<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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
</body>
</html>