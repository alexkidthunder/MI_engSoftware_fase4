use hospital_universitario;
show tables;
describe usuarios;

select nome from usuarios ORDER BY nome;

/* Insere na tabela de usuarios*/
insert into usuarios values
	('0214467174','João da Silva e Silva','silvajao123','joaosilva.hp@gmail.com','1980-12-05','a','Masculino','0010101'),
    ('1755851249','Maria joaquina Drumond','maria981','mariazinhaquina@gmail.com','1995-07-12','a','Feminino','00100101'),
    ('1749853671','Juscelino Silva dos Santos','jusck987','santosjuscelino.hp@gmail.com','1976-01-19','a','Masculino','11010110'),
    
    ('2024573651','Vinicius Martins magalhães','viniciinEhdeiz10','mmvinicius@gmail.com','1989-09-24','b','Masculino','00110101001'),
    ('6580021010','Ambrozina pereira amorim','98378s2','amorim.Ambozina@gmail.com','1974-04-27','b','Feminino','10001010'),
    ('4750131356','Ana Catarina Melo','09annamello','anna.melocatarina@gmail.com','1986-10-11','b','Feminino','010010110'),
    
    ('2526960017','Brenda Estefanir souza','09szai2','brendasouza.hp@gmail.com','1995-07-29','c','Feminino','0100110101011'),
    ('2504145287','Alfredo Estrada Félix','frefedo872','estrada.felixfred@gmail.com','1979-02-27','c','Masculino','110100101'),
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
    
  desc administradores;
  /*Insere na tabela de administradores*/
  INSERT INTO administradores VALUES
	('0214467174'), /*esse CPF faz referencia ao registro na tabela de usuarios*/
	('1755851249'),
	('1749853671');

DESC responsaveis;
/*Insere na tabela de responsaveis*/
 INSERT INTO responsaveis values select CPF from Usuarios where atribuicao != 'a';