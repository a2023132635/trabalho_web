-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 15-Dez-2025 às 18:31
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
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tipo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `saldo_resultante` decimal(10,2) NOT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id`, `user_id`, `tipo`, `valor`, `saldo_resultante`, `data`) VALUES
(1, 8, 'Horas extra no trabalho', 150.00, 1650.00, '2025-12-14 22:55:11'),
(2, 8, 'Investimento', -400.00, 1250.00, '2025-12-14 22:55:41'),
(3, 8, 'Pagamento de dívida', -600.00, 650.00, '2025-12-15 14:05:45'),
(4, 8, 'Subsídio Extra', 500.00, 1150.00, '2025-12-15 14:06:11'),
(5, 8, 'Horas extra no trabalho', 150.00, 150.00, '2025-12-15 14:08:24'),
(6, 8, 'Problema automóvel inesperado', -200.00, -50.00, '2025-12-15 14:08:27'),
(7, 8, 'Subsídio Extra', 500.00, 450.00, '2025-12-15 14:08:51'),
(8, 8, 'Despesa hospitalar inesperada', -150.00, 300.00, '2025-12-15 14:08:54'),
(9, 8, 'Problema automóvel inesperado', -200.00, 100.00, '2025-12-15 14:18:39'),
(10, 8, 'Subsídio Extra', 500.00, 600.00, '2025-12-15 14:18:41'),
(11, 8, 'Subsídio Extra', 500.00, 1100.00, '2025-12-15 14:18:42'),
(12, 8, 'Horas extra no trabalho', 150.00, 150.00, '2025-12-15 14:18:49'),
(13, 8, 'Problema automóvel inesperado', -200.00, -50.00, '2025-12-15 14:18:51'),
(14, 8, 'Despesa hospitalar inesperada', -150.00, -200.00, '2025-12-15 14:18:52'),
(15, 8, 'Horas extra no trabalho', 150.00, -50.00, '2025-12-15 14:18:53'),
(16, 8, 'Horas extra no trabalho', 150.00, 150.00, '2025-12-15 14:19:24'),
(17, 8, 'Despesa hospitalar inesperada', -150.00, 0.00, '2025-12-15 14:19:25'),
(18, 8, 'Despesa hospitalar inesperada', -150.00, -150.00, '2025-12-15 14:19:26'),
(19, 8, 'Despesa hospitalar inesperada', -150.00, -300.00, '2025-12-15 14:19:27'),
(20, 8, 'Problema automóvel inesperado', -200.00, -500.00, '2025-12-15 14:19:29'),
(21, 8, 'Subsídio Extra', 500.00, 0.00, '2025-12-15 14:19:31'),
(22, 8, 'Subsídio Extra', 500.00, 500.00, '2025-12-15 14:19:31'),
(23, 8, 'Recebeu salário', 5000.00, 5000.00, '2025-12-15 14:19:58'),
(24, 8, 'Gasto', -800.00, 4200.00, '2025-12-15 14:20:02'),
(25, 8, 'Pagamento de dívida', -600.00, 3600.00, '2025-12-15 14:20:06'),
(26, 8, 'Investimento', -1000.00, 2600.00, '2025-12-15 14:20:09'),
(27, 8, 'Horas extra no trabalho', 150.00, 2750.00, '2025-12-15 14:20:17'),
(28, 8, 'Horas extra no trabalho', 150.00, 2900.00, '2025-12-15 14:20:18'),
(29, 8, 'Subsídio Extra', 500.00, 3400.00, '2025-12-15 14:20:20'),
(30, 8, 'Investimento', -200.00, 650.00, '2025-12-15 18:27:04');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;