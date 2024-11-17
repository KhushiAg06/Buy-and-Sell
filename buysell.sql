-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: buysell
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  CONSTRAINT `chk_email` CHECK (((`email` is not null) and (`email` <> _utf8mb4'')))
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Khushi','Agarwal','2002-10-06','khushi.agarwal@iitg.ac.in','6398529297'),(3,'Prathemesh','Patil','2003-02-12','patil@iitg.ac.in','9856472844'),(5,'Khushi','Ag','2024-11-06','khushi.ag@iitg.ac.in','6398529297'),(8,'Khushi','A','2024-11-06','khushi.a@iitg.ac.in','6398529297'),(9,'abc','XYZ','2024-11-15','abcxyz@iig.ac.in','7857235543'),(10,'pratham','P','2022-09-15','pratham@iitg.ac.in','5675586899'),(12,'Shivika','Shivika','2024-01-25','shivika@iitg.ac.in','5658688987');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_user_insert` BEFORE INSERT ON `User` FOR EACH ROW BEGIN
    IF NEW.dob > CURDATE() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Date of birth cannot be in the future';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_user_update` BEFORE UPDATE ON `User` FOR EACH ROW BEGIN
    IF NEW.dob > CURDATE() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Date of birth cannot be in the future';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `electronics`
--

DROP TABLE IF EXISTS `electronics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `electronics` (
  `Product_Id` int NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(100) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Purchase_Date` date NOT NULL,
  `Price` float NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `buyer_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Product_Id`),
  KEY `email` (`email`),
  KEY `fk_buyer_email_electronics` (`buyer_email`),
  CONSTRAINT `electronics_ibfk_1` FOREIGN KEY (`email`) REFERENCES `User` (`email`),
  CONSTRAINT `fk_buyer_email_electronics` FOREIGN KEY (`buyer_email`) REFERENCES `login` (`email`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `electronics`
--

LOCK TABLES `electronics` WRITE;
/*!40000 ALTER TABLE `electronics` DISABLE KEYS */;
INSERT INTO `electronics` VALUES (1,'Kettle','Prestige','PKOSS1.5','khushi.agarwal@iitg.ac.in','Electric','2024-06-20',1500,'Kettle','Yes','pratham@iitg.ac.in');
/*!40000 ALTER TABLE `electronics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `furniture`
--

DROP TABLE IF EXISTS `furniture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `furniture` (
  `Product_Id` int NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(100) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Purchase_Date` date NOT NULL,
  `Price` float NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `buyer_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Product_Id`),
  KEY `email` (`email`),
  KEY `fk_buyer_email_furniture` (`buyer_email`),
  CONSTRAINT `fk_buyer_email_furniture` FOREIGN KEY (`buyer_email`) REFERENCES `login` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `furniture_ibfk_1` FOREIGN KEY (`email`) REFERENCES `User` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `furniture`
--

LOCK TABLES `furniture` WRITE;
/*!40000 ALTER TABLE `furniture` DISABLE KEYS */;
INSERT INTO `furniture` VALUES (1,'Chair','furniture','Nilkamal','pratham@iitg.ac.in','plastic chair','2024-03-06',600,'chair.jpeg',NULL,NULL),(2,'lamp','xyz','ikea','pratham@iitg.ac.in','tyftyf','2024-11-09',900,'lamp.jpeg','Yes','shivika@iitg.ac.in');
/*!40000 ALTER TABLE `furniture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `email` varchar(255) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `Forgot_text` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`email`) REFERENCES `User` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('abcxyz@iig.ac.in','$2y$10$2vsN4Bz0b28./34bCSITsOUxBD2ZVMQQ1lREBMr4YT1kYqIaHuyvy','gfger'),('khushi.a@iitg.ac.in','$2y$10$7SJXspE/E1wFKA0mnEJKHePfE9OKagNe0esgCkhr57w1RezUGPw4q','Khushi'),('khushi.agarwal@iitg.ac.in','Khushi@123','Leo'),('patil@iitg.ac.in','Patil@123','Nia'),('pratham@iitg.ac.in','Pratham@123','hi'),('shivika@iitg.ac.in','Shivika@123','shivu');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `others`
--

DROP TABLE IF EXISTS `others`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `others` (
  `Product_Id` int NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Purchase_Date` date NOT NULL,
  `Price` float NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `buyer_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Product_Id`),
  KEY `email` (`email`),
  KEY `fk_buyer_email_others` (`buyer_email`),
  CONSTRAINT `fk_buyer_email_others` FOREIGN KEY (`buyer_email`) REFERENCES `login` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `others_ibfk_1` FOREIGN KEY (`email`) REFERENCES `User` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `others`
--

LOCK TABLES `others` WRITE;
/*!40000 ALTER TABLE `others` DISABLE KEYS */;
/*!40000 ALTER TABLE `others` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stationary`
--

DROP TABLE IF EXISTS `stationary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stationary` (
  `Product_Id` int NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Purchase_Date` date NOT NULL,
  `Price` float NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `buyer_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Product_Id`),
  KEY `email` (`email`),
  KEY `fk_buyer_email_stationary` (`buyer_email`),
  CONSTRAINT `fk_buyer_email_stationary` FOREIGN KEY (`buyer_email`) REFERENCES `login` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `stationary_ibfk_1` FOREIGN KEY (`email`) REFERENCES `User` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stationary`
--

LOCK TABLES `stationary` WRITE;
/*!40000 ALTER TABLE `stationary` DISABLE KEYS */;
INSERT INTO `stationary` VALUES (2,'Book','khushi.agarwal@iitg.ac.in','Analysis','2023-06-23',1000,'book.jpeg','Yes','pratham@iitg.ac.in');
/*!40000 ALTER TABLE `stationary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle` (
  `Product_Id` int NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(100) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Pass_Number` varchar(10) NOT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Purchase_Date` date NOT NULL,
  `Price` float NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `buyer_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Product_Id`),
  KEY `email` (`email`),
  KEY `fk_buyer_email_vehicle` (`buyer_email`),
  CONSTRAINT `fk_buyer_email_vehicle` FOREIGN KEY (`buyer_email`) REFERENCES `login` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`email`) REFERENCES `User` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` VALUES (1,'Car','Hyundai','secondHand','Creta','shivika@iitg.ac.in','345354','white','2021-06-05',200000,'creta.jpeg',NULL,NULL);
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-05 18:05:26
