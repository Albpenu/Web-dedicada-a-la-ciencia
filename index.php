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
  <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
  <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
</head>
<body onload="horario()">
  <style type="text/css">
    @font-face {
        font-family: 'sciencefair';
        src: url('fonts/Science Fair.otf') format('opentype');
    }
  </style>
  <b style="top: 0; left: 0">Correo de contacto: <u><a href="#">cultoalaciencia@gmail.com</a></u></b>
  <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
  </br>
  
  <div id="imgperfil" style="float: right;">
    <?php

    if (isset($_SESSION['usuario'])) {
      //$extension = strtolower(substr($_SESSION["nombreimg"], strpos($_SESSION["nombreimg"], '.') + 1));
      echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';
      //echo '<img src="data:image/'.$extension.';base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';
    } else {
     }
     
    ?>
  </div>
  <span style="float: right; right: 0; padding: 0px; padding-top: 15px; clear: both;">
  <a href='cerrarsesion.php' title='Cerrar sesión' id="salir" style="right: 0px">Salir</a></span>
  <?php

    $fecha = date('d/m/Y');
    echo "<p style='color: white; padding-top: 15px;'>".$fecha.", <label id='hora'></label></p>";

  ?>

    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="index.php" style="font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 50px;">CULTO A LA CIENCIA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav" style="text-align: center">
          <li class="nav-item">
            <a class="nav-link" href="categorias.php" style="font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 30px; box-shadow: 0px 0px 0px 12px; margin: 5px black; border: 3px solid black;">CATEGORíAS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 30px; box-shadow: 0px 0px 0px 12px; margin: 5px black; border: 3px solid black; cursor: pointer;" onclick="acceso()">AcceSO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 30px; box-shadow: 0px 0px 0px 12px; margin: 5px black; border: 3px solid black" href="registro.php">RegiSTRO</a>
          </li>
        </ul>
      </div>
    </nav>

    <div id="imglogo" align="center" style="position: relative;">
    	<img id="logo" src="rsc/img/acceso.gif" />
    </div>
    
  <?php
    include('conexion.php');
  ?>

    <!-- Formulario de acceso-->
	<form id="formu" name="form" action="acceso.php" method="post" style="background: url('rsc/img/accesofinal.gif'); background-repeat: no-repeat; background-position: center center; background-attachment: scroll; background-size: 100% 100%; height: auto; width: auto; border-radius: 15px; text-align: center; z-index: 1000; display: block;" align="center">
      <a href="javascript:cerrarAcc()" style="float: right; font-family: 'mejor'; color: black; text-decoration: none; background-color: white; border-radius: 50%; width: 15px">X</a>
      <h1 style="margin-top: 5px; font-family: 'mejor'; font-size: 60px">Acceso:</h1>
	    <input style="background-color: transparent; width: 80%; font-size: 30px" placeholder="Correo" required name="email" type="email" value="" style="" /><br><br>
	    <input style="background-color: transparent; width: 80%; font-size: 30px" placeholder="Contraseña" required name="password" type="password" value=""/><br>
        <input name="remember" type="checkbox" value="rememberYES"><label style="color: blue; font-size: 40px">Recuérdame</label><br>
        <input type="submit" style="background-color: transparent; font-size: 40px" name="enviar" value="Entrar"/><br>
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

    function acceso(){
      $("#formu").toggle();
    }

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
