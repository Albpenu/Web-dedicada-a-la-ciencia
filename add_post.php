<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<style type="text/css">
		body{
			background: url("./rsc/img/the_martian.jpg") !important; 
		    background-repeat: no-repeat !important;
		    background-position: center center !important;
		    background-position-y: 30px !important;
		    background-attachment: fixed !important;
		    background-size: 100% 100% !important;
		}

		/* 1100px o menos */
		@media screen and (max-width: 1100px){

			textarea {
				width: 470px;
			} 
		}
		/* 492px o menos */
		@media screen and (max-width: 492px){

			input#titulo {
				width: 300px;
			} 

			textarea {
				width: 310px;
			} 
		}

		form {
			color: white;
		}
	</style>

	<div height='100px' style="display: flex; align-items: center; z-index: 100; position: absolute;">
		<img onclick="volver()" src="rsc/img/volver.gif" width="100px" style="cursor: pointer;">
		<h3 style="color: blue;">Volver a la página anterior</h3>
	</div>
	<?php
		session_start();
		include('acceso.php');
	?>

	<span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
        </br>
        
        <div id="imgperfil" style="float: right; margin-top: -100px;">
            <?php
            if (isset($_SESSION['usuario'])) {

            echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';

            } else {
            }
            
            ?>
        </div>
        <span style="float: right; right: 0; padding: 0px; padding-top: 15px; clear: both;">
            <a href='cerrarsesion.php' title='Cerrar sesión' id="salir" style="right: 0px">Salir</a></span>
<div style="margin-top: 100px">
	<?php
		include('conexion.php');
		$consulta = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = '".$_SESSION['id_cat']."'");
		$ncat = mysqli_fetch_assoc($consulta);
		echo '<h1>Para la categoría "'.$ncat['nombre_categoria'].'"...</h1>';
	
		echo "<form style='border-bottom: 1px dotted black; border-top: 1px dotted black; padding-bottom: 15px; border-width: 10px; margin-top: 10px' name='form' action='' method='POST'  enctype='multipart/form-data'>
			<h2 style='text-decoration: underline;'>Escriba su post:</h2>
			<h3>¿A qué subcategoría va a pertenecer? <select name='nsubcat'>";
			$consulta = mysqli_query($connect, "SELECT nombre_subcategoria FROM subcategorias WHERE id_categoria='".$_SESSION['id_cat']."';");
			while ($nsubcat = mysqli_fetch_array($consulta)) {
				echo "<option>".$nsubcat[0]."</option>";
			}
			echo "</select></h3><br>
			<input id='titulo' required type='text' name='titulo' placeholder='Título' style='font-size: 30px;'><br>
			<textarea required name='descripcion' placeholder='Descripción' rows='10' cols='60' style='resize: none; font-size: 30px'></textarea><br>
			<h3>Adjunte una imagen en relación al post (si quiere):</h3><input type='file' name='imagenpost' id='imagenpost' /><br>
			<h3>Adjunte la página con un vídeo de youtube relacionado (si quiere):</h3><input type='text' name='video' /><br><br>
			<input type='submit' id='add' style='font-size: 30px' name='publicar' value='Publicar post'>
		</form><br>";
			
			if (isset($_POST['publicar'])) {
				$consulta = mysqli_query($connect, "SELECT id_subcategoria FROM subcategorias WHERE nombre_subcategoria LIKE '".$_POST['nsubcat']."'");
				$idsubcat = mysqli_fetch_array($consulta);
				$idu = mysqli_query($connect, "SELECT id_usuario FROM usuarios WHERE email LIKE '".$_SESSION['email']."';");
				$idusu = mysqli_fetch_array($idu);
				$titulo = $_POST['titulo'];
				$descripcion = $_POST['descripcion'];
				$imagenpost = addslashes(file_get_contents($_FILES["imagenpost"]["tmp_name"]));
				$video = $_POST['video'];

				if (isset($_SESSION['email'])) {

					$sql = mysqli_query($connect, "INSERT INTO posts (id_post, id_subcategoria, id_usuario, titulo, contenido, imagen, video, fecha_subida) VALUES ('', '".$idsubcat[0]."', '".$idusu[0]."', '$titulo', '".utf8_encode($descripcion)."', '$imagenpost', '$video', NOW());") or die(mysqli_error($connect));

					if ($sql) {
						echo "<script>alert('¡Publicación realizada!');</script>";
						echo '<img src="data:image/jpeg;base64,'.base64_encode($imagenpost).'" width="100"/><br>';  
					}

				}	else {
					echo "<script>confirm('Disculpe, caballero, pero me temo que debe primero iniciar sesión con su cuenta');</script>";
			    }
			}
	?>
</div>
	<script type="text/javascript">
		function volver(){
			window.history.back();
		}
		
		document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
		document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['usuario']." "; echo $_SESSION['imagenperfil']; ?>';
		$(document).ready(function(){
            $("#add").click(function(){
                var nombre_imagen = $("#imagenpost").val();
                if (nombre_imagen == "") {
                    alert("Parece que se te olvidó seleccionar una imagen de perfil");
                    return false;
                } else {
                    var extension = $('#imagenpost').val().split('.').pop().toLowerCase();

                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert('Vamos a ver, lo que has adjuntado no es una imagen, genious...');
                        $("#imagenperfil").val();
                        return false;
                    }
                }
            });
        });
	</script>
</body>
</html>
