<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_reply',
		'label' => 'survey',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => TRUE,

		'delete' => 'deleted',
		'default_sortby' => 'tstamp',
		'enablecolumns' => [
			'disabled' => 'hidden'
		],
		'searchFields' => 'user, comment,',
		'iconfile' => 'EXT:fku_planning/Resources/Public/Icons/tx_fkuplanning_domain_model_reply.gif'
	),
	'interface' => [
		'showRecordFieldList' => 'hidden, survey, user, availability, comment',
	],
	'types' => [
		'1' => ['showitem' => 'hidden, survey, user, availability, comment'],
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
		'survey' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_reply.survey',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_fkuplanning_domain_model_survey',
				'foreign_table_where' => 'ORDER BY tx_fkuplanning_domain_model_survey.title',
			],
		],
		'user' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_reply.user',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
			],
		],
		'availability' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_reply.availability',
			'config' => [
				'type' => 'input',
				'eval' => 'trim'
			],
		],
		'comment' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_reply.comment',
			'config' => [
				'type' => 'text',
				'cols' => 30,
				'rows' => 2,
				'eval' => 'trim'
			],
		],
		
	],
);