create schema pessoa;

CREATE TABLE pessoa.pessoa (
    id_pessoa bigint PRIMARY KEY,
    nome_site varchar(300),
    data_cadastro timestamp with time zone not null DEFAULT current_timestamp
)WITHOUT OIDS;

CREATE TABLE public.endereco (
    id_endereco bigserial PRIMARY KEY,
    fk_municipio bigint,
    nome_logradouro varchar(500),
    nome_bairro varchar(300),
    numero_lote bigint,
    numero_quadra bigint,
    numero_cep bigint
)WITHOUT OIDS;

CREATE TABLE pessoa.pessoa_endereco (
    fk_endereco bigint,
    fk_pessoa bigint,
    flag_principal Boolean,
    tipo_endereco varchar(100),
    FOREIGN KEY(fk_endereco) REFERENCES public.endereco (id_endereco),
    FOREIGN KEY(fk_pessoa) REFERENCES pessoa.pessoa (id_pessoa), 
    PRIMARY KEY(fk_endereco, fk_pessoa)
)WITHOUT OIDS;

CREATE TABLE pessoa.pessoa_email (
    fk_email bigint,
    fk_pessoa bigint,
    flag_principal Boolean,
    tipo_email varchar(50),
    FOREIGN KEY(fk_pessoa) REFERENCES pessoa.pessoa (id_pessoa),
    PRIMARY KEY(fk_email, fk_pessoa)
)WITHOUT OIDS;

create schema administrativo;

CREATE TABLE administrativo.perfil_usuario (
    fk_perfil bigint,
    fk_usuario bigint,
    PRIMARY KEY(fk_perfil, fk_usuario)
)WITHOUT OIDS;

CREATE TABLE administrativo.organizacao_telefone (
    fk_telefone bigint,
    fk_organizacao bigint,
    flag_principal Boolean,
    tipo_telefone varchar(30),
    PRIMARY KEY(fk_telefone, fk_organizacao)
)WITHOUT OIDS;

CREATE TABLE administrativo.usuario (
    fk_pessoa bigint PRIMARY KEY,
    nome_login varchar(250) not null unique,
    nome_senha varchar(50) not null,
    data_bloqueio timestamp with time zone,
    FOREIGN KEY(fk_pessoa) REFERENCES pessoa.pessoa (id_pessoa),
    CONSTRAINT check_login_senha_usuario CHECK (length(nome_login) >= 4 AND length(nome_senha) >= 4)
)WITHOUT OIDS;

CREATE TABLE administrativo.organizacao_endereco (
    fk_organizacao bigint,
    fk_endereco bigint,
    flag_principal Boolean,
    tipo_endereco varchar(50),
    FOREIGN KEY(fk_endereco) REFERENCES public.endereco (id_endereco),
    PRIMARY KEY(fk_organizacao, fk_endereco)
)WITHOUT OIDS;

CREATE TABLE administrativo.organizacao (
    cnpj_organizacao bigint PRIMARY KEY,
    nome_organizacao varchar(300),
    razao_social varchar(350),     
    fk_matriz bigint,
    prioridade_exibicao integer,
    data_cadastro timestamp with time zone not null DEFAULT current_timestamp,
    data_bloqueio timestamp with time zone
)WITHOUT OIDS;

CREATE TABLE administrativo.perfil_organizacao (
    fk_organizacao bigint,
    fk_perfil bigint,
    FOREIGN KEY(fk_organizacao) REFERENCES administrativo.organizacao (cnpj_organizacao),
    PRIMARY KEY(fk_organizacao, fk_perfil)
)WITHOUT OIDS;

CREATE TABLE administrativo.controller (
    id_controller bigserial PRIMARY KEY,
    nome_controller varchar(300) unique,
    codigo_controller varchar(250) unique,
    descricao_controller varchar(500),
    numero_ordem integer,
    data_cadastro timestamp with time zone not null DEFAULT current_timestamp,
    data_bloqueio timestamp with time zone
)WITHOUT OIDS;

CREATE TABLE administrativo.action (
    fk_controller bigint,
    id_action varchar(50) PRIMARY KEY,
    codigo_action character varying(250) not null,
    rel_controller varchar(100),
    rel_action varchar(100),
    class_icone varchar(100),
    class_botao varchar(100) not null default 'btn-default',
    nome_action varchar(300) not null,
    tipo_action char(1) not null,
    tipo_menu char(1),
    descricao_action varchar(500),
    numero_ordem integer,
    data_cadastro timestamp with time zone not null DEFAULT current_timestamp,
    data_bloqueio timestamp with time zone,
    FOREIGN KEY(fk_controller) REFERENCES administrativo.controller (id_controller),
    CONSTRAINT const_action_tipo_action CHECK (tipo_action = 'B' OR tipo_action = 'F' OR tipo_action = 'U'),
    CONSTRAINT const_action_tipo_menu CHECK (tipo_menu = 'F' OR tipo_menu = 'L')
)WITHOUT OIDS;

