<?php
namespace FKU\FkuPlanning\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Daniel Widmer <daniel.widmer@fku.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * MasterController
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use FKU\FkuPlanning\Utilities\Utilities;
use FKU\FkuPlanning\Domain\Repository\MasterRepository;
use FKU\FkuPlanning\Domain\Repository\FileReferenceRepository;
use FKU\FkuPlanning\Domain\Repository\VisibilityRepository;
use FKU\FkuPlanning\Domain\Repository\SerialRepository;
use FKU\FkuPlanning\Domain\Repository\TrackingRepository;
use FKU\FkuPlanning\Domain\Repository\MissionaryRepository;
use FKU\FkuPlanning\Command\IcalCommand;
use FKU\FkuPeople\Domain\Repository\PersonRepository;
use FKU\FkuPeople\Domain\Repository\UserRepository;
use FKU\FkuPeople\Domain\Repository\NotificationRepository;
use FKU\FkuPeople\Domain\Repository\BirthdayRepository;
use FKU\FkuPeople\Command\NotificationCommand;
use FKU\FkuAgenda\Domain\Repository\EventRepository;
use FKU\FkuSongs\Domain\Repository\ReportingRepository;

class MasterController extends ActionController {

    /**
     * sections
     */
    protected $sections = array(
		'service' => array(
			'key' => 'service',
			'name' => 'Gottesdienst',
			'title' => 'Gottesdienst',
			'pdf' => 'Gottesdienst',
			'role' => false
		),
		'teens' => array(
			'key' => 'teens',
			'name' => 'Teens Treff',
			'title' => 'Teens-Treff',
			'pdf' => 'TeensTreff',
			'role' => false
		),
		'kids' => array(
			'key' => 'kids',
			'name' => 'Kids Treff',
			'title' => 'Kids-Treff',
			'pdf' => 'KidsTreff',
			'role' => false
		),
		'children' => array(
			'key' => 'children',
			'name' => 'Kinderhüeti',
			'title' => 'Kinderhüeti',
			'pdf' => 'Kinderhueti',
			'role' => false
		),
		'others' => array(
			'key' => 'others',
			'name' => 'Vorher, nachher',
			'title' => 'Vorher-Nachher',
			'pdf' => 'VorherNachher',
			'role' => false
		),
		'mission' => array(
			'key' => 'mission',
			'name' => 'Missionsfenster',
			'title' => 'Missionsfenster',
			'pdf' => 'Missionsfenster',
			'role' => 'usergroupMission'
		)
	);
	
	protected $kidsProgramOptions = array (
		0 => 'Kein Kids Treff',
		1 => 'Thema',
		2 => 'Thema, Kinder anfangs im GD',
		3 => 'Kinder ganze Zeit im GD',
		4 => 'Ferienprogramm',
		5 => 'Theaterprobe',
		6 => 'Ausflug'
	);
	
	protected $teensProgram1Options = array (
		0 => 'Kein Teens Treff',
		1 => 'Thema',
		2 => 'Gottesdienstbesuch',
	);
	
	protected $teensProgram2Options = array (
		0 => 'Kein Teens Treff',
		1 => 'Thema',
		2 => 'Gottesdienstbesuch',
		3 => 'Schnuppereinsatz im GD',
	);

      
	/**
	 * @param MasterRepository $masterRepository
	 * @param FileReferenceRepository $fileReferenceRepository
	 * @param VisibilityRepository $visibilityRepository
	 * @param SerialRepository $serialRepository
	 * @param TrackingRepository $trackingRepository
	 * @param MissionaryRepository $missionaryRepository
	 */
	public function __construct(
			MasterRepository $masterRepository,
			FileReferenceRepository $fileReferenceRepository,
			VisibilityRepository $visibilityRepository,
			SerialRepository $serialRepository,
			TrackingRepository $trackingRepository,
			MissionaryRepository $missionaryRepository
		) {
		$this->masterRepository = $masterRepository;
		$this->fileReferenceRepository = $fileReferenceRepository;
		$this->visibilityRepository = $visibilityRepository;
		$this->serialRepository = $serialRepository;
		$this->trackingRepository = $trackingRepository;
		$this->missionaryRepository = $missionaryRepository;
	}
	
