-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.12.0.7122
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_loja_roupa
CREATE DATABASE IF NOT EXISTS `db_loja_roupa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_loja_roupa`;

-- Copiando estrutura para tabela db_loja_roupa.tb_acesso
CREATE TABLE IF NOT EXISTS `tb_acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niv_acesso` varchar(10) NOT NULL,
  `obs` text DEFAULT NULL,
  `cadastrado_por` int(11) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_acesso: ~4 rows (aproximadamente)
INSERT INTO `tb_acesso` (`id`, `niv_acesso`, `obs`, `cadastrado_por`, `data_cad`) VALUES
	(1, 'CURRENT_TI', 'para por a data automaticamente ', 1, '2025-09-06 16:55:12'),
	(2, 'Administra', 'Acesso geral', 2, '2025-09-06 16:56:57'),
	(3, 'Vendedor', 'Apenas vendas', 1, '2025-09-06 16:57:29'),
	(4, 'Estoquista', 'Entrada, Saida, Coreção, Relatorio, Pedido', 1, '2025-09-06 16:58:43');

-- Copiando estrutura para tabela db_loja_roupa.tb_categoria
CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) NOT NULL,
  `cadastrado_por` int(11) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_categoria: ~21 rows (aproximadamente)
INSERT INTO `tb_categoria` (`id`, `categoria`, `cadastrado_por`, `data_cad`) VALUES
	(1, 'Calsa', 125, '2025-09-06 16:18:20'),
	(2, 'Camiseta', 5, '2025-09-06 16:18:20'),
	(3, 'Calça Jeans', 125, '2025-09-06 16:18:20'),
	(4, 'Bermuda', 125, '2025-09-06 16:18:20'),
	(5, 'Saia', 125, '2025-09-06 16:18:20'),
	(6, 'Vestido', 125, '2025-09-06 16:18:20'),
	(7, 'Blusa', 125, '2025-09-06 16:18:20'),
	(8, 'Jaqueta', 125, '2025-09-06 16:18:20'),
	(9, 'Moletom', 8, '2025-09-06 16:18:20'),
	(10, 'Camisa Social', 125, '2025-09-06 16:18:20'),
	(11, 'Terno', 125, '2025-09-06 16:18:20'),
	(12, 'Blazer', 125, '2025-09-06 16:18:20'),
	(13, 'Shorts', 125, '2025-09-06 16:18:20'),
	(14, 'Macacão', 7, '2025-09-06 16:18:20'),
	(15, 'Polo', 125, '2025-09-06 16:18:20'),
	(16, 'Legging', 125, '2025-09-06 16:18:20'),
	(17, 'Top', 100, '2025-09-06 16:18:20'),
	(18, 'Roupa Íntima', 100, '2025-09-06 16:18:20'),
	(19, 'Meias', 120, '2025-09-06 16:18:20'),
	(20, 'Roupão', 121, '2025-09-06 16:18:20'),
	(21, 'Pijama', 125, '2025-09-06 16:18:20');

-- Copiando estrutura para tabela db_loja_roupa.tb_cor
CREATE TABLE IF NOT EXISTS `tb_cor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_fornecedor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL DEFAULT 0,
  `cod_modelo` int(11) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `obs` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` int(11) NOT NULL,
  `data_fim` datetime DEFAULT current_timestamp(),
  `inativado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tb_modelo_tb_fornecedor` (`cod_fornecedor`) USING BTREE,
  KEY `FK_tb_modelo_tb_categoria` (`categoria`) USING BTREE,
  KEY `FK_tb_cor_tb_modelo` (`cod_modelo`),
  CONSTRAINT `FK_tb_cor_tb_modelo` FOREIGN KEY (`cod_modelo`) REFERENCES `tb_modelo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_cor_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `tb_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_cor_ibfk_2` FOREIGN KEY (`cod_fornecedor`) REFERENCES `tb_fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela db_loja_roupa.tb_cor: ~2 rows (aproximadamente)
INSERT INTO `tb_cor` (`id`, `cod_fornecedor`, `categoria`, `cod_modelo`, `cor`, `obs`, `status`, `data_cad`, `cadastrado_por`, `data_fim`, `inativado_por`) VALUES
	(1, 4, 3, 2, 'branca', 'com griter', 1, '2025-09-06 15:51:40', 1, '0000-00-00 00:00:00', NULL),
	(2, 6, 16, 4, 'preta', '', 1, '2025-09-06 15:52:44', 2, '0000-00-00 00:00:00', NULL);

-- Copiando estrutura para tabela db_loja_roupa.tb_estoque
CREATE TABLE IF NOT EXISTS `tb_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(20,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `FK_tb_estoque_tb_tamanho` (`cod_produto`),
  CONSTRAINT `FK_tb_estoque_tb_tamanho` FOREIGN KEY (`cod_produto`) REFERENCES `tb_tamanho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_estoque: ~2 rows (aproximadamente)
INSERT INTO `tb_estoque` (`id`, `cod_produto`, `quantidade`, `valor_unitario`) VALUES
	(1, 1, 25, 65.00),
	(2, 1, 45, 32.00);

