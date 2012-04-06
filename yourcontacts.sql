-- 
-- Structure for table `admins`
-- 

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 
-- Data for table `admins`
-- 

INSERT INTO `admins` (`aid`, `name`, `password`) VALUES
  ('1', 'Admin', 'dc647eb65e6711e155375218212b3964');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- 
-- Data for table `contacts`
-- 

INSERT INTO `contacts` (`cid`, `uid`, `name`, `email`, `phone`) VALUES
  ('38', '7', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('39', '7', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('40', '7', 'contact3', 'contact3@mail.com', '333333333333333'),
  ('41', '7', 'contact4', 'contact4@mail.com', '444444444444444'),
  ('42', '8', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('43', '8', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('44', '8', 'contact3', 'contact3@mail.com', '333333333333333'),
  ('45', '9', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('46', '9', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('47', '10', 'contact1', 'contact1@mail.com', '111111111111111');

-- 
-- Structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `contacts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- 
-- Data for table `users`
-- 

INSERT INTO `users` (`uid`, `email`, `password`, `contacts`) VALUES
  ('7', 'user2@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '4'),
  ('8', 'user3@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '3'),
  ('9', 'user4@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '2'),
  ('10', 'user1@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '1');

