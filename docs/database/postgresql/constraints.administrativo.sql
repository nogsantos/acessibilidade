/**
 * Constraints Pessoas: Primary, foreing, not null, unique
 * 
 * @version 1.0.0
 */
/*
 * Modulo
 */
ALTER TABLE ONLY administrativo.modulo
    ADD CONSTRAINT id_modulo_pkey PRIMARY KEY (id_modulo);
ALTER TABLE ONLY administrativo.modulo
    ADD CONSTRAINT uq_administrativo_modulo_codigo_modulo UNIQUE (codigo_modulo);
ALTER TABLE ONLY administrativo.modulo
    ADD CONSTRAINT uq_administrativo_modulo_nm_modulo UNIQUE (nm_modulo);
/*
 * Controller
 */
ALTER TABLE ONLY administrativo.controller
    ADD CONSTRAINT id_controller_pkey PRIMARY KEY (id_controller);
ALTER TABLE ONLY administrativo.controller
    ADD CONSTRAINT uq_administrativo_controller_codigo_controller UNIQUE (codigo_controller);
ALTER TABLE ONLY administrativo.controller
    ADD CONSTRAINT uq_administrativo_controller_nm_controller UNIQUE (nm_controller);
ALTER TABLE ONLY administrativo.controller
    ADD CONSTRAINT administrativo_controller_fk_modulo_fkey FOREIGN KEY (fk_modulo) REFERENCES administrativo.modulo(id_modulo);
/*
 * Action
 */
ALTER TABLE ONLY administrativo.action
    ADD CONSTRAINT administrativo_action_fk_controller_fkey FOREIGN KEY (fk_controller) REFERENCES administrativo.controller (codigo_controller);
/*
 * usuario
 */
ALTER TABLE ONLY administrativo.usuario
    ADD CONSTRAINT administrativo_usuario_pkey PRIMARY KEY (fk_pessoa);
ALTER TABLE ONLY administrativo.usuario
    ADD CONSTRAINT administrativo_usuario_fk_pessoa_fkey FOREIGN KEY (fk_pessoa) REFERENCES pessoa.pessoa(id_pessoa);
ALTER TABLE ONLY administrativo.usuario
    ADD CONSTRAINT uq_administrativo_usuario_login UNIQUE (login);
/*
 * perfil
 */
ALTER TABLE ONLY administrativo.perfil
    ADD CONSTRAINT administrativo_perfil_pkey PRIMARY KEY (id_perfil);
ALTER TABLE ONLY administrativo.perfil
    ADD CONSTRAINT uq_administrativo_perfil_nm_perfil UNIQUE (nm_perfil);
/*
 * perfil usuario
 */
ALTER TABLE ONLY administrativo.perfil_usuario
    ADD CONSTRAINT administrativo_perfil_usuario_fk_perfil_fkey FOREIGN KEY (fk_perfil) REFERENCES administrativo.perfil(id_perfil);
ALTER TABLE ONLY administrativo.perfil_usuario
    ADD CONSTRAINT administrativo_perfil_usuario_fk_usuario_fkey FOREIGN KEY (fk_usuario) REFERENCES pessoa.pessoa(id_pessoa);
/*
 * organizacao
 */
ALTER TABLE ONLY administrativo.organizacao
    ADD CONSTRAINT administrativo_organizacao_pkey PRIMARY KEY (id_organizacao);
ALTER TABLE ONLY administrativo.organizacao
    ADD CONSTRAINT uq_administrativo_organizacao_nm_perfil UNIQUE (nr_cnpj);
ALTER TABLE ONLY administrativo.organizacao
    ADD CONSTRAINT administrativo_organizacao_fk_matriz_fkey FOREIGN KEY (fk_matriz) REFERENCES administrativo.organizacao (id_organizacao);
/*
 * organizacao telefones
 */
ALTER TABLE ONLY administrativo.organizacao_telefone
    ADD CONSTRAINT administrativo_organizacao_telefone_fk_organizacao_fkey FOREIGN KEY (fk_organizacao) REFERENCES administrativo.organizacao (id_organizacao);
ALTER TABLE ONLY administrativo.organizacao_telefone
    ADD CONSTRAINT administrativo_organizacao_telefone_fk_telefone_fkey FOREIGN KEY (fk_telefone) REFERENCES public.telefone (id_telefone);
/*
 * organizacao perfil
 */
ALTER TABLE ONLY administrativo.perfil_organizacao
    ADD CONSTRAINT administrativo_perfil_organizacao_fk_perfil_fkey FOREIGN KEY (fk_perfil) REFERENCES administrativo.perfil (id_perfil);
ALTER TABLE ONLY administrativo.organizacao_telefone
    ADD CONSTRAINT administrativo_perfil_organizacao_fk_organizacao_fkey FOREIGN KEY (fk_organizacao) REFERENCES administrativo.organizacao (id_organizacao);