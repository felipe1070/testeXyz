CREATE DATABASE  IF NOT EXISTS `teste_xyz` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `teste_xyz`;
-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: teste_xyz
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `Enquetes`
--

DROP TABLE IF EXISTS `Enquetes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Enquetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Enquetes`
--

LOCK TABLES `Enquetes` WRITE;
/*!40000 ALTER TABLE `Enquetes` DISABLE KEYS */;
INSERT INTO `Enquetes` VALUES (12,'Enquete 4'),(18,'Enquete 1'),(19,'Enquete 2'),(20,'Enquete 3');
/*!40000 ALTER TABLE `Enquetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Perguntas`
--

DROP TABLE IF EXISTS `Perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Perguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(255) NOT NULL,
  `Enquetes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Perguntas_Enquetes_idx` (`Enquetes_id`),
  CONSTRAINT `fk_Perguntas_Enquetes` FOREIGN KEY (`Enquetes_id`) REFERENCES `Enquetes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Perguntas`
--

LOCK TABLES `Perguntas` WRITE;
/*!40000 ALTER TABLE `Perguntas` DISABLE KEYS */;
INSERT INTO `Perguntas` VALUES (1,'Como qualificaria a comunicação e a informação no website antes do evento? ',18),(2,'Como qualificaria o local do evento?',18),(3,'Como qualificaria a área de credenciamento?',18),(4,'Como descreveria o serviço que recebeu no dia do evento?',18),(5,'Por favor, selecione as áreas que alcançaram suas expectativas durante o evento:',18),(6,'Quando você encontra tempo para ler?',19),(7,'O que você acha do uso de animais como cobaias para a fabricação de medicamentos?',19),(8,'Que assuntos você mais gostaria de ler num jornal como o Mundo Jovem?',19),(9,'Qual é o maior desafio do jovem na atualidade?',19),(10,'Como você avalia os reality shows do tipo \'Big Brother\' e \'A Fazenda\'?',20),(11,'Você concorda com punições mais severas para motoristas que tenham ingerido álcool?',20),(12,'Que efeitos você considera que a eleição do Papa Francisco trará ao mundo?',20),(13,'Que consequências as mobilizações populares que acontecem no Brasil trazem para a sociedade?',20),(14,'Como você avalia a onda de protestos que têm acontecido nas cidades brasileiras?',12),(15,'A partir da entrevista no Mundo Jovem deste mês, como você considera que estão as relações afetivas e de namoro no mundo de hoje?',12),(16,'Qual é (ou foi) sua principal motivação ao fazer uma escolha profissional?',12);
/*!40000 ALTER TABLE `Perguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Respostas`
--

DROP TABLE IF EXISTS `Respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Respostas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resposta` varchar(255) DEFAULT NULL,
  `numero` bigint(20) NOT NULL DEFAULT '0',
  `Perguntas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Respostas_Perguntas1_idx` (`Perguntas_id`),
  CONSTRAINT `fk_Respostas_Perguntas1` FOREIGN KEY (`Perguntas_id`) REFERENCES `Perguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Respostas`
--

LOCK TABLES `Respostas` WRITE;
/*!40000 ALTER TABLE `Respostas` DISABLE KEYS */;
INSERT INTO `Respostas` VALUES (1,'Excelente',5,1),(2,'Muito bom',3,1),(3,'Bom',0,1),(4,'Regular',1,1),(5,'Ruim',0,1),(6,'Excelente',2,2),(7,'Muito bom',5,2),(8,'Bom',0,2),(9,'Regular',2,2),(10,'Ruim',0,2),(11,'Excelente',0,3),(12,'Muito bom',4,3),(13,'Bom',1,3),(14,'Regular',2,3),(15,'Ruim',2,3),(16,'Excelente',2,4),(17,'Muito bom',0,4),(18,'Bom',4,4),(19,'Regular',2,4),(20,'Ruim',1,4),(21,'Os palestrantes',3,5),(22,'O número de participantes',1,5),(23,'Oportunidade para networking',4,5),(24,'O atendimento prestado durante o evento',0,5),(25,'A qualidade dos contatos realizados',1,5),(26,'Sempre reservo um momento do dia para ler.',4,6),(27,'Aproveito para ler quando estou no trânsito.',1,6),(28,'Carrego minhas leituras para ler quando sobrar um tempinho.',1,6),(29,'Quase não encontro tempo, mas gostaria de ler mais.',0,6),(30,'Não é um hábito que me interesse cultivar.',2,6),(31,'Sou contra porque é um desrespeito para com os animais e poderiam ser usados outros métodos, mesmo que mais caros.',4,7),(32,'Sou a favor porque muitas vidas humanas são salvas graças aos medicamentos testados em animais.',0,7),(33,'Sou a favor. É um absurdo querer igualar os direitos dos animais aos direitos humanos.',1,7),(34,'Não tenho opinião formada sobre o assunto.',3,7),(35,'Esporte e saúde',0,8),(36,'Política e realidade brasileira',0,8),(37,'Filosofia e Sociologia',2,8),(38,'Temas pedagógicos',4,8),(39,'Mensagens e testemunhos de vida',0,8),(40,'Ensino Religioso e espiritualidade',2,8),(41,'Ter acesso a uma educação pública de qualidade.',2,9),(42,'Encontrar dignidade e ser valorizado no mercado de trabalho.',1,9),(43,'Ser reconhecido pela sociedade como um sujeito de direitos.',0,9),(44,'Superar a violência que o ameaça de muitas formas.',2,9),(45,'A falta de referências e de um projeto para sua vida.',1,9),(46,'Não tenho opinião formada sobre o assunto.',2,9),(47,'É um programa sem conteúdo cultural, que expõe sem escrúpulos a vida privada.',0,10),(48,'Sou a favor, pois uma das finalidades da TV é o entretenimento e a diversão.',3,10),(49,'É algo tão ruim que deveria ser boicotado pela sociedade brasileira.',0,10),(50,'Não tenho opinião formada sobre o assunto.',1,10),(51,'Concordo. É preciso adotar tolerância zero até que se mude esta cultura de beber e dirigir.',0,11),(52,'Em parte. Concordo com a maior fiscalização e punição aos infratores, mas o nível máximo de álcool no sangue é muito baixo.',1,11),(53,'Não concordo. A lei já estava certa, faltava era fiscalização.',2,11),(54,'Não tenho opinião formada sobre o assunto.',1,11),(55,'Isso compete somente aos seguidores de sua instituição.',0,12),(56,'Será um sopro de esperança e ação contra a miséria, a injustiça e outras questões sociais.',0,12),(57,'Acredito que a euforia é somente da mídia e que não haverá nenhum efeito positivo.',1,12),(58,'Não tenho opinião formada sobre o assunto.',3,12),(59,'É através delas que o povo consegue manifestar sua indignação e reclamar mudanças.',0,13),(60,'A luta popular tem seu valor, mas não tem trazido efeitos práticos.',0,13),(61,'São uma perda de tempo e ainda atrapalham o cotidiano das cidades.',2,13),(62,'Não tenho opinião formada sobre o assunto.',2,13),(63,'Estou orgulhoso(a), pois é um sinal de mudança e de que o país está acordando para viver uma democracia plena.',0,14),(64,'É preciso esperar por mais fatos para se fazer uma avaliação dos seus efeitos.',0,14),(65,'Os movimentos não sabem o que querem e ainda depredam patrimônios públicos.',0,14),(66,'A rapidez com que as coisas acontecem na vida de hoje atrapalha o real encontro de duas pessoas.',0,15),(67,'O namoro vai muito bem, pois as pessoas continuam procurando o amor em qualquer tempo.',0,15),(68,'O modelo de namoro tradicional está ultrapassado.',0,15),(69,'Não tenho opinião formada sobre o assunto.',0,15),(70,'Garantir um rendimento que me proporcione uma vida confortável.',0,16),(71,'Trabalhar com algo que me traga prazer e realização pessoal.',0,16),(72,'Ser valorizado nos meios que frequento.',0,16),(73,'Dar minha contribuição para melhorar o mundo.',0,16),(74,'Não tenho opinião formada sobre o assunto.',0,16);
/*!40000 ALTER TABLE `Respostas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Xyz','xyz@xyz.com','k5NO/P09');
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

-- Dump completed on 2016-01-28 13:14:17
