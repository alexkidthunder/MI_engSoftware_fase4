-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Abr-2021 às 00:04
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
CREATE DATABASE IF NOT EXISTS `hospital_universitario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hospital_universitario`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `CPF` char(14) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `administradores`:
--   `CPF`
--       `usuarios` -> `CPF`
--

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`CPF`) VALUES
('021.446.717-41'),
('174.985.367-13'),
('175.585.124-92');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE IF NOT EXISTS `agendamentos` (
  `Codigo` bigint(20) NOT NULL,
  `Posologia` float NOT NULL,
  `Data_Agend` date NOT NULL,
  `Realizado` tinyint(1) DEFAULT NULL,
  `Hora_Agend` time NOT NULL,
  `ID_prontuario` bigint(20) NOT NULL,
  `CPF_usuario` char(14) DEFAULT NULL,
  `Cod_medicamento` bigint(20) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `ID_prontuario` (`ID_prontuario`),
  KEY `CPF_usuario` (`CPF_usuario`),
  KEY `Cod_medicamento` (`Cod_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `agendamentos`:
--   `ID_prontuario`
--       `prontuarios` -> `ID`
--   `CPF_usuario`
--       `usuarios` -> `CPF`
--   `Cod_medicamento`
--       `medicamentos` -> `Codigo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento_prontuario`
--

CREATE TABLE IF NOT EXISTS `agendamento_prontuario` (
  `ID_prontuario` bigint(20) DEFAULT NULL,
  `Codigo_Agendamento` bigint(20) NOT NULL,
  KEY `ID_prontuario` (`ID_prontuario`),
  KEY `Codigo_Agendamento` (`Codigo_Agendamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `agendamento_prontuario`:
--   `ID_prontuario`
--       `prontuarios` -> `ID`
--   `Codigo_Agendamento`
--       `agendamentos` -> `Codigo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cid`
--

CREATE TABLE IF NOT EXISTS `cid` (
  `ID_prontuario` bigint(20) NOT NULL,
  `CodCID` char(6) NOT NULL,
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `ID_prontuario` (`ID_prontuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `cid`:
--   `ID_prontuario`
--       `prontuarios` -> `ID`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiros`
--

CREATE TABLE IF NOT EXISTS `enfermeiros` (
  `CPF` char(14) NOT NULL,
  `COREN` char(10) NOT NULL,
  `Plantao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`COREN`),
  KEY `CPF` (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `enfermeiros`:
--   `CPF`
--       `usuarios` -> `CPF`
--

--
-- Extraindo dados da tabela `enfermeiros`
--

INSERT INTO `enfermeiros` (`CPF`, `COREN`, `Plantao`) VALUES
('252.696.001-73', '01-BA00004', 0),
('250.414.528-74', '01-BA00005', 0),
('127.066.920-65', '01-BA00006', 0),
('558.570.920-86', '01-BA00007', 0),
('136.382.370-10', '01-BA00008', 0),
('072.003.190-74', '01-BA00009', 0),
('873.325.550-42', '01-BA00010', 0),
('607.500.500-55', '01-BA00011', 0),
('841.084.862-77', '01-BA00012', 0),
('046.822.991-40', '01-BA00013', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiros_chefes`
--

CREATE TABLE IF NOT EXISTS `enfermeiros_chefes` (
  `CPF` char(14) NOT NULL,
  `COREN` char(10) NOT NULL,
  PRIMARY KEY (`COREN`),
  KEY `CPF` (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `enfermeiros_chefes`:
--   `CPF`
--       `usuarios` -> `CPF`
--

--
-- Extraindo dados da tabela `enfermeiros_chefes`
--

INSERT INTO `enfermeiros_chefes` (`CPF`, `COREN`) VALUES
('202.457.365-11', '01-BA00001'),
('475.013.135-62', '01-BA00003'),
('658.002.101-02', '01-BA00002');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagiarios`
--

CREATE TABLE IF NOT EXISTS `estagiarios` (
  `CPF` char(14) NOT NULL,
  `Plantao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `estagiarios`:
--   `CPF`
--       `usuarios` -> `CPF`
--

--
-- Extraindo dados da tabela `estagiarios`
--

INSERT INTO `estagiarios` (`CPF`, `Plantao`) VALUES
('213.223.336-53', 0),
('645.566.964-96', 0),
('657.687.833-85', 0),
('868.500.956-17', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `leitos`
--

CREATE TABLE IF NOT EXISTS `leitos` (
  `Ocupado` tinyint(1) NOT NULL,
  `Identificacao` varchar(20) NOT NULL,
  PRIMARY KEY (`Identificacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `leitos`:
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `Id` bigint(20) NOT NULL,
  `Data_Log` date NOT NULL,
  `Hora_Agend` time NOT NULL,
  `CPF_usuario` varchar(255) NOT NULL,
  `Ip` varchar(15) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `log`:
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE IF NOT EXISTS `medicamentos` (
  `Nome_Medicam` varchar(50) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Fabricante` varchar(30) NOT NULL,
  `Data_Validade` date NOT NULL,
  `Codigo` bigint(20) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `medicamentos`:
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

CREATE TABLE IF NOT EXISTS `ocorrencias` (
  `Codigo` bigint(20) NOT NULL,
  `Data_ocorr` date NOT NULL,
  `ID_prontuario` bigint(20) NOT NULL,
  `Descricao` text NOT NULL,
  `CPF` char(14) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `ID_prontuario` (`ID_prontuario`),
  KEY `CPF` (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `ocorrencias`:
--   `ID_prontuario`
--       `prontuarios` -> `ID`
--   `CPF`
--       `usuarios` -> `CPF`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `Nome_Paciente` varchar(50) NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Status` enum('internado','alta','obito') NOT NULL,
  `Data_Nasc` date NOT NULL,
  `CPF` char(14) NOT NULL,
  `Tipo_Sang` varchar(5) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `pacientes`:
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `prontuarios`
--

CREATE TABLE IF NOT EXISTS `prontuarios` (
  `ID` bigint(20) NOT NULL,
  `Data_Internacao` date NOT NULL,
  `Data_Saida` date NOT NULL,
  `Id_leito` varchar(20) NOT NULL,
  `Cpfpaciente` char(14) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Id_leito` (`Id_leito`),
  KEY `Cpfpaciente` (`Cpfpaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `prontuarios`:
--   `Id_leito`
--       `leitos` -> `Identificacao`
--   `Cpfpaciente`
--       `pacientes` -> `CPF`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis`
--

CREATE TABLE IF NOT EXISTS `responsaveis` (
  `CPF` char(14) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `responsaveis`:
--   `CPF`
--       `usuarios` -> `CPF`
--

--
-- Extraindo dados da tabela `responsaveis`
--

INSERT INTO `responsaveis` (`CPF`) VALUES
('046.822.991-40'),
('072.003.190-74'),
('127.066.920-65'),
('136.382.370-10'),
('175.585.124-92'),
('202.457.365-11'),
('213.223.336-53'),
('250.414.528-74'),
('252.696.001-73'),
('475.013.135-62'),
('558.570.920-86'),
('607.500.500-55'),
('645.566.964-96'),
('657.687.833-85'),
('658.002.101-02'),
('841.084.862-77'),
('868.500.956-17'),
('873.325.550-42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `CPF` char(14) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Senha` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Data_Nasc` date NOT NULL,
  `Atribuicao` enum('Administrador','Enfermeiro Chefe','Enfermeiro','Estagiario') NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Ip` varchar(15) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `usuarios`:
--

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`CPF`, `Nome`, `Senha`, `Email`, `Data_Nasc`, `Atribuicao`, `Sexo`, `Ip`) VALUES
('021.446.717-41', 'João da Silva e Silva', 'silvajao123', 'joaosilva.hp@gmail.com', '1980-12-05', 'Administrador', 'Masculino', '0010101'),
('046.822.991-40', 'Fernando Miguel Galvão', 'GFdZCYh6Yo', 'fernandomiguelgalvao-92@gmail.com', '1959-04-23', 'Enfermeiro', 'Masculino', '011010001'),
('072.003.190-74', 'Isaac Márcio Enrico Almada', 'malfada234', 'malfada.enricoIsaac@gmail.com', '1988-07-26', 'Enfermeiro', 'Masculino', '110100101'),
('127.066.920-65', 'Rafael Yago Rocha', 'goya761s', 'Yagorafael.hp@gmail.com', '1968-09-26', 'Enfermeiro', 'Masculino', '11010010100'),
('136.382.370-10', 'Diego Luan Cardoso', 'dosos23doso12', 'dieguinho87luan@gmail.com', '1968-02-18', 'Enfermeiro', 'Masculino', '1101010'),
('174.985.367-13', 'Juscelino Silva dos Santos', 'jusck987', 'santosjuscelino.hp@gmail.com', '1976-01-19', 'Administrador', 'Masculino', '11010110'),
('175.585.124-92', 'Maria joaquina Drumond', 'maria981', 'mariazinhaquina@gmail.com', '1995-07-12', 'Administrador', 'Feminino', '00100101'),
('202.457.365-11', 'Vinicius Martins magalhães', 'viniciinEhdeiz10', 'mmvinicius@gmail.com', '1989-09-24', 'Enfermeiro Chefe', 'Masculino', '00110101001'),
('213.223.336-53', 'Severino Nathan Ferreira', 'frefedo872', 'severinonathanferreira@gmail.com', '1996-02-17', 'Estagiario', 'Masculino', '011111000'),
('250.414.528-74', 'Alfredo Estrada Félix', 'frefedo872', 'estrada.felixfred@gmail.com', '1979-02-27', 'Enfermeiro', 'Masculino', '110100101'),
('252.696.001-73', 'Brenda Estefanir souza', '09szai2', 'brendasouza.hp@gmail.com', '1995-07-29', 'Enfermeiro', 'Feminino', '0100110101011'),
('475.013.135-62', 'Ana Catarina Melo', '09annamello', 'anna.melocatarina@gmail.com', '1986-10-11', 'Enfermeiro Chefe', 'Feminino', '010010110'),
('558.570.920-86', 'Jaqueline Marina da Cunha', 'cunh87ja212que', 'cunha.jaquemarina@gmail.com', '1987-08-21', 'Enfermeiro', 'Feminino', '0010110101'),
('607.500.500-55', 'Alfredo Estrada Félix', 'frefedo872', 'suelimirellaaparecidadossantos@gmail.com', '1971-01-21', 'Enfermeiro', 'Feminino', '11001010'),
('645.566.964-96', 'Nina Gabriela Camila Figueiredo', '7bfc8LG23j', 'inagabrielacamilafigueiredo@gmail.com', '1971-01-21', 'Estagiario', 'Feminino', '010100111'),
('657.687.833-85', 'Rayssa Larissa da Rosa', 'ro029090710sa', 'rrayssalarissadarosa@gmail.com', '1994-11-14', 'Estagiario', 'Feminino', '00100010'),
('658.002.101-02', 'Ambrozina pereira amorim', '98378s2', 'amorim.Ambozina@gmail.com', '1974-04-27', 'Enfermeiro Chefe', 'Feminino', '10001010'),
('841.084.862-77', 'Diego Theo Nathan Vieira', '08F993d2gq', '_diegotheonathanvieira@gmail.com', '1992-02-25', 'Enfermeiro', 'Masculino', '1010010101'),
('868.500.956-17', 'Marlene Sarah Alana Moura', 'm4a13mp0s8m', 'smmarlenesarahalanamoura@gmail.com', '1992-11-06', 'Estagiario', 'Feminino', '01001010'),
('873.325.550-42', 'Cauã Mário da Luz', 'luz21s1z', 'cauamariodaluz.81@gmail.com', '1984-07-07', 'Enfermeiro', 'Masculino', '001011011');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  ADD CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`CPF_usuario`) REFERENCES `usuarios` (`CPF`),
  ADD CONSTRAINT `agendamento_ibfk_3` FOREIGN KEY (`Cod_medicamento`) REFERENCES `medicamentos` (`Codigo`);

--
-- Limitadores para a tabela `agendamento_prontuario`
--
ALTER TABLE `agendamento_prontuario`
  ADD CONSTRAINT `agendamento_prontuario_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  ADD CONSTRAINT `agendamento_prontuario_ibfk_2` FOREIGN KEY (`Codigo_Agendamento`) REFERENCES `agendamentos` (`Codigo`);

--
-- Limitadores para a tabela `cid`
--
ALTER TABLE `cid`
  ADD CONSTRAINT `cid_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`);

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
-- Limitadores para a tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD CONSTRAINT `ocorrencia_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  ADD CONSTRAINT `ocorrencia_ibfk_2` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);

--
-- Limitadores para a tabela `prontuarios`
--
ALTER TABLE `prontuarios`
  ADD CONSTRAINT `prontuario_ibfk_1` FOREIGN KEY (`Id_leito`) REFERENCES `leitos` (`Identificacao`),
  ADD CONSTRAINT `prontuario_ibfk_2` FOREIGN KEY (`Cpfpaciente`) REFERENCES `pacientes` (`CPF`);

--
-- Limitadores para a tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  ADD CONSTRAINT `responsaveis_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
