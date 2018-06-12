<!DOCTYPE html>
<html>
<head>
	<title>Resultados de la búsqueda</title>
	<meta charset="utf-8">
</head>
<body>
	<div height='100px' style="display: flex; align-items: center;">
		<img onclick="volver()" src="rsc/img/volver.gif" width="100px" style="cursor: pointer;">
		<h3 style="color: blue;">Volver a la página anterior</h3>
	</div>
	<h1>Resultados de la búsqueda de <label style="color: blue; text-decoration: underline;"><?php echo "'".$_GET['busqueda']."'"; ?></label></h1>
	<script type="text/javascript">
		function volver(){
			window.history.back();
		}
	</script>
	<?php
		include('conexion.php');
		$cat = mysqli_query($connect, "SELECT id_categoria FROM categorias WHERE nombre_categoria = '".$_GET['categoria']."';");
		$cateleg = mysqli_fetch_assoc($cat);
		$_SESSION['id_cat'] = $cateleg['id_categoria'];
	if (isset($_GET['busqueda'])) {
		mysqli_query($connect, "SELECT * FROM posts WHERE titulo LIKE '%".$_GET['busqueda']."%'");
		$sql = "SELECT * FROM subcategorias WHERE id_categoria = '".$_SESSION['id_cat']."';";
		$resultado = $connect->query($sql) or die(mysqli_error($connect));
		$sql2 = "SELECT * FROM posts WHERE id_subcategoria='".$valor["id_subcategoria"]."';";
		$resultado2 = $connect->query($sql2) or die(mysqli_error($connect));

		if ((mysqli_num_rows($resultado)>0)) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<a style='text-decoration: none;' href='view_subcat.php?subcat=".$valor["nombre_subcategoria"]."'><h2 style='display: inline-block; background-color: yellow;'>".$valor["nombre_subcategoria"]."</h2></a><br><label>***".$valor["descripcion"]."***</label><br><label>".$valor["fecha_ultima_actualizacion"]."</label>";

			$sql2 = "SELECT * FROM posts WHERE id_subcategoria='".$valor["id_subcategoria"]."';";
			$resultado2 = $connect->query($sql2) or die(mysqli_error($connect));
	}		
?>
<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
					<th>Título</th>
					<th>Descripción</th>
					<th>Autor</th>
					<th>Fecha de subida</th>
				</thead>
				<tbody>
		<?php
			if (mysqli_num_rows($resultado2)>0) {
			    while($valor2 = mysqli_fetch_assoc($resultado2)) {
			    	$consulta = mysqli_query($connect, "SELECT * FROM usuarios WHERE id_usuario = '".$valor2["id_usuario"]."';");
			    	$usu = mysqli_fetch_assoc($consulta);

			        echo "<tr><td align='center' id='".$valor2["id_subcategoria"]."'><a href='view_post.php?post=".$valor2["id_post"]."'>" .$valor2["titulo"]. "</a></td><td align='center'>".substr($valor2["contenido"], 0, 100)."...</td><td align='center'>".$usu["alias"]. "</td><td align='center'>".$valor2["fecha_subida"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='4' align='center'>No hay posts para esta subcategoría. ¡¿A qué esperas?! ¡Ilústranos!</td></tr>";
			}
		?>
				</tbody>
			</table>
		<?php
			
		}
			} else {
			    echo "<h2 align='center'>NO HAY CONTENIDO REFERENTE A SU BúSQUEDA</h2>";
			}
		?>
				</tbody>
			</table>
</body>
</html>