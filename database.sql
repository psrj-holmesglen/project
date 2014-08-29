-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2014 at 03:27 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epworth_ec`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_rules`
--

CREATE TABLE `business_rules` (
  `Bus_Rule` char(30) NOT NULL,
  `Value` char(30) NOT NULL,
  PRIMARY KEY (`Bus_Rule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_rules`
--

INSERT INTO `business_rules` (`Bus_Rule`, `Value`) VALUES
('And dont blink', 'yes'),
('Blink and your dead', 'yes'),
('Dont Blink', 'yes'),
('Dont look away', 'yes'),
('Dont turn your back', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE `conference` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(400) NOT NULL,
  `Start_Time` datetime NOT NULL,
  `End_Time` datetime NOT NULL,
  `Organiser` varchar(30) NOT NULL,
  `Location` varchar(80) NOT NULL,
  `Contact` char(25) NOT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Download_Avail` tinyint(1) NOT NULL,
  `FilePath` varchar(100) DEFAULT NULL,
  `Feedback` smallint(5) unsigned DEFAULT NULL,
  `Venue` smallint(5) unsigned NOT NULL,
  `Token` int(11) DEFAULT NULL,
  `Conference_Admin_Id` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Conference_Venue_fk` (`Venue`),
  KEY `Conference_Feedback_fk` (`Feedback`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`ID`, `Title`, `Description`, `Start_Time`, `End_Time`, `Organiser`, `Location`, `Contact`, `Last_Updated`, `Download_Avail`, `FilePath`, `Feedback`, `Venue`, `Token`, `Conference_Admin_Id`) VALUES
(1, 'DSTC', 'Definitive Surgical Trauma Care Course and Definitive Preoperative Nurses Trauma Care Course Combined Program Course No: 061//32', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'DSTC', 'Epworth Richmond Auditorium / DPNTC-Only Sessions: Cato Room (Level 2)', 'John Doe', '2014-08-27 11:57:17', 0, 'http://www.test.org/', 1, 3, 100001, 2),
(2, 'Surgical', 'Conference covering all surgical procedures', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'Epworth Healthcare', 'Melbourne', 'Jane Smith', '2014-08-28 13:34:00', 1, 'http://www.test.org/', 1, 6, 100002, 2),
(3, 'Trauma', 'Intensive trauma conference', '2014-03-03 08:00:00', '2014-03-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Hamstick', '2014-08-28 13:32:01', 0, 'http://www.test.org/', 1, 5, 100003, 2),
(4, 'General practitioners', 'A fast paced conference in general medical practices', '2015-04-04 08:00:00', '2014-04-07 04:00:00', 'Epworth Healthcare', 'Albury', 'Timothy Dalton', '2014-08-27 08:26:11', 0, 'http://www.test.org/', 1, 1, 100004, 4),
(5, 'MidYear', 'Refresher Conference Description', '2014-03-03 08:00:00', '2014-06-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Ham', '2014-08-28 11:57:42', 0, 'http://www.test.org/', 3, 2, 100005, 2),
(6, 'End of Year', 'Refresher Conference', '2014-03-03 08:00:00', '2014-07-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Ham', '2014-08-27 08:26:19', 0, 'http://www.test.org/', 1, 2, 100006, 3),
(7, 'DSTC Conference ', 'DSTC Conference edit', '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC org', 'Melbourne CBD', 'Jane Smith', '2014-08-28 13:19:36', 0, 'http://www.test.org/', 1, 6, 100007, 2),
(8, 'DSTC and Future Trauma Care', 'Discussing about fure development of DSTC for dealing with increasing patients', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'John Daugh', 'Epworth Richmond Auditorium Cato Room (Level 2)', 'John Doe', '2014-08-28 12:36:47', 0, 'http://www.test.org/', 1, 1, 100008, 3),
(9, 'Surgical Research and Psychological Test', 'Topic is collaboration between surgeon and modern psychology', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'Epworth Healthcare', 'Melbourne', 'Kane Damih', '2014-08-27 11:57:43', 1, 'http://www.test.org/', 3, 3, 100009, 3),
(10, 'Trauma Care in early stage', 'Discuss about Intensive Trauma and Early Stage Care', '2014-03-03 08:00:00', '2014-03-07 04:00:00', 'DSTC', 'Melbourne', 'Herren Hisick', '2014-08-27 08:26:44', 0, 'http://www.test.org/', 3, 2, 100010, 4),
(11, 'Relationship between Trauma and End of Year', 'Statistical research which reveals hidden relationship between Trauma an end season of year', '2014-03-03 08:00:00', '2014-07-07 04:00:00', 'DSTC', 'Melbourne', 'Zen Zen', '2014-08-28 12:36:51', 0, 'http://www.test.org/', 4, 2, 100011, 2),
(12, 'Collaboration in DSTC', 'Short report about collaborations which takes place in DSTC between various fields', '2014-02-02 08:00:00', '2014-02-02 10:00:00', 'DSTC', 'Melbourne', 'Ann Thim', '2014-08-28 12:36:55', 0, 'http://www.test.org/', 4, 1, 100012, 3),
(13, 'DSTC33 - jprs group', 'TEST date not updtedghgbhj', '2016-05-26 06:05:00', '2019-05-28 03:05:00', 'Epworth Healthcare', 'Here', 'NO ONE', '2014-08-28 12:37:01', 0, 'UPLOADED_FILES/Conference/logo.jpg', NULL, 1, NULL, 4),
(41, 'jprs conference', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2014-08-22 12:10:00', '2014-08-22 12:50:00', 'Jprs', 'Melbourne', '12348877', '2014-08-28 02:12:42', 0, 'No File Uploaded', 1, 1, NULL, 3),
(44, 'jprs conference Copy1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2014-08-22 12:10:00', '2014-08-22 12:50:00', 'jprs', 'Melbourne', '334498855', '2014-08-28 02:14:16', 0, 'No File Uploaded', 5, 1, NULL, 4),
(45, 'jprs conference Co', 'work on conference section 1', '2014-08-22 12:10:00', '2014-08-22 18:50:00', 'jbjkb', 'bjkbj', 'bjb', '2014-08-28 12:37:04', 0, 'No File Uploaded', NULL, 5, NULL, 4),
(50, 'jack-jprs', 'Work on conference section', '2014-08-23 14:15:00', '2014-08-23 16:15:00', 'Jprs', 'Melbourne', 'jack', '2014-08-28 12:37:11', 0, 'No File Uploaded', 2, 2, NULL, 3),
(52, 'feedback checking', 'feedback checking description', '2014-08-26 10:10:00', '2014-08-26 10:55:00', 'fb checking ', 'checking fb', 'contact fb', '2014-08-28 12:37:14', 0, 'No File Uploaded', 4, 1, NULL, 4),
(55, 'checking confi admin', 'checking confi admin description', '2014-08-27 10:15:00', '2014-08-27 10:50:00', 'checking Organiser', 'checking location', 'checking  contact', '2014-08-27 09:14:11', 0, 'No File Uploaded', 2, 4, NULL, 3),
(56, 'checking confi admin', 'checking confi admin ', '2014-08-27 10:15:00', '2014-08-27 10:50:00', 'checking Organiser', 'checking location', 'checking  contact', '2014-08-28 12:00:46', 0, 'No File Uploaded', 1, 1, NULL, 3),
(57, 'edit rudhra check', 'edit rudhra check description', '2014-08-27 10:15:00', '2014-08-27 10:50:00', 'edit rudhra org', 'edit rudhra', 'edit locat', '2014-08-27 09:26:27', 0, 'No File Uploaded', 4, 4, NULL, 4),
(58, 'edit rudhra check Copy', 'edit rudhra check description', '2014-08-27 10:15:00', '2014-08-27 10:50:00', 'edit rudhra org', 'edit rudhra', 'edit locat', '2014-08-27 09:26:27', 0, 'No File Uploaded', 4, 4, NULL, 4),
(59, 'DSTC Conference  Copy R.r', 'DSTC Conference edit', '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC org', 'Melbourne CBD', 'Jane Smith', '2014-08-28 12:37:18', 0, 'http://www.test.org/', 3, 5, 100007, 4);

-- --------------------------------------------------------

--
-- Table structure for table `conference_fb_section`
--

CREATE TABLE `conference_fb_section` (
  `Conference` smallint(5) unsigned NOT NULL,
  `Feedback_Section` smallint(5) unsigned NOT NULL,
  KEY `Conference_FB_Section_Conference_fk` (`Conference`),
  KEY `Conference_FB_Feedback_Section_fk` (`Feedback_Section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conference_section`
--

CREATE TABLE `conference_section` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Section_Title` varchar(100) NOT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Ordering` int(6) DEFAULT NULL,
  `Conference` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Conference_Section_Conference_fk` (`Conference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `conference_section`
--

INSERT INTO `conference_section` (`ID`, `Section_Title`, `Last_Updated`, `Ordering`, `Conference`) VALUES
(1, 'Surgical Decision Making', '2014-08-28 12:19:56', 1, 2),
(2, 'Surgical Techniques', '2014-08-23 13:33:40', 2, 50),
(3, 'Future Trauma Care', '2014-02-23 13:00:00', 1, 8),
(4, 'Psychological Techniques', '2014-02-23 13:00:00', 2, 9),
(5, 'Statistical Approach to Trauma', '2014-08-23 13:42:50', 1, 41),
(8, 'Title 1', '2014-08-24 04:35:28', 1, 50),
(10, 'jprs_44_section', '2014-08-26 10:12:58', 2, 44),
(11, '5 4 conference add', '2014-08-28 09:15:45', 5, 4),
(14, '45 8 dstc edit new section', '2014-08-28 10:01:32', 45, 8),
(15, 'Mid Year Conference Section', '2014-08-28 12:20:50', 2, 5),
(16, 'dstc confi', '2014-08-28 12:21:14', 3, 1),
(17, 'verify session', '2014-08-28 15:34:35', 2, 11),
(18, 'section title 2', '2014-08-29 01:50:32', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `conference_sponsor`
--

CREATE TABLE `conference_sponsor` (
  `Conference` smallint(5) unsigned NOT NULL,
  `Sponsor` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`Conference`,`Sponsor`),
  KEY `Conference_Sponsor_Sponsor_fk` (`Sponsor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conference_sponsor`
--

INSERT INTO `conference_sponsor` (`Conference`, `Sponsor`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Equipment_Name` varchar(30) NOT NULL,
  `Equipment_Type` varchar(60) NOT NULL,
  `Supplier_Webite` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`ID`, `Equipment_Name`, `Equipment_Type`, `Supplier_Webite`) VALUES
(1, 'CT Scanner', 'Scanner', ''),
(2, 'PET', 'Functional imaging technique', ''),
(3, 'MRI', 'Magnetic resonance imaging', 'www.magnetec.com'),
(4, 'Ultrasound', 'Imaging technique', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Feedback_Title` varchar(50) NOT NULL,
  `Feedback_Desc` varchar(250) DEFAULT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `Feedback_Title`, `Feedback_Desc`, `Last_Updated`) VALUES
(1, 'Testing Feedback', 'This is for testing purposes', '2014-02-23 23:10:10'),
(2, 'Feedback for Conference 8', 'This is for testing purposes', '2014-02-23 23:10:10'),
(3, 'Feedback for Conference 9', 'This is for testing purposes', '2014-02-23 23:10:10'),
(4, 'Feedback for Conference 10', 'This is for testing purposes', '2014-02-23 23:10:10'),
(5, 'Testing Feedback', 'This is for testing purposes', '2014-02-23 23:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_option`
--

CREATE TABLE `feedback_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Option_Number` varchar(5) DEFAULT NULL,
  `Option_Text` varchar(100) DEFAULT NULL,
  `Feedback_Question` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Option_Feedback_Question_fk` (`Feedback_Question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=225 ;

--
-- Dumping data for table `feedback_option`
--

INSERT INTO `feedback_option` (`ID`, `Option_Number`, `Option_Text`, `Feedback_Question`) VALUES
(1, '0001', 'Not confident in any case', 1),
(2, '0002', 'Confident only in some cases', 1),
(3, '0003', 'Confident in most cases', 1),
(4, '0004', 'Confident with every major trauma situation', 1),
(5, '0005', 'Uncomfortable with all areas of major trauma', 2),
(6, '0006', 'Confident & competent only in some areas of major trauma', 2),
(7, '0007', 'Confident & competent in most areas of major trauma', 2),
(8, '0008', 'Confident & competent with any major trauma situation', 2),
(9, '0009', 'No benefit', 3),
(10, '0010', 'Some Benefit', 3),
(11, '0011', 'Quite helpful', 3),
(12, '0012', 'Very beneficial', 3),
(13, '0013', 'Indispensable', 3),
(14, '0014', 'Not at all', 4),
(15, '0015', 'To a low degree', 4),
(16, '0016', 'To a moderate degree', 4),
(17, '0017', 'To a high degree', 4),
(18, '0018', 'To a very high degree', 4),
(19, '0019', 'Inappropriately low', 5),
(20, '0020', 'About right', 5),
(21, '0021', 'Inappropriately high', 5),
(22, '0022', 'No benefit', 6),
(23, '0023', 'Some Benefit', 6),
(24, '0024', 'Quite helpful', 6),
(25, '0025', 'Very beneficial', 6),
(26, '0026', 'Indispensable', 6),
(27, '0027', 'No benefit', 7),
(28, '0028', 'Some Benefit', 7),
(29, '0029', 'Quite helpful', 7),
(30, '0030', 'Very beneficial', 7),
(31, '0031', 'Indispensable', 7),
(32, '0032', 'No benefit', 8),
(33, '0033', 'Some Benefit', 8),
(34, '0034', 'Quite helpful', 8),
(35, '0035', 'Very beneficial', 8),
(36, '0036', 'Indispensable', 8),
(37, '0037', 'No benefit', 9),
(38, '0038', 'Some Benefit', 9),
(39, '0039', 'Quite helpful', 9),
(40, '0040', 'Very beneficial', 9),
(41, '0041', 'Indispensable', 9),
(42, '0042', 'No benefit', 10),
(43, '0043', 'Some Benefit', 10),
(44, '0044', 'Quite helpful', 10),
(45, '0045', 'Very beneficial', 10),
(46, '0046', 'Indispensable', 10),
(47, '0047', 'No benefit', 11),
(48, '0048', 'Some Benefit', 11),
(49, '0049', 'Quite helpful', 11),
(50, '0050', 'Very beneficial', 11),
(51, '0051', 'Indispensable', 11),
(52, '0052', 'No benefit', 12),
(53, '0053', 'Some Benefit', 12),
(54, '0054', 'Quite helpful', 12),
(55, '0055', 'Very beneficial', 12),
(56, '0056', 'Indispensable', 12),
(57, '0057', 'No benefit', 13),
(58, '0058', 'Some Benefit', 13),
(59, '0059', 'Quite helpful', 13),
(60, '0060', 'Very beneficial', 13),
(61, '0061', 'Indispensable', 13),
(62, '0062', 'Not at all', 14),
(63, '0063', 'Low degree', 14),
(64, '0064', 'Moderate degree', 14),
(65, '0065', 'High degree', 14),
(66, '0066', 'Very high degree', 14),
(67, '0067', 'Not at all', 15),
(68, '0068', 'Low degree', 15),
(69, '0069', 'Moderate degree', 15),
(70, '0070', 'High degree', 15),
(71, '0071', 'Very high degree', 15),
(72, '0072', 'Not at all', 16),
(73, '0073', 'Low degree', 16),
(74, '0074', 'Moderate degree', 16),
(75, '0075', 'High degree', 16),
(76, '0076', 'Very high degree', 16),
(77, '0077', 'Not at all', 17),
(78, '0078', 'Low degree', 17),
(79, '0079', 'Moderate degree', 17),
(80, '0080', 'High degree', 17),
(81, '0081', 'Very high degree', 17),
(82, '0082', 'Not at all', 18),
(83, '0083', 'Low degree', 18),
(84, '0084', 'Moderate degree', 18),
(85, '0085', 'High degree', 18),
(86, '0086', 'Very high degree', 18),
(87, '0087', 'Too Short', 19),
(88, '0088', 'About right', 19),
(89, '0089', 'Too long', 19),
(90, '0090', 'Of reasonable cost', 20),
(91, '0091', 'Far too expensive', 20),
(92, '0092', 'No response', 20),
(93, '0093', 'Case discussions/Interactive presentations', 21),
(94, '0094', 'Surgery in animal lab/live animal workshop useful', 21),
(95, '0095', 'Experienced instructors', 21),
(96, '0096', 'Giving out manuals early for pre-read', 21),
(97, '0097', 'Exposure to views of foreign faculty', 21),
(98, '0098', 'Other (Specify)', 21),
(99, '0099', 'Some leactures were too long', 22),
(100, '0100', 'Too many lectures cramped together', 22),
(101, '0101', 'Course too short', 22),
(102, '0102', 'Lectures too rushed', 22),
(103, '0103', 'Too many lectures', 22),
(104, '0104', 'Other (Specify)', 22),
(105, '0105', 'Yes', 24),
(106, '0106', 'No', 24),
(107, '0107', 'Not confident in any case', 25),
(108, '0108', 'Confident only in some cases', 25),
(109, '0109', 'Confident in most cases', 25),
(110, '0110', 'Confident with every major trauma situation', 25),
(111, '0111', 'Uncomfortable with all areas of major trauma', 27),
(112, '0112', 'Confident & competent only in some areas of major trauma', 27),
(113, '0113', 'Confident & competent in most areas of major trauma', 27),
(114, '0114', 'Confident & competent with any major trauma situation', 27),
(115, '0115', 'No benefit', 29),
(116, '0116', 'Some Benefit', 29),
(117, '0117', 'Quite helpful', 29),
(118, '0118', 'Very beneficial', 29),
(119, '0001', 'Not confident in any case', 31),
(120, '0002', 'Confident only in some cases', 31),
(121, '0003', 'Confident in most cases', 31),
(122, '0004', 'Confident with every major trauma situation', 31),
(123, '0005', 'Uncomfortable with all areas of major trauma', 32),
(124, '0006', 'Confident & competent only in some areas of major trauma', 32),
(125, '0007', 'Confident & competent in most areas of major trauma', 32),
(126, '0008', 'Confident & competent with any major trauma situation', 32),
(127, '0009', 'No benefit', 33),
(128, '0010', 'Some Benefit', 33),
(129, '0011', 'Quite helpful', 33),
(130, '0012', 'Very beneficial', 33),
(131, '0013', 'Indispensable', 33),
(132, '0014', 'Not at all', 34),
(133, '0015', 'To a low degree', 34),
(134, '0016', 'To a moderate degree', 34),
(135, '0017', 'To a high degree', 34),
(136, '0018', 'To a very high degree', 34),
(137, '0019', 'Inappropriately low', 35),
(138, '0020', 'About right', 35),
(139, '0021', 'Inappropriately high', 35),
(140, '0022', 'No benefit', 36),
(141, '0023', 'Some Benefit', 36),
(142, '0024', 'Quite helpful', 36),
(143, '0025', 'Very beneficial', 36),
(144, '0026', 'Indispensable', 36),
(145, '0027', 'No benefit', 37),
(146, '0028', 'Some Benefit', 37),
(147, '0029', 'Quite helpful', 37),
(148, '0030', 'Very beneficial', 37),
(149, '0031', 'Indispensable', 37),
(150, '0032', 'No benefit', 38),
(151, '0033', 'Some Benefit', 38),
(152, '0034', 'Quite helpful', 38),
(153, '0035', 'Very beneficial', 38),
(154, '0036', 'Indispensable', 38),
(155, '0037', 'No benefit', 39),
(156, '0038', 'Some Benefit', 39),
(157, '0039', 'Quite helpful', 39),
(158, '0040', 'Very beneficial', 39),
(159, '0041', 'Indispensable', 39),
(160, '0042', 'No benefit', 40),
(161, '0043', 'Some Benefit', 40),
(162, '0044', 'Quite helpful', 40),
(163, '0045', 'Very beneficial', 40),
(164, '0046', 'Indispensable', 40),
(165, '0047', 'No benefit', 41),
(166, '0048', 'Some Benefit', 41),
(167, '0049', 'Quite helpful', 41),
(168, '0050', 'Very beneficial', 41),
(169, '0051', 'Indispensable', 41),
(170, '0052', 'No benefit', 42),
(171, '0053', 'Some Benefit', 42),
(172, '0054', 'Quite helpful', 42),
(173, '0055', 'Very beneficial', 42),
(174, '0056', 'Indispensable', 42),
(175, '0057', 'No benefit', 43),
(176, '0058', 'Some Benefit', 43),
(177, '0059', 'Quite helpful', 43),
(178, '0060', 'Very beneficial', 43),
(179, '0061', 'Indispensable', 43),
(180, '0062', 'Not at all', 44),
(181, '0063', 'Low degree', 44),
(182, '0064', 'Moderate degree', 44),
(183, '0065', 'High degree', 44),
(184, '0066', 'Very high degree', 44),
(185, '0067', 'Not at all', 45),
(186, '0068', 'Low degree', 45),
(187, '0069', 'Moderate degree', 45),
(188, '0070', 'High degree', 45),
(189, '0071', 'Very high degree', 45),
(190, '0072', 'Not at all', 46),
(191, '0073', 'Low degree', 46),
(192, '0074', 'Moderate degree', 46),
(193, '0075', 'High degree', 46),
(194, '0076', 'Very high degree', 46),
(195, '0077', 'Not at all', 47),
(196, '0078', 'Low degree', 47),
(197, '0079', 'Moderate degree', 47),
(198, '0080', 'High degree', 47),
(199, '0081', 'Very high degree', 47),
(200, '0082', 'Not at all', 48),
(201, '0083', 'Low degree', 48),
(202, '0084', 'Moderate degree', 48),
(203, '0085', 'High degree', 48),
(204, '0086', 'Very high degree', 48),
(205, '0087', 'Too Short', 49),
(206, '0088', 'About right', 49),
(207, '0089', 'Too long', 49),
(208, '0090', 'Of reasonable cost', 50),
(209, '0091', 'Far too expensive', 50),
(210, '0092', 'No response', 50),
(211, '0093', 'Case discussions/Interactive presentations', 51),
(212, '0094', 'Surgery in animal lab/live animal workshop useful', 51),
(213, '0095', 'Experienced instructors', 51),
(214, '0096', 'Giving out manuals early for pre-read', 51),
(215, '0097', 'Exposure to views of foreign faculty', 51),
(216, '0098', 'Other (Specify)', 51),
(217, '0099', 'Some leactures were too long', 52),
(218, '0100', 'Too many lectures cramped together', 52),
(219, '0101', 'Course too short', 52),
(220, '0102', 'Lectures too rushed', 52),
(221, '0103', 'Too many lectures', 52),
(222, '0104', 'Other (Specify)', 52),
(223, '0105', 'Yes', 54),
(224, '0106', 'No', 54);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_question`
--

CREATE TABLE `feedback_question` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question_Number` varchar(5) NOT NULL,
  `Question_Text` varchar(200) NOT NULL,
  `Type` smallint(4) NOT NULL,
  `Question_Type` char(10) DEFAULT NULL,
  `Feedback_Section` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Question_Question_Type_fk` (`Question_Type`),
  KEY `Feedback_Question_Feedback_Section_fk` (`Feedback_Section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `feedback_question`
--

INSERT INTO `feedback_question` (`ID`, `Question_Number`, `Question_Text`, `Type`, `Question_Type`, `Feedback_Section`) VALUES
(1, '0001', 'Confidence level dealing with major trauma prior to the DSTC', 1, 'Multi', 1),
(2, '0002', 'Confidence level after having completed the dstc', 1, 'Multi', 1),
(3, '0003', 'Regarding your overall experience of the course, the DSTC was of:', 1, 'Multi', 1),
(4, 'Q004', 'Regarding course objectives, to what degree were they clear & appropriate:', 1, 'Multi', 1),
(5, 'Q005', 'Regarding course workload it was:', 1, 'Multi', 1),
(6, 'Q006', 'Regarding course content, how do you rate the importance of Surgical Descision Making:', 1, 'Multi', 1),
(7, 'Q007', 'Regarding course content, how do you rate the importance of Surgical Technique Theory:', 1, 'Multi', 1),
(8, 'Q008', 'How valuable was the Manual?', 1, 'Multi', 1),
(9, 'Q009', 'How valuable was the DVD Material?', 1, 'Multi', 1),
(10, 'Q010', 'How valuable was the Lectures?', 1, 'Multi', 1),
(11, 'Q011', 'How valuable was the Lectures?', 1, 'Multi', 1),
(12, 'Q012', 'How valuable was the Labs?', 1, 'Multi', 1),
(13, 'Q013', 'How valuable was the Case Discussions / Strategic Thinking / Problem Solving?', 1, 'Multi', 1),
(14, 'Q014', 'Surgical Descision Making Sessions - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 1),
(15, 'Q015', 'Practical Workshops - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 1),
(16, 'Q016', 'Problem Solving open forums & discussion groups - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 1),
(17, 'Q017', 'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1, 'Multi', 1),
(18, 'Q017', 'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1, 'Multi', 1),
(19, 'Q018', 'How useful was the ongoing feedback you recieved from DSTC instructors?', 1, 'Multi', 1),
(20, 'Q020', 'Regarding course value for money, it was:', 1, 'Multi', 1),
(21, 'Q021', 'The best features of the course were: (circle as many as necessary)', 1, 'Multi', 1),
(22, 'Q022', 'The worst features of the course were:', 1, 'Multi', 1),
(23, 'Q023', 'Suggested Improvements', 1, 'Multi', 1),
(24, 'Q024', 'Would you recommend this course to others?', 1, 'Multi', 1),
(25, '0025', 'Dealing with light trauma prior to the DSTC', 2, 'Multi', 7),
(26, '0026', ' Regarding patient response after having the dstc', 1, 'Multi', 7),
(27, '0027', 'Regarding whole experience of the course:', 2, 'Multi', 8),
(28, 'Q028', 'Regarding course objectives, to what degree were they clear & appropriate:', 1, 'Multi', 8),
(29, 'Q029', 'Regarding course, how to look after patients who has serious trauma after seeing them:', 2, 'Multi', 9),
(30, 'Q030', 'Regarding course content, what is your background to make Surgical Descision:', 1, 'Multi', 9),
(31, '0001', 'Confidence level dealing with major trauma prior to the DSTC', 1, 'Multi', 10),
(32, '0002', 'Confidence level after having completed the dstc', 1, 'Multi', 10),
(33, '0003', 'Regarding your overall experience of the course, the DSTC was of:', 1, 'Multi', 10),
(34, 'Q004', 'Regarding course objectives, to what degree were they clear & appropriate:', 1, 'Multi', 10),
(35, 'Q005', 'Regarding course workload it was:', 1, 'Multi', 10),
(36, 'Q006', 'Regarding course content, how do you rate the importance of Surgical Descision Making:', 1, 'Multi', 10),
(37, 'Q007', 'Regarding course content, how do you rate the importance of Surgical Technique Theory:', 1, 'Multi', 10),
(38, 'Q008', 'How valuable was the Manual?', 1, 'Multi', 10),
(39, 'Q009', 'How valuable was the DVD Material?', 1, 'Multi', 10),
(40, 'Q010', 'How valuable was the Lectures?', 1, 'Multi', 10),
(41, 'Q011', 'How valuable was the Lectures?', 1, 'Multi', 10),
(42, 'Q012', 'How valuable was the Labs?', 1, 'Multi', 10),
(43, 'Q013', 'How valuable was the Case Discussions / Strategic Thinking / Problem Solving?', 1, 'Multi', 10),
(44, 'Q014', 'Surgical Descision Making Sessions - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 10),
(45, 'Q015', 'Practical Workshops - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 10),
(46, 'Q016', 'Problem Solving open forums & discussion groups - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 10),
(47, 'Q017', 'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1, 'Multi', 10),
(48, 'Q017', 'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1, 'Multi', 10),
(49, 'Q018', 'How useful was the ongoing feedback you recieved from DSTC instructors?', 1, 'Multi', 10),
(50, 'Q020', 'Regarding course value for money, it was:', 1, 'Multi', 10),
(51, 'Q021', 'The best features of the course were: (circle as many as necessary)', 1, 'Multi', 10),
(52, 'Q022', 'The worst features of the course were:', 1, 'Multi', 10),
(53, 'Q023', 'Suggested Improvements', 1, 'Multi', 10),
(54, 'Q024', 'Would you recommend this course to others?', 1, 'Multi', 10),
(55, 'Q055', 'delete question', 2, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_section`
--

CREATE TABLE `feedback_section` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Section_Start` datetime NOT NULL,
  `Section_End` datetime NOT NULL,
  `Section_Title` varchar(50) NOT NULL,
  `Section_Desc` varchar(250) DEFAULT NULL,
  `Type` enum('Conference','Session','Demographic') NOT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Feedback` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Section_Feedback_fk` (`Feedback`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `feedback_section`
--

INSERT INTO `feedback_section` (`ID`, `Section_Start`, `Section_End`, `Section_Title`, `Section_Desc`, `Type`, `Last_Updated`, `Feedback`) VALUES
(1, '2014-12-25 12:50:00', '2014-12-25 13:50:00', 'Section A', 'Confidence levels & Overall experience of course', 'Demographic', '2014-02-23 23:10:10', 1),
(2, '2014-12-25 13:50:00', '2014-12-25 14:50:00', 'Section B', 'Curriculum', 'Session', '2014-02-23 23:10:10', 1),
(3, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section C', 'Teaching materials & methods', 'Conference', '2014-02-23 23:10:10', 1),
(4, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section D', 'Teaching outcomes', 'Session', '2014-02-23 23:10:10', 1),
(5, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section E', 'Assessment & Feedback', 'Demographic', '2014-02-23 23:10:10', 1),
(6, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section E', 'General Comments', 'Demographic', '2014-02-23 23:10:10', 1),
(7, '2014-12-25 12:50:00', '2014-12-25 13:50:00', 'Section TYPE-I', 'Dealing with foreign patients', 'Demographic', '2014-02-23 23:10:10', 2),
(8, '2014-12-25 13:50:00', '2014-12-25 14:50:00', 'Section TYPE-II', 'Complex system and brain behaviour', 'Session', '2014-02-23 23:10:10', 3),
(9, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section TYPE-III', 'Statistical Research method', 'Session', '2014-02-23 23:10:10', 4),
(10, '2014-12-25 12:50:00', '2014-12-25 13:50:00', 'Section A', 'Confidence levels & Overall experience of course', 'Demographic', '2014-02-23 23:10:10', 5),
(11, '2014-12-25 13:50:00', '2014-12-25 14:50:00', 'Section B', 'Curriculum', 'Session', '2014-02-23 23:10:10', 5),
(12, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section C', 'Teaching materials & methods', 'Conference', '2014-02-23 23:10:10', 5),
(13, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section D', 'Teaching outcomes', 'Session', '2014-02-23 23:10:10', 5),
(14, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section E', 'Assessment & Feedback', 'Demographic', '2014-02-23 23:10:10', 5),
(15, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section E', 'General Comments', 'Demographic', '2014-02-23 23:10:10', 5);

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Map_Directory` varchar(100) NOT NULL,
  `FilePath` varchar(20) NOT NULL,
  `Conference` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Map_Conference_fk` (`Conference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`ID`, `Map_Directory`, `FilePath`, `Conference`) VALUES
(1, 'img/', 'map_a.jpg', 1),
(2, 'img/', 'map_b.jpg', 2),
(3, 'img/map/', 'map_c.jpg', 3),
(4, 'img/map/', 'map_d.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `polling`
--

CREATE TABLE `polling` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Polling_Question` varchar(150) NOT NULL,
  `Session` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Session_fk` (`Session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `polling`
--

INSERT INTO `polling` (`ID`, `Polling_Question`, `Session`) VALUES
(1, 'Key Decision Point 1', 7),
(2, 'Key Decision Point 2', 7),
(6, 'Key Decision Point 1', 14),
(7, 'Key Decision Point 2', 14),
(8, 'Key Decision Point 3: Which is NOT an appropriate strategy?', 14),
(9, 'Key Decision Point 1', 14),
(22, 'Dstc surgical Case', 1),
(23, 'njknkjnkj', 18);

-- --------------------------------------------------------

--
-- Table structure for table `polling_option`
--

CREATE TABLE `polling_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Option_Text` varchar(80) NOT NULL,
  `Polling` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Option_Polling_fk` (`Polling`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `polling_option`
--

INSERT INTO `polling_option` (`ID`, `Option_Text`, `Polling`) VALUES
(1, '1. Laparotomy', 1),
(2, '2. FAST', 1),
(3, '3. DPL', 1),
(4, '4. Thoracotomy', 1),
(5, '5. CT Head, Neck, Chest, Abdo', 1),
(6, '1. Laparotomy', 2),
(7, '2. Thoracotomy', 2),
(8, '3. 2nd Chest Tube', 2),
(9, '4. Admit ICU', 2),
(10, '5. Cardiothoracic Surgery Consultation', 2),
(26, '1. FAST', 6),
(27, '2. Left ICC', 6),
(28, '3. 2nd IV Line', 6),
(29, '4. EERT', 6),
(30, '5. CXR', 6),
(31, '1. EERT then OR', 7),
(32, '2. Resus ++ then CT', 7),
(33, '3. Resus ++ then OR', 7),
(34, '4. Definitive thoracotomy then ICU', 7),
(35, '1. Relieve cardiac tamponade', 8),
(36, '2. Control cardiac laceration', 8),
(37, '3. Suture bleeding intercostals vessels', 8),
(38, '4. Manual cardiac compression', 8),
(39, '5. Control lung hilum', 8),
(40, '6. Primary repair of major vessels', 8),
(41, '7. X-clamp descending aorta', 8),
(42, '8. Tamponade pleural apex', 8),
(43, '1. CTA neck chest?', 9),
(44, '2. OR?', 9),
(45, '3. CXR?', 9),
(46, '4. Local exploration (see if platysma breached)?', 9),
(47, '5. Suture discharge?', 9),
(99, '1', 22),
(100, '2', 22),
(101, '3', 22),
(102, 'njk', 23),
(103, 'mkmkl', 23);

-- --------------------------------------------------------

--
-- Table structure for table `polling_response`
--

CREATE TABLE `polling_response` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Medical_Profession` varchar(40) NOT NULL,
  `Polling_Option` smallint(5) unsigned NOT NULL,
  `Profile_Id` char(10) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Responses_Polling_Option_fk` (`Polling_Option`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `polling_response`
--

INSERT INTO `polling_response` (`ID`, `Medical_Profession`, `Polling_Option`, `Profile_Id`) VALUES
(1, 'Anesthesiology', 1, 'AABCCEEDAA'),
(2, 'Cardiovascular Medicine', 2, 'AABCCEEDAA'),
(3, 'Endocrinology', 3, 'AABCCEEDAA'),
(4, 'Forceinology', 4, 'AABCCEEDAA'),
(5, 'Endocrinology', 5, 'AABCCEEDAA'),
(6, 'Anesthesiology', 6, 'AADDCCCAAB'),
(7, 'Cardiovascular Medicine', 7, 'AADDCCCAAB'),
(8, 'Endocrinology', 8, 'AADDCCCAAB'),
(9, 'Forceinology', 9, 'AADDCCCAAB'),
(11, 'Anesthesiology', 10, 'ABBBCCAAAB'),
(29, 'Forceinology', 26, 'AAAAAAAAAA'),
(30, 'Endocrinology', 28, 'AAAAAAAAAA'),
(31, 'Anesthesiology', 29, 'BBBBBBBBBB'),
(32, 'Cardiovascular Medicine', 29, 'BBBBBBBBBB'),
(33, 'Endocrinology', 30, 'BBBBBBBBBB'),
(34, 'Forceinology', 31, 'BBBBBBBBBB'),
(35, 'Endocrinology', 32, 'BBBBBBBBBB'),
(36, 'Anesthesiology', 31, 'DDDDDDDDDD'),
(37, 'Cardiovascular Medicine', 32, 'DDDDDDDDDD'),
(38, 'Endocrinology', 33, 'DDDDDDDDDD'),
(39, 'Forceinology', 34, 'DDDDDDDDDD'),
(40, 'Endocrinology', 35, 'DDDDDDDDDD'),
(41, 'Anesthesiology', 36, 'AABCCEEDAA'),
(42, 'Cardiovascular Medicine', 37, 'AABCCEEDAA'),
(43, 'Endocrinology', 38, 'AABCCEEDAA'),
(44, 'Forceinology', 40, 'AABCCEEDAA'),
(45, 'Endocrinology', 41, 'AABCCEEDAA'),
(46, 'Anesthesiology', 41, 'AABCCEEDAA'),
(47, 'Cardiovascular Medicine', 42, 'AABCCEEDAA'),
(48, 'Endocrinology', 43, 'AABCCEEDAA'),
(49, 'Forceinology', 44, 'AABCCEEDAA'),
(50, 'Endocrinology', 45, 'AABCCEEDAA'),
(51, 'Anesthesiology', 46, 'AABCCEEDAA'),
(52, 'Cardiovascular Medicine', 47, 'AABCCEEDAA');

-- --------------------------------------------------------

--
-- Table structure for table `presenter`
--

CREATE TABLE `presenter` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(20) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Organisation` varchar(150) NOT NULL,
  `Medical_Field` varchar(50) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `Qualification` varchar(100) NOT NULL,
  `Short_Bio` varchar(250) NOT NULL,
  `Filepath` varchar(100) DEFAULT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `presenter`
--

INSERT INTO `presenter` (`ID`, `Title`, `First_Name`, `Last_Name`, `Organisation`, `Medical_Field`, `Position`, `Qualification`, `Short_Bio`, `Filepath`, `Last_Updated`) VALUES
(1, 'Dr', 'Walter L.', 'Biffl', 'Denver Health Medical Center', 'Surgery & Patient Safety/Quality', 'Head of Anatomy', 'MD', 'Dr Oak is chief of medicine at the Handless School of Anatomy', 'c:/games/MyLittlePony', '2014-02-24 13:00:00'),
(2, 'Dr', 'Phillip', 'Antippa', 'Royal Melbourne Hospital and Peter MacCallum Cancer Centre', 'Cardiothoracic Surgeon', 'Chairman', 'MD', 'Dr Evil was frozen till the year of 1997', 'http://www.evil.com', '2014-02-24 13:00:00'),
(3, 'Dr', 'Peter', 'Bautz', 'Royal Adelaide Hospital', 'Trauma Surgeon', 'Head of Research ', 'MchD', 'Dr Octopus was the prime inventor of Octobots', 'http://www.drock.com', '2014-02-24 13:00:00'),
(4, 'Dr', 'Grant', 'Christey', 'Waikato Hospital and Midland Regional Trauma System', 'General Surgeon', 'Director of Trauma', 'MD', 'trained in New Zealand as a general surgeon and has a strong and long-standing interest in general surgery and trauma.', '3.jpg', '2014-02-24 13:00:00'),
(5, 'Prof', 'Stephen', 'Deane', 'University of Newcastle, John Hunter Hospital, Hunter NEw England LHD', 'Surgery', 'Director of Trauma', 'MD', 'He has been recognised professionally for his contributions to advancement of Trauma Care', '3.jpg', '2014-02-24 13:00:00'),
(6, 'Prof', 'Russell', 'Gruen', 'The Alfred and Monash University', 'Surgery', 'Surgeon', 'PhD', 'He now heads an active teaching and research program.', '1.jpg', '2014-02-24 13:00:00'),
(7, 'Dr', 'Annette', 'Holian', 'National Critical Care and Trauma response Centre', 'Orthopaedic and Trauma Surgeon', 'Head of Anatomy', 'MD', 'Dr Oak is chief of medicine at the Handless School of Anatomy', 'c:/games/MyLittlePony', '2014-02-24 13:00:00'),
(8, 'Mister', 'Rondhir', 'Jithoo', 'Consults at Epworth Group Hospitals', 'Cranial Trauma', 'Consultant', 'MD', 'He has a background of trauma experience and cranial trauma especially.', '3.jpg', '2014-02-24 13:00:00'),
(9, 'Dr', 'Bhadu', 'Kavar', 'The Royal Melbourne Hospital', 'Neurosurgeon', 'Consultant', 'MD', 'He has been an instructor for DSTC Melbourne since its commencement in 1998.', '0.jpg', '2014-02-24 13:00:00'),
(10, 'Dr', 'Christian', 'Kenfield', 'Australian Army', 'Trauma and Hepatobillary/Surgical Oncology.', 'Major in the Australian Army', '', 'Has served on operations and exercises on Thursday Island, Timor Leste and Solomon Islands and Papua New Guinea.', '1.jpg', '2014-02-24 13:00:00'),
(11, 'A/Prof', 'Martin', 'Richardson', 'University of Melbourne & Monash University', 'Clinical Practise', 'Associate Professor at both University of Melbourne and Monash University.', 'PhD', 'He is on the research board of the VOTOR and is an active member of the RANR LCDR.', '2.jpg', '2014-02-24 13:00:00'),
(12, 'Dr', 'Ben', 'Thomson', 'Royal Melbourne Hospital', 'Trauma', 'HPB and Trauma surgeon', 'MD', 'He has been a member of the DSTC faculty for the last 5 years.', '3.jpg', '2014-02-24 13:00:00'),
(13, 'Dr', 'Martin', 'Wullschleger', 'Royal Brisbane & Womens Hospital', 'General and Trauma surgery', 'Surgeon', 'PhD', 'is a swiss trained General and Trauma surgeon.', '4.jpg', '2014-02-24 13:00:00'),
(14, 'Dr', 'Robert', 'Maningham', 'Epworth Camberwell', 'Surgery', 'Surgeon', 'Director of Surgery', 'is a  is chief of surgery at the School of Camberwell Surgery.', 'img/presenter/1.jpg', '2014-02-24 13:00:00'),
(15, 'Dr', 'George', 'Wills', 'Epworth Eastern', 'General  Surgery', 'Surgeonf ', 'phD', 'He is a trained General and Trauma surgeon.', 'img/presenter/2.jpg', '2014-02-24 13:00:00'),
(16, 'Mr', 'Ann', 'Seng', 'JPRS', 'Surgery', 'Proffessor', 'MD', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s,', 'No File Uploaded', '2014-08-26 01:03:40'),
(17, 'Dr', 'Dr', 'dr', 'DSTC', 'Surgery', 'Proffessor', 'MD', 'my name', 'No File Uploaded', '2014-08-26 12:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `Question_Type` char(10) NOT NULL,
  `Type_Description` char(100) DEFAULT NULL,
  PRIMARY KEY (`Question_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`Question_Type`, `Type_Description`) VALUES
('Long', 'Expected to take over 10 minutes to explain'),
('Multi', 'Far to complex to explain earthling'),
('Short', 'Expected to take under 10 minutes to explain'),
('Specific', 'An in depth question that requires previous experience in the field'),
('VShort', 'Yes or No');

-- --------------------------------------------------------

--
-- Table structure for table `reponse_text`
--

CREATE TABLE `reponse_text` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question_Reponse` varchar(250) NOT NULL,
  `Feedback_Question` smallint(5) unsigned NOT NULL,
  `Feedback_Response` smallint(5) unsigned NOT NULL,
  `Profile_Id` char(10) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Reponse_Text_Feedback_Question_fk` (`Feedback_Question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `reponse_text`
--

INSERT INTO `reponse_text` (`ID`, `Question_Reponse`, `Feedback_Question`, `Feedback_Response`, `Profile_Id`) VALUES
(1, 'QR00000', 1, 1, 'AABCCEEDAA'),
(2, 'QR00001', 2, 2, 'AADDCCCAA'),
(3, 'QR00002', 3, 3, 'ABBBCCAAAB'),
(4, 'QR00003', 4, 4, 'AADDCCCAA'),
(5, 'QR00004', 5, 5, 'AABCCEEDAA'),
(6, 'QR00005', 26, 6, 'DDDDDEACCB'),
(7, 'QR00006', 30, 7, 'DDDDDEACCB'),
(8, 'QR00007', 28, 8, 'ABBBCCAAAB');

-- --------------------------------------------------------

--
-- Table structure for table `response_option`
--

CREATE TABLE `response_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Feedback_Response` smallint(5) unsigned NOT NULL,
  `Feedback_Option` smallint(5) unsigned NOT NULL,
  `Profile_Id` char(10) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Response_Option_Feedback_Option_fk` (`Feedback_Option`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `response_option`
--

INSERT INTO `response_option` (`ID`, `Feedback_Response`, `Feedback_Option`, `Profile_Id`) VALUES
(3, 3, 3, 'AABCCEEDAA'),
(4, 4, 4, 'AABCCEEDAA'),
(6, 6, 107, 'AABCCEEDAA'),
(7, 7, 108, 'AABCCEEDAA'),
(8, 8, 109, 'AABCCEEDAA'),
(9, 6, 111, 'ABBBCCAAAB'),
(10, 7, 112, 'ABBBCCAAAB'),
(11, 8, 113, 'ABBBCCAAAB'),
(12, 6, 116, 'AABCCEEDAA'),
(13, 7, 117, 'DDDDDEACCB'),
(14, 8, 118, 'DDDDDEACCB');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(400) DEFAULT NULL,
  `Start_Time` datetime NOT NULL,
  `End_Time` datetime NOT NULL,
  `Room_Location` varchar(20) NOT NULL,
  `Session_Chairperson` varchar(50) DEFAULT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Polling_Available` tinyint(1) NOT NULL,
  `Polling_Open` tinyint(1) NOT NULL,
  `Conference_Section` smallint(5) unsigned NOT NULL,
  `Feedback` smallint(5) unsigned NOT NULL,
  `Feedback_Section` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Session_Conference_Section_fk` (`Conference_Section`),
  KEY `Session_Feedback_fk` (`Feedback`),
  KEY `Session_Feedback_Section_fk` (`Feedback_Section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`ID`, `Title`, `Description`, `Start_Time`, `End_Time`, `Room_Location`, `Session_Chairperson`, `Last_Updated`, `Polling_Available`, `Polling_Open`, `Conference_Section`, `Feedback`, `Feedback_Section`) VALUES
(1, 'Case Presentation Decision Making (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2014-11-30 07:50:00', '2014-11-30 08:00:00', 'Auditorium', 'P Danne', '2014-08-24 07:17:04', 0, 1, 10, 1, 1),
(2, 'Surgical Decision Making in Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium', 'P Danne', '2014-08-24 06:19:07', 0, 0, 2, 1, 1),
(4, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:30:00', '2012-11-30 08:40:00', 'Auditorium', 'P Danne', '2014-08-23 14:38:26', 0, 0, 4, 1, 1),
(5, 'Blunt Abdominal Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:40:00', '2012-11-30 08:55:00', 'Auditorium', 'P Danne', '2014-08-24 06:19:12', 0, 0, 3, 1, 1),
(6, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:55:00', '2012-11-30 09:05:00', 'Auditorium', 'P Danne', '2014-08-24 06:19:17', 0, 0, 2, 1, 1),
(7, 'Blunt Thoracic Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:05:00', '2012-11-30 09:20:00', 'Auditorium', 'P Danne', '2014-08-23 14:38:46', 0, 0, 5, 1, 1),
(8, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:20:00', '2012-11-30 09:35:00', 'Auditorium', 'P Danne', '2014-08-28 14:20:35', 0, 0, 16, 1, 1),
(10, 'Morning Tea', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:45:00', '2012-11-30 10:15:00', 'Auditorium', 'P Danne', '2014-08-23 14:39:18', 0, 0, 5, 1, 1),
(11, 'Penetration Abdominal Trauma overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:15:00', '2012-11-30 10:30:00', 'Auditorium', 'P Danne', '2014-08-24 06:19:45', 0, 0, 8, 1, 1),
(13, 'ED Tracheotomy Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:40:00', '2012-11-30 10:55:00', 'Auditorium', 'P Danne', '2014-08-24 07:17:30', 0, 0, 10, 1, 1),
(14, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:55:00', '2012-11-30 11:10:00', 'Auditorium', 'P Danne', '2014-08-23 14:39:39', 0, 0, 4, 1, 1),
(15, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium', 'P Danne', '2014-08-23 14:39:46', 0, 0, 5, 1, 1),
(18, 'Title', 'Desc', '2014-08-26 02:20:00', '2014-08-26 02:40:00', 'Room1', 'fffgg', '2014-08-26 01:27:38', 0, 0, 1, 1, 2),
(19, 'jprs_44_section', 'jprs_44_section\r\njprs_44_section\r\njprs_44_section\r\njprs_44_section\r\n', '2014-08-26 02:30:00', '2014-08-26 02:50:00', 'jprs_44_section_Room', 'jprs_44_section_Chair', '2014-08-26 01:30:01', 0, 0, 10, 1, 10),
(20, 'Title 10 jprs 44 section feedbackSection', 'Description 10 jprs 44 section feedbackSection\r\n10 jprs 44 section feedbackSection', '2014-08-30 02:35:00', '2014-10-05 02:05:00', 'Room 10 jprs 44 sect', 'Chair', '2014-08-26 01:53:44', 0, 0, 8, 1, 1),
(21, 'Case Presentation (Interactive)', 'session edit done by rudhra', '2014-11-30 09:20:00', '2014-11-30 09:35:00', 'Auditorium', 'P Danne', '2014-08-28 14:26:33', 0, 0, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `session_equipment`
--

CREATE TABLE `session_equipment` (
  `Equipment` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`Equipment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_equipment`
--

INSERT INTO `session_equipment` (`Equipment`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `session_presenter`
--

CREATE TABLE `session_presenter` (
  `Presenter` smallint(5) unsigned NOT NULL,
  `Session` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`Presenter`,`Session`),
  KEY `Session_Presenter_Session_fk` (`Session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_presenter`
--

INSERT INTO `session_presenter` (`Presenter`, `Session`) VALUES
(1, 1),
(2, 2),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(1, 11),
(3, 13),
(4, 14),
(5, 15),
(3, 18),
(10, 19),
(4, 20),
(13, 20),
(15, 21);

-- --------------------------------------------------------

--
-- Table structure for table `session_question`
--

CREATE TABLE `session_question` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question` varchar(400) NOT NULL,
  `Accepted` tinyint(1) NOT NULL,
  `Session` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Session_Question_Session_fk` (`Session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `session_question`
--

INSERT INTO `session_question` (`ID`, `Question`, `Accepted`, `Session`) VALUES
(1, 'Why do my legs feel itchy after a hot shower?', 0, 1),
(2, 'My gums sometimes bleed when I brush my teeth, could this be related to.. dredging Port Phillip Bay?', 1, 2),
(4, 'Why is my undies so tight?', 1, 4),
(5, 'Why have a handle on a enter door?', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `FilePath` varchar(100) DEFAULT NULL,
  `Short_Desc` varchar(250) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Session_Equipment` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Sponsor_Session_Equipment_fk` (`Session_Equipment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`ID`, `Name`, `FilePath`, `Short_Desc`, `URL`, `Last_Updated`, `Session_Equipment`) VALUES
(1, 'Royal Australasian College of Surgeons', 'images/life.jpg', 'Formed in 1927 the Royal Australasian Collage of surgeons is a non-profit organisation.', 'http://www.surgeons.org/', '2014-02-24 13:00:00', 1),
(2, 'IATSIC', 'images/death.jpg', 'International Association for Trauma Surgery and Intensive Care', 'http://www.iatsic.org/', '2014-02-24 13:00:00', 2),
(3, 'Covidien', 'images/the.jpg', 'Covidien is a $10 billion global healthcare products leader dedicated to innovation and long-term growth.', 'http://www.covidien.com/covidien/pages.aspx', '2014-02-24 13:00:00', 3),
(4, 'KCI', 'images/same.jpg', 'Our proprietary KCI negative pressure technologies have revolutionized the way in which caregivers treat a wide variety of wound types', 'http://www.kci-medical.com.au/AU-ENG/home', '2014-02-24 13:00:00', 4),
(5, 'Australasian College of Surgeons', 'images/he.jpg', 'established in 1987, specilized for Surgeon .', 'http://www.surgeons.org/', '2014-02-24 13:00:00', 1),
(6, 'IAS', 'images/did.jpg', 'International Association of Surgeon', 'http://www.ias.org/', '2014-02-24 13:00:00', 2),
(7, 'Allianz', 'images/care.jpg', 'Allianz is a Australian healthcare industry leader .', 'http://www.allianz.com/', '2014-02-24 13:00:00', 3),
(8, '34', 'No File Uploaded', '35', 'www.53.com', '2014-06-05 01:27:24', 1),
(9, 'Caue', 'UPLOADED_FILES/Sponsor/id.jpg', 'Test', 'www.tes.com', '2014-08-16 01:14:58', 2),
(10, 'test', 'UPLOADED_FILES/Sponsor/id.jpg', 'test', 'www.test.com', '2014-08-16 01:22:17', 2),
(12, 'fgfg', 'No File Uploaded', 's', 'www.w5.com', '2014-08-16 01:29:47', 1),
(13, 'w', 'File Uploaded', 'w', 'www.1.com', '2014-08-26 15:14:12', 2),
(14, 'Abc', 'No File Uploaded', 'abc', 'www.1a-b.com', '2014-08-26 15:20:51', 1),
(15, 'Abc', 'No File Uploaded', 'abc', 'www.1.com', '2014-07-30 07:57:42', 1),
(16, 'ABC', 'File Uploaded', 'abc and company', 'www.abc', '2014-08-15 09:19:01', 2),
(17, 'new', 'No File Uploaded', 'sponsor', 'www.axc.com', '2014-08-26 15:21:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `First_Name` char(25) NOT NULL,
  `Last_Name` char(30) NOT NULL,
  `User_name` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` char(32) NOT NULL,
  `Access_Level` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `First_Name`, `Last_Name`, `User_name`, `Email`, `Password`, `Access_Level`) VALUES
(1, 'Admin', 'User', 'Admin', 'rudhrakumar@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63', '1'),
(2, 'Rudhrakumar', 'Gurunathan', 'Rudhra', 'rudhraraji@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63', '0'),
(3, 'Paulo', 'Goncalves', 'Paul', 'phsgjc@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63', '0'),
(4, 'Shuhei', 'Nakahodo', 'Shuhei', 'snakahodo55442@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63', '0');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Name` char(30) NOT NULL,
  `Company` char(10) DEFAULT NULL,
  `Street` char(25) NOT NULL,
  `Suburb` char(10) NOT NULL,
  `Post_Code` smallint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`ID`, `Name`, `Company`, `Street`, `Suburb`, `Post_Code`) VALUES
(1, 'Epworth Richmond', 'Epworth', '89 Bridge Rd', 'Richmond', 3000),
(2, 'Holmesglen', 'Epworth', '22 Smiths St', 'Morrabbin', 3590),
(3, 'Hawthorne Hospital', 'Epworth', '10 Sturt St', 'Hawthorne', 3333),
(4, 'Albury Medical Centre', 'Epworth', '45 Medical St', 'Kinsington', 3121),
(5, 'Royal Melbourne Hospital', 'Epworth', '55 Queens Rd', 'Melbourne', 3100),
(6, 'EpworthCamberwell', 'Epworth', '888 Toorak Rd', 'Camberwell', 3124),
(7, 'Epworth Eastern', 'Epworth', '1 Arnold St', 'Box Hill', 3128);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conference`
--
ALTER TABLE `conference`
  ADD CONSTRAINT `Conference_Feedback_fk` FOREIGN KEY (`Feedback`) REFERENCES `feedback` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Conference_Venue_fk` FOREIGN KEY (`Venue`) REFERENCES `venue` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conference_fb_section`
--
ALTER TABLE `conference_fb_section`
  ADD CONSTRAINT `Conference_FB_Feedback_Section_fk` FOREIGN KEY (`Feedback_Section`) REFERENCES `feedback_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Conference_FB_Section_Conference_fk` FOREIGN KEY (`Conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conference_section`
--
ALTER TABLE `conference_section`
  ADD CONSTRAINT `Conference_Section_Conference_fk` FOREIGN KEY (`Conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conference_sponsor`
--
ALTER TABLE `conference_sponsor`
  ADD CONSTRAINT `Conference_Sponsor_Conference_fk` FOREIGN KEY (`Conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Conference_Sponsor_Sponsor_fk` FOREIGN KEY (`Sponsor`) REFERENCES `sponsor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback_option`
--
ALTER TABLE `feedback_option`
  ADD CONSTRAINT `Feedback_Option_Feedback_Question_fk` FOREIGN KEY (`Feedback_Question`) REFERENCES `feedback_question` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback_question`
--
ALTER TABLE `feedback_question`
  ADD CONSTRAINT `Feedback_Question_Feedback_Section_fk` FOREIGN KEY (`Feedback_Section`) REFERENCES `feedback_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Feedback_Question_Question_Type_fk` FOREIGN KEY (`Question_Type`) REFERENCES `question_type` (`Question_Type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback_section`
--
ALTER TABLE `feedback_section`
  ADD CONSTRAINT `Feedback_Section_Feedback_fk` FOREIGN KEY (`Feedback`) REFERENCES `feedback` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `map`
--
ALTER TABLE `map`
  ADD CONSTRAINT `Map_Conference_fk` FOREIGN KEY (`Conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polling`
--
ALTER TABLE `polling`
  ADD CONSTRAINT `Polling_Session_fk` FOREIGN KEY (`Session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polling_option`
--
ALTER TABLE `polling_option`
  ADD CONSTRAINT `Polling_Option_Polling_fk` FOREIGN KEY (`Polling`) REFERENCES `polling` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polling_response`
--
ALTER TABLE `polling_response`
  ADD CONSTRAINT `Polling_Responses_Polling_Option_fk` FOREIGN KEY (`Polling_Option`) REFERENCES `polling_option` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse_text`
--
ALTER TABLE `reponse_text`
  ADD CONSTRAINT `Reponse_Text_Feedback_Question_fk` FOREIGN KEY (`Feedback_Question`) REFERENCES `feedback_question` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response_option`
--
ALTER TABLE `response_option`
  ADD CONSTRAINT `Response_Option_Feedback_Option_fk` FOREIGN KEY (`Feedback_Option`) REFERENCES `feedback_option` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `Session_Conference_Section_fk` FOREIGN KEY (`Conference_Section`) REFERENCES `conference_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Session_Feedback_fk` FOREIGN KEY (`Feedback`) REFERENCES `feedback` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Session_Feedback_Section_fk` FOREIGN KEY (`Feedback_Section`) REFERENCES `feedback_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_equipment`
--
ALTER TABLE `session_equipment`
  ADD CONSTRAINT `Session_Equipment_Equipment_fk` FOREIGN KEY (`Equipment`) REFERENCES `equipment` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_presenter`
--
ALTER TABLE `session_presenter`
  ADD CONSTRAINT `Session_Presenter_Presenter_fk` FOREIGN KEY (`Presenter`) REFERENCES `presenter` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Session_Presenter_Session_fk` FOREIGN KEY (`Session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_question`
--
ALTER TABLE `session_question`
  ADD CONSTRAINT `Session_Question_Session_fk` FOREIGN KEY (`Session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `Sponsor_Session_Equipment_fk` FOREIGN KEY (`Session_Equipment`) REFERENCES `session_equipment` (`Equipment`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
