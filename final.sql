-- MySQL dump 10.13  Distrib 5.6.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ACFG
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ADMIN`
--

DROP TABLE IF EXISTS `ADMIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADMIN` (
  `admin_id` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADMIN`
--

LOCK TABLES `ADMIN` WRITE;
/*!40000 ALTER TABLE `ADMIN` DISABLE KEYS */;
INSERT INTO `ADMIN` VALUES ('admin','admin');
/*!40000 ALTER TABLE `ADMIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ATTENDANCE`
--

DROP TABLE IF EXISTS `ATTENDANCE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ATTENDANCE` (
  `student_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `ATTENDANCE_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`) ON DELETE CASCADE,
  CONSTRAINT `ATTENDANCE_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ATTENDANCE`
--

LOCK TABLES `ATTENDANCE` WRITE;
/*!40000 ALTER TABLE `ATTENDANCE` DISABLE KEYS */;
/*!40000 ALTER TABLE `ATTENDANCE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CALENDAR`
--

DROP TABLE IF EXISTS `CALENDAR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CALENDAR` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id` varchar(50) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CALENDAR`
--

LOCK TABLES `CALENDAR` WRITE;
/*!40000 ALTER TABLE `CALENDAR` DISABLE KEYS */;
INSERT INTO `CALENDAR` VALUES (1,'Test 1','2016-08-29','2016-09-02','admin'),(2,'Class Starts','2016-07-21','2016-07-21','admin'),(3,'M.tech proj eval','2016-08-01','2016-08-01','admin'),(4,'Project mid term Assessment','2016-09-21','2016-09-23','admin'),(5,'Test 2','2016-10-05','2016-10-14','admin'),(6,'CC2','2016-09-26','2016-09-28','admin'),(7,'CC1','2016-08-11','2016-08-13','admin'),(8,'CC3','2016-10-27','2016-10-29','admin'),(10,'TE','2016-10-24','2016-10-29','admin'),(11,'Project final Assessment','2016-11-02','2016-11-05','admin'),(12,'End Exam','2016-11-15','2016-11-26','admin'),(13,'MakeUp','2016-12-01','2016-12-06','admin'),(14,'End result declaration','2016-12-07','2016-12-07','admin'),(15,'test','2016-11-25','2016-11-11','nadiya'),(16,'t2_admin','2016-12-08','2016-12-17','admin'),(17,'timepass','2016-12-09','2016-12-10','admin');
/*!40000 ALTER TABLE `CALENDAR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COURSE`
--

DROP TABLE IF EXISTS `COURSE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COURSE` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `dept_id` (`dept_id`),
  CONSTRAINT `COURSE_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `DEPARTMENT` (`dept_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COURSE`
--

LOCK TABLES `COURSE` WRITE;
/*!40000 ALTER TABLE `COURSE` DISABLE KEYS */;
INSERT INTO `COURSE` VALUES ('CS3001','Theory of Computation','cse'),('CS3002','DBMS','cse'),('CS3003','Operating Systems','cse'),('CS4021','Number Theory & Cryptography','cse'),('CS4022','Principles of Programming Languages','cse'),('CS4035','Computer Security','cse'),('CS4040','Bioinformatics','cse'),('CS6122','Computer Architecture','cse');
/*!40000 ALTER TABLE `COURSE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COURSE_CO`
--

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
--

LOCK TABLES `COURSE_CO` WRITE;
/*!40000 ALTER TABLE `COURSE_CO` DISABLE KEYS */;
INSERT INTO `COURSE_CO` VALUES (21,'CS3002','CO!',1,2,1,1,2.2,8,9,20,10),(22,'CS3002','CO2',1,1,1,1,1.45,8,5,15,10),(23,'CS3002','CO3',1,1,1,0,0.8,4,6,15,0),(24,'CS3003','CO1',1,1,1,1,1.19,5,6,12,10),(25,'CS3003','CO2',0,2,1,1,1.56,0,9,13,10),(26,'CS3003','CO3',1,1,1,0,0.78,7,3,14,0),(27,'CS3003','CO4',1,1,1,1,0.92,8,2,11,5);
/*!40000 ALTER TABLE `COURSE_CO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COURSE_PO`
--

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

--
-- Dumping data for table `COURSE_PO`
--

LOCK TABLES `COURSE_PO` WRITE;
/*!40000 ALTER TABLE `COURSE_PO` DISABLE KEYS */;
INSERT INTO `COURSE_PO` VALUES ('CS3002',0,0,0,0,0,0,0,0,0,0,0,0,0,0),('CS3003',1.19,1.19,0.92,0.78,0.78,1.56,1.19,1.19,1.56,1.01,1.24,0.92,1,1.1275);
/*!40000 ALTER TABLE `COURSE_PO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CO_QUES`
--

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

LOCK TABLES `CO_QUES` WRITE;
/*!40000 ALTER TABLE `CO_QUES` DISABLE KEYS */;
INSERT INTO `CO_QUES` VALUES ('CS3002',21,1,1,2),('CS3002',21,1,2,4),('CS3002',21,1,3,20),('CS3002',21,1,4,10),('CS3002',22,2,1,3),('CS3002',22,2,2,5),('CS3002',22,2,3,15),('CS3002',22,2,4,10),('CS3002',23,3,1,4),('CS3002',23,3,2,6),('CS3002',23,3,3,15),('CS3002',22,4,1,5),('CS3002',21,4,2,5),('CS3002',21,5,1,6),('CS3003',24,1,1,5),('CS3003',24,1,2,6),('CS3003',24,1,3,12),('CS3003',24,1,4,10),('CS3003',26,2,1,7),('CS3003',25,2,2,4),('CS3003',25,2,3,13),('CS3003',25,2,4,10),('CS3003',27,3,1,8),('CS3003',25,3,2,5),('CS3003',26,3,3,14),('CS3003',27,3,4,5),('CS3003',26,4,2,3),('CS3003',27,4,3,11),('CS3003',27,5,2,2);
/*!40000 ALTER TABLE `CO_QUES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DEPARTMENT`
--

DROP TABLE IF EXISTS `DEPARTMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DEPARTMENT` (
  `dept_id` varchar(10) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `hod_id` varchar(20) NOT NULL,
  PRIMARY KEY (`dept_id`),
  KEY `hod_id` (`hod_id`),
  CONSTRAINT `DEPARTMENT_ibfk_1` FOREIGN KEY (`hod_id`) REFERENCES `FACULTY` (`faculty_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DEPARTMENT`
--

LOCK TABLES `DEPARTMENT` WRITE;
/*!40000 ALTER TABLE `DEPARTMENT` DISABLE KEYS */;
INSERT INTO `DEPARTMENT` VALUES ('cse','Computer Science','saidalavi');
/*!40000 ALTER TABLE `DEPARTMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DOCUMENTS`
--

DROP TABLE IF EXISTS `DOCUMENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DOCUMENTS` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `doc_type` varchar(45) DEFAULT NULL,
  `doc_name` varchar(45) DEFAULT NULL,
  `doc_path` varchar(100) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `course_id` (`course_id`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `DOCUMENTS_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE,
  CONSTRAINT `DOCUMENTS_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `FACULTY` (`faculty_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DOCUMENTS`
--

LOCK TABLES `DOCUMENTS` WRITE;
/*!40000 ALTER TABLE `DOCUMENTS` DISABLE KEYS */;
INSERT INTO `DOCUMENTS` VALUES (34,'gaurav','CS4021','t1_quespaper','Mid_Sem_1.pdf','uploads/CS4021/2016_Monsoon/question_papers/Mid_Sem_1.pdf','',2016,1),(35,'gaurav','CS4021','t1_keysheet','Mid_Sem_1_sol.pdf','uploads/CS4021/2016_Monsoon/answer_keys/Mid_Sem_1_sol.pdf','',2016,1),(36,'gaurav','CS4021','t2_quespaper','mid_sem_2.pdf','uploads/CS4021/2016_Monsoon/question_papers/mid_sem_2.pdf','',2016,1),(37,'gaurav','CS4021','t2_keysheet','mid_sem_2_sol.pdf','uploads/CS4021/2016_Monsoon/answer_keys/mid_sem_2_sol.pdf','',2016,1),(38,'gaurav','CS4021','assgn','assg1.pdf','uploads/CS4021/2016_Monsoon/question_papers/assg1.pdf','',2016,1),(39,'gaurav','CS4021','assg_key','assg1_sol.pdf','uploads/CS4021/2016_Monsoon/answer_keys/assg1_sol.pdf','',2016,1),(40,'gaurav','CS4021','assgn','assg2.pdf','uploads/CS4021/2016_Monsoon/question_papers/assg2.pdf','',2016,1),(41,'gaurav','CS4021','assg_key','assg2_sol.pdf','uploads/CS4021/2016_Monsoon/answer_keys/assg2_sol.pdf','',2016,1),(42,'gaurav','CS4021','course','CS4021_NTC_Course_Plan.pdf','uploads/CS4021/2016_Monsoon/course_plan/CS4021_NTC_Course_Plan.pdf','',2016,1),(46,'nadiya','CS3002','course','cs3002_courseplan.pdf','uploads/CS3002/2016_Monsoon/course_plan/cs3002_courseplan.pdf','Course plan of DBMS',2016,1),(47,'nadiya','CS3002','t1_quespaper','t1_final.pdf','uploads/CS3002/2016_Monsoon/question_papers/t1_final.pdf','',2016,1),(48,'nadiya','CS3002','t1_markssheet','ResStat_t1.pdf','uploads/CS3002/2016_Monsoon/result/ResStat_t1.pdf','',2016,1),(49,'nadiya','CS3002','t2_quespaper','t2_final.pdf','uploads/CS3002/2016_Monsoon/question_papers/t2_final.pdf','',2016,1),(50,'nadiya','CS3002','t2_markssheet','ResStat_t2.pdf','uploads/CS3002/2016_Monsoon/result/ResStat_t2.pdf','',2016,1),(52,'anju','CS3003','course','courseplan.pdf','uploads/CS3003/2016_Monsoon/course_plan/courseplan.pdf','',2016,1),(55,'anju','CS3003','t1_markssheet','marksheet_t1.pdf','uploads/CS3003/2016_Monsoon/result/marksheet_t1.pdf','',2016,1),(93,'anju','CS3003','ACFG','ACFG.pdf','uploads/CS3003/2016_Monsoon/ACFG.pdf',NULL,2016,1),(94,'nadiya','CS3002','ACFG','ACFG.pdf','uploads/CS3002/2016_Monsoon/ACFG.pdf',NULL,2016,1);
/*!40000 ALTER TABLE `DOCUMENTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FACULTY`
--

DROP TABLE IF EXISTS `FACULTY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FACULTY` (
  `faculty_id` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dob` date NOT NULL,
  `accepted` int(11) DEFAULT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FACULTY`
--

LOCK TABLES `FACULTY` WRITE;
/*!40000 ALTER TABLE `FACULTY` DISABLE KEYS */;
INSERT INTO `FACULTY` VALUES ('anju','anju','Anju','cs','9876543245','anju@gmail.com','1989-09-09',1),('anu','1234','Anu Mary Chacko','cs','8987679009','anumary@nitc.ac.in','1980-06-19',1),('gaurav','1234','Gaurav Sood','cs','8097678541','gaurav@ntc.ac.in','1987-03-13',1),('jayaraj','1234','Jayaraj P B','cs','9865434578','jayaraj@nitc.ac.in','1980-11-10',0),('nadiya','nadiya123!','Nadiya T T','cs','9846707126','febna@nitc.ac.in','1986-08-05',1),('saidalavi','1234','Saidalavi Kalady','cs','9878654578','saidalavi@nitc.ac.in','1980-09-04',1);
/*!40000 ALTER TABLE `FACULTY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FACULTY_COURSE`
--

DROP TABLE IF EXISTS `FACULTY_COURSE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FACULTY_COURSE` (
  `faculty_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `mentor_id` varchar(30) DEFAULT NULL,
  `curr_sem` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `accepted` int(11) DEFAULT NULL,
  PRIMARY KEY (`faculty_id`,`course_id`),
  KEY `course_id` (`course_id`),
  KEY `mentor_id` (`mentor_id`),
  CONSTRAINT `FACULTY_COURSE_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE,
  CONSTRAINT `FACULTY_COURSE_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `FACULTY` (`faculty_id`) ON DELETE CASCADE,
  CONSTRAINT `FACULTY_COURSE_ibfk_3` FOREIGN KEY (`mentor_id`) REFERENCES `FACULTY` (`faculty_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FACULTY_COURSE`
--

LOCK TABLES `FACULTY_COURSE` WRITE;
/*!40000 ALTER TABLE `FACULTY_COURSE` DISABLE KEYS */;
INSERT INTO `FACULTY_COURSE` VALUES ('anju','CS3003',NULL,1,2016,1),('gaurav','CS4021',NULL,1,2016,1),('nadiya','CS3002',NULL,1,2016,1);
/*!40000 ALTER TABLE `FACULTY_COURSE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FEEDBACK_QUES`
--

DROP TABLE IF EXISTS `FEEDBACK_QUES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FEEDBACK_QUES` (
  `ques_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `ques_type` int(11) DEFAULT NULL,
  `mini` int(11) DEFAULT NULL,
  `maxi` int(11) DEFAULT NULL,
  `question` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ques_id`),
  KEY `faculty_id` (`faculty_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `FEEDBACK_QUES_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `FACULTY` (`faculty_id`) ON DELETE CASCADE,
  CONSTRAINT `FEEDBACK_QUES_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FEEDBACK_QUES`
--

LOCK TABLES `FEEDBACK_QUES` WRITE;
/*!40000 ALTER TABLE `FEEDBACK_QUES` DISABLE KEYS */;
INSERT INTO `FEEDBACK_QUES` VALUES (7,'nadiya','CS3002',1,0,10,'Rate the difficulty of question paper (0-10)'),(8,'nadiya','CS3002',0,NULL,NULL,'Suggest any improvements');
/*!40000 ALTER TABLE `FEEDBACK_QUES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FEEDBACK_RESP`
--

DROP TABLE IF EXISTS `FEEDBACK_RESP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FEEDBACK_RESP` (
  `ques_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `response` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ques_id`,`student_id`,`course_id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `FEEDBACK_RESP_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`) ON DELETE CASCADE,
  CONSTRAINT `FEEDBACK_RESP_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FEEDBACK_RESP`
--

LOCK TABLES `FEEDBACK_RESP` WRITE;
/*!40000 ALTER TABLE `FEEDBACK_RESP` DISABLE KEYS */;
INSERT INTO `FEEDBACK_RESP` VALUES (7,'B130004CS','CS3002','7'),(7,'B130005CS','CS3002','9'),(7,'B130026CS','CS3002','3'),(8,'B130004CS','CS3002','Please include some objective type questions in the question paper.'),(8,'B130005CS','CS3002','No improvements or suggestions'),(8,'B130026CS','CS3002','No improvements');
/*!40000 ALTER TABLE `FEEDBACK_RESP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MARKS`
--

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

--
-- Dumping data for table `MARKS`
--

LOCK TABLES `MARKS` WRITE;
/*!40000 ALTER TABLE `MARKS` DISABLE KEYS */;
INSERT INTO `MARKS` VALUES ('CS3002','B130004CS',1,1,10),('CS3002','B130004CS',1,2,20),('CS3002','B130004CS',1,3,30),('CS3002','B130004CS',1,4,40),('CS3002','B130004CS',1,5,50),('CS3002','B130004CS',2,1,10),('CS3002','B130004CS',2,2,20),('CS3002','B130004CS',2,3,30),('CS3002','B130004CS',2,4,40),('CS3002','B130004CS',3,1,10),('CS3002','B130004CS',3,2,20),('CS3002','B130004CS',3,3,30),('CS3002','B130004CS',4,1,10),('CS3002','B130004CS',4,2,20),('CS3002','B130005CS',1,1,20),('CS3002','B130005CS',1,2,30),('CS3002','B130005CS',1,3,40),('CS3002','B130005CS',1,4,50),('CS3002','B130005CS',1,5,60),('CS3002','B130005CS',2,1,20),('CS3002','B130005CS',2,2,30),('CS3002','B130005CS',2,3,40),('CS3002','B130005CS',2,4,50),('CS3002','B130005CS',3,1,20),('CS3002','B130005CS',3,2,30),('CS3002','B130005CS',3,3,40),('CS3002','B130005CS',4,1,20),('CS3002','B130005CS',4,2,30),('CS3002','B130026CS',1,1,30),('CS3002','B130026CS',1,2,40),('CS3002','B130026CS',1,3,50),('CS3002','B130026CS',1,4,60),('CS3002','B130026CS',1,5,70),('CS3002','B130026CS',2,1,30),('CS3002','B130026CS',2,2,40),('CS3002','B130026CS',2,3,50),('CS3002','B130026CS',2,4,60),('CS3002','B130026CS',3,1,30),('CS3002','B130026CS',3,2,40),('CS3002','B130026CS',3,3,50),('CS3002','B130026CS',4,1,30),('CS3002','B130026CS',4,2,40),('CS3002','B130052CS',1,1,40),('CS3002','B130052CS',1,2,50),('CS3002','B130052CS',1,3,60),('CS3002','B130052CS',1,4,70),('CS3002','B130052CS',1,5,80),('CS3002','B130052CS',2,1,40),('CS3002','B130052CS',2,2,50),('CS3002','B130052CS',2,3,60),('CS3002','B130052CS',2,4,70),('CS3002','B130052CS',3,1,40),('CS3002','B130052CS',3,2,50),('CS3002','B130052CS',3,3,60),('CS3002','B130052CS',4,1,40),('CS3002','B130052CS',4,2,50),('CS3003','B130004CS',1,1,10),('CS3003','B130004CS',1,2,20),('CS3003','B130004CS',1,3,30),('CS3003','B130004CS',2,1,10),('CS3003','B130004CS',2,2,20),('CS3003','B130004CS',2,3,30),('CS3003','B130004CS',2,4,40),('CS3003','B130004CS',2,5,50),('CS3003','B130004CS',3,1,10),('CS3003','B130004CS',3,2,20),('CS3003','B130004CS',3,3,30),('CS3003','B130004CS',3,4,40),('CS3003','B130004CS',4,1,10),('CS3003','B130004CS',4,2,20),('CS3003','B130004CS',4,3,30),('CS3003','B130005CS',1,1,20),('CS3003','B130005CS',1,2,30),('CS3003','B130005CS',1,3,40),('CS3003','B130005CS',2,1,20),('CS3003','B130005CS',2,2,30),('CS3003','B130005CS',2,3,40),('CS3003','B130005CS',2,4,50),('CS3003','B130005CS',2,5,60),('CS3003','B130005CS',3,1,20),('CS3003','B130005CS',3,2,30),('CS3003','B130005CS',3,3,40),('CS3003','B130005CS',3,4,50),('CS3003','B130005CS',4,1,20),('CS3003','B130005CS',4,2,30),('CS3003','B130005CS',4,3,40),('CS3003','B130026CS',1,1,30),('CS3003','B130026CS',1,2,40),('CS3003','B130026CS',1,3,50),('CS3003','B130026CS',2,1,30),('CS3003','B130026CS',2,2,40),('CS3003','B130026CS',2,3,50),('CS3003','B130026CS',2,4,60),('CS3003','B130026CS',2,5,70),('CS3003','B130026CS',3,1,30),('CS3003','B130026CS',3,2,40),('CS3003','B130026CS',3,3,50),('CS3003','B130026CS',3,4,60),('CS3003','B130026CS',4,1,30),('CS3003','B130026CS',4,2,40),('CS3003','B130026CS',4,3,50),('CS3003','B130052CS',1,1,40),('CS3003','B130052CS',1,2,50),('CS3003','B130052CS',1,3,60),('CS3003','B130052CS',2,1,40),('CS3003','B130052CS',2,2,50),('CS3003','B130052CS',2,3,60),('CS3003','B130052CS',2,4,70),('CS3003','B130052CS',2,5,80),('CS3003','B130052CS',3,1,40),('CS3003','B130052CS',3,2,50),('CS3003','B130052CS',3,3,60),('CS3003','B130052CS',3,4,70),('CS3003','B130052CS',4,1,40),('CS3003','B130052CS',4,2,50),('CS3003','B130052CS',4,3,60);
/*!40000 ALTER TABLE `MARKS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STUDENT`
--

DROP TABLE IF EXISTS `STUDENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STUDENT` (
  `student_id` varchar(20) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(13) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STUDENT`
--

LOCK TABLES `STUDENT` WRITE;
/*!40000 ALTER TABLE `STUDENT` DISABLE KEYS */;
INSERT INTO `STUDENT` VALUES ('B130004CS','RITVIK VINODKUMAR  ','chandupatlarohith@gmail.com','9870466564'),('B130005CS','MUHAMED IRFAN VENGASSERI  ','rithvik@gmail.com','9870466564'),('B130026CS','AKSHAY KISHOR PATIL  ','rithvik@gmail.com','9870466564'),('B130052CS','ROHITH JAYADEVAN NAIR  ','rithvik@gmail.com','9870466564'),('B130055CS','ASHOK DHUNGANA  ','rithvik@gmail.com','9870466564'),('B130056CS','PRABHAV ADHIKARI  ','rithvik@gmail.com','9870466564'),('B130057CS','PIYUSH BHOPALKA  ','rithvik@gmail.com','9870466564'),('B130060CS','SAMEER KHALID  ','rithvik@gmail.com','9870466564'),('B130064CS','SIDHARTH PALAKODE RAJU  ','rithvik@gmail.com','9870466564'),('B130070CS','VINAY R. DAMODARAN  ','rithvik@gmail.com','9870466564');
/*!40000 ALTER TABLE `STUDENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STUDENT_COURSE`
--

DROP TABLE IF EXISTS `STUDENT_COURSE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STUDENT_COURSE` (
  `student_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  PRIMARY KEY (`student_id`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `STUDENT_COURSE_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`) ON DELETE CASCADE,
  CONSTRAINT `STUDENT_COURSE_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STUDENT_COURSE`
--

LOCK TABLES `STUDENT_COURSE` WRITE;
/*!40000 ALTER TABLE `STUDENT_COURSE` DISABLE KEYS */;
INSERT INTO `STUDENT_COURSE` VALUES ('B130004CS','CS3002'),('B130005CS','CS3002'),('B130026CS','CS3002'),('B130052CS','CS3002'),('B130055CS','CS3002'),('B130056CS','CS3002'),('B130057CS','CS3002'),('B130060CS','CS3002'),('B130064CS','CS3002'),('B130070CS','CS3002');
/*!40000 ALTER TABLE `STUDENT_COURSE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STU_FEEDBACK`
--

DROP TABLE IF EXISTS `STU_FEEDBACK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STU_FEEDBACK` (
  `student_id` varchar(20) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`student_id`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `STU_FEEDBACK_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `STUDENT` (`student_id`) ON DELETE CASCADE,
  CONSTRAINT `STU_FEEDBACK_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `COURSE` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STU_FEEDBACK`
--

LOCK TABLES `STU_FEEDBACK` WRITE;
/*!40000 ALTER TABLE `STU_FEEDBACK` DISABLE KEYS */;
INSERT INTO `STU_FEEDBACK` VALUES ('B130004CS','CS3002','367005');
/*!40000 ALTER TABLE `STU_FEEDBACK` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-27  2:55:46
