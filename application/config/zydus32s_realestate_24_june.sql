-- MySQL dump 10.13  Distrib 5.6.44-86.0, for Linux (x86_64)
--
-- Host: localhost    Database: zydus32s_realestate
-- ------------------------------------------------------
-- Server version	5.6.44-86.0

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
-- Table structure for table `admin_master`
--

DROP TABLE IF EXISTS `admin_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_master` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_master`
--

LOCK TABLES `admin_master` WRITE;
/*!40000 ALTER TABLE `admin_master` DISABLE KEYS */;
INSERT INTO `admin_master` VALUES (1,'admin','e6e061838856bf47e1de730719fb2609','admin@gmail.com');
/*!40000 ALTER TABLE `admin_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_master`
--

DROP TABLE IF EXISTS `bank_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_master` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) NOT NULL,
  `bank_email` varchar(255) NOT NULL,
  `bank_contact_no` varchar(20) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `bank_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_master`
--

LOCK TABLES `bank_master` WRITE;
/*!40000 ALTER TABLE `bank_master` DISABLE KEYS */;
INSERT INTO `bank_master` VALUES (1,'HDFC Bank','support@hdfcbank.com','075739 19585','Shop No 27, Ground Floor, Galaxy Mall Shivranjani Cross Road, Nehrunagar Opposite Jhansi ki Rani Statue, Ahmedabad, Gujarat 380015																																					','2020-05-01'),(2,'Axis Bank','customer.service@axisbank.com','092432 34663','Ground floor, Himalaya Emerald, Shivranjani Cross Rd, Ahmedabad, Gujarat 380015','2020-05-01'),(3,'State Bank Of India','epg.cms@sbi.co.in','079 2644 6248','Panchavati Society, Gulbai Tekra, Ahmedabad, Gujarat 380006																																																																																																																																																																																																				','2020-05-18'),(4,'Bank of Baroda','gm.ops.ho@bankofbaroda.com',' (0265) 2316792','Baroda Bhavan\r\n7th Floor,R.C. Dutt Road,\r\nVadodara-390 007, (Gujarat) India																												','2020-05-19');
/*!40000 ALTER TABLE `bank_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `broker_master`
--

DROP TABLE IF EXISTS `broker_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `broker_master` (
  `broker_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `broker_name` int(11) NOT NULL,
  `broker_commission_type` varchar(30) NOT NULL,
  `brokerage_amount` decimal(15,2) NOT NULL,
  `brokerage_amount_to_paid` decimal(15,2) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `partically_paid_amount` decimal(15,2) DEFAULT NULL,
  `payment_date` varchar(50) NOT NULL,
  `broker_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`broker_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `broker_master`
--

