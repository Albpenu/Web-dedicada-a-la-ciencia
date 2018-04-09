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
	<h1><?php echo 'Categoría: "'.$_GET['categoria'].'"'; ?></h1>
	<hr>
	<img src="">
	<label><?php  ?></label>
		<?php
			if ((mysqli_num_rows($resultado)>0)) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<h2>".$valor["nombre_subcategoria"]."</h2><br><label>".$valor["descripcion"]."</label><br><label>".$valor["fecha_ultima_actualizacion"]."</label><br><img class='add' id='".$valor["nombre_subcategoria"]."' src='rsc/img/add.gif' alt='Añadir post' style='cursor: pointer; border-radius: 100%; width: 100px'><textarea style='display:none;'></textarea>";
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