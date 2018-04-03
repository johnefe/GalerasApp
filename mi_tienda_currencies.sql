-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: mi_tienda
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

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
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `precision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'US Dollar','$','2',',','.','USD'),(2,'Libra Esterlina','&pound;','2',',','.','GBP'),(3,'Euro','Ã¢â€šÂ¬','2','.',',','EUR'),(4,'South African Rand','R','2','.',',','ZAR'),(5,'Danish Krone','kr ','2','.',',','DKK'),(6,'Israeli Shekel','NIS ','2',',','.','ILS'),(7,'Swedish Krona','kr ','2','.',',','SEK'),(8,'Kenyan Shilling','KSh ','2',',','.','KES'),(9,'Canadian Dollar','C$','2',',','.','CAD'),(10,'Philippine Peso','P ','2',',','.','PHP'),(11,'Indian Rupee','Rs. ','2',',','.','INR'),(12,'Australian Dollar','$','2',',','.','AUD'),(13,'Singapore Dollar','SGD ','2',',','.','SGD'),(14,'Norske Kroner','kr ','2','.',',','NOK'),(15,'New Zealand Dollar','$','2',',','.','NZD'),(16,'Vietnamese Dong','VND ','0','.',',','VND'),(17,'Swiss Franc','CHF ','2','\'','.','CHF'),(18,'Quetzal Guatemalteco','Q','2',',','.','GTQ'),(19,'Malaysian Ringgit','RM','2',',','.','MYR'),(20,'Real Brasile&ntilde;o','R$','2','.',',','BRL'),(21,'Thai Baht','THB ','2',',','.','THB'),(22,'Nigerian Naira','NGN ','2',',','.','NGN'),(23,'Peso Argentino','$','2','.',',','ARS'),(24,'Bangladeshi Taka','Tk','2',',','.','BDT'),(25,'United Arab Emirates Dirham','DH ','2',',','.','AED'),(26,'Hong Kong Dollar','$','2',',','.','HKD'),(27,'Indonesian Rupiah','Rp','2',',','.','IDR'),(28,'Peso Mexicano','$','2',',','.','MXN'),(29,'Egyptian Pound','&pound;','2',',','.','EGP'),(30,'Peso Colombiano','$','2','.',',','COP'),(31,'West African Franc','CFA ','2',',','.','XOF'),(32,'Chinese Renminbi','RMB ','2',',','.','CNY');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-03 17:38:24
