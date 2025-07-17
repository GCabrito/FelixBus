-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Fev-2025 às 16:51
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
-- Banco de dados: `felixbus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bilhete`
--

CREATE TABLE `bilhete` (
  `idBilhete` int(11) NOT NULL,
  `Partida` varchar(60) NOT NULL,
  `Chegada` varchar(60) NOT NULL,
  `dataPartida` datetime NOT NULL,
  `dataChegada` datetime NOT NULL,
  `Preço` decimal(6,2) NOT NULL,
  `Capacidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `bilhete`
--

INSERT INTO `bilhete` (`idBilhete`, `Partida`, `Chegada`, `dataPartida`, `dataChegada`, `Preço`, `Capacidade`) VALUES
(1, 'Castelo Branco', 'Lisboa', '2025-01-25 12:30:00', '2025-01-25 15:00:00', 5.80, 70),
(2, 'Castelo Branco', 'Porto', '2025-01-25 10:00:00', '2025-01-25 14:00:00', 6.70, 60),
(3, 'Castelo Branco', 'Faro', '2025-01-25 14:00:00', '2025-01-25 19:00:00', 7.50, 80),
(4, 'Covilhã', 'Castelo Branco', '2025-02-20 15:00:00', '2025-02-20 16:35:00', 3.90, 65),
(5, 'Covilhã', 'Lisboa', '2025-02-20 15:00:00', '2025-02-20 18:30:00', 9.90, 80);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bilhetes_comprados`
--

CREATE TABLE `bilhetes_comprados` (
  `idBilhete` int(11) NOT NULL,
  `idUtilizador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoutilizador`
--

CREATE TABLE `tipoutilizador` (
  `idTipoUtilizador` int(11) NOT NULL,
  `Nome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipoutilizador`
--

INSERT INTO `tipoutilizador` (`idTipoUtilizador`, `Nome`) VALUES
(1, 'admin'),
(2, 'funcionário'),
(3, 'utilizador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `idTransacao` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `dataTransacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor` decimal(10,2) DEFAULT NULL,
  `idUtilizador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `idUtilizador` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `pass` varchar(256) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `morada` varchar(60) DEFAULT NULL,
  `tipoUtilizador` int(11) DEFAULT 3,
  `estado` varchar(10) DEFAULT 'Pendente',
  `saldo` decimal(6,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`idUtilizador`, `nome`, `pass`, `email`, `morada`, `tipoUtilizador`, `estado`, `saldo`) VALUES
(1, 'admin', 'admin', 'admin', 'rua admin', 1, 'Válido', 200.00),
(2, 'funcionario', 'funcionario', 'funcionario', 'rua funcionario', 2, 'Válido', 200.00),
(3, 'cliente', 'cliente', 'cliente', 'rua cliente', 3, 'Válido', 0.00);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bilhete`
--
ALTER TABLE `bilhete`
  ADD PRIMARY KEY (`idBilhete`);

--
-- Índices para tabela `bilhetes_comprados`
--
ALTER TABLE `bilhetes_comprados`
  ADD PRIMARY KEY (`idBilhete`,`idUtilizador`),
  ADD KEY `idUtilizador` (`idUtilizador`);

--
-- Índices para tabela `tipoutilizador`
--
ALTER TABLE `tipoutilizador`
  ADD PRIMARY KEY (`idTipoUtilizador`);

--
-- Índices para tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`idTransacao`),
  ADD KEY `idUtilizador` (`idUtilizador`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`idUtilizador`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `tipoUtilizador` (`tipoUtilizador`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bilhete`
--
ALTER TABLE `bilhete`
  MODIFY `idBilhete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tipoutilizador`
--
ALTER TABLE `tipoutilizador`
  MODIFY `idTipoUtilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `idTransacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `idUtilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `bilhetes_comprados`
--
ALTER TABLE `bilhetes_comprados`
  ADD CONSTRAINT `bilhetes_comprados_ibfk_1` FOREIGN KEY (`idBilhete`) REFERENCES `bilhete` (`idBilhete`),
  ADD CONSTRAINT `bilhetes_comprados_ibfk_2` FOREIGN KEY (`idUtilizador`) REFERENCES `utilizador` (`idUtilizador`);

--
-- Limitadores para a tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD CONSTRAINT `transacoes_ibfk_1` FOREIGN KEY (`idUtilizador`) REFERENCES `utilizador` (`idUtilizador`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD CONSTRAINT `utilizador_ibfk_1` FOREIGN KEY (`tipoUtilizador`) REFERENCES `tipoutilizador` (`idTipoUtilizador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
