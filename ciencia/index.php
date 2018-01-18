<?php

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Culto a la ciencia</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script>-->
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
</head>
<body onload="horario()" style="background-size: 150% 150%; background-attachment: fixed; background-position: cover; min-width: 400px;">

  <video autoplay="autoplay" loop="loop" id="fondo" preload="auto"/>
    <source src="https://i.imgur.com/W1GEO9G.mp4" type="video/mp4" />
  </video/>

  <b style="top: 0; left: 0">Correo de contacto: <u><a href="#">cultoalaciencia@gmail.com</a></u></b>
  <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
  </br>
  <span style="top: 5; right: 5; float: right; position: absolute; padding: 20px"><a href='cerrarsesion.php' title='Cerrar sesión' id="salir"></a></span>
  <?php

    $fecha = date('d/m/Y');
    echo $fecha;
    echo "<p id='hora'></p>";

  ?>
    <div id="imglogo" align="center" >
    	<img id="logo" src="https://media1.giphy.com/media/pZGDZwmxOtEEo/giphy.gif" />
    </div>

    <!-- Formulario de acceso-->
	<form id="formu" name="form" action="acceso.php" method="post" style="background: url('rsc/img/icon11.png'); background-position: center; background-size: 100%; border-radius: 15px; text-align: center;" align="center">
        <h1><u>Acceso</u>:</h1>
	    <input style="width: 125px" placeholder="Correo" required name="email" type="email" value="" style="" /><br>
	    <input style="width: 125px" placeholder="Contraseña" required name="password" type="password" value=""/><br>
        <input name="remember" type="checkbox" value="rememberYES"><label style="color: gold;">Recuérdame</label><br>
        <input type="submit" name="enviar" value="Entrar"/><br>
        <a style="font-size: 12px" href="registro.php">¿No estás registrado?</a><br>
        <a style="font-size: 8px" href="olvidado.php">¿Has olvidado tu contraseña?</a>
	</form>
  <nav></nav>
	<aside></aside>
	<aside></aside>
	<script type="text/javascript">

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

    function formato(i) {
        if (i < 10) {i = "0" + i};
        return i;
    }

  document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
  document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['cliente']; ?>';

  document.getElementById("formu").nextElementSibling.innerHTML = "<ul align='center'><li><a href='index.php?<?php echo htmlspecialchars(SID); ?>'><img class='option' src='rsc/img/house.png' /></a></li><li><img class='option' src='rsc/img/list.png' onclick='secciones()'/></li><li><img class='option' onclick='formulario()' src='rsc/img/userpassword.png' /></li><br><div  id='seccion'><li><a href='catlibros.php?<?php echo htmlspecialchars(SID); ?>'><img class='option' src='rsc/img/catlibros.png' /></a></li><li><a href='catbolis.php'><img class='option' src='rsc/img/pen.png' /></a></li></div></ul>";
  document.getElementById("seccion").style.display = "none";
  document.getElementById("formu").style.display = "none";
  function secciones() {
      var seccion = document.getElementById("seccion");
      if (seccion.style.display === "none") {
          seccion.style.display = "block";
      } else {
          seccion.style.display = "none";
      }
  }
  
  function formulario() {
      var form = document.getElementById("formu");
      if (form.style.display === "none") {
          form.style.display = "block";
      } else {
          form.style.display = "none";
      }
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
