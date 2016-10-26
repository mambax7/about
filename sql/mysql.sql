CREATE TABLE `about_page` (
`page_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`page_pid` INT( 4 ) NOT NULL DEFAULT '0',
`page_title` VARCHAR( 255 ) NOT NULL default '',
`page_menu_title` VARCHAR( 255 ) NOT NULL default '',
`page_image` VARCHAR( 255 ) NOT NULL default '',
`page_text` text,
`page_author` VARCHAR( 255 ) NOT NULL default '',
`page_pushtime` INT( 10 )  DEFAULT '0',
`page_blank` INT( 1 ) NOT NULL DEFAULT '0',
`page_menu_status` INT( 1 ) NOT NULL DEFAULT '0',
`page_type` INT( 1 ) NOT NULL DEFAULT '0',
`page_status` INT( 1 ) NOT NULL DEFAULT '0',
`page_order` INT( 2 ) NOT NULL DEFAULT '0',
`page_index` INT( 1 ) NOT NULL DEFAULT '0',
`page_tpl` VARCHAR( 255 ) NOT NULL default '',
`dohtml` 		tinyint(1) 		NOT NULL default '1',
`dosmiley` 		tinyint(1) 		NOT NULL default '0',
`doxcode` 		tinyint(1) 		NOT NULL default '0',
`doimage` 		tinyint(1) 		NOT NULL default '0',
`dobr` 			tinyint(1) 		NOT NULL default '0',
PRIMARY KEY ( `page_id` )
)
  ENGINE = MyISAM;
