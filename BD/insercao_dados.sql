use hospital_universitario;

/*desc estagiarios;*/
/* Insere na tabela de usuarios*/
/*select Count(*) from pacientes;*/

insert into usuarios values
	('021.446.717-41','João da Silva e Silva','silvajao123','joaosilva.hp@gmail.com','1980-12-05','Administrador','M','0010101'),
    ('175.585.124-92','Maria joaquina Drumond','maria981','mariazinhaquina@gmail.com','1995-07-12','Administrador','F','00100101'),
    ('174.985.367-13','Juscelino Silva dos Santos','jusck987','santosjuscelino.hp@gmail.com','1976-01-19','Administrador','M','11010110'),
    
    ('202.457.365-11','Vinicius Martins magalhães','viniciinEhdeiz10','mmvinicius@gmail.com','1989-09-24','Enfermeiro Chefe','M','00110101001'),
    ('658.002.101-02','Ambrozina pereira amorim','98378s2','amorim.Ambozina@gmail.com','1974-04-27','Enfermeiro Chefe','F','10001010'),
    ('475.013.135-62','Ana Catarina Melo','09annamello','anna.melocatarina@gmail.com','1986-10-11','Enfermeiro Chefe','F','010010110'),
    
    ('252.696.001-73','Brenda Estefanir souza','09szai2','brendasouza.hp@gmail.com','1995-07-29','Enfermeiro','F','0100110101011'),
    ('250.414.528-74','Alfredo Estrada Félix','frefedo872','estrada.felixfred@gmail.com','1979-02-27','Enfermeiro','M','110100101'),
    ('127.066.920-65','Rafael Yago Rocha','goya761s','Yagorafael.hp@gmail.com','1968-09-26','Enfermeiro','M','11010010100'),
    ('558.570.920-86','Jaqueline Marina da Cunha','cunh87ja212que','cunha.jaquemarina@gmail.com','1987-08-21','Enfermeiro','F','0010110101'),
    ('136.382.370-10','Diego Luan Cardoso','dosos23doso12','dieguinho87luan@gmail.com','1968-02-18','Enfermeiro','M','1101010'),
    ('072.003.190-74','Isaac Márcio Enrico Almada','malfada234','malfada.enricoIsaac@gmail.com','1988-07-26','Enfermeiro','M','110100101'),
    ('873.325.550-42','Cauã Mário da Luz','luz21s1z','cauamariodaluz.81@gmail.com','1984-07-07','Enfermeiro','M','001011011'),
    ('607.500.500-55','Alfredo Estrada Félix','frefedo872','suelimirellaaparecidadossantos@gmail.com','1971-01-21','Enfermeiro','F','11001010'),
    ('841.084.862-77','Diego Theo Nathan Vieira','08F993d2gq','_diegotheonathanvieira@gmail.com','1992-02-25','Enfermeiro','M','1010010101'),
    ('046.822.991-40','Fernando Miguel Galvão','GFdZCYh6Yo','fernandomiguelgalvao-92@gmail.com','1959-04-23','Enfermeiro','M','011010001'),
    
    ('657.687.833-85','Rayssa Larissa da Rosa','ro029090710sa','rrayssalarissadarosa@gmail.com','1994-11-14','Estagiario','F','00100010'),
    ('868.500.956-17','Marlene Sarah Alana Moura','m4a13mp0s8m','smmarlenesarahalanamoura@gmail.com','1992-11-06','Estagiario','F','01001010'),
    ('645.566.964-96','Nina Gabriela Camila Figueiredo','7bfc8LG23j','inagabrielacamilafigueiredo@gmail.com','1971-01-21','Estagiario','F','010100111'),
    ('213.223.336-53','Severino Nathan Ferreira','frefedo872','severinonathanferreira@gmail.com','1996-02-17','Estagiario','M','011111000');
    
  /*Insere na tabela de administradores*/
  INSERT INTO administradores VALUES
	('021.446.717-41'), /*esse CPF faz referencia ao registro na tabela de usuarios*/
	('175.585.124-92'),
	('174.985.367-13');


/*Insere na tabela de responsaveis*/
 INSERT INTO responsaveis select CPF from Usuarios where atribuicao NOT LIKE 'a%';


/* Insere na tabela de enfermeiros_chefes*/
INSERT INTO enfermeiros_chefes VALUES
	('202.457.365-11','01-BA00001'),
	('658.002.101-02','01-BA00002'),
	('475.013.135-62','01-BA00003');

/*Insere na tabela enfermeiros*/
INSERT INTO enfermeiros VALUES
	('252.696.001-73','01-BA00004','0'),
	('250.414.528-74','01-BA00005','0'),
	('127.066.920-65','01-BA00006','0'),
	('558.570.920-86','01-BA00007','0'),
	('136.382.370-10','01-BA00008','0'),
	('072.003.190-74','01-BA00009','0'),
	('873.325.550-42','01-BA00010','0'),
	('607.500.500-55','01-BA00011','0'),
	('841.084.862-77','01-BA00012','0'),
	('046.822.991-40','01-BA00013','0');
    
