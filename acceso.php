<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<?php
	//Acceso usuarios registrados

	    error_reporting(E_ALL ^ E_NOTICE);

	    $email = $_POST['email'];
	    $pass = md5($_POST['password']);
	    // Consultas
	    
	  
		include("conexion.php");
	    // Inicio de variable de sesión
	    session_start();

	    $imagen = mysqli_query($connect, "SELECT imagendeperfil FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';");

	    $imagen2 = mysqli_fetch_array($imagen);

	    $correo=mysqli_query($connect, "SELECT email FROM usuarios WHERE email='$email';");
	    $comprobar_correo= mysqli_fetch_array($correo);

	    $alias= mysqli_query($connect, "SELECT alias FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';");
	    $usuario= mysqli_fetch_array($alias);

	    $password=mysqli_query($connect, "SELECT contrasenia FROM usuarios WHERE contrasenia='$pass';");
	    $comprobar_pass= mysqli_fetch_array($password);
	    
		if (isset($_COOKIE['emailU'])) {
			$_SESSION['email'] = $_COOKIE['emailU'];
			header('location: index.php');
		}else {

			if ($_POST) {

				if (empty($_POST['email']) || empty($_POST['password'])) {
					
				} else {
					//Acceso de administrador:
					if ($_POST['email'] == "albpenu3110@gmail.com") {

						if ($_POST['password'] == "1234") {
							
							if ($_POST['remember'] == "rememberYES") {
								setcookie("emailU", $_POST['email'], time()+157680000);
								setcookie("passU", $_POST['password'], time()+157680000);
							}
							$_SESSION['email'] = $_POST['email'];
							echo "<script>alert('¡BIENVENIDO, ADMINISTRADOR!');</script>";
							echo "<script>window.location = 'admin.php';</script>";
						}else {
							echo "<script>alert('Contraseña INCORRECTA');</script>";
							echo "<script>window.location = 'index.php'</script>";
						}
					} elseif ($email == $comprobar_correo['email']) {
						//Acceso de usuarios:

					      if ($pass == $comprobar_pass['contrasenia']) {

						      if ($_POST['remember'] && !empty($_POST['remember'])) {
						        setcookie("emailU", $_POST['email'], time()+157680000);
						        setcookie("passU", $_POST['password'], time()+157680000);
						      }
						      	$_SESSION['email'] = $_POST['email'];
						      	$_SESSION['usuario'] = $usuario['alias'];
						      	$_SESSION['imagendeperfil'] = $imagen2['imagendeperfil'];
						      	include('conexion.php');
	   							echo '<script>alert("¡BIENVENID@, '.$_SESSION['usuario'].'!")</script>';
	   							
	   						    echo "Volvamos a casa:<br> <a href='categorias.php'><img class='option' src='rsc/img/house.png' /></a>";
						      
						      ?>
						      <script type="text/javascript">
						      	document.getElementById('salir').innerHTML = 'Salir';
						      </script>
							<?php
								
					      } else {
								echo "<script>alert('Contraseña INCORRECTA');</script>";
								echo "<script>window.location = 'index.php'</script>";
							}
					} else{
						echo "<script>alert('Correo INCORRECTO');</script>";
						echo '<script>alert("Lo sentimos, pero ha insertado mal su correo o todavía no es miembro de nuestra erudita comunidad. ¡A qué espera, el saber no ocupa lugar! Además, el registro es gratis ;)")</script>';
						echo "<script>window.location = 'index.php';</script>";
					}
				}
			}else{

				
			}
	    }
	?>
</body>
</html>