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
		$orderings = array ('user.firstname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
		$query = $this->createQuery();
		$query->matching($query->equals('survey',$survey));
		return $query->setOrderings($orderings)->execute();
	}	

	/**
	* findByPerson
	*
	* @param \FKU\FkuPeople\Domain\Model\Person $person
	* @return
	*/
	public function findByPerson (\FKU\FkuPeople\Domain\Model\Person $person) {
		$orderings = array ('survey.crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
		$query = $this->createQuery();
		$query->matching($query->equals('user',$person));
		return $query->setOrderings($orderings)->execute();
	}	

	/**
	* findBySurveyAndPerson
	*
	* @param \FKU\FkuPlanning\Domain\Model\Survey $survey
	* @param \FKU\FkuPeople\Domain\Model\Person $person
	* @return
	*/
	public function findBySurveyAndPerson (\FKU\FkuPlanning\Domain\Model\Survey $survey, \FKU\FkuPeople\Domain\Model\Person $person) {
		$query = $this->createQuery();
		$query->matching($query->logicalAnd([$query->equals('survey',$survey),$query->equals('user',$person)]));
		return $query->execute()->getFirst();
	}	


}