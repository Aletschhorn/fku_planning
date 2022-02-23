<?php

namespace FKU\FkuPlanning\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Daniel Widmer <daniel.widmer@fku.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \FKU\FkuPlanning\Domain\Model\Master.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Daniel Widmer <daniel.widmer@fku.ch>
 */
class MasterTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \FKU\FkuPlanning\Domain\Model\Master
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \FKU\FkuPlanning\Domain\Model\Master();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getDateReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getDate()
		);
	}

	/**
	 * @test
	 */
	public function setDateForDateTimeSetsDate()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'date',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVisibilityReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setVisibilityForIntSetsVisibility()
	{	}

	/**
	 * @test
	 */
	public function getAgendaReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getAgenda()
		);
	}

	/**
	 * @test
	 */
	public function setAgendaForBoolSetsAgenda()
	{
		$this->subject->setAgenda(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'agenda',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getServiceActiveReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getServiceActive()
		);
	}

	/**
	 * @test
	 */
	public function setServiceActiveForBoolSetsServiceActive()
	{
		$this->subject->setServiceActive(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'serviceActive',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getServiceTopicReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getServiceTopic()
		);
	}

	/**
	 * @test
	 */
	public function setServiceTopicForStringSetsServiceTopic()
	{
		$this->subject->setServiceTopic('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'serviceTopic',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getServiceBibleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getServiceBible()
		);
	}

	/**
	 * @test
	 */
	public function setServiceBibleForStringSetsServiceBible()
	{
		$this->subject->setServiceBible('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'serviceBible',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getServicePreacherReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServicePreacherForIntSetsServicePreacher()
	{	}

	/**
	 * @test
	 */
	public function getServiceNotesReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getServiceNotes()
		);
	}

	/**
	 * @test
	 */
	public function setServiceNotesForStringSetsServiceNotes()
	{
		$this->subject->setServiceNotes('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'serviceNotes',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getServiceKidsReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceKidsForIntSetsServiceKids()
	{	}

	/**
	 * @test
	 */
	public function getServiceTeensReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceTeensForIntSetsServiceTeens()
	{	}

	/**
	 * @test
	 */
	public function getServiceModeratorReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceModeratorForIntSetsServiceModerator()
	{	}

	/**
	 * @test
	 */
	public function getServiceMusicSelectReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceMusicSelectForIntSetsServiceMusicSelect()
	{	}

	/**
	 * @test
	 */
	public function getServiceMusicRehearseReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceMusicRehearseForIntSetsServiceMusicRehearse()
	{	}

	/**
	 * @test
	 */
	public function getServiceMusicBandReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceMusicBandForIntSetsServiceMusicBand()
	{	}

	/**
	 * @test
	 */
	public function getServiceMusicOrganReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceMusicOrganForIntSetsServiceMusicOrgan()
	{	}

	/**
	 * @test
	 */
	public function getServiceBeamerReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceBeamerForIntSetsServiceBeamer()
	{	}

	/**
	 * @test
	 */
	public function getServiceConsoleReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceConsoleForIntSetsServiceConsole()
	{	}

	/**
	 * @test
	 */
	public function getServiceSextonReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceSextonForIntSetsServiceSexton()
	{	}

	/**
	 * @test
	 */
	public function getServiceMissionReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getServiceMission()
		);
	}

	/**
	 * @test
	 */
	public function setServiceMissionForBoolSetsServiceMission()
	{
		$this->subject->setServiceMission(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'serviceMission',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getServiceMissionaryReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setServiceMissionaryForIntSetsServiceMissionary()
	{	}

	/**
	 * @test
	 */
	public function getServiceSupperReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getServiceSupper()
		);
	}

	/**
	 * @test
	 */
	public function setServiceSupperForBoolSetsServiceSupper()
	{
		$this->subject->setServiceSupper(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'serviceSupper',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getChildrenActiveReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getChildrenActive()
		);
	}

	/**
	 * @test
	 */
	public function setChildrenActiveForBoolSetsChildrenActive()
	{
		$this->subject->setChildrenActive(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'childrenActive',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getChildrenPeopleReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setChildrenPeopleForIntSetsChildrenPeople()
	{	}

	/**
	 * @test
	 */
	public function getKidsActiveReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getKidsActive()
		);
	}

	/**
	 * @test
	 */
	public function setKidsActiveForBoolSetsKidsActive()
	{
		$this->subject->setKidsActive(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'kidsActive',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKidsTopicReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getKidsTopic()
		);
	}

	/**
	 * @test
	 */
	public function setKidsTopicForStringSetsKidsTopic()
	{
		$this->subject->setKidsTopic('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'kidsTopic',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKidsTopicLinkReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getKidsTopicLink()
		);
	}

	/**
	 * @test
	 */
	public function setKidsTopicLinkForStringSetsKidsTopicLink()
	{
		$this->subject->setKidsTopicLink('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'kidsTopicLink',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKidsNotesReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getKidsNotes()
		);
	}

	/**
	 * @test
	 */
	public function setKidsNotesForStringSetsKidsNotes()
	{
		$this->subject->setKidsNotes('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'kidsNotes',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKidsPlayingReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsPlayingForIntSetsKidsPlaying()
	{	}

	/**
	 * @test
	 */
	public function getKidsSingingReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsSingingForIntSetsKidsSinging()
	{	}

	/**
	 * @test
	 */
	public function getKidsPlenumReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsPlenumForIntSetsKidsPlenum()
	{	}

	/**
	 * @test
	 */
	public function getKidsGroup1ReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsGroup1ForIntSetsKidsGroup1()
	{	}

	/**
	 * @test
	 */
	public function getKidsGroup2ReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsGroup2ForIntSetsKidsGroup2()
	{	}

	/**
	 * @test
	 */
	public function getKidsGroup3ReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsGroup3ForIntSetsKidsGroup3()
	{	}

	/**
	 * @test
	 */
	public function getKidsGroup3ProgramReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsGroup3ProgramForIntSetsKidsGroup3Program()
	{	}

	/**
	 * @test
	 */
	public function getKidsYoungReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setKidsYoungForIntSetsKidsYoung()
	{	}

	/**
	 * @test
	 */
	public function getTeensActiveReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getTeensActive()
		);
	}

	/**
	 * @test
	 */
	public function setTeensActiveForBoolSetsTeensActive()
	{
		$this->subject->setTeensActive(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'teensActive',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTeensTopicReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTeensTopic()
		);
	}

	/**
	 * @test
	 */
	public function setTeensTopicForStringSetsTeensTopic()
	{
		$this->subject->setTeensTopic('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'teensTopic',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTeensNotesReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTeensNotes()
		);
	}

	/**
	 * @test
	 */
	public function setTeensNotesForStringSetsTeensNotes()
	{
		$this->subject->setTeensNotes('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'teensNotes',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTeensPeopleReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setTeensPeopleForIntSetsTeensPeople()
	{	}

	/**
	 * @test
	 */
	public function getCoffeeActiveReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getCoffeeActive()
		);
	}

	/**
	 * @test
	 */
	public function setCoffeeActiveForBoolSetsCoffeeActive()
	{
		$this->subject->setCoffeeActive(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'coffeeActive',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCoffeePeopleReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setCoffeePeopleForIntSetsCoffeePeople()
	{	}

	/**
	 * @test
	 */
	public function getCoffeeSpecialReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setCoffeeSpecialForIntSetsCoffeeSpecial()
	{	}

	/**
	 * @test
	 */
	public function getPrayerActiveReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setPrayerActiveForIntSetsPrayerActive()
	{	}

	/**
	 * @test
	 */
	public function getPrayerPeopleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPrayerPeople()
		);
	}

	/**
	 * @test
	 */
	public function setPrayerPeopleForStringSetsPrayerPeople()
	{
		$this->subject->setPrayerPeople('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'prayerPeople',
			$this->subject
		);
	}
}
