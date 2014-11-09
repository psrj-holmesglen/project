-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2014 at 07:17 AM
-- Server version: 5.5.37-35.1
-- PHP Version: 5.4.23

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `robfaie_econ_2`
--

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
  `Download_Avail` tinyint(1) NOT NULL,
  `FilePath` varchar(100) DEFAULT NULL,
  `venue` smallint(5) unsigned NOT NULL,
  `Token` int(11) DEFAULT NULL,
  `Conference_Tag` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Schedule_Tag` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Speaker_Tag` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Sponsor_Tag` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `C_Feedback_Tag` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `S_Feedback_Tag` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Token` (`Token`),
  KEY `Conference_Venue_fk` (`venue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_fb_section`
--

DROP TABLE IF EXISTS `conference_fb_section`;
CREATE TABLE IF NOT EXISTS `conference_fb_section` (
  `conference` smallint(5) unsigned NOT NULL,
  `feedback_section` smallint(5) unsigned NOT NULL,
  KEY `Conference_FB_Section_Conference_fk` (`conference`),
  KEY `Conference_FB_Feedback_Section_fk` (`feedback_section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `conference_fb_section`
--
DROP TRIGGER IF EXISTS `Conference_FB_Section_AD`;
DELIMITER //
CREATE TRIGGER `Conference_FB_Section_AD` AFTER DELETE ON `conference_fb_section`
 FOR EACH ROW UPDATE `conference`
SET `C_Feedback_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Conference_FB_Section_AI`;
DELIMITER //
CREATE TRIGGER `Conference_FB_Section_AI` AFTER INSERT ON `conference_fb_section`
 FOR EACH ROW UPDATE `conference`
SET `C_Feedback_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Conference_FB_Section_AU`;
DELIMITER //
CREATE TRIGGER `Conference_FB_Section_AU` AFTER UPDATE ON `conference_fb_section`
 FOR EACH ROW UPDATE `conference`
SET `C_Feedback_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_section`
--

DROP TABLE IF EXISTS `conference_section`;
CREATE TABLE IF NOT EXISTS `conference_section` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Section_Title` varchar(100) NOT NULL,
  `Ordering` int(6) DEFAULT NULL,
  `conference` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Conference_Section_Conference_fk` (`conference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Triggers `conference_section`
--
DROP TRIGGER IF EXISTS `Conference_Section_AD`;
DELIMITER //
CREATE TRIGGER `Conference_Section_AD` AFTER DELETE ON `conference_section`
 FOR EACH ROW UPDATE `conference`
SET `Schedule_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Conference_Section_AI`;
DELIMITER //
CREATE TRIGGER `Conference_Section_AI` AFTER INSERT ON `conference_section`
 FOR EACH ROW UPDATE `conference`
SET `Schedule_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Conference_Section_AU`;
DELIMITER //
CREATE TRIGGER `Conference_Section_AU` AFTER UPDATE ON `conference_section`
 FOR EACH ROW UPDATE `conference`
SET `Schedule_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_sponsor`
--

DROP TABLE IF EXISTS `conference_sponsor`;
CREATE TABLE IF NOT EXISTS `conference_sponsor` (
  `conference` smallint(5) unsigned NOT NULL,
  `sponsor` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`conference`,`sponsor`),
  KEY `Conference_Sponsor_Sponsor_fk` (`sponsor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `conference_sponsor`
--
DROP TRIGGER IF EXISTS `Conference_Sponsor_AD`;
DELIMITER //
CREATE TRIGGER `Conference_Sponsor_AD` AFTER DELETE ON `conference_sponsor`
 FOR EACH ROW UPDATE `conference`
SET `Sponsor_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Conference_Sponsor_AI`;
DELIMITER //
CREATE TRIGGER `Conference_Sponsor_AI` AFTER INSERT ON `conference_sponsor`
 FOR EACH ROW UPDATE `conference`
SET `Sponsor_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Conference_Sponsor_AU`;
DELIMITER //
CREATE TRIGGER `Conference_Sponsor_AU` AFTER UPDATE ON `conference_sponsor`
 FOR EACH ROW UPDATE `conference`
SET `Sponsor_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Equipment_Name` varchar(30) NOT NULL,
  `Equipment_Type` varchar(60) NOT NULL,
  `Supplier_Website` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_option`
--

DROP TABLE IF EXISTS `feedback_option`;
CREATE TABLE IF NOT EXISTS `feedback_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Option_Text` varchar(100) DEFAULT NULL,
  `feedback_question` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Option_Feedback_Question_fk` (`feedback_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

--
-- Triggers `feedback_option`
--
DROP TRIGGER IF EXISTS `Feedback_Option_AD`;
DELIMITER //
CREATE TRIGGER `Feedback_Option_AD` AFTER DELETE ON `feedback_option`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
    INNER JOIN `feedback_section` FS
      ON CS.feedback_section = FS.ID
    INNER JOIN `feedback_question` FQ
      ON FQ.feedback_section = FS.ID
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FQ.ID = old.feedback_question;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
    INNER JOIN `feedback_section` FS
      ON S.feedback_section = FS.ID
    INNER JOIN `feedback_question` FQ
      ON FQ.feedback_section = FS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FQ.ID = old.feedback_question;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Feedback_Option_AI`;
DELIMITER //
CREATE TRIGGER `Feedback_Option_AI` AFTER INSERT ON `feedback_option`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
    INNER JOIN `feedback_section` FS
      ON CS.feedback_section = FS.ID
    INNER JOIN `feedback_question` FQ
      ON FQ.feedback_section = FS.ID
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FQ.ID = new.feedback_question;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
    INNER JOIN `feedback_section` FS
      ON S.feedback_section = FS.ID
    INNER JOIN `feedback_question` FQ
      ON FQ.feedback_section = FS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FQ.ID = new.feedback_question;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Feedback_Option_AU`;
DELIMITER //
CREATE TRIGGER `Feedback_Option_AU` AFTER UPDATE ON `feedback_option`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
    INNER JOIN `feedback_section` FS
      ON CS.feedback_section = FS.ID
    INNER JOIN `feedback_question` FQ
      ON FQ.feedback_section = FS.ID
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FQ.ID = new.feedback_question;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
    INNER JOIN `feedback_section` FS
      ON S.feedback_section = FS.ID
    INNER JOIN `feedback_question` FQ
      ON FQ.feedback_section = FS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FQ.ID = new.feedback_question;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_question`
--

DROP TABLE IF EXISTS `feedback_question`;
CREATE TABLE IF NOT EXISTS `feedback_question` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question_Text` varchar(200) NOT NULL,
  `Type` smallint(4) NOT NULL,
  `question_type` char(10) DEFAULT NULL,
  `feedback_section` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Feedback_Question_Question_Type_fk` (`question_type`),
  KEY `Feedback_Question_Feedback_Section_fk` (`feedback_section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Triggers `feedback_question`
--
DROP TRIGGER IF EXISTS `Feedback_Question_AD`;
DELIMITER //
CREATE TRIGGER `Feedback_Question_AD` AFTER DELETE ON `feedback_question`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
    INNER JOIN `feedback_section` FS
      ON CS.feedback_section = FS.ID
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FS.ID = old.feedback_section;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
    INNER JOIN `feedback_section` FS
      ON S.feedback_section = FS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FS.ID = old.feedback_section;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Feedback_Question_AI`;
DELIMITER //
CREATE TRIGGER `Feedback_Question_AI` AFTER INSERT ON `feedback_question`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
    INNER JOIN `feedback_section` FS
      ON CS.feedback_section = FS.ID
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FS.ID = new.feedback_section;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
    INNER JOIN `feedback_section` FS
      ON S.feedback_section = FS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FS.ID = new.feedback_section;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Feedback_Question_AU`;
DELIMITER //
CREATE TRIGGER `Feedback_Question_AU` AFTER UPDATE ON `feedback_question`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
    INNER JOIN `feedback_section` FS
      ON CS.feedback_section = FS.ID
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FS.ID = new.feedback_section;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
    INNER JOIN `feedback_section` FS
      ON S.feedback_section = FS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE FS.ID = new.feedback_section;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_section`
--

DROP TABLE IF EXISTS `feedback_section`;
CREATE TABLE IF NOT EXISTS `feedback_section` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Section_Title` varchar(50) NOT NULL,
  `Section_Desc` varchar(250) DEFAULT NULL,
  `Type` enum('conference','session','Demographic') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Triggers `feedback_section`
--
DROP TRIGGER IF EXISTS `Feedback_Section_AD`;
DELIMITER //
CREATE TRIGGER `Feedback_Section_AD` AFTER DELETE ON `feedback_section`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE CS.feedback_section = old.ID;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE S.feedback_section = old.ID;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Feedback_Section_AI`;
DELIMITER //
CREATE TRIGGER `Feedback_Section_AI` AFTER INSERT ON `feedback_section`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE CS.feedback_section = new.ID;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE S.feedback_section = new.ID;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Feedback_Section_AU`;
DELIMITER //
CREATE TRIGGER `Feedback_Section_AU` AFTER UPDATE ON `feedback_section`
 FOR EACH ROW BEGIN
  UPDATE `conference` C
    INNER JOIN `conference_fb_section` CS
      ON C.ID = CS.conference
  SET C.C_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE CS.feedback_section = new.ID;

  UPDATE `conference` C
    INNER JOIN `conference_section` CS
      ON C.ID = CS.conference
    INNER JOIN `session` S
      ON S.conference_section = CS.ID
  SET C.S_Feedback_Tag = CURRENT_TIMESTAMP
  WHERE S.feedback_section = new.ID;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Map_Directory` varchar(100) NOT NULL,
  `FilePath` varchar(20) NOT NULL,
  `conference` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Map_Conference_fk` (`conference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Triggers `map`
--
DROP TRIGGER IF EXISTS `Map_AD`;
DELIMITER //
CREATE TRIGGER `Map_AD` AFTER DELETE ON `map`
 FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Map_AI`;
DELIMITER //
CREATE TRIGGER `Map_AI` AFTER INSERT ON `map`
 FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Map_AU`;
DELIMITER //
CREATE TRIGGER `Map_AU` AFTER UPDATE ON `map`
 FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `polling`
--

DROP TABLE IF EXISTS `polling`;
CREATE TABLE IF NOT EXISTS `polling` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Polling_Question` varchar(150) NOT NULL,
  `session` smallint(5) unsigned NOT NULL,
  `Available` tinyint(1) NOT NULL DEFAULT '0',
  `Open` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `Polling_Session_fk` (`session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `polling_option`
--

DROP TABLE IF EXISTS `polling_option`;
CREATE TABLE IF NOT EXISTS `polling_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Option_Text` varchar(80) NOT NULL,
  `polling` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Option_Polling_fk` (`polling`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

-- --------------------------------------------------------

--
-- Table structure for table `polling_response`
--

DROP TABLE IF EXISTS `polling_response`;
CREATE TABLE IF NOT EXISTS `polling_response` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `polling_option` smallint(5) unsigned NOT NULL,
  `Profile_Id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Polling_Responses_Polling_Option_fk` (`polling_option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Triggers `presenter`
--
DROP TRIGGER IF EXISTS `Presenter_AD`;
DELIMITER //
CREATE TRIGGER `Presenter_AD` AFTER DELETE ON `presenter`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
  INNER JOIN `session_presenter` SP
    ON S.ID = SP.session
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE SP.presenter = old.ID
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Presenter_AI`;
DELIMITER //
CREATE TRIGGER `Presenter_AI` AFTER INSERT ON `presenter`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
  INNER JOIN `session_presenter` SP
    ON S.ID = SP.session
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE SP.presenter = new.ID
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Presenter_AU`;
DELIMITER //
CREATE TRIGGER `Presenter_AU` AFTER UPDATE ON `presenter`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
  INNER JOIN `session_presenter` SP
    ON S.ID = SP.session
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE SP.presenter = new.ID
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

DROP TABLE IF EXISTS `question_type`;
CREATE TABLE IF NOT EXISTS `question_type` (
  `question_type` char(10) NOT NULL,
  `Type_Description` char(100) DEFAULT NULL,
  PRIMARY KEY (`question_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `response_option`
--

DROP TABLE IF EXISTS `response_option`;
CREATE TABLE IF NOT EXISTS `response_option` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Feedback_Response` smallint(5) unsigned NOT NULL,
  `feedback_option` smallint(5) unsigned NOT NULL,
  `Profile_Id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Response_Option_Feedback_Option_fk` (`feedback_option`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `response_text`
--

DROP TABLE IF EXISTS `response_text`;
CREATE TABLE IF NOT EXISTS `response_text` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question_Response` varchar(250) NOT NULL,
  `feedback_question` smallint(5) unsigned NOT NULL,
  `Feedback_Response` smallint(5) unsigned NOT NULL,
  `Profile_Id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Response_Text_Feedback_Question_fk` (`feedback_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

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
  `QA_Open` tinyint(1) NOT NULL DEFAULT '0',
  `conference_section` smallint(5) unsigned NOT NULL,
  `feedback_section` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Session_Conference_Section_fk` (`conference_section`),
  KEY `Session_Feedback_Section_fk` (`feedback_section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Triggers `session`
--
DROP TRIGGER IF EXISTS `Session_AD`;
DELIMITER //
CREATE TRIGGER `Session_AD` AFTER DELETE ON `session`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP,
  C.S_Feedback_Tag = CURRENT_TIMESTAMP
WHERE CS.ID = old.conference_section
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Session_AI`;
DELIMITER //
CREATE TRIGGER `Session_AI` AFTER INSERT ON `session`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP,
  C.S_Feedback_Tag = CURRENT_TIMESTAMP
WHERE CS.ID = new.conference_section
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Session_AU`;
DELIMITER //
CREATE TRIGGER `Session_AU` AFTER UPDATE ON `session`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP,
  C.S_Feedback_Tag = CURRENT_TIMESTAMP
WHERE CS.ID = new.conference_section
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `session_equipment`
--

DROP TABLE IF EXISTS `session_equipment`;
CREATE TABLE IF NOT EXISTS `session_equipment` (
  `equipment` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`equipment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session_presenter`
--

DROP TABLE IF EXISTS `session_presenter`;
CREATE TABLE IF NOT EXISTS `session_presenter` (
  `presenter` smallint(5) unsigned NOT NULL,
  `session` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`presenter`,`session`),
  KEY `Session_Presenter_Session_fk` (`session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `session_presenter`
--
DROP TRIGGER IF EXISTS `Session_Presenter_AD`;
DELIMITER //
CREATE TRIGGER `Session_Presenter_AD` AFTER DELETE ON `session_presenter`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE S.ID = old.session
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Session_Presenter_AI`;
DELIMITER //
CREATE TRIGGER `Session_Presenter_AI` AFTER INSERT ON `session_presenter`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE S.ID = new.session
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Session_Presenter_AU`;
DELIMITER //
CREATE TRIGGER `Session_Presenter_AU` AFTER UPDATE ON `session_presenter`
 FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE S.ID = new.session
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `session_question`
--

DROP TABLE IF EXISTS `session_question`;
CREATE TABLE IF NOT EXISTS `session_question` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Question` varchar(400) NOT NULL,
  `Accepted` tinyint(1) NOT NULL,
  `Profile_Id` varchar(100) DEFAULT NULL,
  `session` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Session_Question_Session_fk` (`session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE IF NOT EXISTS `sponsor` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `FilePath` varchar(100) DEFAULT NULL,
  `Short_Desc` text NOT NULL,
  `URL` varchar(100) NOT NULL,
  `session_equipment` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Sponsor_Session_Equipment_fk` (`session_equipment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Triggers `sponsor`
--
DROP TRIGGER IF EXISTS `Sponsor_AD`;
DELIMITER //
CREATE TRIGGER `Sponsor_AD` AFTER DELETE ON `sponsor`
 FOR EACH ROW UPDATE conference C
  INNER JOIN conference_sponsor CS
    ON C.ID = CS.conference
SET C.Sponsor_Tag = CURRENT_TIMESTAMP
WHERE CS.sponsor = old.ID
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Sponsor_AI`;
DELIMITER //
CREATE TRIGGER `Sponsor_AI` AFTER INSERT ON `sponsor`
 FOR EACH ROW UPDATE conference C
  INNER JOIN conference_sponsor CS
    ON C.ID = CS.conference
SET C.Sponsor_Tag = CURRENT_TIMESTAMP
WHERE CS.sponsor = new.ID
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Sponsor_AU`;
DELIMITER //
CREATE TRIGGER `Sponsor_AU` AFTER UPDATE ON `sponsor`
 FOR EACH ROW UPDATE conference C
  INNER JOIN conference_sponsor CS
    ON C.ID = CS.conference
SET C.Sponsor_Tag = CURRENT_TIMESTAMP
WHERE CS.sponsor = new.ID
//
DELIMITER ;

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

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
CREATE TABLE IF NOT EXISTS `venue` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Name` char(30) NOT NULL,
  `Company` char(10) DEFAULT NULL,
  `Street` varchar(50) NOT NULL,
  `Suburb` char(10) NOT NULL,
  `Post_Code` smallint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Triggers `venue`
--
DROP TRIGGER IF EXISTS `Venue_AD`;
DELIMITER //
CREATE TRIGGER `Venue_AD` AFTER DELETE ON `venue`
 FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `venue` = old.ID
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Venue_AI`;
DELIMITER //
CREATE TRIGGER `Venue_AI` AFTER INSERT ON `venue`
 FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `venue` = new.ID
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Venue_AU`;
DELIMITER //
CREATE TRIGGER `Venue_AU` AFTER UPDATE ON `venue`
 FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `venue` = new.ID
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conference`
--
ALTER TABLE `conference`
  ADD CONSTRAINT `Conference_Venue_fk` FOREIGN KEY (`venue`) REFERENCES `venue` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conference_fb_section`
--
ALTER TABLE `conference_fb_section`
  ADD CONSTRAINT `Conference_FB_Section_Conference_fk` FOREIGN KEY (`conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Conference_FB_Feedback_Section_fk` FOREIGN KEY (`feedback_section`) REFERENCES `feedback_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conference_section`
--
ALTER TABLE `conference_section`
  ADD CONSTRAINT `Conference_Section_Conference_fk` FOREIGN KEY (`conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conference_sponsor`
--
ALTER TABLE `conference_sponsor`
  ADD CONSTRAINT `Conference_Sponsor_Conference_fk` FOREIGN KEY (`conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Conference_Sponsor_Sponsor_fk` FOREIGN KEY (`sponsor`) REFERENCES `sponsor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback_option`
--
ALTER TABLE `feedback_option`
  ADD CONSTRAINT `Feedback_Option_Feedback_Question_fk` FOREIGN KEY (`feedback_question`) REFERENCES `feedback_question` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback_question`
--
ALTER TABLE `feedback_question`
  ADD CONSTRAINT `Feedback_Question_Question_Type_fk` FOREIGN KEY (`question_type`) REFERENCES `question_type` (`question_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Feedback_Question_Feedback_Section_fk` FOREIGN KEY (`feedback_section`) REFERENCES `feedback_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `map`
--
ALTER TABLE `map`
  ADD CONSTRAINT `Map_Conference_fk` FOREIGN KEY (`conference`) REFERENCES `conference` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polling`
--
ALTER TABLE `polling`
  ADD CONSTRAINT `Polling_Session_fk` FOREIGN KEY (`session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polling_option`
--
ALTER TABLE `polling_option`
  ADD CONSTRAINT `Polling_Option_Polling_fk` FOREIGN KEY (`polling`) REFERENCES `polling` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polling_response`
--
ALTER TABLE `polling_response`
  ADD CONSTRAINT `Polling_Responses_Polling_Option_fk` FOREIGN KEY (`polling_option`) REFERENCES `polling_option` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response_option`
--
ALTER TABLE `response_option`
  ADD CONSTRAINT `Response_Option_Feedback_Option_fk` FOREIGN KEY (`feedback_option`) REFERENCES `feedback_option` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response_text`
--
ALTER TABLE `response_text`
  ADD CONSTRAINT `Response_Text_Feedback_Question_fk` FOREIGN KEY (`feedback_question`) REFERENCES `feedback_question` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `Session_Conference_Section_fk` FOREIGN KEY (`conference_section`) REFERENCES `conference_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Session_Feedback_Section_fk` FOREIGN KEY (`feedback_section`) REFERENCES `feedback_section` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_equipment`
--
ALTER TABLE `session_equipment`
  ADD CONSTRAINT `Session_Equipment_Equipment_fk` FOREIGN KEY (`equipment`) REFERENCES `equipment` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_presenter`
--
ALTER TABLE `session_presenter`
  ADD CONSTRAINT `Session_Presenter_Session_fk` FOREIGN KEY (`session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Session_Presenter_Presenter_fk` FOREIGN KEY (`presenter`) REFERENCES `presenter` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_question`
--
ALTER TABLE `session_question`
  ADD CONSTRAINT `Session_Question_Session_fk` FOREIGN KEY (`session`) REFERENCES `session` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `Sponsor_Session_Equipment_fk` FOREIGN KEY (`session_equipment`) REFERENCES `session_equipment` (`equipment`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
