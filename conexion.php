<?php
    //Conectar con la Base de Datos
    $connect = mysqli_connect("localhost", "root", "Admin2015", "ciencia", 3316);
    //Codificación utf8
    mysqli_set_charset($connect, "utf8");
    //Comprobar que la conexión es correcta
    if ($connect->connect_errno) {
       	printf("Connection failed: %s\n", $connect->connect_error);
        exit();
    }
?>
