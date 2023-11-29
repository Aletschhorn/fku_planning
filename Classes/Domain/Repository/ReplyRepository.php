<?php
namespace FKU\FkuPlanning\Domain\Repository;

class ReplyRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	* findBySurvey
	*
	* @param \FKU\FkuPlanning\Domain\Model\Survey $survey
	* @return
	*/
	public function findBySurvey (\FKU\FkuPlanning\Domain\Model\Survey $survey) {
		$orderings = array ('tstamp' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
		$query = $this->createQuery();
		$query->matching($query->equals('survey',$survey));
		return $query->setOrderings($orderings)->execute();
	}	


}