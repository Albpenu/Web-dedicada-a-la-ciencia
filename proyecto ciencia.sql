CREATE DATABASE ciencia;
USE ciencia;

CREATE TABLE usuarios (id_usuario INT, alias VARCHAR(40), contraseña varchar(20), 
email varchar(50), fecha_alta DATE, sabiduria varchar(25), primary key 
(id_usuario));

CREATE TABLE posts (id_post INT, id_subcategoria INT, id_usuario INT, 
titulo varchar(50), contenido varchar(50), imagen blob, video blob, 
fecha_subida DATE, primary key (id_post), 
foreign key (id_usuario) references usuarios(id_usuario),
foreign key (id_subcategoria) references subcategorias(id_subcategoria));

CREATE TABLE votos (id_voto INT, valor boolean, id_usuario INT, 
foreign key (id_usuario) references usuarios(id_usuario), primary key (id_voto));

CREATE TABLE subcategorias (id_subcategoria INT, id_categoria INT, titulo 
varchar(50), descripcion varchar(200), fecha_ultima_actualizacion DATE, 
foreign key (id_categoria) references categorias(id_categoria),  
primary key (id_subcategoria));

CREATE TABLE categorias (id_categoria INT, titulo varchar(50), 
descripcion varchar(200), fecha_ultima_actualizacion DATE, 
primary key (id_categoria));
