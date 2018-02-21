<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <?php
    // Registro de usuario:
        include('conexion.php');

        $alias = $_POST['alias'];
        $imagen = $_POST['imagenperfil'];
        $email = $_POST['email'];
        $contra = md5($_POST['password']);
        $repcontra = md5($_POST['rpass']);

        $comprobaremail = mysqli_query($connect, "SELECT * FROM usuarios WHERE email='$email'");
        $comprobar_email = mysqli_num_rows($comprobaremail);

        $comprobaralias = mysqli_query($connect, "SELECT * FROM usuarios WHERE alias='$alias'");
        $comprobar_alias = mysqli_num_rows($comprobaralias);

        if($contra==$repcontra){
            if($comprobar_email>0){
                    echo '<script language="javascript">alert("Uy, este email ya está designado, a ver sí vas a estar ya registrado...");</script> ';
                    echo '<script>history.back();</script>';
            } elseif ($comprobar_alias>0) {
                    echo '<script language="javascript">alert("Uy, este alias ya está designado, a ver sí vas a estar ya registrado...");</script> ';
                    echo '<script>history.back();</script>';
                } else {
                $consulta = mysqli_query($connect, "INSERT INTO usuarios (id_usuario, alias, contrasenia, email, fecha_alta, sabiduria, imagendeperfil) VALUES ('', '$alias', '$contra', '$email', NOW(), 'Sabe cositas', '$imagen')");
                //sabiduria: parece intelig, todo un sabio

                echo "<b align='center'>¡Se ha registrado con éxito! 😉👍.<br> Ahora podrá acceder con su nueva cuenta. 😃 </br> Sea bienvenid@ y volvamos a casa:<br> <a href='index.php'><img class='option' src='rsc/img/house.png' /></a></b>"; 
            }
        } else {
                echo '<script>alert("Las contraseñas no coinciden. Revíselas ;)");</script>';
                echo '<script>history.back();</script>';
        }  
        mysqli_close($connect);
    ?>
</body>
</html>