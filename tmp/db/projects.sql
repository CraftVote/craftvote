CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sn` varchar(128) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `logo` varchar(32) DEFAULT NULL,
  `rating` smallint(5) unsigned NOT NULL DEFAULT '1',
  `votes` int(10) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `rating` (`rating`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

