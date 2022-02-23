<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_serial',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => TRUE,

		'delete' => 'deleted',
		'default_sortby' => 'title',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'title,',
		'iconfile' => 'EXT:fku_planning/Resources/Public/Icons/tx_fkuplanning_domain_model_serial.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'hidden, title, recent',
	],
	'types' => [
		'1' => ['showitem' => 'hidden, title, recent'],
	],
	'palettes' => [
		'1' => ['showitem' => ''],
	],
	'columns' => [
	
		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
			],
		],

		'title' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_serial.title',
			'config' => [
				'type' => 'input',
				'eval' => 'trim,required'
			],
		],
		
		'recent' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_serial.recent',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 1,
			],
		],
	],
];