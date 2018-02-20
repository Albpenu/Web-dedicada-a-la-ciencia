CREATE DATABASE ciencia;
USE ciencia;

CREATE TABLE usuarios (id_usuario INT not null auto_increment, alias VARCHAR(40), contraseña varchar(20), 
email varchar(50), fecha_alta datetime, sabiduria varchar(25), primary key 
(id_usuario));

CREATE TABLE posts (id_post INT NOT NULL, id_subcategoria INT, id_usuario INT, 
titulo varchar(50), contenido varchar(50), imagen blob, video blob, 
fecha_subida DATE, primary key (id_post), 
foreign key (id_usuario) references usuarios(id_usuario),
foreign key (id_subcategoria) references subcategorias(id_subcategoria));

CREATE TABLE votos (id_voto INT not null, valor boolean, id_usuario INT, 
foreign key (id_usuario) references usuarios(id_usuario), primary key (id_voto));

CREATE TABLE subcategorias (id_subcategoria INT not null, id_categoria INT, titulo 
varchar(50), descripcion varchar(200), fecha_ultima_actualizacion DATE, 
foreign key (id_categoria) references categorias(id_categoria),  
primary key (id_subcategoria));

CREATE TABLE categorias (id_categoria INT not NULL, titulo varchar(50), 
descripcion varchar(200), fecha_ultima_actualizacion datetime, 
primary key (id_categoria));

SELECT * from usuarios WHERE contrasenia=MD5("med32654") and email='asdf@gmail.com';
SELECT contrasenia FROM usuarios WHERE contrasenia=MD5('1234');
SET FOREIGN_KEY_CHECKS=0;
TRUNCATE table usuarios;
SET FOREIGN_KEY_CHECKS=1;
/*DROP table ;
ALTER TABLE usuarios change contraseña contrasenia varchar(20);
SELECT * from usuarios;
*/

