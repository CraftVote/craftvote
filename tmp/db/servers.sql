CREATE TABLE IF NOT EXISTS `servers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `version` varchar(32) NOT NULL,
  `client` enum('свой','лицензия','пиратка','') NOT NULL DEFAULT 'свой',
  `wlist` tinyint(1) NOT NULL DEFAULT '0',
  `pvp` tinyint(1) NOT NULL DEFAULT '0',
  `host` varchar(64) NOT NULL,
  `players` smallint(5) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `host` (`host`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
