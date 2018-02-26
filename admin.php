<?php
	include('conexion.php');
	//$connect->query("SET NAMES 'utf8'");
	echo "<div style='float: right; text-align: center'>Volvamos a casa:<br> <a href='index.php'><img class='option' src='rsc/img/house.png' /></a></div>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Panel de administración</title>
	<meta charset="utf-8">
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
		        echo utf8_encode("<tr><td align='center'>".$valor["id_usuario"]. "</td><td align='center'>" .utf8_encode($valor["alias"]). "</td><td align='center'>" .$valor["email"]. "</td><td align='center'>".$valor["contrasenia"]. "</td><td align='center'>" .$valor["fecha_alta"]. "</td><td align='center'>" .utf8_encode($valor["sabiduria"]). "</td><td align='center'>" .$valor["imagendeperfil"]. "</td></tr>");
		    }
		} else {
		    echo "<tr><td colspan='7' align='center'>0 resultados</td></tr>";
		}
	?>
			</tbody>
		</table>

<div>

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
			        echo "<tr><td align='center'>".$valor["id_categoria"]. "</td><td align='center'>" .utf8_encode($valor["nombre_categoria"]). "</td><td align='center'>".utf8_encode($valor["descripcion"]). "</td><td align='center'>".$valor["fecha_ultima_actualizacion"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='4' align='center'>0 resultados</td></tr>";
			}
		?>
				</tbody>
			</table>
	</div>

	<!--Subcategorías-->
	<div style="float: left; margin-right: 10px; margin-top: 35px;">
		<form name="form" action="admin_consultas.php" method="POST">
			<h1>Subcategorías:</h1>
		</form>
		<?php
			$sql = "SELECT * FROM subcategorias;";
			$resultado = $connect->query($sql) or die(mysqli_error($connect));
		?>
			<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
					<th>Id de Subcategoría</th>
					<th>Id de categoría</th>
					<th>Nombre de la subcategoría</th>
					<th>Descripción</th>
					<th>Fecha de la última actualización</th>
				</thead>
				<tbody>
		<?php
			if (mysqli_num_rows($resultado)>0) {
			    while($valor = mysqli_fetch_assoc($resultado)) {
			        echo "<tr><td align='center'>".$valor["id_subcategoria"]. "</td><td align='center'>".$valor["id_categoria"]. "</td><td align='center'>" . utf8_encode($valor["nombre_subcategoria"]). "</td><td align='center'>".utf8_encode($valor["descripcion"]). "</td><td align='center'>".$valor["fecha_ultima_actualizacion"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='5' align='center'>0 resultados</td></tr>";
			}
		?>
				</tbody>
			</table>
	</div>
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
    </script>
</body>
</html>