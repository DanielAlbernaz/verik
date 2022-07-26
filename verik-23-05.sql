-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para verik
CREATE DATABASE IF NOT EXISTS `verik` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `verik`;

-- Copiando estrutura para tabela verik.banner
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `abrir_mesma_aba` int(11) NOT NULL,
  `dhcadastro` datetime NOT NULL,
  `data_inicio_exibicao` datetime NOT NULL,
  `data_expiracao` datetime DEFAULT NULL,
  `idoperador_cadastro` int(11) NOT NULL,
  `idoperador_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.banner: ~1 rows (aproximadamente)
INSERT INTO `banner` (`id`, `titulo`, `url`, `ordem`, `imagem`, `status`, `abrir_mesma_aba`, `dhcadastro`, `data_inicio_exibicao`, `data_expiracao`, `idoperador_cadastro`, `idoperador_alteracao`) VALUES
	(5, 'asdas', 'https://github.com/DanielAlbernaz/verik/tree/daniel', 3, 'arq_banner/banner1653257439.png', 1, 0, '2022-05-22 19:10:39', '2022-05-22 19:10:00', NULL, 1, 1);

-- Copiando estrutura para tabela verik.blog
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `status` int(11) NOT NULL,
  `dhcadastro` datetime NOT NULL,
  `data_inicio_exibicao` datetime NOT NULL,
  `data_expiracao` datetime DEFAULT NULL,
  `idoperador_cadastro` int(11) NOT NULL,
  `idoperador_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_blog_categoria_blog` (`id_categoria`),
  CONSTRAINT `FK_blog_categoria_blog` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_blog` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.blog: ~2 rows (aproximadamente)
INSERT INTO `blog` (`id`, `id_categoria`, `titulo`, `imagem`, `texto`, `status`, `dhcadastro`, `data_inicio_exibicao`, `data_expiracao`, `idoperador_cadastro`, `idoperador_alteracao`) VALUES
	(9, 2, 'asdasd', 'blog/blog1653149514.png', 'asdasd', 1, '2022-05-21 13:11:54', '2022-05-21 13:11:54', NULL, 1, NULL),
	(10, 2, 'asda', 'blog/blog1653149555.png', 'asdas', 1, '2022-05-21 13:12:35', '2022-05-21 13:12:35', NULL, 1, NULL);

-- Copiando estrutura para tabela verik.blog_fotos
CREATE TABLE IF NOT EXISTS `blog_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_blog` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_blog_fotos_blog` (`id_blog`),
  CONSTRAINT `FK_blog_fotos_blog` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.blog_fotos: ~3 rows (aproximadamente)
INSERT INTO `blog_fotos` (`id`, `id_blog`, `nome`, `img`) VALUES
	(24, 10, 'blog.png', 'arq_blog/10/800b4e8e514e13f9e46d4db7de89f1b8.png'),
	(25, 10, 'grande.png', 'arq_blog/10/5b8eabc0025410488ec6bb1e707f7815.png'),
	(26, 10, 'thumb-1920-523521.jpg', 'arq_blog/10/2aa80524882c43f809b65d189951327a.jpg');

-- Copiando estrutura para tabela verik.categoria_blog
CREATE TABLE IF NOT EXISTS `categoria_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.categoria_blog: ~3 rows (aproximadamente)
INSERT INTO `categoria_blog` (`id`, `id_produto`, `cor`) VALUES
	(2, 0, '2022-05-21 11:41:16'),
	(3, 0, '2022-05-21 14:31:16'),
	(4, 0, '2022-05-21 14:36:28');

-- Copiando estrutura para tabela verik.categoria_pergunta
CREATE TABLE IF NOT EXISTS `categoria_pergunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `dhcadastro` datetime NOT NULL,
  `idoperador_cadastro` int(11) NOT NULL,
  `idoperador_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.categoria_pergunta: ~3 rows (aproximadamente)
INSERT INTO `categoria_pergunta` (`id`, `nome`, `dhcadastro`, `idoperador_cadastro`, `idoperador_alteracao`) VALUES
	(4, 'rasdasd', '2022-05-21 15:06:13', 1, NULL),
	(5, 'Teste', '2022-05-21 15:06:40', 1, NULL),
	(6, 'Aqui', '2022-05-21 15:37:44', 1, NULL);

-- Copiando estrutura para tabela verik.categoria_produto
CREATE TABLE IF NOT EXISTS `categoria_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `dhcadastro` datetime NOT NULL,
  `idoperador_cadastro` int(11) NOT NULL,
  `idoperador_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.categoria_produto: ~1 rows (aproximadamente)
INSERT INTO `categoria_produto` (`id`, `nome`, `dhcadastro`, `idoperador_cadastro`, `idoperador_alteracao`) VALUES
	(5, 'Categoria produto', '2022-05-22 14:51:31', 1, NULL);

