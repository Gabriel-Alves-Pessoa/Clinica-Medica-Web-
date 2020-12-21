-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Maio-2020 às 19:35
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinicou`
--
CREATE DATABASE IF NOT EXISTS `clinicou` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clinicou`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `cpf`, `nome`, `email`, `senha`) VALUES
(1, '222.333.111-66', 'Pedro Rivaldo', 'pedrorivaldo@gmail.com', '61c622d09bc158a9ce6ae49f7e923b4d'),
(4, '121.312.413-32', 'Davi Santos', 'daviadin@gmail.com', '270ad0828adc9930eabe81990d96248f'),
(8, '212.523.876-21', 'Gabriel Alves ', 'alves80gabriel@gmail.com', '202cb962ac59075b964b07152d234b70'),
(13, '123.123.123-12', 'Bill Gatos', 'billgatos12@gmail.com', '085cd2d9ed9007edc1edd5875821d122'),
(14, '060.083.443-32', 'Mundo de Tinta', 'antoniagardenia45@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `consulta`
--

CREATE TABLE `consulta` (
  `id_cons` int(11) NOT NULL,
  `descricao_cons` varchar(80) NOT NULL,
  `horario_cons` varchar(20) NOT NULL,
  `id_med` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_cons` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

CREATE TABLE `medico` (
  `id_med` int(11) NOT NULL,
  `nome_med` varchar(50) NOT NULL,
  `cpf_med` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`id_med`, `nome_med`, `cpf_med`) VALUES
(1, 'Drauzio Varella', '111.111.111-11'),
(2, 'Thiago Silva', '222.222.222-22'),
(3, 'João das Couves', '333.333.333-33'),
(4, 'Gabriel Alves ', '060.083.433-60'),
(5, 'Pedro Rivaldo', '123.123.444-33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretaria`
--

CREATE TABLE `secretaria` (
  `cpf_sec` varchar(14) NOT NULL,
  `nome_sec` varchar(50) NOT NULL,
  `senha_sec` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `secretaria`
--

INSERT INTO `secretaria` (`cpf_sec`, `nome_sec`, `senha_sec`) VALUES
('212.212.212-21', 'Joana Darc', 'joana123'),
('212.212.212-22', 'Maria das Dores', 'maria123'),
('421.473.253-34', 'Carlos Marcos', 'carlos123'),
('555.555.555-55', 'Paumo Robinso', 'paulo123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_cons`),
  ADD KEY `med_id_fk` (`id_med`),
  ADD KEY `cliente_id_fk` (`id_cliente`);

--
-- Índices para tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_med`);

--
-- Índices para tabela `secretaria`
--
ALTER TABLE `secretaria`
  ADD PRIMARY KEY (`cpf_sec`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_cons` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id_med` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `cliente_id_fk` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `med_id_fk` FOREIGN KEY (`id_med`) REFERENCES `medico` (`id_med`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
