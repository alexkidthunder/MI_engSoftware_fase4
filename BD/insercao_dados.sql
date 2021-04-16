
use hospital_universitario;

/* Insere na tabela de usuarios*/
insert into usuarios values
	('02144671741','João da Silva e Silva','silvajao123','joaosilva.hp@gmail.com','1980-12-05','a','Masculino','0010101'),
    ('17558512492','Maria joaquina Drumond','maria981','mariazinhaquina@gmail.com','1995-07-12','a','Feminino','00100101'),
    ('17498536713','Juscelino Silva dos Santos','jusck987','santosjuscelino.hp@gmail.com','1976-01-19','a','Masculino','11010110'),
    
    ('20245736511','Vinicius Martins magalhães','viniciinEhdeiz10','mmvinicius@gmail.com','1989-09-24','b','Masculino','00110101001'),
    ('65800210102','Ambrozina pereira amorim','98378s2','amorim.Ambozina@gmail.com','1974-04-27','b','Feminino','10001010'),
    ('47501313562','Ana Catarina Melo','09annamello','anna.melocatarina@gmail.com','1986-10-11','b','Feminino','010010110'),
    
    ('25269600173','Brenda Estefanir souza','09szai2','brendasouza.hp@gmail.com','1995-07-29','c','Feminino','0100110101011'),
    ('25041452874','Alfredo Estrada Félix','frefedo872','estrada.felixfred@gmail.com','1979-02-27','c','Masculino','110100101'),
    ('12706692065','Rafael Yago Rocha','goya761s','Yagorafael.hp@gmail.com','1968-09-26','c','Masculino','11010010100'),
    ('55857092086','Jaqueline Marina da Cunha','cunh87ja212que','cunha.jaquemarina@gmail.com','1987-08-21','c','Feminino','0010110101'),
    ('13638237010','Diego Luan Cardoso','dosos23doso12','dieguinho87luan@gmail.com','1968-02-18','c','Masculino','1101010'),
    ('07200319074','Isaac Márcio Enrico Almada','malfada234','malfada.enricoIsaac@gmail.com','1988-07-26','c','Masculino','110100101'),
    ('87332555042','Cauã Mário da Luz','luz21s1z','cauamariodaluz.81@gmail.com','1984-07-07','c','Masculino','001011011'),
    ('60750050055','Alfredo Estrada Félix','frefedo872','suelimirellaaparecidadossantos@gmail.com','1971-01-21','c','Feminino','11001010'),
    ('84108486277','Diego Theo Nathan Vieira','08F993d2gq','_diegotheonathanvieira@gmail.com','1992-02-25','c','Masculino','1010010101'),
    ('04682299140','Fernando Miguel Galvão','GFdZCYh6Yo','fernandomiguelgalvao-92@gmail.com','1959-04-23','c','Masculino','011010001'),
    
    ('65768783385','Rayssa Larissa da Rosa','ro029090710sa','rrayssalarissadarosa@gmail.com','1994-11-14','d','Feminino','00100010'),
    ('86850095617','Marlene Sarah Alana Moura','m4a13mp0s8m','smmarlenesarahalanamoura@gmail.com','1992-11-06','d','Feminino','01001010'),
    ('64556696496','Nina Gabriela Camila Figueiredo','7bfc8LG23j','inagabrielacamilafigueiredo@gmail.com','1971-01-21','d','Feminino','010100111'),
    ('21322333653','Severino Nathan Ferreira','frefedo872','severinonathanferreira@gmail.com','1996-02-17','d','Masculino','011111000');
    
  /*Insere na tabela de administradores*/
  INSERT INTO administradores VALUES
	('02144671741'), /*esse CPF faz referencia ao registro na tabela de usuarios*/
	('17558512492'),
	('17498536713');


/*Insere na tabela de responsaveis*/
 INSERT INTO responsaveis select CPF from Usuarios where atribuicao != 'a';


/* Insere na tabela de enfermeiros_chefes*/
INSERT INTO enfermeiros_chefes VALUES
	('20245736511','01-BA00001'),
	('65800210102','01-BA00002'),
	('47501313562','01-BA00003');
    
/*Insere na tabela enfermeiros*/
INSERT INTO enfermeiros VALUES
	('25269600173','01-BA00004','0'),
	('25041452874','01-BA00005','0'),
	('12706692065','01-BA00006','0'),
	('55857092086','01-BA00007','0'),
	('13638237010','01-BA00008','0'),
	('07200319074','01-BA00009','0'),
	('87332555042','01-BA00010','0'),
	('60750050055','01-BA00011','0'),
	('84108486277','01-BA00012','0'),
	('04682299140','01-BA00013','0');
    
/*Insere na tabela estagiarios*/
INSERT INTO estagiarios VALUES
	('65768783385','0'),
	('86850095617','0'),
	('64556696496','0'),
	('21322333653','0');