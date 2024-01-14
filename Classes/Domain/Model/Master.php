<?php
namespace FKU\FkuPlanning\Domain\Model;

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
 * Master
 */
class Master extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * date
     *
     * @var \DateTime
     */
    protected $date = null;
    
    /**
     * dateDate (only date without time)
     *
     * @var \DateTime
     */
    protected $dateDate = null;
    
    /**
     * dateMonth (only month)
     *
     * @var int
     */
    protected $dateMonth = 0;
    
    /**
     * dateTime (only time without date)
     *
     * @var \DateTime
     */
    protected $dateTime = null;
    
    /**
     * holidays
     *
     * @var bool
     */
    protected $holidays = false;
    
    /**
     * notes
     *
     * @var string
     */
    protected $notes = '';
    
    /**
     * visibility
     *
     * @var \FKU\FkuPlanning\Domain\Model\Visibility
     */
    protected $visibility;
    
    /**
     * agenda
     *
     * @var bool
     */
    protected $agenda = false;
    
    /**
     * event
     *
     * @var \FKU\FkuAgenda\Domain\Model\Event
     */
    protected $event = NULL;
    
    /**
     * serviceActive
     *
     * @var bool
     */
    protected $serviceActive = false;
    
    /**
     * serviceTopic
     *
     * @var string
     */
    protected $serviceTopic = '';
    
    /**
     * serviceSerial
     *
     * @var \FKU\FkuPlanning\Domain\Model\Serial
     */
    protected $serviceSerial;
    
    /**
     * serviceBible
     *
     * @var string
     */
    protected $serviceBible = '';

	/**
	 * servicePreacher
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
	 */
    protected $servicePreacher = NULL;
    
    /**
     * serviceNotes
     *
     * @var string
     */
    protected $serviceNotes = '';
    
    /**
     * serviceModerator
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceModerator = null;
    
    /**
     * serviceMusicSelect
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceMusicSelect = null;
    
    /**
     * serviceMusicSelectAll
     *
     * @var bool
     */
    protected $serviceMusicSelectAll = false;
    
    /**
     * serviceMusicRehearse
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceMusicRehearse = null;
    
    /**
     * serviceMusicBand
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceMusicBand = null;
    
    /**
     * serviceMusicOrgan
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceMusicOrgan = null;
    
    /**
     * serviceBeamer
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceBeamer = null;
    
    /**
     * serviceConsole
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceConsole = null;
    
    /**
     * serviceCamera
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceCamera = null;
    
    /**
     * serviceFilmeditor
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceFilmeditor = null;
    
    /**
     * serviceSexton
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceSexton = null;
    
    /**
     * serviceWelcome
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceWelcome = null;
    
    /**
     * serviceWinter
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceWinter = null;
    
    /**
     * serviceMission
     *
     * @var bool
     */
    protected $serviceMission = false;
    
    /**
     * serviceMissionNotes
     *
     * @var string
     */
    protected $serviceMissionNotes = '';
    
    /**
     * serviceMissionContent
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPlanning\Domain\Model\Missionary>
     */
    protected $serviceMissionContent = null;
    
    /**
     * serviceMissionContentArray
     *
	 * @var array
     */
    protected $serviceMissionContentArray = [];
    
    /**
     * serviceMissionary
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceMissionary = null;
    
    /**
     * serviceSupper
     *
     * @var bool
     */
    protected $serviceSupper = false;
    
    /**
     * serviceSupperPeople
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $serviceSupperPeople = null;
    
    /**
     * serviceCollection
     *
     * @var int
     */
    protected $serviceCollection = 0;
    
    /**
     * serviceLivestream
     *
     * @var bool
     */
    protected $serviceLivestream = false;
    
    /**
     * serviceLivestreamlink
     *
     * @var string
     */
    protected $serviceLivestreamlink = '';
    
    /**
     * childrenActive
     *
     * @var bool
     */
    protected $childrenActive = false;
    
    /**
     * childrenPeople
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $childrenPeople = null;
    
    /**
     * kidsProgram
     *
     * @var int
     */
    protected $kidsProgram = 0;
    
    /**
     * kidsTopic
     *
     * @var string
     */
    protected $kidsTopic = '';
    
    /**
     * kidsTopicLink
     *
     * @var string
     */
    protected $kidsTopicLink = '';
    
    /**
     * kidsNotes
     *
     * @var string
     */
    protected $kidsNotes = '';
    
    /**
     * kidsPlaying
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsPlaying = null;
    
    /**
     * kidsSinging
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsSinging = null;
    
    /**
     * kidsPlenum
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsPlenum = null;
    
    /**
     * kidsGroup1
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsGroup1 = null;
    
    /**
     * kidsGroup2
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsGroup2 = null;
    
    /**
     * kidsGroup3
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsGroup3 = null;
    
    /**
     * kidsGroup3Program
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsGroup3Program = null;
    
    /**
     * kidsYoungActive
     *
     * @var bool
     */
    protected $kidsYoungActive = false;
    
    /**
     * kidsYoung
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $kidsYoung = null;
    
    /**
     * teensProgram1
     *
     * @var int
     */
    protected $teensProgram1 = 0;
    
    /**
     * teensTopic1
     *
     * @var string
     */
    protected $teensTopic1 = '';
    
    /**
     * teensNotes1
     *
     * @var string
     */
    protected $teensNotes1 = '';
    
    /**
     * teensPeople1
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $teensPeople1 = null;
    
    /**
     * teensProgram2
     *
     * @var int
     */
    protected $teensProgram2 = 0;
    
    /**
     * teensTopic2
     *
     * @var string
     */
    protected $teensTopic2 = '';
    
    /**
     * teensNotes2
     *
     * @var string
     */
    protected $teensNotes2 = '';
    
    /**
     * teensPeople2
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $teensPeople2 = null;
    
    /**
     * coffeeActive
     *
     * @var bool
     */
    protected $coffeeActive = false;
    
    /**
     * coffeeNotes
     *
     * @var string
     */
    protected $coffeeNotes = '';
    
    /**
     * coffeePeople
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $coffeePeople = null;
    
    /**
     * coffeeSpecial
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $coffeeSpecial = null;
    
    /**
     * prayerActive
     *
     * @var bool
     */
    protected $prayerActive = false;
    
    /**
     * prayerPeople
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $prayerPeople = null;
    
    /**
     * drivingActive
     *
     * @var bool
     */
    protected $drivingActive = false;
    
    /**
     * drivingPeople
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person>
     */
    protected $drivingPeople = null;
    
	/**
	 * sermonBibletext
	 *
	 * @var string
	 */
	protected $sermonBibletext = '';

	/**
	 * sermonConcept
	 *
	 * @var string
	 */
	protected $sermonConcept = '';

	/**
	 * sermonRelatedFiles
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPlanning\Domain\Model\FileReference>
	 */
	protected $sermonRelatedFiles = NULL;

	/**
	 * sermonPublic
	 *
	 * @var boolean
	 */
	protected $sermonPublic = false;

	/**
	 * sermonExist
	 *
	 * @var boolean
	 */
	protected $sermonExist = false;


	/**
	 * __construct
	 *
	 * @return Event
	 */
	public function __construct() {

		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->sermonRelatedFiles = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}


	/**
	 * Returns the tstamp
	 *
	 * @return \DateTime $tstamp
	 */
	public function getTstamp() {
		$timestamp = new \DateTime(date('Y-m-d H:i:s',$this->tstamp));
		return $timestamp;
	}
	
    /**
     * Returns the date
     *
     * @return \DateTime $date
     */
    public function getDate() {
		return $this->date;
    }
    
    /**
     * Returns the month of the date
     *
     * @return int $dateMonth
     */
    public function getDateMonth() {
		return intval(date_format($this->date,'n'));
    }
    
    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date) {
        $this->date = $date;
		$timezone = new \DateTimeZone('Europe/Zurich');
        $this->date->setTimezone($timezone);
    }
    
    /**
     * Sets the dateDate
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDateDate(\DateTime $date) {
        $this->dateDate = $date;
		if ($this->date) {
			$this->date->setDate($date->format('Y'), $date->format('n'), $date->format('d'));
		} else {
			$this->date = $date;
		}
    }
    
    /**
     * Sets the dateTime
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDateTime(\DateTime $date) {
		$timezone = new \DateTimeZone('Europe/Zurich');
        $this->dateTime = $date;
        $this->dateTime->setTimezone($timezone);
		$this->date->setTime($this->dateTime->format('H'), $this->dateTime->format('i'), 0);
        $this->date->setTimezone($timezone);
    }
    
    /**
     * Returns the holidays
     *
     * @return bool $holidays
     */
    public function getHolidays() {
        return $this->holidays;
    }
    
    /**
     * Sets the holidays
     *
     * @param bool $holidays
     * @return void
     */
    public function setHolidays($holidays) {
        $this->holidays = $holidays;
    }
    
    /**
     * Returns the boolean state of holidays
     *
     * @return bool
     */
    public function isHolidays() {
        return $this->holidays;
    }
    
    /**
     * Returns the notes
     *
     * @return string $notes
     */
    public function getNotes() {
        return $this->notes;
    }
    
    /**
     * Sets the notes
     *
     * @param string $notes
     * @return void
     */
    public function setNotes($notes) {
        $this->notes = $notes;
    }
    
    /**
     * Returns the visibility
     *
     * @return \FKU\FkuPlanning\Domain\Model\Visibility $visibility
     */
    public function getVisibility() {
        return $this->visibility;
    }
    
    /**
     * Sets the visibility
     *
     * @param \FKU\FkuPlanning\Domain\Model\Visibility $visibility
     * @return void
     */
    public function setVisibility(\FKU\FkuPlanning\Domain\Model\Visibility $visibility) {
        $this->visibility = $visibility;
    }
    
    /**
     * Returns the agenda
     *
     * @return bool $agenda
     */
    public function getAgenda() {
        return $this->agenda;
    }
    
    /**
     * Sets the agenda
     *
     * @param bool $agenda
     * @return void
     */
    public function setAgenda($agenda) {
        $this->agenda = $agenda;
    }
    
    /**
     * Returns the boolean state of agenda
     *
     * @return bool
     */
    public function isAgenda() {
        return $this->agenda;
    }
    
    /**
     * Returns the event
     *
     * @return \FKU\FkuAgenda\Domain\Model\Event $event
     */
    public function getEvent() {
        return $this->event;
	}

    /**
     * Sets the event
     *
     * @param \FKU\FkuAgenda\Domain\Model\Event $event
     * @return void
     */
    public function setEvent(\FKU\FkuAgenda\Domain\Model\Event $event) {
        $this->event = $event;
    }

    /**
     * Returns the serviceActive
     *
     * @return bool $serviceActive
     */
    public function getServiceActive() {
        return $this->serviceActive;
    }
    
    /**
     * Sets the serviceActive
     *
     * @param bool $serviceActive
     * @return void
     */
    public function setServiceActive($serviceActive) {
        $this->serviceActive = $serviceActive;
    }
    
    /**
     * Returns the boolean state of serviceActive
     *
     * @return bool
     */
    public function isServiceActive() {
        return $this->serviceActive;
    }
    
    /**
     * Returns the serviceTopic
     *
     * @return string $serviceTopic
     */
    public function getServiceTopic() {
        return $this->serviceTopic;
    }
    
    /**
     * Sets the serviceTopic
     *
     * @param string $serviceTopic
     * @return void
     */
    public function setServiceTopic($serviceTopic) {
        $this->serviceTopic = trim($serviceTopic);
    }
    
    /**
     * Returns the serviceSerial
     *
     * @return \FKU\FkuPlanning\Domain\Model\Visibility $visibility
     */
    public function getServiceSerial() {
        return $this->serviceSerial;
    }
    
    /**
     * Sets the serviceSerial
     *
     * @param mixed $serviceSerial
     * @return void
     */
    public function setServiceSerial($serviceSerial) {
		if ($serviceSerial instanceof \FKU\FkuPlanning\Domain\Model\Serial){
	        $this->serviceSerial = $serviceSerial;
		} else {
			$this->serviceSerial = NULL;
		}
    }
    
    /**
     * Returns the serviceBible
     *
     * @return string $serviceBible
     */
    public function getServiceBible() {
        return $this->serviceBible;
    }
    
    /**
     * Sets the serviceBible
     *
     * @param string $serviceBible
     * @return void
     */
    public function setServiceBible($serviceBible) {
        $this->serviceBible = $serviceBible;
    }
    
	/**
	 * Adds a servicePreacher
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServicePreacher(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->servicePreacher->attach($person);
	}
	
	/**
	 * Removes a servicePreacher
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServicePreacher(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->servicePreacher->detach($person);
	}
	
	/**
	 * Returns the servicePreacher
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $servicePreacher
	 */
	public function getServicePreacher() {
		return $this->servicePreacher;
	}
	
	/**
	 * Sets the servicePreacher
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $servicePreacher
	 * @return void
	 */
	public function setServicePreacher(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $servicePreacher) {
		$this->servicePreacher = $servicePreacher;
	}

    /**
     * Returns the serviceNotes
     *
     * @return string $serviceNotes
     */
    public function getServiceNotes() {
        return $this->serviceNotes;
    }
    
    /**
     * Sets the serviceNotes
     *
     * @param string $serviceNotes
     * @return void
     */
    public function setServiceNotes($serviceNotes) {
        $this->serviceNotes = $serviceNotes;
    }
    
	/**
	 * Adds a serviceModerator
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceModerator(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceModerator->attach($person);
	}
	
	/**
	 * Removes a serviceModerator
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceModerator(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceModerator->detach($person);
	}
	
	/**
	 * Returns the serviceModerator
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceModerator
	 */
	public function getServiceModerator() {
		return $this->serviceModerator;
	}
	
	/**
	 * Sets the serviceModerator
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceModerator
	 * @return void
	 */
	public function setServiceModerator(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceModerator) {
		$this->serviceModerator = $serviceModerator;
	}

	/**
	 * Adds a serviceMusicSelect
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceMusicSelect(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicSelect->attach($person);
	}
	
	/**
	 * Removes a serviceMusicSelect
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceMusicSelect(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicSelect->detach($person);
	}
	
	/**
	 * Returns the serviceMusicSelect
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicSelect
	 */
	public function getServiceMusicSelect() {
		return $this->serviceMusicSelect;
	}
	
	/**
	 * Sets the serviceMusicSelect
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicSelect
	 * @return void
	 */
	public function setServiceMusicSelect(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceMusicSelect) {
		$this->serviceMusicSelect = $serviceMusicSelect;
	}

    /**
     * Returns the serviceMusicSelectAll
     *
     * @return bool $serviceMusicSelectAll
     */
    public function getServiceMusicSelectAll() {
        return $this->serviceMusicSelectAll;
    }
    
    /**
     * Sets the serviceMusicSelectAll
     *
     * @param bool $serviceMusicSelectAll
     * @return void
     */
    public function setServiceMusicSelectAll($serviceMusicSelectAll) {
        $this->serviceMusicSelectAll = $serviceMusicSelectAll;
    }
    
    /**
     * Returns the boolean state of serviceMusicSelectAll
     *
     * @return bool
     */
    public function isServiceMusicSelectAll() {
        return $this->serviceMusicSelectAll;
    }
    
	/**
	 * Adds a serviceMusicRehearse
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceMusicRehearse(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicRehearse->attach($person);
	}
	
	/**
	 * Removes a serviceMusicRehearse
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceMusicRehearse(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicRehearse->detach($person);
	}
	
	/**
	 * Returns the serviceMusicRehearse
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicRehearse
	 */
	public function getServiceMusicRehearse() {
		return $this->serviceMusicRehearse;
	}
	
	/**
	 * Sets the serviceMusicRehearse
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicRehearse
	 * @return void
	 */
	public function setServiceMusicRehearse(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceMusicRehearse) {
		$this->serviceMusicRehearse = $serviceMusicRehearse;
	}

	/**
	 * Adds a serviceMusicBand
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceMusicBand(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicBand->attach($person);
	}
	
	/**
	 * Removes a serviceMusicBand
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceMusicBand(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicBand->detach($person);
	}
	
	/**
	 * Returns the serviceMusicBand
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicBand
	 */
	public function getServiceMusicBand() {
		return $this->serviceMusicBand;
	}
	
	/**
	 * Sets the serviceMusicBand
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicBand
	 * @return void
	 */
	public function setServiceMusicBand(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceMusicBand) {
		$this->serviceMusicBand = $serviceMusicBand;
	}

	/**
	 * Adds a serviceMusicOrgan
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceMusicOrgan(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicOrgan->attach($person);
	}
	
	/**
	 * Removes a serviceMusicOrgan
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceMusicOrgan(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMusicOrgan->detach($person);
	}
	
	/**
	 * Returns the serviceMusicOrgan
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicOrgan
	 */
	public function getServiceMusicOrgan() {
		return $this->serviceMusicOrgan;
	}
	
	/**
	 * Sets the serviceMusicOrgan
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMusicOrgan
	 * @return void
	 */
	public function setServiceMusicOrgan(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceMusicOrgan) {
		$this->serviceMusicOrgan = $serviceMusicOrgan;
	}

	/**
	 * Adds a serviceBeamer
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceBeamer(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceBeamer->attach($person);
	}
	
	/**
	 * Removes a serviceBeamer
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceBeamer(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceBeamer->detach($person);
	}
	
	/**
	 * Returns the serviceBeamer
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceBeamer
	 */
	public function getServiceBeamer() {
		return $this->serviceBeamer;
	}
	
	/**
	 * Sets the serviceBeamer
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceBeamer
	 * @return void
	 */
	public function setServiceBeamer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceBeamer) {
		$this->serviceBeamer = $serviceBeamer;
	}

	/**
	 * Adds a serviceConsole
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceConsole(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceConsole->attach($person);
	}
	
	/**
	 * Removes a serviceConsole
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceConsole(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceConsole->detach($person);
	}
	
	/**
	 * Returns the serviceConsole
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceConsole
	 */
	public function getServiceConsole() {
		return $this->serviceConsole;
	}
	
	/**
	 * Sets the serviceConsole
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceConsole
	 * @return void
	 */
	public function setServiceConsole(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceConsole) {
		$this->serviceConsole = $serviceConsole;
	}

	/**
	 * Adds a serviceCamera
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceCamera(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceCamera->attach($person);
	}
	
	/**
	 * Removes a serviceCamera
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceCamera(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceCamera->detach($person);
	}
	
	/**
	 * Returns the serviceCamera
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceCamera
	 */
	public function getServiceCamera() {
		return $this->serviceCamera;
	}
	
	/**
	 * Sets the serviceCamera
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceCamera
	 * @return void
	 */
	public function setServiceCamera(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceCamera) {
		$this->serviceCamera = $serviceCamera;
	}

	/**
	 * Adds a serviceFilmeditor
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceFilmeditor(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceFilmeditor->attach($person);
	}
	
	/**
	 * Removes a serviceFilmeditor
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceFilmeditor(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceFilmeditor->detach($person);
	}
	
	/**
	 * Returns the serviceFilmeditor
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceFilmeditor
	 */
	public function getServiceFilmeditor() {
		return $this->serviceFilmeditor;
	}
	
	/**
	 * Sets the serviceFilmeditor
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceFilmeditor
	 * @return void
	 */
	public function setServiceFilmeditor(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceFilmeditor) {
		$this->serviceFilmeditor = $serviceFilmeditor;
	}

	/**
	 * Adds a serviceSexton
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceSexton(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceSexton->attach($person);
	}
	
	/**
	 * Removes a serviceSexton
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceSexton(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceSexton->detach($person);
	}
	
	/**
	 * Returns the serviceSexton
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceSexton
	 */
	public function getServiceSexton() {
		return $this->serviceSexton;
	}
	
	/**
	 * Sets the serviceSexton
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceSexton
	 * @return void
	 */
	public function setServiceSexton(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceSexton) {
		$this->serviceSexton = $serviceSexton;
	}
    
	/**
	 * Adds a serviceWelcome
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceWelcome(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceWelcome->attach($person);
	}
	
	/**
	 * Removes a serviceWelcome
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceWelcome(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceWelcome->detach($person);
	}
	
	/**
	 * Returns the serviceWelcome
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceSexton
	 */
	public function getServiceWelcome() {
		return $this->serviceWelcome;
	}
	
	/**
	 * Sets the serviceWelcome
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceWelcome
	 * @return void
	 */
	public function setServiceWelcome(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceWelcome) {
		$this->serviceWelcome = $serviceWelcome;
	}
    
	/**
	 * Adds a serviceWinter
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceWinter(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceWinter->attach($person);
	}
	
	/**
	 * Removes a serviceWinter
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceWinter(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceWinter->detach($person);
	}
	
	/**
	 * Returns the serviceWinter
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceWinter
	 */
	public function getServiceWinter() {
		return $this->serviceWinter;
	}
	
	/**
	 * Sets the serviceWinter
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceWinter
	 * @return void
	 */
	public function setServiceWinter(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceWinter) {
		$this->serviceWinter = $serviceWinter;
	}
    
    /**
     * Returns the serviceMission
     *
     * @return bool $serviceMission
     */
    public function getServiceMission() {
        return $this->serviceMission;
    }
    
    /**
     * Sets the serviceMission
     *
     * @param bool $serviceMission
     * @return void
     */
    public function setServiceMission($serviceMission) {
        $this->serviceMission = $serviceMission;
    }
    
    /**
     * Returns the boolean state of serviceMission
     *
     * @return bool
     */
    public function isServiceMission() {
        return $this->serviceMission;
    }
    
    /**
     * Returns the serviceMissionNotes
     *
     * @return string $serviceMissionNotes
     */
	 
    public function getServiceMissionNotes() {
        return $this->serviceMissionNotes;
    }
    
    /**
     * Sets the serviceMissionNotes
     *
     * @param string $serviceMissionNotes
     * @return void
     */
    public function setServiceMissionNotes($serviceMissionNotes) {
        $this->serviceMissionNotes = $serviceMissionNotes;
    }
    
	/**
	 * Adds a serviceMissionContent
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\Missionary $missionContent
	 * @return void
	 */
	public function addServiceMissionContent(\FKU\FkuPlanning\Domain\Model\Missionary $missionContent) {
		$this->serviceMissionContent->attach($missionContent);
	}
	
	/**
	 * Removes a serviceMissionContent
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\Missionary $missionContent The collection to be removed
	 * @return void
	 */
	public function removeServiceMissionContent(\FKU\FkuPlanning\Domain\Model\Missionary $missionContent) {
		$this->serviceMissionContent->detach($missionContent);
	}
	
	/**
	 * Returns the serviceMissionContent
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FkuPlanning\Domain\Model\Missionary> $serviceMissionContent
	 */
	public function getServiceMissionContent() {
		return $this->serviceMissionContent;
	}
	
	/**
	 * Sets the serviceMissionContent
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FkuPlanning\Domain\Model\Missionary> $serviceMissionContent
	 * @return void
	 */
	public function setServiceMissionContent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceMissionContent) {
		$this->serviceMissionContent = $serviceMissionContent;
	}
    
	/**
	 * Adds a serviceMissionary
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceMissionary(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMissionary->attach($person);
	}
	
	/**
	 * Removes a serviceMissionary
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceMissionary(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceMissionary->detach($person);
	}
	
	/**
	 * Returns the serviceMissionary
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMissionary
	 */
	public function getServiceMissionary() {
		return $this->serviceMissionary;
	}
	
	/**
	 * Sets the serviceMissionary
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceMissionary
	 * @return void
	 */
	public function setServiceMissionary(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceMissionary) {
		$this->serviceMissionary = $serviceMissionary;
	}

    /**
     * Returns the serviceSupper
     *
     * @return bool $serviceSupper
     */
    public function getServiceSupper()     {
        return $this->serviceSupper;
    }
    
    /**
     * Sets the serviceSupper
     *
     * @param bool $serviceSupper
     * @return void
     */
    public function setServiceSupper($serviceSupper) {
        $this->serviceSupper = $serviceSupper;
    }
    
    /**
     * Returns the boolean state of serviceSupper
     *
     * @return bool
     */
    public function isServiceSupper() {
        return $this->serviceSupper;
    }
    
	/**
	 * Adds a serviceSupperPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addServiceSupperPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceSupperPeople->attach($person);
	}
	
	/**
	 * Removes a serviceSupperPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeServiceSupperPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->serviceSupperPeople->detach($person);
	}
	
	/**
	 * Returns the serviceSupperPeople
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceSupperPeople
	 */
	public function getServiceSupperPeople() {
		return $this->serviceSupperPeople;
	}
	
	/**
	 * Sets the serviceSupperPeople
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $serviceSupperPeople
	 * @return void
	 */
	public function setServiceSupperPeople(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $serviceSupperPeople) {
		$this->serviceSupperPeople = $serviceSupperPeople;
	}

    /**
     * Returns the serviceCollection
     *
     * @return int $serviceCollection
     */
    public function getServiceCollection() {
        return $this->serviceCollection;
    }
    
    /**
     * Sets the serviceCollection
     *
     * @param int $serviceCollection
     * @return void
     */
    public function setServiceCollection($serviceCollection) {
        $this->serviceCollection = $serviceCollection;
    }
    
    /**
     * Returns the serviceLivestream
     *
     * @return bool $serviceLivestream
     */
    public function getServiceLivestream() {
        return $this->serviceLivestream;
    }
    
    /**
     * Sets the serviceLivestream
     *
     * @param bool $serviceLivestream
     * @return void
     */
    public function setServiceLivestream($serviceLivestream) {
        $this->serviceLivestream = $serviceLivestream;
    }
    
    /**
     * Returns the boolean state of serviceLivestream
     *
     * @return bool
     */
    public function isServiceLivestream() {
        return $this->serviceLivestream;
    }
    
    /**
     * Returns the serviceLivestreamlink
     *
     * @return string $serviceLivestreamlink
     */
	 
    public function getServiceLivestreamlink() {
        return $this->serviceLivestreamlink;
    }
    
    /**
     * Sets the serviceLivestreamlink
     *
     * @param string $serviceLivestreamlink
     * @return void
     */
    public function setServiceLivestreamlink($serviceLivestreamlink) {
        $this->serviceLivestreamlink = $serviceLivestreamlink;
    }
    
    /**
     * Returns the childrenActive
     *
     * @return bool $childrenActive
     */
    public function getChildrenActive() {
        return $this->childrenActive;
    }
    
    /**
     * Sets the childrenActive
     *
     * @param bool $childrenActive
     * @return void
     */
    public function setChildrenActive($childrenActive) {
        $this->childrenActive = $childrenActive;
    }
    
    /**
     * Returns the boolean state of childrenActive
     *
     * @return bool
     */
    public function isChildrenActive() {
        return $this->childrenActive;
    }
    
	/**
	 * Adds a childrenPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addChildrenPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->childrenPeople->attach($person);
	}
	
	/**
	 * Removes a childrenPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeChildrenPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->childrenPeople->detach($person);
	}
	
	/**
	 * Returns the childrenPeople
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $childrenPeople
	 */
	public function getChildrenPeople() {
		return $this->childrenPeople;
	}
	
	/**
	 * Sets the childrenPeople
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $childrenPeople
	 * @return void
	 */
	public function setChildrenPeople(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $childrenPeople) {
		$this->childrenPeople = $childrenPeople;
	}
    
    /**
     * Returns the kidsProgram
     *
     * @return int $kidsProgram
     */
    public function getKidsProgram() {
        return $this->kidsProgram;
    }
    
    /**
     * Sets the kidsProgram
     *
     * @param int $kidsProgram
     * @return void
     */
    public function setKidsProgram($kidsProgram) {
        $this->kidsProgram = $kidsProgram;
    }
    
    /**
     * Returns the kidsTopic
     *
     * @return string $kidsTopic
     */
    public function getKidsTopic()
    {
        return $this->kidsTopic;
    }
    
    /**
     * Sets the kidsTopic
     *
     * @param string $kidsTopic
     * @return void
     */
    public function setKidsTopic($kidsTopic)
    {
        $this->kidsTopic = $kidsTopic;
    }
    
    /**
     * Returns the kidsTopicLink
     *
     * @return string $kidsTopicLink
     */
    public function getKidsTopicLink()
    {
        return $this->kidsTopicLink;
    }
    
    /**
     * Sets the kidsTopicLink
     *
     * @param string $kidsTopicLink
     * @return void
     */
    public function setKidsTopicLink($kidsTopicLink)
    {
        $this->kidsTopicLink = $kidsTopicLink;
    }
    
    /**
     * Returns the kidsNotes
     *
     * @return string $kidsNotes
     */
    public function getKidsNotes()
    {
        return $this->kidsNotes;
    }
    
    /**
     * Sets the kidsNotes
     *
     * @param string $kidsNotes
     * @return void
     */
    public function setKidsNotes($kidsNotes)
    {
        $this->kidsNotes = $kidsNotes;
    }

	/**
	 * Adds a kidsPlaying
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsPlaying(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsPlaying->attach($person);
	}
	
	/**
	 * Removes a kidsPlaying
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsPlaying(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsPlaying->detach($person);
	}
	
	/**
	 * Returns the kidsPlaying
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsPlaying
	 */
	public function getKidsPlaying() {
		return $this->kidsPlaying;
	}
	
	/**
	 * Sets the kidsPlaying
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsPlaying
	 * @return void
	 */
	public function setKidsPlaying(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsPlaying) {
		$this->kidsPlaying = $kidsPlaying;
	}

	/**
	 * Adds a kidsSinging
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsSinging(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsSinging->attach($person);
	}
	
	/**
	 * Removes a kidsSinging
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsSinging(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsSinging->detach($person);
	}
	
	/**
	 * Returns the kidsSinging
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsSinging
	 */
	public function getKidsSinging() {
		return $this->kidsSinging;
	}
	
	/**
	 * Sets the kidsSinging
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsSinging
	 * @return void
	 */
	public function setKidsSinging(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsSinging) {
		$this->kidsSinging = $kidsSinging;
	}

	/**
	 * Adds a kidsPlenum
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsPlenum(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsPlenum->attach($person);
	}
	
	/**
	 * Removes a kidsPlenum
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsPlenum(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsPlenum->detach($person);
	}
	
	/**
	 * Returns the kidsPlenum
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsPlenum
	 */
	public function getKidsPlenum() {
		return $this->kidsPlenum;
	}
	
	/**
	 * Sets the kidsPlenum
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsPlenum
	 * @return void
	 */
	public function setKidsPlenum(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsPlenum) {
		$this->kidsPlenum = $kidsPlenum;
	}

	/**
	 * Adds a kidsGroup1
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsGroup1(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup1->attach($person);
	}
	
	/**
	 * Removes a kidsGroup1
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsGroup1(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup1->detach($person);
	}
	
	/**
	 * Returns the kidsGroup1
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup1
	 */
	public function getKidsGroup1() {
		return $this->kidsGroup1;
	}
	
	/**
	 * Sets the kidsGroup1
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup1
	 * @return void
	 */
	public function setKidsGroup1(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsGroup1) {
		$this->kidsGroup1 = $kidsGroup1;
	}

	/**
	 * Adds a kidsGroup2
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsGroup2(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup2->attach($person);
	}
	
	/**
	 * Removes a kidsGroup2
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsGroup2(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup2->detach($person);
	}
	
	/**
	 * Returns the kidsGroup2
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup2
	 */
	public function getKidsGroup2() {
		return $this->kidsGroup2;
	}
	
	/**
	 * Sets the kidsGroup2
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup2
	 * @return void
	 */
	public function setKidsGroup2(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsGroup2) {
		$this->kidsGroup2 = $kidsGroup2;
	}

	/**
	 * Adds a kidsGroup3
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsGroup3(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup3->attach($person);
	}
	
	/**
	 * Removes a kidsGroup3
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsGroup3(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup3->detach($person);
	}
	
	/**
	 * Returns the kidsGroup3
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup3
	 */
	public function getKidsGroup3() {
		return $this->kidsGroup3;
	}
	
	/**
	 * Sets the kidsGroup3
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup3
	 * @return void
	 */
	public function setKidsGroup3(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsGroup3) {
		$this->kidsGroup3 = $kidsGroup3;
	}

	/**
	 * Adds a kidsGroup3Program
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsGroup3Program(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup3Program->attach($person);
	}
	
	/**
	 * Removes a kidsGroup3Program
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsGroup3Program(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsGroup3Program->detach($person);
	}
	
	/**
	 * Returns the kidsGroup3Program
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup3Program
	 */
	public function getKidsGroup3Program() {
		return $this->kidsGroup3Program;
	}
	
	/**
	 * Sets the kidsGroup3Program
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsGroup3Program
	 * @return void
	 */
	public function setKidsGroup3Program(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsGroup3Program) {
		$this->kidsGroup3Program = $kidsGroup3Program;
	}

    /**
     * Returns the kidsYoungActive
     *
     * @return bool $kidsYoungActive
     */
    public function getKidsYoungActive()
    {
        return $this->kidsYoungActive;
    }
    
    /**
     * Sets the kidsYoungActive
     *
     * @param bool $kidsYoungActive
     * @return void
     */
    public function setKidsYoungActive($kidsYoungActive)
    {
        $this->kidsYoungActive = $kidsYoungActive;
    }
    
    /**
     * Returns the boolean state of kidsYoungActive
     *
     * @return bool
     */
    public function isKidsYoungActive()
    {
        return $this->childrenActive;
    }
    
	/**
	 * Adds a kidsYoung
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addKidsYoung(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsYoung->attach($person);
	}
	
	/**
	 * Removes a kidsYoung
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeKidsYoung(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->kidsYoung->detach($person);
	}
	
	/**
	 * Returns the kidsYoung
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsYoung
	 */
	public function getKidsYoung() {
		return $this->kidsYoung;
	}
	
	/**
	 * Sets the kidsYoung
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $kidsYoung
	 * @return void
	 */
	public function setKidsYoung(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kidsYoung) {
		$this->kidsYoung = $kidsYoung;
	}
    
    /**
     * Returns the teensProgram1
     *
     * @return int $teensProgram1
     */
    public function getTeensProgram1() {
        return $this->teensProgram1;
    }
    
    /**
     * Sets the teensProgram1
     *
     * @param int $teensProgram1
     * @return void
     */
    public function setTeensProgram1($teensProgram1) {
        $this->teensProgram1 = $teensProgram1;
    }
    
    /**
     * Returns the teensTopic1
     *
     * @return string $teensTopic1
     */
    public function getTeensTopic1() {
        return $this->teensTopic1;
    }
    
    /**
     * Sets the teensTopic1
     *
     * @param string $teensTopic1
     * @return void
     */
    public function setTeensTopic1($teensTopic1)
    {
        $this->teensTopic1 = $teensTopic1;
    }
    
    /**
     * Returns the teensNotes1
     *
     * @return string $teensNotes1
     */
    public function getTeensNotes1()
    {
        return $this->teensNotes1;
    }
    
    /**
     * Sets the teensNotes1
     *
     * @param string $teensNotes1
     * @return void
     */
    public function setTeensNotes1($teensNotes1)
    {
        $this->teensNotes1 = $teensNotes1;
    }
    
	/**
	 * Adds a teensPeople1
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addTeensPeople1(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->teensPeople1->attach($person);
	}
	
	/**
	 * Removes a teensPeople1
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeTeensPeople1(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->teensPeople1->detach($person);
	}
	
	/**
	 * Returns the teensPeople1
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $teensPeople1
	 */
	public function getTeensPeople1() {
		return $this->teensPeople1;
	}
	
	/**
	 * Sets the teensPeople1
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $teensPeople1
	 * @return void
	 */
	public function setTeensPeople1(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $teensPeople1) {
		$this->teensPeople1 = $teensPeople1;
	}
    
    /**
     * Returns the teensProgram2
     *
     * @return int $teensProgram2
     */
    public function getTeensProgram2() {
        return $this->teensProgram2;
    }
    
    /**
     * Sets the teensProgram2
     *
     * @param int $teensProgram2
     * @return void
     */
    public function setTeensProgram2($teensProgram2) {
        $this->teensProgram2 = $teensProgram2;
    }
    
    /**
     * Returns the teensTopic2
     *
     * @return string $teensTopic2
     */
    public function getTeensTopic2()
    {
        return $this->teensTopic2;
    }
    
    /**
     * Sets the teensTopic2
     *
     * @param string $teensTopic2
     * @return void
     */
    public function setTeensTopic2($teensTopic2)
    {
        $this->teensTopic2 = $teensTopic2;
    }
    
    /**
     * Returns the teensNotes2
     *
     * @return string $teensNotes2
     */
    public function getTeensNotes2()
    {
        return $this->teensNotes2;
    }
    
    /**
     * Sets the teensNotes2
     *
     * @param string $teensNotes2
     * @return void
     */
    public function setTeensNotes2($teensNotes2)
    {
        $this->teensNotes2 = $teensNotes2;
    }
    
	/**
	 * Adds a teensPeople2
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addTeensPeople2(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->teensPeople2->attach($person);
	}
	
	/**
	 * Removes a teensPeople2
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeTeensPeople2(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->teensPeople2->detach($person);
	}
	
	/**
	 * Returns the teensPeople2
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $teensPeople2
	 */
	public function getTeensPeople2() {
		return $this->teensPeople2;
	}
	
	/**
	 * Sets the teensPeople2
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $teensPeople2
	 * @return void
	 */
	public function setTeensPeople2(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $teensPeople2) {
		$this->teensPeople2 = $teensPeople2;
	}

    /**
     * Returns the coffeeActive
     *
     * @return bool $coffeeActive
     */
    public function getCoffeeActive()
    {
        return $this->coffeeActive;
    }
    
    /**
     * Sets the coffeeActive
     *
     * @param bool $coffeeActive
     * @return void
     */
    public function setCoffeeActive($coffeeActive)
    {
        $this->coffeeActive = $coffeeActive;
    }
    
    /**
     * Returns the boolean state of coffeeActive
     *
     * @return bool
     */
    public function isCoffeeActive()
    {
        return $this->coffeeActive;
    }
    
    /**
     * Returns the coffeeNotes
     *
     * @return string $coffeeNotes
     */
    public function getCoffeeNotes()
    {
        return $this->coffeeNotes;
    }
    
    /**
     * Sets the coffeeNotes
     *
     * @param string $coffeeNotes
     * @return void
     */
    public function setCoffeeNotes($coffeeNotes)
    {
        $this->coffeeNotes = $coffeeNotes;
    }

	/**
	 * Adds a coffeePeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addCoffeePeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->coffeePeople->attach($person);
	}
	
	/**
	 * Removes a coffeePeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeCoffeePeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->coffeePeople->detach($person);
	}
	
	/**
	 * Returns the coffeePeople
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $coffeePeople
	 */
	public function getCoffeePeople() {
		return $this->coffeePeople;
	}
	
	/**
	 * Sets the coffeePeople
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $coffeePeople
	 * @return void
	 */
	public function setCoffeePeople(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $coffeePeople) {
		$this->coffeePeople = $coffeePeople;
	}
    
	/**
	 * Adds a coffeeSpecial
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addCoffeeSpecial(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->coffeeSpecial->attach($person);
	}
	
	/**
	 * Removes a coffeeSpecial
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeCoffeeSpecial(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->coffeeSpecial->detach($person);
	}
	
	/**
	 * Returns the coffeeSpecial
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $coffeeSpecial
	 */
	public function getCoffeeSpecial() {
		return $this->coffeeSpecial;
	}
	
	/**
	 * Sets the coffeeSpecial
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $coffeeSpecial
	 * @return void
	 */
	public function setCoffeeSpecial(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $coffeeSpecial) {
		$this->coffeeSpecial = $coffeeSpecial;
	}
        
    /**
     * Returns the prayerActive
     *
     * @return bool $prayerActive
     */
    public function getPrayerActive()
    {
        return $this->prayerActive;
    }
    
    /**
     * Sets the prayerActive
     *
     * @param bool $prayerActive
     * @return void
     */
    public function setPrayerActive($prayerActive)
    {
        $this->prayerActive = $prayerActive;
    }
    
    /**
     * Returns the boolean state of prayerActive
     *
     * @return bool
     */
    public function isPrayerActive()
    {
        return $this->prayerActive;
    }
    
	/**
	 * Adds a prayerPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addPrayerPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->prayerPeople->attach($person);
	}
	
	/**
	 * Removes a prayerPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removePrayerPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->prayerPeople->detach($person);
	}
	
	/**
	 * Returns the prayerPeople
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $prayerPeople
	 */
	public function getPrayerPeople() {
		return $this->prayerPeople;
	}
	
	/**
	 * Sets the prayerPeople
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $prayerPeople
	 * @return void
	 */
	public function setPrayerPeople(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $prayerPeople) {
		$this->prayerPeople = $prayerPeople;
	}

    /**
     * Returns the drivingActive
     *
     * @return bool $drivingActive
     */
    public function getDrivingActive()
    {
        return $this->drivingActive;
    }
    
    /**
     * Sets the drivingActive
     *
     * @param bool $drivingActive
     * @return void
     */
    public function setDrivingActive($drivingActive)
    {
        $this->drivingActive = $drivingActive;
    }
    
    /**
     * Returns the boolean state of drivingActive
     *
     * @return bool
     */
    public function isDrivingActive()
    {
        return $this->drivingActive;
    }
    
	/**
	 * Adds a drivingPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person
	 * @return void
	 */
	public function addDrivingPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->drivingPeople->attach($person);
	}
	
	/**
	 * Removes a drivingPeople
	 *
	 * @param \FKU\FkuPeople\Domain\Model\Person $person The collection to be removed
	 * @return void
	 */
	public function removeDrivingPeople(\FKU\FkuPeople\Domain\Model\Person $person) {
		$this->drivingPeople->detach($person);
	}
	
	/**
	 * Returns the drivingPeople
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $drivingPeople
	 */
	public function getDrivingPeople() {
		return $this->drivingPeople;
	}
	
	/**
	 * Sets the drivingPeople
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPeople\Domain\Model\Person> $drivingPeople
	 * @return void
	 */
	public function setDrivingPeople(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $drivingPeople) {
		$this->drivingPeople = $drivingPeople;
	}
    
	/**
	 * Returns the sermonBibletext
	 *
	 * @return string $sermonBibletext
	 */
	public function getSermonBibletext() {
		return $this->sermonBibletext;
	}

	/**
	 * Sets the sermonBibletext
	 *
	 * @param string $sermonBibletext
	 * @return void
	 */
	public function setSermonBibletext($sermonBibletext) {
		$this->sermonBibletext = $sermonBibletext;
	}

	/**
	 * Returns the sermonConcept
	 *
	 * @return string $sermonConcept
	 */
	public function getSermonConcept() {
		return $this->sermonConcept;
	}

	/**
	 * Sets the sermonConcept
	 *
	 * @param string $sermonConcept
	 * @return void
	 */
	public function setSermonConcept($sermonConcept) {
		$this->sermonConcept = $sermonConcept;
	}

	/**
	 * Returns the sermonRelatedFiles
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPlanning\Domain\Model\FileReference> $sermonRelatedFiles
	 */
	public function getSermonRelatedFiles() {
		return $this->sermonRelatedFiles;
	}

	/**
	 * Sets the sermonRelatedFiles
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPlanning\Domain\Model\FileReference> $sermonRelatedFiles
	 * @return void
	 */
	public function setSermonRelatedFiles(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $sermonRelatedFiles) {
		$this->sermonRelatedFiles = $sermonRelatedFiles;
	}

	/**
	 * Adds a sermonRelatedFile
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\FileReference $sermonRelatedFile
	 * @return void
	 */
	public function addSermonRelatedFile(\FKU\FkuPlanning\Domain\Model\FileReference $sermonRelatedFile) {
		$this->sermonRelatedFiles->attach($sermonRelatedFile);
	}

	/**
	 * Removes a sermonRelatedFile
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\FileReference $sermonRelatedFile
	 * @return void
	 */
	public function removeSermonRelatedFile(\FKU\FkuPlanning\Domain\Model\FileReference $sermonRelatedFile) {
		$this->sermonRelatedFiles->detach($sermonRelatedFile);
	}

	/**
	 * Returns the sermonPublic
	 *
	 * @return boolean $sermonPublic
	 */
	public function getSermonPublic() {
		return $this->sermonPublic;
	}

	/**
	 * Sets the sermonPublic
	 *
	 * @param boolean $sermonPublic
	 * @return void
	 */
	public function setSermonPublic($sermonPublic) {
		$this->sermonPublic = $sermonPublic;
	}

	/**
	 * Returns the sermonExist
	 *
	 * @return boolean $sermonExist
	 */
	public function getSermonExist() {
		return $this->sermonExist;
	}

	/**
	 * Sets the sermonExist
	 *
	 * @param boolean $sermonExist
	 * @return void
	 */
	public function setSermonExist($sermonExist) {
		$this->sermonExist = $sermonExist;
	}

}