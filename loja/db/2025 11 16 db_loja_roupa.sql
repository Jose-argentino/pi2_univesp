-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.10.0.7023
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_acesso: ~4 rows (aproximadamente)
INSERT INTO `tb_acesso` (`id`, `niv_acesso`, `obs`, `cadastrado_por`, `data_cad`) VALUES
	(1, 'Técnico', 'Acesso ao codigo e banco de dados e cadastros', 1, '2025-09-06 16:55:12'),
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
	(10, 'Camisa Social', 'Camisa social em tecido 100% natural, fabricada no brasil em região certificada como livre de agreção ao meio ambiente e a sociedade', 125, '2025-09-06 16:18:20'),
	(12, 'Blazer', NULL, 125, '2025-09-06 16:18:20'),
	(13, 'Shorts', NULL, 125, '2025-09-06 16:18:20'),
	(14, 'Macacão', NULL, 7, '2025-09-06 16:18:20'),
	(15, 'Polo', NULL, 125, '2025-09-06 16:18:20'),
	(16, 'Legging', NULL, 125, '2025-09-06 16:18:20'),
	(17, 'Top', NULL, 100, '2025-09-06 16:18:20'),
	(18, 'Roupa Íntima', NULL, 100, '2025-09-06 16:18:20'),
	(19, 'Meias', NULL, 120, '2025-09-06 16:18:20'),
	(20, 'Roupão', NULL, 121, '2025-09-06 16:18:20'),
	(21, 'Pijama', NULL, 125, '2025-09-06 16:18:20');

-- Copiando estrutura para tabela db_loja_roupa.tb_estoque
CREATE TABLE IF NOT EXISTS `tb_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `estoque_minimo` int(5) NOT NULL,
  `valor_unitario` decimal(20,2) NOT NULL DEFAULT 0.00,
  `custo` decimal(20,6) DEFAULT NULL,
  `valor_venda` decimal(20,6) NOT NULL,
  `desconto` int(11) DEFAULT NULL,
  `cadastrado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_estoque: ~12 rows (aproximadamente)
INSERT INTO `tb_estoque` (`id`, `cod_produto`, `quantidade`, `estoque_minimo`, `valor_unitario`, `custo`, `valor_venda`, `desconto`, `cadastrado_por`) VALUES
	(1, 3, 20, 10, 0.00, NULL, 80.000000, 20, 7),
	(2, 2, 50, 60, 0.00, NULL, 90.000000, 6, 7),
	(3, 3, 150, 30, 55.00, 50.000000, 129.900000, NULL, 7),
	(4, 5, 45, 30, 38.00, 35.000000, 79.900000, 0, 8),
	(5, 9, 3, 10, 110.00, 95.000000, 229.000000, NULL, 7),
	(6, 11, 35, 40, 25.00, 20.000000, 59.900000, NULL, 7),
	(7, 14, 10, 10, 8.00, 7.500000, 19.900000, 0, 7),
	(8, 16, 25, 25, 45.00, 40.000000, 99.900000, NULL, 7),
	(9, 19, 70, 15, 30.00, 28.000000, 69.900000, 5, 9),
	(10, 21, 8, 5, 55.00, 50.000000, 119.000000, NULL, 7),
	(11, 22, 4, 5, 18.00, 15.000000, 39.900000, NULL, 7),
	(12, 24, 15, 15, 22.00, 20.000000, 49.900000, NULL, 7);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_fornecedor: ~12 rows (aproximadamente)
