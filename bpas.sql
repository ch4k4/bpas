-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2017 at 09:07 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_group`
--

CREATE TABLE `bank_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `kode` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_group`
--

INSERT INTO `bank_group` (`id`, `name`, `kode`) VALUES
(1, 'BANK BCA', '014'),
(2, 'BANK MANDIRI', '008'),
(3, 'BANK BNI', '009'),
(4, 'BANK BRI', '002'),
(5, 'AMERICAN EXPRESS BANK LTD', '030'),
(6, 'ANGLOMAS INTERNASIONAL BANK', '531'),
(7, 'ANZ PANIN BANK', '061'),
(8, 'BANK ABN AMRO', '052'),
(10, 'BANK AKITA', '525'),
(13, 'BANK ANTARDAERAH', '088'),
(14, 'BANK ARTA NIAGA KENCANA', '020'),
(15, 'BANK ARTHA GRAHA', '037'),
(16, 'BANK ARTOS IND', '542'),
(17, 'BANK BENGKULU', '133'),
(18, 'BANK BII', '016'),
(19, 'BANK BINTANG MANUNGGAL', '484'),
(20, 'BANK BISNIS INTERNASIONAL', '459'),
(21, 'CITIBANK N.A.', '031');

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE `bank_info` (
  `id` tinyint(4) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `country_id` tinyint(4) NOT NULL,
  `city_id` tinyint(4) NOT NULL,
  `zip` int(5) DEFAULT NULL,
  `telp` varchar(20) NOT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `cp1` varchar(50) NOT NULL,
  `titl` varchar(4) NOT NULL,
  `cp2` varchar(50) DEFAULT NULL,
  `titl2` varchar(4) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `bank_group_kode` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `kode`, `name`, `address`, `country_id`, `city_id`, `zip`, `telp`, `fax`, `cp1`, `titl`, `cp2`, `titl2`, `remarks`, `bank_group_kode`) VALUES
(1, '0141', 'Kantor Pusat BCA', 'Menara BCA, Jakarta', 1, 13, 10310, '23588000', '23588300', 'Bapak', '1', 'Ibu', '2', 'test 150615', '014'),
(2, '0311', 'Citibank Landmark', 'Landmark Building Jl. Jendral Sudirman No.1', 1, 13, 12190, '2529999', '2529999', '', '0', '', '0', 'Tes', '031'),
(4, '5555', '121321', 'rrrrrrr', 3, 34, 13211, '12312313', '22222', 'jjjj', '0', '', '0', 'tttt23', '030');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(2) NOT NULL,
  `desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `desc`) VALUES