/*Insere na tabela estagiarios*/
INSERT INTO estagiarios VALUES
	('657.687.833-85','0'),
	('868.500.956-17','0'),
	('645.566.964-96','0'),
	('213.223.336-53','0');

INSERT INTO leitos VALUES
('0','LB001'),
('0','LB002'),
('0','LB003'),
('0','LB004'),
('0','LC001'),
('0','LC002'),
('0','LC003'),
('0','LC004'),
('0','LD001'),
('0','LD002'),
('0','LD003'),
('0','LD004');


/* Insere na tabela de pacientes*/
INSERT INTO pacientes VALUES
('Rafaela Eloá Raquel Campos','F','alta','2002-08-07','622.748.620-52','A-'),
('Amanda Jéssica Caroline de Paula','F','alta','1968-04-06','065.799.448-03','B+'),
('Vera Tânia Bruna da Conceição','F','alta','1953-008-26','341.846.973-64','B+'),
('Pedro Henrique Henrique Juan Dias','M','alta','1953-02-05','429.326.274-14','AB-'),
('Otávio Theo Elias Moura','M','alta','1968-08-21','167.879.644-12','B-'),
('Analu Caroline dos Santos','F','alta','1989-12-01','981.757.680-96','O-'),
('Francisca Joana Simone da Luz','F','alta','1961-03-27','325.227.456-62','O+'),
('Bárbara Antonella Marina Corte Real','F','alta','1987-12-03','649.100.528-36','O-'),
('Camila Rosângela Aparecida Melo','F','alta','1970-04-10','419.234.708-33','O+'),
('Valentina Fátima Santos','F','alta','2000-01-12','759.661.020-07','O-'),
('Olivia Natália Sueli de Paula','F','alta','1984-05-05','012.456.594-80','AB-'),
('Francisca Bruna Eduarda Vieira','F','alta','1994-06-04','613.234.078-55','B+'),
( 'Liz Francisca Fogaça','F','alta','1998-10-13', '575.168.453-29', 'O+'),
('Teresinha Jaqueline da Cunha','F','alta','1979-06-05', '436.232.985-49', 'AB+'),
('Leandro Mário Ferreira','M','alta','1975-12-21', '483.410.653-55', 'O-'),
('Analu Aparecida Vanessa Brito','F','alta','1963-02-19', '921.670.790-95', 'B+'),
('Rosângela Alícia das Neves','F','alta','1954-12-24', '068.103.730-04', 'B-'),
('Louise Clara Fernanda Teixeira','F','alta','1972-10-13', '844.695.514-81', 'O+'),
('Pietro Levi Cláudio Costa','M','alta','1961-02-26', '107.590.579-66', 'A+'),
('Andreia Ana Campos','F','alta','1983-12-06', '294.023.462-01', 'B+'),
('Luiz Calebe Luís Castro','M','alta','1988-06-04', '851.618.421-80', 'A+'),
('Carla Isabel Beatriz Fogaça','F','alta','1965-12-07', '742.819.788-01', 'AB+'),
('Cauê Ian Victor Lopes','M','alta','1955-12-25', '538.758.667-38', 'AB-'), 
('Analu Renata Eliane Aragão','F','alta','1996-12-09', '188.647.372-27', 'O+'),
('Esther Benedita Farias','F','alta','1948-03-11', '645.173.749-63', 'A-'),
('Tomás Giovanni Nelson Freitas','M','alta','1983-05-06', '666.418.353-67', 'AB-'),
('Guilherme Noah Gael Nascimento','M','alta','1975-03-24', '578.205.336-41', 'O-'),
('Anderson Manuel da Cunha','M','alta','1967-07-16', '448.953.115-03', 'A-'),
('Pietra Mariah da Rosa','F','alta','1977-05-11', '530.492.786-92', 'A+'),
('Vinicius Mateus Santos','M','alta','1955-09-27', '486.038.078-92', 'A+'),
('Brenda Joana Fernanda Novaes','F','alta','1998-11-03', '140.949.640-61', 'O-'),
('Stefany Marlene Marina Freitas','F','alta','2001-05-07', '269.530.728-49', 'B+'),
('Stella Camila Castro','F','alta','1958-02-26', '787.976.063-67', 'A-'),
('Liz Daiane Cavalcanti','F','alta','1980-06-19', '195.907.118-12', 'AB-'),
('Tiago Geraldo Fogaça','M','alta','1998-01-04', '065.603.436-00', 'O-'),
('Caleb Bruno Ferreira','M','alta','1949-09-25', '224.447.809-22', 'O-'),
('Paulo Sebastião Sales','M','alta','1982-05-14', '494.194.016-42', 'A-'),
('Victor Renan Assis','M','alta','1948-10-03', '800.170.953-10', 'AB+'),
('Hugo Gael Fernandes','M','alta','1944-03-12', '345.048.927-58', 'O-'),
('Lorena Lúcia Nascimento','F','alta','1943-04-04', '037.734.615-26', 'A-'),
( 'Sueli Luna Martins','F','alta','1961-12-12', '009.812.684-98', 'A-'),
('Eliane Julia Aragão','F','alta','2002-08-14', '263.899.863-00', 'B+'),
('Ester Maya Alice da Paz','F','alta','1971-08-04', '450.331.323-18', 'O+'),
('Raimundo Daniel das Neves','M','alta','1985-09-04', '799.171.576-03', 'A+'),
('Isadora Natália da Mata','F','alta','1955-11-12', '901.930.181-01', 'AB+'),
('Levi Leandro Otávio Duarte','M','alta','1974-08-11', '626.142.628-70', 'A+'),
('Sophia Alícia Campos','F','alta','1948-11-01', '201.095.279-09', 'A-'),
('Benjamin Bento Rodrigues','M','alta','1967-06-21', '856.213.656-58', 'A+'),
('Jennifer Clarice Assunção','F','alta','1993-04-09', '029.226.827-06', 'B-'),
('Giovana Lorena Pires','F','alta','1975-12-03', '501.661.629-90', 'AB-');

