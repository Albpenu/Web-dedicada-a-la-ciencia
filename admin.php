<!DOCTYPE html>
<html>
<head>
	<title>Panel de administración</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
	<style type="text/css">
		tbody tr:nth-child(odd){
		    background: #eac633;
		}
		 
		tbody tr:nth-child(even){
		    background: white;
		}
	</style>
</head>
<body>
	<?php
		include('conexion.php');
		//$connect->query("SET NAMES 'utf8'");
		echo "<div style='float: right; text-align: center'>Volvamos a casa:<br> <a href='index.php'><img class='option' src='rsc/img/house.png' /></a></div>";
		session_start();

	    if(!isset($_SESSION['acceso'])) {
	    	echo '<script>alert("¡Acceso restringido, genius!");</script>';
	        die('<h1>¿Todavía sigues aquí? Vete a casita, anda</h1>');
	    }
	?>
	<!--Usuarios-->
	<form name="form" action="admin_consultas.php" method="POST">
		<h1>Actualizar contraseña de usuario:</h1>
		<input type="number" name="idusu" placeholder="Id de usuario"><br>
		<input type="password" name="pass" id="pass" placeholder="Contraseña"> <input type="checkbox" name="comprobar" id="checkpass" onclick="showHidePass()"/><b>Mostrar contraseña</b><br>
		<input type="submit" name="add1" value="Añadir" onclick="add()">
	</form>
	
	<form name="form" action="admin_consultas.php" method="POST">
		<h1>Eliminar usuario:</h1>
		<input type="number" name="idusu" placeholder="Id de usuario">
		<input type="submit" name="remove1" value="Eliminar" onclick="remove()">
	</form>
	<?php
		$sql = "SELECT * FROM usuarios;";
		$resultado = $connect->query($sql) or die(mysqli_error($connect));

	?>
		<h1>Todos los usuarios:</h1>
		<table border="1px solid black" cellspacing="0">
			<thead style="background-color: #4d8cf2;">
				<th>Id de Usuario</th>
				<th>Alias</th>
				<th>Email</th>
				<th>Contrasenia</th>
				<th>Fecha de alta</th>
				<th>Sabiduría</th>
				<th>Imagen de perfil</th>
			</thead>
			<tbody>
	<?php

		if (mysqli_num_rows($resultado)>0) {
		    while($valor = mysqli_fetch_assoc($resultado)) {
		        echo "<tr><td align='center'>".$valor["id_usuario"]. "</td><td align='center'>" .$valor["alias"]. "</td><td align='center'>" .$valor["email"]. "</td><td align='center'>".$valor["contrasenia"]. "</td><td align='center'>" .$valor["fecha_alta"]. "</td><td align='center'>" .$valor["sabiduria"]. "</td><td align='center'><img width='75' src='data:image/jpeg;base64," .base64_encode($valor["imagendeperfil"]). "'/></td></tr>";
		    }
		} else {
		    echo "<tr><td colspan='7' align='center'>0 resultados</td></tr>";
		}
	?>
			</tbody>
		</table>

	<!--Categorías-->
	<div style="float: left; margin-right: 20px;">
		<form name="form" action="admin_consultas.php" method="POST">
			<h1>Categorías:</h1>
			<label>*Id de categoría = 0 = NO TIENE ID</label>
		</form>
		<?php
			$sql = "SELECT * FROM categorias;";
			$resultado = $connect->query($sql) or die(mysqli_error($connect));
		?>
			<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
					<th>Id de Categoría</th>
					<th>Nombre de la categoría</th>
					<th>Descripción</th>
					<th>Fecha de la última actualización</th>
				</thead>
				<tbody>
		<?php
			if (mysqli_num_rows($resultado)>0) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<tr><td align='center'>".$valor["id_categoria"]. "</td><td align='center'>" .$valor["nombre_categoria"]. "</td><td align='center'>".$valor["descripcion"]. "</td><td align='center'>".$valor["fecha_ultima_actualizacion"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='4' align='center'>0 resultados</td></tr>";
			}
		?>
				</tbody>
			</table>
	</div>

	<!--Subcategorías-->
	<div style="float: left; margin-right: 20px;">
		<form name="form" action="admin_consultas.php" method="POST">
			<h1>Subcategorías:</h1>
		</form>
		<?php
			$sql = "SELECT * FROM subcategorias;";
			$resultado = $connect->query($sql) or die(mysqli_error($connect));
		?>
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
	</div>

	<!--Insertar subcategorías-->
	<div style="float: left; clear: both;">
			<?php
				$nombre1 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 1;");
				$nombre2 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 2;");
				$nombre3 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 3;");
			?>
			<h1>Insertar subcategoría:</h1>
			<label>¿A qué categoría se la vas a añadir? Selecciónala:</label>
		<form action="admin_consultas.php" method="POST">
			<br><input type="radio" name="categoria" value="<?php $idcat1=mysqli_fetch_assoc($nombre1); echo utf8_encode($idcat1['nombre_categoria']); ?>" onclick="catSelecc(this)"> <?php echo utf8_encode($idcat1['nombre_categoria']); ?><br>
			<input type="radio" name="categoria" value="<?php $idcat2=mysqli_fetch_assoc($nombre2); echo utf8_encode($idcat2['nombre_categoria']); ?>" onclick="catSelecc(this)"> <?php echo utf8_encode($idcat2['nombre_categoria']); ?><br>
			<input type="radio" name="categoria" value="<?php $idcat3=mysqli_fetch_assoc($nombre3); echo utf8_encode($idcat3['nombre_categoria']); ?>" onclick="catSelecc(this)"> <?php echo utf8_encode($idcat3['nombre_categoria']); ?><br>
			<label id="subcat"></label>
		</form>
	</div>

	<script type="text/javascript">
        function showHidePass(){
            var pass = document.getElementById("pass");
            var checkpass = document.getElementById("checkpass");

            if (checkpass.checked){
                pass.setAttribute("type", "text");
            } else {
                pass.setAttribute("type", "password");
            }
        }

        function add(){
        	alert('Contraseña actualizada 😉👍');
        }

        function remove(){
        	alert('Eliminado 😉👍');
        }

        function catSelecc(categoria){
        	var catselecc = categoria.value;
        	document.getElementById('subcat').innerHTML = "<?php echo "<br><label>¿Qué nombre y descripción va a tener?</label><br><br><input name='nsubcat' type='text' placeholder='Nombre de la subcategoría' required /><input name='desubcat' type='text' placeholder='Descripción' required /><input type='submit' name='add2' value='Añadir'>"; ?>";
        }

    </script>
    <?php
    ?>
</body>

</html>