CREATE TABLE administrativo.perfil_controller (
    fk_controller bigint,
    fk_perfil bigint,
    FOREIGN KEY(fk_controller) REFERENCES administrativo.controller (id_controller),
    PRIMARY KEY(fk_controller, fk_perfil)
)WITHOUT OIDS;

CREATE TABLE administrativo.perfil (
    id_perfil bigserial PRIMARY KEY,
    nome_perfil varchar(300) unique,
    descricao_perfil varchar(500)
)WITHOUT OIDS;

CREATE TABLE administrativo.perfil_action (
    fk_perfil bigint,
    fk_action varchar(50),
    FOREIGN KEY(fk_perfil) REFERENCES administrativo.perfil (id_perfil),
    FOREIGN KEY(fk_action) REFERENCES administrativo.action (id_action),
    PRIMARY KEY(fk_perfil, fk_action)
)WITHOUT OIDS;

CREATE TABLE public.email (
    id_email bigserial PRIMARY KEY,
    nome_email varchar(300) unique
)WITHOUT OIDS;

CREATE TABLE administrativo.organizacao_email (
    fk_organizacao bigint,
    fk_email bigint,
    flag_principal Boolean,
    tipo_email varchar(100),
    FOREIGN KEY(fk_organizacao) REFERENCES administrativo.organizacao (cnpj_organizacao),
    FOREIGN KEY(fk_email) REFERENCES public.email (id_email),
    PRIMARY KEY(fk_organizacao,fk_email)
)WITHOUT OIDS;

CREATE TABLE public.municipio (
    id_municipio bigserial PRIMARY KEY,
    nome_municipio varchar(300) unique,
    sigla_uf char(2),
    flag_capital Boolean
)WITHOUT OIDS;

CREATE TABLE pessoa.pessoa_telefone (
    fk_telefone bigint not null,
    fk_pessoa bigint not null,
    flag_principal Boolean,
    tipo_telefone varchar(100),
    PRIMARY KEY(fk_telefone,fk_pessoa)
)WITHOUT OIDS;

CREATE TABLE public.telefone (
    id_telefone bigserial PRIMARY KEY,
    codigo_pais bigint,
    numero_ddd bigint,
    numero_telefone bigint,
    tipo_telefone varchar(100),
    nome_operadora varchar(100)
)WITHOUT OIDS;

CREATE TABLE pessoa.fisica (
    numero_cpf bigint PRIMARY KEY,
    nome_pessoa_fisica varchar(300),
    descricao_sexo char(1),
    descricao_estado_civil varchar(30),
    numero_rg bigint,
    nome_orgao_expeditor varchar(300),
    data_expedicao timestamp with time zone,
    nome_mae varchar(300),
    nome_pai varchar(300),
    data_nascimento timestamp with time zone,
    numero_passaporte varchar(150),
    tipo_passaporte varchar(150),
    nome_orgao_expedidor_passaporte varchar(300),
    data_expedicao_passaporte timestamp with time zone,
    data_concessao_passaporte timestamp with time zone,
    data_expiracao_passaporte timestamp with time zone,
    numero_serie_passaporte bigint,
    nome_pais_passaporte varchar(300),
    nome_forma_tratamento varchar(300),
    FOREIGN KEY(numero_cpf) REFERENCES pessoa.pessoa (id_pessoa),
    CONSTRAINT check_sexo CHECK (descricao_sexo = 'M' OR descricao_sexo = 'F')
)WITHOUT OIDS;

CREATE TABLE pessoa.juridica (
    numero_cnpj bigint PRIMARY KEY,
    numero_cgc varchar(100),
    nome_pessoa_juridica varchar(300),
    nome_fantasia varchar(300),
    FOREIGN KEY(numero_cnpj) REFERENCES pessoa.pessoa (id_pessoa)
)WITHOUT OIDS;