/* Insere na tabela de cargos*/
INSERT INTO cargo Values
	('1','Administrador'),
    ('2','Enfermeiro Chefe'),
    ('3','Enfermeiro'),
    ('4','Estagiario');

/* Insere na tabela de permissões */
INSERT INTO permissoes VALUES	
	('1','Cadastrar funcionário'),
	(DEFAULT,'Remover funcionário'),	
	(DEFAULT,'Alterar atribuição do funcionário'),
	(DEFAULT,'Editar permissões de cargo'),
	(DEFAULT,'Visualizar permissões de cargo'),
	(DEFAULT,'Cadastro de plantonista'),
	(DEFAULT,'Remoção de plantonista'),
	(DEFAULT,'Cadastro de medicamentos'),
	(DEFAULT,'Cadastro de CID'),
	(DEFAULT,'Remoção de CID'),
	(DEFAULT,'Cadastro de agendamento'),
	(DEFAULT,'Alocar responsável por agendamento'),
	(DEFAULT,'Listagem de plantonistas'),
	(DEFAULT,'Listagem de agendamentos'),
	(DEFAULT,'Responsáveis por aplicação de medicamentos'),
	(DEFAULT,'Cadastro de pacientes'),
	(DEFAULT,'Visualizar pacientes e prontuários'),
	(DEFAULT,'Acesso ao prontuário do paciente'),
	(DEFAULT,'Editar informações pessoais do paciente'),
	(DEFAULT,'Listagem de medicamentos para preparação'),
	(DEFAULT,'Visualização de agendamento realizados pelo funcionário'),
	(DEFAULT,'Visualização de agendamento alocados para o funcionário'),
	(DEFAULT,'Aplicação de medicamentos'),
	(DEFAULT,'Nomear-se responsável por preparar a aplicação'),
	(DEFAULT,'Dar baixa no agendamento'),
	(DEFAULT,'Visualizar ocorrências do paciente'),
	(DEFAULT,'Registro de ocorrências'),
	(DEFAULT,'Cadastro do leito'),
	(DEFAULT,'Remoção do leito'),
	(DEFAULT,'Realizar / Agendar Backup');

/* Insere na tabela de permisssao_cargo*/
INSERT INTO permissao_cargo VALUES
	(DEFAULT,'1','1'),
	(DEFAULT,'2','1'),
	(DEFAULT,'3','1'),
	(DEFAULT,'4','1'),
	(DEFAULT,'5','1'),
	(DEFAULT,'6','1'),
	(DEFAULT,'7','2'),
	(DEFAULT,'7','3'),
	(DEFAULT,'8','2'),
	(DEFAULT,'8','3'),
	(DEFAULT,'8','2'),
	(DEFAULT,'8','3'),
	(DEFAULT,'9','2'),
	(DEFAULT,'10','2'),
	(DEFAULT,'10','3'),
	(DEFAULT,'10','4'),
	(DEFAULT,'11','2'),
	(DEFAULT,'12','2'),
	(DEFAULT,'12','3'),
	(DEFAULT,'12','4'),
	(DEFAULT,'13','2'),
	(DEFAULT,'13','3'),
	(DEFAULT,'13','4'),
	(DEFAULT,'14','2'),
	(DEFAULT,'15','2'),
	(DEFAULT,'16','2'),
	(DEFAULT,'16','3'),
	(DEFAULT,'16','4'),
	(DEFAULT,'17','2'),
	(DEFAULT,'17','3'),
	(DEFAULT,'17','4'),
	(DEFAULT,'18','2'),
	(DEFAULT,'18','3'),
	(DEFAULT,'18','4'),
	(DEFAULT,'19','2'),
	(DEFAULT,'19','3'),
	(DEFAULT,'19','4');