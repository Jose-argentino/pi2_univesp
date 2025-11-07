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
  `niv_acesso` varchar(15) NOT NULL,
  `obs` text DEFAULT NULL,
  `cadastrado_por` int(11) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_acesso: ~4 rows (aproximadamente)
INSERT INTO `tb_acesso` (`id`, `niv_acesso`, `obs`, `cadastrado_por`, `data_cad`) VALUES
	(1, 'CURRENT_TI', 'para por a data automaticamente ,para por a data automaticamente ,para por a data automaticamente ,para por a data automaticamente ,para por a data automaticamente .para por a data automaticamente .para por a data automaticamente .para por a data automaticamente .para por a data automaticamente ', 1, '2025-09-06 16:55:12'),
	(2, 'Administrador', 'Acesso geral', 2, '2025-09-06 16:56:57'),
	(3, 'Vendedor', 'Vendas', 1, '2025-09-06 16:57:29'),
	(4, 'Estoquista', 'Estoque (Entrada, Saida, Coreção, Relatorio, Pedido)', 1, '2025-09-06 16:58:43');

-- Copiando estrutura para tabela db_loja_roupa.tb_categoria
CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) NOT NULL,
  `obs` text DEFAULT NULL,
  `cadastrado_por` int(11) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_categoria: ~21 rows (aproximadamente)
INSERT INTO `tb_categoria` (`id`, `categoria`, `obs`, `cadastrado_por`, `data_cad`) VALUES
	(1, 'Calça', NULL, 125, '2025-09-06 16:18:20'),
	(2, 'Camiseta', NULL, 5, '2025-09-06 16:18:20'),
	(3, 'Calça Jeans', NULL, 125, '2025-09-06 16:18:20'),
	(4, 'Bermuda', NULL, 125, '2025-09-06 16:18:20'),
	(5, 'Saia', NULL, 125, '2025-09-06 16:18:20'),
	(6, 'Vestido', NULL, 125, '2025-09-06 16:18:20'),
	(7, 'Blusa', NULL, 125, '2025-09-06 16:18:20'),
	(8, 'Jaqueta', NULL, 125, '2025-09-06 16:18:20'),
	(9, 'Moletom', NULL, 8, '2025-09-06 16:18:20'),
	(10, 'Camisa Social', NULL, 125, '2025-09-06 16:18:20'),
	(11, 'Terno', NULL, 125, '2025-09-06 16:18:20'),
	(12, 'Blazer', NULL, 125, '2025-09-06 16:18:20'),
	(13, 'Shorts', NULL, 125, '2025-09-06 16:18:20'),
	(14, 'Macacão', NULL, 7, '2025-09-06 16:18:20'),
	(15, 'Polo', NULL, 125, '2025-09-06 16:18:20'),
	(16, 'Legging', NULL, 125, '2025-09-06 16:18:20'),
	(17, 'Top', NULL, 100, '2025-09-06 16:18:20'),
	(18, 'Roupa Íntima', NULL, 100, '2025-09-06 16:18:20'),
	(19, 'Meias', NULL, 120, '2025-09-06 16:18:20'),
	(20, 'Roupão', NULL, 121, '2025-09-06 16:18:20'),
	(21, 'Pijama', NULL, 125, '2025-09-06 16:18:20'),
	(22, 'teste', 'teste', 7, '2025-10-23 20:46:29');

-- Copiando estrutura para tabela db_loja_roupa.tb_estoque
CREATE TABLE IF NOT EXISTS `tb_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(20,2) NOT NULL DEFAULT 0.00,
  `custo` decimal(20,6) DEFAULT NULL,
  `valor_venda` decimal(20,6) DEFAULT NULL,
  `desconto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_estoque: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_loja_roupa.tb_fornecedor
CREATE TABLE IF NOT EXISTS `tb_fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor` varchar(50) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` int(12) NOT NULL,
  `endereco` text NOT NULL,
  `obs` text NOT NULL,
  `vendedor` varchar(50) NOT NULL,
  `data_cad` timestamp NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_fornecedor: ~0 rows (aproximadamente)
INSERT INTO `tb_fornecedor` (`id`, `fornecedor`, `cnpj`, `email`, `telefone`, `endereco`, `obs`, `vendedor`, `data_cad`, `cadastrado_por`) VALUES
	(1, 'BellaLi Lingerie', '12.244.668/0001-63', 'bellalilojaonline@hotmail.com', 55, 'PEDRO CANDIDO MARQUES, 102\r\nMIRANTE II, JURUAIA/MG\r\ncep 37805-000', 'whatsapp +55 (19) 98421-0017', 'ana camargo', '2025-10-21 19:39:40', '7'),
	(2, 'DAAP STORE', '12.244.568/0001-63', 'daapwebstore@gmail.com', 55, 'Ibitiura de Minas - MG\r\nRua Barão do Rio Branco 540', '55(35)99758-1212\r\nhttps://www.daapstore.com.br/\r\n', 'carlos barbosa', '2025-10-21 19:48:07', '7');

-- Copiando estrutura para tabela db_loja_roupa.tb_modelo
CREATE TABLE IF NOT EXISTS `tb_modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL DEFAULT 0,
  `partNumber` varchar(50) NOT NULL,
  `titulo` varchar(250) NOT NULL DEFAULT '',
  `caracteristica` text NOT NULL,
  `obs` text NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_modelo: ~2 rows (aproximadamente)