(1, 'ID', 'Indonesia'),
(2, 'US', 'United State of America'),
(3, 'UK', 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `dyn_groups`
--

CREATE TABLE `dyn_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `abbrev` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Navigation groupings. Eg, header, sidebar, footer, etc';

--
-- Dumping data for table `dyn_groups`
--

INSERT INTO `dyn_groups` (`id`, `title`, `abbrev`) VALUES
(1, 'Header', 'header'),
(2, 'Sidebar', 'sidebar'),
(3, 'Footer', 'footer'),
(4, 'Topbar', 'topbar'),
(5, 'Sidebar1', 'sidebar1'),
(6, 'Sidebar2', 'sidebar2');

-- --------------------------------------------------------

--
-- Table structure for table `dyn_menu`
--

CREATE TABLE `dyn_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uri',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `module_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dyn_group_id` int(11) NOT NULL DEFAULT '0',
  `position` int(5) NOT NULL DEFAULT '0',
  `target` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `show_menu` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `menu_allowed` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dyn_menu`
--

INSERT INTO `dyn_menu` (`id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `is_parent`, `show_menu`, `menu_allowed`) VALUES
(1, 'Home', 'page', 1, '', '', '', 1, 0, '', 0, 1, '1', '+1+2+3+0+4+'),
(2, 'Master Data', 'page', 2, '', '', '', 1, 0, '', 0, 1, '1', '+1+'),
(3, 'Transaction', 'page', 3, '', '', '', 1, 0, '', 0, 1, '1', '+1+2+3+'),
(4, 'Daily Maintenance', 'page', 4, '', '', '', 1, 0, '', 0, 1, '0', '+1+3+'),
(5, 'Account Maintenance', 'page', 5, '', 'akun', '', 1, 0, '', 2, 0, '0', '+1+'),
(6, 'Bank Maintenance', 'page', 6, '', '', '', 1, 0, '', 2, 1, '0', '+1+'),
(7, 'Bank Group Name', 'page', 7, '', 'bank', '', 1, 0, '', 6, 0, '0', '+1+'),
(8, 'Bank Information', 'page', 8, '', 'bin', '', 1, 0, '', 2, 0, '0', '+1+2+3+'),
(9, 'Counterpart Maintenance', 'page', 9, '', '', '', 1, 0, '', 2, 1, '0', '+1+'),
(10, 'Counterpart Type', 'page', 10, '', 'counterpart', '', 1, 0, '', 9, 0, '0', '+1+'),
(11, 'Counterpart Information', 'page', 11, '', 'cin', '', 1, 0, '', 9, 0, '0', '+1+'),
(12, 'Issuer Maintenance', 'page', 12, '', 'issuer', '', 1, 0, '', 2, 0, '0', '+1+'),
(13, 'Security Maintenance', 'page', 13, '', '', '', 1, 0, '', 2, 1, '0', '+1+'),
(14, 'Security Type', 'page', 14, '', 'securities', '', 1, 0, '', 13, 0, '0', '+1+'),
(15, 'Security Information', 'page', 15, '', 'sim', '', 1, 0, '', 13, 0, '0', '+1+'),
(16, 'Industry Maintenance', 'page', 16, '', 'indus', '', 1, 0, '', 2, 0, '0', '+1+'),
(17, 'Biaya', 'page', 17, '', 'biaya', '', 1, 0, '', 2, 0, '1', '+1+'),
(18, 'Beban', 'page', 18, '', 'beban', '', 1, 0, '', 2, 0, '1', '+1+'),
(19, 'Country Maintenance', 'page', 19, '', 'country', '', 1, 0, '', 2, 0, '0', '+1+'),
(20, 'City Maintenance', 'page', 20, '', 'city', '', 1, 0, '', 2, 0, '0', '+1+'),
(21, 'Currency Maintenance', 'page', 21, '', 'curr', '', 1, 0, '', 2, 0, '0', '+1+'),
(22, 'Tax Maintenance', 'page', 22, '', 'tax', '', 1, 0, '', 2, 0, '0', '+1+'),
(23, 'Transaction Entry', 'page', 23, '', 'entry', '', 1, 0, '', 3, 0, '1', '+1+3+'),
(24, 'Transaction Approval', 'page', 24, '', 'approval', '', 1, 0, '', 3, 0, '1', '+1+2+'),
(25, 'Settlemen Approval', 'page', 25, '', 'settle', '', 1, 0, '', 3, 0, '0', '+1+'),
(26, 'Interest Processing', 'page', 26, '', 'interest', '', 1, 0, '', 4, 0, '0', '+1+'),
(27, 'Bond Price', 'page', 27, '', 'bond', '', 1, 0, '', 4, 0, '0', '+1+3+'),
(28, 'MarketNav Price', 'page', 28, '', 'mnprice', '', 1, 0, '', 4, 0, '0', '+1+3+'),
(29, 'Daily Maintenance', 'page', 29, '', 'daily', '', 1, 0, '', 4, 0, '0', '+1+3+'),
(30, 'Unrealized Maintenance', 'page', 30, '', 'unreal', '', 1, 0, '', 4, 0, '0', '+1+'),
(31, 'Reporting', 'page', 31, '', '', '', 1, 0, '', 0, 1, '0', '+1+2+3+'),
(98, 'Login', 'page', 98, '', 'Login', '', 1, 0, NULL, 0, 0, '1', '+0+'),
(99, 'Logout', 'page', 99, '', 'Logout', '', 1, 0, NULL, 0, 0, '1', '+1+2+3+4+');

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `id` tinyint(4) NOT NULL,
  `dt_input` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `sector_id` tinyint(4) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `dt_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subsec_id` tinyint(4) NOT NULL,
  `bon` text,
  `sts` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `dt_input`, `name`, `sector_id`, `harga`, `dt_created`, `subsec_id`, `bon`, `sts`) VALUES
(39, '2017-12-20', 'kuras kolam', 2, '15000', '2017-12-21 09:36:46', 19, NULL, 'O'),
(38, '2017-12-01', 'pensil', 5, '10000', '2017-12-21 08:58:09', 9, NULL, 'O'),
(37, '2017-12-20', 'hebel', 2, '200000', '2017-12-20 13:52:46', 16, NULL, 'O');