-- Copiando estrutura para tabela db_loja_roupa.tb_fornecedor
CREATE TABLE IF NOT EXISTS `tb_fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` int(12) NOT NULL,
  `endereco` text NOT NULL,
  `obs` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `vendedor` varchar(50) NOT NULL,
  `data_cad` timestamp NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` varchar(50) NOT NULL,
  `data_fim` timestamp NULL DEFAULT NULL,
  `inativado_por` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_fornecedor: ~6 rows (aproximadamente)
INSERT INTO `tb_fornecedor` (`id`, `nome`, `cnpj`, `email`, `telefone`, `endereco`, `obs`, `status`, `vendedor`, `data_cad`, `cadastrado_por`, `data_fim`, `inativado_por`) VALUES
	(1, 'B&C Moda', '00.000.000/0000-00', 'teste@email.com', 2147483647, 'Rua Exemplo, 123 - SP', 'Fornecedor inicial de teste', 1, 'José da Silva', '2025-09-03 20:16:47', '1', NULL, NULL),
	(2, 'Fino Fio', '12.345.678/0001-90', 'contato@tecnpecas.com', 2147483647, 'Rua das Indústrias, 120 - São Paulo/SP', 'Fornecedor de componentes eletrônicos', 1, 'Carlos Mendes', '2025-09-03 20:17:56', '2', NULL, NULL),
	(3, 'Mundo Têxtil', '98.765.432/0001-55', 'vendas@mundotextil.com', 2147483647, 'Av. Paulista, 2500 - São Paulo/SP', 'Fornece tecidos e aviamentos', 1, 'Fernanda Souza', '2025-09-03 20:17:56', '5', NULL, NULL),
	(4, 'algodão de ouro', '55.444.333/0001-22', 'sac@bomsabor.com', 2147483647, 'Rua das Flores, 88 - Rio de Janeiro/RJ', 'Distribuidor de alimentos enlatados', 1, 'João Ribeiro', '2025-09-03 20:17:56', '4', NULL, NULL),
	(5, 'Conf Mais', '11.222.333/0001-44', 'contato@construmais.com', 2147483647, 'Av. Amazonas, 300 - Belo Horizonte/MG', 'Fornece materiais de construção', 1, 'Marina Costa', '2025-09-03 20:17:56', '1', NULL, NULL),
	(6, 'Eco Produtos', '77.888.999/0001-11', 'suporte@ecolimpo.com', 2147483647, 'Rua Paraná, 500 - Curitiba/PR', 'Fornece produtos de limpeza ecológicos', 1, 'Rafael Lima', '2025-09-03 20:17:56', '1', NULL, NULL);

-- Copiando estrutura para tabela db_loja_roupa.tb_modelo
CREATE TABLE IF NOT EXISTS `tb_modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_fornecedor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL DEFAULT 0,
  `modelo_fabricante` varchar(50) NOT NULL,
  `titulo` varchar(250) NOT NULL DEFAULT '',
  `caracteristica` text NOT NULL,
  `obs` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` int(11) NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  `inativado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tb_modelo_tb_fornecedor` (`cod_fornecedor`),
  KEY `FK_tb_modelo_tb_categoria` (`categoria`),
  CONSTRAINT `FK_tb_modelo_tb_categoria` FOREIGN KEY (`categoria`) REFERENCES `tb_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tb_modelo_tb_fornecedor` FOREIGN KEY (`cod_fornecedor`) REFERENCES `tb_fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_modelo: ~4 rows (aproximadamente)
INSERT INTO `tb_modelo` (`id`, `cod_fornecedor`, `categoria`, `modelo_fabricante`, `titulo`, `caracteristica`, `obs`, `status`, `data_cad`, `cadastrado_por`, `data_fim`, `inativado_por`) VALUES
	(2, 5, 7, 'D458', 'Blusa feminina artezanal', 'Blusa de croche, manga longa', '100% feita a mao', 1, '2025-09-05 17:02:32', 0, '0000-00-00 00:00:00', NULL),
	(3, 3, 4, '259 - 4', 'Bermuda tipo havaiana com estampa de caveira e bolso lateral', '20% poliester, 80% algodão', '', 1, '2025-09-05 17:05:31', 0, '0000-00-00 00:00:00', NULL),
	(4, 6, 10, 'C - S12 - 42X', 'Camiseta social 100% algodão ', '100% algodão natural colorido com corantes extraidos da amazonia', 'feita por colonos espanhois', 1, '2025-09-05 17:08:58', 0, '0000-00-00 00:00:00', NULL),
	(5, 5, 7, 'blusa 258', 'Blusa masculina manga 3/4', '80% algodão. 20 % elastano', 'livre de corante', 1, '2025-09-06 15:33:59', 1, '0000-00-00 00:00:00', NULL);

-- Copiando estrutura para tabela db_loja_roupa.tb_usuario
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `nivel_acesso` int(11) NOT NULL DEFAULT 0,
  `email` varchar(50) NOT NULL,
  `telefone` int(12) NOT NULL,
  `endereco` text NOT NULL,
  `obs` text NOT NULL,
  `status_usuario` int(1) NOT NULL DEFAULT 0,
  `data_cad` timestamp NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tb_usuario_tb_acesso` (`nivel_acesso`),
  CONSTRAINT `FK_tb_usuario_tb_acesso` FOREIGN KEY (`nivel_acesso`) REFERENCES `tb_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela db_loja_roupa.tb_usuario: ~1 rows (aproximadamente)
INSERT INTO `tb_usuario` (`id`, `nome`, `senha`, `cpf`, `nivel_acesso`, `email`, `telefone`, `endereco`, `obs`, `status_usuario`, `data_cad`, `cadastrado_por`) VALUES
	(7, 'jose', '$2y$10$24lXkWhPmQRAKqZdaxkGQuNqKUMeqOw3QXCNoLAdZxgxCh.nB886G', '25975868668', 2, 'teste@teste.com', 2147483647, 'Rua Exemplo, 123 - São Paulo, SP', 'teste OBS', 1, '2025-09-24 00:14:52', '2');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
