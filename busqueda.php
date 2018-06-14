<!DOCTYPE html>
<html>
<head>
	<title>Resultados de la búsqueda</title>
	<meta charset="utf-8">
</head>
<body>
	<style type="text/css">
		body{
			background: url("./rsc/img/the_martian.jpg"); 
		    background-repeat: no-repeat;
		    background-position: center center;
		    background-position-y: 30px;
		    background-attachment: fixed;
		    background-size: 100% 100%;
		}

		tbody tr:nth-child(odd){
		    background: white;
		}
		 
		tbody tr:nth-child(even){
		    background: #eac633;
		}

	</style>
	<div height='100px' style="display: flex; align-items: center;">
		<img onclick="volver()" src="rsc/img/volver.gif" width="100px" style="cursor: pointer;">
		<h3 style="color: blue;">Volver a la página anterior</h3>
	</div>
	
	<script type="text/javascript">
		function volver(){
			window.history.back();
		}
	</script>
	<?php
		include('conexion.php');
		session_start();
		
	if (isset($_GET['busqueda'])) {
		
		if ($_GET['busqueda'] == '') {
			echo "<h1>Me gustaría ayudarte, de verdad, pero es que no has escrito nada";
		} else {
		echo "<h1>Resultados de tu búsqueda de <label style='color: blue; text-decoration: underline;'>"."'".$_GET['busqueda']."'";
		echo "</label></h1>";
		$busqueda = mysqli_query($connect, "SELECT * FROM posts p JOIN subcategorias s ON s.id_subcategoria=p.id_subcategoria JOIN categorias c ON c.id_categoria=s.id_categoria WHERE titulo LIKE '%".$_GET['busqueda']."%' AND nombre_categoria LIKE '".$_SESSION['categoria']."';");		
?>
	<table border="1px solid black" cellspacing="0" align="center">
				<thead style="background-color: #4d8cf2;">
					<th>Título</th>
					<th>Descripción</th>
					<th>Autor</th>
					<th>Fecha de subida</th>
				</thead>
				<tbody style="background-color: white;">
		<?php
			if (mysqli_num_rows($busqueda)>0) {
			    while($valor = mysqli_fetch_assoc($busqueda)) {
			    	$consulta = mysqli_query($connect, "SELECT * FROM usuarios WHERE id_usuario = '".$valor["id_usuario"]."';");
			    	$usu = mysqli_fetch_assoc($consulta);

			        echo "<tr><td align='center' id='".$valor["id_subcategoria"]."'><a href='view_post.php?post=".$valor["id_post"]."'>" .$valor["titulo"]. "</a></td><td align='center'>".substr($valor["contenido"], 0, 100)."...</td><td align='center'>".$usu["alias"]. "</td><td align='center'>".$valor["fecha_subida"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='4' align='center'>No hay posts para esta subcategoría. ¡¿A qué esperas?! ¡Ilústranos!</td></tr><br><h2 align='center'>NO HAY CONTENIDO REFERENTE A SU BúSQUEDA</h2>";
			}

		?>
				</tbody>
			</table>
		<?php
			}
		}
		?>
				</tbody>
			</table>
</body>
</html>