<?php
//Acceso usuarios registrados
    error_reporting(E_ALL ^ E_NOTICE);
    // Prevenir inyecciones a la base de datos
    $email = md5($_POST['email']);
    $pass = md5($_POST['password']);

    include("conexion.php");
    // Inicio de variables de sesión
    session_cache_limiter('public');
    session_start();
    // Consultas
    $correo=mysqli_query($connect, "SELECT email FROM usuario WHERE email='$email';");
    $comprobar_correo= mysqli_fetch_array($email);
    /*$alias= mysqli_query($connect, "SELECT alias FROM usuario c JOIN usuario u ON c.id_usuario=u.id WHERE u.correo='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));*/
    $alias= mysqli_query($connect, "SELECT alias FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$contrasenia';") or die(mysqli_error($connect));
    $usuario= mysqli_fetch_array($alias);

    $password=mysqli_query($connect, "SELECT contrasenia FROM usuarios WHERE contrasenia='$pass';");
    $comprobar_pass= mysqli_fetch_array($password);
    
//Acceso de administrador:
	
	if (isset($_COOKIE['emailU'])) {
		$_SESSION['email'] = $_COOKIE['emailU'];
		header('location: index.php');
	}else{
		if ($_POST) {
			if (empty($_POST['email']) || empty($_POST['password'])) {
				
			}else{
				if ($_POST['email'] == "albpenu3110@gmail.com") {
					if ($_POST['password'] == "1234") {
						
						if ($_POST['remember'] == "rememberYES") {
							setcookie("emailU", $_POST['email'], time()+157680000);
							setcookie("passU", $_POST['password'], time()+157680000);
						}
						$_SESSION['email'] = $_POST['email'];
						echo "<script>alert('¡BIENVENIDO, ADMINISTRADOR!');</script>";
						echo "<script>window.location = 'admin.php';</script>";
					}else{
						echo "<script>alert('Contraseña INCORRECTA');</script>";
						echo "<script>window.location = 'index.php'</script>";
					}
				} elseif ($email == $comprobar_correo[0]) {

				      if ($pass == $comprobar_pass[0]) {

					      if ($_POST['remember'] == "rememberYES") {
					        setcookie("emailU", $_POST['email'], time()+157680000);
					        setcookie("passU", $_POST['password'], time()+157680000);
					      }

					      	$_SESSION['usuario'] = $usuario['alias'];
   							echo '<script>alert("¡BIENVENIDO, '.$_SESSION['usuario'].'!")</script>';
   						    echo '<a href="index.php?<?php echo htmlspecialchars(SID); ?>">Volver a la página principal</a>';
					      
					      ?>
					      <script type="text/javascript">
					      	document.getElementById("usuario").innerHTML = '<?php echo $_SESSION['imagenperfil']." ".$_SESSION['usuario']; ?>';
					      	
					      	document.getElementById('salir').innerHTML = 'Salir';
					      </script>
						<?php
							
				      } else {
							echo "<script>alert('Contraseña INCORRECTA');</script>";
							echo "<script>window.location = 'index.php'</script>";
						}
				} else{
					echo "<script>alert('Correo INCORRECTO');</script>";
					echo '<script>alert("Lo sentimos, pero para hacerse usuario y comprar necesitamos que registre algunos datos. ¡A qué espera, es gratis! Si ya lo está, vuelva a intentar acceder ;)")</script>';
					echo "<script>window.location = 'index.php';</script>";
				}
			}
		}else{

			
		}
    }
?>