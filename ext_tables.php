<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fku_planning', 'Configuration/TypoScript', 'FKU Planning');

foreach (['master', 'visibility', 'tracking', 'missionary', 'serial, survey, reply'] as $table) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_fkuplanning_domain_model_' . $table);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_fkuplanning_domain_model_' . $table, 
	'EXT:fku_planning/Resources/Private/Language/locallang_csh_tx_fkuplanning_domain_model_' . $table . '.xlf');
}

?>