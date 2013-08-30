/**
 * Funções.
 *
 */
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
comment on function nvl is 'Substitui o valor do primeiro termo pelo segundo caso o primeiro valor esteja nulo.';
