CREATE TABLE usuario(
  login character varying(50) NOT NULL,
  senha character(40),
  data_ultimo_acesso timestamp with time zone
);

insert into usuario values('admin','d033e22ae348aeb5660fc2140aec35850c4da997',now());
