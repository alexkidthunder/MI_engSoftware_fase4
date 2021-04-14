drop database if exists hospital_universitario;
create database if not exists hospital_universitario;
use hospital_universitario;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Abr-2021 às 22:17
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hospital_universitario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE `administradores` (
  `CPF` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cid`
--

CREATE TABLE `cid` (
  `CPF_prontuario` char(11) NOT NULL,
  `CodCID` char(6) NOT NULL,
  `Id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiros`
--

CREATE TABLE `enfermeiros` (
  `CPF` char(11) NOT NULL,
  `COREN` char(10) NOT NULL,
  `Plantao` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiros_chefes`
--

CREATE TABLE `enfermeiros_chefes` (
  `CPF` char(11) NOT NULL,
  `COREN` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagiarios`
--

CREATE TABLE `estagiarios` (
  `CPF` char(11) NOT NULL,
  `Plantao` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamento`
--

CREATE TABLE `medicamento` (
  `Nome_Medicam` varchar(50) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Fabricante` varchar(30) NOT NULL,
  `Data_Validade` date NOT NULL,
  `Codigo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prontuario`
--

CREATE TABLE `prontuario` (
  `Nome_Paciente` varchar(50) NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Data_Nasc` date NOT NULL,
  `CPF` char(11) NOT NULL,
  `Tipo_Sang` varchar(5) NOT NULL,
  `Data_Internacao` date NOT NULL,
  `Data_Saida` date NOT NULL,
  `Leito` varchar(10) NOT NULL,
  `Status` enum('internado','alta','obito') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis`
--

CREATE TABLE `responsaveis` (
  `Atribuicao` enum('a','b','c','d') NOT NULL,
  `CPF` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `CPF` char(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Senha` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Data_Nasc` date NOT NULL,
  `Atribuicao` enum('a','b','c','d') NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`CPF`);

--
-- Índices para tabela `cid`
--
ALTER TABLE `cid`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CPF_prontuario` (`CPF_prontuario`);

--
-- Índices para tabela `enfermeiros`
--
ALTER TABLE `enfermeiros`
  ADD PRIMARY KEY (`COREN`),
  ADD KEY `CPF` (`CPF`);

--
-- Índices para tabela `enfermeiros_chefes`
--
ALTER TABLE `enfermeiros_chefes`
  ADD PRIMARY KEY (`COREN`),
  ADD KEY `CPF` (`CPF`);

--
-- Índices para tabela `estagiarios`
--
ALTER TABLE `estagiarios`
  ADD PRIMARY KEY (`CPF`);

--
-- Índices para tabela `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`Codigo`);

--
-- Índices para tabela `prontuario`
--
ALTER TABLE `prontuario`
  ADD PRIMARY KEY (`CPF`);

--
-- Índices para tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  ADD PRIMARY KEY (`CPF`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`CPF`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cid`
--
ALTER TABLE `cid`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);

--
-- Limitadores para a tabela `cid`
--
ALTER TABLE `cid`
  ADD CONSTRAINT `cid_ibfk_1` FOREIGN KEY (`CPF_prontuario`) REFERENCES `prontuario` (`CPF`);

--
-- Limitadores para a tabela `enfermeiros`
--
ALTER TABLE `enfermeiros`
  ADD CONSTRAINT `enfermeiros_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);

--
-- Limitadores para a tabela `enfermeiros_chefes`
--
ALTER TABLE `enfermeiros_chefes`
  ADD CONSTRAINT `enfermeiros_chefes_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);

--
-- Limitadores para a tabela `estagiarios`
--
ALTER TABLE `estagiarios`
  ADD CONSTRAINT `estagiarios_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);

--
-- Limitadores para a tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  ADD CONSTRAINT `responsaveis_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
