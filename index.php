<?php
  session_start();
  session_id();
  session_name();
  include('acceso.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Culto a la ciencia</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
	<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script>-->
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
</head>
<body onload="horario()">

  <b style="top: 0; left: 0">Correo de contacto: <u><a href="#">cultoalaciencia@gmail.com</a></u></b>
  <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
  </br>
  <span style="float: right; padding-top: 10px"><a href='cerrarsesion.php' title='Cerrar sesión' id="salir">Salir</a></span>
  <?php

    $fecha = date('d/m/Y');
    echo "<p style='color: white;'>".$fecha.", <label id='hora'></label></p>";

  ?>
    <div id="imglogo" align="center">
    	<img id="logo" src="rsc/img/acceso.gif" />
    </div>
    
  <?php
    include('conexion.php');
  ?>

    <!-- Formulario de acceso-->
	<form id="formu" name="form" action="acceso.php" method="post" style="background: url('rsc/img/NPL-Page-Cinemagraph-1.gif') repeat scroll center center / 100% 100%; border-radius: 15px; text-align: center; z-index: 1000; display: block;" align="center">
      <a href="javascript:cerrarAcc()" style="float: right; font-family: 'mejor'; color: black; text-decoration: none; background-color: white; border-radius: 50%; width: 15px">X</a>
      <h1 style="margin-top: 5px; font-family: 'mejor'; font-size: 60px">Acceso:</h1>
	    <input style="width: 80%; font-size: 30px" placeholder="Correo" required name="email" type="email" value="" style="" /><br><br>
	    <input style="width: 80%; font-size: 30px" placeholder="Contraseña" required name="password" type="password" value=""/><br>
        <input name="remember" type="checkbox" value="rememberYES"><label style="color: gold; font-size: 40px">Recuérdame</label><br>
        <input type="submit" style="font-size: 40px" name="enviar" value="Entrar"/><br>
        <a style="font-size: 30px" href="registro.php">¿No estás registrado?</a><br>
        <a style="font-size: 30px" href="olvidado.php">¿Has olvidado tu contraseña?</a>
	</form>

  <nav></nav>

	<aside></aside>

	<aside></aside>

	<script type="text/javascript">
    $("#formu").hide();

    $("#imglogo").click(function(){
        $("#formu").toggle();
    });

    function formato(i) {
        if (i < 10) {i = "0" + i};
        return i;
    }

    document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
    document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['usuario']." "; echo $_SESSION['imagenperfil']; ?>';

    function cerrarAcc(){
      document.getElementById("formu").style.display = "none";
       return;
    }

    function horario() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = formato(m);
      s = formato(s);
      document.getElementById('hora').innerHTML = h + ":" + m + ":" + s;
      var t = setTimeout(horario, 500);
    }
        
  function showHidePass() {
      var password = document.getElementById("pass");
      var checkbox = document.getElementById("checkpass");
          
      if (checkbox.checked == true) {
          password.type = "text";
      } else {
          password.type = "password";
      }
  }

  
	</script>

</body>
</html>
