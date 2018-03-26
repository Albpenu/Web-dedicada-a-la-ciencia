<?php
	session_start();
	session_id();
  session_name();
  include('acceso.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Categorías</title>
  <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> 
</head>

<body onload="horario()">

  <b style="top: 0; left: 0">Correo de contacto: <u><a href="#">cultoalaciencia@gmail.com</a></u></b>
  <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
  </br>
  
  <div id="imgperfil" style="float: right;">
    <?php

    if (isset($_SESSION['usuario'])) {
      echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';
    } else {
     }
     
    ?>
  </div>
  <span style="float: right; right: 0; padding: 0px; padding-top: 15px; clear: both;">
  <a href='cerrarsesion.php' title='Cerrar sesión' id="salir" style="right: 0px">Salir</a></span>
 
  <?php

    $fecha = date('d/m/Y');
    echo "<p style='color: white;'>".$fecha.", <label id='hora'></label></p>";
  ?>

  <div id="categorias" align="center">

  <?php
  $nombreydesc1 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 1;");
  $nombreydesc2 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 2;");
  $nombreydesc3 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 3;");
	$fechacat = mysqli_query($connect, "SELECT fecha_ultima_actualizacion FROM categorias WHERE id_categoria = '".$idcat."';");
	$fcat = mysqli_fetch_array($fechacat);
	 ?>
  	
  	<div style="clear: both;">
  		<img style="cursor: pointer;" src="rsc/img/1.gif" id="imgcategoria1" width="300" alt="<?php 
      $id1 = mysqli_fetch_assoc($nombreydesc1);
      echo utf8_encode($id1['nombre_categoria']);
      ?>">
  		<div id="categoria1">
  			<label style="color: white;"><?php echo utf8_encode($id1['descripcion']); ?></label>
  		</div>
  	</div>

  	<div>
  		<img style="cursor: pointer; clear: both;" src="rsc/img/2.gif" id="imgcategoria2" width="300" alt="<?php 
      $id2 = mysqli_fetch_assoc($nombreydesc2);
      echo utf8_encode($id2['nombre_categoria']);
      ?>">	
  		<div id="categoria2">
  			<label style="color: white;"><?php echo utf8_encode($id2['descripcion']); ?></label>
  		</div>	
  	</div>

  	<div>
  		<img style="cursor: pointer; clear: both;" src="rsc/img/3.gif" id="imgcategoria3" width="300" alt="<?php 
      $id3 = mysqli_fetch_assoc($nombreydesc3);
      echo utf8_encode($id3['nombre_categoria']);
      ?>">	
  		<div id="categoria3">
  			<label style="color: white;"><?php echo utf8_encode($id3['descripcion']); ?></label>
  		</div>
  	</div>	
  </div>

  <script type="text/javascript">
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
    //ACORDEON DE CATEGORIAS
    $("div#categorias > div > div#categoria1").hide();
    $("div#categorias > div > div#categoria2").hide();
    $("div#categorias > div > div#categoria3").hide();
        
    $("div#categorias > div > img#imgcategoria1").click(function() {
        $("div#categorias > div > div#categoria1").animate({
            height: "toggle"
        }, 1500);

        $("div#categorias > div > div#categoria2").animate({
            height: "hide"
        }, 1500);

        $("div#categorias > div > div#categoria3").animate({
            height: "hide"
        }, 1500);
    });

    $("div#categorias > div > img#imgcategoria2").click(function() {
        $("div#categorias > div > div#categoria2").animate({
            height: "toggle"
        }, 1500);

        $("div#categorias > div > div#categoria1").animate({
            height: "hide"
        }, 1500);

        $("div#categorias > div > div#categoria3").animate({
            height: "hide"
        }, 1500);
    });

    $("div#categorias > div > img#imgcategoria3").click(function() {
        $("div#categorias > div > div#categoria3").animate({
            height: "toggle"
        }, 1500);

        $("div#categorias > div > div#categoria2").animate({
            height: "hide"
        }, 1500);

        $("div#categorias > div > div#categoria1").animate({
            height: "hide"
        }, 1500);
    });
  </script>
</body>
</html>