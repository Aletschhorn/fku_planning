<?php
namespace FKU\FkuPlanning\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use FKU\FkuPlanning\Domain\Repository\SurveyRepository;
use FKU\FkuPlanning\Domain\Repository\ReplyRepository;
use FKU\FkuPlanning\Domain\Repository\MasterRepository;
use FKU\FkuPeople\Domain\Repository\PersonRepository;
use FKU\FkuPeople\Domain\Repository\UserRepository;
use FKU\FkuPlanning\Utilities\SimpleXLSXGen;

class SurveyController extends ActionController {
    
	/**
	 * @param SurveyRepository $surveyRepository
	 * @param ReplyRepository $replyRepository
	 */
	public function __construct(
			SurveyRepository $surveyRepository,
			ReplyRepository $replyRepository
		) {
		$this->surveyRepository = $surveyRepository;
		$this->replyRepository = $replyRepository;
	}
	
    /**
     * action list
     *
     * @return void
     */
    public function listAction() 
	{
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		$person = $objectManager->get(PersonRepository::class)->findByUid($me);
		
		$mySurveys = $this->surveyRepository->findByOwner($person);
		$myReplies = $this->replyRepository->findByPerson($person);
		
		foreach ($mySurveys->toArray() as $mySurvey) {
			$numberOfReplies[$mySurvey->getUid()] = $this->replyRepository->findBySurvey($mySurvey)->count();
		}
		
		$this->view->assignMultiple([
			'mySurveys' => $mySurveys,
			'myReplies' => $myReplies,
			'numberOfReplies' => $numberOfReplies,
		]);
    }

