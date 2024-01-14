<?php
namespace FKU\FkuPlanning\Domain\Model;

class Survey extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';
    
    /**
     * owner
     *
	 * @var \FKU\FkuPeople\Domain\Model\Person
     */
    protected $owner = null;

    /**
     * slug
     *
     * @var string
     */
    protected $slug = '';
    
    /**
     * services
     *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPlanning\Domain\Model\Master>
     */
    protected $services = null;

    /**
     * servicesSorted
     *
	 * @var array
     */
    protected $servicesSorted = array();

    /**
     * expirydate
     *
     * @var int
     */
    protected $expirydate = 0;
    
    /**
     * alloptions
     *
     * @var bool
     */
    protected $alloptions = false;
    
    /**
     * blocked
     *
     * @var bool
     */
    protected $blocked = false;
    
    /**
     * blind
     *
     * @var bool
     */
    protected $blind = false;
    
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() 
	{
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() 
	{
		$this->services = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}


    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the owner
     *
     * @return \FKU\FkuPeople\Domain\Model\Person $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Sets the owner
     *
     * @param \FKU\FkuPeople\Domain\Model\Person $owner
     * @return void
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }
    
    /**
     * Returns the slug
     *
     * @return string $slug
     */
    public function getSlug() {
        return $this->slug;
    }
    
    /**
     * Sets the slug
     *
     * @param string $slug
     * @return void
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }
    
	/**
	 * Adds a service
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\Master $service
	 * @return void
	 */
	public function addService(\FKU\FkuPlanning\Domain\Model\Master $service) {
		$this->services->attach($service);
	}
	
	/**
	 * Removes a service
	 *
	 * @param \FKU\FkuPlanning\Domain\Model\Master $service
	 * @return void
	 */
	public function removeService(\FKU\FkuPlanning\Domain\Model\Master $service) {
		$this->services->detach($service);
	}
	
	/**
	 * Returns the services
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPlanning\Domain\Model\Master> $services
	 */
	public function getServices() {
		return $this->services;
	}
	
	/**
	 * Returns the servicesSorted
	 *
	 * @return array $servicesSorted
	 */
	public function getServicesSorted() {
		$serviceArray = array();
		foreach ($this->services as $service) {
			$serviceArray[$service->getDate()->format('U')] = $service;
		}
		ksort($serviceArray);
		return $serviceArray;
	}
	
	/**
	 * Sets the services
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\FKU\FkuPlanning\Domain\Model\Master> $services
	 * @return void
	 */
	public function setServices(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $services) {
		$this->services = $services;
	}

    /**
     * Returns the expirydate
     *
     * @return int $expirydate
     */
    public function getExpirydate() {
        return $this->expirydate;
    }
    
    /**
     * Sets the expirydate
     *
     * @param int $expirydate
     * @return void
     */
    public function setExpirydate($expirydate) {
        $this->expirydate = $expirydate;
    }
    
    /**
     * Returns the alloptions
     *
     * @return bool $alloptions
     */
    public function getAlloptions() {
        return $this->alloptions;
    }
    
    /**
     * Sets the alloptions
     *
     * @param bool $alloptions
     * @return void
     */
    public function setAlloptions($alloptions) {
        $this->alloptions = $alloptions;
    }
    
    /**
     * Returns the blocked
     *
     * @return bool $blocked
     */
    public function getBlocked() {
        return $this->blocked;
    }
    
    /**
     * Sets the blocked
     *
     * @param bool $blocked
     * @return void
     */
    public function setBlocked($blocked) {
        $this->blocked = $blocked;
    }
    
    /**
     * Returns the blind
     *
     * @return bool $blind
     */
    public function getBlind() {
        return $this->blind;
    }
    
    /**
     * Sets the blind
     *
     * @param bool $blind
     * @return void
     */
    public function setBlind($blind) {
        $this->blind = $blind;
    }
    

}