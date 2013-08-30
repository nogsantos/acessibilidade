/*
 * endereco
 */
ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT public_endereco_pkey PRIMARY KEY (id_endereco);
ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT public_endereco_fk_municipio_fkey FOREIGN KEY (fk_municipio) REFERENCES public.municipio(id_municipio);
/*
 * endereco
 */
ALTER TABLE ONLY public.telefone
    ADD CONSTRAINT public_telefone_pkey PRIMARY KEY (id_telefone);
/*
 * email
 */
ALTER TABLE ONLY public.email
    ADD CONSTRAINT public_email_pkey PRIMARY KEY (id_email);
ALTER TABLE ONLY public.email
    ADD CONSTRAINT uq_public_email_nm_email UNIQUE (nm_email);
/*
 * email
 */
ALTER TABLE ONLY public.municipio
    ADD CONSTRAINT public_municipio_pkey PRIMARY KEY (id_municipio);