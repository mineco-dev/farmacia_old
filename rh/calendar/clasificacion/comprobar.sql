CREATE TABLE `apodos` (
  `id` int(4) NOT NULL auto_increment,
  `apodo` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `apodo` (`apodo`)
) ENGINE=MyISAM;
