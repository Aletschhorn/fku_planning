<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Serviceplan',
	'GD Plan'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Dashboard',
	'GD Plan Dashboard'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Mission',
	'GD Mission Plan'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Beamer',
	'GD Beamer'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Livestream',
	'GD Livestream'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Sermon',
	'GD Sermon List'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Driver',
	'GD Driver List'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Youtube',
	'Youtube'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'fku_planning',
	'Registration',
	'GD Registration'
);



// register flexforms
foreach (['serviceplan', 'dashboard', 'mission', 'beamer', 'livestream', 'sermon', 'driver', 'registration'] as $plugin) {
	$pluginSignature = 'fkuplanning_'.$plugin; 
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = ''; 
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:fku_planning/Configuration/FlexForms/flexform_'.$plugin.'.xml'); 
}

?>