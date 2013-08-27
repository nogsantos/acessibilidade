CREATE OR REPLACE FUNCTION nvl(character varying, character varying) RETURNS character varying AS 
$$
/**
 * Substitui o valor do primeiro termo pelo segundo caso o primeiro valor esteja nulo.
 * Eschema Public
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
/**
 * Schema Pessoa
 */
create schema pessoa;
create table pessoa.pessoa(
    id_pessoa bigint not null primary key  
);
create table pessoa.fisica(
    nr_cpf bigint not null primary key,
    nm_pessoa varchar(250),
    foreign key (nr_cpf) references pessoa.pessoa(id_pessoa)
);
create table pessoa.juridica(
    nr_cnpj bigint not null primary key,
    nm_razao_social varchar(250),
    nm_fantasia varchar(250),
    foreign key (nr_cnpj) references pessoa.pessoa(id_pessoa)
);
create table pessoa.usuario(
    fk_pessoa bigint not null primary key,
    login character varying(50) unique NOT NULL,
    senha character(40),
    data_cadastro timestamp with time zone,
    data_bloqueio timestamp with time zone,
    foreign key (fk_pessoa) references pessoa.pessoa(id_pessoa)
);
create table pessoa.perfil(
        id_perfil bigserial not null primary key,
        nm_perfil varchar(250) unique,
        desc_perfil varchar(500)
);
create table pessoa.perfil_usuario(
	fk_perfil bigint not null,
	fk_usuario bigint not null,
	foreign key (fk_perfil) references pessoa.perfil(id_perfil),
	foreign key (fk_usuario) references pessoa.pessoa(id_pessoa)
);

insert into pessoa.pessoa values(99999999999);
insert into pessoa.fisica values(99999999999, 'Administrador do Sistema');
insert into pessoa.usuario values(99999999999,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',now());

insert into pessoa.perfil(nm_perfil, desc_perfil) values('Administrador geral', 'Administrador geral');
insert into pessoa.perfil(nm_perfil, desc_perfil) values('Administrador regional', 'Administrador regional');
insert into pessoa.perfil(nm_perfil, desc_perfil) values('Administrador local', 'Administrador local');
insert into pessoa.perfil(nm_perfil, desc_perfil) values('Secretário', 'Secretário');
insert into pessoa.perfil(nm_perfil, desc_perfil) values('Pessoa Juridica', 'Visualização pessoas juridica');

insert into pessoa.perfil_usuario values((select id_perfil from pessoa.perfil where nm_perfil = 'Administrador geral'),(select fk_pessoa from pessoa.usuario where login = 'admin'));

insert into pessoa.pessoa values(13272511000104);
insert into pessoa.juridica values(13272511000104, 'Pink Floyd Music Band LTDA', 'Pink Floyd');
insert into pessoa.usuario values(13272511000104,'pink','d033e22ae348aeb5660fc2140aec35850c4da997',now());
insert into pessoa.perfil_usuario values((select id_perfil from pessoa.perfil where nm_perfil = 'Pessoa Juridica'),(select fk_pessoa from pessoa.usuario where login = 'pink'));

select 
    nr_cpf,
    nm_pessoa,
    login,
    senha
from pessoa.fisica pf
join pessoa.usuario u on u.fk_pessoa = pf.nr_cpf

/**
 * Schema Administrativos
 */
create schema administrativo;
create table administrativo.modulo(
	id_modulo bigserial not null primary key,
	codigo_modulo varchar(40) not null unique,
	nm_modulo varchar(250) not null unique,
	desc_modulo varchar(500),
	ordem integer
);
create table administrativo.controller(
	id_controller bigserial not null primary key,
	fk_modulo bigint not null,
	codigo_controller varchar(60) not null unique,
	nm_controller varchar(250) not null unique,	
	desc_controller varchar(500),
	ordem integer,
	foreign key (fk_modulo) references administrativo.modulo (id_modulo)	
);
create table administrativo.action(
	fk_controller varchar(60) not null,
	codigo_action varchar(60) not null,
	nm_action varchar(250) not null,	
	desc_action varchar(500),	
	foreign key (fk_controller) references administrativo.controller (codigo_controller)
);
create table administrativo.user_session( 
    session_id varchar(32) NOT NULL primary key, 
    session_user_id bigint, 
    session_expire integer NOT NULL default '0', 
    session_data text NOT NULL,
    foreign key (session_user_id) references pessoa.usuario (fk_pessoa)
);

create table administrativo.empresa(
    id_empresa bigserial not null primary key,
    nm_empresa varchar(250) not null,
    razao_social varchar(500) not null,
    nr_cnpj bigint not null unique,
    empresa_matriz boolean, -- Confirma se é a empresa matriz.
    fk_matriz bigint, -- Auto relacionamento, caso não seja matriz com a matriz.
    prioridade_exibicao integer not null default (0), -- Define a prioridade de exibição.
    data_cadastro timestamp with time zone not null default(now()),
    data_bloqueio timestamp with time zone,
    foreign key (fk_matriz) references administrativo.empresa (id_empresa)
);

create table administrativo.perfil_empresa(
    fk_perfil bigint not null,
    fk_empresa bigint not null,
    foreign key (fk_perfil) references pessoa.perfil (id_perfil),
    foreign key (fk_empresa) references administrativo.empresa (id_empresa)	
);

insert into administrativo.modulo(codigo_modulo,nm_modulo,desc_modulo,ordem) values ('administrativo','Administrativo','Cadastro administrativos do sistema.',0);

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.modulo', 'Cadastro de modulos', 'Cadastro de modulos para o sistema.',1);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.controller', 'Cadastro de controllers', 'Cadastro de controllers para o sistema.',2);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.action', 'Cadastro de actions', 'Cadastro de actions para o sistema.',3);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.');
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'editar', 'Editar', 'Funcão para edição.');
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'excluir', 'Excluir', 'Funcão para exclusão.');

