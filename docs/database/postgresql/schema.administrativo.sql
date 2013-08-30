/**
 * Schema Administrativo
 * 
 * Módulo Pessoas.
 *
 * @version 1.0.0
 *
 */
create schema administrativo;
/*
 * Módulos disponíveis no sistema.
 */
create table administrativo.modulo(
    id_modulo bigserial,
    codigo_modulo varchar(40) not null,
    nm_modulo varchar(250) not null,
    desc_modulo varchar(500),
    ordem integer,
    data_cadastro timestamp with time zone not null default(now()),
    data_bloqueio timestamp with time zone
)WITHOUT OIDS;
/*
 * Controladores do sistema.
 */
create table administrativo.controller(
    id_controller bigserial,
    fk_modulo bigint not null,
    codigo_controller varchar(60) not null,
    nm_controller varchar(250) not null,
    desc_controller varchar(500),
    ordem integer,
    data_cadastro timestamp with time zone not null default(now()),
    data_bloqueio timestamp with time zone
)WITHOUT OIDS;
/*
 * Ações do sistema, cadastrar, editar, excluir etc.
 */
create table administrativo.action(
    fk_controller varchar(60) not null,
    codigo_action varchar(60) not null,
    nm_action varchar(250) not null,	
    desc_action varchar(500),
    data_cadastro timestamp with time zone not null default(now()),
    data_bloqueio timestamp with time zone
)WITHOUT OIDS;
/*
 * Generalização de pessoa, contém informações de acesso ao sistema.
 */
create table administrativo.usuario(
    fk_pessoa bigint,
    login character varying(50) not null,
    senha character(40),
    data_cadastro timestamp with time zone,
    data_bloqueio timestamp with time zone
)WITHOUT OIDS;
/*
 * Definição do perfil dos usuários no sistema.
 */
create table administrativo.perfil(
    id_perfil bigserial,
    nm_perfil varchar(250),
    desc_perfil varchar(500)
)WITHOUT OIDS;
/*
 * Tabela intermediária entre perfil e usuário, permitindo ao usuário 
 * exercer mais de um papel no sistema.
 */
create table administrativo.perfil_usuario(
    fk_perfil bigint not null,
    fk_usuario bigint not null
)WITHOUT OIDS;
/*
 * Cadastro de organizações no sistema.
 */
create table administrativo.organizacao(
    id_organizacao bigserial,
    nm_organizacao varchar(250) not null,
    razao_social varchar(500) not null,
    nr_cnpj bigint not null,
    organizacao_matriz boolean,
    fk_matriz bigint,
    prioridade_exibicao integer not null default (0), 
    data_cadastro timestamp with time zone not null default(now()),
    data_bloqueio timestamp with time zone
)WITHOUT OIDS;
/*
 * Possibilita o cadastro de n telefones por organizacao.
 */
create table administrativo.organizacao_telefone(
    fk_organizacao bigint not null,
    fk_telefone bigint not null,
    flag_principal boolean
)WITHOUT OIDS;
/*
 * Tabela intermediária que permite um perfil ter acesso a mais 
 * de uma empresa do sistema.
 */
create table administrativo.perfil_organizacao(
    fk_perfil bigint not null,
    fk_organizacao bigint not null
)WITHOUT OIDS;

