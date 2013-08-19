-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sistema_mtn
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.04.1

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
-- Table structure for table `bl_autores`
--

DROP TABLE IF EXISTS `bl_autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bl_autores` (
  `numg_autor` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nome` varchar(500) NOT NULL,
  `desc_observacoes` text,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`numg_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bl_autores`
--

LOCK TABLES `bl_autores` WRITE;
/*!40000 ALTER TABLE `bl_autores` DISABLE KEYS */;
/*!40000 ALTER TABLE `bl_autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bl_editoras`
--

DROP TABLE IF EXISTS `bl_editoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bl_editoras` (
  `numg_editora` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nome` varchar(500) NOT NULL,
  `desc_endereco` varchar(1024) DEFAULT NULL,
  `desc_observacoes` text,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`numg_editora`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bl_editoras`
--

LOCK TABLES `bl_editoras` WRITE;
/*!40000 ALTER TABLE `bl_editoras` DISABLE KEYS */;
INSERT INTO `bl_editoras` VALUES (14,'Saraiva','Shopping Flamboyant','teste','2012-11-12 16:03:13'),(15,'Casa da letra','SÃ£o paulo','ImpressÃµes e ediÃ§Ãµes','2012-11-12 18:05:48');
/*!40000 ALTER TABLE `bl_editoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bl_generos`
--

DROP TABLE IF EXISTS `bl_generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bl_generos` (
  `numg_genero` int(11) NOT NULL AUTO_INCREMENT,
  `desc_nome` varchar(500) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`numg_genero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bl_generos`
--

LOCK TABLES `bl_generos` WRITE;
/*!40000 ALTER TABLE `bl_generos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bl_generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bl_livros`
--

DROP TABLE IF EXISTS `bl_livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bl_livros` (
  `numg_livro` int(11) NOT NULL AUTO_INCREMENT,
  `desc_titulo` varchar(500) NOT NULL,
  `desc_subtitulo` varchar(500) DEFAULT NULL,
  `desc_resumo` varchar(1024) DEFAULT NULL,
  `codg_livro` varchar(30) DEFAULT NULL,
  `data_ano` varchar(4) DEFAULT NULL,
  `numr_impressao` int(11) DEFAULT NULL,
  `numg_editora` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`numg_livro`),
  KEY `bl_livros_numg_editora_fkey` (`numg_editora`),
  CONSTRAINT `bl_livros_numg_editora_fkey` FOREIGN KEY (`numg_editora`) REFERENCES `bl_editoras` (`numg_editora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bl_livros`
--

LOCK TABLES `bl_livros` WRITE;
/*!40000 ALTER TABLE `bl_livros` DISABLE KEYS */;
/*!40000 ALTER TABLE `bl_livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bl_livrosautores`
--

DROP TABLE IF EXISTS `bl_livrosautores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bl_livrosautores` (
  `numg_livro` int(11) NOT NULL,
  `numg_autor` int(11) NOT NULL,
  KEY `bl_livrosautores_numg_livro_fkey` (`numg_livro`),
  KEY `bl_livrosautores_numg_autor_fkey` (`numg_autor`),
  CONSTRAINT `bl_livrosautores_numg_autor_fkey` FOREIGN KEY (`numg_autor`) REFERENCES `bl_autores` (`numg_autor`),
  CONSTRAINT `bl_livrosautores_numg_livro_fkey` FOREIGN KEY (`numg_livro`) REFERENCES `bl_livros` (`numg_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bl_livrosautores`
--

LOCK TABLES `bl_livrosautores` WRITE;
/*!40000 ALTER TABLE `bl_livrosautores` DISABLE KEYS */;
/*!40000 ALTER TABLE `bl_livrosautores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bl_livrosgeneros`
--

DROP TABLE IF EXISTS `bl_livrosgeneros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bl_livrosgeneros` (
  `numg_livro` int(11) NOT NULL,
  `numg_genero` int(11) NOT NULL,
  KEY `bl_livrosgeneros_numg_livro_fkey` (`numg_livro`),
  KEY `bl_livrosgeneros_numg_genero_fkey` (`numg_genero`),
  CONSTRAINT `bl_livrosgeneros_numg_genero_fkey` FOREIGN KEY (`numg_genero`) REFERENCES `bl_generos` (`numg_genero`),
  CONSTRAINT `bl_livrosgeneros_numg_livro_fkey` FOREIGN KEY (`numg_livro`) REFERENCES `bl_livros` (`numg_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bl_livrosgeneros`
--

LOCK TABLES `bl_livrosgeneros` WRITE;
/*!40000 ALTER TABLE `bl_livrosgeneros` DISABLE KEYS */;
/*!40000 ALTER TABLE `bl_livrosgeneros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `cd_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `senha` char(42) NOT NULL,
  PRIMARY KEY (`cd_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Tabela de usuários';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997'),(2,'fabricio','40bd001563085fc35165329ea1ff5c5ecbdbbeef');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-01 16:31:55