insert into administrativo.modulo(codigo_modulo,nm_modulo,desc_modulo, ordem) values ('pessoa','Pessoas','Cadastro de pessoas para o sistema.',1);

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'pessoa'), 'cad.pessoa.fisica', 'Cadastro de pessoa física', 'Cadastro de pessoa física.',1);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'pessoa'), 'cad.pessoa.juridica', 'Cadastro de pessoa juridica', 'Cadastro de pessoa juridica.',2);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'pessoa'), 'cad.usuario', 'Cadastro de usuários', 'Cadastro de usuários do sistema.',3);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.empresa(nm_empresa, razao_social, nr_cnpj, empresa_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Grass Company', 'INC Grass Company SA',65437872000167, true, null, 0, now());
insert into administrativo.empresa(nm_empresa, razao_social, nr_cnpj, empresa_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Grass Company II', 'INC Grass Company SA',65437872000166, false, (select id_empresa from administrativo.empresa where nr_cnpj = 65437872000167), 1, now());
insert into administrativo.empresa(nm_empresa, razao_social, nr_cnpj, empresa_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Moon Inc', 'Dark Side Moon INC SA',57612881000119, false, (select id_empresa from administrativo.empresa where nr_cnpj = 65437872000167), 2, now());
insert into administrativo.empresa(nm_empresa, razao_social, nr_cnpj, empresa_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Another Brink', 'Another Brink in the Wall',57612881000118, true, null, 1, now());

insert into administrativo.perfil_empresa values(1,1);
insert into administrativo.perfil_empresa values(1,2);

select 
	m.nm_modulo,
	a.nm_action,
	c.codigo_controller
from administrativo.controller c
join administrativo.action a on a.fk_controller = c.codigo_controller
join administrativo.modulo m on m.id_modulo = c.fk_modulo
where m.codigo_modulo = 'administrativo'

/*Selecionar todos os controllers por módulo*/
select
	m.nm_modulo modulo, 
	c.nm_controller controller
from administrativo.modulo m
join administrativo.controller c on c.fk_modulo = m.id_modulo
where m.codigo_modulo = 'administrativo'

/*Selecionar actions por controller*/
select 
	c.nm_controller controller,
	a.nm_action
from administrativo.controller c
join administrativo.action a on a.fk_controller = c.codigo_controller
where c.id_controller = 6

select 
	m.nm_modulo modulo,
	m.codigo_modulo,
	c.nm_controller controller,
	c.codigo_controller,
	id_controller
from administrativo.modulo m
join administrativo.controller c on c.fk_modulo = m.id_modulo
order by m.ordem, c.ordem

/*Consulta o perfil dos usuários do sistema, informando o tipo de pessoa*/
select  
	pe.nm_perfil perfil,
	nvl(pf.nm_pessoa||' (Fisica)', pj.nm_razao_social||' (Juridica)') nome
from pessoa.usuario u
join pessoa.pessoa p on p.id_pessoa = u.fk_pessoa
left join pessoa.fisica pf on pf.nr_cpf = u.fk_pessoa
left join pessoa.juridica pj on pj.nr_cnpj = u.fk_pessoa
join pessoa.perfil_usuario pu on pu.fk_usuario = u.fk_pessoa
join pessoa.perfil pe on pe.id_perfil = pu.fk_perfil

select 
	id_empresa,
	nm_empresa
from administrativo.empresa

/*Consulta os usuários por perfil*/
select
	nvl(pf.nm_pessoa, pj.nm_razao_social) usuario,
	nm_perfil,
	nm_empresa
from pessoa.perfil p
join administrativo.perfil_empresa pe on pe.fk_perfil = p.id_perfil
join administrativo.empresa e on e.id_empresa = pe.fk_empresa
join pessoa.perfil_usuario pu on pu.fk_perfil = p.id_perfil
join pessoa.usuario u on u.fk_pessoa = pu.fk_usuario
join pessoa.pessoa pes on pes.id_pessoa = u.fk_pessoa
left join pessoa.fisica pf on pf.nr_cpf = u.fk_pessoa
left join pessoa.juridica pj on pj.nr_cnpj = u.fk_pessoa

/*View login usuário*/
create view vw_login_usuario as
    select 
        e.id_empresa,
        u.fk_pessoa,
        u.login, 
        u.senha 
    from pessoa.usuario as u
    join pessoa.perfil_usuario pu on pu.fk_usuario = u.fk_pessoa
    join administrativo.perfil_empresa pe on pe.fk_perfil = pu.fk_perfil
    join administrativo.empresa e on e.id_empresa = pe.fk_empresa
    where u.data_bloqueio is null