/**
 * Documentação das tabelas e campos.
 */
/*
 * Pessoa
 */
comment on table pessoa.pessoa is 'Tabela Pessoa é a especialização de pessoas no sistema.';
comment on column pessoa.pessoa.id_pessoa is 'Chave principal de identificação da pessoa no sistema, pode ser um cpf(fisica) cnpj(juridica)';
/*
 * fisica
 */
comment on table pessoa.fisica is 'Generalização de pessoa identificada pelo cpf.';
/*
 * Juridica
 */
comment on table pessoa.juridica is 'Generalização de pessoa identificada pelo cnpj.';