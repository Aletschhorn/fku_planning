<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_missionary',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => TRUE,

		'delete' => 'deleted',
		'default_sortby' => 'title',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,',
		'iconfile' => 'EXT:fku_planning/Resources/Public/Icons/tx_fkuplanning_domain_model_missionary.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, title',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden, title'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_missionary.title',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim,required'
			),
		),
		
	),
);