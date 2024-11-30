-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2024 às 14:08
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `locadora_veiculos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cpf`, `nome`, `data_nascimento`) VALUES
(1, '12345678901', 'João Silva', '1990-05-15'),
(2, '98765432100', 'Maria Oliveira', '1985-10-20'),
(3, '12345678900', 'João Pedro', '2000-03-27'),
(4, '98765432100', 'João Paulo', '1984-06-17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacoes`
--

CREATE TABLE `locacoes` (
  `id_locacao` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `data_locacao` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `dias_locacao` int(11) GENERATED ALWAYS AS (to_days(`data_devolucao`) - to_days(`data_locacao`)) STORED,
  `quantidade_dias` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ativa'
) ;

--
-- Despejando dados para a tabela `locacoes`
--

INSERT INTO `locacoes` (`id_locacao`, `id_cliente`, `id_veiculo`, `data_locacao`, `data_devolucao`, `quantidade_dias`, `status`) VALUES
(1, 3, 2, '2024-11-19', '2024-11-30', NULL, 'ativa'),
(2, 3, 2, '2024-11-19', '2024-11-30', NULL, 'ativa'),
(3, 3, 2, '2024-11-19', '2024-11-30', NULL, 'finalizada'),
(4, 4, 4, '2024-11-13', '2024-12-10', 27, 'ativa'),
(5, 1, 1, '2024-11-14', '2024-11-30', 16, 'ativa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id_veiculo` int(11) NOT NULL,
  `placa` varchar(7) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `cor` varchar(20) NOT NULL,
  `ano_fabricacao` year(4) NOT NULL,
  `categoria` enum('B','I','L') NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id_veiculo`, `placa`, `marca`, `modelo`, `cor`, `ano_fabricacao`, `categoria`, `estoque`) VALUES
(1, 'AAA1234', 'Toyota', 'Corolla', 'Preto', '2020', 'B', 2),
(2, 'BBB5678', 'Volkswagen', 'Gol', 'Branco', '2018', 'B', 3),
(3, 'CCC9012', 'Honda', 'Civic', 'Azul', '2022', 'I', 2),
(4, 'DDD3456', 'Ford', 'Focus', 'Prata', '2019', 'I', 1),
(5, 'EEE7890', 'BMW', '320i', 'Vermelho', '2021', 'L', 2),
(6, 'FFF1234', 'Mercedes', 'C180', 'Preto', '2020', 'L', 2),
(7, 'POL7895', 'Volkswagen', 'Golf Sportline', 'Prata', '2014', 'I', 0),
(8, 'KLN8152', 'Toyota', 'Corolla', 'Bege', '2013', 'B', 1),
(11, 'TES5623', 'Volkswagen', 'Golf Sportline', 'Vermelho', '2013', 'B', 1),
(12, 'TES5678', 'Mercedes-Benz', 'SL500', 'Preta', '2004', 'L', 1),
(13, 'TES7789', 'Nissan', 'Kicks', 'Azul', '2019', 'I', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `locacoes`
--
ALTER TABLE `locacoes`
  ADD PRIMARY KEY (`id_locacao`),
  ADD KEY `fk_cliente` (`id_cliente`),
  ADD KEY `fk_veiculo` (`id_veiculo`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `locacoes`
--
ALTER TABLE `locacoes`
  MODIFY `id_locacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `locacoes`
--
ALTER TABLE `locacoes`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
