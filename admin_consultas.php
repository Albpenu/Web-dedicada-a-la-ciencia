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
		$contrasenia = md5($_POST['pass']);
		$add1 = $_POST['add1'];
		$remove1 = $_POST['remove1'];

		if (isset($add1)) {
			$consulta = mysqli_query($connect, "UPDATE usuarios SET contrasenia = '$contrasenia' WHERE id_usuario = '$idusuario';");
	        header('location: admin.php');
		} else {}

		if (isset($remove1)) {
			$consulta = mysqli_query($connect, "DELETE FROM usuarios WHERE id_usuario = '$idusuario';");
	        header('location: admin.php');
		} else {

		}
/*
		$nombre_producto = $_POST['nombre_producto'];
		$precio = $_POST['precio'];
		$add2 = $_POST['add2'];
		$remove2 = $_POST['remove2'];
		$id_producto = $_POST['id_producto'];
		$id_subseccion = $_POST['id_subseccion'];
		$id_seccion = $_POST['id_seccion'];
		$connect->query("SET NAMES utf8");
		if (isset($add2)) {
			$consulta = mysqli_query($connect, "INSERT INTO producto (id_producto,nombre_producto,precio,id_subseccion,id_seccion) VALUES ('', '$nombre_producto', '$precio','$id_subseccion','$id_seccion')");
	        header('location: admin.php');
		} else {}

		if (isset($remove2)) {
			$consulta = mysqli_query($connect, "DELETE FROM producto WHERE id_producto='$id_producto'");
	        header('location: admin.php');
		} else {
			echo "<script>";
		}
*/
	?>
</body>
</html>