/**
 * Documentação das tabelas e campos.
 *
 */
/*
 * Modulos
 */
comment ON TABLE administrativo.modulo IS 'Módulos disponíveis no sistema.';
COMMENT ON COLUMN administrativo.modulo.codigo_modulo IS 'String identificadora do módulo.';
COMMENT ON COLUMN administrativo.modulo.desc_modulo IS 'Texto descritivo do módulo.';
COMMENT ON COLUMN administrativo.modulo.ordem IS 'Ordenação para exibição do módulo.';
/*
 * Controller
 */
comment ON TABLE administrativo.controller IS 'Controladores do sistema.';
COMMENT ON COLUMN administrativo.controller.codigo_controller IS 'String identificadora do controller';
COMMENT ON COLUMN administrativo.controller.desc_controller IS 'Texto descritivo para o controller';
COMMENT ON COLUMN administrativo.controller.ordem IS 'Ordenação para exibição do controller.';
/*
 * Action
 */
comment ON TABLE administrativo.action IS 'Ações do sistema, cadastrar, editar, excluir etc.';
/*
 * usuario
 */
comment on table administrativo.usuario is 'Generalização de pessoa, contém informações de acesso ao sistema.';
/*
 * perfil
 */
comment on table administrativo.perfil is 'Definição do perfil dos usuários no sistema.';
/*
 * perfil usuario
 */
comment on table administrativo.perfil_usuario is 'Tabela intermediária entre perfil e usuário, permitindo ao usuário exercer mais de um papel no sistema.';
/*
 * Organizacao
 */
comment on table administrativo.organizacao is 'Cadastro de organizações no sistema.';
comment on column administrativo.organizacao.organizacao_matriz is 'Confirma se é a organização matriz(true) ou filial(false).';
comment on column administrativo.organizacao.fk_matriz is 'Caso seja uma filial, informa quem é a matriz.';
comment on column administrativo.organizacao.prioridade_exibicao is 'Define a prioridade de exibição para seleção no formulário de login do sistema.';
/*
 * Organizacao telefone
 */
comment on table administrativo.organizacao_telefone is 'Possibilita o cadastro de n telefones por empresa.';
comment on column administrativo.organizacao_telefone.flag_principal is 'Define dentre os telefones cadastrados para a empresa, qual será o principal.';
/*
 * organizacao perfil
 */
comment on table administrativo.perfil_organizacao is 'Tabela intermediária que permite um perfil ter acesso a mais de uma organização do sistema.';