-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2014 at 04:48 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.2

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
  `from_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`from_email`, `from_name`) VALUES
('bejan.nouri@gmail.com', 'Bejan Nouri');

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
('671604f5ca34c4ea0512c4951c04f046', '192.168.1.14', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 1399490621, '', '2014-05-07 03:23:41'),
('8c7401a034c5b6d72b0bb0cf733d93a9', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', 1399469133, '', '2014-05-07 09:02:51'),
('d63c6b9f176f5c9af06b57ce7dee426d', '192.168.1.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 1399490120, 'a:4:{s:9:"user_data";s:0:"";s:7:"created";s:21:"2014/05/07 03:15:20pm";s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', '2014-05-07 03:15:20'),
('fe43e7bcb43803979040921e115279bb', '192.168.1.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 1399471414, 'a:4:{s:9:"user_data";s:0:"";s:7:"created";s:21:"2014/05/07 09:32:20am";s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', '2014-05-07 09:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE IF NOT EXISTS `temp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first`, `last`, `created`, `last_updated`, `status`, `locked`) VALUES
(1, 'bejan.nouri@gmail.com', '1267a87a8017ae58f47f55f3c0089fbf', 'Bejan', 'Nouri', '2014-07-03 00:00:00', '2014-07-03 16:46:26', 'ACTIVE', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `email2`, `tel`, `mobile`, `fax`, `company_name`, `website`, `last_updated`) VALUES
(1, 1, '4574 Robin Hood Trail', '', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-444-6514', '941-444-6514', '', '', 'threshinglabs.com', '2014-07-03 16:46:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
