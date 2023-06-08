<?php
namespace FKU\FkuPlanning\Domain\Repository;

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
 * The repository for Masters
 */
class MasterRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	* defaultOrderings
	*
	* @var array
	*/
	protected $defaultOrderings = array('date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
	
	/**
	* findNewest
	*
	* @param \array $visibility Visibility uids that shall be displayed
	* @return
	*/
	public function findNewest ($visibility = array()) {
		if (! is_array($visibility)) {
			$visibility = [];
		}
		$orderings = ['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];
		$query = $this->createQuery();
		if (count($visibility) > 0) {
			$query->matching($query->in('visibility',$visibility));
		}
		return $query->setOrderings($orderings)->execute()->getFirst();
	}	

	/**
	* findOldest
	*
	* @param \array $visibility Visibility uids that shall be displayed
	* @return
	*/
	public function findOldest ($visibility = array()) {
		if (! is_array($visibility)) {
			$visibility = [];
		}
		$orderings = ['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
		$query = $this->createQuery();
		if (count($visibility) > 0) {
			$query->matching($query->in('visibility',$visibility));
		}
		return $query->setOrderings($orderings)->execute()->getFirst();
	}	

	/**
	* findNext
	*
	* @param \DateTime $start Next (or previous) master from this date on
	* @param \boolean $previous If true: find previous instead of next master
	* @param \array $visibility Visibility uids that shall be displayed
	* @return
	*/
	public function findNext ($start, $previous = false, $visibility = array()) {
		$startUTC = (clone $start)->setTimezone(new \DateTimeZone('UTC'));
		if (! is_array($visibility)) {
			$visibility = [];
		}
		$query = $this->createQuery();
		$constraints = [];
		if ($previous) {
			$constraints[] = $query->lessThan('date',$startUTC->format('Y-m-d H:i:s'));
			$orderings = ['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];
		} else {
			$constraints[] = $query->greaterThan('date',$startUTC->format('Y-m-d H:i:s'));
			$orderings = ['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
		}
		if (count($visibility) > 0) {
			$constraints[] = $query->in('visibility',$visibility);
		}
		return $query->matching($query->logicalAnd($constraints))->setOrderings($orderings)->execute()->getFirst();
	}	

	/**
	* findNext
	*
	* @param \DateTime $start Next (or previous) master from this date on
	* @param \boolean $previous If true: find previous instead of next master
	* @param \array $visibility Visibility uids that shall be displayed
	* @return
	*/
	public function findNextLivestream ($start, $previous = false, $visibility = array()) {
		$startUTC = (clone $start)->setTimezone(new \DateTimeZone('UTC'));
		if (! is_array($visibility)) {
			$visibility = [];
		}
		$query = $this->createQuery();
		$constraints = [$query->equals('serviceLivestream',1)];
		if ($previous) {
			$constraints[] = $query->lessThan('date',$startUTC->format('Y-m-d H:i:s'));
			$orderings = ['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];
		} else {
			$constraints[] = $query->greaterThan('date',$startUTC->format('Y-m-d H:i:s'));
			$orderings = ['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
		}
		if (count($visibility) > 0) {
			$constraints[] = $query->in('visibility',$visibility);
		}
		return $query->matching($query->logicalAnd($constraints))->setOrderings($orderings)->execute()->getFirst();
	}	

	/**
	* findInDateRange
	*
	* @param \DateTime $lowLimit
	* @param \DateTime $highLimit
	* @param \array $visibility Visibility uids that shall be taken
	* @param \array $extraContraints Additional contraints
	* @return
	*/
	public function findInDateRange (\DateTime $lowLimit, \DateTime $highLimit, $visibility = array(), $extraContraints = array()) {
		if (! is_array($visibility)) {
			$visibility = [];
		}
		$query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
		$constraints = [];
		if (count($extraContraints) > 0) {
			foreach ($extraContraints as $field => $value) {
				$constraints[] = $query->equals($field, $value);
			}
		}
		$constraints[] = $query->greaterThanOrEqual('date',$lowLimit->format('Y-m-d H:i:s'));
		$constraints[] = $query->lessThan('date',$highLimit->format('Y-m-d H:i:s'));
		if (count($visibility) > 0) {
			$constraints[] = $query->in('visibility',$visibility);
		}
		$orderings = ['date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
		return $query->matching($query->logicalAnd($constraints))->setOrderings($orderings)->execute();
	}	

	/**
	* findUpdated
	*
	* @param \integer $year
	* @param \integer $updateIntervalHours
	* @param \array $visibility Visibility uids that shall be taken
	* @return
	*/
	public function findUpdated ($year, $updateIntervalHours, $visibility = array()) {
		if (! is_array($visibility)) {
			$visibility = [];
		}
		date_default_timezone_set('Europe/Zurich');
		$start = new \DateTime();
		$start->setTime(0,0,0)->setDate($year,1,1);
		$tstamp = new \DateTime();
		$tstamp->modify('-'.$updateIntervalHours.' hours');
		$query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
		$constraints = [];
		$constraints[] = $query->greaterThanOrEqual('date',$start->format('Y-m-d H:i:s'));
		$constraints[] = $query->greaterThanOrEqual('tstamp',$tstamp->format('U'));
		if (count($visibility) > 0) {
			$constraints[] = $query->in('visibility',$visibility);
		}
		return $query->matching($query->logicalAnd($constraints))->execute();
	}	

	/**
	 * findByEvent
	 *
	 * @param \FKU\FkuAgenda\Domain\Model\Event $event
	 * @return
	 */
	public function findByEvent ($event) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
		$query->matching($query->equals('event.uid',$event->getUid()));
		return $query->execute()->getFirst();
	}

	/**
	* findSermonBySearch
	*
	* @var String $expression
	* @var Integer $year 0 = all years (no limitation)
	* @return
	*/
	public function findSermonBySearch($expression = '', $year = 0) {
		$query = $this->createQuery();
		$constraints = [];
		
		$constraints[] = $query->equals('sermonExist',true);
		
		if ($expression) {
			$contraints[] = $query->logicalOr(
				$query->like('title','%'.$expression.'%'),
				$query->like('biblePassage','%'.$expression.'%')
			);
		}

		if ($year > 0) {
			$endyear = $year+1;
			$constraints[] = $query->logicalAnd(
				$query->greaterThanOrEqual('date',$year.'-00-00 00:00:00'),
				$query->lessThan('date',$endyear.'-00-00 00:00:00')
			);
		}

		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array('date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		return $query->execute();
	}

	/**
	* findSermonBySerial
	*
	* @return
	*/
	public function findSermonBySerial() {
		$oldest = mktime(0,0,0,1,1,2013);
		$query = $this->createQuery();
		$query->matching($query->logicalAnd([$query->equals('sermonExist',true),$query->greaterThanOrEqual('date',$oldest)]));
		$query->setOrderings(['serviceSerial.sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING, 'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING]);
		return $query->execute();
	}

	/**
	* findSermonOldest
	*
	* @return
	*/
	public function findSermonOldest() {
		$query = $this->createQuery();
		$query->matching($query->equals('sermonExist',true));
		$query->setOrderings(array('date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		return $query->execute()->getFirst();
	}
	
	/**
	* findSermonNewest
	*
	* @var boolean $onlyPublic
	* @return
	*/
	public function findSermonNewest($onlyPublic = false) {
		$query = $this->createQuery();
		$constraints = [];
		
		$constraints[] = $query->equals('sermonExist',true);
		if ($onlyPublic) {
			$constraints[] = $query->equals('sermonPublic',true);
		}

		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array('date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
		return $query->execute()->getFirst();
	}
	
	/**
	* findWithoutSermon
	*
	* @var /DateTime $startDate
	* @var /Integer $limit
	* @return
	*/
	public function findWithoutSermon($startDate, $limit = 1) {
		$query = $this->createQuery();
		$constraints = [
			$query->equals('sermonExist',false),
			$query->equals('serviceActive',true),
			$query->greaterThanOrEqual('date',$startDate->format('Y-m-d 00:00:00'))
		];

		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array('date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		$query->setLimit($limit);
		return $query->execute();
	}
	
	/**
	* findWithoutSermon
	*
	* @var /DateTime $startDate
	* @var /DateTime $endDate
	* @return
	*/
	public function findWithoutSermonDaterange($startDate, $endDate) {
		$query = $this->createQuery();
		$constraints = [
			$query->equals('sermonExist',false),
			$query->equals('serviceActive',true),
			$query->greaterThanOrEqual('date',$startDate->format('Y-m-d 00:00:00')),
			$query->lessThanOrEqual('date',$endDate->format('Y-m-d 00:00:00'))
		];

		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array('date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		return $query->execute();
	}
}
