CREATE DATABASE IF NOT EXISTS db_wba;
USE db_wba;

CREATE TABLE IF NOT EXISTS usuarios(
id 						int(255) auto_increment not null,
bol_mat					varchar(10) not null,
nombre					varchar(30),
ape_pat					varchar(30),
ape_mat					varchar(30),
pass					varchar(255),
email					varchar(255),
cel						varchar(10),
descripcion				text,
estudios				text,
acadmy					varchar(255),
disponible				tinyint,
lugar_at				varchar(255),
proyectos_history		text,
dt_visibles				tinyint,
foto					varchar(255),
fecha_creado			datetime,
rol						varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id) 
)ENGINE=InnoDb;			

CREATE TABLE IF NOT EXISTS proyectos(
id 						int(255) auto_increment not null,
usuario_id				int,
titulo					varchar(255),
descripcion				text,
CONSTRAINT pk_proyectos PRIMARY KEY(id),
CONSTRAINT fk_pyct_user FOREIGN KEY(usuario_id) REFERENCES usuarios(id) 
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS boletas(
id    					int(255) auto_increment not null,
boleta 					varchar(10),
CONSTRAINT pk_boletas PRIMARY KEY(id),
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS matriculas(
id  					int(255) auto_increment not null,
matriculas 				varchar(10),
CONSTRAINT pk_matriculas PRIMARY KEY(id),
)ENGINE=InnoDb;

INSERT INTO usuarios VALUES(NULL, '2013120518', 'Alex', 'Zamorano', 'Guzman', 'password','alex@mail.com','1234567890', NULL, NULL, , NULL, NULL, NULL, NULL, NULL, CURTIME(), 'ROLE_USERA');
INSERT INTO usuarios VALUES(NULL, '2014130619', 'Patricio', 'Salvador', 'Mesa', 'password','alex@mail.com','1234567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURTIME(), 'ROLE_USERA');
INSERT INTO usuarios VALUES(NULL, '6666123456', 'Gisela', 'Gomez', 'Quiroga', 'password','alex@mail.com','1234567890','Docente numero 1','Estudio1','Comunicaciones y electronica', 1,'Edificio A','x', '1', '', CURTIME(), 'ROLE_USERD');
INSERT INTO usuarios VALUES(NULL, '6666654321', 'Carolina', 'Cordero', 'Barrera', 'password','alex@mail.com','1234567890','Docente numero 2','Estudio1','Informatica', 0,'Edificio B','x', '1', '', CURTIME(), 'ROLE_USERD');

INSERT INTO proyectos VALUES(NULL, 1, 'Titulo de proyecto 1', 'Descripcion 1');
INSERT INTO proyectos VALUES(NULL, 2, 'Titulo de proyecto 2', 'Descripcion 2');

INSERT INTO boletas VALUES(NULL, '2013120518');
INSERT INTO boletas VALUES(NULL, '2014130619');
INSERT INTO boletas VALUES(NULL, '2015120518');
INSERT INTO boletas VALUES(NULL, '2016120518');
INSERT INTO boletas VALUES(NULL, '2017120518');
INSERT INTO boletas VALUES(NULL, '2018120518');
INSERT INTO boletas VALUES(NULL, '2019120518');
INSERT INTO boletas VALUES(NULL, '2020120518');


INSERT INTO matriculas VALUES(NULL, '6666123456');
INSERT INTO matriculas VALUES(NULL, '6666654321');
INSERT INTO matriculas VALUES(NULL, '6666789564');
INSERT INTO matriculas VALUES(NULL, '6666781543');
INSERT INTO matriculas VALUES(NULL, '6666789003');
INSERT INTO matriculas VALUES(NULL, '6666789033');
INSERT INTO matriculas VALUES(NULL, '6666787843');
INSERT INTO matriculas VALUES(NULL, '6666784613');

INSERT INTO matriculas VALUES(NULL, '6666666666');


