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

		$idpost = $_POST['idpost'];
		$idusuario = $_POST['idusu'];
		$idsubcat = $_POST['idsubcat'];
		$contra = md5($_POST['pass']);
		$remove0 = $_POST['remove0'];
		$add1 = $_POST['add1'];
		$remove1 = $_POST['remove1'];
		$remove2 = $_POST['remove2'];
		$nsubcat = $_POST['nsubcat'];
		$desubcat = $_POST['desubcat'];
		$add2 = $_POST['add2'];
		
		if (isset($remove0)) {
			$consulta = mysqli_query($connect, "DELETE FROM posts WHERE id_post = '$idpost';") or die(mysqli_error($connect));
	        ?>
	        <script type="text/javascript">
	        	alert('Post eliminado!');
	        	window.location.href = "admin.php";
	        </script>
	        <?php
		} else {

		}

		if (isset($add1)) {
			$consulta = mysqli_query($connect, "UPDATE usuarios SET contrasenia = '$contra' WHERE id_usuario = '$idusuario';") or die(mysqli_error($connect));
	        ?>
	        <script type="text/javascript">
	        	alert('Contraseña de usuario modificada!');
	        	window.location.href = "admin.php";
	        </script>
	        <?php
		} else {}

		if (isset($remove1)) {
			mysqli_query($connect, "SET FOREIGN_KEY_CHECKS=0;");
			$consulta = mysqli_query($connect, "DELETE FROM usuarios WHERE id_usuario = '$idusuario';") or die(mysqli_error($connect));
			?>
	        <script type="text/javascript">
	        	alert('Usuario eliminado');
	        	window.location.href = "admin.php";
	        </script>
	        <?php
		} else {

		}

		if (isset($add2)) {
				mysqli_query($connect, "SET FOREIGN_KEY_CHECKS=0;");
				$consulta1 = mysqli_query($connect, "SELECT id_categoria FROM categorias WHERE nombre_categoria = '".$_POST['cat_add']."';") or die(mysqli_error($connect));
				$idcat = mysqli_fetch_array($consulta1);
			
				$consulta2 = mysqli_query($connect, "INSERT INTO subcategorias VALUES ('', '".$idcat[0]."', '$nsubcat', '$desubcat', NOW());") or die(mysqli_error($connect));
				
				?>
	        <script type="text/javascript">
	        	alert('Nueva subcategoría insertada!');
	        	window.location.href = "admin.php";
	        </script>
	        <?php

		} else {}

		if (isset($remove2)) {
			$consulta = mysqli_query($connect, "DELETE FROM subcategorias WHERE id_subcategoria = '$idsubcat';") or die(mysqli_error($connect));
	        ?>
	        <script type="text/javascript">
	        	alert('Subcategoría eliminada!');
	        	window.location.href = "admin.php";
	        </script>
	        <?php
		} else {

		}
	?>
</body>
</html>