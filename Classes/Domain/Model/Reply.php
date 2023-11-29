<?php
namespace FKU\FkuPlanning\Domain\Model;

class Reply extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * survey
     *
     * @var \FKU\FkuPlanning\Domain\Model\Survey
     */
    protected $survey;
    
    /**
     * user
     *
	 * @var \FKU\FkuPeople\Domain\Model\Person
     */
    protected $user = null;

    /**
     * availability
     *
	 * @var string
     */
    protected $availability = '';

    /**
     * comment
     *
	 * @var string
     */
    protected $comment = '';

    /**
     * Returns the survey
     *
     * @return \FKU\FkuPlanning\Domain\Model\Survey $survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }
    
    /**
     * Sets the survey
     *
     * @param \FKU\FkuPlanning\Domain\Model\Survey $title
     * @return void
     */
    public function setSurvey($survey)
    {
        $this->survey = $survey;
    }
    
    /**
     * Returns the user
     *
     * @return \FKU\FkuPeople\Domain\Model\Person $user
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Sets the user
     *
     * @param \FKU\FkuPeople\Domain\Model\Person $user
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    
    /**
     * Returns the availability
     *
     * @return string $availability
     */
    public function getAvailability()
    {
        return $this->availability;
    }
    
    /**
     * Sets the availability
     *
     * @param string $availability
     * @return void
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    /**
     * Returns the comment
     *
     * @return string $comment
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * Sets the comment
     *
     * @param string $comment
     * @return void
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    
}