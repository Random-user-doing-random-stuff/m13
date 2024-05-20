-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Maio-2024 às 01:13
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `m13`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animals`
--

CREATE TABLE `animals` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `desc` varchar(8000) NOT NULL,
  `datain` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `animals`
--

INSERT INTO `animals` (`ID`, `nome`, `desc`, `datain`, `image`) VALUES
(1, 'elefante', 'muito pesado', '2024-05-17 22:06:49', ''),
(9, 'test', 'ok', '2024-05-17 22:29:49', 0x44657369676e2073656d206e6f6d6520283529202832292e706e67),
(27, 'as', 'as', '2024-05-19 16:54:21', 0x64643132333137365f335b315d2e6a7067),
(28, 'as', 'as', '2024-05-19 16:54:22', 0x64643132333137365f335b315d2e6a7067),
(29, 'as', 'as', '2024-05-19 22:45:50', 0x64643132333137365f335b315d2e6a7067),
(30, 'as', 'as', '2024-05-19 22:45:52', 0x64643132333137365f335b315d2e6a7067),
(31, 'as', 'as', '2024-05-19 22:45:54', 0x64643132333137365f335b315d2e6a7067),
(32, 'as', 'as', '2024-05-19 22:45:54', 0x64643132333137365f335b315d2e6a7067),
(33, 'as', 'as', '2024-05-19 22:45:55', 0x64643132333137365f335b315d2e6a7067),
(34, 'as', 'as', '2024-05-19 22:45:55', 0x64643132333137365f335b315d2e6a7067),
(35, 'as', 'as', '2024-05-19 22:45:56', 0x64643132333137365f335b315d2e6a7067),
(36, 'as', 'as', '2024-05-19 22:45:58', 0x64643132333137365f335b315d2e6a7067),
(37, 'as', 'as', '2024-05-19 22:45:59', 0x64643132333137365f335b315d2e6a7067),
(38, 'as', 'as', '2024-05-19 22:45:59', 0x64643132333137365f335b315d2e6a7067),
(39, 'as', 'as', '2024-05-19 22:46:00', 0x64643132333137365f335b315d2e6a7067),
(40, 'as', 'as', '2024-05-19 22:46:00', 0x64643132333137365f335b315d2e6a7067),
(41, 'as', 'as', '2024-05-19 22:46:01', 0x64643132333137365f335b315d2e6a7067),
(42, '', '', '2024-05-19 22:51:01', NULL),
(43, '', '', '2024-05-19 22:51:02', NULL),
(44, '', '', '2024-05-19 22:51:03', NULL),
(45, '', '', '2024-05-19 22:51:03', NULL),
(46, 'barata', 'ewww', '2024-05-19 22:54:00', NULL),
(47, 'as', 'as', '2024-05-19 22:54:04', NULL),
(48, 'ok', 'test', '2024-05-19 22:54:12', NULL),
(49, 'ok', 'test', '2024-05-19 22:54:18', NULL),
(50, 'ok', 'test', '2024-05-19 22:54:19', NULL),
(51, 'pila', 'cona', '2024-05-19 22:57:02', 0x30303364313430356433643033653538633734303465353436376162336535322e6a7067),
(52, 'asssss', 'asssssss', '2024-05-19 22:57:25', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'sergi', 'test'),
(2, 'rubi', 'oi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user-animal`
--

CREATE TABLE `user-animal` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `nome` (`nome`),
  ADD KEY `desc` (`desc`(768));

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`);

--
-- Índices para tabela `user-animal`
--
ALTER TABLE `user-animal`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `user_id` (`user_id`,`animal_id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animals`
--
ALTER TABLE `animals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `user-animal`
--
ALTER TABLE `user-animal`
  ADD CONSTRAINT `user-animal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user-animal_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
