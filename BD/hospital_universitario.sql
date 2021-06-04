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
  CPF_usuario char(14) , /* Chave estrangeira que faz referencia ao Usuários*/
  Cod_medicamento bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; /* InnoDB é a engine usada para criação do BD*/

/*Cria tabela do relacionamento agendamento<->prontuario*/
CREATE TABLE agendamento_prontuario (
  ID_prontuario bigint(20) DEFAULT NULL, /* Chave estrangeira que faz referencia ao prontuario*/
  Codigo_Agendamento bigint(20) NOT NULL /* Chave estrangeira que faz referencia ao agendamento*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de cargo*/
CREATE TABLE cargo (
  id int(10) NOT NULL,
  nome varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela da CID*/
CREATE TABLE cid (
  id bigint(20) NOT NULL,
  codCid char(50) NOT NULL,
  descricaoCid text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela da CID relacionada aos prontuários*/
CREATE TABLE cid_prontuario (
  id bigint(20) NOT NULL,
  id_CID bigint(20) NOT NULL,
  id_prontuario bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de Responsavel*/
CREATE TABLE responsaveis(
	CPF char(14) NOT NULL /* Chave estrangeira que faz referência ao usuarios*/
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de enfermeiros*/
CREATE TABLE enfermeiros (
  CPF char(14) NOT NULL, /* Chave estrangeira que faz referência ao usuarios*/
  COREN char(12) NOT NULL,
  Plantao tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de enfermeiros  chefes*/
CREATE TABLE enfermeiros_chefes (
  CPF char(14) NOT NULL, /* Chave estrangeira que faz referência ao usuarios*/
  COREN char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de estagiarios*/
CREATE TABLE estagiarios (
  CPF char(14) NOT NULL, /* Chave estrangeira que faz referência ao usuarios*/
  Plantao tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de Leitos*/
CREATE TABLE leitos (
  Ocupado tinyint(1) NOT NULL,
  Identificacao varchar(20) NOT NULL    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela  logs*/
CREATE TABLE logs (
  Id bigint(20) NOT NULL,
  Data_Log date NOT NULL,
  Hora_Agend time NOT NULL,
  Ip varchar(15) NOT NULL,
  Acao text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de medicamentos*/
CREATE TABLE medicamentos (
  Nome_Medicam varchar(50) NOT NULL,
  Quantidade int(11) NOT NULL,
  Fabricante varchar(80) NOT NULL,
  Data_Validade date NOT NULL,
  Codigo bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de ocorrencias*/
CREATE TABLE ocorrencias (
  Codigo bigint(20) NOT NULL,
  Data_ocorr date NOT NULL,  
  Hora_ocorr time NOT NULL,
  ID_prontuario bigint(20) NOT NULL,
  Descricao text NOT NULL,
  CPF char(14)  /* Chave estrangeira que faz refência ao usuarios*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de pacientes*/
CREATE TABLE pacientes (
  Nome_Paciente varchar(50) NOT NULL,
  Sexo varchar(20) NOT NULL,
  Estado enum('internado','alta','obito') NOT NULL,  
  Data_Nasc date NOT NULL,
  CPF char(14) NOT NULL,
  Tipo_Sang varchar(5) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de permissões relacionada aos cargos*/
CREATE TABLE permissao_cargo (
  id int(10) NOT NULL,
  permissao_id int(10) NOT NULL,
  cargo_id int(10) NOT NULL,
  ativo int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de permissões*/
CREATE TABLE permissoes (
  id int(10) NOT NULL,
  nome varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de prontuarios*/
CREATE TABLE prontuarios (
  aberto tinyint(1) NOT NULL, 
  ID bigint(20) NOT NULL,   
  Data_Internacao date NOT NULL,
  Data_Saida date NOT NULL,
  Id_leito varchar(20) NOT NULL, /*Chave estrangeira que faz referência ao leito*/
  Cpfpaciente char(14)  /* Chave estrangeira que faz referência ao paciente*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Cria tabela de usuarios*/
CREATE TABLE usuarios (
  CPF char(14) NOT NULL, /*Chave primaria*/
  Nome varchar(50) NOT NULL,
  Senha varchar(60) NOT NULL,
  Email varchar(50) NOT NULL,
  Data_Nasc date NOT NULL,
  Atribuicao enum('Administrador','Enfermeiro Chefe','Enfermeiro','Estagiario') NOT NULL,
  Sexo enum('M','F') NOT NULL,
  Ip varchar(15) NOT NULL,
  Ativo tinyint(1) NOT NULL
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

ALTER TABLE cargo
  ADD PRIMARY KEY (id); /*seleciona o id como chave primaria*/

ALTER TABLE cid
  ADD PRIMARY KEY (id); /* Seleciona o campo ID como chave primaria*/

ALTER TABLE cid_prontuario
  ADD PRIMARY KEY (id),
  ADD KEY id_CID (id_CID),
  ADD KEY id_prontuario (id_prontuario);

ALTER TABLE responsaveis
  ADD PRIMARY KEY CPF (CPF), /* Seleciona o campo CPF como chave primaria*/
  ADD UNIQUE KEY CPF (CPF);

ALTER TABLE usuarios
  ADD PRIMARY KEY CPF (CPF); /* Seleciona o campo CPF como chave primaria*/
  
ALTER TABLE enfermeiros
  ADD PRIMARY KEY (COREN), /* Seleciona o campo COREN como chave primaria*/
  ADD KEY CPF (CPF); /* Seleciona o campo CPF como chave */

ALTER TABLE enfermeiros_chefes
  ADD PRIMARY KEY (COREN), /* Seleciona o campo COREN como chave primaria*/
  ADD KEY CPF (CPF); /* Seleciona o campo CPF como chave */

ALTER TABLE estagiarios
  ADD PRIMARY KEY (CPF); /* Seleciona o campo CPF como chave primaria*/

ALTER TABLE logs
  ADD PRIMARY KEY (Id); /* Seleciona o campo CPF como chave primaria*/

ALTER TABLE medicamentos
  ADD PRIMARY KEY (Codigo); /* Seleciona o campo Codigo como chave primaria*/

ALTER TABLE ocorrencias
  ADD PRIMARY KEY (Codigo), /* Seleciona o campo Codigo como chave primaria */
  ADD KEY ID_prontuario (ID_prontuario), /* Seleciona o campo como chave */
  ADD KEY CPF (CPF); /* Seleciona o campo como chave */

ALTER TABLE permissao_cargo
  ADD PRIMARY KEY (id),
  ADD KEY permissao_id (permissao_id),
  ADD KEY cargo_id (cargo_id);   

ALTER TABLE permissoes
  ADD PRIMARY KEY (id); /*seleciona o id como chave primaria*/  

ALTER TABLE prontuarios
  ADD PRIMARY KEY (ID), /* Seleciona o campo ID como chave primaria*/
  ADD KEY Id_leito (Id_leito), /* Seleciona o campo como chave */
  ADD KEY Cpfpaciente (Cpfpaciente); /* Seleciona o campo como chave */

  
ALTER TABLE pacientes
  ADD PRIMARY KEY (CPF); /* Seleciona o campo CPF como chave primaria*/

ALTER TABLE leitos
  ADD PRIMARY KEY (Identificacao); /* Seleciona o campo Identificação como chave primaria*/
  
/*Seção para modificação das das tabelas*/  

ALTER TABLE logs
  MODIFY Id bigint(20) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE cid
  MODIFY id bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE cid_prontuario
  MODIFY id bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE permissao_cargo /*Faz com que o campo Id tenha auto incremento a partir do primeiro*/
  MODIFY id int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE permissoes /*Faz com que o campo Id tenha auto incremento a partir do primeiro*/
  MODIFY id int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE prontuarios
  MODIFY COLUMN ID bigint(20) NOT NULL AUTO_INCREMENT; /*Faz com que o campo Id tenha auto incremento*/

ALTER TABLE ocorrencias
  MODIFY Codigo bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE agendamentos
  MODIFY Codigo bigint(20) NOT NULL AUTO_INCREMENT;

/*Seção para definição das chaves estrangeiras*/  

ALTER TABLE administradores
  ADD CONSTRAINT administradores_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF) ON DELETE CASCADE; /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE agendamentos
  ADD CONSTRAINT agendamento_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuarios (ID), /*Cria chave estrangeira fazendo referencia a prontuario*/
  ADD CONSTRAINT agendamento_ibfk_2 FOREIGN KEY (CPF_usuario) REFERENCES responsaveis (CPF), /*Cria chave estrangeira fazendo referencia a responsaveis*/
  ADD CONSTRAINT agendamento_ibfk_3 FOREIGN KEY (Cod_medicamento) REFERENCES medicamentos (Codigo); /*Cria chave estrangeira fazendo referencia a medicamento*/

ALTER TABLE agendamento_prontuario
  ADD CONSTRAINT agendamento_prontuario_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuarios (ID), /*Cria chave estrangeira fazendo referencia a prontuario*/
  ADD CONSTRAINT agendamento_prontuario_ibfk_2 FOREIGN KEY (Codigo_Agendamento) REFERENCES agendamentos (Codigo);

ALTER TABLE cid_prontuario
  ADD CONSTRAINT cid_prontuario_ibfk_1 FOREIGN KEY (id_CID) REFERENCES cid (id) ON DELETE CASCADE,/*Cria chave estrangeira fazendo referencia ao CID*/
  ADD CONSTRAINT cid_prontuario_ibfk_2 FOREIGN KEY (id_prontuario) REFERENCES prontuarios (ID);/*Cria chave estrangeira fazendo referencia a prontuario*/

ALTER TABLE responsaveis
  ADD CONSTRAINT responsaveis_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF)ON DELETE CASCADE;/*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE enfermeiros
  ADD CONSTRAINT enfermeiros_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF)ON DELETE CASCADE;/*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE enfermeiros_chefes
  ADD CONSTRAINT enfermeiros_chefes_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF)ON DELETE CASCADE; /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE estagiarios
  ADD CONSTRAINT estagiarios_ibfk_1 FOREIGN KEY (CPF) REFERENCES usuarios (CPF)ON DELETE CASCADE; /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE ocorrencias
  ADD CONSTRAINT ocorrencia_ibfk_1 FOREIGN KEY (ID_prontuario) REFERENCES prontuarios (ID), /*Cria chave estrangeira fazendo referencia a prontuario*/
  ADD CONSTRAINT ocorrencia_ibfk_2 FOREIGN KEY (CPF) REFERENCES usuarios (CPF); /*Cria chave estrangeira fazendo referencia a Usuario*/

ALTER TABLE permissao_cargo
  ADD CONSTRAINT permissao_cargo_ibfk_1 FOREIGN KEY (cargo_id) REFERENCES cargo (id) ON DELETE CASCADE,/*Cria chave estrangeira fazendo referencia a cargo*/
  ADD CONSTRAINT permissao_cargo_ibfk_2 FOREIGN KEY (permissao_id) REFERENCES permissoes (id) ON DELETE CASCADE;/*Cria chave estrangeira fazendo referencia a permissoes*/

ALTER TABLE prontuarios
  ADD CONSTRAINT prontuario_ibfk_1 FOREIGN KEY (Id_leito) REFERENCES leitos (Identificacao), /*Cria chave estrangeira fazendo referencia a leito*/
  ADD CONSTRAINT prontuario_ibfk_2 FOREIGN KEY (Cpfpaciente) REFERENCES pacientes (CPF); /*Cria chave estrangeira fazendo referencia a paciente*/
