-- 
-- Database: `medSearchEngine`
-- 

-- --------------------------------------------------------
DROP TABLE IF EXISTS `sites`;
create table sites(
	site_id int auto_increment not null primary key,
	url varchar(255) not null,
	title varchar(255) not null,
	short_desc text,
	indexdate timestamp,
	spider_depth int default 2,
	required text,
	disallowed text,
	can_leave_domain bool,
        specialty_id int,
        KEY `specialty_id` (`specialty_id`) ) ENGINE = MYISAM;

DROP TABLE IF EXISTS `links`;
create table links (
	link_id int auto_increment primary key not null,
	site_id int,
	url varchar(255) not null,
	title varchar(200),
	description varchar(255),
	fulltxt mediumtext,
	indexdate date,
	size float(2),
	md5sum varchar(32),
	key url (url),
	key md5key (md5sum),
	visible int default 0, 
	level int) ENGINE = MYISAM;

DROP TABLE IF EXISTS `keywords`;
create table keywords	(
	keyword_id int primary key not null auto_increment,
	keyword varchar(30) not null,
	unique kw (keyword),
	key keyword (keyword(10))) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword0`;
create table link_keyword0 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword1`;
create table link_keyword1 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword2`;
create table link_keyword2 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword3`;
create table link_keyword3 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword4`;
create table link_keyword4 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword5`;
create table link_keyword5 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword6`;
create table link_keyword6 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword7`;
create table link_keyword7 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword8`;
create table link_keyword8 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyword9`;
create table link_keyword9 (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyworda`;
create table link_keyworda (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keywordb`;
create table link_keywordb (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keywordc`;
create table link_keywordc (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keywordd`;
create table link_keywordd (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keyworde`;
create table link_keyworde (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `link_keywordf`;
create table link_keywordf (
	link_id int not null,
	keyword_id int not null,
	weight int(3),
	domain int(4),
	key linkid(link_id),
	key keyid(keyword_id)) ENGINE = MYISAM;

DROP TABLE IF EXISTS `pending`;
create table pending (
	site_id integer,
	temp_id varchar(32),
	level integer,
	count integer,
	num integer) ENGINE = MYISAM;

DROP TABLE IF EXISTS `categories`;
create table categories(
	category_id integer not null auto_increment primary key, 
	category text,
	parent_num integer
	) ENGINE = MYISAM;

DROP TABLE IF EXISTS `site_category`;
create table site_category (
	site_id integer,
	category_id integer
	) ENGINE = MYISAM;

DROP TABLE IF EXISTS `temp`;
create table temp (
	link varchar(255),
	level integer,
	id varchar (32)
	) ENGINE = MYISAM;

DROP TABLE IF EXISTS `query_log`;
create table query_log (
	query varchar(255),
	time timestamp,
	elapsed float(2),
	results int(10),
	key query_key(query)
	) ENGINE = MYISAM;

DROP TABLE IF EXISTS `domains`;
create table domains (
	domain_id int auto_increment primary key not null,	
	domain varchar(255)
) ENGINE = MYISAM;


DROP TABLE IF EXISTS `users`;
create table users (
	user_id int auto_increment primary key not null,	
	user_login varchar(60),
        user_pass varchar(64),
        user_nicename varchar(50),
        user_email varchar(100),
        user_url varchar(100),
        user_registered datetime NOT NULL,
        user_activation_key varchar(60),
        user_status int(11),
        display_name varchar(250),
        account_type varchar(36) NOT NULL
) ENGINE = MYISAM;

DROP TABLE IF EXISTS `specialty`;
create table specialty (
	specialty_id int auto_increment primary key not null,	
	`specialty` varchar(255) default NULL
) ENGINE = MYISAM;






-- 
-- Table structure for table `patient`
-- 

DROP TABLE IF EXISTS `patient`;
CREATE TABLE `patient` (
  `patient_id` bigint(20) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '',
  `firstname` varchar(255) NOT NULL default '',
  `lastname` varchar(255) NOT NULL default '',
  `middlename` varchar(255) NOT NULL default '',
  `DOB` date default NULL,
  `password` longtext,
  `passwordSalt` varchar(4) default NULL,
  `image_dir` varchar(255) default NULL,
  `profile_pic_name` varchar(255) NOT NULL default '',
  `thumbnail_pic_name` varchar(255) NOT NULL default '',
  `language` varchar(255) NOT NULL default '',
  `mcp_number` varchar(255) NOT NULL default '',
  `financial` varchar(255) NOT NULL default '',
  `user_ip` varchar(15) NOT NULL default '000.000.000.000' COMMENT 'needed later for ip banning',
  `account_status` varchar(24) default NULL,
  `random_code` varchar(32) default NULL,
  `confirm_email_code` varchar(32) default NULL,
  `street` varchar(255) NOT NULL default '',
  `postal_code` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `state` varchar(255) NOT NULL default '',
  `country_code` varchar(255) NOT NULL default '',
  `drivers_license` varchar(255) NOT NULL default '',
  `ss` varchar(255) NOT NULL default '',
  `occupation` longtext,
  `phone_home` varchar(255) NOT NULL default '',
  `phone_biz` varchar(255) NOT NULL default '',
  `phone_contact` varchar(255) NOT NULL default '',
  `phone_cell` varchar(255) NOT NULL default '',
  `pharmacy_id` int(11) NOT NULL default '0',
  `status` varchar(255) NOT NULL default '',
  `contact_relationship` varchar(255) NOT NULL default '',
  `date_created` datetime default NULL,
  `sex` varchar(255) NOT NULL default '',
  `referrer` varchar(255) NOT NULL default '',
  `referrerID` varchar(255) NOT NULL default '',
  `providerID` int(11) default NULL,
  `email` varchar(255) NOT NULL default '',
  `ethnoracial` varchar(255) NOT NULL default '',
  `interpretter` varchar(255) NOT NULL default '',
  `migrantseasonal` varchar(255) NOT NULL default '',
  `family_size` varchar(255) NOT NULL default '',
  `monthly_income` varchar(255) NOT NULL default '',
  `homeless` varchar(255) NOT NULL default '',
  `financial_review` datetime default NULL,
  `pubpid` varchar(255) NOT NULL default '',
  `genericname1` varchar(255) NOT NULL default '',
  `genericval1` varchar(255) NOT NULL default '',
  `genericname2` varchar(255) NOT NULL default '',
  `genericval2` varchar(255) NOT NULL default '',
  `hipaa_mail` varchar(3) NOT NULL default '',
  `hipaa_voice` varchar(3) NOT NULL default '',
  `hipaa_notice` varchar(3) NOT NULL default '',
  `hipaa_message` varchar(20) NOT NULL default '',
  `hipaa_allowsms` VARCHAR( 3 ) NOT NULL DEFAULT 'NO',
  `hipaa_allowemail` VARCHAR( 3 ) NOT NULL DEFAULT 'NO',
  `squad` varchar(32) NOT NULL default '',
  `fitness` int(11) NOT NULL default '0',
  `referral_source` varchar(30) NOT NULL default '',
  `introduction` longtext,
  `usertext1` varchar(255) NOT NULL DEFAULT '',
  `usertext2` varchar(255) NOT NULL DEFAULT '',
  `usertext3` varchar(255) NOT NULL DEFAULT '',
  `usertext4` varchar(255) NOT NULL DEFAULT '',
  `usertext5` varchar(255) NOT NULL DEFAULT '',
  `usertext6` varchar(255) NOT NULL DEFAULT '',
  `usertext7` varchar(255) NOT NULL DEFAULT '',
  `usertext8` varchar(255) NOT NULL DEFAULT '',
  `userlist1` varchar(255) NOT NULL DEFAULT '',
  `userlist2` varchar(255) NOT NULL DEFAULT '',
  `userlist3` varchar(255) NOT NULL DEFAULT '',
  `userlist4` varchar(255) NOT NULL DEFAULT '',
  `userlist5` varchar(255) NOT NULL DEFAULT '',
  `userlist6` varchar(255) NOT NULL DEFAULT '',
  `userlist7` varchar(255) NOT NULL DEFAULT '',
  `pricelevel` varchar(255) NOT NULL default 'standard',
  `regdate`     date DEFAULT NULL COMMENT 'Registration Date',
  `contrastart` date DEFAULT NULL COMMENT 'Date contraceptives initially used',
   FULLTEXT (username,firstname, lastname, middlename,email),
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;




-- 
-- Table structure for table `patient_profile_image`
--
DROP TABLE IF EXISTS `patient_photo`;
CREATE TABLE `patient_photo` (
      `patient_photo_id` bigint(20) NOT NULL auto_increment,
      `patient_id` bigint(20) default NULL,
      `image_name` varchar(255) NOT NULL default '',
      `image_category` varchar(255) NOT NULL default '',
      `image_folder` varchar(255) NOT NULL default '',
      `image_album` varchar(255) NOT NULL default '',
      `album_location` varchar(255) NOT NULL default '',
      `album_date_created` varchar(255) NOT NULL default '',
      `date_created` datetime default NULL,
       PRIMARY KEY (`patient_photo_id`),
        KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;




-- 
-- Table structure for table `physician`
-- 

DROP TABLE IF EXISTS `physician`;
CREATE TABLE `physician` (
  `physician_id` bigint(20) NOT NULL auto_increment,
  `username` varchar(255) default NULL,
  `password` longtext,
  `passwordSalt` varchar(4) default NULL,
  `authorized` tinyint(4) default NULL,
  `info` longtext,
  `source` tinyint(4) default NULL,
  `firstname` varchar(255) default NULL,
  `middlename` varchar(255) default NULL,
  `lastname` varchar(255) default NULL,
  `DOB` date default NULL,
  `image_dir` varchar(255) default NULL,
  `profile_pic_name` varchar(255) NOT NULL default '',
  `thumbnail_pic_name` varchar(255) NOT NULL default '',
  `user_ip` varchar(15) NOT NULL default '000.000.000.000' COMMENT 'needed later for ip banning',
  `account_status` varchar(24) default NULL,
  `date_created` datetime default NULL,
  `sex` varchar(255) NOT NULL default '',
  `country_code` varchar(255) NOT NULL default '',
  `random_code` varchar(32) default NULL,
  `federaltaxid` varchar(255) default NULL,
  `federaldrugid` varchar(255) default NULL,
  `upin` varchar(255) default NULL,
  `facility` varchar(255) default NULL,
  `facility_id` int(11) NOT NULL default '0',
  `see_auth` int(11) NOT NULL default '1',
  `active` tinyint(1) NOT NULL default '1',
  `npi` varchar(15) default NULL,
  `title` varchar(30) default NULL,
  `specialty` varchar(255) default NULL,
  `billname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `assistant` varchar(255) default NULL,
  `organization` varchar(255) default NULL,
  `valedictory` varchar(255) default NULL,
  `street` varchar(60) default NULL,
  `streetb` varchar(60) default NULL,
  `city` varchar(30) default NULL,
  `state` varchar(30) default NULL,
  `postal_code` varchar(20) default NULL,
  `street2` varchar(60) default NULL,
  `streetb2` varchar(60) default NULL,
  `city2` varchar(30) default NULL,
  `state2` varchar(30) default NULL,
  `zip2` varchar(20) default NULL,
  `phone` varchar(30) default NULL,
  `fax` varchar(30) default NULL,
  `phonew1` varchar(30) default NULL,
  `phonew2` varchar(30) default NULL,
  `phonecell` varchar(30) default NULL,
  `notes` text,
  `cal_ui` tinyint(4) NOT NULL default '1',
  `taxonomy` varchar(30) NOT NULL DEFAULT '207Q00000X',
  `ssi_relayhealth` varchar(64) NULL,
  `calendar` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1 = appears in calendar',
  `introduction` longtext,
  FULLTEXT (username,firstname, lastname, middlename,email,specialty),
  PRIMARY KEY  (`physician_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;



--
-- Table structure for table `patient_patient_relationships`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
DROP TABLE IF EXISTS `patient_patient_relationships`;
CREATE TABLE `patient_patient_relationships` (
  `id` bigint(20) NOT NULL auto_increment,
  `patient_id_one` bigint(20) unsigned NOT NULL,
  `patient_id_two` bigint(20) unsigned NOT NULL,
  `date_created` datetime default NULL,
  `date_confirmed` datetime default NULL,
  `status` boolean not null default 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patient_id_one` (`patient_id_one`,`patient_id_two`),
  KEY `patient_id_two` (`patient_id_two`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `physician_physician_relationships`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
DROP TABLE IF EXISTS `physician_physician_relationships`;
CREATE TABLE `physician_physician_relationships` (
  `id` bigint(20) NOT NULL auto_increment,
  `physician_id_one` bigint(20) unsigned NOT NULL,
  `physician_id_two` bigint(20) unsigned NOT NULL,
  `date_created` datetime default NULL,
  `date_confirmed` datetime default NULL,
  `status` boolean not null default 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `physician_id_one` (`physician_id_one`,`physician_id_two`),
  KEY `physician_id_two` (`physician_id_two`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `physician_patient_relationships`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
DROP TABLE IF EXISTS `physician_patient_relationships`;
CREATE TABLE `physician_patient_relationships` (
  `id` bigint(20) NOT NULL auto_increment,
  `physician_id_one` bigint(20) unsigned NOT NULL,
  `patient_id_one` bigint(20) unsigned NOT NULL,
  `require_to` varchar(20) default NULL,
  `date_created` datetime default NULL,
  `date_confirmed` datetime default NULL,
  `status` boolean not null default 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `physician_id_one` (`physician_id_one`,`patient_id_one`),
  KEY `patient_id_one` (`patient_id_one`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


--
-- Table structure for table `st_physician_recommand_to_patient`
--
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
DROP TABLE IF EXISTS `st_physician_recommand_to_patient`;
CREATE TABLE `st_physician_recommand_to_patient` (
  `id` bigint(20) NOT NULL auto_increment,
  `physician_id` bigint(20) unsigned NOT NULL,
  `patient_id` bigint(20) unsigned NOT NULL,
  `st_category_id` bigint(20) NOT NULL,
  `date_created` datetime default NULL,
  `date_confirmed` datetime default NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `physician_id` (`physician_id`,`patient_id`, `st_category_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


--
-- Table structure for table `st_physician_recommand_to_physician`
--
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
DROP TABLE IF EXISTS `st_physician_recommand_to_physician`;
CREATE TABLE `st_physician_recommand_to_physician` (
  `id` bigint(20) NOT NULL auto_increment,
  `physician_id_one` bigint(20) unsigned NOT NULL,
  `physician_id_two` bigint(20) unsigned NOT NULL,
  `st_category_id` bigint(20) NOT NULL,
  `date_created` datetime default NULL,
  `date_confirmed` datetime default NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `physician_id_one` (`physician_id_one`,`physician_id_two`, `st_category_id`),
  KEY `physician_id_two` (`physician_id_two`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



--
-- Table structure for table `st_physician_recommand_to_physician`
--
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
DROP TABLE IF EXISTS `st_patient_recommand_to_patient`;
CREATE TABLE `st_patient_recommand_to_patient` (
  `id` bigint(20) NOT NULL auto_increment,
  `patient_id_one` bigint(20) unsigned NOT NULL,
  `patient_id_two` bigint(20) unsigned NOT NULL,
  `st_category_id` bigint(20) NOT NULL,
  `date_created` datetime default NULL,
  `date_confirmed` datetime default NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patient_id_one` (`patient_id_one`,`patient_id_two`, `st_category_id`),
  KEY `patient_id_two` (`patient_id_two`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



-- 
-- Table structure for table `patient_profile_image`
--
DROP TABLE IF EXISTS `physician_photo`;
CREATE TABLE `physician_photo` (
      `physician_photo_id` bigint(20) NOT NULL auto_increment,
      `physician_id` bigint(20) default NULL,
      `image_name` varchar(255) NOT NULL default '',
      `image_category` varchar(255) NOT NULL default '',
      `image_folder` varchar(255) NOT NULL default '',
      `image_album` varchar(255) NOT NULL default '',
      `album_location` varchar(255) NOT NULL default '',
      `album_date_created` varchar(255) NOT NULL default '',
      `date_created` datetime default NULL,
       PRIMARY KEY (`physician_photo_id`),
       KEY `physician_id` (`physician_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;



--
-- Table structure for table `st_usage`
--
DROP TABLE IF EXISTS `st_usage`;
CREATE TABLE IF NOT EXISTS `st_usage` (
    `st_usage_id` bigint(20) NOT NULL auto_increment,
    `screeningtools` varchar(30) default NULL,
    `score` varchar(30) default NULL,
    `usage_date_time` datetime default NULL,
    `platform`  varchar(255) NOT NULL default '',
    `screeningtools_id` bigint(20) default NULL,
    `st_category_id` bigint(20) default NULL,
    `patient_id` bigint(20) default NULL,
    `physician_id` bigint(20) default NULL,
    PRIMARY KEY  (`st_usage_id`),
    KEY `patient_id` (`patient_id`),
    KEY `physician_id` (`physician_id`),
    KEY `screeningtools_id` (`screeningtools_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



--
-- Table structure for table `st_category`
--
DROP TABLE IF EXISTS `st_category`;
CREATE TABLE IF NOT EXISTS `st_category` (
    `st_category_id` bigint(20) NOT NULL auto_increment,
    `screeningtool_name` varchar(30) default NULL,
    `screeningtool_full_name` longtext,
    `screeningtool_name_md5` longtext,
    `create_date_time` datetime default NULL,
    `author` varchar(30) default NULL,
    `specialist` varchar(30) default NULL,
    `index` varchar(30) default NULL,
    `keyword` longtext,
    `copy_right` varchar(30) default NULL,
    `st_icon_location` longtext,
    PRIMARY KEY  (`st_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


--
-- Table structure for table `private_messages`
--
DROP TABLE IF EXISTS `private_messages`;
CREATE TABLE IF NOT EXISTS `private_messages` (
    `message_id` bigint(20) NOT NULL auto_increment,
    `from_id` bigint(20) NOT NULL,
    `from_id_cate` varchar(20) NOT NULL,
    `subject` longtext,
    `message` longtext,
    `create_date_time` datetime default NULL,
    `senderDelete` ENUM("0", "1"),
    PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


--
-- Table structure for table `message_recipient`
--
DROP TABLE IF EXISTS `message_recipient`;
CREATE TABLE IF NOT EXISTS `message_recipient` (
    `id` bigint(20) NOT NULL auto_increment,
    `message_id` bigint(20) NOT NULL,
    `to_id` bigint(20) NOT NULL,
    `to_id_cate` varchar(20) NOT NULL,
    `opened` ENUM("0", "1"),
    `recipientDelete` ENUM("0", "1"),
    `replayed` ENUM("0", "1"),
    `replayed_to_id` bigint(20),
     PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



--
-- Table structure for table `pasq`
--

DROP TABLE IF EXISTS `pasq`;
CREATE TABLE IF NOT EXISTS `pasq` (
    `pasq_id` bigint(20) NOT NULL auto_increment,
    
    `back` int(1) default NULL,
    
    `leftAnkle` int(1) default NULL,
    
    `leftClavicleInside` int(1) default NULL,
    
    `leftClavicleOutside` int(1) default NULL,
    
    `leftElbow` int(1) default NULL,
    
    `leftFoot11` int(1) default NULL,
    
    `leftFoot12` int(1) default NULL,
    
    `leftFoot21` int(1) default NULL,
    
    `leftFoot22` int(1) default NULL,
    
    `leftFoot31` int(1) default NULL,
    
    `leftFoot32` int(1) default NULL,
    
    `leftFoot41` int(1) default NULL,
    
   `leftFoot42` int(1) default NULL,
    
    `leftFoot51` int(1) default NULL,
    
    `leftFoot52` int(1) default NULL,
    
    `leftHand11` int(1) default NULL,
    
    `leftHand12` int(1) default NULL,
    
    `leftHand13` int(1) default NULL,
    
    `leftHand21` int(1) default NULL,
    
    `leftHand22` int(1) default NULL,
    
    `leftHand23` int(1) default NULL,
    
    `leftHand31` int(1) default NULL,
    
    `leftHand32` int(1) default NULL,
    
    `leftHand33` int(1) default NULL,
    
    `leftHand41` int(1) default NULL,
    
    `leftHand42` int(1) default NULL,
    
    `leftHand43` int(1) default NULL,
    
    `leftHand51` int(1) default NULL,
    
    `leftHand52` int(1) default NULL,
    
    `leftHand53` int(1) default NULL,
    
    `leftHip` int(1) default NULL,
    
    `leftKnee` int(1) default NULL,
    
    `leftMouth` int(1) default NULL,
    
    `leftShoulder` int(1) default NULL,
    
    `leftWrist` int(1) default NULL,
	
    `rightAnkle` int(1) default NULL,
    
    `rightClavicleInside` int(1) default NULL,
    
    `rightClavicleOutside` int(1) default NULL,
    
    `rightElbow` int(1) default NULL,
    
    `rightFoot11` int(1) default NULL,
    
    `rightFoot12` int(1) default NULL,
    
    `rightFoot21` int(1) default NULL,
    
    `rightFoot22` int(1) default NULL,
    
    `rightFoot31` int(1) default NULL,
    
    `rightFoot32` int(1) default NULL,
    
    `rightFoot41` int(1) default NULL,
    
    `rightFoot42` int(1) default NULL,
    
    `rightFoot51` int(1) default NULL,
    
    `rightFoot52` int(1) default NULL,
    
    `rightHand11` int(1) default NULL,
    
    `rightHand12` int(1) default NULL,
    
    `rightHand13` int(1) default NULL,
    
    `rightHand21` int(1) default NULL,
    
    `rightHand22` int(1) default NULL,
    
    `rightHand23` int(1) default NULL,
    
    `rightHand31` int(1) default NULL,
    
    `rightHand32` int(1) default NULL,
    
    `rightHand33` int(1) default NULL,
    
    `rightHand41` int(1) default NULL,
    
    `rightHand42` int(1) default NULL,
    
    `rightHand43` int(1) default NULL,
    
    `rightHand51` int(1) default NULL,
    
    `rightHand52` int(1) default NULL,
    
    `rightHand53` int(1) default NULL,
    
    `rightHip` int(1) default NULL,
    
    `rightKnee` int(1) default NULL,
    
    `rightMouth` int(1) default NULL,
    
    `rightShoulder` int(1) default NULL,
    
    `rightWrist` int(1) default NULL,
    
    `question1` int(1) default NULL,
    
    `question2` int(1) default NULL,
    
    `question3` int(1) default NULL,
    
    `question4` int(1) default NULL,
    
    `question4a` int(1) default NULL,
    
    `question5` int(1) default NULL,

    `question6` int(1) default NULL,
    
    `question6a` int(1) default NULL,

    `question7` int(1) default NULL,
    
    `question8` int(1) default NULL,
    
    `question9` int(1) default NULL,

    `question10` int(1) default NULL,

    `score` varchar(30) default NULL,
    `pasq_date_time` datetime default NULL,
    `platform`  varchar(255) NOT NULL default '',

    `patient_id` bigint(20) default NULL,
    `physician_id` bigint(20) default NULL,

  PRIMARY KEY  (`pasq_id`),
  KEY `patient_id` (`patient_id`),
  KEY `physician_id` (`physician_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;






DROP TABLE IF EXISTS `rasq`;
CREATE TABLE IF NOT EXISTS `rasq` (
    `rasq_id` bigint(20) NOT NULL auto_increment,
    
    `back` int(1) default NULL,
    
    `leftAnkle` int(1) default NULL,
    
    `leftClavicleInside` int(1) default NULL,
    
    `leftClavicleOutside` int(1) default NULL,
    
    `leftElbow` int(1) default NULL,
    
    `leftFoot11` int(1) default NULL,
    
    `leftFoot12` int(1) default NULL,
    
    `leftFoot21` int(1) default NULL,
    
    `leftFoot22` int(1) default NULL,
    
    `leftFoot31` int(1) default NULL,
    
    `leftFoot32` int(1) default NULL,
    
    `leftFoot41` int(1) default NULL,
    
   `leftFoot42` int(1) default NULL,
    
    `leftFoot51` int(1) default NULL,
    
    `leftFoot52` int(1) default NULL,
    
    `leftHand11` int(1) default NULL,
    
    `leftHand12` int(1) default NULL,
    
    `leftHand13` int(1) default NULL,
    
    `leftHand21` int(1) default NULL,
    
    `leftHand22` int(1) default NULL,
    
    `leftHand23` int(1) default NULL,
    
    `leftHand31` int(1) default NULL,
    
    `leftHand32` int(1) default NULL,
    
    `leftHand33` int(1) default NULL,
    
    `leftHand41` int(1) default NULL,
    
    `leftHand42` int(1) default NULL,
    
    `leftHand43` int(1) default NULL,
    
    `leftHand51` int(1) default NULL,
    
    `leftHand52` int(1) default NULL,
    
    `leftHand53` int(1) default NULL,
    
    `leftHip` int(1) default NULL,
    
    `leftKnee` int(1) default NULL,
    
    `leftMouth` int(1) default NULL,
    
    `leftShoulder` int(1) default NULL,
    
    `leftWrist` int(1) default NULL,
	
    `rightAnkle` int(1) default NULL,
    
    `rightClavicleInside` int(1) default NULL,
    
    `rightClavicleOutside` int(1) default NULL,
    
    `rightElbow` int(1) default NULL,
    
    `rightFoot11` int(1) default NULL,
    
    `rightFoot12` int(1) default NULL,
    
    `rightFoot21` int(1) default NULL,
    
    `rightFoot22` int(1) default NULL,
    
    `rightFoot31` int(1) default NULL,
    
    `rightFoot32` int(1) default NULL,
    
    `rightFoot41` int(1) default NULL,
    
    `rightFoot42` int(1) default NULL,
    
    `rightFoot51` int(1) default NULL,
    
    `rightFoot52` int(1) default NULL,
    
    `rightHand11` int(1) default NULL,
    
    `rightHand12` int(1) default NULL,
    
    `rightHand13` int(1) default NULL,
    
    `rightHand21` int(1) default NULL,
    
    `rightHand22` int(1) default NULL,
    
    `rightHand23` int(1) default NULL,
    
    `rightHand31` int(1) default NULL,
    
    `rightHand32` int(1) default NULL,
    
    `rightHand33` int(1) default NULL,
    
    `rightHand41` int(1) default NULL,
    
    `rightHand42` int(1) default NULL,
    
    `rightHand43` int(1) default NULL,
    
    `rightHand51` int(1) default NULL,
    
    `rightHand52` int(1) default NULL,
    
    `rightHand53` int(1) default NULL,
    
    `rightHip` int(1) default NULL,
    
    `rightKnee` int(1) default NULL,
    
    `rightMouth` int(1) default NULL,
    
    `rightShoulder` int(1) default NULL,
    
    `rightWrist` int(1) default NULL,
    
    `q1` int(1) default NULL,
    
    `q2` int(1) default NULL,
    
    `q3` int(1) default NULL,
    
    `q3a` int(1) default NULL,
    
    `q4` int(1) default NULL,

    `q4aa` varchar(10) default NULL,

    `q4ab` varchar(10) default NULL,

    `q4b` int(1) default NULL,

    `q5` int(1) default NULL,

    `q6` int(1) default NULL,

    `q7` int(1) default NULL,

    `score` varchar(30) default NULL,
    `rasq_date_time` datetime default NULL,
    `platform`  varchar(255) NOT NULL default '',

    `patient_id` bigint(20) default NULL,
    `physician_id` bigint(20) default NULL,

  PRIMARY KEY  (`rasq_id`),
  KEY `patient_id` (`patient_id`),
  KEY `physician_id` (`physician_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



-- --------------------------------------------------------

-- 
-- Table structure for table `haq`
-- 
DROP TABLE IF EXISTS `haq`;
CREATE TABLE IF NOT EXISTS `haq` (
    `haq_id` bigint(20) NOT NULL auto_increment,
  
    `q1` int(1) default NULL,   
    `q2` int(1) default NULL,    
    `q3` int(1) default NULL,   
    `q4` int(1) default NULL,  
    `q5` int(1) default NULL,
    `q6` int(1) default NULL,
    `q7` int(1) default NULL,
    `q8` int(1) default NULL,
    `q9` int(1) default NULL,
    `q10` int(1) default NULL,
    `q11` int(1) default NULL,
    `q12` int(1) default NULL,
    `q13` int(1) default NULL,
    `q14` int(1) default NULL,
    `q15` int(1) default NULL,
    `q16` int(1) default NULL,
    `q17` int(1) default NULL,
    `q18` int(1) default NULL,
    `q19` int(1) default NULL,
    `q20` int(1) default NULL,
    
    `pain` int(3) default NULL, 
    

    `check1` varchar(30) default NULL,
    `check2` varchar(30) default NULL,
    `check3` varchar(30) default NULL,
    `check4` varchar(30) default NULL,
    `check5` varchar(30) default NULL,
    `check6` varchar(30) default NULL,
    `check7` varchar(30) default NULL,
    `check8` varchar(30) default NULL,
    `check9` varchar(30) default NULL,
    `check10` varchar(30) default NULL,
    `check11` varchar(30) default NULL,
    `check12` varchar(30) default NULL,
    `check13` varchar(30) default NULL,
    `check14` varchar(30) default NULL,
    `check15` varchar(30) default NULL,
    `check16` varchar(30) default NULL,
    `check17` varchar(30) default NULL,
    `check18` varchar(30) default NULL,
    `check19` varchar(30) default NULL,
    `check20` varchar(30) default NULL,
    `check21` varchar(30) default NULL,

    `other1` longtext,
    `other2` longtext,

    `score` varchar(30) default NULL,
    `haq_date_time` datetime default NULL,

    `platform`  varchar(255) NOT NULL default '',

    `patient_id` bigint(20) default NULL,
    `physician_id` bigint(20) default NULL,

  PRIMARY KEY  (`haq_id`),
  KEY `patient_id` (`patient_id`),
  KEY `physician_id` (`physician_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;









--
-- Table structure for table `das`
--

DROP TABLE IF EXISTS `das`;
CREATE TABLE IF NOT EXISTS `das` (
    `das_id` bigint(20) NOT NULL auto_increment,
    
    `back` int(1) default NULL,
    
    `leftAnkle` int(1) default NULL,
    
    `leftClavicleInside` int(1) default NULL,
    
    `leftClavicleOutside` int(1) default NULL,
    
    `leftElbow` int(1) default NULL,
    
    `leftFoot11` int(1) default NULL,
    
    `leftFoot12` int(1) default NULL,
    
    `leftFoot21` int(1) default NULL,
    
    `leftFoot22` int(1) default NULL,
    
    `leftFoot31` int(1) default NULL,
    
    `leftFoot32` int(1) default NULL,
    
    `leftFoot41` int(1) default NULL,
    
   `leftFoot42` int(1) default NULL,
    
    `leftFoot51` int(1) default NULL,
    
    `leftFoot52` int(1) default NULL,
    
    `leftHand11` int(1) default NULL,
    
    `leftHand12` int(1) default NULL,
    
    `leftHand13` int(1) default NULL,
    
    `leftHand21` int(1) default NULL,
    
    `leftHand22` int(1) default NULL,
    
    `leftHand23` int(1) default NULL,
    
    `leftHand31` int(1) default NULL,
    
    `leftHand32` int(1) default NULL,
    
    `leftHand33` int(1) default NULL,
    
    `leftHand41` int(1) default NULL,
    
    `leftHand42` int(1) default NULL,
    
    `leftHand43` int(1) default NULL,
    
    `leftHand51` int(1) default NULL,
    
    `leftHand52` int(1) default NULL,
    
    `leftHand53` int(1) default NULL,
    
    `leftHip` int(1) default NULL,
    
    `leftKnee` int(1) default NULL,
    
    `leftMouth` int(1) default NULL,
    
    `leftShoulder` int(1) default NULL,
    
    `leftWrist` int(1) default NULL,
	
    `rightAnkle` int(1) default NULL,
    
    `rightClavicleInside` int(1) default NULL,
    
    `rightClavicleOutside` int(1) default NULL,
    
    `rightElbow` int(1) default NULL,
    
    `rightFoot11` int(1) default NULL,
    
    `rightFoot12` int(1) default NULL,
    
    `rightFoot21` int(1) default NULL,
    
    `rightFoot22` int(1) default NULL,
    
    `rightFoot31` int(1) default NULL,
    
    `rightFoot32` int(1) default NULL,
    
    `rightFoot41` int(1) default NULL,
    
    `rightFoot42` int(1) default NULL,
    
    `rightFoot51` int(1) default NULL,
    
    `rightFoot52` int(1) default NULL,
    
    `rightHand11` int(1) default NULL,
    
    `rightHand12` int(1) default NULL,
    
    `rightHand13` int(1) default NULL,
    
    `rightHand21` int(1) default NULL,
    
    `rightHand22` int(1) default NULL,
    
    `rightHand23` int(1) default NULL,
    
    `rightHand31` int(1) default NULL,
    
    `rightHand32` int(1) default NULL,
    
    `rightHand33` int(1) default NULL,
    
    `rightHand41` int(1) default NULL,
    
    `rightHand42` int(1) default NULL,
    
    `rightHand43` int(1) default NULL,
    
    `rightHand51` int(1) default NULL,
    
    `rightHand52` int(1) default NULL,
    
    `rightHand53` int(1) default NULL,
    
    `rightHip` int(1) default NULL,
    
    `rightKnee` int(1) default NULL,
    
    `rightMouth` int(1) default NULL,
    
    `rightShoulder` int(1) default NULL,
    
    `rightWrist` int(1) default NULL,

    `patient_global_assessment` int(3) default NULL, 

    `physician_global_assessment` int(3) default NULL,

    `crp_result`  DECIMAL(6, 2) default NULL,

    `numOfTender` int(3) default NULL, 
    
    `numOfSwollen` int(3) default NULL, 

    `numOfTender_DAS28` int(3) default NULL, 
    
    `numOfSwollen_DAS28` int(3) default NULL, 
    
    `score` DECIMAL(6, 2) default NULL,
    `das_date_time` datetime default NULL,
    `platform`  varchar(255) NOT NULL default '',

    `patient_id` bigint(20) default NULL,
    `physician_id` bigint(20) default NULL,

  PRIMARY KEY  (`das_id`),
  KEY `patient_id` (`patient_id`),
  KEY `physician_id` (`physician_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;








-- --------------------------------------------------------

-- 
-- Table structure for table `payments`
-- 

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL auto_increment,
  `pid` bigint(20) NOT NULL default '0',
  `dtime` datetime NOT NULL,
  `encounter` bigint(20) NOT NULL default '0',
  `user` varchar(255) default NULL,
  `method` varchar(255) default NULL,
  `source` varchar(255) default NULL,
  `amount1` decimal(12,2) NOT NULL default '0.00',
  `amount2` decimal(12,2) NOT NULL default '0.00',
  `posted1` decimal(12,2) NOT NULL default '0.00',
  `posted2` decimal(12,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pharmacies`
-- 

DROP TABLE IF EXISTS `pharmacies`;
CREATE TABLE `pharmacies` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `transmit_method` int(11) NOT NULL default '1',
  `email` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `phone_numbers`
-- 

DROP TABLE IF EXISTS `phone_numbers`;
CREATE TABLE `phone_numbers` (
  `id` int(11) NOT NULL default '0',
  `country_code` varchar(5) default NULL,
  `area_code` char(3) default NULL,
  `prefix` char(3) default NULL,
  `number` varchar(4) default NULL,
  `type` int(11) default NULL,
  `foreign_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `foreign_id` (`foreign_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_bookmark`
-- 

DROP TABLE IF EXISTS `pma_bookmark`;
CREATE TABLE `pma_bookmark` (
  `id` int(11) NOT NULL auto_increment,
  `dbase` varchar(255) default NULL,
  `user` varchar(255) default NULL,
  `label` varchar(255) default NULL,
  `query` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM COMMENT='Bookmarks' AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `pma_bookmark`
-- 

INSERT INTO `pma_bookmark` VALUES (2, 'openemr', 'openemr', 'Aggregate Race Statistics', 'SELECT ethnoracial as "Race/Ethnicity", count(*) as Count FROM  `patient_data` WHERE 1 group by ethnoracial');
INSERT INTO `pma_bookmark` VALUES (9, 'openemr', 'openemr', 'Search by Code', 'SELECT  b.code, concat(pd.fname," ", pd.lname) as "Patient Name", concat(u.fname," ", u.lname) as "Provider Name", en.reason as "Encounter Desc.", en.date\r\nFROM billing as b\r\nLEFT JOIN users AS u ON b.user = u.id\r\nLEFT JOIN patient_data as pd on b.pid = pd.pid\r\nLEFT JOIN form_encounter as en on b.encounter = en.encounter and b.pid = en.pid\r\nWHERE 1 /* and b.code like ''%[VARIABLE]%'' */ ORDER BY b.code');
INSERT INTO `pma_bookmark` VALUES (8, 'openemr', 'openemr', 'Count No Shows By Provider since Interval ago', 'SELECT concat( u.fname,  " ", u.lname )  AS  "Provider Name", u.id AS  "Provider ID", count(  DISTINCT ev.pc_eid )  AS  "Number of No Shows"/* , concat(DATE_FORMAT(NOW(),''%Y-%m-%d''), '' and '',DATE_FORMAT(DATE_ADD(now(), INTERVAL [VARIABLE]),''%Y-%m-%d'') ) as "Between Dates" */ FROM  `postcalendar_events`  AS ev LEFT  JOIN users AS u ON ev.pc_aid = u.id WHERE ev.pc_catid =1/* and ( ev.pc_eventDate >= DATE_SUB(now(), INTERVAL [VARIABLE]) )  */\r\nGROUP  BY u.id;');
INSERT INTO `pma_bookmark` VALUES (6, 'openemr', 'openemr', 'Appointments By Race/Ethnicity from today plus interval', 'SELECT  count(pd.ethnoracial) as "Number of Appointments", pd.ethnoracial AS  "Race/Ethnicity" /* , concat(DATE_FORMAT(NOW(),''%Y-%m-%d''), '' and '',DATE_FORMAT(DATE_ADD(now(), INTERVAL [VARIABLE]),''%Y-%m-%d'') ) as "Between Dates" */ FROM postcalendar_events AS ev LEFT  JOIN   `patient_data`  AS pd ON  pd.pid = ev.pc_pid where ev.pc_eventstatus=1 and ev.pc_catid = 5 and ev.pc_eventDate >= now()  /* and ( ev.pc_eventDate <= DATE_ADD(now(), INTERVAL [VARIABLE]) )  */ group by pd.ethnoracial');

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_column_info`
-- 

DROP TABLE IF EXISTS `pma_column_info`;
CREATE TABLE `pma_column_info` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `db_name` varchar(64) default NULL,
  `table_name` varchar(64) default NULL,
  `column_name` varchar(64) default NULL,
  `comment` varchar(255) default NULL,
  `mimetype` varchar(255) default NULL,
  `transformation` varchar(255) default NULL,
  `transformation_options` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=MyISAM COMMENT='Column Information for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_history`
-- 

DROP TABLE IF EXISTS `pma_history`;
CREATE TABLE `pma_history` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `username` varchar(64) default NULL,
  `db` varchar(64) default NULL,
  `table` varchar(64) default NULL,
  `timevalue` timestamp NOT NULL,
  `sqlquery` text,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=MyISAM COMMENT='SQL history' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_pdf_pages`
-- 

DROP TABLE IF EXISTS `pma_pdf_pages`;
CREATE TABLE `pma_pdf_pages` (
  `db_name` varchar(64) default NULL,
  `page_nr` int(10) unsigned NOT NULL auto_increment,
  `page_descr` varchar(50) default NULL,
  PRIMARY KEY  (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=MyISAM COMMENT='PDF Relationpages for PMA' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_relation`
-- 

DROP TABLE IF EXISTS `pma_relation`;
CREATE TABLE `pma_relation` (
  `master_db` varchar(64) NOT NULL default '',
  `master_table` varchar(64) NOT NULL default '',
  `master_field` varchar(64) NOT NULL default '',
  `foreign_db` varchar(64) default NULL,
  `foreign_table` varchar(64) default NULL,
  `foreign_field` varchar(64) default NULL,
  PRIMARY KEY  (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=MyISAM COMMENT='Relation table';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_table_coords`
-- 

DROP TABLE IF EXISTS `pma_table_coords`;
CREATE TABLE `pma_table_coords` (
  `db_name` varchar(64) NOT NULL default '',
  `table_name` varchar(64) NOT NULL default '',
  `pdf_page_number` int(11) NOT NULL default '0',
  `x` float unsigned NOT NULL default '0',
  `y` float unsigned NOT NULL default '0',
  PRIMARY KEY  (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=MyISAM COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_table_info`
-- 

DROP TABLE IF EXISTS `pma_table_info`;
CREATE TABLE `pma_table_info` (
  `db_name` varchar(64) NOT NULL default '',
  `table_name` varchar(64) NOT NULL default '',
  `display_field` varchar(64) default NULL,
  PRIMARY KEY  (`db_name`,`table_name`)
) ENGINE=MyISAM COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

-- 
-- Table structure for table `pnotes`
-- 

DROP TABLE IF EXISTS `pnotes`;
CREATE TABLE `pnotes` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `body` longtext,
  `pid` bigint(20) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `activity` tinyint(4) default NULL,
  `authorized` tinyint(4) default NULL,
  `title` varchar(255) default NULL,
  `assigned_to` varchar(255) default NULL,
  `deleted` tinyint(4) default 0 COMMENT 'flag indicates note is deleted',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `prescriptions`
-- 

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) default NULL,
  `filled_by_id` int(11) default NULL,
  `pharmacy_id` int(11) default NULL,
  `date_added` date default NULL,
  `date_modified` date default NULL,
  `provider_id` int(11) default NULL,
  `start_date` date default NULL,
  `drug` varchar(150) default NULL,
  `drug_id` int(11) NOT NULL default '0',
  `form` int(3) default NULL,
  `dosage` varchar(100) default NULL,
  `quantity` varchar(31) default NULL,
  `size` float unsigned default NULL,
  `unit` int(11) default NULL,
  `route` int(11) default NULL,
  `interval` int(11) default NULL,
  `substitute` int(11) default NULL,
  `refills` int(11) default NULL,
  `per_refill` int(11) default NULL,
  `filled_date` date default NULL,
  `medication` int(11) default NULL,
  `note` text,
  `active` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `prices`
-- 

DROP TABLE IF EXISTS `prices`;
CREATE TABLE `prices` (
  `pr_id` varchar(11) NOT NULL default '',
  `pr_selector` varchar(255) NOT NULL default '' COMMENT 'template selector for drugs, empty for codes',
  `pr_level` varchar(31) NOT NULL default '',
  `pr_price` decimal(12,2) NOT NULL default '0.00' COMMENT 'price in local currency',
  PRIMARY KEY  (`pr_id`,`pr_selector`,`pr_level`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `registry`
-- 

DROP TABLE IF EXISTS `registry`;
CREATE TABLE `registry` (
  `name` varchar(255) default NULL,
  `state` tinyint(4) default NULL,
  `directory` varchar(255) default NULL,
  `id` bigint(20) NOT NULL auto_increment,
  `sql_run` tinyint(4) default NULL,
  `unpackaged` tinyint(4) default NULL,
  `date` datetime default NULL,
  `priority` int(11) default '0',
  `category` varchar(255) default NULL,
  `nickname` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `registry`
-- 

INSERT INTO `registry` VALUES ('New Encounter Form', 1, 'newpatient', 1, 1, 1, '2003-09-14 15:16:45', 0, 'category', '');
INSERT INTO `registry` VALUES ('Review of Systems Checks', 1, 'reviewofs', 9, 1, 1, '2003-09-14 15:16:45', 0, 'category', '');
INSERT INTO `registry` VALUES ('Speech Dictation', 1, 'dictation', 10, 1, 1, '2003-09-14 15:16:45', 0, 'category', '');
INSERT INTO `registry` VALUES ('SOAP', 1, 'soap', 11, 1, 1, '2005-03-03 00:16:35', 0, 'category', '');
INSERT INTO `registry` VALUES ('Vitals', 1, 'vitals', 12, 1, 1, '2005-03-03 00:16:34', 0, 'category', '');
INSERT INTO `registry` VALUES ('Review Of Systems', 1, 'ros', 13, 1, 1, '2005-03-03 00:16:30', 0, 'category', '');
INSERT INTO `registry` VALUES ('Fee Sheet', 1, 'fee_sheet', 14, 1, 1, '2007-07-28 00:00:00', 0, 'category', '');
INSERT INTO `registry` VALUES ('Misc Billing Options HCFA', 1, 'misc_billing_options', 15, 1, 1, '2007-07-28 00:00:00', 0, 'category', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `sequences`
-- 

DROP TABLE IF EXISTS `sequences`;
CREATE TABLE `sequences` (
  `id` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sequences`
-- 

INSERT INTO `sequences` VALUES (1);

-- --------------------------------------------------------

-- 
-- Table structure for table `transactions`
-- 

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id`                      bigint(20)   NOT NULL auto_increment,
  `date`                    datetime     default NULL,
  `title`                   varchar(255) NOT NULL DEFAULT '',
  `body`                    longtext     NOT NULL DEFAULT '',
  `pid`                     bigint(20)   default NULL,
  `user`                    varchar(255) NOT NULL DEFAULT '',
  `groupname`               varchar(255) NOT NULL DEFAULT '',
  `authorized`              tinyint(4)   default NULL,
  `refer_date`              date         DEFAULT NULL,
  `refer_from`              int(11)      NOT NULL DEFAULT 0,
  `refer_to`                int(11)      NOT NULL DEFAULT 0,
  `refer_diag`              varchar(255) NOT NULL DEFAULT '',
  `refer_risk_level`        varchar(255) NOT NULL DEFAULT '',
  `refer_vitals`            tinyint(1)   NOT NULL DEFAULT 0,
  `refer_external`          tinyint(1)   NOT NULL DEFAULT 0,
  `refer_related_code`      varchar(255) NOT NULL DEFAULT '',
  `reply_date`              date         DEFAULT NULL,
  `reply_from`              varchar(255) NOT NULL DEFAULT '',
  `reply_init_diag`         varchar(255) NOT NULL DEFAULT '',
  `reply_final_diag`        varchar(255) NOT NULL DEFAULT '',
  `reply_documents`         varchar(255) NOT NULL DEFAULT '',
  `reply_findings`          text         NOT NULL DEFAULT '',
  `reply_services`          text         NOT NULL DEFAULT '',
  `reply_recommend`         text         NOT NULL DEFAULT '',
  `reply_rx_refer`          text         NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------



-- --------------------------------------------------------

-- 
-- Table structure for table `x12_partners`
-- 

DROP TABLE IF EXISTS `x12_partners`;
CREATE TABLE `x12_partners` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `id_number` varchar(255) default NULL,
  `x12_sender_id` varchar(255) default NULL,
  `x12_receiver_id` varchar(255) default NULL,
  `x12_version` varchar(255) default NULL,
  `processing_format` enum('standard','medi-cal','cms','proxymed') default NULL,
  `x12_isa05` char(2)     NOT NULL DEFAULT 'ZZ',
  `x12_isa07` char(2)     NOT NULL DEFAULT 'ZZ',
  `x12_isa14` char(1)     NOT NULL DEFAULT '0',
  `x12_isa15` char(1)     NOT NULL DEFAULT 'P',
  `x12_gs02`  varchar(15) NOT NULL DEFAULT '',
  `x12_per06` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

------------------------------------------------------------------------------------- 
-- Table structure for table `automatic_notification`
-- 

DROP TABLE IF EXISTS `automatic_notification`;
CREATE TABLE `automatic_notification` (
  `notification_id` int(5) NOT NULL auto_increment,
  `sms_gateway_type` varchar(255) NOT NULL,
  `next_app_date` date NOT NULL,
  `next_app_time` varchar(10) NOT NULL,
  `provider_name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `email_sender` varchar(100) NOT NULL,
  `email_subject` varchar(100) NOT NULL,
  `type` enum('SMS','Email') NOT NULL default 'SMS',
  `notification_sent_date` datetime NOT NULL,
  PRIMARY KEY  (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `automatic_notification`
-- 

INSERT INTO `automatic_notification` (`notification_id`, `sms_gateway_type`, `next_app_date`, `next_app_time`, `provider_name`, `message`, `email_sender`, `email_subject`, `type`, `notification_sent_date`) VALUES (1, 'CLICKATELL', '0000-00-00', ':', 'EMR GROUP 1 .. SMS', 'Welcome to EMR GROUP 1.. SMS', '', '', 'SMS', '0000-00-00 00:00:00'),
(2, '', '2007-10-02', '05:50', 'EMR GROUP', 'Welcome to EMR GROUP . Email', 'EMR Group', 'Welcome to EMR GROUP', 'Email', '2007-09-30 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `notification_log`
-- 

DROP TABLE IF EXISTS `notification_log`;
CREATE TABLE `notification_log` (
  `iLogId` int(11) NOT NULL auto_increment,
  `pid` int(7) NOT NULL,
  `pc_eid` int(11) unsigned NULL,
  `sms_gateway_type` varchar(50) NOT NULL,
  `smsgateway_info` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email_sender` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `type` enum('SMS','Email') NOT NULL,
  `patient_info` text NOT NULL,
  `pc_eventDate` date NOT NULL,
  `pc_endDate` date NOT NULL,
  `pc_startTime` time NOT NULL,
  `pc_endTime` time NOT NULL,
  `dSentDateTime` datetime NOT NULL,
  PRIMARY KEY  (`iLogId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `notification_settings`
-- 

DROP TABLE IF EXISTS `notification_settings`;
CREATE TABLE `notification_settings` (
  `SettingsId` int(3) NOT NULL auto_increment,
  `Send_SMS_Before_Hours` int(3) NOT NULL,
  `Send_Email_Before_Hours` int(3) NOT NULL,
  `SMS_gateway_username` varchar(100) NOT NULL,
  `SMS_gateway_password` varchar(100) NOT NULL,
  `SMS_gateway_apikey` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY  (`SettingsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `notification_settings`
-- 

INSERT INTO `notification_settings` (`SettingsId`, `Send_SMS_Before_Hours`, `Send_Email_Before_Hours`, `SMS_gateway_username`, `SMS_gateway_password`, `SMS_gateway_apikey`, `type`) VALUES (1, 150, 150, 'sms username', 'sms password', 'sms api key', 'SMS/Email Settings');

-- -------------------------------------------------------------------

CREATE TABLE chart_tracker (
  ct_pid            int(11)       NOT NULL,
  ct_when           datetime      NOT NULL,
  ct_userid         bigint(20)    NOT NULL DEFAULT 0,
  ct_location       varchar(31)   NOT NULL DEFAULT '',
  PRIMARY KEY (ct_pid, ct_when)
) ENGINE=MyISAM;

CREATE TABLE ar_session (
  session_id     int unsigned  NOT NULL AUTO_INCREMENT,
  payer_id       int(11)       NOT NULL            COMMENT '0=pt else references insurance_companies.id',
  user_id        int(11)       NOT NULL            COMMENT 'references users.id for session owner',
  closed         tinyint(1)    NOT NULL DEFAULT 0  COMMENT '0=no, 1=yes',
  reference      varchar(255)  NOT NULL DEFAULT '' COMMENT 'check or EOB number',
  check_date     date          DEFAULT NULL,
  deposit_date   date          DEFAULT NULL,
  pay_total      decimal(12,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (session_id),
  KEY user_closed (user_id, closed),
  KEY deposit_date (deposit_date)
) ENGINE=MyISAM;

CREATE TABLE ar_activity (
  pid            int(11)       NOT NULL,
  encounter      int(11)       NOT NULL,
  sequence_no    int unsigned  NOT NULL AUTO_INCREMENT,
  code           varchar(9)    NOT NULL            COMMENT 'empty means claim level',
  modifier       varchar(5)    NOT NULL DEFAULT '',
  payer_type     int           NOT NULL            COMMENT '0=pt, 1=ins1, 2=ins2, etc',
  post_time      datetime      NOT NULL,
  post_user      int(11)       NOT NULL            COMMENT 'references users.id',
  session_id     int unsigned  NOT NULL            COMMENT 'references ar_session.session_id',
  memo           varchar(255)  NOT NULL DEFAULT '' COMMENT 'adjustment reasons go here',
  pay_amount     decimal(12,2) NOT NULL DEFAULT 0  COMMENT 'either pay or adj will always be 0',
  adj_amount     decimal(12,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (pid, encounter, sequence_no),
  KEY session_id (session_id)
) ENGINE=MyISAM;

CREATE TABLE `users_facility` (
  `tablename` varchar(64) NOT NULL,
  `table_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  PRIMARY KEY (`tablename`,`table_id`,`facility_id`)
) ENGINE=InnoDB COMMENT='joins users or patient_data to facility table';

CREATE TABLE `lbf_data` (
  `form_id`     int(11)      NOT NULL AUTO_INCREMENT COMMENT 'references forms.form_id',
  `field_id`    varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`form_id`,`field_id`)
) ENGINE=MyISAM COMMENT='contains all data from layout-based forms';

CREATE TABLE gprelations (
  type1 int(2)     NOT NULL,
  id1   bigint(20) NOT NULL,
  type2 int(2)     NOT NULL,
  id2   bigint(20) NOT NULL,
  PRIMARY KEY (type1,id1,type2,id2),
  KEY key2  (type2,id2)
) ENGINE=MyISAM COMMENT='general purpose relations';