-- Copiando estrutura para tabela verik.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.cliente: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela verik.configuracao
CREATE TABLE IF NOT EXISTS `configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tipo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Copiando dados para a tabela verik.configuracao: ~2 rows (aproximadamente)
INSERT INTO `configuracao` (`id`, `nome`, `email`, `tipo`, `status`) VALUES
	(3, 'Paulo Henrique', 'lucas@netsuprema.com.br', 'Fale Conosco', 1),
	(4, 'Lucas', 'lucas@netsuprema.com.br', 'Curriculum', 1);

-- Copiando estrutura para tabela verik.configuracao_produto
CREATE TABLE IF NOT EXISTS `configuracao_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exibir_valor_logado` int(11) NOT NULL,
  `idoperador_alteracao` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.configuracao_produto: ~0 rows (aproximadamente)
INSERT INTO `configuracao_produto` (`id`, `exibir_valor_logado`, `idoperador_alteracao`) VALUES
	(1, 1, 1);

-- Copiando estrutura para tabela verik.cores_produto
CREATE TABLE IF NOT EXISTS `cores_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_cores_produto_produtos` (`id_produto`),
  CONSTRAINT `FK_cores_produto_produtos` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.cores_produto: ~2 rows (aproximadamente)
INSERT INTO `cores_produto` (`id`, `id_produto`, `cor`) VALUES
	(23, 14, '#2caa84'),
	(24, 14, '#a90bd5');

-- Copiando estrutura para tabela verik.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.empresa: ~0 rows (aproximadamente)
INSERT INTO `empresa` (`id`, `titulo`, `img`, `texto`, `status`) VALUES
	(1, 'fsad', '', 'teste', 1);

-- Copiando estrutura para tabela verik.endereco_usuarios
CREATE TABLE IF NOT EXISTS `endereco_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cep` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_endereco_usuarios_usuarios_site` (`usuario_id`),
  CONSTRAINT `FK_endereco_usuarios_usuarios_site` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios_site` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.endereco_usuarios: ~1 rows (aproximadamente)
INSERT INTO `endereco_usuarios` (`id`, `usuario_id`, `cep`) VALUES
	(1, 1, '74.255-470');

-- Copiando estrutura para tabela verik.equipe
CREATE TABLE IF NOT EXISTS `equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.equipe: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela verik.formas_pagamento
CREATE TABLE IF NOT EXISTS `formas_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.formas_pagamento: ~0 rows (aproximadamente)
INSERT INTO `formas_pagamento` (`id`, `titulo`, `texto`, `imagem`) VALUES
	(1, 'Formas de pagamento', 'Dados divergentes<br />\r\nCaso ocorra alguma divergência no seu cadastro ou no pagamento a DITEC vai entrar em contato. O prazo para você ligar para uma de nossas unidades é de 2 (dois) dias úteis e se esse contato não ocorrer dentro de 4 (quatro) dias úteis, o pedido será cancelado automaticamente pelo sistema.<br />\r\n<br />\r\nPrazo para confirmar o pagamento<br />\r\nCartão de crédito: O prazo de aprovação é de até 48 horas.<br />\r\nBoleto Bancário: Após o pagamento do boleto, o banco tem o prazo de 3 (três) dias úteis para confirmar o pagamento.<br />\r\n<br />\r\nÉ possível alterar a forma de pagamento após concluir o pedido?<br />\r\nPara sua segurança, após a conclusão pedido não é possível alterar a forma de pagamento, endereço ou produtos.<br />\r\n<br />\r\nPedido não aprovado<br />\r\nOs motivos mais comuns para que um pedido não seja aprovado são:<br />\r\n<br />\r\nErro de digitação do número do cartão ou validade;<br />\r\nDados divergentes;<br />\r\nSaldo de crédito inferior à compra realizada.<br />\r\n<br />\r\nÉ possível pagar uma parte no boleto e outra no cartão?<br />\r\nNão é possível dividir o valor de um pedido em duas formas de pagamento.<br />\r\n<br />\r\nÉ possível parcelar a compra em dois cartões?<br />\r\nNão temos a opção para você fazer o pagamento com dois cartões de crédito<br />\r\n<br />\r\nFormas de pagamento disponíveis<br />\r\nCARTÃO DE DÉBITO<br />\r\nCARTÃO DE CRÉDITO<br />\r\nBOLETO<br />\r\nCartão de Débito<br />\r\nA confirmação do pagamento ocorre até 48 horas para confirmação de pagamento, decorrente da verificação de autenticidade do usuário.<br />\r\n<br />\r\nCartão de Crédito<br />\r\nA confirmação do pagamento ocorre até 48 horas para confirmação de pagamento, decorrente da verificação de autenticidade do usuário.<br />\r\n<br />\r\nBoleto bancário<br />\r\nA confirmação ocorre até 3 três dias úteis contados partir da data de pagamento do boleto.<br />\r\n<br />\r\nPara mais informações sobre Trocas e Devoluções,&nbsp;CLIQUE AQUI.', 'politica_cookies/politicaCookie1653159476.png');

-- Copiando estrutura para tabela verik.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `acao` varchar(50) DEFAULT NULL,
  `datahora` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.logs: ~302 rows (aproximadamente)
INSERT INTO `logs` (`id`, `usuario`, `area`, `id_area`, `acao`, `datahora`, `ip`) VALUES
	(192, 'Administrador', 'usuários', 1, 'saiu', '2014-08-28 08:42:23', '192.168.7.36'),
	(193, 'Paulo', 'usuários', 2, 'entrou', '2014-08-28 08:47:01', '192.168.7.36'),
	(194, 'Paulo', 'usuários', 2, 'alterou', '2014-08-28 08:55:56', '192.168.7.36'),
	(195, 'Paulo', 'usuários', 2, 'alterou', '2014-08-28 09:20:27', '192.168.7.36'),
	(196, 'Paulo', 'usuários', 2, 'saiu', '2014-08-28 09:28:03', '192.168.7.36'),
	(197, 'Administrador', 'usuários', 1, 'entrou', '2014-08-29 13:09:46', '192.168.7.36'),
	(198, 'Administrador', 'usuários', 1, 'entrou', '2014-08-29 13:10:05', '192.168.7.36'),
	(199, 'Administrador', 'usuários', 1, 'entrou', '2014-09-03 17:07:01', '192.168.7.126'),
	(200, 'Administrador', 'usuários', 2, 'deletou', '2014-09-03 17:07:17', '192.168.7.126'),
	(201, 'Administrador', 'usuários', 1, 'alterou senha', '2014-09-03 17:07:49', '192.168.7.126'),
	(202, 'Administrador', 'usuários', 1, 'alterou senha', '2014-09-03 17:07:54', '192.168.7.126'),
	(203, 'Administrador', 'usuários', 1, 'alterou', '2014-09-03 17:07:54', '192.168.7.126'),
	(204, 'Administrador', 'Módulo', 1, 'Cadastrou', '2014-09-03 17:11:24', '192.168.7.126'),
	(205, 'Administrador', 'usuários', 1, 'alterou senha', '2014-09-03 17:11:48', '192.168.7.126'),
	(206, 'Administrador', 'usuários', 1, 'alterou', '2014-09-03 17:11:48', '192.168.7.126'),
	(207, 'Administrador', 'usuários', 1, 'entrou', '2014-09-04 15:26:01', '192.168.7.126'),
	(208, 'Administrador', 'usuários', 1, 'entrou', '2014-09-05 09:52:52', '192.168.7.126'),
	(209, 'Administrador', 'Configuração', 1, 'Alterou', '2014-09-05 09:53:13', '192.168.7.126'),
	(210, 'Administrador', 'Configuração', 1, 'Cadastrou', '2014-09-05 09:57:40', '192.168.7.126'),
	(211, 'Administrador', 'usuários', 1, 'entrou', '2014-09-05 14:22:28', '192.168.7.36'),
	(212, 'Administrador', 'Módulo', 1, 'Deletou', '2014-09-05 14:22:50', '192.168.7.36'),
	(213, 'Administrador', 'usuários', 3, 'deletou', '2014-09-05 14:27:01', '192.168.7.36'),
	(214, 'Administrador', 'usuários', 4, 'deletou', '2014-09-05 14:29:12', '192.168.7.36'),
	(215, 'Administrador', 'usuários', 1, 'saiu', '2014-09-05 15:29:56', '192.168.7.36'),
	(216, 'Administrador', 'usuários', 1, 'entrou', '2014-09-19 15:14:52', '192.168.7.36'),
	(217, 'Administrador', 'usuários', 1, 'entrou', '2014-12-30 16:22:37', '192.168.7.36'),
	(218, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 11:58:14', '192.168.7.36'),
	(219, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:22:51', '192.168.7.36'),
	(220, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:23:15', '192.168.7.36'),
	(221, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:34:47', '192.168.7.36'),
	(222, 'Administrador', 'usuários', 1, 'entrou', '2015-01-05 16:35:44', '192.168.7.36'),
	(223, 'Administrador', 'usuários', 1, 'entrou', '2015-01-06 08:01:15', '192.168.7.36'),
	(224, 'Administrador', 'usuários', 1, 'entrou', '2015-01-08 09:30:22', '192.168.7.36'),
	(225, 'Administrador', 'usuários', 1, 'entrou', '2015-01-09 12:40:53', '192.168.7.36'),
	(226, 'Administrador', 'usuários', 1, 'entrou', '2015-01-12 08:42:45', '192.168.7.36'),
	(227, 'Administrador', 'usuários', 1, 'alterou', '2015-01-12 08:45:45', '192.168.7.36'),
	(228, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 11:39:55', '192.168.7.36'),
	(229, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 11:43:18', '192.168.7.36'),
	(230, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 11:46:51', '192.168.7.36'),
	(231, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 12:36:37', '192.168.7.36'),
	(232, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 12:37:16', '192.168.7.36'),
	(233, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 12:38:52', '192.168.7.36'),
	(234, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 12:39:12', '192.168.7.36'),
	(235, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:08:56', '192.168.7.36'),
	(236, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 13:09:21', '192.168.7.36'),
	(237, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:09:46', '192.168.7.36'),
	(238, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:09:47', '192.168.7.36'),
	(239, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:10:46', '192.168.7.36'),
	(240, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:10:47', '192.168.7.36'),
	(241, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:12:05', '192.168.7.36'),
	(242, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:12:06', '192.168.7.36'),
	(243, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:12:41', '192.168.7.36'),
	(244, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:12:42', '192.168.7.36'),
	(245, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:13:12', '192.168.7.36'),
	(246, 'Administrador', 'Conta de Email', 1, 'Alterou a Senha', '2015-01-12 13:13:13', '192.168.7.36'),
	(247, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 13:14:04', '192.168.7.36'),
	(248, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 13:14:59', '192.168.7.36'),
	(249, 'Administrador', 'Email', 1, 'Deletou', '2015-01-12 13:15:14', '192.168.7.36'),
	(250, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:17:47', '192.168.7.36'),
	(251, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:18:17', '192.168.7.36'),
	(252, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:22:25', '192.168.7.36'),
	(253, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:22:36', '192.168.7.36'),
	(254, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:23:52', '192.168.7.36'),
	(255, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-12 13:37:17', '192.168.7.36'),
	(256, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 14:59:08', '192.168.7.36'),
	(257, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 14:59:36', '192.168.7.36'),
	(258, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 15:03:08', '192.168.7.36'),
	(259, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 15:05:20', '192.168.7.36'),
	(260, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 15:13:42', '192.168.7.36'),
	(261, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:03:34', '192.168.7.36'),
	(262, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:03:37', '192.168.7.36'),
	(263, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:04:49', '192.168.7.36'),
	(264, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:04:51', '192.168.7.36'),
	(265, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:06:57', '192.168.7.36'),
	(266, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:06:59', '192.168.7.36'),
	(267, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:12:21', '192.168.7.36'),
	(268, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:12:24', '192.168.7.36'),
	(269, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:16:58', '192.168.7.36'),
	(270, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:24:32', '192.168.7.36'),
	(271, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:24:43', '192.168.7.36'),
	(272, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:24:45', '192.168.7.36'),
	(273, 'Administrador', 'FTP', 1, 'Alterou a Cota', '2015-01-12 16:25:20', '192.168.7.36'),
	(274, 'Administrador', 'FTP', 1, 'Alterou a Senha', '2015-01-12 16:25:22', '192.168.7.36'),
	(275, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:26:19', '192.168.7.36'),
	(276, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:33:54', '192.168.7.36'),
	(277, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:37:39', '192.168.7.36'),
	(278, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:38:08', '192.168.7.36'),
	(279, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:39:42', '192.168.7.36'),
	(280, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:40:06', '192.168.7.36'),
	(281, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:51:43', '192.168.7.36'),
	(282, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:55:41', '192.168.7.36'),
	(283, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:55:49', '192.168.7.36'),
	(284, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:56:24', '192.168.7.36'),
	(285, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:57:56', '192.168.7.36'),
	(286, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:58:21', '192.168.7.36'),
	(287, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 16:58:57', '192.168.7.36'),
	(288, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 16:59:17', '192.168.7.36'),
	(289, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:00:51', '192.168.7.36'),
	(290, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:02:30', '192.168.7.36'),
	(291, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:02:37', '192.168.7.36'),
	(292, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:04:16', '192.168.7.36'),
	(293, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:04:54', '192.168.7.36'),
	(294, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:05:36', '192.168.7.36'),
	(295, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:15:42', '192.168.7.36'),
	(296, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:17:02', '192.168.7.36'),
	(297, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:19:58', '192.168.7.36'),
	(298, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:20:18', '192.168.7.36'),
	(299, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:21:18', '192.168.7.36'),
	(300, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:21:43', '192.168.7.36'),
	(301, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:22:02', '192.168.7.36'),
	(302, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:23:37', '192.168.7.36'),
	(303, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:28:15', '192.168.7.36'),
	(304, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:28:24', '192.168.7.36'),
	(305, 'Administrador', 'Conta de Email', 1, 'Cadastrou', '2015-01-12 17:29:34', '192.168.7.36'),
	(306, 'Administrador', 'Ftp', 1, 'Deletou', '2015-01-12 17:29:47', '192.168.7.36'),
	(307, 'Administrador', 'usuários', 1, 'entrou', '2015-01-13 10:31:52', '192.168.7.36'),
	(308, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-01-13 11:52:22', '192.168.7.36'),
	(309, 'Administrador', 'usuários', 1, 'alterou', '2015-01-13 11:52:37', '192.168.7.36'),
	(310, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-01-13 14:44:06', '192.168.7.36'),
	(311, 'Administrador', 'usuários', 1, 'alterou', '2015-01-13 14:44:40', '192.168.7.36'),
	(312, 'Administrador', 'Email', 1, 'Deletou', '2015-01-13 15:18:30', '192.168.7.36'),
	(313, 'Administrador', 'Conta de Email', 1, 'Alterou a Cota', '2015-01-13 15:20:49', '192.168.7.36'),
	(314, 'Administrador', 'usuários', 1, 'entrou', '2015-01-13 17:07:17', '192.168.7.36'),
	(315, 'Administrador', 'usuários', 1, 'entrou', '2015-01-13 17:34:24', '192.168.7.36'),
	(316, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 08:08:37', '192.168.7.36'),
	(317, 'Administrador', 'usuários', 1, 'saiu', '2015-01-14 08:35:48', '192.168.7.36'),
	(318, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 08:37:37', '192.168.7.36'),
	(319, 'Administrador', 'usuários', 1, 'saiu', '2015-01-14 08:42:02', '192.168.7.36'),
	(320, '0', 'usuários', 0, 'saiu', '2015-01-14 08:43:24', '192.168.7.36'),
	(321, '0', 'usuários', 0, 'saiu', '2015-01-14 08:43:51', '192.168.7.36'),
	(322, '0', 'usuários', 0, 'saiu', '2015-01-14 08:45:41', '192.168.7.36'),
	(323, '0', 'usuários', 0, 'saiu', '2015-01-14 08:45:51', '192.168.7.36'),
	(324, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 08:47:37', '192.168.7.36'),
	(325, 'Administrador', 'usuários', 1, 'saiu', '2015-01-14 09:14:08', '192.168.7.36'),
	(326, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:14:25', '192.168.7.36'),
	(327, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:36:40', '192.168.7.36'),
	(328, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:37:57', '192.168.7.36'),
	(329, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:41:33', '192.168.7.36'),
	(330, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 09:58:19', '192.168.7.36'),
	(331, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:00:27', '192.168.7.36'),
	(332, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:02:34', '192.168.7.36'),
	(333, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:03:30', '192.168.7.36'),
	(334, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:04:51', '192.168.7.36'),
	(335, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 10:07:29', '192.168.7.36'),
	(336, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 15:31:54', '192.168.7.36'),
	(337, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 15:37:35', '192.168.7.36'),
	(338, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 16:55:56', '192.168.7.36'),
	(339, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 17:10:05', '192.168.7.36'),
	(340, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 17:14:43', '192.168.7.36'),
	(341, 'Administrador', 'usuários', 1, 'entrou', '2015-01-14 17:18:44', '192.168.7.36'),
	(342, 'Administrador', 'usuários', 1, 'entrou', '2015-01-15 08:07:00', '192.168.7.36'),
	(343, 'Administrador', 'usuários', 1, 'entrou', '2015-01-15 08:08:33', '192.168.7.36'),
	(344, 'Administrador', 'usuários', 1, 'entrou', '2015-02-19 08:44:28', '192.168.7.36'),
	(345, 'Administrador', 'usuários', 1, 'entrou', '2015-02-19 08:44:33', '192.168.7.36'),
	(346, 'Administrador', 'usuários', 1, 'entrou', '2015-02-19 08:44:45', '192.168.7.36'),
	(347, 'Administrador', 'usuários', 1, 'saiu', '2015-02-19 08:55:42', '192.168.7.36'),
	(348, 'Administrador', 'usuários', 1, 'entrou', '2015-02-25 15:05:33', '192.168.7.36'),
	(349, 'Administrador', 'usuários', 1, 'entrou', '2015-02-25 17:10:00', '192.168.7.36'),
	(350, 'Administrador', 'Empresa', 1, 'Alterou', '2015-02-25 17:18:55', '192.168.7.36'),
	(351, 'Administrador', 'usuários', 1, 'entrou', '2015-03-05 13:27:40', '192.168.7.36'),
	(352, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:09:51', '192.168.7.36'),
	(353, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:12:52', '192.168.7.36'),
	(354, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:19:00', '192.168.7.36'),
	(355, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:22:40', '192.168.7.36'),
	(356, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:26:51', '192.168.7.36'),
	(357, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:27:18', '192.168.7.36'),
	(358, 'Administrador', 'Categoria', 1, 'Cadastrou', '2015-03-05 14:27:34', '192.168.7.36'),
	(359, 'Administrador', 'Categoria', 1, 'Deletou', '2015-03-05 14:27:39', '192.168.7.36'),
	(360, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:28:38', '192.168.7.36'),
	(361, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:29:08', '192.168.7.36'),
	(362, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:37:20', '192.168.7.36'),
	(363, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:37:54', '192.168.7.36'),
	(364, 'Administrador', 'Módulo', 1, 'Cadastrou', '2015-03-05 14:44:13', '192.168.7.36'),
	(365, 'Administrador', 'usuários', 1, 'alterou', '2015-03-05 14:44:39', '192.168.7.36'),
	(366, 'Administrador', 'usu?rios', 1, 'entrou', '2022-05-21 08:44:41', '::1'),
	(367, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 08:49:10', '::1'),
	(368, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 08:49:24', '::1'),
	(369, 'Administrador', 'M?dulo', 1, 'Alterou', '2022-05-21 08:51:43', '::1'),
	(370, 'Administrador', 'M?dulo', 1, 'Alterou', '2022-05-21 08:52:52', '::1'),
	(371, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 08:55:37', '::1'),
	(372, 'Administrador', 'usu?rios', 1, 'entrou', '2022-05-21 09:05:21', '::1'),
	(373, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 09:14:19', '::1'),
	(374, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 09:18:01', '::1'),
	(375, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 09:43:24', '::1'),
	(376, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 09:46:09', '::1'),
	(377, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 09:46:39', '::1'),
	(378, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 09:56:46', '::1'),
	(379, 'Administrador', 'usu?rios', 1, 'entrou', '2022-05-21 10:02:17', '::1'),
	(380, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:11:35', '::1'),
	(381, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:11:41', '::1'),
	(382, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:14:44', '::1'),
	(383, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:23:34', '::1'),
	(384, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:25:30', '::1'),
	(385, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:27:40', '::1'),
	(386, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:32:54', '::1'),
	(387, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:33:02', '::1'),
	(388, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:33:32', '::1'),
	(389, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:35:09', '::1'),
	(390, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:35:19', '::1'),
	(391, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:35:46', '::1'),
	(392, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:36:52', '::1'),
	(393, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:41:32', '::1'),
	(394, 'Administrador', 'sobrenos', 1, 'Alterou', '2022-05-21 10:41:39', '::1'),
	(395, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 10:44:01', '::1'),
	(396, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 10:44:12', '::1'),
	(397, 'Administrador', 'termo', 1, 'Alterou', '2022-05-21 10:45:13', '::1'),
	(398, 'Administrador', 'termo', 1, 'Alterou', '2022-05-21 10:46:25', '::1'),
	(399, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 10:48:59', '::1'),
	(400, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 10:49:14', '::1'),
	(401, 'Administrador', 'Politica', 1, 'Alterou', '2022-05-21 10:52:26', '::1'),
	(402, 'Administrador', 'Politica', 1, 'Alterou', '2022-05-21 10:52:48', '::1'),
	(403, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 10:58:18', '::1'),
	(404, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 10:58:30', '::1'),
	(405, 'Administrador', 'politicacookies', 1, 'Alterou', '2022-05-21 11:00:54', '::1'),
	(406, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 11:03:47', '::1'),
	(407, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 11:03:58', '::1'),
	(408, 'Administrador', 'trocasdevolucoes', 1, 'Alterou', '2022-05-21 11:07:08', '::1'),
	(409, 'Administrador', 'M?dulo', 1, 'Deletou', '2022-05-21 11:27:03', '::1'),
	(410, 'Administrador', 'M?dulo', 1, 'Deletou', '2022-05-21 11:27:09', '::1'),
	(411, 'Administrador', 'M?dulo', 1, 'Deletou', '2022-05-21 11:27:13', '::1'),
	(412, 'Administrador', 'M?dulo', 1, 'Deletou', '2022-05-21 11:27:18', '::1'),
	(413, 'Administrador', 'M?dulo', 1, 'Deletou', '2022-05-21 11:27:25', '::1'),
	(414, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 11:29:15', '::1'),
	(415, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 11:29:24', '::1'),
	(416, 'Administrador', 'Categoria', 1, 'Cadastrou', '2022-05-21 11:41:16', '::1'),
	(417, 'Administrador', 'Categoria', 1, 'Deletou', '2022-05-21 11:41:21', '::1'),
	(418, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 11:44:36', '::1'),
	(419, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 11:44:49', '::1'),
	(420, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 12:07:34', '::1'),
	(421, 'Administrador', 'Blog', 1, 'Publicou', '2022-05-21 12:08:34', '::1'),
	(422, 'Administrador', 'Blog', 1, 'Publicou', '2022-05-21 12:08:36', '::1'),
	(423, 'Administrador', 'Blog', 1, 'Alterou', '2022-05-21 12:24:54', '::1'),
	(424, 'Administrador', 'Blog', 1, 'Alterou', '2022-05-21 12:25:26', '::1'),
	(425, 'Administrador', 'Blog', 1, 'Alterou', '2022-05-21 12:25:48', '::1'),
	(426, 'Administrador', 'Blog', 1, 'Alterou', '2022-05-21 12:25:54', '::1'),
	(427, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 12:26:23', '::1'),
	(428, 'Administrador', 'Blog', 1, 'Alterou', '2022-05-21 12:28:51', '::1'),
	(429, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 12:40:29', '::1'),
	(430, 'Administrador', 'Blog', 1, 'Alterou', '2022-05-21 12:59:51', '::1'),
	(431, 'Administrador', 'Blog', 6, 'deletou fotos', '2022-05-21 13:00:04', '::1'),
	(432, 'Administrador', 'Blog', 7, 'deletou fotos', '2022-05-21 13:00:05', '::1'),
	(433, 'Administrador', 'Blog', 11, 'deletou fotos', '2022-05-21 13:00:07', '::1'),
	(434, 'Administrador', 'Blog', 1, 'Alterou', '2022-05-21 13:00:33', '::1'),
	(435, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 13:01:52', '::1'),
	(436, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 13:03:27', '::1'),
	(437, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 13:04:43', '::1'),
	(438, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 13:10:52', '::1'),
	(439, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 13:11:54', '::1'),
	(440, 'Administrador', 'Blog', 1, 'Cadastrou', '2022-05-21 13:12:35', '::1'),
	(441, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 14:28:02', '::1'),
	(442, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 14:28:12', '::1'),
	(443, 'Administrador', 'Categoria', 1, 'Cadastrou', '2022-05-21 14:31:16', '::1'),
	(444, 'Administrador', 'Categoria', 1, 'Cadastrou', '2022-05-21 14:32:25', '::1'),
	(445, 'Administrador', 'Categoria', 1, 'Alterou', '2022-05-21 14:35:39', '::1'),
	(446, 'Administrador', 'Categoria', 1, 'Alterou', '2022-05-21 14:35:44', '::1'),
	(447, 'Administrador', 'Categoria', 1, 'Cadastrou', '2022-05-21 14:36:28', '::1'),
	(448, 'Administrador', 'Categoria', 1, 'Alterou', '2022-05-21 14:36:35', '::1'),
	(449, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 14:51:55', '::1'),
	(450, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 14:52:08', '::1'),
	(451, 'Administrador', 'Categoria', 1, 'Cadastrou', '2022-05-21 15:06:13', '::1'),
	(452, 'Administrador', 'Categoria', 1, 'Cadastrou', '2022-05-21 15:06:40', '::1'),
	(453, 'Administrador', 'Pergunta', 1, 'Cadastrou', '2022-05-21 15:19:38', '::1'),
	(454, 'Administrador', 'Pergunta', 1, 'Deletou', '2022-05-21 15:24:17', '::1'),
	(455, 'Administrador', 'Pergunta', 1, 'Cadastrou', '2022-05-21 15:24:34', '::1'),
	(456, 'Administrador', 'Categoria', 1, 'Cadastrou', '2022-05-21 15:37:44', '::1'),
	(457, 'Administrador', 'Pergunta', 1, 'Alterou', '2022-05-21 15:42:57', '::1'),
	(458, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 15:55:25', '::1'),
	(459, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 15:55:37', '::1'),
	(460, 'Administrador', 'M?dulo', 1, 'Alterou', '2022-05-21 15:57:27', '::1'),
	(461, 'Administrador', 'M?dulo', 1, 'Alterou', '2022-05-21 15:57:27', '::1'),
	(462, 'Administrador', 'Formas Pagamento', 1, 'Alterou', '2022-05-21 15:57:56', '::1'),
	(463, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-21 16:18:04', '::1'),
	(464, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-21 16:18:15', '::1'),
	(465, 'Administrador', 'usu?rios', 1, 'entrou', '2022-05-22 13:28:06', '::1'),
	(466, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-22 14:50:56', '::1'),
	(467, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-22 14:51:06', '::1'),
	(468, 'Administrador', 'CategoriaProduto', 1, 'Cadastrou', '2022-05-22 14:51:31', '::1'),
	(469, 'Administrador', 'Produto', 1, 'Cadastrou', '2022-05-22 15:35:21', '::1'),
	(470, 'Administrador', 'Produto', 1, 'Cadastrou', '2022-05-22 15:36:49', '::1'),
	(471, 'Administrador', 'Produto', 1, 'Cadastrou', '2022-05-22 15:55:44', '::1'),
	(472, 'Administrador', 'Produto', 1, 'Cadastrou', '2022-05-22 15:57:02', '::1'),
	(473, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 17:15:29', '::1'),
	(474, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 17:16:31', '::1'),
	(475, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 17:20:29', '::1'),
	(476, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 17:58:19', '::1'),
	(477, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:05:21', '::1'),
	(478, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:07:48', '::1'),
	(479, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:08:02', '::1'),
	(480, 'Administrador', 'Produto', 1, 'Cadastrou', '2022-05-22 18:27:22', '::1'),
	(481, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:29:04', '::1'),
	(482, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:29:15', '::1'),
	(483, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:31:15', '::1'),
	(484, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:31:50', '::1'),
	(485, 'Administrador', 'Produto', 35, 'deletou fotos', '2022-05-22 18:36:35', '::1'),
	(486, 'Administrador', 'Produto', 34, 'deletou fotos', '2022-05-22 18:36:42', '::1'),
	(487, 'Administrador', 'Produto', 1, 'Alterou', '2022-05-22 18:36:51', '::1'),
	(488, 'Administrador', 'Produto', 1, 'Deletou', '2022-05-22 18:36:58', '::1'),
	(489, 'Administrador', 'Produto', 1, 'Cadastrou', '2022-05-22 18:37:55', '::1'),
	(490, 'Administrador', 'Produto', 1, 'Deletou', '2022-05-22 18:40:13', '::1'),
	(491, 'Administrador', 'politicacookies', 1, 'Alterou', '2022-05-22 18:52:52', '::1'),
	(492, 'Administrador', 'Banner', 1, 'Alterou', '2022-05-22 19:04:17', '::1'),
	(493, 'Administrador', 'Banner', 1, 'Cadastrou', '2022-05-22 19:05:05', '::1'),
	(494, 'Administrador', 'Banner', 1, 'Deletou', '2022-05-22 19:06:03', '::1'),
	(495, 'Administrador', 'Banner', 1, 'Cadastrou', '2022-05-22 19:06:20', '::1'),
	(496, 'Administrador', 'Banner', 1, 'Alterou', '2022-05-22 19:06:26', '::1'),
	(497, 'Administrador', 'Banner', 1, 'Cadastrou', '2022-05-22 19:10:02', '::1'),
	(498, 'Administrador', 'Banner', 1, 'Alterou', '2022-05-22 19:10:11', '::1'),
	(499, 'Administrador', 'Banner', 1, 'Cadastrou', '2022-05-22 19:10:39', '::1'),
	(500, 'Administrador', 'Banner', 1, 'Alterou', '2022-05-22 19:10:44', '::1'),
	(501, 'Administrador', 'Banner', 1, 'Deletou', '2022-05-22 19:10:48', '::1'),
	(502, 'Administrador', 'Banner', 1, 'Deletou', '2022-05-22 19:10:50', '::1'),
	(503, 'Administrador', 'M?dulo', 1, 'Cadastrou', '2022-05-22 19:18:53', '::1'),
	(504, 'Administrador', 'usu?rios', 1, 'alterou', '2022-05-22 19:19:03', '::1'),
	(505, 'Administrador', 'configuracaoproduto', 1, 'Alterou', '2022-05-22 19:22:50', '::1'),
	(506, 'Administrador', 'configuracaoproduto', 1, 'Alterou', '2022-05-22 19:25:30', '::1'),
	(507, 'Administrador', 'configuracaoproduto', 1, 'Alterou', '2022-05-22 19:27:06', '::1'),
	(508, 'Administrador', 'configuracaoproduto', 1, 'Alterou', '2022-05-22 19:27:21', '::1'),
	(509, 'Administrador', 'configuracaoproduto', 1, 'Alterou', '2022-05-22 19:27:25', '::1'),
	(510, 'Administrador', 'usu?rios', 1, 'entrou', '2022-05-24 11:25:58', '::1'),
	(511, 'Administrador', 'usu?rios', 1, 'entrou', '2022-05-28 10:44:55', '::1');

-- Copiando estrutura para tabela verik.perguntas
CREATE TABLE IF NOT EXISTS `perguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria_pergunta` int(11) NOT NULL,
  `pergunta` varchar(255) NOT NULL,
  `resposta` text NOT NULL,
  `status` int(11) NOT NULL,
  `dhcadastro` datetime NOT NULL,
  `data_inicio_exibicao` datetime NOT NULL,
  `data_expiracao` datetime DEFAULT NULL,
  `idoperador_cadastro` int(11) NOT NULL,
  `idoperador_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_perguntas_categoria_pergunta` (`id_categoria_pergunta`),
  CONSTRAINT `FK_perguntas_categoria_pergunta` FOREIGN KEY (`id_categoria_pergunta`) REFERENCES `categoria_pergunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.perguntas: ~2 rows (aproximadamente)
