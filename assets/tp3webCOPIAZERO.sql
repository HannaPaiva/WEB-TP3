-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
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
  `userid` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  `passwordficheiro` varchar(400) DEFAULT NULL,
  `publico` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`userid`,`fileid`),
  KEY `fk_utilizadores_has_ficheiros_ficheiros1_idx` (`fileid`),
  KEY `fk_utilizadores_has_ficheiros_utilizadores_idx` (`userid`),
  CONSTRAINT `fk_utilizadores_has_ficheiros_ficheiros1` FOREIGN KEY (`fileid`) REFERENCES `ficheiros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilizadores_has_ficheiros_utilizadores` FOREIGN KEY (`userid`) REFERENCES `utilizadores` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela tp3web.acessos: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela tp3web.ficheiros
CREATE TABLE IF NOT EXISTS `ficheiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeficheiro` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `dataficheiro` longblob NOT NULL,
  `enviado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `ficheiros_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilizadores` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela tp3web.ficheiros: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela tp3web.utilizadores
CREATE TABLE IF NOT EXISTS `utilizadores` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('cliente','admin','convidado') DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela tp3web.utilizadores: ~3 rows (aproximadamente)
INSERT INTO `utilizadores` (`userid`, `email`, `password`, `tipo`, `nome`) VALUES
	(1, 'aiwda@gmail.com', '*3543A0AD7EA1BADD56F68D29D84796272A9D88F7', 'admin', 'aida'),
	(3, 'admin@admin.pt', '$2y$10$xl2Il9voZACcfOHWlcQZPOsccCzBr0uzKpw9D706UAblFt5tCRe.m', 'admin', 'admin'),
	(4, 'hanna@admin.pt', '$2y$10$unx2QzSVkc5dtM9j79eAHeHNWHj64iCYrl3nBs1G8BWyNuba2ZsJq', 'admin', 'hanna');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
