CREATE TABLE IF NOT EXISTS `skrupel_portal_games` (
                   `id` int(11) NOT NULL auto_increment,
                   `spiel_name` varchar(50) NOT NULL default '',
                   `siegbedingungen` tinyint(1) unsigned NOT NULL default '0',
                   `zielinfo_1` varchar(10) NOT NULL default '',
                   `zielinfo_2` varchar(10) NOT NULL default '',
                   `zielinfo_3` varchar(10) NOT NULL default '',
                   `zielinfo_4` varchar(10) NOT NULL default '',
                   `zielinfo_5` varchar(10) NOT NULL default '',
                   `out` tinyint(1) unsigned NOT NULL default '0',
                   `user_1` int(11) NOT NULL default '0',
                   `user_2` int(11) NOT NULL default '0',
                   `user_3` int(11) NOT NULL default '0',
                   `user_4` int(11) NOT NULL default '0',
                   `user_5` int(11) NOT NULL default '0',
                   `user_6` int(11) NOT NULL default '0',
                   `user_7` int(11) NOT NULL default '0',
                   `user_8` int(11) NOT NULL default '0',
                   `user_9` int(11) NOT NULL default '0',
                   `user_10` int(11) NOT NULL default '0',
                   `rasse_1` varchar(255) NOT NULL default '',
                   `rasse_2` varchar(255) NOT NULL default '',
                   `rasse_3` varchar(255) NOT NULL default '',
                   `rasse_4` varchar(255) NOT NULL default '',
                   `rasse_5` varchar(255) NOT NULL default '',
                   `rasse_6` varchar(255) NOT NULL default '',
                   `rasse_7` varchar(255) NOT NULL default '',
                   `rasse_8` varchar(255) NOT NULL default '',
                   `rasse_9` varchar(255) NOT NULL default '',
                   `rasse_10` varchar(255) NOT NULL default '',
                   `spieler_admin` int(11) NOT NULL default '0',
                   `startposition` tinyint(1) unsigned NOT NULL default '0',
                   `imperiumgroesse` tinyint(1) unsigned NOT NULL default '0',
                   `geldmittel` int(11) NOT NULL default '0',
                   `mineralienhome` tinyint(1) unsigned NOT NULL default '0',
                   `sternendichte` int(11) NOT NULL default '0',
                   `mineralien` tinyint(1) unsigned NOT NULL default '0',
                   `spezien` int(11) NOT NULL default '0',
                   `max` tinyint(3) unsigned NOT NULL default '0',
                   `wahr` tinyint(3) unsigned NOT NULL default '0',
                   `lang` tinyint(3) unsigned NOT NULL default '0',
                   `instabil` tinyint(3) unsigned NOT NULL default '0',
                   `stabil` tinyint(3) unsigned NOT NULL default '0',
                   `leminvorkommen` tinyint(1) unsigned NOT NULL default '0',
                   `umfang` int(11) NOT NULL default '0',
                   `struktur` varchar(255) NOT NULL default '',
                   `modul_0` tinyint(1) unsigned NOT NULL default '0',
                   `modul_2` tinyint(1) unsigned NOT NULL default '0',
                   `modul_3` tinyint(1) unsigned NOT NULL default '0',
                   `modul_4` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
                   `team1` int(11) NOT NULL default '0',
                   `team2` int(11) NOT NULL default '0',
                   `team3` int(11) NOT NULL default '0',
                   `team4` int(11) NOT NULL default '0',
                   `team5` int(11) NOT NULL default '0',
                   `team6` int(11) NOT NULL default '0',
                   `team7` int(11) NOT NULL default '0',
                   `team8` int(11) NOT NULL default '0',
                   `team9` int(11) NOT NULL default '0',
                   `team10` int(11) NOT NULL default '0',
                   `nebel` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_mitte` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_aussen` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_min` tinyint(3) unsigned NOT NULL default '0',
                   `piraten_max` tinyint(3) unsigned NOT NULL default '0',
                   `playable` int(11) NOT NULL default '0',
                   `user_1_x` int(10) unsigned,
                   `user_1_y` int(10) unsigned,
                   `user_2_x` int(10) unsigned,
                   `user_2_y` int(10) unsigned,
                   `user_3_x` int(10) unsigned,
                   `user_3_y` int(10) unsigned,
                   `user_4_x` int(10) unsigned,
                   `user_4_y` int(10) unsigned,
                   `user_5_x` int(10) unsigned,
                   `user_5_y` int(10) unsigned,
                   `user_6_x` int(10) unsigned,
                   `user_6_y` int(10) unsigned,
                   `user_7_x` int(10) unsigned,
                   `user_7_y` int(10) unsigned,
                   `user_8_x` int(10) unsigned,
                   `user_8_y` int(10) unsigned,
                   `user_9_x` int(10) unsigned,
                   `user_9_y` int(10) unsigned,
                   `user_10_x` int(10) unsigned,
                   `user_10_y` int(10) unsigned,
                   PRIMARY KEY  (`id`)
                 ) ENGINE=MyISAM AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `skrupel_portal_linklist` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `title` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `views` char(10) NOT NULL default '0',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;


INSERT INTO `skrupel_portal_linklist` (`title`, `url`, `views`, `description`) VALUES
('Skrupel.de', 'http://www.skrupel.de', '7', 'Die offizielle Skrupel-Seite.') ;


CREATE TABLE IF NOT EXISTS `skrupel_portal_messages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `absender` int(11) NOT NULL default '0',
  `empfaenger` int(11) NOT NULL default '0',
  `title` text NOT NULL,
  `text` longtext NOT NULL,
  `time` TIMESTAMP NOT NULL default '0',
  `status` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;



INSERT INTO `skrupel_portal_messages` (`absender`, `empfaenger`, `title`, `text`, `time`, `status`) VALUES
(0, 0, 'Willkommen im Portal!', 'Viel Spaß mit dem neuen Portal!', NOW(), 0) ;

ALTER TABLE `skrupel_user` ADD `portal_layout` CHAR(20) NOT NULL default 'classic' ;

ALTER TABLE `skrupel_user` ADD `homepage` TINYTEXT NOT NULL DEFAULT '' ;


CREATE TABLE IF NOT EXISTS `skrupel_portal` (
  `id` int(11) NOT NULL auto_increment,
  `version` varchar(10) NOT NULL default '2.0.2',
  `servername` text,
  `seitentitel` text NOT NULL,
  `template` char(20) NOT NULL default 'classic',
  `keywords` longtext NOT NULL,
  `description` longtext NOT NULL,
  `encoding` varchar(20) NOT NULL default 'iso-8859-1',
  `cookie_dauer` char(75) NOT NULL default '7',
  `cookie_dauer_2` char(20) NOT NULL default '86400',
  `news_limit` char(5) NOT NULL,
  `impressum_vorname` tinytext,
  `impressum_nachname` tinytext,
  `impressum_strasse` tinytext,
  `impressum_hausnummer` char(5) default NULL,
  `impressum_postleitzahl` varchar(15) default NULL,
  `impressum_ortsname` tinytext,
  `impressum_email` tinytext,
  `impressum_settings` char(2) NOT NULL default '10',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `version` (`version`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `skrupel_portal` (`version`, `servername`, `seitentitel`, `template`, `keywords`, `description`, `encoding`, `cookie_dauer`, `cookie_dauer_2`, `news_limit`, `impressum_settings`) VALUES
('2.0', 'Skrupel-Server', 'Willkommen im Portal', 'classic', 'browsergame, skrupel, portal', 'Das Portal zum Game.', 'iso-8859-1', '7', '86400', '3', '10') ;


ALTER TABLE `skrupel_user` ADD `portal_bann` varchar(1) NOT NULL default '0' ;

ALTER TABLE `skrupel_user` ADD `portal_activity` char(20) NOT NULL default '0' ;

ALTER TABLE `skrupel_user` ADD `profil_text` longtext NOT NULL DEFAULT '' ;