INSERT INTO `perguntas` (`id`, `id_categoria_pergunta`, `pergunta`, `resposta`, `status`, `dhcadastro`, `data_inicio_exibicao`, `data_expiracao`, `idoperador_cadastro`, `idoperador_alteracao`) VALUES
	(8, 4, 'asdas', 'asdasd', 1, '2022-05-21 15:19:38', '2022-05-21 15:19:38', NULL, 1, NULL),
	(9, 6, 'asdas 2', 'asdasd 2', 1, '2022-05-21 15:24:00', '2022-05-21 15:24:00', NULL, 1, 1);

-- Copiando estrutura para tabela verik.permissao_secao_fixa
CREATE TABLE IF NOT EXISTS `permissao_secao_fixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secao_fixa_id` int(11) NOT NULL DEFAULT 0,
  `usuarios_id` int(11) NOT NULL,
  `cadastrar` int(1) NOT NULL DEFAULT 0,
  `alterar` int(1) NOT NULL DEFAULT 0,
  `excluir` int(1) NOT NULL DEFAULT 0,
  `publicar` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `permissao_secao_fixa_FKIndex1` (`usuarios_id`),
  KEY `permissao_secao_fixa_FKIndex2` (`secao_fixa_id`),
  CONSTRAINT `permissao_secao_fixa_ibfk_1` FOREIGN KEY (`secao_fixa_id`) REFERENCES `secao_fixa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permissao_secao_fixa_ibfk_2` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.permissao_secao_fixa: ~17 rows (aproximadamente)
