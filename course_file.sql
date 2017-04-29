
DROP DATABASE ACFG;
CREATE DATABASE ACFG;

USE ACFG;

CREATE TABLE FACULTY
(
faculty_id varchar(20) NOT NULL,
password varchar(50) NOT NULL,
name varchar(50) NOT NULL,
dept_id varchar(10) NOT NULL,
phone  varchar(13) NOT NULL,
email varchar(50) CHECK (email LIKE '%@%.%'),
dob date NOT NULL,
accepted int,
PRIMARY KEY(faculty_id));

CREATE TABLE DEPARTMENT
(
dept_id varchar(10) NOT NULL,
dept_name varchar(50) NOT NULL,
hod_id varchar(20),
PRIMARY KEY(dept_id));

CREATE TABLE COURSE
(
course_id varchar(10) NOT NULL,
course_name varchar(50) NOT NULL,
dept_id varchar(10) NOT NULL,
PRIMARY KEY(course_id),
FOREIGN KEY (dept_id) REFERENCES DEPARTMENT(dept_id) ON DELETE CASCADE);

CREATE TABLE FACULTY_COURSE
(
faculty_id varchar(20) NOT NULL,
course_id varchar(10) NOT NULL,
mentor_id varchar(30) ,
curr_sem int,
year int,
accepted int,
PRIMARY KEY(faculty_id,course_id),
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE,
FOREIGN KEY (faculty_id) REFERENCES FACULTY(faculty_id) ON DELETE CASCADE,
FOREIGN KEY (mentor_id) REFERENCES FACULTY(faculty_id) ON DELETE CASCADE);


CREATE TABLE STUDENT
(
student_id varchar(20) NOT NULL,
student_name varchar(50) NOT NULL,
email varchar(50) CHECK (email LIKE '%@%.%'),
mobile  varchar(13) NOT NULL,
PRIMARY KEY(student_id));

CREATE TABLE STUDENT_COURSE
(
student_id varchar(20) NOT NULL,
course_id varchar(10) NOT NULL,
PRIMARY KEY(student_id,course_id),
FOREIGN KEY (student_id) REFERENCES STUDENT(student_id) ON DELETE CASCADE,
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE);

CREATE TABLE DOCUMENTS
(
doc_id int NOT NULL AUTO_INCREMENT,
faculty_id varchar(20) NOT NULL,
course_id varchar(10) NOT NULL,
doc_type varchar(45),
doc_name varchar(45),
doc_path varchar(100),
description varchar(45),
year int,
semester int,
PRIMARY KEY (doc_id),
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE,
FOREIGN KEY (faculty_id) REFERENCES FACULTY(faculty_id) ON DELETE CASCADE);


CREATE TABLE ADMIN
(
admin_id varchar(20) NOT NULL,
password varchar(50) NOT NULL);


CREATE TABLE CALENDAR
(
event_id int NOT NULL AUTO_INCREMENT,
event varchar(50),
start_date date,
end_date date,
id varchar(50) NOT NULL,
PRIMARY KEY (event_id));

insert into ADMIN values('admin','admin');

CREATE TABLE FEEDBACK_QUES
(
ques_id int NOT NULL AUTO_INCREMENT,
faculty_id varchar(20) NOT NULL,
course_id varchar(10) NOT NULL,
ques_type int,
mini int,
maxi int,
question varchar(200),
PRIMARY KEY (ques_id),
FOREIGN KEY (faculty_id) REFERENCES FACULTY(faculty_id) ON DELETE CASCADE,
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE
);

CREATE TABLE STU_FEEDBACK
(
student_id varchar(20) NOT NULL,
course_id varchar(10) NOT NULL,
password varchar(10) NOT NULL,
PRIMARY KEY (student_id,course_id),
FOREIGN KEY (student_id) REFERENCES STUDENT(student_id) ON DELETE CASCADE,
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE
);

CREATE TABLE FEEDBACK_RESP
(
ques_id int NOT NULL,
student_id varchar(20) NOT NULL,
course_id varchar(10) NOT NULL,
response varchar(500),
PRIMARY KEY (ques_id,student_id,course_id),
FOREIGN KEY (student_id) REFERENCES STUDENT(student_id) ON DELETE CASCADE,
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE
);

