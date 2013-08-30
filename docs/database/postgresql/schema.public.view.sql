/**
 *
 * Views do sistema
 *
 */

/*
 * login usuário
 */
create view vw_login_usuario as
    select 
        e.id_organizacao,
        u.fk_pessoa,
        u.login, 
        u.senha 
    from administrativo.usuario as u
    join administrativo.perfil_usuario pu on pu.fk_usuario = u.fk_pessoa
    join administrativo.perfil_organizacao pe on pe.fk_perfil = pu.fk_perfil
    join administrativo.organizacao e on e.id_organizacao = pe.fk_organizacao
    where u.data_bloqueio is null

comment on view vw_login_usuario is 'Consulta para login do sistema.';