-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: localhost    Database: vendingDB
-- ------------------------------------------------------
-- Server version	8.0.40-0ubuntu0.24.04.1

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250115105830','2025-01-17 08:07:20',9);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `machine`
--

DROP TABLE IF EXISTS `machine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `machine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machine`
--

LOCK TABLES `machine` WRITE;
/*!40000 ALTER TABLE `machine` DISABLE KEYS */;
INSERT INTO `machine` VALUES (1,'Kossmouth','nobis 393','Fuera de servicio'),(2,'South Jadeside','suscipit 83','Disponible'),(3,'New Tessieshire','minima 639','Disponible'),(4,'Lake Lauryn','officiis 795','En mantenimiento'),(5,'Port Lucile','nisi 390','Fuera de servicio'),(6,'Hellertown','sit 81','Disponible'),(7,'Lake Larrystad','sunt 702','En mantenimiento'),(8,'Jaidahaven','labore 439','Disponible'),(9,'East Alivia','atque 609','Fuera de servicio'),(10,'Treutelton','consequatur 319','Disponible'),(11,'Getafe','API-01','Disponible');
/*!40000 ALTER TABLE `machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Chocolate con Leche',1.88,NULL),(2,'Pepsi',1.78,NULL),(3,'Monster',4.38,NULL),(4,'Agua con Gas',3.05,NULL),(5,'Pañuelos de Papel',1.15,NULL),(6,'Palomitas de Maíz',2.05,NULL),(7,'Fruta Deshidratada',2.42,NULL),(8,'Crackers',0.94,NULL),(9,'Galletas de Mantequilla',1.48,NULL),(10,'Almendras',1.96,NULL),(11,'Té Frío Limón',2.59,NULL),(12,'Mix de Frutos Secos',4.36,NULL),(14,'Donuts',4.63,NULL),(15,'Gel Hidroalcohólico',4.54,NULL),(16,'Auriculares',3.31,NULL),(17,'Chicles de Menta',0.82,NULL),(18,'Café con Leche',2.78,NULL),(19,'Coca-Cola',4.81,NULL),(20,'Patatas Fritas Clásicas',3.53,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `machine_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B365660F6B75B26` (`machine_id`),
  KEY `IDX_4B3656604584665A` (`product_id`),
  CONSTRAINT `FK_4B3656604584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_4B365660F6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (1,7,17,17),(2,7,5,35),(3,4,20,49),(4,4,15,36),(5,8,7,7),(6,6,3,19),(7,1,6,6),(8,1,15,95),(9,1,15,29),(10,4,19,19),(11,3,5,61),(13,3,10,82),(14,6,6,47),(15,2,11,44),(16,6,5,4),(17,5,19,16),(18,9,3,60),(19,3,11,6),(20,7,1,80),(21,8,10,3),(22,8,12,78),(24,8,19,40),(25,7,2,32),(26,5,20,75),(27,5,2,77),(28,5,3,24),(29,5,19,30),(30,7,6,80),(32,9,15,11),(33,7,12,12),(34,2,17,60),(35,9,17,69),(36,1,16,94),(37,7,4,16),(38,1,19,34),(39,6,5,35),(40,4,2,96),(41,5,9,63),(43,1,14,45),(44,4,2,97),(45,6,14,99),(46,5,10,28),(47,2,15,63),(48,4,2,55),(49,1,11,12),(50,1,11,33);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin@example.com','[\"ROLE_ADMIN\"]','$2y$13$yu9jB2CH.AiFmcZEf3MjIuvYkxEe8G88fxwvlxbJ4Mqn/zSostxiC'),(2,'pagac.emanuel@balistreri.info','[\"ROLE_USER\"]','$2y$13$iwOiWCcmdTTuqlt3FbXL5O8qwL9RCZyOIPaQTbrGks3sdsX1y.VFO'),(3,'zoey.kilback@mann.biz','[\"ROLE_USER\"]','$2y$13$69tTEe4ICsZUQeZpim/jZu0vSpSxX.nzm9Jr5xiD9HrW/iGQbR2R6'),(4,'chet05@yahoo.com','[\"ROLE_USER\"]','$2y$13$z/jyAQyl3D09W.e8bFQIqO3dMRFkU7qKhFOFC65kjIcFhUW2HLj.y'),(5,'wilfred.durgan@ward.info','[\"ROLE_USER\"]','$2y$13$OUp44pAB.fsvO/DIhIyJbONountJaiFaNgjnEmFrL.osB5SlH/8qa'),(6,'kiel.lubowitz@collier.com','[\"ROLE_USER\"]','$2y$13$ZwmBidhwGmvFEU8IQProY.tQ0eUNd9ooq5vXWc9K.Qbdkk.eQ6O52'),(7,'antonio22@hotmail.com','[\"ROLE_USER\"]','$2y$13$GpG3pyK2GnbLGGvM0ODB3O/sNgAdTHWBtx.xZpHoBSc/jkG.ckulq'),(8,'walsh.aurelia@jacobson.com','[\"ROLE_USER\"]','$2y$13$m4RV/06NuQVaUtJAtvv8NeYLCjb99p9sfSCnlQtb4kE8yF1Ash67.'),(9,'khahn@mosciski.com','[\"ROLE_USER\"]','$2y$13$DDImkXHZ3vXoRgLYB/GPre9udnwFcNKwLhmiduFRYv/BOudm/fIgG'),(10,'crystal.flatley@connelly.info','[\"ROLE_USER\"]','$2y$13$Sc9pfakTtgCU4epNbPi2r.77SpZv/1dhu44zr3xP2rkCrcgJUI1/y'),(11,'hand.marcelino@herman.biz','[\"ROLE_USER\"]','$2y$13$1KDBfqAu5jpYtX4LCViUH.lnjWmFo.J5446f5kaMqeP6fq0ZQwNkO'),(12,'eee@ooo.com','[\"ROLE_USER\"]','$2y$13$ahFcMS02m6h4QlTqyYGX3ec6AGKDAho8ni63z6.Qz/S82QL7QDyUe');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-22 10:56:16
