-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2014 at 02:55 AM
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
-- Table structure for table `attendee_profile`
--

DROP TABLE IF EXISTS `attendee_profile`;
CREATE TABLE IF NOT EXISTS `attendee_profile` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Position_Type` char(20) NOT NULL,
  `Years_Experience` smallint(3) NOT NULL,
  `Age_Group` char(10) NOT NULL,
  `Gender` enum('Male','Female') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `attendee_profile`
--

INSERT INTO `attendee_profile` (`ID`, `Position_Type`, `Years_Experience`, `Age_Group`, `Gender`) VALUES
(1, 'Surgeon', 10, '30-40', 'Male'),
(2, 'Surgeon', 8, '40-45', 'Female'),
(3, 'Medical', 15, '50-55', 'Male'),
(4, 'Surgeon', 7, '40-45', 'Female'),
(5, 'Medical', 12, '50-55', 'Male'),
(6, 'Surgeon', 9, '30-40', 'Male'),
(7, 'Medical', 19, '40-45', 'Female'),
(8, 'Medical', 21, '50-55', 'Male'),
(9, 'Surgeon', 12, '40-45', 'Female'),
(10, 'Medical', 17, '50-55', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `business_rules`
--

DROP TABLE IF EXISTS `business_rules`;
CREATE TABLE IF NOT EXISTS `business_rules` (
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

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
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
  PRIMARY KEY (`ID`),
  KEY `Conference_Venue_fk` (`Venue`),
  KEY `Conference_Feedback_fk` (`Feedback`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`ID`, `Title`, `Description`, `Start_Time`, `End_Time`, `Organiser`, `Location`, `Contact`, `Last_Updated`, `Download_Avail`, `FilePath`, `Feedback`, `Venue`, `Token`) VALUES
(1, 'DSTC', 'Definitive Surgical Trauma Care Course and Definitive Preoperative Nurses Trauma Care Course Combined Program Course No: 061//32', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'DSTC', 'Epworth Richmond Auditorium', 'John Doe', '2014-05-25 23:42:58', 0, 'http://www.test.org/', 1, 3, 100001),
(2, 'Surgical', 'Conference covering all surgical procedures', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'Epworth Healthcare', 'Melbourne', 'Jane Smith', '2014-10-09 23:10:10', 1, 'http://www.test.org/', 1, 3, 100002),
(3, 'Trauma', 'Intensive trauma conference', '2014-03-03 08:00:00', '2014-03-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Hamstick', '2014-10-09 23:10:10', 0, 'http://www.test.org/', 1, 2, 100003),
(4, 'General practitioners', 'A fast paced conference in general medical practices', '2014-04-04 08:00:00', '2014-04-07 04:00:00', 'Epworth Healthcare', 'Albury', 'Timothy Dalton', '2014-10-09 23:10:10', 0, 'http://www.test.org/', 1, 1, 100004),
(5, 'MidYear', 'Refresher Conference', '2014-03-03 08:00:00', '2014-06-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Ham', '2014-10-09 23:10:10', 0, 'http://www.test.org/', 1, 2, 100005),
(6, 'End of Year', 'Refresher Conference', '2014-03-03 08:00:00', '2014-07-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Ham', '2014-10-09 23:10:10', 0, 'http://www.test.org/', 1, 2, 100006),
(7, 'DSTC Conference', 'DSTC Conference', '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC', 'Melbourne', 'Jane Smith', '2014-10-10 08:10:01', 0, 'http://www.test.org/', 1, 2, 100007),
(8, 'DSTC and Future Trauma Care', 'Discussing about fure development of DSTC for dealing with increasing patients', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'John Daugh', 'Epworth Richmond Auditorium / DPNTC-Only Sessions: Cato Room (Level 2)', 'John Doe', '2014-10-09 23:10:10', 0, 'http://www.test.org/', 2, 3, 100008),
(9, 'Surgical Research and Psychological Test', 'Topic is collaboration between surgeon and modern psychology', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'Epworth Healthcare', 'Melbourne', 'Kane Damih', '2014-10-09 23:10:10', 1, 'http://www.test.org/', 3, 3, 100009),
(10, 'Trauma Care in early stage', 'Discuss about Intensive Trauma and Early Stage Care', '2014-03-03 08:00:00', '2014-03-07 04:00:00', 'DSTC', 'Melbourne', 'Herren Hisick', '2014-10-09 23:10:10', 0, 'http://www.test.org/', 3, 2, 100010),
(11, 'Relationship between Trauma and End of Year', 'Statistical research which reveals hidden relationship between Trauma an end season of year', '2014-03-03 08:00:00', '2014-07-07 04:00:00', 'DSTC', 'Melbourne', 'Zen Zen', '2014-10-09 23:10:10', 0, 'http://www.test.org/', 4, 2, 100011),
(12, 'Collaboration in DSTC', 'Short report about collaborations which takes place in DSTC between various fields', '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC', 'Melbourne', 'Ann Thim', '2014-10-10 08:10:01', 0, 'http://www.test.org/', 4, 2, 100012),
(13, 'DSTC33', 'TEST', '2014-05-26 01:30:00', '2014-05-28 01:30:00', 'USALL', 'THERE', 'ANY ONE', '2014-05-26 00:35:35', 0, 'UPLOADED_FILES/Conference/logo.jpg', NULL, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conference_fb_section`
--

