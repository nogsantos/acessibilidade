/*
 * login usuário
 */
create view vw_login_usuario as
    select 
        e.cnpj_organizacao,
        u.fk_pessoa,
        u.nome_login, 
        u.nome_senha 
    from administrativo.usuario as u
    join administrativo.perfil_usuario pu on pu.fk_usuario = u.fk_pessoa
    join administrativo.perfil_organizacao pe on pe.fk_perfil = pu.fk_perfil
    join administrativo.organizacao e on e.cnpj_organizacao = pe.fk_organizacao
    where u.data_bloqueio is null;
