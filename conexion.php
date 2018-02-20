<?php
    //Conectar con la Base de Datos
    $connect = mysqli_connect("localhost", "root", "Admin2015", "ciencia", 3316);
    $connect->set_charset("uft8");

    //Comprobar que la conexión es correcta
    if ($connect->connect_errno) {
       	printf("Connection failed: %s\n", $connect->connect_error);
        exit();
    }
?>
