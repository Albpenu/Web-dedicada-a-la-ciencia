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
		var_dump($_POST);

		$idusuario = $_POST['idusu'];
		$contra = md5($_POST['pass']);
		$add1 = $_POST['add1'];
		$remove1 = $_POST['remove1'];

		$nsubcat = $_POST['nsubcat'];
		$desubcat = $_POST['desubcat'];
		$add2 = $_POST['add2'];
		

		if (isset($add1)) {
			$consulta = mysqli_query($connect, "UPDATE usuarios SET contrasenia = '$contra' WHERE id_usuario = '$idusuario';") or die(mysqli_error($connect));
	        //header('location: admin.php');
		} else {}

		if (isset($remove1)) {
			$consulta = mysqli_query($connect, "DELETE * FROM usuarios WHERE id_usuario = '$idusuario';") or die(mysqli_error($connect));
	        //header('location: admin.php');
		} else {

		}

		if (isset($add2)) {
				
				$consulta1 = mysqli_query($connect, "SELECT id_categoria FROM categorias WHERE nombre_categoria = '".$_POST['categoria']."';") or die(mysqli_error($connect));
				$idcat = mysqli_fetch_array($consulta1);

				$consulta2 = mysqli_query($connect, "INSERT INTO subcategorias VALUES ('', '".$idcat[0]."', '$nsubcat', '$desubcat', NOW());") or die(mysqli_error($connect));
				
				/*echo '<script type="text/javascript">
				alert(`Subcategoría "'.$nsubcat.'" insertada en categoría "'.$_POST['categoria'].'" 😉👍`);
				window.location.href = "admin.php";
				</script>';*/

		} else {}

		if (isset($remove2)) {
			$consulta = mysqli_query($connect, "DELETE * FROM subcategorias WHERE id_categoria = '".$idcat[0]."' AND id_subcategoria = '".$idcat[0]."';") or die(mysqli_error($connect));
	        //header('location: admin.php');
		} else {

		}
	?>
</body>
</html>