create table bl_generos(
    numg_genero bigserial not null primary key,
    desc_nome varchar (500) not null,
    data_cadastro timestamp without time zone default(CURRENT_TIMESTAMP) not null    
);

create table bl_autores(
    numg_autor bigserial not null primary key,
    desc_nome varchar (500) not null,
    desc_observacoes text,
    data_cadastro timestamp without time zone default(CURRENT_TIMESTAMP) not null    
);

create table bl_editoras(
    numg_editora bigserial not null primary key,
    desc_nome varchar(500) not null,
    desc_endereco varchar(1024),
    desc_observacoes text,
    data_cadastro timestamp without time zone default(CURRENT_TIMESTAMP) not null    
);

create table bl_livros(
    numg_livro bigserial not null primary key,
    desc_titulo varchar(500) not null,
    desc_subtitulo varchar(500),
    desc_resumo varchar(1024),
    codg_livro varchar(30),
    data_ano varchar(4),
    numr_impressao integer,
    numg_editora integer not null,
    data_cadastro timestamp without time zone default(CURRENT_TIMESTAMP) not null,
    CONSTRAINT bl_livros_numg_editora_fkey FOREIGN KEY (numg_editora)
      REFERENCES bl_editoras (numg_editora) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create table bl_livrosgeneros(
    numg_livro integer not null,
    numg_genero integer not null,
    CONSTRAINT bl_livrosgeneros_numg_livro_fkey FOREIGN KEY (numg_livro)
      REFERENCES bl_livros (numg_livro) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT bl_livrosgeneros_numg_genero_fkey FOREIGN KEY (numg_genero)
      REFERENCES bl_generos (numg_genero) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create table bl_livrosautores(
    numg_livro integer not null,
    numg_autor integer not null,
    CONSTRAINT bl_livrosautores_numg_livro_fkey FOREIGN KEY (numg_livro)
      REFERENCES bl_livros (numg_livro) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT bl_livrosautores_numg_autor_fkey FOREIGN KEY (numg_autor)
      REFERENCES bl_autores (numg_autor) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
