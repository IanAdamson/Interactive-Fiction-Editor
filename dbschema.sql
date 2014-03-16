CREATE TABLE IF NOT EXISTS `nodes` (
  `n_name` text NOT NULL,
  `n_dialog` text NOT NULL,
  `n_action` text NOT NULL,
  `n_parent` int(11) NOT NULL,
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;