INSERT INTO `permissao_secao_fixa` (`id`, `secao_fixa_id`, `usuarios_id`, `cadastrar`, `alterar`, `excluir`, `publicar`) VALUES
	(227, 1, 1, 1, 1, 1, 1),
	(228, 2, 1, 1, 1, 1, 1),
	(229, 3, 1, 1, 1, 1, 1),
	(230, 4, 1, 1, 1, 1, 1),
	(231, 10, 1, 1, 1, 1, 1),
	(232, 11, 1, 1, 1, 1, 1),
	(233, 12, 1, 1, 1, 1, 1),
	(234, 13, 1, 1, 1, 1, 1),
	(235, 14, 1, 1, 1, 1, 1),
	(236, 15, 1, 1, 1, 1, 1),
	(237, 16, 1, 1, 1, 1, 1),
	(238, 17, 1, 1, 1, 1, 1),
	(239, 18, 1, 1, 1, 1, 1),
	(240, 19, 1, 1, 1, 1, 1),
	(241, 20, 1, 1, 1, 1, 1),
	(242, 21, 1, 1, 1, 1, 1),
	(243, 22, 1, 1, 1, 1, 1);

-- Copiando estrutura para tabela verik.politica
CREATE TABLE IF NOT EXISTS `politica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.politica: ~0 rows (aproximadamente)
INSERT INTO `politica` (`id`, `titulo`, `texto`, `imagem`) VALUES
	(1, 'Política de Privacidade', 'Somos comprometidos com a privacidade e segurança dos dados e informações dos usuários, e tomamos todas as medidas necessárias em atendimento à legislação em vigor. Por sabermos da importância da segurança e privacidade nós armazenamos sobre sigilo total.<br />\r\n<br />\r\nNos comprometemos em não disponibilizarmos (alugar, facilitar e ou compartilhar, permitir acesso, vender, trocar, etc.) os dados pessoais dos nossos clientes a terceiros que não estejam integrados em nossas operações comerciais, destacamos como integradas na plataforma, as empresas processadoras de pagamentos (instituições bancárias, administradoras de cartão de crédito) e transportadoras (utilizando esta os dados de identificação e endereço de entrega).<br />\r\n<br />\r\nTodos os nossos parceiros comerciais são obrigados a firmar por meio de contratos de confidencialidade, a não divulgar, compartilhar, arquivar, armazenar, compilar, copiar, reproduzir tais dados, seja de modo escrito, digital, ou qualquer outro que seja, e com quem quer que seja.<br />\r\n<br />\r\nSe necessário a divulgação dos dados pessoais do nosso cliente, tal fato ocorrera única e exclusivamente com a autorização expressa do proprietário, com ressalva por meio de uma determinação judicial. Em caso de solicitação judicial, disponibilizamos apenas os dados necessários para cumprir a determinação judicial, os demais dados não requeridos seguiram em absoluto sigilo.<br />\r\n<br />\r\nPara auxiliar-nos na privacidade e segurança dos dados pessoais, solicitamos aos nossos clientes que utilizem:<br />\r\n<br />\r\nSenha com combinação de letras, números e símbolos;<br />\r\nNão utilizar palavras comuns ou nomes nas senhas;<br />\r\nUtilize uma senha exclusiva para acessar nossa loja;<br />\r\n<br />\r\nNão fornecer a terceiros acesso a conta pessoal, caso ocorra compra, ou má utilização dos dados, fica sobre a responsabilidade do proprietário da conta, não nos responsabilizamos por tais fatos decorrentes destas atitudes.', '');

-- Copiando estrutura para tabela verik.politica_cookies
CREATE TABLE IF NOT EXISTS `politica_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.politica_cookies: ~0 rows (aproximadamente)
INSERT INTO `politica_cookies` (`id`, `titulo`, `texto`, `imagem`) VALUES
	(1, 'Política de cookies', 'Somos comprometidos com a privacidade e segurança dos dados e informações dos usuários, e tomamos todas as medidas necessárias em atendimento à legislação em vigor. Por sabermos da importância da segurança e privacidade nós armazenamos sobre sigilo total.<br />\r\n<br />\r\nNos comprometemos em não disponibilizarmos (alugar, facilitar e ou compartilhar, permitir acesso, vender, trocar, etc.) os dados pessoais dos nossos clientes a terceiros que não estejam integrados em nossas operações comerciais, destacamos como integradas na plataforma, as empresas processadoras de pagamentos (instituições bancárias, administradoras de cartão de crédito) e transportadoras (utilizando esta os dados de identificação e endereço de entrega).<br />\r\n<br />\r\nTodos os nossos parceiros comerciais são obrigados a firmar por meio de contratos de confidencialidade, a não divulgar, compartilhar, arquivar, armazenar, compilar, copiar, reproduzir tais dados, seja de modo escrito, digital, ou qualquer outro que seja, e com quem quer que seja.<br />\r\n<br />\r\nSe necessário a divulgação dos dados pessoais do nosso cliente, tal fato ocorrera única e exclusivamente com a autorização expressa do proprietário, com ressalva por meio de uma determinação judicial. Em caso de solicitação judicial, disponibilizamos apenas os dados necessários para cumprir a determinação judicial, os demais dados não requeridos seguiram em absoluto sigilo.<br />\r\n<br />\r\nPara auxiliar-nos na privacidade e segurança dos dados pessoais, solicitamos aos nossos clientes que utilizem:<br />\r\n<br />\r\nSenha com combinação de letras, números e símbolos;<br />\r\nNão utilizar palavras comuns ou nomes nas senhas;<br />\r\nUtilize uma senha exclusiva para acessar nossa loja;<br />\r\n<br />\r\nNão fornecer a terceiros acesso a conta pessoal, caso ocorra compra, ou má utilização dos dados, fica sobre a responsabilidade do proprietário da conta, não nos responsabilizamos por tais fatos decorrentes destas atitudes.', 'politica_cookies/politicaCookie1653256372.png');

