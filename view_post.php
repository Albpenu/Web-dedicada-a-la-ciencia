<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		session_start();
		session_id();
  		session_name();
  		include('acceso.php');
	?>
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
		include('conexion.php');
		$consulta = mysqli_query($connect, "SELECT * FROM posts WHERE titulo LIKE '".$_GET['post']."';");
		$post = mysqli_fetch_assoc($consulta);
		$video = substr($post['video'], strpos($post['video'], "=") + 1);
	?>
	<h1><?php echo utf8_decode($post['titulo']); ?></h1>
	<label><?php echo utf8_decode($post['contenido'])."<br>"; ?></label>
	<?php 
		echo '<img src="data:image/jpeg;base64,'.base64_encode($post['imagen']).'" width="100"/><br>';   
    ?>
	 <iframe type="text/html" width="420" height="315"
    src="https://www.youtube.com/embed/<?php echo $video;?>" frameborder="0" allowfullscreen></iframe><br>
    <form action="" method="POST">
    	<h1>Votos:</h1>
    	<select name="puntos">
    		<option>Puntuación</option>
    		<option>1</option>
    		<option>2</option>
    		<option>3</option>
    		<option>4</option>
    		<option>5</option>
    	</select>
    	<input type="submit" name="enviar" value="Votar">
    </form>
    <?php
    	include('conexion.php');
    	//$idusu = ;
    	//$idpost = ;
    	$idu = mysqli_query($connect, "SELECT id_usuario FROM usuarios WHERE alias='".$_SESSION['usuario']."';");
    	$idusu = mysqli_fetch_array($idu);
    	echo $idusu[0];
    	mysqli_query($connect, "INSERT INTO votos (id_voto, valor, id_usuario, id_post) VALUES NULL,'".$_POST['puntos']."', '".$idusu[0]."', '".$post['id_post']."';");
    ?>
    <script type="text/javascript">
    	document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
    	document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['usuario']." "; echo $_SESSION['imagenperfil']; ?>';
    </script>
</body>
</html>