CREATE TABLE COURSE_CO
(
co_id int AUTO_INCREMENT,
course_id varchar(10),
co_desc varchar(500),
t1 int default 0,
t2 int default 0,
t3 int default 0,
ass int default 0,
total float,
PRIMARY KEY (co_id),
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `COURSE_CO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COURSE_CO` (
  `co_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(10) DEFAULT NULL,
  `co_desc` varchar(500) DEFAULT NULL,
  `t1` int(11) DEFAULT '0',
  `t2` int(11) DEFAULT '0',
  `t3` int(11) DEFAULT '0',
  `ass` int(11) DEFAULT '0',
  `total` float DEFAULT NULL,
  `t1_max` float DEFAULT '0',
  `t2_max` float DEFAULT '0',
  `t3_max` float DEFAULT '0',
  `ass_max` float DEFAULT '0',
  PRIMARY KEY (`co_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `COURSE_CO_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COURSE_CO`


CREATE TABLE CO_QUES
(
course_id varchar(10),
co_id int,
ques int,
test int,
PRIMARY KEY (course_id,ques,test),
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE,
FOREIGN KEY (co_id) REFERENCES COURSE_CO(co_id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `CO_QUES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CO_QUES` (
  `course_id` varchar(10) NOT NULL DEFAULT '',
  `co_id` int(11) DEFAULT NULL,
  `ques` int(11) NOT NULL DEFAULT '0',
  `test` int(11) NOT NULL DEFAULT '0',
  `max_marks` float DEFAULT '0',
  PRIMARY KEY (`course_id`,`ques`,`test`),
  KEY `co_id` (`co_id`),
  CONSTRAINT `CO_QUES_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE,
  CONSTRAINT `CO_QUES_ibfk_2` FOREIGN KEY (`co_id`) REFERENCES `COURSE_CO` (`co_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CO_QUES`
--



CREATE TABLE MARKS
(
course_id varchar(10),
student_id varchar(20) NOT NULL,
test int,
ques int,
mark float,
PRIMARY KEY (course_id,student_id,test,ques),
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE,
FOREIGN KEY (student_id) REFERENCES STUDENT(student_id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `MARKS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MARKS` (
  `course_id` varchar(10) NOT NULL DEFAULT '',
  `student_id` varchar(20) NOT NULL,
  `test` int(11) NOT NULL DEFAULT '0',
  `ques` int(11) NOT NULL DEFAULT '0',
  `mark` float DEFAULT NULL,
  PRIMARY KEY (`course_id`,`student_id`,`test`,`ques`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `MARKS_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE,
  CONSTRAINT `MARKS_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;



CREATE TABLE COURSE_PO
(
course_id varchar(10),
PO1 float default 0,
PO2 float default 0,
PO3 float default 0,
PO4 float default 0,
PO5 float default 0,
PO6 float default 0,
PO7 float default 0,
PO8 float default 0,
PO9 float default 0,
PO10 float default 0,
PO11 float default 0,
PO12 float default 0,
flag float default 0,
avg_po float default 0; 
PRIMARY KEY (course_id),
FOREIGN KEY (course_id) REFERENCES COURSE(course_id) ON DELETE CASCADE);

DROP TABLE IF EXISTS `COURSE_PO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COURSE_PO` (
  `course_id` varchar(10) NOT NULL DEFAULT '',
  `PO1` float DEFAULT '0',
  `PO2` float DEFAULT '0',
  `PO3` float DEFAULT '0',
  `PO4` float DEFAULT '0',
  `PO5` float DEFAULT '0',
  `PO6` float DEFAULT '0',
  `PO7` float DEFAULT '0',
  `PO8` float DEFAULT '0',
  `PO9` float DEFAULT '0',
  `PO10` float DEFAULT '0',
  `PO11` float DEFAULT '0',
  `PO12` float DEFAULT '0',
  `flag` float DEFAULT '0',
  `avg_po` float DEFAULT '0',
  PRIMARY KEY (`course_id`),
  CONSTRAINT `COURSE_PO_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

