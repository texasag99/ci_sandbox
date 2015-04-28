-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2014 at 08:51 PM
-- Server version: 5.5.38
-- PHP Version: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
  `retry_limit` int(2) NOT NULL DEFAULT '3',
  `default_pagination` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`from_email`, `from_name`, `retry_limit`, `default_pagination`) VALUES
('bejan.nouri@gmail.com', 'Bejan Nouri', 5, 10);

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
(9999, 'SUPER-ADMIN', 'Global admin permission that allows access to the entire application', 'All', 99, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`, `created`, `last_updated`, `status`) VALUES
(11, 'ROLE-112323', 'Just a test to see what happens', '2014-09-15 00:00:00', '2014-11-23 20:42:42', 'ACTIVE'),
(12, 'SYS-ADMIN', 'System Administrator Role', '2014-09-15 00:00:00', '2014-11-23 20:45:10', 'ACTIVE'),
(15, 'PRIMARY-USER3', 'Primary user 3', '2014-09-15 00:00:00', '2014-09-15 00:00:00', 'ACTIVE'),
(16, 'PRIMARY-USER4', 'Primary user 4', '2014-09-15 00:00:00', '2014-09-15 00:00:00', 'ACTIVE'),
(17, 'PRIMARY-USER5', 'Primary user 5', '2014-09-15 00:00:00', '2014-11-23 20:44:56', 'ACTIVE'),
(19, 'PRIMARY-USER6', 'Primary user 6', '2014-09-15 00:00:00', '2014-09-15 00:00:00', 'ACTIVE'),
(21, 'PRIMARY-USER8', 'Primary user 8', '2014-09-15 00:00:00', '2014-09-15 00:00:00', 'ACTIVE'),
(22, 'PRIMARY-USER9', 'Primary user 9', '2014-09-15 00:00:00', '2014-09-15 00:00:00', 'ACTIVE'),
(23, 'SWX-ADMIN', 'SWITCHWARE Admin', '2014-10-14 06:45:48', '2014-11-23 20:49:08', 'INACTIVE'),
(24, 'TEST-ADMIN', 'What is the deal?', '2014-10-14 06:48:02', '2014-11-23 20:49:33', 'ACTIVE'),
(25, 'TEST-ADMIN2', 'Another test for the admin', '2014-10-14 06:49:20', '2014-11-23 20:45:19', 'ACTIVE'),
(26, 'GUEST', 'guest role', '2014-10-14 06:50:42', '2014-11-23 20:44:36', 'ACTIVE');

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
('02a2f889ad8b7babc896ddf81557c242', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1411072356, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('03bc759d65076cb3b9264b76c9fbc559', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36', 1416546932, '', NULL),
('03fdf4bab552e4340c5ccbcc3472996b', '71.180.21.110', 'Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/75', 1411053039, '', NULL),
('0fc0819e2c3ada7f2d02bc80d1ac22bf', '71.99.202.45', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1412048532, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('10f5c93e76bd4749c8791e0f25fd811b', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1407589599, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('14a5ab1e60f3017440a6a1feba2c0120', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1411073623, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('1ec0178102021ddaf70dfae2ee59743c', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1411134985, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('3138df05cfb17b438725eac1011e2871', '71.180.21.110', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409154782, '', NULL),
('3acbc0d6edc355ffbe2c669420115ba4', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1409174114, '', NULL),
('4060656150952daec68c54ec93d9bec6', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406039405, 'a:2:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', NULL),
('40bb1bb36e01b4d723a8f58b89ff1fc4', '71.180.21.110', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409173874, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('4861d3c6e218423f61db0f250056dd5c', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1410458591, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('48e378de305681b12fa48d8947d45941', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1412106037, '', NULL),
('490b76e1b30eae967d20a9948bc3d64c', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1412048132, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('49e13eed13d95bf718d4515d4873956d', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1412798529, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('4a2c5bf5d33d752b4621312c5922424e', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415240176, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('4a9c68144d149c1a598def8d1b817586', '50.243.213.148', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1410797571, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('4af26143b7811c354195fbdbe9ad04ef', '12.168.101.34', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1410921724, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('4b45160d81de28c125fda66a324310d6', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1409234073, '', NULL),
('4e80478af537b6460c9ecf9b323f12d4', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1412694273, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('5130e7d8f508af8c88ce1d74c11546ac', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1412024949, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('5249df3799c5a97e75d78d7d12e031d0', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1411994608, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('56d6221c1f51f6f459524dcffd8a3c57', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1412087183, '', NULL),
('59cbc44571f651c939c629519bbf42cb', '66.87.102.226', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1410828713, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('5d73a77d0796627731cabfb575ff2b4e', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409153208, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('5fc468a5a9d97b29e27640bb93fa9934', '66.87.102.142', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1410877297, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('671604f5ca34c4ea0512c4951c04f046', '192.168.1.14', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0', 1399490621, '', '2014-05-07 03:23:41'),
('678f1288c8eee30e684d096da159e283', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407859488, '', NULL),
('6898e71fea6e2d783e350ebfa8a637d8', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407859487, '', NULL),
('6be275b2472135aaa2fe32e7870b8d33', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0', 1406042641, '', NULL),
('6cdcfa95fac88054edb10b060c6f0d69', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1412627806, '', NULL),
('71138aac9949833a09d761e09ae90467', '192.168.100.4', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1', 1409183596, '', NULL),
('73393dd9de6a64b31d6260cc483f6d6f', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.94 Safari/537.36', 1410433363, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('759eea40a5b3b067cafd743137f2cd29', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1409155671, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('835b48f59e0844fcd0d68a0642d9e21d', '12.168.101.34', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1410922791, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('8917a28bf9d24f3aa0440bbc3909133e', '12.168.101.34', 'Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/75', 1410954338, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('8c7401a034c5b6d72b0bb0cf733d93a9', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', 1399469133, '', '2014-05-07 09:02:51'),
('8fb32f8cd0e050f6d4bf79c67199682c', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1411154243, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('91b945505400626372c79c4b17b4f0d9', '192.168.100.4', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1411164691, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('a041529dd0ddf9ef9287ec57b841507d', '12.168.101.34', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1410953797, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('a77e2be413e70eb114ef0b46c7ca823b', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.101 Safari/537.36', 1413284369, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('ae2425feecc2e437d3dd2173d4943d71', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1412693902, '', NULL),
('ae4d0f4ecb0ad605970372caa1577330', '50.243.213.148', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1410799189, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('ae739edb72054670a13e3d98de6e1e3a', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0', 1406088274, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('b0a00630caeee782ff86d543ea24b769', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1409155731, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('b2682fda58bb12b587d2902ee6556597', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.94 Safari/537.36', 1409663848, '', NULL),
('ba9d06a318e8848c06c450f2b0091c6b', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1411136684, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('bd4c9f7af876779243389f06ed4cc46e', '192.168.100.5', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0', 1414360351, '', NULL),
('be373d254094f5eabbf6cda1c74d7c99', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1412735242, '', NULL),
('be7d6731358f749d8284ae9de031c2e8', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.101 Safari/537.36', 1413246850, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('c36ef39bac203b37b233155e14d78698', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1416585100, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('c699cc6d29a48a33dfd95eff418523ec', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1411130417, '', NULL),
('c8dcf8b6dca7dc1663fefdad0689145e', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1409174101, '', NULL),
('cf5432d513d038259d1e9eec9d2186e4', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1412705184, '', NULL),
('d12ddbb5928281fcd23d230412114ea9', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1411049584, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('d537990b9a0c98d61e17674440f15748', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416709855, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('d63c6b9f176f5c9af06b57ce7dee426d', '192.168.1.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.132 Safari/537.36', 1399490120, 'a:4:{s:9:"user_data";s:0:"";s:7:"created";s:21:"2014/05/07 03:15:20pm";s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', '2014-05-07 03:15:20'),
('d673de3d9febbc5e07a6bb35e2cd4a6a', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1410466595, '', NULL),
('dc3e0dacc2647551cd6740ec794ef1c4', '71.101.119.179', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2', 1414103041, '', NULL),
('dc6771becac274a707a8d459db9670d8', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1410466839, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('df6ffdc8c1214055bc61d6d7fbde15a7', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1411593304, '', NULL),
('e29626ee2bf9b55540b8743c472bd091', '12.168.101.34', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1410821152, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('ed63a8eac450e6857ccc9b06a71206c9', '71.99.202.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416793751, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
('f29b4088d51a0c3b65336f8d1c5c6d79', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407859488, '', NULL),
('f3b87d43ef84de03269f476d8ecd197d', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406043172, 'a:2:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;}', NULL),
('f590983acb1058d85f3cb7d602ffe88b', '192.168.100.6', 'Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/75', 1410491835, '', NULL),
('f812661fa1ab00f8c0b07764599b5ff2', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1412709540, '', NULL),
('fc0cbbc95992530691898605eb2e67bd', '66.87.103.2', 'Mozilla/5.0 (Linux; Android 4.4.2; XT1049 Build/KXA20.16-1.24-1.12) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2', 1410964604, 'a:3:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";}', NULL),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

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
(1, 'bejan.nouri@gmail.com', '1267a87a8017ae58f47f55f3c0089fbf', 'Bejan', 'Nouri', '2014-07-03 00:00:00', '2014-09-16 22:13:23', 'ACTIVE', 0, 0),
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
(1, 1, '4574 Robin Hood Trail W', '', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-444-6514', '941-444-6514', '', '', 'http://www.threshinglabs.com', '2014-09-15 15:39:42'),
(2, 2, '1629 Barber Road', '', 'Sarasota', 'FL', 34240, 'US', 'bejan.nouri@csfi.com', '941-379-0881', '941-444-6514', '', '', '', '2014-07-11 14:59:59'),
(3, 3, '1629 Barber Road', '', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-379-0881', '941-444-6514', '', '', 'http://www.csfi.com', '2014-07-11 15:41:34');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
