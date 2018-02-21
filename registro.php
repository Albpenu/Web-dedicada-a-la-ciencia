<?php
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body style="background-image: url('rsc/img/fondo.png'); background-repeat: no-repeat; background-size: cover;">
    <!-- Formulario de registro-->
    	<form name="form" action="registro_db.php" method="post">
            <fieldset style="width: 40%">
                <legend><h1><u>Registro:</u></h1></legend>
                <input placeholder="Elija un alias" name="alias" type="text" value=""/><br><br>
                <strong>Elija su imagen de avatar: </strong><input type="file" name="imagenperfil"><br><br>
        	    <input placeholder="Introduzca su dirección de correo electrónico" style="width: 270px;" name="email" type="email" value=""/><br><br>
        	    <input placeholder="Introduzca una contraseña" name="password" style="width: 160px;" type="password" id="pass" value=""/> <input type="checkbox" name="comprobar" id="checkpass" onclick="showHidePass()"/><b>Mostrar contraseña</b><br><br>
                <input type="password" style="width: 160px;" name="rpass" id="rpass" class="form-control" required placeholder="Repita su contraseña" /><br><br>
                <input style="float: right;" type="submit" name="registro" value="Registrarse"/>
            </fieldset>
    	</form>

    <script type="text/javascript">
        function showHidePass(){
            var pass = document.getElementById("pass");
            var rpass = document.getElementById("rpass");
            var checkpass = document.getElementById("checkpass");

            if (checkpass.checked){
                pass.setAttribute("type", "text");
                rpass.setAttribute("type", "text");
            } else {
                pass.setAttribute("type", "password");
                rpass.setAttribute("type", "password");
            }
        }    
    </script>
</body>
</html>