--
-- Triggers `entry`
--
DELIMITER $$
CREATE TRIGGER `entry_AFTER_DELETE` AFTER DELETE ON `entry` FOR EACH ROW BEGIN
INSERT into stu_log VALUES (user(), CONCAT(
		OLD.id,'|',OLD.NAME,'|',OLD.dt_input,'|',OLD.sector_id,
        '|',OLD.harga,'|',OLD.dt_created,'|',OLD.subsec_id,
        '|',OLD.sts,'|delete on ', NOW()         
         ));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `entry_AFTER_UPDATE` AFTER UPDATE ON `entry` FOR EACH ROW BEGIN
INSERT into stu_log VALUES (user(), CONCAT(
		OLD.id,' | ',OLD.dt_input,' => ',NEW.dt_input,
        ' | ',OLD.NAME,' => ',NEW.NAME,        
        ' | ',OLD.sector_id,' => ',NEW.sector_id,
        ' | ',OLD.harga,' => ',NEW.harga,
        ' | ',OLD.dt_created,' => ',NEW.dt_created,
        ' | ',OLD.subsec_id,' => ',NEW.subsec_id,
        ' | ',OLD.sts,' => ',NEW.sts, '|update on ', NOW()         
         ));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'user', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '::1', 'admin@admin.com', 1433748222),
(2, '::1', 'admin@admin.com', 1433748222),
(3, '::1', 'biasa@user.com', 1433748337);

-- --------------------------------------------------------

--
-- Table structure for table `propinsi`
--

