/**
 * Constraints Pessoas: Primary, foreing, not null, unique
 * 
 * @version 1.0.0
 */
/*
 * Pessoa
 */
ALTER TABLE ONLY pessoa.pessoa
    ADD CONSTRAINT pessoa_pkey PRIMARY KEY (id_pessoa);
/*
 * fisica
 */
ALTER TABLE ONLY pessoa.fisica
    ADD CONSTRAINT pessoa_fisica_pkey PRIMARY KEY (nr_cpf);
ALTER TABLE ONLY pessoa.fisica
    ADD CONSTRAINT pessoa_fisica_nr_cpf_fkey FOREIGN KEY (nr_cpf) REFERENCES pessoa.pessoa(id_pessoa);
/*
 * juridica
 */
ALTER TABLE ONLY pessoa.juridica
    ADD CONSTRAINT pessoa_juridica_pkey PRIMARY KEY (nr_cnpj);
ALTER TABLE ONLY pessoa.juridica
    ADD CONSTRAINT pessoa_juridica_nr_cnpj_fkey FOREIGN KEY (nr_cnpj) REFERENCES pessoa.pessoa(id_pessoa);
