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
    id_pessoa bigint    
)WITHOUT OIDS;
/*
 * Generalização de pessoa identificada pelo cpf.
 */
create table pessoa.fisica(
    nr_cpf bigint,
    nm_pessoa varchar(250)
)WITHOUT OIDS;
/*
 * Generalização de pessoa identificada pelo cnpj
 */
create table pessoa.juridica(
    nr_cnpj bigint,
    nm_razao_social varchar(250),
    nm_fantasia varchar(250)
)WITHOUT OIDS;
