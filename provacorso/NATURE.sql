-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: NATURE
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ADESIONE`
--

DROP TABLE IF EXISTS `ADESIONE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ADESIONE` (
  `id` tinyint NOT NULL,
  `nomeUtente` varchar(64) NOT NULL,
  `importoDonazione` float DEFAULT NULL,
  `noteDonazione` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`,`nomeUtente`),
  KEY `nomeUtente` (`nomeUtente`),
  CONSTRAINT `adesione_ibfk_1` FOREIGN KEY (`id`) REFERENCES `RACCOLTAFONDI` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `adesione_ibfk_2` FOREIGN KEY (`nomeUtente`) REFERENCES `UTENTE` (`nomeUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADESIONE`
--

LOCK TABLES `ADESIONE` WRITE;
/*!40000 ALTER TABLE `ADESIONE` DISABLE KEYS */;
/*!40000 ALTER TABLE `ADESIONE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ESCURSIONE`
--

DROP TABLE IF EXISTS `ESCURSIONE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ESCURSIONE` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `titolo` varchar(32) DEFAULT NULL,
  `dataEscursione` date DEFAULT NULL,
  `oraPartenza` time DEFAULT NULL,
  `oraRitorno` time DEFAULT NULL,
  `descrizione` varchar(500) DEFAULT NULL,
  `maxPartecipanti` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ESCURSIONE`
--

LOCK TABLES `ESCURSIONE` WRITE;
/*!40000 ALTER TABLE `ESCURSIONE` DISABLE KEYS */;
/*!40000 ALTER TABLE `ESCURSIONE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GESTIONEH`
--

DROP TABLE IF EXISTS `GESTIONEH`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `GESTIONEH` (
  `id` tinyint NOT NULL,
  `nomeUtente` varchar(64) NOT NULL,
  `tipoOperazione` varchar(16) NOT NULL,
  PRIMARY KEY (`id`,`nomeUtente`),
  KEY `nomeUtente` (`nomeUtente`),
  CONSTRAINT `gestioneh_ibfk_1` FOREIGN KEY (`id`) REFERENCES `HABITAT` (`id`),
  CONSTRAINT `gestioneh_ibfk_2` FOREIGN KEY (`nomeUtente`) REFERENCES `UTENTE` (`nomeUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GESTIONEH`
--

LOCK TABLES `GESTIONEH` WRITE;
/*!40000 ALTER TABLE `GESTIONEH` DISABLE KEYS */;
/*!40000 ALTER TABLE `GESTIONEH` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GESTIONES`
--

DROP TABLE IF EXISTS `GESTIONES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `GESTIONES` (
  `nomeLatino` varchar(64) NOT NULL,
  `nomeUtente` varchar(64) NOT NULL,
  `tipoOperazione` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`nomeLatino`,`nomeUtente`),
  KEY `nomeUtente` (`nomeUtente`),
  CONSTRAINT `gestiones_ibfk_1` FOREIGN KEY (`nomeLatino`) REFERENCES `SPECIE` (`nomeLatino`),
  CONSTRAINT `gestiones_ibfk_2` FOREIGN KEY (`nomeUtente`) REFERENCES `UTENTE` (`nomeUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GESTIONES`
--

LOCK TABLES `GESTIONES` WRITE;
/*!40000 ALTER TABLE `GESTIONES` DISABLE KEYS */;
/*!40000 ALTER TABLE `GESTIONES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HABITAT`
--

DROP TABLE IF EXISTS `HABITAT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HABITAT` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HABITAT`
--

LOCK TABLES `HABITAT` WRITE;
/*!40000 ALTER TABLE `HABITAT` DISABLE KEYS */;
/*!40000 ALTER TABLE `HABITAT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MESSAGGIO`
--

DROP TABLE IF EXISTS `MESSAGGIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MESSAGGIO` (
  `id` tinyint NOT NULL,
  `nomeUtenteMittente` varchar(64) DEFAULT NULL,
  `nomeUtenteDestinatario` varchar(64) DEFAULT NULL,
  `titolo` varchar(32) DEFAULT NULL,
  `testo` varchar(500) DEFAULT NULL,
  `tstamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nomeUtenteMittente` (`nomeUtenteMittente`),
  KEY `nomeUtenteDestinatario` (`nomeUtenteDestinatario`),
  CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`nomeUtenteMittente`) REFERENCES `UTENTE` (`nomeUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messaggio_ibfk_2` FOREIGN KEY (`nomeUtenteDestinatario`) REFERENCES `UTENTE` (`nomeUtente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MESSAGGIO`
--

LOCK TABLES `MESSAGGIO` WRITE;
/*!40000 ALTER TABLE `MESSAGGIO` DISABLE KEYS */;
/*!40000 ALTER TABLE `MESSAGGIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OSPITATA`
--

DROP TABLE IF EXISTS `OSPITATA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `OSPITATA` (
  `nomeLatino` varchar(64) NOT NULL,
  `id` tinyint NOT NULL,
  PRIMARY KEY (`nomeLatino`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `ospitata_ibfk_1` FOREIGN KEY (`nomeLatino`) REFERENCES `SPECIE` (`nomeLatino`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ospitata_ibfk_2` FOREIGN KEY (`id`) REFERENCES `HABITAT` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OSPITATA`
--

LOCK TABLES `OSPITATA` WRITE;
/*!40000 ALTER TABLE `OSPITATA` DISABLE KEYS */;
/*!40000 ALTER TABLE `OSPITATA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PARTECIPATO`
--

DROP TABLE IF EXISTS `PARTECIPATO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PARTECIPATO` (
  `nomeUtente` varchar(64) NOT NULL,
  `id` tinyint NOT NULL,
  PRIMARY KEY (`nomeUtente`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `partecipato_ibfk_1` FOREIGN KEY (`nomeUtente`) REFERENCES `UTENTE` (`nomeUtente`),
  CONSTRAINT `partecipato_ibfk_2` FOREIGN KEY (`id`) REFERENCES `ESCURSIONE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARTECIPATO`
--

LOCK TABLES `PARTECIPATO` WRITE;
/*!40000 ALTER TABLE `PARTECIPATO` DISABLE KEYS */;
/*!40000 ALTER TABLE `PARTECIPATO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROGETTORICERCA`
--

DROP TABLE IF EXISTS `PROGETTORICERCA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PROGETTORICERCA` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROGETTORICERCA`
--

LOCK TABLES `PROGETTORICERCA` WRITE;
/*!40000 ALTER TABLE `PROGETTORICERCA` DISABLE KEYS */;
/*!40000 ALTER TABLE `PROGETTORICERCA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROPOSTA`
--

DROP TABLE IF EXISTS `PROPOSTA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PROPOSTA` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `id2` tinyint DEFAULT NULL,
  `nomeUtente` varchar(64) DEFAULT NULL,
  `commento` varchar(500) DEFAULT NULL,
  `dataProposta` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id2` (`id2`),
  KEY `nomeUtente` (`nomeUtente`),
  CONSTRAINT `proposta_ibfk_1` FOREIGN KEY (`id2`) REFERENCES `SEGNALAZIONE` (`id`) ON DELETE CASCADE,
  CONSTRAINT `proposta_ibfk_2` FOREIGN KEY (`nomeUtente`) REFERENCES `UTENTE` (`nomeUtente`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROPOSTA`
--

LOCK TABLES `PROPOSTA` WRITE;
/*!40000 ALTER TABLE `PROPOSTA` DISABLE KEYS */;
/*!40000 ALTER TABLE `PROPOSTA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RACCOLTAFONDI`
--

DROP TABLE IF EXISTS `RACCOLTAFONDI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RACCOLTAFONDI` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `id2` tinyint DEFAULT NULL,
  `stato` enum('APERTA','CHIUSA') DEFAULT 'APERTA',
  `inizio` date DEFAULT NULL,
  `descrizione` varchar(500) DEFAULT NULL,
  `maxImporto` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id2` (`id2`),
  CONSTRAINT `raccoltafondi_ibfk_1` FOREIGN KEY (`id2`) REFERENCES `PROGETTORICERCA` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RACCOLTAFONDI`
--

LOCK TABLES `RACCOLTAFONDI` WRITE;
/*!40000 ALTER TABLE `RACCOLTAFONDI` DISABLE KEYS */;
/*!40000 ALTER TABLE `RACCOLTAFONDI` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REGISTER`
--

DROP TABLE IF EXISTS `REGISTER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `REGISTER` (
  `nomeUtente` varchar(64) NOT NULL,
  `psw` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `annoNascita` int DEFAULT NULL,
  `professione` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`nomeUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REGISTER`
--

LOCK TABLES `REGISTER` WRITE;
/*!40000 ALTER TABLE `REGISTER` DISABLE KEYS */;
INSERT INTO `REGISTER` VALUES ('mik32','tomare32','qwerty@gmail.com',1994,'studente');
/*!40000 ALTER TABLE `REGISTER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SEGNALAZIONE`
--

DROP TABLE IF EXISTS `SEGNALAZIONE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SEGNALAZIONE` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `nomeUtente` varchar(64) DEFAULT NULL,
  `dataSegnalazione` date DEFAULT NULL,
  `latitudineGPS` int DEFAULT NULL,
  `longitudineGPS` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nomeUtente` (`nomeUtente`),
  CONSTRAINT `segnalazione_ibfk_1` FOREIGN KEY (`nomeUtente`) REFERENCES `UTENTE` (`nomeUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SEGNALAZIONE`
--

LOCK TABLES `SEGNALAZIONE` WRITE;
/*!40000 ALTER TABLE `SEGNALAZIONE` DISABLE KEYS */;
/*!40000 ALTER TABLE `SEGNALAZIONE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SPECIE`
--

DROP TABLE IF EXISTS `SPECIE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SPECIE` (
  `nomeLatino` varchar(64) NOT NULL,
  `tipo` enum('animale','vegetale') DEFAULT NULL,
  `nomeItaliano` varchar(64) DEFAULT NULL,
  `classe` varchar(64) DEFAULT NULL,
  `annoClassif` int DEFAULT NULL,
  `vulnerabilita` float DEFAULT NULL,
  `wikiLink` varchar(64) DEFAULT NULL,
  `cmAltezza` int DEFAULT NULL,
  `cmDiametro` int DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `mediaProle` float DEFAULT NULL,
  PRIMARY KEY (`nomeLatino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SPECIE`
--

LOCK TABLES `SPECIE` WRITE;
/*!40000 ALTER TABLE `SPECIE` DISABLE KEYS */;
/*!40000 ALTER TABLE `SPECIE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UTENTE`
--

DROP TABLE IF EXISTS `UTENTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `UTENTE` (
  `nomeUtente` varchar(64) NOT NULL,
  `tipo` enum('semplice','premium','amministratore') DEFAULT 'semplice',
  `psw` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `annoNascita` int DEFAULT NULL,
  `dataRegistrazione` date DEFAULT NULL,
  `professione` varchar(64) DEFAULT NULL,
  `classifCorrette` int DEFAULT NULL,
  `classifNonCorrette` int DEFAULT NULL,
  `classifTotali` int DEFAULT NULL,
  `affidabilita` float DEFAULT NULL,
  `contatore` int DEFAULT NULL,
  PRIMARY KEY (`nomeUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UTENTE`
--

LOCK TABLES `UTENTE` WRITE;
/*!40000 ALTER TABLE `UTENTE` DISABLE KEYS */;
/*!40000 ALTER TABLE `UTENTE` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-01 13:27:32
