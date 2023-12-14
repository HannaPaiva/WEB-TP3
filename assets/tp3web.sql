-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
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

-- A despejar estrutura para tabela tp3web.ficheiros
CREATE TABLE IF NOT EXISTS `ficheiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeficheiro` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `dataficheiro` longblob NOT NULL,
  `enviado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela tp3web.ficheiros: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela tp3web.utilizadores
CREATE TABLE IF NOT EXISTS `utilizadores` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela tp3web.utilizadores: ~1 rows (aproximadamente)
INSERT INTO `utilizadores` (`userid`, `email`, `password`) VALUES
	(1, 'aiwda@gmail.com', '*3543A0AD7EA1BADD56F68D29D84796272A9D88F7'),
	(2, 'aa@ua.pt', 'asdwqeasd');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
