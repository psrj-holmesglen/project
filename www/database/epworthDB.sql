﻿
-- Version 4.1.13

Drop Table If Exists conference_sponsor;
Drop Table If Exists sponsor;
Drop Table If Exists session_equipment;
Drop Table If Exists session_presenter; 
Drop Table If Exists reponse_text;
Drop Table If Exists response_option;
Drop Table If Exists polling_response;
Drop Table If Exists polling_option;
Drop Table If Exists polling;
Drop Table If Exists session_question;
Drop Table If Exists session; 
Drop Table If Exists conference_section;
Drop Table If Exists map;
Drop Table If Exists conference_fb_section;
Drop Table If Exists conference; 
Drop Table If Exists feedback_option;
Drop Table If Exists feedback_question;
Drop Table If Exists feedback_section; 
Drop Table If Exists feedback;
Drop Table If Exists equipment;
Drop Table If Exists presenter; 
Drop Table If Exists venue;
Drop Table If Exists question_type;
Drop Table If Exists business_rules;
Drop Table If Exists user;



Create Table If Not Exists user
(
	 ID 			SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 First_Name		Char(25)	Not Null,
	 Last_Name 		Char(30)	Not Null,
	 User_name		Varchar(30) Not Null,
	 Email			Varchar(50) Not Null,
	 Password		Char(32)	NOt Null,

	 Constraint User_pk Primary Key (ID)	
) Engine=InnoDB Default Charset=utf8;

