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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

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
  ('47', '10', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('48', '10', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('49', '10', 'contact3', 'contact3@mail.com', '333333333333333'),
  ('50', '10', 'contact4', 'contact4@mail.com', '444444444444444'),
  ('51', '8', 'contact4', 'contact4@mail.com', '444444444444444'),
  ('52', '8', 'contact5', 'contact5@mail.com', '555555555555555'),
  ('53', '8', 'contact6', 'contact6@mail.com', '666666666666666'),
  ('54', '8', 'contact7', 'contact7@mail.com', '777777777777777'),
  ('64', '10', 'contact5', 'contact5@mail.com', '555555555555555'),
  ('65', '10', 'contact6', 'contact6@mail.com', '666666666666666'),
  ('66', '10', 'contact7', 'contact7@mail.com', '777777777777777'),
  ('67', '10', 'contact8', 'contact8@mail.com', '888888888888888'),
  ('68', '10', 'contact9', 'contact9@mail.com', '999999999999999'),
  ('69', '10', 'contact10', 'contact10@mail.com', '101010101010101'),
  ('70', '10', 'contact11', 'contact11@mail.com', '111111111111111'),
  ('71', '10', 'contact12', 'contact12@mail.com', '121212121212121'),
  ('72', '13', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('73', '13', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('74', '12', 'conatct1', 'contact1@mail.com', '111111111111111'),
  ('75', '11', 'contact1', 'contact1@mail.com', '111111111111111'),
  ('76', '11', 'contact2', 'contact2@mail.com', '222222222222222'),
  ('77', '11', 'contact3', 'contact3@mail.com', '333333333333333');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- 
-- Data for table `users`
-- 

INSERT INTO `users` (`uid`, `email`, `password`, `contacts`) VALUES
  ('7', 'user2@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '4'),
  ('8', 'user3@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '7'),
  ('9', 'user4@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '2'),
  ('10', 'user1@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '12'),
  ('11', 'user5@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '3'),
  ('12', 'user6@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '1'),
  ('13', 'user7@mail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '2');

