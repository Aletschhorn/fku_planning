#
# Table structure for table 'tx_fkuplanning_domain_model_master'
#
CREATE TABLE tx_fkuplanning_domain_model_master (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	date datetime DEFAULT '0000-00-00 00:00:00',
	holidays tinyint(1) unsigned DEFAULT '0' NOT NULL,
	notes varchar(255) DEFAULT '' NOT NULL,
	visibility int(11) unsigned DEFAULT '0',
	agenda tinyint(1) unsigned DEFAULT '0' NOT NULL,
	event int(11) unsigned DEFAULT '0',
	service_active tinyint(1) unsigned DEFAULT '0' NOT NULL,
	service_topic varchar(255) DEFAULT '' NOT NULL,
	service_serial int(11) unsigned DEFAULT '0',
	service_bible varchar(255) DEFAULT '' NOT NULL,
	service_preacher varchar(255) DEFAULT '' NOT NULL,
	service_notes varchar(255) DEFAULT '' NOT NULL,
	service_moderator varchar(255) DEFAULT '' NOT NULL,
	service_music_select varchar(255) DEFAULT '' NOT NULL,
	service_music_select_all tinyint(1) unsigned DEFAULT '0',
	service_music_rehearse varchar(255) DEFAULT '' NOT NULL,
	service_music_band varchar(255) DEFAULT '' NOT NULL,
	service_music_organ varchar(255) DEFAULT '' NOT NULL,
	service_beamer varchar(255) DEFAULT '' NOT NULL,
	service_console varchar(255) DEFAULT '' NOT NULL,
	service_camera varchar(255) DEFAULT '' NOT NULL,
	service_filmeditor varchar(255) DEFAULT '' NOT NULL,	
	service_sexton varchar(255) DEFAULT '' NOT NULL,
	service_welcome varchar(255) DEFAULT '' NOT NULL,
	service_winter varchar(255) DEFAULT '' NOT NULL,
	service_mission tinyint(1) unsigned DEFAULT '0' NOT NULL,
	service_mission_notes varchar(255) DEFAULT '' NOT NULL,
	service_mission_content varchar(255) DEFAULT '' NOT NULL,
	service_missionary varchar(255) DEFAULT '' NOT NULL,
	service_supper tinyint(1) unsigned DEFAULT '0' NOT NULL,
	service_supper_people varchar(255) DEFAULT '' NOT NULL,
	service_collection tinyint(4) unsigned DEFAULT '0' NOT NULL,
	service_livestreamlink varchar(255) DEFAULT '' NOT NULL,
	service_livestream tinyint(1) unsigned DEFAULT '0' NOT NULL,
	children_active tinyint(1) unsigned DEFAULT '0' NOT NULL,
	children_people varchar(255) DEFAULT '' NOT NULL,
	kids_program int(11) DEFAULT '0' NOT NULL,
	kids_topic varchar(255) DEFAULT '' NOT NULL,
	kids_topic_link varchar(255) DEFAULT '' NOT NULL,
	kids_notes varchar(255) DEFAULT '' NOT NULL,
	kids_playing varchar(255) DEFAULT '' NOT NULL,
	kids_singing varchar(255) DEFAULT '' NOT NULL,
	kids_plenum varchar(255) DEFAULT '' NOT NULL,
	kids_group1 varchar(255) DEFAULT '' NOT NULL,
	kids_group2 varchar(255) DEFAULT '' NOT NULL,
	kids_group3 varchar(255) DEFAULT '' NOT NULL,
	kids_group3_program varchar(255) DEFAULT '' NOT NULL,
	kids_young_active tinyint(1) unsigned DEFAULT '0' NOT NULL,
	kids_young varchar(255) DEFAULT '' NOT NULL,
	teens_program1 int(11) DEFAULT '0' NOT NULL,
	teens_topic1 varchar(255) DEFAULT '' NOT NULL,
	teens_notes1 varchar(255) DEFAULT '' NOT NULL,
	teens_people1 varchar(255) DEFAULT '' NOT NULL,
	teens_program2 int(11) DEFAULT '0' NOT NULL,
	teens_topic2 varchar(255) DEFAULT '' NOT NULL,
	teens_notes2 varchar(255) DEFAULT '' NOT NULL,
	teens_people2 varchar(255) DEFAULT '' NOT NULL,
	coffee_active tinyint(1) unsigned DEFAULT '0' NOT NULL,
	coffee_notes varchar(255) DEFAULT '' NOT NULL,
	coffee_people varchar(255) DEFAULT '' NOT NULL,
	coffee_special varchar(255) DEFAULT '' NOT NULL,
	prayer_active tinyint(1) unsigned DEFAULT '0' NOT NULL,
	prayer_people varchar(255) DEFAULT '' NOT NULL,
	driving_active tinyint(1) unsigned DEFAULT '0' NOT NULL,
	driving_people varchar(255) DEFAULT '' NOT NULL,
	sermon_bibletext text NOT NULL,
	sermon_concept text NOT NULL,
	sermon_related_files int(11) unsigned NOT NULL default '0',
	sermon_public tinyint(4) unsigned DEFAULT '0' NOT NULL,
	sermon_exist tinyint(4) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);

#
# Table structure for table 'tx_fkuplanning_domain_model_visibility'
#
CREATE TABLE tx_fkuplanning_domain_model_visibility (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);

#
# Table structure for table 'tx_fkuplanning_domain_model_serial'
#
CREATE TABLE tx_fkuplanning_domain_model_serial (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	recent tinyint(4) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);

#
# Table structure for table 'tx_fkuplanning_domain_model_tracking'
#
CREATE TABLE tx_fkuplanning_domain_model_tracking (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	moment datetime DEFAULT '0000-00-00 00:00:00',
	user int(11) DEFAULT '0' NOT NULL,
	master int(11) unsigned DEFAULT '0' NOT NULL,
	field varchar(255) DEFAULT '' NOT NULL,
	old varchar(255) DEFAULT '' NOT NULL,
	new varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_fkuplanning_domain_model_missionary'
#
CREATE TABLE tx_fkuplanning_domain_model_missionary (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);

#
# Table structure for table 'tx_fkuplanning_domain_model_survey'
#
CREATE TABLE tx_fkuplanning_domain_model_survey (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	owner int(11) unsigned DEFAULT '0' NOT NULL,
	slug varchar(2048),
	services varchar(255) DEFAULT '' NOT NULL,
	expirydate int(11) unsigned DEFAULT '0' NOT NULL,
	alloptions tinyint(4) unsigned DEFAULT '0' NOT NULL,
	blocked tinyint(4) unsigned DEFAULT '0' NOT NULL,
	blind tinyint(4) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);

#
# Table structure for table 'tx_fkuplanning_domain_model_reply'
#
CREATE TABLE tx_fkuplanning_domain_model_reply (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	survey int(11) unsigned DEFAULT '0' NOT NULL,
	user int(11) unsigned DEFAULT '0' NOT NULL,
	availability varchar(255) DEFAULT '' NOT NULL,
	comment varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);
