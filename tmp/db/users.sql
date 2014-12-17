CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` set('sadmin','admin','editor','author','member') NOT NULL DEFAULT 'member',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `session` varchar(64) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `city` varchar(64) NOT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `auth` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;