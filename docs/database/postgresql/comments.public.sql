/*
 * endereco
 */
comment on table public.endereco is 'Cadastro global de endereços para as entidades que necessitem dessa opção no sistema.';
/*
 * telefone
 */
comment on table public.telefone is 'Cadastro global de telefones para as entidades que necessitem dessa opção no sistema.';
comment on column public.telefone.nm_tipo is 'Informa o tipo de telefone, fixo, fax, celular, trabalho, residencial etc.';
/*
 * email
 */
comment on table public.email is 'Cadastro global de endereços de email para as entidades que necessitem dessa opção no sistema.';
/*
 * municipios
 */
comment on table public.municipio is 'Municípios disponíveis no sistema.';