INSERT INTO `tb_modelo` (`id`, `fornecedor`, `categoria`, `partNumber`, `titulo`, `caracteristica`, `obs`, `data_cad`, `cadastrado_por`) VALUES
	(1, 1, 1, 'CMS120', 'fhgsjyuktm,', '4565\r\n36562655', '542556 ew1 e6 6', '2025-10-21 17:25:52', 7),
	(2, 2, 10, 'rer tetwetwerg ', 'Camisa social com estampa em autorelevo', '4555 fwekhwejewbhrj', 'hghh \r\nkgkjkjrg', '2025-10-21 17:27:13', 7),
	(3, 1, 8, 'hhhgdygj2', 'Jaqueta em couro refinado a mao', '100 % natural', 'nada consta', '2025-10-23 21:00:08', 7);

-- Copiando estrutura para tabela db_loja_roupa.tb_usuario
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `sobreNome` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `nivel_acesso` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` int(12) NOT NULL,
  `endereco` text NOT NULL,
  `obs` text NOT NULL,
  `status_usuario` int(1) NOT NULL,
  `data_cad` timestamp NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tb_usuario_tb_acesso` (`nivel_acesso`),
  CONSTRAINT `FK_tb_usuario_tb_acesso` FOREIGN KEY (`nivel_acesso`) REFERENCES `tb_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela db_loja_roupa.tb_usuario: ~7 rows (aproximadamente)
INSERT INTO `tb_usuario` (`id`, `nome`, `sobreNome`, `senha`, `cpf`, `nivel_acesso`, `email`, `telefone`, `endereco`, `obs`, `status_usuario`, `data_cad`, `cadastrado_por`) VALUES
	(7, 'jose', 'teste', '$2y$10$24lXkWhPmQRAKqZdaxkGQuNqKUMeqOw3QXCNoLAdZxgxCh.nB886G', '25975868668', 2, 'teste@teste.com', 2147483647, 'Rua Exemplo, 123 - São Paulo, SP', 'teste OBS', 1, '2025-09-24 00:14:52', '2'),
	(8, 'jose', 'teste', '$2y$10$tqkyb71EQGl91p.XiiWrjO1tz1uhxruSv0KQXHYHmUITM2J.7GS5a', '25975868668', 4, 'j.argentino@hotmail.com', 2147483647, 'cidade: teste do teste', 'testes infindaveis', 0, '2025-10-13 19:50:41', '2'),
	(9, 'jose', 'teste', '$2y$10$AVbA5ASLt70BEci7U9RAeeRICiSphY7Xm2jOD2/qTAPzxKEEJqbdO', '25975868668', 4, 'j.argentino@hotmail.com', 2147483647, 'cidade: teste do teste', 'testes infindaveis', 0, '2025-10-13 19:53:32', '3'),
	(10, 'carina', 'teste', '$2y$10$gXE8tThRl7JeFE2BcXk4MuP04A5cehoY3K7O1JP4wNqWNWF/jA1Vu', '25698745625', 3, 'teste2@teste.com', 2147483647, 'testes 5585895', 'nada consta', 0, '2025-10-15 20:19:22', '4'),
	(11, 'carina ', 'teste', '$2y$10$7fUD2pXxSVI6EY135mSTBe8BF6bgHHfzLLyLFndQHIUACq1uN94sO', '25789869955', 3, 'teste2@teste.com', 2147483647, 'dfasdgasdgdsabdb  we e wet ', 'nada consta', 0, '2025-10-15 20:23:50', '2'),
	(12, 'sara', 'teste', '$2y$10$Tsb/cKwM0.efOxaOKjsNEeiaVKMxxmJxGJK/yceCkUYOrqaEO9/vi', '78956423658', 3, 'sara@sara.com', 2147483647, 'teste', '', 1, '2025-10-16 23:27:16', '3'),
	(13, 'sara', 'teste', '$2y$10$T.Cr2bUhI7KyJz.JdTC8uOEKv9yVBnAn7YzG7o5PUt9HB6xINFOAi', '78956423658', 3, 'sara@sara.com', 2147483647, 'teste', '', 1, '2025-10-16 23:27:16', '1'),
	(14, 'Cyro', 'Cyro Teste', '$2y$10$FXukSclUNRciazfWEmR5MO9HzRR61/E7iYubOz9QslhH5PzuSVOz2', '87987987985', 4, 'cyro@cyro.com', 2147483647, 'rua teste, \r\nnumero 105,\r\nbairo:teste\r\nCidade: Teste do teste', 'incontaveis testes', 0, '2025-10-17 14:09:10', '7'),
	(15, 'argentino', 'felipe', '$2y$10$FArp93BcD5tuOoGBjbl.cefKPoVXeDTsJuzYdfTT6EklXD8521qUW', '58958978658', 4, 'teste@gmail.com', 2147483647, 'teste\r\ntestes\r\n012', 'jfgnjagkngj nj ne n n', 1, '2025-10-19 16:13:24', '7');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
