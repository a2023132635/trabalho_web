-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 15-Dez-2025 às 18:30
-- Versão do servidor: 8.4.7
-- versão do PHP: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `simulador_financas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `financas`
--

CREATE TABLE `financas` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `saldo` decimal(10,2) DEFAULT '0.00',
  `poupanca` decimal(10,2) DEFAULT '0.00',
  `divida` decimal(10,2) DEFAULT '0.00',
  `data_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `financas`
--

INSERT INTO `financas` (`id`, `user_id`, `saldo`, `poupanca`, `divida`, `data_atualizacao`) VALUES
(1, 3, 0.00, 0.00, 0.00, '2025-12-12 23:25:06'),
(2, 4, 0.00, 0.00, 0.00, '2025-12-13 00:13:41'),
(3, 5, 2400.00, 1000.00, -400.00, '2025-12-13 17:10:15'),
(4, 6, 2650.00, 1200.00, -800.00, '2025-12-13 23:02:52'),
(5, 8, 0.00, 0.00, 0.00, '2025-12-15 18:27:24');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `financas`
--
ALTER TABLE `financas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `financas`
--
ALTER TABLE `financas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `financas`
--
ALTER TABLE `financas`
  ADD CONSTRAINT `financas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;