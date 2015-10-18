-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2015 at 12:49 PM
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
  `id` int(11) NOT NULL,
  `from_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retry_limit` int(2) NOT NULL DEFAULT '3',
  `default_pagination` int(11) NOT NULL,
  `reset_pwd_days` int(4) NOT NULL,
  `allow_registration` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `from_email`, `from_name`, `retry_limit`, `default_pagination`, `reset_pwd_days`, `allow_registration`) VALUES
(1, 'bejan.nouri@gmail.com', 'Webmaster', 8, 10, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(4) NOT NULL,
  `permission` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `description`, `status`, `category`, `created`, `last_updated`) VALUES
(9005, 'USER', 'Allows permission to view all the users from the User Admin screen.', 'ACTIVE', 'UserAdmin', '2015-05-08 09:26:30', '2015-05-08 09:27:20'),
(9010, 'USER-EDIT', 'Allows permission to edit users from the User Admin screen', 'ACTIVE', 'User Admin', '2015-04-11 06:43:09', '2015-04-14 11:04:13'),
(9015, 'USER-ADD', 'Allows permission to add users from the User Admin screen', 'ACTIVE', 'User Admin', '2015-04-11 06:44:01', '2015-04-11 06:44:01'),
(9020, 'USER-DELETE', 'Allows permission to delete users from the User Admin screen', 'ACTIVE', 'User Admin', '2015-04-11 06:44:43', '2015-04-11 06:44:43'),
(9030, 'ROLE', 'Allows permission to view the Roles screen', 'ACTIVE', 'Roles', '2015-04-11 06:47:52', '2015-05-08 09:13:33'),
(9035, 'ROLE-EDIT', 'Allows permission to add and edit roles from the Roles screen', 'ACTIVE', 'Roles', '2015-04-11 06:49:13', '2015-04-11 06:53:13'),
(9040, 'ROLE-DELETE', 'Allows permission to delete roles from the Roles screen', 'ACTIVE', 'Roles', '2015-04-11 06:49:45', '2015-04-11 06:49:45'),
(9050, 'PERMISSION', 'Allows permission to view the Permissions screen', 'ACTIVE', 'Permissions', '2015-04-11 06:51:58', '2015-05-08 09:13:40'),
(9055, 'PERMISSION-EDIT', 'Allows permission to add and edit permissions from the Permissions screen', 'ACTIVE', 'Permissions', '2015-04-11 06:52:47', '2015-04-11 06:53:06'),
(9060, 'PERMISSION-DEL', 'Allows permission to delete permissions from the Permissions screen', 'ACTIVE', 'Permissions', '2015-04-11 06:54:05', '2015-04-11 06:54:05'),
(9065, 'SETTINGS', 'Allows permission to view the global settings screen', 'ACTIVE', 'Settings', '2015-04-11 06:58:07', '2015-05-08 09:13:52'),
(9070, 'SETTINGS-EDIT', 'Allows permissions to edit the global settings of the app', 'ACTIVE', 'Settings', '2015-04-11 06:56:23', '2015-04-11 06:56:23'),
(9999, 'SUPER-ADMIN', 'Global admin permission that allows access to the entire application', 'ACTIVE', 'Administrator', '2015-04-11 06:39:18', '2015-04-11 06:39:18');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`, `created`, `last_updated`, `status`) VALUES
(31, 'SYS-ADMIN', 'Role for the System Administrator', '2015-04-11 07:00:53', '2015-06-29 13:37:00', 'ACTIVE'),
(32, 'USER-ADMIN', 'Administers users rights and privileges', '2015-04-13 17:12:47', '2015-05-04 10:02:52', 'ACTIVE'),
(33, 'GENERAL-ACCESS', 'This is a role that allows you to view but not edit, add or delete', '2015-04-14 20:54:13', '2015-04-28 19:50:58', 'ACTIVE'),
(34, 'ROLES-ADMIN', 'Creates, removes and manages the roles in the system', '2015-04-16 12:06:39', '2015-04-16 12:06:57', 'ACTIVE'),
(35, 'PERMISSION-ADMIN', 'Creates, removes and manages the permissions in the system', '2015-04-16 12:07:48', '2015-04-16 12:08:16', 'ACTIVE'),
(36, 'SETTINGS-ADMIN', 'Manages the application settings', '2015-04-16 12:08:50', '2015-04-16 12:09:12', 'ACTIVE');

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
('001f2f2295181b607f21d89843ca8124', '66.249.64.232', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1435102305, '', NULL),
('01c1c6068430f24707830004dcc577f0', '66.249.64.242', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1433605304, '', NULL),
('03209c53e5dc214192c0e59d43cc9f26', '66.249.65.173', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1434798256, '', NULL),
('039cf182105afb747639d92bc8e8687f', '71.251.112.31', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', 1430265739, 'a:4:{s:5:"email";s:20:"bejan.nouri@csfi.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:4:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}}}', NULL),
('0e9f9499b55731d38f078945d62eb992', '66.249.69.19', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430270449, '', NULL),
('0f094e193f11a1fc4d4ffcea93873e74', '66.249.65.180', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1435612885, '', NULL),
('14a927d49a36440d8a5b019eeb56daec', '66.249.65.159', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430345032, '', NULL),
('16eabe93be399a50f963faeb1426df81', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; rv:29.0) Gecko/20100101 Firefox/29.0', 1433536668, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('184fbb3686ef8b92770a93308fef0fd5', '71.251.112.31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0', 1435805539, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('1bb2f61e08b158cc4ac44f09120de2ba', '66.249.69.35', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430270798, '', NULL),
('1ffd7b3da1e8f6e28a9322d48af759f7', '71.251.112.31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1429671380, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('254e72910b3fd2865660b00a4ea8e610', '66.249.64.232', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1433605458, '', NULL),
('2582b71dd1eb2d1065adb3ea9b0d1e10', '66.249.65.159', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430344736, '', NULL),
('285baf3c4551267d9533fee05a09f272', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430252567, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('2b9fab25464e04d89426323c8b281dac', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.1', 1430256014, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('306e8e84cb3b5612e6772d03a7d52c2d', '71.251.112.31', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1429062608, 'a:4:{s:5:"email";s:20:"bejan.nouri@live.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:4:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}}}', NULL),
('34e98b1244e26a7dc05277dacf56e210', '66.249.64.232', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1433605571, '', NULL),
('35924039f5681306cd02d97f09a3e735', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.9', 1429021055, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:4:{i:0;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9005";}i:1;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9010";}i:2;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9015";}i:3;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9020";}}}', NULL),
('391be080d7d292ffca0ab0dda32f5792', '66.249.64.237', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1431740821, '', NULL),
('3b561aff4e82aa475cbf9a564a0d48a2', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611727, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('3df956599330564db3f923e42edcdeb6', '71.180.21.110', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-gb) AppleWebKit/535+ (KHTML, like Gecko) Version/5.0 Safari/535.22+ Midori', 1435603212, 'a:5:{s:5:"email";s:20:"bejan.nouri@live.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:1:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}}}', NULL),
('412383b27217a883a615bf0e39293d60', '192.168.1.3', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0', 1435891954, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('429ce09d32cfb8b42c26b07c368c3b55', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.9', 1433510601, 'a:1:{s:17:"flash:old:message";s:194:"<div class=''alert alert-success'' role=''alert''><p><span class=''glyphicon glyphicon-ok''></span> <strong>Success!</strong> You have successfully updated your password. Please login again.</p></div>";}', NULL),
('462059490bc6709157cb9dbbc21ab32b', '66.249.64.237', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1433605363, '', NULL),
('4f41fcbf5bccd1070411add503109e3a', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430402677, '', NULL),
('509d4210031df029a9c6b57fab9d0b61', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430402681, '', NULL),
('51416b69c9ee37c6ce0735b8f1638ce6', '66.249.65.180', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1435613274, '', NULL),
('590afe25b759752a648b9912f1170029', '66.249.64.232', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1435354129, '', NULL),
('5d01ba613a2b647d79f73acf381ba5e9', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1428960799, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:5:{i:0;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9020";}}}', NULL),
('5df3810bc6c881a4d03cdfdd67aa8290', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430402679, '', NULL),
('5f47214a926e96450df2f5d8f36ffdaf', '118.140.38.3', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 7.1; Trident/5.0)', 1436086885, '', NULL),
('60c82ca9a195a1cd6b0927acdc613aba', '192.168.100.11', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1430185202, '', NULL),
('61356b4ee4944a4ac3028aef64be7184', '71.251.112.31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1430185965, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('6306ec72d7aee539e0eb6e2fce8c43c1', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430748144, 'a:6:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}s:17:"flash:old:message";s:179:"<div class=''alert alert-success''  role=''alert''><p><span class=''glyphicon glyphicon-ok''></span> <strong>Success!</strong> The role was successfully updated in the system.</p></div>";}', NULL),
('672707c0aa159262f56bed3867a6c4fd', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1433510556, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('67d5bcb2a4105b24e3bdd717639deac4', '70.195.73.137', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0', 1434487948, '', NULL),
('69d066281a61dbdb6d7b6c9349024080', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1429045317, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:5:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}}}', NULL),
('6f179a6182ad62726f2b1f9ae71a8f62', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1429217431, '', NULL),
('70828414cbd0591226b091194869b0d3', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1429200530, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:5:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}}}', NULL),
('70e35fa06d69c8beca11faaa30d2776a', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611720, '', NULL),
('718b85ac907a766008e7e071c5710a98', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611785, '', NULL),
('71a1808cb20bc52ac5f20ca31b8eb83c', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.1', 1430424250, 'a:1:{s:17:"flash:old:message";s:194:"<div class=''alert alert-success'' role=''alert''><p><span class=''glyphicon glyphicon-ok''></span> <strong>Success!</strong> You have successfully updated your password. Please login again.</p></div>";}', NULL),
('72e71bc5fdf2fa5c19570f6fbb894ce9', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430424456, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('75133b970c74de28f7bff0778d986276', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1431095033, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('7938af0a6e7bdfcb34f07114ec07370b', '71.180.21.110', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-gb) AppleWebKit/535+ (KHTML, like Gecko) Version/5.0 Safari/535.22+ Midori', 1435850568, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('79ca0c7521f0c635d6a102db0e35def5', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1429217457, '', NULL),
('7b293c79c73562203d41ccb2acfab25d', '71.251.112.31', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', 1430184927, '', NULL),
('7cabc9157a1a367c7e6cb5c9675c17a1', '66.249.64.242', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1433604953, '', NULL),
('7ef825eac2c452128706b6842dfa76a3', '71.180.21.110', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-gb) AppleWebKit/535+ (KHTML, like Gecko) Version/5.0 Safari/535.22+ Midori', 1436447425, 'a:1:{s:17:"flash:old:message";s:183:"<div class=''alert alert-danger''  role=''alert''><p><span class=''glyphicon glyphicon-exclamation-sign''></span> The email failed to send. Please notify the system administrator.</p></div>";}', NULL),
('7fd53ad6af946a315d5e136721abec8a', '66.249.64.242', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1431737543, '', NULL),
('810269e04688f1f75f7cfc31324da848', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430402679, '', NULL),
('85d1299227077326e0cf0b4beb294efb', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611710, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('88af5e54828e35341535c9bf52ecfdcb', '71.251.112.31', 'Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.9', 1428971559, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:5:{i:0;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9020";}}}', NULL),
('899887e53d583cfeedaaf4f4423949e4', '66.249.64.242', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1431116736, '', NULL),
('8b665187d4ea45ce25f54497bfd4ad39', '71.251.112.31', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', 1429670160, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('8d1090bf8874b206630ce3bedc4a9b97', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611711, '', NULL),
('8d3387d71d12edcf62153141b582052c', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611693, '', NULL),
('8eb94a437eab3506172b34428f5793f9', '66.249.64.232', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1431112998, '', NULL),
('977b0d87219ae6d722324dcd335e31ba', '66.249.64.115', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1434090674, '', NULL),
('97f76692c86ae90606770422df0ef59b', '66.249.65.159', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430344702, '', NULL),
('a0f0f77047fc342dae45df3dc44bd823', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430402673, '', NULL),
('a12412ca7be385cafa8e7d452c32a762', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430315050, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}s:17:"flash:old:message";s:143:"<div class=''alert alert-success'' role=''alert><p><span class=''glyphicon glyphicon-exclamation-ok''></span>Profile successfully updated.</p></div>";}', NULL),
('a1b09943325838c94a3bf4d446d80eda', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1431094893, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('a4721c3aa0917bd799167c7ae33e9cf7', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1435863504, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('a5353d76359de7f79c9c7e16a567475a', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431610980, '', NULL),
('a9301d3b2c63bf52c3fcf22f7d3eca1e', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1430255377, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('a951e4615f3b95f5a904281c32706251', '192.168.1.3', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0', 1435760333, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('ad7e15f79beaa8a1024497bff9f26e92', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611680, '', NULL),
('aea9a4733d35b123955fb6abe6731bba', '66.249.79.160', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1433701259, '', NULL),
('b2602283e9bb62159857e254fd67f70a', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1430323777, '', NULL),
('b4922196bba8ad1db99ed9f54c424028', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611706, '', NULL),
('c22328bd86166462f9d01327e3a6db87', '66.249.69.19', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430246109, '', NULL),
('c45c3bc714df83ffd84f8f0d3eb4168e', '118.140.38.3', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 7.1; Trident/5.0)', 1436086884, '', NULL),
('c6b0bb46521aa4ea554cc933d55372b0', '71.251.112.31', 'Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.1', 1430258428, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('c74802cc978386e3f20b72554129402c', '66.249.65.163', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430344671, '', NULL),
('c85efbe6eb1e80ea3ed4a9a321988ae9', '70.195.73.137', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', 1434478945, '', NULL),
('cf15ec380eb45bebde34f33840eebaba', '71.251.112.31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1429249061, '', NULL),
('cfdee375cbb992c36cf4c8dfe723c3b1', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1435841226, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('d6986d9935ca370b8b826d943d9a523d', '71.251.112.31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1430701408, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('dafbc1bcddfd25baf041263667546b36', '118.140.38.3', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 7.1; Trident/5.0)', 1436086885, '', NULL),
('e0d5eddb485479d9e6e4807a9947475d', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1429820745, '', NULL),
('e15a778ebecd5665031ffb390ef30ef7', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1431611728, '', NULL),
('e24de2d4eeaa7c876bec3be5a1a4874a', '118.140.38.3', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 7.1; Trident/5.0)', 1436086848, '', NULL),
('e40b1d458be4559b3c54f00adb71fa3c', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430404936, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('e4bca088d80bf12b40c85da43d094320', '66.249.65.187', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1434794543, '', NULL),
('e5a2ceeb58bffa4c69f6ee13df68a790', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430251149, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('e65606324aff11b9e4a75443a224d6a5', '71.180.21.110', 'Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0', 1430252609, '', NULL),
('e67ce49fdf4ec93fbe6b28a36bcf3271', '66.249.64.237', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1435340118, '', NULL),
('ed9fd65982ad197023f947f00550eb71', '71.180.21.110', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-gb) AppleWebKit/535+ (KHTML, like Gecko) Version/5.0 Safari/535.22+ Midori', 1435766406, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('eda7ffafa5925dd5d2f932f92f0f5fe8', '71.251.112.31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0', 1435099893, '', NULL),
('eec925449ccc0735ca9cf03d86f9adf9', '66.249.69.27', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430270487, '', NULL),
('eee077789b30bf8f368ea5a52be985a5', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1430418344, 'a:1:{s:17:"flash:old:message";s:194:"<div class=''alert alert-success'' role=''alert''><p><span class=''glyphicon glyphicon-ok''></span> <strong>Success!</strong> You have successfully updated your password. Please login again.</p></div>";}', NULL),
('ef5203925bc7debb70539b1f015afa15', '71.180.21.110', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-gb) AppleWebKit/535+ (KHTML, like Gecko) Version/5.0 Safari/535.22+ Midori', 1435677686, '', NULL),
('f0e77a951f9391a40793fdb6609c50fc', '71.180.21.110', 'Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.1', 1430317016, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}s:17:"flash:old:message";s:152:"<div class=''alert alert-success'' role=''alert''><span class=''glyphicon glyphicon-ok''></span> <strong>Success!</strong> Profile successfully updated.</div>";}', NULL),
('f360a792ba6051d22f1b364f1187b9a1', '71.251.112.31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0', 1430185200, '', NULL),
('f4854507038eabb05fa87ffcee88be3a', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1429023993, 'a:4:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:5:{i:0;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:13:"permission_id";s:4:"9020";}}}', NULL),
('f5383b5c00ab51c7ce64b9ce6291130b', '71.180.21.110', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-gb) AppleWebKit/535+ (KHTML, like Gecko) Version/5.0 Safari/535.22+ Midori', 1435850231, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('fa1974e5ab34e6da0f7634e5b742cc05', '66.249.69.27', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1430270430, '', NULL),
('fb2dc8edda0fad90cfc0cebe2610152b', '66.249.64.115', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1434094776, '', NULL),
('fcc66a9794688756530709ea776e5fe5', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1433535906, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL),
('fea4c23083a842802f78526dc5ae1cde', '71.180.21.98', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', 1435265409, 'a:5:{s:5:"email";s:21:"bejan.nouri@gmail.com";s:12:"is_logged_in";i:1;s:19:"requires_pwd_change";i:0;s:4:"name";s:11:"Bejan Nouri";s:11:"permissions";a:13:{i:0;O:8:"stdClass":1:{s:2:"id";s:4:"9999";}i:1;O:8:"stdClass":1:{s:2:"id";s:4:"9005";}i:2;O:8:"stdClass":1:{s:2:"id";s:4:"9010";}i:3;O:8:"stdClass":1:{s:2:"id";s:4:"9015";}i:4;O:8:"stdClass":1:{s:2:"id";s:4:"9020";}i:5;O:8:"stdClass":1:{s:2:"id";s:4:"9030";}i:6;O:8:"stdClass":1:{s:2:"id";s:4:"9035";}i:7;O:8:"stdClass":1:{s:2:"id";s:4:"9040";}i:8;O:8:"stdClass":1:{s:2:"id";s:4:"9050";}i:9;O:8:"stdClass":1:{s:2:"id";s:4:"9055";}i:10;O:8:"stdClass":1:{s:2:"id";s:4:"9060";}i:11;O:8:"stdClass":1:{s:2:"id";s:4:"9065";}i:12;O:8:"stdClass":1:{s:2:"id";s:4:"9070";}}}', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`id`, `email`, `temp_key`, `password`) VALUES
(29, 'Billy@billy.com', '6e879c436fcdde9c11dcb2d067dd435a', '1267a87a8017ae58f47f55f3c0089fbf'),
(32, 'bejan.nouri@live.com', '594ce4e2db9ce785ef5a93a542ff4e3d', '1267a87a8017ae58f47f55f3c0089fbf'),
(38, 'bejan.nouri@live.com', 'af3d345379d67de055fa93e3d464c7e0', ''),
(49, 'bejan.nouri@csfi.com', 'ee41b545adaf124e341638a316399827', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `pwd_last_updated` datetime DEFAULT NULL,
  `first` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `retry_counter` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `pwd_last_updated`, `first`, `last`, `created`, `last_updated`, `last_activity`, `status`, `locked`, `retry_counter`) VALUES
(1, 'bejan.nouri@gmail.com', '54f2a08c0990d05c019579e115b278e5', '2015-06-29 13:36:08', 'Bejan', 'Nouri', '2014-07-03 00:00:00', '2015-07-09 08:36:02', '2015-07-09 08:31:49', 'ACTIVE', 0, 0),
(3, 'bejan.nouri@live.com', '54f2a08c0990d05c019579e115b278e5', '2015-06-29 14:08:25', 'Bejan', 'Nouri', '2014-07-11 15:20:17', '2015-07-09 08:36:06', '2015-06-29 14:08:44', 'ACTIVE', 0, 0),
(9, 'bejan.nouri@csfi.com', '16d7a4fca7442dda3ad93c9a726597e4', NULL, 'Bejan', 'Nouri', '2015-07-09 09:09:41', '2015-07-09 09:09:41', '2015-07-09 09:09:41', 'ACTIVE', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `email2`, `tel`, `mobile`, `fax`, `company_name`, `website`, `last_updated`) VALUES
(1, 1, '4574 Robin Hood Trail W', 'PO Box 1111', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-444-6514', '941-444-6514', '', '', 'http://www.threshinglabs.com', '2015-04-29 12:04:18'),
(2, 2, '1629 Barber Road', '', 'Sarasota', 'FL', 34240, 'US', 'bejan.nouri@csfi.com', '941-379-0881', '941-444-6514', '', '', '', '2014-07-11 14:59:59'),
(3, 3, '1629 Barber Road', '', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-379-0881', '941-444-6514', '', '', 'http://www.csfi.com', '2015-05-08 09:34:24'),
(5, 5, 'none', '', 'bobville', 'TX', 75008, 'US', '', '', '', '', '', '', '2015-03-12 11:14:02'),
(6, 6, '1629 Barber Road', '', 'Sarasota', 'FL', 34240, 'US', 'bejan.nouri@csfi.com', '941-379-0881', '941-444-6514', '', '', 'http://www.csfi.com', '2015-03-30 16:56:48'),
(7, 7, '1629 Barber Road', '', 'Sarasota', 'FL', 34232, 'US', 'bejan.nouri@live.com', '941-379-0881', '941-444-6514', '', '', 'www.csfi.com', '2015-04-28 19:48:31'),
(8, 8, '1526 Barber Road', '', 'Sarasota', 'FL', 34240, 'US', '', '941-379-0881 ext 144', '', '', '', 'www.csfi.com', '2015-07-09 08:58:09'),
(9, 9, '', '', '', 'FL', 34240, 'US', '', '', '', '', '', '', '2015-07-09 09:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `xref_roles_permissions`
--

CREATE TABLE IF NOT EXISTS `xref_roles_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(4) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xref_roles_permissions`
--

INSERT INTO `xref_roles_permissions` (`role_id`, `permission_id`) VALUES
(15, 1030),
(16, 1030),
(22, 1030),
(15, 1111),
(22, 1833),
(15, 8756),
(32, 9005),
(33, 9005),
(32, 9010),
(33, 9010),
(32, 9015),
(32, 9020),
(34, 9030),
(34, 9035),
(34, 9040),
(33, 9050),
(35, 9050),
(35, 9055),
(35, 9060),
(33, 9065),
(36, 9065),
(36, 9070),
(12, 9999),
(15, 9999),
(31, 9999);

-- --------------------------------------------------------

--
-- Table structure for table `xref_user_roles`
--

CREATE TABLE IF NOT EXISTS `xref_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xref_user_roles`
--

INSERT INTO `xref_user_roles` (`user_id`, `role_id`) VALUES
(1, 31),
(1, 32),
(1, 34),
(1, 35),
(1, 36),
(3, 31);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
