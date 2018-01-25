<?php
  session_start();
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

  <div class="fullscreen-bg">
    <video loop muted autoplay id="fondo" class="fullscreen-bg__video"/>
      <source src="https://i.imgur.com/W1GEO9G.mp4" type="video/mp4" />
    </video/>
  </div>

  <b style="top: 0; left: 0">Correo de contacto: <u><a href="#">cultoalaciencia@gmail.com</a></u></b>
  <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
  </br>
  <span style="top: 5; right: 5; float: right; position: absolute; padding: 20px"><a href='cerrarsesion.php' title='Cerrar sesión' id="salir"></a></span>
  <?php

    $fecha = date('d/m/Y');
    echo "<p style='color: white;'>".$fecha.", <label id='hora'></label></p>";

  ?>
    <div id="imglogo" align="center" style="cursor: pointer;">
    	<img id="logo" src="https://media1.giphy.com/media/pZGDZwmxOtEEo/giphy.gif" />
    </div>
    
    <!-- Formulario de acceso-->
	<form id="formu" name="form" action="acceso.php" method="post" style="background: rgba(0, 0, 0, 0) url(&quot;rsc/img/icon11.png&quot;) repeat scroll center center / 100% 100%; border-radius: 15px; text-align: center; z-index: 1000; display: block;" align="center">
      <a href="javascript:cerrarAcc()" style="float: right; padding-right: 5px; font-family: 'mejor'; color: black">x</a>
      <h1 style="margin-top: 5px; font-family: 'mejor';"><u>Acceso</u>:</h1>
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
    $("#formu").hide();

    $("#imglogo").click(function(){
        $("#formu").toggle();
    });

    function formato(i) {
        if (i < 10) {i = "0" + i};
        return i;
    }

    document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
    /*document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['alias']." "; echo $_SESSION['imagenperfil']; ?>';*/

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


  /*document.getElementById("formu").nextElementSibling.innerHTML = "<ul align='center'><li><a href='index.php?<?php echo htmlspecialchars(SID); ?>'><img class='option' src='rsc/img/house.png' /></a></li><li><img class='option' src='rsc/img/list.png' onclick='secciones()'/></li><li><img class='option' onclick='formulario()' src='rsc/img/userpassword.png' /></li><br><div  id='seccion'><li><a href='catlibros.php?<?php echo htmlspecialchars(SID); ?>'><img class='option' src='rsc/img/' /></a></li><li><a href='.php'><img class='option' src='rsc/img/' /></a></li></div></ul>";
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
  */
        
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
