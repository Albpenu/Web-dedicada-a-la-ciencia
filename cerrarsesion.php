<?php
	session_start();
	unset($_SESSION["alias"]); 
	$_SESSION = array();
  	session_destroy();
  	header("Location: index.php");
  	exit;
?>