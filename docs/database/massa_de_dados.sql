begin transaction;
insert into pessoa.pessoa(id_pessoa) values(99999999999);
insert into pessoa.fisica(numero_cpf, nome_pessoa_fisica, descricao_sexo) values(99999999999, 'Administrador do Sistema','M');

insert into pessoa.pessoa(id_pessoa) values(13272511000104);
insert into pessoa.juridica(numero_cnpj, nome_pessoa_juridica, nome_fantasia) values(13272511000104, 'Pink Floyd Music Band LTDA', 'Pink Floyd');

insert into administrativo.modulo(codigo_modulo,nome_modulo,descricao_modulo,numero_ordem) values ('administrativo','Administrativo','Cadastro administrativos do sistema.',0);

insert into administrativo.controller(fk_modulo, codigo_controller, nome_controller, descricao_controller, numero_ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.modulo', 'Cadastro de modulos', 'Cadastro de modulos para o sistema.',1);
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.modulo'), 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.modulo'), 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.modulo'), 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nome_controller, descricao_controller, numero_ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.controller', 'Cadastro de controllers', 'Cadastro de controllers para o sistema.',2);
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.controller'), 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.controller'), 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.controller'), 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nome_controller, descricao_controller, numero_ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.action', 'Cadastro de actions', 'Cadastro de actions para o sistema.',3);
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.action'), 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.action'), 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nome_action, descricao_action) values ((select id_controller from administrativo.controller where codigo_controller = 'cad.action'), 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.usuario values(99999999999,'admin','d033e22ae348aeb5660fc2140aec35850c4da997');

insert into administrativo.perfil(nome_perfil, descricao_perfil) values('Administrador geral', 'Administrador geral');
insert into administrativo.perfil(nome_perfil, descricao_perfil) values('Administrador regional', 'Administrador regional');
insert into administrativo.perfil(nome_perfil, descricao_perfil) values('Administrador local', 'Administrador local');
insert into administrativo.perfil(nome_perfil, descricao_perfil) values('Secretário', 'Secretário');
insert into administrativo.perfil(nome_perfil, descricao_perfil) values('Pessoa Juridica', 'Visualização pessoas juridica');


insert into administrativo.organizacao(cnpj_organizacao, nome_organizacao, razao_social, fk_matriz, prioridade_exibicao) values(63546143000113, 'Grass', 'Grass Company S/A', null, 0);
insert into administrativo.organizacao(cnpj_organizacao, nome_organizacao, razao_social, fk_matriz, prioridade_exibicao) values(39131837000105, 'Lunatics', 'The Lunatics is on the grass', 63546143000113, 1);
insert into administrativo.organizacao(cnpj_organizacao, nome_organizacao, razao_social, fk_matriz, prioridade_exibicao) values(92657468000171, 'War Machine', 'No line on the horizon', null, 2);

insert into administrativo.perfil_organizacao values(63546143000113, (select id_perfil from administrativo.perfil where nome_perfil = 'Administrador geral'));
insert into administrativo.perfil_organizacao values(63546143000113, (select id_perfil from administrativo.perfil where nome_perfil = 'Administrador regional'));
commit;
insert into administrativo.perfil_usuario values((select id_perfil from administrativo.perfil where nome_perfil = 'Administrador geral'), 99999999999);
