-- MySQL dump 10.13  Distrib 5.7.38, for Linux (x86_64)
--
-- Host: localhost    Database: thegarden
-- ------------------------------------------------------
-- Server version	5.7.38-0ubuntu0.18.04.1

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2020_10_12_000000_create_products_table',1),(6,'2021_10_12_000000_create_orders_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniqid` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  `fullname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_expiration` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_cvv` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_uniqid_unique` (`uniqid`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'ZX86JRD8',1,75.00,'Dr. Orland Dare III','9336 McGlynn Harbors Suite 113','17711','Romaguerachester','Maldives','NDcxNjgxNjA5OTQyOTE5OQ==','03/25','204','{\"compute\":{\"quantity\":13,\"total\":75},\"5\":{\"product_id\":5,\"quantity\":10,\"price\":\"6.00\",\"total\":60},\"4\":{\"product_id\":4,\"quantity\":3,\"price\":\"5.00\",\"total\":15}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(2,'TB622VL3',10,85.00,'Mateo Shields','4415 Karley Park','79718-1951','Turnerhaven','Madagascar','MzUyODc3MTM2MDcyMjQwMg==','01/25','338','{\"compute\":{\"quantity\":15,\"total\":85},\"1\":{\"product_id\":1,\"quantity\":5,\"price\":\"7.00\",\"total\":35},\"4\":{\"product_id\":4,\"quantity\":10,\"price\":\"5.00\",\"total\":50}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(3,'KX738AV7',10,121.00,'Mr. Juwan Hintz','6967 Adriana Trail Suite 338','27292','Port Nasir','Madagascar','NjAxMTcyNzk1MjcyNTk3OA==','07/23','085','{\"compute\":{\"quantity\":33,\"total\":121},\"6\":{\"product_id\":6,\"quantity\":10,\"price\":\"2.00\",\"total\":20},\"5\":{\"product_id\":5,\"quantity\":4,\"price\":\"6.00\",\"total\":24},\"2\":{\"product_id\":2,\"quantity\":2,\"price\":\"6.00\",\"total\":12},\"4\":{\"product_id\":4,\"quantity\":7,\"price\":\"5.00\",\"total\":35},\"3\":{\"product_id\":3,\"quantity\":10,\"price\":\"3.00\",\"total\":30}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(4,'BR43B5KT',2,78.00,'Prof. Quincy Fritsch','880 Klein Track','27738','Port Deonmouth','Niue','NDUzOTI4NjUzOTE0MzM2OQ==','04/23','951','{\"compute\":{\"quantity\":17,\"total\":78},\"3\":{\"product_id\":3,\"quantity\":8,\"price\":\"3.00\",\"total\":24},\"5\":{\"product_id\":5,\"quantity\":7,\"price\":\"6.00\",\"total\":42},\"2\":{\"product_id\":2,\"quantity\":2,\"price\":\"6.00\",\"total\":12}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(5,'ZQ63VJE9',11,59.00,'Ofelia Christiansen','74509 Towne Village Apt. 148','51998-4358','Daviston','Switzerland','NTU5NjQ1NjMzOTA4NDA3NA==','03/24','783','{\"compute\":{\"quantity\":17,\"total\":59},\"7\":{\"product_id\":7,\"quantity\":7,\"price\":\"3.00\",\"total\":21},\"3\":{\"product_id\":3,\"quantity\":6,\"price\":\"3.00\",\"total\":18},\"4\":{\"product_id\":4,\"quantity\":4,\"price\":\"5.00\",\"total\":20}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(6,'NK57UHLY',1,57.00,'Brock Roberts','977 Winnifred Vista','26717-1684','South Mark','Burundi','NDQ4NTA1NDE2MDg0NTgwOQ==','04/24','314','{\"compute\":{\"quantity\":10,\"total\":57},\"4\":{\"product_id\":4,\"quantity\":3,\"price\":\"5.00\",\"total\":15},\"5\":{\"product_id\":5,\"quantity\":7,\"price\":\"6.00\",\"total\":42}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(7,'HU57ZVPG',9,73.00,'Delia Smitham DDS','8140 Janis Radial','38189','Kylashire','Djibouti','NDQ4NTYxODgzNTg4Nw==','10/22','008','{\"compute\":{\"quantity\":16,\"total\":73},\"6\":{\"product_id\":6,\"quantity\":6,\"price\":\"2.00\",\"total\":12},\"1\":{\"product_id\":1,\"quantity\":1,\"price\":\"7.00\",\"total\":7},\"5\":{\"product_id\":5,\"quantity\":6,\"price\":\"6.00\",\"total\":36},\"2\":{\"product_id\":2,\"quantity\":3,\"price\":\"6.00\",\"total\":18}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(8,'DM98ZCEV',2,95.00,'Dr. Aron Watsica III','783 Graham Drive Suite 070','00534-3302','Lake Geoffreyberg','Hong Kong','NDcxNjI1MDU2Mzk3NzUwMQ==','10/23','958','{\"compute\":{\"quantity\":20,\"total\":95},\"7\":{\"product_id\":7,\"quantity\":5,\"price\":\"3.00\",\"total\":15},\"6\":{\"product_id\":6,\"quantity\":5,\"price\":\"2.00\",\"total\":10},\"1\":{\"product_id\":1,\"quantity\":10,\"price\":\"7.00\",\"total\":70}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(9,'KG92449Q',11,151.00,'Ike Hettinger','867 Ceasar Freeway','51588-1893','North Wilber','Cook Islands','NDU1NjkzMDY1MDk4OTA2Mg==','09/23','225','{\"compute\":{\"quantity\":36,\"total\":151},\"1\":{\"product_id\":1,\"quantity\":6,\"price\":\"7.00\",\"total\":42},\"7\":{\"product_id\":7,\"quantity\":8,\"price\":\"3.00\",\"total\":24},\"6\":{\"product_id\":6,\"quantity\":8,\"price\":\"2.00\",\"total\":16},\"2\":{\"product_id\":2,\"quantity\":9,\"price\":\"6.00\",\"total\":54},\"3\":{\"product_id\":3,\"quantity\":5,\"price\":\"3.00\",\"total\":15}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(10,'MC346VRZ',1,91.00,'Myriam Predovic','4307 Wilhelm Path','08600-4930','Mannstad','Comoros','Mzc5NzIyNTE1MjUzNDI3','12/22','304','{\"compute\":{\"quantity\":18,\"total\":91},\"5\":{\"product_id\":5,\"quantity\":7,\"price\":\"6.00\",\"total\":42},\"3\":{\"product_id\":3,\"quantity\":3,\"price\":\"3.00\",\"total\":9},\"4\":{\"product_id\":4,\"quantity\":8,\"price\":\"5.00\",\"total\":40}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(11,'CR156JW4',9,121.00,'Armando Green','65515 Ernser Spring','39611-8452','Earlinemouth','Ghana','NDUzOTk1ODU5MjQ3ODcxNA==','05/25','338','{\"compute\":{\"quantity\":23,\"total\":121},\"1\":{\"product_id\":1,\"quantity\":10,\"price\":\"7.00\",\"total\":70},\"3\":{\"product_id\":3,\"quantity\":4,\"price\":\"3.00\",\"total\":12},\"2\":{\"product_id\":2,\"quantity\":4,\"price\":\"6.00\",\"total\":24},\"7\":{\"product_id\":7,\"quantity\":5,\"price\":\"3.00\",\"total\":15}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(12,'BP96JMR6',10,123.00,'Erick Auer','6095 Mayer Mall Suite 474','74162','New Riverview','Kuwait','MjcyMDIxOTQwMzM4MDMxNQ==','01/24','981','{\"compute\":{\"quantity\":22,\"total\":123},\"7\":{\"product_id\":7,\"quantity\":3,\"price\":\"3.00\",\"total\":9},\"5\":{\"product_id\":5,\"quantity\":7,\"price\":\"6.00\",\"total\":42},\"1\":{\"product_id\":1,\"quantity\":9,\"price\":\"7.00\",\"total\":63},\"3\":{\"product_id\":3,\"quantity\":3,\"price\":\"3.00\",\"total\":9}}','2022-07-20 10:07:27','2022-07-20 10:07:28'),(13,'EX85SRQD',1,107.00,'Lyric Lakin','66781 Agnes Curve Apt. 920','88277','Olsonbury','Poland','NDcxNjA1Mjc1NjE2ODk3NQ==','02/24','664','{\"compute\":{\"quantity\":24,\"total\":107},\"4\":{\"product_id\":4,\"quantity\":7,\"price\":\"5.00\",\"total\":35},\"2\":{\"product_id\":2,\"quantity\":7,\"price\":\"6.00\",\"total\":42},\"1\":{\"product_id\":1,\"quantity\":2,\"price\":\"7.00\",\"total\":14},\"6\":{\"product_id\":6,\"quantity\":8,\"price\":\"2.00\",\"total\":16}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(14,'BF75KDKV',1,73.00,'Prof. Thad Pollich V','1487 Jermain Trafficway','06880-5411','South Pablo','Cote d\'Ivoire','Mzc3Mzc1MDY5ODUxNTkx','03/23','971','{\"compute\":{\"quantity\":11,\"total\":73},\"2\":{\"product_id\":2,\"quantity\":4,\"price\":\"6.00\",\"total\":24},\"1\":{\"product_id\":1,\"quantity\":7,\"price\":\"7.00\",\"total\":49}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(15,'QH79K52R',11,39.00,'Trent Cremin MD','15898 Altenwerth Dam','70340-1724','Ardithside','Somalia','MzU4OTU5NDkzMjU3MTEwNw==','10/24','434','{\"compute\":{\"quantity\":15,\"total\":39},\"3\":{\"product_id\":3,\"quantity\":9,\"price\":\"3.00\",\"total\":27},\"6\":{\"product_id\":6,\"quantity\":6,\"price\":\"2.00\",\"total\":12}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(16,'DM96DZEB',1,4.00,'Dr. Blanca Pouros','1095 Wiegand Crescent Apt. 216','26306','South Herminia','Niger','NTQwODQ0OTAwMDk0MTA1MA==','05/25','952','{\"compute\":{\"quantity\":2,\"total\":4},\"6\":{\"product_id\":6,\"quantity\":2,\"price\":\"2.00\",\"total\":4}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(17,'SA84Y7VS',9,81.00,'Bianka Will','25547 Monserrate Shore Suite 165','25831-1937','Alvahport','Malaysia','NDUzOTE5NDg4NTc5NzQ0Mg==','04/24','046','{\"compute\":{\"quantity\":20,\"total\":81},\"6\":{\"product_id\":6,\"quantity\":6,\"price\":\"2.00\",\"total\":12},\"7\":{\"product_id\":7,\"quantity\":5,\"price\":\"3.00\",\"total\":15},\"2\":{\"product_id\":2,\"quantity\":9,\"price\":\"6.00\",\"total\":54}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(18,'CG22AKRB',10,108.00,'Sam Stracke','581 Schamberger Vista','66019-2680','West Leonor','Niue','NTI0ODg3OTE3ODgzMjU0Nw==','04/23','265','{\"compute\":{\"quantity\":26,\"total\":108},\"2\":{\"product_id\":2,\"quantity\":9,\"price\":\"6.00\",\"total\":54},\"6\":{\"product_id\":6,\"quantity\":9,\"price\":\"2.00\",\"total\":18},\"3\":{\"product_id\":3,\"quantity\":4,\"price\":\"3.00\",\"total\":12},\"5\":{\"product_id\":5,\"quantity\":4,\"price\":\"6.00\",\"total\":24}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(19,'BV95MPMK',2,72.00,'Nelda Krajcik','87625 Halvorson Turnpike','36614','South Angiechester','Montenegro','NTU3OTM4ODI4NTU2MzI0Mg==','07/24','956','{\"compute\":{\"quantity\":20,\"total\":72},\"2\":{\"product_id\":2,\"quantity\":4,\"price\":\"6.00\",\"total\":24},\"7\":{\"product_id\":7,\"quantity\":8,\"price\":\"3.00\",\"total\":24},\"3\":{\"product_id\":3,\"quantity\":8,\"price\":\"3.00\",\"total\":24}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(20,'XK91DVAK',10,39.00,'Rafaela Prohaska','423 Reese Turnpike','31973','Boyerburgh','Romania','MjQ1NjQ5NzY5MTY5OTAyMg==','10/22','753','{\"compute\":{\"quantity\":13,\"total\":39},\"4\":{\"product_id\":4,\"quantity\":2,\"price\":\"5.00\",\"total\":10},\"6\":{\"product_id\":6,\"quantity\":4,\"price\":\"2.00\",\"total\":8},\"7\":{\"product_id\":7,\"quantity\":7,\"price\":\"3.00\",\"total\":21}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(21,'WU98BHA3',9,8.00,'Gertrude Paucek','31382 Garrison Mews','24362-2208','New Cedrickburgh','Mauritius','NjAxMTAxODA0NjczNzg2OA==','06/23','572','{\"compute\":{\"quantity\":4,\"total\":8},\"6\":{\"product_id\":6,\"quantity\":4,\"price\":\"2.00\",\"total\":8}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(22,'XU34WMY1',1,102.00,'Jaime Von MD','58080 Predovic Spurs','95048','Bergeburgh','Croatia','NDAyNDAwNzE4MTk1MDI1Mw==','08/22','121','{\"compute\":{\"quantity\":23,\"total\":102},\"4\":{\"product_id\":4,\"quantity\":7,\"price\":\"5.00\",\"total\":35},\"1\":{\"product_id\":1,\"quantity\":1,\"price\":\"7.00\",\"total\":7},\"2\":{\"product_id\":2,\"quantity\":5,\"price\":\"6.00\",\"total\":30},\"7\":{\"product_id\":7,\"quantity\":10,\"price\":\"3.00\",\"total\":30}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(23,'EV73GARN',1,107.00,'Flo Larkin','69788 Twila Locks','17697','Lake Ericmouth','Mali','MjIyMTE4OTYzODU3Nzc1OQ==','08/22','894','{\"compute\":{\"quantity\":20,\"total\":107},\"1\":{\"product_id\":1,\"quantity\":4,\"price\":\"7.00\",\"total\":28},\"5\":{\"product_id\":5,\"quantity\":7,\"price\":\"6.00\",\"total\":42},\"3\":{\"product_id\":3,\"quantity\":4,\"price\":\"3.00\",\"total\":12},\"4\":{\"product_id\":4,\"quantity\":5,\"price\":\"5.00\",\"total\":25}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(24,'QQ63J3AW',10,120.00,'Vanessa Ryan','61930 Meaghan Roads Apt. 608','05846','Dorthyburgh','Liberia','NjAxMTU0NTc5NTUzMzY5Mg==','05/25','437','{\"compute\":{\"quantity\":30,\"total\":120},\"4\":{\"product_id\":4,\"quantity\":2,\"price\":\"5.00\",\"total\":10},\"7\":{\"product_id\":7,\"quantity\":5,\"price\":\"3.00\",\"total\":15},\"1\":{\"product_id\":1,\"quantity\":9,\"price\":\"7.00\",\"total\":63},\"3\":{\"product_id\":3,\"quantity\":4,\"price\":\"3.00\",\"total\":12},\"6\":{\"product_id\":6,\"quantity\":10,\"price\":\"2.00\",\"total\":20}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(25,'HB25QZ4M',11,188.00,'Marshall Bernhard','4135 Luigi Skyway Suite 340','42217-7298','Ryanside','Lesotho','NDAyNDAwNzE3MzI3OTg4NQ==','10/24','938','{\"compute\":{\"quantity\":40,\"total\":188},\"7\":{\"product_id\":7,\"quantity\":5,\"price\":\"3.00\",\"total\":15},\"3\":{\"product_id\":3,\"quantity\":10,\"price\":\"3.00\",\"total\":30},\"5\":{\"product_id\":5,\"quantity\":8,\"price\":\"6.00\",\"total\":48},\"4\":{\"product_id\":4,\"quantity\":7,\"price\":\"5.00\",\"total\":35},\"2\":{\"product_id\":2,\"quantity\":10,\"price\":\"6.00\",\"total\":60}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(26,'YN74YJAF',1,114.00,'Asia Kemmer','31904 Rafael Gardens Suite 306','95645','Flatleymouth','Liechtenstein','Mzc5NzI1MDQ4Mzc4MTk5','03/24','697','{\"compute\":{\"quantity\":18,\"total\":114},\"1\":{\"product_id\":1,\"quantity\":8,\"price\":\"7.00\",\"total\":56},\"2\":{\"product_id\":2,\"quantity\":8,\"price\":\"6.00\",\"total\":48},\"4\":{\"product_id\":4,\"quantity\":2,\"price\":\"5.00\",\"total\":10}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(27,'FN758BBB',10,46.00,'Yvette Jakubowski','89593 Misael Light','54758','East Janick','Anguilla','MjIyMTYyODE3MjY1NTY4Nw==','02/24','840','{\"compute\":{\"quantity\":8,\"total\":46},\"2\":{\"product_id\":2,\"quantity\":2,\"price\":\"6.00\",\"total\":12},\"1\":{\"product_id\":1,\"quantity\":4,\"price\":\"7.00\",\"total\":28},\"3\":{\"product_id\":3,\"quantity\":2,\"price\":\"3.00\",\"total\":6}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(28,'BD77W9HH',2,31.00,'Genevieve Spinka','106 Colton Mall','89070','Handbury','Brunei Darussalam','MzUyODAzMzcyNjg5MjIwOQ==','07/25','893','{\"compute\":{\"quantity\":10,\"total\":31},\"7\":{\"product_id\":7,\"quantity\":6,\"price\":\"3.00\",\"total\":18},\"3\":{\"product_id\":3,\"quantity\":2,\"price\":\"3.00\",\"total\":6},\"6\":{\"product_id\":6,\"quantity\":1,\"price\":\"2.00\",\"total\":2},\"4\":{\"product_id\":4,\"quantity\":1,\"price\":\"5.00\",\"total\":5}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(29,'VA191BNC',10,130.00,'Sierra Farrell MD','31825 Jace Circle','40409-5967','Boscoshire','Christmas Island','NjAxMTczMzA0MjI0NjI5OA==','03/25','485','{\"compute\":{\"quantity\":31,\"total\":130},\"4\":{\"product_id\":4,\"quantity\":6,\"price\":\"5.00\",\"total\":30},\"2\":{\"product_id\":2,\"quantity\":10,\"price\":\"6.00\",\"total\":60},\"6\":{\"product_id\":6,\"quantity\":5,\"price\":\"2.00\",\"total\":10},\"7\":{\"product_id\":7,\"quantity\":10,\"price\":\"3.00\",\"total\":30}}','2022-07-20 10:07:28','2022-07-20 10:07:28'),(30,'PQ17XXE4',11,6.00,'Laisha Keeling','233 Pfeffer Forest Suite 949','07802-3468','South Bernie','Iran','NTE5OTcxMDk5NDUxNDU2NA==','02/23','168','{\"compute\":{\"quantity\":2,\"total\":6},\"3\":{\"product_id\":3,\"quantity\":2,\"price\":\"3.00\",\"total\":6}}','2022-07-20 10:07:28','2022-07-20 10:07:28');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_descr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_descr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Apples','Red, healthy, sweet and tasty, just like me.','For instance, suppose it were nine o\'clock in the morning, just time to begin lessons: you\'d only have to whisper a hint to Time, and round goes the clock in a twinkling! Half-past one, time for dinner!\' (\'I only wish it was,\' the March Hare said to Alice, very earnestly. \'I\'ve had nothing yet,\' Alice replied in an offended tone, \'so I can\'t take more.\' \'You mean you can\'t take LESS,\' said the Hatter: \'it\'s very easy to take MORE than nothing.\' \'Nobody asked YOUR opinion,\' said Alice. \'Who\'s making personal remarks now?\' the Hatter asked triumphantly. Alice did not quite know what to say to this: so she helped herself to some tea and bread-and-butter, and then turned to the Dormouse, and repeated her question. \'Why did they live at the bottom of a well?\' \'Take some more tea,\' the March Hare said to itself in a whisper.) \'That would be grand, certainly,\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry for it, you know.\' \'Not at first, perhaps,\' said the Hatter: \'but you.',7.00,'apple.jpg','2022-07-20 10:07:27','2022-07-20 10:07:27'),(2,'Avocados','Holy Moly that Guacamole is killing me softly.','Queen, \'and take this young lady to see the Mock Turtle, and to hear his history. I must go back and see after some executions I have ordered\'; and she walked off, leaving Alice alone with the Gryphon. Alice did not quite like the look of the creature, but on the whole she thought it would be quite as safe to stay with it as to go after that savage Queen: so she waited. The Gryphon sat up and rubbed its eyes: then it watched the Queen till she was out of sight: then it chuckled. \'What fun!\' said the Gryphon, half to itself, half to Alice. \'What IS the fun?\' said Alice. \'Why, SHE,\' said the Gryphon. \'It\'s all her fancy, that: they never executes nobody, you know. Come on!\' \'Everybody says \"come on!\" here,\' thought Alice, as she went slowly after it: \'I never was so ordered about in all my life, never!\' They had not gone far before they saw the Mock Turtle in the distance, sitting sad and lonely on a little ledge of rock, and, as they came nearer, Alice could hear him sighing as if his.',6.00,'avocado.jpg','2022-07-20 10:07:27','2022-07-20 10:07:27'),(3,'Bananas','Take care or you\'ll turn Canabananalist.','The first thing she heard was a general chorus of \'There goes Bill!\' then the Rabbit\'s voice along--\'Catch him, you by the hedge!\' then silence, and then another confusion of voices--\'Hold up his head--Brandy now--Don\'t choke him--How was it, old fellow? What happened to you? Tell us all about it!\' Last came a little feeble, squeaking voice, (\'That\'s Bill,\' thought Alice,) \'Well, I hardly know--No more, thank ye; I\'m better now--but I\'m a deal too flustered to tell you--all I know is, something comes at me like a Jack-in-the-box, and up I goes like a sky-rocket!\' \'So you did, old fellow!\' said the others. \'We must burn the house down!\' said the Rabbit\'s voice; and Alice called out as loud as she could, \'If you do. I\'ll set Dinah at you!\' There was a dead silence instantly, and Alice thought to herself, \'I don\'t see how he can EVEN finish, if he doesn\'t begin.\' But she waited patiently. \'Once,\' said the Mock Turtle at last, with a deep sigh, \'I was a real Turtle.\' These words were.',3.00,'banana.jpg','2022-07-20 10:07:27','2022-07-20 10:07:27'),(4,'Coconuts','The best coconuts you will ever have.','Magpie began wrapping itself up very carefully, remarking, \'I really must be getting home; the night-air doesn\'t suit my throat!\' and a Canary called out in a trembling voice to its children, \'Come away, my dears! It\'s high time you were all in bed!\' On various pretexts they all moved off, and Alice was soon left alone. \'I wish I hadn\'t mentioned Dinah!\' she said to herself in a melancholy tone. \'Nobody seems to like her, down here, and I\'m sure she\'s the best cat in the world! Oh, my dear Dinah! I wonder if I shall ever see you any more!\' And here poor Alice began to cry again, for she felt very lonely and low-spirited. In a little while, however, she again heard a little pattering of feet in the distance, and she hastily dried her eyes to see what was coming. It was the White Rabbit returning, splendidly dressed, with a pair of white kid gloves in one hand and a piece of bread-and-butter in the other. \'I beg pardon, your Majesty,\' he began, \'for bringing these in: but I hadn\'t.',5.00,'coconut.jpg','2022-07-20 10:07:27','2022-07-20 10:07:27'),(5,'Mangos','Because they\'re good for your heart.','Very soon the Rabbit noticed Alice, as she went hunting about, and called out to her in an angry tone, \'Why, Mary Ann, what ARE you doing out here? Run home this moment, and fetch me a pair of gloves and a fan! Quick, now!\' And Alice was so much frightened that she ran off at once in the direction it pointed to, without trying to explain the mistake it had made. \'He took me for his housemaid,\' she said to herself as she ran. \'How surprised he\'ll be when he finds out who I am! But I\'d better take him his fan and gloves--that is, if I can find them.\' As she said this, she looked up, and there was the Cat again, sitting on a branch of a tree. \'Did you say pig, or fig?\' said the Cat. \'I said pig,\' replied Alice; \'and I wish you wouldn\'t keep appearing and vanishing so suddenly: you make one quite giddy.\' \'All right,\' said the Cat; and this time it vanished quite slowly, beginning with the end of the tail, and ending with the grin, which remained some time after the rest of it had gone.',6.00,'mango.jpg','2022-07-20 10:07:27','2022-07-20 10:07:27'),(6,'Onions','**Don\'t get emotionally attached.**','Cat. \'I\'d nearly forgotten to ask.\' \'It turned into a pig,\' Alice quietly said, just as if it had come back in a natural way. \'I thought it would,\' said the Cat, and vanished again. Alice waited a little, half expecting to see it again, but it did not appear, and after a minute or two she walked on in the direction in which the March Hare was said to live. \'I\'ve seen hatters before,\' she said to herself; \'the March Hare will be much the most interesting, and perhaps as this is May it won\'t be raving mad--at least not so mad as it was in March.\' As she said this, she came suddenly upon an open place, with a little house in it about four feet high. \'Whoever lives there,\' thought Alice, \'it\'ll never do to come upon them THIS size: why, I should frighten them out of their wits!\' So she began nibbling at the righthand bit again, and did not venture to go near the house till she had brought herself down to nine inches high. CHAPTER VI. Pig and Pepper For a minute or two she walked on in.',2.00,'onion.jpg','2022-07-20 10:07:27','2022-07-20 10:07:27'),(7,'Tomatos','If it was long, skinny, and green, it would be a bean.','Alice, and tried to speak, but for a minute or two sobs choked his voice. \'Same as if he had a bone in his throat,\' said the Gryphon: and it set to work shaking him and punching him in the back. At last the Mock Turtle recovered his voice, and, with tears running down his cheeks, he went on again:-- \'You may not have lived much under the sea--\' (\'I haven\'t,\' said Alice)--\'and perhaps you were never even introduced to a lobster--\' (Alice began to say \'I once tasted--\' but checked herself hastily, and said \'No, never\') \'--so you can have no idea what a delightful thing a Lobster Quadrille is!\' \'No, indeed,\' said Alice. \'What sort of a dance is it?\' \'Why,\' said the Gryphon, \'you first form into a line along the sea-shore--\' \'Two lines!\' cried the Mock Turtle. \'Seals, turtles, salmon, and so on; then, when you\'ve cleared all the jelly-fish out of the way--\' \'THAT generally takes some time,\' interrupted the Gryphon. \'--you advance twice--\' \'Each with a lobster as a partner!\' cried the.',3.00,'tomato.jpg','2022-07-20 10:07:27','2022-07-20 10:07:27');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Prof. Rylee Davis','jarret79@example.net','2022-07-20 10:07:27','$2a$12$mfvdrotDA5iv9XWGW5.2BOaguJlFqiwDxG3frwKHxdHopIz4l1Qfe','lGzaQg5bO5Qqlv0QzUMbRCMJRUgsfuPm4y607TxtdgQsyy0EyXJxMzgmZyJg',NULL,'yApJjgk3LF','2022-07-20 10:07:27','2022-07-20 10:07:27'),(2,'gwen','Mrs. Katelin Schmidt V','ebert.kyla@example.org','2022-07-20 10:07:27','$2a$12$mfvdrotDA5iv9XWGW5.2BOaguJlFqiwDxG3frwKHxdHopIz4l1Qfe','9KceFvN0KjmXt85o7fpnUsRjBsaBdohvVfLnwoZTgKcsleKFlFQMQ0I5a22Q',NULL,'A1nrOCuRS1guPtAckrFX8T7CVnwyj9UOpneZRMUPDtrtbW5y1GYmDw1uGUgn','2022-07-20 10:07:27','2022-07-20 10:07:27'),(3,'stephanie11','Felipa Stamm','bernhard.king@example.org','2022-07-20 10:07:27','$2a$12$mfvdrotDA5iv9XWGW5.2BOaguJlFqiwDxG3frwKHxdHopIz4l1Qfe','J7DCUzW86j0y82ygGzCJJbzndie1F3GF64RoqORpWxVQLALpxwqC3qS4MFR0',NULL,'gQRjh2MAHA','2022-07-20 10:07:27','2022-07-20 10:07:27'),(4,'thalia.bechtelar','Katelin O\'Keefe','miles.greenholt@example.org','2022-07-20 10:07:27','$2a$12$mfvdrotDA5iv9XWGW5.2BOaguJlFqiwDxG3frwKHxdHopIz4l1Qfe','WZQYIdtzFQePnFXJXfpm0YMzc2B1i3hSN6watb6Pmum2vO316DlPV9rKYjoD',NULL,'wTVjDmarD2','2022-07-20 10:07:27','2022-07-20 10:07:27'),(5,'kferry','Miss Adeline Daugherty','walker84@example.com','2022-07-20 10:07:27','$2a$12$mfvdrotDA5iv9XWGW5.2BOaguJlFqiwDxG3frwKHxdHopIz4l1Qfe','AYa1xu6O7RuBXrsP3aFyWrERqU1fioPiZ66bYNZ30E8RMjew0MjjooXokU3r',NULL,'0m91tNwcNt','2022-07-20 10:07:27','2022-07-20 10:07:27'),(9,'tom','tom','tom@tom.com','2022-07-20 15:04:17','$2y$10$SNu7or8XIpkbcJ/aJRQ83ezbBrhnfvkcAkvkvHXHdUuAH6GBnlM1y','lGzaQg5bO5Qqlv0QzUMbRCMJRUgsfuRm4y607QxtdgLsyy0EyXJxMugmZyJh',NULL,NULL,'2022-07-20 15:04:17','2022-07-20 15:04:17'),(10,'eric','eric','eric@eric.com','2022-07-20 15:04:21','$2y$10$A3D3Zkqbt/eN9M/7nRDnPOFGbZ.ToxNfZbiX3i6Ht6FFAs2VAdpX6','lGzaQg5bO5Qqlv0QzUMbRCMJRUgsfuRm4y607QxtdgLsyh0FyXJxNugmZyJh',NULL,NULL,'2022-07-20 15:04:21','2022-07-20 15:04:21'),(11,'florent','florent','florent@florent.com','2022-07-20 15:04:21','$2y$10$pOn.1YJWyObPFUtgx1CqPOnpomk/E2Qm1hlmKG/lITgrU4gZIFmEe','lGzaQg5bO5Qqlv0QzUMbRCMJRUgsfuRm4y607QxtdgLsyy0EyXJxMugmWyJg',NULL,NULL,'2022-07-20 15:04:21','2022-07-20 15:04:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-22  8:41:02
