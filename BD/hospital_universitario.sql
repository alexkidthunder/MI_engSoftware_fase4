CREATE DATABASE IF NOT EXISTS hospital_universitario DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE hospital_universitario;

/*Cria tabela de admninistradores*/
CREATE TABLE administradores ( 
  CPF char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de agendamentos*/
CREATE TABLE agendamento (
  Codigo bigint(20) NOT NULL,
  Posologia float NOT NULL,
  Data_Agend date NOT NULL,
  Realizado tinyint(1) DEFAULT NULL,
  Hora_Agend time NOT NULL,
  ID_prontuario bigint(20) NOT NULL,
  CPF_usuario char(14) , /* Cahve estrangeira que refencia o Responsavel*/
  Cod_medicamento bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela do relacionamento agendamento<->prontuario*/
CREATE TABLE agendamento_prontuario (
  ID_prontuario bigint(20) DEFAULT NULL,
  Codigo_Agendamento bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela da CID*/
CREATE TABLE cid (
  ID_prontuario bigint(20) NOT NULL,
  CodCID char(6) NOT NULL,
  Id bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de enfermeiros*/
CREATE TABLE enfermeiros (
  CPF char(14) NOT NULL,
  COREN char(10) NOT NULL,
  Plantao tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de enfermeiros  chefes*/
CREATE TABLE enfermeiros_chefes (
  CPF char(14) NOT NULL,
  COREN char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de estagiarios*/
CREATE TABLE estagiarios (
  CPF char(14) NOT NULL,
  Plantao tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela  log*/
CREATE TABLE log (
  Id bigint(20) NOT NULL,
  Data_Log date NOT NULL,
  Hora_Agend time NOT NULL,
  CPF_usuario varchar(255) NOT NULL,
  Ip varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de medicamentos*/
CREATE TABLE medicamento (
  Nome_Medicam varchar(50) NOT NULL,
  Quantidade int(11) NOT NULL,
  Fabricante varchar(30) NOT NULL,
  Data_Validade date NOT NULL,
  Codigo bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de ocorrencias*/
CREATE TABLE ocorrencia (
  Codigo bigint(20) NOT NULL,
  Data_ocorr date NOT NULL,
  ID_prontuario bigint(20) NOT NULL,
  Descricao text NOT NULL,
  CPF char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de prontuarios*/
CREATE TABLE prontuario (
  ID bigint(20) NOT NULL,  
  Data_Internacao date NOT NULL,
  Data_Saida date NOT NULL,
  Status enum('internado','alta','obito') NOT NULL,  
  Id_leito varchar(20) NOT NULL,
  Cpfpaciente char(14)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de prontuarios*/
CREATE TABLE paciente (
  Nome_Paciente varchar(50) NOT NULL,
  Sexo varchar(20) NOT NULL,
  Data_Nasc date NOT NULL,
  CPF char(14) NOT NULL,
  Tipo_Sang varchar(5) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de prontuarios*/
CREATE TABLE leito (
  Ocupado tinyint(1) NOT NULL,
  Identificacao varchar(20) NOT NULL    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de administradores*/
CREATE TABLE responsaveis (
  CPF char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de usuarios*/
CREATE TABLE usuarios (
  CPF char(14) NOT NULL,
  Nome varchar(50) NOT NULL,
  Senha varchar(20) NOT NULL,
  Email varchar(50) NOT NULL,
  Data_Nasc date NOT NULL,
  Atribuicao enum('Administrador','Enfermeiro Chefe','Enfermeiro','Estagiario') NOT NULL,
  Sexo varchar(20) NOT NULL,
  Ip varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE administradores
  ADD PRIMARY KEY (CPF);

ALTER TABLE agendamento
  ADD PRIMARY KEY (Codigo),
  ADD KEY ID_prontuario (ID_prontuario),
  ADD KEY CPF_usuario (CPF_usuario),
  ADD KEY Cod_medicamento (Cod_medicamento);

ALTER TABLE agendamento_prontuario
  ADD KEY ID_prontuario (ID_prontuario),
  ADD KEY Codigo_Agendamento (Codigo_Agendamento);

ALTER TABLE cid
  ADD PRIMARY KEY (Id),
  ADD KEY ID_prontuario (ID_prontuario);

ALTER TABLE enfermeiros
  ADD PRIMARY KEY (COREN),
  ADD KEY CPF (CPF);

ALTER TABLE enfermeiros_chefes
  ADD PRIMARY KEY (COREN),
  ADD KEY CPF (CPF);

ALTER TABLE estagiarios
  ADD PRIMARY KEY (CPF);

ALTER TABLE log
  ADD PRIMARY KEY (Id);

ALTER TABLE medicamento
  ADD PRIMARY KEY (Codigo);

ALTER TABLE ocorrencia
  ADD PRIMARY KEY (Codigo),
  ADD KEY ID_prontuario (ID_prontuario),
  ADD KEY CPF (CPF);

ALTER TABLE prontuario
  ADD PRIMARY KEY (ID),
  ADD KEY Id_leito (Id_leito),
  ADD KEY Cpfpaciente (Cpfpaciente);

ALTER TABLE responsaveis
  ADD PRIMARY KEY (CPF);

ALTER TABLE usuarios
  ADD PRIMARY KEY (CPF);
  
ALTER TABLE paciente
  ADD PRIMARY KEY (CPF);

ALTER TABLE leito
  ADD PRIMARY KEY (Identificacao);
  
  


ALTER TABLE cid
  MODIFY Id bigint(20) NOT NULL AUTO_INCREMENT;


ALTER TABLE administradores
  ADD CONSTRAINT administradores_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF);

ALTER TABLE agendamento
  ADD CONSTRAINT agendamento_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuario (ID),
  ADD CONSTRAINT agendamento_ibfk_2 FOREIGN KEY (CPF_usuario) REFERENCES usuarios (CPF),
  ADD CONSTRAINT agendamento_ibfk_3 FOREIGN KEY (Cod_medicamento) REFERENCES medicamento (Codigo);

ALTER TABLE agendamento_prontuario
  ADD CONSTRAINT agendamento_prontuario_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuario (ID),
  ADD CONSTRAINT agendamento_prontuario_ibfk_2 FOREIGN KEY (Codigo_Agendamento) REFERENCES agendamento (Codigo);

ALTER TABLE cid
  ADD CONSTRAINT cid_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuario (ID);

ALTER TABLE enfermeiros
  ADD CONSTRAINT enfermeiros_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF);

ALTER TABLE enfermeiros_chefes
  ADD CONSTRAINT enfermeiros_chefes_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF);

ALTER TABLE estagiarios
  ADD CONSTRAINT estagiarios_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF);

ALTER TABLE ocorrencia
  ADD CONSTRAINT ocorrencia_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuario (ID),
  ADD CONSTRAINT ocorrencia_ibfk_2 FOREIGN KEY (CPF) REFERENCES usuarios (CPF);

ALTER TABLE responsaveis
  ADD CONSTRAINT responsaveis_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF);
  
ALTER TABLE prontuario
  ADD CONSTRAINT prontuario_ibfk_1 FOREIGN KEY (Id_leito) REFERENCES leito (Identificacao),
  ADD CONSTRAINT prontuario_ibfk_2 FOREIGN KEY (Cpfpaciente) REFERENCES paciente (CPF);  ADD CONSTRAINT prontuario_ibfk_2 FOREIGN KEY (Cpfpaciente) REFERENCES paciente (CPF);
