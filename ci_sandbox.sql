-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 27, 2014 at 11:27 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_sandbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `from_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retry_limit` int(2) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`from_email`, `from_name`, `retry_limit`) VALUES
('bejan.nouri@gmail.com', 'Bejan Nouri', 5);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(4) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(3) NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `category`, `category_id`, `created`, `last_updated`) VALUES
(9999, 'SUPER-ADMIN', 'Global admin permission that allows access to the entire application', 'All', 99, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`, `created`, `last_updated`, `status`) VALUES
(1, 'SYS-ADMIN', 'System administrator role', '2014-07-24 00:00:00', '2014-07-24 00:00:00', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `created`) VALUES
('10f5c93e76bd4749c8791e0f25fd811b', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1407589599, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('4060656150952daec68c54ec93d9bec6', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406039405, 'a:2:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', NULL),
('5d73a77d0796627731cabfb575ff2b4e', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409153208, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('671604f5ca34c4ea0512c4951c04f046', '192.168.1.14', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 1399490621, '', '2014-05-07 03:23:41'),
('678f1288c8eee30e684d096da159e283', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407859488, '', NULL),
('6898e71fea6e2d783e350ebfa8a637d8', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407859487, '', NULL),
('6be275b2472135aaa2fe32e7870b8d33', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0', 1406042641, '', NULL),
('8c7401a034c5b6d72b0bb0cf733d93a9', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', 1399469133, '', '2014-05-07 09:02:51'),
('ae739edb72054670a13e3d98de6e1e3a', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0', 1406088274, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('d63c6b9f176f5c9af06b57ce7dee426d', '192.168.1.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 1399490120, 'a:4:{s:9:"user_data";s:0:"";s:7:"created";s:21:"2014/05/07 03:15:20pm";s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', '2014-05-07 03:15:20'),
('f29b4088d51a0c3b65336f8d1c5c6d79', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407859488, '', NULL),
('f3b87d43ef84de03269f476d8ecd197d', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406043172, 'a:2:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', NULL),
('fe43e7bcb43803979040921e115279bb', '192.168.1.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 1399471414, 'a:4:{s:9:"user_data";s:0:"";s:7:"created";s:21:"2014/05/07 09:32:20am";s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', '2014-05-07 09:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE IF NOT EXISTS `temp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `first` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `retry_counter` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first`, `last`, `created`, `last_updated`, `status`, `locked`, `retry_counter`) VALUES
(1, 'bejan.nouri@gmail.com', '1267a87a8017ae58f47f55f3c0089fbf', 'Bejan', 'Nouri', '2014-07-03 00:00:00', '2014-07-21 11:46:59', 'ACTIVE', 0, 0),
(2, 'bejan.nouri@live.com', '1267a87a8017ae58f47f55f3c0089fbf', 'Bejan', 'Nouri', '2014-07-11 13:32:27', '2014-07-11 14:59:59', 'ACTIVE', 0, 0),
(3, 'bejan.nouri@csfi.com', '1267a87a8017ae58f47f55f3c0089fbf', 'Bejan', 'Nouri', '2014-07-11 15:20:17', '2014-07-11 15:41:34', 'ACTIVE', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address1` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `state` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(20) NOT NULL,
  `country` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `email2` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `email2`, `tel`, `mobile`, `fax`, `company_name`, `website`, `last_updated`) VALUES
(1, 1, '4574 Robin Hood Trail', '', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-444-6514', '941-444-6514', '', '', 'http://www.threshinglabs.com', '2014-07-11 13:31:58'),
(2, 2, '1629 Barber Road', '', 'Sarasota', 'FL', 34240, 'US', 'bejan.nouri@csfi.com', '941-379-0881', '941-444-6514', '', '', '', '2014-07-11 14:59:59'),
(3, 3, '1629 Barber Road', '', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-379-0881', '941-444-6514', '', '', 'http://www.csfi.com', '2014-07-11 15:41:34');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
