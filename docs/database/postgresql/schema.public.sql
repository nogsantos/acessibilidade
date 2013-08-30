/**
 * Schema Public
 *
 * Implementa funções, views e tabelas públicas do sistema.
 *
 * @version 1.0.0
 *
 */
/*
 * Cadastro global de endereços para as entidades que necessitem 
 * dessa opção no sistema.
 */
create table public.endereco(
    id_endereco bigserial,
    nm_logradouro varchar(500), 
    nm_bairro varchar(250),
    nr_lote integer,
    nr_quadra varchar(50), 
    nr_cep varchar(17),
    fk_municipio bigint
)WITHOUT OIDS;
/*
 * Cadastro global de telefones para as entidades que necessitem 
 * dessa opção no sistema.
 */
create table public.telefone(
    id_telefone bigserial,
    codigo_pais integer,
    nr_ddd integer not null,
    nr_telefone bigint not null, 
    nm_tipo varchar(30) not null,
    nm_operadora varchar(40)
)WITHOUT OIDS;
/*
 * Cadastro global de endereços de email para as entidades que 
 * necessitem dessa opção no sistema.
 */
create table public.email(
    id_email bigserial,
    nm_email varchar(250) not null
)WITHOUT OIDS;
/*
 * Municipios
 */
create table public.municipio(
    id_municipio bigserial, 
    nm_municipio varchar(250) not null, 
    sigla_uf char(2) not null,
    flag_capital boolean default(false)
)WITHOUT OIDS;
