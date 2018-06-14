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
  <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px; padding-bottom: 5px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
  </br>
  
  <div id="imgperfil" style="float: right;">
    <?php

    if (isset($_SESSION['usuario'])) {
      echo '<img id="imgperfil" src="data:image/jpeg;base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';
      $consulta = mysqli_query($connect, "SELECT * FROM usuarios WHERE alias LIKE '".$_SESSION['usuario']."'");
            $saber = mysqli_fetch_assoc($consulta);

            
            echo "<br><span id='saber'></span>";
                if ($saber['sabiduria']=='Es su primerita vez') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='Ya ha hecho sus pinitos en este mundillo') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='Sabe cositas') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='Progresa Adecuadamente') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='En la cresta de la ola') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/>';
                    </script>
                    <?php
                }
            } else {
            }
            
            ?>
        </div>
  <span style="float: right; right: 0; padding: 0px; padding-top: 15px; clear: both;">
  <a href='cerrarsesion.php' title='Cerrar sesión' id="salir" style=" margin-right: 10px">Salir</a></span>
  <?php

    $fecha = date('d/m/Y');
    echo "<p style='color: white; padding-top: 15px;'>".$fecha.", <label id='hora'></label></p>";

  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #436A6C !important">
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
            <a class="nav-link" href="index.php" style="font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 30px; box-shadow: 0px 0px 0px 12px; margin: 5px black; border: 3px solid black;">INICIO</a>
          </li>
        </ul>
      </div>
    </nav>

  <?php
  $nombreydesc1 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 1;");
  $id1 = mysqli_fetch_assoc($nombreydesc1);

  $nombreydesc2 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 2;");
  $id2 = mysqli_fetch_assoc($nombreydesc2);

  $nombreydesc3 = mysqli_query($connect, "SELECT * FROM categorias WHERE id_categoria = 3;");
  $id3 = mysqli_fetch_assoc($nombreydesc3);

	$fechacat = mysqli_query($connect, "SELECT fecha_ultima_actualizacion FROM categorias WHERE id_categoria = '".$idcat."';");
	$fcat = mysqli_fetch_array($fechacat); 
	 ?>

  <b id="dificultad">CATEGORíAS SEGúN SU NIVEL de DIFICULTAD:</b>

  <div class="categorias">
  	<div id="cat1">
      <a href="posts.php?categoria=<?php echo $id1['nombre_categoria']; ?>" style="outline: none;"><div style="display: block; position: relative; width: 300px; cursor: pointer;">
    		<img style="display: block; position: relative;" src="rsc/img/1.gif" width="300" alt="<?php 
        echo $id1['nombre_categoria'];
        ?>">
        <h1 style="display: block; position: absolute; width: 100%; bottom: -16px; color: white"><?php echo $id1['nombre_categoria']; ?></h1>
      </div></a>
      <div id="categoria1">
      <img id="imgcategoria1" src="rsc/img/info.gif" alt="Más información" style="cursor: pointer; border-radius: 100%; width: 100px">
      <br>
  			<label id="desccat1" style="color: white;"><?php echo $id1['descripcion']; ?></label>
  		</div>
  	</div>

  	<div id="cat2">
      <a href="posts.php?categoria=<?php echo $id2['nombre_categoria']; ?>" style="outline: none;"><div style="display: block; position: relative; width: 300px; cursor: pointer;">
    		<img style="cursor: pointer; display: block; position: relative;" src="rsc/img/2.gif" width="300" alt="<?php 
        echo $id2['nombre_categoria'];
        ?>">
        <h1 style="display: block; position: absolute; width: 100%; bottom: -16px; color: black;"><?php echo $id2['nombre_categoria']; ?></h1>
      </div></a>
      <div id="categoria2">
      <img id="imgcategoria2" src="rsc/img/info.gif" alt="Más información" style="cursor: pointer; border-radius: 100%; width: 100px">
      <br>
  			<label id="desccat2" style="color: white;"><?php echo $id2['descripcion']; ?></label>
  		</div>	
  	</div>

  	<div id="cat3">
      <a href="posts.php?categoria=<?php echo $id3['nombre_categoria']; ?>" style="outline: none;"><div style="display: block; position: relative; width: 300px; cursor: pointer; ">
    		<img style="cursor: pointer; display: block; position: relative;" src="rsc/img/3.gif" width="300" alt="<?php 
        echo $id3['nombre_categoria'];
        ?>">	
        <h1 style="display: block; position: absolute; width: 100%; bottom: -16px; color: white;"><?php echo $id3['nombre_categoria']; ?></h1>
      </div></a>
      <div id="categoria3">
      <img id="imgcategoria3" src="rsc/img/info.gif" alt="Más información" style="cursor: pointer; border-radius: 100%; width: 100px">
      <br>
  			<label id="desccat3" style="color: white;"><?php echo $id3['descripcion']; ?></label>
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
    $("div.categorias > div > div#categoria1 > label#desccat1").hide();
    $("div.categorias > div > div#categoria2 > label#desccat2").hide();
    $("div.categorias > div > div#categoria3 > label#desccat3").hide();
        
    $("img#imgcategoria1").click(function() {
        $("div.categorias > div > div#categoria1 > label#desccat1").animate({
            height: "toggle"
        }, 1500);

        $("div.categorias > div > div#categoria2 > label#desccat2").animate({
            height: "hide"
        }, 1500);

        $("div.categorias > div > div#categoria3 > label#desccat3").animate({
            height: "hide"
        }, 1500);

        $("div.categorias > div > div#categoria1").css("background-color", "#01E4AD");
        $(this).css("border-radius", "0%");
    });

    $("img#imgcategoria2").click(function() {
        $("div.categorias > div > div#categoria2 > label#desccat2").animate({
            height: "toggle"
        }, 1500);

        $("div.categorias > div > div#categoria1 > label#desccat1").animate({
            height: "hide"
        }, 1500);

        $("div.categorias > div > div#categoria3 > label#desccat3").animate({
            height: "hide"
        }, 1500);

        $("div.categorias > div > div#categoria2").css("background-color", "#01E4AD");
        $(this).css("border-radius", "0%");
    });

    $("img#imgcategoria3").click(function() {
        $("div.categorias > div > div#categoria3 > label#desccat3").animate({
            height: "toggle"
        }, 1500);

        $("div.categorias > div > div#categoria2 > label#desccat2").animate({
            height: "hide"
        }, 1500);

        $("div.categorias > div > div#categoria1 > label#desccat1").animate({
            height: "hide"
        }, 1500);

        $("div.categorias > div > div#categoria3").css("background-color", "#01E4AD");
        $(this).css("border-radius", "0%");
    });
  </script>
</body>
</html>