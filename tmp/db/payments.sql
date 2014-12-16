CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL,
  `amount` tinyint(4) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `status` enum('success','fail','wait') NOT NULL DEFAULT 'wait',
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `status` (`status`,`date_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

