<?php
	include('conexion.php');
	$cat = mysqli_query($connect, "SELECT id_categoria FROM categoria WHERE nombre_categoria = '".$_GET['categoria']."';");
	echo $cat['id_categoria'];
	$sql = "SELECT * FROM subcategorias WHERE id_categoria = '".$cat['id_categoria']."';";
	$resultado = $connect->query($sql) or die(mysqli_error($connect));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Posts</title>
	<meta charset="utf-8" />
</head>
<body>	
	<h1><?php echo 'Categoría: "'.$_GET['categoria'].'"'; ?></h1>
	<hr>
	<img src="">
	<label><?php  ?></label>
	<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
					<th>Id de Categoría</th>
					<th>Id de Subcategoría</th>
					<th>Nombre de la Subcategoría</th>
					<th>Descripción</th>
					<th>Fecha de la última actualización</th>
				</thead>
				<tbody>
		<?php
			if ((mysqli_num_rows($resultado)>0)) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<tr><td align='center'>".$valor["id_categoria"]."</td><td align='center'>".$valor["id_subcategoria"]."</td><td align='center'>".$valor["nombre_subcategoria"]."</td><td align='center'>".$valor["descripcion"]."</td><td align='center'>".$valor["fecha_ultima_actualizacion"]."</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='6' align='center'>0 resultados</td></tr>";
			}
		?>
				</tbody>
			</table>
	<textarea></textarea>
</body>
</html>