<?php
return array(
	'ctrl' => [
		'title'	=> 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master',
		'label' => 'date',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => TRUE,

		'delete' => 'deleted',
		'default_sortby' => 'ORDER BY date DESC',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'date, holidays, notes, visibility, agenda, event, service_active, service_topic, service_bible, service_preacher, service_notes, service_moderator, service_music_select, service_music_select_all, service_music_rehearse, service_music_band, service_music_organ, service_beamer, service_console, service_camera, service_filmeditor, service_sexton, service_welcome, service_winter, service_mission, service_mission_notes, service_mission_content, service_missionary, service_supper, service_supper_people, service_collection, service_livestreamlink, children_active, children_people, kids_program, kids_topic, kids_topic_link, kids_notes, kids_playing, kids_singing, kids_plenum, kids_group1, kids_group2, kids_group3, kids_group3_program, kids_young_active, kids_young, teen_program1, teens_topic1, teens_notes1, teens_people1, teens_program2, teens_topic2, teens_notes2, teens_people2, coffee_active, coffee_notes, coffee_people, coffee_special, prayer_active, prayer_people, driving_active, driving_people, sermon_bibletext, ',
		'iconfile' => 'EXT:fku_planning/Resources/Public/Icons/tx_fkuplanning_domain_model_master.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'hidden, date, holidays, notes, visibility, agenda, event, service_active, service_topic, service_serial, service_bible, service_preacher, service_notes, service_moderator, service_music_select, service_music_select_all, service_music_rehearse, service_music_band, service_music_organ, service_beamer, service_console, service_camera, service_filmeditor, service_sexton, service_welcome, service_winter, service_mission, service_mission_notes, service_mission_content, service_missionary, service_supper, service_supper_people, service_collection, service_livestreamlink, service_livestream, children_active, children_people, kids_program, kids_topic, kids_topic_link, kids_notes, kids_playing, kids_singing, kids_plenum, kids_group1, kids_group2, kids_group3, kids_group3_program, kids_young_active, kids_young, teens_program1, teens_topic1, teens_notes1, teens_people1, teens_program2, teens_topic2, teens_notes2, teens_people2, coffee_active, coffee_notes, coffee_people, coffee_special, prayer_active, prayer_people, driving_active, driving_people, sermon_bibletext, sermon_concept, sermon_related_files, sermon_public, sermon_exist',
	],
	'types' => [
		'1' => ['showitem' => '
				--palette--;;DateTime, notes, --palette--;;Visible,  event, 
			--div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.service, 
				service_active, --palette--;;TopicBible, service_serial, --palette--;;NotesSupper, --palette--;;Livestream, service_collection, service_preacher, service_moderator, service_music_select, service_music_rehearse, service_music_band, service_music_organ, service_beamer, service_console, service_camera, service_filmeditor, service_sexton, service_welcome, service_winter, --palette--;;MissionNotes, service_missionary, service_mission_content, service_supper_people, 
			--div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.children, 
				children_active, children_people, --div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.kids, kids_program, --palette--;;KidsTopic, kids_notes, kids_playing, kids_singing, kids_plenum, kids_group1, kids_group2, kids_group3, kids_group3_program, kids_young_active, kids_young, 
			--div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.teens, 
				teens_active, --palette--;;TeensTopic1, teens_notes1, teens_people1, --palette--;;TeensTopic2, teens_notes2, teens_people2, 
			--div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.coffee, 
				coffee_active, coffee_notes, coffee_people, coffee_special, 
			--div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.prayer, 
				prayer_active, prayer_people, 
			--div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.driving, 
				driving_active, driving_people, 
			--div--;LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.tabs.sermon, 
				--palette--;;SermonPresence, sermon_bibletext, sermon_concept, sermon_related_files, 
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
				hidden, starttime, endtime'],
	],
	'palettes' => [
		'1' => ['showitem' => ''],
		'DateTime' => ['showitem' => 'date, holidays'],
		'Visible' => ['showitem' => 'visibility, agenda'],
		'TopicBible' => ['showitem' => 'service_topic, service_bible'],
		'Livestream' => ['showitem' => 'service_livestream, service_livestreamlink'],
		'NotesSupper'  => ['showitem' => 'service_notes, service_supper'],
		'MissionNotes' => ['showitem' => 'service_mission, service_mission_notes'],
		'KidsTopic'  => ['showitem' => 'kids_topic, kids_topic_link'],
		'TeensTopic1'  => ['showitem' => 'teens_program1, teens_topic1'],
		'TeensTopic2'  => ['showitem' => 'teens_program2, teens_topic2'],
		'SermonPresence' => ['showitem' => 'sermon_exist, sermon_public'],
	],
	'columns' => array(
	
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
			'config' => array(
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
			'config' => array(
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
			),
		),

		'date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime',
				'default' => '0000-00-00 00:00:00'
			),
		),
		'notes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.notes',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'holidays' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.holidays',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'visibility' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.visibility',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_fkuplanning_domain_model_visibility',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'agenda' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.agenda',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'event' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.event',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('',0)
				),
				'foreign_table' => 'tx_fkuagenda_domain_model_event',
				'foreign_table_where' => 'AND tx_fkuagenda_domain_model_event.category=24 ORDER BY tx_fkuagenda_domain_model_event.event_start DESC',
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'service_active' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_active',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'service_topic' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_topic',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'service_serial' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_serial',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_fkuplanning_domain_model_serial',
				'items' => [ ['(none)', 0] ],
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'service_bible' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_bible',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'service_preacher' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_preacher',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_notes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_notes',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 3,
				'eval' => 'trim'
			),
		),
		'service_moderator' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_moderator',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_music_select' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_music_select',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_music_select_all' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_music_select_all',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'service_music_rehearse' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_music_rehearse',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_music_band' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_music_band',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 20,
			),
		),
		'service_music_organ' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_music_organ',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_beamer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_beamer',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_console' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_console',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_camera' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_camera',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_filmeditor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_filmeditor',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_sexton' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_sexton',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_welcome' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_welcome',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_winter' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_winter',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_mission' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_mission',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'service_mission_notes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_mission_notes',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 3,
				'eval' => 'trim'
			),
		),
		'service_mission_content' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_mission_content',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkuplanning_domain_model_missionary',
				'foreign_table_where' => 'ORDER BY tx_fkuplanning_domain_model_missionary.title',
				'foreign_sortby' => 'sorting',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_missionary' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_missionary',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_supper' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_supper',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'service_supper_people' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_supper_people',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'service_collection' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_collection',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('Normale Kollekte', 0),
					array('Kollekte zur Hälfte für Missionswerk', 1),
					array('Kollekte ganz für Missionswerk', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'service_livestreamlink' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_livestreamlink',
			'config' => array(
				'type' => 'input',
				'eval' => 'domainname,trim',
			),
		),
		'service_livestream' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.service_livestream',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'children_active' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.children_active',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'children_people' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.children_people',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
			),
		),
		'kids_program' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_program',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('Kein Kidstreff', 0),
					array('Thema', 1),
					array('Thema, Kinder anfangs im GD', 2),
					array('Kinder ganze Zeit im GD', 3),
					array('Ferienprogramm', 4),
					array('Theaterprobe', 5),
					array('Ausflug', 6),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'kids_topic' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_topic',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'kids_topic_link' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_topic_link',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'kids_notes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_notes',
			'config' => array(
				'type' => 'input',
				'size' => 80,
				'eval' => 'trim'
			),
		),
		'kids_playing' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_playing',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'kids_singing' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_singing',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'kids_plenum' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_plenum',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
			),
		),
		'kids_group1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_group1',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'kids_group2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_group2',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'kids_group3' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_group3',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'kids_group3_program' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_group3_program',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'kids_young_active' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_young_active',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'kids_young' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.kids_young',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'teens_program1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_program1',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('Kein Teenstreff', 0),
					array('Thema', 1),
					array('Gottesdienstbesuch', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'teens_topic1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_topic1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'teens_notes1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_notes1',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 3,
				'eval' => 'trim'
			),
		),
		'teens_people1' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_people1',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'teens_program2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_program2',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('Kein Teenstreff', 0),
					array('Thema', 1),
					array('Gottesdienstbesuch', 2),
					array('Schnuppereinsatz', 3),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'teens_topic2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_topic2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'teens_notes2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_notes2',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 3,
				'eval' => 'trim'
			),
		),
		'teens_people2' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.teens_people2',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'coffee_active' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.coffee_active',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'coffee_notes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.coffee_notes',
			'config' => array(
				'type' => 'input',
				'size' => 80,
				'eval' => 'trim'
			),
		),
		'coffee_people' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.coffee_people',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
			),
		),
		'coffee_special' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.coffee_special',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'prayer_active' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.prayer_active',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'prayer_people' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.prayer_people',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 5,
			),
		),
		'driving_active' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.driving_active',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'driving_people' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.driving_people',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_fkupeople_domain_model_person',
				'foreign_table_where' => 'ORDER BY tx_fkupeople_domain_model_person.name',
				'enableMultiSelectFilterTextfield' => 1,
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
			),
		),
		'sermon_public' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.sermon_public',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'sermon_exist' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.sermon_exist',
			'config' => array(
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 0
			)
		),
		'sermon_bibletext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.sermon_bibletext',
			'config' => array(
				'type' => 'text',
				'rows' => 5,
				'eval' => 'trim'
			),
		),
		'sermon_concept' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.sermon_concept',
			'config' => array(
				'type' => 'text',
				'rows' => 5,
				'eval' => 'trim'
			),
		),
		'sermon_related_files' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:fku_planning/Resources/Private/Language/locallang_db.xlf:tx_fkuplanning_domain_model_master.sermon_related_files',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'related_files', 
				array(
					'appearance' => array('createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'),
					'foreign_match_fields' => array('fieldname' => 'sermon_related_files', 'tablenames' => 'tx_fkuplanning_domain_model_master', 'table_local' => 'sys_file')
				)
			)
		),
		
	),
);