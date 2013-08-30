/**
 * Insersões de dados
 *
 */
insert into administrativo.modulo(codigo_modulo,nm_modulo,desc_modulo,ordem) values ('administrativo','Administrativo','Cadastro administrativos do sistema.',0);

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.modulo', 'Cadastro de modulos', 'Cadastro de modulos para o sistema.',1);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.modulo', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.controller', 'Cadastro de controllers', 'Cadastro de controllers para o sistema.',2);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.controller', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'administrativo'), 'cad.action', 'Cadastro de actions', 'Cadastro de actions para o sistema.',3);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.');
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'editar', 'Editar', 'Funcão para edição.');
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.action', 'excluir', 'Excluir', 'Funcão para exclusão.');

insert into administrativo.modulo(codigo_modulo,nm_modulo,desc_modulo, ordem) values ('pessoa','Pessoas','Cadastro de pessoas para o sistema.',1);

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'pessoa'), 'cad.pessoa.fisica', 'Cadastro de pessoa física', 'Cadastro de pessoa física.',1);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.fisica', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'pessoa'), 'cad.pessoa.juridica', 'Cadastro de pessoa juridica', 'Cadastro de pessoa juridica.',2);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.pessoa.juridica', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.controller(fk_modulo, codigo_controller, nm_controller, desc_controller, ordem) values ((select id_modulo from administrativo.modulo where codigo_modulo = 'pessoa'), 'cad.usuario', 'Cadastro de usuários', 'Cadastro de usuários do sistema.',3);
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'cadastrar', 'Cadastrar', 'Funcão para cadastro.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'editar', 'Editar', 'Funcão para edição.' );
insert into administrativo.action(fk_controller, codigo_action, nm_action, desc_action) values ('cad.usuario', 'excluir', 'Excluir', 'Funcão para exclusão.' );

insert into administrativo.organizacao(nm_organizacao, razao_social, nr_cnpj, organizacao_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Grass Company', 'INC Grass Company SA',65437872000167, true, null, 0, now());
insert into administrativo.organizacao(nm_organizacao, razao_social, nr_cnpj, organizacao_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Grass Company II', 'INC Grass Company SA',65437872000166, false, (select id_organizacao from administrativo.organizacao where nr_cnpj = 65437872000167), 1, now());
insert into administrativo.organizacao(nm_organizacao, razao_social, nr_cnpj, organizacao_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Moon Inc', 'Dark Side Moon INC SA',57612881000119, false, (select id_organizacao from administrativo.organizacao where nr_cnpj = 65437872000167), 2, now());
insert into administrativo.organizacao(nm_organizacao, razao_social, nr_cnpj, organizacao_matriz, fk_matriz,prioridade_exibicao, data_cadastro) values ('Another Brink', 'Another Brink in the Wall',57612881000118, true, null, 1, now());

insert into administrativo.usuario values(99999999999,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',now());

insert into administrativo.perfil(nm_perfil, desc_perfil) values('Administrador geral', 'Administrador geral');
insert into administrativo.perfil(nm_perfil, desc_perfil) values('Administrador regional', 'Administrador regional');
insert into administrativo.perfil(nm_perfil, desc_perfil) values('Administrador local', 'Administrador local');
insert into administrativo.perfil(nm_perfil, desc_perfil) values('Secretário', 'Secretário');
insert into administrativo.perfil(nm_perfil, desc_perfil) values('Pessoa Juridica', 'Visualização pessoas juridica');

insert into administrativo.perfil_organizacao values(1,1);
insert into administrativo.perfil_organizacao values(1,2);

insert into administrativo.perfil_usuario values((select id_perfil from administrativo.perfil where nm_perfil = 'Administrador geral'),(select fk_pessoa from administrativo.usuario where login = 'admin'));

insert into administrativo.usuario values(13272511000104,'pink','d033e22ae348aeb5660fc2140aec35850c4da997',now());
insert into administrativo.perfil_usuario values((select id_perfil from administrativo.perfil where nm_perfil = 'Pessoa Juridica'),(select fk_pessoa from administrativo.usuario where login = 'pink'));