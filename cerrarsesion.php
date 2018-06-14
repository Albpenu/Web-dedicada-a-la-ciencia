<!DOCTYPE html>
<html>
<head>
	<title>Cerrar sesion</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		session_start();
		unset($_SESSION["alias"]); 
		$_SESSION = array();
	  	session_destroy();
	  	?>
	  	<script type="text/javascript">
		alert('Has cerrado tu sesión 😢');
		window.location.href='index.php';
	</script>
	  	<?php
	  	exit;
	?>
</body>
</html>

