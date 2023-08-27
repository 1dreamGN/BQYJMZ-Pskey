CREATE TABLE IF NOT EXISTS `sgk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uin` varchar(15) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(32) CHARACTER SET utf8 NOT NULL,
  `url` text CHARACTER SET utf8 NOT NULL,
  `ip` varchar(30) CHARACTER SET utf8 NOT NULL,
  `lasttime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;