CREATE TABLE `propinsi` (
  `id` tinyint(4) NOT NULL,
  `propinsi` varchar(100) NOT NULL,
  `country_id` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `propinsi`
--

INSERT INTO `propinsi` (`id`, `propinsi`, `country_id`) VALUES
(1, 'Aceh', 1),
(2, 'Sumatera Utara', 1),
(3, 'Bengkulu', 1),
(4, 'Jambi', 1),
(5, 'Riau', 1),
(6, 'Sumatera Barat', 1),
(7, 'Sumatera Selatan', 1),
(8, 'Lampung', 1),
(9, 'Kepulauan Bangka Belitung', 1),
(10, 'Kepulauan Riau', 1),
(11, 'Banten', 1),
(12, 'Jawa Barat', 1),
(13, 'DKI Jakarta', 1),
(14, 'Jawa Tengah', 1),
(15, 'Jawa Timur', 1),
(16, 'Daerah Istimewa Yogyakarta', 1),
(17, 'Bali', 1),
(18, 'Nusa Tenggara Barat', 1),
(19, 'Nusa Tenggara Timur', 1),
(20, 'Kalimantan Barat', 1),
(21, 'Kalimantan Selatan', 1),
(22, 'Kalimantan Tengah', 1),
(23, 'Kalimantan Timur', 1),
(24, 'Gorontalo', 1),
(25, 'Sulawesi Selatan', 1),
(26, 'Sulawesi Tenggara', 1),
(27, 'Sulawesi Tengah', 1),
(28, 'Sulawesi Utara', 1),
(29, 'Sulawesi Barat', 1),
(30, 'Maluku', 1),
(31, 'Maluku Utara', 1),
(32, 'Papua', 1),
(33, 'Papua Barat', 1),
(34, 'London', 3),
(35, 'Washington ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`id`, `name`) VALUES
(1, 'Biaya'),
(2, 'Perawatan'),
(3, 'Perlengkapan'),
(4, 'Konsumsi'),
(5, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `stu_log`
--

CREATE TABLE `stu_log` (
  `user_id` varchar(100) DEFAULT NULL,
  `deskripsion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stu_log`
--

INSERT INTO `stu_log` (`user_id`, `deskripsion`) VALUES
('root@localhost', '37 | 2017-12-20 => 2017-12-20 | hebel => hebel | 2 => 2 | 200000 => 200000 | 2017-12-20 13:52:46 => 2017-12-20 13:52:46 | 16 => 16 | O => A|update on 2017-12-28 15:01:22'),
('root@localhost', '37 | 2017-12-20 => 2017-12-20 | hebel => hebel | 2 => 2 | 200000 => 200000 | 2017-12-20 13:52:46 => 2017-12-20 13:52:46 | 16 => 16 | A => O|update on 2017-12-28 15:01:59'),
('root@localhost', '41 | 2017-12-21 => 2017-12-21 | tes => tes | 1 => 1 | 1 => 1 | 2017-12-21 14:39:01 => 2017-12-21 14:39:01 | 1 => 1 | A => O|update on 2017-12-28 15:05:36'),
('root@localhost', '38 | 2017-12-01 => 2017-12-01 | pensil => pensil | 5 => 5 | 1000 => 1000 | 2017-12-21 08:58:09 => 2017-12-21 08:58:09 | 9 => 9 | A => O|update on 2017-12-28 15:06:15'),
('root@localhost', '41|tes|2017-12-21|1|1|2017-12-21 14:39:01|1|O|delete on 2017-12-28 15:06:40'),
('root@localhost', '38 | 2017-12-01 => 2017-12-01 | pensil => pensil | 5 => 5 | 1000 => 10000 | 2017-12-21 08:58:09 => 2017-12-21 08:58:09 | 9 => 9 | O => O|update on 2017-12-28 15:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `subsec`
--

CREATE TABLE `subsec` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desk` varchar(255) DEFAULT NULL,
  `coa` varchar(10) NOT NULL,
  `sector_id` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subsec`
--

INSERT INTO `subsec` (`id`, `name`, `desk`, `coa`, `sector_id`) VALUES
(1, 'Listrik', 'Beban Listrik dan Air Perkantoran', '832500001', 1),
(2, 'Telephone', 'Beban Telephone dan Fax', '832500002', 1),
(3, 'BBM', 'Beban BBM dan Oli', '832500003', 1),
(4, 'Transport', 'Beban Transport Umum', '832500004', 1),
(5, 'Internet', 'Beban Internet', '832500005', 1),
(6, 'Air Mineral', 'Biaya Konsumsi', '832500015', 4),
(7, 'Gas', 'Biaya Konsumsi', '832500016', 4),
(8, 'Jamuan Karyawan', 'Biaya Konsumsi', '832500017', 4),
(9, 'ATK', 'Beban Alat Tulis Kantor', '832500018', 5),
(10, 'Perlengkapan Kantor', 'Beban Pemeliharaan Alat Kantor', '832500019', 5),
(11, 'Tanaman', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500012', 3),
(12, 'Bangunan', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500013', 3),
(13, 'Kolam', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500014', 3),
(14, 'Tanaman - Material', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500006', 2),
(15, 'Tanaman - Jasa', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500007', 2),
(16, 'Bangunan - Material', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500008', 2),
(17, 'Bangunan - Jasa', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500009', 2),
(18, 'Kolam - Material', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500010', 2),
(19, 'Kolam - Jasa', 'Beban Pemeliharaan dan Perawatan Perkantoran', '832500011', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1514440697, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'biasa', '$2y$08$aCAwJ1Gury2Y3WuCmKkmWeV6mwkIcTZdsV8rOw4F63gzh7wWHaHq6', '', 'biasa@user.com', '', '', NULL, '', 1432017667, 1434606988, 1, 'User', 'Biasa', '', ''),
(3, '::1', 'rusli', '$2y$08$aCAwJ1Gury2Y3WuCmKkmWeV6mwkIcTZdsV8rOw4F63gzh7wWHaHq6', '', 'rusli@user.com', '', '', NULL, '', 1432017667, 1434607027, 1, 'User', 'Rusli', '', ''),
(4, '::1', 'suwangsih .', '$2y$08$yxHtJ74/auE21H.uXYTnkutJPish60T9PWnj0Kv8HUz0Pnu3E2oMe', NULL, 'suwangsih@indonesiare.co.id', NULL, NULL, NULL, NULL, 1514436784, 1514436830, 1, 'Suwangsih', '.', 'IndonesiaRe', '1100'),
(5, '::1', 'riana noviyanti', '$2y$08$V26yWngL2OP7dnuaVWk.IeGcg02BWHyZu7BnttwrWpsjR4Vy2o6lS', NULL, 'riana@indonesiare.co.id', NULL, NULL, NULL, NULL, 1514440624, 1514440766, 1, 'Riana', 'Noviyanti', 'IndonesiaRe', '2128');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 4, 3),
(5, 5, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_group`
--
ALTER TABLE `bank_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dyn_groups`
--
ALTER TABLE `dyn_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dyn_menu`
--
ALTER TABLE `dyn_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dyn_group_id - normal` (`dyn_group_id`);

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `propinsi`
--
ALTER TABLE `propinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subsec`
--
ALTER TABLE `subsec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subsec_ibfk_3` (`sector_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_group`
--
ALTER TABLE `bank_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dyn_groups`
--
ALTER TABLE `dyn_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dyn_menu`
--
ALTER TABLE `dyn_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `propinsi`
--
ALTER TABLE `propinsi`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subsec`
--
ALTER TABLE `subsec`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
