/**
 * Consultas
 *
 */
select 
    nr_cpf,
    nm_pessoa,
    login,
    senha
from pessoa.fisica pf
join pessoa.usuario u on u.fk_pessoa = pf.nr_cpf


