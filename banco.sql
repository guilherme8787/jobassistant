create database if not exists jobassistant;

use jobassistant;

drop table if exists vagas;

create table vagas(
	id int(11) auto_increment,
	email varchar(200) not null,
	assunto varchar(200) not null,
	enviado bool not null,
	constraint id_is_primary primary key (ID)
);