LOCK TABLES `broker_master` WRITE;
/*!40000 ALTER TABLE `broker_master` DISABLE KEYS */;
INSERT INTO `broker_master` VALUES (1,5,38,'Fixed Amount',5000.00,0.00,'Partically Paid',500.00,'2020-06-11','2020-06-15'),(31,58,38,'Percentage',10.00,174812.00,'Paid',0.00,'2020-06-24','2020-06-17'),(3,11,38,'Percentage',10.00,0.00,'Not Paid',0.00,'2020-06-10','2020-06-15'),(4,12,38,'Percentage',10.00,0.00,'Not Paid',0.00,'2020-06-10','2020-06-15'),(5,13,38,'Percentage',5.00,0.00,'Partically Paid',1000.00,'2020-06-02','2020-06-15'),(6,16,38,'Fixed Amount',1234.00,0.00,'Partically Paid',123.00,'2020-06-17','2020-06-15'),(7,17,38,'Fixed Amount',1234.00,0.00,'Partically Paid',123.00,'2020-06-17','2020-06-15'),(8,18,38,'Fixed Amount',1221.00,0.00,'Not Paid',0.00,'2020-06-25','2020-06-15'),(9,20,38,'Fixed Amount',12121.00,0.00,'Not Paid',0.00,'2020-06-24','2020-06-15'),(10,21,38,'Fixed Amount',5000.00,0.00,'Not Paid',0.00,'2020-06-08','2020-06-15'),(11,22,38,'Fixed Amount',1212.00,0.00,'Not Paid',0.00,'2020-06-25','2020-06-15'),(12,23,38,'Fixed Amount',1212.00,0.00,'Not Paid',0.00,'2020-06-25','2020-06-15'),(13,24,38,'Fixed Amount',12221.00,0.00,'Not Paid',0.00,'2020-06-24','2020-06-15'),(14,25,38,'Fixed Amount',12221.00,0.00,'Not Paid',0.00,'2020-06-24','2020-06-15'),(15,26,38,'Fixed Amount',1221.00,0.00,'Not Paid',0.00,'2020-06-23','2020-06-15'),(16,27,38,'Fixed Amount',12121.00,0.00,'Not Paid',0.00,'2020-06-26','2020-06-15'),(23,51,38,'Fixed Amount',2700.00,2700.00,'Partically Paid',500.00,'2020-06-18','2020-06-16'),(24,52,38,'Fixed Amount',2700.00,2700.00,'Partically Paid',500.00,'2020-06-18','2020-06-16'),(19,46,38,'Percentage',5.00,350000.00,'Partically Paid',15000.00,'2020-06-16','2020-06-15'),(28,56,0,'',0.00,0.00,'',NULL,'1970-01-01','2020-06-17'),(29,56,38,'Fixed Amount',3500.00,3500.00,'Not Paid',NULL,'2020-06-18','2020-06-17'),(32,59,38,'Percentage',10.00,174812.00,'Paid',0.00,'2020-06-24','2020-06-17'),(30,57,38,'Fixed Amount',5000.00,5000.00,'Partically Paid',2500.00,'2020-06-22','2020-06-17'),(33,60,38,'Fixed Amount',145000.00,145000.00,'Partically Paid',4585.00,'2020-06-18','2020-06-17'),(35,62,38,'Percentage',3.00,1800000.00,'Paid',0.00,'2020-07-18','2020-06-22');
/*!40000 ALTER TABLE `broker_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `case_against_master`
--

DROP TABLE IF EXISTS `case_against_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `case_against_master` (
  `case_against_id` int(11) NOT NULL AUTO_INCREMENT,
  `case_against_contact_person` varchar(150) NOT NULL,
  `case_against_email` varchar(255) NOT NULL,
  `case_against_contact_no` varchar(20) NOT NULL,
  `case_against_company_name` varchar(150) NOT NULL,
  `case_against_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`case_against_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `case_against_master`
--

LOCK TABLES `case_against_master` WRITE;
/*!40000 ALTER TABLE `case_against_master` DISABLE KEYS */;
INSERT INTO `case_against_master` VALUES (1,'Ashit Pancholee','ashit@gmail.com','1234567890','Zydus','2020-05-11'),(2,'Nidhi Shah','nidhi123@gmail.com','1234554391','Divine Infosys','2020-05-18'),(3,'Amit Shah','amit@gmail.com','1234567890','Amit Shah','2020-05-19');
/*!40000 ALTER TABLE `case_against_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `case_by_master`
--

DROP TABLE IF EXISTS `case_by_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `case_by_master` (
  `case_by_id` int(11) NOT NULL AUTO_INCREMENT,
  `case_by_contact_person` varchar(150) NOT NULL,
  `case_by_email` varchar(255) NOT NULL,
  `case_by_contact_no` varchar(20) NOT NULL,
  `case_by_company_name` varchar(150) NOT NULL,
  `case_by_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`case_by_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `case_by_master`
--

LOCK TABLES `case_by_master` WRITE;
/*!40000 ALTER TABLE `case_by_master` DISABLE KEYS */;
INSERT INTO `case_by_master` VALUES (1,'Preksha Shah','shahprexa2509@gmail.com','1234567890','Divine','2020-05-07'),(2,'Akhil Trivedi','me.akhiltrivedi@gmail.com','7788996655','Zydus Real Estate','2020-05-07'),(3,'Vishal Kotak','vishalkotak200@gmail.com','1234567890','Divine Infosys','2020-05-18'),(4,'Bhavesh Gajjar','bhaveshgajjar@gmail.com','4448885522','Zydus Real Estate','2020-05-19');
/*!40000 ALTER TABLE `case_by_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_authority_master`
--

DROP TABLE IF EXISTS `document_authority_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_authority_master` (
  `document_auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_authority` varchar(255) NOT NULL,
  `doc_auth_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`document_auth_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_authority_master`
--

LOCK TABLES `document_authority_master` WRITE;
/*!40000 ALTER TABLE `document_authority_master` DISABLE KEYS */;
INSERT INTO `document_authority_master` VALUES (1,'Zydus Real Estate','2020-04-29'),(2,'Gujarat Goverment','2020-06-19'),(3,'No Authority ','2020-06-22');
/*!40000 ALTER TABLE `document_authority_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_master`
--

DROP TABLE IF EXISTS `document_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_master` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) NOT NULL,
  `document_type` int(11) NOT NULL,
  `document_nature` varchar(30) NOT NULL,
  `document_state` varchar(100) NOT NULL,
  `document_renewal` varchar(5) NOT NULL,
  `document_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_master`
--

LOCK TABLES `document_master` WRITE;
/*!40000 ALTER TABLE `document_master` DISABLE KEYS */;
INSERT INTO `document_master` VALUES (1,'Identification Document',1,'Not complsoury','Delhi','No','2020-04-30'),(2,'Address Document',2,'Compulsory','Delhi','Yes','2020-04-30'),(3,'Identity Document',1,'Compulsory','Gujarat','Yes','2020-06-18'),(4,'Form No #',1,'Compulsory','Gujarat','Yes','2020-06-18'),(5,'Chita Pita nadangal Tamilnadu',2,'Compulsory','Tamil Nadu','Yes','2020-06-19'),(6,'Document Test Name',2,'Compulsory','Gujarat','Yes','2020-06-22'),(7,'Bhada karar',2,'Compulsory','Gujarat','No','2020-06-22'),(8,'Purchase Contract',1,'Compulsory','Gujarat','No','2020-06-24');
/*!40000 ALTER TABLE `document_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_type_master`
--

DROP TABLE IF EXISTS `document_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_type_master` (
  `document_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type` varchar(255) NOT NULL,
  `document_type_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`document_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_type_master`
--

LOCK TABLES `document_type_master` WRITE;
/*!40000 ALTER TABLE `document_type_master` DISABLE KEYS */;
INSERT INTO `document_type_master` VALUES (1,'Identification Proof','2020-04-29'),(2,'Address Proof','2020-04-29'),(3,'ABCDEF123','2020-06-22');
/*!40000 ALTER TABLE `document_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_master`
--

DROP TABLE IF EXISTS `expense_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_master` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_ledger_head` varchar(100) NOT NULL,
  `expense_ledger_number` varchar(100) NOT NULL,
  `property_id` int(11) NOT NULL,
  `expense_title` varchar(255) NOT NULL,
  `expense_amount` decimal(15,2) NOT NULL,
  `expense_date` text NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `expense_source_party` int(11) NOT NULL,
  `expense_invoice_number` varchar(100) NOT NULL,
  `invoice_upload` varchar(255) NOT NULL,
  `tds_percentage` decimal(15,2) NOT NULL,
  `gst_percentage` decimal(15,2) NOT NULL,
  `paid_by` int(11) NOT NULL,
  `recurring_expense` varchar(10) NOT NULL,
  `next_recurring_date` varchar(50) DEFAULT NULL,
  `expense_description` text,
  `expense_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_master`
--

LOCK TABLES `expense_master` WRITE;
/*!40000 ALTER TABLE `expense_master` DISABLE KEYS */;
INSERT INTO `expense_master` VALUES (1,'Direct Expense','456897',2,'Rent Paid',100000.00,'2020-05-25',1,48,'882233','OWY0ZTZmM2Y3ZGZmNmJiMjdhOTdmZDE3ODA0MDYzNjEucGRm',8.50,18.50,30,'Yes','2020-06-25','<p>Rent Paid</p>','2020-05-25'),(2,'Expense Ledger','444551',3,'Wearhouse Purchase',25000000.00,'2020-05-02',2,44,'452051','ZTA1ODZmYmNmZGI0NjBiYWUwOWRmYTU3NzZmNjIwNDMuanBlZw==',10.50,15.00,30,'No',NULL,'<p>Warehouse Purchased</p>','2020-05-25'),(3,'Direct Expense Ledger','7895641235',1,'Purchase Property',5000000.00,'2020-05-28',2,48,'4442222','MThkMjA5NzAzMjNmMmUzYWMzODA4M2M5N2RhNGUxMDQucGRm',10.00,17.00,30,'No',NULL,'<p>Test</p>','2020-05-28'),(4,'Test Expense Ledger','7778888',2,'Rent Paid',100000.00,'2020-05-29',1,48,'112233','NmMyNjQwMDAzNDQzNTlmNTM0MGE3MzM3YzY4ODAyZmIucGRm',12.50,14.50,30,'No','','','2020-05-29');
/*!40000 ALTER TABLE `expense_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_type_master`
--

DROP TABLE IF EXISTS `expense_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_type_master` (
  `expense_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_type` varchar(150) NOT NULL,
  `expense_type_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`expense_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_type_master`
--

LOCK TABLES `expense_type_master` WRITE;
/*!40000 ALTER TABLE `expense_type_master` DISABLE KEYS */;
INSERT INTO `expense_type_master` VALUES (1,'Rent','2020-05-12'),(2,'Purchase Property','2020-05-12');
/*!40000 ALTER TABLE `expense_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_master`
--

DROP TABLE IF EXISTS `income_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `income_master` (
  `income_id` int(11) NOT NULL AUTO_INCREMENT,
  `income_ledger_head` varchar(100) NOT NULL,
  `income_ledger_number` varchar(100) NOT NULL,
  `property_id` int(11) NOT NULL,
  `income_title` varchar(255) NOT NULL,
  `income_amount` decimal(15,2) NOT NULL,
  `income_date` text NOT NULL,
  `income_type_id` int(11) NOT NULL,
  `income_source_party` int(11) NOT NULL,
  `income_invoice_number` varchar(100) NOT NULL,
  `invoice_upload` varchar(255) NOT NULL,
  `tds_percentage` decimal(15,2) NOT NULL,
  `gst_percentage` decimal(15,2) NOT NULL,
  `received_by` int(11) NOT NULL,
  `recurring_income` varchar(10) NOT NULL,
  `next_recurring_date` varchar(50) DEFAULT NULL,
  `income_description` text,
  `income_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`income_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_master`
--

LOCK TABLES `income_master` WRITE;
/*!40000 ALTER TABLE `income_master` DISABLE KEYS */;
INSERT INTO `income_master` VALUES (1,'Income Ledger','123456',2,'Land Income',25000.00,'2020-05-12',1,44,'456898','YjQyOGRlNjgzNDdmNjJhZGE3YzQ0NDdhNDQ2MTUwY2QucGRm',8.50,9.99,30,'No',NULL,'<p>Test For Income</p>','2020-05-21'),(2,'Income Ledger 1','78945623',3,'Warehouse Income For Rent',75000.00,'2020-05-11',1,48,'77866','OWQ0NDg0YzAzYTg3ZjZhMTVhOGEwN2QxODM5YWUxMTEucGRm',10.30,14.50,30,'Yes','2020-07-01','<p>&nbsp;</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -37px; top: 34.6px;\">&nbsp;</div>','2020-05-21'),(3,'Income Ledger For Colony','45895623',1,'Colony Rent Monthly',25000.00,'2020-05-18',1,44,'882333','ODU0MzFmNTJhZWNiYTQyODVlMGJlNmZmYWMzMGFmYjAuanBn',13.50,14.50,30,'Yes','2020-06-18','<p>Colony&nbsp;Rent</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 48px; top: 34.6px;\">&nbsp;</div>','2020-05-21'),(4,'Direct Income','8456289',2,'Land Direct Income',95000.00,'2020-05-11',1,48,'452089','ZDJkZDBhMDFiMDE2YjUzYWQyOWJkODgyNWZkM2JkOGMucGRm',5.50,13.00,30,'Yes','2020-06-02','<p>Direct Income For Land</p>','2020-05-22');
/*!40000 ALTER TABLE `income_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_type_master`
--

DROP TABLE IF EXISTS `income_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `income_type_master` (
  `income_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `income_type` varchar(150) NOT NULL,
  `income_type_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`income_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_type_master`
--

LOCK TABLES `income_type_master` WRITE;
/*!40000 ALTER TABLE `income_type_master` DISABLE KEYS */;
INSERT INTO `income_type_master` VALUES (1,'Rent','2020-05-12'),(2,'Sale Property','2020-05-12');
/*!40000 ALTER TABLE `income_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_company_master`
--

DROP TABLE IF EXISTS `insurance_company_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_company_master` (
  `insurance_company_id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance_company` varchar(255) NOT NULL,
  `insurance_company_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`insurance_company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_company_master`
--

LOCK TABLES `insurance_company_master` WRITE;
/*!40000 ALTER TABLE `insurance_company_master` DISABLE KEYS */;
INSERT INTO `insurance_company_master` VALUES (6,'IFFCO Tokio','2020-04-07'),(2,'Aditya Birla','2020-04-07'),(3,'Bajaj Allianz','2020-04-07'),(4,'Bharti AXA','2020-04-07'),(5,'ICICI Lombard','2020-04-07'),(7,'SBI','2020-04-07'),(8,'Canara HSBC Oriental Bank of Commerce Life Insurance Company Limited','2020-05-18');
/*!40000 ALTER TABLE `insurance_company_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_master`
--

DROP TABLE IF EXISTS `insurance_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_master` (
  `insurance_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `insurance_name` varchar(255) NOT NULL,
  `insurance_company_id` int(11) NOT NULL,
  `policy_no` varchar(50) NOT NULL,
  `insurance_type_id` int(11) NOT NULL,
  `premium_amount` varchar(15) NOT NULL,
  `contact_agent` int(11) NOT NULL,
  `lean_mark` varchar(5) NOT NULL,
  `lean_person_name` varchar(255) DEFAULT NULL,
  `lean_amount` varchar(15) DEFAULT NULL,
  `next_premium_date` varchar(50) NOT NULL,
  `insurance_expiry_date` varchar(50) NOT NULL,
  `policy_owner` int(11) NOT NULL,
  `policy_payer` varchar(255) NOT NULL,
  `insurance_beneficiary` int(11) NOT NULL,
  `ledger_number` varchar(100) NOT NULL,
  `ledger_head` varchar(100) NOT NULL,
  `insurance_renewed` varchar(20) NOT NULL,
  `insurance_remark` text,
  `insurance_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`insurance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_master`
--

LOCK TABLES `insurance_master` WRITE;
/*!40000 ALTER TABLE `insurance_master` DISABLE KEYS */;
INSERT INTO `insurance_master` VALUES (1,3,'Zydus Warehouse',6,'12345667890',3,'2000',33,'Yes','Zyuds - Mahesh Rana','5000','2020-06-25','2020-06-26',35,'zydus',34,'552242','Policy Ledger','2','<p>Zydus Warehouse</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -11px; top: -12px;\">&nbsp;</div>','2020-04-07'),(2,2,'Flats Insurance',4,'78956423115',1,'10000',33,'No',NULL,NULL,'2020-05-12','2020-06-30',35,'zydus',34,'123456','Policy Ledger','0','<p>Zyuds Flats Fire Insurance.</p>\r\n<p><br /> Test</p>','2020-04-07'),(3,1,'Colony Flood Insurance',3,'4562318970',2,'25000',33,'Yes','Zyuds - Mahesh Rana','20000','2020-06-08','2020-07-31',35,'zydus',34,'123466','Policy Ledger12','2','<p>Colony Flood Insurance</p>','2020-04-07'),(4,2,'Commercial Land',7,'4564564562',4,'50000',33,'No','','','2021-04-27','2020-06-27',35,'zydus',34,'123456','Policy Ledger','1','<p>Land Insurance</p>','2020-04-07'),(6,3,'test',6,'12345667890',3,'12000',33,'Yes','Zyuds - Ajit Sahay','5000','2020-06-14','2020-04-30',35,'zydus',34,'12345634','Ledger','1','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -237px; top: 34.6px;\">&nbsp;</div>','2020-04-07'),(7,3,'Zyudus Warehouse Flood Insurance',8,'1234500000',5,'555533',33,'Yes','Oriental Bank','15000','2020-07-22','2022-04-22',32,'Zydus Real Estate',47,'1111111112222','1111111000','0','<p>Testing of Edit insurance Detail\'s</p>','2020-04-07');
/*!40000 ALTER TABLE `insurance_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_type_master`
--

DROP TABLE IF EXISTS `insurance_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_type_master` (
  `insurance_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance_type` varchar(255) NOT NULL,
  `insurance_type_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`insurance_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_type_master`
--

LOCK TABLES `insurance_type_master` WRITE;
/*!40000 ALTER TABLE `insurance_type_master` DISABLE KEYS */;
INSERT INTO `insurance_type_master` VALUES (1,'Fire Insurance','2020-04-07'),(2,'Flood Insurance','2020-04-07'),(3,'Earthquake Insurance','2020-04-07'),(4,'Land Insurance','2020-04-07'),(5,'Damage Insurance','2020-05-18'),(6,'Flood Damage','2020-06-22');
/*!40000 ALTER TABLE `insurance_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land_type_master`
--

DROP TABLE IF EXISTS `land_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land_type_master` (
  `land_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `land_type` varchar(100) NOT NULL,
  `land_type_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`land_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_type_master`
--

LOCK TABLES `land_type_master` WRITE;
/*!40000 ALTER TABLE `land_type_master` DISABLE KEYS */;
INSERT INTO `land_type_master` VALUES (1,'Juni Sharat','2020-04-27'),(2,'Navi Sharat','2020-04-27'),(3,'abc','2020-06-12'),(4,'Land 1','2020-06-22');
/*!40000 ALTER TABLE `land_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lease_given_lessee_master`
--

DROP TABLE IF EXISTS `lease_given_lessee_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lease_given_lessee_master` (
  `lease_given_lessee_id` int(11) NOT NULL AUTO_INCREMENT,
  `lease_given_id` int(11) NOT NULL,
  `lessee_id` int(11) NOT NULL,
  `lease_given_lessee_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`lease_given_lessee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lease_given_lessee_master`
--

LOCK TABLES `lease_given_lessee_master` WRITE;
/*!40000 ALTER TABLE `lease_given_lessee_master` DISABLE KEYS */;
INSERT INTO `lease_given_lessee_master` VALUES (1,1,53,'2020-06-10'),(2,1,52,'2020-06-10'),(3,2,54,'2020-06-10'),(4,2,40,'2020-06-10'),(5,2,53,'2020-06-10');
/*!40000 ALTER TABLE `lease_given_lessee_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lease_given_master`
--

DROP TABLE IF EXISTS `lease_given_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lease_given_master` (
  `lease_given_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `lessee_name` varchar(50) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `payment_date` int(11) NOT NULL,
  `lease_amount` decimal(15,2) NOT NULL,
  `lease_increment_type` varchar(20) NOT NULL,
  `lease_increment` decimal(15,2) NOT NULL,
  `lease_increment_month` int(11) NOT NULL,
  `area_given_on_lease` varchar(50) NOT NULL,
  `lease_security_deposit` decimal(15,2) NOT NULL,
  `lease_contract_status` varchar(30) NOT NULL,
  `contract_upload` varchar(255) NOT NULL,
  `lease_terms` text NOT NULL,
  `lease_remarks` text NOT NULL,
  `lease_given_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`lease_given_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lease_given_master`
--

LOCK TABLES `lease_given_master` WRITE;
/*!40000 ALTER TABLE `lease_given_master` DISABLE KEYS */;
INSERT INTO `lease_given_master` VALUES (1,2,'53,52','2020-06-10','2021-04-10',10,100000.00,'Rupees',15000.00,4,'8000',50000.00,'Not Received','MDc2OGZlYzE0ZmMzMTIyMjAyMDc1MGI0MDIxNzU2MmQuemlw','<p>Zydus Commercial Land Terms</p>','<p>Zydus Commercial Land Remark</p>','2020-06-10'),(2,1,'54,40,53','2020-06-22','2024-06-22',29,25000.00,'Percentage',4.00,4,'7000',30000.00,'Not Received','ZjU3MjE1Nzc0MzgwYzU0MmRhMWUxN2Q2OTk0MmZhMGEuemlw','<p>Colony Terms</p>','','2020-06-10');
/*!40000 ALTER TABLE `lease_given_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lease_own_lessor_master`
--

DROP TABLE IF EXISTS `lease_own_lessor_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lease_own_lessor_master` (
  `lease_own_lessor_id` int(11) NOT NULL AUTO_INCREMENT,
  `lease_own_id` int(11) NOT NULL,
  `lessor_id` int(11) NOT NULL,
  `lease_own_lessor_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`lease_own_lessor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lease_own_lessor_master`
--

LOCK TABLES `lease_own_lessor_master` WRITE;
/*!40000 ALTER TABLE `lease_own_lessor_master` DISABLE KEYS */;
INSERT INTO `lease_own_lessor_master` VALUES (1,1,50,'2020-06-09'),(2,1,49,'2020-06-09'),(3,2,51,'2020-06-09'),(4,2,50,'2020-06-09'),(5,2,39,'2020-06-09'),(11,5,49,'2020-06-11'),(10,5,50,'2020-06-11'),(12,6,51,'2020-06-19');
/*!40000 ALTER TABLE `lease_own_lessor_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lease_own_master`
--

DROP TABLE IF EXISTS `lease_own_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lease_own_master` (
  `lease_own_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `lessor_name` varchar(50) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `payment_date` int(11) NOT NULL,
  `lease_amount` decimal(15,2) NOT NULL,
  `lease_increment_type` varchar(20) NOT NULL,
  `lease_increment` decimal(15,2) NOT NULL,
  `lease_increment_month` int(11) NOT NULL,
  `area_taken_on_lease` varchar(50) NOT NULL,
  `lease_security_deposit` decimal(15,2) NOT NULL,
  `lease_contract_status` varchar(10) NOT NULL,
  `contract_upload` varchar(255) NOT NULL,
  `lease_terms` text NOT NULL,
  `lease_remarks` text NOT NULL,
  `lease_own_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`lease_own_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lease_own_master`
--

LOCK TABLES `lease_own_master` WRITE;
/*!40000 ALTER TABLE `lease_own_master` DISABLE KEYS */;
INSERT INTO `lease_own_master` VALUES (1,3,'50,49','2020-06-01','2022-06-01',29,75000.00,'Percentage',10.00,2,'5000',25000.00,'Unpaid','ZjFhYjUxNjY0ZTk1MTJjNDY2ZTYwZjQ4OTRmMTY5OTEuemlw','<p>test</p>','<p>test</p>','2020-06-09'),(2,2,'51,50,39','2020-06-01','2024-08-01',21,85000.00,'Rupees',10000.00,5,'5000 Sq.ft',50000.00,'Unpaid','ZmU5NDYyYmY2YTU3NjI2NDdjMDEzNDZhMmZmYWIxY2Iuemlw','<p>&nbsp;Zydus Commercial Land Terms and Conditions</p>','<p>Zydus Commercial Land</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -47px; top: -12px;\">&nbsp;</div>','2020-06-09'),(5,1,'50,49','2020-06-04','2020-06-30',8,2500000.00,'Percentage',10.00,3,'10000 Sq.ft',65000.00,'Unpaid','NGI2YTc3Njk3MWJiYTUxM2VjMzBkMGFkMzdkYzlkODMuemlw','<p>test</p>','','2020-06-11'),(6,2,'51','2020-05-01','2020-06-30',2,100000.00,'Percentage',10.00,10,'100',100000.00,'Paid','YTRiM2Y2MzM5MzgwNmFlZjZiY2NlOGE0ODFiOGJlNzguemlw','<p>Lease Term</p>','<p>Lease Remark</p>','2020-06-19');
/*!40000 ALTER TABLE `lease_own_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_advocate_master`
--

DROP TABLE IF EXISTS `legal_advocate_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_advocate_master` (
  `legal_advocate_id` int(11) NOT NULL AUTO_INCREMENT,
  `legal_id` int(11) NOT NULL,
  `advocate_id` int(11) NOT NULL,
  `legal_advocate_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`legal_advocate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_advocate_master`
--

LOCK TABLES `legal_advocate_master` WRITE;
/*!40000 ALTER TABLE `legal_advocate_master` DISABLE KEYS */;
INSERT INTO `legal_advocate_master` VALUES (3,2,55,'2020-06-12'),(4,2,43,'2020-06-12');
/*!40000 ALTER TABLE `legal_advocate_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_case_against_master`
--

DROP TABLE IF EXISTS `legal_case_against_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_case_against_master` (
  `legal_case_against_id` int(11) NOT NULL AUTO_INCREMENT,
  `legal_id` int(11) NOT NULL,
  `case_against_id` int(11) NOT NULL,
  `legal_case_against_added_Date` varchar(50) NOT NULL,
  PRIMARY KEY (`legal_case_against_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_case_against_master`
--

LOCK TABLES `legal_case_against_master` WRITE;
/*!40000 ALTER TABLE `legal_case_against_master` DISABLE KEYS */;
INSERT INTO `legal_case_against_master` VALUES (3,2,3,'2020-06-12'),(4,2,2,'2020-06-12'),(5,2,1,'2020-06-12');
/*!40000 ALTER TABLE `legal_case_against_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_case_by_master`
--

DROP TABLE IF EXISTS `legal_case_by_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_case_by_master` (
  `legal_case_by_id` int(11) NOT NULL AUTO_INCREMENT,
  `legal_id` int(11) NOT NULL,
  `case_by_id` int(11) NOT NULL,
  `legal_case_by_added_Date` varchar(50) NOT NULL,
  PRIMARY KEY (`legal_case_by_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_case_by_master`
--

LOCK TABLES `legal_case_by_master` WRITE;
/*!40000 ALTER TABLE `legal_case_by_master` DISABLE KEYS */;
INSERT INTO `legal_case_by_master` VALUES (3,2,4,'2020-06-12'),(4,2,3,'2020-06-12'),(5,2,2,'2020-06-12');
/*!40000 ALTER TABLE `legal_case_by_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_case_status_master`
--

DROP TABLE IF EXISTS `legal_case_status_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_case_status_master` (
  `case_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `case_status` varchar(100) NOT NULL,
  `case_status_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`case_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_case_status_master`
--

LOCK TABLES `legal_case_status_master` WRITE;
/*!40000 ALTER TABLE `legal_case_status_master` DISABLE KEYS */;
INSERT INTO `legal_case_status_master` VALUES (1,'Ongoing','2020-05-11'),(2,'Completed','2020-05-11'),(3,'Moved To High Court','2020-05-11'),(4,'Pending','2020-05-18');
/*!40000 ALTER TABLE `legal_case_status_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_court_authority_master`
--

DROP TABLE IF EXISTS `legal_court_authority_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_court_authority_master` (
  `legal_authority_id` int(11) NOT NULL AUTO_INCREMENT,
  `legal_court_authority` varchar(200) NOT NULL,
  `legal_court_authority_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`legal_authority_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_court_authority_master`
--

LOCK TABLES `legal_court_authority_master` WRITE;
/*!40000 ALTER TABLE `legal_court_authority_master` DISABLE KEYS */;
INSERT INTO `legal_court_authority_master` VALUES (1,'Civil Court','2020-05-11'),(2,'High Court','2020-05-11'),(3,'Supreme Court','2020-05-18');
/*!40000 ALTER TABLE `legal_court_authority_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_master`
--

DROP TABLE IF EXISTS `legal_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_master` (
  `legal_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `case_number` varchar(100) NOT NULL,
  `case_by_id` varchar(100) NOT NULL,
  `case_against_id` varchar(100) NOT NULL,
  `police_station_id` int(11) NOT NULL,
  `act_section_applied` varchar(50) NOT NULL,
  `case_type` varchar(50) NOT NULL,
  `case_registered_date` varchar(50) NOT NULL,
  `advocate_id` varchar(100) NOT NULL,
  `court_authority_id` int(11) NOT NULL,
  `case_document_upload` varchar(255) NOT NULL,
  `legal_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`legal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_master`
--

LOCK TABLES `legal_master` WRITE;
/*!40000 ALTER TABLE `legal_master` DISABLE KEYS */;
INSERT INTO `legal_master` VALUES (2,2,'78956','4,3,2','3,2,1',4,'320','Criminal','2020-06-02','55,43',3,'YWE5MGMxNjZlNjFiM2MwOWY5ZTNhNTg4MGMyNDQ3YjUuemlw','2020-06-12');
/*!40000 ALTER TABLE `legal_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessee_master`
--

DROP TABLE IF EXISTS `lessee_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessee_master` (
  `lessee_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `lessee_name` int(11) NOT NULL,
  `share_in_property` decimal(15,2) NOT NULL,
  `lessee_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`lessee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessee_master`
--

LOCK TABLES `lessee_master` WRITE;
/*!40000 ALTER TABLE `lessee_master` DISABLE KEYS */;
INSERT INTO `lessee_master` VALUES (1,5,54,1000.00,'2020-06-15'),(2,5,53,1200.00,'2020-06-15'),(3,13,54,1111.00,'2020-06-15'),(4,13,53,1100.00,'2020-06-15'),(5,16,53,12.00,'2020-06-15'),(6,17,53,12.00,'2020-06-15'),(7,18,54,12.00,'2020-06-15'),(8,20,54,12.00,'2020-06-15'),(9,22,54,12.00,'2020-06-15'),(10,23,54,12.00,'2020-06-15'),(11,24,54,12.00,'2020-06-15'),(12,25,54,12.00,'2020-06-15'),(13,26,54,12.00,'2020-06-15'),(14,27,54,12.00,'2020-06-15'),(104,62,53,10.00,'2020-06-24'),(103,62,52,50.00,'2020-06-24'),(101,57,52,5000.00,'2020-06-24'),(102,57,54,4500.00,'2020-06-24');
/*!40000 ALTER TABLE `lessee_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessor_master`
--

DROP TABLE IF EXISTS `lessor_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessor_master` (
  `lessor_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `lessor_name` int(11) NOT NULL,
  `share_in_property` decimal(15,2) NOT NULL,
  `lessor_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`lessor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessor_master`
--

LOCK TABLES `lessor_master` WRITE;
/*!40000 ALTER TABLE `lessor_master` DISABLE KEYS */;
INSERT INTO `lessor_master` VALUES (1,5,51,500.00,'2020-06-15'),(2,5,39,1000.00,'2020-06-15'),(3,13,51,1000.00,'2020-06-15'),(4,13,50,2000.00,'2020-06-15'),(5,16,39,12.00,'2020-06-15'),(6,17,39,12.00,'2020-06-15'),(7,18,39,12.00,'2020-06-15'),(8,20,49,12.00,'2020-06-15'),(9,22,49,12.00,'2020-06-15'),(10,23,49,12.00,'2020-06-15'),(11,24,49,12.00,'2020-06-15'),(12,25,49,12.00,'2020-06-15'),(13,26,50,12.00,'2020-06-15'),(14,27,49,12.00,'2020-06-15'),(19,51,50,3500.00,'2020-06-16'),(20,52,50,3500.00,'2020-06-16'),(90,57,49,6000.00,'2020-06-24'),(89,57,49,7000.00,'2020-06-24'),(91,62,39,10.00,'2020-06-24');
/*!40000 ALTER TABLE `lessor_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_installment_master`
--

DROP TABLE IF EXISTS `loan_installment_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_installment_master` (
  `loan_installment_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `installment_amount` decimal(15,2) NOT NULL,
  `payment_reference` varchar(50) NOT NULL,
  `loan_installment_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`loan_installment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_installment_master`
--

LOCK TABLES `loan_installment_master` WRITE;
/*!40000 ALTER TABLE `loan_installment_master` DISABLE KEYS */;
INSERT INTO `loan_installment_master` VALUES (1,2,13900.00,'Cheque','2020-06-02'),(2,2,13900.00,'Cheque','2020-06-02'),(3,2,13900.00,'Draft','2020-06-02'),(4,2,13900.00,'Cheque','2020-06-02'),(5,2,13900.00,'Cheque','2020-06-02'),(6,2,13900.00,'Cheque','2020-06-02'),(7,1,208532.27,'Draft','2020-06-03');
/*!40000 ALTER TABLE `loan_installment_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_master`
--

DROP TABLE IF EXISTS `loan_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_master` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `loan_officer_id` int(11) NOT NULL,
  `loan_beneficary` int(11) NOT NULL,
  `loan_amount` decimal(15,2) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `interest_type` varchar(50) NOT NULL,
  `installment_interest` decimal(15,2) NOT NULL,
  `installment_amount` decimal(15,2) NOT NULL,
  `total_loan_amount` decimal(15,2) NOT NULL,
  `payment_date` varchar(10) NOT NULL,
  `reminder_day` int(11) NOT NULL,
  `total_no_installments` int(11) NOT NULL,
  `loan_type_id` int(11) NOT NULL,
  `loan_remark` text,
  `loan_installment_status` varchar(10) NOT NULL,
  `loan_added_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_master`
--

LOCK TABLES `loan_master` WRITE;
/*!40000 ALTER TABLE `loan_master` DISABLE KEYS */;
INSERT INTO `loan_master` VALUES (1,2,3,4,45,2500000.00,'2020-06-01','2021-07-01','Compound Interest',7.50,208532.27,2710919.51,'14',29,13,2,'<p>Loan Taken For Land</p>','Paid','2020-06-01'),(2,3,2,2,42,80000.00,'2020-05-01','2020-11-01','Simple Interest',8.50,13900.00,83400.00,'05',10,6,3,'<p>Loan For Zydus Warehouse</p>','Fully Paid','2020-06-01'),(3,60,2,5,45,500000.00,'2020-06-01','2020-06-16','Simple Interest',7.50,0.00,5000000.00,'08',23,0,1,'<p>Loan remark here&nbsp;</p>','Not Paid','2020-06-19'),(4,4,3,4,45,100000.00,'2020-05-01','2020-06-30','Simple Interest',10.00,100833.33,100833.33,'01',16,1,5,'<ul>\r\n<li>Loan&nbsp;</li>\r\n</ul>','Not Paid','2020-06-19'),(5,60,2,2,45,156000.00,'2020-06-24','2020-11-19','Simple Interest',14500.00,1916200.00,9581000.00,'20',5,5,4,'<p>Testing</p>','Not Paid','2020-06-22'),(6,2,3,4,45,5000000.00,'2020-04-01','2020-12-01','Simple Interest',7.50,656250.00,5250000.00,'07',22,8,4,'<p>Test Remarks</p>','Not Paid','2020-06-22');
/*!40000 ALTER TABLE `loan_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_officer_master`
--

DROP TABLE IF EXISTS `loan_officer_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_officer_master` (
  `loan_officer_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) NOT NULL,
  `loan_officer_name` varchar(150) NOT NULL,
  `loan_officer_contact` varchar(20) NOT NULL,
  `loan_officer_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`loan_officer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_officer_master`
--

LOCK TABLES `loan_officer_master` WRITE;
/*!40000 ALTER TABLE `loan_officer_master` DISABLE KEYS */;
INSERT INTO `loan_officer_master` VALUES (1,1,'Shatish Varma','6688774455','2020-05-01'),(2,2,'Priyanka Chaudhry','9875612354','2020-05-01'),(3,1,'Preksha Shah','6688774455','2020-05-04'),(4,3,'Akhil Trivedi','1234567895','2020-05-18'),(5,2,'Nidhi Shah','9278456315','2020-05-19');
/*!40000 ALTER TABLE `loan_officer_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_type_master`
--

DROP TABLE IF EXISTS `loan_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_type_master` (
  `loan_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_type` varchar(255) NOT NULL,
  `loan_type_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`loan_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_type_master`
--

LOCK TABLES `loan_type_master` WRITE;
/*!40000 ALTER TABLE `loan_type_master` DISABLE KEYS */;
INSERT INTO `loan_type_master` VALUES (1,'Mortgage loan','2020-05-01'),(2,'FHA-Insured Loans','2020-05-01'),(3,'Conventional Loans','2020-05-01'),(4,'Veteran Affairs (VA) Loan','2020-05-18'),(5,'Special Purpose Loan','2020-05-19');
/*!40000 ALTER TABLE `loan_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `police_station_master`
--

DROP TABLE IF EXISTS `police_station_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `police_station_master` (
  `police_station_id` int(11) NOT NULL AUTO_INCREMENT,
  `police_station_name` varchar(150) NOT NULL,
  `police_station_contact_number` varchar(20) NOT NULL,
  `police_station_branch` varchar(150) NOT NULL,
  `police_station_address` varchar(255) NOT NULL,
  `police_station_state` varchar(150) NOT NULL,
  `police_station_city` varchar(150) NOT NULL,
  `police_station_pincode` varchar(15) NOT NULL,
  `police_station_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`police_station_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `police_station_master`
--

LOCK TABLES `police_station_master` WRITE;
/*!40000 ALTER TABLE `police_station_master` DISABLE KEYS */;
INSERT INTO `police_station_master` VALUES (1,'Ellis Bridge Police Station','079 2657 8202','Ellis Bridge','Ashram Rd, Opp. Town Hall, Ellisbridge','Gujarat','Ahmedabad','380006','2020-05-11'),(2,'Bodakdev Police Station','079 1234 5678','Bodakdev','Judges Bungalow Cross Rd, Bodakdev','Ahmedabad','Gujarat','380054','2020-05-11'),(3,'Anand Nagar Police Station','079 2676 2250','Ambawadi',' 8, Surendra Mangaldas Rd, Ambawadi','Gujarat','Ahmedabad','380015','2020-05-18'),(4,'Navrangpura Police Station','079 2644 0698','Navrangpura','91-92, 74-73, 39, 40, Umashankar Joshi Marg, Mithakhali, Navrangpura','Gujarat','Ahmedabad','380009','2020-05-19');
/*!40000 ALTER TABLE `police_station_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_financial_status_master`
--

DROP TABLE IF EXISTS `property_financial_status_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_financial_status_master` (
  `financial_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `financial_status` varchar(100) NOT NULL,
  `financial_status_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`financial_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_financial_status_master`
--

LOCK TABLES `property_financial_status_master` WRITE;
/*!40000 ALTER TABLE `property_financial_status_master` DISABLE KEYS */;
INSERT INTO `property_financial_status_master` VALUES (1,'Sold','2020-04-27'),(2,'Purchased','2020-04-27'),(3,'Leased','2020-04-27'),(4,'Purchased - Leased','2020-04-27'),(5,'Leased - Subleased','2020-04-27'),(6,'Test Status 1','2020-06-22');
/*!40000 ALTER TABLE `property_financial_status_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_fixed_expense_master`
--

DROP TABLE IF EXISTS `property_fixed_expense_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_fixed_expense_master` (
  `fixed_expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `expense_amount` decimal(15,2) NOT NULL,
  `fixed_expense_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`fixed_expense_id`)
) ENGINE=MyISAM AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_fixed_expense_master`
--

LOCK TABLES `property_fixed_expense_master` WRITE;
/*!40000 ALTER TABLE `property_fixed_expense_master` DISABLE KEYS */;
INSERT INTO `property_fixed_expense_master` VALUES (1,5,2,1000.00,'2020-06-15'),(2,5,1,1500.00,'2020-06-15'),(216,60,1,150.00,'2020-06-24'),(4,11,2,2000.00,'2020-06-15'),(5,12,2,2000.00,'2020-06-15'),(6,13,2,1000.00,'2020-06-15'),(7,13,1,1500.00,'2020-06-15'),(8,16,1,23.00,'2020-06-15'),(9,17,1,23.00,'2020-06-15'),(10,18,2,121.00,'2020-06-15'),(11,20,2,12.00,'2020-06-15'),(12,21,2,1000.00,'2020-06-15'),(13,22,2,1212.00,'2020-06-15'),(14,23,2,1212.00,'2020-06-15'),(15,24,2,121.00,'2020-06-15'),(16,25,2,121.00,'2020-06-15'),(17,26,2,12.00,'2020-06-15'),(18,27,2,12.00,'2020-06-15'),(215,60,2,150.00,'2020-06-24'),(21,46,2,2500.00,'2020-06-15'),(221,62,2,10.00,'2020-06-24'),(219,57,2,1000.00,'2020-06-24'),(210,58,2,250.00,'2020-06-24'),(212,59,2,250.00,'2020-06-24'),(29,52,1,1500.00,'2020-06-16'),(30,53,2,1000.00,'2020-06-16'),(31,53,1,1200.00,'2020-06-16'),(32,54,2,1000.00,'2020-06-16'),(33,54,1,1200.00,'2020-06-16'),(220,62,1,55.00,'2020-06-24');
/*!40000 ALTER TABLE `property_fixed_expense_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_fixed_expense_type_master`
--

DROP TABLE IF EXISTS `property_fixed_expense_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_fixed_expense_type_master` (
  `fixed_expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `fixed_expense` varchar(100) NOT NULL,
  `fixed_expense_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`fixed_expense_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_fixed_expense_type_master`
--

LOCK TABLES `property_fixed_expense_type_master` WRITE;
/*!40000 ALTER TABLE `property_fixed_expense_type_master` DISABLE KEYS */;
INSERT INTO `property_fixed_expense_type_master` VALUES (1,'Stamp Duty','2020-04-27'),(2,'Municipal Tax','2020-04-27'),(3,'Test','2020-06-22'),(4,'abcdef','2020-06-22');
/*!40000 ALTER TABLE `property_fixed_expense_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_images_master`
--

DROP TABLE IF EXISTS `property_images_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_images_master` (
  `property_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `property_image` varchar(255) NOT NULL,
  `image_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`property_image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_images_master`
--

LOCK TABLES `property_images_master` WRITE;
/*!40000 ALTER TABLE `property_images_master` DISABLE KEYS */;
INSERT INTO `property_images_master` VALUES (1,18,'','2020-06-15'),(2,18,'','2020-06-15'),(3,18,'','2020-06-15'),(4,20,'','2020-06-15'),(5,20,'','2020-06-15'),(6,20,'','2020-06-15'),(7,21,'','2020-06-15'),(8,21,'','2020-06-15'),(9,40,'b322e3702449a8ee87c6bb8d9c29f92874c778a9bb7c9b89a13bde4b1fa028e5a183de84e87154937441dd42c88a016954ba8f40074e870cc53845db2e58a752.png','2020-06-15'),(10,40,'b322e3702449a8ee87c6bb8d9c29f92874c778a9bb7c9b89a13bde4b1fa028e5a183de84e87154937441dd42c88a016954ba8f40074e870cc53845db2e58a7521.png','2020-06-15'),(11,41,'103cec6af8983bf30bd8050364fb1927b8822cd02b97551f4dee800a8bed4e4f75c6e44cd77a96f086e91df11445efda1ca44aa91433803a266ad28418475316.png','2020-06-15'),(12,41,'103cec6af8983bf30bd8050364fb1927b8822cd02b97551f4dee800a8bed4e4f75c6e44cd77a96f086e91df11445efda1ca44aa91433803a266ad284184753161.png','2020-06-15'),(83,62,'VGVzdGluZ19Qcm9wZXJ0eV8xS2FKc2dvWnpYVi9iMGFiMTFkMWQ1NGY3YjlkZDY2YmI3YzQxMzgzZTVhNGM2ZTUyZWI0Nzc5OTQxNDVlZjlhNGFkNmI2NjUzZmU1MzdjMjIwMjA3YTNiM2UyY2UxY2MwOTY4ZDFkMTIwOGFmYTIwODFmN2U1NjhmNTM0NjkxNDk5NTMzZDI3ZDhjZS5qcGc=','2020-06-23'),(84,62,'VGVzdGluZ19Qcm9wZXJ0eV8xS2FKc2dvWnpYVi9iMGFiMTFkMWQ1NGY3YjlkZDY2YmI3YzQxMzgzZTVhNGM2ZTUyZWI0Nzc5OTQxNDVlZjlhNGFkNmI2NjUzZmU1MzdjMjIwMjA3YTNiM2UyY2UxY2MwOTY4ZDFkMTIwOGFmYTIwODFmN2U1NjhmNTM0NjkxNDk5NTMzZDI3ZDhjZTEuanBn','2020-06-23'),(26,47,'WnlkdXNfSG91c2UxS0Z5Nzlnbno2LzYzMjRkYjZmOGJlMTU0ZGE4ZTE0MjQ5YjZmN2U4ZDI1ZjQ3MWVkMDhhOGZjMDVjMzIwYTBmMmIxYTA4MzEyYjE0YWRmYjRmOGUyNzkwMDE5OTc0MDkxMTBiYmM2MDJkMDkwMTk2YmRlZTI5ODk0YjJhM2Q5YzIwYWIzNWYxZDZkNC5qcGc=','2020-06-15'),(25,47,'WnlkdXNfSG91c2UxS0Z5Nzlnbno2LzYzMjRkYjZmOGJlMTU0ZGE4ZTE0MjQ5YjZmN2U4ZDI1ZjQ3MWVkMDhhOGZjMDVjMzIwYTBmMmIxYTA4MzEyYjE0YWRmYjRmOGUyNzkwMDE5OTc0MDkxMTBiYmM2MDJkMDkwMTk2YmRlZTI5ODk0YjJhM2Q5YzIwYWIzNWYxZDZkMy5qcGc=','2020-06-15'),(24,47,'WnlkdXNfSG91c2UxS0Z5Nzlnbno2LzYzMjRkYjZmOGJlMTU0ZGE4ZTE0MjQ5YjZmN2U4ZDI1ZjQ3MWVkMDhhOGZjMDVjMzIwYTBmMmIxYTA4MzEyYjE0YWRmYjRmOGUyNzkwMDE5OTc0MDkxMTBiYmM2MDJkMDkwMTk2YmRlZTI5ODk0YjJhM2Q5YzIwYWIzNWYxZDZkMi5qcGc=','2020-06-15'),(23,47,'WnlkdXNfSG91c2UxS0Z5Nzlnbno2LzYzMjRkYjZmOGJlMTU0ZGE4ZTE0MjQ5YjZmN2U4ZDI1ZjQ3MWVkMDhhOGZjMDVjMzIwYTBmMmIxYTA4MzEyYjE0YWRmYjRmOGUyNzkwMDE5OTc0MDkxMTBiYmM2MDJkMDkwMTk2YmRlZTI5ODk0YjJhM2Q5YzIwYWIzNWYxZDZkMS5qcGc=','2020-06-15'),(22,47,'WnlkdXNfSG91c2UxS0Z5Nzlnbno2LzYzMjRkYjZmOGJlMTU0ZGE4ZTE0MjQ5YjZmN2U4ZDI1ZjQ3MWVkMDhhOGZjMDVjMzIwYTBmMmIxYTA4MzEyYjE0YWRmYjRmOGUyNzkwMDE5OTc0MDkxMTBiYmM2MDJkMDkwMTk2YmRlZTI5ODk0YjJhM2Q5YzIwYWIzNWYxZDZkLmpwZw==','2020-06-15'),(85,62,'VGVzdGluZ19Qcm9wZXJ0eV8xTFNzVERlN21OaC8zMTQxNjNmYmYyMTk0MjZjODZkNGY1YzVmMGM0MTA1N2VlYmM5YWNhNWNjMTNlZWJiMjMwMTc0ZDZlMjc0ZGZlNzkxYjMyYjg0ZWQ5NDc0NzFmNmFjMjVjNjk0MGRlZTEzNjQzOTkzYzc0MWFkZmUyYjFmMjZlOGU4YjgyY2Q2Ni5qcGc=','2020-06-23'),(78,60,'QWdyaWN1bHR1cmVfTGFuZF9Qcm9wZXJ0eWJyUGtKd1d0UVMvN2ZkMTY0MzMyYzM4ZTUzNTFiMDA1NDNlOGYzMGE0NDQxMjhkNjg3Zjc5YjZhOGFlMDQ5NDU5MjE2MzlmNTFjM2UzMzAyNjQwYjEyZDQ1YjY3YTEwYjQ2ZDhkMTlkYmE2M2M2ODc3NTQ3YzA2MDMzYjc0Mzc4NTgwYzU2MzUzYWIuanBn','2020-06-17'),(76,60,'QWdyaWN1bHR1cmVfTGFuZF9Qcm9wZXJ0eXMzbkVKb2ZpeDkvNjI5OTI0MmFkNzdjYjY1Zjk4NGZmMGRhM2YzMzFlMTIzYWJhY2VlNjA5ZjkyNzQ0ZmM4M2Q2N2U2ZWRkMDQ2ZGM5ODE3OTUxMDNjYzNiMDNmY2NlYWMxN2U2OWVhODA1OGMwMWU5NjdlMTcxYzM0N2EzNDVhMTgyNjJmNDM1MDkucG5n','2020-06-17'),(74,59,'Ti9BX0xhbmRfR290YXZPSWhYb2xIeFkvNzk1NTIwNzk4ZDRhZWIxMTE3ODk1ZWViOGE3NTc0ODEyMTc1MDIwNGU5MzQ1YTRiODAxOGU1NTc5N2I3ODk1NTVjMjJhNDQ1YzdhNjFiZDIzYTdkYjA4N2Y2NGVjOGFlOTk2NDc1NjYzODUwNDliOTMwMzE4ZTI4YjljMmJkNWMuanBn','2020-06-17'),(75,59,'Ti9BX0xhbmRfR290YXZPSWhYb2xIeFkvNzk1NTIwNzk4ZDRhZWIxMTE3ODk1ZWViOGE3NTc0ODEyMTc1MDIwNGU5MzQ1YTRiODAxOGU1NTc5N2I3ODk1NTVjMjJhNDQ1YzdhNjFiZDIzYTdkYjA4N2Y2NGVjOGFlOTk2NDc1NjYzODUwNDliOTMwMzE4ZTI4YjljMmJkNWMucG5n','2020-06-17'),(72,57,'WnlkdXNfQWdyaV9MYW5kZXQ2SkloTG9XMS8wNzZkNWNhZDZlMDhjZTRlOTMxMmY2MzlhNGRhMDlhODJmNjdlYzlkNTY3NDQ2ZjE4OGMzOTA3OGE4ZTY1ZmQ1Y2JiYTg3MzQ4ZTMzZWE4NmZmNzVkMTY0NzQ2OGQ1YWNhZTAyYmU0N2Y5OTNlN2JiMmRmODc4ZThmOTQ1YmYyNTEuanBn','2020-06-17'),(73,57,'WnlkdXNfQWdyaV9MYW5kZXQ2SkloTG9XMS8wNzZkNWNhZDZlMDhjZTRlOTMxMmY2MzlhNGRhMDlhODJmNjdlYzlkNTY3NDQ2ZjE4OGMzOTA3OGE4ZTY1ZmQ1Y2JiYTg3MzQ4ZTMzZWE4NmZmNzVkMTY0NzQ2OGQ1YWNhZTAyYmU0N2Y5OTNlN2JiMmRmODc4ZThmOTQ1YmYyNTIuanBn','2020-06-17'),(71,57,'WnlkdXNfQWdyaV9MYW5kZXQ2SkloTG9XMS8wNzZkNWNhZDZlMDhjZTRlOTMxMmY2MzlhNGRhMDlhODJmNjdlYzlkNTY3NDQ2ZjE4OGMzOTA3OGE4ZTY1ZmQ1Y2JiYTg3MzQ4ZTMzZWE4NmZmNzVkMTY0NzQ2OGQ1YWNhZTAyYmU0N2Y5OTNlN2JiMmRmODc4ZThmOTQ1YmYyNTEuanBlZw==','2020-06-17'),(70,57,'WnlkdXNfQWdyaV9MYW5kZXQ2SkloTG9XMS8wNzZkNWNhZDZlMDhjZTRlOTMxMmY2MzlhNGRhMDlhODJmNjdlYzlkNTY3NDQ2ZjE4OGMzOTA3OGE4ZTY1ZmQ1Y2JiYTg3MzQ4ZTMzZWE4NmZmNzVkMTY0NzQ2OGQ1YWNhZTAyYmU0N2Y5OTNlN2JiMmRmODc4ZThmOTQ1YmYyNS5qcGVn','2020-06-17'),(69,57,'WnlkdXNfQWdyaV9MYW5kZXQ2SkloTG9XMS8wNzZkNWNhZDZlMDhjZTRlOTMxMmY2MzlhNGRhMDlhODJmNjdlYzlkNTY3NDQ2ZjE4OGMzOTA3OGE4ZTY1ZmQ1Y2JiYTg3MzQ4ZTMzZWE4NmZmNzVkMTY0NzQ2OGQ1YWNhZTAyYmU0N2Y5OTNlN2JiMmRmODc4ZThmOTQ1YmYyNS5qcGc=','2020-06-17'),(68,57,'WnlkdXNfQWdyaV9MYW5kUmdWR0lXU3g0TC80YThlZWIwMDM1OTVkMDBhM2YwZjJmYzM4ZDcwMTU3YmMzYzRlYzdmOGViNDFkZmYzMWQ4MzQ4YzhjODY4NDQzY2JiYzc4NTZjZDFiYjc5OWEwZDRlODY5ZDgwMGQ3ZWY4NTMyOGU1MzY0Yzk2MTUwNWE1ZDIxNjJmNDZhOWMyNjEuanBn','2020-06-17'),(65,57,'WnlkdXNfQWdyaV9MYW5kUmdWR0lXU3g0TC80YThlZWIwMDM1OTVkMDBhM2YwZjJmYzM4ZDcwMTU3YmMzYzRlYzdmOGViNDFkZmYzMWQ4MzQ4YzhjODY4NDQzY2JiYzc4NTZjZDFiYjc5OWEwZDRlODY5ZDgwMGQ3ZWY4NTMyOGU1MzY0Yzk2MTUwNWE1ZDIxNjJmNDZhOWMyNi5wbmc=','2020-06-17'),(67,57,'WnlkdXNfQWdyaV9MYW5kUmdWR0lXU3g0TC80YThlZWIwMDM1OTVkMDBhM2YwZjJmYzM4ZDcwMTU3YmMzYzRlYzdmOGViNDFkZmYzMWQ4MzQ4YzhjODY4NDQzY2JiYzc4NTZjZDFiYjc5OWEwZDRlODY5ZDgwMGQ3ZWY4NTMyOGU1MzY0Yzk2MTUwNWE1ZDIxNjJmNDZhOWMyNi5qcGc=','2020-06-17'),(66,57,'WnlkdXNfQWdyaV9MYW5kUmdWR0lXU3g0TC80YThlZWIwMDM1OTVkMDBhM2YwZjJmYzM4ZDcwMTU3YmMzYzRlYzdmOGViNDFkZmYzMWQ4MzQ4YzhjODY4NDQzY2JiYzc4NTZjZDFiYjc5OWEwZDRlODY5ZDgwMGQ3ZWY4NTMyOGU1MzY0Yzk2MTUwNWE1ZDIxNjJmNDZhOWMyNjEucG5n','2020-06-17'),(82,62,'VGVzdGluZ19Qcm9wZXJ0eV8xOUJ4QUZLT2drdS9lZGFkZjE0YjZjYmZhN2Q3YTJmZmYyNzdiNjlhMzM5NzUxZmQ2YmEzYzhhNWJiMjUwN2M1YTI1OGI2ZTU4NDExYTcyNzdlYTZiZDYwOTBlNTk1NTcwNTQ2NzA5NDZkYmVmNGE5MTlmZTAzMDBmZjhiMTZlNjQ2ODA5OThlZGE2NS5wbmc=','2020-06-22'),(86,62,'VGVzdGluZ19Qcm9wZXJ0eV8xTFNzVERlN21OaC8zMTQxNjNmYmYyMTk0MjZjODZkNGY1YzVmMGM0MTA1N2VlYmM5YWNhNWNjMTNlZWJiMjMwMTc0ZDZlMjc0ZGZlNzkxYjMyYjg0ZWQ5NDc0NzFmNmFjMjVjNjk0MGRlZTEzNjQzOTkzYzc0MWFkZmUyYjFmMjZlOGU4YjgyY2Q2NjEuanBn','2020-06-23');
/*!40000 ALTER TABLE `property_images_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_jurisdiction_master`
--

DROP TABLE IF EXISTS `property_jurisdiction_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_jurisdiction_master` (
  `jurisdiction_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_jurisdiction` varchar(100) NOT NULL,
  `juri_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`jurisdiction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_jurisdiction_master`
--

LOCK TABLES `property_jurisdiction_master` WRITE;
/*!40000 ALTER TABLE `property_jurisdiction_master` DISABLE KEYS */;
INSERT INTO `property_jurisdiction_master` VALUES (1,'Rent','2020-04-27'),(2,'Tax','2020-04-27'),(3,'ABC','2020-06-22');
/*!40000 ALTER TABLE `property_jurisdiction_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_master`
--

DROP TABLE IF EXISTS `property_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_master` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_type_id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `property_contract` varchar(10) NOT NULL,
  `unit` varchar(40) NOT NULL,
  `property_unit` decimal(15,2) NOT NULL,
  `property_price_per_unit` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `nature_of_land` varchar(30) DEFAULT NULL,
  `land_type_id` int(11) DEFAULT NULL,
  `rera_number` varchar(100) DEFAULT NULL,
  `bu_number` varchar(100) DEFAULT NULL,
  `property_controller_id` int(11) NOT NULL,
  `property_juridiction_id` int(11) NOT NULL,
  `property_purchase_date` varchar(50) NOT NULL,
  `property_status_id` int(11) NOT NULL,
  `property_remarks` text NOT NULL,
  `financial_status_id` int(11) NOT NULL,
  `mark_property_as_sold` varchar(10) DEFAULT NULL,
  `poperty_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_master`
--

LOCK TABLES `property_master` WRITE;
/*!40000 ALTER TABLE `property_master` DISABLE KEYS */;
INSERT INTO `property_master` VALUES (1,1,'Zydus Colony','','','','','','','','2',0.00,0.00,0.00,'',0,'','',0,0,'',0,'',3,'No','2020-04-06'),(2,4,'Zydus Commerical Land','','','','','','','','1',0.00,0.00,0.00,'',0,'','',0,0,'',0,'',2,'No','2020-04-06'),(3,0,'Zydus Warehouse','','','','','','','','2',0.00,0.00,0.00,'',0,'','',0,0,'',0,'',2,'No','2020-04-06'),(4,1,'Zydus Flats','','','','','','','','1',0.00,0.00,0.00,'',0,'','',0,0,'',0,'',3,'No','2020-04-06'),(59,4,'N/A Land Gota','Unnamed Road, Katlupur, Delhi 131103, India',' Katlupur','Delhi','131103','28.836337945940226','77.03411340312499','Buy','2',145.00,12056.00,1748120.00,'Industrial',2,'','',65,2,'2020-06-18',1,'<p>Property Remark Here</p>',2,'No','2020-06-17'),(62,2,'Testing Property 1','5, Rd Number 1, Patel Colony, Jamnagar, Gujarat 361008, India',' Jamnagar','Gujarat','361008','22.48466046084248','70.05773','Lease','3',700.00,13000000.00,9100000000.00,'',0,'11111111111111','55555555555555555',58,2,'2020-07-23',2,'<p>Testing</p>',3,'No','2020-06-22'),(60,3,'Agriculture Land Property','2076, Brhampoll, Sanand, Gujarat 382110, India','Ahmedabad','Gujarat','380015','22.9919637','72.3772986','Buy','3',4580.00,156852.00,718382160.00,'Commercial',2,'','',31,2,'2020-07-13',1,'<p>Property Remark</p>',2,'No','2020-06-17'),(47,1,'Zydus House','Khajuri Rd, Chhipakuva, Ahmedabad, Gujarat 380028, India','Ahmedabad','Gujarat','380015','22.98205381084043','72.57136209999999','Buy','2',1000.00,2000.00,2000000.00,'',0,'','',31,1,'2020-06-15',1,'<p>Zydus House</p>',2,'No','2020-06-15'),(57,3,'Zydus Agri Land','Tamil University Rd, AVP Azhagammal Nagar, Thanjavur, Tamil Nadu 613010, India',' Thanjavur','Tamil Nadu','613010','10.7396081','79.09460159999999','Lease','1',10000.00,7500.00,75000000.00,'Commercial',2,'','',31,1,'2020-06-17',1,'<p>test</p>',3,'No','2020-06-17'),(58,4,'N/A Land Gota','Mintoo Road Terminal, Ajmeri Gate, Kamla Market, Ajmeri Gate, New Delhi, Delhi 110002, India',' New Delhi',' Delhi','110002','28.64005869999999','77.2231445','Buy','2',145.00,12056.00,1748120.00,'Industrial',2,'','',31,2,'2020-06-18',1,'<p>Property Remark Here</p>',1,'Yes','2020-06-17');
/*!40000 ALTER TABLE `property_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_status_master`
--

DROP TABLE IF EXISTS `property_status_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_status_master` (
  `property_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_status` varchar(100) NOT NULL,
  `Property_status_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`property_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_status_master`
--

LOCK TABLES `property_status_master` WRITE;
/*!40000 ALTER TABLE `property_status_master` DISABLE KEYS */;
INSERT INTO `property_status_master` VALUES (1,'Notaries','2020-04-27'),(2,'Test Property Status','2020-06-22');
/*!40000 ALTER TABLE `property_status_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_type_master`
--

DROP TABLE IF EXISTS `property_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_type_master` (
  `property_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_type` varchar(100) NOT NULL,
  `property_type_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`property_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_type_master`
--

LOCK TABLES `property_type_master` WRITE;
/*!40000 ALTER TABLE `property_type_master` DISABLE KEYS */;
INSERT INTO `property_type_master` VALUES (1,'House/Flat','2020-04-24'),(2,'Building/Warehouse/Commercial Building','2020-04-24'),(3,'Agricultural Land','2020-04-24'),(4,'N/A Land','2020-04-24'),(5,'Type 1','2020-06-22');
/*!40000 ALTER TABLE `property_type_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaser_master`
--

DROP TABLE IF EXISTS `purchaser_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaser_master` (
  `purchaser_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `purchaser_name` int(11) NOT NULL,
  `share_in_property` decimal(15,2) NOT NULL,
  `purchaser_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`purchaser_id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaser_master`
--

LOCK TABLES `purchaser_master` WRITE;
/*!40000 ALTER TABLE `purchaser_master` DISABLE KEYS */;
INSERT INTO `purchaser_master` VALUES (125,59,57,50.00,'2020-06-24'),(123,58,57,50.00,'2020-06-24'),(3,11,41,800.00,'2020-06-15'),(4,11,41,600.00,'2020-06-15'),(5,12,41,800.00,'2020-06-15'),(6,12,41,1000.00,'2020-06-15'),(7,21,41,1000.00,'2020-06-15'),(8,21,41,500.00,'2020-06-15'),(9,46,41,1000.00,'2020-06-15'),(127,60,57,485.00,'2020-06-24'),(126,60,41,400.00,'2020-06-24');
/*!40000 ALTER TABLE `purchaser_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seller_master`
--

DROP TABLE IF EXISTS `seller_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seller_master` (
  `seller_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `seller_name` int(11) NOT NULL,
  `share_in_property` decimal(15,2) NOT NULL,
  `seller_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seller_master`
--

LOCK TABLES `seller_master` WRITE;
/*!40000 ALTER TABLE `seller_master` DISABLE KEYS */;
INSERT INTO `seller_master` VALUES (156,59,56,10.00,'2020-06-24'),(154,58,56,10.00,'2020-06-24'),(3,11,37,1000.00,'2020-06-15'),(4,11,37,800.00,'2020-06-15'),(5,12,37,1000.00,'2020-06-15'),(6,12,37,1800.00,'2020-06-15'),(7,21,37,1000.00,'2020-06-15'),(8,21,37,800.00,'2020-06-15'),(9,46,37,1000.00,'2020-06-15'),(158,60,37,155.00,'2020-06-24'),(157,60,56,250.00,'2020-06-24');
/*!40000 ALTER TABLE `seller_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_master`
--

DROP TABLE IF EXISTS `unit_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_master` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(100) NOT NULL,
  `unit_added_date` varchar(50) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_master`
--

LOCK TABLES `unit_master` WRITE;
/*!40000 ALTER TABLE `unit_master` DISABLE KEYS */;
INSERT INTO `unit_master` VALUES (1,'Sq.mtrs','2020-04-24'),(2,'Sq.ft','2020-04-24'),(3,'vigha','2020-06-19'),(4,'Unit 1','2020-06-22');
/*!40000 ALTER TABLE `unit_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_document_master`
--

DROP TABLE IF EXISTS `upload_document_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_document_master` (
  `upload_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `document_for` varchar(20) NOT NULL,
  `document_authority_id` int(11) NOT NULL,
  `renewal_date` varchar(50) NOT NULL,
  `document_number` varchar(100) NOT NULL,
  `registration_date` varchar(50) NOT NULL,
  `execution_date` varchar(50) NOT NULL,
  `notification_day` int(11) NOT NULL,
  `document_upload` varchar(255) NOT NULL,
  `document_uploaded_date` varchar(50) NOT NULL,
  PRIMARY KEY (`upload_document_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_document_master`
--

LOCK TABLES `upload_document_master` WRITE;
/*!40000 ALTER TABLE `upload_document_master` DISABLE KEYS */;
INSERT INTO `upload_document_master` VALUES (1,59,1,'Purchase',2,'','7895642315','2020-06-10','2020-06-15',15,'NTllbk4xNHRURzVsLzM4OTMzODE4MjRkZWE4NTJlMGYxNzQ0NzMzYTA5MWMwM2NjMjM2NTlmYWU1Yjk1Y2U5Zjc4Y2QxMzI2YjQzOGU0NjA3NDY4MDNlZjhjYTNhY2VkZGFmMzg3NDlhNzhhMTA0NzNhMWMxOGM2MWYwM2U4YjQyNDVhZjZlZTE1YTE4LnBkZg==','2020-06-24'),(2,60,6,'Sales',3,'2020-09-04','7895642315','2020-06-01','2020-06-15',22,'NjBKTUNmQjdEQWlyL2JlZWNhMzg3ZDIzNThiNDYyMTk0YjM3MzgxMGNiYmZlYTVhMWE3OTIzODE2ODExYjY0ODIzNTZlMDI1ZTg4N2Y4MTJjYmIwMGQ0ODNjYjlmMmYzNDAyMTU2ZjY5YTJlZTZkNTZmMDA2MWJmYmNmNWE4MmYwN2IzOTNlNGYyYTRiLnppcA==','2020-06-24'),(3,59,2,'Lease',1,'2020-06-03','78953250','2020-06-03','2020-06-05',14,'NTlYTDJ1bjFZVXdCLzc5ZTAwN2VkNTMzN2FiNzBkNGExZTIyN2I2MjM2MGZiOWYzZWNiMWRjNzM1MmRkODkwY2Y3Y2ZjZDkzZGJmMDEyMzU4OTRhMzM3ZTA0MGVhM2VlYTMyMjJkYjI4MGJhZGZjNTQ2ZGI3MzhmMzJiNjM2MTEzMmM2MDE5YWVjZmNmLnppcA==','2020-06-24');
/*!40000 ALTER TABLE `upload_document_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_master`
--

DROP TABLE IF EXISTS `user_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(15) NOT NULL,
  `gst_number` varchar(30) DEFAULT NULL,
  `pancard_no` varchar(30) DEFAULT NULL,
  `pancard_image` varchar(255) DEFAULT NULL,
  `adharcard_no` varchar(30) DEFAULT NULL,
  `adharcard_image` varchar(255) DEFAULT NULL,
  `date_added` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_master`
--

LOCK TABLES `user_master` WRITE;
/*!40000 ALTER TABLE `user_master` DISABLE KEYS */;
INSERT INTO `user_master` VALUES (32,11,'Rajesh Sahay','test@gmail.com','1234567890','Ahmedabad Sola Road','Zydus','Ahmedabad','Gujarat','380015','12345ASD859','789BFC333','tree-2.png','14257823598','boradcast_media.jpg','2020-04-06'),(33,10,'Rohini','rohini@gmail.com','1234567110','Ahmedabad  -Sola Road','Zydus','Ahmedabad','Gujarat','380015','12345ASD859','789BFC333','Ttuck-Mock-Up-011.png','14257823598','flow_chart_133.jpg','2020-04-06'),(34,12,'Mohan Roy','mohan@gamil.com','7412589632','Boriwali','Zydus Real Estate','Mumbai','Maharashtra','741258','12345ASDF45','789BFC333','1_SFxBtjAaTAC2rsbFW43K0A6.png','14257823598','flow_chart_132.jpg','2020-04-06'),(35,11,'Abhijit M Rathod','abhijit@gmail.com','7412589622','Boriwali Mumbai','Zydus Real Estate','Mumbai','Maharashtra','741388','12345ASD888','789BFC222','Credit_Card_Statement.pdf','14258844598','Credit_Card_Statement.pdf','2020-04-06'),(30,7,'Shreya Shah','shreya@gmail.com','1234567890','Ahmedabad Sola Road','Zydus','Ahmedabad','Gujarat','380015','12345ASDF45','789BFC895','flow_chart_13.jpg','14257823598','FireShot_Capture_001_Google3.png','2020-04-06'),(31,9,'admin','admin123@gmail.com','124444890','Paldi ,Ahmedabad','Zydus','Ahmedabad','Gujarat','380015','12345ASD859','789BFC333','1_SFxBtjAaTAC2rsbFW43K0A7.png','14257823598','soap-bubble-1958650_960_7201.jpg','2020-04-06'),(39,5,'Preksha Shah','shahprexa2509@gmail.com','7412589632','Ahmedabad','Zydus Real Estate','Ahmedabad','Gujarat','380012','12345ASD999','789BFC333','flow_chart_18.jpg','14254443598','FireShot_Capture_001_Google7.png','2020-04-28'),(37,3,'Bhavesh Gajjar','bhaveshgajjar@gmail.com','09033098795','18 badrinath society near vaibhav hall - ghodasar','Divine Infosys','ahmedabad','Gujarat','380050','1111','1111','p530_(1).png','11111','fav.png','2020-04-06'),(38,1,'Ashit Pancholee','ashit@gmail.com','1234567890','Ahmedabad','Zydus','Ahmedabad','Gujarat','380015','12345ASD888','789BFC333','26708.JPG','14257823598','Bajunda.jpg','2020-04-28'),(40,4,'Akhil Trivedi','me.akhiltrivedi@gmail.com','7788996655','Ahmedabad','Divine','Ahmedabad','Gujarat','380012','12345ASD845','78QW2C895','pie_chart.pdf','14258844598','soap-bubble-1958650_960_7202.jpg','2020-04-28'),(41,2,'Nidhi Shah','nidhi@gmail.com','1234567890','Ahmedabad Sola Road','Zydus','Ahmedabad','Gujarat','380015','12345ASD888','789BFC333','15578099620.jpg','14258844598','Patisserie_Menu_V151.pdf','2020-04-28'),(42,8,'Vishal Kotak','vishal200@gmail.com','7788996644','Ahmedabad Sola Road','Divine Infosys','Ahmedabad','Gujarat','380015','12345ASD845','789BFC222','zoom-small-1.jpg','14258844598','blue01.jpg','2020-05-04'),(43,6,'Kavya Roy','kavya@gmail.com','1234567822','Ahmedabad Sola Road test','Zydus Real Estate','Ahmedabad','Gujarat','380015','12345ASD225','789BFC897AZ','img1234.jpg','142588445200','Patisserie_Menu_-_for_Franchisee_-_10.pdf','2020-05-13'),(44,20,'Rishi Prajapati','rishi@gmail.com','7458962315','Test','Rishi Materials','Rajkot','Gujarat','123456','ASDFERT789564','QAZ123WSX','Credit_Card_Statement1.pdf','74125896325','Patisserie_Menu_-_for_Franchisee_-_101.pdf','2020-05-15'),(45,8,'Rima Doshi','rima@gmail.com','7788996655','Ahmedabad Sola Road','Divine','Ahmedabad','Gujarat','380015','12345ASD845','789BFC333','air_advantage10.png','14257823598','Credit_Card_Statement_(1).pdf','2020-05-18'),(46,11,'Mohit Shah','mohit@gmail.com','7788996655','Ahmedabad Sola Road','Divine','Ahmedabad','Gujarat','380015','12345ASD859','789BFC333111','img12341.jpg','14258844598','Ttuck-Mock-Up-012.png','2020-05-18'),(47,12,'Preksha Shah','shahprexa2502223239@gmail.com','1234567890','Boriwali','Zydus','Mumbai','Maharashtra','741258','12345ASD859','789BFC333','air_advantage11.png','14258844598','WhatsApp_Image_2020-04-09_at_3_34_35_PM.jpeg','2020-05-18'),(48,20,'Monark Jadeja','monarkjadeja@gmail.com','4567891235','Sola Road','Zydus Real Estate','Ahmedabad','Gujarat','380018','12345ASD845','789BFCASD555','ZDA5M2I0YmJhZTBhOWQ3MDNmMWQ4Y2Y0MjljN2E0ZjgucGRm','14258844700','ODMyOGU1NTU5ODJlYzcyMjNiYjcxNDFkMzU0ZDg3NjQucGRm','2020-05-19'),(49,5,'Mayank Shah','mayank@gmail.com','1112223334','Ahmedabad','Divine','Ahmedabad','Gujarat','380012','12345ASD888','789BFC333','MTg0MDRhMGI3MWI2NmM2MDEzYzFkMWYwYWFlZmUwMzUuanBlZw==','14258844555','NWU2ZmIyYWM5ZTIzN2QwMmVlYzczZjA1ODQ0Nzc3OTkucGRm','2020-06-03'),(50,5,'Akhil Trivedi','me.akhiltrivedi1@gmail.com','7788996655','Ahmedabad','Divine','Ahmedabad','Gujarat','380012','12345ASD222','789BFC333','M2Y4MGE4ZTg0NzU0NjUwMTEzNDg1OTVlN2EyNzkyYTcuanBlZw==','142588445200','YzNhYTkxNDFiZTg3ZDI1YTI4ZjQ3YzkxYmZiYzZhNjAucG5n','2020-06-03'),(51,5,'Mahi Rathod','mahi@gmail.com','7788996655','Ahmedabad','Divine','Ahmedabad','Gujarat','380012','12345ASD859','789BFCASD555','YjdlMjAyNGU0YTY5ZmU1ODI3NTU2M2ZmYjM3YzMwZDQucGRm','14258844598','M2U4NGE0NDAwMDI1MTdhMTYxZjcxMDQ5MDUyY2RkYzUucGRm','2020-06-05'),(52,4,'Satyam Mishra','satyam@gmail.com','1112223334','Ahmedabad','Zydus Real Estate','Ahmedabad','Gujarat','380012','SDFVG85236GHV','DCVFB5234DC','YmI5N2UzYTUzODBhZTU5OGM1ZmY1M2ZiYTY3Nzk1MjcucGRm','852596367414','NjkzYzZhODIzMTkwNzQwNjkwNDYwNzE4MmZkMmJlZGIucG5n','2020-06-10'),(53,4,'Mohan Pathak','mohanpathak@gamil.com','7412589632','Boriwali','Zydus Real Estate','Mumbai','Maharashtra','741258','12345ASD845','789BFC222','ZmZkNDdlNTgyODUwY2Q5ZGQ4NTkxNmJjYmUzNjBiZDIucGRm','14254443598','OTNjMDBjMjU1MjJiZWUzZWMxMGJjNjM4MWRjMjk5NDUucGRm','2020-06-10'),(54,4,'Maya Shah','maya@gmail.com','1234567890','Ahmedabad Sola Road','Zydus','Ahmedabad','Gujarat','380015','12345ASD999','789BFC897QW','M2ZiMWYyMjJiZDliNTA1YzQ2NWE3ZDZlM2U1MGI2NDgucG5n','14258844555','MGQzYzM0NGYyZWI5MDZiNDZhYWUwYTc2YTVhODMzOWUucGRm','2020-06-10'),(55,6,'Mahesh Vakil','mahesh@gmail.com','7788996655','Ahmedabad Sola Road','Divine','Ahmedabad','Gujarat','380015','12345ASD999','789BFC222','N2U3NTM5YmI0OWQ0MTIxODA3YTY5NWVhYTZiZDQyNzUuanBlZw==','14254443598','MjgyMjU4MDExYzgwYjdjMTM2NDkzZWQxNWY2ODY1MjYucGRm','2020-06-12'),(56,3,'Rahul','rahul001@gmail.com','741258963','Ahmedabad','Divine','ahmedabad','gujarat','380050','7412585269','77455','MjljNzJlZGJjY2QyMmYzYzhlNDVlZDQwNDc4MjNjZWUucG5n','4411223366','Nzk4MjNlNzUyYzllMTRiY2E5OGE2N2FlOTI3NmQ1YTkucG5n','2020-06-17'),(57,2,'Jainam 1','jainam001@gmail.com','7412589630','Ahmedabad','Divine','ahmedabad','Gujarat','380050','22AAAAA0000A1Z5','','YmRmNzYwNDRiZGMxYzc2ODQzN2JiZmM1Yzk2OTcyMWMuanBn','','MWMxZDc2M2RmYTgzZDE1MTdhNDdlZTJkZGY3YzhjZDcuanBn','2020-06-17'),(58,9,'Niraj Lal','nirajlal@gmail.com','7412589630','Ahmedabad','Newtech','ahmedabad','gujarat','380050','18AABCT3518Q1ZV','','N2RlMDc5Mzg3YjEwNzVlNDQ5NzVkM2VjZmUzN2UzMDMuanBn','','OGJiMjYzNWMyNDVjOTYxODBmNGQ0NDU0NWIxYWEzZTAuanBn','2020-06-22'),(59,6,'Rajat Mehta','rajat@gmail.com','7788996655','Ahmedabad',NULL,'Ahmedabad','Gujarat','380012','','',NULL,'',NULL,'2020-06-23'),(63,6,'Reyansh Roy','reyansh@gmail.com','4448885522','Ahmedabad Sola Road','Zydus','Ahmedabad','Gujarat','380015','','','NTBkZjRkNWI5NGVlMGJhNDI2YWUyODQ0NWM3MmNlNmIucGRm','',NULL,'2020-06-23'),(64,6,'Mihir Dave','mihir@gmail.com','7788996655','Ahmedabad','Divine','Ahmedabad','Gujarat','380012','','',NULL,'',NULL,'2020-06-23'),(65,9,'Rishi Anand','rishianand@gmail.com','7458962315','Test','Rishi Materials','Rajkot','Gujarat','123456','22AAAAA0000A1Z5','','NjAyYzE5NGU1NDkyYTYwOTllODM3M2E2MGNjODMwNTIuanBlZw==','','NjQxZDBjMDM0NjZmYjE0NmJjNjU0ZTI3MzIzY2U0MmIucGRm','2020-06-23'),(66,9,'Nikhil Makhija','nikhil@yahoo.com','7788996655','Ahmedabad','','Ahmedabad','Gujarat','380012','','','ZmI5MWU5YTg4NmFiYjA0MGI3ZThiMDE3MDc4NWVmYjYucG5n','123456789521','Y2NmMGFkZTk0ZDE1NDY2MWQ0OTc1MWQ2YWE4YTA4MWMucG5n','2020-06-23');
/*!40000 ALTER TABLE `user_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type_master`
--

DROP TABLE IF EXISTS `user_type_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type_master` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type_master`
--

LOCK TABLES `user_type_master` WRITE;
/*!40000 ALTER TABLE `user_type_master` DISABLE KEYS */;
INSERT INTO `user_type_master` VALUES (1,'Broker'),(2,'Purchaser'),(3,'Seller'),(4,'Lesse'),(5,'Lessor'),(6,'Advocate'),(7,'Staff'),(8,'Loan Beneficiary'),(9,'Property Controller'),(10,'Insurance Agent'),(11,'Policy Owner'),(12,'Insurance Beneficiary'),(20,'Vendor');
/*!40000 ALTER TABLE `user_type_master` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-24 11:30:41