INSERT INTO user VALUES(1, 'Jenn', 'de Peyrecave', 'Jenny', 'jenny@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES(2, 'Will', 'Budds', 'Will', 'Will@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES(3, 'Tom', 'Budds', 'Tom', 'tom@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES(4, 'Caue', 'Motta', 'Caue', 'caue@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');
INSERT INTO user VALUES(5, 'Shohei', 'M', 'Shohei', 'shohei@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63');



Create Table If Not Exists business_rules
(
	 Bus_Rule		Char(30)	Not Null,
	 Value			Char(30)	Not Null,

	 Constraint BusinessRules_pk Primary Key (Bus_Rule)
) Engine=InnoDB Default Charset=utf8;

Insert Into business_rules Values ('Dont Blink','yes');
Insert Into business_rules Values ('Blink and your dead','yes');
Insert Into business_rules Values ('Dont turn your back','yes');
Insert Into business_rules Values ('Dont look away','yes');
Insert Into business_rules Values ('And dont blink','yes');



Create Table If Not Exists question_type
(
	 question_type		Char(10)	Not Null,
	 Type_Description	Char(100),

	 Constraint Question_Type_pk Primary Key (question_type)
) Engine=InnoDB Default Charset=utf8;

Insert Into question_type Values ('Long','Expected to take over 10 minutes to explain');
Insert Into question_type Values ('Short','Expected to take under 10 minutes to explain');
Insert Into question_type Values ('Specific','An in depth question that requires previous experience in the field');
Insert Into question_type Values ('Multi','Far to complex to explain earthling');
Insert Into question_type Values ('VShort','Yes or No');



Create Table If Not Exists venue
(
	 ID				SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Name			Char(30) 	Not Null,
	 Company		Char(10),
	 Street			VarChar(50) Not Null,
	 Suburb			Char(10) 	Not Null,
	 Post_Code		SmallInt(4)	Not Null,

	 Constraint Venue_pk Primary Key (ID)
) Engine=InnoDB Default Charset=utf8;

Insert Into venue Values (1,'Epworth Richmond','Epworth','89 Bridge Rd','Richmond', 3000);
Insert Into venue Values (2,'Holmesglen','Epworth','22 Smiths St','Morrabbin',3590);
Insert Into venue Values (3,'Hawthorne Hospital','Epworth','10 Sturt St','Hawthorne', 3333);
Insert Into venue Values (4,'Albury Medical Centre','Epworth','45 Medical St','Kinsington',3121);
Insert Into venue Values (5,'Royal Melbourne Hospital','Epworth','55 Queens Rd','Melbourne',3100);

Insert Into venue Values (6,'EpworthCamberwell','Epworth','888 Toorak Rd','Camberwell',3124);
Insert Into venue Values (7,'Epworth Eastern','Epworth','1 Arnold St','Box Hill',3128);



Create Table If Not Exists presenter
(
	 ID					SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Title				VarChar(20)		Not Null,
	 First_Name			VarChar(30)		Not Null,
	 Last_Name			VarChar(30)		Not Null,
	 Organisation		VarChar(150)	Not Null,
	 Medical_Field		VarChar(50),
	 Position			VarChar(100),
	 Qualification		VarChar(100)	Not Null,
	 Short_Bio			VarChar(250)	Not Null,
	 Filepath			VarChar(100),
	 Last_Updated		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

	 Constraint Presenter_pk Primary Key (ID)
 
) Engine=InnoDB Default Charset=utf8; 


Insert Into presenter Values (1,'Dr','Walter L.','Biffl','Denver Health Medical Center','Surgery & Patient Safety/Quality',		'Head of Anatomy','MD','Dr Oak is chief of medicine at the Handless School of Anatomy','c:/games/MyLittlePony',  '2014-02-25');
Insert Into presenter Values (2,'Dr','Phillip','Antippa','Royal Melbourne Hospital and Peter MacCallum Cancer Centre',	'Cardiothoracic Surgeon',	'Chairman',			'MD','Dr Evil was frozen till the year of 1997','http://www.evil.com',     '2014-02-25');
Insert Into presenter Values (3,'Dr','Peter','Bautz','Royal Adelaide Hospital',	'Trauma Surgeon',	'Head of Research ','MchD','Dr Octopus was the prime inventor of Octobots','http://www.drock.com',     '2014-02-25');

Insert Into presenter Values (4,'Dr','Grant','Christey','Waikato Hospital and Midland Regional Trauma System', 'General Surgeon','Director of Trauma','MD','trained in New Zealand as a general surgeon and has a strong and long-standing interest in general surgery and trauma.', '3.jpg',     '2014-02-25');
Insert Into presenter Values (5,'Prof','Stephen','Deane','University of Newcastle, John Hunter Hospital, Hunter NEw England LHD','Surgery','Director of Trauma','MD','He has been recognised professionally for his contributions to advancement of Trauma Care','3.jpg',     '2014-02-25');
Insert Into presenter Values (6,'Prof','Russell','Gruen','The Alfred and Monash University','Surgery','Surgeon','PhD', 'He now heads an active teaching and research program.','1.jpg',     '2014-02-25');

Insert Into presenter Values (7,'Dr','Annette','Holian','National Critical Care and Trauma response Centre','Orthopaedic and Trauma Surgeon','Head of Anatomy','MD','Dr Oak is chief of medicine at the Handless School of Anatomy','c:/games/MyLittlePony',     '2014-02-25');
Insert Into presenter Values (8,'Mister','Rondhir','Jithoo','Consults at Epworth Group Hospitals','Cranial Trauma','Consultant','MD','He has a background of trauma experience and cranial trauma especially.','3.jpg',     '2014-02-25');

Insert Into presenter Values (9,'Dr','Bhadu','Kavar','The Royal Melbourne Hospital','Neurosurgeon', 'Consultant', 'MD', 'He has been an instructor for DSTC Melbourne since its commencement in 1998.','0.jpg',     '2014-02-25');
Insert Into presenter Values (10, 'Dr','Christian','Kenfield','Australian Army','Trauma and Hepatobillary/Surgical Oncology.', 'Major in the Australian Army','','Has served on operations and exercises on Thursday Island, Timor Leste and Solomon Islands and Papua New Guinea.',       '1.jpg',     '2014-02-25');


Insert Into presenter Values (11,'A/Prof', 'Martin','Richardson','University of Melbourne & Monash University','Clinical Practise','Associate Professor at both University of Melbourne and Monash University.','PhD', 'He is on the research board of the VOTOR and is an active member of the RANR LCDR.','2.jpg',     '2014-02-25'); 
Insert Into presenter Values (12,'Dr','Ben','Thomson','Royal Melbourne Hospital','Trauma', 'HPB and Trauma surgeon','MD', 'He has been a member of the DSTC faculty for the last 5 years.','3.jpg',     '2014-02-25');
Insert Into presenter Values (13,'Dr','Martin','Wullschleger','Royal Brisbane & Womens Hospital','General and Trauma surgery','Surgeon', 'PhD', 'is a swiss trained General and Trauma surgeon.', '4.jpg',     '2014-02-25');

Insert Into presenter Values (14,'Dr','Robert','Maningham','Epworth Camberwell','Surgery','Surgeon', 'Director of Surgery', 'is a  is chief of surgery at the School of Camberwell Surgery.', 'img/presenter/1.jpg',     '2014-02-25');
Insert Into presenter Values (15,'Dr','George','Wills','Epworth Eastern','General  Surgery','Surgeonf ', 'phD', 'He is a trained General and Trauma surgeon.', 'img/presenter/2.jpg',     '2014-02-25');



Create Table If Not Exists equipment
(
	 ID					SMALLINT  UNSIGNED AUTO_INCREMENT	Not Null,
	 Equipment_Name		VarChar(30)		Not Null,
	 Equipment_Type 	VarChar(60)		Not Null,
	 Supplier_Webite 	VarChar(50),

	 Constraint Equipment_pk Primary Key (ID)
) Engine=InnoDB Default Charset=utf8;

Insert Into equipment Values (1,'CT Scanner','Scanner','' );
Insert Into equipment Values (2,'PET','Functional imaging technique','');
Insert Into equipment Values (3,'MRI','Magnetic resonance imaging','www.magnetec.com');
Insert Into equipment Values (4,'Ultrasound','Imaging technique','');




Create Table If Not Exists feedback
(
	 ID					SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Feedback_Title		VarChar(50)	Not Null,
	 Feedback_Desc		VarChar(250),
	 Last_Updated		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	 Constraint Feedback_pk Primary Key (ID)
) Engine=InnoDB Default Charset=utf8;

Insert Into feedback Values (1, 'Testing feedback', 'This is for testing purposes', '2014-02-24 10:10:10');

Insert Into feedback Values (2, 'feedback for conference 8', 'This is for testing purposes', '2014-02-24 10:10:10');
Insert Into feedback Values (3, 'feedback for conference 9', 'This is for testing purposes', '2014-02-24 10:10:10');
Insert Into feedback Values (4, 'feedback for conference 10', 'This is for testing purposes', '2014-02-24 10:10:10');






Create Table If Not Exists feedback_section
(
	 ID 			SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 
	 Section_Start	DATETIME 	Not Null,
	 Section_End	DATETIME    Not Null,
	 Section_Title	VarChar(50)	Not Null,
	 Section_Desc	VarChar(250),
	 Type 			Enum('conference', 'session', 'Demographic') Not Null,
	 Last_Updated	TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

     feedback	SMALLINT UNSIGNED Not Null,
     
	 Constraint Feedback_Section_pk Primary Key (ID),
	 Constraint Feedback_Section_Feedback_fk Foreign Key (feedback) References feedback (ID) ON DELETE CASCADE ON UPDATE CASCADE
	
) Engine=InnoDB Default Charset=utf8;

Insert Into feedback_section values (1,'2014-12-25 12:50','2014-12-25 13:50','Section A','Confidence levels & Overall experience of course', 'Demographic', '2014-02-24 10:10:10',1);
Insert Into feedback_section values (2,'2014-12-25 13:50','2014-12-25 14:50','Section B','Curriculum', 'session', '2014-02-24 10:10:10',1);
Insert Into feedback_section values (3,'2014-12-25 14:50','2014-12-25 15:50','Section C','Teaching materials & methods', 'conference', '2014-02-24 10:10:10',1);
Insert Into feedback_section values (4,'2014-12-25 14:50','2014-12-25 15:50','Section D','Teaching outcomes', 'session', '2014-02-24 10:10:10',1);
Insert Into feedback_section values (5,'2014-12-25 14:50','2014-12-25 15:50','Section E','Assessment & feedback', 'Demographic', '2014-02-24 10:10:10',1);
Insert Into feedback_section values (6,'2014-12-25 14:50','2014-12-25 15:50','Section E','General Comments', 'Demographic', '2014-02-24 10:10:10',1);

Insert Into feedback_section values (7,'2014-12-25 12:50','2014-12-25 13:50','Section TYPE-I','Dealing with foreign patients', 'Demographic', '2014-02-24 10:10:10',2);
Insert Into feedback_section values (8,'2014-12-25 13:50','2014-12-25 14:50','Section TYPE-II','Complex system and brain behaviour', 'session', '2014-02-24 10:10:10',3);
Insert Into feedback_section values (9,'2014-12-25 14:50','2014-12-25 15:50','Section TYPE-III','Statistical Research method', 'session', '2014-02-24 10:10:10',4);



Create Table If Not Exists feedback_question
(
	 ID		SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Question_Number	VarChar(5)	Not Null,
	 Question_Text		VarChar(200)	Not Null,
	 Type				SmallInt(4)	Not Null,
	 
	 question_type		Char(10),
	 feedback_section	SMALLINT UNSIGNED Not Null,

	 Constraint Feedback_Question_pk Primary Key (ID),
	 Constraint Feedback_Question_Question_Type_fk Foreign Key (question_type) References question_type (question_type)  ON DELETE CASCADE ON UPDATE CASCADE,
	 Constraint Feedback_Question_Feedback_Section_fk Foreign Key (feedback_section) References feedback_section (ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

Insert Into feedback_question values (1,'0001','Confidence level dealing with major trauma prior to the DSTC',1,'Multi', 1);
Insert Into feedback_question values (2,'0002','Confidence level after having completed the dstc',1,'Multi',1);
Insert Into feedback_question values (3,'0003','Regarding your overall experience of the course, the DSTC was of:',1,'Multi',1);
Insert Into feedback_question values (4,'Q004','Regarding course objectives, to what degree were they clear & appropriate:', 1,'Multi',1);
Insert Into feedback_question values (5,'Q005','Regarding course workload it was:', 1,'Multi',1);
Insert Into feedback_question values (6,'Q006','Regarding course content, how do you rate the importance of Surgical Descision Making:', 1,'Multi',1);
Insert Into feedback_question values (7,'Q007','Regarding course content, how do you rate the importance of Surgical Technique Theory:', 1,'Multi',1);
Insert Into feedback_question values (8,'Q008','How valuable was the Manual?', 1,'Multi',1);
Insert Into feedback_question values (9,'Q009','How valuable was the DVD Material?', 1,'Multi',1);
Insert Into feedback_question values (10,'Q010','How valuable was the Lectures?', 1,'Multi',1);
Insert Into feedback_question values (11,'Q011','How valuable was the Lectures?', 1,'Multi',1);
Insert Into feedback_question values (12,'Q012','How valuable was the Labs?', 1,'Multi',1);
Insert Into feedback_question values (13,'Q013','How valuable was the Case Discussions / Strategic Thinking / Problem Solving?', 1,'Multi',1);
Insert Into feedback_question values (14,'Q014','Surgical Descision Making Sessions - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1,'Multi',1);
Insert Into feedback_question values (15,'Q015','Practical Workshops - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1,'Multi',1);
Insert Into feedback_question values (16,'Q016','Problem Solving open forums & discussion groups - Please rate the degree you feel these teaching sessions have improved your ability to deal with a major trauma situation:', 1,'Multi',1);
Insert Into feedback_question values (17,'Q017','To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1,'Multi',1);
Insert Into feedback_question values (18,'Q017','To what degree is ongoing feedback to participants a fair & appropriate way to monitor fulfilment of the course objectives', 1,'Multi',1);
Insert Into feedback_question values (19,'Q018','How useful was the ongoing feedback you recieved from DSTC instructors?', 1,'Multi',1);
  
Insert Into feedback_question values (20,'Q020','Regarding course value for money, it was:',1,'Multi',1);
Insert Into feedback_question values (21,'Q021','The best features of the course were: (circle as many as necessary)',1,'Multi',1);
Insert Into feedback_question values (22,'Q022','The worst features of the course were:',1,'Multi',1);
Insert Into feedback_question values (23,'Q023','Suggested Improvements',1,'Multi',1);
Insert Into feedback_question values (24,'Q024','Would you recommend this course to others?',1,'Multi',1);

Insert Into feedback_question values (25,'0025','Dealing with light trauma prior to the DSTC',2,'Multi', 7);
Insert Into feedback_question values (26,'0026',' Regarding patient response after having the dstc',1,'Multi',7);
Insert Into feedback_question values (27,'0027','Regarding whole experience of the course:',2,'Multi',8);
Insert Into feedback_question values (28,'Q028','Regarding course objectives, to what degree were they clear & appropriate:', 1,'Multi',8);
Insert Into feedback_question values (29,'Q029','Regarding course, how to look after patients who has serious trauma after seeing them:', 2,'Multi',9);
Insert Into feedback_question values (30,'Q030','Regarding course content, what is your background to make Surgical Descision:', 1,'Multi',9);



Create Table If Not Exists feedback_option
(
	 ID					SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Option_Number		VarChar(5),
	 Option_Text		VarChar(100),

	 feedback_question	SMALLINT UNSIGNED Not Null,

	 Constraint Feedback_Option_pk Primary Key (ID),
	 Constraint Feedback_Option_Feedback_Question_fk Foreign Key (feedback_question) References feedback_question (ID)  ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

Insert Into feedback_option values (1, '0001','Not confident in any case', 1);
Insert Into feedback_option values (2,'0002','Confident only in some cases',1);
Insert Into feedback_option values (3,'0003','Confident in most cases',1);
Insert Into feedback_option values (4,'0004','Confident with every major trauma situation',1);
Insert Into feedback_option values (5,'0005','Uncomfortable with all areas of major trauma',2);
Insert Into feedback_option values (6,'0006','Confident & competent only in some areas of major trauma',2);
Insert Into feedback_option values (7,'0007','Confident & competent in most areas of major trauma',2);
Insert Into feedback_option values (8,'0008','Confident & competent with any major trauma situation',2);
Insert Into feedback_option values (9,'0009','No benefit',3);
Insert Into feedback_option values (10,'0010','Some Benefit',3);
Insert Into feedback_option values (11,'0011','Quite helpful',3);
Insert Into feedback_option values (12,'0012','Very beneficial',3);

Insert Into feedback_option values (13,'0013','Indispensable',3);
Insert Into feedback_option values (14,'0014','Not at all',4);
Insert Into feedback_option values (15,'0015','To a low degree',4);
Insert Into feedback_option values (16,'0016','To a moderate degree',4);
Insert Into feedback_option values (17,'0017','To a high degree',4);
Insert Into feedback_option values (18,'0018','To a very high degree',4);
Insert Into feedback_option values (19,'0019','Inappropriately low',5);
Insert Into feedback_option values (20,'0020','About right',5);
Insert Into feedback_option values (21,'0021','Inappropriately high',5);
Insert Into feedback_option values (22,'0022','No benefit',6);
Insert Into feedback_option values (23,'0023','Some Benefit',6);
Insert Into feedback_option values (24,'0024','Quite helpful',6);
Insert Into feedback_option values (25,'0025','Very beneficial',6);
Insert Into feedback_option values (26,'0026','Indispensable',6);

Insert Into feedback_option values (27,'0027','No benefit',7);
Insert Into feedback_option values (28,'0028','Some Benefit',7);
Insert Into feedback_option values (29,'0029','Quite helpful',7);
Insert Into feedback_option values (30,'0030','Very beneficial',7);
Insert Into feedback_option values (31,'0031','Indispensable',7);
Insert Into feedback_option values (32,'0032','No benefit',8);
Insert Into feedback_option values (33,'0033','Some Benefit',8);
Insert Into feedback_option values (34,'0034','Quite helpful',8);
Insert Into feedback_option values (35,'0035','Very beneficial',8);
Insert Into feedback_option values (36,'0036','Indispensable',8);
Insert Into feedback_option values (37,'0037','No benefit',9);
Insert Into feedback_option values (38,'0038','Some Benefit',9);
Insert Into feedback_option values (39,'0039','Quite helpful',9);
Insert Into feedback_option values (40,'0040','Very beneficial',9);
Insert Into feedback_option values (41,'0041','Indispensable',9);
Insert Into feedback_option values (42,'0042','No benefit',10);
Insert Into feedback_option values (43,'0043','Some Benefit',10);
Insert Into feedback_option values (44,'0044','Quite helpful',10);
Insert Into feedback_option values (45,'0045','Very beneficial',10);
Insert Into feedback_option values (46,'0046','Indispensable',10);
Insert Into feedback_option values (47,'0047','No benefit',11);
Insert Into feedback_option values (48,'0048','Some Benefit',11);
Insert Into feedback_option values (49,'0049','Quite helpful',11);
Insert Into feedback_option values (50,'0050','Very beneficial',11);
Insert Into feedback_option values (51,'0051','Indispensable',11);
Insert Into feedback_option values (52,'0052','No benefit',12);
Insert Into feedback_option values (53,'0053','Some Benefit',12);
Insert Into feedback_option values (54,'0054','Quite helpful',12);
Insert Into feedback_option values (55,'0055','Very beneficial',12);
Insert Into feedback_option values (56,'0056','Indispensable',12);
Insert Into feedback_option values (57,'0057','No benefit',13);
Insert Into feedback_option values (58,'0058','Some Benefit',13);
Insert Into feedback_option values (59,'0059','Quite helpful',13);
Insert Into feedback_option values (60,'0060','Very beneficial',13);
Insert Into feedback_option values (61,'0061','Indispensable',13);
Insert Into feedback_option values (62,'0062','Not at all',14);
Insert Into feedback_option values (63,'0063','Low degree',14);
Insert Into feedback_option values (64,'0064','Moderate degree',14);
Insert Into feedback_option values (65,'0065','High degree',14);
Insert Into feedback_option values (66,'0066','Very high degree',14);
Insert Into feedback_option values (67,'0067','Not at all',15);
Insert Into feedback_option values (68,'0068','Low degree',15);
Insert Into feedback_option values (69,'0069','Moderate degree',15);
Insert Into feedback_option values (70,'0070','High degree',15);
Insert Into feedback_option values (71,'0071','Very high degree',15);
Insert Into feedback_option values (72,'0072','Not at all',16);
Insert Into feedback_option values (73,'0073','Low degree',16);
Insert Into feedback_option values (74,'0074','Moderate degree',16);
Insert Into feedback_option values (75,'0075','High degree',16);
Insert Into feedback_option values (76,'0076','Very high degree',16);
Insert Into feedback_option values (77,'0077','Not at all',17);
Insert Into feedback_option values (78,'0078','Low degree',17);
Insert Into feedback_option values (79,'0079','Moderate degree',17);
Insert Into feedback_option values (80,'0080','High degree',17);
Insert Into feedback_option values (81,'0081','Very high degree',17);
Insert Into feedback_option values (82,'0082','Not at all',18);
Insert Into feedback_option values (83,'0083','Low degree',18);
Insert Into feedback_option values (84,'0084','Moderate degree',18);
Insert Into feedback_option values (85,'0085','High degree',18);
Insert Into feedback_option values (86,'0086','Very high degree',18);
Insert Into feedback_option values (87,'0087','Too Short',19);
Insert Into feedback_option values (88,'0088','About right',19);
Insert Into feedback_option values (89,'0089','Too long',19);

Insert Into feedback_option values (90,'0090','Of reasonable cost',20);
Insert Into feedback_option values (91,'0091','Far too expensive',20);
Insert Into feedback_option values (92,'0092','No response',20);
Insert Into feedback_option values (93,'0093','Case discussions/Interactive presentations',21);
Insert Into feedback_option values (94,'0094','Surgery in animal lab/live animal workshop useful',21);
Insert Into feedback_option values (95,'0095', 'Experienced instructors',21);
Insert Into feedback_option values (96,'0096', 'Giving out manuals early for pre-read',21);
Insert Into feedback_option values (97,'0097', 'Exposure to views of foreign faculty',21);
Insert Into feedback_option values (98,'0098', 'Other (Specify)',21);
Insert Into feedback_option values (99,'0099', 'Some leactures were too long',22);
Insert Into feedback_option values (100,'0100', 'Too many lectures cramped together',22);
Insert Into feedback_option values (101,'0101', 'Course too short',22);
Insert Into feedback_option values (102,'0102','Lectures too rushed',22);
Insert Into feedback_option values (103,'0103','Too many lectures',22);
Insert Into feedback_option values (104,'0104','Other (Specify)',22);
Insert Into feedback_option values (105,'0105','Yes',24);
Insert Into feedback_option values (106,'0106','No',24);

Insert Into feedback_option values (107, '0107','Not confident in any case', 25);
Insert Into feedback_option values (108,'0108','Confident only in some cases',25);
Insert Into feedback_option values (109,'0109','Confident in most cases',25);
Insert Into feedback_option values (110,'0110','Confident with every major trauma situation',25);
Insert Into feedback_option values (111,'0111','Uncomfortable with all areas of major trauma',27);
Insert Into feedback_option values (112,'0112','Confident & competent only in some areas of major trauma',27);
Insert Into feedback_option values (113,'0113','Confident & competent in most areas of major trauma',27);
Insert Into feedback_option values (114,'0114','Confident & competent with any major trauma situation',27);
Insert Into feedback_option values (115,'0115','No benefit',29);
Insert Into feedback_option values (116,'0116','Some Benefit',29);
Insert Into feedback_option values (117,'0117','Quite helpful',29);
Insert Into feedback_option values (118,'0118','Very beneficial',29);




Create Table If Not Exists conference
(
	 ID					SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Title				VarChar(100) 			Not Null,
	 Description		VarChar(400)			Not Null,
	 Start_Time			DATETIME				Not Null,
	 End_Time			DATETIME				Not Null,
	 Organiser			VarChar(30)				Not Null,
	 Location			VarChar(80)				Not Null,
	 Contact			Char(25)				Not Null,
	 Download_Avail		TINYINT(1)				Not Null,
	 FilePath 			Varchar(100),

	 feedback			SMALLINT  	UNSIGNED,
	 venue				SMALLINT  	UNSIGNED	Not Null,
	 Token				INT 		UNIQUE,

	 Conference_Tag		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	 Schedule_Tag		TIMESTAMP,
	 Speaker_Tag		TIMESTAMP,
	 Sponsor_Tag		TIMESTAMP,
	 C_Feedback_Tag		TIMESTAMP,
	 S_Feedback_Tag		TIMESTAMP,

	 
	 Constraint Conference_pk Primary Key (ID),
	 Constraint Conference_Venue_fk Foreign Key (venue) References venue (ID) ON DELETE CASCADE ON UPDATE CASCADE,
	 Constraint Conference_Feedback_fk Foreign Key (feedback) References feedback (ID) ON DELETE CASCADE ON UPDATE CASCADE
	 
) Engine=InnoDB Default Charset=utf8;

Insert Into conference values (1,'DSTC', 'Definitive Surgical Trauma Care Course and Definitive Preoperative Nurses Trauma Care Course Combined Program Course No: 061//32','2014-07-02 08:00:00', '2014-07-04 4:00:00', 'DSTC', 'Epworth Richmond Auditorium / DPNTC-Only Sessions: Cato Room (Level 2)', 'John Doe', 1, 'http://www.test.org/' ,1, 3, 100001, NUll, NUll, NUll, NUll, NUll, NUll);

Insert Into conference values (2,'Surgical',										'conference covering all surgical procedures',		 											'2014-02-02 08:00:00', '2014-02-04 4:00:00', 'Epworth Healthcare',	'Melbourne', 'Jane Smith',1,'http://www.test.org/' , 1,3, 100002, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (3,'Trauma',											'Intensive trauma conference', 																	'2014-03-03 08:00:00', '2014-03-07 4:00:00', 'DSTC',				'Melbourne', 'Warren Hamstick',0, 'http://www.test.org/' , 1,2, 100003, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (4,'General practitioners',							'A fast paced conference in general medical practices', 										'2014-04-04 08:00:00', '2014-04-07 4:00:00', 'Epworth Healthcare',	'Albury',    'Timothy Dalton',0, 'http://www.test.org/' , 1,1, 100004, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (5,'MidYear',											'Refresher conference', 																		'2014-03-03 08:00:00', '2014-06-07 4:00:00', 'DSTC',				'Melbourne', 'Warren Ham',0, 'http://www.test.org/' , 1,2, 100005, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (6,'End of Year',										'Refresher conference', 																		'2014-03-03 08:00:00', '2014-07-07 4:00:00', 'DSTC',				'Melbourne', 'Warren Ham',0, 'http://www.test.org/' , 1,2, 100006, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (7,'DSTC conference',									'DSTC conference', 																				'2014-02-02 08:00:00', '2014-11-02 18:00:00','DSTC',				'Melbourne', 'Jane Smith',0, 'http://www.test.org/' , 1,2, 100007, NUll, NUll, NUll, NUll, NUll, NUll);

Insert Into conference values (8,'DSTC and Future Trauma Care', 					'Discussing about fure development of DSTC for dealing with increasing patients',				'2014-02-02 08:00:00', '2014-02-04 4:00:00', 'John Daugh', 			'Epworth Richmond Auditorium / DPNTC-Only Sessions: Cato Room (Level 2)', 'John Doe',  0, 'http://www.test.org/' , 2, 3, 100008, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (9,'Surgical Research and Psychological Test',		'Topic is collaboration between surgeon and modern psychology',		 							'2014-02-02 08:00:00', '2014-02-04 4:00:00', 'Epworth Healthcare',	'Melbourne', 'Kane Damih',1, 'http://www.test.org/',3,3, 100009, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (10,'Trauma Care in early stage',						'Discuss about Intensive Trauma and Early Stage Care', 											'2014-03-03 08:00:00', '2014-03-07 4:00:00', 'DSTC',				'Melbourne', 'Herren Hisick',0, 'http://www.test.org/' , 3,2, 100010, NUll, NUll, NUll, NUll, NUll, NUll);

Insert Into conference values (11,'Relationship between Trauma and End of Year',	'Statistical research which reveals hidden relationship between Trauma an end season of year',	'2014-03-03 08:00:00', '2014-07-07 4:00:00', 'DSTC',				'Melbourne', 'Zen Zen',0, 'http://www.test.org/' , 4,2, 100011, NUll, NUll, NUll, NUll, NUll, NUll);
Insert Into conference values (12,'Collaboration in DSTC',							'Short report about collaborations which takes place in DSTC between various fields', 			'2014-02-02 08:00:00', '2014-11-02 18:00:00','DSTC',				'Melbourne', 'Ann Thim',0, 'http://www.test.org/' , 4,2, 100012, NUll, NUll, NUll, NUll, NUll, NUll);


Create Table If Not Exists conference_fb_section
(
	conference 			SMALLINT UNSIGNED Not Null,
	feedback_section 	SMALLINT UNSIGNED Not Null,

	Constraint Conference_FB_Section_Conference_fk Foreign Key (conference) References conference (ID) ON DELETE CASCADE ON UPDATE CASCADE,
	Constraint Conference_FB_Feedback_Section_fk Foreign Key (feedback_section) References feedback_section (ID) ON DELETE CASCADE ON UPDATE CASCADE

) Engine=InnoDB Default Charset=utf8;


Create Table If Not Exists map
(
	 ID					SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Map_Directory		VarChar(100)					Not Null,
	 FilePath			VarChar(20)						Not Null,

	 conference 		SMALLINT  	UNSIGNED	Not Null,

	 Constraint Map_pk Primary Key (ID),
	 Constraint Map_Conference_fk Foreign Key (conference) References conference (ID) ON DELETE CASCADE ON UPDATE CASCADE

) Engine=InnoDB Default Charset=utf8;

Insert Into map values (1,'img/','map_a.jpg', 1);
Insert Into map values (2,'img/','map_b.jpg', 2);

Insert Into map values (3,'img/map/','map_c.jpg', 3);
Insert Into map values (4,'img/map/','map_d.jpg', 4);



Create Table If Not Exists conference_section
(
	ID						SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	Section_Title			VarChar(100)	Not Null,
	Last_Updated 			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	Ordering				INT(6),
	
	conference				SMALLINT  	UNSIGNED	Not Null,

	Constraint Conference_Section_pk Primary Key (ID),
	Constraint Conference_Section_Conference_fk Foreign Key (conference) References conference (ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;


Insert Into conference_section values (1, 'Surgical Decision Making', '2014-02-24', 1, 1);
Insert Into conference_section values (2, 'Surgical Techniques', '2014-02-24', 2, 1);

Insert Into conference_section values (3, 'Future Trauma Care', '2014-02-24', 1, 8);
Insert Into conference_section values (4, 'Psychological Techniques', '2014-02-24', 2, 9);
Insert Into conference_section values (5, 'Statistical Approach to Trauma', '2014-02-24', 1, 10);



Create Table If Not Exists session
(
	 ID						SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Title					VarChar(100)	Not Null,
	 Description			VarChar(400),
	 Start_Time				DATETIME		Not Null,
	 End_Time				DATETIME		Not Null,
	 Room_Location			VarChar(20)		Not Null,
	 Session_Chairperson	VarChar(50),
	 
	 QA_Open 					TINYINT(1) Not Null Default 0,
	 Last_Updated			TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

 	conference_section	    SMALLINT UNSIGNED Not Null,
 	feedback 				SMALLINT UNSIGNED Not Null,
 	feedback_section 		SMALLINT UNSIGNED Not Null,
 	
 Constraint Session_pk Primary Key (ID),
 Constraint Session_Conference_Section_fk Foreign Key (conference_section) References conference_section(ID) ON DELETE CASCADE ON UPDATE CASCADE,
 Constraint Session_Feedback_fk Foreign Key (feedback) References feedback(ID) ON DELETE CASCADE ON UPDATE CASCADE,
 Constraint Session_Feedback_Section_fk Foreign Key (feedback_section) References feedback_section(ID) ON DELETE CASCADE ON UPDATE CASCADE
 
) Engine=InnoDB Default Charset=utf8;

Insert Into session values(1, 'Case Presentation Decision Making (Interactive)',        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 07:50:00', '2012-11-30 08:00:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(2, 'Surgical Decision Making in Trauma Overview',            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(3, 'Damage Control Overview',                                'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:15:00', '2012-11-30 08:30:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(4, 'Case Presentation',                                      'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:30:00', '2012-11-30 08:40:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(5, 'Blunt Abdominal Trauma Overview',                        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:40:00', '2012-11-30 08:55:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(6, 'Case Presentation',                                      'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:55:00', '2012-11-30 09:05:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(7, 'Blunt Thoracic Trauma Overview',                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:05:00', '2012-11-30 09:20:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(8, 'Case Presentation (Interactive)',                        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:20:00', '2012-11-30 09:35:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(9, 'Group Discussion',                                       'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:35:00', '2012-11-30 09:45:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);

Insert Into session values(10, 'Morning Tea',                                           'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 09:45:00', '2012-11-30 10:15:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(11, 'Penetration Abdominal Trauma overview',                 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:15:00', '2012-11-30 10:30:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(12, 'Case Presentation',                                     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:30:00', '2012-11-30 10:40:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(13, 'ED Tracheotomy Overview',                               'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:40:00', '2012-11-30 10:55:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(14, 'Case Presentation (Interactive)',                       'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 10:55:00', '2012-11-30 11:10:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(15, 'Panel Discussion',                                      'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(16, 'Case Presentation (Interactive)',                       'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:10:00', '2012-11-30 11:25:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);
Insert Into session values(17, 'Panel Discussion',                                      'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 1, 1, 1);

INSERT INTO session VALUES(18,'Subscavian/ Neck Exposure',                              'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:25:00', '2012-11-30 11:35:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(19,'Discussion/DVD',                                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:35:00', '2012-11-30 11:40:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(20,'Fasciotomy',                                             'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:40:00', '2012-11-30 11:50:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(21,'Discussion/DVD',                                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:50:00', '2012-11-30 11:55:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(22,'Temporary Abdominal Closure',                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 11:55:00', '2012-11-30 12:05:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(23,'Discussion/DVD or Demonstration of VAC Pack',            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:05:00', '2012-11-30 12:10:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(24,'Craniotomy',                                             'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:10:00', '2012-11-30 12:20:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(25,'Discussion/DVD',                                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:20:00', '2012-11-30 12:25:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(26,'Perocardial Window',                                     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:25:00', '2012-11-30 12:35:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(27,'Discussion/DVD',                                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:35:00', '2012-11-30 12:40:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(28,'Panel Discussion',                                       'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:40:00', '2012-11-30 12:55:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(29,'Trade Display / Lunch',                                  'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 12:55:00', '2012-11-30 13:15:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(30,'Bus 1 - depart for Parkville',                           'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 13:15:00', '2012-11-30 17:00:00', 'Parkville',       'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(31,'Bus 2 - depart for Parkville',                           'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 13:30:00', '2012-11-30 17:00:00', 'Parkville',       'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(32,'Department of Anatomy - Practical session (All Groups)', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 14:00:00', '2012-11-30 17:00:00', 'Parkville',       'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(33,'Bus Back to Epworth Richmond',                           'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 17:00:00', '2012-11-30 17:45:00', 'Parkville',       'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(34,'Problem Solving and Discussion Groups (Auditorium)',     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 17:45:00', '2012-11-30 18:30:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(35,'Close',                                                  'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 18:30:00', '2012-11-30 17:00:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(36,'Course Dinner - Elim Gardens',                           'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 18:45:00', '2012-11-30 17:00:00', 'Auditorium',      'S Deane', 0, '2014-02-25', 2, 1, 1);

INSERT INTO session VALUES(37,'Arrival - Tea/Coffe',                                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:00:00', '2012-12-01 07:30:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(38,'Penetrating Thoracic Trauma',                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:30:00', '2012-12-01 07:45:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(39,'Case Presentation (Interactive)',                        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 07:45:00', '2012-12-01 08:00:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(40,'Haemodynamically Unstable Pelvic Fracture Overview',     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:00:00', '2012-12-01 08:15:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(41,'Case Presentation',                                      'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:15:00', '2012-12-01 08:25:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(42,'Head Injury',                                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:25:00', '2012-12-01 08:40:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(43,'Case Presentation',                                      'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:40:00', '2012-12-01 08:50:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(44,'Penetrating Neck Injury',                                'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 08:50:00', '2012-12-01 09:05:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(45,'Case Presentation (Interactive)',                        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:05:00', '2012-12-01 09:20:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(46,'Vascular Limb Injury',                                   'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:20:00', '2012-12-01 09:35:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(47,'Case Presentation (Interactive)',                        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:35:00', '2012-12-01 09:50:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(48,'Panel Discussion',                                       'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:50:00', '2012-12-01 09:55:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(49,'Morning Tea / Trade Display',                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 09:55:00', '2012-12-01 10:50:00', 'Auditorium',      'M Richardson', 0, '2014-02-25', 2, 1, 1);

INSERT INTO session VALUES(50,'Spleen & Kidney',                                        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 10:50:00', '2012-12-01 11:05:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(51,'Discussion/DVD or Demonstration of VAC Pack',            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:05:00', '2012-12-01 11:20:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(52,'Liver',                                                  'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:20:00', '2012-12-01 11:35:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(53,'Discussion/DVD',                                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:35:00', '2012-12-01 11:50:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(54,'Pancreas & Duodenum',                                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 11:50:00', '2012-12-01 12:05:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(55,'Discussion/DVD',                                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:05:00', '2012-12-01 12:20:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(56,'Cardiac & Lung Repair',                                  'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:20:00', '2012-12-01 12:35:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(57,'Discussion/DVD',                                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:35:00', '2012-12-01 12:50:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(58,'Bus 1 - Faculty/DPNTC departs',                          'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 12:50:00', '2012-12-01 17:00:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(59,'Bus 2 - Faculty/DSTC departs',                           'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 13:00:00', '2012-12-01 17:00:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(60,'Practical session (All Groups)',                         'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 13:45:00', '2012-12-01 17:00:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(61,'Discussion & Close at Werribee Campus',                  'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 17:00:00', '2012-12-01 17:30:00', 'Werribee Campus', 'T. Wagner', 0, '2014-02-25', 2, 1, 1);
INSERT INTO session VALUES(62,'Bus Back to Epworth Richmond',                           'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-12-01 17:30:00', '2012-12-01 17:00:00', 'Auditorium',      'T. Wagner', 0, '2014-02-25', 2, 1, 1);

Insert Into session values(63, 'Analysis of Future Trauma Care',        				'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 07:50:00', '2012-11-30 08:00:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 3, 2, 7);
Insert Into session values(64, 'Method of applying psychological research and its approach','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:00:00', '2012-11-30 08:15:00', 'Auditorium',  'P Danne', 0, '2014-02-25', 4, 3, 8);
Insert Into session values(65, 'Statistical approach to Trauma',                        'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2012-11-30 08:15:00', '2012-11-30 08:30:00', 'Auditorium',      'P Danne', 0, '2014-02-25', 5, 3, 9);


Create Table If Not Exists session_question
(
	 ID				SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Question		VarChar(400)	Not Null,
	 Accepted 		TINYINT(1)      Not Null,
	 Profile_Id		VARCHAR(100),
	 
	 session		SMALLINT UNSIGNED Not Null,
	 
	 Constraint Session_Question_pk Primary Key (ID),	
	 Constraint Session_Question_Session_fk Foreign Key (session) References session(ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

Insert Into session_question values (1,'Why do my legs feel itchy after a hot shower?',1,'AABCCEEDAA',1);
Insert Into session_question values (2,'My gums sometimes bleed when I brush my teeth, could this be related to.. dredging Port Phillip Bay?',1,'AABCCEEDAA',2);
Insert Into session_question values (3,'Have you ever heard of the Emancipation Proclaimation, and if so, is it Hip-hop?',0,'AABCCEEDAA',3);
Insert Into session_question values (4,'Why is my undies so tight?',1,'DDDDDDDDDD',4);
Insert Into session_question values (5,'Why have a handle on a enter door?',1,'DDDDDDDDDD',5);

Insert Into session_question values (6,'How can you predict future Trauma?',1,'CCCCCCCCCC',63);
Insert Into session_question values (7,'What is the best book for introduction of Psychology?',1,'CCCCCCCCCC',64);
Insert Into session_question values (8,'Is statistical research always correct?',0,'AAAAAAAAAA',65);



Create Table If Not Exists polling
(
	 ID					SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Polling_Question	VarChar(150)	Not Null,
	 session			SMALLINT UNSIGNED Not Null,
	 Available 			TINYINT(1) Not Null Default 0,
	 Open 				TINYINT(1) Not Null Default 0,

	 Constraint Polling_pk Primary Key (ID),
	 Constraint Polling_Session_fk Foreign Key (session) References session(ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

Insert Into polling values(1,'Key Decision Point 1', 7, 0, 0);
Insert Into polling values(2,'Key Decision Point 2', 7, 0, 0);
Insert Into polling values(3,'Key Decision Point 2: Probabilities', 38, 0, 0);
Insert Into polling values(4,'Key Decision Point 3: Investigations', 38, 0, 0);
Insert Into polling values(5,'Key Decision Point 4', 38, 0, 0);
Insert Into polling values(6,'Key Decision Point 1',14, 0, 0);
Insert Into polling values(7,'Key Decision Point 2',14, 0, 0);
Insert Into polling values(8,'Key Decision Point 3: Which is NOT an appropriate strategy?',14, 0, 0);
Insert Into polling values(9,'Key Decision Point 1',14, 0, 0);
Insert Into polling values(10,'Key Decision Point 1',45, 0, 0);
Insert Into polling values(11,'Surgical Approach',45, 0, 0);
Insert Into polling values(12,'Key Decision Point 1',47, 0, 0);

Insert Into polling values(13,'Key Decision Point 63', 63, 0, 0);
Insert Into polling values(14,'Key Decision Point 64', 64, 0, 0);
Insert Into polling values(15,'Key Decision Point 65: Probabilities', 65, 0, 0);
Insert Into polling values(16,'Key Decision Point 43', 43, 0, 0);
Insert Into polling values(17,'Key Decision Point 44', 44, 0, 0);
Insert Into polling values(18,'Key Decision Point 55: Probabilities', 55, 0, 0);
Insert Into polling values(19,'Key Decision Point 53', 53, 0, 0);
Insert Into polling values(20,'Key Decision Point 47', 47, 0, 0);
Insert Into polling values(21,'Key Decision Point 28: Probabilities', 28, 0, 0);



Create Table If Not Exists polling_option
(
	 ID					SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Option_Text		VarChar(80)	Not Null,

	 polling			SMALLINT UNSIGNED Not Null,

	 Constraint Polling_Option_pk Primary Key (ID),
	 Constraint Polling_Option_Polling_fk Foreign Key (polling) References polling(ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

INSERT INTO polling_option VALUES(1,'1. Laparotomy',1);
INSERT INTO polling_option VALUES(2,'2. FAST',1);
INSERT INTO polling_option VALUES(3,'3. DPL',1);
INSERT INTO polling_option VALUES(4,'4. Thoracotomy',1);
INSERT INTO polling_option VALUES(5,'5. CT Head, Neck, Chest, Abdo',1);
INSERT INTO polling_option VALUES(6,'1. Laparotomy',2);
INSERT INTO polling_option VALUES(7,'2. Thoracotomy',2);
INSERT INTO polling_option VALUES(8,'3. 2nd Chest Tube',2);
INSERT INTO polling_option VALUES(9,'4. Admit ICU',2);
INSERT INTO polling_option VALUES(10,'5. Cardiothoracic Surgery Consultation',2);
INSERT INTO polling_option VALUES(11,'1. Stable and will not require surgery?',3);
INSERT INTO polling_option VALUES(12,'2. Will need surgery to lung?',3);
INSERT INTO polling_option VALUES(13,'3. Will need surgery to mediastinal structure?',3);
INSERT INTO polling_option VALUES(14,'4. Likely to need ERRT?',3);
INSERT INTO polling_option VALUES(15,'5. May require surgery – further investigation required?',3);
INSERT INTO polling_option VALUES(16,'1. Contrast CT?',4);
INSERT INTO polling_option VALUES(17,'2. CXR?',4);
INSERT INTO polling_option VALUES(18,'3. Bronchoscopy?',4);
INSERT INTO polling_option VALUES(19,'4. Oesophagoscopy?',4);
INSERT INTO polling_option VALUES(20,'5. All of the Above?',4);
INSERT INTO polling_option VALUES(21,'1. ERRT',5);
INSERT INTO polling_option VALUES(22,'2. Anterolateral thorocotomy',5);
INSERT INTO polling_option VALUES(23,'3. Sternotomy',5);
INSERT INTO polling_option VALUES(24,'4. Post lateral thoracotomy',5);
INSERT INTO polling_option VALUES(25,'5. All of the above',5);
INSERT INTO polling_option VALUES(26,'1. FAST',6);
INSERT INTO polling_option VALUES(27,'2. Left ICC',6);
INSERT INTO polling_option VALUES(28,'3. 2nd IV Line',6);
INSERT INTO polling_option VALUES(29,'4. EERT',6);
INSERT INTO polling_option VALUES(30,'5. CXR',6);
INSERT INTO polling_option VALUES(31,'1. EERT then OR',7);
INSERT INTO polling_option VALUES(32,'2. Resus ++ then CT',7);
INSERT INTO polling_option VALUES(33,'3. Resus ++ then OR',7);
INSERT INTO polling_option VALUES(34,'4. Definitive thoracotomy then ICU',7);
INSERT INTO polling_option VALUES(35,'1. Relieve cardiac tamponade',8);
INSERT INTO polling_option VALUES(36,'2. Control cardiac laceration',8);
INSERT INTO polling_option VALUES(37,'3. Suture bleeding intercostals vessels',8);
INSERT INTO polling_option VALUES(38,'4. Manual cardiac compression',8);
INSERT INTO polling_option VALUES(39,'5. Control lung hilum',8);
INSERT INTO polling_option VALUES(40,'6. Primary repair of major vessels',8);
INSERT INTO polling_option VALUES(41,'7. X-clamp descending aorta',8);
INSERT INTO polling_option VALUES(42,'8. Tamponade pleural apex',8);
INSERT INTO polling_option VALUES(43,'1. CTA neck chest?',9);
INSERT INTO polling_option VALUES(44,'2. OR?',9);
INSERT INTO polling_option VALUES(45,'3. CXR?',9);
INSERT INTO polling_option VALUES(46,'4. Local exploration (see if platysma breached)?',9);
INSERT INTO polling_option VALUES(47,'5. Suture discharge?',9);
INSERT INTO polling_option VALUES(48,'1. OR immediately?',10);
INSERT INTO polling_option VALUES(49,'2. Pull out knife in emergency?',10);
INSERT INTO polling_option VALUES(50,'3. CTA?',10);
INSERT INTO polling_option VALUES(51,'4. CXR?',10);
INSERT INTO polling_option VALUES(52,'5. Call thoracic or ENT service?',10);
INSERT INTO polling_option VALUES(53,'1. Transverse incision?',11);
INSERT INTO polling_option VALUES(54,'2. Anterior border SCM?',11);
INSERT INTO polling_option VALUES(55,'3. Median sternotomy +/- extension to neck?',11);
INSERT INTO polling_option VALUES(56,'1. 2nd OR, exploration, fasciotomy?',11);
INSERT INTO polling_option VALUES(57,'2. Angiogram, 2nd OR, fasiotomy?',11);
INSERT INTO polling_option VALUES(58,'3. Angiogram, 2nd OR, exploration, fasciotomy?',11);

INSERT INTO polling_option VALUES(59,'1. Laparotomy',12);
INSERT INTO polling_option VALUES(60,'2. FAST',12);
INSERT INTO polling_option VALUES(61,'3. DPL',12);
INSERT INTO polling_option VALUES(62,'4. Thoracotomy',12);
INSERT INTO polling_option VALUES(63,'5. CT Head, Neck, Chest, Abdo',13);
INSERT INTO polling_option VALUES(64,'1. Laparotomy',13);
INSERT INTO polling_option VALUES(65,'2. Thoracotomy',13);
INSERT INTO polling_option VALUES(66,'3. 2nd Chest Tube',13);
INSERT INTO polling_option VALUES(67,'4. Admit ICU',14);
INSERT INTO polling_option VALUES(68,'5. Cardiothoracic Surgery Consultation',14);
INSERT INTO polling_option VALUES(69,'1. Stable and will not require surgery?',14);
INSERT INTO polling_option VALUES(70,'2. Will need surgery to lung?',14);

INSERT INTO polling_option VALUES(71,'1. Laparotomy',15);
INSERT INTO polling_option VALUES(72,'2. FAST',15);
INSERT INTO polling_option VALUES(73,'3. DPL',15);
INSERT INTO polling_option VALUES(74,'4. Thoracotomy',15);
INSERT INTO polling_option VALUES(75,'5. CT Head, Neck, Chest, Abdo',16);
INSERT INTO polling_option VALUES(76,'1. Laparotomy',16);
INSERT INTO polling_option VALUES(77,'2. Thoracotomy',16);
INSERT INTO polling_option VALUES(78,'3. 2nd Chest Tube',16);
INSERT INTO polling_option VALUES(79,'4. Admit ICU',17);
INSERT INTO polling_option VALUES(80,'5. Cardiothoracic Surgery Consultation',17);

INSERT INTO polling_option VALUES(81,'1. Stable and will not require surgery?',17);
INSERT INTO polling_option VALUES(82,'2. Will need surgery to lung?',17);
INSERT INTO polling_option VALUES(83,'1. Laparotomy',18);
INSERT INTO polling_option VALUES(84,'2. FAST',18);
INSERT INTO polling_option VALUES(85,'3. DPL',18);
INSERT INTO polling_option VALUES(86,'4. Thoracotomy',18);
INSERT INTO polling_option VALUES(87,'5. CT Head, Neck, Chest, Abdo',19);
INSERT INTO polling_option VALUES(88,'1. Laparotomy',19);
INSERT INTO polling_option VALUES(89,'2. Thoracotomy',19);
INSERT INTO polling_option VALUES(90,'3. 2nd Chest Tube',19);

INSERT INTO polling_option VALUES(91,'4. Admit ICU',20);
INSERT INTO polling_option VALUES(92,'5. Cardiothoracic Surgery Consultation',20);
INSERT INTO polling_option VALUES(93,'1. Stable and will not require surgery?',20);
INSERT INTO polling_option VALUES(94,'2. Will need surgery to lung?',20);
INSERT INTO polling_option VALUES(95,'1. Laparotomy',21);
INSERT INTO polling_option VALUES(96,'2. FAST',21);
INSERT INTO polling_option VALUES(97,'3. DPL',21);
INSERT INTO polling_option VALUES(98,'4. Thoracotomy',21);



Create Table If Not Exists polling_response
(
	 ID								SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Medical_Profession				VarChar(40)	Not Null,
	 
	 polling_option					SMALLINT UNSIGNED Not Null,
	 Profile_Id		VARCHAR(100),

	 Constraint Polling_Responses_pk Primary Key (ID),
	 Constraint Polling_Responses_Polling_Option_fk Foreign Key (polling_option) References polling_option(ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;




Create Table If Not Exists response_option
(
	 ID						SMALLINT UNSIGNED AUTO_INCREMENT Not Null,

	 Feedback_Response		SMALLINT UNSIGNED Not Null,
	 feedback_option		SMALLINT UNSIGNED Not Null,
	 Profile_Id		VARCHAR(100),

	 Constraint Response_Option_pk Primary Key (ID),
	 Constraint Response_Option_Feedback_Option_fk Foreign Key (feedback_option) References feedback_option(ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

Insert Into response_option values (1,1,1,'AABCCEEDAA');
Insert Into response_option values (2,2,2,'AADDCCCAA');
Insert Into response_option values (3,3,3,'AABCCEEDAA');
Insert Into response_option values (4,4,4,'AABCCEEDAA');
Insert Into response_option values (5,5,5,'AABCCEEDAA');

Insert Into response_option values (6,6,107,'AABCCEEDAA');
Insert Into response_option values (7,7,108,'AABCCEEDAA');
Insert Into response_option values (8,8,109,'AABCCEEDAA');
Insert Into response_option values (9,6,111,'ABBBCCAAAB');
Insert Into response_option values (10,7,112,'ABBBCCAAAB');
Insert Into response_option values (11,8,113,'ABBBCCAAAB');
Insert Into response_option values (12,6,116,'AABCCEEDAA');
Insert Into response_option values (13,7,117,'DDDDDEACCB');
Insert Into response_option values (14,8,118,'DDDDDEACCB');


Create Table If Not Exists reponse_text
(
	 ID						SMALLINT UNSIGNED AUTO_INCREMENT Not Null,
	 Question_Reponse		VarChar(250)	Not Null,
	 
	 feedback_question		SMALLINT UNSIGNED Not Null,
	 Feedback_Response		SMALLINT UNSIGNED Not Null,
	 Profile_Id		VARCHAR(100),

	 Constraint Reponse_Text_pk Primary Key (ID),
	 Constraint Reponse_Text_Feedback_Question_fk Foreign Key (feedback_question) References feedback_question(ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

Insert Into reponse_text values (1,'QR00000',1,1,'AABCCEEDAA');
Insert Into reponse_text values (2,'QR00001',2,2,'AADDCCCAA');
Insert Into reponse_text values (3,'QR00002',3,3,'ABBBCCAAAB');
Insert Into reponse_text values (4,'QR00003',4,4,'AADDCCCAA');
Insert Into reponse_text values (5,'QR00004',5,5,'AABCCEEDAA');

Insert Into reponse_text values (6,'QR00005',26,6,'DDDDDEACCB');
Insert Into reponse_text values (7,'QR00006',30,7,'DDDDDEACCB');
Insert Into reponse_text values (8,'QR00007',28,8,'ABBBCCAAAB');



Create Table If Not Exists session_presenter
(
	 presenter			SMALLINT UNSIGNED Not Null,
	 session			SMALLINT UNSIGNED Not Null,

	 Constraint Session_Presenter_pk Primary Key (presenter, session),
	 Constraint Session_Presenter_Session_fk Foreign Key (session) References session(ID) ON DELETE CASCADE ON UPDATE CASCADE,
	 Constraint Session_Presenter_Presenter_fk Foreign Key (presenter) References presenter(ID) ON DELETE CASCADE ON UPDATE CASCADE

) Engine=InnoDB Default Charset=utf8;

Insert Into session_presenter values (1,1);
Insert Into session_presenter values (2,2);
Insert Into session_presenter values (3,3);
Insert Into session_presenter values (4,4);
Insert Into session_presenter values (5,5);
Insert Into session_presenter values (6,6);
Insert Into session_presenter values (7,7);
Insert Into session_presenter values (8,8);
Insert Into session_presenter values (1,11);
Insert Into session_presenter values (2,12);
Insert Into session_presenter values (3,13);
Insert Into session_presenter values (4,14);
Insert Into session_presenter values (5,15);
Insert Into session_presenter values (6,16);
Insert Into session_presenter values (7,16);
Insert Into session_presenter values (8,16);
Insert Into session_presenter values (7,18);
Insert Into session_presenter values (8,20);
Insert Into session_presenter values (9,22);
Insert Into session_presenter values (10,24);
Insert Into session_presenter values (11,26);
Insert Into session_presenter values (12,28);
Insert Into session_presenter values (13,28);
Insert Into session_presenter values (1,28);
Insert Into session_presenter values (1,32);
Insert Into session_presenter values (2,32);
Insert Into session_presenter values (3,38);
Insert Into session_presenter values (4,38);
Insert Into session_presenter values (5,39);
Insert Into session_presenter values (6,40);
Insert Into session_presenter values (7,41);
Insert Into session_presenter values (8,42);
Insert Into session_presenter values (9,43);
Insert Into session_presenter values (10,44);
Insert Into session_presenter values (11,45);
Insert Into session_presenter values (12,46);
Insert Into session_presenter values (13,47);
Insert Into session_presenter values (1,50);
Insert Into session_presenter values (2,52);
Insert Into session_presenter values (3,53);
Insert Into session_presenter values (4,54);
Insert Into session_presenter values (5,56);

Insert Into session_presenter values (1, 63);
Insert Into session_presenter values (2, 64);
Insert Into session_presenter values (3, 65);
Insert Into session_presenter values (5, 63);
Insert Into session_presenter values (6, 64);
Insert Into session_presenter values (6, 65);


Create Table If Not Exists session_equipment
(
	equipment			SMALLINT UNSIGNED Not Null,

	Constraint Session_Equipment_pk Primary Key (equipment),
	Constraint Session_Equipment_Equipment_fk Foreign Key (equipment) References equipment(ID) ON DELETE CASCADE ON UPDATE CASCADE

) Engine=InnoDB Default Charset=utf8;

Insert Into session_equipment values (1);
Insert Into session_equipment values (2);
Insert Into session_equipment values (3);
Insert Into session_equipment values (4);



Create Table If Not Exists sponsor
(
	ID					SMALLINT UNSIGNED AUTO_INCREMENT Not NUll,
	Name				VarChar(40)		Not Null,
	FilePath			VarChar(100),
	Short_Desc			TEXT	Not Null,
	URL					VarChar(100)		Not Null,
	Last_Updated		TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 
	session_equipment	SMALLINT  UNSIGNED Not NUll,

	Constraint Sponsor_pk Primary Key (ID),
	Constraint Sponsor_Session_Equipment_fk Foreign Key (session_equipment) References session_equipment(equipment) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

 Insert Into sponsor values (1, 'Royal Australasian College of Surgeons', 'images/life.jpg', 'Formed in 1927 the Royal Australasian Collage of surgeons is a non-profit organisation.',                                                'http://www.surgeons.org/',     '2014-02-25',                    1);
 Insert Into sponsor values (2, 'IATSIC',                                 'images/death.jpg', 'International Association for Trauma Surgery and Intensive Care',                                                                        'http://www.iatsic.org/',     '2014-02-25',                      2);
 Insert Into sponsor values (3, 'Covidien',                               'images/the.jpg', 'Covidien is a $10 billion global healthcare products leader dedicated to innovation and long-term growth.',                              'http://www.covidien.com/covidien/pages.aspx',     '2014-02-25', 3);
 Insert Into sponsor values (4, 'KCI',                                    'images/same.jpg', 'Our proprietary KCI negative pressure technologies have revolutionized the way in which caregivers treat a wide variety of wound types', 'http://www.kci-medical.com.au/AU-ENG/home',     '2014-02-25',   4);

 Insert Into sponsor values (5, 'Australasian College of Surgeons', 'images/he.jpg', 'established in 1987, specilized for Surgeon .',                                                'http://www.surgeons.org/',     '2014-02-25',                    1);
 Insert Into sponsor values (6, 'IAS',                                 'images/did.jpg', 'International Association of Surgeon',                                                                        'http://www.ias.org/',     '2014-02-25',                      2);
 Insert Into sponsor values (7, 'Allianz',                               'images/care.jpg', 'Allianz is a Australian healthcare industry leader .',                              'http://www.allianz.com/',     '2014-02-25', 3);



Create Table If Not Exists conference_sponsor
(
	conference			SMALLINT  	UNSIGNED Not Null,
	sponsor				SMALLINT 	UNSIGNED Not NUll,
	
	Constraint Conference_Sponsor_pk Primary Key (conference, sponsor), 
	Constraint Conference_Sponsor_Conference_fk Foreign Key (conference) References conference(ID) ON DELETE CASCADE ON UPDATE CASCADE,
	Constraint Conference_Sponsor_Sponsor_fk Foreign Key (sponsor) References sponsor(ID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB Default Charset=utf8;

Insert Into conference_sponsor values (1, 1);
Insert Into conference_sponsor values (1, 2);
Insert Into conference_sponsor values (1, 3);
Insert Into conference_sponsor values (1, 4);

Insert Into conference_sponsor values (2, 1);
Insert Into conference_sponsor values (2, 2);


-- conference.json  triggers
-- CREATE TRIGGER `Conference_Tag_Venue` AFTER UPDATE ON `venue` FOR EACH ROW UPDATE `conference` SET `Conference_Tag` = CURRENT_TIMESTAMP WHERE `venue` = new.ID;
-- CREATE TRIGGER `Conference_Tag_Map`   AFTER UPDATE ON `map`   FOR EACH ROW UPDATE `conference` SET `Conference_Tag` = CURRENT_TIMESTAMP WHERE `ID` = new.conference;

-- schedule.json and speaker.json  triggers
-- CREATE TRIGGER `Schedule_Tag_Conference_Section` AFTER UPDATE ON `conference_section` FOR EACH ROW UPDATE `conference` SET `Schedule_Tag` = CURRENT_TIMESTAMP WHERE `ID` = new.conference;
-- CREATE TRIGGER `Schedule_Tag_Session`            AFTER UPDATE ON `session`            FOR EACH ROW UPDATE `conference` C INNER JOIN `conference_section` CS ON C.ID = CS.conference SET C.Schedule_Tag = CURRENT_TIMESTAMP, C.Speaker_Tag = CURRENT_TIMESTAMP WHERE CS.ID = new.conference_section;
-- CREATE TRIGGER `Schedule_Tag_Session_Presenter`  AFTER UPDATE ON `session_presenter`  FOR EACH ROW UPDATE `conference` C INNER JOIN `conference_section` CS ON C.ID = CS.conference INNER JOIN `session` S ON S.conference_section = CS.ID SET C.Schedule_Tag = CURRENT_TIMESTAMP, C.Speaker_Tag = CURRENT_TIMESTAMP WHERE S.ID = new.session;
-- CREATE TRIGGER `Schedule_Tag_Presenter`          AFTER UPDATE ON `presenter`          FOR EACH ROW UPDATE `conference` C INNER JOIN `conference_section` CS ON C.ID = CS.conference INNER JOIN `session` S ON S.conference_section = CS.ID INNER JOIN `session_presenter` SP ON S.ID = SP.session SET C.Schedule_Tag = CURRENT_TIMESTAMP, C.Speaker_Tag = CURRENT_TIMESTAMP WHERE SP.presenter = new.ID;


-- sponsor.json  triggers
-- CREATE TRIGGER `Sponsor_Tag_Conference_Sponsor` AFTER UPDATE ON `conference_sponsor` FOR EACH ROW UPDATE `conference` SET `Sponsor_Tag` = CURRENT_TIMESTAMP WHERE `ID` = new.conference;
-- CREATE TRIGGER `Sponsor_Tag_Sponsor`            AFTER UPDATE ON `sponsor`            FOR EACH ROW UPDATE `conference` C INNER JOIN `conference_sponsor` CS ON C.ID = CS.conference SET C.Sponsor_Tag = CURRENT_TIMESTAMP WHERE CS.sponsor = new.ID;

-- conference-feedback.json  triggers
-- CREATE TRIGGER `C_Feedback_Tag_`

-- session-feedback.json  triggers
-- CREATE TRIGGER `S_Feedback_Tag_`


-- --------
-- Triggers
-- --------

-- conference-feedback.json
CREATE TRIGGER `Conference_FB_Section_AU` AFTER UPDATE ON `conference_fb_section`
 FOR EACH ROW UPDATE `conference`
	SET `C_Feedback_Tag` = CURRENT_TIMESTAMP
	WHERE `ID` = new.conference;

-- conference.json
CREATE TRIGGER `Conference_Tag_Map` AFTER UPDATE ON `map`
 FOR EACH ROW UPDATE `conference`
	SET `Conference_Tag` = CURRENT_TIMESTAMP
	WHERE `ID` = new.conference;

-- conference.json
CREATE TRIGGER `Conference_Tag_Venue` AFTER UPDATE ON `venue`
 FOR EACH ROW UPDATE `conference`
	SET `Conference_Tag` = CURRENT_TIMESTAMP
	WHERE `venue` = new.ID;

-- conference-feedback.json  sesion-feedback.json
DELIMITER //
CREATE TRIGGER `Feedback_Option` AFTER UPDATE ON `feedback_option`
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

-- conference-feedback.json  session-feedback.json
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

-- conference-feedback.json  session-feedback.json
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

-- schedule.json
CREATE TRIGGER `Schedule_Tag_Conference_Section` AFTER UPDATE ON `conference_section`
 FOR EACH ROW UPDATE `conference`
	SET `Schedule_Tag` = CURRENT_TIMESTAMP
	WHERE `ID` = new.conference;

-- schedule.json  speaker.json
CREATE TRIGGER `Schedule_Tag_Presenter` AFTER UPDATE ON `presenter`
 FOR EACH ROW UPDATE `conference` C
    INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
        INNER JOIN `session` S
        ON S.conference_section = CS.ID
            INNER JOIN `session_presenter` SP
            ON S.ID = SP.session
	            SET C.Schedule_Tag = CURRENT_TIMESTAMP,
	              C.Speaker_Tag = CURRENT_TIMESTAMP
				WHERE SP.presenter = new.ID;

-- schedule.json  speaker.json  session-feedback.json
CREATE TRIGGER `Schedule_Tag_Session` AFTER UPDATE ON `session`
 FOR EACH ROW UPDATE `conference` C
    INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
	    SET C.Schedule_Tag = CURRENT_TIMESTAMP,
	      C.Speaker_Tag = CURRENT_TIMESTAMP,
	      C.S_Feedback_Tag = CURRENT_TIMESTAMP
		WHERE CS.ID = new.conference_section;

-- schedule.json  speaker.json
CREATE TRIGGER `Schedule_Tag_Session_Presenter` AFTER UPDATE ON `session_presenter`
 FOR EACH ROW UPDATE `conference` C
    INNER JOIN `conference_section` CS
    ON C.ID = CS.conference
        INNER JOIN `session` S
        ON S.conference_section = CS.ID
	        SET C.Schedule_Tag = CURRENT_TIMESTAMP,
	          C.Speaker_Tag = CURRENT_TIMESTAMP
			WHERE S.ID = new.session;

-- sponsor.json
CREATE TRIGGER `Sponsor_Tag_Conference_Sponsor` AFTER UPDATE ON `conference_sponsor`
 FOR EACH ROW UPDATE `conference`
	SET `Sponsor_Tag` = CURRENT_TIMESTAMP
	WHERE `ID` = new.conference;

-- sponsor.json
CREATE TRIGGER `Sponsor_Tag_Sponsor` AFTER UPDATE ON `sponsor`
 FOR EACH ROW UPDATE  conference C
    INNER JOIN conference_sponsor CS
    ON C.ID = CS.conference
		SET C.Sponsor_Tag = CURRENT_TIMESTAMP
		WHERE CS.sponsor = new.ID;