INSERT INTO `tb_fornecedor` (`id`, `fornecedor`, `cnpj`, `email`, `telefone`, `endereco`, `obs`, `vendedor`, `data_cad`, `cadastrado_por`) VALUES
	(1, 'BellaLi Lingerie', '12.244.668/0001-63', 'bellalilojaonline@hotmail.com', 55, 'PEDRO CANDIDO MARQUES, 102\r\nMIRANTE II, JURUAIA/MG\r\ncep 37805-000', 'whatsapp +55 (19) 98421-0017', 'ana camargo', '2025-10-21 19:39:40', '7'),
	(2, 'DAAP STORE', '12.244.568/0001-63', 'daapwebstore@gmail.com', 55, 'Ibitiura de Minas - MG\r\nRua Barão do Rio Branco 540', '55(35)99758-1212\r\nhttps://www.daapstore.com.br/\r\n', 'carlos barbosa', '2025-10-21 19:48:07', '7'),
	(4, 'Moda Prime Distribuidora', '12.345.678/0001-90', 'contato@modaprime.com', 2147483647, 'Rua das Flores, 150 - São Paulo/SP', 'Fornecedor de roupas casuais', 'Carla Menezes', '2025-11-17 02:37:33', '8'),
	(5, 'Estilo Fashion Atacado', '98.765.432/0001-21', 'vendas@estilofashion.com', 2147483647, 'Av. Brasil, 2100 - Rio de Janeiro/RJ', 'Especializado em moda feminina', 'João Paes', '2025-11-17 02:37:33', '8'),
	(6, 'Brasil Têxtil Group', '45.678.123/0001-55', 'comercial@brasiltextil.com', 2147483647, 'Rua Goiás, 900 - Belo Horizonte/MG', 'Roupas sociais e ternos', 'Renata Duarte', '2025-11-17 02:37:33', '8'),
	(7, 'VesteMix Distribuidora', '23.987.654/0001-80', 'mix@vestemix.com', 2147483647, 'Rua Aurora, 300 - São Paulo/SP', 'Moda esportiva e fitness', 'Tiago Ramos', '2025-11-17 02:37:33', '8'),
	(8, 'Roupas & Cia Atacado', '56.789.012/0001-43', 'suporte@roupasecia.com', 2147483647, 'Rua XV de Novembro, 110 - Curitiba/PR', 'Linha adulto e infantil', 'Marcos Lima', '2025-11-17 02:37:33', '8'),
	(9, 'TopWear Brasil', '67.890.123/0001-66', 'contato@topwear.com', 2147483647, 'Av. Amazonas, 5050 - Belo Horizonte/MG', 'Moda masculina casual', 'Larissa Nogueira', '2025-11-17 02:37:33', '8'),
	(10, 'FashionUp Importados', '34.567.890/0001-11', 'importados@fashionup.com', 2147483647, 'Rua Oscar Freire, 800 - São Paulo/SP', 'Roupas premium importadas', 'Isabela Silva', '2025-11-17 02:37:33', '8'),
	(11, 'TrendyLine Atacado', '78.901.234/0001-33', 'atendimento@trendyline.com', 2147483647, 'Rua Boa Vista, 45 - São Paulo/SP', 'Moda jovem', 'Pedro Martins', '2025-11-17 02:37:33', '8'),
	(12, 'Confecções Silva', '89.012.345/0001-77', 'silva@confeccoes.com', 2147483647, 'Rua das Palmeiras, 22 - Salvador/BA', 'Fabricante direto', 'Ana Beatriz', '2025-11-17 02:37:33', '8'),
	(13, 'UrbanStyle Roupas', '90.123.456/0001-09', 'urbanshop@urbanstyle.com', 2147483647, 'Av. Ipiranga, 700 - Porto Alegre/RS', 'Moda urbana e streetwear', 'Jorge Andrade', '2025-11-17 02:37:33', '8');

