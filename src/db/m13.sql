-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Maio-2024 às 12:31
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
  `datain` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `animals`
--

INSERT INTO `animals` (`ID`, `nome`, `datain`, `image`) VALUES
(1, 'elefante', '2024-05-17 22:06:49', ''),
(9, 'test', '2024-05-17 22:29:49', 0x44657369676e2073656d206e6f6d6520283529202832292e706e67),
(27, 'as', '2024-05-19 16:54:21', 0x64643132333137365f335b315d2e6a7067),
(28, 'as', '2024-05-19 16:54:22', 0x64643132333137365f335b315d2e6a7067),
(29, 'as', '2024-05-19 22:45:50', 0x64643132333137365f335b315d2e6a7067),
(30, 'as', '2024-05-19 22:45:52', 0x64643132333137365f335b315d2e6a7067),
(31, 'as', '2024-05-19 22:45:54', 0x64643132333137365f335b315d2e6a7067),
(32, 'as', '2024-05-19 22:45:54', 0x64643132333137365f335b315d2e6a7067),
(33, 'as', '2024-05-19 22:45:55', 0x64643132333137365f335b315d2e6a7067),
(34, 'as', '2024-05-19 22:45:55', 0x64643132333137365f335b315d2e6a7067),
(35, 'as', '2024-05-19 22:45:56', 0x64643132333137365f335b315d2e6a7067),
(36, 'as', '2024-05-19 22:45:58', 0x64643132333137365f335b315d2e6a7067),
(37, 'as', '2024-05-19 22:45:59', 0x64643132333137365f335b315d2e6a7067),
(38, 'as', '2024-05-19 22:45:59', 0x64643132333137365f335b315d2e6a7067),
(39, 'as', '2024-05-19 22:46:00', 0x64643132333137365f335b315d2e6a7067),
(40, 'as', '2024-05-19 22:46:00', 0x64643132333137365f335b315d2e6a7067),
(41, 'as', '2024-05-19 22:46:01', 0x64643132333137365f335b315d2e6a7067),
(46, 'barata', '2024-05-19 22:54:00', NULL),
(47, 'as', '2024-05-19 22:54:04', NULL),
(48, 'ok', '2024-05-19 22:54:12', NULL),
(49, 'ok', '2024-05-19 22:54:18', NULL),
(50, 'ok', '2024-05-19 22:54:19', NULL),
(51, 'sas', '2024-05-19 22:57:02', 0x30303364313430356433643033653538633734303465353436376162336535322e6a7067),
(52, 'asssss', '2024-05-19 22:57:25', NULL),
(53, 'ruben', '2024-05-23 11:00:03', 0x5f3130363534343731315f65343932323530372d363733612d346632662d623931642d3334373939393461383730622e6a7067),
(54, 'aaaaaaaaaaasasa', '2024-05-25 17:21:25', NULL),
(55, 'boas', '2024-05-25 18:22:15', 0x313130363630382d70657272792d7468652d706c6174797075732d77616c6c70617065722d3139323078313038302d66756c6c2d68642e6a7067);

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
-- Estrutura da tabela `user_animal`
--

CREATE TABLE `user_animal` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `fact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user_animal`
--

INSERT INTO `user_animal` (`ID`, `user_id`, `animal_id`, `fact`) VALUES
(1, 1, 27, ''),
(2, 1, 1, 'jynzx'),
(3, 2, 51, 'tinoni'),
(4, 1, 1, 'bora bora upa'),
(5, 1, 1, 'nada disso'),
(6, 1, 1, 'kkkkkkkkkkk'),
(7, 1, 1, 'kkkkkkkkkkk'),
(8, 1, 1, 'kkkkkkkkkkk'),
(9, 1, 1, 'kkkkkkkkkkk'),
(10, 1, 1, 'muito pesado'),
(11, 1, 1, '111111111111'),
(12, 1, 1, '111111111111'),
(13, 1, 1, '111111111111'),
(14, 1, 1, 'boas2'),
(15, 1, 1, 'boas2'),
(16, 1, 1, 'boas2'),
(17, 1, 1, 'boas2'),
(18, 1, 1, 'boas2'),
(19, 1, 1, 'bas3'),
(20, 1, 1, 'bas3'),
(21, 1, 1, 'bas3'),
(22, 1, 1, 'bas3'),
(23, 1, 1, '55'),
(24, 1, 1, '55'),
(25, 1, 27, 'na lagoa'),
(26, 1, 27, 'na lagoa'),
(27, 1, 1, 'new fact'),
(28, 1, 1, 'new fact'),
(29, 1, 9, 'first edited fact'),
(30, 2, 55, 'engraçado'),
(31, 1, 55, 'nada engraçado');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `nome` (`nome`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`);

--
-- Índices para tabela `user_animal`
--
ALTER TABLE `user_animal`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `user_id` (`user_id`,`animal_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `fact` (`fact`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animals`
--
ALTER TABLE `animals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `user_animal`
--
ALTER TABLE `user_animal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `user_animal`
--
ALTER TABLE `user_animal`
  ADD CONSTRAINT `user_animal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_animal_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;