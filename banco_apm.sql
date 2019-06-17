-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 17-Jun-2019 às 22:13
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `banco_apm`
--
CREATE DATABASE IF NOT EXISTS `banco_apm` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `banco_apm`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_aluno`
--

CREATE TABLE IF NOT EXISTS `tabela_aluno` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(15) COLLATE utf8_bin NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tabela_aluno`
--

INSERT INTO `tabela_aluno` (`matricula`, `nome`, `email`, `telefone`, `data`, `valor`) VALUES
(1, 'q', 'q', '1', '2019-05-08', '1.00'),
(2, 'w', 'w', '2', '2019-05-22', '2.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_professores`
--

CREATE TABLE IF NOT EXISTS `tabela_professores` (
  `matricula` int(5) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `data` date DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tabela_professores`
--

INSERT INTO `tabela_professores` (`matricula`, `nome`, `email`, `telefone`, `celular`, `data`, `valor`, `foto`) VALUES
(33052, 'Adriano', 'a@a', '1', '213214', '2019-06-04', '1.00', 'd3f2bc420dde8f7015cc84ce98d77b59.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_usuario`
--

CREATE TABLE IF NOT EXISTS `tabela_usuario` (
  `cod` int(5) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_bin NOT NULL,
  `senha` varchar(100) COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `tipo` char(3) COLLATE utf8_bin NOT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `tabela_usuario`
--

INSERT INTO `tabela_usuario` (`cod`, `user`, `senha`, `nome`, `tipo`, `foto`) VALUES
(8, 'pedro1', '202cb962ac59075b964b07152d234b70', 'pedro', 'adm', '6d14556e5994b9b5a54b52540c26d16e.png'),
(10, 'adriano', '202cb962ac59075b964b07152d234b70', 'adriano', 'us', '80fb919737f7d73e787f3cbdc3250c2f.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
