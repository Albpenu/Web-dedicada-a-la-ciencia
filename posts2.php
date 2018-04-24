<?php
	session_start();
	include('conexion.php');
	$cat = mysqli_query($connect, "SELECT id_categoria FROM categorias WHERE nombre_categoria = '".$_GET['categoria']."';");
	$cateleg = mysqli_fetch_assoc($cat);
	var_dump($cateleg['id_categoria']);
	$sql = "SELECT * FROM subcategorias WHERE id_categoria = '".$cateleg['id_categoria']."';";
	$resultado = $connect->query($sql) or die(mysqli_error($connect));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Posts</title>
	<meta charset="utf-8" />
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
</head>
<body>	
	<h1 style="border-bottom: 1px solid black;"><?php echo 'Categoría: "'.$_GET['categoria'].'<div style="display: inline-block; float: right;" id="add"></div>'; ?></h1>
	<h1 style="text-decoration: underline;">Subcategorías: </h1>
		<?php

			if ((mysqli_num_rows($resultado)>0)) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<h2 style='display: inline-block; background-color: yellow;'>".$valor["nombre_subcategoria"]."</h2><br><label>***".$valor["descripcion"]."***</label><br><label>".$valor["fecha_ultima_actualizacion"]."</label>";

			$sql2 = "SELECT * FROM posts WHERE id_subcategoria='".$valor["id_subcategoria"]."';";
			$resultado2 = $connect->query($sql2) or die(mysqli_error($connect));

			?>
			<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
					<th>Id subcat</th>
					<th>Título</th>
					<th>Descripción</th>
					<th>Fecha de subida</th>
				</thead>
				<tbody>
		<?php
			if (mysqli_num_rows($resultado2)>0) {
			    while($valor2 = mysqli_fetch_assoc($resultado2)) {
			        echo "<tr><td align='center'>" .$valor2["id_subcategoria"]. "</td><td align='center'>" .$valor2["titulo"]. "</td><td align='center'>".$valor2["contenido"]. "</td><td align='center'>".$valor2["fecha_subida"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='4' align='center'>No hay posts para esta subcategoría. ¡¿A qué esperas?! ¡Ilústranos!</td></tr>";
			}
		?>
				</tbody>
			</table>
		<?php
			echo "<form style='display:none; border-bottom: 1px dotted black; border-top: 1px dotted black; padding-bottom: 15px; border-width: 10px; margin-top: 10px' name='form' action='' method='POST'>
		<h2>Escriba su post:</h2>
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
			    }
			} else {
			    echo "<h2 align='center'>NO HAY CONTENIDO EN ESTA CATEGORÍA</h2>";
			}
		?>
				</tbody>
			</table>
	<script type="text/javascript">
		$(document).ready(function() {
			$("img.add").click(function () {
				var add = $(this).attr("id");
        		//alert(add);
				console.log(add);
				var formu = $(this).next();
				formu.toggle();
				//$("form").removeAttr("style").hide();
			});
		});

		document.getElementById('add').innerHTML = '<img class="add" id="<?php echo $valor["nombre_subcategoria"]; ?>" src="rsc/img/add.gif" alt="Añadir post" style="cursor: pointer; border-radius: 100%; width: 100px; margin-top: -12px">';
		/*document.getElementsByClassName('<?php $valor["nombre_subcategoria"]; ?>').addEventListener("click", function(){
			alert("Hola");
			document.getElementsByTagName("textarea").display = "block";
			document.getElementsByTagName("textarea").innerHTML = "Escriba aquí su post";
		});*/
	</script>
</body>
</html>