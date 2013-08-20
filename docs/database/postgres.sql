/**Pessoas**/
create table pessoa(
    id_pessoa bigint not null primary key  
);
create table pessoa_fisica(
    nr_cpf bigint not null primary key,
    nm_pessoa varchar(250),
    foreign key (nr_cpf) references pessoa(id_pessoa)
);
create table pessoa_juridica(
    nr_cnpj bigint not null primary key,
    nm_razao_social varchar(250),
    nm_fantasia varchar(250),
    foreign key (nr_cnpj) references pessoa(id_pessoa)
);
create table usuario(
    fk_pessoa bigint not null primary key,
    login character varying(50) unique NOT NULL,
    senha character(40),
    data_ultimo_acesso timestamp with time zone,
    foreign key (fk_pessoa) references pessoa(id_pessoa)
);

insert into pessoa values(99999999999);
insert into pessoa_fisica values(99999999999, 'Administrador do Sistema');
insert into usuario values(99999999999,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',now());
/*
select 
    nr_cpf,
    nm_pessoa,
    login,
    senha
from pessoa_fisica pf
join usuario u on u.fk_pessoa = pf.nr_cpf
*/
/**Modulos**/
create table modulo(
	id_modulo bigserial not null primary key,
	codigo_modulo varchar(40) not null unique,
	nm_modulo varchar(250) not null unique,
	desc_modulo varchar(500)
);
create table controller(
	id_controller bigserial not null primary key,
	fk_modulo bigint not null,
	codigo_controller varchar(40) not null unique,
	nm_controller varchar(250) not null unique,	
	desc_controller varchar(500),
	foreign key (fk_modulo) references modulo (id_modulo)	
);
create table action(
	fk_controller bigint not null,
	codigo_action varchar(40) not null unique,
	nm_action varchar(250) not null unique,	
	desc_action varchar(500),
	foreign key (fk_controller) references controller (id_controller)
);

insert into modulo(codigo_modulo,nm_modulo,desc_modulo) values ('administrativo','Cadastros Administrativos','Cadastro administrativos do sistema.');
insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller) values ((select id_modulo from modulo where codigo_modulo = 'administrativo'), 'pessoa_fisica', 'Cadastro de Pessoas fisicas', 'Cadastro de pessoas fisicas');
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ((select id_controller from controller where codigo_controller = 'pessoa_fisica'), 'cadastrar.pessoa.fisica', 'Cadastro de Pessoas fisica', 'Funcão de cadastro de pessoa física.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ((select id_controller from controller where codigo_controller = 'pessoa_fisica'), 'editar.pessoa.fisica', 'Edição de Pessoas fisica', 'Funcão de edição de pessoa física.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ((select id_controller from controller where codigo_controller = 'pessoa_fisica'), 'excluir.pessoa.fisica', 'Exclusão de Pessoas fisica', 'Funcão de exclusão de pessoa física.' );
insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller) values ((select id_modulo from modulo where codigo_modulo = 'administrativo'), 'pessoa_jurica', 'Cadastro de Pessoas juridicas', 'Cadastro de pessoas fisicas');
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ((select id_controller from controller where codigo_controller = 'pessoa_juridica'), 'cadastrar.pessoa.juridica', 'Cadastro de Pessoas juridica', 'Funcão de cadastro de pessoa juridica.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ((select id_controller from controller where codigo_controller = 'pessoa_juridica'), 'editar.pessoa.juridica', 'Edição de Pessoas juridica', 'Funcão de edição de pessoa juridica.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ((select id_controller from controller where codigo_controller = 'pessoa_juridica'), 'excluir.pessoa.juridica', 'Exclusão de Pessoas juridica', 'Funcão de exclusão de pessoa juridica.' );

/*
select 
	m.nm_modulo,
	a.nm_action,
	c.codigo_controller	
from controller c
join action a on a.fk_controller = c.id_controller
join modulo m on m.id_modulo = c.fk_modulo
where c.codigo_controller = 'pessoa_juridica'
*/