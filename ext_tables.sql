#
# Table structure for table 'tx_nsrevolutionslider_domain_model_slideitem'
#
CREATE TABLE tx_nsrevolutionslider_domain_model_slideitem (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	slide_effect varchar(255) DEFAULT '' NOT NULL,
	data_duration varchar(255) DEFAULT '' NOT NULL,
	image int(11) unsigned NOT NULL default '0',
	headline varchar(255) DEFAULT '' NOT NULL,
	headline_animation varchar(255) DEFAULT '' NOT NULL,
	description text,
	description_animation varchar(255) DEFAULT '' NOT NULL,
	button_text varchar(255) DEFAULT '' NOT NULL,
	button_link varchar(255) DEFAULT '' NOT NULL,
	button_animation varchar(255) DEFAULT '' NOT NULL,
	box_bg_color varchar(255) DEFAULT '' NOT NULL,
	box_text_color varchar(255) DEFAULT '' NOT NULL,
	box_bg_trans_opacity varchar(255) DEFAULT '' NOT NULL,
	box_position_x varchar(255) DEFAULT '' NOT NULL,
	box_position_y varchar(255) DEFAULT '' NOT NULL,
	box_animation varchar(255) DEFAULT '' NOT NULL,
	box_height varchar(255) DEFAULT '' NOT NULL,
	headline_position_x varchar(255) DEFAULT '' NOT NULL,
	headline_position_y varchar(255) DEFAULT '' NOT NULL,
	description_position_x varchar(255) DEFAULT '' NOT NULL,
	description_position_y varchar(255) DEFAULT '' NOT NULL,
	button_position_x varchar(255) DEFAULT '' NOT NULL,
	button_position_y varchar(255) DEFAULT '' NOT NULL,
	box_width varchar(255) DEFAULT '' NOT NULL,
	box_check int(11) unsigned DEFAULT '0' NOT NULL,


	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
	hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state smallint(6) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,
	l10n_state text,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_nsrevolutionslider_domain_model_slider'
#
CREATE TABLE tx_nsrevolutionslider_domain_model_slider (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	slider_name varchar(255) DEFAULT '' NOT NULL,
	slides int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
	hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state smallint(6) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,
	l10n_state text,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_nsrevolutionslider_slider_slideitem_mm'
#
CREATE TABLE tx_nsrevolutionslider_slider_slideitem_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
