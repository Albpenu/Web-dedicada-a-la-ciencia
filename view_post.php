<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>`
<body>
	<?php
		include('conexion.php');
		$consulta = mysqli_query($connect, "SELECT * FROM posts WHERE titulo LIKE '".$_GET['post']."';");
		$post = mysqli_fetch_assoc($consulta);
		$video = substr($post['video'], strpos($post['video'], "=") + 1);
	?>
	<h1><?php echo $post['titulo']; ?></h1>
	<label><?php echo $post['contenido']; ?></label>
	<?php 
		echo '<img src="data:image/jpeg;base64,'.base64_encode($post['imagen']).'" width="100"/><br>';   
    ?>
	 <iframe type="text/html" width="420" height="315"
    src="https://www.youtube.com/embed/<?php echo $video;?>" frameborder="0" allowfullscreen></iframe>
</body>
</html>