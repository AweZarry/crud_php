-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/10/2023 às 21:33
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gerercar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carros`
--

CREATE TABLE `carros` (
  `id_carro` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `ano_de_fabricacao` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `tipo_de_combustivel` varchar(255) NOT NULL,
  `n_de_portas` varchar(255) NOT NULL,
  `quilometragem` varchar(255) NOT NULL,
  `preco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carros`
--

INSERT INTO `carros` (`id_carro`, `marca`, `modelo`, `ano_de_fabricacao`, `cor`, `tipo_de_combustivel`, `n_de_portas`, `quilometragem`, `preco`) VALUES
(5, 'test', 'test123123', '2023', 'test', 'Etanol', '4', '213123', '1231231'),
(6, 'teeee', 'teee', '2000', 'teeeftft', 'Gasolina', '4', '4', '4'),
(7, 'teee', 'teee', '2000', 'tee', 'Gasolina', '2', '222', '2'),
(8, 'eeeee', 'eeeeeeee', '2002', 'eeeee', 'Gasolina', '3', '333', '333');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registros`
--

CREATE TABLE `registros` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `registros`
--

INSERT INTO `registros` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha`) VALUES
(1, 'awe', 'awe@gmail.com', '$2y$10$d9M6IJ7uHMyZ3oC2YXPIwOpjZjPYN/V0W8Osbw7d6NP4hAa0TGwke'),
(2, 'test', 'test@gmail.com', '$2y$10$V.CuHsfQf30F/ULJchdEkO62zxhzW9NspSKZOBCmUKoNSgLcZa4SG');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id_carro`);

--
-- Índices de tabela `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carros`
--
ALTER TABLE `carros`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
