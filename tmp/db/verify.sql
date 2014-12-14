CREATE TABLE IF NOT EXISTS `verify` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  `hash` varchar(64) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `hash` (`hash`),
  KEY `date_reg` (`date_create`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
