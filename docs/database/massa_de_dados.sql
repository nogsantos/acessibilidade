
insert into pessoa.pessoa(id_pessoa) values(99999999999);
insert into pessoa.fisica(numero_cpf, nome_pessoa_fisica, descricao_sexo) values(99999999999, 'Administrador do Sistema','M');

insert into pessoa.pessoa(id_pessoa) values(13272511000104);
insert into pessoa.juridica(numero_cnpj, nome_pessoa_juridica, nome_fantasia) values(13272511000104, 'Pink Floyd Music Band LTDA', 'Pink Floyd');

insert into administrativo.controller(nome_controller,codigo_controller,descricao_controller,numero_ordem)values('Administrativo','Administrativo','Controller para controle administrativos do sistema.',0);
insert into administrativo.action(fk_controller,id_action, codigo_action, rel_controller,rel_action,class_icone,nome_action,tipo_action,descricao_action,numero_ordem)values((select id_controller from administrativo.controller where codigo_controller = 'Administrativo'),'controller', 'controller','administrativo','controller',null,'Controladores','F','Listagem com grid dos controladores registradas no sistema',0);
insert into administrativo.action(fk_controller,id_action, codigo_action, rel_controller,rel_action,class_icone,nome_action,tipo_action,descricao_action,numero_ordem)values((select id_controller from administrativo.controller where codigo_controller = 'Administrativo'),'action', 'controller','administrativo','action',null,'Ações','F','Listagem com grid das ações registradas no sistema',1);
INSERT INTO administrativo.action(fk_controller, id_action, codigo_action, rel_controller, rel_action, class_icone,  nome_action, tipo_action, tipo_menu, descricao_action, numero_ordem)VALUES ((select id_controller from administrativo.controller where codigo_controller = 'Administrativo'),'bt_novo_controller','controller','administrativo','controller.form','icon-file-alt','Novo Controlador','B','L','Cadastro de novo controlador',0);
INSERT INTO administrativo.action(fk_controller, id_action, codigo_action, rel_controller, rel_action, class_icone,  nome_action, tipo_action, tipo_menu, descricao_action, numero_ordem)VALUES ((select id_controller from administrativo.controller where codigo_controller = 'Administrativo'),'salvarController','controller','administrativo','salvar.controller','icon-save','Salvar Controlador','B','F','Salvar controlador',0);
INSERT INTO administrativo.action(fk_controller, id_action, codigo_action, rel_controller, rel_action, class_icone,  nome_action, tipo_action, tipo_menu, descricao_action, numero_ordem)VALUES ((select id_controller from administrativo.controller where codigo_controller = 'Administrativo'),'bt_novo_action','action','administrativo','action.form','icon-file-alt','Nova Ação','B','L','Cadastro de novas ações',0);

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

insert into administrativo.perfil_usuario values((select id_perfil from administrativo.perfil where nome_perfil = 'Administrador geral'), 99999999999);