    /**
     * action show
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $survey
     * @return void
     */
    public function showAction(\FKU\FkuPlanning\Domain\Model\Survey $survey) 
	{
		$replies = $this->replyRepository->findBySurvey($survey);
		
		$this->view->assignMultiple([
			'survey' => $survey,
			'replies' => $replies,
		]);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction() 
	{
		$intervalMonths = 10;
		$numberOfColumns = 4;
		
		$survey = new \FKU\FkuPlanning\Domain\Model\Survey();
		
		$startDate = new \DateTime('Tomorrow');
		$endDate = new \DateTime('+'.$intervalMonths.' months');
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$masters = $objectManager->get(MasterRepository::class)->findInDateRange($startDate, $endDate);
		
		$mastersPerColumn = ceil(count($masters) / $numberOfColumns);
		$counter = 0;
		
		foreach ($masters->toArray() as $row) {
			$masterColumn[floor($counter / $mastersPerColumn)][] = $row;
			$counter++;
		}
			
		$this->view->assignMultiple([
			'survey' => $survey,
			'masters' => $masters,
			'masterColumn' => $masterColumn,
		]);
    }

    /**
     * action create
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $survey
     * @return void
     */
    public function createAction(\FKU\FkuPlanning\Domain\Model\Survey $survey) 
	{
		// set owner
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		$survey->setOwner($objectManager->get(PersonRepository::class)->findByUid($me));
		
		// set slug based on current timestamp and $owner ID
		$survey->setSlug(time().'-'.$me);
		
		// calculate expiry date
		$expiryDate = new \DateTime('+1 month');
		
		// set services
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$masterRepository = $objectManager->get(MasterRepository::class);
		$tempValues = $this->request->getArgument('service');
		foreach ($tempValues as $serviceId => $value) {
			if ($value == 1) {
				if ($service = $masterRepository->findByUid($serviceId)) {
					$survey->addService($service);
					$expiryDate = $service->getDate();
				}
			}
		}
		
		// set expiry date
		$survey->setExpirydate($expiryDate->format('U'));
		
		// store in database
        $this->surveyRepository->add($survey);

        $this->addFlashMessage('Neue Umfrage "'.$survey->getTitle().'" erstellt.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->redirect('list');
        // $this->redirect('show','Survey','fkuplanning',['survey' => $survey]);
	}

    /**
     * action edit
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $survey
     * @return void
     */
    public function editAction(\FKU\FkuPlanning\Domain\Model\Survey $survey) 
	{
		$intervalMonths = 10;
		$numberOfColumns = 4;
		
		// find date of oldest service in survey
		$startDate = new \DateTime('Tomorrow');
		foreach ($survey->getServices() as $row) {
			$startDate = min($startDate,$row->getDate());
		}
		
		// find further services in-beetwen those of survey and in the future
		$endDate = new \DateTime('+'.$intervalMonths.' months');
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$masters = $objectManager->get(MasterRepository::class)->findInDateRange($startDate, $endDate);
		
		// prepare for showing services in columns in frontend
		$mastersPerColumn = ceil(count($masters) / $numberOfColumns);
		$counter = 0;
		$masterColumn = array();
		$serviceList = array();
		$oldServices = array();
		foreach ($masters->toArray() as $row) {
			$masterColumn[floor($counter / $mastersPerColumn)][] = $row;
			$serviceList[$row->getUid()] = 0;
			$counter++;
		}
		foreach ($survey->getServicesSorted() as $row) {
			$serviceList[$row->getUid()] = 1;
			$oldServices[] = $row->getUid();
		}
			
		$this->view->assignMultiple([
			'survey' => $survey,
			'masters' => $masters,
			'masterColumn' => $masterColumn,
			'serviceList' => $serviceList,
			'oldServices' => implode(',',$oldServices),
		]);
    }

    /**
     * action update
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $survey
     * @return void
     */
    public function updateAction(\FKU\FkuPlanning\Domain\Model\Survey $survey) 
	{
		// set services temporarily
		$allServicesArray = array();
		$newServicesArray = array();
		$expiryDate = new \DateTime('+1 month');
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$masterRepository = $objectManager->get(MasterRepository::class);
		$tempValues = $this->request->getArgument('service');
		$allServices = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
		foreach ($tempValues as $serviceId => $value) {
			if ($value == 1) {
				$newServicesArray[] = $serviceId;
				if ($service = $masterRepository->findByUid($serviceId)) {
					$allServices->attach($service);
					$expiryDate = $service->getDate();
				}
			}
		}

		// compare old and new services; if different, set new services and modify existing replies (if existing)
		$oldServices = $this->request->getArgument('oldServices');
		if ($oldServices != implode(',',$newServicesArray)) {
			$survey->setServices($allServices);
			$survey->setExpirydate($expiryDate->format('U'));
			$replies = $this->replyRepository->findBySurvey($survey);
			if ($replies->count() > 0) {
				$oldServicesArray = explode(',',$oldServices);
				$transfer = array();
				foreach ($newServicesArray as $singleNewService) {
					$transfer[] = array_search($singleNewService, $oldServicesArray);
				}
				foreach ($replies as $reply) {
					$oldAvailability = $reply->getAvailabilityArray();
					$newAvailability = array();
					foreach ($transfer as $value) {
						if (is_int($value)) {
							$newAvailability[] = $oldAvailability[$value];
						} else {
							$newAvailability[] = 0;
						}
					}
					$reply->setAvailability(implode(',',$newAvailability));
					$this->replyRepository->update($reply);
				}
			}
			
		}

		// store in database
		$this->surveyRepository->update($survey);
		
        $this->redirect('show','Survey','fkuplanning',['survey' => $survey]);
	}
	
    /**
     * action delete
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $survey
     * @return void
     */
    public function deleteAction(\FKU\FkuPlanning\Domain\Model\Survey $survey) 
	{
		$replies = $this->replyRepository->findBySurvey($survey);
		foreach ($replies as $reply) {
			$this->replyRepository->remove($reply);
		}
		$this->surveyRepository->remove($survey);
		
        $this->addFlashMessage('Umfrage "'.$survey->getTitle().'" gelöscht.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->redirect('list');
    }

    /**
     * action reply
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $survey
     * @return void
     */
    public function replyAction(\FKU\FkuPlanning\Domain\Model\Survey $survey) 
	{
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		$person = $objectManager->get(PersonRepository::class)->findByUid($me);
		
		$replies = $this->replyRepository->findBySurvey($survey);
		$new = false;
		$myReply = $this->replyRepository->findBySurveyAndPerson($survey, $person);
		if (! $myReply) {
			$myReply = new \FKU\FkuPlanning\Domain\Model\Reply;
			$new = true;
		}

		$this->view->assignMultiple([
			'survey' => $survey,
			'replies' => $replies,
			'me' => $person,
			'myReply' => $myReply,
			'new' => $new,
		]);
    }

    /**
     * action participate
     *
     * @param \FKU\FkuPlanning\Domain\Model\Reply $reply
     * @return void
     */
    public function participateAction(\FKU\FkuPlanning\Domain\Model\Reply $reply) 
	{
		$availability = $this->request->getArgument('availability');
		ksort($availability);
		$reply->setAvailability(implode(',',$availability));
		if ($reply->getUid() > 0) {
			// update existiing reply
			$this->replyRepository->update($reply);
		} else {
			// create new reply
			$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
			$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
			$reply->setUser($objectManager->get(PersonRepository::class)->findByUid($me));
			$this->replyRepository->add($reply);
		}

		$this->redirect('reply','Survey','fkuplanning',['survey' => $reply->getSurvey()]);
	}


    /**
     * action download
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $survey
     * @return void
     */
    public function downloadAction(\FKU\FkuPlanning\Domain\Model\Survey $survey) 
	{
		$row = [''];
		foreach ($survey->getServicesSorted() as $service) {
			$row[] = $service->getDate()->format('Y-m-d');
		}
		$data = array($row);
		$replies = $this->replyRepository->findBySurvey($survey);
		foreach ($replies as $reply) {
			$row = [$reply->getUser()->getName()];
			$availabilities = explode(',', $reply->getAvailability());
			foreach ($availabilities as $availability) {
				switch ($availability) {
					case 0:
						$row[] = '<style bgcolor="#FFFFFF"></style>';
						break;
					case 1:
						$row[] = '<style bgcolor="#D5E6CE"></style>';
						break;
					case 2:
						$row[] = '<style bgcolor="#FBE8CD"></style>';
						break;
					case 3:
						$row[] = '<style bgcolor="#F4CFCE"></style>';
						break;
				}
			}
			$data[] = $row;
		}
		SimpleXLSXGen::fromArray($data)->downloadAs('table.xlsx');

        $this->redirect('show','Survey','fkuplanning',['survey' => $survey]);
	}
	
}