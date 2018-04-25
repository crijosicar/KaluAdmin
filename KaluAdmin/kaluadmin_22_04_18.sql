-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: admin_kalu
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
-- Table structure for table `conversaciones`
--

DROP TABLE IF EXISTS `conversaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mensaje` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_bot` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversaciones`
--

LOCK TABLES `conversaciones` WRITE;
/*!40000 ALTER TABLE `conversaciones` DISABLE KEYS */;
INSERT INTO `conversaciones` VALUES (1,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(2,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(3,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(4,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(5,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(6,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(7,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(8,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(9,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(10,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(11,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(12,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(13,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(14,1,'fsfsdsdfds','0000-00-00',NULL,NULL,NULL,0),(15,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:00:23','2018-04-02 02:00:23',0),(16,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:03:14','2018-04-02 02:03:14',0),(17,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:03:15','2018-04-02 02:03:15',0),(18,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:03:15','2018-04-02 02:03:15',0),(19,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:03:16','2018-04-02 02:03:16',0),(20,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:07','2018-04-02 02:04:07',0),(21,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:08','2018-04-02 02:04:08',0),(22,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:08','2018-04-02 02:04:08',0),(23,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:08','2018-04-02 02:04:08',0),(24,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:09','2018-04-02 02:04:09',0),(25,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:09','2018-04-02 02:04:09',0),(26,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:28','2018-04-02 02:04:28',0),(27,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:04:55','2018-04-02 02:04:55',0),(28,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:05:03','2018-04-02 02:05:03',0),(29,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:05:04','2018-04-02 02:05:04',0),(30,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:05:04','2018-04-02 02:05:04',0),(31,1,'fsfsdsdfds','0000-00-00',NULL,'2018-04-02 02:05:05','2018-04-02 02:05:05',0),(32,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:05:21','2018-04-02 02:05:21',0),(33,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:05:41','2018-04-02 02:05:41',0),(34,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:05:42','2018-04-02 02:05:42',0),(35,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:05:43','2018-04-02 02:05:43',0),(36,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:05:44','2018-04-02 02:05:44',0),(37,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:05:45','2018-04-02 02:05:45',0),(38,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:06:28','2018-04-02 02:06:28',1),(39,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:06:30','2018-04-02 02:06:30',1),(40,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:06:31','2018-04-02 02:06:31',1),(41,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:06:32','2018-04-02 02:06:32',1),(42,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:06:44','2018-04-02 02:06:44',0),(43,1,'is from bot','0000-00-00',NULL,'2018-04-02 02:06:48','2018-04-02 02:06:48',1),(44,1,'','0000-00-00',NULL,'2018-04-02 02:17:44','2018-04-02 02:17:44',0),(45,1,'','0000-00-00',NULL,'2018-04-02 02:18:00','2018-04-02 02:18:00',0);
/*!40000 ALTER TABLE `conversaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_movimiento`
--

DROP TABLE IF EXISTS `detalle_movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_movimiento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria_activo_id` int(11) NOT NULL,
  `movimiento_id` int(11) NOT NULL,
  `nombre_activo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monto` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_movimiento`
--

LOCK TABLES `detalle_movimiento` WRITE;
/*!40000 ALTER TABLE `detalle_movimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_valor`
--

DROP TABLE IF EXISTS `lista_valor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lista_valor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_valor`
--

LOCK TABLES `lista_valor` WRITE;
/*!40000 ALTER TABLE `lista_valor` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista_valor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2018_01_30_175828_add_fields_users_table',1),('2018_02_11_205419_add_field_facebookId_usersTable',1),('2018_02_11_215642_add_MovimientosTabla',1),('2018_02_11_220054_add_ListaValorTabla',1),('2018_02_11_221449_add_Constraints_ListaValorTabla_y_TablaMovimientos',1),('2018_02_11_222427_add_DetalleMovimientoTabla',1),('2018_03_25_225641_create_users_movements_table',2),('2018_04_01_161504_create_conversations_table',3),('2018_04_01_205442_add_is_bot_field_to_conversations_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_movimiento_id` int(10) unsigned NOT NULL,
  `tipo_transaccion_id` int(10) unsigned NOT NULL,
  `monto` bigint(20) NOT NULL,
  `detalle_movimiento_id` int(11) NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movimientos_tipo_movimiento_id_foreign` (`tipo_movimiento_id`),
  KEY `movimientos_tipo_transaccion_id_foreign` (`tipo_transaccion_id`),
  CONSTRAINT `movimientos_tipo_movimiento_id_foreign` FOREIGN KEY (`tipo_movimiento_id`) REFERENCES `lista_valor` (`id`),
  CONSTRAINT `movimientos_tipo_transaccion_id_foreign` FOREIGN KEY (`tipo_transaccion_id`) REFERENCES `lista_valor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_movimientos`
--

DROP TABLE IF EXISTS `user_movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_movimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `movimiento_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_movimientos`
--

LOCK TABLES `user_movimientos` WRITE;
/*!40000 ALTER TABLE `user_movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_day` date DEFAULT NULL,
  `range_income` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_profile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Dev user','dev@dev.com','$2y$10$ULDUDD3MgaPCjiZcVluYLOwh8HIJbxl/wMTZQv0QaxbLwlAt15VK6',NULL,'2018-04-01 22:56:08','2018-04-01 22:56:08',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Dev user','dev2@dev.com','$2y$10$nn/fNSr4csdiON222Db.zO8amvJD9OUqyQw/tSbGpN2nWfIDXN/Bu',NULL,'2018-04-01 23:16:46','2018-04-01 23:16:46',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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

-- Dump completed on 2018-04-22 16:37:25
