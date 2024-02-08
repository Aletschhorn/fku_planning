<?php
use FKU\FkuPlanning\Controller\MasterController;
use FKU\FkuPlanning\Controller\RegistrationController;
use FKU\FkuPlanning\Controller\YoutubeController;
use FKU\FkuPlanning\Controller\SurveyController;

defined('TYPO3_MODE') || die();

(static function() {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Serviceplan',
		[MasterController::class => 'list, show, new, create, edit, update, delete, export, personal, calendar, createCalendar, updateCalendar, removeCalendar, listMonth, agenda, agendaUpdate, missionary'],
		[MasterController::class => 'list, new, create, update, delete, export, calendar, agenda, agendaUpdate, missionary']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Dashboard',
		[MasterController::class => 'dashboard'],
		[MasterController::class => 'dashboard']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Mission',
		[MasterController::class => 'missionary, edit, update'],
		[MasterController::class => 'list, update, export']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Beamer',
		[MasterController::class => 'beamer'],
		[]
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Livestream',
		[MasterController::class => 'livestream'],
		[]
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Sermon',
		[MasterController::class => 'sermonList, sermonShow, sermonEdit, sermonUpdate, sermonDelete, sermonNewList, sermonLast'],
		[MasterController::class => 'sermonList, sermonEdit, sermonUpdate, sermonDelete, sermonNewList']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Driver',
		[MasterController::class => 'driver'],
		[]
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Youtube',
		[YoutubeController::class => 'define, show'],
		[YoutubeController::class => 'define, show']
	);

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Registration',
		[RegistrationController::class => 'show'],
		[]
	);

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'fku_planning',
		'Survey',
		[SurveyController::class => 'list, show, new, create, edit, update, delete, reply, participate, download'],
		[SurveyController::class => 'list, create, update, delete, participate, download']
	);
})();

?>