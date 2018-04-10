<?php
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	include('conexion.php');
	session_start();
	$sql = mysqli_query($connect, "INSERT INTO posts (id_post, id_subcategoria, id_usuario, titulo, contenido, imagen, video, fecha_subida) VALUES '', '', '', '$titulo', '$descripcion', '', '', 'now()';");
	
	$resultado = $connect->query($sql) or die(mysqli_error($connect));
?>