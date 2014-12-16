-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 02 月 27 日 10:45
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `beiya`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminName` char(54) NOT NULL,
  `passWord` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cateId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateName` char(20) NOT NULL,
  PRIMARY KEY (`cateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`cateId`, `cateName`) VALUES
(1, 'Perl');

-- --------------------------------------------------------

--
-- 表的结构 `commentinfo`
--

CREATE TABLE IF NOT EXISTS `commentinfo` (
  `commentId` char(13) NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `userName` varchar(15) DEFAULT NULL,
  `itemId` int(10) NOT NULL,
  `idType` char(1) NOT NULL,
  `commentText` text,
  `ratings` tinyint(1) unsigned DEFAULT NULL,
  `authorId` mediumint(8) DEFAULT '0',
  `authorName` varchar(15) DEFAULT '',
  `ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `comminfo`
--

CREATE TABLE IF NOT EXISTS `comminfo` (
  `commId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateId` int(10) unsigned NOT NULL,
  `shopId` mediumint(7) unsigned NOT NULL,
  `commTitle` char(56) NOT NULL,
  `commDescription` text NOT NULL,
  `commPhotoId` int(10) unsigned DEFAULT '0',
  `isbn` char(13) DEFAULT '0',
  `author` varchar(50) DEFAULT '0',
  `press` varchar(50) DEFAULT '0',
  `price` float(5,2) NOT NULL,
  `discount` smallint(5) unsigned DEFAULT '1',
  `rating` tinyint(1) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The time u added this item',
  PRIMARY KEY (`commId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10005 ;

--
-- 转存表中的数据 `comminfo`
--

INSERT INTO `comminfo` (`commId`, `cateId`, `shopId`, `commTitle`, `commDescription`, `commPhotoId`, `isbn`, `author`, `press`, `price`, `discount`, `rating`, `add_time`) VALUES
(1, 61, 1, 'Ten Great Works of Philosophy', 'From ancient Greece to nineteenth-century America, this collection traces the history of our civilization through the seminal works of its most influential thinkers. Perfect for anyone interested in understanding the progression of Western thought, this volume includes:\r\n\r\nPlato: Apology, Crito, and Death of Socrates from Phaedo\r\nAristotle: Poetics\r\nSt. Anselm: The Ontological Proof of St. Anselm, from Proslogium\r\nSt. Thomas Aquinas: St. Thomas'' Proofs of God''s Existence, from The Summa Theologica\r\nRené Descartes: Meditations on the First Philosophy\r\nDavid Hume: An Inquiry Concerning Human Understanding\r\nImmanuel Kant: Prolegomena to Any Future Metaphysics\r\nJohn Stuart Mill: Utilitarianism\r\nWilliam James: The Will to Believe', 0, '0451528301', 'Various', 'Signet Classics', 20.00, 1, 3, '2013-02-26 15:13:18'),
(2, 1, 1, 'Learning Perl', '', 0, '7564133724', 'Randal L．Schwartz&Brian de foy', '东南大学出版社', 43.00, 1, 4, '2013-02-26 15:13:11'),
(10002, 2, 1000, 'Anecdotes of Lake Anthium', 'An assembly of the stories engraved by Von Ryan', 20002, '1', 'Von Ryan', 'Wareit Press', 150.00, 1, 0, '2013-02-26 04:40:19'),
(10003, 2, 1000, 'The Serene Creek Sonnets', 'A collection of sonnets about the Serene Creek', 20003, '1', 'Von Ryan', 'Wareit Press', 100.00, 1, 0, '2013-02-26 04:40:21'),
(10004, 1, 1000, 'Perl Cookbook,2e', 'As far as the computer is concerned, all data is just a series of individual numbers,each a string of bits. Even text strings are just sequences of numeric codes inter-preted as characters by programs like web browsers, mailers, printing programs, andeditors.Back when memory sizes were far smaller and memory prices far more dear, program-mers would go to great lengths to save memory. Strategies such as stuffing six charac-ters into one 36-bit word or jamming three characters into one 16-bit word werecommon. Even today, the numeric codes used for characters usually aren''t longerthan 7 or 8 bits, which are the lengths you find in ASCII and Latinl, respectively.That doesn''t leave many bits per character——and thus, not many characters. Con-sider an image file with 8-bit color. You''re limited to 256 different colors in your pal-ette. Similarly, with characters stored as individual octets （an octet is an 8-bit byte）, adocument can usually have no more than 256 different letters, punctuation marks,and symbols in it.ASCII, being the American Standard Code for Information Interchange, was of lim-ited utility outside the United States, since it covered only the characters needed for aslightly stripped-down dialect of American English. Consequently, many countriesinvented their own incompatible 8-bit encodings built upon 7-bit ASCII. Conflictingschemes for assigning numeric codes to characters sprang up, all reusing the samelimited range. That meant the same number could mean a different character in dif-ferent systems and that the same character could have been assigned a different num-ber in different systems. ', 0, '9787564124946', '（美国）克里斯蒂安森（Tom Christiansen） （美国）托克英顿（Nathan Torki', '南京东南大学出版社', 72.30, 1, 0, '2013-02-26 04:40:16');

-- --------------------------------------------------------

--
-- 表的结构 `liketable`
--

CREATE TABLE IF NOT EXISTS `liketable` (
  `itemId` int(10) NOT NULL,
  `idType` char(1) NOT NULL,
  `likeNo` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `orderinfo`
--

CREATE TABLE IF NOT EXISTS `orderinfo` (
  `orderId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commId` int(10) unsigned NOT NULL,
  `userId` mediumint(8) unsigned DEFAULT NULL,
  `shopId` mediumint(7) unsigned DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `postCode` int(6) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `amount` smallint(6) NOT NULL,
  `payment` float(6,2) NOT NULL,
  `delivery` tinyint(1) NOT NULL,
  `done` tinyint(1) NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL,
  `idtype` char(1) NOT NULL,
  `votes` int(10) NOT NULL DEFAULT '0' COMMENT '评分次数',
  `total` int(11) NOT NULL DEFAULT '0' COMMENT '总分',
  `l_r` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last Rating Time',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `rating`
--

INSERT INTO `rating` (`id`, `idtype`, `votes`, `total`, `l_r`) VALUES
(1, 'c', 1, 4, '2013-02-26 06:08:26'),
(10002, 'c', 1, 3, '2013-02-25 13:43:54'),
(10003, 'c', 2, 10, '2013-02-25 13:49:06');

-- --------------------------------------------------------

--
-- 表的结构 `raty`
--

CREATE TABLE IF NOT EXISTS `raty` (
  `id` int(11) NOT NULL,
  `idtype` char(1) NOT NULL,
  `value` tinyint(4) NOT NULL,
  `uid` int(10) NOT NULL,
  `uname` varchar(15) NOT NULL,
  `uip` varchar(12) NOT NULL,
  `r_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `shopinfo`
--

CREATE TABLE IF NOT EXISTS `shopinfo` (
  `userId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `shopName` char(15) NOT NULL,
  `shopId` mediumint(7) unsigned DEFAULT NULL,
  `shopPhotoId` mediumint(7) unsigned DEFAULT '0',
  `sales` smallint(5) unsigned DEFAULT NULL,
  `dealerPhoneNo` varchar(18) NOT NULL,
  `dealerAddr` varchar(80) NOT NULL,
  `dealerEmail` char(40) NOT NULL,
  `shopDescription` varchar(100) DEFAULT NULL,
  `dealerCredit` tinyint(1) unsigned DEFAULT NULL,
  `userPraise` tinyint(1) unsigned DEFAULT NULL,
  `dealerFriendo` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `shopinfo`
--

INSERT INTO `shopinfo` (`userId`, `shopName`, `shopId`, `shopPhotoId`, `sales`, `dealerPhoneNo`, `dealerAddr`, `dealerEmail`, `shopDescription`, `dealerCredit`, `userPraise`, `dealerFriendo`) VALUES
(1, 'GoDaddy', 1, 0, NULL, '13653474427', '', '', NULL, NULL, NULL, NULL),
(4, 'Uranus', 1000, 30001, NULL, '1230644882', 'maple street', 'alamo@wareit.com', 'Duck it!', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tagId` int(10) NOT NULL AUTO_INCREMENT,
  `itemId` int(10) NOT NULL,
  `idType` char(1) NOT NULL,
  `tagName` char(15) DEFAULT NULL,
  PRIMARY KEY (`tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `userId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userName` char(15) NOT NULL,
  `passWord` char(40) NOT NULL,
  `gender` char(2) NOT NULL,
  `userEmail` char(40) NOT NULL,
  `userPhoneNo` varchar(18) NOT NULL,
  `userAddr` varchar(100) NOT NULL,
  `userSecAddr` varchar(100) DEFAULT NULL,
  `postCode` int(6) DEFAULT NULL,
  `userDescription` varchar(101) DEFAULT NULL,
  `userPhotoId` int(9) DEFAULT '0',
  `userCredit` tinyint(4) DEFAULT NULL,
  `userViewHistory` varchar(141) DEFAULT NULL,
  `userBudId` text,
  `shopId` int(7) DEFAULT '0',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`userId`, `userName`, `passWord`, `gender`, `userEmail`, `userPhoneNo`, `userAddr`, `userSecAddr`, `postCode`, `userDescription`, `userPhotoId`, `userCredit`, `userViewHistory`, `userBudId`, `shopId`) VALUES
(1, 'aloha', 'c3a910958c6bf9e87a0719a68c35ee475ed9212e', '', 'aloha@beiya.com', '', '', NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(2, 'aloha2', '4d6301dd57fda44845f7fd5fac0484c69aa39a35', '', 'aloha@beiya.com', '178996', 'Maple street', '', 110225, NULL, 0, NULL, NULL, NULL, 0),
(4, 'alamo1', 'c3a910958c6bf9e87a0719a68c35ee475ed9212e', '', 'alamo@wareit.com', '', '', NULL, NULL, NULL, 0, NULL, NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
