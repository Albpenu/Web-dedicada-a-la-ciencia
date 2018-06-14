<?php

	if (isset($_POST['publicar'])) {
		$titulo = $_POST['titulo'];

		$descripcion = $_POST['descripcion'];

		$sql = mysqli_query($connect, "INSERT INTO posts (id_post, id_subcategoria, id_usuario, titulo, contenido, imagen, video, fecha_subida) VALUES '', '', '', '$titulo', '$descripcion', '', '', 'now()';");
		
		$resultado = $connect->query($sql) or die(mysqli_error($connect));	
	}
	
?>