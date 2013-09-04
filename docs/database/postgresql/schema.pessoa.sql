/**
 * Schema Pessoa
 * 
 * Módulo Pessoas.
 *
 * @version 1.0.0
 *
 */
create schema pessoa;
/*
 * Tabela Pessoa é a especialização de pessoas no sistema.
 */
create table pessoa.pessoa(
    id_pessoa bigint,
    fk_email bigint,
    nm_paginaweb varchar(100)
)WITHOUT OIDS;
/*
 * Generalização de pessoa identificada pelo cpf.
 */
create table pessoa.fisica(
    nr_cpf bigint,
    nm_pessoa varchar(250),
    tipo_pessoa_fisica varchar()
)WITHOUT OIDS;
comment on column pessoa.fisica.tipo_pessoa_fisica is 'Define qual o tipo de pessoa ';
/*
 * Generalização de pessoa identificada pelo cnpj
 */
create table pessoa.juridica(
    nr_cnpj bigint,
    nm_razao_social varchar(250),
    nm_fantasia varchar(250)
)WITHOUT OIDS;
