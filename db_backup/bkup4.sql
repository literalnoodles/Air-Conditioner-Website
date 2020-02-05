-- MariaDB dump 10.17  Distrib 10.4.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cosy_airconditioner
-- ------------------------------------------------------
-- Server version	10.4.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `cosy_airconditioner`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cosy_airconditioner` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cosy_airconditioner`;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` char(60) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (1,'root','$2y$10$.FtGTAU23q/oeZs1NE9pN.stF8KK0D0W6yj4KdH2eetW.95H1XDq6',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_brands`
--

DROP TABLE IF EXISTS `tbl_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `logo` varchar(400) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `phone_number` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`brand_id`),
  UNIQUE KEY `tbl_brand_un` (`brand_name`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_brands`
--

LOCK TABLES `tbl_brands` WRITE;
/*!40000 ALTER TABLE `tbl_brands` DISABLE KEYS */;
INSERT INTO `tbl_brands` VALUES (52,'Panasonic','Japan','LÃ´ J1-J2, Khu cÃ´ng nghiá»‡p ThÄƒng Long, xÃ£ Kim Chung, huyá»‡n ÄÃ´ng Anh, Tp. HÃ  Ná»™i, Viá»‡t Nam','customer@vn.panasonic.com','https://www.panasonic.com/vn/','Matsushita Electric Industrial Co., Ltd. (æ¾ä¸‹é›»å™¨ç”£æ¥­æ ªå¼ä¼šç¤¾ (TÃ¹ng Háº¡ Äiá»‡n khÃ­ Sáº£n nghiá»‡p Chu thá»©c há»™i xÃ£) Matsushita Denki SangyÅ Kabushiki-gaisha?) (TYO: 6752, NYSE: MC) lÃ  má»™t cÃ´ng ty cháº¿ táº¡o Ä‘iá»‡n tá»­ Nháº­t Báº£n Ä‘Ã³ng trá»¥ sá»Ÿ á»Ÿ Kadoma, tá»‰nh Osaka, Nháº­t Báº£n. Sáº£n pháº©m cá»§a hÃ£ng nÃ y Ä‘a dáº¡ng vá»›i thÆ°Æ¡ng hiá»‡u Panasonic vÃ  Technics.','./storage/brands_logo/5e018d8dd5813.jpg','','1800 1593'),(58,'Daikin','Japan',' CÃ´ng ty TNHH Äiá»‡n tá»­ - Äiá»‡n láº¡nh Minh SÆ¡n','baohanhminhhoang@gmail.com','https://www.daikin.com.vn/#','Daikin Industries, Ltd. lÃ  má»™t cÃ´ng ty sáº£n xuáº¥t Ä‘iá»u hÃ²a khÃ´ng khÃ­ Ä‘a quá»‘c gia cá»§a Nháº­t Báº£n cÃ³ trá»¥ sá»Ÿ táº¡i Osaka, cÃ³ hoáº¡t Ä‘á»™ng táº¡i Hoa Ká»³, Nháº­t Báº£n, Trung Quá»‘c, Philippines, Ãšc, áº¤n Äá»™, ÄÃ´ng Nam Ã, ChÃ¢u Ã‚u vÃ  ChÃ¢u Má»¹ Latinh','./storage/brands_logo/5e0197bc32b89.jpg',NULL,'0243 8465275'),(113,'fa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `picture` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `tbl_categories_un` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categories`
--

LOCK TABLES `tbl_categories` WRITE;
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
INSERT INTO `tbl_categories` VALUES (16,'re','rw',NULL),(19,'erew','q',NULL);
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_deliveries`
--

DROP TABLE IF EXISTS `tbl_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_deliveries` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_deliveries`
--

LOCK TABLES `tbl_deliveries` WRITE;
/*!40000 ALTER TABLE `tbl_deliveries` DISABLE KEYS */;
INSERT INTO `tbl_deliveries` VALUES (1,'giao hang tiet kiem','1800','https://giaohangtietkiem.vn/');
/*!40000 ALTER TABLE `tbl_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_features`
--

DROP TABLE IF EXISTS `tbl_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_features` (
  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_name` varchar(200) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`feature_id`),
  UNIQUE KEY `tbl_features_un` (`feature_name`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_features`
--

LOCK TABLES `tbl_features` WRITE;
/*!40000 ALTER TABLE `tbl_features` DISABLE KEYS */;
INSERT INTO `tbl_features` VALUES (108,'af','3'),(110,'feature2','aa'),(111,'fs','fds4'),(112,'fds','asdf');
/*!40000 ALTER TABLE `tbl_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_features_products`
--

DROP TABLE IF EXISTS `tbl_features_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_features_products` (
  `product_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_features_products`
--

LOCK TABLES `tbl_features_products` WRITE;
/*!40000 ALTER TABLE `tbl_features_products` DISABLE KEYS */;
INSERT INTO `tbl_features_products` VALUES (3,108),(3,110),(9,108),(9,110);
/*!40000 ALTER TABLE `tbl_features_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` smallint(6) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orders`
--

LOCK TABLES `tbl_orders` WRITE;
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;
INSERT INTO `tbl_orders` VALUES (16,NULL,'2020-01-03 10:15:39',1,'fasas','sdf','sf','234423'),(17,NULL,'2020-01-03 15:36:16',3,'ad','3423','234','150'),(18,NULL,'2020-01-03 15:37:59',4,'342','234','fs','234'),(19,NULL,'2020-01-03 15:38:47',4,'6','fds','234','234');
/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orders_details`
--

DROP TABLE IF EXISTS `tbl_orders_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_orders_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orders_details`
--

LOCK TABLES `tbl_orders_details` WRITE;
/*!40000 ALTER TABLE `tbl_orders_details` DISABLE KEYS */;
INSERT INTO `tbl_orders_details` VALUES (18,13,2,1,1),(19,3,12,1,32),(16,9,6,1,3),(16,3,12,4,32),(17,14,8,1,4);
/*!40000 ALTER TABLE `tbl_orders_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `brand_id` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `unit_price` double DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `unit_in_stock` int(11) unsigned NOT NULL,
  `picture` varchar(300) DEFAULT NULL,
  `apower_consumption` decimal(3,1) DEFAULT NULL,
  `cooling_capacity` int(11) DEFAULT NULL,
  `effective_range` smallint(6) DEFAULT NULL,
  `n_ways` smallint(6) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `inverter` smallint(6) DEFAULT NULL,
  `energy_label` smallint(6) DEFAULT NULL,
  `release_date` datetime DEFAULT NULL,
  `country_of_origin` varchar(50) DEFAULT NULL,
  `warranty_period` smallint(6) DEFAULT NULL,
  `document` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `tbl_products_un` (`product_name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_products`
--

LOCK TABLES `tbl_products` WRITE;
/*!40000 ALTER TABLE `tbl_products` DISABLE KEYS */;
INSERT INTO `tbl_products` VALUES (3,'fs',NULL,'58','19',12,32,7,NULL,1.1,12000,30,2,2,1,4,NULL,'fas',10,NULL),(9,'a',NULL,'52','19',NULL,3,2,NULL,NULL,NULL,NULL,2,2,1,NULL,NULL,'f',NULL,NULL),(13,'re',NULL,'58','19',2,1,1,NULL,NULL,NULL,NULL,2,2,0,NULL,NULL,NULL,NULL,NULL),(14,'fawer',NULL,'58','19',8,4,2,NULL,NULL,NULL,NULL,1,3,1,NULL,NULL,NULL,NULL,NULL),(17,'as',NULL,'58','19',NULL,2,1,NULL,NULL,NULL,NULL,2,2,1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` char(60) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `tbl_users_un` (`fullname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-03 16:41:26
