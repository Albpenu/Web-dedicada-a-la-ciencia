<?php
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.2.1.min.js"></script>
    <title></title>
</head>

<body style="background-image: url('rsc/img/fondo.png'); background-repeat: no-repeat; background-size: cover;">
    <!-- Formulario de registro-->
    	<form name="form" action="registro_db.php" method="post" enctype="multipart/form-data">
            <fieldset style="width: 40%; color: white; background: url('rsc/img/registro.gif') repeat scroll center center / 100% 100%; border-radius: 15px; z-index: 1000; display: block;">
                <legend><h1><u>Registro:</u></h1></legend>
                <input required placeholder="Elija un alias" name="alias" type="text" value=""/><br><br>
                <strong>Elija una imagen de perfil: </strong><br>
                <input required type="file" name="imagenperfil" id="imagenperfil" style="color: #f2ff00"><br><br>
        	    <input required placeholder="Introduzca su dirección de correo electrónico" style="width: 270px;" name="email" type="email" value=""/><br><br>
        	    <input required placeholder="Introduzca una contraseña" name="password" style="width: 160px;" type="password" id="pass" value=""/> <input type="checkbox" name="comprobar" id="checkpass" onclick="showHidePass()"/><b>Mostrar contraseña</b><br><br>
                <input required type="password" style="width: 160px;" name="rpass" id="rpass" class="form-control" required placeholder="Repita su contraseña" /><br><br>
                <input style="float: right; background: gold" type="submit" name="registro" id="registrarse" value="Registrarse"/>
            </fieldset>
    	</form>
        
    <script type="text/javascript">
        $(document).ready(function(){
            $("#registrarse").click(function(){
                var nombre_imagen = $("#imagenperfil").val();
                if (nombre_imagen == "") {
                    alert("Parece que se te olvidó seleccionar una imagen de perfil");
                    return false;
                } else {
                    var extension = $('#imagenperfil').val().split('.').pop().toLowerCase();

                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert('Vamos a ver, esto no es una imagen...');
                        $("#imagenperfil").val();
                        return false;
                    }
                }
            });
        });

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