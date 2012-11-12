USE test;

CREATE TABLE IF NOT EXISTS `guruguru_test_tbl` (
  `id` bigint(20) unsigned NOT NULL,
  `target_id` int(11) unsigned DEFAULT '0' NOT NULL,
  `status` tinyint(4) unsigned DEFAULT '1' NOT NULL,
  `name` varchar(32) DEFAULT '' NOT NULL,
  `birth` datetime NOT NULL,
  `marriage` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
