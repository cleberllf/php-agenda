-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jul 29, 2009 as 09:47 PM
-- Versão do Servidor: 5.1.32
-- Versão do PHP: 5.2.9-1

SET AUTOCOMMIT=0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bd_agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda_contatos`
--

CREATE TABLE `agenda_contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(8) DEFAULT NULL,
  `celular` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`id`,`nome`,`celular`),
  KEY `id` (`usuario_id`,`id`,`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=578 ;

--
-- Extraindo dados da tabela `agenda_contatos`
--

INSERT INTO `agenda_contatos` (`id`, `usuario_id`, `nome`, `telefone`, `celular`) VALUES
(2, 2, 'Nome 02', 'asdasduh', 'Cel 02'),
(3, 2, 'SQLTeste', 'Telefone', 'Celular'),
(5, 1, 'Teste', '456', '789');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda_usuarios`
--

CREATE TABLE `agenda_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nivel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`id`,`nome`,`usuario`),
  UNIQUE KEY `usuario_2` (`usuario`),
  KEY `usuario` (`id`,`nivel`,`nome`,`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `agenda_usuarios`
--

INSERT INTO `agenda_usuarios` (`id`, `nome`, `usuario`, `senha`, `nivel`) VALUES
(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'Usuário Comum', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 1),
(3, 'Maiquer', 'mike', 'd356cb34e2156ab57e98f5e49366c47b', 1);

COMMIT;
