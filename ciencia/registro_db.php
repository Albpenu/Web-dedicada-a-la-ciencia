<?php
// Registro de cliente:
    include('conexion.php');

    $alias = md5($_POST['alias']);
    $email = md5($_POST['email']);
    $contrasenia = md5($_POST['password']);
    $repcontrasenia = md5($_POST['rpass']);
    $fecha = date('d/m/Y, h:i:s');

    //$sabiduria = ;

    $comprobaremail = mysqli_query($connect, "SELECT * FROM usuario WHERE correo='$correo'");
    $comprobar_email = mysqli_num_rows($comprobaremail);

    if($contrasenia==$repcontrasenia){
        if($comprobar_email>0){
            echo ' <script language="javascript">alert("Uy, este email ya está designado, a ver sí vas a estar ya registrado...");</script> ';
        } else {
            $consulta1 = mysqli_query($connect, "INSERT INTO usuario (id_usuario, alias, contrasenia, email, fecha_alta, sabiduria) VALUES (NULL, $alias, '$contrasenia', '$email', '$fecha', '$sabiduria')");

            $id = mysqli_insert_id($connect);
            
            $consulta2 = mysqli_query($connect, "INSERT INTO cliente (id_usuario,alias,correo) VALUES (NULL, '$alias', '$correo')");

            echo "¡Se ha registrado con éxito! ;).<br> Sea bienvenid@ y volvamos a casa:<br> <a href='index.php'><img class='option' src='rsc/img/house.png' /></a>"; 
        }
    } else {
            echo '<script>alert("Las contraseñas no coinciden. Revíselas ;)");</script>';
            echo '<script>history.back();</script>';
    }  
    mysqli_close($connect);
?>