ALTER TABLE public.endereco ADD FOREIGN KEY(fk_municipio) REFERENCES public.municipio (id_municipio);
ALTER TABLE pessoa.pessoa_email ADD FOREIGN KEY(fk_email) REFERENCES public.email (id_email);
ALTER TABLE administrativo.perfil_usuario ADD FOREIGN KEY(fk_perfil) REFERENCES administrativo.perfil (id_perfil);
ALTER TABLE administrativo.perfil_usuario ADD FOREIGN KEY(fk_usuario) REFERENCES administrativo.usuario (fk_pessoa);
ALTER TABLE administrativo.organizacao_telefone ADD FOREIGN KEY(fk_telefone) REFERENCES public.telefone (id_telefone);
ALTER TABLE administrativo.organizacao_telefone ADD FOREIGN KEY(fk_organizacao) REFERENCES administrativo.organizacao (cnpj_organizacao);
ALTER TABLE administrativo.organizacao_endereco ADD FOREIGN KEY(fk_organizacao) REFERENCES administrativo.organizacao (cnpj_organizacao);
ALTER TABLE administrativo.organizacao ADD FOREIGN KEY(fk_matriz) REFERENCES administrativo.organizacao (cnpj_organizacao);
ALTER TABLE administrativo.perfil_organizacao ADD FOREIGN KEY(fk_perfil) REFERENCES administrativo.perfil (id_perfil);
ALTER TABLE administrativo.perfil_controller ADD FOREIGN KEY(fk_perfil) REFERENCES administrativo.perfil (id_perfil);
ALTER TABLE pessoa.pessoa_telefone ADD FOREIGN KEY(fk_telefone) REFERENCES public.telefone (id_telefone);
ALTER TABLE pessoa.pessoa_telefone ADD FOREIGN KEY(fk_pessoa) REFERENCES public.telefone (id_telefone);

comment on table pessoa.pessoa is 'Tabela Pessoa é a especialização de pessoas no sistema.';
comment on column pessoa.pessoa.id_pessoa is 'Chave principal de identificação da pessoa no sistema, pode ser um cpf(fisica) cnpj(juridica)';
comment on table pessoa.fisica is 'Generalização de pessoa identificada pelo cpf.';
comment on table pessoa.juridica is 'Generalização de pessoa identificada pelo cnpj.';
comment ON TABLE administrativo.controller IS 'Controladores do sistema.';
COMMENT ON COLUMN administrativo.controller.codigo_controller IS 'String identificadora do controller';
COMMENT ON COLUMN administrativo.controller.descricao_controller IS 'Texto descritivo para o controller';
COMMENT ON COLUMN administrativo.controller.numero_ordem IS 'Ordenação para exibição do controller.';
comment ON TABLE administrativo.action IS 'Ações do sistema, cadastrar, editar, excluir etc.';
comment ON COLUMN administrativo.action.id_action IS 'Identificador da action, será utilizado para manipulações via javascript';
comment ON COLUMN administrativo.action.codigo_action IS 'Identifica para qual listagem essa action pertece.';
comment ON COLUMN administrativo.action.rel_controller IS 'Usado para definir o controller da action.';
comment ON COLUMN administrativo.action.rel_action IS 'Nome da action no controller.';
comment ON COLUMN administrativo.action.class_icone IS 'Classe que será utilizada para adicionar um icone caso a action seja um botão.';
comment ON COLUMN administrativo.action.nome_action IS 'Nome visual da action.';
comment ON COLUMN administrativo.action.tipo_action IS 'Define se a action será um botão, formulário ou função. B=Botão, F=Formulário, U=Função.';
comment ON COLUMN administrativo.action.tipo_menu IS 'Caso a action seja do tipo botão, define se será para a listagem ou formulário.';
comment ON COLUMN administrativo.action.class_botao IS 'Define a classe visual do botão no formulário.';
comment on table administrativo.usuario is 'Generalização de pessoa, contém informações de acesso ao sistema.';
comment on table administrativo.perfil is 'Definição do perfil dos usuários no sistema.';
comment on table administrativo.perfil_usuario is 'Tabela intermediária entre perfil e usuário, permitindo ao usuário exercer mais de um papel no sistema.';
comment on table administrativo.organizacao is 'Cadastro de organizações no sistema.';
comment on column administrativo.organizacao.fk_matriz is 'Caso seja uma filial, informa quem é a matriz.';
comment on column administrativo.organizacao.prioridade_exibicao is 'Define a prioridade de exibição para seleção no formulário de login do sistema.';
comment on table administrativo.organizacao_telefone is 'Possibilita o cadastro de n telefones por empresa.';
comment on column administrativo.organizacao_telefone.flag_principal is 'Define dentre os telefones cadastrados para a empresa, qual será o principal.';
comment on table administrativo.perfil_organizacao is 'Tabela intermediária que permite um perfil ter acesso a mais de uma organização do sistema.';
comment on table public.endereco is 'Cadastro global de endereços para as entidades que necessitem dessa opção no sistema.';
comment on table public.telefone is 'Cadastro global de telefones para as entidades que necessitem dessa opção no sistema.';
comment on column public.telefone.tipo_telefone is 'Informa o tipo de telefone, fixo, fax, celular, trabalho, residencial etc.';
comment on table public.email is 'Cadastro global de endereços de email para as entidades que necessitem dessa opção no sistema.';
comment on table public.municipio is 'Municípios disponíveis no sistema.';