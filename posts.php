<?php
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
	<h1 style="border-bottom: 1px solid black;"><?php echo 'Categoría: "'.$_GET['categoria'].'"'; ?></h1>
	<img src="">
	<label><?php  ?></label>
	<h1 style="text-decoration: underline;">Subcategorías: </h1>
		<?php
			if ((mysqli_num_rows($resultado)>0)) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<h2 style='display: inline-block; background-color: yellow;'>".$valor["nombre_subcategoria"]."</h2><br><label>***".$valor["descripcion"]."***</label><br><label>".$valor["fecha_ultima_actualizacion"]."</label><br><img class='add' id='".$valor["nombre_subcategoria"]."' src='rsc/img/add.gif' alt='Añadir post' style='cursor: pointer; border-radius: 100%; width: 100px;'><form style='display:none; border-bottom: 1px dotted black; border-top: 1px dotted black; padding-bottom: 15px; border-width: 10px;' name='form' action='posts_publicados.php' method='POST'>
		<h2>Escriba su post:</h2>
		<input type='text' name='titulo' placeholder='Título' style='font-size: 30px'><br>
		<textarea name='descripcion' placeholder='Descripción' rows='10' cols='60' style='resize: none; font-size: 30px'></textarea><br>
		<input type='submit' style='font-size: 30px' name='publicar' value='Publicar post'>
	</form><br>";
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
		/*document.getElementsByClassName('<?php $valor["nombre_subcategoria"]; ?>').addEventListener("click", function(){
			alert("Hola");
			document.getElementsByTagName("textarea").display = "block";
			document.getElementsByTagName("textarea").innerHTML = "Escriba aquí su post";
		});*/
	</script>
</body>
</html>