<?php
// Registro de usuario:
    include('conexion.php');

    $alias = $_POST['alias'];
    $imagen = $_POST['imagenperfil'];
    $email = $_POST['email'];
    $contrasenia = $_POST['password'];
    $repcontrasenia = $_POST['rpass'];
    $fecha = date('d/m/Y, h:i:s');

    //$sabiduria = ;

    $comprobaremail = mysqli_query($connect, "SELECT * FROM usuarios WHERE email='$email'");
    $comprobar_email = mysqli_num_rows($comprobaremail);

    if($contrasenia==$repcontrasenia){
        if($comprobar_email>0){
            echo ' <script language="javascript">alert("Uy, este email ya está designado, a ver sí vas a estar ya registrado...");</script> ';
        } else {
            $consulta1 = mysqli_query($connect, "INSERT INTO usuarios (id_usuario, alias, email, fecha_alta, sabiduria, contrasenia) VALUES (NULL, $alias, '$contrasenia', '$email', '$fecha', '', $contrasenia)");

            $id = mysqli_insert_id($connect);

            echo "¡Se ha registrado con éxito! ;).<br> Sea bienvenid@ y volvamos a casa:<br> <a href='index.php'><img class='option' src='rsc/img/house.png' /></a>"; 
        }
    } else {
            echo '<script>alert("Las contraseñas no coinciden. Revíselas ;)");</script>';
            echo '<script>history.back();</script>';
    }  
    mysqli_close($connect);
?>