DROP TABLE IF EXISTS `conference_fb_section`;
CREATE TABLE IF NOT EXISTS `conference_fb_section` (
  `Conference` smallint(5) unsigned NOT NULL,
  `Feedback_Section` smallint(5) unsigned NOT NULL,
  KEY `Conference_FB_Section_Conference_fk` (`Conference`),
  KEY `Conference_FB_Feedback_Section_fk` (`Feedback_Section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conference_section`
--

DROP TABLE IF EXISTS `conference_section`;
CREATE TABLE IF NOT EXISTS `conference_section` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Section_Title` varchar(100) NOT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Ordering` int(6) DEFAULT NULL,
  `Conference` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Conference_Section_Conference_fk` (`Conference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `conference_section`
--

INSERT INTO `conference_section` (`ID`, `Section_Title`, `Last_Updated`, `Ordering`, `Conference`) VALUES
(1, 'Surgical Decision Making', '2014-05-24 06:14:05', 1, 1),
(2, 'Surgical Techniques', '2014-02-23 13:00:00', 2, 1),
(3, 'Future Trauma Care', '2014-02-23 13:00:00', 1, 8),
(4, 'Psychological Techniques', '2014-02-23 13:00:00', 2, 9),
(5, 'Statistical Approach to Trauma', '2014-02-23 13:00:00', 1, 10),
(6, 'MIDDAY ORGY', '2014-05-25 23:41:23', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conference_sponsor`
--

DROP TABLE IF EXISTS `conference_sponsor`;
CREATE TABLE IF NOT EXISTS `conference_sponsor` (
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

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
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

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Feedback_Title` varchar(50) NOT NULL,
  `Feedback_Desc` varchar(250) DEFAULT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `Feedback_Title`, `Feedback_Desc`, `Last_Updated`) VALUES
(1, 'Testing Feedback', 'This is for testing purposes', '2014-02-23 23:10:10'),
(2, 'Feedback for Conference 8', 'This is for testing purposes', '2014-02-23 23:10:10'),
(3, 'Feedback for Conference 9', 'This is for testing purposes', '2014-02-23 23:10:10'),
(4, 'Feedback for Conference 10', 'This is for testing purposes', '2014-02-23 23:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_option`
--

DROP TABLE IF EXISTS `feedback_option`;
CREATE TABLE IF NOT EXISTS `feedback_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Option_Number` varchar(5) DEFAULT NULL,
  `Option_Text` varchar(100) DEFAULT NULL,
  `Feedback_Question` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Option_Feedback_Question_fk` (`Feedback_Question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

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
(118, '0118', 'Very beneficial', 29);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_question`
--

DROP TABLE IF EXISTS `feedback_question`;
CREATE TABLE IF NOT EXISTS `feedback_question` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question_Number` varchar(5) NOT NULL,
  `Question_Text` varchar(200) NOT NULL,
  `Type` smallint(4) NOT NULL,
  `Question_Type` char(10) DEFAULT NULL,
  `Feedback_Section` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Question_Question_Type_fk` (`Question_Type`),
  KEY `Feedback_Question_Feedback_Section_fk` (`Feedback_Section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

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
(30, 'Q030', 'Regarding course content, what is your background to make Surgical Descision:', 1, 'Multi', 9);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_response`
--

DROP TABLE IF EXISTS `feedback_response`;
CREATE TABLE IF NOT EXISTS `feedback_response` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Session` smallint(5) unsigned NOT NULL,
  `Conference` smallint(5) unsigned NOT NULL,
  `Attendee_Profile` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Response_Session_fk` (`Session`),
  KEY `Feedback_Response_Conference_fk` (`Conference`),
  KEY `Feedback_Response_Attendee_Profile_fk` (`Attendee_Profile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `feedback_response`
--

INSERT INTO `feedback_response` (`ID`, `Session`, `Conference`, `Attendee_Profile`) VALUES
(1, 1, 2, 1),
(2, 2, 3, 2),
(3, 3, 3, 3),
(4, 4, 3, 4),
(5, 5, 3, 5),
(6, 63, 8, 1),
(7, 64, 9, 2),
(8, 65, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_section`
--

DROP TABLE IF EXISTS `feedback_section`;
CREATE TABLE IF NOT EXISTS `feedback_section` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
(9, '2014-12-25 14:50:00', '2014-12-25 15:50:00', 'Section TYPE-III', 'Statistical Research method', 'Session', '2014-02-23 23:10:10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
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

DROP TABLE IF EXISTS `polling`;
CREATE TABLE IF NOT EXISTS `polling` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Polling_Question` varchar(150) NOT NULL,
  `Session` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Session_fk` (`Session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `polling`
--

INSERT INTO `polling` (`ID`, `Polling_Question`, `Session`) VALUES
(1, 'Key Decision Point 1', 7),
(2, 'Key Decision Point 2', 7),
(3, 'Key Decision Point 2: Probabilities', 38),
(4, 'Key Decision Point 3: Investigations', 38),
(5, 'Key Decision Point 4', 38),
(6, 'Key Decision Point 1', 14),
(7, 'Key Decision Point 2', 14),
(8, 'Key Decision Point 3: Which is NOT an appropriate strategy?', 14),
(9, 'Key Decision Point 1', 14),
(10, 'Key Decision Point 1', 45),
(11, 'Surgical Approach', 45),
(12, 'Key Decision Point 1', 47),
(13, 'Key Decision Point 63', 63),
(14, 'Key Decision Point 64', 64),
(15, 'Key Decision Point 65: Probabilities', 65),
(16, 'Key Decision Point 43', 43),
(17, 'Key Decision Point 44', 44),
(18, 'Key Decision Point 55: Probabilities', 55),
(19, 'Key Decision Point 53', 53),
(20, 'Key Decision Point 47', 47),
(21, 'Key Decision Point 28: Probabilities', 28);

-- --------------------------------------------------------

--
-- Table structure for table `polling_option`
--

DROP TABLE IF EXISTS `polling_option`;
CREATE TABLE IF NOT EXISTS `polling_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Option_Text` varchar(80) NOT NULL,
  `Polling` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Option_Polling_fk` (`Polling`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

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
(11, '1. Stable and will not require surgery?', 3),
(12, '2. Will need surgery to lung?', 3),
(13, '3. Will need surgery to mediastinal structure?', 3),
(14, '4. Likely to need ERRT?', 3),
(15, '5. May require surgery – further investigation required?', 3),
(16, '1. Contrast CT?', 4),
(17, '2. CXR?', 4),
(18, '3. Bronchoscopy?', 4),
(19, '4. Oesophagoscopy?', 4),
(20, '5. All of the Above?', 4),
(21, '1. ERRT', 5),
(22, '2. Anterolateral thorocotomy', 5),
(23, '3. Sternotomy', 5),
(24, '4. Post lateral thoracotomy', 5),
(25, '5. All of the above', 5),
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
(48, '1. OR immediately?', 10),
(49, '2. Pull out knife in emergency?', 10),
(50, '3. CTA?', 10),
(51, '4. CXR?', 10),
(52, '5. Call thoracic or ENT service?', 10),
(53, '1. Transverse incision?', 11),
(54, '2. Anterior border SCM?', 11),
(55, '3. Median sternotomy +/- extension to neck?', 11),
(56, '1. 2nd OR, exploration, fasciotomy?', 11),
(57, '2. Angiogram, 2nd OR, fasiotomy?', 11),
(58, '3. Angiogram, 2nd OR, exploration, fasciotomy?', 11),
(59, '1. Laparotomy', 12),
(60, '2. FAST', 12),
(61, '3. DPL', 12),
(62, '4. Thoracotomy', 12),
(63, '5. CT Head, Neck, Chest, Abdo', 13),
(64, '1. Laparotomy', 13),
(65, '2. Thoracotomy', 13),
(66, '3. 2nd Chest Tube', 13),
(67, '4. Admit ICU', 14),
(68, '5. Cardiothoracic Surgery Consultation', 14),
(69, '1. Stable and will not require surgery?', 14),
(70, '2. Will need surgery to lung?', 14),
(71, '1. Laparotomy', 15),
(72, '2. FAST', 15),
(73, '3. DPL', 15),
(74, '4. Thoracotomy', 15),
(75, '5. CT Head, Neck, Chest, Abdo', 16),
(76, '1. Laparotomy', 16),
(77, '2. Thoracotomy', 16),
(78, '3. 2nd Chest Tube', 16),
(79, '4. Admit ICU', 17),
(80, '5. Cardiothoracic Surgery Consultation', 17),
(81, '1. Stable and will not require surgery?', 17),
(82, '2. Will need surgery to lung?', 17),
(83, '1. Laparotomy', 18),
(84, '2. FAST', 18),
(85, '3. DPL', 18),
(86, '4. Thoracotomy', 18),
(87, '5. CT Head, Neck, Chest, Abdo', 19),
(88, '1. Laparotomy', 19),
(89, '2. Thoracotomy', 19),
(90, '3. 2nd Chest Tube', 19),
(91, '4. Admit ICU', 20),
(92, '5. Cardiothoracic Surgery Consultation', 20),
(93, '1. Stable and will not require surgery?', 20),
(94, '2. Will need surgery to lung?', 20),
(95, '1. Laparotomy', 21),
(96, '2. FAST', 21),
(97, '3. DPL', 21),
(98, '4. Thoracotomy', 21);

-- --------------------------------------------------------

--
-- Table structure for table `polling_response`
--

DROP TABLE IF EXISTS `polling_response`;
CREATE TABLE IF NOT EXISTS `polling_response` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Medical_Profession` varchar(40) NOT NULL,
  `Attendee_Profile` smallint(5) unsigned NOT NULL,
  `Polling_Option` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Responses_Attendee_Profile_fk` (`Attendee_Profile`),
  KEY `Polling_Responses_Polling_Option_fk` (`Polling_Option`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `polling_response`
--

INSERT INTO `polling_response` (`ID`, `Medical_Profession`, `Attendee_Profile`, `Polling_Option`) VALUES
(1, 'Anesthesiology', 1, 1),
(2, 'Cardiovascular Medicine', 2, 2),
(3, 'Endocrinology', 3, 3),
(4, 'Forceinology', 4, 4),
(5, 'Endocrinology', 5, 5),
(6, 'Anesthesiology', 2, 6),
(7, 'Cardiovascular Medicine', 2, 7),
(8, 'Endocrinology', 3, 8),
(9, 'Forceinology', 4, 9),
(10, 'Endocrinology', 5, 10),
(11, 'Anesthesiology', 1, 10),
(12, 'Cardiovascular Medicine', 2, 11),
(13, 'Endocrinology', 3, 12),
(14, 'Forceinology', 4, 14),
(15, 'Endocrinology', 5, 15),
(16, 'Anesthesiology', 1, 15),
(17, 'Cardiovascular Medicine', 2, 16),
(18, 'Endocrinology', 3, 16),
(19, 'Forceinology', 4, 17),
(20, 'Endocrinology', 5, 18),
(21, 'Anesthesiology', 1, 19),
(22, 'Cardiovascular Medicine', 2, 20),
(23, 'Endocrinology', 3, 21),
(24, 'Forceinology', 4, 22),
(25, 'Endocrinology', 5, 23),
(26, 'Anesthesiology', 1, 24),
(27, 'Cardiovascular Medicine', 2, 24),
(28, 'Endocrinology', 3, 25),
(29, 'Forceinology', 4, 26),
(30, 'Endocrinology', 5, 28),
(31, 'Anesthesiology', 1, 29),
(32, 'Cardiovascular Medicine', 2, 29),
(33, 'Endocrinology', 3, 30),
(34, 'Forceinology', 4, 31),
(35, 'Endocrinology', 5, 32),
(36, 'Anesthesiology', 1, 31),
(37, 'Cardiovascular Medicine', 2, 32),
(38, 'Endocrinology', 3, 33),
(39, 'Forceinology', 4, 34),
(40, 'Endocrinology', 5, 35),
(41, 'Anesthesiology', 1, 36),
(42, 'Cardiovascular Medicine', 2, 37),
(43, 'Endocrinology', 3, 38),
(44, 'Forceinology', 4, 40),
(45, 'Endocrinology', 5, 41),
(46, 'Anesthesiology', 1, 41),
(47, 'Cardiovascular Medicine', 2, 42),
(48, 'Endocrinology', 3, 43),
(49, 'Forceinology', 4, 44),
(50, 'Endocrinology', 5, 45),
(51, 'Anesthesiology', 1, 46),
(52, 'Cardiovascular Medicine', 2, 47),
(53, 'Endocrinology', 3, 48),
(54, 'Forceinology', 4, 49),
(55, 'Endocrinology', 5, 50),
(56, 'Anesthesiology', 1, 51),
(57, 'Cardiovascular Medicine', 2, 52),
(58, 'Endocrinology', 3, 53),
(59, 'Forceinology', 4, 54),
(60, 'Endocrinology', 5, 55),
(61, 'Anesthesiology', 1, 56),
(62, 'Cardiovascular Medicine', 2, 57),
(63, 'Endocrinology', 3, 58),
(64, 'Forceinology', 4, 59),
(65, 'Endocrinology', 5, 60);

-- --------------------------------------------------------

--
-- Table structure for table `presenter`
--

DROP TABLE IF EXISTS `presenter`;
CREATE TABLE IF NOT EXISTS `presenter` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `presenter`
--

INSERT INTO `presenter` (`ID`, `Title`, `First_Name`, `Last_Name`, `Organisation`, `Medical_Field`, `Position`, `Qualification`, `Short_Bio`, `Filepath`, `Last_Updated`) VALUES
(1, 'Dr', 'Walter L', 'Biffl', 'Denver Health Medical Center', 'Surgery & Patient Safety/Quality', 'Head of Anatomy', 'MD', 'Dr Oak is chief of medicine at the Handless School of Anatomy', 'No File Uploaded', '2014-05-24 06:48:39'),
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
(15, 'MR', 'PLUTO', 'PUPPY', 'STREET  DOGHOUSE', 'VETERINARY', 'CRAWLER', 'PRO', 'GOOD DOG', 'No File Uploaded', '2014-05-26 00:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

DROP TABLE IF EXISTS `question_type`;
CREATE TABLE IF NOT EXISTS `question_type` (
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

DROP TABLE IF EXISTS `reponse_text`;
CREATE TABLE IF NOT EXISTS `reponse_text` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question_Reponse` varchar(250) NOT NULL,
  `Feedback_Question` smallint(5) unsigned NOT NULL,
  `Feedback_Response` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Reponse_Text_Feedback_Question_fk` (`Feedback_Question`),
  KEY `Reponse_Text_Feedback_Response_fk` (`Feedback_Response`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `reponse_text`
--

INSERT INTO `reponse_text` (`ID`, `Question_Reponse`, `Feedback_Question`, `Feedback_Response`) VALUES
(1, 'QR00000', 1, 1),
(2, 'QR00001', 2, 2),
(3, 'QR00002', 3, 3),
(4, 'QR00003', 4, 4),
(5, 'QR00004', 5, 5),
(6, 'QR00005', 26, 6),
(7, 'QR00006', 30, 7),
(8, 'QR00007', 28, 8);

-- --------------------------------------------------------

--
-- Table structure for table `response_option`
--

DROP TABLE IF EXISTS `response_option`;
CREATE TABLE IF NOT EXISTS `response_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Feedback_Response` smallint(5) unsigned NOT NULL,
  `Feedback_Option` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Response_Option_Feedback_Option_fk` (`Feedback_Option`),
  KEY `Response_Option_Feedback_Response_fk` (`Feedback_Response`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `response_option`
--

INSERT INTO `response_option` (`ID`, `Feedback_Response`, `Feedback_Option`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 107),
(7, 7, 108),
(8, 8, 109),
(9, 6, 111),
(10, 7, 112),
(11, 8, 113),
(12, 6, 116),
(13, 7, 117),
(14, 8, 118);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`ID`, `Title`, `Description`, `Start_Time`, `End_Time`, `Room_Location`, `Session_Chairperson`, `Last_Updated`, `Polling_Available`, `Polling_Open`, `Conference_Section`, `Feedback`, `Feedback_Section`) VALUES
(1, 'Case Presentation Decision Making (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2014-11-30 07:50:00', '2014-11-30 08:00:00', 'Auditorium', 'P Danne', '2014-05-24 06:22:54', 0, 0, 1, 1, 1),
(2, 'Surgical Decision Making in Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(3, 'Damage Control Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:15:00', '2012-11-30 08:30:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(4, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:30:00', '2012-11-30 08:40:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(5, 'Blunt Abdominal Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:40:00', '2012-11-30 08:55:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(6, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:55:00', '2012-11-30 09:05:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(7, 'Blunt Thoracic Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:05:00', '2012-11-30 09:20:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(8, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:20:00', '2012-11-30 09:35:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(9, 'Group Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:35:00', '2012-11-30 09:45:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(10, 'Morning Tea', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:45:00', '2012-11-30 10:15:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(11, 'Penetration Abdominal Trauma overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:15:00', '2012-11-30 10:30:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(12, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:30:00', '2012-11-30 10:40:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(13, 'ED Tracheotomy Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:40:00', '2012-11-30 10:55:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(14, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:55:00', '2012-11-30 11:10:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(15, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(16, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(17, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 1, 1, 1),
(18, 'Subscavian/ Neck Exposure', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(19, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:35:00', '2012-11-30 11:40:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(20, 'Fasciotomy', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:40:00', '2012-11-30 11:50:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(21, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:50:00', '2012-11-30 11:55:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(22, 'Temporary Abdominal Closure', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:55:00', '2012-11-30 12:05:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(23, 'Discussion/DVD or Demonstration of VAC Pack', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:05:00', '2012-11-30 12:10:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(24, 'Craniotomy', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:10:00', '2012-11-30 12:20:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(25, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:20:00', '2012-11-30 12:25:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(26, 'Perocardial Window', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:25:00', '2012-11-30 12:35:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(27, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:35:00', '2012-11-30 12:40:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(28, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:40:00', '2012-11-30 12:55:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(29, 'Trade Display / Lunch', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:55:00', '2012-11-30 13:15:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(30, 'Bus 1 - depart for Parkville', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 13:15:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(31, 'Bus 2 - depart for Parkville', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 13:30:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(32, 'Department of Anatomy - Practical Session (All Groups)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 14:00:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(33, 'Bus Back to Epworth Richmond', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 17:00:00', '2012-11-30 17:45:00', 'Parkville', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(34, 'Problem Solving and Discussion Groups (Auditorium)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 17:45:00', '2012-11-30 18:30:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(35, 'Close', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 18:30:00', '2012-11-30 17:00:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(36, 'Course Dinner - Elim Gardens', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 18:45:00', '2012-11-30 17:00:00', 'Auditorium', 'S Deane', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(37, 'Arrival - Tea/Coffe', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:00:00', '2012-12-01 07:30:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(38, 'Penetrating Thoracic Trauma', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:30:00', '2012-12-01 07:45:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(39, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:45:00', '2012-12-01 08:00:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(40, 'Haemodynamically Unstable Pelvic Fracture Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:00:00', '2012-12-01 08:15:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(41, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:15:00', '2012-12-01 08:25:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(42, 'Head Injury', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:25:00', '2012-12-01 08:40:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(43, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:40:00', '2012-12-01 08:50:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(44, 'Penetrating Neck Injury', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:50:00', '2012-12-01 09:05:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(45, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:05:00', '2012-12-01 09:20:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(46, 'Vascular Limb Injury', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:20:00', '2012-12-01 09:35:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(47, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:35:00', '2012-12-01 09:50:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(48, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:50:00', '2012-12-01 09:55:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(49, 'Morning Tea / Trade Display', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:55:00', '2012-12-01 10:50:00', 'Auditorium', 'M Richardson', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(50, 'Spleen & Kidney', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 10:50:00', '2012-12-01 11:05:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(51, 'Discussion/DVD or Demonstration of VAC Pack', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:05:00', '2012-12-01 11:20:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(52, 'Liver', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:20:00', '2012-12-01 11:35:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(53, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:35:00', '2012-12-01 11:50:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(54, 'Pancreas & Duodenum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:50:00', '2012-12-01 12:05:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(55, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:05:00', '2012-12-01 12:20:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(56, 'Cardiac & Lung Repair', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:20:00', '2012-12-01 12:35:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(57, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:35:00', '2012-12-01 12:50:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(58, 'Bus 1 - Faculty/DPNTC departs', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:50:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(59, 'Bus 2 - Faculty/DSTC departs', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 13:00:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(60, 'Practical Session (All Groups)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 13:45:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(61, 'Discussion & Close at Werribee Campus', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 17:00:00', '2012-12-01 17:30:00', 'Werribee Campus', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(62, 'Bus Back to Epworth Richmond', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 17:30:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', '2014-02-24 13:00:00', 0, 0, 2, 1, 1),
(63, 'Analysis of Future Trauma Care', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 07:50:00', '2012-11-30 08:00:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 3, 2, 7),
(64, 'Method of applying psychological research and its approach', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 4, 3, 8),
(65, 'Statistical approach to Trauma', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:15:00', '2012-11-30 08:30:00', 'Auditorium', 'P Danne', '2014-02-24 13:00:00', 0, 0, 5, 3, 9),
(66, 'DONALD''S BDAY PARTY', 'A BIT OF FUN IN THE CHAOS.', '2014-05-26 01:35:00', '2014-05-26 01:45:00', 'LABORATORY RATS DORM', 'DR. MICKEY M', '2014-05-26 00:41:38', 1, 1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `session_equipment`
--

DROP TABLE IF EXISTS `session_equipment`;
CREATE TABLE IF NOT EXISTS `session_equipment` (
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

DROP TABLE IF EXISTS `session_presenter`;
CREATE TABLE IF NOT EXISTS `session_presenter` (
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
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(1, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15),
(6, 16),
(7, 16),
(8, 16),
(7, 18),
(8, 20),
(9, 22),
(10, 24),
(11, 26),
(1, 28),
(12, 28),
(13, 28),
(1, 32),
(2, 32),
(3, 38),
(4, 38),
(5, 39),
(6, 40),
(7, 41),
(8, 42),
(9, 43),
(10, 44),
(11, 45),
(12, 46),
(13, 47),
(1, 50),
(2, 52),
(3, 53),
(4, 54),
(5, 56),
(1, 63),
(5, 63),
(2, 64),
(6, 64),
(3, 65),
(6, 65),
(13, 66),
(14, 66);

-- --------------------------------------------------------

--
-- Table structure for table `session_question`
--

DROP TABLE IF EXISTS `session_question`;
CREATE TABLE IF NOT EXISTS `session_question` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question` varchar(400) NOT NULL,
  `Accepted` tinyint(1) NOT NULL,
  `Session` smallint(5) unsigned NOT NULL,
  `Profile` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Session_Question_Session_fk` (`Session`),
  KEY `Session_Question_Attendee_Profile_fk` (`Profile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `session_question`
--

INSERT INTO `session_question` (`ID`, `Question`, `Accepted`, `Session`, `Profile`) VALUES
(1, 'Why do my legs feel itchy after a hot shower?', 1, 1, 1),
(2, 'My gums sometimes bleed when I brush my teeth, could this be related to.. dredging Port Phillip Bay?', 1, 2, 2),
(3, 'Have you ever heard of the Emancipation Proclaimation, and if so, is it Hip-hop?', 0, 3, 3),
(4, 'Why is my undies so tight?', 1, 4, 4),
(5, 'Why have a handle on a enter door?', 1, 5, 5),
(6, 'How can you predict future Trauma?', 1, 63, 7),
(7, 'What is the best book for introduction of Psychology?', 1, 64, 8),
(8, 'Is statistical research always correct?', 0, 65, 10);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE IF NOT EXISTS `sponsor` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `Logo` varchar(100) DEFAULT NULL,
  `Short_Desc` varchar(250) NOT NULL,
  `FilePath` varchar(100) DEFAULT NULL,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Session_Equipment` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Sponsor_Session_Equipment_fk` (`Session_Equipment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`ID`, `Name`, `Logo`, `Short_Desc`, `FilePath`, `Last_Updated`, `Session_Equipment`) VALUES
(1, 'Royal Australasian College of Surgeons', '', 'Formed in 1927 the Royal Australasian Collage of surgeons is a non-profit organisation.', 'http://www.surgeons.org/', '2014-02-24 13:00:00', 1),
(2, 'IATSIC', '', 'International Association for Trauma Surgery and Intensive Care', 'http://www.iatsic.org/', '2014-02-24 13:00:00', 2),
(3, 'Covidien', '', 'Covidien is a $10 billion global healthcare products leader dedicated to innovation and long-term growth.', 'http://www.covidien.com/covidien/pages.aspx', '2014-02-24 13:00:00', 3),
(4, 'KCI', '', 'Our proprietary KCI negative pressure technologies have revolutionized the way in which caregivers treat a wide variety of wound types', 'http://www.kci-medical.com.au/AU-ENG/home', '2014-02-24 13:00:00', 4),
(5, 'Australasian College of Surgeons', '', 'established in 1987, specilized for Surgeon .', 'http://www.surgeons.org/', '2014-02-24 13:00:00', 1),
(6, 'IAS', '', 'International Association of Surgeon', 'http://www.ias.org/', '2014-02-24 13:00:00', 2),
(7, 'Allianz', '', 'Allianz is a Australian healthcare industry leader .', 'http://www.allianz.com/', '2014-02-24 13:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `First_Name` char(25) NOT NULL,
  `Last_Name` char(30) NOT NULL,
  `User_name` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` char(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `First_Name`, `Last_Name`, `User_name`, `Email`, `Password`) VALUES
(1, 'Jenn', 'de Peyrecave', 'Jenny', 'jenny@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
(2, 'Will', 'Budds', 'Will', 'Will@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
(3, 'Tom', 'Budds', 'Tom', 'tom@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
(4, 'Caue', 'Motta', 'Caue', 'caue@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
(5, 'Shohei', 'M', 'Shohei', 'shohei@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
CREATE TABLE IF NOT EXISTS `venue` (
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
-- Constraints for table `feedback_response`
--
ALTER TABLE `feedback_response`
  ADD CONSTRAINT `Feedback_Response_Attendee_Profile_fk` FOREIGN KEY (`Attendee_Profile`) REFERENCES `attendee_profile` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Feedback_Response_Conference_fk` FOREIGN KEY (`Conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Feedback_Response_Session_fk` FOREIGN KEY (`Session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `Polling_Responses_Attendee_Profile_fk` FOREIGN KEY (`Attendee_Profile`) REFERENCES `attendee_profile` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Polling_Responses_Polling_Option_fk` FOREIGN KEY (`Polling_Option`) REFERENCES `polling_option` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse_text`
--
ALTER TABLE `reponse_text`
  ADD CONSTRAINT `Reponse_Text_Feedback_Question_fk` FOREIGN KEY (`Feedback_Question`) REFERENCES `feedback_question` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Reponse_Text_Feedback_Response_fk` FOREIGN KEY (`Feedback_Response`) REFERENCES `feedback_response` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response_option`
--
ALTER TABLE `response_option`
  ADD CONSTRAINT `Response_Option_Feedback_Option_fk` FOREIGN KEY (`Feedback_Option`) REFERENCES `feedback_option` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Response_Option_Feedback_Response_fk` FOREIGN KEY (`Feedback_Response`) REFERENCES `feedback_response` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `Session_Question_Attendee_Profile_fk` FOREIGN KEY (`Profile`) REFERENCES `attendee_profile` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Session_Question_Session_fk` FOREIGN KEY (`Session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `Sponsor_Session_Equipment_fk` FOREIGN KEY (`Session_Equipment`) REFERENCES `session_equipment` (`Equipment`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
