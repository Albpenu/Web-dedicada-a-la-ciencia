<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	
		session_start();
		include('conexion.php');
		$consulta = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = '".$_SESSION['id_cat']."'");
		$ncat = mysqli_fetch_assoc($consulta);
		echo '<h1>Para la categoría "'.$ncat['nombre_categoria'].'"</h1>';
	
		echo "<form style='border-bottom: 1px dotted black; border-top: 1px dotted black; padding-bottom: 15px; border-width: 10px; margin-top: 10px' name='form' action='' method='POST'>
			<h2>Escriba su post:</h2>
			<label>¿A qué subcategoría va a pertenecer? </label><select>";
			$consulta = mysqli_query($connect, "SELECT nombre_subcategoria FROM subcategorias WHERE id_categoria='".$_SESSION['id_cat']."';");
			while ($nsubcat = mysqli_fetch_array($consulta)) {
				echo "<option>".$nsubcat[0]."</option>";
			}
			echo "</select><br>
			<input required type='text' name='titulo' placeholder='Título' style='font-size: 30px'><br>
			<textarea required name='descripcion' placeholder='Descripción' rows='10' cols='60' style='resize: none; font-size: 30px'></textarea><br>
			<input type='submit' style='font-size: 30px' name='publicar' value='Publicar post'>
		</form><br>";
			
			if (isset($_POST['publicar'])) {
				$idsubcat = $valor["id_subcategoria"];
				$idu = mysqli_query($connect, "SELECT id_usuario FROM usuarios WHERE email LIKE '".$_SESSION['email']."';");
				$idusu = mysqli_fetch_array($idu);
				$titulo = $_POST['titulo'];
				$descripcion = $_POST['descripcion'];

				if (isset($_SESSION['email'])) {
					$sql = mysqli_query($connect, "INSERT INTO posts (id_post, id_subcategoria, id_usuario, titulo, contenido, fecha_subida) VALUES ('', '$idsubcat', '".$idusu[0]."', '$titulo', '$descripcion', 'now()');") or die(mysqli_error($connect));
				}	else {
					echo "<script>confirm('Disculpe, caballero, pero me temo que debe primero iniciar sesión con su cuenta');</script>";
			    }
			}
	?>
</body>
</html>