-- Copiando estrutura para tabela verik.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria_produto` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `codigo_produto` varchar(255) DEFAULT NULL,
  `referencia_produto` varchar(255) DEFAULT NULL,
  `codigo_barras` varchar(255) DEFAULT NULL,
  `peso` varchar(255) DEFAULT NULL,
  `fabricante` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `informacao_adicional` varchar(255) DEFAULT NULL,
  `quantidade_estoque` int(11) NOT NULL DEFAULT 0,
  `preco_custo` decimal(10,2) DEFAULT NULL,
  `preco_venda` decimal(10,6) NOT NULL,
  `imagem_principal` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `dhcadastro` datetime NOT NULL,
  `data_inicio_exibicao` datetime NOT NULL,
  `data_expiracao` datetime DEFAULT NULL,
  `idoperador_cadastro` int(11) NOT NULL,
  `idoperador_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_blog_categoria_blog` (`id_categoria_produto`) USING BTREE,
  CONSTRAINT `FK_produtos_categoria_produto` FOREIGN KEY (`id_categoria_produto`) REFERENCES `categoria_produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.produtos: ~2 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `id_categoria_produto`, `nome_produto`, `codigo_produto`, `referencia_produto`, `codigo_barras`, `peso`, `fabricante`, `marca`, `descricao`, `informacao_adicional`, `quantidade_estoque`, `preco_custo`, `preco_venda`, `imagem_principal`, `status`, `dhcadastro`, `data_inicio_exibicao`, `data_expiracao`, `idoperador_cadastro`, `idoperador_alteracao`) VALUES
	(13, 5, 'asdas', '', '', '', '', '', '', '', '', 23, 0.00, 9999.999999, 'produto/produto1653245744.jpg', 1, '2022-05-22 15:55:00', '2022-05-22 15:55:00', NULL, 1, 1),
	(14, 5, 'Teste', '', '', '', '', '', '', '', '', 23, 0.00, 2323.230000, 'produto/produto1653250829.jpg', 1, '2022-05-22 15:57:00', '2022-05-22 15:57:00', NULL, 1, 1);

