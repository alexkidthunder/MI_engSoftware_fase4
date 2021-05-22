-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Maio-2021 às 00:42
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
--       `responsaveis` -> `CPF`
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
-- Estrutura da tabela `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `cargo`:
--

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`id`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Enfermeiro Chefe'),
(3, 'Enfermeiro'),
(4, 'Estagiario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cid`
--

CREATE TABLE IF NOT EXISTS `cid` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `CodCID` char(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `cid`:
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cid_prontuario`
--

CREATE TABLE IF NOT EXISTS `cid_prontuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_CID` bigint(20) NOT NULL,
  `id_prontuario` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_CID` (`id_CID`),
  KEY `id_prontuario` (`id_prontuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `cid_prontuario`:
--   `id_CID`
--       `cid` -> `Id`
--   `id_prontuario`
--       `prontuarios` -> `ID`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiros`
--

CREATE TABLE IF NOT EXISTS `enfermeiros` (
  `CPF` char(14) NOT NULL,
  `COREN` char(12) NOT NULL,
  `Plantao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`COREN`),
  KEY `CPF` (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `enfermeiros`:
--   `CPF`
--       `responsaveis` -> `CPF`
--

--
-- Extraindo dados da tabela `enfermeiros`
--

INSERT INTO `enfermeiros` (`CPF`, `COREN`, `Plantao`) VALUES
('252.696.001-73', 'BA000000004', 1),
('250.414.528-74', 'BA000000005', 1),
('127.066.920-65', 'BA000000006', 1),
('558.570.920-86', 'BA000000007', 1),
('136.382.370-10', 'BA000000008', 1),
('072.003.190-74', 'BA000000009', 0),
('873.325.550-42', 'BA000000010', 0),
('607.500.500-55', 'BA000000011', 0),
('841.084.862-77', 'BA000000012', 0),
('046.822.991-40', 'BA000000013', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiros_chefes`
--

CREATE TABLE IF NOT EXISTS `enfermeiros_chefes` (
  `CPF` char(14) NOT NULL,
  `COREN` char(12) NOT NULL,
  PRIMARY KEY (`COREN`),
  KEY `CPF` (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `enfermeiros_chefes`:
--   `CPF`
--       `responsaveis` -> `CPF`
--

--
-- Extraindo dados da tabela `enfermeiros_chefes`
--

INSERT INTO `enfermeiros_chefes` (`CPF`, `COREN`) VALUES
('202.457.365-11', 'BA000000001'),
('475.013.135-62', 'BA000000003'),
('658.002.101-02', 'BA000000002');

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
--       `responsaveis` -> `CPF`
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

--
-- Extraindo dados da tabela `leitos`
--

INSERT INTO `leitos` (`Ocupado`, `Identificacao`) VALUES
(0, 'LB001'),
(0, 'LB002'),
(0, 'LB003'),
(0, 'LB004'),
(0, 'LC001'),
(0, 'LC002'),
(0, 'LC003'),
(0, 'LC004'),
(0, 'LD001'),
(0, 'LD002'),
(0, 'LD003'),
(0, 'LD004');

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
--       `responsaveis` -> `CPF`
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

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`Nome_Paciente`, `Sexo`, `Status`, `Data_Nasc`, `CPF`, `Tipo_Sang`) VALUES
('Sueli Luna Martins', 'F', 'alta', '1961-12-12', '009.812.684-98', 'A-'),
('Olivia Natália Sueli de Paula', 'F', 'alta', '1984-05-05', '012.456.594-80', 'AB-'),
('Jennifer Clarice Assunção', 'F', 'alta', '1993-04-09', '029.226.827-06', 'B-'),
('Lorena Lúcia Nascimento', 'F', 'alta', '1943-04-04', '037.734.615-26', 'A-'),
('Tiago Geraldo Fogaça', 'M', 'alta', '1998-01-04', '065.603.436-00', 'O-'),
('Amanda Jéssica Caroline de Paula', 'F', 'alta', '1968-04-06', '065.799.448-03', 'B+'),
('Rosângela Alícia das Neves', 'F', 'alta', '1954-12-24', '068.103.730-04', 'B-'),
('Pietro Levi Cláudio Costa', 'M', 'alta', '1961-02-26', '107.590.579-66', 'A+'),
('Brenda Joana Fernanda Novaes', 'F', 'alta', '1998-11-03', '140.949.640-61', 'O-'),
('Otávio Theo Elias Moura', 'M', 'alta', '1968-08-21', '167.879.644-12', 'B-'),
('Analu Renata Eliane Aragão', 'F', 'alta', '1996-12-09', '188.647.372-27', 'O+'),
('Liz Daiane Cavalcanti', 'F', 'alta', '1980-06-19', '195.907.118-12', 'AB-'),
('Sophia Alícia Campos', 'F', 'alta', '1948-11-01', '201.095.279-09', 'A-'),
('Caleb Bruno Ferreira', 'M', 'alta', '1949-09-25', '224.447.809-22', 'O-'),
('Eliane Julia Aragão', 'F', 'alta', '2002-08-14', '263.899.863-00', 'B+'),
('Stefany Marlene Marina Freitas', 'F', 'alta', '2001-05-07', '269.530.728-49', 'B+'),
('Andreia Ana Campos', 'F', 'alta', '1983-12-06', '294.023.462-01', 'B+'),
('Francisca Joana Simone da Luz', 'F', 'alta', '1961-03-27', '325.227.456-62', 'O+'),
('Vera Tânia Bruna da Conceição', 'F', 'alta', '1953-08-26', '341.846.973-64', 'B+'),
('Hugo Gael Fernandes', 'M', 'alta', '1944-03-12', '345.048.927-58', 'O-'),
('Camila Rosângela Aparecida Melo', 'F', 'alta', '1970-04-10', '419.234.708-33', 'O+'),
('Pedro Henrique Henrique Juan Dias', 'M', 'alta', '1953-02-05', '429.326.274-14', 'AB-'),
('Teresinha Jaqueline da Cunha', 'F', 'alta', '1979-06-05', '436.232.985-49', 'AB+'),
('Anderson Manuel da Cunha', 'M', 'alta', '1967-07-16', '448.953.115-03', 'A-'),
('Ester Maya Alice da Paz', 'F', 'alta', '1971-08-04', '450.331.323-18', 'O+'),
('Leandro Mário Ferreira', 'M', 'alta', '1975-12-21', '483.410.653-55', 'O-'),
('Vinicius Mateus Santos', 'M', 'alta', '1955-09-27', '486.038.078-92', 'A+'),
('Paulo Sebastião Sales', 'M', 'alta', '1982-05-14', '494.194.016-42', 'A-'),
('Giovana Lorena Pires', 'F', 'alta', '1975-12-03', '501.661.629-90', 'AB-'),
('Pietra Mariah da Rosa', 'F', 'alta', '1977-05-11', '530.492.786-92', 'A+'),
('Cauê Ian Victor Lopes', 'M', 'alta', '1955-12-25', '538.758.667-38', 'AB-'),
('Liz Francisca Fogaça', 'F', 'alta', '1998-10-13', '575.168.453-29', 'O+'),
('Guilherme Noah Gael Nascimento', 'M', 'alta', '1975-03-24', '578.205.336-41', 'O-'),
('Francisca Bruna Eduarda Vieira', 'F', 'alta', '1994-06-04', '613.234.078-55', 'B+'),
('Rafaela Eloá Raquel Campos', 'F', 'alta', '2002-08-07', '622.748.620-52', 'A-'),
('Levi Leandro Otávio Duarte', 'M', 'alta', '1974-08-11', '626.142.628-70', 'A+'),
('Esther Benedita Farias', 'F', 'alta', '1948-03-11', '645.173.749-63', 'A-'),
('Bárbara Antonella Marina Corte Real', 'F', 'alta', '1987-12-03', '649.100.528-36', 'O-'),
('Tomás Giovanni Nelson Freitas', 'M', 'alta', '1983-05-06', '666.418.353-67', 'AB-'),
('Carla Isabel Beatriz Fogaça', 'F', 'alta', '1965-12-07', '742.819.788-01', 'AB+'),
('Valentina Fátima Santos', 'F', 'alta', '2000-01-12', '759.661.020-07', 'O-'),
('Stella Camila Castro', 'F', 'alta', '1958-02-26', '787.976.063-67', 'A-'),
('Raimundo Daniel das Neves', 'M', 'alta', '1985-09-04', '799.171.576-03', 'A+'),
('Victor Renan Assis', 'M', 'alta', '1948-10-03', '800.170.953-10', 'AB+'),
('Louise Clara Fernanda Teixeira', 'F', 'alta', '1972-10-13', '844.695.514-81', 'O+'),
('Luiz Calebe Luís Castro', 'M', 'alta', '1988-06-04', '851.618.421-80', 'A+'),
('Benjamin Bento Rodrigues', 'M', 'alta', '1967-06-21', '856.213.656-58', 'A+'),
('Isadora Natália da Mata', 'F', 'alta', '1955-11-12', '901.930.181-01', 'AB+'),
('Analu Aparecida Vanessa Brito', 'F', 'alta', '1963-02-19', '921.670.790-95', 'B+'),
('Analu Caroline dos Santos', 'F', 'alta', '1989-12-01', '981.757.680-96', 'O-');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao_cargo`
--

CREATE TABLE IF NOT EXISTS `permissao_cargo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `permissao_id` int(10) NOT NULL,
  `cargo_id` int(10) NOT NULL,
  `ativo` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permissao_id` (`permissao_id`),
  KEY `cargo_id` (`cargo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `permissao_cargo`:
--   `cargo_id`
--       `cargo` -> `id`
--   `permissao_id`
--       `permissoes` -> `id`
--

--
-- Extraindo dados da tabela `permissao_cargo`
--

INSERT INTO `permissao_cargo` (`id`, `permissao_id`, `cargo_id`, `ativo`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),

(7, 7, 2, 1),
(8, 8, 2, 1),
(9, 9, 2, 1),
(10, 10, 2, 1),
(11, 11, 2, 1),
(12, 12, 2, 1),
(13, 13, 2, 1),
(14, 14, 2, 1),
(15, 15, 2, 1),
(16, 16, 2, 1),
(17, 17, 2, 1),
(18, 18, 2, 1),
(19, 19, 2, 1),
(20, 20, 2, 1),
(21, 21, 2, 1),
(22, 22, 2, 1),
(23, 23, 2, 1),
(24, 24, 2, 1),
(25, 25, 2, 1),
(26, 26, 2, 1),
(27, 27, 2, 1),
(28, 28, 2, 1),
(29, 29, 2, 1),
(30, 30, 2, 1),
(31, 31, 2, 1),
(32, 32, 2, 1),
(33, 33, 2, 1),
(34, 34, 2, 1),
(35, 35, 2, 1),

(36, 10, 3, 1),
(37, 11, 3, 1),
(38, 15, 3, 1),
(39, 17, 3, 1),
(40, 18, 3, 1),
(41, 19, 3, 1),
(42, 20, 3, 1),
(43, 21, 3, 1),
(44, 22, 3, 1),
(45, 23, 3, 1),
(46, 24, 3, 1),
(47, 25, 3, 1),
(48, 26, 3, 1),
(49, 27, 3, 1),
(50, 28, 3, 1),
(51, 31, 3, 1),
(52, 32, 3, 1),
(53, 33, 3, 1),
(54, 34, 3, 1),

(55, 15, 4, 1),
(56, 18, 4, 1),
(57, 19, 4, 1),
(58, 20, 4, 1),
(59, 22, 4, 1),
(60, 23, 4, 1),
(61, 24, 4, 1),
(62, 27, 4, 1),
(63, 28, 4, 1),
(64, 31, 4, 1),
(65, 32, 4, 1),
(66, 34, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `permissoes`:
--

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `nome`) VALUES
(1, 'Cadastrar funcionário'),
(2, 'Remover funcionário'),
(3, 'Alterar atribuição do funcionário'),
(4, 'Editar permissões de cargo'),
(5, 'Visualizar permissões de cargo'),
(6, 'Realizar / Agendar Backup'),
(7, 'Cadastro de plantonista'),
(8, 'Remoção de plantonista'),
(9, 'Cadastro de medicamentos'),
(10, 'Cadastro de CID'),
(11, 'Remoção de CID'),
(12, 'Cadastro de agendamento'),
(13, 'Alocar responsável por agendamento'),
(14, 'Listagem de plantonistas'),
(15, 'Listagem de agendamentos'),
(16, 'Responsáveis por aplicação de medicamentos'),
(17, 'Cadastro de pacientes'),
(18, 'Visualizar pacientes e prontuários'),
(19, 'Acesso ao prontuário do paciente'),
(20, 'Editar informações pessoais do paciente'),
(21, 'Listagem de medicamentos para preparação'),
(22, 'Visualização de agendamento realizados pelo funcio'),
(23, 'Visualização de agendamento alocados para o funcio'),
(24, 'Aplicação de medicamentos'),
(25, 'Nomear-se responsável por preparar a aplicação'),
(26, 'Dar baixa no agendamento'),
(27, 'Visualizar ocorrências do paciente'),
(28, 'Registro de ocorrências'),
(29, 'Cadastro e alocação do leito'),
(30, 'Remoção do leito'),
(31, 'Inserir data de internação do paciente'),
(32, 'Inserir data de saída do paciente'),
(33, 'Cadastrar Prontuário'),
(34, 'Visualizar histórico de prontuários'),
(35, 'Listagem de medicamentos cadastrados');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prontuarios`
--

CREATE TABLE IF NOT EXISTS `prontuarios` (
  `aberto` tinyint(1) NOT NULL,
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `Sexo` enum('M','F') NOT NULL,
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
('021.446.717-41', 'João da Silva e Silva', 'silvajao123', 'joaosilva.hp@gmail.com', '1980-12-05', 'Administrador', 'M', '0010101'),
('046.822.991-40', 'Fernando Miguel Galvão', 'GFdZCYh6Yo', 'fernandomiguelgalvao-92@gmail.com', '1959-04-23', 'Enfermeiro', 'M', '011010001'),
('072.003.190-74', 'Isaac Márcio Enrico Almada', 'malfada234', 'malfada.enricoIsaac@gmail.com', '1988-07-26', 'Enfermeiro', 'M', '110100101'),
('127.066.920-65', 'Rafael Yago Rocha', 'goya761s', 'Yagorafael.hp@gmail.com', '1968-09-26', 'Enfermeiro', 'M', '11010010100'),
('136.382.370-10', 'Diego Luan Cardoso', 'dosos23doso12', 'dieguinho87luan@gmail.com', '1968-02-18', 'Enfermeiro', 'M', '1101010'),
('174.985.367-13', 'Juscelino Silva dos Santos', 'jusck987', 'santosjuscelino.hp@gmail.com', '1976-01-19', 'Administrador', 'M', '11010110'),
('175.585.124-92', 'Maria joaquina Drumond', 'maria981', 'mariazinhaquina@gmail.com', '1995-07-12', 'Administrador', 'F', '00100101'),
('202.457.365-11', 'Vinicius Martins magalhães', 'viniciinEhdeiz10', 'mmvinicius@gmail.com', '1989-09-24', 'Enfermeiro Chefe', 'M', '00110101001'),
('213.223.336-53', 'Severino Nathan Ferreira', 'frefedo872', 'severinonathanferreira@gmail.com', '1996-02-17', 'Estagiario', 'M', '011111000'),
('250.414.528-74', 'Alfredo Estrada Félix', 'frefedo872', 'estrada.felixfred@gmail.com', '1979-02-27', 'Enfermeiro', 'M', '110100101'),
('252.696.001-73', 'Brenda Estefanir souza', '09szai2', 'brendasouza.hp@gmail.com', '1995-07-29', 'Enfermeiro', 'F', '0100110101011'),
('475.013.135-62', 'Ana Catarina Melo', '09annamello', 'anna.melocatarina@gmail.com', '1986-10-11', 'Enfermeiro Chefe', 'F', '010010110'),
('558.570.920-86', 'Jaqueline Marina da Cunha', 'cunh87ja212que', 'cunha.jaquemarina@gmail.com', '1987-08-21', 'Enfermeiro', 'F', '0010110101'),
('607.500.500-55', 'Alfredo Estrada Félix', 'frefedo872', 'suelimirellaaparecidadossantos@gmail.com', '1971-01-21', 'Enfermeiro', 'F', '11001010'),
('645.566.964-96', 'Nina Gabriela Camila Figueiredo', '7bfc8LG23j', 'inagabrielacamilafigueiredo@gmail.com', '1971-01-21', 'Estagiario', 'F', '010100111'),
('657.687.833-85', 'Rayssa Larissa da Rosa', 'ro029090710sa', 'rrayssalarissadarosa@gmail.com', '1994-11-14', 'Estagiario', 'F', '00100010'),
('658.002.101-02', 'Ambrozina pereira amorim', '98378s2', 'amorim.Ambozina@gmail.com', '1974-04-27', 'Enfermeiro Chefe', 'F', '10001010'),
('841.084.862-77', 'Diego Theo Nathan Vieira', '08F993d2gq', '_diegotheonathanvieira@gmail.com', '1992-02-25', 'Enfermeiro', 'M', '1010010101'),
('868.500.956-17', 'Marlene Sarah Alana Moura', 'm4a13mp0s8m', 'smmarlenesarahalanamoura@gmail.com', '1992-11-06', 'Estagiario', 'F', '01001010'),
('873.325.550-42', 'Cauã Mário da Luz', 'luz21s1z', 'cauamariodaluz.81@gmail.com', '1984-07-07', 'Enfermeiro', 'M', '001011011');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  ADD CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`CPF_usuario`) REFERENCES `responsaveis` (`CPF`),
  ADD CONSTRAINT `agendamento_ibfk_3` FOREIGN KEY (`Cod_medicamento`) REFERENCES `medicamentos` (`Codigo`);

--
-- Limitadores para a tabela `agendamento_prontuario`
--
ALTER TABLE `agendamento_prontuario`
  ADD CONSTRAINT `agendamento_prontuario_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  ADD CONSTRAINT `agendamento_prontuario_ibfk_2` FOREIGN KEY (`Codigo_Agendamento`) REFERENCES `agendamentos` (`Codigo`);

--
-- Limitadores para a tabela `cid_prontuario`
--
ALTER TABLE `cid_prontuario`
  ADD CONSTRAINT `cid_prontuario_ibfk_1` FOREIGN KEY (`id_CID`) REFERENCES `cid` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cid_prontuario_ibfk_2` FOREIGN KEY (`id_prontuario`) REFERENCES `prontuarios` (`ID`);

--
-- Limitadores para a tabela `enfermeiros`
--
ALTER TABLE `enfermeiros`
  ADD CONSTRAINT `enfermeiros_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `responsaveis` (`CPF`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `enfermeiros_chefes`
--
ALTER TABLE `enfermeiros_chefes`
  ADD CONSTRAINT `enfermeiros_chefes_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `responsaveis` (`CPF`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `estagiarios`
--
ALTER TABLE `estagiarios`
  ADD CONSTRAINT `estagiarios_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `responsaveis` (`CPF`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD CONSTRAINT `ocorrencia_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  ADD CONSTRAINT `ocorrencia_ibfk_2` FOREIGN KEY (`CPF`) REFERENCES `responsaveis` (`CPF`);

--
-- Limitadores para a tabela `permissao_cargo`
--
ALTER TABLE `permissao_cargo`
  ADD CONSTRAINT `permissao_cargo_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permissao_cargo_ibfk_2` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `responsaveis_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;