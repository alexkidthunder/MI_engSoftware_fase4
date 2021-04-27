use hospital_universitario;
/*desc estagiarios;*/
/* Insere na tabela de usuarios*/
select Count(*) from estagiarios;
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