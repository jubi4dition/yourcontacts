-- 
-- Structure for table `contacts`
-- 

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- 
-- Data for table `contacts`
-- 

INSERT INTO `contacts` (`cid`, `uid`, `name`, `email`, `phone`) VALUES
  ('18', '1', 'Codeigniter', 'code@igniter.com', '111111111111111'),
  ('19', '1', 'Twitter Bootstrap', 'twitter@bootstrap.com', '222222222222222'),
  ('20', '2', 'Jquery', 'jquery@script.com', '3333333333333'),
  ('21', '2', 'CSS', 'css@style.com', '44444444444444');

-- 
-- Structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=18446744073709551615 DEFAULT CHARSET=utf8;

-- 
-- Data for table `users`
-- 

INSERT INTO `users` (`uid`, `email`, `password`) VALUES
  ('1', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
  ('2', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6');

