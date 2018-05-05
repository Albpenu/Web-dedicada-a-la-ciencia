<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include('conexion.php');
		$consulta = mysqli_query($connect, "SELECT video FROM posts WHERE titulo LIKE '".$_GET['post']."';");
		$video = mysqli_fetch_array($consulta);
		$id_video = substr($video[0], strpos($video[0], "=") + 1);    
		echo $id_video;
    ?>
	 <iframe type="text/html" width="420" height="315"
    src="https://www.youtube.com/embed/<?php echo $id_video;?>" frameborder="0" allowfullscreen></iframe>
</body>
</html>