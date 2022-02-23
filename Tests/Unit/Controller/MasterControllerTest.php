<?php
namespace FKU\FkuPlanning\Tests\Unit\Controller;
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
 * Test case for class FKU\FkuPlanning\Controller\MasterController.
 *
 * @author Daniel Widmer <daniel.widmer@fku.ch>
 */
class MasterControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \FKU\FkuPlanning\Controller\MasterController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('FKU\\FkuPlanning\\Controller\\MasterController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMastersFromRepositoryAndAssignsThemToView()
	{

		$allMasters = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$masterRepository = $this->getMock('FKU\\FkuPlanning\\Domain\\Repository\\MasterRepository', array('findAll'), array(), '', FALSE);
		$masterRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMasters));
		$this->inject($this->subject, 'masterRepository', $masterRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('masters', $allMasters);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMasterToView()
	{
		$master = new \FKU\FkuPlanning\Domain\Model\Master();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('master', $master);

		$this->subject->showAction($master);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenMasterToMasterRepository()
	{
		$master = new \FKU\FkuPlanning\Domain\Model\Master();

		$masterRepository = $this->getMock('FKU\\FkuPlanning\\Domain\\Repository\\MasterRepository', array('add'), array(), '', FALSE);
		$masterRepository->expects($this->once())->method('add')->with($master);
		$this->inject($this->subject, 'masterRepository', $masterRepository);

		$this->subject->createAction($master);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenMasterToView()
	{
		$master = new \FKU\FkuPlanning\Domain\Model\Master();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('master', $master);

		$this->subject->editAction($master);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenMasterInMasterRepository()
	{
		$master = new \FKU\FkuPlanning\Domain\Model\Master();

		$masterRepository = $this->getMock('FKU\\FkuPlanning\\Domain\\Repository\\MasterRepository', array('update'), array(), '', FALSE);
		$masterRepository->expects($this->once())->method('update')->with($master);
		$this->inject($this->subject, 'masterRepository', $masterRepository);

		$this->subject->updateAction($master);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenMasterFromMasterRepository()
	{
		$master = new \FKU\FkuPlanning\Domain\Model\Master();

		$masterRepository = $this->getMock('FKU\\FkuPlanning\\Domain\\Repository\\MasterRepository', array('remove'), array(), '', FALSE);
		$masterRepository->expects($this->once())->method('remove')->with($master);
		$this->inject($this->subject, 'masterRepository', $masterRepository);

		$this->subject->deleteAction($master);
	}
}
