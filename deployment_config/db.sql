-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ims_data
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` char(36) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `googleplus` varchar(100) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `industry` varchar(50) DEFAULT NULL,
  `annual_revenue` varchar(100) DEFAULT NULL,
  `phone_fax` varchar(100) DEFAULT NULL,
  `billing_address_street` varchar(150) DEFAULT NULL,
  `billing_address_city` varchar(100) DEFAULT NULL,
  `billing_address_state` varchar(100) DEFAULT NULL,
  `billing_address_postalcode` varchar(20) DEFAULT NULL,
  `billing_address_country` varchar(255) DEFAULT NULL,
  `rating` varchar(100) DEFAULT NULL,
  `phone_office` varchar(100) DEFAULT NULL,
  `phone_alternate` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `ownership` varchar(100) DEFAULT NULL,
  `employees` varchar(10) DEFAULT NULL,
  `ticker_symbol` varchar(10) DEFAULT NULL,
  `shipping_address_street` varchar(150) DEFAULT NULL,
  `shipping_address_city` varchar(100) DEFAULT NULL,
  `shipping_address_state` varchar(100) DEFAULT NULL,
  `shipping_address_postalcode` varchar(20) DEFAULT NULL,
  `shipping_address_country` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `sic_code` varchar(10) DEFAULT NULL,
  `duns_num` varchar(15) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `shipping_latitude` decimal(20,12) DEFAULT NULL,
  `shipping_longitude` decimal(20,12) DEFAULT NULL,
  `billing_latitude` decimal(20,12) DEFAULT NULL,
  `billing_longitude` decimal(20,12) DEFAULT NULL,
  `last_call_status` varchar(100) DEFAULT '',
  `last_call_date` datetime DEFAULT NULL,
  `portal_account` varchar(100) DEFAULT NULL,
  `portal_password` varchar(60) DEFAULT '$2y$10$GZeG0xdSWASEvVc33LJPhONDlZ8TRb0kitPW/zTgLPYx/UeUoaIdi',
  `international_name` varchar(255) DEFAULT NULL,
  `business_code` varchar(255) DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Active',
  `portal_active` tinyint(1) DEFAULT '1',
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_accounts_date_modfied` (`date_modified`),
  KEY `idx_accounts_id_del` (`id`,`deleted`),
  KEY `idx_accounts_date_entered` (`date_entered`),
  KEY `idx_accounts_name_del` (`name`,`deleted`),
  KEY `idx_accnt_parent_id` (`parent_id`),
  KEY `idx_account_billing_address_city` (`billing_address_city`),
  KEY `idx_account_billing_address_country` (`billing_address_country`),
  KEY `idx_accounts_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_accounts_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_accounts_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_accounts_cjtpl_id` (`dri_workflow_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_audit`
--

DROP TABLE IF EXISTS `accounts_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_accounts_audit_parent_id` (`parent_id`),
  KEY `idx_accounts_audit_event_id` (`event_id`),
  KEY `idx_accounts_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_accounts_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_audit`
--

LOCK TABLES `accounts_audit` WRITE;
/*!40000 ALTER TABLE `accounts_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_b_invoices_1_c`
--

DROP TABLE IF EXISTS `accounts_b_invoices_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_b_invoices_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `accounts_b_invoices_1accounts_ida` char(36) DEFAULT NULL,
  `accounts_b_invoices_1b_invoices_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_accounts_b_invoices_1_ida1_deleted` (`accounts_b_invoices_1accounts_ida`,`deleted`),
  KEY `idx_accounts_b_invoices_1_idb2_deleted` (`accounts_b_invoices_1b_invoices_idb`,`deleted`),
  KEY `accounts_b_invoices_1_alt` (`accounts_b_invoices_1b_invoices_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_b_invoices_1_c`
--

LOCK TABLES `accounts_b_invoices_1_c` WRITE;
/*!40000 ALTER TABLE `accounts_b_invoices_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_b_invoices_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_bugs`
--

DROP TABLE IF EXISTS `accounts_bugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_bugs` (
  `id` char(36) NOT NULL,
  `account_id` char(36) DEFAULT NULL,
  `bug_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_acc_bug_acc` (`account_id`),
  KEY `idx_acc_bug_bug` (`bug_id`),
  KEY `idx_account_bug` (`account_id`,`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_bugs`
--

LOCK TABLES `accounts_bugs` WRITE;
/*!40000 ALTER TABLE `accounts_bugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_bugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_cases`
--

DROP TABLE IF EXISTS `accounts_cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_cases` (
  `id` char(36) NOT NULL,
  `account_id` char(36) DEFAULT NULL,
  `case_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_acc_case_acc` (`account_id`),
  KEY `idx_acc_acc_case` (`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_cases`
--

LOCK TABLES `accounts_cases` WRITE;
/*!40000 ALTER TABLE `accounts_cases` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_contacts`
--

DROP TABLE IF EXISTS `accounts_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_contacts` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `primary_account` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_account_contact` (`account_id`,`contact_id`),
  KEY `idx_contid_del_accid` (`contact_id`,`deleted`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_contacts`
--

LOCK TABLES `accounts_contacts` WRITE;
/*!40000 ALTER TABLE `accounts_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_dataprivacy`
--

DROP TABLE IF EXISTS `accounts_dataprivacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_dataprivacy` (
  `id` char(36) NOT NULL,
  `account_id` char(36) DEFAULT NULL,
  `dataprivacy_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_acc_dataprivacy_acc` (`account_id`),
  KEY `idx_acc_dataprivacy_dataprivacy` (`dataprivacy_id`),
  KEY `idx_accounts_dataprivacy` (`account_id`,`dataprivacy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_dataprivacy`
--

LOCK TABLES `accounts_dataprivacy` WRITE;
/*!40000 ALTER TABLE `accounts_dataprivacy` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_dataprivacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_opportunities`
--

DROP TABLE IF EXISTS `accounts_opportunities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_opportunities` (
  `id` char(36) NOT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_account_opportunity` (`account_id`,`opportunity_id`),
  KEY `idx_oppid_del_accid` (`opportunity_id`,`deleted`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_opportunities`
--

LOCK TABLES `accounts_opportunities` WRITE;
/*!40000 ALTER TABLE `accounts_opportunities` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_opportunities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_actions`
--

DROP TABLE IF EXISTS `acl_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_actions` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `acltype` varchar(100) DEFAULT NULL,
  `aclaccess` int(3) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_aclaction_id_del` (`id`,`deleted`),
  KEY `idx_category_name` (`category`,`name`),
  KEY `idx_del_category_name_acltype_aclaccess` (`deleted`,`category`,`name`,`acltype`,`aclaccess`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_actions`
--

LOCK TABLES `acl_actions` WRITE;
/*!40000 ALTER TABLE `acl_actions` DISABLE KEYS */;
INSERT INTO `acl_actions` VALUES ('4dcfc98a-1433-11eb-b413-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Leads','module',1,0),('58763932-1433-11eb-9bca-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Leads','module',89,0),('5878a960-1433-11eb-9900-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Leads','module',90,0),('587afc4c-1433-11eb-b2bf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Leads','module',90,0),('588327be-1433-11eb-adad-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Leads','module',90,0),('5884e2d4-1433-11eb-a940-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Leads','module',90,0),('5886ecfa-1433-11eb-95da-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Leads','module',90,0),('58894414-1433-11eb-a17d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Leads','module',90,0),('588b5f6a-1433-11eb-9759-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Leads','module',90,0),('588ef2f6-1433-11eb-aca8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Cases','module',1,0),('589244a6-1433-11eb-b488-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Cases','module',89,0),('5895ae0c-1433-11eb-adc8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Cases','module',90,0),('58992910-1433-11eb-bb20-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Cases','module',90,0),('589c3b78-1433-11eb-b4d6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Cases','module',90,0),('589f1320-1433-11eb-80f4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Cases','module',90,0),('58a17d22-1433-11eb-930a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Cases','module',90,0),('58a3acb4-1433-11eb-88ce-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Cases','module',90,0),('58a6159e-1433-11eb-b566-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Cases','module',90,0),('58a99ea8-1433-11eb-9cda-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Bugs','module',1,0),('58ac194e-1433-11eb-8065-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Bugs','module',89,0),('58aec392-1433-11eb-8486-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Bugs','module',90,0),('58b11afc-1433-11eb-9bf8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Bugs','module',90,0),('58b3ff38-1433-11eb-acd4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Bugs','module',90,0),('58b6ac74-1433-11eb-a471-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Bugs','module',90,0),('58ba32ea-1433-11eb-9c00-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Bugs','module',90,0),('58bdea84-1433-11eb-b165-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Bugs','module',90,0),('58c173d4-1433-11eb-99f5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Bugs','module',90,0),('58c537f8-1433-11eb-b5ee-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','ProspectLists','module',1,0),('58c8e380-1433-11eb-a585-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','ProspectLists','module',89,0),('58cca696-1433-11eb-aff4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','ProspectLists','module',90,0),('58d01f56-1433-11eb-95ff-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','ProspectLists','module',90,0),('58d361fc-1433-11eb-a605-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','ProspectLists','module',90,0),('58d6ae3e-1433-11eb-bf92-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','ProspectLists','module',90,0),('58d9f076-1433-11eb-a6ce-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','ProspectLists','module',90,0),('58dca6b8-1433-11eb-8613-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','ProspectLists','module',90,0),('58df35fe-1433-11eb-81bb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','ProspectLists','module',90,0),('58e273a4-1433-11eb-8b4a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Prospects','module',1,0),('58e513a2-1433-11eb-9ec8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Prospects','module',89,0),('58e79460-1433-11eb-96bc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Prospects','module',90,0),('58ea5b28-1433-11eb-922a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Prospects','module',90,0),('58ed9a2c-1433-11eb-b371-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Prospects','module',90,0),('58f0677a-1433-11eb-aa9f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Prospects','module',90,0),('58f2afee-1433-11eb-8a11-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Prospects','module',90,0),('58f6589c-1433-11eb-9fb0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Prospects','module',90,0),('58f9ab5a-1433-11eb-aa5d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Prospects','module',90,0),('58fde7f6-1433-11eb-b072-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Project','module',1,0),('590101fc-1433-11eb-a77d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Project','module',89,0),('590423b4-1433-11eb-82a8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Project','module',90,0),('5906b188-1433-11eb-bfe3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Project','module',90,0),('59099060-1433-11eb-8bc5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Project','module',90,0),('590ce0ee-1433-11eb-9bb6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Project','module',90,0),('590fa6a8-1433-11eb-a820-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Project','module',90,0),('59127bbc-1433-11eb-a836-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Project','module',90,0),('59165e1c-1433-11eb-bf48-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Project','module',90,0),('5919d2cc-1433-11eb-bdec-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','ProjectTask','module',1,0),('591c9570-1433-11eb-a82c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','ProjectTask','module',89,0),('591f9428-1433-11eb-96f1-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','ProjectTask','module',90,0),('59233998-1433-11eb-9a9c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','ProjectTask','module',90,0),('59261f96-1433-11eb-9411-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','ProjectTask','module',90,0),('59295706-1433-11eb-a428-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','ProjectTask','module',90,0),('592cb798-1433-11eb-916e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','ProjectTask','module',90,0),('592f6e5c-1433-11eb-8af4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','ProjectTask','module',90,0),('5933308c-1433-11eb-9bb7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','ProjectTask','module',90,0),('5937f95a-1433-11eb-9a3e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Campaigns','module',1,0),('593ceb18-1433-11eb-9485-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Campaigns','module',89,0),('5940b784-1433-11eb-b27b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Campaigns','module',90,0),('59443e18-1433-11eb-a52a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Campaigns','module',90,0),('594854da-1433-11eb-8d42-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Campaigns','module',90,0),('594b6436-1433-11eb-8b33-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Campaigns','module',90,0),('594e32ce-1433-11eb-9eb7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Campaigns','module',90,0),('5951932e-1433-11eb-88fd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Campaigns','module',90,0),('5954e5b0-1433-11eb-ae59-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Campaigns','module',90,0),('5957dafe-1433-11eb-8d68-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','EmailMarketing','module',1,0),('595b3f78-1433-11eb-8889-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','EmailMarketing','module',89,0),('595ea24e-1433-11eb-b93c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','EmailMarketing','module',90,0),('596202f4-1433-11eb-a133-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','EmailMarketing','module',90,0),('5965cd62-1433-11eb-93a6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','EmailMarketing','module',90,0),('5969815a-1433-11eb-ab99-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','EmailMarketing','module',90,0),('596e7c0a-1433-11eb-a2c8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','EmailMarketing','module',90,0),('5972f1b8-1433-11eb-ab3e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','EmailMarketing','module',90,0),('5977bf40-1433-11eb-8119-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','EmailMarketing','module',90,0),('597dd402-1433-11eb-aa15-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Users','module',1,0),('59826706-1433-11eb-922f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Users','module',89,0),('59865f64-1433-11eb-b35a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Users','module',90,0),('5989d66c-1433-11eb-94be-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Users','module',90,0),('598ccf3e-1433-11eb-af9f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Users','module',90,0),('5990b43c-1433-11eb-9fdf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Users','module',90,0),('59935052-1433-11eb-aad0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Users','module',90,0),('599717dc-1433-11eb-9b8f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Users','module',90,0),('599a95d8-1433-11eb-ae45-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Users','module',90,0),('599fc382-1433-11eb-bad2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Contacts','module',1,0),('59a39dfe-1433-11eb-9dbb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Contacts','module',89,0),('59a83274-1433-11eb-84ee-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Contacts','module',90,0),('59ad60c8-1433-11eb-b4a8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Contacts','module',90,0),('59b20416-1433-11eb-9b86-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Contacts','module',90,0),('59b68770-1433-11eb-b5c7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Contacts','module',90,0),('59ba76e6-1433-11eb-a1a3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Contacts','module',90,0),('59be36b4-1433-11eb-8f0e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Contacts','module',90,0),('59c1644c-1433-11eb-8ffd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Contacts','module',90,0),('59c52b7c-1433-11eb-9e1b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Accounts','module',1,0),('59c87070-1433-11eb-9cb8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Accounts','module',89,0),('59cc1edc-1433-11eb-b792-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Accounts','module',90,0),('59d27cfa-1433-11eb-9a76-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Accounts','module',90,0),('59d7133c-1433-11eb-bfd6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Accounts','module',90,0),('59dbf2b2-1433-11eb-aa60-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Accounts','module',90,0),('59e05244-1433-11eb-90af-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Accounts','module',90,0),('59e45ace-1433-11eb-bb6b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Accounts','module',90,0),('59e814ca-1433-11eb-a36f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Accounts','module',90,0),('59ecfd28-1433-11eb-a25c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Opportunities','module',1,0),('59f14676-1433-11eb-8d0a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Opportunities','module',89,0),('59f5408c-1433-11eb-8c6b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Opportunities','module',90,0),('59f9092e-1433-11eb-9b10-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Opportunities','module',90,0),('59fcc190-1433-11eb-b43f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Opportunities','module',90,0),('5a00c1a0-1433-11eb-b7a9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Opportunities','module',90,0),('5a05222c-1433-11eb-b449-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Opportunities','module',90,0),('5a0a2b96-1433-11eb-a3bf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Opportunities','module',90,0),('5a0f3c4e-1433-11eb-9bd5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Opportunities','module',90,0),('5a144dc4-1433-11eb-b6a2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','EmailTemplates','module',1,0),('5a186580-1433-11eb-a903-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','EmailTemplates','module',89,0),('5a1c02b2-1433-11eb-b0df-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','EmailTemplates','module',90,0),('5a206672-1433-11eb-b934-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','EmailTemplates','module',90,0),('5a251d16-1433-11eb-89c3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','EmailTemplates','module',90,0),('5a290bf6-1433-11eb-b851-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','EmailTemplates','module',90,0),('5a2c0f40-1433-11eb-b1d4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','EmailTemplates','module',90,0),('5a2f8a6c-1433-11eb-939e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','EmailTemplates','module',90,0),('5a3413b6-1433-11eb-93f5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','EmailTemplates','module',90,0),('5a38cec4-1433-11eb-900c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Notes','module',1,0),('5a3dd022-1433-11eb-a798-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Notes','module',89,0),('5a427744-1433-11eb-bb62-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Notes','module',90,0),('5a4630d2-1433-11eb-aaf0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Notes','module',90,0),('5a49564a-1433-11eb-89a0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Notes','module',90,0),('5a4de3a4-1433-11eb-af46-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Notes','module',90,0),('5a512820-1433-11eb-8b7a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Notes','module',90,0),('5a5473a4-1433-11eb-8786-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Notes','module',90,0),('5a58c3aa-1433-11eb-847b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Notes','module',90,0),('5a5c923c-1433-11eb-a569-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Calls','module',1,0),('5a6001b0-1433-11eb-848a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Calls','module',89,0),('5a646c28-1433-11eb-9629-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Calls','module',90,0),('5a6897ee-1433-11eb-8740-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Calls','module',90,0),('5a6c839a-1433-11eb-b888-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Calls','module',90,0),('5a700182-1433-11eb-b1b6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Calls','module',90,0),('5a73254c-1433-11eb-8d55-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Calls','module',90,0),('5a772df4-1433-11eb-9992-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Calls','module',90,0),('5a7ce578-1433-11eb-bfd3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Calls','module',90,0),('5a8384dc-1433-11eb-902a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Emails','module',1,0),('5a884d46-1433-11eb-835f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Emails','module',89,0),('5a8d02b4-1433-11eb-bef7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Emails','module',90,0),('5a91b2dc-1433-11eb-9fd5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Emails','module',90,0),('5a966822-1433-11eb-99f9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Emails','module',90,0),('5a9ad8bc-1433-11eb-9496-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Emails','module',90,0),('5a9fad24-1433-11eb-a3a2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Emails','module',90,0),('5aa4a0b8-1433-11eb-8eb6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Emails','module',90,0),('5aa91c9c-1433-11eb-8ba5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Emails','module',90,0),('5aae1602-1433-11eb-bf20-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Meetings','module',1,0),('5ab396fe-1433-11eb-a07b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Meetings','module',89,0),('5ab8974e-1433-11eb-9e24-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Meetings','module',90,0),('5abea904-1433-11eb-a6be-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Meetings','module',90,0),('5ac47cc6-1433-11eb-b6bf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Meetings','module',90,0),('5ac9f41c-1433-11eb-9d62-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Meetings','module',90,0),('5acf3cd8-1433-11eb-b697-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Meetings','module',90,0),('5ad46226-1433-11eb-a58b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Meetings','module',90,0),('5ad9b884-1433-11eb-9117-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Meetings','module',90,0),('5ade5eac-1433-11eb-b9d3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Tasks','module',1,0),('5ae2dda6-1433-11eb-9fc9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Tasks','module',89,0),('5ae713da-1433-11eb-859f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Tasks','module',90,0),('5aeb1b42-1433-11eb-9026-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Tasks','module',90,0),('5af0899c-1433-11eb-8dfe-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Tasks','module',90,0),('5af6352c-1433-11eb-9fc7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Tasks','module',90,0),('5afc0448-1433-11eb-b47b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Tasks','module',90,0),('5b01c2f2-1433-11eb-9926-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Tasks','module',90,0),('5b074ede-1433-11eb-b233-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Tasks','module',90,0),('5b0e72f4-1433-11eb-ba9f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Trackers','Tracker',-99,0),('5b139ab8-1433-11eb-bfbf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Trackers','Tracker',-99,0),('5b19147a-1433-11eb-980f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Trackers','Tracker',-99,0),('5b1e1786-1433-11eb-bf61-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Trackers','Tracker',-99,0),('5b22b5a2-1433-11eb-80cf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Trackers','Tracker',-99,0),('5b28d6a8-1433-11eb-86a5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Trackers','Tracker',-99,0),('5b2f75bc-1433-11eb-bddd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Trackers','Tracker',-99,0),('5b369e64-1433-11eb-a843-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Trackers','Tracker',-99,0),('5b3c66e6-1433-11eb-823f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Trackers','Tracker',90,0),('5b425d12-1433-11eb-854f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','TrackerSessions','TrackerSession',-99,0),('5b477e8c-1433-11eb-972c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','TrackerSessions','TrackerSession',-99,0),('5b4cf0b0-1433-11eb-a949-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','TrackerSessions','TrackerSession',-99,0),('5b52a4ba-1433-11eb-a77f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','TrackerSessions','TrackerSession',-99,0),('5b588db2-1433-11eb-86c4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','TrackerSessions','TrackerSession',-99,0),('5b5dfe96-1433-11eb-9e3c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','TrackerSessions','TrackerSession',-99,0),('5b63ed38-1433-11eb-af15-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','TrackerSessions','TrackerSession',-99,0),('5b6aaf60-1433-11eb-bc90-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','TrackerSessions','TrackerSession',-99,0),('5b70fe88-1433-11eb-96a8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','TrackerSessions','TrackerSession',90,0),('5b76630a-1433-11eb-a2ea-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','TrackerPerfs','TrackerPerf',-99,0),('5b7b70fc-1433-11eb-870a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','TrackerPerfs','TrackerPerf',-99,0),('5b801058-1433-11eb-9f22-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','TrackerPerfs','TrackerPerf',-99,0),('5b8575de-1433-11eb-8d52-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','TrackerPerfs','TrackerPerf',-99,0),('5b8a8a7e-1433-11eb-aab2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','TrackerPerfs','TrackerPerf',-99,0),('5b8fca34-1433-11eb-b52f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','TrackerPerfs','TrackerPerf',-99,0),('5b945afe-1433-11eb-95c3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','TrackerPerfs','TrackerPerf',-99,0),('5b99ce4e-1433-11eb-8fbc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','TrackerPerfs','TrackerPerf',-99,0),('5b9f1872-1433-11eb-a80a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','TrackerPerfs','TrackerPerf',90,0),('5ba49856-1433-11eb-b243-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','TrackerQueries','TrackerQuery',-99,0),('5ba8fb4e-1433-11eb-af67-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','TrackerQueries','TrackerQuery',-99,0),('5badbb84-1433-11eb-902e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','TrackerQueries','TrackerQuery',-99,0),('5bb33f64-1433-11eb-a8aa-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','TrackerQueries','TrackerQuery',-99,0),('5bb81f3e-1433-11eb-b768-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','TrackerQueries','TrackerQuery',-99,0),('5bbe38ba-1433-11eb-b74c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','TrackerQueries','TrackerQuery',-99,0),('5bcda944-1433-11eb-919c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','TrackerQueries','TrackerQuery',-99,0),('5bd1d262-1433-11eb-a0ad-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','TrackerQueries','TrackerQuery',-99,0),('5bd6a850-1433-11eb-9fef-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','TrackerQueries','TrackerQuery',90,0),('5bdd69a6-1433-11eb-b8d5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Documents','module',1,0),('5be26b4a-1433-11eb-b7c0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Documents','module',89,0),('5be72824-1433-11eb-9f13-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Documents','module',90,0),('5bec0e0c-1433-11eb-b2e6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Documents','module',90,0),('5bf030cc-1433-11eb-a732-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Documents','module',90,0),('5bf43668-1433-11eb-9739-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Documents','module',90,0),('5bf9015c-1433-11eb-b605-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Documents','module',90,0),('5bfd9776-1433-11eb-be34-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Documents','module',90,0),('5c02abe4-1433-11eb-80e7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Documents','module',90,0),('5c0a16b8-1433-11eb-a48f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Reports','module',1,0),('5c0fee94-1433-11eb-8720-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Reports','module',89,0),('5c141302-1433-11eb-9455-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Reports','module',90,0),('5c188cfc-1433-11eb-a1c7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Reports','module',90,0),('5c1cec84-1433-11eb-8c7e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Reports','module',90,0),('5c2221ae-1433-11eb-aeee-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Reports','module',90,0),('5c2849f8-1433-11eb-a02c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Reports','module',90,0),('5c2dad6c-1433-11eb-9bd8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Reports','module',90,0),('5c34edd4-1433-11eb-8daa-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Reports','module',90,0),('5c3cd076-1433-11eb-9a70-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Quotes','module',1,0),('5c432dcc-1433-11eb-a5a5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Quotes','module',89,0),('5c49c308-1433-11eb-826b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Quotes','module',90,0),('5c4fdd4c-1433-11eb-b900-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Quotes','module',90,0),('5c568980-1433-11eb-8a90-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Quotes','module',90,0),('5c5c293a-1433-11eb-a1bd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Quotes','module',90,0),('5c624dd8-1433-11eb-9bdd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Quotes','module',90,0),('5c68e3d2-1433-11eb-85cc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Quotes','module',90,0),('5c70446a-1433-11eb-96a1-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Quotes','module',90,0),('5c7801fa-1433-11eb-a713-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','RevenueLineItems','module',1,0),('5c7ed6c4-1433-11eb-bf80-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','RevenueLineItems','module',89,0),('5c855e36-1433-11eb-853a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','RevenueLineItems','module',90,0),('5c8bbc22-1433-11eb-8086-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','RevenueLineItems','module',90,0),('5c914a34-1433-11eb-a0da-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','RevenueLineItems','module',90,0),('5c96efca-1433-11eb-b82c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','RevenueLineItems','module',90,0),('5c9c5f64-1433-11eb-a1c9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','RevenueLineItems','module',90,0),('5ca1ba54-1433-11eb-bb46-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','RevenueLineItems','module',90,0),('5ca7b1c0-1433-11eb-807a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','RevenueLineItems','module',90,0),('5cad51de-1433-11eb-b09f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Products','module',1,0),('5cb2d23a-1433-11eb-acc6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Products','module',89,0),('5cb879c4-1433-11eb-9100-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Products','module',90,0),('5cbe5a92-1433-11eb-8c53-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Products','module',90,0),('5cc37612-1433-11eb-9647-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Products','module',90,0),('5cc830d0-1433-11eb-a143-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Products','module',90,0),('5ccd925a-1433-11eb-ae73-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Products','module',90,0),('5cd276f8-1433-11eb-a8ef-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Products','module',90,0),('5cd83638-1433-11eb-a7e9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Products','module',90,0),('5cddad70-1433-11eb-bb93-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','ProductCategories','module',1,0),('5ce304e6-1433-11eb-93ea-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','ProductCategories','module',89,0),('5ce7f3fc-1433-11eb-8568-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','ProductCategories','module',90,0),('5cedce9e-1433-11eb-af46-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','ProductCategories','module',90,0),('5cf42370-1433-11eb-a017-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','ProductCategories','module',90,0),('5cf94d50-1433-11eb-9162-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','ProductCategories','module',90,0),('5cfe3482-1433-11eb-adc0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','ProductCategories','module',90,0),('5d02a0f8-1433-11eb-8af7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','ProductCategories','module',90,0),('5d071a0c-1433-11eb-9f97-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','ProductCategories','module',90,0),('5d0dc136-1433-11eb-bfbb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Forecasts','module',1,0),('5d13579a-1433-11eb-a391-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Forecasts','module',89,0),('5d17cf96-1433-11eb-af99-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Forecasts','module',90,0),('5d1eeda8-1433-11eb-ac81-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Forecasts','module',90,0),('5d271ff0-1433-11eb-8896-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Forecasts','module',90,0),('5d2d3322-1433-11eb-aa97-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Forecasts','module',90,0),('5d3269fa-1433-11eb-b061-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Forecasts','module',90,0),('5d36fa06-1433-11eb-bb9d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Forecasts','module',90,0),('5d3c07c6-1433-11eb-869c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Forecasts','module',90,0),('5d493e8c-1433-11eb-acef-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Contracts','module',1,0),('5d4fe476-1433-11eb-be4a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Contracts','module',89,0),('5d573f14-1433-11eb-a1d5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Contracts','module',90,0),('5d5f145a-1433-11eb-9538-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Contracts','module',90,0),('5d662fb0-1433-11eb-8adc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Contracts','module',90,0),('5d6c61f0-1433-11eb-b080-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Contracts','module',90,0),('5d730726-1433-11eb-83ec-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Contracts','module',90,0),('5d794b0e-1433-11eb-8464-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Contracts','module',90,0),('5d801182-1433-11eb-b6f8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Contracts','module',90,0),('5d87ea10-1433-11eb-b890-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','pmse_Project','module',1,0),('5d904a70-1433-11eb-a828-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','pmse_Project','module',89,0),('5d97220a-1433-11eb-ad1c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','pmse_Project','module',90,0),('5d9df83c-1433-11eb-bf20-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','pmse_Project','module',90,0),('5da49854-1433-11eb-a9ca-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','pmse_Project','module',90,0),('5dab4bd6-1433-11eb-a7dc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','pmse_Project','module',90,0),('5db17e34-1433-11eb-9021-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','pmse_Project','module',90,0),('5db85556-1433-11eb-abf7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','pmse_Project','module',90,0),('5dbeb356-1433-11eb-9586-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','pmse_Project','module',90,0),('5dc4f9c8-1433-11eb-b381-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','pmse_Inbox','module',1,0),('5dcb7262-1433-11eb-a991-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','pmse_Inbox','module',89,0),('5dd1ecdc-1433-11eb-82ab-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','pmse_Inbox','module',90,0),('5dd89a5a-1433-11eb-8d91-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','pmse_Inbox','module',90,0),('5de0a100-1433-11eb-95d9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','pmse_Inbox','module',90,0),('5de7dde4-1433-11eb-95dd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','pmse_Inbox','module',90,0),('5dee8310-1433-11eb-93fe-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','pmse_Inbox','module',90,0),('5df53430-1433-11eb-a698-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','pmse_Inbox','module',90,0),('5dfc8640-1433-11eb-a356-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','pmse_Inbox','module',90,0),('5e035ef2-1433-11eb-9432-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','pmse_Business_Rules','module',1,0),('5e0a4514-1433-11eb-9e43-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','pmse_Business_Rules','module',89,0),('5e11c96a-1433-11eb-a44c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','pmse_Business_Rules','module',90,0),('5e192e62-1433-11eb-8cb9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','pmse_Business_Rules','module',90,0),('5e1f5c9c-1433-11eb-abc5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','pmse_Business_Rules','module',90,0),('5e262dba-1433-11eb-9c85-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','pmse_Business_Rules','module',90,0),('5e2bc5c2-1433-11eb-bf86-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','pmse_Business_Rules','module',90,0),('5e31c1b6-1433-11eb-8854-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','pmse_Business_Rules','module',90,0),('5e376a08-1433-11eb-9066-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','pmse_Business_Rules','module',90,0),('5e3d2ab0-1433-11eb-9048-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','pmse_Emails_Templates','module',1,0),('5e431754-1433-11eb-9ab2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','pmse_Emails_Templates','module',89,0),('5e48d892-1433-11eb-af3f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','pmse_Emails_Templates','module',90,0),('5e4e133e-1433-11eb-ad59-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','pmse_Emails_Templates','module',90,0),('5e53ad44-1433-11eb-86f2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','pmse_Emails_Templates','module',90,0),('5e582e96-1433-11eb-acf0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','pmse_Emails_Templates','module',90,0),('5e5d0ac4-1433-11eb-ba3e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','pmse_Emails_Templates','module',90,0),('5e62d274-1433-11eb-aeb9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','pmse_Emails_Templates','module',90,0),('5e678922-1433-11eb-9bdf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','pmse_Emails_Templates','module',90,0),('5e814dda-1433-11eb-9a33-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','OutboundEmail','module',1,0),('5e865708-1433-11eb-ac86-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','OutboundEmail','module',89,0),('5e8c2ebc-1433-11eb-b72f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','OutboundEmail','module',90,0),('5e92103e-1433-11eb-babd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','OutboundEmail','module',90,0),('5e96ecf8-1433-11eb-a9d4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','OutboundEmail','module',90,0),('5e9e8bfc-1433-11eb-a05c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','OutboundEmail','module',90,0),('5ea60fa8-1433-11eb-b724-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','OutboundEmail','module',90,0),('5eae3b92-1433-11eb-bc71-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','OutboundEmail','module',90,0),('5eb5afc6-1433-11eb-b19d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','OutboundEmail','module',90,0),('5ebd2dbe-1433-11eb-9f06-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','DataPrivacy','module',1,0),('5ec40b66-1433-11eb-99a0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','DataPrivacy','module',89,0),('5ec9e536-1433-11eb-bdc4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','DataPrivacy','module',90,0),('5ed080f8-1433-11eb-b4c2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','DataPrivacy','module',90,0),('5ed88712-1433-11eb-9bbc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','DataPrivacy','module',90,0),('5ee1194a-1433-11eb-ba60-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','DataPrivacy','module',90,0),('5ee974f0-1433-11eb-a0ee-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','DataPrivacy','module',90,0),('5ef22d2a-1433-11eb-9662-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','DataPrivacy','module',90,0),('5ef861d6-1433-11eb-b27e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','DataPrivacy','module',90,0),('5efeb6e4-1433-11eb-b3f2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','ReportSchedules','module',1,0),('5f05dbb8-1433-11eb-b48d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','ReportSchedules','module',89,0),('5f0cd274-1433-11eb-96a8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','ReportSchedules','module',90,0),('5f147600-1433-11eb-a9c1-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','ReportSchedules','module',90,0),('5f1ae62a-1433-11eb-a15a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','ReportSchedules','module',90,0),('5f209e12-1433-11eb-8d65-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','ReportSchedules','module',90,0),('5f25867a-1433-11eb-bd42-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','ReportSchedules','module',90,0),('5f2b6130-1433-11eb-9bc1-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','ReportSchedules','module',90,0),('5f310a72-1433-11eb-bf50-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','ReportSchedules','module',90,0),('5f3729f2-1433-11eb-84cc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Notifications','module',1,0),('5f3d550c-1433-11eb-a8ef-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Notifications','module',89,0),('5f43ca40-1433-11eb-8285-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Notifications','module',90,0),('5f4a8f9c-1433-11eb-b5ef-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Notifications','module',90,0),('5f50134a-1433-11eb-91dc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Notifications','module',90,0),('5f564e04-1433-11eb-be64-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Notifications','module',90,0),('5f5c7c70-1433-11eb-b1ed-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Notifications','module',90,0),('5f632958-1433-11eb-b354-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Notifications','module',90,0),('5f6a4148-1433-11eb-b6b5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Notifications','module',90,0),('5f6fa6e2-1433-11eb-807f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','EAPM','module',1,0),('5f76a0f0-1433-11eb-8762-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','EAPM','module',89,0),('5f7e39e6-1433-11eb-8f99-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','EAPM','module',90,0),('5f86d75e-1433-11eb-8311-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','EAPM','module',90,0),('5f8d0534-1433-11eb-a795-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','EAPM','module',90,0),('5f933f1c-1433-11eb-927e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','EAPM','module',90,0),('5f9ade52-1433-11eb-96fa-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','EAPM','module',90,0),('5fa2581c-1433-11eb-8858-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','EAPM','module',90,0),('5fa99dac-1433-11eb-8327-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','EAPM','module',90,0),('5fb04eae-1433-11eb-bc57-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','WebLogicHooks','module',1,0),('5fb73fa2-1433-11eb-a7af-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','WebLogicHooks','module',89,0),('5fbbf880-1433-11eb-b72e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','WebLogicHooks','module',90,0),('5fc1f62c-1433-11eb-8f79-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','WebLogicHooks','module',90,0),('5fc7275a-1433-11eb-9808-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','WebLogicHooks','module',90,0),('5fccd77c-1433-11eb-bdaf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','WebLogicHooks','module',90,0),('5fd1f162-1433-11eb-a3e5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','WebLogicHooks','module',90,0),('5fd74400-1433-11eb-bab4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','WebLogicHooks','module',90,0),('5fde7342-1433-11eb-b135-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','WebLogicHooks','module',90,0),('5fe534b6-1433-11eb-b949-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','Tags','module',1,0),('5feac322-1433-11eb-8d41-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','Tags','module',89,0),('5ff214ce-1433-11eb-8cad-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','Tags','module',90,0),('5ff7aa92-1433-11eb-8a40-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','Tags','module',90,0),('5ffdad48-1433-11eb-b507-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','Tags','module',90,0),('60022fe4-1433-11eb-8337-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','Tags','module',90,0),('60088df8-1433-11eb-886d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','Tags','module',90,0),('600f79d8-1433-11eb-960f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','Tags','module',90,0),('60154cd2-1433-11eb-b43b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','Tags','module',90,0),('601bfcee-1433-11eb-99cf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','PdfManager','module',1,0),('602290a4-1433-11eb-83fa-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','PdfManager','module',89,0),('6029b14a-1433-11eb-9868-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','PdfManager','module',90,0),('6030225a-1433-11eb-99cd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','PdfManager','module',90,0),('6034b932-1433-11eb-9883-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','PdfManager','module',90,0),('603bc47a-1433-11eb-ac77-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','PdfManager','module',90,0),('604308e8-1433-11eb-be33-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','PdfManager','module',90,0),('60486914-1433-11eb-ae1c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','PdfManager','module',90,0),('604f1430-1433-11eb-863e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','PdfManager','module',90,0),('605617d0-1433-11eb-9bf9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','KBContents','module',1,0),('605b2c7a-1433-11eb-adfd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','KBContents','module',89,0),('6060b23a-1433-11eb-8541-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','KBContents','module',90,0),('6065e912-1433-11eb-a2b5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','KBContents','module',90,0),('606c98fc-1433-11eb-b228-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','KBContents','module',90,0),('60713484-1433-11eb-99cb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','KBContents','module',90,0),('6077db18-1433-11eb-9f32-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','KBContents','module',90,0),('607ddbbc-1433-11eb-bcd4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','KBContents','module',90,0),('60838ddc-1433-11eb-bce7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','KBContents','module',90,0),('608ab86e-1433-11eb-959d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','fte_UsageTracking','module',1,0),('6091a1ba-1433-11eb-9859-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','fte_UsageTracking','module',89,0),('609769c4-1433-11eb-a4eb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','fte_UsageTracking','module',90,0),('609d08e8-1433-11eb-a496-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','fte_UsageTracking','module',90,0),('60a32a0c-1433-11eb-8384-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','fte_UsageTracking','module',90,0),('60a84f14-1433-11eb-96ae-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','fte_UsageTracking','module',90,0),('60ae6728-1433-11eb-956f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','fte_UsageTracking','module',90,0),('60b498e6-1433-11eb-8eb5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','fte_UsageTracking','module',90,0),('60bb2be8-1433-11eb-a969-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','fte_UsageTracking','module',90,0),('60c2e8e2-1433-11eb-88a2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','DRI_Workflows','module',1,0),('60cbaa0e-1433-11eb-8585-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','DRI_Workflows','module',89,0),('60d457d0-1433-11eb-9bf0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','DRI_Workflows','module',90,0),('60dbb3f4-1433-11eb-a26f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','DRI_Workflows','module',90,0),('60e302e4-1433-11eb-af67-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','DRI_Workflows','module',90,0),('60e97002-1433-11eb-94ca-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','DRI_Workflows','module',90,0),('60ef6ce6-1433-11eb-a102-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','DRI_Workflows','module',90,0),('60f5b1aa-1433-11eb-8cdf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','DRI_Workflows','module',90,0),('60fb817a-1433-11eb-a2ff-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','DRI_Workflows','module',90,0),('61027656-1433-11eb-ad87-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','DRI_SubWorkflows','module',1,0),('6109a1ce-1433-11eb-b16f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','DRI_SubWorkflows','module',89,0),('61119d0c-1433-11eb-aa10-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','DRI_SubWorkflows','module',90,0),('61199700-1433-11eb-9860-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','DRI_SubWorkflows','module',90,0),('612110c0-1433-11eb-b425-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','DRI_SubWorkflows','module',90,0),('61278d56-1433-11eb-a71a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','DRI_SubWorkflows','module',90,0),('612e087a-1433-11eb-ad12-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','DRI_SubWorkflows','module',90,0),('614009e4-1433-11eb-81be-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','DRI_SubWorkflows','module',90,0),('61460b1e-1433-11eb-b6db-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','DRI_SubWorkflows','module',90,0),('614d62f6-1433-11eb-ba19-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','DRI_Workflow_Templates','module',1,0),('6152ac2a-1433-11eb-bb9c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','DRI_Workflow_Templates','module',89,0),('6158ef9a-1433-11eb-b468-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','DRI_Workflow_Templates','module',90,0),('6160221a-1433-11eb-9ef8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','DRI_Workflow_Templates','module',90,0),('61665f7c-1433-11eb-8554-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','DRI_Workflow_Templates','module',90,0),('616c7eb6-1433-11eb-b941-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','DRI_Workflow_Templates','module',90,0),('61726650-1433-11eb-be27-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','DRI_Workflow_Templates','module',90,0),('617965ea-1433-11eb-ae74-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','DRI_Workflow_Templates','module',90,0),('61803ad2-1433-11eb-8bf2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','DRI_Workflow_Templates','module',90,0),('618683a6-1433-11eb-b3d4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','DRI_SubWorkflow_Templates','module',1,0),('618ca920-1433-11eb-a5be-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','DRI_SubWorkflow_Templates','module',89,0),('6192b1f8-1433-11eb-99a9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','DRI_SubWorkflow_Templates','module',90,0),('6197e2ea-1433-11eb-af47-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','DRI_SubWorkflow_Templates','module',90,0),('619f1e34-1433-11eb-bd0c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','DRI_SubWorkflow_Templates','module',90,0),('61a57ba8-1433-11eb-a1db-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','DRI_SubWorkflow_Templates','module',90,0),('61ac8394-1433-11eb-b232-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','DRI_SubWorkflow_Templates','module',90,0),('61b28e2e-1433-11eb-9c39-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','DRI_SubWorkflow_Templates','module',90,0),('61b86042-1433-11eb-9c09-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','DRI_SubWorkflow_Templates','module',90,0),('61c366a4-1433-11eb-ac8a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','DRI_Workflow_Task_Templates','module',1,0),('61c99b1e-1433-11eb-b5a7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','DRI_Workflow_Task_Templates','module',89,0),('61d0f0f8-1433-11eb-985d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','DRI_Workflow_Task_Templates','module',90,0),('61d7d198-1433-11eb-b145-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','DRI_Workflow_Task_Templates','module',90,0),('61dfb052-1433-11eb-b570-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','DRI_Workflow_Task_Templates','module',90,0),('61e6e75a-1433-11eb-820f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','DRI_Workflow_Task_Templates','module',90,0),('61ed50fe-1433-11eb-a0fe-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','DRI_Workflow_Task_Templates','module',90,0),('61f378da-1433-11eb-a841-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','DRI_Workflow_Task_Templates','module',90,0),('61fa95d4-1433-11eb-95fd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','DRI_Workflow_Task_Templates','module',90,0),('62019618-1433-11eb-ba9c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','CJ_Forms','module',1,0),('62096dc0-1433-11eb-9813-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','CJ_Forms','module',89,0),('620fb856-1433-11eb-9d9b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','CJ_Forms','module',90,0),('6215bc88-1433-11eb-9bad-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','CJ_Forms','module',90,0),('621b8c30-1433-11eb-b116-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','CJ_Forms','module',90,0),('62220a2e-1433-11eb-bde9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','CJ_Forms','module',90,0),('6229e00a-1433-11eb-a8f8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','CJ_Forms','module',90,0),('623112da-1433-11eb-86c4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','CJ_Forms','module',90,0),('6237929a-1433-11eb-8049-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','CJ_Forms','module',90,0),('623e0530-1433-11eb-8612-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','CJ_WebHooks','module',1,0),('624606cc-1433-11eb-aa15-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','CJ_WebHooks','module',89,0),('624d3d0c-1433-11eb-abcb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','CJ_WebHooks','module',90,0),('6253d464-1433-11eb-92f2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','CJ_WebHooks','module',90,0),('625b5568-1433-11eb-a720-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','CJ_WebHooks','module',90,0),('6262c104-1433-11eb-991d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','CJ_WebHooks','module',90,0),('626b849c-1433-11eb-93ef-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','CJ_WebHooks','module',90,0),('6273fba4-1433-11eb-a98a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','CJ_WebHooks','module',90,0),('627b7b2c-1433-11eb-b9ff-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','CJ_WebHooks','module',90,0),('6282bbd0-1433-11eb-8f68-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','C_AdminConfig','module',1,0),('6287d336-1433-11eb-8a3d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','C_AdminConfig','module',89,0),('628f2df2-1433-11eb-aee8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','C_AdminConfig','module',90,0),('6295da30-1433-11eb-a854-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','C_AdminConfig','module',90,0),('629c4352-1433-11eb-9613-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','C_AdminConfig','module',90,0),('62a2a8b4-1433-11eb-b56a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','C_AdminConfig','module',90,0),('62a8011a-1433-11eb-ad42-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','C_AdminConfig','module',90,0),('62af9a2e-1433-11eb-8779-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','C_AdminConfig','module',90,0),('62b61bd8-1433-11eb-82f0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','C_AdminConfig','module',90,0),('62bd2cfc-1433-11eb-ac17-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','C_SMS','module',1,0),('62c3f0e6-1433-11eb-8182-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','C_SMS','module',89,0),('62cc7d60-1433-11eb-99c3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','C_SMS','module',90,0),('62d3b396-1433-11eb-a04a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','C_SMS','module',90,0),('62d98960-1433-11eb-b358-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','C_SMS','module',90,0),('62e05a74-1433-11eb-a6ad-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','C_SMS','module',90,0),('62e66f04-1433-11eb-831f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','C_SMS','module',90,0),('62ef8648-1433-11eb-9a8f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','C_SMS','module',90,0),('62f642ee-1433-11eb-96dc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','C_SMS','module',90,0),('62fd480a-1433-11eb-b24f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','C_Comments','module',1,0),('630401f4-1433-11eb-93d1-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','C_Comments','module',89,0),('63096fa4-1433-11eb-b3a8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','C_Comments','module',90,0),('630f3b14-1433-11eb-aba6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','C_Comments','module',90,0),('63146ac6-1433-11eb-ab84-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','C_Comments','module',90,0),('631a7ab0-1433-11eb-b507-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','C_Comments','module',90,0),('63209558-1433-11eb-8538-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','C_Comments','module',90,0),('6327ac76-1433-11eb-bd43-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','C_Comments','module',90,0),('632f0372-1433-11eb-8bda-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','C_Comments','module',90,0),('633702c0-1433-11eb-80ab-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','B_Invoices','module',1,0),('633d6d54-1433-11eb-9463-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','B_Invoices','module',89,0),('63446104-1433-11eb-9181-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','B_Invoices','module',90,0),('634b6a3a-1433-11eb-9dcc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','B_Invoices','module',90,0),('6350fa4a-1433-11eb-9c9f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','B_Invoices','module',90,0),('6359c5f8-1433-11eb-a913-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','B_Invoices','module',90,0),('635ef988-1433-11eb-b7c4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','B_Invoices','module',90,0),('63651bc4-1433-11eb-86e8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','B_Invoices','module',90,0),('636b3144-1433-11eb-84cf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','B_Invoices','module',90,0),('63718c6a-1433-11eb-8733-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','RT_DotbBoards','module',1,0),('6378be40-1433-11eb-8a5a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','RT_DotbBoards','module',89,0),('6381c5d0-1433-11eb-8061-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','RT_DotbBoards','module',90,0),('6388d5aa-1433-11eb-b54e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','RT_DotbBoards','module',90,0),('63905410-1433-11eb-bd9d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','RT_DotbBoards','module',90,0),('6399bd34-1433-11eb-8a3d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','RT_DotbBoards','module',90,0),('63a65ba2-1433-11eb-9bbe-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','RT_DotbBoards','module',90,0),('63b01e1c-1433-11eb-8578-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','RT_DotbBoards','module',90,0),('63b9d4a2-1433-11eb-8a86-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','RT_DotbBoards','module',90,0),('63c392c6-1433-11eb-8b0c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','C_SiteDeployment','module',1,0),('63cb575e-1433-11eb-b80e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','C_SiteDeployment','module',89,0),('63d44d46-1433-11eb-b596-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','C_SiteDeployment','module',90,0),('63db2fee-1433-11eb-af79-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','C_SiteDeployment','module',90,0),('63e44458-1433-11eb-8acd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','C_SiteDeployment','module',90,0),('63ed6fce-1433-11eb-b182-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','C_SiteDeployment','module',90,0),('63f7e74c-1433-11eb-b37d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','C_SiteDeployment','module',90,0),('6400b2fa-1433-11eb-a896-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','C_SiteDeployment','module',90,0),('64099fd2-1433-11eb-9368-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','C_SiteDeployment','module',90,0),('64126996-1433-11eb-9075-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','C_ParentAppLicense','module',1,0),('641a4c4c-1433-11eb-b25c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','C_ParentAppLicense','module',89,0),('642f1672-1433-11eb-bc87-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','C_ParentAppLicense','module',90,0),('6437f878-1433-11eb-b7ba-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','C_ParentAppLicense','module',90,0),('643f2454-1433-11eb-927a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','C_ParentAppLicense','module',90,0),('644641f8-1433-11eb-9343-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','C_ParentAppLicense','module',90,0),('644d93b8-1433-11eb-a42d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','C_ParentAppLicense','module',90,0),('64546576-1433-11eb-b746-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','C_ParentAppLicense','module',90,0),('645af80a-1433-11eb-b5f0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','C_ParentAppLicense','module',90,0),('6461a358-1433-11eb-a866-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_submission_data','module',1,0),('6467fadc-1433-11eb-879f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_submission_data','module',89,0),('646df22a-1433-11eb-bffd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_submission_data','module',90,0),('6474161e-1433-11eb-835d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_submission_data','module',90,0),('647a2932-1433-11eb-b540-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_submission_data','module',90,0),('64809682-1433-11eb-8c0a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_submission_data','module',90,0),('6486f3f6-1433-11eb-969c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_submission_data','module',90,0),('648d47a6-1433-11eb-9a41-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_submission_data','module',90,0),('64947774-1433-11eb-87ea-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_submission_data','module',90,0),('649c882e-1433-11eb-80a7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_submission','module',1,0),('64a4ffc2-1433-11eb-a60d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_submission','module',89,0),('64ae9992-1433-11eb-9def-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_submission','module',90,0),('64b8776e-1433-11eb-8be0-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_submission','module',90,0),('64c038f0-1433-11eb-a58c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_submission','module',90,0),('64c86610-1433-11eb-8062-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_submission','module',90,0),('64d11ba2-1433-11eb-9a9d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_submission','module',90,0),('64d77498-1433-11eb-a222-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_submission','module',90,0),('64dfc972-1433-11eb-9684-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_submission','module',90,0),('64e6bb2e-1433-11eb-9f3b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_template','module',1,0),('64eef622-1433-11eb-b5a6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_template','module',89,0),('64f7b3d4-1433-11eb-94e5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_template','module',90,0),('650057be-1433-11eb-a3da-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_template','module',90,0),('650829c6-1433-11eb-9f75-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_template','module',90,0),('651129c2-1433-11eb-9cd8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_template','module',90,0),('651828da-1433-11eb-a7ba-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_template','module',90,0),('651efa98-1433-11eb-ba9c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_template','module',90,0),('65266a80-1433-11eb-8650-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_template','module',90,0),('652eb0d2-1433-11eb-93ad-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey','module',1,0),('6533a376-1433-11eb-965d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey','module',89,0),('653af9b4-1433-11eb-9bb7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey','module',90,0),('65429fb6-1433-11eb-8beb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey','module',90,0),('654a823a-1433-11eb-913c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey','module',90,0),('654fdffa-1433-11eb-90d3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey','module',90,0),('6557f4c4-1433-11eb-99d7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey','module',90,0),('6560e1d8-1433-11eb-b28c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey','module',90,0),('656759fa-1433-11eb-a9ee-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey','module',90,0),('656e1fec-1433-11eb-a1a1-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_questions','module',1,0),('65758610-1433-11eb-97e5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_questions','module',89,0),('657d1e02-1433-11eb-8700-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_questions','module',90,0),('65848a2a-1433-11eb-ae9c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_questions','module',90,0),('658b1c28-1433-11eb-88b2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_questions','module',90,0),('65916164-1433-11eb-adff-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_questions','module',90,0),('65968a2c-1433-11eb-85b2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_questions','module',90,0),('659c9610-1433-11eb-bb1c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_questions','module',90,0),('65a54a4e-1433-11eb-ba2a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_questions','module',90,0),('65ab0c4a-1433-11eb-9571-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_pages','module',1,0),('65b1a654-1433-11eb-a57c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_pages','module',89,0),('65b7f400-1433-11eb-8f86-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_pages','module',90,0),('65be9ddc-1433-11eb-acbf-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_pages','module',90,0),('65c55e60-1433-11eb-9a46-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_pages','module',90,0),('65cc5454-1433-11eb-af5b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_pages','module',90,0),('65d2e904-1433-11eb-a2c8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_pages','module',90,0),('65d963d8-1433-11eb-b013-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_pages','module',90,0),('65e02484-1433-11eb-9ffe-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_pages','module',90,0),('65e5b9e4-1433-11eb-ba8a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_answers','module',1,0),('65eb7bc2-1433-11eb-be2c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_answers','module',89,0),('65f2b0e0-1433-11eb-a12f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_answers','module',90,0),('65f9063e-1433-11eb-bb0c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_answers','module',90,0),('65fd73a4-1433-11eb-96d5-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_answers','module',90,0),('66036818-1433-11eb-883d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_answers','module',90,0),('66085166-1433-11eb-98b4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_answers','module',90,0),('660dd7b2-1433-11eb-83fa-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_answers','module',90,0),('6614cf04-1433-11eb-8758-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_answers','module',90,0),('661b13fa-1433-11eb-8b2d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_automizer','module',1,0),('66228392-1433-11eb-92fc-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_automizer','module',89,0),('66292dbe-1433-11eb-a63c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_automizer','module',90,0),('662df0a6-1433-11eb-8e0d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_automizer','module',90,0),('66337ef4-1433-11eb-848e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_automizer','module',90,0),('66380294-1433-11eb-ac2f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_automizer','module',90,0),('663e2200-1433-11eb-8a38-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_automizer','module',90,0),('6643023e-1433-11eb-99d7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_automizer','module',90,0),('664846e0-1433-11eb-8963-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_automizer','module',90,0),('664e0c9c-1433-11eb-8aeb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_automizer_condition','module',1,0),('665314d0-1433-11eb-95f9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_automizer_condition','module',89,0),('6658413a-1433-11eb-8b50-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_automizer_condition','module',90,0),('665ce83e-1433-11eb-ad88-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_automizer_condition','module',90,0),('6667aaf8-1433-11eb-8a89-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_automizer_condition','module',90,0),('6671312c-1433-11eb-8056-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_automizer_condition','module',90,0),('667797c4-1433-11eb-81ad-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_automizer_condition','module',90,0),('668017dc-1433-11eb-85e3-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_automizer_condition','module',90,0),('6688a064-1433-11eb-9074-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_automizer_condition','module',90,0),('669064ac-1433-11eb-b4d6-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_automizer_actions','module',1,0),('669a03fe-1433-11eb-89c4-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_automizer_actions','module',89,0),('669ed94c-1433-11eb-a0da-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_automizer_actions','module',90,0),('66b4b348-1433-11eb-9b7b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_automizer_actions','module',90,0),('66bdefe4-1433-11eb-9aa1-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_automizer_actions','module',90,0),('66c58dc6-1433-11eb-819b-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_automizer_actions','module',90,0),('66cbfd5a-1433-11eb-ba90-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_automizer_actions','module',90,0),('66d5ab66-1433-11eb-83dd-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_automizer_actions','module',90,0),('66e1c72a-1433-11eb-8f55-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_automizer_actions','module',90,0),('66ea9af8-1433-11eb-921e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_language','module',1,0),('66f0f812-1433-11eb-96ae-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_language','module',89,0),('66f91c68-1433-11eb-9c92-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_language','module',90,0),('67032b4a-1433-11eb-bb04-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_language','module',90,0),('670ebd8e-1433-11eb-9900-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_language','module',90,0),('6718db2a-1433-11eb-a6d8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_language','module',90,0),('671f24f8-1433-11eb-841d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_language','module',90,0),('672933da-1433-11eb-b7af-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_language','module',90,0),('67323390-1433-11eb-8144-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_language','module',90,0),('673bcea0-1433-11eb-b318-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_submit_question','module',1,0),('67420aa4-1433-11eb-9600-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_submit_question','module',89,0),('67478fd8-1433-11eb-8bcb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_submit_question','module',90,0),('67502af8-1433-11eb-a84c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_submit_question','module',90,0),('6756a2fc-1433-11eb-b7e7-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_submit_question','module',90,0),('675e147e-1433-11eb-8717-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_submit_question','module',90,0),('6767c1b8-1433-11eb-8166-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_submit_question','module',90,0),('676e776a-1433-11eb-98f2-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_submit_question','module',90,0),('67766b64-1433-11eb-b4ef-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_submit_question','module',90,0),('677e3222-1433-11eb-8f3f-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','bc_survey_sms_template','module',1,0),('67868b0c-1433-11eb-bca9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','bc_survey_sms_template','module',89,0),('6792363c-1433-11eb-9a86-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','bc_survey_sms_template','module',90,0),('679ca112-1433-11eb-8bb8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','bc_survey_sms_template','module',90,0),('67a25210-1433-11eb-a94d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','bc_survey_sms_template','module',90,0),('67a94d04-1433-11eb-8c45-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','bc_survey_sms_template','module',90,0),('67af3660-1433-11eb-8fd8-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','bc_survey_sms_template','module',90,0),('67bb8780-1433-11eb-8809-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','bc_survey_sms_template','module',90,0),('67c7c4be-1433-11eb-baeb-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','bc_survey_sms_template','module',90,0),('67d05c14-1433-11eb-be12-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','admin','C_CRMLicense','module',1,0),('67d912be-1433-11eb-8598-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','access','C_CRMLicense','module',89,0),('67e0173a-1433-11eb-acd9-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','view','C_CRMLicense','module',90,0),('67eb9646-1433-11eb-a41c-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','list','C_CRMLicense','module',90,0),('67f83248-1433-11eb-893e-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','edit','C_CRMLicense','module',90,0),('67ff2c60-1433-11eb-ae78-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','delete','C_CRMLicense','module',90,0),('68070bba-1433-11eb-be78-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','import','C_CRMLicense','module',90,0),('680dea52-1433-11eb-b59d-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','export','C_CRMLicense','module',90,0),('68192106-1433-11eb-b45a-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','massupdate','C_CRMLicense','module',90,0);
/*!40000 ALTER TABLE `acl_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_fields`
--

DROP TABLE IF EXISTS `acl_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_fields` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `aclaccess` int(3) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `role_id` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aclfield_role_del` (`role_id`,`category`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_fields`
--

LOCK TABLES `acl_fields` WRITE;
/*!40000 ALTER TABLE `acl_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_role_sets`
--

DROP TABLE IF EXISTS `acl_role_sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_role_sets` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_acl_role_sets_hash` (`hash`),
  KEY `idx_acl_role_sets_date_modfied` (`date_modified`),
  KEY `idx_acl_role_sets_id_del` (`id`,`deleted`),
  KEY `idx_acl_role_sets_date_entered` (`date_entered`),
  KEY `idx_acl_role_sets_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_role_sets`
--

LOCK TABLES `acl_role_sets` WRITE;
/*!40000 ALTER TABLE `acl_role_sets` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_role_sets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_role_sets_acl_roles`
--

DROP TABLE IF EXISTS `acl_role_sets_acl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_role_sets_acl_roles` (
  `id` char(36) NOT NULL,
  `acl_role_set_id` char(36) DEFAULT NULL,
  `acl_role_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_rsr_set_id` (`acl_role_set_id`,`acl_role_id`),
  KEY `idx_rsr_role_id` (`acl_role_id`),
  KEY `idx_rsr_acl_role_set_id` (`acl_role_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_role_sets_acl_roles`
--

LOCK TABLES `acl_role_sets_acl_roles` WRITE;
/*!40000 ALTER TABLE `acl_role_sets_acl_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_role_sets_acl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_roles`
--

DROP TABLE IF EXISTS `acl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_roles` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_aclrole_id_del` (`id`,`deleted`),
  KEY `idx_aclrole_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_roles`
--

LOCK TABLES `acl_roles` WRITE;
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` VALUES ('6825a5ac-1433-11eb-8658-00ace43f6d74','2020-10-22 06:53:33','2020-10-22 06:53:33','1','1','Tracker','Tracker Role',0);
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_roles_actions`
--

DROP TABLE IF EXISTS `acl_roles_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_roles_actions` (
  `id` char(36) NOT NULL,
  `role_id` char(36) DEFAULT NULL,
  `action_id` char(36) DEFAULT NULL,
  `access_override` int(3) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_acl_role_id` (`role_id`),
  KEY `idx_acl_action_id` (`action_id`),
  KEY `idx_del_override` (`role_id`,`deleted`,`action_id`,`access_override`),
  KEY `idx_aclrole_action` (`role_id`,`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_roles_actions`
--

LOCK TABLES `acl_roles_actions` WRITE;
/*!40000 ALTER TABLE `acl_roles_actions` DISABLE KEYS */;
INSERT INTO `acl_roles_actions` VALUES ('682ad720-1433-11eb-becf-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b0e72f4-1433-11eb-ba9f-00ace43f6d74',1,'2020-10-22 06:53:33',0),('682cc2e2-1433-11eb-a741-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b139ab8-1433-11eb-bfbf-00ace43f6d74',89,'2020-10-22 06:53:33',0),('682e7d9e-1433-11eb-8128-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b19147a-1433-11eb-980f-00ace43f6d74',90,'2020-10-22 06:53:33',0),('68302edc-1433-11eb-a44b-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b1e1786-1433-11eb-bf61-00ace43f6d74',90,'2020-10-22 06:53:33',0),('6831d34a-1433-11eb-8d3b-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b22b5a2-1433-11eb-80cf-00ace43f6d74',90,'2020-10-22 06:53:33',0),('683369da-1433-11eb-9844-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b28d6a8-1433-11eb-86a5-00ace43f6d74',90,'2020-10-22 06:53:33',0),('683490f8-1433-11eb-bdcb-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b2f75bc-1433-11eb-bddd-00ace43f6d74',90,'2020-10-22 06:53:33',0),('6835a06a-1433-11eb-ba74-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b369e64-1433-11eb-a843-00ace43f6d74',90,'2020-10-22 06:53:33',0),('6836b356-1433-11eb-9f59-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5ba49856-1433-11eb-b243-00ace43f6d74',1,'2020-10-22 06:53:33',0),('6838139a-1433-11eb-883f-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5ba8fb4e-1433-11eb-af67-00ace43f6d74',89,'2020-10-22 06:53:33',0),('683984d2-1433-11eb-8515-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5badbb84-1433-11eb-902e-00ace43f6d74',90,'2020-10-22 06:53:33',0),('683ac9e6-1433-11eb-9e88-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5bb33f64-1433-11eb-a8aa-00ace43f6d74',90,'2020-10-22 06:53:33',0),('683c8fba-1433-11eb-9541-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5bb81f3e-1433-11eb-b768-00ace43f6d74',90,'2020-10-22 06:53:33',0),('683dbf3e-1433-11eb-bcc5-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5bbe38ba-1433-11eb-b74c-00ace43f6d74',90,'2020-10-22 06:53:33',0),('683f397c-1433-11eb-947f-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5bcda944-1433-11eb-919c-00ace43f6d74',90,'2020-10-22 06:53:33',0),('6841011c-1433-11eb-9f4e-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5bd1d262-1433-11eb-a0ad-00ace43f6d74',90,'2020-10-22 06:53:33',0),('6842d302-1433-11eb-bb5b-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b76630a-1433-11eb-a2ea-00ace43f6d74',1,'2020-10-22 06:53:33',0),('6844fcb8-1433-11eb-9463-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b7b70fc-1433-11eb-870a-00ace43f6d74',89,'2020-10-22 06:53:33',0),('68472326-1433-11eb-ba01-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b801058-1433-11eb-9f22-00ace43f6d74',90,'2020-10-22 06:53:33',0),('684919a6-1433-11eb-aa1b-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b8575de-1433-11eb-8d52-00ace43f6d74',90,'2020-10-22 06:53:33',0),('684b356a-1433-11eb-a2c0-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b8a8a7e-1433-11eb-aab2-00ace43f6d74',90,'2020-10-22 06:53:33',0),('684d285c-1433-11eb-82d5-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b8fca34-1433-11eb-b52f-00ace43f6d74',90,'2020-10-22 06:53:33',0),('684f350c-1433-11eb-bdff-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b945afe-1433-11eb-95c3-00ace43f6d74',90,'2020-10-22 06:53:33',0),('68511124-1433-11eb-9065-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b99ce4e-1433-11eb-8fbc-00ace43f6d74',90,'2020-10-22 06:53:33',0),('6852e2b0-1433-11eb-9091-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b425d12-1433-11eb-854f-00ace43f6d74',1,'2020-10-22 06:53:33',0),('6854c710-1433-11eb-8a35-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b477e8c-1433-11eb-972c-00ace43f6d74',89,'2020-10-22 06:53:33',0),('68568370-1433-11eb-b5aa-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b4cf0b0-1433-11eb-a949-00ace43f6d74',90,'2020-10-22 06:53:33',0),('68586f00-1433-11eb-bd9d-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b52a4ba-1433-11eb-a77f-00ace43f6d74',90,'2020-10-22 06:53:33',0),('685a507c-1433-11eb-829e-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b588db2-1433-11eb-86c4-00ace43f6d74',90,'2020-10-22 06:53:33',0),('685bff08-1433-11eb-89d7-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b5dfe96-1433-11eb-9e3c-00ace43f6d74',90,'2020-10-22 06:53:33',0),('685cf6d8-1433-11eb-840f-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b63ed38-1433-11eb-af15-00ace43f6d74',90,'2020-10-22 06:53:33',0),('685eb518-1433-11eb-8cbf-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','5b6aaf60-1433-11eb-bc90-00ace43f6d74',90,'2020-10-22 06:53:33',0);
/*!40000 ALTER TABLE `acl_roles_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_roles_users`
--

DROP TABLE IF EXISTS `acl_roles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_roles_users` (
  `id` char(36) NOT NULL,
  `role_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_aclrole_id` (`role_id`),
  KEY `idx_acluser_id` (`user_id`),
  KEY `idx_aclrole_user` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_roles_users`
--

LOCK TABLES `acl_roles_users` WRITE;
/*!40000 ALTER TABLE `acl_roles_users` DISABLE KEYS */;
INSERT INTO `acl_roles_users` VALUES ('6828bda0-1433-11eb-9584-00ace43f6d74','6825a5ac-1433-11eb-8658-00ace43f6d74','1','2020-10-22 06:53:33',0);
/*!40000 ALTER TABLE `acl_roles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `parent_id` char(36) DEFAULT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `activity_type` varchar(100) DEFAULT NULL,
  `data` longtext,
  `comment_count` int(11) DEFAULT '0',
  `last_comment` longtext,
  PRIMARY KEY (`id`),
  KEY `idx_activities_date_modfied` (`date_modified`),
  KEY `idx_activities_id_del` (`id`,`deleted`),
  KEY `idx_activities_date_entered` (`date_entered`),
  KEY `activity_records` (`parent_type`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities_users`
--

DROP TABLE IF EXISTS `activities_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities_users` (
  `id` char(36) NOT NULL,
  `activity_id` char(36) NOT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `fields` longtext,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `activities_records` (`parent_type`,`parent_id`),
  KEY `activities_users_parent` (`activity_id`,`parent_id`,`parent_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities_users`
--

LOCK TABLES `activities_users` WRITE;
/*!40000 ALTER TABLE `activities_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_book`
--

DROP TABLE IF EXISTS `address_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_book` (
  `assigned_user_id` char(36) NOT NULL,
  `bean` varchar(50) DEFAULT NULL,
  `bean_id` char(36) NOT NULL,
  PRIMARY KEY (`assigned_user_id`,`bean_id`),
  KEY `ab_user_bean_idx` (`assigned_user_id`,`bean`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_book`
--

LOCK TABLES `address_book` WRITE;
/*!40000 ALTER TABLE `address_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_book_list_items`
--

DROP TABLE IF EXISTS `address_book_list_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_book_list_items` (
  `list_id` char(36) NOT NULL,
  `bean_id` char(36) NOT NULL,
  PRIMARY KEY (`list_id`,`bean_id`),
  KEY `abli_list_id_idx` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_book_list_items`
--

LOCK TABLES `address_book_list_items` WRITE;
/*!40000 ALTER TABLE `address_book_list_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book_list_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_book_lists`
--

DROP TABLE IF EXISTS `address_book_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_book_lists` (
  `id` char(36) NOT NULL,
  `assigned_user_id` char(36) NOT NULL,
  `list_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abml_user_bean_idx` (`assigned_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_book_lists`
--

LOCK TABLES `address_book_lists` WRITE;
/*!40000 ALTER TABLE `address_book_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_events`
--

DROP TABLE IF EXISTS `audit_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_events` (
  `id` char(36) NOT NULL,
  `type` char(10) DEFAULT NULL,
  `parent_id` char(36) NOT NULL,
  `module_name` varchar(100) DEFAULT NULL,
  `source` text,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aud_eve_ptd` (`parent_id`,`type`,`date_created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_events`
--

LOCK TABLES `audit_events` WRITE;
/*!40000 ALTER TABLE `audit_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_invoices`
--

DROP TABLE IF EXISTS `b_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_invoices` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `inv_sent` tinyint(1) DEFAULT '0',
  `invoice_type` varchar(100) DEFAULT 'Active',
  `invoice_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `po_number` varchar(100) DEFAULT '',
  `status` varchar(100) DEFAULT 'Active',
  `sub_total` decimal(18,2) DEFAULT NULL,
  `total` decimal(18,2) DEFAULT NULL,
  `total_tax` decimal(18,2) DEFAULT NULL,
  `total_paid` decimal(18,2) DEFAULT NULL,
  `balance_due` decimal(18,2) DEFAULT NULL,
  `ehd_id` varchar(150) DEFAULT '',
  `ehd_url` varchar(255) DEFAULT 'http://ehd.smartvas.vn/HDDT/{ehd_id}',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_b_invoices_date_modfied` (`date_modified`),
  KEY `idx_b_invoices_id_del` (`id`,`deleted`),
  KEY `idx_b_invoices_date_entered` (`date_entered`),
  KEY `idx_b_invoices_name_del` (`name`,`deleted`),
  KEY `idx_b_invoices_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_b_invoices_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_b_invoices_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_invoices`
--

LOCK TABLES `b_invoices` WRITE;
/*!40000 ALTER TABLE `b_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `b_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_invoices_audit`
--

DROP TABLE IF EXISTS `b_invoices_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_invoices_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_b_invoices_audit_parent_id` (`parent_id`),
  KEY `idx_b_invoices_audit_event_id` (`event_id`),
  KEY `idx_b_invoices_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_b_invoices_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_invoices_audit`
--

LOCK TABLES `b_invoices_audit` WRITE;
/*!40000 ALTER TABLE `b_invoices_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `b_invoices_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_automizer_actions`
--

DROP TABLE IF EXISTS `bc_automizer_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_automizer_actions` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `recipient_type` varchar(255) DEFAULT NULL,
  `recipient_module` varchar(255) DEFAULT NULL,
  `filter_by` varchar(255) DEFAULT NULL,
  `recipient_field` text,
  `recipient_operator` varchar(255) DEFAULT NULL,
  `compare_value` text,
  `recipient_email_field` varchar(255) DEFAULT NULL,
  `survey_id` char(36) DEFAULT NULL,
  `email_template_id` char(36) DEFAULT NULL,
  `action_order` int(255) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_automizer_actions_date_modfied` (`date_modified`),
  KEY `idx_bc_automizer_actions_id_del` (`id`,`deleted`),
  KEY `idx_bc_automizer_actions_date_entered` (`date_entered`),
  KEY `idx_bc_automizer_actions_name_del` (`name`,`deleted`),
  KEY `idx_bc_automizer_actions_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_automizer_actions_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_automizer_actions_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_automizer_actions`
--

LOCK TABLES `bc_automizer_actions` WRITE;
/*!40000 ALTER TABLE `bc_automizer_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_automizer_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_automizer_actions_audit`
--

DROP TABLE IF EXISTS `bc_automizer_actions_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_automizer_actions_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_automizer_actions_audit_parent_id` (`parent_id`),
  KEY `idx_bc_automizer_actions_audit_event_id` (`event_id`),
  KEY `idx_bc_automizer_actions_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_automizer_actions_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_automizer_actions_audit`
--

LOCK TABLES `bc_automizer_actions_audit` WRITE;
/*!40000 ALTER TABLE `bc_automizer_actions_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_automizer_actions_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_automizer_condition`
--

DROP TABLE IF EXISTS `bc_automizer_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_automizer_condition` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `condition_module` varchar(255) DEFAULT NULL,
  `filter_by` varchar(255) DEFAULT 'any_related',
  `condition_field` varchar(255) DEFAULT NULL,
  `condition_operator` varchar(255) DEFAULT NULL,
  `value_type` varchar(255) DEFAULT NULL,
  `compare_value` text,
  `condition_order` int(255) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_automizer_condition_date_modfied` (`date_modified`),
  KEY `idx_bc_automizer_condition_id_del` (`id`,`deleted`),
  KEY `idx_bc_automizer_condition_date_entered` (`date_entered`),
  KEY `idx_bc_automizer_condition_name_del` (`name`,`deleted`),
  KEY `idx_bc_automizer_condition_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_automizer_condition_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_automizer_condition_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_automizer_condition`
--

LOCK TABLES `bc_automizer_condition` WRITE;
/*!40000 ALTER TABLE `bc_automizer_condition` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_automizer_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_automizer_condition_audit`
--

DROP TABLE IF EXISTS `bc_automizer_condition_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_automizer_condition_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_automizer_condition_audit_parent_id` (`parent_id`),
  KEY `idx_bc_automizer_condition_audit_event_id` (`event_id`),
  KEY `idx_bc_automizer_condition_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_automizer_condition_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_automizer_condition_audit`
--

LOCK TABLES `bc_automizer_condition_audit` WRITE;
/*!40000 ALTER TABLE `bc_automizer_condition_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_automizer_condition_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_automizer_condition_bc_survey_automizer_c`
--

DROP TABLE IF EXISTS `bc_automizer_condition_bc_survey_automizer_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_automizer_condition_bc_survey_automizer_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_automizc5cctomizer_ida` varchar(36) DEFAULT NULL,
  `bc_automizbd1dndition_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_automizer_condition_bc_survey_automizer_ida1` (`bc_automizc5cctomizer_ida`),
  KEY `bc_automizer_condition_bc_survey_automizer_alt` (`bc_automizbd1dndition_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_automizer_condition_bc_survey_automizer_c`
--

LOCK TABLES `bc_automizer_condition_bc_survey_automizer_c` WRITE;
/*!40000 ALTER TABLE `bc_automizer_condition_bc_survey_automizer_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_automizer_condition_bc_survey_automizer_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_submission_data`
--

DROP TABLE IF EXISTS `bc_submission_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_submission_data` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_submission_data_date_modfied` (`date_modified`),
  KEY `idx_bc_submission_data_id_del` (`id`,`deleted`),
  KEY `idx_bc_submission_data_date_entered` (`date_entered`),
  KEY `idx_bc_submission_data_name_del` (`name`,`deleted`),
  KEY `idx_bc_submission_data_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_submission_data_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_submission_data_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_submission_data`
--

LOCK TABLES `bc_submission_data` WRITE;
/*!40000 ALTER TABLE `bc_submission_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_submission_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_submission_data_audit`
--

DROP TABLE IF EXISTS `bc_submission_data_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_submission_data_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_submission_data_audit_parent_id` (`parent_id`),
  KEY `idx_bc_submission_data_audit_event_id` (`event_id`),
  KEY `idx_bc_submission_data_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_submission_data_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_submission_data_audit`
--

LOCK TABLES `bc_submission_data_audit` WRITE;
/*!40000 ALTER TABLE `bc_submission_data_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_submission_data_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_submission_data_bc_survey_answers_c`
--

DROP TABLE IF EXISTS `bc_submission_data_bc_survey_answers_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_submission_data_bc_survey_answers_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_submission_data_bc_survey_answersbc_survey_answers_ida` varchar(36) DEFAULT NULL,
  `bc_submission_data_bc_survey_answersbc_submission_data_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_submission_data_bc_survey_answers_ida1` (`bc_submission_data_bc_survey_answersbc_survey_answers_ida`),
  KEY `bc_submission_data_bc_survey_answers_alt` (`bc_submission_data_bc_survey_answersbc_submission_data_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_submission_data_bc_survey_answers_c`
--

LOCK TABLES `bc_submission_data_bc_survey_answers_c` WRITE;
/*!40000 ALTER TABLE `bc_submission_data_bc_survey_answers_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_submission_data_bc_survey_answers_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_submission_data_bc_survey_questions_c`
--

DROP TABLE IF EXISTS `bc_submission_data_bc_survey_questions_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_submission_data_bc_survey_questions_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_submission_data_bc_survey_questionsbc_survey_questions_ida` varchar(36) DEFAULT NULL,
  `bc_submission_data_bc_survey_questionsbc_submission_data_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_submission_data_bc_survey_questions_ida1` (`bc_submission_data_bc_survey_questionsbc_survey_questions_ida`),
  KEY `bc_submission_data_bc_survey_questions_alt` (`bc_submission_data_bc_survey_questionsbc_submission_data_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_submission_data_bc_survey_questions_c`
--

LOCK TABLES `bc_submission_data_bc_survey_questions_c` WRITE;
/*!40000 ALTER TABLE `bc_submission_data_bc_survey_questions_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_submission_data_bc_survey_questions_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_submission_data_bc_survey_submission_c`
--

DROP TABLE IF EXISTS `bc_submission_data_bc_survey_submission_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_submission_data_bc_survey_submission_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_submission_data_bc_survey_submissionbc_survey_submission_ida` varchar(36) DEFAULT NULL,
  `bc_submission_data_bc_survey_submissionbc_submission_data_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_submission_data_bc_survey_submission_ida1` (`bc_submission_data_bc_survey_submissionbc_survey_submission_ida`),
  KEY `bc_submission_data_bc_survey_submission_alt` (`bc_submission_data_bc_survey_submissionbc_submission_data_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_submission_data_bc_survey_submission_c`
--

LOCK TABLES `bc_submission_data_bc_survey_submission_c` WRITE;
/*!40000 ALTER TABLE `bc_submission_data_bc_survey_submission_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_submission_data_bc_survey_submission_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey`
--

DROP TABLE IF EXISTS `bc_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `email_template_subject` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `survey_logo` varchar(255) DEFAULT NULL,
  `survey_theme` varchar(100) DEFAULT 'theme0',
  `email_template` text,
  `surveypages` varchar(255) DEFAULT '1',
  `redirect_url` varchar(255) DEFAULT NULL,
  `allowed_resubmit_count` varchar(11) DEFAULT '0',
  `is_progress` tinyint(1) DEFAULT '1',
  `image` longblob,
  `base_score` int(11) DEFAULT NULL,
  `survey_welcome_page` text,
  `survey_thanks_page` text,
  `enable_review_mail` tinyint(1) DEFAULT '0',
  `review_mail_content` text,
  `default_survey_language` varchar(100) DEFAULT NULL,
  `supported_survey_language` text,
  `survey_type` varchar(255) DEFAULT 'survey',
  `allow_redundant_answers` tinyint(1) DEFAULT '0',
  `survey_submit_unique_id` varchar(255) DEFAULT NULL,
  `web_link_counter` int(11) DEFAULT '0',
  `enable_data_piping` tinyint(1) DEFAULT '0',
  `sync_module` varchar(100) DEFAULT NULL,
  `sync_type` varchar(100) DEFAULT NULL,
  `survey_send_status` varchar(255) DEFAULT 'inactive',
  `footer_content` text,
  `survey_status` varchar(255) DEFAULT 'Active',
  `survey_background_image` varchar(255) DEFAULT NULL,
  `background_image_lb` longblob,
  `recursive_email` tinyint(1) DEFAULT '0',
  `resend_count` int(2) DEFAULT '1',
  `resend_interval` varchar(100) DEFAULT NULL,
  `enable_individual_report` tinyint(1) DEFAULT '0',
  `enable_agreement` tinyint(1) DEFAULT '0',
  `is_required_agreement` tinyint(1) DEFAULT '0',
  `agreement_content` text,
  `form_seen` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_date_entered` (`date_entered`),
  KEY `idx_bc_survey_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey`
--

LOCK TABLES `bc_survey` WRITE;
/*!40000 ALTER TABLE `bc_survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_accounts_c`
--

DROP TABLE IF EXISTS `bc_survey_accounts_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_accounts_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_accountsbc_survey_ida` varchar(36) DEFAULT NULL,
  `bc_survey_accountsaccounts_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_accounts_alt` (`bc_survey_accountsbc_survey_ida`,`bc_survey_accountsaccounts_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_accounts_c`
--

LOCK TABLES `bc_survey_accounts_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_accounts_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_accounts_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_answers`
--

DROP TABLE IF EXISTS `bc_survey_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_answers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `answer_name` text,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `answer_sequence` int(11) DEFAULT NULL,
  `score_weight` int(11) DEFAULT NULL,
  `logic_target` text,
  `logic_action` varchar(255) DEFAULT NULL,
  `answer_type` varchar(255) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `radio_image` longblob,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_answers_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_answers_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_answers_date_entered` (`date_entered`),
  KEY `idx_bc_survey_answers_tmst_id` (`team_set_id`),
  KEY `idx_bc_survey_answers_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_answers`
--

LOCK TABLES `bc_survey_answers` WRITE;
/*!40000 ALTER TABLE `bc_survey_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_answers_audit`
--

DROP TABLE IF EXISTS `bc_survey_answers_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_answers_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_answers_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_answers_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_answers_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_answers_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_answers_audit`
--

LOCK TABLES `bc_survey_answers_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_answers_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_answers_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_answers_bc_survey_questions_c`
--

DROP TABLE IF EXISTS `bc_survey_answers_bc_survey_questions_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_answers_bc_survey_questions_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_answers_bc_survey_questionsbc_survey_questions_ida` varchar(36) DEFAULT NULL,
  `bc_survey_answers_bc_survey_questionsbc_survey_answers_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_answers_bc_survey_questions_ida1` (`bc_survey_answers_bc_survey_questionsbc_survey_questions_ida`),
  KEY `bc_survey_answers_bc_survey_questions_alt` (`bc_survey_answers_bc_survey_questionsbc_survey_answers_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_answers_bc_survey_questions_c`
--

LOCK TABLES `bc_survey_answers_bc_survey_questions_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_answers_bc_survey_questions_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_answers_bc_survey_questions_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_audit`
--

DROP TABLE IF EXISTS `bc_survey_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_audit`
--

LOCK TABLES `bc_survey_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_automizer`
--

DROP TABLE IF EXISTS `bc_survey_automizer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_automizer` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `execution_occurs` varchar(255) DEFAULT 'when_record_saved',
  `target_module` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `applied_to` varchar(255) DEFAULT 'new_and_updated_records',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_automizer_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_automizer_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_automizer_date_entered` (`date_entered`),
  KEY `idx_bc_survey_automizer_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_automizer_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_automizer_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_automizer_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_automizer`
--

LOCK TABLES `bc_survey_automizer` WRITE;
/*!40000 ALTER TABLE `bc_survey_automizer` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_automizer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_automizer_audit`
--

DROP TABLE IF EXISTS `bc_survey_automizer_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_automizer_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_automizer_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_automizer_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_automizer_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_automizer_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_automizer_audit`
--

LOCK TABLES `bc_survey_automizer_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_automizer_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_automizer_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_automizer_bc_automizer_actions_c`
--

DROP TABLE IF EXISTS `bc_survey_automizer_bc_automizer_actions_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_automizer_bc_automizer_actions_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_automizer_ida` varchar(36) DEFAULT NULL,
  `bc_survey_actions_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_automizer_bc_automizer_actions_ida1` (`bc_survey_automizer_ida`),
  KEY `bc_survey_automizer_bc_automizer_actions_alt` (`bc_survey_actions_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_automizer_bc_automizer_actions_c`
--

LOCK TABLES `bc_survey_automizer_bc_automizer_actions_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_automizer_bc_automizer_actions_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_automizer_bc_automizer_actions_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_bc_survey_questions_c`
--

DROP TABLE IF EXISTS `bc_survey_bc_survey_questions_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_bc_survey_questions_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_bc_survey_questionsbc_survey_ida` varchar(36) DEFAULT NULL,
  `bc_survey_bc_survey_questionsbc_survey_questions_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_bc_survey_questions_ida1` (`bc_survey_bc_survey_questionsbc_survey_ida`),
  KEY `bc_survey_bc_survey_questions_alt` (`bc_survey_bc_survey_questionsbc_survey_questions_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_bc_survey_questions_c`
--

LOCK TABLES `bc_survey_bc_survey_questions_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_bc_survey_questions_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_bc_survey_questions_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_bc_survey_template_c`
--

DROP TABLE IF EXISTS `bc_survey_bc_survey_template_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_bc_survey_template_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_bc_survey_templatebc_survey_template_ida` varchar(36) DEFAULT NULL,
  `bc_survey_bc_survey_templatebc_survey_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_bc_survey_template_ida1` (`bc_survey_bc_survey_templatebc_survey_template_ida`),
  KEY `bc_survey_bc_survey_template_alt` (`bc_survey_bc_survey_templatebc_survey_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_bc_survey_template_c`
--

LOCK TABLES `bc_survey_bc_survey_template_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_bc_survey_template_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_bc_survey_template_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_contacts_c`
--

DROP TABLE IF EXISTS `bc_survey_contacts_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_contacts_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_contactsbc_survey_ida` varchar(36) DEFAULT NULL,
  `bc_survey_contactscontacts_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_contacts_alt` (`bc_survey_contactsbc_survey_ida`,`bc_survey_contactscontacts_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_contacts_c`
--

LOCK TABLES `bc_survey_contacts_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_contacts_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_contacts_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_language`
--

DROP TABLE IF EXISTS `bc_survey_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_language` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `text_direction` varchar(100) DEFAULT 'left_to_right',
  `bc_survey_id_c` char(36) DEFAULT NULL,
  `survey_lang` varchar(255) DEFAULT '',
  `status` varchar(100) DEFAULT 'enabled',
  `translated` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_language_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_language_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_language_date_entered` (`date_entered`),
  KEY `idx_bc_survey_language_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_language_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_language_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_language_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_language`
--

LOCK TABLES `bc_survey_language` WRITE;
/*!40000 ALTER TABLE `bc_survey_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_language_audit`
--

DROP TABLE IF EXISTS `bc_survey_language_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_language_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_language_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_language_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_language_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_language_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_language_audit`
--

LOCK TABLES `bc_survey_language_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_language_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_language_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_leads_c`
--

DROP TABLE IF EXISTS `bc_survey_leads_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_leads_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_leadsbc_survey_ida` varchar(36) DEFAULT NULL,
  `bc_survey_leadsleads_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_leads_alt` (`bc_survey_leadsbc_survey_ida`,`bc_survey_leadsleads_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_leads_c`
--

LOCK TABLES `bc_survey_leads_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_leads_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_leads_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_pages`
--

DROP TABLE IF EXISTS `bc_survey_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_pages` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `type` varchar(100) DEFAULT NULL,
  `page_number` varchar(255) DEFAULT NULL,
  `page_sequence` int(11) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_pages_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_pages_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_pages_date_entered` (`date_entered`),
  KEY `idx_bc_survey_pages_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_pages_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_pages_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_pages_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_pages`
--

LOCK TABLES `bc_survey_pages` WRITE;
/*!40000 ALTER TABLE `bc_survey_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_pages_audit`
--

DROP TABLE IF EXISTS `bc_survey_pages_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_pages_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_pages_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_pages_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_pages_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_pages_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_pages_audit`
--

LOCK TABLES `bc_survey_pages_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_pages_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_pages_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_pages_bc_survey_c`
--

DROP TABLE IF EXISTS `bc_survey_pages_bc_survey_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_pages_bc_survey_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_pages_bc_surveybc_survey_ida` varchar(36) DEFAULT NULL,
  `bc_survey_pages_bc_surveybc_survey_pages_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_pages_bc_survey_ida1` (`bc_survey_pages_bc_surveybc_survey_ida`),
  KEY `bc_survey_pages_bc_survey_alt` (`bc_survey_pages_bc_surveybc_survey_pages_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_pages_bc_survey_c`
--

LOCK TABLES `bc_survey_pages_bc_survey_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_pages_bc_survey_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_pages_bc_survey_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_pages_bc_survey_questions_c`
--

DROP TABLE IF EXISTS `bc_survey_pages_bc_survey_questions_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_pages_bc_survey_questions_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_pages_bc_survey_questionsbc_survey_pages_ida` varchar(36) DEFAULT NULL,
  `bc_survey_pages_bc_survey_questionsbc_survey_questions_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_pages_bc_survey_questions_ida1` (`bc_survey_pages_bc_survey_questionsbc_survey_pages_ida`),
  KEY `bc_survey_pages_bc_survey_questions_alt` (`bc_survey_pages_bc_survey_questionsbc_survey_questions_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_pages_bc_survey_questions_c`
--

LOCK TABLES `bc_survey_pages_bc_survey_questions_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_pages_bc_survey_questions_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_pages_bc_survey_questions_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_pages_bc_survey_template_c`
--

DROP TABLE IF EXISTS `bc_survey_pages_bc_survey_template_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_pages_bc_survey_template_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_pages_bc_survey_templatebc_survey_template_ida` varchar(36) DEFAULT NULL,
  `bc_survey_pages_bc_survey_templatebc_survey_pages_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_pages_bc_survey_template_ida1` (`bc_survey_pages_bc_survey_templatebc_survey_template_ida`),
  KEY `bc_survey_pages_bc_survey_template_alt` (`bc_survey_pages_bc_survey_templatebc_survey_pages_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_pages_bc_survey_template_c`
--

LOCK TABLES `bc_survey_pages_bc_survey_template_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_pages_bc_survey_template_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_pages_bc_survey_template_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_prospects_c`
--

DROP TABLE IF EXISTS `bc_survey_prospects_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_prospects_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_prospectsbc_survey_ida` varchar(36) DEFAULT NULL,
  `bc_survey_prospectsprospects_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_prospects_alt` (`bc_survey_prospectsbc_survey_ida`,`bc_survey_prospectsprospects_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_prospects_c`
--

LOCK TABLES `bc_survey_prospects_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_prospects_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_prospects_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_questions`
--

DROP TABLE IF EXISTS `bc_survey_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_questions` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `is_required` tinyint(1) DEFAULT '0',
  `is_question_seperator` tinyint(1) DEFAULT '0',
  `question_type` varchar(100) DEFAULT 'Textbox',
  `question_help_comment` text,
  `display_boolean_label` varchar(100) DEFAULT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `question_sequence` int(11) DEFAULT NULL,
  `is_datetime` tinyint(1) DEFAULT '0',
  `is_sort` tinyint(1) DEFAULT '0',
  `min` varchar(100) DEFAULT '',
  `max` varchar(100) DEFAULT '',
  `precision_value` varchar(100) DEFAULT '',
  `maxsize` varchar(100) DEFAULT '',
  `scale_slot` varchar(100) DEFAULT '',
  `advance_type` varchar(1000) DEFAULT '',
  `matrix_row` longblob,
  `matrix_col` longblob,
  `enable_scoring` tinyint(1) DEFAULT '0',
  `base_weight` varchar(100) DEFAULT '',
  `is_skip_logic` tinyint(1) DEFAULT '0',
  `enable_otherOption` tinyint(1) DEFAULT '0',
  `limit_min` varchar(255) DEFAULT '',
  `sync_field` varchar(255) DEFAULT '',
  `disable_piping` tinyint(1) DEFAULT '0',
  `allow_future_dates` tinyint(1) DEFAULT '0',
  `richtextContent` text,
  `is_image_option` tinyint(1) DEFAULT '0',
  `show_option_text` tinyint(1) DEFAULT '0',
  `file_extension` varchar(1000) DEFAULT '',
  `file_size` varchar(100) DEFAULT '',
  `disabled_question` tinyint(1) DEFAULT '0',
  `piping_sequence` int(11) DEFAULT NULL,
  `qpiping_que_ids` varchar(255) DEFAULT '',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_questions_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_questions_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_questions_date_entered` (`date_entered`),
  KEY `idx_bc_survey_questions_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_questions_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_questions_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_questions_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_questions`
--

LOCK TABLES `bc_survey_questions` WRITE;
/*!40000 ALTER TABLE `bc_survey_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_questions_audit`
--

DROP TABLE IF EXISTS `bc_survey_questions_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_questions_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_questions_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_questions_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_questions_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_questions_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_questions_audit`
--

LOCK TABLES `bc_survey_questions_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_questions_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_questions_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_questions_bc_survey_submit_question_1_c`
--

DROP TABLE IF EXISTS `bc_survey_questions_bc_survey_submit_question_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_questions_bc_survey_submit_question_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_6a25estions_ida` char(36) DEFAULT NULL,
  `bc_survey_bb7auestion_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_questions_bc_survey_submit_question_1_ida1_deleted` (`bc_survey_6a25estions_ida`,`deleted`),
  KEY `idx_bc_survey_questions_bc_survey_submit_question_1_idb2_deleted` (`bc_survey_bb7auestion_idb`,`deleted`),
  KEY `bc_survey_questions_bc_survey_submit_question_1_alt` (`bc_survey_bb7auestion_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_questions_bc_survey_submit_question_1_c`
--

LOCK TABLES `bc_survey_questions_bc_survey_submit_question_1_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_questions_bc_survey_submit_question_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_questions_bc_survey_submit_question_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_sms_template`
--

DROP TABLE IF EXISTS `bc_survey_sms_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_sms_template` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `sms_content` text,
  `sms_sync_module_list` text,
  `sms_field_name` text,
  `sms_survey_linked` varchar(255) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_sms_template_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_sms_template_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_sms_template_date_entered` (`date_entered`),
  KEY `idx_bc_survey_sms_template_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_sms_template_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_sms_template_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_sms_template_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_sms_template`
--

LOCK TABLES `bc_survey_sms_template` WRITE;
/*!40000 ALTER TABLE `bc_survey_sms_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_sms_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_sms_template_audit`
--

DROP TABLE IF EXISTS `bc_survey_sms_template_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_sms_template_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_sms_template_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_sms_template_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_sms_template_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_sms_template_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_sms_template_audit`
--

LOCK TABLES `bc_survey_sms_template_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_sms_template_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_sms_template_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submission`
--

DROP TABLE IF EXISTS `bc_survey_submission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submission` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `last_send_on` datetime DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  `email_opened` tinyint(1) DEFAULT '0',
  `survey_send` tinyint(1) DEFAULT '0',
  `schedule_on` datetime DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Pending',
  `customer_name` varchar(255) DEFAULT NULL,
  `resubmit` tinyint(1) DEFAULT '0',
  `resubmit_counter` int(11) DEFAULT '0',
  `change_request` varchar(25) DEFAULT 'N/A',
  `resend` tinyint(1) DEFAULT '0',
  `resend_counter` int(11) DEFAULT '0',
  `submitted_by` varchar(255) DEFAULT '',
  `recipient_as` varchar(25) DEFAULT 'to',
  `mail_status` varchar(999) DEFAULT NULL,
  `base_score` int(11) DEFAULT '0',
  `obtained_score` int(11) DEFAULT '0',
  `score_percentage` int(11) DEFAULT '0',
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `target_parent_type` varchar(255) DEFAULT NULL,
  `target_parent_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `submission_type` varchar(255) DEFAULT NULL,
  `submission_ip_address` varchar(255) DEFAULT NULL,
  `submission_language` varchar(255) DEFAULT NULL,
  `new_record_id` varchar(255) DEFAULT NULL,
  `consent_accepted` tinyint(1) DEFAULT '0',
  `survey_trackdatetime` datetime DEFAULT NULL,
  `survey_trackdatetime_temp` datetime DEFAULT NULL,
  `email_survey_sumission_unique_id` varchar(255) DEFAULT NULL,
  `to_be_sms_send_field` text,
  `whatsapp_send_response_sid` text,
  `whatsapp_message_status` text,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_submission_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_submission_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_submission_date_entered` (`date_entered`),
  KEY `idx_bc_survey_submission_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_submission_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_submission_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_submission_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submission`
--

LOCK TABLES `bc_survey_submission` WRITE;
/*!40000 ALTER TABLE `bc_survey_submission` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submission_audit`
--

DROP TABLE IF EXISTS `bc_survey_submission_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submission_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_submission_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_submission_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_submission_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_submission_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submission_audit`
--

LOCK TABLES `bc_survey_submission_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_submission_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submission_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submission_bc_survey_c`
--

DROP TABLE IF EXISTS `bc_survey_submission_bc_survey_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submission_bc_survey_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_submission_bc_surveybc_survey_ida` varchar(36) DEFAULT NULL,
  `bc_survey_submission_bc_surveybc_survey_submission_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_submission_bc_survey_ida1` (`bc_survey_submission_bc_surveybc_survey_ida`),
  KEY `bc_survey_submission_bc_survey_alt` (`bc_survey_submission_bc_surveybc_survey_submission_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submission_bc_survey_c`
--

LOCK TABLES `bc_survey_submission_bc_survey_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_submission_bc_survey_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submission_bc_survey_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submission_documents_c`
--

DROP TABLE IF EXISTS `bc_survey_submission_documents_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submission_documents_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_submission_documentsbc_survey_submission_ida` char(36) DEFAULT NULL,
  `bc_survey_submission_documentsdocuments_idb` char(36) DEFAULT NULL,
  `document_revision_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_submission_documents_ida1_deleted` (`bc_survey_submission_documentsbc_survey_submission_ida`,`deleted`),
  KEY `idx_bc_survey_submission_documents_idb2_deleted` (`bc_survey_submission_documentsdocuments_idb`,`deleted`),
  KEY `bc_survey_submission_documents_alt` (`bc_survey_submission_documentsdocuments_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submission_documents_c`
--

LOCK TABLES `bc_survey_submission_documents_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_submission_documents_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submission_documents_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submit_question`
--

DROP TABLE IF EXISTS `bc_survey_submit_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submit_question` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `receiver_name` varchar(255) DEFAULT '',
  `survey_title` varchar(255) DEFAULT NULL,
  `question_type` varchar(255) DEFAULT '',
  `reciepient_module` varchar(255) DEFAULT '',
  `question_id` char(36) DEFAULT '',
  `submission_date` datetime DEFAULT NULL,
  `submission_type` varchar(255) DEFAULT NULL,
  `submission_ip_address` varchar(255) DEFAULT NULL,
  `schedule_on` datetime DEFAULT NULL,
  `submission_id` char(36) DEFAULT '',
  `survey_ID` char(36) DEFAULT '',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_submit_question_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_submit_question_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_submit_question_date_entered` (`date_entered`),
  KEY `idx_bc_survey_submit_question_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_submit_question_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_submit_question_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_submit_question_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submit_question`
--

LOCK TABLES `bc_survey_submit_question` WRITE;
/*!40000 ALTER TABLE `bc_survey_submit_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submit_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submit_question_audit`
--

DROP TABLE IF EXISTS `bc_survey_submit_question_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submit_question_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_submit_question_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_submit_question_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_submit_question_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_submit_question_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submit_question_audit`
--

LOCK TABLES `bc_survey_submit_question_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_submit_question_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submit_question_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submit_question_bc_survey_answers_c`
--

DROP TABLE IF EXISTS `bc_survey_submit_question_bc_survey_answers_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submit_question_bc_survey_answers_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_c9f6uestion_ida` char(36) DEFAULT NULL,
  `bc_survey_submit_question_bc_survey_answersbc_survey_answers_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_submit_question_bc_survey_answers_ida1_deleted` (`bc_survey_c9f6uestion_ida`,`deleted`),
  KEY `idx_bc_survey_submit_question_bc_survey_answers_idb2_deleted` (`bc_survey_submit_question_bc_survey_answersbc_survey_answers_idb`,`deleted`),
  KEY `bc_survey_submit_question_bc_survey_answers_alt` (`bc_survey_c9f6uestion_ida`,`bc_survey_submit_question_bc_survey_answersbc_survey_answers_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submit_question_bc_survey_answers_c`
--

LOCK TABLES `bc_survey_submit_question_bc_survey_answers_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_submit_question_bc_survey_answers_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submit_question_bc_survey_answers_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_submit_question_bc_survey_submission_c`
--

DROP TABLE IF EXISTS `bc_survey_submit_question_bc_survey_submission_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_submit_question_bc_survey_submission_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_9f7bmission_ida` char(36) DEFAULT NULL,
  `bc_survey_8829uestion_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_submit_question_bc_survey_submission_ida1_deleted` (`bc_survey_9f7bmission_ida`,`deleted`),
  KEY `idx_bc_survey_submit_question_bc_survey_submission_idb2_deleted` (`bc_survey_8829uestion_idb`,`deleted`),
  KEY `bc_survey_submit_question_bc_survey_submission_alt` (`bc_survey_8829uestion_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_submit_question_bc_survey_submission_c`
--

LOCK TABLES `bc_survey_submit_question_bc_survey_submission_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_submit_question_bc_survey_submission_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_submit_question_bc_survey_submission_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_template`
--

DROP TABLE IF EXISTS `bc_survey_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_template` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `surveypages` varchar(255) DEFAULT '1',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_template_date_modfied` (`date_modified`),
  KEY `idx_bc_survey_template_id_del` (`id`,`deleted`),
  KEY `idx_bc_survey_template_date_entered` (`date_entered`),
  KEY `idx_bc_survey_template_name_del` (`name`,`deleted`),
  KEY `idx_bc_survey_template_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bc_survey_template_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_bc_survey_template_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_template`
--

LOCK TABLES `bc_survey_template` WRITE;
/*!40000 ALTER TABLE `bc_survey_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_template_audit`
--

DROP TABLE IF EXISTS `bc_survey_template_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_template_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bc_survey_template_audit_parent_id` (`parent_id`),
  KEY `idx_bc_survey_template_audit_event_id` (`event_id`),
  KEY `idx_bc_survey_template_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bc_survey_template_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_template_audit`
--

LOCK TABLES `bc_survey_template_audit` WRITE;
/*!40000 ALTER TABLE `bc_survey_template_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_template_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_survey_template_bc_survey_questions_c`
--

DROP TABLE IF EXISTS `bc_survey_template_bc_survey_questions_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_survey_template_bc_survey_questions_c` (
  `id` varchar(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bc_survey_template_bc_survey_questionsbc_survey_template_ida` varchar(36) DEFAULT NULL,
  `bc_survey_template_bc_survey_questionsbc_survey_questions_idb` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bc_survey_template_bc_survey_questions_ida1` (`bc_survey_template_bc_survey_questionsbc_survey_template_ida`),
  KEY `bc_survey_template_bc_survey_questions_alt` (`bc_survey_template_bc_survey_questionsbc_survey_questions_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_survey_template_bc_survey_questions_c`
--

LOCK TABLES `bc_survey_template_bc_survey_questions_c` WRITE;
/*!40000 ALTER TABLE `bc_survey_template_bc_survey_questions_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `bc_survey_template_bc_survey_questions_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bugs`
--

DROP TABLE IF EXISTS `bugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bugs` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `bug_number` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `priority` varchar(100) DEFAULT NULL,
  `resolution` varchar(255) DEFAULT NULL,
  `work_log` text,
  `found_in_release` varchar(255) DEFAULT NULL,
  `fixed_in_release` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  `portal_viewable` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bugsnumk` (`bug_number`),
  KEY `idx_bugs_date_modfied` (`date_modified`),
  KEY `idx_bugs_id_del` (`id`,`deleted`),
  KEY `idx_bugs_date_entered` (`date_entered`),
  KEY `idx_bugs_name_del` (`name`,`deleted`),
  KEY `idx_bug_name` (`name`),
  KEY `idx_bugs_assigned_user` (`assigned_user_id`),
  KEY `idx_bugs_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_bugs_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_bugs_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bugs`
--

LOCK TABLES `bugs` WRITE;
/*!40000 ALTER TABLE `bugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bugs_audit`
--

DROP TABLE IF EXISTS `bugs_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bugs_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_bugs_audit_parent_id` (`parent_id`),
  KEY `idx_bugs_audit_event_id` (`event_id`),
  KEY `idx_bugs_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_bugs_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bugs_audit`
--

LOCK TABLES `bugs_audit` WRITE;
/*!40000 ALTER TABLE `bugs_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `bugs_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_adminconfig`
--

DROP TABLE IF EXISTS `c_adminconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_adminconfig` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_c_adminconfig_date_modfied` (`date_modified`),
  KEY `idx_c_adminconfig_id_del` (`id`,`deleted`),
  KEY `idx_c_adminconfig_date_entered` (`date_entered`),
  KEY `idx_c_adminconfig_name_del` (`name`,`deleted`),
  KEY `idx_c_adminconfig_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_adminconfig`
--

LOCK TABLES `c_adminconfig` WRITE;
/*!40000 ALTER TABLE `c_adminconfig` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_adminconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_adminconfig_audit`
--

DROP TABLE IF EXISTS `c_adminconfig_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_adminconfig_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_c_adminconfig_audit_parent_id` (`parent_id`),
  KEY `idx_c_adminconfig_audit_event_id` (`event_id`),
  KEY `idx_c_adminconfig_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_c_adminconfig_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_adminconfig_audit`
--

LOCK TABLES `c_adminconfig_audit` WRITE;
/*!40000 ALTER TABLE `c_adminconfig_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_adminconfig_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_comments`
--

DROP TABLE IF EXISTS `c_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_comments` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `parent_id` varchar(36) DEFAULT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `file_ext` varchar(100) DEFAULT NULL,
  `file_mime_type` varchar(100) DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `subcategory_id` varchar(100) DEFAULT NULL,
  `status_id` varchar(100) DEFAULT NULL,
  `direction` varchar(100) DEFAULT 'outbound',
  PRIMARY KEY (`id`),
  KEY `idx_c_comments_date_modfied` (`date_modified`),
  KEY `idx_c_comments_id_del` (`id`,`deleted`),
  KEY `idx_c_comments_date_entered` (`date_entered`),
  KEY `idx_c_comments_name_del` (`name`,`deleted`),
  KEY `idx_c_comments_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_c_comments_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_c_comments_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_comments`
--

LOCK TABLES `c_comments` WRITE;
/*!40000 ALTER TABLE `c_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_comments_audit`
--

DROP TABLE IF EXISTS `c_comments_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_comments_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_c_comments_audit_parent_id` (`parent_id`),
  KEY `idx_c_comments_audit_event_id` (`event_id`),
  KEY `idx_c_comments_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_c_comments_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_comments_audit`
--

LOCK TABLES `c_comments_audit` WRITE;
/*!40000 ALTER TABLE `c_comments_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_comments_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_crmlicense`
--

DROP TABLE IF EXISTS `c_crmlicense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_crmlicense` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `number_of_team` int(11) DEFAULT '0',
  `number_of_user` int(11) DEFAULT '0',
  `number_storage` int(11) DEFAULT '0',
  `license_type` varchar(100) DEFAULT '',
  `date_start` date DEFAULT NULL,
  `date_expired` date DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_c_crmlicense_date_modfied` (`date_modified`),
  KEY `idx_c_crmlicense_id_del` (`id`,`deleted`),
  KEY `idx_c_crmlicense_date_entered` (`date_entered`),
  KEY `idx_c_crmlicense_name_del` (`name`,`deleted`),
  KEY `idx_c_crmlicense_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_c_crmlicense_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_c_crmlicense_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_crmlicense`
--

LOCK TABLES `c_crmlicense` WRITE;
/*!40000 ALTER TABLE `c_crmlicense` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_crmlicense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_crmlicense_audit`
--

DROP TABLE IF EXISTS `c_crmlicense_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_crmlicense_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_c_crmlicense_audit_parent_id` (`parent_id`),
  KEY `idx_c_crmlicense_audit_event_id` (`event_id`),
  KEY `idx_c_crmlicense_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_c_crmlicense_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_crmlicense_audit`
--

LOCK TABLES `c_crmlicense_audit` WRITE;
/*!40000 ALTER TABLE `c_crmlicense_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_crmlicense_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_parentapplicense`
--

DROP TABLE IF EXISTS `c_parentapplicense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_parentapplicense` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `package` varchar(255) DEFAULT NULL,
  `used` int(11) DEFAULT '0',
  `expired` date DEFAULT NULL,
  `start` date DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_c_parentapplicense_date_modfied` (`date_modified`),
  KEY `idx_c_parentapplicense_id_del` (`id`,`deleted`),
  KEY `idx_c_parentapplicense_date_entered` (`date_entered`),
  KEY `idx_c_parentapplicense_name_del` (`name`,`deleted`),
  KEY `idx_c_parentapplicense_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_c_parentapplicense_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_c_parentapplicense_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_parentapplicense`
--

LOCK TABLES `c_parentapplicense` WRITE;
/*!40000 ALTER TABLE `c_parentapplicense` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_parentapplicense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_parentapplicense_audit`
--

DROP TABLE IF EXISTS `c_parentapplicense_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_parentapplicense_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_c_parentapplicense_audit_parent_id` (`parent_id`),
  KEY `idx_c_parentapplicense_audit_event_id` (`event_id`),
  KEY `idx_c_parentapplicense_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_c_parentapplicense_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_parentapplicense_audit`
--

LOCK TABLES `c_parentapplicense_audit` WRITE;
/*!40000 ALTER TABLE `c_parentapplicense_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_parentapplicense_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_sitedeployment`
--

DROP TABLE IF EXISTS `c_sitedeployment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sitedeployment` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `date_expired` date DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Running',
  `git_url` varchar(255) DEFAULT NULL,
  `lic_users` int(11) DEFAULT NULL,
  `lic_teams` int(11) DEFAULT NULL,
  `lic_students` int(11) DEFAULT NULL,
  `lic_type` varchar(100) DEFAULT NULL,
  `lic_storages` int(11) DEFAULT NULL,
  `db_name` varchar(255) DEFAULT NULL,
  `db_pass` varchar(255) DEFAULT NULL,
  `user_admin` varchar(100) DEFAULT NULL,
  `pass_admin` varchar(100) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT 'http://{name}',
  `protocol` varchar(255) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `lic_remain` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_c_sitedeployment_date_modfied` (`date_modified`),
  KEY `idx_c_sitedeployment_id_del` (`id`,`deleted`),
  KEY `idx_c_sitedeployment_date_entered` (`date_entered`),
  KEY `idx_c_sitedeployment_name_del` (`name`,`deleted`),
  KEY `idx_c_sitedeployment_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_c_sitedeployment_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_c_sitedeployment_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_sitedeployment`
--

LOCK TABLES `c_sitedeployment` WRITE;
/*!40000 ALTER TABLE `c_sitedeployment` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_sitedeployment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_sitedeployment_audit`
--

DROP TABLE IF EXISTS `c_sitedeployment_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sitedeployment_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_c_sitedeployment_audit_parent_id` (`parent_id`),
  KEY `idx_c_sitedeployment_audit_event_id` (`event_id`),
  KEY `idx_c_sitedeployment_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_c_sitedeployment_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_sitedeployment_audit`
--

LOCK TABLES `c_sitedeployment_audit` WRITE;
/*!40000 ALTER TABLE `c_sitedeployment_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_sitedeployment_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_sitedeployment_c_crmlicense_1_c`
--

DROP TABLE IF EXISTS `c_sitedeployment_c_crmlicense_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sitedeployment_c_crmlicense_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `c_sitedeployment_c_crmlicense_1c_sitedeployment_ida` char(36) DEFAULT NULL,
  `c_sitedeployment_c_crmlicense_1c_crmlicense_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_c_sitedeployment_c_crmlicense_1_ida1_deleted` (`c_sitedeployment_c_crmlicense_1c_sitedeployment_ida`,`deleted`),
  KEY `idx_c_sitedeployment_c_crmlicense_1_idb2_deleted` (`c_sitedeployment_c_crmlicense_1c_crmlicense_idb`,`deleted`),
  KEY `c_sitedeployment_c_crmlicense_1_alt` (`c_sitedeployment_c_crmlicense_1c_crmlicense_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_sitedeployment_c_crmlicense_1_c`
--

LOCK TABLES `c_sitedeployment_c_crmlicense_1_c` WRITE;
/*!40000 ALTER TABLE `c_sitedeployment_c_crmlicense_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_sitedeployment_c_crmlicense_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_sitedeployment_c_parentapplicense_1_c`
--

DROP TABLE IF EXISTS `c_sitedeployment_c_parentapplicense_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sitedeployment_c_parentapplicense_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida` char(36) DEFAULT NULL,
  `c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_c_sitedeployment_c_parentapplicense_1_ida1_deleted` (`c_sitedeployment_c_parentapplicense_1c_sitedeployment_ida`,`deleted`),
  KEY `idx_c_sitedeployment_c_parentapplicense_1_idb2_deleted` (`c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb`,`deleted`),
  KEY `c_sitedeployment_c_parentapplicense_1_alt` (`c_sitedeployment_c_parentapplicense_1c_parentapplicense_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_sitedeployment_c_parentapplicense_1_c`
--

LOCK TABLES `c_sitedeployment_c_parentapplicense_1_c` WRITE;
/*!40000 ALTER TABLE `c_sitedeployment_c_parentapplicense_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_sitedeployment_c_parentapplicense_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_sms`
--

DROP TABLE IF EXISTS `c_sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sms` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `phone_number` varchar(100) DEFAULT NULL,
  `delivery_status` varchar(100) DEFAULT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `date_send` date DEFAULT NULL,
  `date_in_content` date DEFAULT NULL,
  `message_count` int(10) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `template_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_c_sms_date_modfied` (`date_modified`),
  KEY `idx_c_sms_id_del` (`id`,`deleted`),
  KEY `idx_c_sms_date_entered` (`date_entered`),
  KEY `idx_c_sms_name_del` (`name`,`deleted`),
  KEY `idx_c_sms_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_sms`
--

LOCK TABLES `c_sms` WRITE;
/*!40000 ALTER TABLE `c_sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_sms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calls` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `duration_hours` int(11) DEFAULT '0',
  `duration_minutes` int(2) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Held',
  `direction` varchar(100) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `reminder_time` int(11) DEFAULT '-1',
  `email_reminder_time` int(11) DEFAULT '-1',
  `email_reminder_sent` tinyint(1) DEFAULT '0',
  `outlook_id` varchar(255) DEFAULT NULL,
  `repeat_type` varchar(36) DEFAULT NULL,
  `repeat_interval` int(3) DEFAULT '1',
  `repeat_dow` varchar(7) DEFAULT NULL,
  `repeat_until` date DEFAULT NULL,
  `repeat_count` int(7) DEFAULT NULL,
  `repeat_selector` varchar(36) DEFAULT NULL,
  `repeat_days` varchar(128) DEFAULT NULL,
  `repeat_ordinal` varchar(36) DEFAULT NULL,
  `repeat_unit` varchar(36) DEFAULT NULL,
  `repeat_parent_id` char(36) DEFAULT NULL,
  `recurrence_id` datetime DEFAULT NULL,
  `recurring_source` varchar(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `dri_workflow_sort_order` varchar(255) DEFAULT '1',
  `customer_journey_score` int(8) DEFAULT NULL,
  `cj_momentum_points` int(8) DEFAULT NULL,
  `cj_momentum_score` int(8) DEFAULT NULL,
  `customer_journey_progress` float DEFAULT '0',
  `cj_momentum_ratio` float DEFAULT '0',
  `customer_journey_points` int(3) DEFAULT '10',
  `cj_parent_activity_type` varchar(255) DEFAULT NULL,
  `customer_journey_blocked_by` text,
  `cj_parent_activity_id` char(36) DEFAULT NULL,
  `is_cj_parent_activity` tinyint(1) DEFAULT '0',
  `is_customer_journey_activity` tinyint(1) DEFAULT '0',
  `cj_momentum_start_date` datetime DEFAULT NULL,
  `cj_momentum_end_date` datetime DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `dri_subworkflow_template_id` char(36) DEFAULT NULL,
  `dri_workflow_task_template_id` char(36) DEFAULT NULL,
  `dri_subworkflow_id` char(36) DEFAULT NULL,
  `cj_actual_sort_order` varchar(255) DEFAULT NULL,
  `cj_url` varchar(255) DEFAULT NULL,
  `call_duration` varchar(255) DEFAULT NULL,
  `call_source` varchar(255) DEFAULT NULL,
  `call_destination` varchar(255) DEFAULT NULL,
  `call_recording` varchar(255) DEFAULT NULL,
  `call_entrysource` varchar(255) DEFAULT NULL,
  `call_result` varchar(255) DEFAULT NULL,
  `call_purpose` varchar(255) DEFAULT NULL,
  `mark_favorite` tinyint(1) DEFAULT '0',
  `move_trash` tinyint(1) DEFAULT '0',
  `parent_call` char(36) DEFAULT NULL,
  `recall` varchar(255) DEFAULT NULL,
  `recall_at` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `app_reminder_sent` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_calls_date_modfied` (`date_modified`),
  KEY `idx_calls_id_del` (`id`,`deleted`),
  KEY `idx_calls_date_entered` (`date_entered`),
  KEY `idx_calls_name_del` (`name`,`deleted`),
  KEY `idx_call_name` (`name`),
  KEY `idx_status` (`status`),
  KEY `idx_calls_date_start` (`date_start`),
  KEY `idx_calls_recurrence_id` (`recurrence_id`),
  KEY `idx_calls_date_start_end_del` (`date_start`,`date_end`,`deleted`),
  KEY `idx_calls_repeat_parent_id` (`repeat_parent_id`,`deleted`),
  KEY `idx_calls_date_start_reminder` (`date_start`,`reminder_time`),
  KEY `idx_calls_par_del` (`parent_id`,`parent_type`,`deleted`),
  KEY `idx_call_direction` (`direction`),
  KEY `idx_calls_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_calls_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_calls_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_call_cj_journey_tpl_id` (`dri_workflow_template_id`),
  KEY `idx_call_cj_stage_tpl_id` (`dri_subworkflow_template_id`),
  KEY `idx_call_cj_activity_tpl_id` (`dri_workflow_task_template_id`),
  KEY `idx_call_cj_stage_id` (`dri_subworkflow_id`),
  KEY `idx_call_cj_parent_activity` (`deleted`,`cj_parent_activity_id`,`cj_parent_activity_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
/*!40000 ALTER TABLE `calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls_contacts`
--

DROP TABLE IF EXISTS `calls_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calls_contacts` (
  `id` char(36) NOT NULL,
  `call_id` char(36) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `required` varchar(1) DEFAULT '1',
  `accept_status` varchar(25) DEFAULT 'none',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_call_call` (`call_id`),
  KEY `idx_con_call_con` (`contact_id`),
  KEY `idx_call_contact` (`call_id`,`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls_contacts`
--

LOCK TABLES `calls_contacts` WRITE;
/*!40000 ALTER TABLE `calls_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `calls_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls_cstm`
--

DROP TABLE IF EXISTS `calls_cstm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calls_cstm` (
  `id_c` char(36) NOT NULL,
  `call_source_c` varchar(150) DEFAULT '',
  `call_duration_minute_c` varchar(150) DEFAULT '',
  `call_entrysource_c` varchar(150) DEFAULT '',
  `record_c` varchar(255) DEFAULT '',
  `call_destination_c` varchar(150) DEFAULT '',
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls_cstm`
--

LOCK TABLES `calls_cstm` WRITE;
/*!40000 ALTER TABLE `calls_cstm` DISABLE KEYS */;
/*!40000 ALTER TABLE `calls_cstm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls_leads`
--

DROP TABLE IF EXISTS `calls_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calls_leads` (
  `id` char(36) NOT NULL,
  `call_id` char(36) DEFAULT NULL,
  `lead_id` char(36) DEFAULT NULL,
  `required` varchar(1) DEFAULT '1',
  `accept_status` varchar(25) DEFAULT 'none',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_lead_call_call` (`call_id`),
  KEY `idx_lead_call_lead` (`lead_id`),
  KEY `idx_call_lead` (`call_id`,`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls_leads`
--

LOCK TABLES `calls_leads` WRITE;
/*!40000 ALTER TABLE `calls_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `calls_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls_users`
--

DROP TABLE IF EXISTS `calls_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calls_users` (
  `id` char(36) NOT NULL,
  `call_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `required` varchar(1) DEFAULT '1',
  `accept_status` varchar(25) DEFAULT 'none',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_usr_call_call` (`call_id`),
  KEY `idx_usr_call_usr` (`user_id`),
  KEY `idx_call_users` (`call_id`,`user_id`),
  KEY `idx_call_users_del` (`call_id`,`user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls_users`
--

LOCK TABLES `calls_users` WRITE;
/*!40000 ALTER TABLE `calls_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `calls_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_log`
--

DROP TABLE IF EXISTS `campaign_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_log` (
  `id` char(36) NOT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `target_tracker_key` varchar(36) DEFAULT NULL,
  `target_id` char(36) DEFAULT NULL,
  `target_type` varchar(100) DEFAULT NULL,
  `activity_type` varchar(100) DEFAULT NULL,
  `activity_date` datetime DEFAULT NULL,
  `related_id` char(36) DEFAULT NULL,
  `related_type` varchar(100) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT '0',
  `hits` int(11) DEFAULT '0',
  `list_id` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  `more_information` varchar(100) DEFAULT NULL,
  `marketing_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_camp_tracker` (`target_tracker_key`),
  KEY `idx_camp_campaign_id` (`campaign_id`),
  KEY `idx_camp_more_info` (`more_information`),
  KEY `idx_target_id` (`target_id`),
  KEY `idx_target_id_deleted` (`target_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_log`
--

LOCK TABLES `campaign_log` WRITE;
/*!40000 ALTER TABLE `campaign_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_trkrs`
--

DROP TABLE IF EXISTS `campaign_trkrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_trkrs` (
  `id` char(36) NOT NULL,
  `tracker_name` varchar(30) DEFAULT NULL,
  `tracker_url` varchar(255) DEFAULT 'http://',
  `tracker_key` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` char(36) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `is_optout` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `campaign_tracker_key_idx` (`tracker_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_trkrs`
--

LOCK TABLES `campaign_trkrs` WRITE;
/*!40000 ALTER TABLE `campaign_trkrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_trkrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `tracker_key` int(11) NOT NULL AUTO_INCREMENT,
  `tracker_count` int(11) DEFAULT '0',
  `refer_url` varchar(255) DEFAULT 'http://',
  `tracker_text` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `impressions` int(11) DEFAULT '0',
  `budget` decimal(26,6) DEFAULT NULL,
  `expected_cost` decimal(26,6) DEFAULT NULL,
  `actual_cost` decimal(26,6) DEFAULT NULL,
  `expected_revenue` decimal(26,6) DEFAULT NULL,
  `campaign_type` varchar(100) DEFAULT NULL,
  `objective` text,
  `content` text,
  `frequency` varchar(100) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_campaigns_date_modfied` (`date_modified`),
  KEY `idx_campaigns_id_del` (`id`,`deleted`),
  KEY `idx_campaigns_date_entered` (`date_entered`),
  KEY `idx_campaigns_name_del` (`name`,`deleted`),
  KEY `camp_auto_tracker_key` (`tracker_key`),
  KEY `idx_campaign_name` (`name`),
  KEY `idx_campaign_status` (`status`),
  KEY `idx_campaign_campaign_type` (`campaign_type`),
  KEY `idx_campaign_end_date` (`end_date`),
  KEY `idx_campaigns_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_campaigns_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_campaigns_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns_audit`
--

DROP TABLE IF EXISTS `campaigns_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_campaigns_audit_parent_id` (`parent_id`),
  KEY `idx_campaigns_audit_event_id` (`event_id`),
  KEY `idx_campaigns_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_campaigns_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns_audit`
--

LOCK TABLES `campaigns_audit` WRITE;
/*!40000 ALTER TABLE `campaigns_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaigns_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases`
--

DROP TABLE IF EXISTS `cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cases` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `case_number` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `priority` varchar(100) DEFAULT NULL,
  `resolution` text,
  `work_log` text,
  `account_id` char(36) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `portal_viewable` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `reply_status` varchar(100) DEFAULT 'Not Replied',
  `parent_type` varchar(100) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `parent_case_id` char(36) DEFAULT NULL,
  `last_comment_direction` varchar(100) DEFAULT 'inbound',
  `last_comment_date` datetime DEFAULT NULL,
  `count_comment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `casesnumk` (`case_number`),
  KEY `idx_cases_date_modfied` (`date_modified`),
  KEY `idx_cases_id_del` (`id`,`deleted`),
  KEY `idx_cases_date_entered` (`date_entered`),
  KEY `idx_cases_name_del` (`name`,`deleted`),
  KEY `idx_case_name` (`name`),
  KEY `idx_account_id` (`account_id`),
  KEY `idx_cases_stat_del` (`assigned_user_id`,`status`,`deleted`),
  KEY `idx_cases_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_cases_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_cases_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_cases_cjtpl_id` (`dri_workflow_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases`
--

LOCK TABLES `cases` WRITE;
/*!40000 ALTER TABLE `cases` DISABLE KEYS */;
/*!40000 ALTER TABLE `cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases_audit`
--

DROP TABLE IF EXISTS `cases_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cases_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_cases_audit_parent_id` (`parent_id`),
  KEY `idx_cases_audit_event_id` (`event_id`),
  KEY `idx_cases_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_cases_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases_audit`
--

LOCK TABLES `cases_audit` WRITE;
/*!40000 ALTER TABLE `cases_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `cases_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases_bugs`
--

DROP TABLE IF EXISTS `cases_bugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cases_bugs` (
  `id` char(36) NOT NULL,
  `case_id` char(36) DEFAULT NULL,
  `bug_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_cas_bug_cas` (`case_id`),
  KEY `idx_cas_bug_bug` (`bug_id`),
  KEY `idx_case_bug` (`case_id`,`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases_bugs`
--

LOCK TABLES `cases_bugs` WRITE;
/*!40000 ALTER TABLE `cases_bugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `cases_bugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases_c_comments_1_c`
--

DROP TABLE IF EXISTS `cases_c_comments_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cases_c_comments_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `cases_c_comments_1cases_ida` char(36) DEFAULT NULL,
  `cases_c_comments_1c_comments_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cases_c_comments_1_ida1_deleted` (`cases_c_comments_1cases_ida`,`deleted`),
  KEY `idx_cases_c_comments_1_idb2_deleted` (`cases_c_comments_1c_comments_idb`,`deleted`),
  KEY `cases_c_comments_1_alt` (`cases_c_comments_1c_comments_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases_c_comments_1_c`
--

LOCK TABLES `cases_c_comments_1_c` WRITE;
/*!40000 ALTER TABLE `cases_c_comments_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `cases_c_comments_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases_cases_1_c`
--

DROP TABLE IF EXISTS `cases_cases_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cases_cases_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `cases_cases_1cases_ida` char(36) DEFAULT NULL,
  `cases_cases_1cases_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cases_cases_1_ida1_deleted` (`cases_cases_1cases_ida`,`deleted`),
  KEY `idx_cases_cases_1_idb2_deleted` (`cases_cases_1cases_idb`,`deleted`),
  KEY `cases_cases_1_alt` (`cases_cases_1cases_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases_cases_1_c`
--

LOCK TABLES `cases_cases_1_c` WRITE;
/*!40000 ALTER TABLE `cases_cases_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `cases_cases_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `root` char(36) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `is_external` tinyint(1) DEFAULT '0',
  `source_id` varchar(255) DEFAULT NULL,
  `source_type` varchar(255) DEFAULT NULL,
  `source_meta` text,
  PRIMARY KEY (`id`),
  KEY `idx_categories_date_modfied` (`date_modified`),
  KEY `idx_categories_id_del` (`id`,`deleted`),
  KEY `idx_categories_date_entered` (`date_entered`),
  KEY `idx_categories_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES ('ae029e1e-3699-11e9-8924-00e04c360044','KBContentCategory','2019-02-22 12:01:29','2019-02-22 12:01:29','1',NULL,NULL,0,'ae029e1e-3699-11e9-8924-00e04c360044',1,2,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_tree`
--

DROP TABLE IF EXISTS `category_tree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_tree` (
  `self_id` char(36) DEFAULT NULL,
  `node_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_node_id` int(11) DEFAULT '0',
  `type` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`node_id`),
  KEY `idx_categorytree` (`self_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_tree`
--

LOCK TABLES `category_tree` WRITE;
/*!40000 ALTER TABLE `category_tree` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_tree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cj_forms`
--

DROP TABLE IF EXISTS `cj_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cj_forms` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `trigger_event` varchar(255) DEFAULT NULL,
  `action_type` varchar(255) DEFAULT NULL,
  `relationship` text,
  `activity_module` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `activity_template_id` char(36) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cj_forms_date_modfied` (`date_modified`),
  KEY `idx_cj_forms_id_del` (`id`,`deleted`),
  KEY `idx_cj_forms_date_entered` (`date_entered`),
  KEY `idx_cj_forms_name_del` (`name`,`deleted`),
  KEY `idx_cj_forms_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_cj_forms_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_cj_forms_act_tpl_id` (`activity_template_id`),
  KEY `idx_cj_forms_jry_tpl_id` (`dri_workflow_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cj_forms`
--

LOCK TABLES `cj_forms` WRITE;
/*!40000 ALTER TABLE `cj_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `cj_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cj_forms_audit`
--

DROP TABLE IF EXISTS `cj_forms_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cj_forms_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_cj_forms_audit_parent_id` (`parent_id`),
  KEY `idx_cj_forms_audit_event_id` (`event_id`),
  KEY `idx_cj_forms_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_cj_forms_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cj_forms_audit`
--

LOCK TABLES `cj_forms_audit` WRITE;
/*!40000 ALTER TABLE `cj_forms_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `cj_forms_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cj_web_hooks`
--

DROP TABLE IF EXISTS `cj_web_hooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cj_web_hooks` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `error_message_path` varchar(255) DEFAULT 'message',
  `sort_order` int(8) DEFAULT '1',
  `request_method` varchar(255) DEFAULT 'GET',
  `request_format` varchar(255) DEFAULT 'json',
  `response_format` varchar(255) DEFAULT 'json',
  `trigger_event` varchar(255) DEFAULT 'before_create',
  `headers` text,
  `ignore_errors` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `parent_id` char(36) NOT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cj_web_hooks_date_modfied` (`date_modified`),
  KEY `idx_cj_web_hooks_id_del` (`id`,`deleted`),
  KEY `idx_cj_web_hooks_date_entered` (`date_entered`),
  KEY `idx_cj_web_hooks_name_del` (`name`,`deleted`),
  KEY `idx_cj_web_hooks_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_cj_web_hooks_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cj_web_hooks`
--

LOCK TABLES `cj_web_hooks` WRITE;
/*!40000 ALTER TABLE `cj_web_hooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cj_web_hooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cj_web_hooks_audit`
--

DROP TABLE IF EXISTS `cj_web_hooks_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cj_web_hooks_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_cj_web_hooks_audit_parent_id` (`parent_id`),
  KEY `idx_cj_web_hooks_audit_event_id` (`event_id`),
  KEY `idx_cj_web_hooks_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_cj_web_hooks_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cj_web_hooks_audit`
--

LOCK TABLES `cj_web_hooks_audit` WRITE;
/*!40000 ALTER TABLE `cj_web_hooks_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `cj_web_hooks_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `parent_id` char(36) NOT NULL,
  `data` longtext,
  PRIMARY KEY (`id`),
  KEY `idx_comments_date_modfied` (`date_modified`),
  KEY `idx_comments_id_del` (`id`,`deleted`),
  KEY `idx_comments_date_entered` (`date_entered`),
  KEY `comment_activities` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `value` text,
  `platform` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_config_cat` (`category`),
  KEY `idx_config_platform` (`platform`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'notify','fromaddress','do_not_reply@example.com',NULL),(2,'notify','fromname','DotbCRM',NULL),(3,'notify','send_by_default','1',NULL),(4,'notify','on','1',NULL),(5,'notify','send_from_assigning_user','0',NULL),(6,'info','dotb_version','8.2.0',NULL),(7,'MySettings','tab','YTo0NTp7aTowO3M6NDoiSG9tZSI7aToxO3M6NToiTGVhZHMiO2k6MjtzOjg6IkNvbnRhY3RzIjtpOjM7czo4OiJBY2NvdW50cyI7aTo0O3M6MTM6Ik9wcG9ydHVuaXRpZXMiO2k6NTtzOjg6IkNhbGVuZGFyIjtpOjY7czo2OiJRdW90ZXMiO2k6NztzOjE2OiJDX1NpdGVEZXBsb3ltZW50IjtpOjg7czo5OiJEb2N1bWVudHMiO2k6OTtzOjY6IkVtYWlscyI7aToxMDtzOjc6IlJlcG9ydHMiO2k6MTE7czo5OiJDYW1wYWlnbnMiO2k6MTI7czo1OiJDYWxscyI7aToxMztzOjg6Ik1lZXRpbmdzIjtpOjE0O3M6NToiVGFza3MiO2k6MTU7czo1OiJOb3RlcyI7aToxNjtzOjk6IkZvcmVjYXN0cyI7aToxNztzOjU6IkNhc2VzIjtpOjE4O3M6OToiUHJvc3BlY3RzIjtpOjE5O3M6MTM6IlByb3NwZWN0TGlzdHMiO2k6MjA7czo0OiJUYWdzIjtpOjIxO3M6MTA6InBtc2VfSW5ib3giO2k6MjI7czoxMjoicG1zZV9Qcm9qZWN0IjtpOjIzO3M6MTk6InBtc2VfQnVzaW5lc3NfUnVsZXMiO2k6MjQ7czoyMToicG1zZV9FbWFpbHNfVGVtcGxhdGVzIjtpOjI1O3M6MTY6IlJldmVudWVMaW5lSXRlbXMiO2k6MjY7czo4OiJQcm9kdWN0cyI7aToyNztzOjk6IkNvbnRyYWN0cyI7aToyODtzOjc6IlByb2plY3QiO2k6Mjk7czo0OiJCdWdzIjtpOjMwO3M6MTM6Ik91dGJvdW5kRW1haWwiO2k6MzE7czoxMToiRGF0YVByaXZhY3kiO2k6MzI7czoxMDoiS0JDb250ZW50cyI7aTozMztzOjExOiJvcHNfQmFja3VwcyI7aTozNDtzOjE3OiJmdGVfVXNhZ2VUcmFja2luZyI7aTozNTtzOjEzOiJEUklfV29ya2Zsb3dzIjtpOjM2O3M6MTA6IkNfQ29tbWVudHMiO2k6Mzc7czoyMjoiYmNfc3VydmV5X3Ntc190ZW1wbGF0ZSI7aTozODtzOjEwOiJCX0ludm9pY2VzIjtpOjM5O3M6OToiYmNfc3VydmV5IjtpOjQwO3M6MTg6ImJjX3N1cnZleV90ZW1wbGF0ZSI7aTo0MTtzOjIwOiJiY19zdXJ2ZXlfc3VibWlzc2lvbiI7aTo0MjtzOjEyOiJDX0NSTUxpY2Vuc2UiO2k6NDM7czo1OiJDX1NNUyI7aTo0NDtzOjE4OiJDX1BhcmVudEFwcExpY2Vuc2UiO30=',NULL),(8,'portal','on','0','support'),(9,'tracker','Tracker','1',NULL),(10,'tracker','tracker_perf','1',NULL),(11,'tracker','tracker_sessions','1',NULL),(12,'tracker','tracker_queries','1',NULL),(13,'system','skypeout_on','1',NULL),(14,'system','tweettocase_on','0',NULL),(15,'KBContents','languages','[{\"en\":\"English\",\"primary\":true}]','base'),(16,'KBContents','category_root','ae029e1e-3699-11e9-8924-00e04c360044','base'),(17,'license','users','50000',NULL),(18,'license','expire_date','2036-03-17',NULL),(19,'license','key','111111111111111',NULL),(20,'Forecasts','is_setup','0','base'),(21,'Forecasts','is_upgrade','0','base'),(22,'Forecasts','has_commits','0','base'),(23,'Forecasts','forecast_by','RevenueLineItems','base'),(24,'Forecasts','timeperiod_type','chronological','base'),(25,'Forecasts','timeperiod_interval','Annual','base'),(26,'Forecasts','timeperiod_leaf_interval','Quarter','base'),(27,'Forecasts','timeperiod_start_date','2014-01-01','base'),(28,'Forecasts','timeperiod_fiscal_year',NULL,'base'),(29,'Forecasts','timeperiod_shown_forward','2','base'),(30,'Forecasts','timeperiod_shown_backward','2','base'),(31,'Forecasts','forecast_ranges','show_binary','base'),(32,'Forecasts','buckets_dom','commit_stage_binary_dom','base'),(33,'Forecasts','show_binary_ranges','{\"include\":{\"min\":70,\"max\":100},\"exclude\":{\"min\":0,\"max\":69}}','base'),(34,'Forecasts','show_buckets_ranges','{\"include\":{\"min\":85,\"max\":100},\"upside\":{\"min\":70,\"max\":84},\"exclude\":{\"min\":0,\"max\":69}}','base'),(35,'Forecasts','show_custom_buckets_ranges','{\"include\":{\"min\":85,\"max\":100},\"upside\":{\"min\":70,\"max\":84},\"exclude\":{\"min\":0,\"max\":69}}','base'),(36,'Forecasts','commit_stages_included','[\"include\"]','base'),(37,'Forecasts','sales_stage_won','[\"Closed Won\"]','base'),(38,'Forecasts','sales_stage_lost','[\"Closed Lost\"]','base'),(39,'Forecasts','show_worksheet_likely','1','base'),(40,'Forecasts','show_worksheet_best','1','base'),(41,'Forecasts','show_worksheet_worst','0','base'),(42,'Forecasts','show_projected_likely','1','base'),(43,'Forecasts','show_projected_best','1','base'),(44,'Forecasts','show_projected_worst','0','base'),(45,'Forecasts','show_forecasts_commit_warnings','1','base'),(46,'Forecasts','worksheet_columns','[\"commit_stage\",\"parent_name\",\"opportunity_name\",\"account_name\",\"date_closed\",\"product_template_name\",\"sales_stage\",\"probability\",\"likely_case\",\"best_case\"]','base'),(47,'Opportunities','opps_view_by','RevenueLineItems','base'),(48,'system','api_system_status','YjoxOw==',''),(49,'MySettings','hide_subpanels','YTo1OntzOjc6InByb2plY3QiO3M6NzoicHJvamVjdCI7czo0OiJidWdzIjtzOjQ6ImJ1Z3MiO3M6ODoicHJvZHVjdHMiO3M6ODoicHJvZHVjdHMiO3M6OToiY29udHJhY3RzIjtzOjk6ImNvbnRyYWN0cyI7czoxMToiZGF0YXByaXZhY3kiO3M6MTE6ImRhdGFwcml2YWN5Ijt9',''),(50,'Update','CheckUpdates','manual',''),(51,'system','name','DotbCRM',''),(52,'license','vk_end_date','2030-10-10',NULL),(53,'license','validation_notice','',NULL),(54,'license','num_portal_users','50000',NULL),(55,'license','last_validation_success','2019-03-21',NULL),(56,'license','num_lic_oc','500',NULL),(57,'Stage2','obfuscation-salt','5c700922687ac','base'),(58,'proxy','on','0',''),(59,'proxy','host','',''),(60,'proxy','port','',''),(61,'proxy','auth','0',''),(62,'proxy','username','',''),(63,'proxy','password','',''),(64,'system','session_timeout','10380',''),(65,'MySettings','tab','[\"Home\",\"Cases\",\"Bugs\",\"KBContents\"]','portal'),(66,'MySettings','disable_useredit','no',''),(67,'DRI_Workflows','validation_key','dotbcrm@123','base');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `salutation` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `googleplus` varchar(100) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `do_not_call` tinyint(1) DEFAULT '0',
  `phone_home` varchar(100) DEFAULT NULL,
  `phone_mobile` varchar(100) DEFAULT NULL,
  `phone_work` varchar(100) DEFAULT NULL,
  `phone_other` varchar(100) DEFAULT NULL,
  `phone_fax` varchar(100) DEFAULT NULL,
  `primary_address_street` varchar(150) DEFAULT NULL,
  `primary_address_city` varchar(100) DEFAULT NULL,
  `primary_address_state` varchar(100) DEFAULT NULL,
  `primary_address_postalcode` varchar(20) DEFAULT NULL,
  `primary_address_country` varchar(255) DEFAULT NULL,
  `alt_address_street` varchar(150) DEFAULT NULL,
  `alt_address_city` varchar(100) DEFAULT NULL,
  `alt_address_state` varchar(100) DEFAULT NULL,
  `alt_address_postalcode` varchar(20) DEFAULT NULL,
  `alt_address_country` varchar(255) DEFAULT NULL,
  `assistant` varchar(75) DEFAULT NULL,
  `assistant_phone` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `lead_source` varchar(255) DEFAULT NULL,
  `dnb_principal_id` varchar(30) DEFAULT NULL,
  `reports_to_id` char(36) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `portal_name` varchar(255) DEFAULT NULL,
  `portal_active` tinyint(1) DEFAULT '0',
  `portal_password` varchar(255) DEFAULT NULL,
  `portal_app` varchar(255) DEFAULT NULL,
  `preferred_language` varchar(255) DEFAULT NULL,
  `dp_business_purpose` text,
  `dp_consent_last_updated` date DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `mkto_sync` tinyint(1) DEFAULT '0',
  `mkto_id` int(11) DEFAULT NULL,
  `mkto_lead_score` int(11) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `pri_latitude` decimal(20,12) DEFAULT NULL,
  `pri_longitude` decimal(20,12) DEFAULT NULL,
  `alt_latitude` decimal(20,12) DEFAULT NULL,
  `alt_longitude` decimal(20,12) DEFAULT NULL,
  `last_call_status` varchar(100) DEFAULT '',
  `last_call_date` datetime DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `utm_source` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_contacts_date_modfied` (`date_modified`),
  KEY `idx_contacts_id_del` (`id`,`deleted`),
  KEY `idx_contacts_date_entered` (`date_entered`),
  KEY `idx_contacts_last_first` (`last_name`,`first_name`,`deleted`),
  KEY `idx_contacts_first_last` (`first_name`,`last_name`,`deleted`),
  KEY `idx_contacts_del_last` (`deleted`,`last_name`),
  KEY `idx_cont_del_reports` (`deleted`,`reports_to_id`,`last_name`),
  KEY `idx_reports_to_id` (`reports_to_id`),
  KEY `idx_del_id_user` (`deleted`,`id`,`assigned_user_id`),
  KEY `idx_cont_assigned` (`assigned_user_id`),
  KEY `idx_contact_title` (`title`),
  KEY `idx_contact_mkto_id` (`mkto_id`),
  KEY `idx_contacts_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_contacts_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_contacts_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_contacts_cjtpl_id` (`dri_workflow_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_audit`
--

DROP TABLE IF EXISTS `contacts_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_contacts_audit_parent_id` (`parent_id`),
  KEY `idx_contacts_audit_event_id` (`event_id`),
  KEY `idx_contacts_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_contacts_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_audit`
--

LOCK TABLES `contacts_audit` WRITE;
/*!40000 ALTER TABLE `contacts_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_b_invoices_1_c`
--

DROP TABLE IF EXISTS `contacts_b_invoices_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_b_invoices_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `contacts_b_invoices_1contacts_ida` char(36) DEFAULT NULL,
  `contacts_b_invoices_1b_invoices_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_contacts_b_invoices_1_ida1_deleted` (`contacts_b_invoices_1contacts_ida`,`deleted`),
  KEY `idx_contacts_b_invoices_1_idb2_deleted` (`contacts_b_invoices_1b_invoices_idb`,`deleted`),
  KEY `contacts_b_invoices_1_alt` (`contacts_b_invoices_1b_invoices_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_b_invoices_1_c`
--

LOCK TABLES `contacts_b_invoices_1_c` WRITE;
/*!40000 ALTER TABLE `contacts_b_invoices_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_b_invoices_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_bugs`
--

DROP TABLE IF EXISTS `contacts_bugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_bugs` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `bug_id` char(36) DEFAULT NULL,
  `contact_role` varchar(50) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_bug_con` (`contact_id`),
  KEY `idx_con_bug_bug` (`bug_id`),
  KEY `idx_contact_bug` (`contact_id`,`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_bugs`
--

LOCK TABLES `contacts_bugs` WRITE;
/*!40000 ALTER TABLE `contacts_bugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_bugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_cases`
--

DROP TABLE IF EXISTS `contacts_cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_cases` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `case_id` char(36) DEFAULT NULL,
  `contact_role` varchar(50) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_case_con` (`contact_id`),
  KEY `idx_con_case_case` (`case_id`),
  KEY `idx_contacts_cases` (`contact_id`,`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_cases`
--

LOCK TABLES `contacts_cases` WRITE;
/*!40000 ALTER TABLE `contacts_cases` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_cases_1_c`
--

DROP TABLE IF EXISTS `contacts_cases_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_cases_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `contacts_cases_1contacts_ida` char(36) DEFAULT NULL,
  `contacts_cases_1cases_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_contacts_cases_1_ida1_deleted` (`contacts_cases_1contacts_ida`,`deleted`),
  KEY `idx_contacts_cases_1_idb2_deleted` (`contacts_cases_1cases_idb`,`deleted`),
  KEY `contacts_cases_1_alt` (`contacts_cases_1cases_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_cases_1_c`
--

LOCK TABLES `contacts_cases_1_c` WRITE;
/*!40000 ALTER TABLE `contacts_cases_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_cases_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_dataprivacy`
--

DROP TABLE IF EXISTS `contacts_dataprivacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_dataprivacy` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `dataprivacy_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_dataprivacy_con` (`contact_id`),
  KEY `idx_con_dataprivacy_dataprivacy` (`dataprivacy_id`),
  KEY `idx_contacts_dataprivacy` (`contact_id`,`dataprivacy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_dataprivacy`
--

LOCK TABLES `contacts_dataprivacy` WRITE;
/*!40000 ALTER TABLE `contacts_dataprivacy` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_dataprivacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_users`
--

DROP TABLE IF EXISTS `contacts_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_users` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_users_con` (`contact_id`),
  KEY `idx_con_users_user` (`user_id`),
  KEY `idx_contacts_users` (`contact_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_users`
--

LOCK TABLES `contacts_users` WRITE;
/*!40000 ALTER TABLE `contacts_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_types`
--

DROP TABLE IF EXISTS `contract_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_types` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `list_order` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_contract_types_date_modfied` (`date_modified`),
  KEY `idx_contract_types_id_del` (`id`,`deleted`),
  KEY `idx_contract_types_date_entered` (`date_entered`),
  KEY `idx_contract_types_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_types`
--

LOCK TABLES `contract_types` WRITE;
/*!40000 ALTER TABLE `contract_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `contract_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `reference_code` varchar(255) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_contract_value` decimal(26,6) DEFAULT NULL,
  `total_contract_value_usdollar` decimal(26,6) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `customer_signed_date` date DEFAULT NULL,
  `company_signed_date` date DEFAULT NULL,
  `expiration_notice` datetime DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_contracts_date_modfied` (`date_modified`),
  KEY `idx_contracts_id_del` (`id`,`deleted`),
  KEY `idx_contracts_date_entered` (`date_entered`),
  KEY `idx_contracts_name_del` (`name`,`deleted`),
  KEY `idx_contract_name` (`name`),
  KEY `idx_contract_status` (`status`),
  KEY `idx_contract_start_date` (`start_date`),
  KEY `idx_contract_end_date` (`end_date`),
  KEY `idx_contracts_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_contracts_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_contracts_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts_audit`
--

DROP TABLE IF EXISTS `contracts_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_contracts_audit_parent_id` (`parent_id`),
  KEY `idx_contracts_audit_event_id` (`event_id`),
  KEY `idx_contracts_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_contracts_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts_audit`
--

LOCK TABLES `contracts_audit` WRITE;
/*!40000 ALTER TABLE `contracts_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts_contacts`
--

DROP TABLE IF EXISTS `contracts_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts_contacts` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `contract_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contracts_contacts_alt` (`contact_id`,`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts_contacts`
--

LOCK TABLES `contracts_contacts` WRITE;
/*!40000 ALTER TABLE `contracts_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts_opportunities`
--

DROP TABLE IF EXISTS `contracts_opportunities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts_opportunities` (
  `id` char(36) NOT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `contract_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contracts_opp_alt` (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts_opportunities`
--

LOCK TABLES `contracts_opportunities` WRITE;
/*!40000 ALTER TABLE `contracts_opportunities` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts_opportunities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts_products`
--

DROP TABLE IF EXISTS `contracts_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts_products` (
  `id` char(36) NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `contract_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contracts_prod_alt` (`contract_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts_products`
--

LOCK TABLES `contracts_products` WRITE;
/*!40000 ALTER TABLE `contracts_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts_quotes`
--

DROP TABLE IF EXISTS `contracts_quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts_quotes` (
  `id` char(36) NOT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `contract_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contracts_quot_alt` (`contract_id`,`quote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts_quotes`
--

LOCK TABLES `contracts_quotes` WRITE;
/*!40000 ALTER TABLE `contracts_quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts_quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` char(36) NOT NULL,
  `name` varchar(36) DEFAULT NULL,
  `symbol` varchar(36) DEFAULT NULL,
  `iso4217` varchar(3) DEFAULT NULL,
  `conversion_rate` decimal(26,6) DEFAULT '0.000000',
  `status` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_currency_name` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_fields` (
  `bean_id` char(36) DEFAULT NULL,
  `set_num` int(11) DEFAULT '0',
  `field0` varchar(255) DEFAULT NULL,
  `field1` varchar(255) DEFAULT NULL,
  `field2` varchar(255) DEFAULT NULL,
  `field3` varchar(255) DEFAULT NULL,
  `field4` varchar(255) DEFAULT NULL,
  `field5` varchar(255) DEFAULT NULL,
  `field6` varchar(255) DEFAULT NULL,
  `field7` varchar(255) DEFAULT NULL,
  `field8` varchar(255) DEFAULT NULL,
  `field9` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  KEY `idx_beanid_set_num` (`bean_id`,`set_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields`
--

LOCK TABLES `custom_fields` WRITE;
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_queries`
--

DROP TABLE IF EXISTS `custom_queries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_queries` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `custom_query` text,
  `query_type` varchar(50) DEFAULT NULL,
  `list_order` int(4) DEFAULT NULL,
  `query_locked` varchar(3) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_customqueries` (`name`,`deleted`),
  KEY `idx_custom_queries_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_custom_queries_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_queries`
--

LOCK TABLES `custom_queries` WRITE;
/*!40000 ALTER TABLE `custom_queries` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_queries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboards` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `dashboard_module` varchar(100) DEFAULT NULL,
  `view_name` varchar(100) DEFAULT NULL,
  `metadata` text,
  `default_dashboard` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `copy_from_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dashboards_date_modfied` (`date_modified`),
  KEY `idx_dashboards_id_del` (`id`,`deleted`),
  KEY `idx_dashboards_date_entered` (`date_entered`),
  KEY `idx_dashboards_name_del` (`name`,`deleted`),
  KEY `user_module_view` (`assigned_user_id`,`dashboard_module`,`view_name`),
  KEY `idx_dashboards_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_dashboards_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_dashboards_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboards`
--

LOCK TABLES `dashboards` WRITE;
/*!40000 ALTER TABLE `dashboards` DISABLE KEYS */;
INSERT INTO `dashboards` VALUES ('13b20450-7949-11ea-88c8-a38174f123ce','LBL_LEADS_LIST_DASHBOARD','2020-04-08 03:28:55','2020-04-08 03:28:55','1','1',NULL,0,'Leads','records','{\"components\":[{\"rows\":[[{\"view\":{\"type\":\"dashablelist\",\"label\":\"TPL_DASHLET_MY_MODULE\",\"display_columns\":[\"name\",\"billing_address_country\",\"billing_address_city\"]},\"context\":{\"module\":\"Accounts\"},\"width\":12}]],\"width\":12}]}',0,'1','1',NULL,'1',NULL),('24fb2de4-1431-11eb-b65b-00ace43f6d74','LBL_CONTACTS_LIST_DASHBOARD','2020-10-22 06:38:06','2020-10-22 06:38:06','1','1',NULL,0,'Contacts','records','{\"components\":[{\"rows\":[[{\"view\":{\"type\":\"dashablelist\",\"label\":\"TPL_DASHLET_MY_MODULE\",\"display_columns\":[\"name\",\"billing_address_country\",\"billing_address_city\"]},\"context\":{\"module\":\"Accounts\"},\"width\":12}]],\"width\":12}]}',0,'1','1',NULL,'1',NULL),('7bd4216e-1433-11eb-8573-00ace43f6d74','LBL_OPPORTUNITIES_LIST_DASHBOARD','2020-10-22 06:54:51','2020-10-22 06:54:51','1','1',NULL,0,'Opportunities','records','{\"components\":[{\"rows\":[[{\"view\":{\"type\":\"sales-pipeline\",\"label\":\"LBL_DASHLET_PIPLINE_NAME\",\"visibility\":\"user\"},\"width\":12}]],\"width\":12}]}',0,'1','1',NULL,'1',NULL),('7ecfe394-1433-11eb-b10c-00ace43f6d74','LBL_CONTACTS_LIST_DASHBOARD','2020-10-22 06:54:56','2020-10-22 06:54:56','1','1',NULL,0,'Contacts','records','{\"components\":[{\"rows\":[[{\"view\":{\"type\":\"dashablelist\",\"label\":\"TPL_DASHLET_MY_MODULE\",\"display_columns\":[\"name\",\"billing_address_country\",\"billing_address_city\"]},\"context\":{\"module\":\"Accounts\"},\"width\":12}]],\"width\":12}]}',0,'1','1',NULL,'1',NULL),('b5f57f28-1433-11eb-94be-00ace43f6d74','LBL_ACCOUNTS_LIST_DASHBOARD','2020-10-22 06:56:28','2020-10-22 06:56:28','1','1',NULL,0,'Accounts','records','{\"components\":[{\"rows\":[[{\"view\":{\"type\":\"dashablelist\",\"label\":\"TPL_DASHLET_MY_MODULE\",\"display_columns\":[\"name\",\"billing_address_country\",\"billing_address_city\"]},\"context\":{\"module\":\"Accounts\"},\"width\":12}]],\"width\":12}]}',0,'1','1',NULL,'1',NULL),('cf527c72-7948-11ea-8fbc-05261049924a','LBL_HOME_DASHBOARD','2020-04-08 03:27:00','2020-04-08 03:27:00','1','1',NULL,0,'Home',NULL,'{\"components\":[]}',0,'1','1',NULL,'1',NULL);
/*!40000 ALTER TABLE `dashboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_privacy`
--

DROP TABLE IF EXISTS `data_privacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_privacy` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `dataprivacy_number` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Open',
  `priority` varchar(100) DEFAULT NULL,
  `resolution` text,
  `work_log` text,
  `business_purpose` text,
  `source` varchar(255) DEFAULT NULL,
  `requested_by` varchar(255) DEFAULT NULL,
  `date_opened` date DEFAULT NULL,
  `date_due` date DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `fields_to_erase` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dataprivacynumk` (`dataprivacy_number`),
  KEY `idx_data_privacy_date_modfied` (`date_modified`),
  KEY `idx_data_privacy_id_del` (`id`,`deleted`),
  KEY `idx_data_privacy_date_entered` (`date_entered`),
  KEY `idx_data_privacy_name_del` (`name`,`deleted`),
  KEY `idx_dataprivacy_name` (`name`),
  KEY `idx_data_privacy_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_data_privacy_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_data_privacy_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_privacy`
--

LOCK TABLES `data_privacy` WRITE;
/*!40000 ALTER TABLE `data_privacy` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_privacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_privacy_audit`
--

DROP TABLE IF EXISTS `data_privacy_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_privacy_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_data_privacy_audit_parent_id` (`parent_id`),
  KEY `idx_data_privacy_audit_event_id` (`event_id`),
  KEY `idx_data_privacy_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_data_privacy_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_privacy_audit`
--

LOCK TABLES `data_privacy_audit` WRITE;
/*!40000 ALTER TABLE `data_privacy_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_privacy_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_sets`
--

DROP TABLE IF EXISTS `data_sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_sets` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `report_id` char(36) DEFAULT NULL,
  `query_id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `list_order_y` int(3) DEFAULT '0',
  `exportable` varchar(3) DEFAULT '0',
  `header` varchar(3) DEFAULT '0',
  `description` text,
  `table_width` varchar(3) DEFAULT '0',
  `font_size` varchar(8) DEFAULT '0',
  `output_default` varchar(100) DEFAULT NULL,
  `prespace_y` varchar(3) DEFAULT '0',
  `use_prev_header` varchar(3) DEFAULT '0',
  `header_back_color` varchar(100) DEFAULT NULL,
  `body_back_color` varchar(100) DEFAULT NULL,
  `header_text_color` varchar(100) DEFAULT NULL,
  `body_text_color` varchar(100) DEFAULT NULL,
  `table_width_type` varchar(3) DEFAULT NULL,
  `custom_layout` varchar(10) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dataset` (`name`,`deleted`),
  KEY `idx_data_sets_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_data_sets_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_sets`
--

LOCK TABLES `data_sets` WRITE;
/*!40000 ALTER TABLE `data_sets` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_sets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_attributes`
--

DROP TABLE IF EXISTS `dataset_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_attributes` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `display_type` varchar(25) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `attribute_type` varchar(8) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `font_size` varchar(8) DEFAULT '0',
  `cell_size` varchar(3) DEFAULT NULL,
  `size_type` varchar(3) DEFAULT NULL,
  `bg_color` varchar(25) DEFAULT NULL,
  `font_color` varchar(25) DEFAULT NULL,
  `wrap` varchar(3) DEFAULT NULL,
  `style` varchar(25) DEFAULT NULL,
  `format_type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_datasetatt` (`parent_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_attributes`
--

LOCK TABLES `dataset_attributes` WRITE;
/*!40000 ALTER TABLE `dataset_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `dataset_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_layouts`
--

DROP TABLE IF EXISTS `dataset_layouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_layouts` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `parent_value` varchar(50) DEFAULT NULL,
  `layout_type` varchar(25) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `list_order_x` int(4) DEFAULT NULL,
  `list_order_z` int(4) DEFAULT NULL,
  `row_header_id` char(36) DEFAULT NULL,
  `hide_column` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_datasetlayout` (`parent_value`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_layouts`
--

LOCK TABLES `dataset_layouts` WRITE;
/*!40000 ALTER TABLE `dataset_layouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `dataset_layouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_revisions`
--

DROP TABLE IF EXISTS `document_revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_revisions` (
  `id` char(36) NOT NULL,
  `change_log` varchar(255) DEFAULT NULL,
  `document_id` char(36) DEFAULT NULL,
  `doc_id` varchar(100) DEFAULT NULL,
  `doc_type` varchar(100) DEFAULT NULL,
  `doc_url` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `file_ext` varchar(100) DEFAULT NULL,
  `file_mime_type` varchar(100) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `revision` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documentrevision_mimetype` (`file_mime_type`),
  KEY `idx_document_revisions_document_id_deleted` (`document_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_revisions`
--

LOCK TABLES `document_revisions` WRITE;
/*!40000 ALTER TABLE `document_revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `document_name` varchar(255) DEFAULT NULL,
  `doc_id` varchar(100) DEFAULT NULL,
  `doc_type` varchar(100) DEFAULT 'Dotb',
  `doc_url` varchar(255) DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `subcategory_id` varchar(100) DEFAULT NULL,
  `status_id` varchar(100) DEFAULT NULL,
  `document_revision_id` char(36) DEFAULT NULL,
  `related_doc_id` char(36) DEFAULT NULL,
  `related_doc_rev_id` char(36) DEFAULT NULL,
  `is_template` tinyint(1) DEFAULT '0',
  `template_type` varchar(100) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_documents_date_modfied` (`date_modified`),
  KEY `idx_documents_id_del` (`id`,`deleted`),
  KEY `idx_documents_date_entered` (`date_entered`),
  KEY `idx_doc_cat` (`category_id`,`subcategory_id`),
  KEY `idx_document_doc_type` (`doc_type`),
  KEY `idx_document_exp_date` (`exp_date`),
  KEY `idx_documents_related_doc_id_deleted` (`related_doc_id`,`deleted`),
  KEY `idx_documents_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_documents_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_documents_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_accounts`
--

DROP TABLE IF EXISTS `documents_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_accounts` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_accounts_account_id` (`account_id`,`document_id`),
  KEY `documents_accounts_document_id` (`document_id`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_accounts`
--

LOCK TABLES `documents_accounts` WRITE;
/*!40000 ALTER TABLE `documents_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_bugs`
--

DROP TABLE IF EXISTS `documents_bugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_bugs` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `bug_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_bugs_bug_id` (`bug_id`,`document_id`),
  KEY `documents_bugs_document_id` (`document_id`,`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_bugs`
--

LOCK TABLES `documents_bugs` WRITE;
/*!40000 ALTER TABLE `documents_bugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_bugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_cases`
--

DROP TABLE IF EXISTS `documents_cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_cases` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `case_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_cases_case_id` (`case_id`,`document_id`),
  KEY `documents_cases_document_id` (`document_id`,`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_cases`
--

LOCK TABLES `documents_cases` WRITE;
/*!40000 ALTER TABLE `documents_cases` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_contacts`
--

DROP TABLE IF EXISTS `documents_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_contacts` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_contacts_contact_id` (`contact_id`,`document_id`),
  KEY `documents_contacts_document_id` (`document_id`,`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_contacts`
--

LOCK TABLES `documents_contacts` WRITE;
/*!40000 ALTER TABLE `documents_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_opportunities`
--

DROP TABLE IF EXISTS `documents_opportunities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_opportunities` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_docu_opps_oppo_id` (`opportunity_id`,`document_id`),
  KEY `idx_docu_oppo_docu_id` (`document_id`,`opportunity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_opportunities`
--

LOCK TABLES `documents_opportunities` WRITE;
/*!40000 ALTER TABLE `documents_opportunities` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_opportunities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_products`
--

DROP TABLE IF EXISTS `documents_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_products` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `product_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_products_product_id` (`product_id`,`document_id`),
  KEY `documents_products_document_id` (`document_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_products`
--

LOCK TABLES `documents_products` WRITE;
/*!40000 ALTER TABLE `documents_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_quotes`
--

DROP TABLE IF EXISTS `documents_quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_quotes` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `quote_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_quotes_quote_id` (`quote_id`,`document_id`),
  KEY `documents_quotes_document_id` (`document_id`,`quote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_quotes`
--

LOCK TABLES `documents_quotes` WRITE;
/*!40000 ALTER TABLE `documents_quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_revenuelineitems`
--

DROP TABLE IF EXISTS `documents_revenuelineitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents_revenuelineitems` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `document_id` char(36) DEFAULT NULL,
  `rli_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_revenuelineitems_revenuelineitem_id` (`rli_id`,`document_id`),
  KEY `documents_revenuelineitems_document_id` (`document_id`,`rli_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_revenuelineitems`
--

LOCK TABLES `documents_revenuelineitems` WRITE;
/*!40000 ALTER TABLE `documents_revenuelineitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents_revenuelineitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dotbfavorites`
--

DROP TABLE IF EXISTS `dotbfavorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dotbfavorites` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `record_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dotbfavorites_date_modfied` (`date_modified`),
  KEY `idx_dotbfavorites_id_del` (`id`,`deleted`),
  KEY `idx_dotbfavorites_date_entered` (`date_entered`),
  KEY `idx_dotbfavorites_name_del` (`name`,`deleted`),
  KEY `idx_favs_date_entered` (`date_entered`,`deleted`),
  KEY `idx_favs_user_module` (`modified_user_id`,`module`,`deleted`),
  KEY `idx_favs_module_record_deleted` (`module`,`record_id`,`deleted`),
  KEY `idx_favs_id_record_id` (`record_id`,`id`),
  KEY `idx_dotbfavorites_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dotbfavorites`
--

LOCK TABLES `dotbfavorites` WRITE;
/*!40000 ALTER TABLE `dotbfavorites` DISABLE KEYS */;
INSERT INTO `dotbfavorites` VALUES ('6cd0335a5b847ff67434106ec863c5ef',NULL,'2020-10-22 06:54:51','2020-10-22 06:54:51','1','1',NULL,0,'Dashboards','7bd4216e-1433-11eb-8573-00ace43f6d74','1'),('f2adda62cfe08d93efe42cf912a9af9b',NULL,'2020-10-22 06:54:56','2020-10-22 06:54:56','1','1',NULL,0,'Dashboards','7ecfe394-1433-11eb-b10c-00ace43f6d74','1'),('fff87e67098e23624c1bc5350a34cc83',NULL,'2020-10-22 06:56:28','2020-10-22 06:56:28','1','1',NULL,0,'Dashboards','b5f57f28-1433-11eb-94be-00ace43f6d74','1');
/*!40000 ALTER TABLE `dotbfavorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dri_subworkflow_templates`
--

DROP TABLE IF EXISTS `dri_subworkflow_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dri_subworkflow_templates` (
  `id` char(36) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `sort_order` int(8) DEFAULT NULL,
  `points` int(8) DEFAULT NULL,
  `related_activities` int(8) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dri_subworkflow_templates_date_modfied` (`date_modified`),
  KEY `idx_dri_subworkflow_templates_id_del` (`id`,`deleted`),
  KEY `idx_dri_subworkflow_templates_date_entered` (`date_entered`),
  KEY `idx_dri_subworkflow_templates_name_del` (`name`,`deleted`),
  KEY `idx_dri_subworkflow_templates_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_dri_subworkflow_templates_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_cj_stage_tpl_jry_tpl_id` (`dri_workflow_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dri_subworkflow_templates`
--

LOCK TABLES `dri_subworkflow_templates` WRITE;
/*!40000 ALTER TABLE `dri_subworkflow_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `dri_subworkflow_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dri_subworkflows`
--

DROP TABLE IF EXISTS `dri_subworkflows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dri_subworkflows` (
  `id` char(36) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT 'not_started',
  `progress` float DEFAULT '0',
  `momentum_ratio` float DEFAULT '1',
  `score` int(8) DEFAULT NULL,
  `points` int(8) DEFAULT NULL,
  `momentum_points` int(8) DEFAULT '0',
  `momentum_score` int(8) DEFAULT '0',
  `sort_order` int(8) DEFAULT '1',
  `date_started` datetime DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `dri_subworkflow_template_id` char(36) DEFAULT NULL,
  `dri_workflow_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dri_subworkflows_date_modfied` (`date_modified`),
  KEY `idx_dri_subworkflows_id_del` (`id`,`deleted`),
  KEY `idx_dri_subworkflows_date_entered` (`date_entered`),
  KEY `idx_dri_subworkflows_name_del` (`name`,`deleted`),
  KEY `idx_dri_subworkflows_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_dri_subworkflows_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_dri_subworkflows_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_cj_stage_org_tpl_id` (`dri_subworkflow_template_id`),
  KEY `idx_cj_stage_parent_journey_id` (`dri_workflow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dri_subworkflows`
--

LOCK TABLES `dri_subworkflows` WRITE;
/*!40000 ALTER TABLE `dri_subworkflows` DISABLE KEYS */;
/*!40000 ALTER TABLE `dri_subworkflows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dri_subworkflows_audit`
--

DROP TABLE IF EXISTS `dri_subworkflows_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dri_subworkflows_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_dri_subworkflows_audit_parent_id` (`parent_id`),
  KEY `idx_dri_subworkflows_audit_event_id` (`event_id`),
  KEY `idx_dri_subworkflows_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_dri_subworkflows_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dri_subworkflows_audit`
--

LOCK TABLES `dri_subworkflows_audit` WRITE;
/*!40000 ALTER TABLE `dri_subworkflows_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `dri_subworkflows_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dri_workflow_task_templates`
--

DROP TABLE IF EXISTS `dri_workflow_task_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dri_workflow_task_templates` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `task_due_date_type` varchar(255) DEFAULT NULL,
  `momentum_start_type` varchar(255) DEFAULT NULL,
  `due_date_module` varchar(255) DEFAULT NULL,
  `due_date_field` varchar(255) DEFAULT NULL,
  `momentum_start_module` varchar(255) DEFAULT NULL,
  `momentum_start_field` varchar(255) DEFAULT NULL,
  `priority` varchar(100) DEFAULT 'Medium',
  `type` varchar(255) DEFAULT 'customer_task',
  `activity_type` varchar(255) DEFAULT 'Tasks',
  `duration_minutes` varchar(2) DEFAULT '0',
  `direction` varchar(100) DEFAULT 'Outbound',
  `points` int(3) DEFAULT '10',
  `momentum_points` int(8) DEFAULT '100',
  `send_invites` varchar(255) DEFAULT 'none',
  `time_of_day` varchar(255) DEFAULT '12:00',
  `sort_order` varchar(255) DEFAULT NULL,
  `task_due_days` int(8) DEFAULT NULL,
  `momentum_due_days` int(8) DEFAULT NULL,
  `momentum_due_hours` int(8) DEFAULT NULL,
  `duration_hours` int(3) DEFAULT '1',
  `is_parent` tinyint(1) DEFAULT '0',
  `blocked_by` text,
  `dri_subworkflow_template_id` char(36) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `blocked_by_id` char(36) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `target_assignee` varchar(255) DEFAULT 'inherit',
  `assignee_rule` varchar(255) DEFAULT 'inherit',
  `url` varchar(255) DEFAULT NULL,
  `target_assignee_user_id` char(36) DEFAULT NULL,
  `target_assignee_team_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dri_workflow_task_templates_date_modfied` (`date_modified`),
  KEY `idx_dri_workflow_task_templates_id_del` (`id`,`deleted`),
  KEY `idx_dri_workflow_task_templates_date_entered` (`date_entered`),
  KEY `idx_dri_workflow_task_templates_name_del` (`name`,`deleted`),
  KEY `idx_dri_workflow_task_templates_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_dri_workflow_task_templates_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_cj_act_tpl_stage_tpl_id` (`dri_subworkflow_template_id`),
  KEY `idx_cj_act_tpl_jry_tpl_id` (`dri_workflow_template_id`),
  KEY `idx_cj_act_tpl_blocked_by_id` (`blocked_by_id`),
  KEY `idx_cj_act_tpl_parent_id` (`parent_id`),
  KEY `idx_cj_act_tpl_trgt_asgn_us_id` (`target_assignee_user_id`),
  KEY `idx_cj_act_tpl_trgt_asgn_te_id` (`target_assignee_team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dri_workflow_task_templates`
--

LOCK TABLES `dri_workflow_task_templates` WRITE;
/*!40000 ALTER TABLE `dri_workflow_task_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `dri_workflow_task_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dri_workflow_templates`
--

DROP TABLE IF EXISTS `dri_workflow_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dri_workflow_templates` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `available_modules` text,
  `disabled_stage_actions` text,
  `disabled_activity_actions` text,
  `points` int(8) DEFAULT NULL,
  `related_activities` int(8) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `assignee_rule` varchar(255) DEFAULT 'stage_start',
  `target_assignee` varchar(255) DEFAULT 'current_user',
  `copied_template_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dri_workflow_templates_date_modfied` (`date_modified`),
  KEY `idx_dri_workflow_templates_id_del` (`id`,`deleted`),
  KEY `idx_dri_workflow_templates_date_entered` (`date_entered`),
  KEY `idx_dri_workflow_templates_name_del` (`name`,`deleted`),
  KEY `idx_dri_workflow_templates_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_dri_workflow_templates_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_cj_jry_tpl_copied_tpl_id` (`copied_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dri_workflow_templates`
--

LOCK TABLES `dri_workflow_templates` WRITE;
/*!40000 ALTER TABLE `dri_workflow_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `dri_workflow_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dri_workflows`
--

DROP TABLE IF EXISTS `dri_workflows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dri_workflows` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `lead_id` char(36) DEFAULT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `case_id` char(36) DEFAULT NULL,
  `available_modules` text,
  `state` varchar(255) DEFAULT 'not_started',
  `assignee_rule` varchar(255) DEFAULT 'stage_start',
  `target_assignee` varchar(255) DEFAULT 'current_user',
  `progress` float DEFAULT '0',
  `momentum_ratio` float DEFAULT '1',
  `score` int(8) DEFAULT NULL,
  `points` int(8) DEFAULT NULL,
  `momentum_points` int(8) DEFAULT '0',
  `momentum_score` int(8) DEFAULT '0',
  `parent_id` char(36) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `date_started` datetime DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `current_stage_id` char(36) DEFAULT NULL,
  `archived` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_dri_workflows_date_modfied` (`date_modified`),
  KEY `idx_dri_workflows_id_del` (`id`,`deleted`),
  KEY `idx_dri_workflows_date_entered` (`date_entered`),
  KEY `idx_dri_workflows_name_del` (`name`,`deleted`),
  KEY `idx_dri_workflows_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_dri_workflows_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_dri_workflows_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_cj_jry_account_id` (`account_id`),
  KEY `idx_cj_jry_contact_id` (`contact_id`),
  KEY `idx_cj_jry_lead_id` (`lead_id`),
  KEY `idx_cj_jry_opportunity_id` (`opportunity_id`),
  KEY `idx_cj_jry_case_id` (`case_id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_cj_journey_tpl_id` (`dri_workflow_template_id`),
  KEY `idx_cj_jry_current_stage_id` (`current_stage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dri_workflows`
--

LOCK TABLES `dri_workflows` WRITE;
/*!40000 ALTER TABLE `dri_workflows` DISABLE KEYS */;
/*!40000 ALTER TABLE `dri_workflows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dri_workflows_audit`
--

DROP TABLE IF EXISTS `dri_workflows_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dri_workflows_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_dri_workflows_audit_parent_id` (`parent_id`),
  KEY `idx_dri_workflows_audit_event_id` (`event_id`),
  KEY `idx_dri_workflows_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_dri_workflows_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dri_workflows_audit`
--

LOCK TABLES `dri_workflows_audit` WRITE;
/*!40000 ALTER TABLE `dri_workflows_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `dri_workflows_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eapm`
--

DROP TABLE IF EXISTS `eapm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eapm` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `application` varchar(100) DEFAULT 'webex',
  `api_data` text,
  `consumer_key` varchar(255) DEFAULT NULL,
  `consumer_secret` varchar(255) DEFAULT NULL,
  `oauth_token` varchar(255) DEFAULT NULL,
  `oauth_secret` varchar(255) DEFAULT NULL,
  `validated` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_eapm_date_modfied` (`date_modified`),
  KEY `idx_eapm_id_del` (`id`,`deleted`),
  KEY `idx_eapm_date_entered` (`date_entered`),
  KEY `idx_eapm_name_del` (`name`,`deleted`),
  KEY `idx_app_active` (`assigned_user_id`,`application`,`validated`),
  KEY `idx_eapm_name` (`name`),
  KEY `idx_eapm_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eapm`
--

LOCK TABLES `eapm` WRITE;
/*!40000 ALTER TABLE `eapm` DISABLE KEYS */;
/*!40000 ALTER TABLE `eapm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_addr_bean_rel`
--

DROP TABLE IF EXISTS `email_addr_bean_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_addr_bean_rel` (
  `id` char(36) NOT NULL,
  `email_address_id` char(36) NOT NULL,
  `bean_id` char(36) NOT NULL,
  `bean_module` varchar(100) DEFAULT NULL,
  `primary_address` tinyint(1) DEFAULT '0',
  `reply_to_address` tinyint(1) DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_email_address_id` (`email_address_id`),
  KEY `idx_bean_id` (`bean_id`,`bean_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_addr_bean_rel`
--

LOCK TABLES `email_addr_bean_rel` WRITE;
/*!40000 ALTER TABLE `email_addr_bean_rel` DISABLE KEYS */;
INSERT INTO `email_addr_bean_rel` VALUES ('32d4b0b2-369c-11e9-9115-00e04c360044','32d41652-369c-11e9-95c4-00e04c360044','1','Users',1,0,'2019-02-22 12:20:10','2019-02-22 12:20:10',1),('4778caf2-36b6-11e9-8df7-00e04c360044','47754760-36b6-11e9-8e0a-00e04c360044','4764ea14-36b6-11e9-9343-00e04c360044','Users',1,0,'2019-02-22 15:26:51','2019-02-22 15:26:51',0);
/*!40000 ALTER TABLE `email_addr_bean_rel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_addresses`
--

DROP TABLE IF EXISTS `email_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_addresses` (
  `id` char(36) NOT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `email_address_caps` varchar(255) DEFAULT NULL,
  `invalid_email` tinyint(1) DEFAULT '0',
  `opt_out` tinyint(1) DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `confirmation_requested_on` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_ea_caps_opt_out_invalid` (`email_address_caps`,`opt_out`,`invalid_email`),
  KEY `idx_ea_opt_out_invalid` (`email_address`,`opt_out`,`invalid_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_addresses`
--

LOCK TABLES `email_addresses` WRITE;
/*!40000 ALTER TABLE `email_addresses` DISABLE KEYS */;
INSERT INTO `email_addresses` VALUES ('32d41652-369c-11e9-95c4-00e04c360044','test@as.com','TEST@AS.COM',0,0,'2019-02-22 12:20:10','2019-02-22 12:20:10',NULL,0),('47754760-36b6-11e9-8e0a-00e04c360044','test@gmail.com','TEST@GMAIL.COM',0,0,'2019-02-22 15:26:51','2019-02-22 15:26:51',NULL,0),('adff8332-3699-11e9-8cc0-00e04c360044','do_not_reply@example.com','DO_NOT_REPLY@EXAMPLE.COM',0,0,'2019-02-22 12:01:29','2019-02-22 12:01:29',NULL,0);
/*!40000 ALTER TABLE `email_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_addresses_audit`
--

DROP TABLE IF EXISTS `email_addresses_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_addresses_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_email_addresses_audit_parent_id` (`parent_id`),
  KEY `idx_email_addresses_audit_event_id` (`event_id`),
  KEY `idx_email_addresses_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_email_addresses_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_addresses_audit`
--

LOCK TABLES `email_addresses_audit` WRITE;
/*!40000 ALTER TABLE `email_addresses_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_addresses_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_cache`
--

DROP TABLE IF EXISTS `email_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_cache` (
  `ie_id` char(36) DEFAULT NULL,
  `mbox` varchar(60) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `fromaddr` varchar(100) DEFAULT NULL,
  `toaddr` varchar(255) DEFAULT NULL,
  `senddate` datetime DEFAULT NULL,
  `message_id` varchar(255) DEFAULT NULL,
  `mailsize` int(10) unsigned DEFAULT NULL,
  `imap_uid` int(10) unsigned DEFAULT NULL,
  `msgno` int(10) unsigned DEFAULT NULL,
  `recent` tinyint(4) DEFAULT NULL,
  `flagged` tinyint(4) DEFAULT NULL,
  `answered` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `seen` tinyint(4) DEFAULT NULL,
  `draft` tinyint(4) DEFAULT NULL,
  KEY `idx_ie_id` (`ie_id`),
  KEY `idx_mail_date` (`ie_id`,`mbox`,`senddate`),
  KEY `idx_mail_from` (`ie_id`,`mbox`,`fromaddr`),
  KEY `idx_mail_subj` (`subject`),
  KEY `idx_mail_to` (`toaddr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_cache`
--

LOCK TABLES `email_cache` WRITE;
/*!40000 ALTER TABLE `email_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_marketing`
--

DROP TABLE IF EXISTS `email_marketing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_marketing` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `from_name` varchar(100) DEFAULT NULL,
  `from_addr` varchar(100) DEFAULT NULL,
  `reply_to_name` varchar(100) DEFAULT NULL,
  `reply_to_addr` varchar(100) DEFAULT NULL,
  `inbound_email_id` char(36) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `template_id` char(36) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `all_prospect_lists` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_emmkt_name` (`name`),
  KEY `idx_emmkit_del` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_marketing`
--

LOCK TABLES `email_marketing` WRITE;
/*!40000 ALTER TABLE `email_marketing` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_marketing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_marketing_prospect_lists`
--

DROP TABLE IF EXISTS `email_marketing_prospect_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_marketing_prospect_lists` (
  `id` char(36) NOT NULL,
  `prospect_list_id` char(36) DEFAULT NULL,
  `email_marketing_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email_mp_prospects` (`email_marketing_id`,`prospect_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_marketing_prospect_lists`
--

LOCK TABLES `email_marketing_prospect_lists` WRITE;
/*!40000 ALTER TABLE `email_marketing_prospect_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_marketing_prospect_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_templates` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `published` varchar(3) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `body_html` text,
  `deleted` tinyint(1) DEFAULT '0',
  `base_module` varchar(50) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_address` varchar(255) DEFAULT NULL,
  `text_only` tinyint(1) DEFAULT '0',
  `type` varchar(255) DEFAULT 'email',
  `has_variables` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `survey_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email_template_name` (`name`),
  KEY `idx_emailtemplate_type` (`type`),
  KEY `idx_emailtemplate_date_modified` (`date_modified`),
  KEY `idx_emailtemplate_date_entered` (`date_entered`),
  KEY `idx_email_templates_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_email_templates_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_email_templates_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES ('ecc01028-3699-11e9-b9b2-00e04c360044','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1','off','System-generated password email','This template is used when the System Administrator sends a new password to a user.','New account information','\nHere is your account username and temporary password:\nUsername : $contact_user_user_name\nPassword : $contact_user_user_hash\n\n$config_site_url\n\nAfter you log in using the above password, you may be required to reset the password to one of your own choice.','<div><table width=\"550\"><tbody><tr><td><p>Here is your account username and temporary password:</p><p>Username : $contact_user_user_name </p><p>Password : $contact_user_user_hash </p><br /><p><a href=\"$config_site_url\">$config_site_url</a></p><br /><p>After you log in using the above password, you may be required to reset the password to one of your own choice.</p> </td> </tr><tr><td></td> </tr> </tbody></table> </div>',0,NULL,NULL,NULL,0,'system',1,NULL,'ae2e9190-3699-11e9-96bf-00e04c360044','ae2e9190-3699-11e9-96bf-00e04c360044',NULL,NULL),('ecc64114-3699-11e9-a5b6-00e04c360044','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1','off','Forgot Password email','This template is used to send a user a link to click to reset the user\'s account password.','Reset your account password','\nYou recently requested on $contact_user_pwd_last_changed to be able to reset your account password.\n\nClick on the link below to reset your password:\n\n$contact_user_link_guid','<div><table width=\"550\"><tbody><tr><td><p>You recently requested on $contact_user_pwd_last_changed to be able to reset your account password. </p><p>Click on the link below to reset your password:</p><p> <a href=\"$contact_user_link_guid\">$contact_user_link_guid</a> </p> </td> </tr><tr><td></td> </tr> </tbody></table> </div>',0,NULL,NULL,NULL,0,'system',1,NULL,'ae2e9190-3699-11e9-96bf-00e04c360044','ae2e9190-3699-11e9-96bf-00e04c360044',NULL,NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailman`
--

DROP TABLE IF EXISTS `emailman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailman` (
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` char(36) DEFAULT NULL,
  `marketing_id` char(36) DEFAULT NULL,
  `list_id` char(36) DEFAULT NULL,
  `send_date_time` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `in_queue` tinyint(1) DEFAULT '0',
  `in_queue_date` datetime DEFAULT NULL,
  `send_attempts` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `related_id` char(36) DEFAULT NULL,
  `related_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_eman_list` (`list_id`,`user_id`,`deleted`),
  KEY `idx_eman_campaign_id` (`campaign_id`),
  KEY `idx_eman_relid_reltype_id` (`related_id`,`related_type`,`campaign_id`),
  KEY `idx_emailman_send_date_time` (`send_date_time`),
  KEY `idx_emailman_send_attempts` (`send_attempts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailman`
--

LOCK TABLES `emailman` WRITE;
/*!40000 ALTER TABLE `emailman` DISABLE KEYS */;
/*!40000 ALTER TABLE `emailman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_sent` datetime DEFAULT NULL,
  `message_id` varchar(255) DEFAULT NULL,
  `message_uid` varchar(64) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `flagged` tinyint(1) DEFAULT '0',
  `reply_to_status` tinyint(1) DEFAULT '0',
  `intent` varchar(100) DEFAULT 'pick',
  `mailbox_id` char(36) DEFAULT NULL,
  `state` varchar(100) NOT NULL DEFAULT 'Archived',
  `reply_to_id` char(36) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `total_attachments` int(11) DEFAULT NULL,
  `outbound_email_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email_name` (`name`),
  KEY `idx_message_id` (`message_id`),
  KEY `idx_email_parent_id` (`parent_id`),
  KEY `idx_email_assigned` (`assigned_user_id`,`type`,`status`),
  KEY `idx_date_modified` (`date_modified`),
  KEY `idx_state` (`state`,`id`),
  KEY `idx_mailbox_id` (`mailbox_id`),
  KEY `idx_emails_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_emails_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails_beans`
--

DROP TABLE IF EXISTS `emails_beans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_beans` (
  `id` char(36) NOT NULL,
  `email_id` char(36) DEFAULT NULL,
  `bean_id` char(36) DEFAULT NULL,
  `bean_module` varchar(100) DEFAULT NULL,
  `campaign_data` text,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_emails_beans_bean_id` (`bean_id`),
  KEY `idx_emails_beans_email_bean` (`email_id`,`bean_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_beans`
--

LOCK TABLES `emails_beans` WRITE;
/*!40000 ALTER TABLE `emails_beans` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails_beans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails_email_addr_rel`
--

DROP TABLE IF EXISTS `emails_email_addr_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_email_addr_rel` (
  `id` char(36) NOT NULL,
  `email_id` char(36) DEFAULT NULL,
  `address_type` varchar(4) DEFAULT NULL,
  `email_address_id` char(36) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_eearl_email_id` (`email_id`,`address_type`),
  KEY `idx_eearl_email_address_deleted` (`email_address_id`,`deleted`),
  KEY `idx_eearl_email_address_role` (`email_address_id`,`address_type`,`deleted`),
  KEY `idx_eearl_parent` (`parent_type`,`parent_id`,`deleted`),
  KEY `idx_eearl_parent_role` (`parent_type`,`parent_id`,`address_type`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_email_addr_rel`
--

LOCK TABLES `emails_email_addr_rel` WRITE;
/*!40000 ALTER TABLE `emails_email_addr_rel` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails_email_addr_rel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails_text`
--

DROP TABLE IF EXISTS `emails_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_text` (
  `email_id` char(36) NOT NULL,
  `from_addr` varchar(255) DEFAULT NULL,
  `reply_to_addr` varchar(255) DEFAULT NULL,
  `to_addrs` text,
  `cc_addrs` text,
  `bcc_addrs` text,
  `description` longtext,
  `description_html` longtext,
  `raw_source` longtext,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`email_id`),
  KEY `emails_textfromaddr` (`from_addr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_text`
--

LOCK TABLES `emails_text` WRITE;
/*!40000 ALTER TABLE `emails_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `embedded_files`
--

DROP TABLE IF EXISTS `embedded_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `embedded_files` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `filename` varchar(255) DEFAULT NULL,
  `file_mime_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_embedded_files_date_modfied` (`date_modified`),
  KEY `idx_embedded_files_id_del` (`id`,`deleted`),
  KEY `idx_embedded_files_date_entered` (`date_entered`),
  KEY `idx_embedded_files_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embedded_files`
--

LOCK TABLES `embedded_files` WRITE;
/*!40000 ALTER TABLE `embedded_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `embedded_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `erased_fields`
--

DROP TABLE IF EXISTS `erased_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `erased_fields` (
  `bean_id` char(36) NOT NULL,
  `table_name` varchar(128) NOT NULL,
  `data` text,
  PRIMARY KEY (`bean_id`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erased_fields`
--

LOCK TABLES `erased_fields` WRITE;
/*!40000 ALTER TABLE `erased_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `erased_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expressions`
--

DROP TABLE IF EXISTS `expressions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expressions` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `lhs_type` varchar(15) DEFAULT NULL,
  `lhs_field` varchar(50) DEFAULT NULL,
  `lhs_module` varchar(50) DEFAULT NULL,
  `lhs_value` varchar(100) DEFAULT NULL,
  `lhs_group_type` varchar(10) DEFAULT NULL,
  `operator` varchar(15) DEFAULT NULL,
  `rhs_group_type` varchar(10) DEFAULT NULL,
  `rhs_type` varchar(15) DEFAULT NULL,
  `rhs_field` varchar(50) DEFAULT NULL,
  `rhs_module` varchar(50) DEFAULT NULL,
  `rhs_value` varchar(255) DEFAULT NULL,
  `parent_id` char(36) NOT NULL,
  `exp_type` varchar(100) DEFAULT NULL,
  `exp_order` int(4) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_exp_id` char(36) DEFAULT NULL,
  `parent_exp_side` int(8) DEFAULT NULL,
  `ext1` varchar(50) DEFAULT NULL,
  `ext2` varchar(50) DEFAULT NULL,
  `ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_exp` (`parent_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expressions`
--

LOCK TABLES `expressions` WRITE;
/*!40000 ALTER TABLE `expressions` DISABLE KEYS */;
/*!40000 ALTER TABLE `expressions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fields_meta_data`
--

DROP TABLE IF EXISTS `fields_meta_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields_meta_data` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `vname` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `help` varchar(255) DEFAULT NULL,
  `custom_module` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `len` int(11) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '0',
  `default_value` varchar(255) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `audited` tinyint(1) DEFAULT '0',
  `massupdate` tinyint(1) DEFAULT '0',
  `duplicate_merge` smallint(6) DEFAULT '0',
  `reportable` tinyint(1) DEFAULT '1',
  `importable` varchar(255) DEFAULT NULL,
  `ext1` varchar(255) DEFAULT '',
  `ext2` varchar(255) DEFAULT '',
  `ext3` varchar(255) DEFAULT '',
  `ext4` text,
  PRIMARY KEY (`id`),
  KEY `idx_meta_id_del` (`id`,`deleted`),
  KEY `idx_meta_cm_del` (`custom_module`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields_meta_data`
--

LOCK TABLES `fields_meta_data` WRITE;
/*!40000 ALTER TABLE `fields_meta_data` DISABLE KEYS */;
INSERT INTO `fields_meta_data` VALUES ('Callscall_destination_c','call_destination_c','LBL_CALL_DESTINATION_C',NULL,NULL,'Calls','varchar',150,0,NULL,'2019-02-27 16:03:21',0,0,0,0,1,'true',NULL,NULL,NULL,NULL),('Callscall_duration_minute_c','call_duration_minute_c','LBL_CALL_DURATION_MINUTE_C',NULL,NULL,'Calls','varchar',150,0,NULL,'2019-02-27 15:53:50',0,0,0,0,1,'true',NULL,NULL,NULL,NULL),('Callscall_entrysource_c','call_entrysource_c','LBL_CALL_ENTRYSOURCE_C',NULL,NULL,'Calls','varchar',150,0,NULL,'2019-02-27 15:54:59',0,0,0,0,1,'true',NULL,NULL,NULL,NULL),('Callscall_source_c','call_source_c','LBL_CALL_SOURCE_C',NULL,NULL,'Calls','varchar',150,0,NULL,'2019-02-27 15:51:17',0,0,0,0,1,'true',NULL,NULL,NULL,NULL),('Callsrecord_c','record_c','LBL_RECORD_C',NULL,NULL,'Calls','url',255,0,NULL,'2019-02-27 15:57:32',0,0,0,0,1,'true',NULL,NULL,'0','_blank'),('Usersasteriskname_c','asteriskname_c','LBL_ASTERISKNAME_C',NULL,NULL,'Users','varchar',255,0,NULL,'2019-02-27 18:18:13',0,0,0,0,1,'true',NULL,NULL,NULL,NULL),('Usersdialout_prefix_c','dialout_prefix_c','LBL_DIALOUT_PREFIX_C',NULL,NULL,'Users','varchar',150,0,NULL,'2019-02-27 18:20:10',0,0,0,0,1,'true',NULL,NULL,NULL,NULL),('Usersdial_plan_c','dial_plan_c','LBL_DIAL_PLAN_C',NULL,NULL,'Users','varchar',255,0,NULL,'2019-02-27 18:19:02',0,0,0,0,1,'true',NULL,NULL,NULL,NULL),('Usersphoneextension_c','phoneextension_c','LBL_PHONEEXTENSION_C',NULL,NULL,'Users','varchar',150,0,NULL,'2019-02-27 18:17:41',0,0,0,0,1,'true',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fields_meta_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filters`
--

DROP TABLE IF EXISTS `filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filters` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `filter_definition` longtext,
  `filter_template` longtext,
  `module_name` varchar(100) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_filters_date_modfied` (`date_modified`),
  KEY `idx_filters_id_del` (`id`,`deleted`),
  KEY `idx_filters_date_entered` (`date_entered`),
  KEY `idx_filters_name_del` (`name`,`deleted`),
  KEY `idx_filters_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_filters_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_filters_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filters`
--

LOCK TABLES `filters` WRITE;
/*!40000 ALTER TABLE `filters` DISABLE KEYS */;
/*!40000 ALTER TABLE `filters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folders`
--

DROP TABLE IF EXISTS `folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folders` (
  `id` char(36) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `folder_type` varchar(25) DEFAULT NULL,
  `parent_folder` char(36) DEFAULT NULL,
  `has_child` tinyint(1) DEFAULT '0',
  `is_group` tinyint(1) DEFAULT '0',
  `is_dynamic` tinyint(1) DEFAULT '0',
  `dynamic_query` text,
  `assign_to_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_parent_folder` (`parent_folder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folders`
--

LOCK TABLES `folders` WRITE;
/*!40000 ALTER TABLE `folders` DISABLE KEYS */;
/*!40000 ALTER TABLE `folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folders_rel`
--

DROP TABLE IF EXISTS `folders_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folders_rel` (
  `id` char(36) NOT NULL,
  `folder_id` char(36) NOT NULL,
  `polymorphic_module` varchar(25) DEFAULT NULL,
  `polymorphic_id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_poly_module_poly_id` (`polymorphic_module`,`polymorphic_id`),
  KEY `idx_fr_id_deleted_poly` (`folder_id`,`deleted`,`polymorphic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folders_rel`
--

LOCK TABLES `folders_rel` WRITE;
/*!40000 ALTER TABLE `folders_rel` DISABLE KEYS */;
/*!40000 ALTER TABLE `folders_rel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folders_subscriptions`
--

DROP TABLE IF EXISTS `folders_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folders_subscriptions` (
  `id` char(36) NOT NULL,
  `folder_id` char(36) NOT NULL,
  `assigned_user_id` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder_id_assigned_user_id` (`folder_id`,`assigned_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folders_subscriptions`
--

LOCK TABLES `folders_subscriptions` WRITE;
/*!40000 ALTER TABLE `folders_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `folders_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forecast_manager_worksheets`
--

DROP TABLE IF EXISTS `forecast_manager_worksheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecast_manager_worksheets` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `quota` decimal(26,6) DEFAULT NULL,
  `best_case` decimal(26,6) DEFAULT NULL,
  `best_case_adjusted` decimal(26,6) DEFAULT NULL,
  `likely_case` decimal(26,6) DEFAULT NULL,
  `likely_case_adjusted` decimal(26,6) DEFAULT NULL,
  `worst_case` decimal(26,6) DEFAULT NULL,
  `worst_case_adjusted` decimal(26,6) DEFAULT NULL,
  `timeperiod_id` char(36) DEFAULT NULL,
  `draft` tinyint(1) DEFAULT '0',
  `user_id` char(36) DEFAULT NULL,
  `opp_count` int(5) DEFAULT NULL,
  `pipeline_opp_count` int(5) DEFAULT '0',
  `pipeline_amount` decimal(26,6) DEFAULT '0.000000',
  `closed_amount` decimal(26,6) DEFAULT '0.000000',
  `manager_saved` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_forecast_manager_worksheets_date_modfied` (`date_modified`),
  KEY `idx_forecast_manager_worksheets_id_del` (`id`,`deleted`),
  KEY `idx_forecast_manager_worksheets_date_entered` (`date_entered`),
  KEY `idx_forecast_manager_worksheets_name_del` (`name`,`deleted`),
  KEY `idx_manager_worksheets_user_timestamp_assigned_user` (`assigned_user_id`,`user_id`,`timeperiod_id`,`draft`,`deleted`),
  KEY `idx_forecast_manager_worksheets_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_forecast_manager_worksheets_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_forecast_manager_worksheets_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forecast_manager_worksheets`
--

LOCK TABLES `forecast_manager_worksheets` WRITE;
/*!40000 ALTER TABLE `forecast_manager_worksheets` DISABLE KEYS */;
/*!40000 ALTER TABLE `forecast_manager_worksheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forecast_manager_worksheets_audit`
--

DROP TABLE IF EXISTS `forecast_manager_worksheets_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecast_manager_worksheets_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_forecast_manager_worksheets_audit_parent_id` (`parent_id`),
  KEY `idx_forecast_manager_worksheets_audit_event_id` (`event_id`),
  KEY `idx_forecast_manager_worksheets_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_forecast_manager_worksheets_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forecast_manager_worksheets_audit`
--

LOCK TABLES `forecast_manager_worksheets_audit` WRITE;
/*!40000 ALTER TABLE `forecast_manager_worksheets_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `forecast_manager_worksheets_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forecast_tree`
--

DROP TABLE IF EXISTS `forecast_tree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecast_tree` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `hierarchy_type` varchar(25) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forecast_tree_idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forecast_tree`
--

LOCK TABLES `forecast_tree` WRITE;
/*!40000 ALTER TABLE `forecast_tree` DISABLE KEYS */;
/*!40000 ALTER TABLE `forecast_tree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forecast_worksheets`
--

DROP TABLE IF EXISTS `forecast_worksheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecast_worksheets` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `parent_id` char(36) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `opportunity_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `campaign_name` varchar(255) DEFAULT NULL,
  `product_template_id` char(36) DEFAULT NULL,
  `product_template_name` varchar(255) DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `sales_status` varchar(255) DEFAULT NULL,
  `likely_case` decimal(26,6) DEFAULT NULL,
  `best_case` decimal(26,6) DEFAULT NULL,
  `worst_case` decimal(26,6) DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `date_closed_timestamp` bigint(20) unsigned DEFAULT NULL,
  `sales_stage` varchar(255) DEFAULT NULL,
  `probability` double DEFAULT NULL,
  `commit_stage` varchar(50) DEFAULT NULL,
  `draft` int(11) DEFAULT '0',
  `next_step` varchar(100) DEFAULT NULL,
  `lead_source` varchar(50) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `list_price` decimal(26,6) DEFAULT NULL,
  `cost_price` decimal(26,6) DEFAULT NULL,
  `discount_price` decimal(26,6) DEFAULT NULL,
  `discount_amount` decimal(26,6) DEFAULT NULL,
  `quantity` int(5) DEFAULT '1',
  `total_amount` decimal(26,6) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_forecast_worksheets_date_modfied` (`date_modified`),
  KEY `idx_forecast_worksheets_id_del` (`id`,`deleted`),
  KEY `idx_forecast_worksheets_date_entered` (`date_entered`),
  KEY `idx_forecast_worksheets_name_del` (`name`,`deleted`),
  KEY `idx_worksheets_parent` (`parent_id`,`parent_type`),
  KEY `idx_worksheets_assigned_del_time_draft_parent_type` (`deleted`,`assigned_user_id`,`draft`,`date_closed_timestamp`,`parent_type`),
  KEY `idx_forecastworksheet_commit_stage` (`commit_stage`),
  KEY `idx_forecastworksheet_sales_stage` (`sales_stage`),
  KEY `idx_forecast_worksheets_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_forecast_worksheets_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_forecast_worksheets_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forecast_worksheets`
--

LOCK TABLES `forecast_worksheets` WRITE;
/*!40000 ALTER TABLE `forecast_worksheets` DISABLE KEYS */;
/*!40000 ALTER TABLE `forecast_worksheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forecasts`
--

DROP TABLE IF EXISTS `forecasts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecasts` (
  `id` char(36) NOT NULL,
  `timeperiod_id` char(36) DEFAULT NULL,
  `forecast_type` varchar(100) DEFAULT NULL,
  `opp_count` int(5) DEFAULT NULL,
  `pipeline_opp_count` int(5) DEFAULT '0',
  `pipeline_amount` decimal(26,6) DEFAULT '0.000000',
  `closed_amount` decimal(26,6) DEFAULT '0.000000',
  `opp_weigh_value` int(11) DEFAULT NULL,
  `best_case` decimal(26,6) DEFAULT NULL,
  `likely_case` decimal(26,6) DEFAULT NULL,
  `worst_case` decimal(26,6) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_forecast_user_tp` (`user_id`,`timeperiod_id`,`date_modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forecasts`
--

LOCK TABLES `forecasts` WRITE;
/*!40000 ALTER TABLE `forecasts` DISABLE KEYS */;
/*!40000 ALTER TABLE `forecasts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fte_usagetracking`
--

DROP TABLE IF EXISTS `fte_usagetracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fte_usagetracking` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `action` varchar(100) DEFAULT '',
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `action_identifier` varchar(255) DEFAULT '',
  `related_module_name` varchar(255) DEFAULT '',
  `platform` varchar(255) DEFAULT 'Desktop',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_fte_usagetracking_date_modfied` (`date_modified`),
  KEY `idx_fte_usagetracking_id_del` (`id`,`deleted`),
  KEY `idx_fte_usagetracking_date_entered` (`date_entered`),
  KEY `idx_fte_usagetracking_name_del` (`name`,`deleted`),
  KEY `idx_fte_usagetracking_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fte_usagetracking`
--

LOCK TABLES `fte_usagetracking` WRITE;
/*!40000 ALTER TABLE `fte_usagetracking` DISABLE KEYS */;
/*!40000 ALTER TABLE `fte_usagetracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fte_usagetracking_audit`
--

DROP TABLE IF EXISTS `fte_usagetracking_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fte_usagetracking_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_fte_usagetracking_audit_parent_id` (`parent_id`),
  KEY `idx_fte_usagetracking_audit_event_id` (`event_id`),
  KEY `idx_fte_usagetracking_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_fte_usagetracking_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fte_usagetracking_audit`
--

LOCK TABLES `fte_usagetracking_audit` WRITE;
/*!40000 ALTER TABLE `fte_usagetracking_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `fte_usagetracking_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fts_queue`
--

DROP TABLE IF EXISTS `fts_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fts_queue` (
  `id` char(36) NOT NULL,
  `bean_id` char(36) DEFAULT NULL,
  `bean_module` varchar(100) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `processed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_beans_bean_id` (`bean_module`,`bean_id`),
  KEY `idx_beans_bean_id_processed` (`bean_module`,`bean_id`,`processed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fts_queue`
--

LOCK TABLES `fts_queue` WRITE;
/*!40000 ALTER TABLE `fts_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `fts_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `holiday_date` date DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `person_id` char(36) DEFAULT NULL,
  `person_type` varchar(255) DEFAULT NULL,
  `related_module` varchar(255) DEFAULT NULL,
  `related_module_id` char(36) DEFAULT NULL,
  `resource_name` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `apply_for` varchar(100) DEFAULT 'All',
  `holidays_range` varchar(100) DEFAULT NULL,
  `public_holiday` varchar(455) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_holiday_id_del` (`id`,`deleted`),
  KEY `idx_holiday_id_rel` (`related_module_id`,`related_module`),
  KEY `idx_holiday_holiday_date` (`holiday_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `import_maps`
--

DROP TABLE IF EXISTS `import_maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `import_maps` (
  `id` char(36) NOT NULL,
  `name` varchar(254) DEFAULT NULL,
  `source` varchar(36) DEFAULT NULL,
  `enclosure` varchar(1) DEFAULT ' ',
  `delimiter` varchar(1) DEFAULT ',',
  `module` varchar(36) DEFAULT NULL,
  `content` text,
  `default_values` text,
  `has_header` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `is_published` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `idx_owner_module_name` (`assigned_user_id`,`module`,`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `import_maps`
--

LOCK TABLES `import_maps` WRITE;
/*!40000 ALTER TABLE `import_maps` DISABLE KEYS */;
/*!40000 ALTER TABLE `import_maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbound_email`
--

DROP TABLE IF EXISTS `inbound_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbound_email` (
  `id` varchar(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Active',
  `server_url` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `email_password` varchar(100) DEFAULT NULL,
  `port` int(5) DEFAULT NULL,
  `service` varchar(50) DEFAULT NULL,
  `mailbox` text,
  `delete_seen` tinyint(1) DEFAULT '0',
  `mailbox_type` varchar(10) DEFAULT NULL,
  `template_id` char(36) DEFAULT NULL,
  `stored_options` text,
  `group_id` char(36) DEFAULT NULL,
  `is_personal` tinyint(1) DEFAULT '0',
  `groupfolder_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_inbound_email_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_inbound_email_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbound_email`
--

LOCK TABLES `inbound_email` WRITE;
/*!40000 ALTER TABLE `inbound_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `inbound_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbound_email_autoreply`
--

DROP TABLE IF EXISTS `inbound_email_autoreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbound_email_autoreply` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `autoreplied_to` varchar(100) DEFAULT NULL,
  `ie_id` char(36) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_ie_autoreplied_to` (`autoreplied_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbound_email_autoreply`
--

LOCK TABLES `inbound_email_autoreply` WRITE;
/*!40000 ALTER TABLE `inbound_email_autoreply` DISABLE KEYS */;
/*!40000 ALTER TABLE `inbound_email_autoreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbound_email_cache_ts`
--

DROP TABLE IF EXISTS `inbound_email_cache_ts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbound_email_cache_ts` (
  `id` varchar(255) NOT NULL,
  `ie_timestamp` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbound_email_cache_ts`
--

LOCK TABLES `inbound_email_cache_ts` WRITE;
/*!40000 ALTER TABLE `inbound_email_cache_ts` DISABLE KEYS */;
/*!40000 ALTER TABLE `inbound_email_cache_ts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_queue`
--

DROP TABLE IF EXISTS `job_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_queue` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `scheduler_id` char(36) DEFAULT NULL,
  `execute_time` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `resolution` varchar(20) DEFAULT NULL,
  `message` text,
  `target` varchar(255) DEFAULT NULL,
  `data` longtext,
  `requeue` tinyint(1) DEFAULT '0',
  `retry_count` tinyint(4) DEFAULT NULL,
  `failure_count` tinyint(4) DEFAULT NULL,
  `job_delay` int(11) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `percent_complete` int(11) DEFAULT NULL,
  `job_group` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `fallible` tinyint(1) DEFAULT '0',
  `rerun` tinyint(1) DEFAULT '0',
  `interface` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_status_scheduler` (`status`,`scheduler_id`),
  KEY `idx_status_time` (`status`,`execute_time`,`date_entered`),
  KEY `idx_status_entered` (`status`,`date_entered`),
  KEY `idx_status_modified` (`status`,`date_modified`),
  KEY `idx_group_status` (`job_group`,`status`),
  KEY `idx_job_queue_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_queue`
--

LOCK TABLES `job_queue` WRITE;
/*!40000 ALTER TABLE `job_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_queue_audit`
--

DROP TABLE IF EXISTS `job_queue_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_queue_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_job_queue_audit_parent_id` (`parent_id`),
  KEY `idx_job_queue_audit_event_id` (`event_id`),
  KEY `idx_job_queue_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_job_queue_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_queue_audit`
--

LOCK TABLES `job_queue_audit` WRITE;
/*!40000 ALTER TABLE `job_queue_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_queue_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kbarticles`
--

DROP TABLE IF EXISTS `kbarticles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kbarticles` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `kbdocument_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kbarticles_date_modfied` (`date_modified`),
  KEY `idx_kbarticles_id_del` (`id`,`deleted`),
  KEY `idx_kbarticles_date_entered` (`date_entered`),
  KEY `idx_kbarticles_name_del` (`name`,`deleted`),
  KEY `idx_kbarticles_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_kbarticles_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_kbarticles_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kbarticles`
--

LOCK TABLES `kbarticles` WRITE;
/*!40000 ALTER TABLE `kbarticles` DISABLE KEYS */;
/*!40000 ALTER TABLE `kbarticles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kbcontent_templates`
--

DROP TABLE IF EXISTS `kbcontent_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kbcontent_templates` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `body` longtext,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kbcontent_templates_date_modfied` (`date_modified`),
  KEY `idx_kbcontent_templates_id_del` (`id`,`deleted`),
  KEY `idx_kbcontent_templates_date_entered` (`date_entered`),
  KEY `idx_kbcontent_templates_name_del` (`name`,`deleted`),
  KEY `idx_kbcontent_templates_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_kbcontent_templates_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kbcontent_templates`
--

LOCK TABLES `kbcontent_templates` WRITE;
/*!40000 ALTER TABLE `kbcontent_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `kbcontent_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kbcontent_templates_audit`
--

DROP TABLE IF EXISTS `kbcontent_templates_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kbcontent_templates_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_kbcontent_templates_audit_parent_id` (`parent_id`),
  KEY `idx_kbcontent_templates_audit_event_id` (`event_id`),
  KEY `idx_kbcontent_templates_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_kbcontent_templates_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kbcontent_templates_audit`
--

LOCK TABLES `kbcontent_templates_audit` WRITE;
/*!40000 ALTER TABLE `kbcontent_templates_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `kbcontent_templates_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kbcontents`
--

DROP TABLE IF EXISTS `kbcontents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kbcontents` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `kbdocument_body` longtext,
  `language` varchar(2) DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `status` varchar(100) DEFAULT 'draft',
  `viewcount` int(11) DEFAULT '0',
  `revision` int(11) DEFAULT '0',
  `useful` int(11) DEFAULT '0',
  `notuseful` int(11) DEFAULT '0',
  `kbdocument_id` char(36) DEFAULT NULL,
  `active_rev` tinyint(4) DEFAULT '0',
  `is_external` tinyint(1) DEFAULT '0',
  `kbarticle_id` char(36) DEFAULT NULL,
  `kbsapprover_id` char(36) DEFAULT NULL,
  `kbscase_id` char(36) DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kbcontents_date_modfied` (`date_modified`),
  KEY `idx_kbcontents_id_del` (`id`,`deleted`),
  KEY `idx_kbcontents_date_entered` (`date_entered`),
  KEY `idx_kbcontents_name_del` (`name`,`deleted`),
  KEY `idx_kbcontent_name` (`name`),
  KEY `idx_kbcontent_del_doc_id` (`kbdocument_id`,`deleted`),
  KEY `idx_kbcontents_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_kbcontents_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_kbcontents_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kbcontents`
--

LOCK TABLES `kbcontents` WRITE;
/*!40000 ALTER TABLE `kbcontents` DISABLE KEYS */;
/*!40000 ALTER TABLE `kbcontents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kbcontents_audit`
--

DROP TABLE IF EXISTS `kbcontents_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kbcontents_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_kbcontents_audit_parent_id` (`parent_id`),
  KEY `idx_kbcontents_audit_event_id` (`event_id`),
  KEY `idx_kbcontents_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_kbcontents_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kbcontents_audit`
--

LOCK TABLES `kbcontents_audit` WRITE;
/*!40000 ALTER TABLE `kbcontents_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `kbcontents_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kbdocuments`
--

DROP TABLE IF EXISTS `kbdocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kbdocuments` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kbdocuments_date_modfied` (`date_modified`),
  KEY `idx_kbdocuments_id_del` (`id`,`deleted`),
  KEY `idx_kbdocuments_date_entered` (`date_entered`),
  KEY `idx_kbdocuments_name_del` (`name`,`deleted`),
  KEY `idx_kbdocuments_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_kbdocuments_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_kbdocuments_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kbdocuments`
--

LOCK TABLES `kbdocuments` WRITE;
/*!40000 ALTER TABLE `kbdocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `kbdocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kbusefulness`
--

DROP TABLE IF EXISTS `kbusefulness`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kbusefulness` (
  `id` char(36) NOT NULL,
  `kbarticle_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `vote` smallint(6) DEFAULT NULL,
  `zeroflag` tinyint(4) DEFAULT NULL,
  `ssid` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kbusefulness_user` (`kbarticle_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kbusefulness`
--

LOCK TABLES `kbusefulness` WRITE;
/*!40000 ALTER TABLE `kbusefulness` DISABLE KEYS */;
/*!40000 ALTER TABLE `kbusefulness` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `key_value_cache`
--

DROP TABLE IF EXISTS `key_value_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `key_value_cache` (
  `id` char(32) NOT NULL,
  `date_expires` datetime DEFAULT NULL,
  `value` longtext,
  PRIMARY KEY (`id`),
  KEY `key_value_cache_date_expires` (`date_expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `key_value_cache`
--

LOCK TABLES `key_value_cache` WRITE;
/*!40000 ALTER TABLE `key_value_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `key_value_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `salutation` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `googleplus` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `do_not_call` tinyint(1) DEFAULT '0',
  `phone_home` varchar(100) DEFAULT NULL,
  `phone_mobile` varchar(100) DEFAULT NULL,
  `phone_work` varchar(100) DEFAULT NULL,
  `phone_other` varchar(100) DEFAULT NULL,
  `phone_fax` varchar(100) DEFAULT NULL,
  `primary_address_street` varchar(150) DEFAULT NULL,
  `primary_address_city` varchar(100) DEFAULT NULL,
  `primary_address_state` varchar(100) DEFAULT NULL,
  `primary_address_postalcode` varchar(20) DEFAULT NULL,
  `primary_address_country` varchar(255) DEFAULT NULL,
  `alt_address_street` varchar(150) DEFAULT NULL,
  `alt_address_city` varchar(100) DEFAULT NULL,
  `alt_address_state` varchar(100) DEFAULT NULL,
  `alt_address_postalcode` varchar(20) DEFAULT NULL,
  `alt_address_country` varchar(255) DEFAULT NULL,
  `assistant` varchar(75) DEFAULT NULL,
  `assistant_phone` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `converted` tinyint(1) DEFAULT '0',
  `refered_by` varchar(100) DEFAULT NULL,
  `lead_source` varchar(100) DEFAULT NULL,
  `lead_source_description` text,
  `status` varchar(100) DEFAULT 'New',
  `status_description` text,
  `reports_to_id` char(36) DEFAULT NULL,
  `dp_business_purpose` text,
  `dp_consent_last_updated` date DEFAULT NULL,
  `dnb_principal_id` varchar(30) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_description` text,
  `contact_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `opportunity_name` varchar(255) DEFAULT NULL,
  `opportunity_amount` varchar(50) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `portal_name` varchar(255) DEFAULT NULL,
  `portal_app` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `preferred_language` varchar(255) DEFAULT NULL,
  `mkto_sync` tinyint(1) DEFAULT '0',
  `mkto_id` int(11) DEFAULT NULL,
  `mkto_lead_score` int(11) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `pri_latitude` decimal(20,12) DEFAULT NULL,
  `pri_longitude` decimal(20,12) DEFAULT NULL,
  `alt_latitude` decimal(20,12) DEFAULT NULL,
  `alt_longitude` decimal(20,12) DEFAULT NULL,
  `last_call_status` varchar(100) DEFAULT '',
  `last_call_date` datetime DEFAULT NULL,
  `utm_source` varchar(20) DEFAULT NULL,
  `address_state_2` varchar(255) DEFAULT NULL,
  `address_city_2` varchar(255) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT '',
  `institution_type` varchar(100) DEFAULT '',
  `employees` varchar(100) DEFAULT '',
  `question_comment` text,
  `channel` text,
  `prefer_product` text,
  `trail_domain` varchar(100) DEFAULT NULL,
  `username_demo` varchar(100) DEFAULT NULL,
  `password_demo` varchar(100) DEFAULT NULL,
  `international_name` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `business_code` varchar(50) DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_leads_date_modfied` (`date_modified`),
  KEY `idx_leads_id_del` (`id`,`deleted`),
  KEY `idx_leads_date_entered` (`date_entered`),
  KEY `idx_leads_last_first` (`last_name`,`first_name`,`deleted`),
  KEY `idx_leads_first_last` (`first_name`,`last_name`,`deleted`),
  KEY `idx_lead_acct_name_first` (`account_name`,`deleted`),
  KEY `idx_lead_del_stat` (`last_name`,`status`,`deleted`,`first_name`),
  KEY `idx_lead_opp_del` (`opportunity_id`,`deleted`),
  KEY `idx_leads_acct_del` (`account_id`,`deleted`),
  KEY `idx_lead_assigned` (`assigned_user_id`),
  KEY `idx_lead_contact` (`contact_id`),
  KEY `idx_reports_to` (`reports_to_id`),
  KEY `idx_lead_phone_work` (`phone_work`),
  KEY `idx_lead_mkto_id` (`mkto_id`),
  KEY `idx_leads_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_leads_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_leads_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_leads_cjtpl_id` (`dri_workflow_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_audit`
--

DROP TABLE IF EXISTS `leads_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_leads_audit_parent_id` (`parent_id`),
  KEY `idx_leads_audit_event_id` (`event_id`),
  KEY `idx_leads_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_leads_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_audit`
--

LOCK TABLES `leads_audit` WRITE;
/*!40000 ALTER TABLE `leads_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_dataprivacy`
--

DROP TABLE IF EXISTS `leads_dataprivacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads_dataprivacy` (
  `id` char(36) NOT NULL,
  `lead_id` char(36) DEFAULT NULL,
  `dataprivacy_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_lead_dataprivacy_lead` (`lead_id`),
  KEY `idx_lead_dataprivacy_dataprivacy` (`dataprivacy_id`),
  KEY `idx_leads_dataprivacy` (`lead_id`,`dataprivacy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_dataprivacy`
--

LOCK TABLES `leads_dataprivacy` WRITE;
/*!40000 ALTER TABLE `leads_dataprivacy` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads_dataprivacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linked_documents`
--

DROP TABLE IF EXISTS `linked_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linked_documents` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `parent_type` varchar(25) DEFAULT NULL,
  `document_id` char(36) DEFAULT NULL,
  `document_revision_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_parent_document` (`parent_type`,`parent_id`,`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linked_documents`
--

LOCK TABLES `linked_documents` WRITE;
/*!40000 ALTER TABLE `linked_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `linked_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locked_field_bean_rel`
--

DROP TABLE IF EXISTS `locked_field_bean_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locked_field_bean_rel` (
  `id` char(36) NOT NULL,
  `pd_id` char(36) NOT NULL,
  `bean_id` char(36) NOT NULL,
  `bean_module` varchar(100) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_locked_fields_rel_pdid_beanid` (`pd_id`,`bean_id`),
  KEY `idx_locked_field_bean_rel_del_bean_module_beanid` (`bean_module`,`deleted`),
  KEY `idx_locked_field_bean_rel_beanid_del_bean_module` (`bean_id`,`deleted`,`bean_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locked_field_bean_rel`
--

LOCK TABLES `locked_field_bean_rel` WRITE;
/*!40000 ALTER TABLE `locked_field_bean_rel` DISABLE KEYS */;
/*!40000 ALTER TABLE `locked_field_bean_rel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `list_order` int(4) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_manufacturers_date_modfied` (`date_modified`),
  KEY `idx_manufacturers_id_del` (`id`,`deleted`),
  KEY `idx_manufacturers_date_entered` (`date_entered`),
  KEY `idx_manufacturers_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `location` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `join_url` varchar(600) DEFAULT NULL,
  `host_url` varchar(600) DEFAULT NULL,
  `displayed_url` varchar(400) DEFAULT NULL,
  `creator` varchar(50) DEFAULT NULL,
  `external_id` varchar(50) DEFAULT NULL,
  `duration_hours` int(11) DEFAULT '0',
  `duration_minutes` int(2) DEFAULT '0',
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Planned',
  `type` varchar(255) DEFAULT 'Dotb',
  `parent_id` char(36) DEFAULT NULL,
  `reminder_time` int(11) DEFAULT '-1',
  `email_reminder_time` int(11) DEFAULT '-1',
  `email_reminder_sent` tinyint(1) DEFAULT '0',
  `outlook_id` varchar(255) DEFAULT NULL,
  `sequence` int(11) DEFAULT '0',
  `repeat_type` varchar(36) DEFAULT NULL,
  `repeat_interval` int(3) DEFAULT '1',
  `repeat_dow` varchar(7) DEFAULT NULL,
  `repeat_until` date DEFAULT NULL,
  `repeat_count` int(7) DEFAULT NULL,
  `repeat_selector` varchar(36) DEFAULT NULL,
  `repeat_days` varchar(128) DEFAULT NULL,
  `repeat_ordinal` varchar(36) DEFAULT NULL,
  `repeat_unit` varchar(36) DEFAULT NULL,
  `repeat_parent_id` char(36) DEFAULT NULL,
  `recurrence_id` datetime DEFAULT NULL,
  `recurring_source` varchar(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `dri_workflow_sort_order` varchar(255) DEFAULT '1',
  `customer_journey_score` int(8) DEFAULT NULL,
  `cj_momentum_points` int(8) DEFAULT NULL,
  `cj_momentum_score` int(8) DEFAULT NULL,
  `customer_journey_progress` float DEFAULT '0',
  `cj_momentum_ratio` float DEFAULT '0',
  `customer_journey_points` int(3) DEFAULT '10',
  `cj_parent_activity_type` varchar(255) DEFAULT NULL,
  `customer_journey_blocked_by` text,
  `cj_parent_activity_id` char(36) DEFAULT NULL,
  `is_cj_parent_activity` tinyint(1) DEFAULT '0',
  `is_customer_journey_activity` tinyint(1) DEFAULT '0',
  `cj_momentum_start_date` datetime DEFAULT NULL,
  `cj_momentum_end_date` datetime DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `dri_subworkflow_template_id` char(36) DEFAULT NULL,
  `dri_workflow_task_template_id` char(36) DEFAULT NULL,
  `dri_subworkflow_id` char(36) DEFAULT NULL,
  `cj_actual_sort_order` varchar(255) DEFAULT NULL,
  `cj_url` varchar(255) DEFAULT NULL,
  `app_reminder_sent` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_meetings_date_modfied` (`date_modified`),
  KEY `idx_meetings_id_del` (`id`,`deleted`),
  KEY `idx_meetings_date_entered` (`date_entered`),
  KEY `idx_meetings_name_del` (`name`,`deleted`),
  KEY `idx_mtg_name` (`name`),
  KEY `idx_meet_par_del` (`parent_id`,`parent_type`,`deleted`),
  KEY `idx_meet_stat_del` (`assigned_user_id`,`status`,`deleted`),
  KEY `idx_meet_date_start` (`date_start`),
  KEY `idx_meet_recurrence_id` (`recurrence_id`),
  KEY `idx_meet_date_start_end_del` (`date_start`,`date_end`,`deleted`),
  KEY `idx_meet_repeat_parent_id` (`repeat_parent_id`,`deleted`),
  KEY `idx_meet_date_start_reminder` (`date_start`,`reminder_time`),
  KEY `idx_meetings_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_meetings_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_meetings_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_meeting_cj_journey_tpl_id` (`dri_workflow_template_id`),
  KEY `idx_meeting_cj_stage_tpl_id` (`dri_subworkflow_template_id`),
  KEY `idx_meeting_cj_activity_tpl_id` (`dri_workflow_task_template_id`),
  KEY `idx_meeting_cj_stage_id` (`dri_subworkflow_id`),
  KEY `idx_meeting_cj_parent_activity` (`deleted`,`cj_parent_activity_id`,`cj_parent_activity_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES ('0131a5f0-4b1f-11e9-8266-1e4d7023ffd7','ádasdsadsa','2019-03-20 14:46:54','2019-03-20 14:47:02','1','1',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,30,'2019-03-20 15:00:00','2019-03-20 15:30:00','Contacts','Held','Sugar','ea4ecaa8-3e52-11e9-95e3-00ac92f6ab22',1800,-1,0,NULL,0,NULL,0,NULL,NULL,0,'None',NULL,NULL,NULL,NULL,NULL,NULL,'1','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7',NULL,'1',NULL,NULL,NULL,0,0,10,NULL,NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),('3b1b47d0-498a-11e9-baa1-1c4d7023ffd7','dsasdsadsa','2019-03-18 14:29:25','2019-03-18 14:29:25','1','1',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,30,'2019-03-18 14:30:00','2019-03-18 15:00:00','Accounts','Planned','Sugar',NULL,1800,-1,0,NULL,0,NULL,0,NULL,NULL,0,'None',NULL,NULL,NULL,NULL,NULL,NULL,'1','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7',NULL,'1',NULL,NULL,NULL,0,0,10,NULL,NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings_contacts`
--

DROP TABLE IF EXISTS `meetings_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings_contacts` (
  `id` char(36) NOT NULL,
  `meeting_id` char(36) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `required` varchar(1) DEFAULT '1',
  `accept_status` varchar(25) DEFAULT 'none',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_mtg_mtg` (`meeting_id`),
  KEY `idx_con_mtg_con` (`contact_id`),
  KEY `idx_meeting_contact` (`meeting_id`,`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_contacts`
--

LOCK TABLES `meetings_contacts` WRITE;
/*!40000 ALTER TABLE `meetings_contacts` DISABLE KEYS */;
INSERT INTO `meetings_contacts` VALUES ('013af0a6-4b1f-11e9-9bbb-1e4d7023ffd7','0131a5f0-4b1f-11e9-8266-1e4d7023ffd7','ea4ecaa8-3e52-11e9-95e3-00ac92f6ab22','1','none','2019-03-20 14:46:54',0);
/*!40000 ALTER TABLE `meetings_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings_leads`
--

DROP TABLE IF EXISTS `meetings_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings_leads` (
  `id` char(36) NOT NULL,
  `meeting_id` char(36) DEFAULT NULL,
  `lead_id` char(36) DEFAULT NULL,
  `required` varchar(1) DEFAULT '1',
  `accept_status` varchar(25) DEFAULT 'none',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_lead_meeting_meeting` (`meeting_id`),
  KEY `idx_lead_meeting_lead` (`lead_id`),
  KEY `idx_meeting_lead` (`meeting_id`,`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_leads`
--

LOCK TABLES `meetings_leads` WRITE;
/*!40000 ALTER TABLE `meetings_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings_users`
--

DROP TABLE IF EXISTS `meetings_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings_users` (
  `id` char(36) NOT NULL,
  `meeting_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `required` varchar(1) DEFAULT '1',
  `accept_status` varchar(25) DEFAULT 'none',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_usr_mtg_mtg` (`meeting_id`),
  KEY `idx_usr_mtg_usr` (`user_id`),
  KEY `idx_meeting_users` (`meeting_id`,`user_id`),
  KEY `idx_meeting_users_del` (`meeting_id`,`user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_users`
--

LOCK TABLES `meetings_users` WRITE;
/*!40000 ALTER TABLE `meetings_users` DISABLE KEYS */;
INSERT INTO `meetings_users` VALUES ('0167597a-4b1f-11e9-947f-1e4d7023ffd7','0131a5f0-4b1f-11e9-8266-1e4d7023ffd7','1','1','accept','2019-03-20 14:46:54',0),('3b2da808-498a-11e9-9ff7-1c4d7023ffd7','3b1b47d0-498a-11e9-baa1-1c4d7023ffd7','1','1','accept','2019-03-18 14:29:25',0);
/*!40000 ALTER TABLE `meetings_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metadata_cache`
--

DROP TABLE IF EXISTS `metadata_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metadata_cache` (
  `id` char(36) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `data` longblob,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type_indx` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metadata_cache`
--

LOCK TABLES `metadata_cache` WRITE;
/*!40000 ALTER TABLE `metadata_cache` DISABLE KEYS */;
INSERT INTO `metadata_cache` VALUES ('0ebab362-1434-11eb-85de-00ace43f6d74','meta:hash:public:base','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','2020-10-22 06:58:58',0);
/*!40000 ALTER TABLE `metadata_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `file_mime_type` varchar(100) DEFAULT NULL,
  `file_ext` varchar(100) DEFAULT NULL,
  `file_source` varchar(32) DEFAULT NULL,
  `file_size` int(11) DEFAULT '0',
  `filename` varchar(255) DEFAULT NULL,
  `upload_id` char(36) DEFAULT NULL,
  `email_type` varchar(255) DEFAULT NULL,
  `email_id` char(36) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `portal_flag` tinyint(1) DEFAULT '0',
  `embed_flag` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_notes_date_modfied` (`date_modified`),
  KEY `idx_notes_id_del` (`id`,`deleted`),
  KEY `idx_notes_date_entered` (`date_entered`),
  KEY `idx_notes_name_del` (`name`,`deleted`),
  KEY `idx_note_name` (`name`),
  KEY `idx_notes_parent` (`parent_id`,`parent_type`),
  KEY `idx_note_contact` (`contact_id`),
  KEY `idx_note_email_id` (`email_id`),
  KEY `idx_note_email_type` (`email_type`),
  KEY `idx_note_email` (`email_id`,`email_type`),
  KEY `idx_notes_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_notes_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_notes_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `is_read` tinyint(1) DEFAULT '0',
  `severity` varchar(15) DEFAULT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_notifications_date_modfied` (`date_modified`),
  KEY `idx_notifications_id_del` (`id`,`deleted`),
  KEY `idx_notifications_date_entered` (`date_entered`),
  KEY `idx_notifications_name_del` (`name`,`deleted`),
  KEY `idx_notifications_my_unread_items` (`assigned_user_id`,`is_read`,`deleted`),
  KEY `idx_notifications_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('f0e34c60-3699-11e9-a6c9-00e04c360044','Missing SMTP Server settings','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1','To send record assignment notifications, an SMTP server must be configured in <a href=\"#bwc/index.php?module=EmailMan&action=config\">Email Settings</a>.',0,0,'warning',NULL,NULL,'1');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications_audit`
--

DROP TABLE IF EXISTS `notifications_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_notifications_audit_parent_id` (`parent_id`),
  KEY `idx_notifications_audit_event_id` (`event_id`),
  KEY `idx_notifications_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_notifications_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications_audit`
--

LOCK TABLES `notifications_audit` WRITE;
/*!40000 ALTER TABLE `notifications_audit` DISABLE KEYS */;
INSERT INTO `notifications_audit` VALUES ('f0e3b4c0-3699-11e9-9222-00e04c360044','f0e34c60-3699-11e9-a6c9-00e04c360044','f0e353b8-3699-11e9-bd87-00e04c360044','2019-02-22 12:01:29','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL);
/*!40000 ALTER TABLE `notifications_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_consumer`
--

DROP TABLE IF EXISTS `oauth_consumer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_consumer` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `c_key` varchar(255) DEFAULT NULL,
  `c_secret` varchar(255) DEFAULT NULL,
  `oauth_type` varchar(50) DEFAULT 'oauth1',
  `client_type` varchar(50) DEFAULT 'user',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ckey` (`c_key`),
  KEY `idx_oauth_consumer_date_modfied` (`date_modified`),
  KEY `idx_oauth_consumer_id_del` (`id`,`deleted`),
  KEY `idx_oauth_consumer_date_entered` (`date_entered`),
  KEY `idx_oauth_consumer_name_del` (`name`,`deleted`),
  KEY `idx_oauthkey_name` (`name`),
  KEY `idx_oauthkey_client_type` (`client_type`),
  KEY `idx_oauth_consumer_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_consumer`
--

LOCK TABLES `oauth_consumer` WRITE;
/*!40000 ALTER TABLE `oauth_consumer` DISABLE KEYS */;
INSERT INTO `oauth_consumer` VALUES ('a5eb8ef6-369a-11e9-9b0d-00e04c360044','Standard OAuth Username & Password Key','2019-02-22 12:09:04','2019-02-22 12:09:04',NULL,NULL,'This OAuth key is automatically created by the OAuth2.0 system to enable username and password logins',0,'dotb',NULL,'oauth2','user',NULL),('be77b2ca-3699-11e9-9044-00e04c360044','SNIPOAuthKey','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1','Email Archiving OAuth key. Used for acessing this instance for purposes of importing emails.',0,'SNIPOAuthKey','3d666fa9f9570e87b29e1d1d553621af','oauth1','user',NULL);
/*!40000 ALTER TABLE `oauth_consumer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_nonce`
--

DROP TABLE IF EXISTS `oauth_nonce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_nonce` (
  `conskey` varchar(32) NOT NULL,
  `nonce` varchar(32) NOT NULL,
  `nonce_ts` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`conskey`,`nonce`),
  KEY `oauth_nonce_keyts` (`conskey`,`nonce_ts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_nonce`
--

LOCK TABLES `oauth_nonce` WRITE;
/*!40000 ALTER TABLE `oauth_nonce` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_nonce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_tokens`
--

DROP TABLE IF EXISTS `oauth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_tokens` (
  `id` char(36) NOT NULL,
  `secret` varchar(32) DEFAULT NULL,
  `tstate` varchar(1) DEFAULT NULL,
  `consumer` char(36) NOT NULL,
  `token_ts` bigint(20) DEFAULT NULL,
  `expire_ts` bigint(20) DEFAULT '-1',
  `verify` varchar(32) DEFAULT NULL,
  `download_token` varchar(36) DEFAULT NULL,
  `platform` varchar(255) DEFAULT 'base',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `callback_url` varchar(255) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`,`deleted`),
  KEY `oauth_state_ts` (`tstate`,`token_ts`),
  KEY `constoken_key` (`consumer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_tokens`
--

LOCK TABLES `oauth_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_tokens` DISABLE KEYS */;
INSERT INTO `oauth_tokens` VALUES ('5c87f289-6db4-448f-94f6-600d7428943f',NULL,'2','a5eb8ef6-369a-11e9-9b0d-00e04c360044',1586316415,1587526015,NULL,'f267d792-a3af-4768-a0d0-1db1a8e25fca','base',0,NULL,NULL,'1'),('67a1d894-a6fe-4e8a-851a-5e0189896b3b',NULL,'2','a5eb8ef6-369a-11e9-9b0d-00e04c360044',1603349566,1604559166,NULL,'80fe29b3-6d4b-40df-9b8e-c53fe5fdf712','base',0,NULL,NULL,'1'),('7598d13c-6a60-454a-88e4-4291f261f894',NULL,'2','a5eb8ef6-369a-11e9-9b0d-00e04c360044',1586316729,1587526329,NULL,'3a40e4f1-3b24-4888-a8b2-9b7077de4049','base',0,NULL,NULL,'1'),('8b2f4ecc-9464-43c8-b478-a239c8e9391d',NULL,'2','a5eb8ef6-369a-11e9-9b0d-00e04c360044',1586316220,1587525820,NULL,'d9af4e41-d261-4540-ae01-8eae6d59708e','base',0,NULL,NULL,'1'),('8e6fc2bd-6d29-42c1-9304-a2298f2f37f1',NULL,'2','a5eb8ef6-369a-11e9-9b0d-00e04c360044',1586316740,1587526340,NULL,'2bbcf485-e9f4-4755-9c35-9489887f5c1a','base',0,NULL,NULL,'1'),('dd37bcad-d527-4ddf-a2ea-ad05013ad653',NULL,'2','a5eb8ef6-369a-11e9-9b0d-00e04c360044',1586316602,1587526202,NULL,'eb9251a3-8bf8-4d95-871f-f34529b01045','base',0,NULL,NULL,'1'),('f85f6e2ee6d0','1ee62fd93575','2','be77b2ca-3699-11e9-9044-00e04c360044',1550836956,-1,NULL,NULL,'base',0,NULL,NULL,'be6dc3aa-3699-11e9-867e-00e04c360044');
/*!40000 ALTER TABLE `oauth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opportunities`
--

DROP TABLE IF EXISTS `opportunities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opportunities` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `opportunity_type` varchar(255) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `lead_source` varchar(50) DEFAULT NULL,
  `amount` decimal(26,6) DEFAULT NULL,
  `amount_usdollar` decimal(26,6) DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `date_closed_timestamp` bigint(20) unsigned DEFAULT NULL,
  `next_step` varchar(100) DEFAULT NULL,
  `sales_stage` varchar(255) DEFAULT 'New',
  `sales_status` varchar(255) DEFAULT 'New',
  `probability` double DEFAULT NULL,
  `best_case` decimal(26,6) DEFAULT NULL,
  `worst_case` decimal(26,6) DEFAULT NULL,
  `commit_stage` varchar(50) DEFAULT NULL,
  `total_revenue_line_items` int(11) DEFAULT NULL,
  `closed_revenue_line_items` int(11) DEFAULT NULL,
  `included_revenue_line_items` int(11) DEFAULT NULL,
  `mkto_sync` tinyint(1) DEFAULT '0',
  `mkto_id` int(11) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_opportunities_date_modfied` (`date_modified`),
  KEY `idx_opportunities_id_del` (`id`,`deleted`),
  KEY `idx_opportunities_date_entered` (`date_entered`),
  KEY `idx_opportunities_name_del` (`name`,`deleted`),
  KEY `idx_opp_name` (`name`),
  KEY `idx_opp_assigned_timestamp` (`assigned_user_id`,`date_closed_timestamp`,`deleted`),
  KEY `idx_opportunity_sales_status` (`sales_status`),
  KEY `idx_opportunity_opportunity_type` (`opportunity_type`),
  KEY `idx_opportunity_lead_source` (`lead_source`),
  KEY `idx_opportunity_next_step` (`next_step`),
  KEY `idx_opportunity_mkto_id` (`mkto_id`),
  KEY `idx_opportunities_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_opportunities_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_opportunities_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_opportunities_cjtpl_id` (`dri_workflow_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opportunities`
--

LOCK TABLES `opportunities` WRITE;
/*!40000 ALTER TABLE `opportunities` DISABLE KEYS */;
/*!40000 ALTER TABLE `opportunities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opportunities_audit`
--

DROP TABLE IF EXISTS `opportunities_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opportunities_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_opportunities_audit_parent_id` (`parent_id`),
  KEY `idx_opportunities_audit_event_id` (`event_id`),
  KEY `idx_opportunities_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_opportunities_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opportunities_audit`
--

LOCK TABLES `opportunities_audit` WRITE;
/*!40000 ALTER TABLE `opportunities_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `opportunities_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opportunities_contacts`
--

DROP TABLE IF EXISTS `opportunities_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opportunities_contacts` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `contact_role` varchar(50) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_opp_con` (`contact_id`),
  KEY `idx_con_opp_opp` (`opportunity_id`),
  KEY `idx_opportunities_contacts` (`opportunity_id`,`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opportunities_contacts`
--

LOCK TABLES `opportunities_contacts` WRITE;
/*!40000 ALTER TABLE `opportunities_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `opportunities_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ops_backups`
--

DROP TABLE IF EXISTS `ops_backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ops_backups` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `download_url` varchar(1024) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ops_backups_date_entered` (`date_entered`),
  KEY `idx_ops_backups_id_del` (`id`,`deleted`),
  KEY `idx_expires_at` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ops_backups`
--

LOCK TABLES `ops_backups` WRITE;
/*!40000 ALTER TABLE `ops_backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `ops_backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outbound_email`
--

DROP TABLE IF EXISTS `outbound_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outbound_email` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(15) DEFAULT 'user',
  `user_id` char(36) NOT NULL,
  `email_address_id` char(36) DEFAULT NULL,
  `mail_sendtype` varchar(8) DEFAULT 'SMTP',
  `mail_smtptype` varchar(20) DEFAULT 'other',
  `mail_smtpserver` varchar(100) DEFAULT NULL,
  `mail_smtpport` int(5) DEFAULT '465',
  `mail_smtpuser` varchar(100) DEFAULT NULL,
  `mail_smtppass` varchar(100) DEFAULT NULL,
  `mail_smtpauth_req` tinyint(1) DEFAULT '0',
  `mail_smtpssl` int(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `oe_user_id_idx` (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outbound_email`
--

LOCK TABLES `outbound_email` WRITE;
/*!40000 ALTER TABLE `outbound_email` DISABLE KEYS */;
INSERT INTO `outbound_email` VALUES ('47876aa8-36b6-11e9-80a7-00e04c360044','test','system-override','4764ea14-36b6-11e9-9343-00e04c360044','47754760-36b6-11e9-8e0a-00e04c360044','SMTP','other',NULL,25,NULL,NULL,1,0,0),('98e6e212-36b0-11e9-ad16-00e04c360044','dasdas','system-override','98ca9fa8-36b0-11e9-9cb4-00e04c360044','adff8332-3699-11e9-8cc0-00e04c360044','SMTP','other',NULL,25,NULL,NULL,1,0,0),('adffd134-3699-11e9-adfd-00e04c360044','DotbCRM','system','1','adff8332-3699-11e9-8cc0-00e04c360044','SMTP','other',NULL,25,NULL,NULL,1,0,0),('ae3c1432-3699-11e9-bd00-00e04c360044','Lap Nguyen Administrator','system-override','1','32d41652-369c-11e9-95c4-00e04c360044','SMTP','other','',25,'','',1,0,0),('be745102-3699-11e9-bb3e-00e04c360044','Email Archiving user','system-override','be6dc3aa-3699-11e9-867e-00e04c360044','adff8332-3699-11e9-8cc0-00e04c360044','SMTP','other',NULL,25,NULL,NULL,1,0,0),('db3265d8-369c-11e9-bed2-00e04c360044',NULL,'system-override','daa08974-369c-11e9-9c72-00e04c360044','adff8332-3699-11e9-8cc0-00e04c360044','SMTP','other',NULL,25,NULL,NULL,1,0,0);
/*!40000 ALTER TABLE `outbound_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pdfmanager`
--

DROP TABLE IF EXISTS `pdfmanager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdfmanager` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `base_module` varchar(100) DEFAULT '',
  `published` varchar(100) DEFAULT 'yes',
  `field` varchar(100) DEFAULT '0',
  `body_html` text,
  `template_name` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT 'DotBCRM',
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `header_title` varchar(255) DEFAULT NULL,
  `header_text` varchar(255) DEFAULT NULL,
  `header_logo` varchar(255) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pdfmanager_date_modfied` (`date_modified`),
  KEY `idx_pdfmanager_id_del` (`id`,`deleted`),
  KEY `idx_pdfmanager_date_entered` (`date_entered`),
  KEY `idx_pdfmanager_name_del` (`name`,`deleted`),
  KEY `idx_pdfmanager_name` (`name`),
  KEY `idx_pdfmanager_base_module` (`base_module`),
  KEY `idx_pdfmanager_published` (`published`),
  KEY `idx_pdfmanager_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_pdfmanager_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_pdfmanager_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pdfmanager`
--

LOCK TABLES `pdfmanager` WRITE;
/*!40000 ALTER TABLE `pdfmanager` DISABLE KEYS */;
INSERT INTO `pdfmanager` VALUES ('ecf9978a-3699-11e9-a3f5-00e04c360044','Quote','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1','This template is used to print Quote in PDF.',0,'Quotes','yes','0','<table border=\"0\" cellspacing=\"2\">\n<tbody>\n<tr>\n<td rowspan=\"4\" width=\"180%\"><img src=\"./themes/default/images/pdf_logo.jpg\" alt=\"\" /></td>\n<td width=\"60%\"><strong>Quote</strong></td>\n<td width=\"60%\">&nbsp;</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Quote number:</td>\n<td width=\"75%\">{$fields.quote_num}</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Sales Person:</td>\n<td width=\"75%\">{if isset($fields.assigned_user_link.name)}{$fields.assigned_user_link.name}{/if}</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Valid until:</td>\n<td width=\"75%\">{$fields.date_quote_expected_closed}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table style=\"width: 50%;\" border=\"0\" cellspacing=\"2\">\n<tbody>\n<tr style=\"color: #ffffff;\" bgcolor=\"#4B4B4B\">\n<td>Bill To</td>\n<td>Ship To</td>\n</tr>\n<tr>\n<td>{$fields.billing_contact_name}</td>\n<td>{$fields.shipping_contact_name}</td>\n</tr>\n<tr>\n<td>{$fields.billing_account_name}</td>\n<td>{$fields.shipping_account_name}</td>\n</tr>\n<tr>\n<td>{$fields.billing_address_street}</td>\n<td>{$fields.shipping_address_street}</td>\n</tr>\n<tr>\n<td>{if $fields.billing_address_city!=\"\"}{$fields.billing_address_city},{/if} {if $fields.billing_address_state!=\"\"}{$fields.billing_address_state},{/if} {$fields.billing_address_postalcode}</td>\n<td>{if $fields.shipping_address_city!=\"\"}{$fields.shipping_address_city},{/if} {if $fields.shipping_address_state!=\"\"}{$fields.shipping_address_state},{/if} {$fields.shipping_address_postalcode}</td>\n</tr>\n<tr>\n<td>{$fields.billing_address_country}</td>\n<td>{$fields.shipping_address_country}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n{foreach from=$product_bundles item=\"bundle\"}\n{if $bundle.products|@count}\n<p>&nbsp;</p>\n<h3>{$bundle.name}</h3>\n<table style=\"width: 100%;\" border=\"0\">\n<tbody>\n<tr style=\"color: #ffffff;\" bgcolor=\"#4B4B4B\">\n<td width=\"70%\">Quantity</td>\n<td width=\"175%\">Part Number</td>\n<td width=\"175%\">Quoted Line Item</td>\n<td width=\"70%\">List Price</td>\n<td width=\"70%\">Unit Price</td>\n<td width=\"70%\">Ext. Price</td>\n<td width=\"70%\">Discount:</td>\n</tr>\n<!--START_PRODUCT_LOOP-->\n<tr>\n<td width=\"70%\">{if isset($product.quantity)}{$product.quantity}{/if}</td>\n<td width=\"175%\">{if isset($product.mft_part_num)}{$product.mft_part_num}{/if}</td>\n<td width=\"175%\">{if isset($product.name)}{$product.name}{/if}{if isset($product.list_price)}<br></br>{$product.description}{/if}</td>\n<td align=\"right\" width=\"70%\">{if isset($product.list_price)}{$product.list_price}{/if}</td>\n<td align=\"right\" width=\"70%\">{if isset($product.discount_price)}{$product.discount_price}{/if}</td>\n<td align=\"right\" width=\"70%\">{if isset($product.ext_price)}{$product.ext_price}{/if}</td>\n<td align=\"right\" width=\"70%\">\n    {if isset($product.discount_amount)}\n        {if !empty($product.discount_select)}\n            {dotb_number_format var=$product.discount_amount}%\n        {else}\n            {dotb_currency_format var=$product.discount_amount currency_id=$product.currency_id}\n        {/if}\n    {/if}</td>\n</tr>\n<!--END_PRODUCT_LOOP--></tbody>\n</table>\n<table>\n<tbody>\n<tr>\n<td><hr /></td>\n</tr>\n</tbody>\n</table>\n<table style=\"width: 100%; margin: auto;\" border=\"0\">\n<tbody>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Subtotal:</td>\n<td align=\"right\" width=\"45%\">{$bundle.subtotal}</td>\n</tr>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Discount:</td>\n<td align=\"right\" width=\"45%\">{$bundle.deal_tot}</td>\n</tr>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Discounted Subtotal:</td>\n<td align=\"right\" width=\"45%\">{$bundle.new_sub}</td>\n</tr>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Total</td>\n<td align=\"right\" width=\"45%\">{$bundle.total}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n{/if}\n{/foreach}\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<table>\n<tbody>\n<tr>\n<td><hr /></td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table style=\"width: 100%; margin: auto;\" border=\"0\">\n<tbody>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td style=\"font-weight: bold;\" colspan=\"2\" align=\"center\" width=\"150%\"><b>Grand Total</b></td>\n<td width=\"75%\">&nbsp;</td>\n<td align=\"right\" width=\"75%\">&nbsp;</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">Currency:</td>\n<td width=\"75%\">{$fields.currency_iso}</td>\n<td width=\"75%\">Subtotal:</td>\n<td align=\"right\" width=\"75%\">{$fields.subtotal}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td align=\"right\" width=\"75%\">&nbsp;</td>\n<td width=\"75%\">Discount:</td>\n<td align=\"right\" width=\"75%\">{$fields.deal_tot}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">Discounted Subtotal:</td>\n<td align=\"right\" width=\"75%\">{$fields.new_sub}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">Tax Rate:</td>\n<td width=\"75%\">{$fields.taxrate_value}</td>\n<td width=\"75%\">Tax:</td>\n<td align=\"right\" width=\"75%\">{$fields.tax}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">Shipping Provider:</td>\n<td width=\"75%\">{$fields.shipper_name}</td>\n<td width=\"75%\">Shipping:</td>\n<td align=\"right\" width=\"75%\">{$fields.shipping}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">Total</td>\n<td align=\"right\" width=\"75%\">{$fields.total}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table>\n<tbody>\n<tr>\n<td><hr /></td>\n</tr>\n</tbody>\n</table>','quote','DotbCRM','DotbCRM','DotbCRM','DotbCRM',NULL,NULL,NULL,NULL,'1','1',NULL,NULL),('ed12a48c-3699-11e9-8498-00e04c360044','Invoice','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1','This template is used to print Invoice in PDF.',0,'Quotes','yes','0','<table border=\"0\" cellspacing=\"2\">\n<tbody>\n<tr>\n<td rowspan=\"6\" width=\"180%\"><img src=\"./themes/default/images/pdf_logo.jpg\" alt=\"\" /></td>\n<td width=\"60%\"><strong>Invoice</strong></td>\n<td width=\"60%\">&nbsp;</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Invoice number:</td>\n<td width=\"75%\">{$fields.quote_num}</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Sales Person:</td>\n<td width=\"75%\">{if isset($fields.assigned_user_link.name)}{$fields.assigned_user_link.name}{/if}</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Valid until:</td>\n<td width=\"75%\">{$fields.date_quote_expected_closed}</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Purchase Order Num:</td>\n<td width=\"75%\">{$fields.purchase_order_num}</td>\n</tr>\n<tr>\n<td bgcolor=\"#DCDCDC\" width=\"75%\">Payment Terms:</td>\n<td width=\"75%\">{$fields.payment_terms}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table style=\"width: 50%;\" border=\"0\" cellspacing=\"2\">\n<tbody>\n<tr style=\"color: #ffffff;\" bgcolor=\"#4B4B4B\">\n<td>Bill To</td>\n<td>Ship To</td>\n</tr>\n<tr>\n<td>{$fields.billing_contact_name}</td>\n<td>{$fields.shipping_contact_name}</td>\n</tr>\n<tr>\n<td>{$fields.billing_account_name}</td>\n<td>{$fields.shipping_account_name}</td>\n</tr>\n<tr>\n<td>{$fields.billing_address_street}</td>\n<td>{$fields.shipping_address_street}</td>\n</tr>\n<tr>\n<td>{if $fields.billing_address_city!=\"\"}{$fields.billing_address_city},{/if} {if $fields.billing_address_state!=\"\"}{$fields.billing_address_state},{/if} {$fields.billing_address_postalcode}</td>\n<td>{if $fields.shipping_address_city!=\"\"}{$fields.shipping_address_city},{/if} {if $fields.shipping_address_state!=\"\"}{$fields.shipping_address_state},{/if} {$fields.shipping_address_postalcode}</td>\n</tr>\n<tr>\n<td>{$fields.billing_address_country}</td>\n<td>{$fields.shipping_address_country}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n{foreach from=$product_bundles item=\"bundle\"}\n{if $bundle.products|@count}\n<p>&nbsp;</p>\n<h3>{$bundle.name}</h3>\n<table style=\"width: 100%;\" border=\"0\">\n<tbody>\n<tr style=\"color: #ffffff;\" bgcolor=\"#4B4B4B\">\n<td width=\"70%\">Quantity</td>\n<td width=\"175%\">Part Number</td>\n<td width=\"175%\">Quoted Line Item</td>\n<td width=\"70%\">List Price</td>\n<td width=\"70%\">Unit Price</td>\n<td width=\"70%\">Ext. Price</td>\n<td width=\"70%\">Discount:</td>\n</tr>\n<!--START_PRODUCT_LOOP-->\n<tr>\n<td width=\"70%\">{if isset($product.quantity)}{$product.quantity}{/if}</td>\n<td width=\"175%\">{if isset($product.mft_part_num)}{$product.mft_part_num}{/if}</td>\n<td width=\"175%\">{if isset($product.name)}{$product.name}{/if}{if isset($product.list_price)}<br></br>{$product.description}{/if}</td>\n<td align=\"right\" width=\"70%\">{if isset($product.list_price)}{$product.list_price}{/if}</td>\n<td align=\"right\" width=\"70%\">{if isset($product.discount_price)}{$product.discount_price}{/if}</td>\n<td align=\"right\" width=\"70%\">{if isset($product.ext_price)}{$product.ext_price}{/if}</td>\n<td align=\"right\" width=\"70%\">\n    {if isset($product.discount_amount)}\n        {if !empty($product.discount_select)}\n            {dotb_number_format var=$product.discount_amount}%\n        {else}\n            {dotb_currency_format var=$product.discount_amount currency_id=$product.currency_id}\n        {/if}\n    {/if}</td>\n</tr>\n<!--END_PRODUCT_LOOP--></tbody>\n</table>\n<table>\n<tbody>\n<tr>\n<td><hr /></td>\n</tr>\n</tbody>\n</table>\n<table style=\"width: 100%; margin: auto;\" border=\"0\">\n<tbody>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Subtotal:</td>\n<td align=\"right\" width=\"45%\">{$bundle.subtotal}</td>\n</tr>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Discount:</td>\n<td align=\"right\" width=\"45%\">{$bundle.deal_tot}</td>\n</tr>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Discounted Subtotal:</td>\n<td align=\"right\" width=\"45%\">{$bundle.new_sub}</td>\n</tr>\n<tr>\n<td width=\"210%\">&nbsp;</td>\n<td width=\"45%\">Total</td>\n<td align=\"right\" width=\"45%\">{$bundle.total}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n{/if}\n{/foreach}\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<table>\n<tbody>\n<tr>\n<td><hr /></td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table style=\"width: 100%; margin: auto;\" border=\"0\">\n<tbody>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td style=\"font-weight: bold;\" colspan=\"2\" align=\"center\" width=\"150%\"><b>Grand Total</b></td>\n<td width=\"75%\">&nbsp;</td>\n<td align=\"right\" width=\"75%\">&nbsp;</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">Currency:</td>\n<td width=\"75%\">{$fields.currency_iso}</td>\n<td width=\"75%\">Subtotal:</td>\n<td align=\"right\" width=\"75%\">{$fields.subtotal}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td align=\"right\" width=\"75%\">&nbsp;</td>\n<td width=\"75%\">Discount:</td>\n<td align=\"right\" width=\"75%\">{$fields.deal_tot}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">Discounted Subtotal:</td>\n<td align=\"right\" width=\"75%\">{$fields.new_sub}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">Tax Rate:</td>\n<td width=\"75%\">{$fields.taxrate_value}</td>\n<td width=\"75%\">Tax:</td>\n<td align=\"right\" width=\"75%\">{$fields.tax}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">Shipping Provider:</td>\n<td width=\"75%\">{$fields.shipper_name}</td>\n<td width=\"75%\">Shipping:</td>\n<td align=\"right\" width=\"75%\">{$fields.shipping}</td>\n</tr>\n<tr>\n<td width=\"200%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">&nbsp;</td>\n<td width=\"75%\">Total</td>\n<td align=\"right\" width=\"75%\">{$fields.total}</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table>\n<tbody>\n<tr>\n<td><hr /></td>\n</tr>\n</tbody>\n</table>','invoice','DotbCRM','DotbCRM','DotbCRM','SugarCRM',NULL,NULL,NULL,NULL,'1','1',NULL,NULL);
/*!40000 ALTER TABLE `pdfmanager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_activity_definition`
--

DROP TABLE IF EXISTS `pmse_bpm_activity_definition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_activity_definition` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `pro_id` varchar(36) DEFAULT '',
  `act_type` varchar(32) DEFAULT 'TASK',
  `act_duration` int(4) DEFAULT '0',
  `act_duration_unit` varchar(32) DEFAULT 'DAYS',
  `act_send_notification` int(4) DEFAULT '0',
  `act_assignment_method` varchar(32) DEFAULT 'balanced',
  `act_assign_team` varchar(40) DEFAULT '',
  `act_assign_user` varchar(40) DEFAULT '',
  `act_value_based_assignment` varchar(255) DEFAULT '',
  `act_reassign` int(4) DEFAULT '0',
  `act_reassign_team` varchar(40) DEFAULT '',
  `act_adhoc` int(4) DEFAULT '0',
  `act_adhoc_behavior` varchar(40) DEFAULT '',
  `act_adhoc_team` varchar(40) DEFAULT '',
  `act_response_buttons` varchar(40) DEFAULT '',
  `act_last_user_assigned` varchar(40) DEFAULT '',
  `act_field_module` varchar(100) DEFAULT '',
  `act_fields` text,
  `act_readonly_fields` text,
  `act_expected_time` text,
  `act_required_fields` text,
  `act_related_modules` text,
  `act_service_url` text,
  `act_service_params` text,
  `act_service_method` text,
  `act_update_record_owner` int(4) DEFAULT '0',
  `execution_mode` varchar(10) DEFAULT 'DEFAULT',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_activity_definition_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_activity_definition_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_activity_definition_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_activity_definition_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_activity_definition_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_activity_definition`
--

LOCK TABLES `pmse_bpm_activity_definition` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_activity_definition` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_activity_definition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_activity_step`
--

DROP TABLE IF EXISTS `pmse_bpm_activity_step`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_activity_step` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `pro_id` varchar(36) DEFAULT '',
  `act_step_type` varchar(30) DEFAULT 'START',
  `act_criteria` text,
  `act_step_form` varchar(255) DEFAULT '',
  `act_step_script` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_activity_step_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_activity_step_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_activity_step_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_activity_step_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_activity_step_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_activity_step`
--

LOCK TABLES `pmse_bpm_activity_step` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_activity_step` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_activity_step` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_activity_user`
--

DROP TABLE IF EXISTS `pmse_bpm_activity_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_activity_user` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `pro_id` varchar(36) DEFAULT '',
  `act_user_type` varchar(32) DEFAULT '',
  `act_user_id` varchar(40) DEFAULT '',
  `act_group_id` varchar(40) DEFAULT '',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_activity_user_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_activity_user_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_activity_user_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_activity_user_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_activity_user_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_activity_user`
--

LOCK TABLES `pmse_bpm_activity_user` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_activity_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_activity_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_config`
--

DROP TABLE IF EXISTS `pmse_bpm_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_config` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `cfg_status` varchar(20) DEFAULT 'ACTIVE',
  `cfg_value` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_config_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_config_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_config_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_config_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_config_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_config`
--

LOCK TABLES `pmse_bpm_config` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_dynamic_forms`
--

DROP TABLE IF EXISTS `pmse_bpm_dynamic_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_dynamic_forms` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `dyn_uid` varchar(32) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `dyn_module` varchar(255) DEFAULT '',
  `dyn_view_defs` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_dynamic_forms_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_dynamic_forms_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_dynamic_forms_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_dynamic_forms_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_dynamic_forms_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_dynamic_forms`
--

LOCK TABLES `pmse_bpm_dynamic_forms` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_dynamic_forms` DISABLE KEYS */;
INSERT INTO `pmse_bpm_dynamic_forms` VALUES ('8235bdb2-9e4e-11e9-a2ad-00e04c68004f','Default','2019-07-04 11:26:00','2019-07-04 11:26:00','1','1','Default',0,'2004816255d1de24c0eb2c8050517232','80408686-9e4e-11e9-8a92-00e04c68004f','80408686-9e4e-11e9-8a92-00e04c68004f','Accounts','{\"BpmView\":{\"templateMeta\":{\"form\":{\"buttons\":[\"SAVE\",\"CANCEL\"]},\"maxColumns\":\"2\",\"useTabs\":true,\"widths\":[{\"label\":\"10\",\"field\":\"30\"},{\"label\":\"10\",\"field\":\"30\"}],\"includes\":[{\"file\":\"modules\\/Accounts\\/Account.js\"}]},\"panels\":{\"lbl_account_information\":[[{\"name\":\"name\",\"label\":\"LBL_NAME\",\"displayParams\":{\"required\":true}},{\"name\":\"phone_office\",\"label\":\"LBL_PHONE_OFFICE\"}],[{\"name\":\"website\",\"type\":\"link\",\"label\":\"LBL_WEBSITE\"},{\"name\":\"phone_fax\",\"label\":\"LBL_FAX\"}],[{\"name\":\"billing_address_street\",\"hideLabel\":true,\"type\":\"address\",\"displayParams\":{\"key\":\"billing\",\"rows\":2,\"cols\":30,\"maxlength\":150}},{\"name\":\"shipping_address_street\",\"hideLabel\":true,\"type\":\"address\",\"displayParams\":{\"key\":\"shipping\",\"copy\":\"billing\",\"rows\":2,\"cols\":30,\"maxlength\":150}}],[{\"name\":\"email\",\"studio\":\"false\",\"label\":\"LBL_EMAIL\"}],[{\"name\":\"description\",\"label\":\"LBL_DESCRIPTION\"}]],\"LBL_PANEL_ADVANCED\":[[\"account_type\",\"industry\"],[\"annual_revenue\",\"employees\"],[\"sic_code\",\"ticker_symbol\"],[\"parent_name\",\"ownership\"],[\"campaign_name\",\"rating\"]],\"LBL_PANEL_ASSIGNMENT\":[[{\"name\":\"assigned_user_name\",\"label\":\"LBL_ASSIGNED_TO\"},{\"name\":\"team_name\",\"displayParams\":{\"display\":true}}]]}}}',NULL);
/*!40000 ALTER TABLE `pmse_bpm_dynamic_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_event_definition`
--

DROP TABLE IF EXISTS `pmse_bpm_event_definition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_event_definition` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `evn_status` varchar(32) DEFAULT 'ACTIVE',
  `evn_type` varchar(30) DEFAULT 'START',
  `evn_module` varchar(128) DEFAULT 'Leads',
  `evn_criteria` text,
  `evn_params` text,
  `evn_script` text,
  `execution_mode` varchar(10) DEFAULT 'DEFAULT',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_event_definition_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_event_definition_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_event_definition_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_event_definition_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_event_definition_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_event_definition`
--

LOCK TABLES `pmse_bpm_event_definition` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_event_definition` DISABLE KEYS */;
INSERT INTO `pmse_bpm_event_definition` VALUES ('9be8540e-9e4e-11e9-bbaf-00e04c68004f',NULL,'2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'80408686-9e4e-11e9-8a92-00e04c68004f','822e95a0-9e4e-11e9-8d4e-00e04c68004f','ACTIVE','END','Accounts',NULL,NULL,NULL,'DEFAULT',NULL),('9c0191bc-9e4e-11e9-863d-00e04c68004f',NULL,'2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'80408686-9e4e-11e9-8a92-00e04c68004f','822e95a0-9e4e-11e9-8d4e-00e04c68004f','ACTIVE','START','Accounts',NULL,NULL,NULL,'DEFAULT',NULL),('9c03c130-9e4e-11e9-a849-00e04c68004f',NULL,'2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'80408686-9e4e-11e9-8a92-00e04c68004f','822e95a0-9e4e-11e9-8d4e-00e04c68004f','ACTIVE','INTERMEDIATE','Accounts',NULL,NULL,NULL,'DEFAULT',NULL);
/*!40000 ALTER TABLE `pmse_bpm_event_definition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_flow`
--

DROP TABLE IF EXISTS `pmse_bpm_flow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_flow` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `cas_id` int(4) DEFAULT NULL,
  `cas_index` int(4) DEFAULT NULL,
  `pro_id` varchar(36) DEFAULT '',
  `cas_previous` int(4) DEFAULT '0',
  `cas_reassign_level` int(4) DEFAULT '0',
  `bpmn_id` varchar(36) DEFAULT '',
  `bpmn_type` varchar(32) DEFAULT '',
  `cas_assignment_method` varchar(32) DEFAULT '',
  `cas_user_id` varchar(40) DEFAULT '',
  `cas_thread` int(4) DEFAULT '0',
  `cas_flow_status` varchar(32) DEFAULT 'OPEN',
  `cas_dotb_module` varchar(128) DEFAULT '',
  `cas_dotb_object_id` varchar(40) DEFAULT '',
  `cas_dotb_action` varchar(40) DEFAULT 'DetailView',
  `cas_adhoc_type` varchar(40) DEFAULT '',
  `cas_adhoc_parent_id` varchar(40) DEFAULT '',
  `cas_adhoc_actions` varchar(255) DEFAULT '',
  `cas_task_start_date` datetime DEFAULT NULL,
  `cas_delegate_date` datetime DEFAULT NULL,
  `cas_start_date` datetime DEFAULT NULL,
  `cas_finish_date` datetime DEFAULT NULL,
  `cas_due_date` datetime DEFAULT NULL,
  `cas_queue_duration` int(4) DEFAULT '0',
  `cas_duration` int(4) DEFAULT '0',
  `cas_delay_duration` int(4) DEFAULT '0',
  `cas_started` int(4) DEFAULT '0',
  `cas_finished` int(4) DEFAULT '0',
  `cas_delayed` int(4) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_flow_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_flow_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_flow_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_flow_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_flow_cas_flow_status` (`bpmn_id`,`cas_flow_status`),
  KEY `idx_pmse_bpm_flow_status` (`cas_flow_status`),
  KEY `idx_pmse_bpm_flow_cas_dotb_object_id` (`cas_dotb_object_id`),
  KEY `idx_pmse_bpm_flow_parent` (`cas_dotb_object_id`,`cas_dotb_module`),
  KEY `idx_pmse_bpm_flow_cas_id` (`cas_id`),
  KEY `idx_pmse_bpm_flow_parent_and_cas_id` (`cas_dotb_object_id`,`cas_dotb_module`,`cas_index`),
  KEY `idx_pmse_bpm_flow_bpmn_type_flow_status_due_date_del` (`bpmn_type`,`cas_flow_status`,`cas_due_date`,`deleted`),
  KEY `idx_pmse_bpm_flow_del_cas_id` (`cas_id`,`deleted`),
  KEY `idx_pmse_bpm_flow_cas_id_flow_status` (`cas_id`,`cas_flow_status`),
  KEY `idx_pmse_bpm_flow_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_flow`
--

LOCK TABLES `pmse_bpm_flow` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_flow` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_flow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_form_action`
--

DROP TABLE IF EXISTS `pmse_bpm_form_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_form_action` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `cas_id` int(4) DEFAULT NULL,
  `act_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `user_id` varchar(36) DEFAULT '',
  `frm_index` int(4) DEFAULT NULL,
  `frm_last` int(4) DEFAULT NULL,
  `frm_action` varchar(255) DEFAULT 'ROUTE',
  `frm_user_id` varchar(255) DEFAULT '',
  `frm_user_name` varchar(255) DEFAULT '',
  `frm_date` datetime DEFAULT NULL,
  `frm_comment` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_form_action_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_form_action_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_form_action_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_form_action_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_form_action_del_cas_id` (`cas_id`,`deleted`),
  KEY `idx_pmse_bpm_form_action_cas_id_frm_last` (`cas_id`,`frm_last`,`deleted`),
  KEY `idx_pmse_bpm_form_action_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_form_action`
--

LOCK TABLES `pmse_bpm_form_action` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_form_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_form_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_gateway_definition`
--

DROP TABLE IF EXISTS `pmse_bpm_gateway_definition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_gateway_definition` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `execution_mode` varchar(10) DEFAULT 'DEFAULT',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_gateway_definition_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_gateway_definition_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_gateway_definition_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_gateway_definition_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_gateway_definition_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_gateway_definition`
--

LOCK TABLES `pmse_bpm_gateway_definition` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_gateway_definition` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_gateway_definition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_group`
--

DROP TABLE IF EXISTS `pmse_bpm_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_group` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `grp_uid` varchar(36) DEFAULT '',
  `grp_parent_group` int(4) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_group_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_group_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_group_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_group_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_group_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_group`
--

LOCK TABLES `pmse_bpm_group` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_group_user`
--

DROP TABLE IF EXISTS `pmse_bpm_group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_group_user` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `user_id` varchar(36) DEFAULT '',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_group_user_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_group_user_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_group_user_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_group_user_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_group_user_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_group_user`
--

LOCK TABLES `pmse_bpm_group_user` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_group_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_notes`
--

DROP TABLE IF EXISTS `pmse_bpm_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_notes` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `cas_id` varchar(36) DEFAULT '',
  `cas_index` int(4) DEFAULT NULL,
  `not_user_id` varchar(40) DEFAULT '',
  `not_user_recipient_id` varchar(40) DEFAULT '',
  `not_type` varchar(32) DEFAULT 'GENERAL',
  `not_date` datetime DEFAULT NULL,
  `not_status` varchar(10) DEFAULT 'ACTIVE',
  `not_availability` varchar(32) DEFAULT '',
  `not_content` text,
  `not_recipients` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_notes_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_notes_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_notes_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_notes_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_notes_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_notes`
--

LOCK TABLES `pmse_bpm_notes` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_process_definition`
--

DROP TABLE IF EXISTS `pmse_bpm_process_definition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_process_definition` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `prj_id` varchar(36) DEFAULT '',
  `pro_module` varchar(255) DEFAULT '',
  `pro_status` varchar(255) DEFAULT '',
  `pro_locked_variables` text,
  `pro_terminate_variables` text,
  `execution_mode` varchar(10) DEFAULT 'SYNC',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_process_definition_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_process_definition_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_process_definition_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_process_definition_name_del` (`name`,`deleted`),
  KEY `idx_pd_prj_id` (`prj_id`),
  KEY `idx_pd_pro_status` (`pro_status`),
  KEY `idx_pmse_bpm_process_definition_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_process_definition`
--

LOCK TABLES `pmse_bpm_process_definition` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_process_definition` DISABLE KEYS */;
INSERT INTO `pmse_bpm_process_definition` VALUES ('822e95a0-9e4e-11e9-8d4e-00e04c68004f',NULL,'2019-07-04 11:26:00','2019-07-04 11:26:00','1','1',NULL,0,'80408686-9e4e-11e9-8a92-00e04c68004f','Accounts','INACTIVE',NULL,NULL,'SYNC','1');
/*!40000 ALTER TABLE `pmse_bpm_process_definition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_related_dependency`
--

DROP TABLE IF EXISTS `pmse_bpm_related_dependency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_related_dependency` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `evn_id` varchar(36) DEFAULT '',
  `evn_uid` varchar(36) DEFAULT '',
  `evn_marker` varchar(36) DEFAULT '',
  `evn_is_interrupting` varchar(36) DEFAULT '',
  `evn_attached_to` varchar(36) DEFAULT '',
  `evn_cancel_activity` varchar(36) DEFAULT '',
  `evn_activity_ref` varchar(36) DEFAULT '',
  `evn_wait_for_completion` varchar(36) DEFAULT '',
  `evn_error_name` varchar(36) DEFAULT '',
  `evn_error_code` varchar(36) DEFAULT '',
  `evn_escalation_name` varchar(36) DEFAULT '',
  `evn_escalation_code` varchar(36) DEFAULT '',
  `evn_condition` varchar(36) DEFAULT '',
  `evn_message` varchar(36) DEFAULT '',
  `evn_operation_name` varchar(36) DEFAULT '',
  `evn_operation_implementation` varchar(36) DEFAULT '',
  `evn_time_date` varchar(36) DEFAULT '',
  `evn_time_cycle` varchar(36) DEFAULT '',
  `evn_time_duration` varchar(36) DEFAULT '',
  `evn_behavior` varchar(36) DEFAULT '',
  `evn_status` varchar(36) DEFAULT '',
  `evn_type` varchar(36) DEFAULT '',
  `evn_module` varchar(36) DEFAULT '',
  `evn_criteria` text,
  `evn_params` text,
  `evn_script` text,
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `pro_module` varchar(36) DEFAULT '',
  `pro_status` varchar(36) DEFAULT '',
  `pro_locked_variables` text,
  `pro_terminate_variables` text,
  `rel_element_id` varchar(40) DEFAULT '',
  `rel_element_type` varchar(32) DEFAULT '',
  `rel_process_module` varchar(32) DEFAULT '',
  `rel_element_module` varchar(32) DEFAULT '',
  `rel_element_relationship` varchar(255) DEFAULT '',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_related_dependency_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_related_dependency_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_related_dependency_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_related_dependency_name_del` (`name`,`deleted`),
  KEY `idx_prostatus_evntype_evnmodule_evn_behavior` (`pro_status`,`evn_type`,`evn_module`,`evn_behavior`),
  KEY `idx_pmse_bpm_related_dependency_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_related_dependency`
--

LOCK TABLES `pmse_bpm_related_dependency` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_related_dependency` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_related_dependency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpm_thread`
--

DROP TABLE IF EXISTS `pmse_bpm_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpm_thread` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `cas_id` int(4) DEFAULT '0',
  `cas_thread_index` int(4) DEFAULT '0',
  `cas_thread_parent` int(4) DEFAULT '0',
  `cas_thread_status` varchar(32) DEFAULT 'OPEN',
  `cas_flow_index` int(4) DEFAULT '0',
  `cas_thread_tokens` int(4) DEFAULT '0',
  `cas_thread_passes` int(4) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpm_thread_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpm_thread_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpm_thread_date_entered` (`date_entered`),
  KEY `idx_pmse_bpm_thread_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpm_thread_del_cas_id` (`cas_id`,`deleted`),
  KEY `idx_pmse_bpm_thread_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpm_thread`
--

LOCK TABLES `pmse_bpm_thread` WRITE;
/*!40000 ALTER TABLE `pmse_bpm_thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpm_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_activity`
--

DROP TABLE IF EXISTS `pmse_bpmn_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_activity` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `act_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `act_type` varchar(30) DEFAULT 'TASK',
  `act_is_for_compensation` int(4) DEFAULT '0',
  `act_start_quantity` int(4) DEFAULT '1',
  `act_completion_quantity` int(4) DEFAULT '1',
  `act_task_type` varchar(20) DEFAULT 'EMPTY',
  `act_implementation` text,
  `act_instantiate` int(4) DEFAULT '0',
  `act_script_type` varchar(255) DEFAULT '',
  `act_script` text,
  `act_loop_type` varchar(20) DEFAULT 'NONE',
  `act_test_before` int(4) DEFAULT '0',
  `act_loop_maximum` int(4) DEFAULT '0',
  `act_loop_condition` varchar(100) DEFAULT '',
  `act_loop_cardinality` int(4) DEFAULT '0',
  `act_loop_behavior` varchar(20) DEFAULT 'NONE',
  `act_is_adhoc` int(4) DEFAULT '0',
  `act_is_collapsed` int(4) DEFAULT '1',
  `act_completion_condition` varchar(255) DEFAULT '',
  `act_ordering` varchar(20) DEFAULT 'PARALLEL',
  `act_cancel_remaining_instances` int(4) DEFAULT '1',
  `act_protocol` varchar(255) DEFAULT '',
  `act_method` varchar(255) DEFAULT '',
  `act_is_global` int(4) DEFAULT '0',
  `act_referer` int(4) DEFAULT NULL,
  `act_default_flow` int(4) DEFAULT NULL,
  `act_master_diagram` int(4) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_activity_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_activity_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_activity_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_activity_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_activity_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_activity`
--

LOCK TABLES `pmse_bpmn_activity` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_artifact`
--

DROP TABLE IF EXISTS `pmse_bpmn_artifact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_artifact` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `art_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `art_type` varchar(15) DEFAULT '',
  `art_category_ref` varchar(32) DEFAULT '',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_artifact_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_artifact_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_artifact_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_artifact_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_artifact_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_artifact`
--

LOCK TABLES `pmse_bpmn_artifact` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_artifact` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_artifact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_bound`
--

DROP TABLE IF EXISTS `pmse_bpmn_bound`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_bound` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `bou_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `dia_id` varchar(36) DEFAULT '',
  `element_id` varchar(36) DEFAULT '',
  `bou_element` varchar(36) DEFAULT '',
  `bou_element_type` varchar(32) DEFAULT '',
  `bou_x` int(4) DEFAULT '0',
  `bou_y` int(4) DEFAULT '0',
  `bou_width` int(4) DEFAULT '0',
  `bou_height` int(4) DEFAULT '0',
  `bou_rel_position` int(4) DEFAULT '0',
  `bou_size_identical` int(4) DEFAULT '0',
  `bou_container` varchar(30) DEFAULT '',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_bound_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_bound_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_bound_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_bound_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_bound_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_bound`
--

LOCK TABLES `pmse_bpmn_bound` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_bound` DISABLE KEYS */;
INSERT INTO `pmse_bpmn_bound` VALUES ('9c0007c0-9e4e-11e9-89ac-00e04c68004f',NULL,'2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'9c0007c0-9e4e-11e9-89ac-00e04c68004f','80408686-9e4e-11e9-8a92-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','9be8540e-9e4e-11e9-bbaf-00e04c68004f','bpmnEvent',123,169,33,33,0,0,'bpmnDiagram',NULL),('9c031ba4-9e4e-11e9-8857-00e04c68004f',NULL,'2019-07-04 11:26:46','2019-07-04 11:29:25','1','1',NULL,0,'9c031ba4-9e4e-11e9-8857-00e04c68004f','80408686-9e4e-11e9-8a92-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','9c0191bc-9e4e-11e9-863d-00e04c68004f','bpmnEvent',602,137,33,33,0,0,'bpmnDiagram',NULL),('9c04e4fc-9e4e-11e9-83e9-00e04c68004f',NULL,'2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'9c04e4fc-9e4e-11e9-83e9-00e04c68004f','80408686-9e4e-11e9-8a92-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','9c03c130-9e4e-11e9-a849-00e04c68004f','bpmnEvent',331,122,33,33,0,0,'bpmnDiagram',NULL);
/*!40000 ALTER TABLE `pmse_bpmn_bound` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_data`
--

DROP TABLE IF EXISTS `pmse_bpmn_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_data` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `dat_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `dat_type` varchar(20) DEFAULT '',
  `dat_is_collection` int(4) DEFAULT '0',
  `dat_item_kind` varchar(20) DEFAULT 'INFORMATION',
  `dat_capacity` int(4) DEFAULT '0',
  `dat_is_unlimited` int(4) DEFAULT '0',
  `dat_state` varchar(255) DEFAULT '',
  `dat_is_global` int(4) DEFAULT '0',
  `dat_object_ref` int(4) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_data_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_data_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_data_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_data_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_data_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_data`
--

LOCK TABLES `pmse_bpmn_data` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_diagram`
--

DROP TABLE IF EXISTS `pmse_bpmn_diagram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_diagram` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `dia_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `dia_is_closable` int(4) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_diagram_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_diagram_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_diagram_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_diagram_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_diagram_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_diagram`
--

LOCK TABLES `pmse_bpmn_diagram` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_diagram` DISABLE KEYS */;
INSERT INTO `pmse_bpmn_diagram` VALUES ('822bfc46-9e4e-11e9-89e0-00e04c68004f','io','2019-07-04 11:26:00','2019-07-04 11:26:00','1','1',NULL,0,'2672158765d1de24c01ae20041449114','80408686-9e4e-11e9-8a92-00e04c68004f',0,'1');
/*!40000 ALTER TABLE `pmse_bpmn_diagram` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_documentation`
--

DROP TABLE IF EXISTS `pmse_bpmn_documentation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_documentation` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `doc_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `doc_element` varchar(36) DEFAULT '',
  `doc_element_type` varchar(45) DEFAULT '',
  `doc_documentation` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_documentation_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_documentation_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_documentation_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_documentation_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_documentation_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_documentation`
--

LOCK TABLES `pmse_bpmn_documentation` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_documentation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_documentation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_event`
--

DROP TABLE IF EXISTS `pmse_bpmn_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_event` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `evn_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `evn_type` varchar(30) DEFAULT '',
  `evn_marker` varchar(30) DEFAULT 'EMPTY',
  `evn_is_interrupting` int(4) DEFAULT '1',
  `evn_attached_to` int(4) DEFAULT NULL,
  `evn_cancel_activity` int(4) DEFAULT '0',
  `evn_activity_ref` int(4) DEFAULT NULL,
  `evn_wait_for_completion` int(4) DEFAULT '1',
  `evn_error_name` varchar(255) DEFAULT '',
  `evn_error_code` varchar(255) DEFAULT '',
  `evn_escalation_name` varchar(255) DEFAULT '',
  `evn_escalation_code` varchar(255) DEFAULT '',
  `evn_condition` varchar(255) DEFAULT '',
  `evn_message` text,
  `evn_operation_name` varchar(255) DEFAULT '',
  `evn_operation_implementation` varchar(255) DEFAULT '',
  `evn_time_date` varchar(255) DEFAULT '',
  `evn_time_cycle` varchar(255) DEFAULT '',
  `evn_time_duration` varchar(255) DEFAULT '',
  `evn_behavior` varchar(20) DEFAULT 'CATCH',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_event_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_event_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_event_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_event_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_event_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_event`
--

LOCK TABLES `pmse_bpmn_event` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_event` DISABLE KEYS */;
INSERT INTO `pmse_bpmn_event` VALUES ('9be8540e-9e4e-11e9-bbaf-00e04c68004f','End Event # 1','2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'4155629605d1de267dcf913093694770','80408686-9e4e-11e9-8a92-00e04c68004f','822e95a0-9e4e-11e9-8d4e-00e04c68004f','END','EMPTY',1,NULL,0,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'THROW',NULL),('9c0191bc-9e4e-11e9-863d-00e04c68004f','Start Event # 1','2019-07-04 11:26:46','2019-07-04 11:29:25','1','1',NULL,0,'4985963635d1de269dcfa35012070782','80408686-9e4e-11e9-8a92-00e04c68004f','822e95a0-9e4e-11e9-8d4e-00e04c68004f','START','MESSAGE',1,NULL,0,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'CATCH',NULL),('9c03c130-9e4e-11e9-a849-00e04c68004f','Wait Event # 1','2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'5663689025d1de26fdcfb41026483240','80408686-9e4e-11e9-8a92-00e04c68004f','822e95a0-9e4e-11e9-8d4e-00e04c68004f','INTERMEDIATE','TIMER',1,NULL,0,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'CATCH',NULL);
/*!40000 ALTER TABLE `pmse_bpmn_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_extension`
--

DROP TABLE IF EXISTS `pmse_bpmn_extension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_extension` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `ext_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `ext_element` varchar(36) DEFAULT '',
  `ext_element_type` varchar(45) DEFAULT '',
  `ext_extension` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_extension_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_extension_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_extension_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_extension_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_extension_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_extension`
--

LOCK TABLES `pmse_bpmn_extension` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_extension` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_extension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_flow`
--

DROP TABLE IF EXISTS `pmse_bpmn_flow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_flow` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `flo_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `dia_id` varchar(36) DEFAULT '',
  `flo_type` varchar(20) DEFAULT '',
  `flo_element_origin` varchar(36) DEFAULT '',
  `flo_element_origin_type` varchar(32) DEFAULT '',
  `flo_element_origin_port` int(4) DEFAULT '0',
  `flo_element_dest` varchar(36) DEFAULT '',
  `flo_element_dest_type` varchar(32) DEFAULT '',
  `flo_element_dest_port` int(4) DEFAULT '0',
  `flo_is_inmediate` int(4) DEFAULT NULL,
  `flo_condition` text,
  `flo_eval_priority` int(4) DEFAULT '0',
  `flo_x1` int(4) DEFAULT '0',
  `flo_y1` int(4) DEFAULT '0',
  `flo_x2` int(4) DEFAULT '0',
  `flo_y2` int(4) DEFAULT '0',
  `flo_state` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_flow_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_flow_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_flow_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_flow_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_flow_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_flow`
--

LOCK TABLES `pmse_bpmn_flow` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_flow` DISABLE KEYS */;
INSERT INTO `pmse_bpmn_flow` VALUES ('9c07721c-9e4e-11e9-be2c-00e04c68004f',NULL,'2019-07-04 11:26:46','2019-07-04 11:26:46','1','1',NULL,0,'8588878565d1de276dd0237042772259','80408686-9e4e-11e9-8a92-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','SEQUENCE','9c03c130-9e4e-11e9-a849-00e04c68004f','bpmnEvent',0,'9be8540e-9e4e-11e9-bbaf-00e04c68004f','bpmnEvent',0,NULL,NULL,0,331,139,123,186,'[{\"x\":331,\"y\":139},{\"x\":103,\"y\":139},{\"x\":103,\"y\":186},{\"x\":123,\"y\":186}]',NULL);
/*!40000 ALTER TABLE `pmse_bpmn_flow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_gateway`
--

DROP TABLE IF EXISTS `pmse_bpmn_gateway`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_gateway` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `gat_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `gat_type` varchar(30) DEFAULT '',
  `gat_direction` varchar(30) DEFAULT 'UNSPECIFIED',
  `gat_instantiate` int(4) DEFAULT '0',
  `gat_event_gateway_type` varchar(20) DEFAULT 'NONE',
  `gat_activation_count` int(4) DEFAULT '0',
  `gat_waiting_for_start` int(4) DEFAULT '1',
  `gat_default_flow` varchar(36) DEFAULT '',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_gateway_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_gateway_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_gateway_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_gateway_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_gateway_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_gateway`
--

LOCK TABLES `pmse_bpmn_gateway` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_gateway` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_gateway` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_lane`
--

DROP TABLE IF EXISTS `pmse_bpmn_lane`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_lane` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `lan_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `lns_id` varchar(36) DEFAULT '',
  `lan_child_laneset` varchar(36) DEFAULT '',
  `lan_is_horizontal` int(4) DEFAULT '1',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_lane_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_lane_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_lane_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_lane_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_lane_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_lane`
--

LOCK TABLES `pmse_bpmn_lane` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_lane` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_lane` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_laneset`
--

DROP TABLE IF EXISTS `pmse_bpmn_laneset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_laneset` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `lns_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `lns_parent_lane` varchar(36) DEFAULT '',
  `lns_is_horizontal` int(4) DEFAULT '1',
  `lns_state` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_laneset_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_laneset_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_laneset_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_laneset_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_laneset_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_laneset`
--

LOCK TABLES `pmse_bpmn_laneset` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_laneset` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_laneset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_participant`
--

DROP TABLE IF EXISTS `pmse_bpmn_participant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_participant` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `par_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `pro_id` varchar(36) DEFAULT '',
  `lns_id` varchar(36) DEFAULT '',
  `par_minimum` int(4) DEFAULT '0',
  `par_maximum` int(4) DEFAULT '1',
  `par_num_participants` int(4) DEFAULT '1',
  `par_is_horizontal` int(4) DEFAULT '1',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_participant_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_participant_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_participant_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_participant_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_participant_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_participant`
--

LOCK TABLES `pmse_bpmn_participant` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_bpmn_participant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_bpmn_process`
--

DROP TABLE IF EXISTS `pmse_bpmn_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_bpmn_process` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `pro_uid` varchar(36) DEFAULT '',
  `prj_id` varchar(36) DEFAULT '',
  `dia_id` varchar(36) DEFAULT '',
  `pro_type` varchar(10) DEFAULT 'NONE',
  `pro_is_executable` int(4) DEFAULT '0',
  `pro_is_closed` int(4) DEFAULT '0',
  `pro_is_subprocess` int(4) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_bpmn_process_date_modfied` (`date_modified`),
  KEY `idx_pmse_bpmn_process_id_del` (`id`,`deleted`),
  KEY `idx_pmse_bpmn_process_date_entered` (`date_entered`),
  KEY `idx_pmse_bpmn_process_name_del` (`name`,`deleted`),
  KEY `idx_pmse_bpmn_process_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_bpmn_process`
--

LOCK TABLES `pmse_bpmn_process` WRITE;
/*!40000 ALTER TABLE `pmse_bpmn_process` DISABLE KEYS */;
INSERT INTO `pmse_bpmn_process` VALUES ('822e95a0-9e4e-11e9-8d4e-00e04c68004f','io','2019-07-04 11:26:00','2019-07-04 11:26:00','1','1',NULL,0,'5624635395d1de24c05d6d8000015058','80408686-9e4e-11e9-8a92-00e04c68004f','822bfc46-9e4e-11e9-89e0-00e04c68004f','NONE',0,0,0,'1');
/*!40000 ALTER TABLE `pmse_bpmn_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_business_rules`
--

DROP TABLE IF EXISTS `pmse_business_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_business_rules` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `rst_uid` varchar(36) DEFAULT NULL,
  `rst_type` varchar(100) DEFAULT 'single',
  `rst_definition` text,
  `rst_editable` int(4) DEFAULT '0',
  `rst_source` varchar(255) DEFAULT NULL,
  `rst_source_definition` longtext,
  `rst_module` varchar(100) DEFAULT NULL,
  `rst_filename` varchar(255) DEFAULT NULL,
  `rst_create_date` datetime DEFAULT NULL,
  `rst_update_date` datetime DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_business_rules_date_modfied` (`date_modified`),
  KEY `idx_pmse_business_rules_id_del` (`id`,`deleted`),
  KEY `idx_pmse_business_rules_date_entered` (`date_entered`),
  KEY `idx_pmse_business_rules_name_del` (`name`,`deleted`),
  KEY `idx_pmse_business_rules_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_pmse_business_rules_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_pmse_business_rules_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_business_rules`
--

LOCK TABLES `pmse_business_rules` WRITE;
/*!40000 ALTER TABLE `pmse_business_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_business_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_email_message`
--

DROP TABLE IF EXISTS `pmse_email_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_email_message` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `from_addr` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `to_addrs` text,
  `cc_addrs` text,
  `bcc_addrs` text,
  `body` longtext,
  `body_html` longtext,
  `subject` varchar(255) DEFAULT NULL,
  `flow_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_email_message_date_modfied` (`date_modified`),
  KEY `idx_pmse_email_message_id_del` (`id`,`deleted`),
  KEY `idx_pmse_email_message_date_entered` (`date_entered`),
  KEY `idx_pmse_email_message_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_email_message`
--

LOCK TABLES `pmse_email_message` WRITE;
/*!40000 ALTER TABLE `pmse_email_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_email_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_emails_templates`
--

DROP TABLE IF EXISTS `pmse_emails_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_emails_templates` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `from_name` varchar(255) DEFAULT NULL,
  `from_address` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `body_html` text,
  `type` varchar(255) DEFAULT NULL,
  `base_module` varchar(100) DEFAULT NULL,
  `text_only` tinyint(4) DEFAULT NULL,
  `published` varchar(3) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_emails_templates_date_modfied` (`date_modified`),
  KEY `idx_pmse_emails_templates_id_del` (`id`,`deleted`),
  KEY `idx_pmse_emails_templates_date_entered` (`date_entered`),
  KEY `idx_pmse_emails_templates_name_del` (`name`,`deleted`),
  KEY `idx_pmse_emails_templates_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_pmse_emails_templates_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_pmse_emails_templates_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_emails_templates`
--

LOCK TABLES `pmse_emails_templates` WRITE;
/*!40000 ALTER TABLE `pmse_emails_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_emails_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_inbox`
--

DROP TABLE IF EXISTS `pmse_inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_inbox` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `cas_id` int(11) NOT NULL AUTO_INCREMENT,
  `cas_parent` int(11) DEFAULT NULL,
  `cas_status` varchar(32) DEFAULT 'IN PROGRESS',
  `pro_id` varchar(36) DEFAULT NULL,
  `cas_title` varchar(255) DEFAULT NULL,
  `pro_title` varchar(255) DEFAULT NULL,
  `cas_custom_status` varchar(32) DEFAULT NULL,
  `cas_init_user` varchar(36) DEFAULT NULL,
  `cas_create_date` datetime DEFAULT NULL,
  `cas_update_date` datetime DEFAULT NULL,
  `cas_finish_date` datetime DEFAULT NULL,
  `cas_pin` varchar(10) DEFAULT '0000',
  `cas_assigned_status` varchar(12) DEFAULT 'UNASSIGNED',
  `cas_module` varchar(100) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_inbox_date_modfied` (`date_modified`),
  KEY `idx_pmse_inbox_id_del` (`id`,`deleted`),
  KEY `idx_pmse_inbox_date_entered` (`date_entered`),
  KEY `idx_pmse_inbox_name_del` (`name`,`deleted`),
  KEY `idx_pmse_inbox_case_id` (`cas_id`),
  KEY `idx_pmse_inbox_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_pmse_inbox_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_pmse_inbox_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_inbox`
--

LOCK TABLES `pmse_inbox` WRITE;
/*!40000 ALTER TABLE `pmse_inbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmse_inbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmse_project`
--

DROP TABLE IF EXISTS `pmse_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmse_project` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `prj_uid` varchar(36) DEFAULT NULL,
  `prj_target_namespace` varchar(255) DEFAULT NULL,
  `prj_expression_language` varchar(255) DEFAULT NULL,
  `prj_type_language` varchar(255) DEFAULT NULL,
  `prj_exporter` varchar(255) DEFAULT NULL,
  `prj_exporter_version` varchar(255) DEFAULT NULL,
  `prj_author` varchar(255) DEFAULT NULL,
  `prj_author_version` varchar(255) DEFAULT NULL,
  `prj_original_source` varchar(255) DEFAULT NULL,
  `prj_status` varchar(10) DEFAULT 'INACTIVE',
  `prj_module` varchar(100) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pmse_project_date_modfied` (`date_modified`),
  KEY `idx_pmse_project_id_del` (`id`,`deleted`),
  KEY `idx_pmse_project_date_entered` (`date_entered`),
  KEY `idx_pmse_project_name_del` (`name`,`deleted`),
  KEY `idx_pmse_project_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_pmse_project_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_pmse_project_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmse_project`
--

LOCK TABLES `pmse_project` WRITE;
/*!40000 ALTER TABLE `pmse_project` DISABLE KEYS */;
INSERT INTO `pmse_project` VALUES ('80408686-9e4e-11e9-8a92-00e04c68004f','io','2019-07-04 11:26:00','2019-07-04 11:29:25','1','1',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'INACTIVE','Accounts','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7',NULL,'1');
/*!40000 ALTER TABLE `pmse_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bundle_note`
--

DROP TABLE IF EXISTS `product_bundle_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_bundle_note` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bundle_id` char(36) DEFAULT NULL,
  `note_id` char(36) DEFAULT NULL,
  `note_index` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_pbn_bundle` (`bundle_id`),
  KEY `idx_pbn_note` (`note_id`),
  KEY `idx_pbn_pb_nb` (`note_id`,`bundle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bundle_note`
--

LOCK TABLES `product_bundle_note` WRITE;
/*!40000 ALTER TABLE `product_bundle_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_bundle_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bundle_notes`
--

DROP TABLE IF EXISTS `product_bundle_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_bundle_notes` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bundle_notes`
--

LOCK TABLES `product_bundle_notes` WRITE;
/*!40000 ALTER TABLE `product_bundle_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_bundle_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bundle_product`
--

DROP TABLE IF EXISTS `product_bundle_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_bundle_product` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bundle_id` char(36) DEFAULT NULL,
  `product_id` char(36) DEFAULT NULL,
  `product_index` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_pbp_bundle` (`bundle_id`),
  KEY `idx_pbp_quote` (`product_id`),
  KEY `idx_pbp_bq` (`product_id`,`bundle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bundle_product`
--

LOCK TABLES `product_bundle_product` WRITE;
/*!40000 ALTER TABLE `product_bundle_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_bundle_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bundle_quote`
--

DROP TABLE IF EXISTS `product_bundle_quote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_bundle_quote` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `bundle_id` char(36) DEFAULT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `bundle_index` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_pbq_bundle` (`bundle_id`),
  KEY `idx_pbq_quote` (`quote_id`),
  KEY `idx_pbq_bq` (`quote_id`,`bundle_id`),
  KEY `bundle_index_idx` (`bundle_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bundle_quote`
--

LOCK TABLES `product_bundle_quote` WRITE;
/*!40000 ALTER TABLE `product_bundle_quote` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_bundle_quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bundles`
--

DROP TABLE IF EXISTS `product_bundles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_bundles` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bundle_stage` varchar(255) DEFAULT NULL,
  `description` text,
  `taxrate_id` char(36) DEFAULT NULL,
  `tax` decimal(26,6) DEFAULT NULL,
  `tax_usdollar` decimal(26,6) DEFAULT NULL,
  `total` decimal(26,6) DEFAULT NULL,
  `total_usdollar` decimal(26,6) DEFAULT NULL,
  `subtotal_usdollar` decimal(26,6) DEFAULT NULL,
  `shipping_usdollar` decimal(26,6) DEFAULT NULL,
  `deal_tot` decimal(26,6) DEFAULT NULL,
  `deal_tot_usdollar` decimal(26,6) DEFAULT NULL,
  `new_sub` decimal(26,6) DEFAULT NULL,
  `new_sub_usdollar` decimal(26,6) DEFAULT NULL,
  `subtotal` decimal(26,6) DEFAULT NULL,
  `taxable_subtotal` decimal(26,6) DEFAULT NULL,
  `shipping` decimal(26,6) DEFAULT NULL,
  `default_group` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_products_bundles` (`name`,`deleted`),
  KEY `idx_product_bundles_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_product_bundles_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bundles`
--

LOCK TABLES `product_bundles` WRITE;
/*!40000 ALTER TABLE `product_bundles` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_bundles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `list_order` int(4) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_product_categories_date_modfied` (`date_modified`),
  KEY `idx_product_categories_id_del` (`id`,`deleted`),
  KEY `idx_product_categories_date_entered` (`date_entered`),
  KEY `idx_product_categories_name_del` (`name`,`deleted`),
  KEY `idx_producttemplate_id_parent_name` (`id`,`parent_id`,`name`,`deleted`),
  KEY `idx_product_categories_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_product`
--

DROP TABLE IF EXISTS `product_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_product` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `child_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_pp_parent` (`parent_id`),
  KEY `idx_pp_child` (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_product`
--

LOCK TABLES `product_product` WRITE;
/*!40000 ALTER TABLE `product_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_templates`
--

DROP TABLE IF EXISTS `product_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_templates` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `type_id` char(36) DEFAULT NULL,
  `manufacturer_id` char(36) DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  `mft_part_num` varchar(50) DEFAULT NULL,
  `vendor_part_num` varchar(50) DEFAULT NULL,
  `date_cost_price` date DEFAULT NULL,
  `cost_price` decimal(26,6) DEFAULT NULL,
  `discount_price` decimal(26,6) DEFAULT NULL,
  `list_price` decimal(26,6) DEFAULT NULL,
  `cost_usdollar` decimal(26,6) DEFAULT NULL,
  `discount_usdollar` decimal(26,6) DEFAULT NULL,
  `list_usdollar` decimal(26,6) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `tax_class` varchar(100) DEFAULT NULL,
  `date_available` date DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `weight` decimal(12,2) DEFAULT NULL,
  `qty_in_stock` int(5) DEFAULT NULL,
  `support_name` varchar(50) DEFAULT NULL,
  `support_description` varchar(255) DEFAULT NULL,
  `support_contact` varchar(50) DEFAULT NULL,
  `support_term` varchar(100) DEFAULT NULL,
  `pricing_formula` varchar(100) DEFAULT NULL,
  `pricing_factor` decimal(8,2) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_product_templates_date_modfied` (`date_modified`),
  KEY `idx_product_templates_id_del` (`id`,`deleted`),
  KEY `idx_product_templates_date_entered` (`date_entered`),
  KEY `idx_product_templates_name_del` (`name`,`deleted`),
  KEY `idx_producttemplate_status` (`status`),
  KEY `idx_producttemplate_qty_in_stock` (`qty_in_stock`),
  KEY `idx_producttemplate_category` (`category_id`),
  KEY `idx_product_templates_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_templates`
--

LOCK TABLES `product_templates` WRITE;
/*!40000 ALTER TABLE `product_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_templates_audit`
--

DROP TABLE IF EXISTS `product_templates_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_templates_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_product_templates_audit_parent_id` (`parent_id`),
  KEY `idx_product_templates_audit_event_id` (`event_id`),
  KEY `idx_product_templates_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_product_templates_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_templates_audit`
--

LOCK TABLES `product_templates_audit` WRITE;
/*!40000 ALTER TABLE `product_templates_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_templates_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_types` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `list_order` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_product_types_date_modfied` (`date_modified`),
  KEY `idx_product_types_id_del` (`id`,`deleted`),
  KEY `idx_product_types_date_entered` (`date_entered`),
  KEY `idx_product_types_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_types`
--

LOCK TABLES `product_types` WRITE;
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `revenuelineitem_id` char(36) DEFAULT NULL,
  `product_template_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `subtotal` decimal(26,6) DEFAULT '0.000000',
  `total_amount` decimal(26,6) DEFAULT '0.000000',
  `type_id` char(36) DEFAULT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `manufacturer_id` char(36) DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  `mft_part_num` varchar(50) DEFAULT NULL,
  `vendor_part_num` varchar(50) DEFAULT NULL,
  `date_purchased` date DEFAULT NULL,
  `cost_price` decimal(26,6) DEFAULT NULL,
  `discount_price` decimal(26,6) DEFAULT '0.000000',
  `discount_amount` decimal(26,6) DEFAULT '0.000000',
  `discount_rate_percent` decimal(26,2) DEFAULT NULL,
  `discount_amount_usdollar` decimal(26,6) DEFAULT NULL,
  `discount_select` tinyint(1) DEFAULT '1',
  `deal_calc` decimal(26,6) DEFAULT NULL,
  `deal_calc_usdollar` decimal(26,6) DEFAULT NULL,
  `list_price` decimal(26,6) DEFAULT NULL,
  `cost_usdollar` decimal(26,6) DEFAULT NULL,
  `discount_usdollar` decimal(26,6) DEFAULT NULL,
  `list_usdollar` decimal(26,6) DEFAULT NULL,
  `status` varchar(100) DEFAULT '',
  `tax_class` varchar(100) DEFAULT 'Taxable',
  `website` varchar(255) DEFAULT NULL,
  `weight` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(12,2) DEFAULT '1.00',
  `support_name` varchar(50) DEFAULT NULL,
  `support_description` varchar(255) DEFAULT NULL,
  `support_contact` varchar(50) DEFAULT NULL,
  `support_term` varchar(100) DEFAULT NULL,
  `date_support_expires` date DEFAULT NULL,
  `date_support_starts` date DEFAULT NULL,
  `pricing_formula` varchar(100) DEFAULT NULL,
  `pricing_factor` int(4) DEFAULT NULL,
  `serial_number` varchar(50) DEFAULT NULL,
  `asset_number` varchar(50) DEFAULT NULL,
  `book_value` decimal(26,6) DEFAULT NULL,
  `book_value_usdollar` decimal(26,6) DEFAULT NULL,
  `book_value_date` date DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `date_closed_timestamp` bigint(20) unsigned DEFAULT NULL,
  `next_step` varchar(100) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_products_date_modfied` (`date_modified`),
  KEY `idx_products_id_del` (`id`,`deleted`),
  KEY `idx_products_date_entered` (`date_entered`),
  KEY `idx_products_name_del` (`name`,`deleted`),
  KEY `idx_prod_user_dc_timestamp` (`id`,`assigned_user_id`,`date_closed_timestamp`),
  KEY `idx_product_quantity` (`quantity`),
  KEY `idx_product_contact` (`contact_id`),
  KEY `idx_product_account` (`account_id`),
  KEY `idx_product_opp` (`opportunity_id`),
  KEY `idx_product_quote` (`quote_id`),
  KEY `idx_product_rli` (`revenuelineitem_id`),
  KEY `idx_products_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_products_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_products_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_audit`
--

DROP TABLE IF EXISTS `products_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_products_audit_parent_id` (`parent_id`),
  KEY `idx_products_audit_event_id` (`event_id`),
  KEY `idx_products_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_products_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_audit`
--

LOCK TABLES `products_audit` WRITE;
/*!40000 ALTER TABLE `products_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `estimated_start_date` date DEFAULT NULL,
  `estimated_end_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `is_template` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_project_name` (`name`),
  KEY `idx_project_estimated_start_date` (`estimated_start_date`),
  KEY `idx_project_estimated_end_date` (`estimated_end_date`),
  KEY `idx_project_status` (`status`),
  KEY `idx_project_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_project_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_resources`
--

DROP TABLE IF EXISTS `project_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_resources` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `resource_id` char(36) DEFAULT NULL,
  `resource_type` varchar(20) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_resources`
--

LOCK TABLES `project_resources` WRITE;
/*!40000 ALTER TABLE `project_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_task`
--

DROP TABLE IF EXISTS `project_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_task` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `project_id` char(36) NOT NULL,
  `project_task_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` text,
  `resource_id` text,
  `predecessors` text,
  `date_start` date DEFAULT NULL,
  `time_start` int(11) DEFAULT NULL,
  `time_finish` int(11) DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `duration_unit` text,
  `actual_duration` int(11) DEFAULT NULL,
  `percent_complete` int(11) DEFAULT NULL,
  `date_due` date DEFAULT NULL,
  `time_due` time DEFAULT NULL,
  `parent_task_id` int(11) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `milestone_flag` tinyint(1) DEFAULT '0',
  `order_number` int(11) DEFAULT '1',
  `task_number` int(11) DEFAULT NULL,
  `estimated_effort` int(11) DEFAULT NULL,
  `actual_effort` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `utilization` int(11) DEFAULT '100',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_project_task_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_project_task_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_task`
--

LOCK TABLES `project_task` WRITE;
/*!40000 ALTER TABLE `project_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_task_audit`
--

DROP TABLE IF EXISTS `project_task_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_task_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_project_task_audit_parent_id` (`parent_id`),
  KEY `idx_project_task_audit_event_id` (`event_id`),
  KEY `idx_project_task_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_project_task_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_task_audit`
--

LOCK TABLES `project_task_audit` WRITE;
/*!40000 ALTER TABLE `project_task_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_task_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_accounts`
--

DROP TABLE IF EXISTS `projects_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_accounts` (
  `id` char(36) NOT NULL,
  `account_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_acct_proj` (`project_id`),
  KEY `idx_proj_acct_acct` (`account_id`),
  KEY `projects_accounts_alt` (`project_id`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_accounts`
--

LOCK TABLES `projects_accounts` WRITE;
/*!40000 ALTER TABLE `projects_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_bugs`
--

DROP TABLE IF EXISTS `projects_bugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_bugs` (
  `id` char(36) NOT NULL,
  `bug_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_bug_proj` (`project_id`),
  KEY `idx_proj_bug_bug` (`bug_id`),
  KEY `projects_bugs_alt` (`project_id`,`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_bugs`
--

LOCK TABLES `projects_bugs` WRITE;
/*!40000 ALTER TABLE `projects_bugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_bugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_cases`
--

DROP TABLE IF EXISTS `projects_cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_cases` (
  `id` char(36) NOT NULL,
  `case_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_case_proj` (`project_id`),
  KEY `idx_proj_case_case` (`case_id`),
  KEY `projects_cases_alt` (`project_id`,`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_cases`
--

LOCK TABLES `projects_cases` WRITE;
/*!40000 ALTER TABLE `projects_cases` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_contacts`
--

DROP TABLE IF EXISTS `projects_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_contacts` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_con_proj` (`project_id`),
  KEY `idx_proj_con_con` (`contact_id`),
  KEY `projects_contacts_alt` (`project_id`,`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_contacts`
--

LOCK TABLES `projects_contacts` WRITE;
/*!40000 ALTER TABLE `projects_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_opportunities`
--

DROP TABLE IF EXISTS `projects_opportunities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_opportunities` (
  `id` char(36) NOT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_opp_proj` (`project_id`),
  KEY `idx_proj_opp_opp` (`opportunity_id`),
  KEY `projects_opportunities_alt` (`project_id`,`opportunity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_opportunities`
--

LOCK TABLES `projects_opportunities` WRITE;
/*!40000 ALTER TABLE `projects_opportunities` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_opportunities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_products`
--

DROP TABLE IF EXISTS `projects_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_products` (
  `id` char(36) NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_prod_project` (`project_id`),
  KEY `idx_proj_prod_product` (`product_id`),
  KEY `projects_products_alt` (`project_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_products`
--

LOCK TABLES `projects_products` WRITE;
/*!40000 ALTER TABLE `projects_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_quotes`
--

DROP TABLE IF EXISTS `projects_quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_quotes` (
  `id` char(36) NOT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_quote_proj` (`project_id`),
  KEY `idx_proj_quote_quote` (`quote_id`),
  KEY `projects_quotes_alt` (`project_id`,`quote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_quotes`
--

LOCK TABLES `projects_quotes` WRITE;
/*!40000 ALTER TABLE `projects_quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_revenue_line_items`
--

DROP TABLE IF EXISTS `projects_revenue_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_revenue_line_items` (
  `id` char(36) NOT NULL,
  `rli_id` char(36) DEFAULT NULL,
  `project_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_proj_rli_project` (`project_id`),
  KEY `idx_proj_rli_product` (`rli_id`),
  KEY `projects_rli_alt` (`project_id`,`rli_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_revenue_line_items`
--

LOCK TABLES `projects_revenue_line_items` WRITE;
/*!40000 ALTER TABLE `projects_revenue_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_revenue_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospect_list_campaigns`
--

DROP TABLE IF EXISTS `prospect_list_campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospect_list_campaigns` (
  `id` char(36) NOT NULL,
  `prospect_list_id` char(36) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_pro_id` (`prospect_list_id`),
  KEY `idx_cam_id` (`campaign_id`),
  KEY `idx_prospect_list_campaigns` (`prospect_list_id`,`campaign_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospect_list_campaigns`
--

LOCK TABLES `prospect_list_campaigns` WRITE;
/*!40000 ALTER TABLE `prospect_list_campaigns` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospect_list_campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospect_lists`
--

DROP TABLE IF EXISTS `prospect_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospect_lists` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `list_type` varchar(100) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `description` text,
  `domain_name` varchar(255) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_prospect_list_name` (`name`),
  KEY `idx_prospect_list_list_type` (`list_type`),
  KEY `idx_prospect_list_date_entered` (`date_entered`),
  KEY `idx_prospect_lists_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_prospect_lists_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_prospect_lists_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospect_lists`
--

LOCK TABLES `prospect_lists` WRITE;
/*!40000 ALTER TABLE `prospect_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospect_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospect_lists_prospects`
--

DROP TABLE IF EXISTS `prospect_lists_prospects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospect_lists_prospects` (
  `id` char(36) NOT NULL,
  `prospect_list_id` char(36) DEFAULT NULL,
  `related_id` char(36) DEFAULT NULL,
  `related_type` varchar(25) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_plp_pro_id` (`prospect_list_id`),
  KEY `idx_plp_rel_id` (`related_id`,`related_type`,`prospect_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospect_lists_prospects`
--

LOCK TABLES `prospect_lists_prospects` WRITE;
/*!40000 ALTER TABLE `prospect_lists_prospects` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospect_lists_prospects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospects`
--

DROP TABLE IF EXISTS `prospects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospects` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `salutation` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `googleplus` varchar(100) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `do_not_call` tinyint(1) DEFAULT '0',
  `phone_home` varchar(100) DEFAULT NULL,
  `phone_mobile` varchar(100) DEFAULT NULL,
  `phone_work` varchar(100) DEFAULT NULL,
  `phone_other` varchar(100) DEFAULT NULL,
  `phone_fax` varchar(100) DEFAULT NULL,
  `primary_address_street` varchar(150) DEFAULT NULL,
  `primary_address_city` varchar(100) DEFAULT NULL,
  `primary_address_state` varchar(100) DEFAULT NULL,
  `primary_address_postalcode` varchar(20) DEFAULT NULL,
  `primary_address_country` varchar(255) DEFAULT NULL,
  `alt_address_street` varchar(150) DEFAULT NULL,
  `alt_address_city` varchar(100) DEFAULT NULL,
  `alt_address_state` varchar(100) DEFAULT NULL,
  `alt_address_postalcode` varchar(20) DEFAULT NULL,
  `alt_address_country` varchar(255) DEFAULT NULL,
  `assistant` varchar(75) DEFAULT NULL,
  `assistant_phone` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `tracker_key` int(11) NOT NULL AUTO_INCREMENT,
  `birthdate` date DEFAULT NULL,
  `lead_id` char(36) DEFAULT NULL,
  `account_name` varchar(150) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `dp_business_purpose` text,
  `dp_consent_last_updated` date DEFAULT NULL,
  `dnb_principal_id` varchar(30) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `pri_latitude` decimal(20,12) DEFAULT NULL,
  `pri_longitude` decimal(20,12) DEFAULT NULL,
  `alt_latitude` decimal(20,12) DEFAULT NULL,
  `alt_longitude` decimal(20,12) DEFAULT NULL,
  `last_call_status` varchar(100) DEFAULT '',
  `last_call_date` datetime DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Draw data',
  PRIMARY KEY (`id`),
  KEY `idx_prospects_date_modfied` (`date_modified`),
  KEY `idx_prospects_id_del` (`id`,`deleted`),
  KEY `idx_prospects_date_entered` (`date_entered`),
  KEY `idx_prospects_last_first` (`last_name`,`first_name`,`deleted`),
  KEY `idx_prospects_first_last` (`first_name`,`last_name`,`deleted`),
  KEY `prospect_auto_tracker_key` (`tracker_key`),
  KEY `idx_prospecs_del_last` (`last_name`,`deleted`),
  KEY `idx_prospects_assigned` (`assigned_user_id`),
  KEY `idx_prospect_title` (`title`),
  KEY `idx_prospects_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_prospects_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_prospects_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospects`
--

LOCK TABLES `prospects` WRITE;
/*!40000 ALTER TABLE `prospects` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospects_audit`
--

DROP TABLE IF EXISTS `prospects_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospects_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_prospects_audit_parent_id` (`parent_id`),
  KEY `idx_prospects_audit_event_id` (`event_id`),
  KEY `idx_prospects_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_prospects_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospects_audit`
--

LOCK TABLES `prospects_audit` WRITE;
/*!40000 ALTER TABLE `prospects_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospects_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospects_dataprivacy`
--

DROP TABLE IF EXISTS `prospects_dataprivacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospects_dataprivacy` (
  `id` char(36) NOT NULL,
  `prospect_id` char(36) DEFAULT NULL,
  `dataprivacy_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_prospect_dataprivacy_prospect` (`prospect_id`),
  KEY `idx_prospect_dataprivacy_dataprivacy` (`dataprivacy_id`),
  KEY `idx_prospects_dataprivacy` (`prospect_id`,`dataprivacy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospects_dataprivacy`
--

LOCK TABLES `prospects_dataprivacy` WRITE;
/*!40000 ALTER TABLE `prospects_dataprivacy` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospects_dataprivacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotas`
--

DROP TABLE IF EXISTS `quotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotas` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `user_id` char(36) DEFAULT NULL,
  `timeperiod_id` char(36) DEFAULT NULL,
  `quota_type` varchar(100) DEFAULT NULL,
  `amount` decimal(26,6) DEFAULT NULL,
  `amount_base_currency` decimal(26,6) DEFAULT NULL,
  `committed` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_quotas_date_modfied` (`date_modified`),
  KEY `idx_quotas_id_del` (`id`,`deleted`),
  KEY `idx_quotas_date_entered` (`date_entered`),
  KEY `idx_quotas_name_del` (`name`,`deleted`),
  KEY `idx_quota_user_tp` (`user_id`,`timeperiod_id`),
  KEY `idx_quotas_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotas`
--

LOCK TABLES `quotas` WRITE;
/*!40000 ALTER TABLE `quotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotas_audit`
--

DROP TABLE IF EXISTS `quotas_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotas_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_quotas_audit_parent_id` (`parent_id`),
  KEY `idx_quotas_audit_event_id` (`event_id`),
  KEY `idx_quotas_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_quotas_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotas_audit`
--

LOCK TABLES `quotas_audit` WRITE;
/*!40000 ALTER TABLE `quotas_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotas_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `shipper_id` char(36) DEFAULT NULL,
  `taxrate_id` char(36) DEFAULT NULL,
  `taxrate_value` decimal(26,6) DEFAULT '0.000000',
  `show_line_nums` tinyint(1) DEFAULT '1',
  `quote_type` varchar(255) DEFAULT NULL,
  `date_quote_expected_closed` date DEFAULT NULL,
  `original_po_date` date DEFAULT NULL,
  `payment_terms` varchar(128) DEFAULT NULL,
  `date_quote_closed` date DEFAULT NULL,
  `date_order_shipped` date DEFAULT NULL,
  `order_stage` varchar(100) DEFAULT NULL,
  `quote_stage` varchar(100) DEFAULT NULL,
  `purchase_order_num` varchar(50) DEFAULT NULL,
  `quote_num` int(11) NOT NULL AUTO_INCREMENT,
  `subtotal` decimal(26,6) DEFAULT NULL,
  `subtotal_usdollar` decimal(26,6) DEFAULT NULL,
  `shipping` decimal(26,6) DEFAULT '0.000000',
  `shipping_usdollar` decimal(26,6) DEFAULT NULL,
  `discount` decimal(26,6) DEFAULT '0.000000',
  `deal_tot` decimal(26,2) DEFAULT NULL,
  `deal_tot_discount_percentage` decimal(26,2) DEFAULT '0.00',
  `deal_tot_usdollar` decimal(26,2) DEFAULT NULL,
  `new_sub` decimal(26,6) DEFAULT NULL,
  `new_sub_usdollar` decimal(26,6) DEFAULT NULL,
  `taxable_subtotal` decimal(26,6) DEFAULT NULL,
  `tax` decimal(26,6) DEFAULT '0.000000',
  `tax_usdollar` decimal(26,6) DEFAULT NULL,
  `total` decimal(26,6) DEFAULT NULL,
  `total_usdollar` decimal(26,6) DEFAULT NULL,
  `billing_address_street` varchar(150) DEFAULT NULL,
  `billing_address_city` varchar(100) DEFAULT NULL,
  `billing_address_state` varchar(100) DEFAULT NULL,
  `billing_address_postalcode` varchar(20) DEFAULT NULL,
  `billing_address_country` varchar(100) DEFAULT NULL,
  `shipping_address_street` varchar(150) DEFAULT NULL,
  `shipping_address_city` varchar(100) DEFAULT NULL,
  `shipping_address_state` varchar(100) DEFAULT NULL,
  `shipping_address_postalcode` varchar(20) DEFAULT NULL,
  `shipping_address_country` varchar(100) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  `pri_latitude` decimal(20,12) DEFAULT NULL,
  `pri_longitude` decimal(20,12) DEFAULT NULL,
  `alt_latitude` decimal(20,12) DEFAULT NULL,
  `alt_longitude` decimal(20,12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quote_num` (`quote_num`),
  KEY `idx_quotes_date_modfied` (`date_modified`),
  KEY `idx_quotes_id_del` (`id`,`deleted`),
  KEY `idx_quotes_date_entered` (`date_entered`),
  KEY `idx_quotes_name_del` (`name`,`deleted`),
  KEY `idx_qte_name` (`name`),
  KEY `idx_quote_quote_stage` (`quote_stage`),
  KEY `idx_quote_date_quote_expected_closed` (`date_quote_expected_closed`),
  KEY `idx_quotes_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_quotes_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_quotes_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_accounts`
--

DROP TABLE IF EXISTS `quotes_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_accounts` (
  `id` char(36) NOT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `account_role` varchar(20) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_acc_qte_acc` (`account_id`),
  KEY `idx_acc_qte_opp` (`quote_id`),
  KEY `idx_quote_account_role` (`quote_id`,`account_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_accounts`
--

LOCK TABLES `quotes_accounts` WRITE;
/*!40000 ALTER TABLE `quotes_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_audit`
--

DROP TABLE IF EXISTS `quotes_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_quotes_audit_parent_id` (`parent_id`),
  KEY `idx_quotes_audit_event_id` (`event_id`),
  KEY `idx_quotes_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_quotes_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_audit`
--

LOCK TABLES `quotes_audit` WRITE;
/*!40000 ALTER TABLE `quotes_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_b_invoices_1_c`
--

DROP TABLE IF EXISTS `quotes_b_invoices_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_b_invoices_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `quotes_b_invoices_1quotes_ida` char(36) DEFAULT NULL,
  `quotes_b_invoices_1b_invoices_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_quotes_b_invoices_1_ida1_deleted` (`quotes_b_invoices_1quotes_ida`,`deleted`),
  KEY `idx_quotes_b_invoices_1_idb2_deleted` (`quotes_b_invoices_1b_invoices_idb`,`deleted`),
  KEY `quotes_b_invoices_1_alt` (`quotes_b_invoices_1b_invoices_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_b_invoices_1_c`
--

LOCK TABLES `quotes_b_invoices_1_c` WRITE;
/*!40000 ALTER TABLE `quotes_b_invoices_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_b_invoices_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_c_sitedeployment_1_c`
--

DROP TABLE IF EXISTS `quotes_c_sitedeployment_1_c`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_c_sitedeployment_1_c` (
  `id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `quotes_c_sitedeployment_1quotes_ida` char(36) DEFAULT NULL,
  `quotes_c_sitedeployment_1c_sitedeployment_idb` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_quotes_c_sitedeployment_1_ida1_deleted` (`quotes_c_sitedeployment_1quotes_ida`,`deleted`),
  KEY `idx_quotes_c_sitedeployment_1_idb2_deleted` (`quotes_c_sitedeployment_1c_sitedeployment_idb`,`deleted`),
  KEY `quotes_c_sitedeployment_1_alt` (`quotes_c_sitedeployment_1c_sitedeployment_idb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_c_sitedeployment_1_c`
--

LOCK TABLES `quotes_c_sitedeployment_1_c` WRITE;
/*!40000 ALTER TABLE `quotes_c_sitedeployment_1_c` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_c_sitedeployment_1_c` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_contacts`
--

DROP TABLE IF EXISTS `quotes_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_contacts` (
  `id` char(36) NOT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `contact_role` varchar(20) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_con_qte_con` (`contact_id`),
  KEY `idx_con_qte_opp` (`quote_id`),
  KEY `idx_quote_contact_role` (`quote_id`,`contact_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_contacts`
--

LOCK TABLES `quotes_contacts` WRITE;
/*!40000 ALTER TABLE `quotes_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_opportunities`
--

DROP TABLE IF EXISTS `quotes_opportunities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_opportunities` (
  `id` char(36) NOT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_opp_qte_opp` (`opportunity_id`),
  KEY `idx_quote_oportunities` (`quote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_opportunities`
--

LOCK TABLES `quotes_opportunities` WRITE;
/*!40000 ALTER TABLE `quotes_opportunities` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes_opportunities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record_list`
--

DROP TABLE IF EXISTS `record_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record_list` (
  `id` char(36) NOT NULL,
  `assigned_user_id` char(36) NOT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `records` longtext,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record_list`
--

LOCK TABLES `record_list` WRITE;
/*!40000 ALTER TABLE `record_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `record_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `releases`
--

DROP TABLE IF EXISTS `releases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `releases` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `list_order` int(4) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_releases` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `releases`
--

LOCK TABLES `releases` WRITE;
/*!40000 ALTER TABLE `releases` DISABLE KEYS */;
/*!40000 ALTER TABLE `releases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_cache`
--

DROP TABLE IF EXISTS `report_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_cache` (
  `id` char(36) NOT NULL,
  `assigned_user_id` char(36) NOT NULL,
  `contents` text,
  `report_options` text,
  `deleted` varchar(1) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`assigned_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_cache`
--

LOCK TABLES `report_cache` WRITE;
/*!40000 ALTER TABLE `report_cache` DISABLE KEYS */;
INSERT INTO `report_cache` VALUES ('b6109d86-3699-11e9-af75-00e04c360044','1','{\"filters_def\":{\"Filter_1\":{\"operator\":\"AND\",\"0\":{\"name\":\"account_type\",\"table_key\":\"self\",\"qualifier_name\":\"one_of\",\"runtime\":1,\"input_name0\":[\"Customer\"]},\"1\":{\"name\":\"industry\",\"table_key\":\"self\",\"qualifier_name\":\"not_empty\",\"runtime\":1,\"input_name0\":\"not_empty\",\"input_name1\":\"on\"}}}}',NULL,'0','2019-07-26 05:29:03','2019-07-26 05:29:03'),('b78196b6-3699-11e9-842a-00e04c360044','1','{\"filters_def\":{\"Filter_1\":{\"operator\":\"AND\"}}}',NULL,'0','2019-07-26 05:28:39','2019-07-26 05:28:39'),('bdecb3be-3699-11e9-a030-00e04c360044','1','{\"filters_def\":{\"Filter_1\":{\"operator\":\"AND\",\"0\":{\"name\":\"date_entered\",\"table_key\":\"self\",\"qualifier_name\":\"tp_this_year\",\"runtime\":1,\"input_name0\":\"tp_this_year\",\"input_name1\":\"on\"},\"1\":{\"name\":\"sales_status\",\"table_key\":\"self\",\"qualifier_name\":\"not_empty\",\"runtime\":1,\"input_name0\":\"not_empty\",\"input_name1\":\"on\"}}}}',NULL,'0','2019-02-22 14:45:08','2020-02-21 04:56:32');
/*!40000 ALTER TABLE `report_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_maker`
--

DROP TABLE IF EXISTS `report_maker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_maker` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `report_align` varchar(8) DEFAULT NULL,
  `description` text,
  `scheduled` tinyint(1) DEFAULT '0',
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_rmaker` (`name`,`deleted`),
  KEY `idx_report_maker_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_report_maker_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_maker`
--

LOCK TABLES `report_maker` WRITE;
/*!40000 ALTER TABLE `report_maker` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_maker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_schedules`
--

DROP TABLE IF EXISTS `report_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_schedules` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `user_id` char(36) DEFAULT NULL,
  `report_id` char(36) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `time_interval` int(11) DEFAULT '604800',
  `next_run` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `schedule_type` varchar(3) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_report_schedules_date_modfied` (`date_modified`),
  KEY `idx_report_schedules_id_del` (`id`,`deleted`),
  KEY `idx_report_schedules_date_entered` (`date_entered`),
  KEY `idx_report_schedules_name_del` (`name`,`deleted`),
  KEY `idx_report_schedules_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_report_schedules_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_report_schedules_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_schedules`
--

LOCK TABLES `report_schedules` WRITE;
/*!40000 ALTER TABLE `report_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_schedules_audit`
--

DROP TABLE IF EXISTS `report_schedules_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_schedules_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_report_schedules_audit_parent_id` (`parent_id`),
  KEY `idx_report_schedules_audit_event_id` (`event_id`),
  KEY `idx_report_schedules_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_report_schedules_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_schedules_audit`
--

LOCK TABLES `report_schedules_audit` WRITE;
/*!40000 ALTER TABLE `report_schedules_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_schedules_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportschedules_users`
--

DROP TABLE IF EXISTS `reportschedules_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportschedules_users` (
  `id` char(36) NOT NULL,
  `reportschedule_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_usr_rs_rs` (`reportschedule_id`),
  KEY `idx_usr_rs_usr` (`user_id`),
  KEY `idx_rs_users` (`reportschedule_id`,`user_id`),
  KEY `idx_reportschedule_users_del` (`reportschedule_id`,`user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportschedules_users`
--

LOCK TABLES `reportschedules_users` WRITE;
/*!40000 ALTER TABLE `reportschedules_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `reportschedules_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revenue_line_items`
--

DROP TABLE IF EXISTS `revenue_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revenue_line_items` (
  `id` char(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `product_template_id` char(36) DEFAULT NULL,
  `account_id` char(36) DEFAULT NULL,
  `total_amount` decimal(26,6) DEFAULT NULL,
  `type_id` char(36) DEFAULT NULL,
  `quote_id` char(36) DEFAULT NULL,
  `manufacturer_id` char(36) DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  `mft_part_num` varchar(50) DEFAULT NULL,
  `vendor_part_num` varchar(50) DEFAULT NULL,
  `date_purchased` date DEFAULT NULL,
  `cost_price` decimal(26,6) DEFAULT NULL,
  `discount_price` decimal(26,6) DEFAULT NULL,
  `discount_amount` decimal(26,6) DEFAULT NULL,
  `discount_rate_percent` decimal(26,2) DEFAULT NULL,
  `discount_amount_usdollar` decimal(26,6) DEFAULT NULL,
  `discount_select` tinyint(1) DEFAULT '0',
  `deal_calc` decimal(26,6) DEFAULT NULL,
  `deal_calc_usdollar` decimal(26,6) DEFAULT NULL,
  `list_price` decimal(26,6) DEFAULT NULL,
  `cost_usdollar` decimal(26,6) DEFAULT NULL,
  `discount_usdollar` decimal(26,6) DEFAULT NULL,
  `list_usdollar` decimal(26,6) DEFAULT NULL,
  `status` varchar(100) DEFAULT '',
  `tax_class` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `weight` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(12,2) DEFAULT '1.00',
  `support_name` varchar(50) DEFAULT NULL,
  `support_description` varchar(255) DEFAULT NULL,
  `support_contact` varchar(50) DEFAULT NULL,
  `support_term` varchar(100) DEFAULT NULL,
  `date_support_expires` date DEFAULT NULL,
  `date_support_starts` date DEFAULT NULL,
  `pricing_formula` varchar(100) DEFAULT NULL,
  `pricing_factor` int(4) DEFAULT NULL,
  `serial_number` varchar(50) DEFAULT NULL,
  `asset_number` varchar(50) DEFAULT NULL,
  `book_value` decimal(26,6) DEFAULT NULL,
  `book_value_usdollar` decimal(26,6) DEFAULT NULL,
  `book_value_date` date DEFAULT NULL,
  `best_case` decimal(26,6) DEFAULT NULL,
  `likely_case` decimal(26,6) DEFAULT NULL,
  `worst_case` decimal(26,6) DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `date_closed_timestamp` bigint(20) unsigned DEFAULT NULL,
  `next_step` varchar(100) DEFAULT NULL,
  `commit_stage` varchar(50) DEFAULT 'exclude',
  `sales_stage` varchar(255) DEFAULT 'Prospecting',
  `probability` double DEFAULT NULL,
  `lead_source` varchar(50) DEFAULT NULL,
  `campaign_id` char(36) DEFAULT NULL,
  `opportunity_id` char(36) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `base_rate` decimal(26,6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_revenue_line_items_date_modfied` (`date_modified`),
  KEY `idx_revenue_line_items_id_del` (`id`,`deleted`),
  KEY `idx_revenue_line_items_date_entered` (`date_entered`),
  KEY `idx_revenue_line_items_name_del` (`name`,`deleted`),
  KEY `idx_rli_user_dc_timestamp` (`id`,`assigned_user_id`,`date_closed_timestamp`),
  KEY `idx_revenuelineitem_sales_stage` (`sales_stage`),
  KEY `idx_revenuelineitem_probability` (`probability`),
  KEY `idx_revenuelineitem_commit_stage` (`commit_stage`),
  KEY `idx_revenuelineitem_quantity` (`quantity`),
  KEY `idx_revenuelineitem_oppid` (`opportunity_id`),
  KEY `idx_revenue_line_items_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_revenue_line_items_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_revenue_line_items_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revenue_line_items`
--

LOCK TABLES `revenue_line_items` WRITE;
/*!40000 ALTER TABLE `revenue_line_items` DISABLE KEYS */;
INSERT INTO `revenue_line_items` VALUES ('2700ce2b-2a82-40a3-b9c3-caa409036530','đasadsa','2019-03-12 17:55:03','2019-03-12 17:55:03','1','1',NULL,0,NULL,'16e92f80-36b6-11e9-b08f-00e04c360044',1000000.000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1000000.000000,NULL,NULL,NULL,0,0.000000,0.000000,NULL,NULL,1000000.000000,NULL,NULL,NULL,NULL,NULL,1.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1000000.000000,1000000.000000,1000000.000000,'2019-02-26',1551139200,NULL,'include','Closed Won',100,NULL,NULL,'f6e85d9e-44ef-11e9-8260-1c4d7023ffd7',NULL,'1','1','1','f72853d6-44ef-11e9-9e6f-1c4d7023ffd7','-99',1.000000),('323e8005-f00b-48a7-96b5-09088bd07f92','ádadas','2019-03-12 17:58:27','2019-03-12 17:58:27','1','1',NULL,0,NULL,'16e92f80-36b6-11e9-b08f-00e04c360044',60000000.000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,60000000.000000,NULL,NULL,NULL,0,0.000000,0.000000,NULL,NULL,60000000.000000,NULL,NULL,NULL,NULL,NULL,1.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,60000000.000000,60000000.000000,60000000.000000,'2019-02-26',1551139200,NULL,'exclude','Prospecting',10,NULL,NULL,'700756a8-44f0-11e9-9df7-1c4d7023ffd7',NULL,'1','1','1','f72853d6-44ef-11e9-9e6f-1c4d7023ffd7','-99',1.000000);
/*!40000 ALTER TABLE `revenue_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revenue_line_items_audit`
--

DROP TABLE IF EXISTS `revenue_line_items_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revenue_line_items_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_revenue_line_items_audit_parent_id` (`parent_id`),
  KEY `idx_revenue_line_items_audit_event_id` (`event_id`),
  KEY `idx_revenue_line_items_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_revenue_line_items_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revenue_line_items_audit`
--

LOCK TABLES `revenue_line_items_audit` WRITE;
/*!40000 ALTER TABLE `revenue_line_items_audit` DISABLE KEYS */;
INSERT INTO `revenue_line_items_audit` VALUES ('700fe624-44f0-11e9-a75e-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'name','varchar',NULL,'ádadas',NULL,NULL),('70107468-44f0-11e9-984a-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'discount_price','currency','0','60000000.000000',NULL,NULL),('7010c396-44f0-11e9-bc18-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'best_case','currency','0','60000000.000000',NULL,NULL),('70110c2a-44f0-11e9-b0cf-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'likely_case','currency','0','60000000.000000',NULL,NULL),('70116698-44f0-11e9-9c33-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'worst_case','currency','0','60000000.000000',NULL,NULL),('7011c6d8-44f0-11e9-8c60-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'date_closed','date',NULL,'2019-02-26',NULL,NULL),('70123a96-44f0-11e9-ab16-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'date_closed_timestamp','ulong','0','1551114000',NULL,NULL),('7012a896-44f0-11e9-877c-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'sales_stage','enum',NULL,'Prospecting',NULL,NULL),('7012fc42-44f0-11e9-bba8-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'probability','double','0','10',NULL,NULL),('70134512-44f0-11e9-97cc-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL),('70138a18-44f0-11e9-8a7d-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','700df9ea-44f0-11e9-9532-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'team_id','id',NULL,'1',NULL,NULL),('703a33d4-44f0-11e9-af37-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','7039e69a-44f0-11e9-925c-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'date_closed_timestamp','ulong','1551114000','1551139200',NULL,NULL),('708e267e-44f0-11e9-880e-1c4d7023ffd7','323e8005-f00b-48a7-96b5-09088bd07f92','708ddfa2-44f0-11e9-8882-1c4d7023ffd7','2019-03-12 17:58:27','1',NULL,'account_id','id',NULL,'16e92f80-36b6-11e9-b08f-00e04c360044',NULL,NULL),('f6f0bcb4-44ef-11e9-b7fb-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'name','varchar',NULL,'đasadsa',NULL,NULL),('f6f27f0e-44ef-11e9-8116-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'discount_price','currency','0','1000000.000000',NULL,NULL),('f6f2d2ec-44ef-11e9-8d2c-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'best_case','currency','0','1000000.000000',NULL,NULL),('f6f32972-44ef-11e9-a415-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'likely_case','currency','0','1000000.000000',NULL,NULL),('f6f37d1e-44ef-11e9-8667-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'worst_case','currency','0','1000000.000000',NULL,NULL),('f6f3c4fe-44ef-11e9-8bf9-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'date_closed','date',NULL,'2019-02-26',NULL,NULL),('f6f42994-44ef-11e9-9a96-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'date_closed_timestamp','ulong','0','1551114000',NULL,NULL),('f6f4a3ec-44ef-11e9-a593-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'sales_stage','enum',NULL,'Closed Won',NULL,NULL),('f6f53e06-44ef-11e9-96e7-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'probability','double','0','100',NULL,NULL),('f6f58cd0-44ef-11e9-94db-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL),('f6f5d37a-44ef-11e9-9af8-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f6f01c1e-44ef-11e9-84db-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'team_id','id',NULL,'1',NULL,NULL),('f72501a4-44ef-11e9-8870-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f7249e9e-44ef-11e9-8c44-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'date_closed_timestamp','ulong','1551114000','1551139200',NULL,NULL),('f7926ef6-44ef-11e9-beb6-1c4d7023ffd7','2700ce2b-2a82-40a3-b9c3-caa409036530','f7922266-44ef-11e9-9e6a-1c4d7023ffd7','2019-03-12 17:55:03','1',NULL,'account_id','id',NULL,'16e92f80-36b6-11e9-b08f-00e04c360044',NULL,NULL);
/*!40000 ALTER TABLE `revenue_line_items_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `modules` text,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_role_id_del` (`id`,`deleted`),
  KEY `idx_role_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_modules`
--

DROP TABLE IF EXISTS `roles_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_modules` (
  `id` char(36) NOT NULL,
  `role_id` char(36) DEFAULT NULL,
  `module_id` char(36) DEFAULT NULL,
  `allow` tinyint(1) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_role_id` (`role_id`),
  KEY `idx_module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_modules`
--

LOCK TABLES `roles_modules` WRITE;
/*!40000 ALTER TABLE `roles_modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_users` (
  `id` char(36) NOT NULL,
  `role_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_ru_role_id` (`role_id`),
  KEY `idx_ru_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_users`
--

LOCK TABLES `roles_users` WRITE;
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rt_dotbboards`
--

DROP TABLE IF EXISTS `rt_dotbboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rt_dotbboards` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `boardModule` varchar(100) DEFAULT NULL,
  `groupBy` varchar(100) DEFAULT NULL,
  `successStage` varchar(100) DEFAULT NULL,
  `failureStage` varchar(100) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_rt_dotbboards_date_modfied` (`date_modified`),
  KEY `idx_rt_dotbboards_id_del` (`id`,`deleted`),
  KEY `idx_rt_dotbboards_date_entered` (`date_entered`),
  KEY `idx_rt_dotbboards_name_del` (`name`,`deleted`),
  KEY `idx_rt_dotbboards_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_rt_dotbboards_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_rt_dotbboards_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rt_dotbboards`
--

LOCK TABLES `rt_dotbboards` WRITE;
/*!40000 ALTER TABLE `rt_dotbboards` DISABLE KEYS */;
/*!40000 ALTER TABLE `rt_dotbboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rt_dotbboards_audit`
--

DROP TABLE IF EXISTS `rt_dotbboards_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rt_dotbboards_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_rt_dotbboards_audit_parent_id` (`parent_id`),
  KEY `idx_rt_dotbboards_audit_event_id` (`event_id`),
  KEY `idx_rt_dotbboards_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_rt_dotbboards_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rt_dotbboards_audit`
--

LOCK TABLES `rt_dotbboards_audit` WRITE;
/*!40000 ALTER TABLE `rt_dotbboards_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `rt_dotbboards_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saved_reports`
--

DROP TABLE IF EXISTS `saved_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saved_reports` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `module` varchar(255) DEFAULT NULL,
  `report_type` varchar(255) DEFAULT NULL,
  `content` longtext,
  `is_published` tinyint(1) DEFAULT '0',
  `chart_type` varchar(36) DEFAULT 'none',
  `schedule_type` varchar(3) DEFAULT 'pro',
  `favorite` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `custom_url` varchar(100) DEFAULT NULL,
  `replace_str` text,
  `is_admin_data` tinyint(1) DEFAULT '0',
  `row_number` tinyint(1) DEFAULT '0',
  `list_of` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_saved_reports_date_modfied` (`date_modified`),
  KEY `idx_saved_reports_id_del` (`id`,`deleted`),
  KEY `idx_saved_reports_date_entered` (`date_entered`),
  KEY `idx_saved_reports_name_del` (`name`,`deleted`),
  KEY `idx_savedreport_module` (`module`),
  KEY `idx_saved_reports_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_saved_reports_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_saved_reports_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saved_reports`
--

LOCK TABLES `saved_reports` WRITE;
/*!40000 ALTER TABLE `saved_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `saved_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saved_search`
--

DROP TABLE IF EXISTS `saved_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saved_search` (
  `id` char(36) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `search_module` varchar(150) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `contents` text,
  `description` text,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_desc` (`name`,`deleted`),
  KEY `idx_saved_search_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_saved_search_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saved_search`
--

LOCK TABLES `saved_search` WRITE;
/*!40000 ALTER TABLE `saved_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `saved_search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedulers`
--

DROP TABLE IF EXISTS `schedulers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedulers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `job` varchar(255) DEFAULT NULL,
  `date_time_start` datetime DEFAULT NULL,
  `date_time_end` datetime DEFAULT NULL,
  `job_interval` varchar(100) DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `last_run` datetime DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `catch_up` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_schedulers_date_modfied` (`date_modified`),
  KEY `idx_schedulers_id_del` (`id`,`deleted`),
  KEY `idx_schedulers_date_entered` (`date_entered`),
  KEY `idx_schedulers_name_del` (`name`,`deleted`),
  KEY `idx_schedule` (`date_time_start`,`deleted`),
  KEY `idx_scheduler_job_interval` (`job_interval`),
  KEY `idx_scheduler_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedulers`
--

LOCK TABLES `schedulers` WRITE;
/*!40000 ALTER TABLE `schedulers` DISABLE KEYS */;
INSERT INTO `schedulers` VALUES ('50118a36-aebc-11e9-9423-00e04c68004f','Activity Stream Record Purger Job','2019-07-25 09:12:22','2019-07-25 09:18:12','1','1',NULL,0,'class::ActivityStreamPurgerJob','2005-01-01 09:15:00',NULL,'0::12::1/15::*::*',NULL,NULL,NULL,'Active',1),('be0eaf32-3699-11e9-8d79-00e04c360044','Process Workflow Tasks','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::processWorkflow','2005-01-01 13:00:01','2020-12-31 23:59:59','*::*::*::*::*',NULL,NULL,NULL,'Active',0),('be14e6f4-3699-11e9-a312-00e04c360044','Run Report Generation Scheduled Tasks','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::processQueue','2005-01-01 06:00:01','2020-12-31 23:59:59','0::6::*::*::*',NULL,NULL,NULL,'Inactive',1),('be15b2d2-3699-11e9-87d1-00e04c360044','Prune Tracker Tables','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::trimTracker','2005-01-01 18:45:01','2020-12-31 23:59:59','0::2::1::*::*',NULL,NULL,NULL,'Active',1),('be166fb0-3699-11e9-9bc1-00e04c360044','Check Inbound Mailboxes','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::pollMonitoredInboxes','2005-01-01 19:15:01','2020-12-31 23:59:59','*::*::*::*::*',NULL,NULL,NULL,'Active',0),('be172c20-3699-11e9-ba9f-00e04c360044','Run Nightly Process Bounced Campaign Emails','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::pollMonitoredInboxesForBouncedCampaignEmails','2005-01-01 11:15:01','2020-12-31 23:59:59','0::2-6::*::*::*',NULL,NULL,NULL,'Active',1),('be17f4d4-3699-11e9-94ff-00e04c360044','Run Nightly Mass Email Campaigns','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::runMassEmailCampaign','2005-01-01 09:15:01','2020-12-31 23:59:59','0::2-6::*::*::*',NULL,NULL,NULL,'Active',1),('be18b5cc-3699-11e9-9f02-00e04c360044','Prune Database on 1st of Month','2019-02-22 12:01:29','2019-07-25 09:14:47','1','1',NULL,0,'function::pruneDatabase','2005-01-01 11:30:00','2021-01-01 00:00:00','0::4::1::*::*',NULL,NULL,NULL,'Inactive',0),('be197bec-3699-11e9-8240-00e04c360044','Update tracker_sessions Table','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::updateTrackerSessions','2005-01-01 14:45:01','2020-12-31 23:59:59','*::*::*::*::*',NULL,NULL,NULL,'Active',1),('be1a3ece-3699-11e9-9224-00e04c360044','Run Email Reminder Notifications','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::sendEmailReminders','2008-01-01 12:00:01','2020-12-31 23:59:59','*::*::*::*::*',NULL,NULL,NULL,'Active',0),('be1afbf2-3699-11e9-b572-00e04c360044','Clean Jobs Queue','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::cleanJobQueue','2012-01-01 18:15:01','2030-12-31 23:59:59','0::5::*::*::*',NULL,NULL,NULL,'Active',0),('be1bbd26-3699-11e9-94a6-00e04c360044','Create Future TimePeriods','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'class::DotbJobCreateNextTimePeriod','2012-01-01 15:00:01','2030-12-31 23:59:59','0::23::*::*::*',NULL,NULL,NULL,'Active',0),('be1c7766-3699-11e9-a286-00e04c360044','Prune Old Record Lists','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::cleanOldRecordLists','2005-01-01 10:45:01','2020-12-31 23:59:59','*::*::*::*::*',NULL,NULL,NULL,'Active',1),('be1df2d0-3699-11e9-a2d4-00e04c360044','Remove temporary files','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'class::DotbJobRemoveTmpFiles','2005-01-01 09:00:01','2030-12-31 23:59:59','0::4::*::*::*',NULL,NULL,NULL,'Active',1),('be1ebbc0-3699-11e9-96b9-00e04c360044','Remove diagnostic tool files','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'class::DotbJobRemoveDiagnosticFiles','2005-01-01 09:45:01','2030-12-31 23:59:59','0::4::*::*::0',NULL,NULL,NULL,'Active',1),('be1fac38-3699-11e9-8cf8-00e04c360044','Remove temporary PDF files','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'class::DotbJobRemovePdfFiles','2005-01-01 14:30:01','2030-12-31 23:59:59','0::4::*::*::*',NULL,NULL,NULL,'Active',1),('be21397c-3699-11e9-ade3-00e04c360044','Advanced Workflow Scheduled Job','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'function::PMSEEngineCron','2015-01-01 13:00:01','2030-12-31 23:59:59','*::*::*::*::*',NULL,NULL,NULL,'Active',1),('be21ff42-3699-11e9-9f9e-00e04c360044','Publish approved articles & Expire KB Articles.','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'class::DotbJobKBContentUpdateArticles','2005-01-01 11:30:01','2030-12-31 23:59:59','0::5::*::*::*',NULL,NULL,NULL,'Active',1),('be22c2d8-3699-11e9-97f3-00e04c360044','Rebuild Denormalized Team Security Data','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'class::Dotbcrm\\Dotbcrm\\Denormalization\\TeamSecurity\\Job\\RebuildJob','2005-01-01 06:00:01','2030-12-31 23:59:59','*/15::*::*::*::*',NULL,NULL,NULL,'Inactive',0),('ec7c55a4-3699-11e9-a7b3-00e04c360044','Elasticsearch Queue Scheduler','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'class::\\Dotbcrm\\Dotbcrm\\Elasticsearch\\Queue\\Scheduler','2001-01-01 00:00:01','2037-12-31 23:59:59','*/1::*::*::*::*',NULL,NULL,NULL,'Active',0);
/*!40000 ALTER TABLE `schedulers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedulers_times`
--

DROP TABLE IF EXISTS `schedulers_times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedulers_times` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `scheduler_id` char(36) NOT NULL,
  `execute_time` datetime DEFAULT NULL,
  `status` varchar(25) DEFAULT 'ready',
  PRIMARY KEY (`id`),
  KEY `idx_scheduler_id` (`scheduler_id`,`execute_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedulers_times`
--

LOCK TABLES `schedulers_times` WRITE;
/*!40000 ALTER TABLE `schedulers_times` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedulers_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_active`
--

DROP TABLE IF EXISTS `session_active`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_active` (
  `id` char(36) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `last_request_time` datetime DEFAULT NULL,
  `session_type` varchar(100) DEFAULT NULL,
  `is_violation` tinyint(1) DEFAULT '0',
  `num_active_sessions` int(11) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_active`
--

LOCK TABLES `session_active` WRITE;
/*!40000 ALTER TABLE `session_active` DISABLE KEYS */;
/*!40000 ALTER TABLE `session_active` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_history`
--

DROP TABLE IF EXISTS `session_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_history` (
  `id` char(36) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `last_request_time` datetime DEFAULT NULL,
  `session_type` varchar(100) DEFAULT NULL,
  `is_violation` tinyint(1) DEFAULT '0',
  `num_active_sessions` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_history`
--

LOCK TABLES `session_history` WRITE;
/*!40000 ALTER TABLE `session_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `session_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shippers`
--

DROP TABLE IF EXISTS `shippers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shippers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `list_order` int(4) DEFAULT NULL,
  `default_cost` decimal(26,6) DEFAULT NULL,
  `default_cost_usdollar` decimal(26,6) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_shippers_date_modfied` (`date_modified`),
  KEY `idx_shippers_id_del` (`id`,`deleted`),
  KEY `idx_shippers_date_entered` (`date_entered`),
  KEY `idx_shippers_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shippers`
--

LOCK TABLES `shippers` WRITE;
/*!40000 ALTER TABLE `shippers` DISABLE KEYS */;
/*!40000 ALTER TABLE `shippers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styleguide`
--

DROP TABLE IF EXISTS `styleguide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `styleguide` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `salutation` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `googleplus` varchar(100) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `do_not_call` tinyint(1) DEFAULT '0',
  `phone_home` varchar(100) DEFAULT NULL,
  `phone_mobile` varchar(100) DEFAULT NULL,
  `phone_work` varchar(100) DEFAULT NULL,
  `phone_other` varchar(100) DEFAULT NULL,
  `phone_fax` varchar(100) DEFAULT NULL,
  `primary_address_street` varchar(150) DEFAULT NULL,
  `primary_address_city` varchar(100) DEFAULT NULL,
  `primary_address_state` varchar(100) DEFAULT NULL,
  `primary_address_postalcode` varchar(20) DEFAULT NULL,
  `primary_address_country` varchar(255) DEFAULT NULL,
  `alt_address_street` varchar(150) DEFAULT NULL,
  `alt_address_city` varchar(100) DEFAULT NULL,
  `alt_address_state` varchar(100) DEFAULT NULL,
  `alt_address_postalcode` varchar(20) DEFAULT NULL,
  `alt_address_country` varchar(255) DEFAULT NULL,
  `assistant` varchar(75) DEFAULT NULL,
  `assistant_phone` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `file_mime_type` varchar(100) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `currency_id` char(36) DEFAULT '-99',
  `list_price` decimal(26,6) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `secret_password` varchar(255) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `radio_button_group` varchar(255) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `pri_latitude` decimal(20,12) DEFAULT NULL,
  `pri_longitude` decimal(20,12) DEFAULT NULL,
  `alt_latitude` decimal(20,12) DEFAULT NULL,
  `alt_longitude` decimal(20,12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_styleguide_date_modfied` (`date_modified`),
  KEY `idx_styleguide_id_del` (`id`,`deleted`),
  KEY `idx_styleguide_date_entered` (`date_entered`),
  KEY `idx_styleguide_last_first` (`last_name`,`first_name`,`deleted`),
  KEY `idx_styleguide_first_last` (`first_name`,`last_name`,`deleted`),
  KEY `idx_styleguide_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styleguide`
--

LOCK TABLES `styleguide` WRITE;
/*!40000 ALTER TABLE `styleguide` DISABLE KEYS */;
/*!40000 ALTER TABLE `styleguide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` char(36) NOT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `parent_type` varchar(100) DEFAULT NULL,
  `parent_id` char(36) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_subscriptions_date_modfied` (`date_modified`),
  KEY `idx_subscriptions_id_del` (`id`,`deleted`),
  KEY `idx_subscriptions_date_entered` (`date_entered`),
  KEY `subscription_parent` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES ('017741d2-4b1f-11e9-a0bf-1e4d7023ffd7','2019-03-20 14:46:54','2019-03-20 14:46:54','1','1',0,'Meetings','0131a5f0-4b1f-11e9-8266-1e4d7023ffd7'),('13e4302e-7949-11ea-811b-038c6356456b','2020-04-08 03:28:55','2020-04-08 03:28:55','1','1',0,'Dashboards','13b20450-7949-11ea-88c8-a38174f123ce'),('1761918c-36b6-11e9-8744-00e04c360044','2019-02-22 15:25:30','2019-08-06 16:09:37','1','1',0,'Accounts','16e92f80-36b6-11e9-b08f-00e04c360044'),('28ce3fc4-1431-11eb-aaf5-00ace43f6d74','2020-10-22 06:38:06','2020-10-22 06:38:06','1','1',0,'Dashboards','24fb2de4-1431-11eb-b65b-00ace43f6d74'),('3b5c550e-498a-11e9-bc95-1c4d7023ffd7','2019-03-18 14:29:25','2019-03-18 14:29:25','1','1',0,'Meetings','3b1b47d0-498a-11e9-baa1-1c4d7023ffd7'),('69d186de-44f3-11e9-a53b-1c4d7023ffd7','2019-03-12 18:19:44','2019-03-12 18:19:44','1','1',0,'Contracts','699e7d84-44f3-11e9-9429-1c4d7023ffd7'),('703e5932-44f0-11e9-a4e9-1c4d7023ffd7','2019-03-12 17:58:27','2019-03-12 17:58:27','1','1',0,'RevenueLineItems','323e8005-f00b-48a7-96b5-09088bd07f92'),('70962b44-44f0-11e9-bf1f-1c4d7023ffd7','2019-03-12 17:58:27','2019-03-12 17:58:27','1','1',0,'Opportunities','700756a8-44f0-11e9-9df7-1c4d7023ffd7'),('7c5569d6-1433-11eb-b999-00ace43f6d74','2020-10-22 06:54:51','2020-10-22 06:54:51','1','1',0,'Dashboards','7bd4216e-1433-11eb-8573-00ace43f6d74'),('7f5b7260-1433-11eb-8f2f-00ace43f6d74','2020-10-22 06:54:56','2020-10-22 06:54:56','1','1',0,'Dashboards','7ecfe394-1433-11eb-b10c-00ace43f6d74'),('b699482e-1433-11eb-a648-00ace43f6d74','2020-10-22 06:56:28','2020-10-22 06:56:28','1','1',0,'Dashboards','b5f57f28-1433-11eb-94be-00ace43f6d74'),('cf864e08-7948-11ea-a86a-b8e1e4e3145d','2020-04-08 03:27:00','2020-04-08 03:27:00','1','1',0,'Dashboards','cf527c72-7948-11ea-8fbc-05261049924a'),('dac19c68-4b1e-11e9-b79d-1e4d7023ffd7','2019-03-20 14:45:49','2019-03-20 14:45:49','1','1',0,'Calls','da75a894-4b1e-11e9-93af-1e4d7023ffd7'),('db780482-44eb-11e9-95b9-1c4d7023ffd7','2019-03-12 17:25:39','2019-03-12 17:25:39','1','1',0,'Leads','db578ef0-44eb-11e9-9245-1c4d7023ffd7'),('e56283d8-3aa9-11e9-98b2-1e4d7023ffd7','2019-02-27 16:08:17','2019-02-27 16:08:17','1','1',0,'Calls','e4dc2342-3aa9-11e9-bbd0-1e4d7023ffd7'),('ea633bf0-3e52-11e9-90e9-00ac92f6ab22','2019-03-04 07:55:44','2019-03-04 07:55:44','1','1',0,'Contacts','ea4ecaa8-3e52-11e9-95e3-00ac92f6ab22'),('ef50e5f4-aa13-11e9-9b50-00e04c68004f','2019-07-19 10:57:00','2019-07-19 10:57:00','1','1',0,'Contacts','ef3ca9cc-aa13-11e9-831e-00e04c68004f'),('f73d2518-44ef-11e9-84f1-1c4d7023ffd7','2019-03-12 17:55:03','2019-03-12 17:55:03','1','1',0,'RevenueLineItems','2700ce2b-2a82-40a3-b9c3-caa409036530'),('f79a4180-44ef-11e9-aaa9-1c4d7023ffd7','2019-03-12 17:55:03','2019-03-12 17:55:03','1','1',0,'Opportunities','f6e85d9e-44ef-11e9-8260-1c4d7023ffd7');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_bean_rel`
--

DROP TABLE IF EXISTS `tag_bean_rel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_bean_rel` (
  `id` char(36) NOT NULL,
  `tag_id` char(36) NOT NULL,
  `bean_id` char(36) NOT NULL,
  `bean_module` varchar(100) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_tagsrel_tagid_beanid` (`tag_id`,`bean_id`),
  KEY `idx_tag_bean_rel_del_bean_module_beanid` (`deleted`,`bean_module`,`bean_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_bean_rel`
--

LOCK TABLES `tag_bean_rel` WRITE;
/*!40000 ALTER TABLE `tag_bean_rel` DISABLE KEYS */;
INSERT INTO `tag_bean_rel` VALUES ('1724d67a-36b6-11e9-9995-00e04c360044','16ec5d86-36b6-11e9-bb11-00e04c360044','16e92f80-36b6-11e9-b08f-00e04c360044','Accounts','2019-02-22 15:25:30',0),('aec21b9a-3699-11e9-897f-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','ae44f462-3699-11e9-bb5a-00e04c360044','Reports','2019-02-22 12:01:29',0),('aec3d778-3699-11e9-bd48-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','ae44f462-3699-11e9-bb5a-00e04c360044','Reports','2019-02-22 12:01:29',0),('aee34bb2-3699-11e9-b34e-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','aec443f2-3699-11e9-b252-00e04c360044','Reports','2019-02-22 12:01:29',0),('aee51898-3699-11e9-a31e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','aec443f2-3699-11e9-b252-00e04c360044','Reports','2019-02-22 12:01:29',0),('af040302-3699-11e9-9410-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','aee59d4a-3699-11e9-9817-00e04c360044','Reports','2019-02-22 12:01:29',0),('af05996a-3699-11e9-8181-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','aee59d4a-3699-11e9-9817-00e04c360044','Reports','2019-02-22 12:01:29',0),('af249eaa-3699-11e9-a0f3-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','af061a52-3699-11e9-a6b7-00e04c360044','Reports','2019-02-22 12:01:29',0),('af2522e4-3699-11e9-b68e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','af061a52-3699-11e9-a6b7-00e04c360044','Reports','2019-02-22 12:01:29',0),('af45689c-3699-11e9-9329-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','af259378-3699-11e9-ae5b-00e04c360044','Reports','2019-02-22 12:01:29',0),('af46f126-3699-11e9-af11-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','af259378-3699-11e9-ae5b-00e04c360044','Reports','2019-02-22 12:01:29',0),('af689272-3699-11e9-b54a-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','af4758c8-3699-11e9-aba0-00e04c360044','Reports','2019-02-22 12:01:29',0),('af6a31ae-3699-11e9-be52-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','af4758c8-3699-11e9-aba0-00e04c360044','Reports','2019-02-22 12:01:29',0),('af894a94-3699-11e9-aebc-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','af6a9414-3699-11e9-a4de-00e04c360044','Reports','2019-02-22 12:01:29',0),('af8acf36-3699-11e9-8d8d-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','af6a9414-3699-11e9-a4de-00e04c360044','Reports','2019-02-22 12:01:29',0),('afa9bc7a-3699-11e9-ae39-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','af8b4c72-3699-11e9-8f2d-00e04c360044','Reports','2019-02-22 12:01:29',0),('afab3af0-3699-11e9-a67e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','af8b4c72-3699-11e9-8f2d-00e04c360044','Reports','2019-02-22 12:01:29',0),('afcb0696-3699-11e9-b877-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','afab9518-3699-11e9-a370-00e04c360044','Reports','2019-02-22 12:01:29',0),('afcb9d68-3699-11e9-907d-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','afab9518-3699-11e9-a370-00e04c360044','Reports','2019-02-22 12:01:29',0),('afeaa438-3699-11e9-bd9d-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','afcc111c-3699-11e9-b283-00e04c360044','Reports','2019-02-22 12:01:29',0),('afec3d8e-3699-11e9-931f-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','afcc111c-3699-11e9-b283-00e04c360044','Reports','2019-02-22 12:01:29',0),('b00ac77c-3699-11e9-a420-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','afecafb2-3699-11e9-9f63-00e04c360044','Reports','2019-02-22 12:01:29',0),('b00c47be-3699-11e9-a392-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','afecafb2-3699-11e9-9f63-00e04c360044','Reports','2019-02-22 12:01:29',0),('b02aa146-3699-11e9-bd37-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','b00cbfd2-3699-11e9-b50c-00e04c360044','Reports','2019-02-22 12:01:29',0),('b02c1f6c-3699-11e9-b019-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b00cbfd2-3699-11e9-b50c-00e04c360044','Reports','2019-02-22 12:01:29',0),('b04b3578-3699-11e9-80a6-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','b02c8a92-3699-11e9-a10c-00e04c360044','Reports','2019-02-22 12:01:29',0),('b04ceff8-3699-11e9-b3a5-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b02c8a92-3699-11e9-a10c-00e04c360044','Reports','2019-02-22 12:01:29',0),('b06b5e98-3699-11e9-b642-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','b04d5c40-3699-11e9-a310-00e04c360044','Reports','2019-02-22 12:01:29',0),('b06cea92-3699-11e9-9e26-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b04d5c40-3699-11e9-a310-00e04c360044','Reports','2019-02-22 12:01:29',0),('b08b3be6-3699-11e9-8953-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','b06d4b0e-3699-11e9-995a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b08cc1d2-3699-11e9-96fe-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b06d4b0e-3699-11e9-995a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b0ab76ae-3699-11e9-9d4c-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','b08d2230-3699-11e9-a023-00e04c360044','Reports','2019-02-22 12:01:29',0),('b0ad1ef0-3699-11e9-925f-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b08d2230-3699-11e9-a023-00e04c360044','Reports','2019-02-22 12:01:29',0),('b0cb963c-3699-11e9-a495-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','b0ad9402-3699-11e9-9054-00e04c360044','Reports','2019-02-22 12:01:29',0),('b0cd2e7a-3699-11e9-87a5-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b0ad9402-3699-11e9-9054-00e04c360044','Reports','2019-02-22 12:01:29',0),('b10c1946-3699-11e9-a06a-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b0cd948c-3699-11e9-8316-00e04c360044','Reports','2019-02-22 12:01:29',0),('b10dbbe8-3699-11e9-89e6-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b0cd948c-3699-11e9-8316-00e04c360044','Reports','2019-02-22 12:01:29',0),('b12d2a3c-3699-11e9-a2ec-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b10e326c-3699-11e9-91f9-00e04c360044','Reports','2019-02-22 12:01:29',0),('b12fd412-3699-11e9-b8a3-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b10e326c-3699-11e9-91f9-00e04c360044','Reports','2019-02-22 12:01:29',0),('b150a642-3699-11e9-906a-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b1316cfa-3699-11e9-9afa-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1522e7c-3699-11e9-85c2-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b1316cfa-3699-11e9-9afa-00e04c360044','Reports','2019-02-22 12:01:29',0),('b171ea78-3699-11e9-8536-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b15297b8-3699-11e9-8b34-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1739530-3699-11e9-a16b-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b15297b8-3699-11e9-8b34-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1924778-3699-11e9-a854-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b1740808-3699-11e9-a8ad-00e04c360044','Reports','2019-02-22 12:01:29',0),('b193d462-3699-11e9-8a7d-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b1740808-3699-11e9-a8ad-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1b23614-3699-11e9-8a54-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b194342a-3699-11e9-8b03-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1b3d1d6-3699-11e9-affe-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b194342a-3699-11e9-8b03-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1d268e4-3699-11e9-9066-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b1b44940-3699-11e9-b8d1-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1d3fd30-3699-11e9-911c-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b1b44940-3699-11e9-b8d1-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1f6fa10-3699-11e9-8d50-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b1d45f32-3699-11e9-a361-00e04c360044','Reports','2019-02-22 12:01:29',0),('b1f88556-3699-11e9-8c1d-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b1d45f32-3699-11e9-a361-00e04c360044','Reports','2019-02-22 12:01:29',0),('b21a4f9c-3699-11e9-a10c-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b1f8fe32-3699-11e9-a4d0-00e04c360044','Reports','2019-02-22 12:01:29',0),('b21c21b4-3699-11e9-80ab-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b1f8fe32-3699-11e9-a4d0-00e04c360044','Reports','2019-02-22 12:01:29',0),('b23dfe92-3699-11e9-a271-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b21ccd3a-3699-11e9-8899-00e04c360044','Reports','2019-02-22 12:01:29',0),('b23e9d34-3699-11e9-8c42-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b21ccd3a-3699-11e9-8899-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2622bbe-3699-11e9-bfee-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b23f240c-3699-11e9-9333-00e04c360044','Reports','2019-02-22 12:01:29',0),('b263d5c2-3699-11e9-9977-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b23f240c-3699-11e9-9333-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2859676-3699-11e9-9b5f-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b264470a-3699-11e9-a2ff-00e04c360044','Reports','2019-02-22 12:01:29',0),('b28729e6-3699-11e9-aba3-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b264470a-3699-11e9-a2ff-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2a7b2b0-3699-11e9-9aae-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b287a07e-3699-11e9-9a5d-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2a95138-3699-11e9-9e00-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b287a07e-3699-11e9-9a5d-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2c90b54-3699-11e9-b3f1-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b2a9bdda-3699-11e9-b113-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2cab0f8-3699-11e9-8024-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b2a9bdda-3699-11e9-b113-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2eaeed6-3699-11e9-981f-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b2cb1fc0-3699-11e9-92fb-00e04c360044','Reports','2019-02-22 12:01:29',0),('b2ec9100-3699-11e9-817e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b2cb1fc0-3699-11e9-92fb-00e04c360044','Reports','2019-02-22 12:01:29',0),('b331b406-3699-11e9-a76e-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b2ed2444-3699-11e9-be89-00e04c360044','Reports','2019-02-22 12:01:29',0),('b3324b0a-3699-11e9-b729-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b2ed2444-3699-11e9-be89-00e04c360044','Reports','2019-02-22 12:01:29',0),('b35620ac-3699-11e9-aaae-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b332d57a-3699-11e9-804a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b356b6fc-3699-11e9-893e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b332d57a-3699-11e9-804a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b378029e-3699-11e9-948e-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b35744fa-3699-11e9-9ca1-00e04c360044','Reports','2019-02-22 12:01:29',0),('b3798f42-3699-11e9-b066-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b35744fa-3699-11e9-9ca1-00e04c360044','Reports','2019-02-22 12:01:29',0),('b39adf12-3699-11e9-b09f-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b37a0fc6-3699-11e9-8539-00e04c360044','Reports','2019-02-22 12:01:29',0),('b39c7606-3699-11e9-8544-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b37a0fc6-3699-11e9-8539-00e04c360044','Reports','2019-02-22 12:01:29',0),('b3be50f0-3699-11e9-be9e-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b39ce56e-3699-11e9-ae44-00e04c360044','Reports','2019-02-22 12:01:29',0),('b3bfe294-3699-11e9-b328-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b39ce56e-3699-11e9-ae44-00e04c360044','Reports','2019-02-22 12:01:29',0),('b3e113ec-3699-11e9-a205-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b3c07790-3699-11e9-8f2d-00e04c360044','Reports','2019-02-22 12:01:29',0),('b3e2caf2-3699-11e9-b963-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b3c07790-3699-11e9-8f2d-00e04c360044','Reports','2019-02-22 12:01:29',0),('b40685d2-3699-11e9-b814-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b3e33988-3699-11e9-8dfa-00e04c360044','Reports','2019-02-22 12:01:29',0),('b408115e-3699-11e9-a56c-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b3e33988-3699-11e9-8dfa-00e04c360044','Reports','2019-02-22 12:01:29',0),('b428d56a-3699-11e9-bd93-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b40895b6-3699-11e9-88ec-00e04c360044','Reports','2019-02-22 12:01:29',0),('b42a84f0-3699-11e9-925d-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b40895b6-3699-11e9-88ec-00e04c360044','Reports','2019-02-22 12:01:29',0),('b44a9b32-3699-11e9-8813-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b42b150a-3699-11e9-9f16-00e04c360044','Reports','2019-02-22 12:01:29',0),('b44c4f86-3699-11e9-9b33-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b42b150a-3699-11e9-9f16-00e04c360044','Reports','2019-02-22 12:01:29',0),('b46e6cc4-3699-11e9-9bee-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b44cbea8-3699-11e9-839e-00e04c360044','Reports','2019-02-22 12:01:29',0),('b46ff274-3699-11e9-87d7-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b44cbea8-3699-11e9-839e-00e04c360044','Reports','2019-02-22 12:01:29',0),('b49a6db0-3699-11e9-8c66-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b4707384-3699-11e9-8ef3-00e04c360044','Reports','2019-02-22 12:01:29',0),('b49c09a4-3699-11e9-8ace-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b4707384-3699-11e9-8ef3-00e04c360044','Reports','2019-02-22 12:01:29',0),('b4c7943e-3699-11e9-8fb3-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b49c87ee-3699-11e9-a8ff-00e04c360044','Reports','2019-02-22 12:01:29',0),('b4c86c9c-3699-11e9-94ee-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b49c87ee-3699-11e9-a8ff-00e04c360044','Reports','2019-02-22 12:01:29',0),('b4f60224-3699-11e9-93dc-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b4c917c8-3699-11e9-b3fc-00e04c360044','Reports','2019-02-22 12:01:29',0),('b4f7aa52-3699-11e9-959d-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b4c917c8-3699-11e9-b3fc-00e04c360044','Reports','2019-02-22 12:01:29',0),('b51d91d6-3699-11e9-93f6-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b4f84b6a-3699-11e9-9072-00e04c360044','Reports','2019-02-22 12:01:29',0),('b51e2844-3699-11e9-8a77-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b4f84b6a-3699-11e9-9072-00e04c360044','Reports','2019-02-22 12:01:29',0),('b540dce0-3699-11e9-a969-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b51ea738-3699-11e9-9492-00e04c360044','Reports','2019-02-22 12:01:29',0),('b5428ad6-3699-11e9-a90a-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b51ea738-3699-11e9-9492-00e04c360044','Reports','2019-02-22 12:01:29',0),('b56448e2-3699-11e9-9588-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b5433382-3699-11e9-9444-00e04c360044','Reports','2019-02-22 12:01:29',0),('b565e24c-3699-11e9-8d7a-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b5433382-3699-11e9-9444-00e04c360044','Reports','2019-02-22 12:01:29',0),('b58662ce-3699-11e9-8811-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b5666424-3699-11e9-8ce1-00e04c360044','Reports','2019-02-22 12:01:29',0),('b5881268-3699-11e9-b3be-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b5666424-3699-11e9-8ce1-00e04c360044','Reports','2019-02-22 12:01:29',0),('b5a7dddc-3699-11e9-9264-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b5887e88-3699-11e9-8250-00e04c360044','Reports','2019-02-22 12:01:29',0),('b5a97110-3699-11e9-8b61-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b5887e88-3699-11e9-8250-00e04c360044','Reports','2019-02-22 12:01:29',0),('b5ca1d20-3699-11e9-a943-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b5a9f856-3699-11e9-8a20-00e04c360044','Reports','2019-02-22 12:01:29',0),('b5cbc3b4-3699-11e9-a56b-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b5a9f856-3699-11e9-8a20-00e04c360044','Reports','2019-02-22 12:01:29',0),('b60e8cbc-3699-11e9-9413-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b5cc6c60-3699-11e9-880b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b6102e78-3699-11e9-9013-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b5cc6c60-3699-11e9-880b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b62f5d20-3699-11e9-9e9c-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b6109d86-3699-11e9-af75-00e04c360044','Reports','2019-02-22 12:01:29',0),('b62ff7ee-3699-11e9-b119-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b6109d86-3699-11e9-af75-00e04c360044','Reports','2019-02-22 12:01:29',0),('b64e81fa-3699-11e9-8eb8-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b6307c14-3699-11e9-97ef-00e04c360044','Reports','2019-02-22 12:01:29',0),('b64f080a-3699-11e9-8d78-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b6307c14-3699-11e9-97ef-00e04c360044','Reports','2019-02-22 12:01:29',0),('b66e2168-3699-11e9-849c-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b64fbba6-3699-11e9-bc19-00e04c360044','Reports','2019-02-22 12:01:29',0),('b66fbe10-3699-11e9-aec3-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b64fbba6-3699-11e9-bc19-00e04c360044','Reports','2019-02-22 12:01:29',0),('b68f432a-3699-11e9-95ab-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b6702bac-3699-11e9-8ec6-00e04c360044','Reports','2019-02-22 12:01:29',0),('b6901638-3699-11e9-bf58-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b6702bac-3699-11e9-8ec6-00e04c360044','Reports','2019-02-22 12:01:29',0),('b6b01a3c-3699-11e9-bbe0-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b69092ca-3699-11e9-9082-00e04c360044','Reports','2019-02-22 12:01:29',0),('b6b0dc60-3699-11e9-8559-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b69092ca-3699-11e9-9082-00e04c360044','Reports','2019-02-22 12:01:29',0),('b6df2656-3699-11e9-9971-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b6b18b06-3699-11e9-84c8-00e04c360044','Reports','2019-02-22 12:01:29',0),('b6e0ef54-3699-11e9-b847-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b6b18b06-3699-11e9-84c8-00e04c360044','Reports','2019-02-22 12:01:29',0),('b708f4ea-3699-11e9-b540-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b6e1ae6c-3699-11e9-b66f-00e04c360044','Reports','2019-02-22 12:01:29',0),('b70a970a-3699-11e9-876e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b6e1ae6c-3699-11e9-b66f-00e04c360044','Reports','2019-02-22 12:01:29',0),('b7304108-3699-11e9-816e-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b70b195a-3699-11e9-8760-00e04c360044','Reports','2019-02-22 12:01:29',0),('b73206b4-3699-11e9-8082-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b70b195a-3699-11e9-8760-00e04c360044','Reports','2019-02-22 12:01:29',0),('b758918a-3699-11e9-9479-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b7329e08-3699-11e9-94b2-00e04c360044','Reports','2019-02-22 12:01:29',0),('b75970aa-3699-11e9-b2ba-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b7329e08-3699-11e9-94b2-00e04c360044','Reports','2019-02-22 12:01:29',0),('b77fff40-3699-11e9-b351-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b75a0d44-3699-11e9-8467-00e04c360044','Reports','2019-02-22 12:01:29',0),('b780b6c4-3699-11e9-951e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b75a0d44-3699-11e9-8467-00e04c360044','Reports','2019-02-22 12:01:29',0),('b7a9a138-3699-11e9-8347-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b78196b6-3699-11e9-842a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b7aa9714-3699-11e9-a2d3-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b78196b6-3699-11e9-842a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b7d22180-3699-11e9-8a13-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b7ab10ea-3699-11e9-9862-00e04c360044','Reports','2019-02-22 12:01:29',0),('b7d3c760-3699-11e9-9735-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b7ab10ea-3699-11e9-9862-00e04c360044','Reports','2019-02-22 12:01:29',0),('b7f5b988-3699-11e9-b0e7-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b7d44b5e-3699-11e9-9645-00e04c360044','Reports','2019-02-22 12:01:29',0),('b7f64a1a-3699-11e9-ac12-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b7d44b5e-3699-11e9-9645-00e04c360044','Reports','2019-02-22 12:01:29',0),('b817e3fa-3699-11e9-9192-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b7f70400-3699-11e9-964a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b81879dc-3699-11e9-80f3-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b7f70400-3699-11e9-964a-00e04c360044','Reports','2019-02-22 12:01:29',0),('b83979de-3699-11e9-a849-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b818fa42-3699-11e9-bc24-00e04c360044','Reports','2019-02-22 12:01:29',0),('b83b10a0-3699-11e9-b69a-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b818fa42-3699-11e9-bc24-00e04c360044','Reports','2019-02-22 12:01:29',0),('b85a84b2-3699-11e9-9f92-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b83b9c0a-3699-11e9-b685-00e04c360044','Reports','2019-02-22 12:01:29',0),('b85c2678-3699-11e9-bde1-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b83b9c0a-3699-11e9-b685-00e04c360044','Reports','2019-02-22 12:01:29',0),('b87c6c30-3699-11e9-ae39-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b85cb2c8-3699-11e9-a716-00e04c360044','Reports','2019-02-22 12:01:29',0),('b87dfce4-3699-11e9-96af-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b85cb2c8-3699-11e9-a716-00e04c360044','Reports','2019-02-22 12:01:29',0),('b89c6c92-3699-11e9-9d5a-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b87e8420-3699-11e9-846f-00e04c360044','Reports','2019-02-22 12:01:29',0),('b89e0a5c-3699-11e9-844b-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b87e8420-3699-11e9-846f-00e04c360044','Reports','2019-02-22 12:01:29',0),('b8bbaa9e-3699-11e9-aeba-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b89edd4c-3699-11e9-a7b8-00e04c360044','Reports','2019-02-22 12:01:29',0),('b8bc3784-3699-11e9-8f30-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b89edd4c-3699-11e9-a7b8-00e04c360044','Reports','2019-02-22 12:01:29',0),('b8d91232-3699-11e9-83c6-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b8bc9b20-3699-11e9-a7b5-00e04c360044','Reports','2019-02-22 12:01:29',0),('b8daaf16-3699-11e9-bc20-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b8bc9b20-3699-11e9-a7b5-00e04c360044','Reports','2019-02-22 12:01:29',0),('b8f85836-3699-11e9-97f9-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b8db1bae-3699-11e9-bac5-00e04c360044','Reports','2019-02-22 12:01:29',0),('b8f9f966-3699-11e9-b1cc-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b8db1bae-3699-11e9-bac5-00e04c360044','Reports','2019-02-22 12:01:29',0),('b91a22a4-3699-11e9-b5f9-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b8fa7742-3699-11e9-9c8b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b91bb4f2-3699-11e9-8630-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b8fa7742-3699-11e9-9c8b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b93cd510-3699-11e9-b510-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b91c318e-3699-11e9-9b48-00e04c360044','Reports','2019-02-22 12:01:29',0),('b93e6786-3699-11e9-be50-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b91c318e-3699-11e9-9b48-00e04c360044','Reports','2019-02-22 12:01:29',0),('b95d4b2e-3699-11e9-a78e-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b93f0dbc-3699-11e9-a48b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b95efb5e-3699-11e9-97f9-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b93f0dbc-3699-11e9-a48b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b97e8140-3699-11e9-8265-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b95f6f76-3699-11e9-993f-00e04c360044','Reports','2019-02-22 12:01:29',0),('b980147e-3699-11e9-b6d6-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b95f6f76-3699-11e9-993f-00e04c360044','Reports','2019-02-22 12:01:29',0),('b99e5bdc-3699-11e9-8b4a-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b9809d2c-3699-11e9-aa9b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b9a0192c-3699-11e9-b109-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b9809d2c-3699-11e9-aa9b-00e04c360044','Reports','2019-02-22 12:01:29',0),('b9bed272-3699-11e9-8307-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b9a0ab80-3699-11e9-8cf4-00e04c360044','Reports','2019-02-22 12:01:29',0),('b9c05f2a-3699-11e9-a617-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b9a0ab80-3699-11e9-8cf4-00e04c360044','Reports','2019-02-22 12:01:29',0),('b9e032be-3699-11e9-8160-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b9c11a6e-3699-11e9-8cc9-00e04c360044','Reports','2019-02-22 12:01:29',0),('b9e0c558-3699-11e9-85c7-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b9c11a6e-3699-11e9-8cc9-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba0093ce-3699-11e9-a202-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b9e152b6-3699-11e9-ae50-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba026cee-3699-11e9-81c1-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','b9e152b6-3699-11e9-ae50-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba204912-3699-11e9-b715-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','ba02ecdc-3699-11e9-b126-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba21d70a-3699-11e9-81e9-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','ba02ecdc-3699-11e9-b126-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba408bdc-3699-11e9-8ec5-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','ba225216-3699-11e9-bbae-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba422ad2-3699-11e9-9ad5-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','ba225216-3699-11e9-bbae-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba61fec0-3699-11e9-b495-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','ba42aa02-3699-11e9-8187-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba63a680-3699-11e9-8f65-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','ba42aa02-3699-11e9-8187-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba826ca0-3699-11e9-bae4-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','ba641476-3699-11e9-acf8-00e04c360044','Reports','2019-02-22 12:01:29',0),('ba84135c-3699-11e9-a6ee-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','ba641476-3699-11e9-acf8-00e04c360044','Reports','2019-02-22 12:01:29',0),('baa2beba-3699-11e9-85df-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','ba848fd0-3699-11e9-ad7e-00e04c360044','Reports','2019-02-22 12:01:29',0),('baa4658a-3699-11e9-b450-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','ba848fd0-3699-11e9-ad7e-00e04c360044','Reports','2019-02-22 12:01:29',0),('bac2b148-3699-11e9-b682-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','baa4eba4-3699-11e9-a7f0-00e04c360044','Reports','2019-02-22 12:01:29',0),('bac4555c-3699-11e9-b320-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','baa4eba4-3699-11e9-a7f0-00e04c360044','Reports','2019-02-22 12:01:29',0),('bae2d914-3699-11e9-9e5c-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bac4cb9a-3699-11e9-94a2-00e04c360044','Reports','2019-02-22 12:01:29',0),('bae48642-3699-11e9-84a6-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bac4cb9a-3699-11e9-94a2-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb0281ce-3699-11e9-8d7f-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bae4fece-3699-11e9-bcd0-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb042484-3699-11e9-bdde-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bae4fece-3699-11e9-bcd0-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb22ace2-3699-11e9-a931-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bb049770-3699-11e9-8fb2-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb245f60-3699-11e9-8d34-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bb049770-3699-11e9-8fb2-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb4307da-3699-11e9-b350-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bb24e066-3699-11e9-b312-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb44d18c-3699-11e9-a095-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bb24e066-3699-11e9-b312-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb6376fa-3699-11e9-9a0a-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bb459da6-3699-11e9-a60c-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb65209a-3699-11e9-85d9-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bb459da6-3699-11e9-a60c-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb83b7b2-3699-11e9-b6bd-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bb65a074-3699-11e9-8aba-00e04c360044','Reports','2019-02-22 12:01:29',0),('bb855414-3699-11e9-95a4-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bb65a074-3699-11e9-8aba-00e04c360044','Reports','2019-02-22 12:01:29',0),('bba3edf2-3699-11e9-b237-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bb85df42-3699-11e9-a0cf-00e04c360044','Reports','2019-02-22 12:01:29',0),('bba5cd48-3699-11e9-b108-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bb85df42-3699-11e9-a0cf-00e04c360044','Reports','2019-02-22 12:01:29',0),('bbc40e7a-3699-11e9-90bf-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bba67e5a-3699-11e9-aa05-00e04c360044','Reports','2019-02-22 12:01:29',0),('bbc5d11a-3699-11e9-975d-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bba67e5a-3699-11e9-aa05-00e04c360044','Reports','2019-02-22 12:01:29',0),('bbe418a0-3699-11e9-add0-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bbc640d2-3699-11e9-a714-00e04c360044','Reports','2019-02-22 12:01:29',0),('bbe4b4ae-3699-11e9-9bcd-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bbc640d2-3699-11e9-a714-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc034f90-3699-11e9-bafa-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bbe5324e-3699-11e9-a1c2-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc04f336-3699-11e9-b566-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bbe5324e-3699-11e9-a1c2-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc23e872-3699-11e9-a085-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bc056e6a-3699-11e9-b964-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc246f4a-3699-11e9-9a4a-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bc056e6a-3699-11e9-b964-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc4378fe-3699-11e9-9738-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bc24e42a-3699-11e9-86d8-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc44053a-3699-11e9-9a4e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bc24e42a-3699-11e9-86d8-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc63d55e-3699-11e9-a6db-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bc448e56-3699-11e9-a3a1-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc6582e6-3699-11e9-b03b-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bc448e56-3699-11e9-a3a1-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc8430ce-3699-11e9-8fc5-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bc6608ce-3699-11e9-9558-00e04c360044','Reports','2019-02-22 12:01:29',0),('bc85d00a-3699-11e9-85aa-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bc6608ce-3699-11e9-9558-00e04c360044','Reports','2019-02-22 12:01:29',0),('bca3f8c8-3699-11e9-986f-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bc8641c0-3699-11e9-a48e-00e04c360044','Reports','2019-02-22 12:01:29',0),('bca5b3fc-3699-11e9-9532-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bc8641c0-3699-11e9-a48e-00e04c360044','Reports','2019-02-22 12:01:29',0),('bcc411ee-3699-11e9-830a-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bca64b96-3699-11e9-954e-00e04c360044','Reports','2019-02-22 12:01:29',0),('bcc4b162-3699-11e9-9d49-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bca64b96-3699-11e9-954e-00e04c360044','Reports','2019-02-22 12:01:29',0),('bce21ac2-3699-11e9-99f2-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bcc5357e-3699-11e9-9e7c-00e04c360044','Reports','2019-02-22 12:01:29',0),('bce2a3ac-3699-11e9-b56e-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bcc5357e-3699-11e9-9e7c-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd097572-3699-11e9-aad0-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bce32426-3699-11e9-89f3-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd0b5fea-3699-11e9-90ad-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bce32426-3699-11e9-89f3-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd29a4e6-3699-11e9-9606-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bd0bd43e-3699-11e9-b004-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd2b4d64-3699-11e9-99e3-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bd0bd43e-3699-11e9-b004-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd4a895e-3699-11e9-9e80-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bd2bdf22-3699-11e9-b898-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd4c2ba6-3699-11e9-80a7-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bd2bdf22-3699-11e9-b898-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd6a8754-3699-11e9-84ae-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bd4ca0a4-3699-11e9-a580-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd6c1920-3699-11e9-98a5-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bd4ca0a4-3699-11e9-a580-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd8a5c96-3699-11e9-a9f8-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bd6c9f44-3699-11e9-8779-00e04c360044','Reports','2019-02-22 12:01:29',0),('bd8bfaec-3699-11e9-874a-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bd6c9f44-3699-11e9-8779-00e04c360044','Reports','2019-02-22 12:01:29',0),('bdaab9d2-3699-11e9-8279-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bd8c68ec-3699-11e9-9b3d-00e04c360044','Reports','2019-02-22 12:01:29',0),('bdac53dc-3699-11e9-ae73-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bd8c68ec-3699-11e9-9b3d-00e04c360044','Reports','2019-02-22 12:01:29',0),('bdca2f38-3699-11e9-826c-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bdacda0a-3699-11e9-913a-00e04c360044','Reports','2019-02-22 12:01:29',0),('bdcbbbaa-3699-11e9-b638-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bdacda0a-3699-11e9-913a-00e04c360044','Reports','2019-02-22 12:01:29',0),('bdea7ff4-3699-11e9-96aa-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bdcc3332-3699-11e9-aba2-00e04c360044','Reports','2019-02-22 12:01:29',0),('bdec221e-3699-11e9-a861-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bdcc3332-3699-11e9-aba2-00e04c360044','Reports','2019-02-22 12:01:29',0),('be0bde9c-3699-11e9-8fd2-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','bdecb3be-3699-11e9-a030-00e04c360044','Reports','2019-02-22 12:01:29',0),('be0c5822-3699-11e9-97ec-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','bdecb3be-3699-11e9-a030-00e04c360044','Reports','2019-02-22 12:01:29',0);
/*!40000 ALTER TABLE `tag_bean_rel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `name_lower` varchar(255) DEFAULT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `source_type` varchar(255) DEFAULT NULL,
  `source_meta` text,
  `assigned_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tags_date_modfied` (`date_modified`),
  KEY `idx_tags_id_del` (`id`,`deleted`),
  KEY `idx_tags_date_entered` (`date_entered`),
  KEY `idx_tags_name_del` (`name`,`deleted`),
  KEY `idx_tag_name` (`name`),
  KEY `idx_tag_name_lower` (`name_lower`),
  KEY `idx_tags_assigned_del` (`assigned_user_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES ('16ec5d86-36b6-11e9-bb11-00e04c360044','dotb','2019-02-22 15:25:30','2019-02-22 15:25:30','1','1',NULL,0,'dotb',NULL,NULL,NULL,'1'),('ae6f0b76-3699-11e9-9021-00e04c360044','Administrative','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'administrative',NULL,NULL,NULL,'1'),('aea13dee-3699-11e9-b1ed-00e04c360044','Stock Report','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'stock report',NULL,NULL,NULL,'1'),('b0eb8ec4-3699-11e9-9a39-00e04c360044','Data Privacy','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'data privacy',NULL,NULL,NULL,'1'),('b30e90de-3699-11e9-8b6f-00e04c360044','Customer Service','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'customer service',NULL,NULL,NULL,'1'),('b5ed1654-3699-11e9-a081-00e04c360044','Sales and Marketing','2019-02-22 12:01:29','2019-02-22 12:01:29','1','1',NULL,0,'sales and marketing',NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_audit`
--

DROP TABLE IF EXISTS `tags_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_tags_audit_parent_id` (`parent_id`),
  KEY `idx_tags_audit_event_id` (`event_id`),
  KEY `idx_tags_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_tags_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_audit`
--

LOCK TABLES `tags_audit` WRITE;
/*!40000 ALTER TABLE `tags_audit` DISABLE KEYS */;
INSERT INTO `tags_audit` VALUES ('16ed4a66-36b6-11e9-a4d1-00e04c360044','16ec5d86-36b6-11e9-bb11-00e04c360044','16eca084-36b6-11e9-a41a-00e04c360044','2019-02-22 15:25:30','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL),('ae716bfa-3699-11e9-b141-00e04c360044','ae6f0b76-3699-11e9-9021-00e04c360044','ae705788-3699-11e9-9f5b-00e04c360044','2019-02-22 12:01:29','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL),('aea28438-3699-11e9-b132-00e04c360044','aea13dee-3699-11e9-b1ed-00e04c360044','aea1449c-3699-11e9-94b7-00e04c360044','2019-02-22 12:01:29','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL),('b0ebdd34-3699-11e9-8b7b-00e04c360044','b0eb8ec4-3699-11e9-9a39-00e04c360044','b0eb9680-3699-11e9-a70f-00e04c360044','2019-02-22 12:01:29','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL),('b310541e-3699-11e9-8017-00e04c360044','b30e90de-3699-11e9-8b6f-00e04c360044','b30e9750-3699-11e9-8c8b-00e04c360044','2019-02-22 12:01:29','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL),('b5ed6faa-3699-11e9-bfc9-00e04c360044','b5ed1654-3699-11e9-a081-00e04c360044','b5ed1d34-3699-11e9-9204-00e04c360044','2019-02-22 12:01:29','1',NULL,'assigned_user_id','id',NULL,'1',NULL,NULL);
/*!40000 ALTER TABLE `tags_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `status` varchar(100) DEFAULT 'Not Started',
  `date_due_flag` tinyint(1) DEFAULT '0',
  `date_due` datetime DEFAULT NULL,
  `date_start_flag` tinyint(1) DEFAULT '0',
  `date_start` datetime DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `contact_id` char(36) DEFAULT NULL,
  `priority` varchar(100) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `dri_workflow_sort_order` varchar(255) DEFAULT '1',
  `customer_journey_score` int(8) DEFAULT NULL,
  `cj_momentum_points` int(8) DEFAULT NULL,
  `cj_momentum_score` int(8) DEFAULT NULL,
  `customer_journey_progress` float DEFAULT '0',
  `cj_momentum_ratio` float DEFAULT '0',
  `customer_journey_points` int(3) DEFAULT '10',
  `cj_parent_activity_type` varchar(255) DEFAULT NULL,
  `customer_journey_type` varchar(255) DEFAULT 'customer_task',
  `customer_journey_blocked_by` text,
  `cj_parent_activity_id` char(36) DEFAULT NULL,
  `is_cj_parent_activity` tinyint(1) DEFAULT '0',
  `is_customer_journey_activity` tinyint(1) DEFAULT '0',
  `cj_momentum_start_date` datetime DEFAULT NULL,
  `cj_momentum_end_date` datetime DEFAULT NULL,
  `dri_workflow_template_id` char(36) DEFAULT NULL,
  `dri_subworkflow_template_id` char(36) DEFAULT NULL,
  `dri_workflow_task_template_id` char(36) DEFAULT NULL,
  `dri_subworkflow_id` char(36) DEFAULT NULL,
  `cj_actual_sort_order` varchar(255) DEFAULT NULL,
  `cj_url` varchar(255) DEFAULT NULL,
  `remind_email` varchar(255) DEFAULT NULL,
  `remind_email_sent` tinyint(1) DEFAULT '0',
  `remind_popup` varchar(255) DEFAULT NULL,
  `call_relate` varchar(36) DEFAULT NULL,
  `task_duration` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `app_reminder_sent` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_tasks_date_modfied` (`date_modified`),
  KEY `idx_tasks_id_del` (`id`,`deleted`),
  KEY `idx_tasks_date_entered` (`date_entered`),
  KEY `idx_tasks_name_del` (`name`,`deleted`),
  KEY `idx_tsk_name` (`name`),
  KEY `idx_task_con_del` (`contact_id`,`deleted`),
  KEY `idx_task_par_del` (`parent_id`,`parent_type`,`deleted`),
  KEY `idx_task_assigned` (`assigned_user_id`),
  KEY `idx_task_status` (`status`),
  KEY `idx_task_date_due` (`date_due`),
  KEY `idx_tasks_assigned_del` (`assigned_user_id`,`deleted`),
  KEY `idx_tasks_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_tasks_acl_tmst_id` (`acl_team_set_id`,`deleted`),
  KEY `idx_task_cj_journey_tpl_id` (`dri_workflow_template_id`),
  KEY `idx_task_cj_stage_tpl_id` (`dri_subworkflow_template_id`),
  KEY `idx_task_cj_activity_tpl_id` (`dri_workflow_task_template_id`),
  KEY `idx_task_cj_stage_id` (`dri_subworkflow_id`),
  KEY `idx_task_cj_parent_activity` (`deleted`,`cj_parent_activity_id`,`cj_parent_activity_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_audit`
--

DROP TABLE IF EXISTS `tasks_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_audit` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `data_type` varchar(100) DEFAULT NULL,
  `before_value_string` varchar(255) DEFAULT NULL,
  `after_value_string` varchar(255) DEFAULT NULL,
  `before_value_text` text,
  `after_value_text` text,
  PRIMARY KEY (`id`),
  KEY `idx_tasks_audit_parent_id` (`parent_id`),
  KEY `idx_tasks_audit_event_id` (`event_id`),
  KEY `idx_tasks_audit_pa_ev_id` (`parent_id`,`event_id`),
  KEY `idx_tasks_audit_after_value` (`after_value_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_audit`
--

LOCK TABLES `tasks_audit` WRITE;
/*!40000 ALTER TABLE `tasks_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxrates`
--

DROP TABLE IF EXISTS `taxrates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxrates` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `value` decimal(26,6) DEFAULT NULL,
  `list_order` int(4) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_taxrates_date_modfied` (`date_modified`),
  KEY `idx_taxrates_id_del` (`id`,`deleted`),
  KEY `idx_taxrates_date_entered` (`date_entered`),
  KEY `idx_taxrates_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxrates`
--

LOCK TABLES `taxrates` WRITE;
/*!40000 ALTER TABLE `taxrates` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxrates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_memberships`
--

DROP TABLE IF EXISTS `team_memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_memberships` (
  `id` char(36) NOT NULL,
  `team_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `explicit_assign` tinyint(1) DEFAULT '0',
  `implicit_assign` tinyint(1) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_team_membership` (`user_id`,`team_id`),
  KEY `idx_del_team_user` (`deleted`,`team_id`,`user_id`),
  KEY `idx_teammemb_team_user` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_memberships`
--

LOCK TABLES `team_memberships` WRITE;
/*!40000 ALTER TABLE `team_memberships` DISABLE KEYS */;
INSERT INTO `team_memberships` VALUES ('736cf7c6-1433-11eb-a9bb-00ace43f6d74','1','1',1,0,'2020-10-22 06:54:36',0),('73f13b4e-1433-11eb-b664-00ace43f6d74','1','be6dc3aa-3699-11e9-867e-00e04c360044',1,0,'2020-10-22 06:54:36',0);
/*!40000 ALTER TABLE `team_memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_notices`
--

DROP TABLE IF EXISTS `team_notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_notices` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `status` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `url_title` varchar(255) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_team_notice` (`name`,`deleted`),
  KEY `idx_team_notices_tmst_id` (`team_set_id`,`deleted`),
  KEY `idx_team_notices_acl_tmst_id` (`acl_team_set_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_notices`
--

LOCK TABLES `team_notices` WRITE;
/*!40000 ALTER TABLE `team_notices` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_set_events`
--

DROP TABLE IF EXISTS `team_set_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_set_events` (
  `id` char(36) NOT NULL,
  `action` varchar(100) DEFAULT NULL,
  `params` text,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_set_events`
--

LOCK TABLES `team_set_events` WRITE;
/*!40000 ALTER TABLE `team_set_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_set_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_sets`
--

DROP TABLE IF EXISTS `team_sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_sets` (
  `id` char(36) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `team_md5` varchar(32) DEFAULT NULL,
  `team_count` int(11) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_team_sets_md5` (`team_md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_sets`
--

LOCK TABLES `team_sets` WRITE;
/*!40000 ALTER TABLE `team_sets` DISABLE KEYS */;
INSERT INTO `team_sets` VALUES ('1','c4ca4238a0b923820dcc509a6f75849b','c4ca4238a0b923820dcc509a6f75849b',1,'2019-02-22 12:01:29',0,NULL);
/*!40000 ALTER TABLE `team_sets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_sets_modules`
--

DROP TABLE IF EXISTS `team_sets_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_sets_modules` (
  `id` char(36) NOT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `module_table_name` varchar(128) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_team_sets_modules` (`team_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_sets_modules`
--

LOCK TABLES `team_sets_modules` WRITE;
/*!40000 ALTER TABLE `team_sets_modules` DISABLE KEYS */;
INSERT INTO `team_sets_modules` VALUES ('7bdafaac-1433-11eb-a9c1-00ace43f6d74','1','dashboards',0),('7bdb7a36-1433-11eb-8573-00ace43f6d74',NULL,'dashboards',0),('7ed64bf8-1433-11eb-a184-00ace43f6d74',NULL,'dashboards',0),('b5fbc0c2-1433-11eb-99ac-00ace43f6d74',NULL,'dashboards',0);
/*!40000 ALTER TABLE `team_sets_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_sets_teams`
--

DROP TABLE IF EXISTS `team_sets_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_sets_teams` (
  `id` char(36) NOT NULL,
  `team_set_id` char(36) NOT NULL,
  `team_id` char(36) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_ud_set_id` (`team_set_id`,`team_id`),
  KEY `idx_ud_team_id` (`team_id`),
  KEY `idx_ud_team_set_id` (`team_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_sets_teams`
--

LOCK TABLES `team_sets_teams` WRITE;
/*!40000 ALTER TABLE `team_sets_teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_sets_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_sets_users_1`
--

DROP TABLE IF EXISTS `team_sets_users_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_sets_users_1` (
  `team_set_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  PRIMARY KEY (`team_set_id`,`user_id`),
  KEY `idx_tud1_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_sets_users_1`
--

LOCK TABLES `team_sets_users_1` WRITE;
/*!40000 ALTER TABLE `team_sets_users_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_sets_users_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_sets_users_2`
--

DROP TABLE IF EXISTS `team_sets_users_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_sets_users_2` (
  `team_set_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  PRIMARY KEY (`team_set_id`,`user_id`),
  KEY `idx_tud2_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_sets_users_2`
--

LOCK TABLES `team_sets_users_2` WRITE;
/*!40000 ALTER TABLE `team_sets_users_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_sets_users_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` char(36) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `name_2` varchar(128) DEFAULT NULL,
  `legal_name` varchar(255) DEFAULT NULL,
  `associated_user_id` char(36) DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  `short_name` varchar(45) DEFAULT NULL,
  `code_prefix` varchar(45) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `team_type` varchar(100) DEFAULT NULL,
  `parent_id` char(45) DEFAULT NULL,
  `sms_config` text,
  `manager_user_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_teams_date_modfied` (`date_modified`),
  KEY `idx_teams_id_del` (`id`,`deleted`),
  KEY `idx_teams_date_entered` (`date_entered`),
  KEY `idx_teams_name_del` (`name`,`deleted`),
  KEY `idx_team_del` (`name`),
  KEY `idx_team_del_name` (`deleted`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES ('1','Global','2019-02-22 12:01:29','2019-02-22 12:01:29','1',NULL,'Globally Visible',0,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeperiods`
--

DROP TABLE IF EXISTS `timeperiods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timeperiods` (
  `id` char(36) NOT NULL,
  `name` varchar(36) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_date_timestamp` int(14) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_date_timestamp` int(14) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `is_fiscal` tinyint(1) DEFAULT '0',
  `is_fiscal_year` tinyint(1) DEFAULT '0',
  `leaf_cycle` int(2) DEFAULT NULL,
  `type` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_timestamps` (`id`,`start_date_timestamp`,`end_date_timestamp`),
  KEY `idx_timeperiod_name` (`name`),
  KEY `idx_timeperiod_start_date` (`start_date`),
  KEY `idx_timeperiod_end_date` (`end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeperiods`
--

LOCK TABLES `timeperiods` WRITE;
/*!40000 ALTER TABLE `timeperiods` DISABLE KEYS */;
/*!40000 ALTER TABLE `timeperiods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker`
--

DROP TABLE IF EXISTS `tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monitor_id` char(36) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `item_id` char(36) DEFAULT NULL,
  `item_summary` varchar(255) DEFAULT NULL,
  `team_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `session_id` char(36) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_tracker_iid` (`item_id`),
  KEY `idx_tracker_userid_vis_id` (`user_id`,`visible`,`id`),
  KEY `idx_tracker_userid_itemid_vis` (`user_id`,`item_id`,`visible`),
  KEY `idx_tracker_userid_del_vis` (`user_id`,`deleted`,`visible`),
  KEY `idx_tracker_monitor_id` (`monitor_id`),
  KEY `idx_tracker_date_modified` (`date_modified`),
  KEY `idx_trckr_mod_uid_dtmod_item` (`module_name`,`user_id`,`date_modified`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker`
--

LOCK TABLES `tracker` WRITE;
/*!40000 ALTER TABLE `tracker` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_perf`
--

DROP TABLE IF EXISTS `tracker_perf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_perf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monitor_id` char(36) NOT NULL,
  `server_response_time` double DEFAULT NULL,
  `db_round_trips` int(6) DEFAULT NULL,
  `files_opened` int(6) DEFAULT NULL,
  `memory_usage` int(12) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tracker_perf_mon_id` (`monitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_perf`
--

LOCK TABLES `tracker_perf` WRITE;
/*!40000 ALTER TABLE `tracker_perf` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_perf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_queries`
--

DROP TABLE IF EXISTS `tracker_queries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_queries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `query_id` char(36) NOT NULL,
  `text` text,
  `query_hash` varchar(36) DEFAULT NULL,
  `sec_total` double DEFAULT NULL,
  `sec_avg` double DEFAULT NULL,
  `run_count` int(6) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tracker_queries_query_hash` (`query_hash`),
  KEY `idx_tracker_queries_query_id` (`query_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_queries`
--

LOCK TABLES `tracker_queries` WRITE;
/*!40000 ALTER TABLE `tracker_queries` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_queries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_sessions`
--

DROP TABLE IF EXISTS `tracker_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` char(36) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `seconds` int(9) DEFAULT '0',
  `client_ip` varchar(45) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_tracker_sessions_s_id` (`session_id`),
  KEY `idx_tracker_sessions_uas_id` (`user_id`,`active`,`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_sessions`
--

LOCK TABLES `tracker_sessions` WRITE;
/*!40000 ALTER TABLE `tracker_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_tracker_queries`
--

DROP TABLE IF EXISTS `tracker_tracker_queries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_tracker_queries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monitor_id` char(36) DEFAULT NULL,
  `query_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tracker_tq_monitor` (`monitor_id`),
  KEY `idx_tracker_tq_query` (`query_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_tracker_queries`
--

LOCK TABLES `tracker_tracker_queries` WRITE;
/*!40000 ALTER TABLE `tracker_tracker_queries` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_tracker_queries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upgrade_history`
--

DROP TABLE IF EXISTS `upgrade_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upgrade_history` (
  `id` char(36) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `md5sum` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `version` varchar(64) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `id_name` varchar(255) DEFAULT NULL,
  `manifest` longtext,
  `patch` text,
  `date_entered` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `upgrade_history_md5_uk` (`md5sum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upgrade_history`
--

LOCK TABLES `upgrade_history` WRITE;
/*!40000 ALTER TABLE `upgrade_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `upgrade_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_preferences`
--

DROP TABLE IF EXISTS `user_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_preferences` (
  `id` char(36) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `assigned_user_id` char(36) NOT NULL,
  `contents` longtext,
  PRIMARY KEY (`id`),
  KEY `idx_userprefnamecat` (`assigned_user_id`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_preferences`
--

LOCK TABLES `user_preferences` WRITE;
/*!40000 ALTER TABLE `user_preferences` DISABLE KEYS */;
INSERT INTO `user_preferences` VALUES ('099a2960-36b1-11e9-b38b-00e04c360044','Users',0,'2019-02-22 14:49:17','2019-02-22 15:23:00','1','YTowOnt9'),('099ac528-36b1-11e9-ba9f-00e04c360044','Reports',0,'2019-02-22 14:49:17','2019-02-22 15:23:00','1','YTowOnt9'),('333fb2e0-af78-11e9-9f06-00e04c68004f','ProjectTask2_PROJECTTASK',0,'2019-07-26 07:37:19','2019-07-26 07:37:19','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('3f9e1d3a-af76-11e9-8da9-00e04c68004f','Project2_PROJECT',0,'2019-07-26 07:23:21','2019-07-26 07:23:21','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('4473d8c8-aeb7-11e9-bba5-00e04c68004f','Schedulers2_SCHEDULER',0,'2019-07-25 08:36:14','2019-07-25 08:36:14','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('44743386-aeb7-11e9-b53e-00e04c68004f','Schedulers2_SCHEDULER',0,'2019-07-25 08:36:13','2019-07-25 08:36:13','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('510bfb38-36b2-11e9-a8f7-00e04c360044','Documents2_DOCUMENT',0,'2019-02-22 14:58:29','2019-02-22 15:23:00','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('72be7bdc-36af-11e9-96a9-00e04c360044','Users2_USER',0,'2019-02-22 14:37:57','2019-02-22 15:23:00','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('95f61e34-36af-11e9-a2bf-00e04c360044','sq_UsersQ',0,'2019-02-22 14:38:57','2019-02-22 15:23:00','1','YTowOnt9'),('9eedff3c-aaba-11e9-b203-00e04c68004f','PdfManager2_PDFMANAGER',0,'2019-07-20 06:50:09','2019-07-20 06:50:09','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('ab1e132c-459e-11e9-9e0a-1c4d7023ffd7','sq_EmailTemplatesQ',0,'2019-03-13 14:45:37','2019-03-13 14:45:37','1','YToxOntzOjE1OiJFbWFpbFRlbXBsYXRlc1EiO2E6Nzp7czo2OiJtb2R1bGUiO3M6MTQ6IkVtYWlsVGVtcGxhdGVzIjtzOjY6ImFjdGlvbiI7czo1OiJpbmRleCI7czoxMDoiY3NyZl90b2tlbiI7czozMjoiaGI2ZXJjVkVveFE1V21hOWg4Q1pQdEhabURidnh2TlMiO3M6MTM6InNlYXJjaEZvcm1UYWIiO3M6MTI6ImJhc2ljX3NlYXJjaCI7czo1OiJxdWVyeSI7czo0OiJ0cnVlIjtzOjEwOiJuYW1lX2Jhc2ljIjtzOjA6IiI7czo2OiJidXR0b24iO3M6NjoiU2VhcmNoIjt9fQ=='),('ab3a5348-459e-11e9-b16e-1c4d7023ffd7','EmailTemplates2_EMAILTEMPLATE',0,'2019-03-13 14:45:37','2019-03-13 14:45:37','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('ae3afb38-3699-11e9-af56-00e04c360044','global',0,'2019-02-22 12:01:29','2020-10-22 05:52:32','1','YTozNjp7czoxMzoicmVtaW5kZXJfdGltZSI7czo0OiIxODAwIjtzOjIwOiJjYWxlbmRhcl9wdWJsaXNoX2tleSI7czozNjoiYWUzZWNlYzAtMzY5OS0xMWU5LWJkZDItMDBlMDRjMzYwMDQ0IjtzOjg6InRpbWV6b25lIjtzOjEyOiJBc2lhL0pha2FydGEiO3M6NToiZGF0ZWYiO3M6NToibS9kL1kiO3M6NToidGltZWYiO3M6NDoiaDppYSI7czoyNjoiZGVmYXVsdF9sb2NhbGVfbmFtZV9mb3JtYXQiO3M6NToicyBmIGwiO3M6MjoidXQiO3M6MToiMSI7czoxMToiX19zdWdhcl91cmwiO3M6MjA6InYxMV8zL21lL3ByZWZlcmVuY2VzIjtzOjc6ImxvY2tvdXQiO3M6MDoiIjtzOjExOiJsb2dpbmZhaWxlZCI7aToxMztzOjEyOiJ1c2VyUHJpdkd1aWQiO3M6MzY6IjczNmZmNjQwLTM2YjAtMTFlOS05ZGQ3LTAwZTA0YzM2MDA0NCI7czoxMToibG9nb3V0X3RpbWUiO3M6MDoiIjtzOjEyOiJtYWlsbWVyZ2Vfb24iO3M6Mzoib2ZmIjtzOjE2OiJzd2FwX2xhc3Rfdmlld2VkIjtzOjA6IiI7czoxNDoic3dhcF9zaG9ydGN1dHMiO3M6MDoiIjtzOjE0OiJtb2R1bGVfZmF2aWNvbiI7czowOiIiO3M6OToiaGlkZV90YWJzIjthOjA6e31zOjExOiJyZW1vdmVfdGFicyI7YTowOnt9czo3OiJub19vcHBzIjtzOjM6Im9mZiI7czoxOToiZW1haWxfcmVtaW5kZXJfdGltZSI7aTotMTtzOjg6ImN1cnJlbmN5IjtzOjM6Ii05OSI7czoyMzoiY3VycmVuY3lfc2hvd19wcmVmZXJyZWQiO2I6MDtzOjI4OiJjdXJyZW5jeV9jcmVhdGVfaW5fcHJlZmVycmVkIjtiOjA7czo0OiJmZG93IjtzOjE6IjAiO3M6MTY6ImV4cG9ydF9kZWxpbWl0ZXIiO3M6MToiLCI7czoyMjoiZGVmYXVsdF9leHBvcnRfY2hhcnNldCI7czo1OiJVVEYtOCI7czoxNDoidXNlX3JlYWxfbmFtZXMiO3M6Mjoib24iO3M6MTc6Im1haWxfc210cGF1dGhfcmVxIjtzOjA6IiI7czoxMjoibWFpbF9zbXRwc3NsIjtpOjA7czoyNzoic3VnYXJwZGZfcGRmX2ZvbnRfbmFtZV9tYWluIjtzOjEwOiJkZWphdnVzYW5zIjtzOjI3OiJzdWdhcnBkZl9wZGZfZm9udF9zaXplX21haW4iO3M6MToiOCI7czoyNzoic3VnYXJwZGZfcGRmX2ZvbnRfbmFtZV9kYXRhIjtzOjEwOiJkZWphdnVzYW5zIjtzOjI3OiJzdWdhcnBkZl9wZGZfZm9udF9zaXplX2RhdGEiO3M6MToiOCI7czoxNToiZW1haWxfbGlua190eXBlIjtzOjY6Im1haWx0byI7czoxNzoiZW1haWxfc2hvd19jb3VudHMiO2k6MDtzOjEyOiJkYXNoYm9hcmRfaWQiO3M6MzY6ImNmNTI3YzcyLTc5NDgtMTFlYS04ZmJjLTA1MjYxMDQ5OTI0YSI7fQ=='),('b2618130-48cf-11e9-927f-1c4d7023ffd7','ETag',0,'2019-03-17 16:14:09','2019-07-02 14:46:35','1','YToxOntzOjEyOiJtYWluTWVudUVUYWciO2k6Mzt9'),('b2ab8d8a-369a-11e9-9f4f-00e04c360044','Emails',0,'2019-02-22 12:09:25','2019-02-23 12:08:15','1','YTowOnt9'),('b9ccb450-36b2-11e9-bc0e-00e04c360044','OAuthKeys2_OAUTHKEY',0,'2019-02-22 15:01:22','2019-02-22 15:23:00','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('bdb446e8-36b5-11e9-8c22-00e04c360044','sq_DocumentsQ',0,'2019-02-22 15:23:00','2019-02-22 15:23:00','1','YTowOnt9'),('bdb58eae-36b5-11e9-92bf-00e04c360044','sq_OAuthKeysQ',0,'2019-02-22 15:23:00','2019-02-22 15:23:00','1','YTowOnt9'),('c526bcc6-36b5-11e9-8c54-00e04c360044','sq_EmployeesQ',0,'2019-02-22 15:23:13','2019-02-22 15:23:13','1','YToxOntzOjEwOiJFbXBsb3llZXNRIjthOjQ6e3M6NjoibW9kdWxlIjtzOjk6IkVtcGxveWVlcyI7czo2OiJhY3Rpb24iO3M6NToiaW5kZXgiO3M6NToicXVlcnkiO3M6NDoidHJ1ZSI7czo4OiJid2NGcmFtZSI7czoxOiIxIjt9fQ=='),('c52895c8-36b5-11e9-a712-00e04c360044','Employees2_EMPLOYEE',0,'2019-02-22 15:23:13','2019-02-22 15:23:13','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ=='),('e20fa29e-36b5-11e9-a03e-00e04c360044','Campaigns2_CAMPAIGN',0,'2019-02-22 15:24:01','2019-02-22 15:24:01','1','YToxOntzOjEzOiJsaXN0dmlld09yZGVyIjthOjI6e3M6Nzoib3JkZXJCeSI7czoxMjoiZGF0ZV9lbnRlcmVkIjtzOjk6InNvcnRPcmRlciI7czo0OiJERVNDIjt9fQ==');
/*!40000 ALTER TABLE `user_preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `user_name` varchar(60) DEFAULT NULL,
  `user_hash` varchar(255) DEFAULT NULL,
  `system_generated_password` tinyint(1) DEFAULT '0',
  `pwd_last_changed` datetime DEFAULT NULL,
  `authenticate_id` varchar(100) DEFAULT NULL,
  `dotb_login` tinyint(1) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `external_auth_only` tinyint(1) DEFAULT '0',
  `receive_notifications` tinyint(1) DEFAULT '1',
  `description` text,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `phone_home` varchar(50) DEFAULT NULL,
  `phone_mobile` varchar(50) DEFAULT NULL,
  `phone_work` varchar(50) DEFAULT NULL,
  `phone_other` varchar(50) DEFAULT NULL,
  `phone_fax` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `address_street` varchar(150) DEFAULT NULL,
  `address_city` varchar(100) DEFAULT NULL,
  `address_state` varchar(100) DEFAULT NULL,
  `address_country` varchar(100) DEFAULT NULL,
  `address_postalcode` varchar(20) DEFAULT NULL,
  `default_team` char(36) DEFAULT NULL,
  `team_set_id` char(36) DEFAULT NULL,
  `acl_team_set_id` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `portal_only` tinyint(1) DEFAULT '0',
  `show_on_employees` tinyint(1) DEFAULT '1',
  `employee_status` varchar(100) DEFAULT NULL,
  `messenger_id` varchar(100) DEFAULT NULL,
  `messenger_type` varchar(100) DEFAULT NULL,
  `reports_to_id` char(36) DEFAULT NULL,
  `is_group` tinyint(1) DEFAULT '0',
  `preferred_language` varchar(255) DEFAULT NULL,
  `acl_role_set_id` char(36) DEFAULT NULL,
  `customer_journey_access` tinyint(1) DEFAULT '0',
  `asterisk_phone_extension` varchar(255) DEFAULT NULL,
  `asterisk_ip` varchar(255) DEFAULT NULL,
  `asterisk_chanel` varchar(255) DEFAULT NULL,
  `asterisk_context` varchar(255) DEFAULT NULL,
  `full_user_name` varchar(250) DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `portal_app_token` text,
  `teacher_id` varchar(45) DEFAULT NULL,
  `reminder_time_default` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_name` (`user_name`,`is_group`,`status`,`last_name`,`first_name`,`id`),
  KEY `idx_user_first_last` (`first_name`,`last_name`,`deleted`),
  KEY `idx_user_last_first` (`last_name`,`first_name`,`deleted`),
  KEY `idx_users_reports_to_id` (`reports_to_id`,`id`),
  KEY `idx_last_login` (`last_login`),
  KEY `idx_users_tmst_id` (`team_set_id`),
  KEY `idx_user_title` (`title`),
  KEY `idx_user_department` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('1','admin','$2y$10$K09Bw5.DaV/6rQkMVXPbwOS7x7AUAPeTP2..Kd.ZF0b3j2Detq9Tu',0,NULL,'',1,'','Lap Nguyen','Administrator',1,0,1,'','2019-02-22 12:01:29','2020-04-08 03:30:05','2020-10-22 05:52:36','1','','Administrator','','','','055455445445','','','Active','','','','','','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7','8f86c9fa-459a-11e9-ba7b-1c4d7023ffd7','',0,0,1,'Active','','','',0,'en_us','',0,'','','','',NULL,NULL,NULL,NULL,NULL),('be6dc3aa-3699-11e9-867e-00e04c360044','SNIPuser','$2y$10$EHKKFJRs8.3s68derotitOp4F3Vj3FKrJlwj9x5vchXA3cFT5tgHq',0,NULL,'f85f6e2ee6d0',1,NULL,NULL,'Email Archiving user',0,1,0,'Email Archiving user','2019-02-22 12:01:29','2019-02-22 12:01:29',NULL,'1','1','Email Archiving user',NULL,NULL,NULL,NULL,NULL,NULL,'Reserved',NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,0,0,1,NULL,NULL,NULL,NULL,0,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_cstm`
--

DROP TABLE IF EXISTS `users_cstm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_cstm` (
  `id_c` char(36) NOT NULL,
  `phoneextension_c` varchar(150) DEFAULT '',
  `asteriskname_c` varchar(255) DEFAULT '',
  `dial_plan_c` varchar(255) DEFAULT '',
  `dialout_prefix_c` varchar(150) DEFAULT '',
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_cstm`
--

LOCK TABLES `users_cstm` WRITE;
/*!40000 ALTER TABLE `users_cstm` DISABLE KEYS */;
INSERT INTO `users_cstm` VALUES ('1','','','','');
/*!40000 ALTER TABLE `users_cstm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_feeds`
--

DROP TABLE IF EXISTS `users_feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_feeds` (
  `user_id` char(36) DEFAULT NULL,
  `feed_id` char(36) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  KEY `idx_ud_user_id` (`user_id`,`feed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_feeds`
--

LOCK TABLES `users_feeds` WRITE;
/*!40000 ALTER TABLE `users_feeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_holidays`
--

DROP TABLE IF EXISTS `users_holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_holidays` (
  `id` char(36) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `holiday_id` char(36) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_user_holi_user` (`user_id`),
  KEY `idx_user_holi_holi` (`holiday_id`),
  KEY `users_quotes_alt` (`user_id`,`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_holidays`
--

LOCK TABLES `users_holidays` WRITE;
/*!40000 ALTER TABLE `users_holidays` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_last_import`
--

DROP TABLE IF EXISTS `users_last_import`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_last_import` (
  `id` char(36) NOT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `import_module` varchar(36) DEFAULT NULL,
  `bean_type` varchar(36) DEFAULT NULL,
  `bean_id` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`assigned_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_last_import`
--

LOCK TABLES `users_last_import` WRITE;
/*!40000 ALTER TABLE `users_last_import` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_last_import` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_password_link`
--

DROP TABLE IF EXISTS `users_password_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_password_link` (
  `id` char(36) NOT NULL,
  `username` varchar(36) DEFAULT NULL,
  `date_generated` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_password_link`
--

LOCK TABLES `users_password_link` WRITE;
/*!40000 ALTER TABLE `users_password_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_password_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_signatures`
--

DROP TABLE IF EXISTS `users_signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_signatures` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `user_id` char(36) DEFAULT NULL,
  `signature` text,
  `signature_html` text,
  PRIMARY KEY (`id`),
  KEY `idx_users_signatures_date_modfied` (`date_modified`),
  KEY `idx_users_signatures_id_del` (`id`,`deleted`),
  KEY `idx_users_signatures_date_entered` (`date_entered`),
  KEY `idx_users_signatures_name_del` (`name`,`deleted`),
  KEY `idx_usersig_uid` (`user_id`),
  KEY `idx_usersig_created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_signatures`
--

LOCK TABLES `users_signatures` WRITE;
/*!40000 ALTER TABLE `users_signatures` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_signatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vcals`
--

DROP TABLE IF EXISTS `vcals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vcals` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `user_id` char(36) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `idx_vcal` (`type`,`user_id`,`source`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vcals`
--

LOCK TABLES `vcals` WRITE;
/*!40000 ALTER TABLE `vcals` DISABLE KEYS */;
/*!40000 ALTER TABLE `vcals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versions`
--

DROP TABLE IF EXISTS `versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `versions` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_version` varchar(255) DEFAULT NULL,
  `db_version` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_version` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versions`
--

LOCK TABLES `versions` WRITE;
/*!40000 ALTER TABLE `versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weblogichooks`
--

DROP TABLE IF EXISTS `weblogichooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weblogichooks` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `webhook_target_module` varchar(255) DEFAULT NULL,
  `request_method` varchar(255) DEFAULT 'POST',
  `url` varchar(255) DEFAULT NULL,
  `trigger_event` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_weblogichooks_date_modfied` (`date_modified`),
  KEY `idx_weblogichooks_id_del` (`id`,`deleted`),
  KEY `idx_weblogichooks_date_entered` (`date_entered`),
  KEY `idx_weblogichooks_name_del` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weblogichooks`
--

LOCK TABLES `weblogichooks` WRITE;
/*!40000 ALTER TABLE `weblogichooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `weblogichooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `base_module` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `description` text,
  `type` varchar(100) DEFAULT NULL,
  `fire_order` varchar(100) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `record_type` varchar(100) DEFAULT NULL,
  `list_order_y` int(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_workflow` (`name`,`deleted`),
  KEY `idx_workflow_type` (`type`),
  KEY `idx_workflow_base_module` (`base_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow`
--

LOCK TABLES `workflow` WRITE;
/*!40000 ALTER TABLE `workflow` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_actions`
--

DROP TABLE IF EXISTS `workflow_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_actions` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `field` varchar(50) DEFAULT NULL,
  `value` text,
  `set_type` varchar(10) DEFAULT NULL,
  `adv_type` varchar(10) DEFAULT NULL,
  `parent_id` char(36) NOT NULL,
  `ext1` varchar(50) DEFAULT NULL,
  `ext2` varchar(50) DEFAULT NULL,
  `ext3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_action` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_actions`
--

LOCK TABLES `workflow_actions` WRITE;
/*!40000 ALTER TABLE `workflow_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_actionshells`
--

DROP TABLE IF EXISTS `workflow_actionshells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_actionshells` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `action_type` varchar(100) DEFAULT NULL,
  `parent_id` char(36) NOT NULL,
  `parameters` varchar(255) DEFAULT NULL,
  `rel_module` varchar(50) DEFAULT NULL,
  `rel_module_type` varchar(10) DEFAULT NULL,
  `action_module` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_actionshell` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_actionshells`
--

LOCK TABLES `workflow_actionshells` WRITE;
/*!40000 ALTER TABLE `workflow_actionshells` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_actionshells` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_alerts`
--

DROP TABLE IF EXISTS `workflow_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_alerts` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `field_value` varchar(50) DEFAULT NULL,
  `rel_email_value` varchar(50) DEFAULT NULL,
  `rel_module1` varchar(255) DEFAULT NULL,
  `rel_module2` varchar(255) DEFAULT NULL,
  `rel_module1_type` varchar(10) DEFAULT NULL,
  `rel_module2_type` varchar(10) DEFAULT NULL,
  `where_filter` tinyint(1) DEFAULT '0',
  `user_type` varchar(100) DEFAULT NULL,
  `array_type` varchar(100) DEFAULT NULL,
  `relate_type` varchar(100) DEFAULT NULL,
  `address_type` varchar(100) DEFAULT NULL,
  `parent_id` char(36) NOT NULL,
  `user_display_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_workflowalerts` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_alerts`
--

LOCK TABLES `workflow_alerts` WRITE;
/*!40000 ALTER TABLE `workflow_alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_alertshells`
--

DROP TABLE IF EXISTS `workflow_alertshells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_alertshells` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `alert_text` text,
  `alert_type` varchar(100) DEFAULT NULL,
  `source_type` varchar(100) DEFAULT NULL,
  `parent_id` char(36) NOT NULL,
  `custom_template_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_workflowalertshell` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_alertshells`
--

LOCK TABLES `workflow_alertshells` WRITE;
/*!40000 ALTER TABLE `workflow_alertshells` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_alertshells` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_schedules`
--

DROP TABLE IF EXISTS `workflow_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_schedules` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  `workflow_id` char(36) DEFAULT NULL,
  `target_module` varchar(50) DEFAULT NULL,
  `bean_id` char(36) DEFAULT NULL,
  `parameters` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wkfl_schedule` (`workflow_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_schedules`
--

LOCK TABLES `workflow_schedules` WRITE;
/*!40000 ALTER TABLE `workflow_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow_triggershells`
--

DROP TABLE IF EXISTS `workflow_triggershells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow_triggershells` (
  `id` char(36) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `field` varchar(50) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `frame_type` varchar(15) DEFAULT NULL,
  `eval` text,
  `parent_id` char(36) NOT NULL,
  `show_past` tinyint(1) DEFAULT '0',
  `rel_module` varchar(255) DEFAULT NULL,
  `rel_module_type` varchar(10) DEFAULT NULL,
  `parameters` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow_triggershells`
--

LOCK TABLES `workflow_triggershells` WRITE;
/*!40000 ALTER TABLE `workflow_triggershells` DISABLE KEYS */;
/*!40000 ALTER TABLE `workflow_triggershells` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-02  9:57:30