-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Maio-2024 às 16:20
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
-- Estrutura da tabela `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `topics`
--

INSERT INTO `topics` (`topic_id`, `name`, `date_added`, `image`) VALUES
(1, 'Morcegos', '2024-05-26 13:35:26', 0x45344532324646372d373333352d344138412d384233303831463635304145344531345f736f757263652e77656270),
(2, 'Venus', '2024-05-26 13:45:24', 0x76656e7573322d6a70672e77656270),
(3, 'Porquinho-da-índia', '2024-05-26 13:55:40', 0x53656d2d54c3ad74756c6f2e706e67),
(4, 'Elefante', '2024-05-26 13:56:55', 0x7472616e7366657269722e6a7067),
(5, 'Golfinho', '2024-05-26 13:57:28', 0x7472616e736665726972202831292e6a7067);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'sergi', 'oi'),
(2, 'tomas', 'tinoni');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_topic_facts`
--

CREATE TABLE `user_topic_facts` (
  `fact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `fact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user_topic_facts`
--

INSERT INTO `user_topic_facts` (`fact_id`, `user_id`, `topic_id`, `fact`) VALUES
(22, 1, 1, 'Morcegos são o único mamífero voador.'),
(23, 1, 2, 'Em Venus 1 dia é mais longo que 1 ano'),
(24, 2, 1, 'Nem todos os morcegos hibernam.'),
(25, 1, 4, 'Elefantes não conseguem saltar.'),
(26, 1, 5, 'Golfinhos dão nomes uns aos outros');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`);

--
-- Índices para tabela `user_topic_facts`
--
ALTER TABLE `user_topic_facts`
  ADD PRIMARY KEY (`fact_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `fact` (`fact`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `user_topic_facts`
--
ALTER TABLE `user_topic_facts`
  MODIFY `fact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `user_topic_facts`
--
ALTER TABLE `user_topic_facts`
  ADD CONSTRAINT `user_topic_facts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_topic_facts_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
