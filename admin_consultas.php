<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php

		include('conexion.php');
		error_reporting(E_ALL ^ E_NOTICE);

		$idusuario = $_POST['idusu'];
		$contra = md5($_POST['pass']);
		$add1 = $_POST['add1'];
		$remove1 = $_POST['remove1'];

		if (isset($add1)) {
			$consulta = mysqli_query($connect, "UPDATE usuarios SET contrasenia = '$contra' WHERE id_usuario = '$idusuario';");
	        header('location: admin.php');
		} else {}

		if (isset($remove1)) {
			$consulta = mysqli_query($connect, "DELETE FROM usuarios WHERE id_usuario = '$idusuario';");
	        header('location: admin.php');
		} else {

		}

		
	?>
</body>
</html>