CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('BONUS','REAL') NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `direction` enum('IN','OUT') NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`,`type`),
  KEY `direction` (`direction`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;