-- Copiando estrutura para tabela verik.produto_fotos
CREATE TABLE IF NOT EXISTS `produto_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_blog_fotos_blog` (`id_produto`) USING BTREE,
  CONSTRAINT `FK_produto_fotos_produtos` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.produto_fotos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela verik.secao_fixa
CREATE TABLE IF NOT EXISTS `secao_fixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `menu` varchar(255) NOT NULL,
  `ctrl` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `ativar` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.secao_fixa: ~15 rows (aproximadamente)
INSERT INTO `secao_fixa` (`id`, `titulo`, `menu`, `ctrl`, `img`, `ordem`, `ativar`) VALUES
	(1, 'Usuários', 'Usuários', '../usuarios/ctrlUsuarios.php', 'images/icons/todos/adminUser.png', 0, 1),
	(2, 'email', 'Emails', '../ctrlEmail.php', 'images/icons/todos/mail.png', 0, 1),
	(3, 'empresa', 'Empresa', '../ctrlEmpresa.php', 'images/icons/todos/expose.png', 0, 1),
	(4, 'banner', 'Banners', '../ctrlBanner.php', 'images/icons/todos/application-split-tile.png', 0, 1),
	(10, 'sobrenos', 'Sobre Nós', '../ctrlSobreNos.php', 'images/icons/todos/doc.png', 0, 1),
	(11, 'termo', 'Termo de Uso', '../ctrlTermo.php', 'images/icons/todos/doc.png', 0, 1),
	(12, 'politica', 'Política de privacidade', '../ctrlPolitica.php', 'images/icons/todos/doc.png', 0, 1),
	(13, 'politicacookies', 'Política Cookies', '../ctrlPoliticaCookies.php', 'images/icons/todos/doc.png', 0, 1),
	(14, 'trocasdevolucoes', 'Trocas e Devoluções', '../ctrlTrocasDevolucoes.php', 'images/icons/todos/doc.png', 0, 1),
	(15, 'categoria', 'Categoria Dicas e novidades', '../ctrlCategoria.php', 'images/icons/todos/delicious.png', 0, 1),
	(16, 'blog', 'Dicas e novidades', '../ctrlBlog.php', 'images/icons/todos/create.png', 0, 1),
	(17, 'categoriapergunta', 'Categoria Perguntas Frequentes', '../ctrlCategoriaPergunta.php', 'images/icons/todos/chart4.png', 0, 1),
	(18, 'pergunta', 'Perguntas Frequentes', '../ctrlPergunta.php', 'images/icons/todos/application.png', 0, 1),
	(19, 'formaspagamento', 'Formas De pagamento', '../ctrlFormasPagamento.php', 'images/icons/todos/money.png', 0, 1),
	(20, 'produto', 'Produtos', '../ctrlProduto.php', 'images/icons/todos/dropbox.png', 0, 1),
	(21, 'categoriaproduto', 'Categoria Produto', '../ctrlCategoriaProduto.php', 'images/icons/todos/blocks.png', 0, 1),
	(22, 'configuracaoproduto', 'Configurações do produto', '../ctrlConfiguracaoProduto.php', 'images/icons/todos/expengine.png', 0, 1);

-- Copiando estrutura para tabela verik.secao_fixa_menu
CREATE TABLE IF NOT EXISTS `secao_fixa_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secao_fixa_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_secao_fixa` (`secao_fixa_id`),
  CONSTRAINT `secao_fixa_menu_ibfk_1` FOREIGN KEY (`secao_fixa_id`) REFERENCES `secao_fixa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.secao_fixa_menu: ~21 rows (aproximadamente)
