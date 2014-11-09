-- Version 4.1.13

DROP TABLE IF EXISTS conference_sponsor;
DROP TABLE IF EXISTS sponsor;
DROP TABLE IF EXISTS session_equipment;
DROP TABLE IF EXISTS session_presenter;
DROP TABLE IF EXISTS response_text;
DROP TABLE IF EXISTS response_option;
DROP TABLE IF EXISTS polling_response;
DROP TABLE IF EXISTS polling_option;
DROP TABLE IF EXISTS polling;
DROP TABLE IF EXISTS session_question;
DROP TABLE IF EXISTS session;
DROP TABLE IF EXISTS conference_section;
DROP TABLE IF EXISTS map;
DROP TABLE IF EXISTS conference_fb_section;
DROP TABLE IF EXISTS conference;
DROP TABLE IF EXISTS feedback_option;
DROP TABLE IF EXISTS feedback_question;
DROP TABLE IF EXISTS feedback_section;
DROP TABLE IF EXISTS feedback;
DROP TABLE IF EXISTS equipment;
DROP TABLE IF EXISTS presenter;
DROP TABLE IF EXISTS venue;
DROP TABLE IF EXISTS question_type;
DROP TABLE IF EXISTS business_rules;
DROP TABLE IF EXISTS user;


CREATE TABLE IF NOT EXISTS user
(
  ID         SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  First_Name CHAR(25)                         NOT NULL,
  Last_Name  CHAR(30)                         NOT NULL,
  User_name  VARCHAR(30)                      NOT NULL,
  Email      VARCHAR(50)                      NOT NULL,
  Password   CHAR(32)                         NOT NULL,

  CONSTRAINT User_pk PRIMARY KEY (ID)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO user VALUES (1, 'Jenn', 'de Peyrecave', 'Jenny', 'jenny@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES (2, 'Will', 'Budds', 'Will', 'Will@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES (3, 'Tom', 'Budds', 'Tom', 'tom@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES (4, 'Caue', 'Motta', 'Caue', 'caue@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES (5, 'Shohei', 'M', 'Shohei', 'shohei@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');


# Not used for anything
CREATE TABLE IF NOT EXISTS business_rules
(
  Bus_Rule CHAR(30) NOT NULL,
  Value    CHAR(30) NOT NULL,

  CONSTRAINT BusinessRules_pk PRIMARY KEY (Bus_Rule)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO business_rules VALUES ('Dont Blink', 'yes');
INSERT INTO business_rules VALUES ('Blink and your dead', 'yes');
INSERT INTO business_rules VALUES ('Dont turn your back', 'yes');
INSERT INTO business_rules VALUES ('Dont look away', 'yes');
INSERT INTO business_rules VALUES ('And dont blink', 'yes');


CREATE TABLE IF NOT EXISTS question_type
(
  question_type    CHAR(10) NOT NULL,
  Type_Description CHAR(100),

  CONSTRAINT Question_Type_pk PRIMARY KEY (question_type)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO question_type VALUES ('Long', 'Expected to take over 10 minutes to explain');
INSERT INTO question_type VALUES ('Short', 'Expected to take under 10 minutes to explain');
INSERT INTO question_type VALUES ('Specific', 'An in depth question that requires previous experience in the field');
INSERT INTO question_type VALUES ('Multi', 'Far to complex to explain earthling');
INSERT INTO question_type VALUES ('VShort', 'Yes or No');


CREATE TABLE IF NOT EXISTS venue
(
  ID        SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Name      CHAR(30)                         NOT NULL,
  Company   CHAR(10),
  Street    VARCHAR(50)                      NOT NULL,
  Suburb    CHAR(10)                         NOT NULL,
  Post_Code SMALLINT(4)                      NOT NULL,

  CONSTRAINT Venue_pk PRIMARY KEY (ID)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO venue VALUES (1, 'Epworth Richmond', 'Epworth', '89 Bridge Rd', 'Richmond', 3000);
INSERT INTO venue VALUES (2, 'Holmesglen', 'Epworth', '22 Smiths St', 'Morrabbin', 3590);
INSERT INTO venue VALUES (3, 'Hawthorne Hospital', 'Epworth', '10 Sturt St', 'Hawthorne', 3333);
INSERT INTO venue VALUES (4, 'Albury Medical Centre', 'Epworth', '45 Medical St', 'Kinsington', 3121);
INSERT INTO venue VALUES (5, 'Royal Melbourne Hospital', 'Epworth', '55 Queens Rd', 'Melbourne', 3100);

INSERT INTO venue VALUES (6, 'EpworthCamberwell', 'Epworth', '888 Toorak Rd', 'Camberwell', 3124);
INSERT INTO venue VALUES (7, 'Epworth Eastern', 'Epworth', '1 Arnold St', 'Box Hill', 3128);


CREATE TABLE IF NOT EXISTS presenter
(
  ID            SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Title         VARCHAR(20)                      NOT NULL,
  First_Name    VARCHAR(30)                      NOT NULL,
  Last_Name     VARCHAR(30)                      NOT NULL,
  Organisation  VARCHAR(150)                     NOT NULL,
  Medical_Field VARCHAR(50),
  Position      VARCHAR(100),
  Qualification VARCHAR(100)                     NOT NULL,
  Short_Bio     VARCHAR(250)                     NOT NULL,
  Filepath      VARCHAR(100),

  CONSTRAINT Presenter_pk PRIMARY KEY (ID)

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;


INSERT INTO presenter VALUES
  (1, 'Dr', 'Walter L.', 'Biffl', 'Denver Health Medical Center', 'Surgery & Patient Safety/Quality', 'Head of Anatomy',
   'MD', 'Dr Oak is chief of medicine at the Handless School of Anatomy', 'c:/games/MyLittlePony');
INSERT INTO presenter VALUES
  (2, 'Dr', 'Phillip', 'Antippa', 'Royal Melbourne Hospital and Peter MacCallum Cancer Centre',
   'Cardiothoracic Surgeon', 'Chairman', 'MD', 'Dr Evil was frozen till the year of 1997', 'http://www.evil.com');
INSERT INTO presenter VALUES
  (3, 'Dr', 'Peter', 'Bautz', 'Royal Adelaide Hospital', 'Trauma Surgeon', 'Head of Research ', 'MchD',
   'Dr Octopus was the prime inventor of Octobots', 'http://www.drock.com');

INSERT INTO presenter VALUES
  (4, 'Dr', 'Grant', 'Christey', 'Waikato Hospital and Midland Regional Trauma System', 'General Surgeon',
   'Director of Trauma', 'MD',
   'trained in New Zealand as a general surgeon and has a strong and long-standing interest in general surgery and trauma.',
   '3.jpg');
INSERT INTO presenter VALUES
  (5, 'Prof', 'Stephen', 'Deane', 'University of Newcastle, John Hunter Hospital, Hunter NEw England LHD', 'Surgery',
   'Director of Trauma', 'MD',
   'He has been recognised professionally for his contributions to advancement of Trauma Care', '3.jpg');
INSERT INTO presenter VALUES
  (6, 'Prof', 'Russell', 'Gruen', 'The Alfred and Monash University', 'Surgery', 'Surgeon', 'PhD',
   'He now heads an active teaching and research program.', '1.jpg');

INSERT INTO presenter VALUES
  (7, 'Dr', 'Annette', 'Holian', 'National Critical Care and Trauma response Centre', 'Orthopaedic and Trauma Surgeon',
   'Head of Anatomy', 'MD', 'Dr Oak is chief of medicine at the Handless School of Anatomy', 'c:/games/MyLittlePony');
INSERT INTO presenter VALUES
  (8, 'Mister', 'Rondhir', 'Jithoo', 'Consults at Epworth Group Hospitals', 'Cranial Trauma', 'Consultant', 'MD',
   'He has a background of trauma experience and cranial trauma especially.', '3.jpg');

INSERT INTO presenter VALUES
  (9, 'Dr', 'Bhadu', 'Kavar', 'The Royal Melbourne Hospital', 'Neurosurgeon', 'Consultant', 'MD',
   'He has been an instructor for DSTC Melbourne since its commencement in 1998.', '0.jpg');
INSERT INTO presenter VALUES
  (10, 'Dr', 'Christian', 'Kenfield', 'Australian Army', 'Trauma and Hepatobillary/Surgical Oncology.',
   'Major in the Australian Army', '',
   'Has served on operations and exercises on Thursday Island, Timor Leste and Solomon Islands and Papua New Guinea.',
   '1.jpg');


INSERT INTO presenter VALUES
  (11, 'A/Prof', 'Martin', 'Richardson', 'University of Melbourne & Monash University', 'Clinical Practise',
   'Associate Professor at both University of Melbourne and Monash University.', 'PhD',
   'He is on the research board of the VOTOR and is an active member of the RANR LCDR.', '2.jpg');
INSERT INTO presenter VALUES
  (12, 'Dr', 'Ben', 'Thomson', 'Royal Melbourne Hospital', 'Trauma', 'HPB and Trauma surgeon', 'MD',
   'He has been a member of the DSTC faculty for the last 5 years.', '3.jpg');
INSERT INTO presenter VALUES
  (13, 'Dr', 'Martin', 'Wullschleger', 'Royal Brisbane & Womens Hospital', 'General and Trauma surgery', 'Surgeon',
   'PhD', 'is a swiss trained General and Trauma surgeon.', '4.jpg');

INSERT INTO presenter VALUES
  (14, 'Dr', 'Robert', 'Maningham', 'Epworth Camberwell', 'Surgery', 'Surgeon', 'Director of Surgery',
   'is a  is chief of surgery at the School of Camberwell Surgery.', 'img/presenter/1.jpg');
INSERT INTO presenter VALUES (15, 'Dr', 'George', 'Wills', 'Epworth Eastern', 'General  Surgery', 'Surgeonf ', 'phD',
                              'He is a trained General and Trauma surgeon.', 'img/presenter/2.jpg');


CREATE TABLE IF NOT EXISTS equipment
(
  ID               SMALLINT  UNSIGNED AUTO_INCREMENT NOT NULL,
  Equipment_Name   VARCHAR(30)                       NOT NULL,
  Equipment_Type   VARCHAR(60)                       NOT NULL,
  Supplier_Website VARCHAR(50),

  CONSTRAINT Equipment_pk PRIMARY KEY (ID)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO equipment VALUES (1, 'CT Scanner', 'Scanner', '');
INSERT INTO equipment VALUES (2, 'PET', 'Functional imaging technique', '');
INSERT INTO equipment VALUES (3, 'MRI', 'Magnetic resonance imaging', 'www.magnetec.com');
INSERT INTO equipment VALUES (4, 'Ultrasound', 'Imaging technique', '');


CREATE TABLE IF NOT EXISTS feedback_section
(
  ID            SMALLINT UNSIGNED AUTO_INCREMENT             NOT NULL,

  Section_Title VARCHAR(50)                                  NOT NULL,
  Section_Desc  VARCHAR(250),
  Type          ENUM('conference', 'session', 'Demographic') NOT NULL,

  CONSTRAINT Feedback_Section_pk PRIMARY KEY (ID)

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO feedback_section VALUES (1, 'Section A', 'Confidence levels & Overall experience of course', 'Demographic');
INSERT INTO feedback_section VALUES (2, 'Section B', 'Curriculum', 'session');
INSERT INTO feedback_section VALUES (3, 'Section C', 'Teaching materials & methods', 'conference');
INSERT INTO feedback_section VALUES (4, 'Section D', 'Teaching outcomes', 'session');
INSERT INTO feedback_section VALUES (5, 'Section E', 'Assessment & feedback', 'Demographic');
INSERT INTO feedback_section VALUES (6, 'Section E', 'General Comments', 'Demographic');

INSERT INTO feedback_section VALUES (7, 'Section TYPE-I', 'Dealing with foreign patients', 'Demographic');
INSERT INTO feedback_section VALUES (8, 'Section TYPE-II', 'Complex system and brain behaviour', 'session');
INSERT INTO feedback_section VALUES (9, 'Section TYPE-III', 'Statistical Research method', 'session');


CREATE TABLE IF NOT EXISTS feedback_question
(
  ID               SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Question_Text    VARCHAR(200)                     NOT NULL,
  Type             SMALLINT(4)                      NOT NULL,

  question_type    CHAR(10),
  feedback_section SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT Feedback_Question_pk PRIMARY KEY (ID),
  CONSTRAINT Feedback_Question_Question_Type_fk FOREIGN KEY (question_type) REFERENCES question_type (question_type)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT Feedback_Question_Feedback_Section_fk FOREIGN KEY (feedback_section) REFERENCES feedback_section (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO feedback_question VALUES (1, 'Confidence level dealing with major trauma prior to the DSTC', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (2, 'Confidence level after having completed the dstc', 1, 'Multi', 1);
INSERT INTO feedback_question
VALUES (3, 'Regarding your overall experience of the course, the DSTC was of:', 1, 'Multi', 1);
INSERT INTO feedback_question
VALUES (4, 'Regarding course objectives, to what degree were they clear & appropriate:', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (5, 'Regarding course workload it was:', 1, 'Multi', 1);
INSERT INTO feedback_question
VALUES (6, 'Regarding course content, how do you rate the importance of Surgical Descision Making:', 1, 'Multi', 1);
INSERT INTO feedback_question
VALUES (7, 'Regarding course content, how do you rate the importance of Surgical Technique Theory:', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (8, 'How valuable was the Manual?', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (9, 'How valuable was the DVD Material?', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (10, 'How valuable was the Lectures?', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (11, 'How valuable was the Lectures?', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (12, 'How valuable was the Labs?', 1, 'Multi', 1);
INSERT INTO feedback_question
VALUES (13, 'How valuable was the Case Discussions / Strategic Thinking / Problem Solving?', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (14,
                                      'Surgical Descision Making Sessions - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:',
                                      1, 'Multi', 1);
INSERT INTO feedback_question VALUES (15,
                                      'Practical Workshops - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:',
                                      1, 'Multi', 1);
INSERT INTO feedback_question VALUES (16,
                                      'Problem Solving open forums & discussion groups - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:',
                                      1, 'Multi', 1);
INSERT INTO feedback_question VALUES (17,
                                      'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives',
                                      1, 'Multi', 1);
INSERT INTO feedback_question VALUES (18,
                                      'To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives',
                                      1, 'Multi', 1);
INSERT INTO feedback_question
VALUES (19, 'How useful was the ongoing feedback you recieved from DSTC instructors?', 1, 'Multi', 1);

INSERT INTO feedback_question VALUES (20, 'Regarding course value for money, it was:', 1, 'Multi', 1);
INSERT INTO feedback_question
VALUES (21, 'The best features of the course were: (circle as many as necessary)', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (22, 'The worst features of the course were:', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (23, 'Suggested Improvements', 1, 'Multi', 1);
INSERT INTO feedback_question VALUES (24, 'Would you recommend this course to others?', 1, 'Multi', 1);

INSERT INTO feedback_question VALUES (25, 'Dealing with light trauma prior to the DSTC', 2, 'Multi', 7);
INSERT INTO feedback_question VALUES (26, ' Regarding patient response after having the dstc', 1, 'Multi', 7);
INSERT INTO feedback_question VALUES (27, 'Regarding whole experience of the course:', 2, 'Multi', 8);
INSERT INTO feedback_question
VALUES (28, 'Regarding course objectives, to what degree were they clear & appropriate:', 1, 'Multi', 8);
INSERT INTO feedback_question
VALUES (29, 'Regarding course, how to look after patients who has serious trauma after seeing them:', 2, 'Multi', 9);
INSERT INTO feedback_question
VALUES (30, 'Regarding course content, what is your background to make Surgical Descision:', 1, 'Multi', 9);


CREATE TABLE IF NOT EXISTS feedback_option
(
  ID                SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Option_Text       VARCHAR(100),

  feedback_question SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT Feedback_Option_pk PRIMARY KEY (ID),
  CONSTRAINT Feedback_Option_Feedback_Question_fk FOREIGN KEY (feedback_question) REFERENCES feedback_question (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO feedback_option VALUES (1, 'Not confident in any case', 1);
INSERT INTO feedback_option VALUES (2, 'Confident only in some cases', 1);
INSERT INTO feedback_option VALUES (3, 'Confident in most cases', 1);
INSERT INTO feedback_option VALUES (4, 'Confident with every major trauma situation', 1);
INSERT INTO feedback_option VALUES (5, 'Uncomfortable with all areas of major trauma', 2);
INSERT INTO feedback_option VALUES (6, 'Confident & competent only in some areas of major trauma', 2);
INSERT INTO feedback_option VALUES (7, 'Confident & competent in most areas of major trauma', 2);
INSERT INTO feedback_option VALUES (8, 'Confident & competent with any major trauma situation', 2);
INSERT INTO feedback_option VALUES (9, 'No benefit', 3);
INSERT INTO feedback_option VALUES (10, 'Some Benefit', 3);
INSERT INTO feedback_option VALUES (11, 'Quite helpful', 3);
INSERT INTO feedback_option VALUES (12, 'Very beneficial', 3);

INSERT INTO feedback_option VALUES (13, 'Indispensable', 3);
INSERT INTO feedback_option VALUES (14, 'Not at all', 4);
INSERT INTO feedback_option VALUES (15, 'To a low degree', 4);
INSERT INTO feedback_option VALUES (16, 'To a moderate degree', 4);
INSERT INTO feedback_option VALUES (17, 'To a high degree', 4);
INSERT INTO feedback_option VALUES (18, 'To a very high degree', 4);
INSERT INTO feedback_option VALUES (19, 'Inappropriately low', 5);
INSERT INTO feedback_option VALUES (20, 'About right', 5);
INSERT INTO feedback_option VALUES (21, 'Inappropriately high', 5);
INSERT INTO feedback_option VALUES (22, 'No benefit', 6);
INSERT INTO feedback_option VALUES (23, 'Some Benefit', 6);
INSERT INTO feedback_option VALUES (24, 'Quite helpful', 6);
INSERT INTO feedback_option VALUES (25, 'Very beneficial', 6);
INSERT INTO feedback_option VALUES (26, 'Indispensable', 6);

INSERT INTO feedback_option VALUES (27, 'No benefit', 7);
INSERT INTO feedback_option VALUES (28, 'Some Benefit', 7);
INSERT INTO feedback_option VALUES (29, 'Quite helpful', 7);
INSERT INTO feedback_option VALUES (30, 'Very beneficial', 7);
INSERT INTO feedback_option VALUES (31, 'Indispensable', 7);
INSERT INTO feedback_option VALUES (32, 'No benefit', 8);
INSERT INTO feedback_option VALUES (33, 'Some Benefit', 8);
INSERT INTO feedback_option VALUES (34, 'Quite helpful', 8);
INSERT INTO feedback_option VALUES (35, 'Very beneficial', 8);
INSERT INTO feedback_option VALUES (36, 'Indispensable', 8);
INSERT INTO feedback_option VALUES (37, 'No benefit', 9);
INSERT INTO feedback_option VALUES (38, 'Some Benefit', 9);
INSERT INTO feedback_option VALUES (39, 'Quite helpful', 9);
INSERT INTO feedback_option VALUES (40, 'Very beneficial', 9);
INSERT INTO feedback_option VALUES (41, 'Indispensable', 9);
INSERT INTO feedback_option VALUES (42, 'No benefit', 10);
INSERT INTO feedback_option VALUES (43, 'Some Benefit', 10);
INSERT INTO feedback_option VALUES (44, 'Quite helpful', 10);
INSERT INTO feedback_option VALUES (45, 'Very beneficial', 10);
INSERT INTO feedback_option VALUES (46, 'Indispensable', 10);
INSERT INTO feedback_option VALUES (47, 'No benefit', 11);
INSERT INTO feedback_option VALUES (48, 'Some Benefit', 11);
INSERT INTO feedback_option VALUES (49, 'Quite helpful', 11);
INSERT INTO feedback_option VALUES (50, 'Very beneficial', 11);
INSERT INTO feedback_option VALUES (51, 'Indispensable', 11);
INSERT INTO feedback_option VALUES (52, 'No benefit', 12);
INSERT INTO feedback_option VALUES (53, 'Some Benefit', 12);
INSERT INTO feedback_option VALUES (54, 'Quite helpful', 12);
INSERT INTO feedback_option VALUES (55, 'Very beneficial', 12);
INSERT INTO feedback_option VALUES (56, 'Indispensable', 12);
INSERT INTO feedback_option VALUES (57, 'No benefit', 13);
INSERT INTO feedback_option VALUES (58, 'Some Benefit', 13);
INSERT INTO feedback_option VALUES (59, 'Quite helpful', 13);
INSERT INTO feedback_option VALUES (60, 'Very beneficial', 13);
INSERT INTO feedback_option VALUES (61, 'Indispensable', 13);
INSERT INTO feedback_option VALUES (62, 'Not at all', 14);
INSERT INTO feedback_option VALUES (63, 'Low degree', 14);
INSERT INTO feedback_option VALUES (64, 'Moderate degree', 14);
INSERT INTO feedback_option VALUES (65, 'High degree', 14);
INSERT INTO feedback_option VALUES (66, 'Very high degree', 14);
INSERT INTO feedback_option VALUES (67, 'Not at all', 15);
INSERT INTO feedback_option VALUES (68, 'Low degree', 15);
INSERT INTO feedback_option VALUES (69, 'Moderate degree', 15);
INSERT INTO feedback_option VALUES (70, 'High degree', 15);
INSERT INTO feedback_option VALUES (71, 'Very high degree', 15);
INSERT INTO feedback_option VALUES (72, 'Not at all', 16);
INSERT INTO feedback_option VALUES (73, 'Low degree', 16);
INSERT INTO feedback_option VALUES (74, 'Moderate degree', 16);
INSERT INTO feedback_option VALUES (75, 'High degree', 16);
INSERT INTO feedback_option VALUES (76, 'Very high degree', 16);
INSERT INTO feedback_option VALUES (77, 'Not at all', 17);
INSERT INTO feedback_option VALUES (78, 'Low degree', 17);
INSERT INTO feedback_option VALUES (79, 'Moderate degree', 17);
INSERT INTO feedback_option VALUES (80, 'High degree', 17);
INSERT INTO feedback_option VALUES (81, 'Very high degree', 17);
INSERT INTO feedback_option VALUES (82, 'Not at all', 18);
INSERT INTO feedback_option VALUES (83, 'Low degree', 18);
INSERT INTO feedback_option VALUES (84, 'Moderate degree', 18);
INSERT INTO feedback_option VALUES (85, 'High degree', 18);
INSERT INTO feedback_option VALUES (86, 'Very high degree', 18);
INSERT INTO feedback_option VALUES (87, 'Too Short', 19);
INSERT INTO feedback_option VALUES (88, 'About right', 19);
INSERT INTO feedback_option VALUES (89, 'Too long', 19);

INSERT INTO feedback_option VALUES (90, 'Of reasonable cost', 20);
INSERT INTO feedback_option VALUES (91, 'Far too expensive', 20);
INSERT INTO feedback_option VALUES (92, 'No response', 20);
INSERT INTO feedback_option VALUES (93, 'Case discussions/Interactive presentations', 21);
INSERT INTO feedback_option VALUES (94, 'Surgery in animal lab/live animal workshop useful', 21);
INSERT INTO feedback_option VALUES (95, 'Experienced instructors', 21);
INSERT INTO feedback_option VALUES (96, 'Giving out manuals early for pre-read', 21);
INSERT INTO feedback_option VALUES (97, 'Exposure to views of foreign faculty', 21);
INSERT INTO feedback_option VALUES (98, 'Other (Specify)', 21);
INSERT INTO feedback_option VALUES (99, 'Some leactures were too long', 22);
INSERT INTO feedback_option VALUES (100, 'Too many lectures cramped together', 22);
INSERT INTO feedback_option VALUES (101, 'Course too short', 22);
INSERT INTO feedback_option VALUES (102, 'Lectures too rushed', 22);
INSERT INTO feedback_option VALUES (103, 'Too many lectures', 22);
INSERT INTO feedback_option VALUES (104, 'Other (Specify)', 22);
INSERT INTO feedback_option VALUES (105, 'Yes', 24);
INSERT INTO feedback_option VALUES (106, 'No', 24);

INSERT INTO feedback_option VALUES (107, 'Not confident in any case', 25);
INSERT INTO feedback_option VALUES (108, 'Confident only in some cases', 25);
INSERT INTO feedback_option VALUES (109, 'Confident in most cases', 25);
INSERT INTO feedback_option VALUES (110, 'Confident with every major trauma situation', 25);
INSERT INTO feedback_option VALUES (111, 'Uncomfortable with all areas of major trauma', 27);
INSERT INTO feedback_option VALUES (112, 'Confident & competent only in some areas of major trauma', 27);
INSERT INTO feedback_option VALUES (113, 'Confident & competent in most areas of major trauma', 27);
INSERT INTO feedback_option VALUES (114, 'Confident & competent with any major trauma situation', 27);
INSERT INTO feedback_option VALUES (115, 'No benefit', 29);
INSERT INTO feedback_option VALUES (116, 'Some Benefit', 29);
INSERT INTO feedback_option VALUES (117, 'Quite helpful', 29);
INSERT INTO feedback_option VALUES (118, 'Very beneficial', 29);


CREATE TABLE IF NOT EXISTS conference
(
  ID             SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Title          VARCHAR(100)                     NOT NULL,
  Description    VARCHAR(400)                     NOT NULL,
  Start_Time     DATETIME                         NOT NULL,
  End_Time       DATETIME                         NOT NULL,
  Organiser      VARCHAR(30)                      NOT NULL,
  Location       VARCHAR(80)                      NOT NULL,
  Contact        CHAR(25)                         NOT NULL,
  Download_Avail TINYINT(1)                       NOT NULL,
  FilePath       VARCHAR(100),

  venue          SMALLINT    UNSIGNED             NOT NULL,
  Token          INT UNIQUE,

  Conference_Tag TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Schedule_Tag   TIMESTAMP,
  Speaker_Tag    TIMESTAMP,
  Sponsor_Tag    TIMESTAMP,
  C_Feedback_Tag TIMESTAMP,
  S_Feedback_Tag TIMESTAMP,


  CONSTRAINT Conference_pk PRIMARY KEY (ID),
  CONSTRAINT Conference_Venue_fk FOREIGN KEY (venue) REFERENCES venue (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO conference VALUES (1, 'DSTC',
                               'Definitive Surgical Trauma Care Course and Definitive Preoperative Nurses Trauma Care Course Combined Program Course No: 061//32',
                               '2014-07-02 08:00:00', '2014-07-04 4:00:00', 'DSTC', 'Epworth Richmond Auditorium',
                               'John Doe', 1, 'http://www.test.org/', 3, 100001, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO conference VALUES
  (2, 'Surgical', 'conference covering all surgical procedures', '2014-02-02 08:00:00', '2014-02-04 4:00:00',
   'Epworth Healthcare', 'Melbourne', 'Jane Smith', 1, 'http://www.test.org/', 3, 100002, NULL, NULL, NULL, NULL, NULL,
   NULL);
INSERT INTO conference VALUES
  (3, 'Trauma', 'Intensive trauma conference', '2014-03-03 08:00:00', '2014-03-07 4:00:00', 'DSTC', 'Melbourne',
   'Warren Hamstick', 0, 'http://www.test.org/', 2, 100003, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO conference VALUES
  (4, 'General practitioners', 'A fast paced conference in general medical practices', '2014-04-04 08:00:00',
   '2014-04-07 4:00:00', 'Epworth Healthcare', 'Albury', 'Timothy Dalton', 0, 'http://www.test.org/', 1, 100004, NULL,
   NULL, NULL, NULL, NULL, NULL);
INSERT INTO conference VALUES
  (5, 'MidYear', 'Refresher conference', '2014-03-03 08:00:00', '2014-06-07 4:00:00', 'DSTC', 'Melbourne', 'Warren Ham',
   0, 'http://www.test.org/', 2, 100005, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO conference VALUES
  (6, 'End of Year', 'Refresher conference', '2014-03-03 08:00:00', '2014-07-07 4:00:00', 'DSTC', 'Melbourne',
   'Warren Ham', 0, 'http://www.test.org/', 2, 100006, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO conference VALUES
  (7, 'DSTC conference', 'DSTC conference', '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC', 'Melbourne',
   'Jane Smith', 0, 'http://www.test.org/', 2, 100007, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO conference VALUES
  (8, 'DSTC and Future Trauma Care', 'Discussing about fure development of DSTC for dealing with increasing patients',
   '2014-02-02 08:00:00', '2014-02-04 4:00:00', 'Epworth', 'Epworth Richmond Auditorium', 'John Doe', 0,
   'http://www.test.org/', 3, 100008, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO conference VALUES
  (9, 'Surgical Research and Psychological Test', 'Topic is collaboration between surgeon and modern psychology',
   '2014-02-02 08:00:00', '2014-02-04 4:00:00', 'Epworth Healthcare', 'Melbourne', 'Kane Damih', 1,
   'http://www.test.org/', 3, 100009, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO conference VALUES
  (10, 'Trauma Care in early stage', 'Discuss about Intensive Trauma and Early Stage Care', '2014-03-03 08:00:00',
   '2014-03-07 4:00:00', 'DSTC', 'Melbourne', 'Herren Hisick', 0, 'http://www.test.org/', 2, 100010, NULL, NULL, NULL,
   NULL, NULL, NULL);

INSERT INTO conference VALUES (11, 'Relationship between Trauma and End of Year',
                               'Statistical research which reveals hidden relationship between Trauma an end season of year',
                               '2014-03-03 08:00:00', '2014-07-07 4:00:00', 'DSTC', 'Melbourne', 'Zen Zen', 0,
                               'http://www.test.org/', 2, 100011, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO conference VALUES
  (12, 'Collaboration in DSTC', 'Short report about collaborations which takes place in DSTC between various fields',
   '2014-02-02 08:00:00', '2014-11-02 18:00:00', 'DSTC', 'Melbourne', 'Ann Thim', 0, 'http://www.test.org/', 2, 100012,
   NULL, NULL, NULL, NULL, NULL, NULL);


CREATE TABLE IF NOT EXISTS conference_fb_section
(
  conference       SMALLINT UNSIGNED NOT NULL,
  feedback_section SMALLINT UNSIGNED NOT NULL,

  CONSTRAINT Conference_FB_Section_Conference_fk FOREIGN KEY (conference) REFERENCES conference (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT Conference_FB_Feedback_Section_fk FOREIGN KEY (feedback_section) REFERENCES feedback_section (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;


CREATE TABLE IF NOT EXISTS map
(
  ID            SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Map_Directory VARCHAR(100)                     NOT NULL,
  FilePath      VARCHAR(20)                      NOT NULL,

  conference    SMALLINT    UNSIGNED             NOT NULL,

  CONSTRAINT Map_pk PRIMARY KEY (ID),
  CONSTRAINT Map_Conference_fk FOREIGN KEY (conference) REFERENCES conference (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO map VALUES (1, 'img/', 'map_a.jpg', 1);
INSERT INTO map VALUES (2, 'img/', 'map_b.jpg', 2);

INSERT INTO map VALUES (3, 'img/map/', 'map_c.jpg', 3);
INSERT INTO map VALUES (4, 'img/map/', 'map_d.jpg', 4);


CREATE TABLE IF NOT EXISTS conference_section
(
  ID            SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Section_Title VARCHAR(100)                     NOT NULL,
  Ordering      INT(6),

  conference    SMALLINT    UNSIGNED             NOT NULL,

  CONSTRAINT Conference_Section_pk PRIMARY KEY (ID),
  CONSTRAINT Conference_Section_Conference_fk FOREIGN KEY (conference) REFERENCES conference (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;


INSERT INTO conference_section VALUES (1, 'Surgical Decision Making', 1, 1);
INSERT INTO conference_section VALUES (2, 'Surgical Techniques', 2, 1);

INSERT INTO conference_section VALUES (3, 'Future Trauma Care', 1, 8);
INSERT INTO conference_section VALUES (4, 'Psychological Techniques', 2, 9);
INSERT INTO conference_section VALUES (5, 'Statistical Approach to Trauma', 1, 10);


CREATE TABLE IF NOT EXISTS session
(
  ID                  SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Title               VARCHAR(100)                     NOT NULL,
  Description         VARCHAR(400),
  Start_Time          DATETIME                         NOT NULL,
  End_Time            DATETIME                         NOT NULL,
  Room_Location       VARCHAR(20)                      NOT NULL,
  Session_Chairperson VARCHAR(50),

  QA_Open             TINYINT(1)                       NOT NULL DEFAULT 0,

  conference_section  SMALLINT UNSIGNED                NOT NULL,
  feedback_section    SMALLINT UNSIGNED,

  CONSTRAINT Session_pk PRIMARY KEY (ID),
  CONSTRAINT Session_Conference_Section_fk FOREIGN KEY (conference_section) REFERENCES conference_section (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT Session_Feedback_Section_fk FOREIGN KEY (feedback_section) REFERENCES feedback_section (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO session VALUES (1, 'Case Presentation Decision Making (Interactive)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 07:50:00', '2012-11-30 08:00:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (2, 'Surgical Decision Making in Trauma Overview',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (3, 'Damage Control Overview',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 08:15:00', '2012-11-30 08:30:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (4, 'Case Presentation',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 08:30:00', '2012-11-30 08:40:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (5, 'Blunt Abdominal Trauma Overview',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 08:40:00', '2012-11-30 08:55:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (6, 'Case Presentation',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 08:55:00', '2012-11-30 09:05:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (7, 'Blunt Thoracic Trauma Overview',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 09:05:00', '2012-11-30 09:20:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (8, 'Case Presentation (Interactive)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 09:20:00', '2012-11-30 09:35:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (9, 'Group Discussion',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 09:35:00', '2012-11-30 09:45:00', 'Auditorium', 'P Danne', 0, 1, 1);

INSERT INTO session VALUES (10, 'Morning Tea',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 09:45:00', '2012-11-30 10:15:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (11, 'Penetration Abdominal Trauma overview',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 10:15:00', '2012-11-30 10:30:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (12, 'Case Presentation',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 10:30:00', '2012-11-30 10:40:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (13, 'ED Tracheotomy Overview',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 10:40:00', '2012-11-30 10:55:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (14, 'Case Presentation (Interactive)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 10:55:00', '2012-11-30 11:10:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (15, 'Panel Discussion',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (16, 'Case Presentation (Interactive)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium', 'P Danne', 0, 1, 1);
INSERT INTO session VALUES (17, 'Panel Discussion',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium', 'P Danne', 0, 1, 1);

INSERT INTO session VALUES (18, 'Subscavian/ Neck Exposure',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (19, 'Discussion/DVD',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:35:00', '2012-11-30 11:40:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (20, 'Fasciotomy',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:40:00', '2012-11-30 11:50:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (21, 'Discussion/DVD',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:50:00', '2012-11-30 11:55:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (22, 'Temporary Abdominal Closure',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 11:55:00', '2012-11-30 12:05:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (23, 'Discussion/DVD or Demonstration of VAC Pack',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 12:05:00', '2012-11-30 12:10:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (24, 'Craniotomy',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 12:10:00', '2012-11-30 12:20:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (25, 'Discussion/DVD',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 12:20:00', '2012-11-30 12:25:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (26, 'Perocardial Window',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 12:25:00', '2012-11-30 12:35:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (27, 'Discussion/DVD',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 12:35:00', '2012-11-30 12:40:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (28, 'Panel Discussion',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 12:40:00', '2012-11-30 12:55:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (29, 'Trade Display / Lunch',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 12:55:00', '2012-11-30 13:15:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (30, 'Bus 1 - depart for Parkville',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 13:15:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (31, 'Bus 2 - depart for Parkville',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 13:30:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (32, 'Department of Anatomy - Practical session (All Groups)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 14:00:00', '2012-11-30 17:00:00', 'Parkville', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (33, 'Bus Back to Epworth Richmond',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 17:00:00', '2012-11-30 17:45:00', 'Parkville', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (34, 'Problem Solving and Discussion Groups (Auditorium)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 17:45:00', '2012-11-30 18:30:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (35, 'Close',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 18:30:00', '2012-11-30 17:00:00', 'Auditorium', 'S Deane', 0, 2, 1);
INSERT INTO session VALUES (36, 'Course Dinner - Elim Gardens',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 18:45:00', '2012-11-30 17:00:00', 'Auditorium', 'S Deane', 0, 2, 1);

INSERT INTO session VALUES (37, 'Arrival - Tea/Coffe',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 07:00:00', '2012-12-01 07:30:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (38, 'Penetrating Thoracic Trauma',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 07:30:00', '2012-12-01 07:45:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (39, 'Case Presentation (Interactive)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 07:45:00', '2012-12-01 08:00:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (40, 'Haemodynamically Unstable Pelvic Fracture Overview',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 08:00:00', '2012-12-01 08:15:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (41, 'Case Presentation',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 08:15:00', '2012-12-01 08:25:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (42, 'Head Injury',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 08:25:00', '2012-12-01 08:40:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (43, 'Case Presentation',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 08:40:00', '2012-12-01 08:50:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (44, 'Penetrating Neck Injury',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 08:50:00', '2012-12-01 09:05:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (45, 'Case Presentation (Interactive)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 09:05:00', '2012-12-01 09:20:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (46, 'Vascular Limb Injury',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 09:20:00', '2012-12-01 09:35:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (47, 'Case Presentation (Interactive)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 09:35:00', '2012-12-01 09:50:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (48, 'Panel Discussion',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 09:50:00', '2012-12-01 09:55:00', 'Auditorium', 'M Richardson', 0, 2, 1);
INSERT INTO session VALUES (49, 'Morning Tea / Trade Display',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 09:55:00', '2012-12-01 10:50:00', 'Auditorium', 'M Richardson', 0, 2, 1);

INSERT INTO session VALUES (50, 'Spleen & Kidney',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 10:50:00', '2012-12-01 11:05:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (51, 'Discussion/DVD or Demonstration of VAC Pack',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 11:05:00', '2012-12-01 11:20:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (52, 'Liver',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 11:20:00', '2012-12-01 11:35:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (53, 'Discussion/DVD',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 11:35:00', '2012-12-01 11:50:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (54, 'Pancreas & Duodenum',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 11:50:00', '2012-12-01 12:05:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (55, 'Discussion/DVD',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 12:05:00', '2012-12-01 12:20:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (56, 'Cardiac & Lung Repair',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 12:20:00', '2012-12-01 12:35:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (57, 'Discussion/DVD',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 12:35:00', '2012-12-01 12:50:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (58, 'Bus 1 - Faculty/DPNTC departs',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 12:50:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (59, 'Bus 2 - Faculty/DSTC departs',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 13:00:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (60, 'Practical session (All Groups)',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 13:45:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (61, 'Discussion & Close at Werribee Campus',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 17:00:00', '2012-12-01 17:30:00', 'Werribee Campus', 'T. Wagner', 0, 2, 1);
INSERT INTO session VALUES (62, 'Bus Back to Epworth Richmond',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-12-01 17:30:00', '2012-12-01 17:00:00', 'Auditorium', 'T. Wagner', 0, 2, 1);

INSERT INTO session VALUES (63, 'Analysis of Future Trauma Care',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 07:50:00', '2012-11-30 08:00:00', 'Auditorium', 'P Danne', 0, 3, 7);
INSERT INTO session VALUES (64, 'Method of applying psychological research and its approach',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium', 'P Danne', 0, 4, 8);
INSERT INTO session VALUES (65, 'Statistical approach to Trauma',
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            '2012-11-30 08:15:00', '2012-11-30 08:30:00', 'Auditorium', 'P Danne', 0, 5, 9);


CREATE TABLE IF NOT EXISTS session_question
(
  ID         SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Question   VARCHAR(400)                     NOT NULL,
  Accepted   TINYINT(1)                       NOT NULL,
  Profile_Id VARCHAR(100),

  session    SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT Session_Question_pk PRIMARY KEY (ID),
  CONSTRAINT Session_Question_Session_fk FOREIGN KEY (session) REFERENCES session (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO session_question VALUES (1, 'Why do my legs feel itchy after a hot shower?', 1, 'AABCCEEDAA', 1);
INSERT INTO session_question VALUES
  (2, 'My gums sometimes bleed when I brush my teeth, could this be related to.. dredging Port Phillip Bay?', 1,
   'AABCCEEDAA', 2);
INSERT INTO session_question
VALUES (3, 'Have you ever heard of the Emancipation Proclaimation, and if so, is it Hip-hop?', 0, 'AABCCEEDAA', 3);
INSERT INTO session_question VALUES (4, 'Why is my undies so tight?', 1, 'DDDDDDDDDD', 4);
INSERT INTO session_question VALUES (5, 'Why have a handle on a enter door?', 1, 'DDDDDDDDDD', 5);

INSERT INTO session_question VALUES (6, 'How can you predict future Trauma?', 1, 'CCCCCCCCCC', 63);
INSERT INTO session_question VALUES (7, 'What is the best book for introduction of Psychology?', 1, 'CCCCCCCCCC', 64);
INSERT INTO session_question VALUES (8, 'Is statistical research always correct?', 0, 'AAAAAAAAAA', 65);


CREATE TABLE IF NOT EXISTS polling
(
  ID               SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Polling_Question VARCHAR(150)                     NOT NULL,
  session          SMALLINT UNSIGNED                NOT NULL,
  Available        TINYINT(1)                       NOT NULL DEFAULT 0,
  Open             TINYINT(1)                       NOT NULL DEFAULT 0,

  CONSTRAINT Polling_pk PRIMARY KEY (ID),
  CONSTRAINT Polling_Session_fk FOREIGN KEY (session) REFERENCES session (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO polling VALUES (1, 'Key Decision Point 1', 7, 0, 0);
INSERT INTO polling VALUES (2, 'Key Decision Point 2', 7, 0, 0);
INSERT INTO polling VALUES (3, 'Key Decision Point 2: Probabilities', 38, 0, 0);
INSERT INTO polling VALUES (4, 'Key Decision Point 3: Investigations', 38, 0, 0);
INSERT INTO polling VALUES (5, 'Key Decision Point 4', 38, 0, 0);
INSERT INTO polling VALUES (6, 'Key Decision Point 1', 14, 0, 0);
INSERT INTO polling VALUES (7, 'Key Decision Point 2', 14, 0, 0);
INSERT INTO polling VALUES (8, 'Key Decision Point 3: Which is NOT an appropriate strategy?', 14, 0, 0);
INSERT INTO polling VALUES (9, 'Key Decision Point 1', 14, 0, 0);
INSERT INTO polling VALUES (10, 'Key Decision Point 1', 45, 0, 0);
INSERT INTO polling VALUES (11, 'Surgical Approach', 45, 0, 0);
INSERT INTO polling VALUES (12, 'Key Decision Point 1', 47, 0, 0);

INSERT INTO polling VALUES (13, 'Key Decision Point 63', 63, 0, 0);
INSERT INTO polling VALUES (14, 'Key Decision Point 64', 64, 0, 0);
INSERT INTO polling VALUES (15, 'Key Decision Point 65: Probabilities', 65, 0, 0);
INSERT INTO polling VALUES (16, 'Key Decision Point 43', 43, 0, 0);
INSERT INTO polling VALUES (17, 'Key Decision Point 44', 44, 0, 0);
INSERT INTO polling VALUES (18, 'Key Decision Point 55: Probabilities', 55, 0, 0);
INSERT INTO polling VALUES (19, 'Key Decision Point 53', 53, 0, 0);
INSERT INTO polling VALUES (20, 'Key Decision Point 47', 47, 0, 0);
INSERT INTO polling VALUES (21, 'Key Decision Point 28: Probabilities', 28, 0, 0);


CREATE TABLE IF NOT EXISTS polling_option
(
  ID          SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Option_Text VARCHAR(80)                      NOT NULL,

  polling     SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT Polling_Option_pk PRIMARY KEY (ID),
  CONSTRAINT Polling_Option_Polling_fk FOREIGN KEY (polling) REFERENCES polling (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO polling_option VALUES (1, '1. Laparotomy', 1);
INSERT INTO polling_option VALUES (2, '2. FAST', 1);
INSERT INTO polling_option VALUES (3, '3. DPL', 1);
INSERT INTO polling_option VALUES (4, '4. Thoracotomy', 1);
INSERT INTO polling_option VALUES (5, '5. CT Head, Neck, Chest, Abdo', 1);
INSERT INTO polling_option VALUES (6, '1. Laparotomy', 2);
INSERT INTO polling_option VALUES (7, '2. Thoracotomy', 2);
INSERT INTO polling_option VALUES (8, '3. 2nd Chest Tube', 2);
INSERT INTO polling_option VALUES (9, '4. Admit ICU', 2);
INSERT INTO polling_option VALUES (10, '5. Cardiothoracic Surgery Consultation', 2);
INSERT INTO polling_option VALUES (11, '1. Stable and will not require surgery?', 3);
INSERT INTO polling_option VALUES (12, '2. Will need surgery to lung?', 3);
INSERT INTO polling_option VALUES (13, '3. Will need surgery to mediastinal structure?', 3);
INSERT INTO polling_option VALUES (14, '4. Likely to need ERRT?', 3);
INSERT INTO polling_option VALUES (15, '5. May require surgery – further investigation required?', 3);
INSERT INTO polling_option VALUES (16, '1. Contrast CT?', 4);
INSERT INTO polling_option VALUES (17, '2. CXR?', 4);
INSERT INTO polling_option VALUES (18, '3. Bronchoscopy?', 4);
INSERT INTO polling_option VALUES (19, '4. Oesophagoscopy?', 4);
INSERT INTO polling_option VALUES (20, '5. All of the Above?', 4);
INSERT INTO polling_option VALUES (21, '1. ERRT', 5);
INSERT INTO polling_option VALUES (22, '2. Anterolateral thorocotomy', 5);
INSERT INTO polling_option VALUES (23, '3. Sternotomy', 5);
INSERT INTO polling_option VALUES (24, '4. Post lateral thoracotomy', 5);
INSERT INTO polling_option VALUES (25, '5. All of the above', 5);
INSERT INTO polling_option VALUES (26, '1. FAST', 6);
INSERT INTO polling_option VALUES (27, '2. Left ICC', 6);
INSERT INTO polling_option VALUES (28, '3. 2nd IV Line', 6);
INSERT INTO polling_option VALUES (29, '4. EERT', 6);
INSERT INTO polling_option VALUES (30, '5. CXR', 6);
INSERT INTO polling_option VALUES (31, '1. EERT then OR', 7);
INSERT INTO polling_option VALUES (32, '2. Resus ++ then CT', 7);
INSERT INTO polling_option VALUES (33, '3. Resus ++ then OR', 7);
INSERT INTO polling_option VALUES (34, '4. Definitive thoracotomy then ICU', 7);
INSERT INTO polling_option VALUES (35, '1. Relieve cardiac tamponade', 8);
INSERT INTO polling_option VALUES (36, '2. Control cardiac laceration', 8);
INSERT INTO polling_option VALUES (37, '3. Suture bleeding intercostals vessels', 8);
INSERT INTO polling_option VALUES (38, '4. Manual cardiac compression', 8);
INSERT INTO polling_option VALUES (39, '5. Control lung hilum', 8);
INSERT INTO polling_option VALUES (40, '6. Primary repair of major vessels', 8);
INSERT INTO polling_option VALUES (41, '7. X-clamp descending aorta', 8);
INSERT INTO polling_option VALUES (42, '8. Tamponade pleural apex', 8);
INSERT INTO polling_option VALUES (43, '1. CTA neck chest?', 9);
INSERT INTO polling_option VALUES (44, '2. OR?', 9);
INSERT INTO polling_option VALUES (45, '3. CXR?', 9);
INSERT INTO polling_option VALUES (46, '4. Local exploration (see if platysma breached)?', 9);
INSERT INTO polling_option VALUES (47, '5. Suture discharge?', 9);
INSERT INTO polling_option VALUES (48, '1. OR immediately?', 10);
INSERT INTO polling_option VALUES (49, '2. Pull out knife in emergency?', 10);
INSERT INTO polling_option VALUES (50, '3. CTA?', 10);
INSERT INTO polling_option VALUES (51, '4. CXR?', 10);
INSERT INTO polling_option VALUES (52, '5. Call thoracic or ENT service?', 10);
INSERT INTO polling_option VALUES (53, '1. Transverse incision?', 11);
INSERT INTO polling_option VALUES (54, '2. Anterior border SCM?', 11);
INSERT INTO polling_option VALUES (55, '3. Median sternotomy +/- extension to neck?', 11);
INSERT INTO polling_option VALUES (56, '1. 2nd OR, exploration, fasciotomy?', 11);
INSERT INTO polling_option VALUES (57, '2. Angiogram, 2nd OR, fasiotomy?', 11);
INSERT INTO polling_option VALUES (58, '3. Angiogram, 2nd OR, exploration, fasciotomy?', 11);

INSERT INTO polling_option VALUES (59, '1. Laparotomy', 12);
INSERT INTO polling_option VALUES (60, '2. FAST', 12);
INSERT INTO polling_option VALUES (61, '3. DPL', 12);
INSERT INTO polling_option VALUES (62, '4. Thoracotomy', 12);
INSERT INTO polling_option VALUES (63, '5. CT Head, Neck, Chest, Abdo', 13);
INSERT INTO polling_option VALUES (64, '1. Laparotomy', 13);
INSERT INTO polling_option VALUES (65, '2. Thoracotomy', 13);
INSERT INTO polling_option VALUES (66, '3. 2nd Chest Tube', 13);
INSERT INTO polling_option VALUES (67, '4. Admit ICU', 14);
INSERT INTO polling_option VALUES (68, '5. Cardiothoracic Surgery Consultation', 14);
INSERT INTO polling_option VALUES (69, '1. Stable and will not require surgery?', 14);
INSERT INTO polling_option VALUES (70, '2. Will need surgery to lung?', 14);

INSERT INTO polling_option VALUES (71, '1. Laparotomy', 15);
INSERT INTO polling_option VALUES (72, '2. FAST', 15);
INSERT INTO polling_option VALUES (73, '3. DPL', 15);
INSERT INTO polling_option VALUES (74, '4. Thoracotomy', 15);
INSERT INTO polling_option VALUES (75, '5. CT Head, Neck, Chest, Abdo', 16);
INSERT INTO polling_option VALUES (76, '1. Laparotomy', 16);
INSERT INTO polling_option VALUES (77, '2. Thoracotomy', 16);
INSERT INTO polling_option VALUES (78, '3. 2nd Chest Tube', 16);
INSERT INTO polling_option VALUES (79, '4. Admit ICU', 17);
INSERT INTO polling_option VALUES (80, '5. Cardiothoracic Surgery Consultation', 17);

INSERT INTO polling_option VALUES (81, '1. Stable and will not require surgery?', 17);
INSERT INTO polling_option VALUES (82, '2. Will need surgery to lung?', 17);
INSERT INTO polling_option VALUES (83, '1. Laparotomy', 18);
INSERT INTO polling_option VALUES (84, '2. FAST', 18);
INSERT INTO polling_option VALUES (85, '3. DPL', 18);
INSERT INTO polling_option VALUES (86, '4. Thoracotomy', 18);
INSERT INTO polling_option VALUES (87, '5. CT Head, Neck, Chest, Abdo', 19);
INSERT INTO polling_option VALUES (88, '1. Laparotomy', 19);
INSERT INTO polling_option VALUES (89, '2. Thoracotomy', 19);
INSERT INTO polling_option VALUES (90, '3. 2nd Chest Tube', 19);

INSERT INTO polling_option VALUES (91, '4. Admit ICU', 20);
INSERT INTO polling_option VALUES (92, '5. Cardiothoracic Surgery Consultation', 20);
INSERT INTO polling_option VALUES (93, '1. Stable and will not require surgery?', 20);
INSERT INTO polling_option VALUES (94, '2. Will need surgery to lung?', 20);
INSERT INTO polling_option VALUES (95, '1. Laparotomy', 21);
INSERT INTO polling_option VALUES (96, '2. FAST', 21);
INSERT INTO polling_option VALUES (97, '3. DPL', 21);
INSERT INTO polling_option VALUES (98, '4. Thoracotomy', 21);


CREATE TABLE IF NOT EXISTS polling_response
(
  ID             SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  polling_option SMALLINT UNSIGNED                NOT NULL,
  Profile_Id     VARCHAR(100),

  CONSTRAINT Polling_Responses_pk PRIMARY KEY (ID),
  CONSTRAINT Polling_Responses_Polling_Option_fk FOREIGN KEY (polling_option) REFERENCES polling_option (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;


CREATE TABLE IF NOT EXISTS response_option
(
  ID                SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  Feedback_Response SMALLINT UNSIGNED                NOT NULL,
  feedback_option   SMALLINT UNSIGNED                NOT NULL,
  Profile_Id        VARCHAR(100),

  CONSTRAINT Response_Option_pk PRIMARY KEY (ID),
  CONSTRAINT Response_Option_Feedback_Option_fk FOREIGN KEY (feedback_option) REFERENCES feedback_option (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO response_option VALUES (1, 1, 1, 'AABCCEEDAA');
INSERT INTO response_option VALUES (2, 2, 2, 'AADDCCCAA');
INSERT INTO response_option VALUES (3, 3, 3, 'AABCCEEDAA');
INSERT INTO response_option VALUES (4, 4, 4, 'AABCCEEDAA');
INSERT INTO response_option VALUES (5, 5, 5, 'AABCCEEDAA');

INSERT INTO response_option VALUES (6, 6, 107, 'AABCCEEDAA');
INSERT INTO response_option VALUES (7, 7, 108, 'AABCCEEDAA');
INSERT INTO response_option VALUES (8, 8, 109, 'AABCCEEDAA');
INSERT INTO response_option VALUES (9, 6, 111, 'ABBBCCAAAB');
INSERT INTO response_option VALUES (10, 7, 112, 'ABBBCCAAAB');
INSERT INTO response_option VALUES (11, 8, 113, 'ABBBCCAAAB');
INSERT INTO response_option VALUES (12, 6, 116, 'AABCCEEDAA');
INSERT INTO response_option VALUES (13, 7, 117, 'DDDDDEACCB');
INSERT INTO response_option VALUES (14, 8, 118, 'DDDDDEACCB');


CREATE TABLE IF NOT EXISTS response_text
(
  ID                SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Question_Response  VARCHAR(250)                     NOT NULL,

  feedback_question SMALLINT UNSIGNED                NOT NULL,
  Feedback_Response SMALLINT UNSIGNED                NOT NULL,
  Profile_Id        VARCHAR(100),

  CONSTRAINT Response_Text_pk PRIMARY KEY (ID),
  CONSTRAINT Response_Text_Feedback_Question_fk FOREIGN KEY (feedback_question) REFERENCES feedback_question (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO response_text VALUES (1, 'QR00000', 1, 1, 'AABCCEEDAA');
INSERT INTO response_text VALUES (2, 'QR00001', 2, 2, 'AADDCCCAA');
INSERT INTO response_text VALUES (3, 'QR00002', 3, 3, 'ABBBCCAAAB');
INSERT INTO response_text VALUES (4, 'QR00003', 4, 4, 'AADDCCCAA');
INSERT INTO response_text VALUES (5, 'QR00004', 5, 5, 'AABCCEEDAA');

INSERT INTO response_text VALUES (6, 'QR00005', 26, 6, 'DDDDDEACCB');
INSERT INTO response_text VALUES (7, 'QR00006', 30, 7, 'DDDDDEACCB');
INSERT INTO response_text VALUES (8, 'QR00007', 28, 8, 'ABBBCCAAAB');


CREATE TABLE IF NOT EXISTS session_presenter
(
  presenter SMALLINT UNSIGNED NOT NULL,
  session   SMALLINT UNSIGNED NOT NULL,

  CONSTRAINT Session_Presenter_pk PRIMARY KEY (presenter, session),
  CONSTRAINT Session_Presenter_Session_fk FOREIGN KEY (session) REFERENCES session (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT Session_Presenter_Presenter_fk FOREIGN KEY (presenter) REFERENCES presenter (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO session_presenter VALUES (1, 1);
INSERT INTO session_presenter VALUES (2, 2);
INSERT INTO session_presenter VALUES (3, 3);
INSERT INTO session_presenter VALUES (4, 4);
INSERT INTO session_presenter VALUES (5, 5);
INSERT INTO session_presenter VALUES (6, 6);
INSERT INTO session_presenter VALUES (7, 7);
INSERT INTO session_presenter VALUES (8, 8);
INSERT INTO session_presenter VALUES (1, 11);
INSERT INTO session_presenter VALUES (2, 12);
INSERT INTO session_presenter VALUES (3, 13);
INSERT INTO session_presenter VALUES (4, 14);
INSERT INTO session_presenter VALUES (5, 15);
INSERT INTO session_presenter VALUES (6, 16);
INSERT INTO session_presenter VALUES (7, 16);
INSERT INTO session_presenter VALUES (8, 16);
INSERT INTO session_presenter VALUES (7, 18);
INSERT INTO session_presenter VALUES (8, 20);
INSERT INTO session_presenter VALUES (9, 22);
INSERT INTO session_presenter VALUES (10, 24);
INSERT INTO session_presenter VALUES (11, 26);
INSERT INTO session_presenter VALUES (12, 28);
INSERT INTO session_presenter VALUES (13, 28);
INSERT INTO session_presenter VALUES (1, 28);
INSERT INTO session_presenter VALUES (1, 32);
INSERT INTO session_presenter VALUES (2, 32);
INSERT INTO session_presenter VALUES (3, 38);
INSERT INTO session_presenter VALUES (4, 38);
INSERT INTO session_presenter VALUES (5, 39);
INSERT INTO session_presenter VALUES (6, 40);
INSERT INTO session_presenter VALUES (7, 41);
INSERT INTO session_presenter VALUES (8, 42);
INSERT INTO session_presenter VALUES (9, 43);
INSERT INTO session_presenter VALUES (10, 44);
INSERT INTO session_presenter VALUES (11, 45);
INSERT INTO session_presenter VALUES (12, 46);
INSERT INTO session_presenter VALUES (13, 47);
INSERT INTO session_presenter VALUES (1, 50);
INSERT INTO session_presenter VALUES (2, 52);
INSERT INTO session_presenter VALUES (3, 53);
INSERT INTO session_presenter VALUES (4, 54);
INSERT INTO session_presenter VALUES (5, 56);

INSERT INTO session_presenter VALUES (1, 63);
INSERT INTO session_presenter VALUES (2, 64);
INSERT INTO session_presenter VALUES (3, 65);
INSERT INTO session_presenter VALUES (5, 63);
INSERT INTO session_presenter VALUES (6, 64);
INSERT INTO session_presenter VALUES (6, 65);


CREATE TABLE IF NOT EXISTS session_equipment
(
  equipment SMALLINT UNSIGNED NOT NULL,

  CONSTRAINT Session_Equipment_pk PRIMARY KEY (equipment),
  CONSTRAINT Session_Equipment_Equipment_fk FOREIGN KEY (equipment) REFERENCES equipment (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE

)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO session_equipment VALUES (1);
INSERT INTO session_equipment VALUES (2);
INSERT INTO session_equipment VALUES (3);
INSERT INTO session_equipment VALUES (4);


CREATE TABLE IF NOT EXISTS sponsor
(
  ID                SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
  Name              VARCHAR(40)                      NOT NULL,
  FilePath          VARCHAR(100),
  Short_Desc        TEXT                             NOT NULL,
  URL               VARCHAR(100)                     NOT NULL,

  session_equipment SMALLINT  UNSIGNED               NOT NULL,

  CONSTRAINT Sponsor_pk PRIMARY KEY (ID),
  CONSTRAINT Sponsor_Session_Equipment_fk FOREIGN KEY (session_equipment) REFERENCES session_equipment (equipment)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO sponsor VALUES (1, 'Royal Australasian College of Surgeons', 'images/life.jpg',
                            'Formed in 1927 the Royal Australasian Collage of surgeons is a non-profit organisation.',
                            'http://www.surgeons.org/', 1);
INSERT INTO sponsor VALUES
  (2, 'IATSIC', 'images/death.jpg', 'International Association for Trauma Surgery and Intensive Care',
   'http://www.iatsic.org/', 2);
INSERT INTO sponsor VALUES (3, 'Covidien', 'images/the.jpg',
                            'Covidien is a $10 billion global healthcare products leader dedicated to innovation and long-term growth.',
                            'http://www.covidien.com/covidien/pages.aspx', 3);
INSERT INTO sponsor VALUES (4, 'KCI', 'images/same.jpg',
                            'Our proprietary KCI negative pressure technologies have revolutionized the way in which caregivers treat a wide variety of wound types',
                            'http://www.kci-medical.com.au/AU-ENG/home', 4);

INSERT INTO sponsor VALUES
  (5, 'Australasian College of Surgeons', 'images/he.jpg', 'established in 1987, specilized for Surgeon .',
   'http://www.surgeons.org/', 1);
INSERT INTO sponsor
VALUES (6, 'IAS', 'images/did.jpg', 'International Association of Surgeon', 'http://www.ias.org/', 2);
INSERT INTO sponsor VALUES
  (7, 'Allianz', 'images/care.jpg', 'Allianz is a Australian healthcare industry leader .', 'http://www.allianz.com/',
   3);



CREATE TABLE IF NOT EXISTS conference_sponsor
(
  conference SMALLINT    UNSIGNED NOT NULL,
  sponsor    SMALLINT  UNSIGNED   NOT NULL,

  CONSTRAINT Conference_Sponsor_pk PRIMARY KEY (conference, sponsor),
  CONSTRAINT Conference_Sponsor_Conference_fk FOREIGN KEY (conference) REFERENCES conference (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT Conference_Sponsor_Sponsor_fk FOREIGN KEY (sponsor) REFERENCES sponsor (ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

INSERT INTO conference_sponsor VALUES (1, 1);
INSERT INTO conference_sponsor VALUES (1, 2);
INSERT INTO conference_sponsor VALUES (1, 3);
INSERT INTO conference_sponsor VALUES (1, 4);

INSERT INTO conference_sponsor VALUES (2, 1);
INSERT INTO conference_sponsor VALUES (2, 2);


-- -------- - ------------------------------------------------------------------------------------------------
-- Triggers - used to update the tag columns on the conference table that are used for Etagging the json files
-- -------- - ------------------------------------------------------------------------------------------------

-- conference-feedback.json
CREATE TRIGGER `Conference_FB_Section_AI` AFTER INSERT ON `conference_fb_section`
FOR EACH ROW UPDATE `conference`
SET `C_Feedback_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Conference_FB_Section_AU` AFTER UPDATE ON `conference_fb_section`
FOR EACH ROW UPDATE `conference`
SET `C_Feedback_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Conference_FB_Section_AD` AFTER DELETE ON `conference_fb_section`
FOR EACH ROW UPDATE `conference`
SET `C_Feedback_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference;

-- conference.json
CREATE TRIGGER `Map_AI` AFTER INSERT ON `map`
FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Map_AU` AFTER UPDATE ON `map`
FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Map_AD` AFTER DELETE ON `map`
FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference;

-- conference.json
CREATE TRIGGER `Venue_AI` AFTER INSERT ON `venue`
FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `venue` = new.ID;

CREATE TRIGGER `Venue_AU` AFTER UPDATE ON `venue`
FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `venue` = new.ID;

CREATE TRIGGER `Venue_AD` AFTER DELETE ON `venue`
FOR EACH ROW UPDATE `conference`
SET `Conference_Tag` = CURRENT_TIMESTAMP
WHERE `venue` = old.ID;

-- conference-feedback.json  session-feedback.json
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

-- conference-feedback.json  session-feedback.json
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

-- conference-feedback.json  session-feedback.json
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

-- schedule.json
CREATE TRIGGER `Conference_Section_AI` AFTER INSERT ON `conference_section`
FOR EACH ROW UPDATE `conference`
SET `Schedule_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Conference_Section_AU` AFTER UPDATE ON `conference_section`
FOR EACH ROW UPDATE `conference`
SET `Schedule_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Conference_Section_AD` AFTER DELETE ON `conference_section`
FOR EACH ROW UPDATE `conference`
SET `Schedule_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference;

-- schedule.json  speaker.json
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
WHERE SP.presenter = new.ID;

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
WHERE SP.presenter = new.ID;

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
WHERE SP.presenter = old.ID;

-- schedule.json  speaker.json  session-feedback.json
CREATE TRIGGER `Session_AI` AFTER INSERT ON `session`
FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP,
  C.S_Feedback_Tag = CURRENT_TIMESTAMP
WHERE CS.ID = new.conference_section;

CREATE TRIGGER `Session_AU` AFTER UPDATE ON `session`
FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP,
  C.S_Feedback_Tag = CURRENT_TIMESTAMP
WHERE CS.ID = new.conference_section;

CREATE TRIGGER `Session_AD` AFTER DELETE ON `session`
FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP,
  C.S_Feedback_Tag = CURRENT_TIMESTAMP
WHERE CS.ID = old.conference_section;

-- schedule.json  speaker.json
CREATE TRIGGER `Session_Presenter_AI` AFTER INSERT ON `session_presenter`
FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE S.ID = new.session;

CREATE TRIGGER `Session_Presenter_AU` AFTER UPDATE ON `session_presenter`
FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE S.ID = new.session;

CREATE TRIGGER `Session_Presenter_AD` AFTER DELETE ON `session_presenter`
FOR EACH ROW UPDATE `conference` C
  INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
  INNER JOIN `session` S
    ON S.conference_section = CS.ID
SET C.Schedule_Tag = CURRENT_TIMESTAMP,
  C.Speaker_Tag    = CURRENT_TIMESTAMP
WHERE S.ID = old.session;

-- sponsor.json
CREATE TRIGGER `Conference_Sponsor_AI` AFTER INSERT ON `conference_sponsor`
FOR EACH ROW UPDATE `conference`
SET `Sponsor_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Conference_Sponsor_AU` AFTER UPDATE ON `conference_sponsor`
FOR EACH ROW UPDATE `conference`
SET `Sponsor_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = new.conference;

CREATE TRIGGER `Conference_Sponsor_AD` AFTER DELETE ON `conference_sponsor`
FOR EACH ROW UPDATE `conference`
SET `Sponsor_Tag` = CURRENT_TIMESTAMP
WHERE `ID` = old.conference;

-- sponsor.json
CREATE TRIGGER `Sponsor_AI` AFTER INSERT ON `sponsor`
FOR EACH ROW UPDATE conference C
  INNER JOIN conference_sponsor CS
    ON C.ID = CS.conference
SET C.Sponsor_Tag = CURRENT_TIMESTAMP
WHERE CS.sponsor = new.ID;

CREATE TRIGGER `Sponsor_AU` AFTER UPDATE ON `sponsor`
FOR EACH ROW UPDATE conference C
  INNER JOIN conference_sponsor CS
    ON C.ID = CS.conference
SET C.Sponsor_Tag = CURRENT_TIMESTAMP
WHERE CS.sponsor = new.ID;

CREATE TRIGGER `Sponsor_AD` AFTER DELETE ON `sponsor`
FOR EACH ROW UPDATE conference C
  INNER JOIN conference_sponsor CS
    ON C.ID = CS.conference
SET C.Sponsor_Tag = CURRENT_TIMESTAMP
WHERE CS.sponsor = old.ID;


