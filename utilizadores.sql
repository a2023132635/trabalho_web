-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 15-Dez-2025 às 18:28
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
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apelido` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'avatar1.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `apelido`, `email`, `password`, `avatar`) VALUES
(1, 'José', 'Amaral', 'joseamaral@gmail.com', '$2y$10$6wyScom3kpigqg.FbLtdDuZkdW7TDtXwNZHGjDbvd3rp34ZenyfOm', 'avatar1.png'),
(2, 'jose', 'sarmento', 'joaosarmento@gmail.com', '$2y$10$1m1Ih7zD82qhlm67YaF.0uhpqOCh1pK.BE7mDgM.KKqNNg6GnMeTu', 'avatar1.png'),
(3, 'andre', 'amaral', 'andreamaral@gmail.com', '$2y$10$GT7CnKwOiMS/O576cfI3fehhTX0XfZ/4XtyD3NJA6M4WHatcOxNCi', 'avatar1.png'),
(4, 'sofia', 'cruz', 'sofiacruz@gmail.com', '$2y$10$cUs9iveV8IcaAF.SzWeHf.Dyjr/lopavuGjJ8oLoRXy71hBV/qhMO', 'avatar1.png'),
(5, 'luis', 'mendes', 'luismendes@gmail.com', '$2y$10$mNsY8NcCeMxBDw6pLligbO/twzmX8BKK6uZg7aq.D65sunI24iYza', 'avatar1.png'),
(6, 'afonso', 'jesus', 'afonsojesus@gmail.com', '$2y$10$g5RwwYEQO6ebdRBY/t076eZqCEvA0zD88iCihim6wVEFQC49cF/c.', 'avatar1.png'),
(7, 'andre', 'filipe', 'andrefilipe@gmail.com', '$2y$10$E0sONvFhF0M2BwfPO0W8GupIS0LONoA6wDoWxbj467NPIIWLEXNdK', 'avatar1.png'),
(8, 'joao', 'costa', 'joaofilipe@gmail.com', '$2y$10$dk5rWUNHDSWyvghzGTfLJ.RP3.m2XAR.5Kd5j1RS4nv3dFdXsfKne', 'avatar2.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
