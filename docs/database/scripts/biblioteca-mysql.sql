create table bl_generos(
    numg_genero INTEGER NOT NULL auto_increment primary key,
    desc_nome VARCHAR(500) not null,
    data_cadastro TIMESTAMP default CURRENT_TIMESTAMP
)ENGINE = innodb;

create table bl_autores(
    numg_autor INTEGER NOT NULL auto_increment primary key,
    desc_nome VARCHAR(500) not null,
    desc_observacoes text,
    data_cadastro TIMESTAMP default CURRENT_TIMESTAMP
)ENGINE = innodb;

create table bl_editoras(
    numg_editora INTEGER NOT NULL auto_increment primary key,
    desc_nome VARCHAR(500) not null,
    desc_endereco VARCHAR(1024),
    desc_observacoes text,
    data_cadastro TIMESTAMP default CURRENT_TIMESTAMP
)ENGINE = innodb;

create table bl_livros(
    numg_livro INTEGER NOT NULL auto_increment primary key,
    desc_titulo VARCHAR(500) not null,
    desc_subtitulo VARCHAR(500),
    desc_resumo VARCHAR(1024),
    codg_livro VARCHAR(30),
    data_ano VARCHAR(4),
    numr_impressao INTEGER,
    numg_editora INTEGER not null,
    data_cadastro TIMESTAMP default CURRENT_TIMESTAMP
)ENGINE = innodb;

create table bl_livrosgeneros(
    numg_livro INTEGER not null,
    numg_genero INTEGER not null
)ENGINE = innodb;

create table bl_livrosautores(
    numg_livro INTEGER not null,
    numg_autor INTEGER not null
)ENGINE = innodb;

ALTER TABLE bl_livros ADD CONSTRAINT `bl_livros_numg_editora_fkey`
    FOREIGN KEY (`numg_editora`) REFERENCES `bl_editoras`(`numg_editora`);
ALTER TABLE bl_livrosautores ADD CONSTRAINT `bl_livrosautores_numg_livro_fkey`
    FOREIGN KEY (`numg_livro`) REFERENCES `bl_livros`(`numg_livro`);
ALTER TABLE bl_livrosgeneros ADD CONSTRAINT `bl_livrosgeneros_numg_livro_fkey`
    FOREIGN KEY (`numg_livro`) REFERENCES `bl_livros`(`numg_livro`);
ALTER TABLE bl_livrosgeneros ADD CONSTRAINT `bl_livrosgeneros_numg_genero_fkey`
    FOREIGN KEY (`numg_genero`) REFERENCES `bl_generos`(`numg_genero`);
ALTER TABLE bl_livrosautores ADD CONSTRAINT `bl_livrosautores_numg_autor_fkey`
    FOREIGN KEY (`numg_autor`) REFERENCES `bl_autores`(`numg_autor`);
