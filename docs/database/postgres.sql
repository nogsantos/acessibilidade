CREATE OR REPLACE FUNCTION nvl(character varying, character varying) RETURNS character varying AS 
$$
/**
 * Substitui o valor do primeiro termo pelo segundo caso o primeiro valor esteja nulo.
 *
 * @author Fabricio Nogueira
 * @since 14 AGO 2013
 */
    select case 
        when $1 is null 
        then $2 
        else $1 
    end
$$
LANGUAGE 'sql' VOLATILE;
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
    data_cadastro timestamp with time zone,
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
	desc_modulo varchar(500),
	ordem integer
);
create table controller(
	id_controller bigserial not null primary key,
	fk_modulo bigint not null,
	codigo_controller varchar(60) not null unique,
	nm_controller varchar(250) not null unique,	
	desc_controller varchar(500),
	ordem integer,
	foreign key (fk_modulo) references modulo (id_modulo)	
);
create table action(
	fk_controller varchar(60) not null,
	codigo_action varchar(60) not null,
	nm_action varchar(250) not null,	
	desc_action varchar(500),	
	foreign key (fk_controller) references controller (codigo_controller)
);

insert into modulo(codigo_modulo,nm_modulo,desc_modulo,ordem) values ('administrativo','Administrativo','Cadastro administrativos do sistema.',0);

insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from modulo where codigo_modulo = 'administrativo'), 'cad.modulo', 'Cadastro de modulos', 'Cadastro de modulos para o sistema.',1);
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'editar', 'Editar', 'Funcão para edição.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from modulo where codigo_modulo = 'administrativo'), 'cad.controller', 'Cadastro de controllers', 'Cadastro de controllers para o sistema.',2);
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'editar', 'Editar', 'Funcão para edição.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from modulo where codigo_modulo = 'administrativo'), 'cad.action', 'Cadastro de actions', 'Cadastro de actions para o sistema.',3);
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'editar', 'Editar', 'Funcão para edição.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'excluir', 'Excluir', 'Funcão para exclusão.' );


insert into modulo(codigo_modulo,nm_modulo,desc_modulo, ordem) values ('pessoa','Pessoas','Cadastro de pessoas para o sistema.',1);

insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from modulo where codigo_modulo = 'pessoa'), 'cad.pessoa.fisica', 'Cadastro de pessoa física', 'Cadastro de pessoa física.',1);
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'editar', 'Editar', 'Funcão para edição.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from modulo where codigo_modulo = 'pessoa'), 'cad.pessoa.juridica', 'Cadastro de pessoa juridica', 'Cadastro de pessoa juridica.',2);
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'editar', 'Editar', 'Funcão para edição.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from modulo where codigo_modulo = 'pessoa'), 'cad.usuario', 'Cadastro de usuários', 'Cadastro de usuários do sistema.',3);
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'editar', 'Editar', 'Funcão para edição.' );
insert into action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'excluir', 'Excluir', 'Funcão para exclusão.' );

select 
	m.nm_modulo,
	a.nm_action,
	c.codigo_controller
from controller c
join action a on a.fk_controller = c.codigo_controller
join modulo m on m.id_modulo = c.fk_modulo
where m.codigo_modulo = 'administrativo'

/*Selecionar todos os controllers por módulo*/
select
	m.nm_modulo modulo, 
	c.nm_controller controller
from modulo m
join controller c on c.fk_modulo = m.id_modulo
where m.codigo_modulo = 'administrativo'

/*Selecionar actions por controller*/
select 
	c.nm_controller controller,
	a.nm_action
from controller c
join action a on a.fk_controller = c.codigo_controller
where c.id_controller = 6

select 
	m.nm_modulo modulo,
	m.codigo_modulo,
	c.nm_controller controller,
	c.codigo_controller,
	id_controller
from modulo m
join controller c on c.fk_modulo = m.id_modulo
order by m.ordem, c.ordem

/**PERFIL**/
create table perfil(
        id_perfil bigserial not null primary key,
        nm_perfil varchar(250) unique,
        desc_perfil varchar(500)
);
create table perfil_usuario(
	fk_perfil bigint not null,
	fk_usuario bigint not null,
	foreign key (fk_perfil) references perfil(id_perfil),
	foreign key (fk_usuario) references pessoa(id_pessoa)
);

insert into perfil(nm_perfil, desc_perfil) values('Administrador geral', 'Administrador geral');
insert into perfil(nm_perfil, desc_perfil) values('Administrador regional', 'Administrador regional');
insert into perfil(nm_perfil, desc_perfil) values('Administrador local', 'Administrador local');
insert into perfil(nm_perfil, desc_perfil) values('Secretário', 'Secretário');
insert into perfil(nm_perfil, desc_perfil) values('Pessoa Juridica', 'Visualização pessoas juridica');

insert into perfil_usuario values((select id_perfil from perfil where nm_perfil = 'Administrador geral'),(select fk_pessoa from usuario where login = 'admin'));
insert into perfil_usuario values((select id_perfil from perfil where nm_perfil = 'Pessoa Juridica'),(select fk_pessoa from usuario where login = 'pink'));

insert into pessoa values(13272511000104);
insert into pessoa_juridica values(13272511000104, 'Pink Floyd Music Band LTDA', 'Pink Floyd');
insert into usuario values(13272511000104,'pink','d033e22ae348aeb5660fc2140aec35850c4da997',now());

/*Consulta o perfil dos usuários do sistema, informando o tipo de pessoa*/
select  
	pe.nm_perfil perfil,
	nvl(pf.nm_pessoa||' (Fisica)', pj.nm_razao_social||' (Juridica)') nome
from usuario u
join pessoa p on p.id_pessoa = u.fk_pessoa
left join pessoa_fisica pf on pf.nr_cpf = u.fk_pessoa
left join pessoa_juridica pj on pj.nr_cnpj = u.fk_pessoa
join perfil_usuario pu on pu.fk_usuario = u.fk_pessoa
join perfil pe on pe.id_perfil = pu.fk_perfil
