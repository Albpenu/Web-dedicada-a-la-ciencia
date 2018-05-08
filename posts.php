<?php
	session_start();
	include('conexion.php');
	$cat = mysqli_query($connect, "SELECT id_categoria FROM categorias WHERE nombre_categoria = '".$_GET['categoria']."';");
	$cateleg = mysqli_fetch_assoc($cat);
	var_dump($cateleg['id_categoria']);
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
<body>	
	<h1 style="border-bottom: 1px solid black;"><?php echo 'Categoría: "'.$_GET['categoria'].'"<div style="display: inline-block; float: right;" id="add"></div>'; ?></h1>
	<h1 style="text-decoration: underline;">Subcategorías: </h1>

		<?php

			if ((mysqli_num_rows($resultado)>0)) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<a style='text-decoration: none;' href='view_subcat.php?subcat=".$valor["nombre_subcategoria"]."'><h2 style='display: inline-block; background-color: yellow;'>".$valor["nombre_subcategoria"]."</h2></a><br><label>***".$valor["descripcion"]."***</label><br><label>".$valor["fecha_ultima_actualizacion"]."</label>";

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
				<tbody>
		<?php
			if (mysqli_num_rows($resultado2)>0) {
			    while($valor2 = mysqli_fetch_assoc($resultado2)) {
			    	$consulta = mysqli_query($connect, "SELECT * FROM usuarios WHERE id_usuario = '".$valor2["id_usuario"]."';");
			    	$usu = mysqli_fetch_assoc($consulta);

			        echo "<tr><td align='center' id='".$valor2["id_subcategoria"]."'><a href='view_post.php?post=".$valor2["titulo"]."'>" .$valor2["titulo"]. "</a></td><td align='center'>".substr($valor2["contenido"], 0, 100)."...</td><td align='center'>".$usu["alias"]. "</td><td align='center'>".$valor2["fecha_subida"]. "</td></tr>";
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
		/*$(document).ready(function() {
			$("img.add").click(function () {
				var add = $(this).attr("id");
        		//alert(add);
				console.log(add);
				var formu = $(this).next();
				formu.toggle();
				//$("form").removeAttr("style").hide();
			});
		});*/

		document.getElementById('add').innerHTML = '<a href="add_post.php?add_post_to_cat=<?php echo $_GET['categoria']; ?>"><img class="add" id="<?php echo $valor["nombre_subcategoria"]; ?>" src="rsc/img/add.gif" alt="Añadir post a la categoría" style="cursor: pointer; border-radius: 100%; width: 100px; margin-top: -12px"></a>';
		/*document.getElementsByClassName('<?php $valor["nombre_subcategoria"]; ?>').addEventListener("click", function(){
			alert("Hola");
			document.getElementsByTagName("textarea").display = "block";
			document.getElementsByTagName("textarea").innerHTML = "Escriba aquí su post";
		});*/
	</script>
</body>
</html>