INSERT INTO `secao_fixa_menu` (`id`, `secao_fixa_id`, `titulo`, `url`) VALUES
	(8, 1, 'Cadastrar', 'index.php?acao=frmCadUsuario&ctrl=usuarios'),
	(9, 1, 'Listar', 'index.php?acao=listaUsuarios&ctrl=usuarios'),
	(10, 2, 'Listar', 'index.php?acao=listar&ctrl=email'),
	(11, 3, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=empresa&id=1'),
	(12, 4, 'Cadastrar', 'index.php?acao=frmCad&ctrl=banner'),
	(13, 4, 'Listar', 'index.php?acao=listar&ctrl=banner'),
	(26, 10, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=sobrenos&id=1'),
	(27, 11, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=termo&id=1'),
	(28, 12, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=politica&id=1'),
	(29, 13, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=politicacookies&id=1'),
	(30, 14, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=trocasdevolucoes&id=1'),
	(31, 15, 'Cadastrar', 'index.php?acao=frmCad&ctrl=categoria'),
	(32, 15, 'Listar', 'index.php?acao=listar&ctrl=categoria'),
	(33, 16, 'Cadastrar', 'index.php?acao=frmCad&ctrl=blog'),
	(34, 16, 'Listar', 'index.php?acao=listar&ctrl=blog'),
	(35, 17, 'Cadastrar', 'index.php?acao=frmCad&ctrl=categoriapergunta'),
	(36, 17, 'Listar', 'index.php?acao=listar&ctrl=categoriapergunta'),
	(37, 18, 'Cadastrar', 'index.php?acao=frmCad&ctrl=pergunta'),
	(38, 18, 'Listar', 'index.php?acao=listar&ctrl=pergunta'),
	(41, 19, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=formaspagamento&id=1'),
	(42, 20, 'Cadastrar', 'index.php?acao=frmCad&ctrl=produto'),
	(43, 20, 'Listar', 'index.php?acao=listar&ctrl=produto'),
	(44, 21, 'Cadastrar', 'index.php?acao=frmCad&ctrl=categoriaproduto'),
	(45, 21, 'Listar', 'index.php?acao=listar&ctrl=categoriaproduto'),
	(46, 22, 'Listar / Alterar', 'index.php?acao=frmAlterar&ctrl=configuracaoproduto&id=1');

-- Copiando estrutura para tabela verik.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.servico: 0 rows
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;

-- Copiando estrutura para tabela verik.sobre_nos
CREATE TABLE IF NOT EXISTS `sobre_nos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `imagem_principal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.sobre_nos: ~1 rows (aproximadamente)
INSERT INTO `sobre_nos` (`id`, `titulo`, `texto`, `imagem`, `imagem_principal`) VALUES
	(1, 'Ditec agora é Verik', 'A Verik nasceu de um sonho de uma empreendedora que conhecia o segmento e via que podia fazer muito mais pelos seus clientes. Essa empreendedora teve a oportunidade de conhecer mercados internacionais e o que há de melhor no mercado nacional, agregando todo esse conhecimento criou a empresa ideal para seus clientes.<br />\r\n<br />\r\nVoltada para o mercado de distribuição a Verik, atende somente revendas, instaladores, integradores e construtoras.<br />\r\nApostamos na tecnologia e nas inovações que invadem o mercado no setor tecnológico trazendo soluções completas para Segurança Eletrônica, Comunicação, Energia, Redes, Smart Home, Provedores, Elétrica, automação, Cabeamento estruturado, Data Center, entre outros.<br />\r\n<br />\r\nHoje a Verik conta com 5 unidades no Centro-Oeste, onde todas estão sempre inovando para melhor atender seus clientes e parceiros, trazendo tecnologia, novas tendências e o mais alto grau de perfeição no atendimento, suporte ao cliente e capacitação de seus parceiros e clientes, contando com um auditório de treinamentos e palestras de alto nível.<br />\r\n<br />\r\nA Verik é uma empresa que foi pensada de fora para dentro como foco principal os seus clientes.', 'sobre_nos/sobreNos1653140499.png', 'sobre_nos/sobreNosPrincipal1653140492.png');

-- Copiando estrutura para tabela verik.termo
CREATE TABLE IF NOT EXISTS `termo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.termo: ~1 rows (aproximadamente)
INSERT INTO `termo` (`id`, `titulo`, `texto`, `imagem`) VALUES
	(1, 'Termo de uso', 'Somos comprometidos com a privacidade e segurança dos dados e informações dos usuários, e tomamos todas as medidas necessárias em atendimento à legislação em vigor. Por sabermos da importância da segurança e privacidade nós armazenamos sobre sigilo total.<br />\r\n<br />\r\nNos comprometemos em não disponibilizarmos (alugar, facilitar e ou compartilhar, permitir acesso, vender, trocar, etc.) os dados pessoais dos nossos clientes a terceiros que não estejam integrados em nossas operações comerciais, destacamos como integradas na plataforma, as empresas processadoras de pagamentos (instituições bancárias, administradoras de cartão de crédito) e transportadoras (utilizando esta os dados de identificação e endereço de entrega).<br />\r\n<br />\r\nTodos os nossos parceiros comerciais são obrigados a firmar por meio de contratos de confidencialidade, a não divulgar, compartilhar, arquivar, armazenar, compilar, copiar, reproduzir tais dados, seja de modo escrito, digital, ou qualquer outro que seja, e com quem quer que seja.<br />\r\n<br />\r\nSe necessário a divulgação dos dados pessoais do nosso cliente, tal fato ocorrera única e exclusivamente com a autorização expressa do proprietário, com ressalva por meio de uma determinação judicial. Em caso de solicitação judicial, disponibilizamos apenas os dados necessários para cumprir a determinação judicial, os demais dados não requeridos seguiram em absoluto sigilo.<br />\r\n<br />\r\nPara auxiliar-nos na privacidade e segurança dos dados pessoais, solicitamos aos nossos clientes que utilizem:<br />\r\n<br />\r\nSenha com combinação de letras, números e símbolos;<br />\r\nNão utilizar palavras comuns ou nomes nas senhas;<br />\r\nUtilize uma senha exclusiva para acessar nossa loja;<br />\r\n<br />\r\nNão fornecer a terceiros acesso a conta pessoal, caso ocorra compra, ou má utilização dos dados, fica sobre a responsabilidade do proprietário da conta, não nos responsabilizamos por tais fatos decorrentes destas atitudes.', 'termo/termo1653140785.png');

-- Copiando estrutura para tabela verik.trocas_devolucoes
CREATE TABLE IF NOT EXISTS `trocas_devolucoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.trocas_devolucoes: ~0 rows (aproximadamente)
INSERT INTO `trocas_devolucoes` (`id`, `titulo`, `texto`, `imagem`) VALUES
	(1, 'Trocas e devoluções', 'As políticas de trocas e devoluções atendem todas estas normas do Código de Defesa do Consumidor (CDC) e do Código Civil.<br />\r\nO consumidor tem direito de se arrepender da compra, devendo ser ressarcidos os valores já pagos, como respalda o Art. 40 do CDC referente as compras por telefone, internet, reembolso postal, etc.<br />\r\n<br />\r\nPrazo<br />\r\nO consumidor tem o prazo de até 7 (sete) dias para exercer o seu direito de arrependimento, dias contabilizados a partir da data de concretização da compra ou de recebimento do produto, independentemente da qualidade do mesmo.<br />\r\nO prazo para solucionar o problema é de 30 (trinta) dias, contabilizados desde a data da reclamação, e o consumidor tem um prazo de até 90 (noventa) dias da data da compra para reclamar. Artigos 18&ordm; e 26&ordm; do CDC.<br />\r\nPara que a troca ou reembolso seja efetuada de forma menos traumática, a pessoa designada para receber a entrega deve atender alguns critérios como relatado nas condições de entrega. As trocas serão realizadas apenas se o produto estiver sem uso e em embalagem original, com todos os acessórios (manual, peças do kit, etc.) e acompanhados do documento fiscal.<br />\r\n<br />\r\nReembolsos<br />\r\nReembolsos são efetuados em normalidade com o prazo de até 30 (trinta) dias contando a partir da data de recebimento como estipulado pelo Código Civil (art. 445), &ldquo;ressaltamos que o cliente deve verificar a mercadoria no ato de recebimento não estando nos conformes solicitar a devolução no mesmo momento&rdquo;.<br />\r\n<br />\r\nA troca, devolução e reembolso não serão atendidos no caso de:<br />\r\nO produto apresentar sinal de mau uso;<br />\r\nProdutos vendidos sob encomenda feita ao fabricante;<br />\r\nProdutos vendidos em promoção ou de mostruário, sendo que estes tiveram seus preços reduzidos, e o valor praticado nestes não cobrem os gastos de eventualidades, como frete de devolução;<br />\r\nProdutos vendidos a granel (fracionados como cabos, mangueiras, etc.);<br />\r\nProdutos perecíveis (como etiquetas, pilhas, etc.) vencidos após a data de recebimento (produto em mão do cliente);<br />\r\n<br />\r\nObservação: Os fabricantes recomendam que não sejam efetuadas trocas de produtos que apresentem defeitos após o recebimento, vistos que estes possuem garantia de assistência técnica definidas por eles, com data contabilizada a partir da data de emissão da nota fiscal. Nestes casos os produtos deverão ser encaminhados à assistência técnica da marca para detecção do problema e solução, caso o problema não seja sanado o fabricante substituiu o mesmo.<br />\r\nDireito de arrependimento<br />\r\nAo cliente será facultado o exercício do direito de arrependimento da compra, com a finalidade de devolução do Produto, hipótese na qual deverão ser observadas as seguintes condições<br />\r\n<br />\r\nO prazo de desistência da compra do produto é de até 7 (sete) dias corridos, a contar da data do recebimento;<br />\r\nEm caso de devolução, o produto deverá ser devolvido à DITEC na embalagem original, acompanhado do DANFE (Documento Auxiliar da Nota Fiscal Eletrônica), do manual e de todos os seus acessórios.<br />\r\nO Cliente deverá solicitar a devolução através do Serviço de Atendimento ao Cliente (SAC) ou diretamente no Painel de Controle, no tópico &quot;cancelar pedido&quot;. As despesas decorrentes de coleta ou postagem do Produto serão custeadas pela DITEC.<br />\r\nApós a chegada do produto ao Centro de Distribuição, a DITEC verificará se as condições supracitadas foram atendidas. Em caso afirmativo, providenciará a restituição no valor total da compra.<br />\r\nEm compras com cartão de crédito a administradora do cartão será notificada e o estorno ocorrerá na fatura seguinte ou na posterior, de uma só vez, seja qual for o número de parcelas utilizado na compra. O prazo de ressarcimento e, ainda, a cobrança das parcelas remanescentes após o estorno integral do valor do Produto no cartão de crédito do Cliente realizado pela DITEC, é de responsabilidade da administradora do cartão. Na hipótese de cobrança de parcelas futuras pela administradora do cartão, o Cliente não será onerado, vez que a DITEC, conforme mencionado acima, realiza o estorno do valor integral do Produto em uma única vez, sendo o crédito referente ao estorno concedido integralmente pela administradora do cartão na fatura de cobrança subsequente ao mês do cancelamento.<br />\r\nEm compras pagas com boleto bancário ou débito em conta, a restituição será efetuada por meio de depósito bancário, em até 10 (dez) dias úteis, somente na conta corrente do(a) comprador(a), que deve ser individual. É necessário que o CPF do titular da conta corrente seja o mesmo que consta no pedido (CPF do Cliente). Caso o(a) comprador(a) não tenha uma conta corrente que atenda às condições citadas, será enviada, no mesmo prazo, uma Ordem de Pagamento em nome do titular da compra. Ela poderá ser resgatada em qualquer agência dos Bancos, BB (Banco do Brasil), Itaú ou Santander, mediante apresentação de documento de identidade e CPF.<br />\r\nEm compras com vale ou com qualquer outra forma de pagamento é possível receber um Vale no mesmo valor pago na compra. Em caso de cancelamento do vale, o reembolso será realizado na mesma forma de pagamento escolhida no processo de compra que originou o mesmo.<br />\r\n<br />\r\nA DITEC isenta-se da obrigação de cancelar qualquer produto que não preencha os requisitos elencados neste dispositivo.', 'trocas_devolucoes/trocasDevolucoes1653142028.png');

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `usuario_cpanel` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `nivel` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela verik.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `usuario_cpanel`, `senha`, `email`, `img`, `status`, `nivel`) VALUES
	(1, 'Administrador', 'angela', '202cb962ac59075b964b07152d234b70', 'paulo@netsuprema.com.br', '', 1, 1);


-- Copiando estrutura para tabela verik.usuarios_site
CREATE TABLE IF NOT EXISTS `usuarios_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `tipo_pessoa` int(11) NOT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela verik.usuarios_site: ~0 rows (aproximadamente)
INSERT INTO `usuarios_site` (`id`, `nome`, `senha`, `email`, `status`, `tipo_pessoa`, `cpf`, `cnpj`) VALUES
	(1, NULL, '$2y$10$AAPfBsfQnaglnx3WVG7qX.zfGXcyij8YkNYxkM81rv3DLdGYTAbDK', 'daniel@daniel.com', 1, 1, '036.601.071-90', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
