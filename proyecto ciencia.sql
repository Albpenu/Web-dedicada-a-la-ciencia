CREATE DATABASE ciencia;
USE ciencia;

CREATE TABLE usuarios (id_usuario INT not null auto_increment, alias VARCHAR(40), 
email varchar(50), contrasenia varchar(50) NOT NULL, imagendeperfil BLOB, fecha_alta datetime, sabiduria varchar(25), primary key 
(id_usuario));

DROP TABLE votos;

DROP TABLE imagen_de_perfil;

ALTER TABLE usuarios DROP imagendeperfil;

ALTER TABLE usuarios ADD imagendeperfil BLOB;

CREATE TABLE posts (id_post INT NOT NULL auto_increment, id_subcategoria INT, id_usuario INT, 
titulo varchar(50), contenido varchar(50), imagen blob, video blob, 
fecha_subida DATETIME, primary key (id_post), 
foreign key (id_usuario) references usuarios(id_usuario),
foreign key (id_subcategoria) references subcategorias(id_subcategoria));

DROP TABLE posts;

CREATE TABLE votos (id_voto INT not null auto_increment, valor boolean, id_usuario INT, 
foreign key (id_usuario) references usuarios(id_usuario), primary key (id_voto));

CREATE TABLE subcategorias (id_subcategoria INT not null auto_increment, id_categoria INT, titulo 
varchar(50), descripcion varchar(200), fecha_ultima_actualizacion DATETIME, 
foreign key (id_categoria) references categorias(id_categoria),  
primary key (id_subcategoria));

ALTER table categorias change titulo nombre_categoria varchar(50);
ALTER table subcategorias change fecha_ultima_actualizacion fecha_ultima_actualizacion DATETIME;

CREATE TABLE categorias (id_categoria INT not NULL auto_increment, titulo varchar(50), 
descripcion varchar(200), fecha_ultima_actualizacion datetime, 
primary key (id_categoria));

SELECT * FROM usuarios WHERE contrasenia = MD5('med32654');
SELECT contrasenia FROM usuarios WHERE contrasenia=MD5('1234');
SELECT * from usuarios;	

UPDATE usuarios set alias='100tífico' where id_usuario=3;
UPDATE usuarios set alias='100tífico2' where id_usuario=4;
UPDATE usuarios set alias='100tífico3' where id_usuario=5;

SELECT * from categorias;
SELECT * from subcategorias;
SELECT * FROM posts;
truncate posts;
TRUNCATE subcategorias;
SET FOREIGN_KEY_CHECKS=0;
TRUNCATE table subcategorias;
SET FOREIGN_KEY_CHECKS=1;
/*DROP table ;
ALTER TABLE usuarios change contraseña contrasenia varchar(20);
SELECT * from usuarios;
*/
CREATE TABLE  `imagen_de_perfil` (
`id_imagen` int(11) NOT NULL auto_increment, id_usuario INT,
`nombre` varchar(100) default NULL,
`tamanio` int(11) default NULL,
`tipo` varchar(20) default NULL,
`contenido` blob,
PRIMARY KEY  (`id_imagen`),
foreign key (id_usuario) references usuarios(id_usuario)
);
/* CAMBIAR ZONA HORARIA */

