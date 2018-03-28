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
		session_start();
		$idusuario = $_POST['idusu'];
		$contra = md5($_POST['pass']);
		$add1 = $_POST['add1'];
		$add2 = $_POST['add2'];
		$remove1 = $_POST['remove1'];

		if (isset($add1)) {
			$consulta = mysqli_query($connect, "UPDATE usuarios SET contrasenia = '$contra' WHERE id_usuario = '$idusuario';") or die(mysqli_error($connect));
	        header('location: admin.php');
		} else {}

		if (isset($remove1)) {
			$consulta = mysqli_query($connect, "DELETE FROM usuarios WHERE id_usuario = '$idusuario';") or die(mysqli_error($connect));
	        header('location: admin.php');
		} else {

		}

		if (isset($add2)) {
				echo "<script>alert('Subcategoría insertada 😉👍');</script>";
				echo $_POST['categoria'];	
		} else {}
	?>
</body>
</html>