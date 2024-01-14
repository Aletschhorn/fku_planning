<?php
namespace FKU\FkuPlanning\Domain\Repository;

class SurveyRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	* defaultOrderings
	*
	* @var array
	*/
	protected $defaultOrderings = [
		'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	];
	
	/**
	* findByOwner
	*
	* @param \FKU\FkuPeople\Domain\Model\Person $person
	* @return
	*/
	public function findByOwner (\FKU\FkuPeople\Domain\Model\Person $person) {
		$query = $this->createQuery();
		$query->matching($query->equals('owner',$person));
		return $query->execute();
	}	

}