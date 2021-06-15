

CREATE TABLE `usuarios` (
  `CPF` char(14) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Senha` varchar(60) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Data_Nasc` date NOT NULL,
  `Atribuicao` enum('Administrador','Enfermeiro Chefe','Enfermeiro','Estagiario') NOT NULL,
  `Sexo` enum('M','F') NOT NULL,
  `Ip` varchar(15) NOT NULL,
  `Ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `estagiarios` (
  `CPF` char(14) NOT NULL,
  `Plantao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CPF`),
  CONSTRAINT `estagiarios_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `enfermeiros_chefes` (
  `CPF` char(14) NOT NULL,
  `COREN` char(12) NOT NULL,
  PRIMARY KEY (`COREN`),
  KEY `CPF` (`CPF`),
  CONSTRAINT `enfermeiros_chefes_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `enfermeiros` (
  `CPF` char(14) NOT NULL,
  `COREN` char(12) NOT NULL,
  `Plantao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`COREN`),
  KEY `CPF` (`CPF`),
  CONSTRAINT `enfermeiros_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `administradores` (
  `CPF` char(14) NOT NULL,
  PRIMARY KEY (`CPF`),
  CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `pacientes` (
  `Nome_Paciente` varchar(50) NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Estado` enum('internado','alta','obito') NOT NULL,
  `Data_Nasc` date NOT NULL,
  `CPF` char(14) NOT NULL,
  `Tipo_Sang` varchar(5) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `leitos` (
  `Ocupado` tinyint(1) DEFAULT NULL,
  `Identificacao` varchar(20) NOT NULL,
  PRIMARY KEY (`Identificacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `medicamentos` (
  `Nome_Medicam` varchar(50) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Fabricante` varchar(80) NOT NULL,
  `Data_Validade` date NOT NULL,
  `Codigo` bigint(20) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `logs` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Data_Log` date NOT NULL,
  `Hora_Agend` time NOT NULL,
  `Ip` varchar(15) NOT NULL,
  `Acao` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `cid` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `codCid` char(50) NOT NULL,
  `descricaoCid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `cargo` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `permissoes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `permissao_cargo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `permissao_id` int(10) NOT NULL,
  `cargo_id` int(10) NOT NULL,
  `ativo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissao_id` (`permissao_id`),
  KEY `cargo_id` (`cargo_id`),
  CONSTRAINT `permissao_cargo_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permissao_cargo_ibfk_2` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `prontuarios` (
  `aberto` tinyint(1) DEFAULT NULL,
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Data_Internacao` date NOT NULL,
  `Data_Saida` date NOT NULL,
  `Id_leito` varchar(20) NOT NULL,
  `Cpfpaciente` char(14) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Id_leito` (`Id_leito`),
  KEY `Cpfpaciente` (`Cpfpaciente`),
  CONSTRAINT `prontuario_ibfk_1` FOREIGN KEY (`Id_leito`) REFERENCES `leitos` (`Identificacao`),
  CONSTRAINT `prontuario_ibfk_2` FOREIGN KEY (`Cpfpaciente`) REFERENCES `pacientes` (`CPF`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `ocorrencias` (
  `Codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `Data_ocorr` date NOT NULL,
  `Hora_ocorr` time NOT NULL,
  `ID_prontuario` bigint(20) NOT NULL,
  `Descricao` text NOT NULL,
  `CPF` char(14) DEFAULT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `ID_prontuario` (`ID_prontuario`),
  KEY `CPF` (`CPF`),
  CONSTRAINT `ocorrencia_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  CONSTRAINT `ocorrencia_ibfk_2` FOREIGN KEY (`CPF`) REFERENCES `usuarios` (`CPF`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `cid_prontuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_CID` bigint(20) NOT NULL,
  `id_prontuario` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_CID` (`id_CID`),
  KEY `id_prontuario` (`id_prontuario`),
  CONSTRAINT `cid_prontuario_ibfk_1` FOREIGN KEY (`id_CID`) REFERENCES `cid` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cid_prontuario_ibfk_2` FOREIGN KEY (`id_prontuario`) REFERENCES `prontuarios` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `backups_agendados` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Data_backup` date NOT NULL,
  `Hora_backup` time NOT NULL,
  `ip` varchar(15) NOT NULL,
  `Automatico` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `agendamentos` (
  `Codigo` bigint(20) NOT NULL AUTO_INCREMENT,
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
  KEY `Cod_medicamento` (`Cod_medicamento`),
  CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`ID_prontuario`) REFERENCES `prontuarios` (`ID`),
  CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`CPF_usuario`) REFERENCES `usuarios` (`CPF`),
  CONSTRAINT `agendamento_ibfk_3` FOREIGN KEY (`Cod_medicamento`) REFERENCES `medicamentos` (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;

INSERT INTO usuarios VALUES("021.446.717-41","João da Silva e Silva","$2y$10$7jWU2w3ajIPD5AWU4waoI.lAVWl6kRLyq5r8AxzmfcTPO8aKKW8AK","joaosilva.hp@gmail.com","1980-12-05","Administrador","M","0010101","1");
INSERT INTO usuarios VALUES("046.822.991-40","Fernando Miguel Galvão","$2y$10$9FsmLSiyhp0xAPLWD7RiZurInmcIj1qQGldVtgKJiP.4YWaYpHf52","fernandomiguelgalvao-92@gmail.com","1959-04-23","Enfermeiro","M","011010001","1");
INSERT INTO usuarios VALUES("072.003.190-74","Isaac Márcio Enrico Almada","$2y$10$SrJHuxfHw3IDg3UcY5WVVOPG.ZyxXySNjV.hzq3F43JknRApuDOxy","malfada.enricoIsaac@gmail.com","1988-07-26","Enfermeiro","M","110100101","1");
INSERT INTO usuarios VALUES("072.341.876-55","annanna","12345","ahhhdhd@gmail.com","2021-06-30","Administrador","F","127.0.0.1","1");
INSERT INTO usuarios VALUES("123.456.090-00","testando o usuário","12345","testuser@gmail.com","2000-06-23","Estagiario","M","127.0.0.1","1");
INSERT INTO usuarios VALUES("127.066.920-65","Rafael Yago Rocha","$2y$10$.BFJ5l8fQCR3clgk2n6N6OnubnB9Pwjzq5mlhxWNRsxZEyV6dD5qm","Yagorafael.hp@gmail.com","1968-09-26","Enfermeiro","M","11010010100","1");
INSERT INTO usuarios VALUES("136.382.370-10","Diego Luan Cardoso","$2y$10$uYc0tNJkj37Ym6H3lhDxYun5ioRSeSC1Obu0tiK3zt2TaFx.DXo/.","dieguinho87luan@gmail.com","1968-02-18","Enfermeiro","M","1101010","1");
INSERT INTO usuarios VALUES("175.585.124-92","Maria joaquina Drumond","$2y$10$833Prl7EMsN8LJ4qgtBh5egUKcN97Pg38aLL414CM.eEdft3as5zK","mariazinhaquina@gmail.com","1995-07-12","Administrador","F","00100101","1");
INSERT INTO usuarios VALUES("202.457.365-11","Vinicius Martins magalhães","$2y$10$m13rSbDG8pumBifJAuLZF.1payfEJBSjSkBkiHxYdcpXPc/ZQ0WHi","mmvinicius@gmail.com","1989-09-24","Enfermeiro Chefe","M","00110101001","1");
INSERT INTO usuarios VALUES("213.223.336-53","Severino Nathan Ferreira","$2y$10$rRw3K2MDhRtuKzZCQD1hM.jOVwuTxWQP6McGSuX39hxeBCjGOg.ne","severinonathanferreira@gmail.com","1996-02-17","Estagiario","M","011111000","1");
INSERT INTO usuarios VALUES("250.414.528-74","Alfredo Estrada Félix","$2y$10$cl2nLZJ2nHvpevacee/ECOizvpoRO3S.4RFkh5ybhu8EK1CiKx8mO","estrada.felixfred@gmail.com","1979-02-27","Enfermeiro","M","110100101","1");
INSERT INTO usuarios VALUES("252.696.001-73","Brenda Estefanir souza","$2y$10$Iefi01NgzHu8ho8JQS6FMOkcwbNFMDqs6ioIdrIejml6Ls8FnJvIS","brendasouza.hp@gmail.com","1995-07-29","Enfermeiro","F","0100110101011","1");
INSERT INTO usuarios VALUES("475.013.135-62","Ana Catarina Melo","$2y$10$dtKg3N94yiKc7jMBvUamXum0LFVa5xlzCfT.dVgZozKEjZLiFntCm","anna.melocatarina@gmail.com","1986-10-11","Enfermeiro Chefe","F","010010110","1");
INSERT INTO usuarios VALUES("558.570.920-86","Jaqueline Marina da Cunha","$2y$10$zg9Vw01B7MbJt1CAXLKSDegalLV/LQQ8iI8nYu5AKmo8xW9vDQqxm","cunha.jaquemarina@gmail.com","1987-08-21","Enfermeiro","F","0010110101","1");
INSERT INTO usuarios VALUES("607.500.500-55","Alfredo Estrada Félix","$2y$10$Wu/px0e4vm4Spgl5MZNSUez5.GAiij1Bwwi1ad.0q795GsD0XxBW2","suelimirellaaparecidadossantos@gmail.com","1971-01-21","Enfermeiro","F","11001010","1");
INSERT INTO usuarios VALUES("645.566.964-96","Nina Gabriela Camila Figueiredo","$2y$10$Onr6Wp/qTFzffQSjEXtwY.6MIwNS97OvqvaPaB4ALl9oXMob/5iY6","inagabrielacamilafigueiredo@gmail.com","1971-01-21","Estagiario","F","010100111","1");
INSERT INTO usuarios VALUES("657.687.833-85","Rayssa Larissa da Rosa","$2y$10$DjAbHQlHcmPAiprncqRuAedBVqjYv4afl0gOZJNC/4RoruAkE1Tsm","rrayssalarissadarosa@gmail.com","1994-11-14","Estagiario","F","00100010","1");
INSERT INTO usuarios VALUES("658.002.101-02","Ambrozina pereira amorim","$2y$10$cQo4T3yyEnZqiHGHUqGfOusxbYhnf6IlT0rV4egtjD.v3QOBFTAWy","amorim.Ambozina@gmail.com","1974-04-27","Enfermeiro Chefe","F","10001010","1");
INSERT INTO usuarios VALUES("841.084.862-77","Diego Theo Nathan Vieira","$2y$10$nyOf77xJhEoO70igqRqQwO3q0W0IMojblRKd7VgLf5B33zT8BKLgS","_diegotheonathanvieira@gmail.com","1992-02-25","Enfermeiro","M","1010010101","1");
INSERT INTO usuarios VALUES("868.500.956-17","Marlene Sarah Alana Moura","$2y$10$/MmXXJJqWGpt.JnNLwIa2.N.AKT1mdmoG4QZrA/B4viXtHuOW8ibW","smmarlenesarahalanamoura@gmail.com","1992-11-06","Estagiario","F","01001010","1");
INSERT INTO usuarios VALUES("873.325.550-42","Cauã Mário da Luz","$2y$10$MhfrDoHO1bSX5TsHJcbUtOvdvv1Gx7CnGT5fgywgqc8dPprnBlnra","cauamariodaluz.81@gmail.com","1984-07-07","Enfermeiro","M","001011011","1");


INSERT INTO estagiarios VALUES("123.456.090-00",0);
INSERT INTO estagiarios VALUES("213.223.336-53",0);
INSERT INTO estagiarios VALUES("645.566.964-96",0);
INSERT INTO estagiarios VALUES("657.687.833-85",0);
INSERT INTO estagiarios VALUES("868.500.956-17",0);


INSERT INTO enfermeiros_chefes VALUES("202.457.365-11","BA000000001");
INSERT INTO enfermeiros_chefes VALUES("475.013.135-62","BA000000003");
INSERT INTO enfermeiros_chefes VALUES("658.002.101-02","BA000000002");


INSERT INTO enfermeiros VALUES("252.696.001-73","BA000000004","1");
INSERT INTO enfermeiros VALUES("250.414.528-74","BA000000005","1");
INSERT INTO enfermeiros VALUES("127.066.920-65","BA000000006","1");
INSERT INTO enfermeiros VALUES("558.570.920-86","BA000000007","1");
INSERT INTO enfermeiros VALUES("136.382.370-10","BA000000008","1");
INSERT INTO enfermeiros VALUES("072.003.190-74","BA000000009",0);
INSERT INTO enfermeiros VALUES("873.325.550-42","BA000000010",0);
INSERT INTO enfermeiros VALUES("607.500.500-55","BA000000011",0);
INSERT INTO enfermeiros VALUES("841.084.862-77","BA000000012",0);
INSERT INTO enfermeiros VALUES("046.822.991-40","BA000000013",0);


INSERT INTO administradores VALUES("021.446.717-41");
INSERT INTO administradores VALUES("072.341.876-55");
INSERT INTO administradores VALUES("175.585.124-92");


INSERT INTO pacientes VALUES("Sueli Luna Martins","F","internado","1961-12-12","009.812.684-98","A-");
INSERT INTO pacientes VALUES("Olivia Natália Sueli de Paula","F","alta","1984-05-05","012.456.594-80","AB-");
INSERT INTO pacientes VALUES("Jennifer Clarice Assunção","F","internado","1993-04-09","029.226.827-06","B-");
INSERT INTO pacientes VALUES("Lorena Lúcia Nascimento","F","internado","1943-04-04","037.734.615-26","A-");
INSERT INTO pacientes VALUES("Tiago Geraldo Fogaça","M","alta","1998-01-04","065.603.436-00","O-");
INSERT INTO pacientes VALUES("Amanda Jéssica Caroline de Paula","F","internado","1968-04-06","065.799.448-03","B+");
INSERT INTO pacientes VALUES("Rosângela Alícia das Neves","F","alta","1954-12-24","068.103.730-04","B-");
INSERT INTO pacientes VALUES("Julho Algustino Silva","M","obito","1990-01-24","107.341.659-12","A+");
INSERT INTO pacientes VALUES("Pietro Levi Cláudio Costa","M","alta","1961-02-26","107.590.579-66","A+");
INSERT INTO pacientes VALUES("Brenda Joana Fernanda Novaes","F","alta","1998-11-03","140.949.640-61","O-");
INSERT INTO pacientes VALUES("Otávio Theo Elias Moura","M","alta","1968-08-21","167.879.644-12","B-");
INSERT INTO pacientes VALUES("Analu Renata Eliane Aragão","F","alta","1996-12-09","188.647.372-27","O+");
INSERT INTO pacientes VALUES("Liz Daiane Cavalcanti","F","alta","1980-06-19","195.907.118-12","AB-");
INSERT INTO pacientes VALUES("Sophia Alícia Campos","F","internado","1948-11-01","201.095.279-09","A-");
INSERT INTO pacientes VALUES("Julho Florence Alves","M","obito","1980-02-04","201.441.679-22","A-");
INSERT INTO pacientes VALUES("Caleb Bruno Ferreira","M","internado","1949-09-25","224.447.809-22","O-");
INSERT INTO pacientes VALUES("Eliane Julia Aragão","F","internado","2002-08-14","263.899.863-00","B+");
INSERT INTO pacientes VALUES("Stefany Marlene Marina Freitas","F","alta","2001-05-07","269.530.728-49","B+");
INSERT INTO pacientes VALUES("Andreia Ana Campos","F","alta","1983-12-06","294.023.462-01","B+");
INSERT INTO pacientes VALUES("Francisca Joana Simone da Luz","F","alta","1961-03-27","325.227.456-62","O+");
INSERT INTO pacientes VALUES("Vera Tânia Bruna da Conceição","F","alta","1953-08-26","341.846.973-64","B+");
INSERT INTO pacientes VALUES("Hugo Gael Fernandes","M","internado","1944-03-12","345.048.927-58","O-");
INSERT INTO pacientes VALUES("Giovano Jorge Cerqueira","M","obito","1985-12-03","401.561.328-95","O-");
INSERT INTO pacientes VALUES("Camila Rosângela Aparecida Melo","F","alta","1970-04-10","419.234.708-33","O+");
INSERT INTO pacientes VALUES("Pedro Henrique Henrique Juan Dias","M","alta","1953-02-05","429.326.274-14","AB-");
INSERT INTO pacientes VALUES("Teresinha Jaqueline da Cunha","F","alta","1979-06-05","436.232.985-49","AB+");
INSERT INTO pacientes VALUES("Anderson Manuel da Cunha","M","alta","1967-07-16","448.953.115-03","A-");
INSERT INTO pacientes VALUES("Ester Maya Alice da Paz","F","internado","1971-08-04","450.331.323-18","O+");
INSERT INTO pacientes VALUES("Giovane Damasco Touro","F","obito","1979-11-07","481.561.521-91","O+");
INSERT INTO pacientes VALUES("Leandro Mário Ferreira","M","alta","1975-12-21","483.410.653-55","O-");
INSERT INTO pacientes VALUES("Vinicius Mateus Santos","M","alta","1955-09-27","486.038.078-92","A+");
INSERT INTO pacientes VALUES("Julia Lama Sousa","F","obito","1978-12-17","491.591.529-81","AB");
INSERT INTO pacientes VALUES("Paulo Sebastião Sales","M","internado","1982-05-14","494.194.016-42","A-");
INSERT INTO pacientes VALUES("Giovana Lorena Pires","F","internado","1975-12-03","501.661.629-90","AB-");
INSERT INTO pacientes VALUES("Pietra Mariah da Rosa","F","alta","1977-05-11","530.492.786-92","A+");
INSERT INTO pacientes VALUES("Cauê Ian Victor Lopes","M","alta","1955-12-25","538.758.667-38","AB-");
INSERT INTO pacientes VALUES("Liz Francisca Fogaça","F","alta","1998-10-13","575.168.453-29","O+");
INSERT INTO pacientes VALUES("Guilherme Noah Gael Nascimento","M","alta","1975-03-24","578.205.336-41","O-");
INSERT INTO pacientes VALUES("Francisca Bruna Eduarda Vieira","F","alta","1994-06-04","613.234.078-55","B+");
INSERT INTO pacientes VALUES("Rafaela Eloá Raquel Campos","F","alta","2002-08-07","622.748.620-52","A-");
INSERT INTO pacientes VALUES("Levi Leandro Otávio Duarte","M","internado","1974-08-11","626.142.628-70","A+");
INSERT INTO pacientes VALUES("Esther Benedita Farias","F","alta","1948-03-11","645.173.749-63","A-");
INSERT INTO pacientes VALUES("Bárbara Antonella Marina Corte Real","F","alta","1987-12-03","649.100.528-36","O-");
INSERT INTO pacientes VALUES("Tomás Giovanni Nelson Freitas","M","alta","1983-05-06","666.418.353-67","AB-");
INSERT INTO pacientes VALUES("Carla Isabel Beatriz Fogaça","F","alta","1965-12-07","742.819.788-01","AB+");
INSERT INTO pacientes VALUES("Valentina Fátima Santos","F","alta","2000-01-12","759.661.020-07","O-");
INSERT INTO pacientes VALUES("Stella Camila Castro","F","alta","1958-02-26","787.976.063-67","A-");
INSERT INTO pacientes VALUES("Raimundo Daniel das Neves","M","internado","1985-09-04","799.171.576-03","A+");
INSERT INTO pacientes VALUES("Victor Renan Assis","M","alta","1948-10-03","800.170.953-10","AB+");
INSERT INTO pacientes VALUES("Louise Clara Fernanda Teixeira","F","alta","1972-10-13","844.695.514-81","O+");
INSERT INTO pacientes VALUES("Luiz Calebe Luís Castro","M","alta","1988-06-04","851.618.421-80","A+");
INSERT INTO pacientes VALUES("Benjamin Bento Rodrigues","M","internado","1967-06-21","856.213.656-58","A+");
INSERT INTO pacientes VALUES("Isadora Natália da Mata","F","internado","1955-11-12","901.930.181-01","AB+");
INSERT INTO pacientes VALUES("Analu Aparecida Vanessa Brito","F","alta","1963-02-19","921.670.790-95","B+");
INSERT INTO pacientes VALUES("Analu Caroline dos Santos","F","alta","1989-12-01","981.757.680-96","O-");


INSERT INTO leitos VALUES(0,"LA001");
INSERT INTO leitos VALUES(0,"LA002");
INSERT INTO leitos VALUES(0,"LA003");
INSERT INTO leitos VALUES(0,"LA004");
INSERT INTO leitos VALUES("1","LB001");
INSERT INTO leitos VALUES("1","LB002");
INSERT INTO leitos VALUES("1","LB003");
INSERT INTO leitos VALUES("1","LB004");
INSERT INTO leitos VALUES("1","LC001");
INSERT INTO leitos VALUES("1","LC002");
INSERT INTO leitos VALUES("1","LC003");
INSERT INTO leitos VALUES("1","LC004");
INSERT INTO leitos VALUES("1","LD001");
INSERT INTO leitos VALUES("1","LD002");
INSERT INTO leitos VALUES("1","LD003");
INSERT INTO leitos VALUES("1","LD004");
INSERT INTO leitos VALUES("1","LE001");
INSERT INTO leitos VALUES("1","LE002");
INSERT INTO leitos VALUES("1","LE003");
INSERT INTO leitos VALUES(0,"LE004");
INSERT INTO leitos VALUES(0,"LF001");
INSERT INTO leitos VALUES(0,"LF002");
INSERT INTO leitos VALUES(0,"LF003");
INSERT INTO leitos VALUES(0,"LF004");
INSERT INTO leitos VALUES(0,"LG001");
INSERT INTO leitos VALUES(0,"LG002");
INSERT INTO leitos VALUES(0,"LG003");
INSERT INTO leitos VALUES(0,"LG004");


INSERT INTO medicamentos VALUES("Dipirona","100","Medley","2027-05-12","1210033020");
INSERT INTO medicamentos VALUES("Atenolol","100","Medley","2027-05-12","1210033452");
INSERT INTO medicamentos VALUES("Losartana","100","Medley","2027-05-12","4320033452");
INSERT INTO medicamentos VALUES("CEFALOTINA SÓDICA","70","AUROBINDO PHARMA INDÚSTRIA FARMACÊUTICA LIMITADA","2026-05-14","500100102151411");
INSERT INTO medicamentos VALUES("CEFOTAXIMA SÓDICA","71","AUROBINDO PHARMA INDÚSTRIA FARMACÊUTICA LIMITADA","2026-05-21","500100305158117");
INSERT INTO medicamentos VALUES("CLORIDRATO DE CIPROFLOXACINO MONOIDRATADO","50","AUROBINDO PHARMA INDÚSTRIA FARMACÊUTICA LIMITADA","2026-04-02","500100401114419");
INSERT INTO medicamentos VALUES("ATENOLOL","25","AUROBINDO PHARMA INDÚSTRIA FARMACÊUTICA LIMITADA","2025-07-01","500103201116110");
INSERT INTO medicamentos VALUES("VALSARTANA","80","EUROFARMA LABORATÓRIOS S.A.","2024-12-12","508014010101404");
INSERT INTO medicamentos VALUES("DELTAMETRINA","60","INFAN INDUSTRIA QUIMICA FARMACEUTICA NACIONAL S/A","2025-11-10","511301501162416");
INSERT INTO medicamentos VALUES("CLORIDRATO DE RANITIDINA","55","SANDOZ DO BRASIL INDÚSTRIA FARMACÊUTICA LTDA","2023-07-20","511502602111117");
INSERT INTO medicamentos VALUES("ACETATO DE DEXAMETASONA","30","SANDOZ DO BRASIL INDÚSTRIA FARMACÊUTICA LTDA","2024-01-21","511502902164410");
INSERT INTO medicamentos VALUES("PANTOPRAZOL SÓDICO SESQUIHIIDRATADO","39","SANDOZ DO BRASIL INDÚSTRIA FARMACÊUTICA LTDA","2024-01-20","511507506119413");
INSERT INTO medicamentos VALUES("DIPIRONA SÓDICA","150","HIPOLABOR FARMACEUTICA LTDA","2027-02-03","511607101153116");
INSERT INTO medicamentos VALUES("MIDAZOLAM","85","HIPOLABOR FARMACEUTICA LTDA","2026-10-11","511607301152415");
INSERT INTO medicamentos VALUES("PARACETAMOL","99","HIPOLABOR FARMACEUTICA LTDA","2028-01-10","511607701134112");
INSERT INTO medicamentos VALUES("SULFATO DE MAGNÉSIO","70","HYPOFARMA - INSTITUTO DE HYPODERMIA E FARMÁCIA LTD","2027-10-13","511803201157415");
INSERT INTO medicamentos VALUES("IBUPROFENO","80","MANTECORP INDÚSTRIA QUÍMICA E FARMACÊUTICA S.A.","2025-05-01","512400201130326");
INSERT INTO medicamentos VALUES("ALPRAZOLAM","35","MANTECORP INDÚSTRIA QUÍMICA E FARMACÊUTICA S.A.","2025-05-01","512400302115411");
INSERT INTO medicamentos VALUES("SULFATO DE SALBUTAMOL","60","INDÚSTRIA QUÍMICA DO ESTADO DE GOIÁS S/A - IQUEGO","2023-06-14","513003501136413");
INSERT INTO medicamentos VALUES("AMOXICILINA TRIIDRATADA","200","INDÚSTRIA QUÍMICA DO ESTADO DE GOIÁS S/A - IQUEGO","2024-06-05","513004101115417");
INSERT INTO medicamentos VALUES("CEFAZOLINA SÓDICA","90","INSTITUTO BIOCHIMICO INDÚSTRIA FARMACÊUTICA LTDA","2022-06-16","513401101154413");
INSERT INTO medicamentos VALUES("OMEPRAZOL","155","INSTITUTO BIOCHIMICO INDÚSTRIA FARMACÊUTICA LTDA","2024-02-14","513402201111412");
INSERT INTO medicamentos VALUES("CLORIDRATO DE VERAPAMIL","500","ARISTON INDÚSTRIAS QUÍMICAS E FARMACÊUTICAS LTDA","2024-05-20","541313070015114");
INSERT INTO medicamentos VALUES("PENICILINA BENZÍLICA POTÁSSICO","150","AGILA ESPECIALIDADES FARMACÊUTICAS LTDA","2023-02-19","541512030000014");
INSERT INTO medicamentos VALUES("CEFTAZIDIMA SODICA","100","AGILA ESPECIALIDADES FARMACÊUTICAS LTDA","2023-06-29","541512030000714");
INSERT INTO medicamentos VALUES("CEFUROXIMA SÓDICA","300","AGILA ESPECIALIDADES FARMACÊUTICAS LTDA","2023-09-09","541512030001104");
INSERT INTO medicamentos VALUES("CEFTRIAXONA DISSÓDICA HEMIEPTAIDRATADA","220","AGILA ESPECIALIDADES FARMACÊUTICAS LTDA","2023-03-19","541512030001214");
INSERT INTO medicamentos VALUES("OXACILINA SÓDICA","250","AGILA ESPECIALIDADES FARMACÊUTICAS LTDA","2023-10-10","541512030002116");
INSERT INTO medicamentos VALUES("AMPICILINA SÓDICA","250","AGILA ESPECIALIDADES FARMACÊUTICAS LTDA","2023-05-19","541512030002316");
INSERT INTO medicamentos VALUES("PIPERACILINA","150","AGILA ESPECIALIDADES FARMACÊUTICAS LTDA","2023-07-15","541512050002513");
INSERT INTO medicamentos VALUES("IOEXOL","95","GE HEALTHCARE DO BRASIL COMÉRCIO E SERVIÇOS PARA EQUIPAMENTOS MEDICO-HOSPITALARE","2023-06-16","541612040000603");
INSERT INTO medicamentos VALUES("IODIXANOL","65","GE HEALTHCARE DO BRASIL COMÉRCIO E SERVIÇOS PARA EQUIPAMENTOS MEDICO-HOSPITALARE","2023-06-16","541612090001004");
INSERT INTO medicamentos VALUES("CETOCONAZOL","125","NATIVITA IND. COM. LTDA.","2023-06-14","542012090002204");
INSERT INTO medicamentos VALUES("DROSPIRENONA","220","ALTHAIA S.A. INDÚSTRIA FARMACÊUTICA","2022-05-11","542112060000106");
INSERT INTO medicamentos VALUES("ATORVASTATINA CÁLCICA","550","SUPERA FARMA LABORATÓRIOS S.A","2028-06-11","542614040002004");
INSERT INTO medicamentos VALUES("CLORIDRATO DE DONEPEZILA","450","SUPERA FARMA LABORATÓRIOS S.A","2025-06-25","542614060002404");
INSERT INTO medicamentos VALUES("IRBESARTANA","130","SUPERA FARMA LABORATÓRIOS S.A","2026-06-04","542614060002604");
INSERT INTO medicamentos VALUES("HIDROCLOROTIAZIDA","300","SUPERA FARMA LABORATÓRIOS S.A","2024-06-12","542614060002804");
INSERT INTO medicamentos VALUES("MESILATO DE ERIBULINA","200","EISAI LABORATÓRIOS LTDA","2024-06-12","542714020000002");
INSERT INTO medicamentos VALUES("ACETATO DE CLORMADINONA","250","GRÜNENTHAL DO BRASIL FARMACÊUTICA LTDA.","2026-06-11","542813120000018");
INSERT INTO medicamentos VALUES("LIDOCAÍNA","300","GRÜNENTHAL DO BRASIL FARMACÊUTICA LTDA.","2024-06-07","542814070000102");
INSERT INTO medicamentos VALUES("LIDOCAÍNA","120","GRÜNENTHAL DO BRASIL FARMACÊUTICA LTDA.","2023-06-07","542814070000502");
INSERT INTO medicamentos VALUES("FATOR VIII DE COAGULAÇÃO","55","EMPRESA BRASILEIRA DE HEMODERIVADOS E BIOTECNOLOGIA","2024-06-12","542914010000304");
INSERT INTO medicamentos VALUES("CLORIDRATO DE FLUOXETINA","200","BLISFARMA INDÚSTRIA FARMACÊUTICA LTDA","2024-06-25","543114040000306");
INSERT INTO medicamentos VALUES("VALSARTANA","50","MOMENTA FARMACÊUTICA LTDA.","2023-06-07","543514060000204");
INSERT INTO medicamentos VALUES("OLMESARTANA MEDOXOMILA","60","MOMENTA FARMACÊUTICA LTDA.","2022-06-15","543514060000804");
INSERT INTO medicamentos VALUES("BERACTANTO","50","ABBVIE FARMACÊUTICA LTDA.","2022-06-16","543714090000117");


INSERT INTO logs VALUES("1","2021-06-14","18:16:02","127.0.0.1","Administrador logou");
INSERT INTO logs VALUES("2","2021-06-14","18:17:45","127.0.0.1","Logout no sistema");
INSERT INTO logs VALUES("3","2021-06-14","18:17:49","127.0.0.1","Enfermeiro chefe logou");
INSERT INTO logs VALUES("4","2021-06-14","18:18:26","127.0.0.1","Logout no sistema");
INSERT INTO logs VALUES("5","2021-06-14","18:18:34","127.0.0.1","Administrador logou");
INSERT INTO logs VALUES("6","2021-06-14","18:18:49","127.0.0.1","Alterou permissões do enfermeiro chefe");
INSERT INTO logs VALUES("7","2021-06-14","18:18:53","127.0.0.1","Logout no sistema");
INSERT INTO logs VALUES("8","2021-06-14","18:18:59","127.0.0.1","Enfermeiro chefe logou");
INSERT INTO logs VALUES("9","2021-06-14","18:19:28","127.0.0.1","Logout no sistema");
INSERT INTO logs VALUES("10","2021-06-14","18:19:45","127.0.0.1","Administrador logou");
INSERT INTO logs VALUES("11","2021-06-14","18:26:17","127.0.0.1","Cadastrou usuário testando o usuário");
INSERT INTO logs VALUES("12","2021-06-14","18:27:26","127.0.0.1","Cadastrou usuário annanna");
INSERT INTO logs VALUES("13","2021-06-14","18:34:13","127.0.0.1","Removeu usuario do sistema");
INSERT INTO logs VALUES("14","2021-06-14","18:40:40","127.0.0.1","Alterou permissões do enfermeiro");
INSERT INTO logs VALUES("15","2021-06-14","18:41:05","127.0.0.1","Alterou permissões do estagiário");




INSERT INTO cargo VALUES("1","Administrador");
INSERT INTO cargo VALUES("2","Enfermeiro Chefe");
INSERT INTO cargo VALUES("3","Enfermeiro");
INSERT INTO cargo VALUES("4","Estagiario");


INSERT INTO permissoes VALUES("1","Cadastrar funcionário");
INSERT INTO permissoes VALUES("2","Remover funcionário");
INSERT INTO permissoes VALUES("3","Alterar atribuição do funcionário");
INSERT INTO permissoes VALUES("4","Editar permissões de cargo");
INSERT INTO permissoes VALUES("5","Visualizar permissões de cargo");
INSERT INTO permissoes VALUES("6","Realizar / Agendar Backup");
INSERT INTO permissoes VALUES("7","Cadastro de plantonista");
INSERT INTO permissoes VALUES("8","Remoção de plantonista");
INSERT INTO permissoes VALUES("9","Cadastro de medicamentos");
INSERT INTO permissoes VALUES("10","Cadastro de CID");
INSERT INTO permissoes VALUES("11","Remoção de CID");
INSERT INTO permissoes VALUES("12","Cadastro de agendamento");
INSERT INTO permissoes VALUES("13","Alocar responsável por agendamento");
INSERT INTO permissoes VALUES("14","Listagem de plantonistas");
INSERT INTO permissoes VALUES("15","Listagem de agendamentos");
INSERT INTO permissoes VALUES("16","Responsáveis por aplicação de medicamentos");
INSERT INTO permissoes VALUES("17","Cadastro de pacientes");
INSERT INTO permissoes VALUES("18","Visualizar pacientes e prontuários");
INSERT INTO permissoes VALUES("19","Acesso ao prontuário do paciente");
INSERT INTO permissoes VALUES("20","Editar informações pessoais do paciente");
INSERT INTO permissoes VALUES("21","Listagem de medicamentos para preparação");
INSERT INTO permissoes VALUES("22","Visualização de agendamento realizados pelo funcio");
INSERT INTO permissoes VALUES("23","Visualização de agendamento alocados para o funcio");
INSERT INTO permissoes VALUES("24","Aplicação de medicamentos");
INSERT INTO permissoes VALUES("25","Nomear-se responsável por preparar a aplicação");
INSERT INTO permissoes VALUES("26","Dar baixa no agendamento");
INSERT INTO permissoes VALUES("27","Visualizar ocorrências do paciente");
INSERT INTO permissoes VALUES("28","Registro de ocorrências");
INSERT INTO permissoes VALUES("29","Cadastro e alocação do leito");
INSERT INTO permissoes VALUES("30","Remoção do leito");
INSERT INTO permissoes VALUES("31","Inserir data de internação do paciente");
INSERT INTO permissoes VALUES("32","Inserir data de saída do paciente");
INSERT INTO permissoes VALUES("33","Cadastrar prontuário");
INSERT INTO permissoes VALUES("34","Visualizar histórico de prontuários");
INSERT INTO permissoes VALUES("35","Listagem de medicamentos cadastrados");


INSERT INTO permissao_cargo VALUES("1","1","1","1");
INSERT INTO permissao_cargo VALUES("2","2","1","1");
INSERT INTO permissao_cargo VALUES("3","3","1","1");
INSERT INTO permissao_cargo VALUES("4","4","1","1");
INSERT INTO permissao_cargo VALUES("5","5","1","1");
INSERT INTO permissao_cargo VALUES("6","6","1","1");
INSERT INTO permissao_cargo VALUES("7","7","2","1");
INSERT INTO permissao_cargo VALUES("8","8","2","1");
INSERT INTO permissao_cargo VALUES("9","9","2","1");
INSERT INTO permissao_cargo VALUES("10","10","2","1");
INSERT INTO permissao_cargo VALUES("11","11","2","1");
INSERT INTO permissao_cargo VALUES("12","12","2","1");
INSERT INTO permissao_cargo VALUES("13","13","2","1");
INSERT INTO permissao_cargo VALUES("14","14","2","1");
INSERT INTO permissao_cargo VALUES("15","15","2","1");
INSERT INTO permissao_cargo VALUES("16","16","2","1");
INSERT INTO permissao_cargo VALUES("17","17","2",0);
INSERT INTO permissao_cargo VALUES("18","18","2","1");
INSERT INTO permissao_cargo VALUES("19","19","2","1");
INSERT INTO permissao_cargo VALUES("20","20","2","1");
INSERT INTO permissao_cargo VALUES("21","21","2","1");
INSERT INTO permissao_cargo VALUES("22","22","2",0);
INSERT INTO permissao_cargo VALUES("23","23","2",0);
INSERT INTO permissao_cargo VALUES("24","24","2","1");
INSERT INTO permissao_cargo VALUES("25","25","2","1");
INSERT INTO permissao_cargo VALUES("26","26","2","1");
INSERT INTO permissao_cargo VALUES("27","27","2","1");
INSERT INTO permissao_cargo VALUES("28","28","2","1");
INSERT INTO permissao_cargo VALUES("29","29","2","1");
INSERT INTO permissao_cargo VALUES("30","30","2","1");
INSERT INTO permissao_cargo VALUES("31","31","2","1");
INSERT INTO permissao_cargo VALUES("32","32","2","1");
INSERT INTO permissao_cargo VALUES("33","33","2","1");
INSERT INTO permissao_cargo VALUES("34","34","2","1");
INSERT INTO permissao_cargo VALUES("35","35","2","1");
INSERT INTO permissao_cargo VALUES("36","7","3","1");
INSERT INTO permissao_cargo VALUES("37","8","3",0);
INSERT INTO permissao_cargo VALUES("38","9","3",0);
INSERT INTO permissao_cargo VALUES("39","10","3","1");
INSERT INTO permissao_cargo VALUES("40","11","3","1");
INSERT INTO permissao_cargo VALUES("41","12","3","1");
INSERT INTO permissao_cargo VALUES("42","13","3","1");
INSERT INTO permissao_cargo VALUES("43","14","3","1");
INSERT INTO permissao_cargo VALUES("44","15","3","1");
INSERT INTO permissao_cargo VALUES("45","16","3",0);
INSERT INTO permissao_cargo VALUES("46","17","3","1");
INSERT INTO permissao_cargo VALUES("47","18","3",0);
INSERT INTO permissao_cargo VALUES("48","19","3","1");
INSERT INTO permissao_cargo VALUES("49","20","3","1");
INSERT INTO permissao_cargo VALUES("50","21","3","1");
INSERT INTO permissao_cargo VALUES("51","22","3",0);
INSERT INTO permissao_cargo VALUES("52","23","3","1");
INSERT INTO permissao_cargo VALUES("53","24","3","1");
INSERT INTO permissao_cargo VALUES("54","25","3","1");
INSERT INTO permissao_cargo VALUES("55","26","3","1");
INSERT INTO permissao_cargo VALUES("56","27","3","1");
INSERT INTO permissao_cargo VALUES("57","28","3",0);
INSERT INTO permissao_cargo VALUES("58","29","3","1");
INSERT INTO permissao_cargo VALUES("59","30","3",0);
INSERT INTO permissao_cargo VALUES("60","31","3","1");
INSERT INTO permissao_cargo VALUES("61","32","3",0);
INSERT INTO permissao_cargo VALUES("62","33","3",0);
INSERT INTO permissao_cargo VALUES("63","34","3",0);
INSERT INTO permissao_cargo VALUES("64","35","3",0);
INSERT INTO permissao_cargo VALUES("65","7","4",0);
INSERT INTO permissao_cargo VALUES("66","8","4",0);
INSERT INTO permissao_cargo VALUES("67","9","4",0);
INSERT INTO permissao_cargo VALUES("68","10","4",0);
INSERT INTO permissao_cargo VALUES("69","11","4","1");
INSERT INTO permissao_cargo VALUES("70","12","4",0);
INSERT INTO permissao_cargo VALUES("71","13","4",0);
INSERT INTO permissao_cargo VALUES("72","14","4","1");
INSERT INTO permissao_cargo VALUES("73","15","4","1");
INSERT INTO permissao_cargo VALUES("74","16","4","1");
INSERT INTO permissao_cargo VALUES("75","17","4","1");
INSERT INTO permissao_cargo VALUES("76","18","4","1");
INSERT INTO permissao_cargo VALUES("77","19","4","1");
INSERT INTO permissao_cargo VALUES("78","20","4","1");
INSERT INTO permissao_cargo VALUES("79","21","4",0);
INSERT INTO permissao_cargo VALUES("80","22","4",0);
INSERT INTO permissao_cargo VALUES("81","23","4","1");
INSERT INTO permissao_cargo VALUES("82","24","4",0);
INSERT INTO permissao_cargo VALUES("83","25","4",0);
INSERT INTO permissao_cargo VALUES("84","26","4",0);
INSERT INTO permissao_cargo VALUES("85","27","4","1");
INSERT INTO permissao_cargo VALUES("86","28","4","1");
INSERT INTO permissao_cargo VALUES("87","29","4",0);
INSERT INTO permissao_cargo VALUES("88","30","4",0);
INSERT INTO permissao_cargo VALUES("89","31","4","1");
INSERT INTO permissao_cargo VALUES("90","32","4","1");
INSERT INTO permissao_cargo VALUES("91","33","4",0);
INSERT INTO permissao_cargo VALUES("92","34","4","1");
INSERT INTO permissao_cargo VALUES("93","35","4",0);


INSERT INTO prontuarios VALUES("1","1","2021-05-11","0000-00-00","LD003","065.799.448-03");
INSERT INTO prontuarios VALUES(0,"2","2020-05-11","2020-05-30","LB001","065.799.448-03");
INSERT INTO prontuarios VALUES(0,"3","2020-01-11","2020-01-22","LB001","065.799.448-03");
INSERT INTO prontuarios VALUES(0,"4","2019-02-11","2019-03-04","LB001","065.799.448-03");
INSERT INTO prontuarios VALUES(0,"5","2005-06-21","2005-07-09","LB001","622.748.620-52");
INSERT INTO prontuarios VALUES(0,"6","2010-01-18","2010-01-31","LB001","622.748.620-52");
INSERT INTO prontuarios VALUES(0,"7","2010-02-06","2010-03-24","LB001","622.748.620-52");
INSERT INTO prontuarios VALUES(0,"8","2001-02-06","2001-02-19","LB001","341.846.973-64");
INSERT INTO prontuarios VALUES(0,"9","2001-07-24","2001-09-12","LB001","341.846.973-64");
INSERT INTO prontuarios VALUES(0,"10","2005-11-01","2006-02-27","LB001","341.846.973-64");
INSERT INTO prontuarios VALUES(0,"11","2008-06-06","2008-06-17","LB001","341.846.973-64");
INSERT INTO prontuarios VALUES(0,"12","2011-04-26","2011-04-30","LB001","341.846.973-64");
INSERT INTO prontuarios VALUES(0,"13","2013-10-12","2013-11-05","LB001","341.846.973-64");
INSERT INTO prontuarios VALUES(0,"14","2016-02-06","2016-03-04","LB001","341.846.973-64");
INSERT INTO prontuarios VALUES(0,"15","2005-08-27","2005-08-30","LB001","429.326.274-14");
INSERT INTO prontuarios VALUES(0,"16","2017-09-18","2018-12-21","LB001","429.326.274-14");
INSERT INTO prontuarios VALUES(0,"17","2020-07-08","2020-07-10","LB001","429.326.274-14");
INSERT INTO prontuarios VALUES(0,"18","2002-05-11","2002-05-16","LB001","167.879.644-12");
INSERT INTO prontuarios VALUES(0,"19","2007-07-25","2007-08-22","LB001","167.879.644-12");
INSERT INTO prontuarios VALUES(0,"20","2009-11-19","2009-12-26","LB001","167.879.644-12");
INSERT INTO prontuarios VALUES(0,"21","2015-07-14","2015-12-07","LB001","167.879.644-12");
INSERT INTO prontuarios VALUES(0,"22","2003-05-14","2003-05-26","LB001","981.757.680-96");
INSERT INTO prontuarios VALUES(0,"23","2003-07-14","2003-07-18","LB001","981.757.680-96");
INSERT INTO prontuarios VALUES(0,"24","2003-07-21","2003-08-29","LB001","981.757.680-96");
INSERT INTO prontuarios VALUES(0,"25","2016-11-17","2016-03-02","LB001","981.757.680-96");
INSERT INTO prontuarios VALUES(0,"26","2017-06-15","2017-07-19","LB001","981.757.680-96");
INSERT INTO prontuarios VALUES(0,"27","2002-08-06","2002-09-13","LB001","325.227.456-62");
INSERT INTO prontuarios VALUES(0,"28","2002-09-14","2002-09-29","LB001","325.227.456-62");
INSERT INTO prontuarios VALUES(0,"29","2007-11-04","2007-11-18","LB001","325.227.456-62");
INSERT INTO prontuarios VALUES(0,"30","2019-04-07","2019-05-05","LB001","325.227.456-62");
INSERT INTO prontuarios VALUES(0,"31","2005-05-10","2015-05-20","LB001","649.100.528-36");
INSERT INTO prontuarios VALUES(0,"32","2012-07-16","2012-08-27","LB001","649.100.528-36");
INSERT INTO prontuarios VALUES(0,"33","2014-10-01","2014-10-05","LB001","649.100.528-36");
INSERT INTO prontuarios VALUES(0,"34","2018-07-08","2018-07-15","LB001","649.100.528-36");
INSERT INTO prontuarios VALUES(0,"35","2001-02-05","2001-02-25","LB001","419.234.708-33");
INSERT INTO prontuarios VALUES(0,"36","2007-07-11","2007-07-15","LB001","419.234.708-33");
INSERT INTO prontuarios VALUES(0,"37","2008-06-24","2008-07-27","LB001","419.234.708-33");
INSERT INTO prontuarios VALUES(0,"38","2011-10-06","2011-11-24","LB001","419.234.708-33");
INSERT INTO prontuarios VALUES(0,"39","2002-01-06","2002-01-15","LB001","759.661.020-07");
INSERT INTO prontuarios VALUES(0,"40","2006-12-22","2007-01-07","LB001","759.661.020-07");
INSERT INTO prontuarios VALUES(0,"41","2020-08-09","2020-08-11","LB001","759.661.020-07");
INSERT INTO prontuarios VALUES(0,"42","2020-04-14","2020-04-14","LB001","759.661.020-07");
INSERT INTO prontuarios VALUES(0,"43","2011-04-17","2011-04-24","LB001","012.456.594-80");
INSERT INTO prontuarios VALUES(0,"44","2011-09-30","2011-10-07","LB001","012.456.594-80");
INSERT INTO prontuarios VALUES(0,"45","2017-01-06","2017-01-24","LB001","012.456.594-80");
INSERT INTO prontuarios VALUES(0,"46","2021-02-06","2021-02-28","LB001","012.456.594-80");
INSERT INTO prontuarios VALUES(0,"47","2000-12-04","2000-12-15","LB001","613.234.078-55");
INSERT INTO prontuarios VALUES(0,"48","2001-07-06","2001-07-11","LB001","613.234.078-55");
INSERT INTO prontuarios VALUES(0,"49","2005-02-22","2005-03-31","LB001","613.234.078-55");
INSERT INTO prontuarios VALUES(0,"50","2013-02-03","2013-02-19","LB001","613.234.078-55");
INSERT INTO prontuarios VALUES(0,"51","2002-08-02","2002-08-15","LB001","575.168.453-29");
INSERT INTO prontuarios VALUES(0,"52","2007-09-24","2007-10-09","LB001","575.168.453-29");
INSERT INTO prontuarios VALUES(0,"53","2007-04-12","2007-04-27","LB001","575.168.453-29");
INSERT INTO prontuarios VALUES(0,"54","2013-10-01","2013-10-14","LB001","575.168.453-29");
INSERT INTO prontuarios VALUES(0,"55","2001-12-16","2001-12-23","LB001","436.232.985-49");
INSERT INTO prontuarios VALUES(0,"56","2003-03-25","2003-03-30","LB001","436.232.985-49");
INSERT INTO prontuarios VALUES(0,"57","2015-05-30","2015-06-11","LB001","436.232.985-49");
INSERT INTO prontuarios VALUES(0,"58","2018-07-25","2018-09-13","LB001","436.232.985-49");
INSERT INTO prontuarios VALUES(0,"60","2001-01-13","2001-01-24","LB001","483.410.653-55");
INSERT INTO prontuarios VALUES(0,"61","2003-11-25","2003-12-12","LB001","483.410.653-55");
INSERT INTO prontuarios VALUES(0,"62","2003-05-19","2003-05-24","LB001","483.410.653-55");
INSERT INTO prontuarios VALUES(0,"63","2004-07-04","2004-07-16","LB001","483.410.653-55");
INSERT INTO prontuarios VALUES(0,"64","2007-05-14","2007-06-12","LB001","921.670.790-95");
INSERT INTO prontuarios VALUES(0,"65","2012-09-11","2012-09-17","LB001","921.670.790-95");
INSERT INTO prontuarios VALUES(0,"66","2014-07-29","2014-08-26","LB001","921.670.790-95");
INSERT INTO prontuarios VALUES(0,"67","2015-06-30","2010-10-19","LB001","921.670.790-95");
INSERT INTO prontuarios VALUES(0,"68","2002-09-15","2002-10-12","LB001","068.103.730-04");
INSERT INTO prontuarios VALUES(0,"69","2002-11-02","2002-11-07","LB001","068.103.730-04");
INSERT INTO prontuarios VALUES(0,"70","2016-03-04","2016-04-05","LB001","068.103.730-04");
INSERT INTO prontuarios VALUES(0,"71","2017-07-22","2017-07-18","LB001","068.103.730-04");
INSERT INTO prontuarios VALUES(0,"72","2005-12-01","2005-12-07","LB001","844.695.514-81");
INSERT INTO prontuarios VALUES(0,"73","2011-05-05","2011-05-15","LB001","844.695.514-81");
INSERT INTO prontuarios VALUES(0,"74","2017-03-16","2017-03-30","LB001","844.695.514-81");
INSERT INTO prontuarios VALUES(0,"75","2018-07-29","2018-07-30","LB001","844.695.514-81");
INSERT INTO prontuarios VALUES(0,"76","2004-12-12","2004-12-17","LB001","107.590.579-66");
INSERT INTO prontuarios VALUES(0,"77","2004-05-25","2004-05-27","LB001","107.590.579-66");
INSERT INTO prontuarios VALUES(0,"78","2010-07-17","2010-06-29","LB001","107.590.579-66");
INSERT INTO prontuarios VALUES(0,"79","2020-03-04","2020-03-13","LB001","107.590.579-66");
INSERT INTO prontuarios VALUES(0,"80","2004-02-09","2004-03-13","LB001","294.023.462-01");
INSERT INTO prontuarios VALUES(0,"81","2005-02-20","2005-02-27","LB001","294.023.462-01");
INSERT INTO prontuarios VALUES(0,"82","2006-02-15","2006-04-17","LB001","294.023.462-01");
INSERT INTO prontuarios VALUES(0,"83","2007-11-01","2007-11-24","LB001","294.023.462-01");
INSERT INTO prontuarios VALUES(0,"84","2001-12-31","2002-01-07","LB001","851.618.421-80");
INSERT INTO prontuarios VALUES(0,"85","2004-03-02","2004-03-11","LB001","851.618.421-80");
INSERT INTO prontuarios VALUES(0,"86","2007-04-15","2007-04-17","LB001","851.618.421-80");
INSERT INTO prontuarios VALUES(0,"87","2008-09-17","2008-09-20","LB001","851.618.421-80");
INSERT INTO prontuarios VALUES(0,"88","2003-08-29","2003-09-23","LB001","742.819.788-01");
INSERT INTO prontuarios VALUES(0,"89","2007-11-17","2007-11-19","LB001","742.819.788-01");
INSERT INTO prontuarios VALUES(0,"90","2003-04-03","2003-04-11","LB001","742.819.788-01");
INSERT INTO prontuarios VALUES(0,"91","2010-09-11","2010-09-18","LB001","742.819.788-01");
INSERT INTO prontuarios VALUES(0,"92","2000-01-28","2000-01-30","LB001","538.758.667-38");
INSERT INTO prontuarios VALUES(0,"93","2002-03-14","2002-03-22","LB001","538.758.667-38");
INSERT INTO prontuarios VALUES(0,"94","2004-08-02","2004-08-09","LB001","538.758.667-38");
INSERT INTO prontuarios VALUES(0,"95","2010-05-03","2010-05-11","LB001","538.758.667-38");
INSERT INTO prontuarios VALUES(0,"96","2001-01-11","2001-01-24","LB001","188.647.372-27");
INSERT INTO prontuarios VALUES(0,"97","2004-12-05","2004-12-08","LB001","188.647.372-27");
INSERT INTO prontuarios VALUES(0,"98","2009-10-07","2009-10-16","LB001","188.647.372-27");
INSERT INTO prontuarios VALUES(0,"99","2002-07-14","2002-07-20","LB001","645.173.749-63");
INSERT INTO prontuarios VALUES(0,"100","2011-06-17","2011-06-20","LB001","645.173.749-63");
INSERT INTO prontuarios VALUES(0,"101","2014-11-25","2014-11-30","LB001","645.173.749-63");
INSERT INTO prontuarios VALUES(0,"102","2016-12-16","2016-12-18","LB001","645.173.749-63");
INSERT INTO prontuarios VALUES(0,"103","2012-07-27","2012-08-30","LB001","666.418.353-67");
INSERT INTO prontuarios VALUES(0,"104","2015-02-10","2015-02-27","LB001","666.418.353-67");
INSERT INTO prontuarios VALUES(0,"105","2016-04-09","2016-04-24","LB001","666.418.353-67");
INSERT INTO prontuarios VALUES(0,"106","2010-10-10","2010-10-10","LB001","578.205.336-41");
INSERT INTO prontuarios VALUES(0,"107","2012-03-19","2012-03-19","LB001","578.205.336-41");
INSERT INTO prontuarios VALUES(0,"108","2013-04-25","2013-04-28","LB001","448.953.115-03");
INSERT INTO prontuarios VALUES(0,"109","2017-09-30","2017-10-06","LB001","448.953.115-03");
INSERT INTO prontuarios VALUES(0,"110","2018-08-01","2018-10-03","LB001","530.492.786-92");
INSERT INTO prontuarios VALUES(0,"111","2018-12-12","2018-12-25","LB001","530.492.786-92");
INSERT INTO prontuarios VALUES(0,"112","2019-08-14","2019-08-26","LB001","530.492.786-92");
INSERT INTO prontuarios VALUES(0,"113","2009-05-14","2009-05-20","LB001","486.038.078-92");
INSERT INTO prontuarios VALUES(0,"114","2010-11-01","2010-11-19","LB001","486.038.078-92");
INSERT INTO prontuarios VALUES(0,"115","2014-10-02","2014-10-27","LB001","486.038.078-92");
INSERT INTO prontuarios VALUES(0,"116","2015-08-06","2015-08-15","LB001","486.038.078-92");
INSERT INTO prontuarios VALUES(0,"117","2019-11-17","2019-12-30","LB001","140.949.640-61");
INSERT INTO prontuarios VALUES(0,"118","2008-09-09","2008-09-11","LB001","269.530.728-49");
INSERT INTO prontuarios VALUES(0,"119","2011-02-17","2011-02-20","LB001","269.530.728-49");
INSERT INTO prontuarios VALUES(0,"120","2013-01-26","2013-01-29","LB001","269.530.728-49");
INSERT INTO prontuarios VALUES(0,"121","2018-12-23","2018-12-30","LB001","269.530.728-49");
INSERT INTO prontuarios VALUES(0,"122","2019-10-12","2019-11-01","LB001","269.530.728-49");
INSERT INTO prontuarios VALUES(0,"123","2015-04-03","2015-04-24","LB001","787.976.063-67");
INSERT INTO prontuarios VALUES(0,"124","2019-07-17","2018-08-12","LB001","787.976.063-67");
INSERT INTO prontuarios VALUES(0,"125","2017-02-05","2017-02-20","LB001","195.907.118-12");
INSERT INTO prontuarios VALUES(0,"126","2018-07-13","2018-10-14","LB001","195.907.118-12");
INSERT INTO prontuarios VALUES(0,"127","2013-08-17","2013-08-26","LB001","065.603.436-00");
INSERT INTO prontuarios VALUES(0,"128","2014-09-02","2014-09-04","LB001","065.603.436-00");
INSERT INTO prontuarios VALUES("1","129","2021-01-14","0000-00-00","LB001","224.447.809-22");
INSERT INTO prontuarios VALUES("1","130","2021-04-24","0000-00-00","LB002","494.194.016-42");
INSERT INTO prontuarios VALUES("1","131","2021-05-16","0000-00-00","LB003","345.048.927-58");
INSERT INTO prontuarios VALUES("1","132","2021-03-30","0000-00-00","LB004","037.734.615-26");
INSERT INTO prontuarios VALUES("1","133","2021-04-14","0000-00-00","LC001","009.812.684-98");
INSERT INTO prontuarios VALUES("1","134","2021-03-11","0000-00-00","LC002","263.899.863-00");
INSERT INTO prontuarios VALUES("1","135","2021-03-08","0000-00-00","LC003","450.331.323-18");
INSERT INTO prontuarios VALUES("1","136","2021-02-20","0000-00-00","LC004","799.171.576-03");
INSERT INTO prontuarios VALUES("1","137","2021-01-19","0000-00-00","LD001","901.930.181-01");
INSERT INTO prontuarios VALUES("1","138","2021-01-31","0000-00-00","LD002","626.142.628-70");
INSERT INTO prontuarios VALUES("1","139","2021-04-17","0000-00-00","LD003","201.095.279-09");
INSERT INTO prontuarios VALUES("1","140","2021-06-01","0000-00-00","LD004","856.213.656-58");
INSERT INTO prontuarios VALUES("1","141","2021-04-02","0000-00-00","LE001","029.226.827-06");
INSERT INTO prontuarios VALUES("1","142","2021-04-16","0000-00-00","LE002","501.661.629-90");
INSERT INTO prontuarios VALUES(0,"143","2019-03-12","2019-03-17","LB001","429.326.274-14");
INSERT INTO prontuarios VALUES(0,"144","2016-06-15","2017-06-15","LA001","107.341.659-12");
INSERT INTO prontuarios VALUES(0,"145","2017-10-26","2017-11-01","LA002","401.561.328-95");
INSERT INTO prontuarios VALUES(0,"146","2018-03-13","2018-04-11","LA003","201.441.679-22");
INSERT INTO prontuarios VALUES(0,"147","2019-07-18","2019-08-14","LA004","481.561.521-91");
INSERT INTO prontuarios VALUES(0,"148","2019-06-13","2019-07-01","LB001","491.591.529-81");
INSERT INTO prontuarios VALUES(0,"149","2021-03-16","2021-03-20","LA002","800.170.953-10");
INSERT INTO prontuarios VALUES(0,"150","2015-07-12","2015-07-20","LA003","800.170.953-10");
INSERT INTO prontuarios VALUES(0,"151","2018-04-17","2018-05-11","LA002","800.170.953-10");


INSERT INTO ocorrencias VALUES("1","2021-05-11","10:12:31","1","Paciente Amanda Jéssica Caroline de Paula, CPF:065.799.448-03 foi internada e alocada para o leito LB001, no dia 11 de Maio de 2021 as 10:12 AM, identificada com a CID A03.2","072.003.190-74");
INSERT INTO ocorrencias VALUES("2","2020-01-21","11:19:16","2","Paciente Amanda Jéssica Caroline de Paula, de CPF: 065.799.448-03 tomou sua medicação e deve ficar um tempo em observação.","868.500.956-17");
INSERT INTO ocorrencias VALUES("3","2020-01-22","21:36:47","3","Paciente Amanda Jéssica Caroline de Paula, CPF:065.799.448-03 foi liberada do leito LB001, no dia 22 de Janeiro de 2020 as 21:36, depois de tomar sua medicação.","072.003.190-74");
INSERT INTO ocorrencias VALUES("4","2021-02-28","22:52:26","46","Paciente Olivia Natália Sueli de Paula, de CPF 012.456.594-80 foi liberada depois de tomar sua medicação e ficar um tempo em observação.","558.570.920-86");
INSERT INTO ocorrencias VALUES("5","2020-08-11","20:32:26","41","Paciente Valentina Fátima Santos, de CPF 759.661.020-07 foi liberada depois de tomar sua medicação e não tempo nenhuma aversão ao medicamento.\n\n","607.500.500-55");




INSERT INTO backups_agendados VALUES("1","0000-00-00","00:08:00","177.207.152.184","1");


INSERT INTO agendamentos VALUES("1","0.355","2021-05-28","1","21:34:10","4","072.003.190-74","1210033020");
INSERT INTO agendamentos VALUES("2","0.15","2021-06-29",0,"18:34:10","4",0,"1210033020");
INSERT INTO agendamentos VALUES("3","0.24","2021-05-21","1","20:00:00","1","046.822.991-40","1210033020");
INSERT INTO agendamentos VALUES("4","0.24","2021-05-21","1","17:00:00","4","072.003.190-74","1210033020");
INSERT INTO agendamentos VALUES("5","0.54","2021-06-30",0,"00:00:12","1",0,"1210033020");
INSERT INTO agendamentos VALUES("6","1","2021-06-13","1","18:06:18","25","072.003.190-74","511607301152415");
INSERT INTO agendamentos VALUES("7","0.7","2021-06-28",0,"08:01:19","135",0,"508014010101404");
INSERT INTO agendamentos VALUES("8","0.95","2021-06-28",0,"20:15:03","130",0,"513003501136413");
INSERT INTO agendamentos VALUES("9","2.35","2020-08-09","1","12:15:03","41","250.414.528-74","511803201157415");
INSERT INTO agendamentos VALUES("10","0.48","2000-01-29","1","21:15:03","92","127.066.920-65","511607701134112");
INSERT INTO agendamentos VALUES("11","0.79","2021-06-22",0,"09:15:03","140",0,"511507506119413");
INSERT INTO agendamentos VALUES("12","0.9","2021-06-23",0,"17:36:02","139",0,"513402201111412");
INSERT INTO agendamentos VALUES("13","0.65","2021-06-24",0,"20:45:01","136",0,"511607301152415");
INSERT INTO agendamentos VALUES("14","1.15","2021-06-25",0,"22:23:03","137",0,"4320033452");
INSERT INTO agendamentos VALUES("15","0.09","2021-06-25",0,"11:11:11","142",0,"512400201130326");
INSERT INTO agendamentos VALUES("16","0.45","2021-06-28",0,"22:25:02","134",0,"511607101153116");
INSERT INTO agendamentos VALUES("17","0.7","2021-06-21",0,"09:25:03","132",0,"511301501162416");
INSERT INTO agendamentos VALUES("18","1.1","2021-06-22",0,"13:15:03","141",0,"511502602111117");
INSERT INTO agendamentos VALUES("19","0.59","2021-06-30",0,"19:45:03","138",0,"500100401114419");
INSERT INTO agendamentos VALUES("20","0.85","2021-06-23",0,"18:35:03","131",0,"500100305158117");
INSERT INTO agendamentos VALUES("21","2.1","2021-06-27",0,"20:05:03","133",0,"500103201116110");
INSERT INTO agendamentos VALUES("22","1.7","2021-06-19",0,"03:00:03","130",0,"513004101115417");
INSERT INTO agendamentos VALUES("41","2.1","2018-08-01","1","21:29:36","110","127.066.920-65","511502902164410");
INSERT INTO agendamentos VALUES("42","2.2","2018-07-14","1","12:29:36","126","046.822.991-40","512400302115411");
INSERT INTO agendamentos VALUES("43","2.3","2017-09-20","1","21:29:36","16","072.003.190-74","513004101115417");
INSERT INTO agendamentos VALUES("44","2.4","2018-12-13","1","15:29:36","111","136.382.370-10","1210033452");
INSERT INTO agendamentos VALUES("45","1.5","2018-12-24","1","01:29:36","121","250.414.528-74","500103201116110");
INSERT INTO agendamentos VALUES("46","1.4","2019-02-12","1","12:29:36","3","252.696.001-73","500100102151411");
INSERT INTO agendamentos VALUES("47","1.2","2019-03-13","1","18:50:36","143","558.570.920-86","513401101154413");
INSERT INTO agendamentos VALUES("48","1.1","2019-04-09","1","19:09:36","30","607.500.500-55","500100305158117");
INSERT INTO agendamentos VALUES("49","1","2019-08-16","1","20:40:36","112","873.325.550-42","500100401114419");
INSERT INTO agendamentos VALUES("50","0.9","2019-10-14","1","12:19:36","122","213.223.336-53","511502602111117");
INSERT INTO agendamentos VALUES("51","0.8","2019-11-18","1","22:09:36","117","250.414.528-74","511301501162416");
INSERT INTO agendamentos VALUES("52","0.7","2020-01-15","1","21:29:00","4","252.696.001-73","1210033020");
INSERT INTO agendamentos VALUES("53","0.6","2020-03-09","1","20:32:36","79","607.500.500-55","511607101153116");
INSERT INTO agendamentos VALUES("54","0.5","2020-04-14","1","15:30:36","42","645.566.964-96","512400201130326");
INSERT INTO agendamentos VALUES("55","0.4","2020-05-20","1","11:19:16","2","657.687.833-85","4320033452");
INSERT INTO agendamentos VALUES("56","0.3","2020-07-09","1","05:29:36","17","868.500.956-17","511607301152415");
INSERT INTO agendamentos VALUES("57","0.2","2020-08-10","1","20:00:36","41","046.822.991-40","511507506119413");
INSERT INTO agendamentos VALUES("58","0.1","2021-02-07","1","07:30:36","46","072.003.190-74","508014010101404");

