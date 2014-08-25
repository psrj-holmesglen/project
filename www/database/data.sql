-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2014 at 07:12 AM
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
-- Database: `robfaie_econ`
--

--
-- Dumping data for table `business_rules`
--

INSERT IGNORE INTO `business_rules` (`Bus_Rule`, `Value`) VALUES
  ('And dont blink', 'yes'),
  ('Blink and your dead', 'yes'),
  ('Dont Blink', 'yes'),
  ('Dont look away', 'yes'),
  ('Dont turn your back', 'yes');

--
-- Dumping data for table `conference`
--

INSERT IGNORE INTO `conference` (`ID`, `Title`, `Description`, `Start_Time`, `End_Time`, `Organiser`, `Location`, `Contact`, `Download_Avail`, `FilePath`, `venue`, `Token`, `Conference_Tag`, `Schedule_Tag`, `Speaker_Tag`, `Sponsor_Tag`, `C_Feedback_Tag`, `S_Feedback_Tag`) VALUES
  (1, 'DSTC', 'Definitive Surgical Trauma Care Course and Definitive Preoperative Nurses Trauma Care Course Combined Program Course No: 061//32', '2014-07-02 08:00:00', '2014-07-04 04:00:00', 'DSTC', 'Epworth Richmond Auditorium / DPNTC-Only Sessions: Cato Room (Level 2)', 'John Doe', 1, 'http://www.test.org/', 3, 100001, '2014-06-25 06:05:37', '2014-06-25 06:05:37', '2014-06-25 06:05:37', '2014-06-07 09:00:00', '2014-06-07 10:00:00', '2014-06-25 06:05:37'),
  (2, 'Surgical', 'conference covering all surgical procedures', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'Epworth Healthcare', 'Melbourne', 'Jane Smith', 1, 'http://www.test.org/', 3, 100002, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (3, 'Trauma', 'Intensive trauma conference', '2014-03-03 08:00:00', '2014-03-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Hamstick', 0, 'http://www.test.org/', 2, 100003, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (4, 'General practitioners', 'A fast paced conference in general medical practices', '2014-04-04 08:00:00', '2014-04-07 04:00:00', 'Epworth Healthcare', 'Albury', 'Timothy Dalton', 0, 'http://www.test.org/', 1, 100004, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (5, 'MidYear', 'Refresher conference', '2014-03-03 08:00:00', '2014-06-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Ham', 0, 'http://www.test.org/', 2, 100005, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (6, 'End of Year', 'Refresher conference', '2014-03-03 08:00:00', '2014-07-07 04:00:00', 'DSTC', 'Melbourne', 'Warren Ham', 0, 'http://www.test.org/', 2, 100006, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (7, 'DSTC conference', 'DSTC conference', '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC', 'Melbourne', 'Jane Smith', 0, 'http://www.test.org/', 2, 100007, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (8, 'DSTC and Future Trauma Care', 'Discussing about fure development of DSTC for dealing with increasing patients', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'John Daugh', 'Epworth Richmond Auditorium / DPNTC-Only Sessions: Cato Room (Level 2)', 'John Doe', 0, 'http://www.test.org/', 3, 100008, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (9, 'Surgical Research and Psychological Test', 'Topic is collaboration between surgeon and modern psychology', '2014-02-02 08:00:00', '2014-02-04 04:00:00', 'Epworth Healthcare', 'Melbourne', 'Kane Damih', 1, 'http://www.test.org/', 3, 100009, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (10, 'Trauma Care in early stage', 'Discuss about Intensive Trauma and Early Stage Care', '2014-03-03 08:00:00', '2014-03-07 04:00:00', 'DSTC', 'Melbourne', 'Herren Hisick', 0, 'http://www.test.org/', 2, 100010, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (11, 'Relationship between Trauma and End of Year', 'Statistical research which reveals hidden relationship between Trauma an end season of year', '2014-03-03 08:00:00', '2014-07-07 04:00:00', 'DSTC', 'Melbourne', 'Zen Zen', 0, 'http://www.test.org/', 2, 100011, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (12, 'Collaboration in DSTC', 'Short report about collaborations which takes place in DSTC between various fields', '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC', 'Melbourne', 'Ann Thim', 0, 'http://www.test.org/', 2, 100012, '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45', '2014-06-07 10:15:45'),
  (13, 'Holmesglen Project Presentations', 'Presentations of Holmesglen IT Diploma students including both Software and Networking.', '2014-06-16 12:00:00', '2014-07-27 14:00:00', 'Holmesglen', 'Holmesglen Chadstone Campus', 'Alan Schenk', 1, 'File Uploaded', 8, 94781, '2014-07-20 02:39:17', '2014-06-15 23:07:16', '2014-06-15 23:07:16', '0000-00-00 00:00:00', '2014-06-11 05:10:31', '2014-06-15 23:07:16'),
  (14, 'Alans Conference', 'Alans Conference Description', '2014-06-23 09:30:00', '2014-06-25 20:30:00', 'Bill Smith', 'Chadstone', 'Bill Smith', 1, 'File Uploaded', 2, 62210, '2014-06-24 04:05:11', '2014-06-24 01:41:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Dumping data for table `conference_fb_section`
--

INSERT IGNORE INTO `conference_fb_section` (`conference`, `feedback_section`) VALUES
  (13, 10),
  (13, 12),
  (13, 13),
  (13, 14);

--
-- Dumping data for table `conference_section`
--

INSERT IGNORE INTO `conference_section` (`ID`, `Section_Title`, `Ordering`, `conference`) VALUES
  (1, 'Surgical Decision Making', 1, 1),
  (2, 'Surgical Techniques', 2, 1),
  (3, 'Future Trauma Care', 1, 8),
  (4, 'Psychological Techniques', 2, 9),
  (5, 'Statistical Approach to Trauma', 1, 10),
  (7, 'Programming Presentation', 2, 13),
  (8, 'Networking Presentations', 3, 13),
  (10, 'Alans Conference Section 1 Title', 1, 14),
  (11, 'Alans Conference section 2', 2, 14);

--
-- Dumping data for table `conference_sponsor`
--

INSERT IGNORE INTO `conference_sponsor` (`conference`, `sponsor`) VALUES
  (1, 1),
  (2, 1),
  (1, 2),
  (2, 2),
  (1, 3),
  (1, 4),
  (13, 9),
  (13, 10),
  (13, 11),
  (13, 12),
  (13, 13),
  (13, 14);

--
-- Dumping data for table `equipment`
--

INSERT IGNORE INTO `equipment` (`ID`, `Equipment_Name`, `Equipment_Type`, `Supplier_Website`) VALUES
  (1, 'CT Scanner', 'Scanner', ''),
  (2, 'PET', 'Functional imaging technique', ''),
  (3, 'MRI', 'Magnetic resonance imaging', 'www.magnetec.com'),
  (4, 'Ultrasound', 'Imaging technique', '');

--
-- Dumping data for table `feedback_option`
--

INSERT IGNORE INTO `feedback_option` (`ID`, `Option_Text`, `feedback_question`) VALUES
  (1, 'Not confident in any case', 1),
  (2, 'Confident only in some cases', 1),
  (3, 'Confident in most cases', 1),
  (4, 'Confident with every major trauma situation', 1),
  (5, 'Uncomfortable with all areas of major trauma', 2),
  (6, 'Confident & competent only in some areas of major trauma', 2),
  (7, 'Confident & competent in most areas of major trauma', 2),
  (8, 'Confident & competent with any major trauma situation', 2),
  (9, 'No benefit', 3),
  (10, 'Some Benefit', 3),
  (11, 'Quite helpful', 3),
  (12, 'Very beneficial', 3),
  (13, 'Indispensable', 3),
  (14, 'Not at all', 4),
  (15, 'To a low degree', 4),
  (16, 'To a moderate degree', 4),
  (17, 'To a high degree', 4),
  (18, 'To a very high degree', 4),
  (19, 'Inappropriately low', 5),
  (20, 'About right', 5),
  (21, 'Inappropriately high', 5),
  (22, 'No benefit', 6),
  (23, 'Some Benefit', 6),
  (24, 'Quite helpful', 6),
  (25, 'Very beneficial', 6),
  (26, 'Indispensable', 6),
  (27, 'No benefit', 7),
  (28, 'Some Benefit', 7),
  (29, 'Quite helpful', 7),
  (30, 'Very beneficial', 7),
  (31, 'Indispensable', 7),
  (32, 'No benefit', 8),
  (33, 'Some Benefit', 8),
  (34, 'Quite helpful', 8),
  (35, 'Very beneficial', 8),
  (36, 'Indispensable', 8),
  (37, 'No benefit', 9),
  (38, 'Some Benefit', 9),
  (39, 'Quite helpful', 9),
  (40, 'Very beneficial', 9),
  (41, 'Indispensable', 9),
  (42, 'No benefit', 10),
  (43, 'Some Benefit', 10),
  (44, 'Quite helpful', 10),
  (45, 'Very beneficial', 10),
  (46, 'Indispensable', 10),
  (47, 'No benefit', 11),
  (48, 'Some Benefit', 11),
  (49, 'Quite helpful', 11),
  (50, 'Very beneficial', 11),
  (51, 'Indispensable', 11),
  (52, 'No benefit', 12),
  (53, 'Some Benefit', 12),
  (54, 'Quite helpful', 12),
  (55, 'Very beneficial', 12),
  (56, 'Indispensable', 12),
  (57, 'No benefit', 13),
  (58, 'Some Benefit', 13),
  (59, 'Quite helpful', 13),
  (60, 'Very beneficial', 13),
  (61, 'Indispensable', 13),
  (62, 'Not at all', 14),
  (63, 'Low degree', 14),
  (64, 'Moderate degree', 14),
  (65, 'High degree', 14),
  (66, 'Very high degree', 14),
  (67, 'Not at all', 15),
  (68, 'Low degree', 15),
  (69, 'Moderate degree', 15),
  (70, 'High degree', 15),
  (71, 'Very high degree', 15),
  (72, 'Not at all', 16),
  (73, 'Low degree', 16),
  (74, 'Moderate degree', 16),
  (75, 'High degree', 16),
  (76, 'Very high degree', 16),
  (77, 'Not at all', 17),
  (78, 'Low degree', 17),
  (79, 'Moderate degree', 17),
  (80, 'High degree', 17),
  (81, 'Very high degree', 17),
  (82, 'Not at all', 18),
  (83, 'Low degree', 18),
  (84, 'Moderate degree', 18),
  (85, 'High degree', 18),
  (86, 'Very high degree', 18),
  (87, 'Too Short', 19),
  (88, 'About right', 19),
  (89, 'Too long', 19),
  (90, 'Of reasonable cost', 20),
  (91, 'Far too expensive', 20),
  (92, 'No response', 20),
  (93, 'Case discussions/Interactive presentations', 21),
  (94, 'Surgery in animal lab/live animal workshop useful', 21),
  (95, 'Experienced instructors', 21),
  (96, 'Giving out manuals early for pre-read', 21),
  (97, 'Exposure to views of foreign faculty', 21),
  (98, 'Other (Specify)', 21),
  (99, 'Some leactures were too long', 22),
  (100, 'Too many lectures cramped together', 22),
  (101, 'Course too short', 22),
  (102, 'Lectures too rushed', 22),
  (103, 'Too many lectures', 22),
  (104, 'Other (Specify)', 22),
  (105, 'Yes', 24),
  (106, 'No', 24),
  (107, 'Not confident in any case', 25),
  (108, 'Confident only in some cases', 25),
  (109, 'Confident in most cases', 25),
  (110, 'Confident with every major trauma situation', 25),
  (111, 'Uncomfortable with all areas of major trauma', 27),
  (112, 'Confident & competent only in some areas of major trauma', 27),
  (113, 'Confident & competent in most areas of major trauma', 27),
  (114, 'Confident & competent with any major trauma situation', 27),
  (115, 'No benefit', 29),
  (116, 'Some Benefit', 29),
  (117, 'Quite helpful', 29),
  (118, 'Very beneficial', 29),
  (119, 'Current Diploma Student', 31),
  (120, 'Future Diploma Student', 31),
  (121, 'Holmesglen Faculty', 31),
  (122, 'Project Client', 31),
  (123, 'Other', 31),
  (124, 'Very Familiar', 32),
  (125, 'Familiar', 32),
  (126, 'Somewhat Familiar', 32),
  (127, 'Not Familiar', 32),
  (128, 'Very Not Familiar', 32),
  (129, 'Very Familiar', 33),
  (130, 'Familiar', 33),
  (131, 'Somewhat Familiar', 33),
  (132, 'Not Familiar', 33),
  (133, 'Very Not Familiar', 33),
  (134, 'Too Fast', 34),
  (135, 'Good', 34),
  (136, 'Too Slow', 34),
  (137, 'No Opinion', 34),
  (138, 'Too Fast', 35),
  (139, 'Good', 35),
  (140, 'Too Slow', 35),
  (141, 'No Opinion', 35),
  (142, 'The purely informational slides.', 36),
  (143, 'The on screen demonstrations.', 36),
  (144, 'The interactive demonstrations.', 36),
  (145, 'The end.', 36),
  (146, 'The purely informational slides.', 37),
  (147, 'The on screen demonstrations.', 37),
  (148, 'The interactive demonstrations.', 37),
  (149, 'The end.', 37),
  (150, 'The purely informational slides.', 38),
  (151, 'The on screen demonstrations.', 38),
  (152, 'The interactive demonstrations.', 38),
  (153, 'The end.', 38),
  (154, 'The purely informational slides.', 39),
  (155, 'The on screen demonstrations.', 39),
  (156, 'The interactive demonstrations.', 39),
  (157, 'The end.', 39),
  (158, 'Q1  Response 1', 45),
  (159, 'Q1  Response 2', 45),
  (160, 'Q1  Response 3', 45),
  (161, 'Q1  Response 4', 45),
  (162, 'Alans Q2 Response 1', 46),
  (163, 'Alans Q2 Response 2', 46),
  (164, 'Alans Q2 Response 3', 46),
  (165, 'Alans Q2 Response 4', 46),
  (166, 'Alans Q4 Response 1', 48),
  (167, 'Alans Q4 Response 2', 48),
  (168, 'Alans Q5 Response 1', 49),
  (169, 'Alans Q5 Response 2', 49),
  (170, 'Alans Q5 Response 3', 49);

--
-- Dumping data for table `feedback_question`
--

INSERT IGNORE INTO `feedback_question` (`ID`, `Question_Text`, `Type`, `question_type`, `feedback_section`) VALUES
  (1, 'Confidence level dealing with major trauma prior to the DSTC', 1, 'Multi', 1),
  (2, 'Confidence level after having completed the dstc', 1, 'Multi', 1),
  (3, 'Regarding your overall experience of the course, the DSTC was of:', 1, 'Multi', 1),
  (4, 'Regarding course objectives, to what degree were they clear & appropriate:', 1, 'Multi', 1),
  (5, 'Regarding course workload it was:', 1, 'Multi', 1),
  (6, 'Regarding course content, how do you rate the importance of Surgical Descision Making:', 1, 'Multi', 1),
  (7, 'Regarding course content, how do you rate the importance of Surgical Technique Theory:', 1, 'Multi', 1),
  (8, 'How valuable was the Manual?', 1, 'Multi', 1),
  (9, 'How valuable was the DVD Material?', 1, 'Multi', 1),
  (10, 'How valuable was the Lectures?', 1, 'Multi', 1),
  (11, 'How valuable was the Lectures?', 1, 'Multi', 1),
  (12, 'How valuable was the Labs?', 1, 'Multi', 1),
  (13, 'How valuable was the Case Discussions / Strategic Thinking / Problem Solving?', 1, 'Multi', 1),
  (14, 'Surgical Descision Making Sessions - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 1),
  (15, 'Practical Workshops - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 1),
  (16, 'Problem Solving open forums & discussion groups - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1, 'Multi', 1),
  (17, 'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1, 'Multi', 1),
  (18, 'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1, 'Multi', 1),
  (19, 'How useful was the ongoing feedback you recieved from DSTC instructors?', 1, 'Multi', 1),
  (20, 'Regarding course value for money, it was:', 1, 'Multi', 1),
  (21, 'The best features of the course were: (circle as many as necessary)', 1, 'Multi', 1),
  (22, 'The worst features of the course were:', 1, 'Multi', 1),
  (23, 'Suggested Improvements', 1, 'Multi', 1),
  (24, 'Would you recommend this course to others?', 1, 'Multi', 1),
  (25, 'Dealing with light trauma prior to the DSTC', 2, 'Multi', 7),
  (26, ' Regarding patient response after having the dstc', 1, 'Multi', 7),
  (27, 'Regarding whole experience of the course:', 2, 'Multi', 8),
  (28, 'Regarding course objectives, to what degree were they clear & appropriate:', 1, 'Multi', 8),
  (29, 'Regarding course, how to look after patients who has serious trauma after seeing them:', 2, 'Multi', 9),
  (30, 'Regarding course content, what is your background to make Surgical Descision:', 1, 'Multi', 9),
  (31, 'What brings you here today?', 1, NULL, 10),
  (32, 'How familiar are you with Software Development?', 1, NULL, 10),
  (33, 'How familiar are you with Networking?', 1, NULL, 10),
  (34, 'The pace of the presentation was:', 1, NULL, 11),
  (35, 'The pace of the presentation was:', 1, NULL, 14),
  (36, 'My favourite part of the presentation was:', 1, NULL, 11),
  (37, 'My favourite part of the presentation was:', 1, NULL, 14),
  (38, 'My least favourite part of the presentation was:', 1, NULL, 11),
  (39, 'My least favourite part of the presentation was:', 1, NULL, 14),
  (40, 'Other comments:', 2, NULL, 11),
  (41, 'Other comments:', 2, NULL, 12),
  (42, 'Other comments:', 2, NULL, 13),
  (43, 'Other comments:', 2, NULL, 14),
  (44, 'Peter', 2, NULL, 1),
  (45, 'Alans FB Question 1', 1, NULL, 16),
  (46, 'Alans Q2 Text', 1, NULL, 16),
  (47, 'Alans Question s Text', 2, NULL, 16),
  (48, 'Alans Question 4 Text', 1, NULL, 17),
  (49, 'Alans Q5 Text', 1, NULL, 17);

--
-- Dumping data for table `feedback_section`
--

INSERT IGNORE INTO `feedback_section` (`ID`, `Section_Title`, `Section_Desc`, `Type`) VALUES
  (1, 'Section A', 'Confidence levels & Overall experience of course', 'Demographic'),
  (2, 'Section B', 'Curriculum', 'session'),
  (3, 'Section C', 'Teaching materials & methods', 'conference'),
  (4, 'Section D', 'Teaching outcomes', 'session'),
  (5, 'Section E', 'Assessment & feedback', 'Demographic'),
  (6, 'Section E', 'General Comments', 'Demographic'),
  (7, 'Section TYPE-I', 'Dealing with foreign patients', 'Demographic'),
  (8, 'Section TYPE-II', 'Complex system and brain behaviour', 'session'),
  (9, 'Section TYPE-III', 'Statistical Research method', 'session'),
  (10, 'Project Demographics', 'Demographic information for the Holmesglen Project Presentations', 'Demographic'),
  (11, 'Mock Presentation', 'Feedback for the mock presentation', 'conference'),
  (12, 'Mobile Application', 'Feedback on the mobile application', 'conference'),
  (13, 'Web Application', 'Feedback on the web application', 'conference'),
  (14, 'Presentation', 'Feedback for the presentation', 'conference'),
  (15, 'asdasd', 'asdasd', 'conference'),
  (16, 'Alans Feedback Section 1', 'Alans Feedback Section 1 Description', 'conference'),
  (17, 'Alans Feedback Section 2', 'Alans Feedback Section 2', 'conference');

--
-- Dumping data for table `map`
--

INSERT IGNORE INTO `map` (`ID`, `Map_Directory`, `FilePath`, `conference`) VALUES
  (1, 'img/', 'map_a.jpg', 1),
  (2, 'img/', 'map_b.jpg', 2),
  (3, 'img/map/', 'map_c.jpg', 3),
  (4, 'img/map/', 'map_d.jpg', 4),
  (5, 'Chadstone Campus', 'File Uploaded', 13),
  (6, 'Chadstone Campus 3D', 'File Uploaded', 13),
  (7, '488 South Road Moorabbin VIC', 'No File Uploaded', 14);

--
-- Dumping data for table `polling`
--

INSERT IGNORE INTO `polling` (`ID`, `Polling_Question`, `session`, `Available`, `Open`) VALUES
  (1, 'Key Decision Point 1', 7, 0, 1),
  (2, 'Key Decision Point 2', 7, 0, 0),
  (3, 'Key Decision Point 2: Probabilities', 38, 0, 0),
  (4, 'Key Decision Point 3: Investigations', 38, 0, 0),
  (5, 'Key Decision Point 4', 38, 0, 0),
  (6, 'Key Decision Point 1', 14, 0, 0),
  (7, 'Key Decision Point 2', 14, 0, 0),
  (8, 'Key Decision Point 3: Which is NOT an appropriate strategy?', 14, 0, 0),
  (9, 'Key Decision Point 1', 14, 0, 0),
  (10, 'Key Decision Point 1', 45, 0, 0),
  (11, 'Surgical Approach', 45, 0, 0),
  (12, 'Key Decision Point 1', 47, 0, 0),
  (13, 'Key Decision Point 63', 63, 0, 0),
  (14, 'Key Decision Point 64', 64, 1, 1),
  (16, 'Key Decision Point 43', 43, 0, 0),
  (17, 'Key Decision Point 44', 44, 0, 0),
  (18, 'Key Decision Point 55: Probabilities', 55, 0, 0),
  (19, 'Key Decision Point 53', 53, 1, 1),
  (20, 'Key Decision Point 47', 47, 0, 0),
  (21, 'Key Decision Point 28: Probabilities', 28, 0, 0),
  (23, 'What is your favourite colour?', 90, 1, 1),
  (24, 'Where the examples used by the presenter relevant to you?', 98, 0, 0);

--
-- Dumping data for table `polling_option`
--

INSERT IGNORE INTO `polling_option` (`ID`, `Option_Text`, `polling`) VALUES
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
  (98, '4. Thoracotomy', 21),
  (107, 'Pink', 23),
  (108, 'Purple', 23),
  (109, 'Blue', 23),
  (110, 'Aqua', 23),
  (111, 'Green', 23),
  (112, 'Yellow', 23),
  (113, 'Orange', 23),
  (114, 'Red', 23),
  (115, 'Very relevent', 24),
  (116, 'Some relevence', 24),
  (117, 'No Relevence', 24);

--
-- Dumping data for table `polling_response`
--

INSERT IGNORE INTO `polling_response` (`ID`, `polling_option`, `Profile_Id`) VALUES
  (26, 3, 'null'),
  (27, 1, 'null'),
  (29, 108, '[{"Profile":""},{"Session":""},{"31":"11'),
  (30, 107, '[{"Profile":""},{"Session":""},{"31":"11'),
  (31, 108, '[{"Profile":""},{"Session":""},{"31":"11'),
  (32, 114, '[{"Profile":""},{"Session":""},{"31":"11'),
  (33, 110, '[{"Profile":""},{"Session":""},{"31":"11'),
  (34, 113, '[{"Profile":""},{"Session":""},{"31":"11'),
  (35, 113, '[{"Profile":""},{"Session":""},{"31":"11'),
  (36, 111, '[{"Profile":""},{"Session":""},{"31":"11'),
  (37, 111, '[{"Profile":""},{"Session":""},{"31":"11'),
  (38, 111, '[{"Profile":""},{"Session":""},{"31":"11'),
  (39, 109, ''),
  (40, 111, ''),
  (41, 110, ''),
  (42, 111, '[{"Profile":"[{\\"Profile\\":\\"\\"},{\\"Sess'),
  (43, 114, '[{"Profile":"[{\\"Profile\\":\\"\\"},{\\"Sess'),
  (44, 107, '[{"Profile":""},{"Session":""},{"31":"12'),
  (45, 111, ''),
  (46, 108, ''),
  (47, 109, '');

--
-- Dumping data for table `presenter`
--

INSERT IGNORE INTO `presenter` (`ID`, `Title`, `First_Name`, `Last_Name`, `Organisation`, `Medical_Field`, `Position`, `Qualification`, `Short_Bio`, `Filepath`) VALUES
  (1, 'Dr', 'Walter L.', 'Biffl', 'Denver Health Medical Center', 'Surgery & Patient Safety/Quality', 'Head of Anatomy', 'MD', 'Dr Oak is chief of medicine at the Handless School of Anatomy', 'c:/games/MyLittlePony'),
  (14, 'Dr', 'Robert', 'Maningham', 'Epworth Camberwell', 'Surgery', 'Surgeon', 'Director of Surgery', 'is a  is chief of surgery at the School of Camberwell Surgery.', 'img/presenter/1.jpg'),
  (15, 'Dr', 'George', 'Wills', 'Epworth Eastern', 'General  Surgery', 'Surgeonf ', 'phD', 'He is a trained General and Trauma surgeon.', 'img/presenter/2.jpg'),
  (16, 'Mr', 'Robert', 'McLeod', 'Team Zelda', '', 'Architect', 'DipInfoTech', 'Rob', 'No File Uploaded'),
  (17, 'Mr', 'Paul', 'Still', 'Team Zelda', '', 'Systems Analyst', 'DipInfoTech', '_', 'No File Uploaded'),
  (18, 'Ms', 'Dawn', 'Collett', 'Team Zelda', '', 'Project Manager', 'DipInfoTech', 'Dawn has been interested in Information Technology for many years. Because of this, she decided to study the Diploma of Information Technology at Holmesglen TAFE.', 'No File Uploaded'),
  (19, 'Ms', 'Jennifer', 'De Peyrecave', 'Team Sparta', '', 'Project Manager', 'DipInfoTech', '_', 'No File Uploaded'),
  (20, 'Mr', 'Thomas', 'Budds', 'Team Sparta', '', 'Systems Analyst', 'DipInfoTech', '_', 'No File Uploaded'),
  (21, 'Mr', 'Caue', 'Motta', 'Team Sparta', '', 'Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (22, 'Mr', 'Shohei', 'Masunga', 'Team Sparta', '', 'Developer', 'DipInfoTech', '_', 'No File Uploaded'),
  (23, 'Mr', 'William', 'Budds', 'Team Sparta', '', 'Test Manager', 'DipInfoTech', '_', 'No File Uploaded'),
  (27, 'Mr', 'Matthew', 'Broberg', 'Fonda Tech', '', 'Team Leader', 'DipInfoTech', '_', 'No File Uploaded'),
  (28, 'Mr', 'Gerry', 'Spathis', 'Fonda Tech', '', 'Network Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (29, 'Mr', 'Brandon', 'Reizer', 'Fonda Tech', '', 'System Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (30, 'Mr', 'Ping', 'Chen', 'Fonda Tech', '', 'Virtualization Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (31, 'Mr', 'Andrew', 'Yarde', 'Network Solutions Inc', '', 'Team Leader', 'DipInfoTech', '_', 'No File Uploaded'),
  (32, 'Mr', 'Larry', 'Zaidel', 'Network Solutions Inc', '', 'System Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (33, 'Mr', 'David', 'Cox', 'Network Solutions Inc', '', 'Virtualization Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (34, 'Mr', 'Huy', 'Nguyen', 'Team Profit', '', 'Team Leader', 'DipInfoTech', '_', 'No File Uploaded'),
  (35, 'Mr', 'Nayler', 'Nguyen', 'Team Profit', '', 'Network Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (36, 'Mr', 'Patrick', '!', 'Team Profit', '', 'System Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (37, 'Mr', 'Woi', 'Chong Lim', 'Team Profit', '', 'Virtualization Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (38, 'Mr', 'Santiago', 'Haddad', 'Simple Fix solutions', '', 'Team Leader', 'DipInfoTech', '_', 'No File Uploaded'),
  (39, 'Mr', 'Munamato', 'Nhira', 'Simple Fix solutions', '', 'Network Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (40, 'Mr', 'Upal', 'Nawalage', 'Simple Fix solutions', '', 'System Architect', 'DipInfoTech', '_', 'No File Uploaded'),
  (41, 'Mr', 'Alan', 'Smith', 'Northern Health', 'Orthopaedics', 'Surgeon', 'MSC', 'Alans Test Bio', 'File Uploaded'),
  (48, 'Dr', 'Chad', 'Ball', 'University of Calgary', 'Hepatobiliary and Pancreatic', 'Associate Professor of Surgery', 'MSc', 'Dr Ball currently practises HPB Trauma and Acute Care Surgery at the Foothills Medical Centre in Calgary. His research interests include clinical injury care, randomised controlled trials within HPB surgery and surgical manpower analyses.', 'File Uploaded'),
  (49, 'Dr', 'Kate', 'Martin', 'The Alfred Hospital', 'General Surgery', 'General Surgeon', 'MBBS', 'Kate is a General Surgeon, sub-specialising in Trauma Surgery. She is an instructor with the EMST and DSTC Faculties, and the Supervisor of General Surgical Training at the Alfred. Kate is also the secretary of ANZAST.', 'File Uploaded'),
  (50, 'Dr', 'John', 'Crozier', 'Liverpool Hospital', 'Vascular Surgery', 'Vascular Surgeon', '', 'John CROZIER is a Vascular and Trauma surgeon on staff of Liverpool Hospital. He has been involved with DSTC teaching from 1996. He is Chair of the National Trauma Committee of the Royal Australasian College of Surgeons. He was appointed Brigadier, Director General Health Reserves - Army, with effect from Jan 2012.', 'File Uploaded'),
  (51, 'Professor', 'Ken', 'Boffard', 'Milpark Hospital Johannesburg', 'General and Trauma Surgery', 'Professor of Surgery and Trauma Director', '', 'Professor Ken Boffard is Professor of Surgery and Trauma Director at Milpark Hospital, Johannesburg, and until recently, Head of the Department of Surgery at Johannesburg Hospital and the University of the Witwatersrand. He was previously Head of the Johannesburg Hospital Trauma Unit.  He qualified in Johannesburg, and trained in Surgery at the Birmingham Accident Hospital and Guyâ€™s Hospital.\r\n\r\nHe is past President of the International Society of Surgery (ISS) in Switzerland, the International Association for Trauma Surgery and Intensive Care (IATSIC), and the Trauma Society of South Africa.  He is a Fellow of five Surgical Colleges, and has received Honorary Fellowships from the American College of Surgeons, Royal College of Surgeons of Thailand, College of Surgeons of Sri Lanka, and the Association of Surgeons of Great Britain and Ireland.\r\n\r\nHis passion is surgical education, and various aspects of trauma resuscitation, intensive care, and regional planning of Trauma Systems. His interests include flying (he is a licensed fixed wing and helicopter pilot), scuba diving, and aeromedical care.  His research interests include coagulation, haemostasis and critical bleeding. \r\n\r\nHe is a Colonel in the South African Military Health Service.\r\n\r\nHe is a Freeman of the City of London by redemption, and an elected Liveryman of the Guild of Air Pilots of London.\r\n\r\nHe is married with two children.', 'No File Uploaded'),
  (52, 'Professor', 'Ken', 'Boffard', 'Milpark Hospital Johannesburg', 'Trauma Surgery', 'Trauma Surgeon', '', 'Professor Ken Boffard is Professor of Surgery and Trauma Director at Milpark Hospital, Johannesburg, and until recently, Head of the Department of Surgery at Johannesburg Hospital and the University of the Witwatersrand. He was previously Head of the Johannesburg Hospital Trauma Unit.  He qualified in Johannesburg, and trained in Surgery at the Birmingham Accident Hospital and Guyâ€™s Hospital.\r\n\r\nHe is past President of the International Society of Surgery (ISS) in Switzerland, the International Association for Trauma Surgery and Intensive Care (IATSIC), and the Trauma Society of South Africa.  He is a Fellow of five Surgical Colleges, and has received Honorary Fellowships from the American College of Surgeons, Royal College of Surgeons of Thailand, College of Surgeons of Sri Lanka, and the Association of Surgeons of Great Britain and Ireland.\r\n\r\nHis passion is surgical education, and various aspects of trauma resuscitation, intensive care, and regional planning of Trauma Systems. His interests include flying (he is a licensed fixed wing and helicopter pilot), scuba diving, and aeromedical care.  His research interests include coagulation, haemostasis and critical bleeding. \r\n\r\nHe is a Colonel in the South African Military Health Service.\r\n\r\nHe is a Freeman of the City of London by redemption, and an elected Liveryman of the Guild of Air Pilots of London.\r\n\r\nHe is married with two children.', 'File Uploaded');

--
-- Dumping data for table `question_type`
--

INSERT IGNORE INTO `question_type` (`question_type`, `Type_Description`) VALUES
  ('Long', 'Expected to take over 10 minutes to explain'),
  ('Multi', 'Far to complex to explain earthling'),
  ('Short', 'Expected to take under 10 minutes to explain'),
  ('Specific', 'An in depth question that requires previous experience in the field'),
  ('VShort', 'Yes or No');

--
-- Dumping data for table `session`
--

INSERT IGNORE INTO `session` (`ID`, `Title`, `Description`, `Start_Time`, `End_Time`, `Room_Location`, `Session_Chairperson`, `QA_Open`, `conference_section`, `feedback_section`) VALUES
  (1, 'Case Presentation Decision Making (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 07:50:00', '2012-11-30 08:00:00', 'Auditorium', 'P Danne', 1, 1, 1),
  (2, 'Surgical Decision Making in Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (3, 'Damage Control Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:15:00', '2012-11-30 08:30:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (4, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:30:00', '2012-11-30 08:40:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (5, 'Blunt Abdominal Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:40:00', '2012-11-30 08:55:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (6, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:55:00', '2012-11-30 09:05:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (7, 'Blunt Thoracic Trauma Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:05:00', '2012-11-30 09:20:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (8, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:20:00', '2012-11-30 09:35:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (9, 'Group Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:35:00', '2012-11-30 09:45:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (10, 'Morning Tea', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:45:00', '2012-11-30 10:15:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (11, 'Penetration Abdominal Trauma overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:15:00', '2012-11-30 10:30:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (12, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:30:00', '2012-11-30 10:40:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (13, 'ED Tracheotomy Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:40:00', '2012-11-30 10:55:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (14, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:55:00', '2012-11-30 11:10:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (15, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (16, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (17, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium', 'P Danne', 0, 1, 1),
  (18, 'Subscavian/ Neck Exposure', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (19, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:35:00', '2012-11-30 11:40:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (20, 'Fasciotomy', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:40:00', '2012-11-30 11:50:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (21, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:50:00', '2012-11-30 11:55:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (22, 'Temporary Abdominal Closure', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:55:00', '2012-11-30 12:05:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (23, 'Discussion/DVD or Demonstration of VAC Pack', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:05:00', '2012-11-30 12:10:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (24, 'Craniotomy', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:10:00', '2012-11-30 12:20:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (25, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:20:00', '2012-11-30 12:25:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (26, 'Perocardial Window', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:25:00', '2012-11-30 12:35:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (27, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:35:00', '2012-11-30 12:40:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (28, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:40:00', '2012-11-30 12:55:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (29, 'Trade Display / Lunch', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:55:00', '2012-11-30 13:15:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (30, 'Bus 1 - depart for Parkville', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 13:15:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', 0, 2, 1),
  (31, 'Bus 2 - depart for Parkville', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 13:30:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', 0, 2, 1),
  (32, 'Department of Anatomy - Practical session (All Groups)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 14:00:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', 0, 2, 1),
  (33, 'Bus Back to Epworth Richmond', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 17:00:00', '2012-11-30 17:45:00', 'Parkville', 'S Deane', 0, 2, 1),
  (34, 'Problem Solving and Discussion Groups (Auditorium)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 17:45:00', '2012-11-30 18:30:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (35, 'Close', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 18:30:00', '2012-11-30 17:00:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (36, 'Course Dinner - Elim Gardens', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 18:45:00', '2012-11-30 17:00:00', 'Auditorium', 'S Deane', 0, 2, 1),
  (37, 'Arrival - Tea/Coffe', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:00:00', '2012-12-01 07:30:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (38, 'Penetrating Thoracic Trauma', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:30:00', '2012-12-01 07:45:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (39, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:45:00', '2012-12-01 08:00:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (40, 'Haemodynamically Unstable Pelvic Fracture Overview', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:00:00', '2012-12-01 08:15:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (41, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:15:00', '2012-12-01 08:25:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (42, 'Head Injury', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:25:00', '2012-12-01 08:40:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (43, 'Case Presentation', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:40:00', '2012-12-01 08:50:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (44, 'Penetrating Neck Injury', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:50:00', '2012-12-01 09:05:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (45, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:05:00', '2012-12-01 09:20:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (46, 'Vascular Limb Injury', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:20:00', '2012-12-01 09:35:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (47, 'Case Presentation (Interactive)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:35:00', '2012-12-01 09:50:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (48, 'Panel Discussion', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:50:00', '2012-12-01 09:55:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (49, 'Morning Tea / Trade Display', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:55:00', '2012-12-01 10:50:00', 'Auditorium', 'M Richardson', 0, 2, 1),
  (50, 'Spleen & Kidney', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 10:50:00', '2012-12-01 11:05:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (51, 'Discussion/DVD or Demonstration of VAC Pack', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:05:00', '2012-12-01 11:20:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (52, 'Liver', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:20:00', '2012-12-01 11:35:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (53, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:35:00', '2012-12-01 11:50:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (54, 'Pancreas & Duodenum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:50:00', '2012-12-01 12:05:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (55, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:05:00', '2012-12-01 12:20:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (56, 'Cardiac & Lung Repair', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:20:00', '2012-12-01 12:35:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (57, 'Discussion/DVD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:35:00', '2012-12-01 12:50:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (58, 'Bus 1 - Faculty/DPNTC departs', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:50:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (59, 'Bus 2 - Faculty/DSTC departs', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 13:00:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (60, 'Practical session (All Groups)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 13:45:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (61, 'Discussion & Close at Werribee Campus', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 17:00:00', '2012-12-01 17:30:00', 'Werribee Campus', 'T. Wagner', 0, 2, 1),
  (62, 'Bus Back to Epworth Richmond', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 17:30:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1),
  (63, 'Analysis of Future Trauma Care', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 07:50:00', '2012-11-30 08:00:00', 'Auditorium', 'P Danne', 0, 3, 7),
  (64, 'Method of applying psychological research and its approach', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium', 'P Danne', 0, 4, 8),
  (80, 'Tinker time', 'Last minute changes, tweak, and fixes. It''s do or die time.', '2014-06-16 09:00:00', '2014-06-16 09:05:00', 'C1.2.02', '', 0, 7, NULL),
  (81, 'Setup', 'Preparation of computers, devices, and equipment.', '2014-06-16 09:15:00', '2014-06-16 09:45:00', 'C1.2.02', '', 0, 7, NULL),
  (82, 'Introduction', 'An introduction to the Project and to both teams.', '2014-06-16 10:00:00', '2014-06-16 10:05:00', 'C1.2.02', '', 0, 7, NULL),
  (83, 'Overview', 'An overview of the System as a whole and its features', '2014-06-16 10:05:00', '2014-06-16 10:10:00', 'C1.2.02', '', 0, 7, NULL),
  (84, 'Web Application', 'A look at the web application and everything it has to offer', '2014-06-16 10:10:00', '2014-06-16 10:15:00', 'C1.2.02', '', 0, 7, NULL),
  (85, 'Web Application', 'A look at the web application and everything it has to offer', '2014-06-16 10:10:00', '2014-06-16 10:15:00', 'C1.2.02', '', 0, 7, NULL),
  (86, 'Mobile Application', 'A look at the mobile application and everything it has to offer.', '2014-06-16 10:15:00', '2014-06-16 10:20:00', 'C1.2.02', '', 0, 7, NULL),
  (87, 'Website Demonstration', 'A live demonstration of the website', '2014-06-16 10:20:00', '2014-06-16 10:25:00', 'C1.2.02', '', 0, 7, NULL),
  (88, 'Mobile Application Demonstration', 'A live demonstration of the mobile application', '2014-06-16 10:25:00', '2014-06-16 10:35:00', 'C1.2.02', '', 0, 7, NULL),
  (89, 'Question & Answer Overview', 'An overview of the Q&A subsystem and how to access it on the mobile application', '2014-06-16 10:35:00', '2014-06-16 10:40:00', 'C1.2.02', '', 0, 7, NULL),
  (90, 'Polling Demonstration', 'A live demonstration of the Polling subsystem', '2014-06-16 10:40:00', '2014-06-16 10:45:00', 'C1.2.02', '', 0, 7, NULL),
  (91, 'Feedback Overview', 'A look at the feedback system on the mobile application', '2014-06-16 10:45:00', '2014-06-16 10:50:00', 'C1.2.02', '', 0, 7, NULL),
  (92, 'Question & Answer Demonstration', 'A live demonstration of the Question and Answer subsystem with questions from the audience.', '2014-06-16 10:50:00', '2014-06-16 11:00:00', 'C1.2.02', '', 1, 7, NULL),
  (94, 'Fonda Tech', 'Aero Design Pty Ltd is a Company that designs aeronautical systems from radar systems to navigation and command and control systems.\n<br><br>\nTheir main Office and design/production center is situated at their Clayton headquarters at 212 Clayton Rd Clayton. This is where most of their current design and production work is carried out.\n<br><br>\nTheir Network Infrastructure at these headquarters is old and out of date.\n\n <br><br>\n\nThey design systems for both private industry and Government, and have recently won a tender to supply control systems for a major Government contract. This is a large contract that is expected to extend for several years.', '2014-06-16 11:00:00', '2014-06-16 11:30:00', 'C1.2.02', NULL, 0, 8, NULL),
  (95, 'Network Solutions Inc', 'Aero Design Pty Ltd is a Company that designs aeronautical systems from radar systems to navigation and command and control systems.\n<br><br>\nTheir main Office and design/production center is situated at their Clayton headquarters at 212 Clayton Rd Clayton. This is where most of their current design and production work is carried out.\n<br><br>\nTheir Network Infrastructure at these headquarters is old and out of date.\n\n <br><br>\n\nThey design systems for both private industry and Government, and have recently won a tender to supply control systems for a major Government contract. This is a large contract that is expected to extend for several years.', '2014-06-16 11:30:00', '2014-06-16 12:00:00', 'C1.2.02', NULL, 0, 8, NULL),
  (96, 'Team Profit', 'Aero Design Pty Ltd is a Company that designs aeronautical systems from radar systems to navigation and command and control systems.\n<br><br>\nTheir main Office and design/production center is situated at their Clayton headquarters at 212 Clayton Rd Clayton. This is where most of their current design and production work is carried out.\n<br><br>\nTheir Network Infrastructure at these headquarters is old and out of date.\n\n <br><br>\n\nThey design systems for both private industry and Government, and have recently won a tender to supply control systems for a major Government contract. This is a large contract that is expected to extend for several years.', '2014-06-16 12:00:00', '2014-06-16 12:30:00', 'C1.2.02', NULL, 0, 8, NULL),
  (97, 'Simple Fix Soluntions', 'Aero Design Pty Ltd is a Company that designs aeronautical systems from radar systems to navigation and command and control systems.\n<br><br>\nTheir main Office and design/production center is situated at their Clayton headquarters at 212 Clayton Rd Clayton. This is where most of their current design and production work is carried out.\n<br><br>\nTheir Network Infrastructure at these headquarters is old and out of date.\n\n <br><br>\n\nThey design systems for both private industry and Government, and have recently won a tender to supply control systems for a major Government contract. This is a large contract that is expected to extend for several years.', '2014-06-16 12:30:00', '2014-06-16 13:00:00', 'C1.2.02', NULL, 0, 8, NULL),
  (98, 'Alans Session 1', 'Alans Session 1 description', '2014-06-23 12:00:00', '2014-06-23 12:50:00', 'Room 1', 'Bill Smith', 0, 10, 16),
  (99, 'Alans session 2', 'Alans session 2 Description', '2014-06-23 13:00:00', '2014-06-23 14:00:00', 'Room 3', 'Bill Smith', 0, 10, 16),
  (100, 'Alans session 3', 'Alans Session 3', '2014-06-23 13:20:00', '2014-06-23 14:20:00', 'Room 12', 'Bill Smith', 0, 11, 17),
  (101, 'Session 2 Section 2 Alan', 'Session 2 Section 2 Alan description', '2014-06-23 14:05:00', '2014-06-23 15:00:00', 'Room 23', 'Bill Smith', 0, 11, 17);

--
-- Dumping data for table `session_equipment`
--

INSERT IGNORE INTO `session_equipment` (`equipment`) VALUES
  (1),
  (2),
  (3),
  (4);

--
-- Dumping data for table `session_presenter`
--

INSERT IGNORE INTO `session_presenter` (`presenter`, `session`) VALUES
  (15, 1),
  (1, 11),
  (1, 28),
  (1, 32),
  (1, 50),
  (1, 63),
  (16, 82),
  (17, 82),
  (18, 82),
  (19, 82),
  (20, 82),
  (21, 82),
  (22, 82),
  (23, 82),
  (27, 94),
  (28, 94),
  (29, 94),
  (30, 94),
  (31, 95),
  (32, 95),
  (33, 95),
  (34, 96),
  (35, 96),
  (36, 96),
  (37, 96),
  (38, 97),
  (39, 97),
  (40, 97),
  (17, 98),
  (41, 98),
  (41, 99),
  (20, 100),
  (17, 101),
  (41, 101);

--
-- Dumping data for table `session_question`
--

INSERT IGNORE INTO `session_question` (`ID`, `Question`, `Accepted`, `Profile_Id`, `session`) VALUES
  (32, 'Has the system been used at a conference yet? ', 0, '[{"Question":""},{"Profile":""},{"Sessio', 92),
  (33, 'How long did the project take to complete? ', 0, '[{"Question":""},{"Profile":""},{"Sessio', 92),
  (34, 'How did you find the process? ', 0, '[{"Question":""},{"Profile":""},{"Sessio', 92),
  (35, 'Will the application be used at a real conference? ', 0, '[{"Question":""},{"Profile":""},{"Sessio', 92),
  (37, 'How much did the documentation help you with developing? ', 0, '[{"Question":""},{"Profile":""},{"Sessio', 92),
  (38, 'Could you give more details about the data flow summaries? ', 0, '[{"Question":""},{"Profile":""},{"Sessio', 92),
  (45, 'coffee?', 1, '[{"31":"121"},{"32":"126"},{"33":"131"}]', 92),
  (55, 'What would be required to convert your app into an IOS app?', 1, '[{"31":"121"},{"32":"124"},{"33":"131"}]', 92),
  (65, 'What did you find the most challenging in the project', 1, '[{"Profile":"[{\\"Profile\\":\\"\\"},{\\"Sess', 92),
  (68, 'what were you most surprised about in doing this project?', 1, '[{"Profile":"[{\\"Profile\\":\\"\\"},{\\"Sess', 92),
  (69, 'What was the hardest part of this process? what was the most valuable thing you learned?', 1, '[{"Profile":"[{\\"Profile\\":\\"\\"},{\\"Sess', 92),
  (71, 'great work everyone.', 0, '[{"Question":""},{"Profile":""},{"Sessio', 92),
  (72, 'Jgdyh', 0, 'null', 92),
  (73, 'Good evening ', 0, 'null', 92);

--
-- Dumping data for table `sponsor`
--

INSERT IGNORE INTO `sponsor` (`ID`, `Name`, `FilePath`, `Short_Desc`, `URL`, `session_equipment`) VALUES
  (1, 'Royal Australasian College of Surgeons', 'images/life.jpg', 'Formed in 1927 the Royal Australasian Collage of surgeons is a non-profit organisation.', 'http://www.surgeons.org/', 1),
  (2, 'IATSIC', 'images/death.jpg', 'International Association for Trauma Surgery and Intensive Care', 'http://www.iatsic.org/', 2),
  (3, 'Covidien', 'images/the.jpg', 'Covidien is a $10 billion global healthcare products leader dedicated to innovation and long-term growth.', 'http://www.covidien.com/covidien/pages.aspx', 3),
  (4, 'KCI', 'images/same.jpg', 'Our proprietary KCI negative pressure technologies have revolutionized the way in which caregivers treat a wide variety of wound types', 'http://www.kci-medical.com.au/AU-ENG/home', 4),
  (5, 'Australasian College of Surgeons', 'images/he.jpg', 'established in 1987, specilized for Surgeon .', 'http://www.surgeons.org/', 1),
  (6, 'IAS', 'images/did.jpg', 'International Association of Surgeon', 'http://www.ias.org/', 2),
  (7, 'Allianz', 'images/care.jpg', 'Allianz is a Australian healthcare industry leader .', 'http://www.allianz.com/', 3),
  (9, 'JetBrains', 'No File Uploaded', 'We provide developers like ourselves with smart professional tools that help them write clean, quality code and deliver better software faster.', 'http://www.jetbrains.com/', 1),
  (10, 'Telerik', 'File Uploaded', 'Telerik empowers over one million developers to create compelling experiences across web, mobile and desktop applications.', 'http://www.telerik.com/fiddler', 1),
  (11, 'Apache', 'File Uploaded', 'The Apache Software Foundation provides support for the Apache community of open-source software projects, which provide software products for the public good.', 'http://www.apache.org/', 1),
  (12, 'Genymotion', 'File Uploaded', 'Genymotion is the next generation of the AndroVM open source project, already trusted by 900,000 developers.  Itâ€™s even easier to use and has lots more functionalities.', 'http://www.genymotion.com/', 1),
  (13, 'Google', 'File Uploaded', 'Googleâ€™s mission is to organize the worldâ€™s information and make it universally accessible and useful.', 'https://www.google.com.au/', 1),
  (14, 'Cloudforge', 'File Uploaded', 'CloudForge is a new development Platform as a Service (dPaaS) for developing, deploying and scaling application services.', 'http://www.cloudforge.com/', 1),
  (15, 'Alans Sponsor', 'File Uploaded', 'Alans Sponsor description', 'www.google.com', 2);

--
-- Dumping data for table `user`
--

INSERT IGNORE INTO `user` (`ID`, `First_Name`, `Last_Name`, `User_name`, `Email`, `Password`) VALUES
  (1, 'Jenn', 'de Peyrecave', 'Jenny', 'jenny@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
  (2, 'Will', 'Budds', 'Will', 'Will@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
  (3, 'Tom', 'Budds', 'Tom', 'tom@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
  (4, 'Caue', 'Motta', 'Caue', 'caue@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
  (5, 'Shohei', 'Masunaga', 'Shohei', 'shohei@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63'),
  (7, 'Alan', 'Schenk', 'Alan', 'Alan.Schenk@holmesglen.edu.au', '2ac9cb7dc02b3c0083eb70898e549b63'),
  (8, 'Geoff', 'Rose', 'Geoff', 'robertwimcleod@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');

--
-- Dumping data for table `venue`
--

INSERT IGNORE INTO `venue` (`ID`, `Name`, `Company`, `Street`, `Suburb`, `Post_Code`) VALUES
  (1, 'Epworth Richmond', 'Epworth', '89 Bridge Rd', 'Richmond', 3000),
  (2, 'Holmesglen', 'Epworth', '22 Smiths St', 'Morrabbin', 3590),
  (3, 'Hawthorne Hospital', 'Epworth', '10 Sturt St', 'Hawthorne', 3333),
  (4, 'Albury Medical Centre', 'Epworth', '45 Medical St', 'Kinsington', 3121),
  (5, 'Royal Melbourne Hospital', 'Epworth', '55 Queens Rd', 'Melbourne', 3100),
  (6, 'EpworthCamberwell', 'Epworth', '888 Toorak Rd', 'Camberwell', 3124),
  (7, 'Epworth Eastern', 'Epworth', '1 Arnold St', 'Box Hill', 3128),
  (8, 'Holmesglen Chadstone', 'Holmesglen', 'Cnr Batesford & Warrigal', 'Chadstone', 3148);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
