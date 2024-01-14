<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => TRUE,

		'delete' => 'deleted',
		'default_sortby' => 'crdate',
		'enablecolumns' => [
			'disabled' => 'hidden'
		],
		'searchFields' => 'title, owner, slug',
		'iconfile' => 'EXT:fku_planning/Resources/Public/Icons/tx_fkuplanning_domain_model_survey.gif'
	),
	'interface' => [
		'showRecordFieldList' => 'hidden, title, owner, slug, services, expirydate, alloptions, blind, blocked',
	],
	'types' => [
		'1' => ['showitem' => 'hidden, title, owner, slug, services, expirydate, alloptions, blind, blocked'],
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
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			],
		],
		'owner' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.owner',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_default_sortby' => 'name',
			],
		],
		'slug' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.slug',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			],
		],
		'services' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.services',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkuplanning_domain_model_master',
				'foreign_default_sortby' => 'date',
				'size' => 12,
				'minitems' => 0,
				'maxitems' => 25,
			],
		],
		'expirydate' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.expirydate',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
			],
		],
		'alloptions' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.alloptions',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
			],
		],
		'blocked' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.blocked',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
			],
		],
		'blind' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_survey.blind',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
			],
		],
		
	],
);