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
 * Tracking
 */
class Tracking extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * moment
     *
     * @var \DateTime
     */
    protected $moment = NULL;
    
    /**
     * user
     *
     * @var \FKU\FkuPeople\Domain\Model\Person
     */
    protected $user;
    
    /**
     * master
     *
     * @var \FKU\FkuPlanning\Domain\Model\Master
     */
    protected $master;
    
    /**
     * field
     *
     * @var string
     */
    protected $field = '';
    
    /**
     * old
     *
     * @var string
     */
    protected $old = '';
    
    /**
     * new
     *
     * @var string
     */
    protected $new = '';

    /**
     * Returns the moment
     *
     * @return \DateTime $moment
     */
    public function getMoment() {
        return $this->moment;
    }
    
    /**
     * Sets the moment
     *
     * @param \DateTime $moment
     * @return void
     */
    public function setMoment($moment) {
        $this->moment = $moment;
    }
    
    /**
     * Returns the user
     *
     * @return \FKU\FkuPeople\Domain\Model\Person $user
     */
    public function getUser() {
        return $this->user;
    }
    
    /**
     * Sets the user
     *
     * @param \FKU\FkuPeople\Domain\Model\Person $user
     * @return void
     */
    public function setUser(\FKU\FkuPeople\Domain\Model\Person $user) {
        $this->user = $user;
    }
    
    /**
     * Returns the master
     *
     * @return \FKU\FkuPlanning\Domain\Model\Master $master
     */
    public function getMaster() {
        return $this->master;
    }
    
    /**
     * Sets the master
     *
     * @param \FKU\FkuPlanning\Domain\Model\Master $master
     * @return void
     */
    public function setMaster(\FKU\FkuPlanning\Domain\Model\Master $master) {
        $this->master = $master;
    }
    
    /**
     * Returns the field
     *
     * @return string $field
     */
    public function getField() {
        return $this->field;
    }
    
    /**
     * Sets the field
     *
     * @param string $field
     * @return void
     */
    public function setField($field) {
        $this->field = $field;
    }
    
    /**
     * Returns the old
     *
     * @return string $old
     */
    public function getOld() {
        return $this->old;
    }
    
    /**
     * Sets the old
     *
     * @param string $old
     * @return void
     */
    public function setOld($old) {
        $this->old = $old;
    }
    
    /**
     * Returns the new
     *
     * @return string $new
     */
    public function getNew() {
        return $this->new;
    }
    
    /**
     * Sets the new
     *
     * @param string $new
     * @return void
     */
    public function setNew($new) {
        $this->new = $new;
    }
    
}