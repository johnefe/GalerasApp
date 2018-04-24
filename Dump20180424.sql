CREATE DATABASE  IF NOT EXISTS `mi_tienda` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mi_tienda`;
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
-- Table structure for table `activos`
--

DROP TABLE IF EXISTS `activos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activos` (
  `id_activo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `valor` double DEFAULT NULL,
  PRIMARY KEY (`id_activo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activos`
--

LOCK TABLES `activos` WRITE;
/*!40000 ALTER TABLE `activos` DISABLE KEYS */;
INSERT INTO `activos` VALUES (3,'vitrina','2018-04-19 23:31:27',120000),(4,'nevera 20 lb','2018-04-19 23:31:46',345000);
/*!40000 ALTER TABLE `activos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono_cliente` char(30) NOT NULL,
  `email_cliente` varchar(64) NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL,
  `status_cliente` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `codigo_producto` (`nombre_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Juan carlos pantoja','3828282','juan@gmail.com','las cuadras',1,'2018-03-14 22:59:06'),(2,'luis fernando','7228316','luis@hotmail.com','panoramico',1,'2018-03-15 13:25:21'),(3,'juan jose cordoba','3434343434','sdsd@sdsd.com','sdsdsdsd',1,'2018-03-16 21:51:09'),(4,'Anonimo','00000000','0000@0000.com','sin direccion',1,'2018-03-20 21:37:07');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `numero_compra` int(11) DEFAULT NULL,
  `fecha_compra` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `condiciones` varchar(100) NOT NULL,
  `total_compra` varchar(100) NOT NULL,
  `estado_compra` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `id_proveedor_idx` (`id_proveedor`),
  KEY `proveedor_compras_idx` (`id_proveedor`),
  KEY `compras_vendedor_idx` (`id_vendedor`),
  CONSTRAINT `compras_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `compras_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,1,'2018-03-02 14:16:35',1,1,'1','7400.00',1),(2,2,'2018-04-05 00:22:24',1,1,'1','450000',1);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `detalle_compra`
--

DROP TABLE IF EXISTS `detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_compra` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `numero_compra` int(11) DEFAULT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` double NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `detalle_compra_producto_idx` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_compra`
--

LOCK TABLES `detalle_compra` WRITE;
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
INSERT INTO `detalle_compra` VALUES (1,1,6,1,2500),(2,1,7,1,2500),(3,1,8,1,2400),(4,2,10,30,15000);
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `precio_compra` double NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `numero_cotizacion` (`numero_factura`,`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_factura`
--

LOCK TABLES `detalle_factura` WRITE;
/*!40000 ALTER TABLE `detalle_factura` DISABLE KEYS */;
INSERT INTO `detalle_factura` VALUES (195,1,6,1,2800,2500),(196,1,7,2,2800,2500),(197,1,9,1,2700,2400),(198,2,6,1,2800,2500),(199,2,7,1,2800,2500),(200,3,6,2,2800,2500),(201,3,7,1,2800,2500),(202,3,9,1,2700,2400),(203,4,6,1,2800,2500),(204,4,7,1,2800,2500),(205,1,7,2,2800,2500),(206,1,8,2,2700,2400),(207,2,8,2,2700,2400),(208,2,9,1,2700,2400),(209,2,10,1,16800,15000),(210,3,6,1,2800,2500),(211,3,7,1,2800,2500),(212,3,10,1,16800,15000),(213,4,6,1,2800,2500),(214,4,7,1,2800,2500),(215,4,8,1,2700,2400),(216,5,6,1,2800,2500),(217,5,7,1,2800,2500),(218,5,8,1,2700,2400),(219,6,6,1,2800,2500),(220,6,7,1,2800,2500),(221,6,8,1,2700,2400),(222,7,7,1,2800,2500),(223,7,9,1,2700,2400),(224,7,10,1,16800,15000),(225,7,6,7,2800,2500),(226,8,6,3,2800,2500),(227,8,7,1,2800,2500),(228,8,8,4,2700,2400),(229,8,9,4,2700,2400),(230,8,10,6,16800,15000),(231,9,6,6,2800,2500),(232,10,6,4,2800,2500),(233,11,6,1,2800,2500),(234,11,7,1,2800,2500),(235,12,6,3,2800,2500);
/*!40000 ALTER TABLE `detalle_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) NOT NULL,
  `fecha_factura` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `condiciones` varchar(30) NOT NULL,
  `total_venta` varchar(20) NOT NULL,
  `estado_factura` tinyint(1) NOT NULL,
  `total_compra` varchar(20) NOT NULL,
  PRIMARY KEY (`id_factura`),
  UNIQUE KEY `numero_cotizacion` (`numero_factura`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COMMENT='ere';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (83,2,'2018-03-28',3,1,'1','24900',1,'22200'),(82,1,'2018-03-27',3,1,'1','11000',1,'9800'),(84,3,'2018-03-28',4,1,'1','22400',1,'20000'),(85,4,'2018-03-02',4,1,'1','8300',1,'7400'),(86,5,'2018-04-03',4,1,'1','8300',1,'7400'),(87,6,'2018-04-03',1,1,'1','8300',1,'7400'),(88,7,'2018-04-19',1,1,'1','41900',1,'37400'),(89,8,'2018-04-20',1,1,'1','133600',1,'119200'),(90,9,'2018-04-22',1,2,'1','16800',1,'15000'),(91,10,'2018-04-23',1,1,'1','11200',1,'10000'),(92,11,'2018-04-24',2,1,'1','5600',1,'5000'),(93,12,'2018-04-24',2,2,'1','8400',1,'7500');
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos` (
  `id_gastos` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL,
  `valor_gasto` double DEFAULT NULL,
  PRIMARY KEY (`id_gastos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
INSERT INTO `gastos` VALUES (5,'lavado vitrinas','2018-04-19 18:38:37',12000),(6,'pintura local','2018-04-19 18:38:20',16000),(7,'vitrina','2018-04-24 00:43:24',34000);
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `moneda` varchar(6) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'TIENDA SAN JUAN ','Barrio San Juan de Dios','Pasto','520001','NariÃ±o','7228315','tiendasanjuandeDios@gmail.com','$','img/1522079848_maxresdefault.jpg');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `status_producto` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio_compra` double NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo_producto` (`codigo_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (6,'004','leche alpina deslactosada Maxilitro',1,'2018-03-20 23:38:31',2500,56,2800),(7,'005','leche deslactosada descremada maxilitro',1,'2018-03-20 23:40:16',2500,17,2800),(8,'003','Leche descremada Alpina Maxilitro',1,'2018-03-20 23:41:01',2400,16,2700),(9,'006','Leche Semidescremada 1.1',1,'2018-03-23 15:25:24',2400,11,2700),(10,'007','Six Pack Leche Desclactosada',1,'2018-03-23 15:47:50',15000,5,16800);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(100) NOT NULL,
  `telefono_proveedor` varchar(100) DEFAULT NULL,
  `email_proveedor` varchar(100) DEFAULT NULL,
  `direccion_proveedor` varchar(100) DEFAULT NULL,
  `status_proveedor` tinyint(4) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `nombre_proveedor_UNIQUE` (`nombre_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Lacteos Alpinita','3186411382','mariof_santacruz@hotmail.com','pandiaco',1,'2018-03-15 16:29:45'),(2,'puyo s.a','343434','mariof_santacruz@hotmail.com','centro',1,'2018-03-15 16:30:03'),(3,'bimbo','454545','sr_jhonf@hotmail.com','fdf rfdfdfdf',1,'2018-03-15 21:05:19'),(4,'sdsd','343434','sr_jhonf@hotmail.com','sdsd',1,'2018-03-16 20:28:39'),(5,'Colacteos','3215700083','colacteos@gmail.com','av panamericana',1,'2018-03-23 20:46:03');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp`
--

DROP TABLE IF EXISTS `tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precio_compra_tmp` double(8,2) NOT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=MyISAM AUTO_INCREMENT=291 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp`
--

LOCK TABLES `tmp` WRITE;
/*!40000 ALTER TABLE `tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_compras`
--

DROP TABLE IF EXISTS `tmp_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_compras` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cant_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_compras`
--

LOCK TABLES `tmp_compras` WRITE;
/*!40000 ALTER TABLE `tmp_compras` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jhon Frey','Diaz','admin','$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO','admin@admin.com','2016-05-21 15:06:00'),(2,'ana','diaz','primeruser','$2y$10$lJJdtLMlhBBzHE7nTXbaRe/5myKuK.mK9iccLTILqYPzp5Dm7KgMW','ana@hotmail.com','2018-03-26 18:38:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'mi_tienda'
--

--
-- Dumping routines for database 'mi_tienda'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-24 14:44:23