    /**
     * action dashboard
     *
     * @return void
     */
    public function dashboardAction() {

		// define filter values
		$visible = explode(',',$this->settings['showVisibility']);
		$now = new \DateTime();
		$later = new \DateTime();
		$later->modify('+6 months');

		// read data from database
        $masters = $this->masterRepository->findInDateRange($now, $later, $visible);
		$me = intval($GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid']);
		
		// filter the masters with logged-in person involved
		$myMasters = [];
		if ($me > 0) {
			foreach ($masters as $key => $master) {
				if ($activeInMaster = Utilities::identifyUser($master, $me)) {
					$myMasters[$key] = $activeInMaster;
				}
			}
			$myMaster = array_shift($myMasters);
		}

		$this->view->assignMultiple(array(
			'myMaster' => $myMaster,
			'me' => $me,
			'settings' => $this->settings,
		));
		
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {
		
		// define active section when loading
		if ($this->request->hasArgument('section')) { 
			$userSection = trim($this->request->getArgument('section'));
			if (array_key_exists ($userSection, $this->sections)) {
				$section = $userSection;
				$GLOBALS['TSFE']->fe_user->setKey('ses','planingSection',$section);
			}
		} else {
			$section = $GLOBALS['TSFE']->fe_user->getKey('ses','planingSection');
		}
		if ($section == 'personal') {
			$this->forward('personal');
		} elseif ($section == '') {
			$section = 'service';
		}
		
		// define filter values
		$visible = explode(',',$this->settings['showVisibility']);
		$limit = $this->getFilterValues();
		$this->getListLimits($filter, $daterange, $limit['low'], $limit['high'], $visible, 4);
		$daterange['visible'] = $this->settings['showVisibility'];

		// read data from database
		if ($section == 'mission') {
	        $masters = $this->masterRepository->findInDateRange($filter['low'], $filter['high'], $visible, ['serviceMission' => 1]);
		} else {
	        $masters = $this->masterRepository->findInDateRange($filter['low'], $filter['high'], $visible);
		}
		
		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		
		if ($this->request->hasArgument('jump')) { 
			$jump = $this->request->getArgument('jump');
		}
		
		$this->view->assignMultiple(array(
			'masters' => $masters,
			'me' => $me,
			'section' => $section,
			'sections' =>  $this->sections,
			'filter' => $filter,
			'daterange' => $daterange,
			'jump' => $jump,
			'settings' => $this->settings,
		));
		
    }
    
    /**
     * action personal
     *
     * @return void
     */
    public function personalAction() {
		
		$GLOBALS['TSFE']->fe_user->setKey('ses','planingSection','personal');
		
		// define filter values
		$visible = explode(',',$this->settings['showVisibility']);
		$limit = $this->getFilterValues();
		$this->getListLimits($filter, $daterange, $limit['low'], $limit['high'], $visible, 4);
		$daterange['visible'] = $this->settings['showVisibility'];

		// read data from database
        $masters = $this->masterRepository->findInDateRange($filter['low'], $filter['high'], $visible);
		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		
		// filter the masters with logged-in person involved
		$myMasters = [];
		foreach ($masters as $key => $master) {
			if ($myMaster = Utilities::identifyUser($master, $me)) {
				$myMasters[$key] = $myMaster;
				if ($master->getEvent() instanceof Event) {
					$event = $master->getEvent();
					$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
					$myMasters[$key]['reporting'] = $objectManager->get(ReportingRepository::class)->findByEvent($event);		
				}
			}
		}
		
		$this->view->assignMultiple(array(
			'myMasters' => $myMasters,
			'me' => $me,
			'section' => 'personal',
			'sections' =>  $this->sections,
			'filter' => $filter,
			'daterange' => $daterange,
			'settings' => $this->settings,
		));
		
    }
    
    /**
     * action listMonth
     *
     * @return void
     */
    public function listMonthAction() {
		
		// define active section when loading
		if ($this->request->hasArgument('section')) { 
			$userSection = trim($this->request->getArgument('section'));
			if (array_key_exists ($userSection, $this->sections)) {
				$section = $userSection;
				$GLOBALS['TSFE']->fe_user->setKey('ses','planingSection',$section);
			}
		} else {
			$section = $GLOBALS['TSFE']->fe_user->getKey('ses','planingSection');
		}
		if ($section == 'personal' or $section == '') {
			$section = 'service';
		}
		
		// define filter values
		$visible = explode(',',$this->settings['showVisibility']);
		$month = $GLOBALS['TSFE']->fe_user->getKey('ses','planningMonth');
		if ($month == 0) {
			$month = date('n');
		}
		$year = $GLOBALS['TSFE']->fe_user->getKey('ses','planningYear');
		if ($year == 0) {
			$year = date('Y');
		}
		if ($this->request->hasArgument('month')) { 
			$month = intval($this->request->getArgument('month'));
			$GLOBALS['TSFE']->fe_user->setKey('ses','planningMonth',$month);
		}
		if ($this->request->hasArgument('year')) { 
			$year = intval($this->request->getArgument('year')); 
			$GLOBALS['TSFE']->fe_user->setKey('ses','planningYear',$year);
		}
		
		$dateRanges = $this->getDateRanges($month, $year, $visible);
		$filter = $dateRanges['filter'];
		$pagination = $dateRanges['pagination'];
		$month = $dateRanges['month'];
		$year = $dateRanges['year'];
		$daterange = array(
			'low' => $filter['low']->format('Ym'), 
			'high' => $filter['high']->format('Ym'), 
			'visible' => $this->settings['showVisibility']
		);

		// read data from database
        $masters = $this->masterRepository->findInDateRange($filter['low'], $filter['high'], $visible);
		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		
		$this->view->assignMultiple(array(
			'masters' => $masters,
			'me' => $me,
			'section' => $section,
			'sections' =>  $this->sections,
			'filter' => $filter,
			'daterange' => $daterange,
			'pagination' => $pagination,
			'settings' => $this->settings,
		));
		
    }
    
    /**
     * action driver
     *
     * @return void
     */
    public function driverAction() {
		
		// define filter values
		$low = new \DateTime('first day of next month');
		$low->setTime(0,0,0);
		$high = new \DateTime('last day of next month');
		$high->setTime(23,59,59);
		$visible = explode(',',$this->settings['showVisibility']);
		
		// read data from database
        $masters = $this->masterRepository->findInDateRange($low, $high, $visible);
		
		$this->view->assignMultiple(array(
			'masters' => $masters,
			'settings' => $this->settings,
			'date' => $low,
		));
		
    }
    
    /**
     * action show
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
     * @return void
     */
    public function showAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		if ($master->isServiceActive()) {
			$maillistAll = array();
			$namelistAll = array();
			$maillistMusic = array();
			$namelistMusic = array();
			foreach ($master->getServicePreacher() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
				}
			}
			foreach ($master->getServiceModerator() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
				}
			}
			foreach ($master->getServiceMusicSelect() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
					$maillistMusic[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
					$namelistMusic[] = $person->getName();
				}
			}
			foreach ($master->getServiceMusicRehearse() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
					$maillistMusic[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
					$namelistMusic[] = $person->getName();
				}
			}
			foreach ($master->getServiceMusicBand() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
					$maillistMusic[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
					$namelistMusic[] = $person->getName();
				}
			}
			foreach ($master->getServiceMusicOrgan() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
				}
			}
			foreach ($master->getServiceBeamer() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
				}
			}
			foreach ($master->getServiceConsole() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
					$maillistMusic[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
					$namelistMusic[] = $person->getName();
				}
			}
			foreach ($master->getServiceCamera() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
					$maillistMusic[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
					$namelistMusic[] = $person->getName();
				}
			}
			foreach ($master->getServiceFilmeditor() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
					$maillistMusic[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
					$namelistMusic[] = $person->getName();
				}
			}
			foreach ($master->getServiceSexton() as $person) {
				if ($person->getEmail()) {
					$maillistAll[] = $person->getEmail();
				} else {
					$namelistAll[] = $person->getName();
				}
			}
			if ($master->isServiceMission()) {
				foreach ($master->getServiceMissionary() as $person) {
					if ($person->getEmail()) {
						$maillistAll[] = $person->getEmail();
					} else {
						$namelistAll[] = $person->getName();
					}
				}
			}
			if ($master->isServiceSupper()) {
				foreach ($master->getServiceSupperPeople() as $person) {
					if ($person->getEmail()) {
						$maillistAll[] = $person->getEmail();
					} else {
						$namelistAll[] = $person->getName();
					}
				}
			}
			if ($master->isServiceMission()) {
				foreach ($master->getServiceMissionary() as $person) {
					if ($person->getEmail()) {
						$maillistAll[] = $person->getEmail();
					} else {
						$namelistAll[] = $person->getName();
					}
				}
			}
			$maillistAll[] = 'gdablauf@fku.ch';
			$maillistAll = array_unique($maillistAll);
			$namelistAll = array_unique($namelistAll);
			$maillistMusic = array_unique($maillistMusic);
			$namelistMusic = array_unique($namelistMusic);
			$mailingAll = array('included' => implode(';',$maillistAll), 'excluded' => implode(', ',$namelistAll));
			$mailingMusic = array('included' => implode(';',$maillistMusic), 'excluded' => implode(', ',$namelistMusic));
			
			if ($master->getEvent() instanceof \FKU\FkuAgenda\Domain\Model\Event) {
				$event = $master->getEvent();
				$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
				$reporting = $objectManager->get(ReportingRepository::class)->findByEvent($event);		
			}
		}

		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		$visible = explode(',',$this->settings['showVisibility']);
		$nextMaster = $this->masterRepository->findNext($master->getDate(), 0, $visible);
		if ($nextMaster == $master) { $nextMaster = NULL; }
		$previousMaster = $this->masterRepository->findNext($master->getDate(), 1, $visible);
		if ($previousMaster == $master) { $previousMaster = NULL; }
		
		$logs = $this->trackingRepository->findByMaster($master);

		$this->view->assignMultiple(array(
			'master' => $master,
			'nextMaster' => $nextMaster,
			'previousMaster' => $previousMaster,
			'me' => $me,
			'mailingAll' => $mailingAll,
			'mailingMusic' => $mailingMusic,
			'reporting' => $reporting,
			'logs' => $logs,
			'settings' => $this->settings,
		));
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction() {
		$startTime = explode('.',$this->settings['defaultStartTime']);
		$newestMaster = $this->masterRepository->findNewest();
		$newDate = clone $newestMaster->getDate();
		$newDate->modify('next Sunday')->setTime(trim($startTime[0]),trim($startTime[1]));
		$master = new \FKU\FkuPlanning\Domain\Model\Master();
		$master->setDate($newDate);
		$visibilities = $this->visibilityRepository->findAll();
		$this->view->assignMultiple(array(
			'master' => $master,
			'visibilities' => $visibilities,
			'settings' => $this->settings,
		));
    }
    
	/**
	* initializeCreateAction
	*
	* @return void
	*/
	public function initializeCreateAction() {
		if (isset($this->arguments['master'])) {
				$this->arguments['master']->getPropertyMappingConfiguration()->forProperty('dateDate')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
				$this->arguments['master']->getPropertyMappingConfiguration()->forProperty('dateTime')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'H.i');
		}
	}

    /**
     * action create
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
     * @return void
     */
    public function createAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		$master->setServiceActive(true);
		$master->setChildrenActive(true);
		$master->setKidsYoungActive(true);
		$master->setKidsProgram(1);
		$master->setTeensProgram1(1);
		$master->setTeensProgram2(1);
		$master->setCoffeeActive(true);
		$master->setPrayerActive(true);
		$master->setDrivingActive(true);


		// Try to find service in agenda
		$date = clone $master->getDate();
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$event = $objectManager->get(EventRepository::class)->findByInterval($date->setTime(0,0)->format('U'), 0, 24, [1], 0, [24])->getFirst();
		if ($event instanceof \FKU\FkuAgenda\Domain\Model\Event) {
			$master->setEvent($event);
		}
		
		// Store in database
        $this->masterRepository->add($master);

        $this->addFlashMessage('Neuen Gottesdienst eingetragen', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->redirect('list');
    }
    
	/**
	* initializeEditAction
	*
	* @return void
	*/
	public function initializEditAction() {
		$this->arguments['master']->getPropertyMappingConfiguration()->forProperty('dateDate')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
		$this->arguments['master']->getPropertyMappingConfiguration()->forProperty('dateTime')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'H.i');
	}

    /**
     * action edit
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("master")
     * @return void
     */
    public function editAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		if ($this->request->hasArgument('section')) { 
			$section = trim($this->request->getArgument('section'));
			if (array_key_exists ($section, $this->sections) or $section == 'general') {

				if ($this->request->hasArgument('back')) {
					$back = $this->request->getArgument('back');
				}

				$nextMaster = $this->masterRepository->findNext($master->getDate(), 0, $visible);
				$forward = false;
				if ($nextMaster) {
					$forward = true;
				}

				$this->view->assignMultiple(array(
					'master' => $master,
					'section' => $section,
					'sectionInfo' =>  $this->sections[$section],
					'visibilities' => $this->visibilityRepository->findAll(),
					'serials' => $this->serialRepository->findRecent(),
					'allPeople' => $objectManager->get(PersonRepository::class)->findAllWithName(),
					'forward' => $forward,
					'back' => $back,
					'kidsProgramOptions' => $this->kidsProgramOptions,
					'teensProgram1Options' => $this->teensProgram1Options,
					'teensProgram2Options' => $this->teensProgram2Options,
					'missionaryOptions' => $this->missionaryRepository->findAll(),
					'settings' => $this->settings,
				));
			} else {
				$this->redirect('list');
			}
		} else {
			$this->redirect('list');
		}
    }
    
	/**
	* initializeUpdateAction
	*
	* @return void
	*/
	public function initializeUpdateAction() {
		if (isset($this->arguments['master'])) {
			$this->arguments['master']->getPropertyMappingConfiguration()->forProperty('dateDate')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['master']->getPropertyMappingConfiguration()->forProperty('dateTime')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'H.i');
			// $this->arguments['master']->getPropertyMappingConfiguration()->allowProperties('missionContent');
			// $this->arguments['master']->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('missionContent', 'array');
		}
	}

    /**
     * action update
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
     * @return void
     */
    public function updateAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$modifyAgenda = false;
		$relevantForAgenda = ['serviceTopic','serviceBible','serviceSupper','servicePreacher','teensProgram1','teensProgram2','kidsProgram','childrenActive'];
		
		if ($this->request->hasArgument('section')) {
			$section = $this->request->getArgument('section');
			switch ($section) {
				case 'general':
					$fieldsWithPeople = [];
					$notificationRule = NULL;

					// Try to find service in agenda
					if (! $master->getEvent()) {
						$date = clone $master->getDate();
						$event = $objectManager->get(EventRepository::class)->findByInterval($date->setTime(0,0)->format('U'), 0, 24, [1], 0, [24])->getFirst();
						if ($event instanceof \FKU\FkuAgenda\Domain\Model\Event) {
							$master->setEvent($event);
						}
					}
					break;
				case 'service':
					$fieldsWithPeople = ['servicePreacher','serviceModerator','serviceMusicSelect','serviceMusicRehearse','serviceMusicBand','serviceMusicOrgan','serviceBeamer','serviceConsole','serviceFilmeditor','serviceCamera','serviceSexton','serviceMissionary', 'serviceSupperPeople'];
					$notificationRule = 21;
					break;
				case 'children':
					$fieldsWithPeople = ['childrenPeople','kidsYoung'];
					$notificationRule = 24;
					break;
				case 'kids':
					$fieldsWithPeople = ['kidsPlaying','kidsSinging','kidsPlenum','kidsGroup1','kidsGroup2','kidsGroup3','kidsGroup3Program','kidsYoung'];
					$notificationRule = 23;
					break;
				case 'teens':
					$fieldsWithPeople = ['teensPeople1','teensPeople2'];
					$notificationRule = 22;
					break;
				case 'others':
					$fieldsWithPeople = ['drivingPeople','serviceWelcome','prayerPeople','coffeePeople','coffeeSpecial','serviceWinter'];
					$notificationRule = 25;
					break;
				case 'mission':
					$fieldsWithPeople = ['serviceMissionary'];
					$notificationRule = NULL;
					$missionContentCollection = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
					$missionContent = $this->request->getArgument('missionContent');
					if (is_array($missionContent)) {
						foreach ($missionContent as $content) {
							$contentValue = intval($content);
							if ($contentValue > 0) {
								$contentElement = $this->missionaryRepository->findByUid($contentValue);
								$missionContentCollection->attach($contentElement);
							}
						}
					}
					$master->setServiceMissionContent($missionContentCollection);
					break;
			}

			// Fill people lists with people data sets
			$listUser = [];
			$listNotification = [];
			$mailingUsers = [];
			$tempValues = $this->request->getArgument('master');
			$notificationRepository = $objectManager->get(NotificationRepository::class);
			$userRepository = $objectManager->get(UserRepository::class);
			$personRepository = $objectManager->get(PersonRepository::class);

			foreach ($fieldsWithPeople as $field) {
				$tempSingleValueArray = explode (',',$tempValues[$field]);
				array_pop ($tempSingleValueArray);
				foreach ($tempSingleValueArray as $tempSingleValue) {
					if ($tempSingleValue != '') {
						$person = $personRepository->findByFullName($tempSingleValue);
						if ($person) {
							$func = 'add'.ucfirst($field);
							call_user_func (array ($master, $func), $person);
							
							// add involved person to list of users (for later notification)
							if ($notificationRule) {
								$user = $userRepository->findByPersonUid($person->getUid());
								if ($user) {
									if (! in_array($user->getUid(), $listUser)) {
										$listUser[] = $user->getUid();
										$notifications = $notificationRepository->findSomeOfUser($user, array($notificationRule),'fku_planning');
										if ($notifications->count() > 0) {
											$notifcationRawText = $notifications->getFirst()->getRule()->getMessage();
											foreach ($notifications as $notification) {
												$listNotification[] = $notification;
											}
										}
									}
								}
							}
						}
					}
				}
			}
			
			$this->masterRepository->update($master);
			$title = $this->sections[$section]['title'];
			if ($section == 'general') {
				$title = 'Generelle Gottesdienst';
			}
			$this->addFlashMessage($title.'-Angaben vom '.$master->getDate()->format('j.m.Y').' aktualisiert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);

			// Notification if all changes are of interest (independent of involved person)
			$listAllNotification = [];
			$notifications = $objectManager->get(NotificationRepository::class)->findAllPerRule([26],'fku_planning');
			if ($notifications->count() > 0) {
				$notifcationAllRawText = $notifications->getFirst()->getRule()->getMessage();
				foreach ($notifications as $notification) {
					$listAllNotification[] = $notification;
				}
			}

			// Tracking of changes
			$oldValues = [];
			$notifText = [];
			$notifAllText = [];
			if ($this->request->hasArgument('old')) {
				$oldValues = $this->request->getArgument('old');
			}
			$timezone = new \DateTimeZone('Europe/Zurich');
			$now = new \DateTime('now');
    	    $now->setTimezone($timezone);
			$trackingTemplate = new \FKU\FkuPlanning\Domain\Model\Tracking;
			$trackingTemplate->setMoment($now);
			$trackingTemplate->setMaster($master);
			$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
			if ($me > 0) {
				$user = $personRepository->findByUid($me);
				$trackingTemplate->setUser($user);
			}
			$log = 'Start'.chr(10).chr(13);
			foreach ($tempValues as $field => $tempValue) {
				if ($field != '__identity' and $field != 'dateDate' and $field != 'dateTime' and $field != 'visibility') {
					if (in_array($field, $fieldsWithPeople)) {
						$old = $oldValues[$field];
						if ($old === NULL or $old === false or $old === '') {
							$old = '(leer)';
						}
					} else {
						$oldTemp = $master->_getCleanProperty($field);
						if (is_object($oldTemp)) {
							$old = strval($oldTemp->getUid());
						} elseif (strval($oldTemp) == '') {
							$old = '(leer)';
						} else {
							$old = $oldTemp;
						}
					}
					if (! $tempValue) {
						$tempValue = '(leer)';
					}
					if ($old != $tempValue) {
						$log .= $field.' | '.$old.' ('.gettype($old).') | '.$tempValue.' ('.gettype($tempValue).')'.chr(10).chr(13);
						$tracking = clone $trackingTemplate;
						$tracking->setField($field);
						$tracking->setOld($old);
						$tracking->setNew($tempValue);
						$this->trackingRepository->add($tracking);
						if (in_array($field,$relevantForAgenda)) {
							$modifyAgenda = true;
						}
						
						// Generate notifications as per user-specific rules
						$notifAllText[] = sprintf($notifcationAllRawText, $master->getDate()->format('d.m.y'), $user->getName(), \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($field, 'fku_planning'), $old, $tempValue);
						$notifText[] = sprintf($notifcationRawText, $master->getDate()->format('d.m.y'), $user->getName(), \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($field, 'fku_planning'), $old, $tempValue);
					}
				}
			}
			// mail('daniel.widmer@fku.ch','Log Master Update',$log);
			
			$notificationCommand = $objectManager->get(NotificationCommand::class);
			if (count($listAllNotification) > 0 and count($notifAllText) > 0) {
				$notificationCommand->storeNotifications($listAllNotification, $notifAllText);
			}
			if (count($listNotification) > 0 and count($notifText) > 0) {
				$notificationCommand->storeNotifications($listNotification, $notifText);
			}

			// Read navigation variables
			$back = $this->request->getArgument('back');
			if ($this->request->hasArgument('forward')) {
				$forward = intval($this->request->getArgument('forward'));
			}
			
			// Show agenda event modification form if relevant master field was modified
			if ($modifyAgenda and $master->getEvent()) {
				$this->redirect('agenda','Master','fkuplanning',array('master' => $master,'section' => $section,'back' => $back,'forward' => $forward));
			}

			// Show edit form of next master if corresponding submit button was klicked
			if ($forward > 0) {
				$nextMaster = $this->masterRepository->findNext($master->getDate(), 0, $visible);
				if ($nextMaster) {
					$this->redirect('edit','Master','fkuplanning',array('master' => $nextMaster,'section' => $section,'back' => $back));				
				}
			}
			
			// Go to either listView or showView depending on what was displayed before the editView
			if ($back == 'list') {
				$this->redirect('list','Master','fkuplanning',array('section' => $section, 'jump' => 'master'.$master->getUid()));
			} else {
				$this->redirect($back,'Master','fkuplanning',array('master' => $master));
			}
		} else {
			$this->redirect('list');
		}
	}
        
	 /**
     * action delete
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
     * @return void
     */
    public function deleteAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
        $this->addFlashMessage('Gottesdienst vom '.$master->getDate()->format('d.m.Y').' gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->masterRepository->remove($master);
        $this->redirect('list');
    }

	/**
	 * action export
	 *
	 * @return void
	 */
	public function exportAction() {

		$now = new \DateTime();
		$arguments = $this->request->getArguments();
		$section = $arguments['section'];

		// define filter values
		$visible = explode(',',$arguments['visible']);
		$limitLow = intval($arguments['lowLimit']);
		$limitHigh = intval($arguments['highLimit']);
		$this->getListLimits($filter, $daterange, $limitLow, $limitHigh, $visible, 0);

		if (array_key_exists ($section, $this->sections)) {
	        $masters = $this->masterRepository->findInDateRange($filter['low'], $filter['high'], $visible);
		}
		$filter['high']->modify('-1 month');

		$filename = $this->sections[$section]['pdf'].'-Plan_'.date('Ymd-His').'.pdf';
		$title = $this->sections[$section]['pdf'].'-Plan';
		$this->response->setHeader('Expires','0');
		$this->response->setHeader('Cache-Control','must-revalidate, post-check=0, pre-check=0');
		$this->response->setHeader('Content-Disposition','attachment; filename=' . $filename);
		$this->response->setHeader('Content-Type','application/pdf; charset=UTF8');

		$this->view->assignMultiple(array(
			'masters' => $masters,
			'section' => $section,
			'title' => $title,
			'filter' => $filter,
			'now' => $now,
		));
	}

	 /**
     * action agenda
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
     * @return void
     */
    public function agendaAction(\FKU\FkuPlanning\Domain\Model\Master $master) {

		$go['arguments']['master'] = $master;
		// Get some variables
		if ($this->request->hasArgument('forward')) {
			$go['arguments']['forward'] = intval($this->request->getArgument('forward'));
		}
		if ($this->request->hasArgument('back')) {
			$go['arguments']['back'] = $this->request->getArgument('back');
			if ($go['arguments']['back'] == 'list') {
				$go['arguments']['jump'] = 'master'.$master->getUid();
			}
		}
		if ($this->request->hasArgument('section')) {
			$go['arguments']['section'] = $this->request->getArgument('section');
		}
		
		if ($go['arguments']['forward'] > 0) {
			$nextMaster = $this->masterRepository->findNext($master->getDate(), 0, $visible);
			if ($nextMaster) {
				$go['action'] = 'edit';
				$go['arguments']['master'] = $nextMaster;
			} else {
				$go['action'] = $go['arguments']['back'];
			}
		} else {
			$go['action'] = $go['arguments']['back'];
		}
		if (! $go['action']) {
			$go['action'] = 'list';
		}			

		$this->view->assignMultiple(array(
			'master' => $master,
			'go' => $go,
			'sectionInfo' =>  $this->sections[$go['arguments']['section']],
		));
	}
		
		
	 /**
     * action agendaUpdate
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
     * @return void
     */
    public function agendaUpdateAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		
		if ($this->request->hasArgument('eventDescriptionNew')) {
			$description = trim($this->request->getArgument('eventDescriptionNew'));
			if ($description != '') {
				$event = $master->getEvent();
				if ($event) {
					$event->setDescription($description);
					$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
					$objectManager->get(EventRepository::class)->update($event);
				}
		        $this->addFlashMessage('Agenda-Eintrag des Gottesdiensts vom '.$master->getDate()->format('d.m.Y').' geändert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
			} else {
		        $this->addFlashMessage('Agenda-Eintrag des Gottesdiensts vom '.$master->getDate()->format('d.m.Y').' konnte nicht geändert werden', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			}
		} else {
	        $this->addFlashMessage('Agenda-Eintrag des Gottesdiensts vom '.$master->getDate()->format('d.m.Y').' konnte nicht geändert werden', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		}

		// Get some variables
		if ($this->request->hasArgument('forward')) {
			$forward = intval($this->request->getArgument('forward'));
		}
		if ($this->request->hasArgument('back')) {
			$back = intval($this->request->getArgument('back'));
		}
		if ($this->request->hasArgument('section')) {
			$section = intval($this->request->getArgument('section'));
		}

		// Go to correct next action
		if ($forward > 0) {
			$nextMaster = $this->masterRepository->findNext($master->getDate(), 0, $visible);
			if ($nextMaster) {
				$this->redirect('edit','Master','fkuplanning',array('master' => $nextMaster,'section' => $section,'back' => $back));				
			}
		}
		if ($back == 'list') {
			$this->redirect('list','Master','fkuplanning',array('section' => $section, 'jump' => 'master'.$master->getUid()));
		} else {
			$this->redirect('show','Master','fkuplanning',array('master' => $master));
		}
    }

	/**
	 * getListLimits
	 *
	 * @param Array $filter
	 * @param Array $daterange
	 * @param Integer $getValueLow GET parameter of list filter, low value, in Format YYYYMM
	 * @param Integer $getValueLow GET parameter of list filter, high value, in Format YYYYMM
	 * @param Array $visibility Visibility uids that shall be displayed
	 * @param Integer $backwards Number of month the lowest limits is in the past, 0 = unlimited
	 * @return void
	 */
	protected function getListLimits (&$filter, &$daterange, $getValueLow = 0, $getValueHigh = 0, $visibility = array(), $backwards = 0) {
		$filter = [];

		if ($backwards > 0) {
			$filter['lowest'] = new \DateTime('first day of -'.$backwards.' months');
		} else {
			$oldestMaster = $this->masterRepository->findOldest($visibility);
			if ($oldestMaster) {
				$oldestMasterDate = $oldestMaster->getDate();
				$filter['lowest'] = clone $oldestMasterDate;
				$filter['lowest']->modify('first day of this month');
			} else {
				$filter['lowest'] = new \DateTime('first day of this month');
			}
		}
		$filter['lowest']->setTime(0,0,0);
		$filter['low'] = new \DateTime('first day of this month');
		$filter['low']->setTime(0,0,0);

		$newestMaster = $this->masterRepository->findNewest($visibility);
		if ($newestMaster) {
			$newestMasterDate = $newestMaster->getDate();
			$filter['highest'] = clone $newestMasterDate;
			$filter['highest']->modify('first day of this month');
		} else {
			$filter['highest'] = new \DateTime('first day of this month');
		}
		$filter['highest']->setTime(0,0,0);
		$filter['high'] = new \DateTime('first day of +2 months');
		if ($filter['highest'] < $filter['high']) {
			$filter['high'] = $filter['highest'];
		}
		$filter['high']->setTime(0,0,0);

		$daterange = [];
//		$daterange['low'] = $filter['low']->format('Ym');
		$daterange['low'] = 0; // stands for "today"
		if ($getValueLow > 0) {
			$daterange['low'] = $getValueLow;
			$daterange['low'] = min($daterange['low'], $filter['highest']->format('Ym'));
			$daterange['low'] = max($daterange['low'], $filter['lowest']->format('Ym'));
		}
		$daterange['high'] = $filter['high']->format('Ym');
		if ($getValueHigh > 0) {
			$daterange['high'] = $getValueHigh;
			$daterange['high'] = max($daterange['high'], $filter['lowest']->format('Ym'));
			$daterange['high'] = min($daterange['high'], $filter['highest']->format('Ym'));
		}
		if ($daterange['high'] < $daterange['low']) {
			$daterange['high'] = $daterange['low'];
		}
//		$daterange['options'] = [];
		$daterange['options'] = [0 => 'heute'];
		$tempfilter = clone $filter['lowest'];
		while ($tempfilter <= $filter['highest']) {
			$daterange['options'][$tempfilter->format('Ym')] = strftime('%b %Y', $tempfilter->getTimestamp());
//			$daterange['options'][$tempfilter->format('Ym')] = utf8_encode(strftime('%b %Y', $tempfilter->getTimestamp()));
			$tempfilter->modify('+1 month');
		}
		
		if ($daterange['low'] == 0) {
			$filter['low'] = new \DateTime('today');
		} else {
			$filter['low']->setDate(substr($daterange['low'],0,4),substr($daterange['low'],4,2),1);
		}
		$filter['high']->setDate(substr($daterange['high'],0,4),substr($daterange['high'],4,2),1)->modify('+1 month');
	}

    /**
     * action calendar
     *
     * @return void
     */
    public function calendarAction() {
		$me = $GLOBALS['TSFE']->fe_user->user;
		$this->view->assignMultiple(array(
			'me' => $me,
			'settings' => $this->settings,
		));
	}
	
    /**
     * action createCalendar
     *
     * @return void
     */
    public function createCalendarAction() {
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$userRepository = $objectManager->get(UserRepository::class);
		$me = $GLOBALS['TSFE']->fe_user->user['uid'];
		$user = $userRepository->findByUid($me);
		$code = str_replace(' ','_',$user->getName()).'_'.substr(uniqid(''),5,6);
		$user->setTxFkupeoplePlanningcal($code);
		$userRepository->update($user);
		
		// write to database
		$persistenceManager = $objectManager->get(PersistenceManager::class);
		$persistenceManager->persistAll();
		
		// create .ics file
		$icsFile = GeneralUtility::makeInstance(IcalCommand::class);
		$icsFile->createFiles($this->settings['IcalFilePathAndName'], explode(',',$this->settings['IcalVisible']), $user);

        $this->redirect('calendar');
	}
	
    /**
     * action updateCalendar
     *
     * @return void
     */
    public function updateCalendarAction() {
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$userRepository = $objectManager->get(UserRepository::class);
		$me = $GLOBALS['TSFE']->fe_user->user['uid'];
		$user = $userRepository->findByUid($me);
		$user->setTxFkupeoplePlanningAlarm(intval($this->request->getArgument('alarm')));
		$userRepository->update($user);
		
		// write to database
		$persistenceManager = $objectManager->get(PersistenceManager::class);
		$persistenceManager->persistAll();
		
		// re-create .ics file with new reminder settings
		$icsFile = GeneralUtility::makeInstance(IcalCommand::class);
		$icsFile->createFiles($this->settings['IcalFilePathAndName'], explode(',',$this->settings['IcalVisible']), $user);

        $this->redirect('calendar');
	}
	
    /**
     * action removeCalendar
     *
     * @return void
     */
    public function removeCalendarAction() {
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$userRepository = $objectManager->get(UserRepository::class);
		$me = $GLOBALS['TSFE']->fe_user->user['uid'];
		$user = $userRepository->findByUid($me);
		$filename = $this->settings['IcalFilePathAndName'].'_'.$user->getTxFkupeoplePlanningcal().'.ics';
		unlink($filename);
		$user->setTxFkupeoplePlanningcal('');
		$userRepository->update($user);
        $this->redirect('calendar');
	}

	/**
	 * action beamer
	 *
	 * @return void
	 */
	public function beamerAction() {
		if ($this->request->hasArgument('clearCache')) {
			$GLOBALS['TSFE']->clearPageCacheContent();
		}

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$now = new \DateTime;
		$masterVisibility = explode(',',$this->settings['showVisibility']);
		$referenceMaster = $this->masterRepository->findNext($now, 0, $masterVisibility);
		$startDate = clone $referenceMaster->getDate();
		$startDate->modify('-8 days');
		$endDate = clone $referenceMaster->getDate();
		$endDate->modify('+15 days');
		$navigationMasters = $this->masterRepository->findInDateRange($startDate, $endDate, $masterVisibility);

		if ($this->request->hasArgument('master')) { 
			$masterId = intval($this->request->getArgument('master')); 
			$master = $this->masterRepository->findByUid($masterId);
		}
		if (! $master) {
			$master = $referenceMaster;
		}
		$navigationExtra = ['before' => false, 'after' => false];
		if ($master->getDate() > $endDate) {
			$navigationExtra['after'] = true;
		}
		if ($master->getDate() < $startDate) {
			$navigationExtra['before'] = true;
		}
		
		// if there are less than 7 days until the next service, the agenda shall be shown until the even next service
		// if there are more than 7 days until the next service, the agenda shall be shown until the next service
		$date = clone $master->getDate();
		$isSunday = true;
		if ($date->format('w') > 0) {
			$isSunday = false;
		}
		$days = 7;
		$nextMaster = $this->masterRepository->findNext($date, false, $masterVisibility);
		if ($nextMaster) {
			$diff = $date->diff($nextMaster->getDate());
			$difference = $diff->d + round($diff->h / 24);
			if ($difference < 7) {
				$nextMaster2 = $this->masterRepository->findNext($nextMaster->getDate(), false, $masterVisibility);
				$diff = $date->diff($nextMaster2->getDate());
				$difference = $diff->d + round($diff->h / 24);
			}
			$days = max($days, $difference);
		}
		
		// Get events
		if (1 == 1) {
			// $this->settings['showContects'] & 1
			$events = $objectManager->get(EventRepository::class)->findByInterval(
				$date->modify('+1 hour')->format('U'), 
				$days, 
				12, 
				explode(',',$this->settings['showEventVisibility']), 
				$this->settings['showEventAllCategories'], 
				explode(',',$this->settings['showEventCategory'])
			);
		}
		
		// Get losungen
		if (1 == 1) {
			// $this->settings['showContects'] & 2
			$filename = 'losungen'.$date->format('Y').'.xml';
			if (substr($this->settings['losungenRootPath'],-1) != '/') {
				$filename = '/'.$filename;
			}
	
			if (file_exists($this->settings['losungenRootPath'].$filename)) {
				$xml = simplexml_load_file ($this->settings['losungenRootPath'].$filename);
				$todayLosungArray = $xml->xpath('//Datum[. ="'.$date->format('Y-m-d').'T00:00:00"]/parent::*');
				$todayLosung = $todayLosungArray[0];
				
				$losung = array(
					'text' => str_replace('/','',(string)$todayLosung->Losungstext),
					'vers' => (string)$todayLosung->Losungsvers,
				);
				$lehrtext = array(
					'text' => str_replace('/','',(string)$todayLosung->Lehrtext),
					'vers' => (string)$todayLosung->Lehrtextvers,
				);
			} else {
				$losung = array(
					'text' => 'Losungsdatei für das Jahr '.$date->format('Y').' konnte nicht gefunden werden. Bitte Administrator informieren. Vorübergehend auf folgender Seite probieren: www.combib.de/internetlosungen/variante1.html',
					'vers' => ''
				);
			}
		}
		
		// Get birthdays (only shown on Sundays)
		if ($isSunday) {
			// $this->settings['showContects'] & 4 and 
			$birthdays = $objectManager->get(BirthdayRepository::class)->findBirthday($date->setTime(0,0,0)->format('U'), $days);
			$adults = 0;
			$children = 0;
			foreach ($birthdays as $birthday) {
				if ($birthday->getPersAlter() > 18) {
					$adults++;
				} else {
					$children++;
				}
			}
			$birthdayCount = array ('adults' => $adults, 'children' => $children);
		}


		// Get songs
		if ($master->getEvent() instanceof \FKU\FkuAgenda\Domain\Model\Event) {
			// $this->settings['showContects'] & 8 and 
			// $event = $master->getEvent();
			$reporting = $objectManager->get(ReportingRepository::class)->findByEvent($master->getEvent());	
		}
		
		$this->view->assignMultiple(array(
			'master' => $master,
			'navigationMasters' => $navigationMasters,
			'navigationExtra' => $navigationExtra,
			'referenceDate' => $referenceDate,
			'reporting' => $reporting,
			'events' => $events,
			'losung' => $losung,
			'lehrtext' => $lehrtext,
			'birthdays' => $birthdays,
			'birthdayCount' => $birthdayCount,
			'isSunday' => $isSunday,
			'settings' => $this->settings,
			'timestamp' => $date->setTime(0,0,0)->format('U'),
			'chr11' => chr(11),
		));
	}

	/**
	 * action missionary
	 *
	 * @return void
	 */
	public function missionaryAction() {
		
		// define filter values
		$visible = explode(',',$this->settings['showVisibility']);
		$limit = $this->getFilterValues();
		$this->getListLimits($filter, $daterange, $limit['low'], $limit['high'], $visible, 4);
		$daterange['visible'] = $this->settings['showVisibility'];

		// read data from database
        $masters = $this->masterRepository->findInDateRange($filter['low'], $filter['high'], $visible, ['serviceMission' => 1]);
		
		$me = $GLOBALS['TSFE']->fe_user->user['tx_fkupeople_fkudbid'];
		
		$this->view->assignMultiple(array(
			'masters' => $masters,
			'me' => $me,
			'filter' => $filter,
			'daterange' => $daterange,
			'settings' => $this->settings,
		));
		
	}


	/**
	 * Create low and high limit based on selected filter values
	 *
	 * @return array
	 */
	protected function getFilterValues () {
		$limitLow = $GLOBALS['TSFE']->fe_user->getKey('ses','planingLimitLow');
		$limitHigh = $GLOBALS['TSFE']->fe_user->getKey('ses','planingLimitHigh');
		if ($this->request->hasArgument('lowLimit')) { 
			$limitLow = intval($this->request->getArgument('lowLimit'));
			$GLOBALS['TSFE']->fe_user->setKey('ses','planingLimitLow',$limitLow);
		}
		if ($this->request->hasArgument('highLimit')) { 
			$limitHigh = intval($this->request->getArgument('highLimit')); 
			$GLOBALS['TSFE']->fe_user->setKey('ses','planingLimitHigh',$limitHigh);
		}
		return ['high' => $limitHigh, 'low' => $limitLow];
	}
	
	/**
	 * Create date limits and pagination values
	 *
	 * @param integer $thisMonth recent month (1-12)
	 * @param integer $thisYear recent year (e.g. 2014)
	 * @param Array $visibility Visibility uids that shall be displayed
	 * @return array
	 */
	protected function getDateRanges ($thisMonth, $thisYear, $visibility = array()) {

		$filter = [];
		
		$oldestMaster = $this->masterRepository->findOldest($visibility);
		if ($oldestMaster) {
			$oldestMasterDate = $oldestMaster->getDate();
			$filter['lowest'] = clone $oldestMasterDate;
			$filter['lowest']->modify('first day of this month');
		} else {
			$filter['lowest'] = new \DateTime('first day of this month');
		}
		$filter['lowest']->setTime(0,0,0);

		$newestMaster = $this->masterRepository->findNewest($visibility);
		if ($newestMaster) {
			$newestMasterDate = $newestMaster->getDate();
			$filter['highest'] = clone $newestMasterDate;
			$filter['highest']->modify('first day of this month');
		} else {
			$filter['highest'] = new \DateTime('first day of this month');
		}
		$filter['highest']->setTime(0,0,0);

		$runningMonth = new \DateTime;
		$runningMonth->setTime(0,0,0);
		$runningMonth->setDate($thisYear,$thisMonth,1);
		if ($runningMonth < $filter['lowest']) {
			$thisYear = $filter['lowest']->format('Y');
			$thisMonth = $filter['lowest']->format('n');
			$runningMonth = $filter['lowest'];
		}
		$filter['low'] = clone $runningMonth;
		$runningMonth->modify('last day of this month');
		if ($runningMonth->format('Ym') > $filter['highest']->format('Ym')) {
			$thisYear = $filter['highest']->format('Y');
			$thisMonth = $filter['highest']->format('n');
			$runningMonth = $filter['highest'];
		}
		$filter['high'] = clone $runningMonth;
		
		$runningMonth->setDate($thisYear,$thisMonth,1);
		$pagination = array ('month', 'year');
		$page = array ();
		$page2 = array ();
		$runningMonth->modify('-1 month');
		if ($runningMonth < $filter['lowest']) {
			$class = 'page-item disabled';
		} else {
			$class = 'page-item';
		}
		$page[] = array ('class' => $class, 'label' => '«', 'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));
		$page2[] = array ('class' => $class, 'label' => '«', 'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));

		for ($i=1;$i<=12;$i++) {
			$runningMonth->setDate($thisYear,$i,1);
			if ($i == $thisMonth) {
				$class = 'page-item active';
				$page2[] = array ('class' => $class, 'label' => strftime('%b', $runningMonth->format('U')),  'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));
			} elseif ($runningMonth->format('Ym') < $filter['lowest']->format('Ym') or $runningMonth->format('Ym') > $filter['highest']->format('Ym')) {
				$class = 'page-item disabled';
			} else {
				$class = 'page-item';
			}
			$page[] = array ('class' => $class, 'label' => strftime('%b', $runningMonth->format('U')),  'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));
		}

		$runningMonth->setDate($thisYear,$thisMonth,1);
		$runningMonth->modify('+1 month');
		if ($runningMonth > $filter['highest']) {
			$class = 'page-item disabled';
		} else {
			$class = 'page-item';
		}
		$page[] = array ('class' => $class, 'label' => '»', 'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));
		$page2[] = array ('class' => $class, 'label' => '»', 'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));

		$pagination['month'] = $page;
		$pagination['minimonth'] = $page2;
		
		$page = array();
		$runningMonth->setDate($thisYear-1,12,1);
		if ($runningMonth < $filter['lowest']) {
			$class = 'page-item disabled';
		} else {
			$class = 'page-item';
		}
		$page[] = array ('class' => $class, 'label' => '«', 'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));
		$runningMonth->setDate($thisYear,$thisMonth,1);
		$page[] = array ('class' => 'page-item active', 'label' => $thisYear, 'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));
		$runningMonth->setDate($thisYear+1,1,1);
		if ($runningMonth > $filter['highest']) {
			$class = 'page-item disabled';
		} else {
			$class = 'page-item';
		}
		$page[] = array ('class' => $class, 'label' => '»', 'arguments' => array ('month' => $runningMonth->format('n'), 'year' => $runningMonth->format('Y')));
		$pagination['year'] = $page;
		
		return array('pagination' => $pagination, 'filter' => $filter, 'month' => $thisMonth, 'year' => $thisYear);
	}
	
	/**
	 * action sermonList
	 *
	 * @return void
	 */
	public function sermonListAction() {
		if ($this->settings['lastSermon'] == 1) {
			// Show only latest public sermon instead of sermon list
			$this->forward('sermonLast');
		}

		$years = array();
		$today = new \DateTime();
		if ($sermon = $this->masterRepository->findSermonOldest()) {
			$old = $sermon->getDate();
			$oldest = $sermon->getDate()->format('Y');
		} else {
			$old = $today;
			$oldest = $today->format('Y');
		}
		if ($sermon = $this->masterRepository->findSermonNewest()) {
			$newest = $sermon->getDate()->format('Y');
		} else {
			$newest = $today->format('Y');
		}

		for ($i=$newest; $i>=$oldest; $i--) {
			$years[$i] = $i;
		}

		if ($this->request->hasArgument('expression')) { 
			$expression = trim($this->request->getArgument('expression')); 
		} else { 
			$expression = '';
		}
		if ($this->request->hasArgument('year')) { 
			$year = intval($this->request->getArgument('year')); 
		} else { 
			$year = reset($years);
		}
		if ($this->request->hasArgument('sorting')) { 
			$sorting = intval($this->request->getArgument('sorting')); 
		} else { 
			$sorting = 1;
		}

		$filter = array(
			'expression' => $expression,
			'year' => $year,
			'sorting' => $sorting
		);
		$masters = $this->masterRepository->findSermonBySearch($expression, $year);
		
		$startDate = new \DateTime;
		$startDate->setTime(0,0,0);
		$startDate->modify('last wednesday');
		$upcoming = $this->masterRepository->findWithoutSermon($startDate)->getFirst();
		
		$this->view->assignMultiple(array(
			'masters' => $masters,
			'back' => 'list',
			'years' => $years,
			'filter' => $filter,
			'upcoming' => $upcoming,
			'settings' => $this->settings,
		));
	}

	/**
	 * action sermonShow
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\Master $master
	 * @return void
	 */
	public function sermonShowAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		if ($this->request->hasArgument('expression')) { 
			$expression = trim($this->request->getArgument('expression')); 
		} else { 
			$expression = '';
		}
		if ($this->request->hasArgument('year')) { 
			$year = intval($this->request->getArgument('year')); 
		} else { 
			$year = date('Y');
		}
		if ($this->request->hasArgument('sorting')) { 
			$sorting = intval($this->request->getArgument('sorting')); 
		} else { 
			$sorting = 1;
		}
		$this->view->assignMultiple(array(
			'master' => $master,
			'expression' => $expression,
			'year' => $year,
			'sorting' => $sorting,
			'settings' => $this->settings,
		));
	}

	/**
	 * action sermonLast
	 *
	 * @return void
	 */
	public function sermonLastAction() {
		$master = $this->masterRepository->findSermonNewest(true);
		$this->view->assignMultiple(array(
			'master' => $master,
			'settings' => $this->settings,
		));
	}

	/**
	 * action sermonNewList
	 *
	 * @return void
	 */
	public function sermonNewListAction() {
		$steps = 10;

		$limit = 0;
		if ($this->request->hasArgument('limit')) {
			$limit = intval($this->request->getArgument('limit'));
		}
		if ($limit == 0) {
			$limit = 10;
		}

		$start = 0;
		if ($this->request->hasArgument('start')) {
			$start = intval($this->request->getArgument('start'));
		}
		if ($start == 0) {
			$start = -3;
		}

		$startDate = new \DateTime;
		$startDate->setTime(0,0,0);
		$startDate->modify($start.' weeks');
		$masters = $this->masterRepository->findWithoutSermon($startDate, $limit);

		$filter['limit'] = $limit + $steps;
		$filter['start']['newer'] = $start;
		$filter['start']['older'] = $start - $steps;
		
/**
		$start = -5;
		$end = 2;
		$count = 0;
		$more = '';
		
		if ($this->request->hasArgument('parameters')) {
			$parameters = explode(',',$this->request->getArgument('parameters'));
			$start = min([$start,intval($parameters[0])]);
			$end = max([$end,intval($parameters[1])]);
			$count = intval($parameters[2]);
		}

		if ($this->request->hasArgument('more')) {
			$more = $this->request->getArgument('more');
		}

		$startDate = new \DateTime('today');
		$startDate->modify($start.' weeks');
		$endDate = new \DateTime('today');
		$endDate->modify($end.' weeks');
		$masters = $this->masterRepository->findWithoutSermonDaterange($startDate, $endDate);

		do {
			$startDate->modify($start.' weeks');
			$masters = $this->masterRepository->findWithoutSermon($startDate, $limit);
		} while (count($masters) == $currentCount and $start < 53);
*/		

		$this->view->assignMultiple(array(
			'masters' => $masters,
			'filter' => $filter,
			'settings' => $this->settings,
		));
	}

	/**
	 * action sermonEdit
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\Master $master
	 * @return void
	 */
	public function sermonEditAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		if ($master->getSermonExist() == false) {
			// make a new sermon public by default
			$master->setSermonPublic(true);
		}

		if ($this->request->hasArgument('back')) { 
			$back = trim($this->request->getArgument('back'));
		}

		$this->view->assignMultiple(array(
			'master' => $master,
			'back' => $back,
			'settings' => $this->settings,
		));
	}

	/**
	 * action sermonUpdate
	 *
	 * @param \FKU\FkuSermon\Domain\Model\Sermons $sermon
	 * @return void
	 */
	public function sermonUpdateAction(\FKU\FkuPlanning\Domain\Model\Master $master) {

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);

		// upload and assign new file
		$storageRepository =  new \TYPO3\CMS\Core\Resource\StorageRepository;
		$storage = $storageRepository->findByUid(intval($this->settings['fileStorageUid']));
		$data = array ();
		if (count($_FILES['tx_fkuplanning_sermon']['error'])) {
			foreach ($_FILES['tx_fkuplanning_sermon']['error'] as $fileId => $error) {
				if ($error == UPLOAD_ERR_OK) {
					
					// upload file
					$fileStoreName = 'PD'.$master->getDate()->format('ymd').'_'.substr(uniqid(''),5,6).'.'.pathinfo($_FILES['tx_fkuplanning_sermon']['name'][$fileId], PATHINFO_EXTENSION);
					$fileTempName = $_FILES['tx_fkuplanning_sermon']['tmp_name'][$fileId];
					$fileObject = $storage->addFile($fileTempName, $storage->getRootLevelFolder(), $fileStoreName);
					$fileRef = new \FKU\FkuPlanning\Domain\Model\FileReference;
					$fileRef->setFile($fileObject);
					$master->addSermonRelatedFile($fileRef);
				}
			}
		}

		// unlink (not delete) relation to files
		if ($this->request->hasArgument('delDocument')) {
			$delFiles = $this->request->getArgument('delDocument');
			if (sizeof($delFiles) > 0) {
				foreach ($delFiles as $fileId => $delete) {
					if ($delete) {
						// delete relation
						$fileRef = $this->fileReferenceRepository->findByUid($fileId);
						$master->removeSermonRelatedFile($fileRef);
						$this->fileReferenceRepository->remove($fileRef);
					}
				}
			}
		}

		// write to database
		$master->setSermonExist(true);
		$this->masterRepository->update($master);
		
		$this->addFlashMessage('Die Predigt-Angaben wurden gespeichert.','',\TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		
		// Generate notifications as per user-specific rules
		if ($master->getSermonPublic() == true and $master->_getCleanProperty('sermonPublic') == false) {
			$notifications = $objectManager->get(NotificationRepository::class)->findAllPerRule([29],'fku_planning');
			if ($notifications->count() > 0) {
				$notifText[0] = sprintf($notifications->getFirst()->getRule()->getMessage(), $master->getDate()->format('d.m.y'));
				$objectManager->get(NotificationCommand::class)->storeNotifications($notifications, $notifText);
			}
		}
		
		$this->redirect('sermonList');
	}

	/**
	 * action sermonDelete
	 *
	 * @param \FKU\FkuSermon\Domain\Model\Sermons $sermon
	 * @return void
	 */
	public function sermonDeleteAction(\FKU\FkuPlanning\Domain\Model\Master $master) {
		$fileRefStorage = $master->getSermonRelatedFiles();
		foreach ($fileRefStorage as $fileRef) {
			$master->removeSermonRelatedFile($fileRef);
			$this->fileReferenceRepository->remove($fileRef);
		}
		$master->setSermonBibletext('');
		$master->setSermonConcept('');
		$master->setSermonPublic(false);
		$master->setSermonExist(false);
		$this->masterRepository->update($master);
		
		$this->addFlashMessage('Die Predigt wurde gelöscht.','',\TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->redirect('sermonList');
	}

	/**
	 * action livestream
	 *
	 * @return void
	 */
	public function livestreamAction() {
		$now = new \DateTime('-4 hours');
		$masterVisibility = explode(',',$this->settings['showVisibility']);
		// $this->settings['livestreamSelection']: 0 = next livestream, 1 = previous livestream
		$master = $this->masterRepository->findNextLivestream($now, intval($this->settings['livestreamSelection']), $masterVisibility);
		$this->view->assignMultiple(array(
			'master' => $master,
			'settings' => $this->settings,
		));		
	}

}