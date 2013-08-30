/**
 * Consultas
 *
 */
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