-- Copiando estrutura para tabela db_loja_roupa.tb_modelo
CREATE TABLE IF NOT EXISTS `tb_modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL DEFAULT 0,
  `partNumber` varchar(50) NOT NULL,
  `titulo` varchar(250) NOT NULL DEFAULT '',
  `caracteristica` text NOT NULL,
  `obs` text DEFAULT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja_roupa.tb_modelo: ~21 rows (aproximadamente)
INSERT INTO `tb_modelo` (`id`, `fornecedor`, `categoria`, `partNumber`, `titulo`, `caracteristica`, `obs`, `data_cad`, `cadastrado_por`) VALUES
	(3, 1, 8, 'hhhgdygj2', 'Jaqueta em couro refinado a mao', '100 % natural', 'nada consta', '2025-10-23 21:00:08', 7),
	(5, 1, 1, 'MP-CL-001', 'Calça Slim Urban', 'Calça slim tecido leve, bolsos laterais, acabamento premium.', '', '2025-11-16 23:42:22', 9),
	(6, 1, 2, 'MP-CM-002', 'Camiseta Soft Touch', 'Camiseta algodão penteado, toque ultra macio.', '', '2025-11-16 23:42:22', 9),
	(7, 2, 6, 'EF-VT-010', 'Vestido Floral Summer', 'Vestido leve, estampa floral digital, corte acinturado.', '', '2025-11-16 23:42:22', 9),
	(8, 2, 7, 'EF-BL-011', 'Blusa Elegance Feminina', 'Blusa manga 3/4 com detalhes rendados.', '', '2025-11-16 23:42:22', 9),
	(9, 3, 11, 'BT-BZ-020', 'Blazer Social Premium', 'Blazer de alfaiataria, tecido italiano, corte moderno.', '', '2025-11-16 23:42:22', 9),
	(10, 3, 1, 'BT-CL-021', 'Calça Social Executiva', 'Calça reta, tecido antirrugas, ideal para ambientes formais.', '', '2025-11-16 23:42:22', 9),
	(11, 4, 15, 'VM-LG-030', 'Legging Fitness Pro', 'Tecido compressão, costura reforçada, ideal para treinos.', '', '2025-11-16 23:42:22', 9),
	(12, 4, 2, 'VM-CM-031', 'Camiseta DryFit Sport', 'Camiseta esportiva, tecnologia dryfit, respirável.', '', '2025-11-16 23:42:22', 9),
	(13, 5, 8, 'RC-JQ-040', 'Jaqueta Winter Plus', 'Jaqueta acolchoada, proteção térmica alta.', '', '2025-11-16 23:42:22', 9),
	(14, 5, 19, 'RC-MS-041', 'Meias Algodão Soft', 'Kit com 3 pares de meias macias, tamanho único.', '', '2025-11-16 23:42:22', 9),
	(15, 6, 13, 'TW-MC-050', 'Macaquinho Casual Denim', 'Macaquinho jeans leve, bolsos frontais.', '', '2025-11-16 23:42:22', 9),
	(16, 6, 3, 'TW-CJ-051', 'Calça Jeans Classic Blue', 'Jeans corte reto, lavagem escura.', '', '2025-11-16 23:42:22', 9),
	(17, 7, 10, 'FU-CS-060', 'Camisa Social Milano', 'Camisa importada, tecido egípcio, alto padrão.', '', '2025-11-16 23:42:22', 7),
	(18, 7, 12, 'FU-SH-061', 'Shorts Premium Linen', 'Shorts de linho importado, confortável e elegante.', '', '2025-11-16 23:42:22', 9),
	(19, 8, 6, 'TL-VT-070', 'Vestido Party Shine', 'Vestido festa com brilho, tecido elástico.', '', '2025-11-16 23:42:22', 9),
	(20, 8, 9, 'TL-ML-071', 'Moletom Oversized', 'Moletom grosso, estilo streetwear.', '', '2025-11-16 23:42:22', 9),
	(21, 9, 14, 'CS-PL-080', 'Polo Masculina Classic', 'Polo algodão, gola estruturada, modelagem tradicional.', '', '2025-11-16 23:42:22', 9),
	(22, 9, 18, 'CS-RP-081', 'Roupão Confort Home', 'Roupão atoalhado, toque macio.', '', '2025-11-16 23:42:22', 9),
	(23, 10, 16, 'US-RI-090', 'Roupa Íntima UrbanFlex', 'Tecido stretch confortável, respirável.', '', '2025-11-16 23:42:22', 9),
	(24, 10, 5, 'US-SA-091', 'Saia Urban Street', 'Saia curta estilo street, tecido resistente.', '', '2025-11-16 23:42:22', 9);

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
  `obs` text DEFAULT NULL,
  `status_usuario` int(1) NOT NULL,
  `data_cad` timestamp NOT NULL DEFAULT current_timestamp(),
  `cadastrado_por` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tb_usuario_tb_acesso` (`nivel_acesso`),
  CONSTRAINT `FK_tb_usuario_tb_acesso` FOREIGN KEY (`nivel_acesso`) REFERENCES `tb_acesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela db_loja_roupa.tb_usuario: ~13 rows (aproximadamente)
INSERT INTO `tb_usuario` (`id`, `nome`, `sobreNome`, `senha`, `cpf`, `nivel_acesso`, `email`, `telefone`, `endereco`, `obs`, `status_usuario`, `data_cad`, `cadastrado_por`) VALUES
	(7, 'jose', 'teste', '$2y$10$24lXkWhPmQRAKqZdaxkGQuNqKUMeqOw3QXCNoLAdZxgxCh.nB886G', '25975868668', 2, 'teste@teste.com', 2147483647, 'Rua Exemplo, 123 - São Paulo, SP', 'teste OBS', 1, '2025-09-24 00:14:52', '2'),
	(8, 'jose', 'teste', '$2y$10$tqkyb71EQGl91p.XiiWrjO1tz1uhxruSv0KQXHYHmUITM2J.7GS5a', '25975868668', 4, 'j.argentino@hotmail.com', 2147483647, 'cidade: teste do teste', 'testes infindaveis', 0, '2025-10-13 19:50:41', '2'),
	(9, 'jose', 'teste', '$2y$10$AVbA5ASLt70BEci7U9RAeeRICiSphY7Xm2jOD2/qTAPzxKEEJqbdO', '25975868668', 4, 'j.argentino@hotmail.com', 2147483647, 'cidade: teste do teste', 'testes infindaveis', 0, '2025-10-13 19:53:32', '3'),
	(10, 'carina', 'teste', '$2y$10$gXE8tThRl7JeFE2BcXk4MuP04A5cehoY3K7O1JP4wNqWNWF/jA1Vu', '25698745625', 3, 'teste2@teste.com', 2147483647, 'testes 5585895', 'nada consta', 0, '2025-10-15 20:19:22', '4'),
	(11, 'carina ', 'teste', '$2y$10$7fUD2pXxSVI6EY135mSTBe8BF6bgHHfzLLyLFndQHIUACq1uN94sO', '25789869955', 3, 'teste2@teste.com', 2147483647, 'dfasdgasdgdsabdb  we e wet ', 'nada consta', 0, '2025-10-15 20:23:50', '2'),
	(12, 'sara', 'teste', '$2y$10$Tsb/cKwM0.efOxaOKjsNEeiaVKMxxmJxGJK/yceCkUYOrqaEO9/vi', '78956423658', 3, 'sara@sara.com', 2147483647, 'teste', '', 1, '2025-10-16 23:27:16', '3'),
	(13, 'sara', 'teste', '$2y$10$T.Cr2bUhI7KyJz.JdTC8uOEKv9yVBnAn7YzG7o5PUt9HB6xINFOAi', '78956423658', 3, 'sara@sara.com', 2147483647, 'teste', '', 1, '2025-10-16 23:27:16', '1'),
	(14, 'Cyro', 'Cyro Teste', '$2y$10$FXukSclUNRciazfWEmR5MO9HzRR61/E7iYubOz9QslhH5PzuSVOz2', '87987987985', 4, 'cyro@cyro.com', 2147483647, 'rua teste, \r\nnumero 105,\r\nbairo:teste\r\nCidade: Teste do teste', 'incontaveis testes', 0, '2025-10-17 14:09:10', '7'),
	(15, 'argentino', 'felipe', '$2y$10$FArp93BcD5tuOoGBjbl.cefKPoVXeDTsJuzYdfTT6EklXD8521qUW', '58958978658', 4, 'teste@gmail.com', 2147483647, 'teste\r\ntestes\r\n012', 'jfgnjagkngj nj ne n n', 1, '2025-10-19 16:13:24', '7'),
	(16, 'teste 44', '654', '$2y$10$hwh33JnynHx6Q.HMMEOPp.oXRMwNNllYzSBVxdKgUq6A98XLxY4/i', '15865845894', 1, 'teste@gmail.com', 2147483647, 'wsedrwet weew t et twet tew ', ' ew wet  e wt wet ', 1, '2025-11-16 02:04:18', '7'),
	(17, 'etwert', 'wtwertwe', '$2y$10$v04s0ddJq6QPiR3339L97e2B9GgwHGUKAlAvM5tFMD7w/F0kQ62nO', '25698745625', 2, 'a@b.com', 55, 'wetrwetwetew', 'wetwetwe', 1, '2025-11-16 02:49:17', '7'),
	(18, '867', '78687', '$2y$10$AjcPW4PO1sFeNVZQa22VaeUMq3aZuMloHx00tmJ7.PBQjYgTnGbxC', 'dfhgdffhdf', 1, 'b@z.com', 0, 'fdsfgdsafgdsa', 'gsdgsg', 0, '2025-11-16 02:59:01', '7'),
	(19, 'sddsgsd', 'sdgsdg', '$2y$10$bOChpU9lOEx/czkTbdu2reNwf81MehZ5gm5NzmX1e0C5764CGodRK', 'sgsdfgsg', 3, 'sadgsdg@d.com', 0, 'dgsdagdgs', 'sdgsdgdg', 1, '2025-11-16 03:08:30', '7');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
