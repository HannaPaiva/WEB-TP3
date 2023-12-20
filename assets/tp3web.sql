-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para tp3web
CREATE DATABASE IF NOT EXISTS `tp3web` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `tp3web`;

-- A despejar estrutura para tabela tp3web.acessos
CREATE TABLE IF NOT EXISTS `acessos` (
  `idacesso` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  `password_ficheiro` varchar(255) DEFAULT NULL,
  `publico` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idacesso`),
  KEY `fk_utilizadores_has_ficheiros_ficheiros1_idx` (`fileid`),
  KEY `fk_utilizadores_has_ficheiros_utilizadores_idx` (`userid`),
  CONSTRAINT `fileid` FOREIGN KEY (`fileid`) REFERENCES `ficheiros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `utilizadores` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados não seleccionada.

-- A despejar estrutura para tabela tp3web.ficheiros
CREATE TABLE IF NOT EXISTS `ficheiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeficheiro` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `dataficheiro` longblob NOT NULL,
  `enviado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados não seleccionada.

-- A despejar estrutura para tabela tp3web.pasta
CREATE TABLE IF NOT EXISTS `pasta` (
  `idpasta` int(11) NOT NULL AUTO_INCREMENT,
  `nomepasta` varchar(100) DEFAULT NULL,
  `idacesso` int(11) DEFAULT NULL,
  `passwordpasta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idpasta`),
  KEY `idacesso` (`idacesso`),
  CONSTRAINT `idacesso` FOREIGN KEY (`idacesso`) REFERENCES `acessos` (`idacesso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados não seleccionada.

-- A despejar estrutura para tabela tp3web.utilizadores
CREATE TABLE IF NOT EXISTS `utilizadores` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('cliente','admin','convidado') DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados não seleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
