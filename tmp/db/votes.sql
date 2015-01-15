CREATE TABLE IF NOT EXISTS `votes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vk_id` int(11) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `vk_id` (`vk_id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
