<?php
	session_start();
	include('conexion.php');
	$cat = mysqli_query($connect, "SELECT id_categoria FROM categorias WHERE nombre_categoria = '".$_GET['categoria']."';");
	$_SESSION['categoria'] = $_GET['categoria'];
	$cateleg = mysqli_fetch_assoc($cat);
	$_SESSION['id_cat'] = $cateleg['id_categoria'];
	$sql = "SELECT * FROM subcategorias WHERE id_categoria = '".$_SESSION['id_cat']."';";
	$resultado = $connect->query($sql) or die(mysqli_error($connect));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Posts</title>
	<meta charset="utf-8" />
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
</head>
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
<body>

	<div height='100px' style="display: flex; align-items: center;">
		<img onclick="volver()" src="rsc/img/volver.gif" width="100px" style="cursor: pointer;">
		<h3 style="color: blue;">Volver a la página anterior</h3>
	</div>

	<form action="busqueda.php" method="get" height='100px' style="display: flex; align-items: center;">
        <input type="text" name="busqueda" placeholder="¿Te interesa un post en concreto?">
        <input name="enviar" type="image" src="rsc/img/search.gif" style="border-radius: 100%;" width="100px">
    </form>

	<h1 style="border-bottom: 1px solid black;"><?php echo 'Categoría: "'.$_GET['categoria'].'"<div style="display: inline-block; float: right;" id="add"></div>'; ?></h1>
	<h1 style="text-decoration: underline black; color: white;">Subcategorías: </h1>

		<?php
			if ((mysqli_num_rows($resultado)>0)) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<a style='text-decoration: none;' href='view_subcat.php?subcat=".$valor["nombre_subcategoria"]."'><h2 style='display: inline-block; background-color: yellow;'>".$valor["nombre_subcategoria"]."</h2></a><br><label style='color: white; font-size: 20px'>***".$valor["descripcion"]."***</label><br><label style='color: white; font-size: 20px'>".$valor["fecha_ultima_actualizacion"]."</label>";

			$sql2 = "SELECT * FROM posts WHERE id_subcategoria='".$valor["id_subcategoria"]."';";
			$resultado2 = $connect->query($sql2) or die(mysqli_error($connect));

			?>
			<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
					<th>Título</th>
					<th>Descripción</th>
					<th>Autor</th>
					<th>Fecha de subida</th>
				</thead>
				<tbody style="background-color: white;">
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
			    echo "<h2 align='center'>NO HAY CONTENIDO EN ESTA CATEGORÍA</h2>";
			}
		?>
				</tbody>
			</table>
	<script type="text/javascript">
		function volver(){
			window.history.back();
		}
		document.getElementById('add').innerHTML = '<a href="add_post.php?add_post_to_cat=<?php echo $_GET['categoria']; ?>"><img class="add" id="<?php echo $valor["nombre_subcategoria"]; ?>" src="rsc/img/add.gif" alt="Añadir post a la categoría <?php echo $_GET['categoria']; ?>" title="Añadir post a la categoría <?php echo $_GET['categoria']; ?>" style="cursor: pointer; border-radius: 100%; width: 100px; margin-top: -12px"></a>';
	</script>
</body>
</html>