/*Cria o banco de dados*/
CREATE DATABASE IF NOT EXISTS hospital_universitario DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE hospital_universitario; /*Seleciona o banco de dados a ser usado*/

/*drop database hospital_universitario;*/

/*Cria tabela de admninistradores*/
CREATE TABLE administradores ( 
  CPF char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de agendamentos*/
CREATE TABLE agendamentos (
  Codigo bigint(20) NOT NULL,
  Posologia float NOT NULL,
  Data_Agend date NOT NULL,
  Realizado tinyint(1) DEFAULT NULL,
  Hora_Agend time NOT NULL,
  ID_prontuario bigint(20) NOT NULL, /* chave primaria */
  CPF_usuario char(14) , /* Chave estrangeira que faz referencia ao Responsavel*/
  Cod_medicamento bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; /* InnoDB é a engine usada para criação do BD*/

/*Cria tabela do relacionamento agendamento<->prontuario*/
CREATE TABLE agendamento_prontuario (
  ID_prontuario bigint(20) DEFAULT NULL, /* Chave estrangeira que faz referencia ao prontuario*/
  Codigo_Agendamento bigint(20) NOT NULL /* Chave estrangeira que faz referencia ao agendamento*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela da CID*/
CREATE TABLE cid (
  ID_prontuario bigint(20) NOT NULL, /* Chave estrangeira que faz referencia ao prontuario*/
  CodCID char(6) NOT NULL,
  Id bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de enfermeiros*/
CREATE TABLE enfermeiros (
  CPF char(14) NOT NULL, /* Chave estrangeira que faz referência ao responsável*/
  COREN char(10) NOT NULL,
  Plantao tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de enfermeiros  chefes*/
CREATE TABLE enfermeiros_chefes (
  CPF char(14) NOT NULL, /* Chave estrangeira que faz referência ao responsável*/
  COREN char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de estagiarios*/
CREATE TABLE estagiarios (
  CPF char(14) NOT NULL, /* Chave estrangeira que faz referência ao responsável*/
  Plantao tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela  log*/
CREATE TABLE log (
  Id bigint(20) NOT NULL,
  Data_Log date NOT NULL,
  Hora_Agend time NOT NULL,
  CPF_usuario varchar(255) NOT NULL, /* Chave estrangeira que faz referencia ao Usuário*/
  Ip varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de medicamentos*/
CREATE TABLE medicamentos (
  Nome_Medicam varchar(50) NOT NULL,
  Quantidade int(11) NOT NULL,
  Fabricante varchar(30) NOT NULL,
  Data_Validade date NOT NULL,
  Codigo bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de ocorrencias*/
CREATE TABLE ocorrencias (
  Codigo bigint(20) NOT NULL,
  Data_ocorr date NOT NULL,
  ID_prontuario bigint(20) NOT NULL,
  Descricao text NOT NULL,
  CPF char(14) NOT NULL /* Chave estrangeira que faz refência ao Responsável*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de prontuarios*/
CREATE TABLE prontuarios (
  ID bigint(20) NOT NULL,  
  Data_Internacao date NOT NULL,
  Data_Saida date NOT NULL,
  Status enum('internado','alta','obito') NOT NULL,  
  Id_leito varchar(20) NOT NULL, /*Chave estrangeira que faz referência ao leito*/
  Cpfpaciente char(14)  /* Chave estrangeira que faz referência ao paciente*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de pacientes*/
CREATE TABLE pacientes (
  Nome_Paciente varchar(50) NOT NULL,
  Sexo varchar(20) NOT NULL,
  Data_Nasc date NOT NULL,
  CPF char(14) NOT NULL,
  Tipo_Sang varchar(5) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de prontuarios*/
CREATE TABLE leitos (
  Ocupado tinyint(1) NOT NULL,
  Identificacao varchar(20) NOT NULL    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de administradores*/
CREATE TABLE responsaveis (
  CPF char(14) NOT NULL /* Chave estrangeira que faz referência ao Usuário*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de usuarios*/
CREATE TABLE usuarios (
  CPF char(14) NOT NULL, /*Chave primaria*/
  Nome varchar(50) NOT NULL,
  Senha varchar(20) NOT NULL,
  Email varchar(50) NOT NULL,
  Data_Nasc date NOT NULL,
  Atribuicao enum('Administrador','Enfermeiro Chefe','Enfermeiro','Estagiario') NOT NULL,
  Sexo varchar(20) NOT NULL,
  Ip varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE administradores
  ADD PRIMARY KEY (CPF); /*seleciona o CPF como chave primaria*/

ALTER TABLE agendamentos
  ADD PRIMARY KEY (Codigo), /*seleciona o Codigo como chave primaria*/
  ADD KEY ID_prontuario (ID_prontuario), /* Seleciona o campo ID_prontuario como uma chave*/
  ADD KEY CPF_usuario (CPF_usuario),	
  ADD KEY Cod_medicamento (Cod_medicamento);

ALTER TABLE agendamento_prontuario
  ADD KEY ID_prontuario (ID_prontuario), /* Seleciona o campo Id_prontuario como uma chave*/
  ADD KEY Codigo_Agendamento (Codigo_Agendamento); /* Seleciona o campo Codigo_agendamento como uma chave*/

ALTER TABLE cid
  ADD PRIMARY KEY (Id), /* Seleciona o campo ID como chave primaria*/
  ADD KEY ID_prontuario (ID_prontuario); /* Seleciona o campo ID_prontuario como chave */

ALTER TABLE enfermeiros
  ADD PRIMARY KEY (COREN), /* Seleciona o campo COREN como chave primaria*/
  ADD KEY CPF (CPF); /* Seleciona o campo CPF como chave */

ALTER TABLE enfermeiros_chefes
  ADD PRIMARY KEY (COREN), /* Seleciona o campo COREN como chave primaria*/
  ADD KEY CPF (CPF); /* Seleciona o campo CPF como chave */

ALTER TABLE estagiarios
  ADD PRIMARY KEY (CPF); /* Seleciona o campo CPF como chave primaria*/

ALTER TABLE log
  ADD PRIMARY KEY (Id); /* Seleciona o campo CPF como chave primaria*/

ALTER TABLE medicamentos
  ADD PRIMARY KEY (Codigo); /* Seleciona o campo Codigo como chave primaria*/

ALTER TABLE ocorrencias
  ADD PRIMARY KEY (Codigo), /* Seleciona o campo Codigo como chave primaria */
  ADD KEY ID_prontuario (ID_prontuario), /* Seleciona o campo como chave */
  ADD KEY CPF (CPF); /* Seleciona o campo como chave */

ALTER TABLE prontuarios
  ADD PRIMARY KEY (ID), /* Seleciona o campo ID como chave primaria*/
  ADD KEY Id_leito (Id_leito), /* Seleciona o campo como chave */
  ADD KEY Cpfpaciente (Cpfpaciente); /* Seleciona o campo como chave */

ALTER TABLE responsaveis
  ADD PRIMARY KEY (CPF); /* Seleciona o campo CPF como chave primaria*/

ALTER TABLE usuarios
  ADD PRIMARY KEY (CPF); /* Seleciona o campo CPF como chave primaria*/
  
ALTER TABLE pacientes
  ADD PRIMARY KEY (CPF); /* Seleciona o campo CPF como chave primaria*/

ALTER TABLE leitos
  ADD PRIMARY KEY (Identificacao); /* Seleciona o campo Identificação como chave primaria*/
  
/*Seção para definição das chaves estrangeiras*/  


ALTER TABLE cid
  MODIFY Id bigint(20) NOT NULL AUTO_INCREMENT;


ALTER TABLE administradores
  ADD CONSTRAINT administradores_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF); /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE agendamentos
  ADD CONSTRAINT agendamento_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuarios (ID), /*Cria chave estrangeira fazendo referencia a prontuario*/
  ADD CONSTRAINT agendamento_ibfk_2 FOREIGN KEY (CPF_usuario) REFERENCES usuarios (CPF), /*Cria chave estrangeira fazendo referencia a Usuario*/
  ADD CONSTRAINT agendamento_ibfk_3 FOREIGN KEY (Cod_medicamento) REFERENCES medicamentos (Codigo); /*Cria chave estrangeira fazendo referencia a medicamento*/

ALTER TABLE agendamento_prontuario
  ADD CONSTRAINT agendamento_prontuario_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuarios (ID), /*Cria chave estrangeira fazendo referencia a prontuario*/
  ADD CONSTRAINT agendamento_prontuario_ibfk_2 FOREIGN KEY (Codigo_Agendamento) REFERENCES agendamentos (Codigo);

ALTER TABLE cid
  ADD CONSTRAINT cid_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuarios (ID);/*Cria chave estrangeira fazendo referencia a prontuario*/

ALTER TABLE enfermeiros
  ADD CONSTRAINT enfermeiros_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF);/*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE enfermeiros_chefes
  ADD CONSTRAINT enfermeiros_chefes_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF); /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE estagiarios
  ADD CONSTRAINT estagiarios_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF); /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE ocorrencias
  ADD CONSTRAINT ocorrencia_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuarios (ID), /*Cria chave estrangeira fazendo referencia a prontuario*/
  ADD CONSTRAINT ocorrencia_ibfk_2 FOREIGN KEY (CPF) REFERENCES usuarios (CPF); /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE responsaveis
  ADD CONSTRAINT responsaveis_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF); /*Cria chave estrangeira fazendo referencia a Usuario*/
  
ALTER TABLE prontuarios
  ADD CONSTRAINT prontuario_ibfk_1 FOREIGN KEY (Id_leito) REFERENCES leitos (Identificacao), /*Cria chave estrangeira fazendo referencia a leito*/
  ADD CONSTRAINT prontuario_ibfk_2 FOREIGN KEY (Cpfpaciente) REFERENCES pacientes (CPF); /*Cria chave estrangeira fazendo referencia a paciente*/
