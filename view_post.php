<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script> 
    </head>
    <body>
        <style type="text/css">
            body{
                background: url("./rsc/img/the_martian.jpg") !important; 
                background-repeat: no-repeat !important;
                background-position: center center !important;
                background-position-y: 30px !important;
                background-attachment: fixed !important;
                background-size: 100% 100% !important;
            }

            @font-face {
                font-family: 'sciencefair';
                src: url('fonts/Science Fair.otf') format('opentype');
            }

            p, label {
                color: white;
                font-size: 20px;
            }

            #titulo, p, label {
                padding-left: 15px;
            }

            a.nav-link {
                background-color: #436A6C !important;
                font-family: 'sciencefair';
            }
        </style>

        <div height='100px' style="display: flex; align-items: center;">
            <img onclick="volver()" src="rsc/img/volver.gif" width="100px" style="cursor: pointer;">
            <h3 style="color: blue;">Volver a la página anterior</h3>
        </div>

        <?php
            session_start();
            session_id();
            session_name();
            include('acceso.php');
        ?>
        <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
        </br>
        
        <div id="imgperfil" style="float: right; margin-top: -100px;">
            <?php
            if (isset($_SESSION['usuario'])) {

            echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';
            $consulta = mysqli_query($connect, "SELECT * FROM usuarios WHERE alias LIKE '".$_SESSION['usuario']."'");
            $saber = mysqli_fetch_assoc($consulta);

            
            echo "<br><span id='saber'></span>";
                if ($saber['sabiduria']=='Es su primerita vez') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='Ya ha hecho sus pinitos en este mundillo') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='Sabe cositas') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='Progresa Adecuadamente') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($saber['sabiduria']=='En la cresta de la ola') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('saber').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/>';
                    </script>
                    <?php
                }
            } else {
            }
            
            ?>
        </div>
        <span style="float: right; right: 0; padding: 0px; padding-top: 15px; clear: both;">
            <a href='cerrarsesion.php' title='Cerrar sesión' id="salir" style="right: 0px">Salir</a></span>

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: transparent !important">
            <ul class="navbar-nav" style="text-align: center">
              <li class="nav-item">
                <a class="nav-link" href="categorias.php" style="font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 30px; box-shadow: 0px 0px 0px 12px; margin: 5px black; border: 3px solid black;">CATEGORíAS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php" style="font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 30px; box-shadow: 0px 0px 0px 12px; margin: 5px black; border: 3px solid black;">INICIO</a>
              </li>
            </ul>
        </nav>
            <?php
                include('conexion.php');
                $consulta = mysqli_query($connect, "SELECT * FROM posts p JOIN usuarios u ON u.id_usuario=p.id_usuario WHERE id_post LIKE '".$_GET['post']."';");
                $post = mysqli_fetch_assoc($consulta);
                $video = substr($post['video'], strpos($post['video'], "=") + 1);
//VOTOS y SABIDURIA del usuario del post:
                $consulta = mysqli_query($connect, "SELECT avg(valor) FROM votos v JOIN posts p ON v.id_usuario=p.id_usuario WHERE p.id_usuario='".$post['id_usuario']."';");
                $sabiduria = mysqli_fetch_array($consulta);

                $consulta = mysqli_query($connect, "SELECT count(id_post) FROM posts WHERE id_usuario = '".$post['id_usuario']."';");
                $cant_post = mysqli_fetch_array($consulta);

                if ($cant_post[0]<=5 && round($sabiduria[0], 2)<=5) {
                    mysqli_query($connect, "UPDATE usuarios SET sabiduria='Es su primerita vez' WHERE id_usuario = '".$post['id_usuario']."';");
                } elseif ($cant_post[0]>=6 && $cant_post[0]<=10 && round($sabiduria[0], 2)>=2.5) {
                    mysqli_query($connect, "UPDATE usuarios SET sabiduria='Ya ha hecho sus pinitos en este mundillo' WHERE id_usuario = '".$post['id_usuario']."';");
                } elseif ($cant_post[0]>=6 && $cant_post[0]<=10 && round($sabiduria[0], 2)>=3) {
                    mysqli_query($connect, "UPDATE usuarios SET sabiduria='Sabe cositas' WHERE id_usuario = '".$post['id_usuario']."';");
                } elseif ($cant_post[0]>=11 && $cant_post[0]<=15 && round($sabiduria[0], 2)>=3.5) {
                    mysqli_query($connect, "UPDATE usuarios SET sabiduria='Progresa Adecuadamente' WHERE id_usuario = '".$post['id_usuario']."';");
                } elseif ($cant_post[0]>=15 && round($sabiduria[0], 2)>4) {
                    mysqli_query($connect, "UPDATE usuarios SET sabiduria='En la cresta de la ola' WHERE id_usuario = '".$post['id_usuario']."';");
                }
                

            ?>

            <h1 id="titulo" style="font-size: 50px"><?php echo $post['titulo']; ?></h1>
            <p style="text-decoration: underline;">Fecha de subida: <?php echo("<b>".$post['fecha_subida']."</b>"); ?></p>
            <p style="text-decoration: underline;">Subido por:</p> <div style="margin-left: 25px; margin-bottom: 15px; font-family: 'sciencefair'; text-shadow: 3px 3px black; color: #E9A56D; font-size: 30px; box-shadow: 0px 0px 0px 12px; margin: 5px black; border: 3px solid black; background-color: #436A6C !important; width: 350px; text-align: center;"><?php echo("<br><b>".$post['alias']."</b><br><span id='nivel'></span><br><b style='padding-left: 0px !important;'>(".$post['sabiduria'].")</b>"); ?></div>
            <label><?php echo $post['contenido']."<br>"; ?></label>
            <div align="center">
                <?php
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($post['imagen']).'" width="500"/><br>';

                    //ESTRELLAS X SABIDURIA
                if ($post['sabiduria']=='Es su primerita vez') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('nivel').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($post['sabiduria']=='Ya ha hecho sus pinitos en este mundillo') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('nivel').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($post['sabiduria']=='Sabe cositas') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('nivel').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($post['sabiduria']=='Progresa Adecuadamente') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('nivel').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/1.png" width="20"/>';
                    </script>
                    <?php
                } elseif ($post['sabiduria']=='En la cresta de la ola') {
                    ?>
                    <script type="text/javascript">
                        document.getElementById('nivel').innerHTML ='<img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/><img src="rsc/img/STARS/9.png" width="20"/>';
                    </script>
                    <?php
                }
                ?>
                <iframe type="text/html" width="500" height="350"
                src="https://www.youtube.com/embed/<?php echo $video;?>" frameborder="0" allowfullscreen></iframe>
            <br>
            <form method="POST">
                <h1>Vota:</h1>
                <select name="puntos">
                    <option>Puntuación</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <input type="submit" name="enviar" value="Votar">
            </form>
            <?php
                include('conexion.php');

                $idu = mysqli_query($connect, "SELECT id_usuario FROM usuarios WHERE alias='".$_SESSION['usuario']."';");
                $idusu = mysqli_fetch_array($idu);

                $id = mysqli_query($connect, "SELECT count(id_voto) FROM votos WHERE id_usuario='".$idusu[0]."' AND id_post = '".$post['id_post']."';");
                $idxpost = mysqli_fetch_array($id);

                if($_POST['puntos'] >= 1){

                    if (count($idusu[0])==1 && $idxpost[0]==0) {
                        mysqli_query($connect, "INSERT INTO votos (id_voto, valor, id_usuario, id_post) VALUES (NULL,'".$_POST['puntos']."', '".$idusu[0]."', '".$post['id_post']."');");
                        ?>
                        <script type="text/javascript">
                            alert('¡Gracias por tu voto, <?php echo $_SESSION['usuario']; ?>  😉👍!');
                        </script>
                        <?php
                    } elseif (count($idusu[0])==1 && $idxpost[0]>=1) {
                        ?>
                        <script type="text/javascript">
                            alert('¡<?php echo $_SESSION['usuario']; ?>, sólo puedes votar una vez!');
                        </script>
                        <?php
                    } elseif (!isset($_SESSION['usuario'])) {
                        ?>
                        <script type="text/javascript">
                            alert('¡Disculpa, pero ¿¿quién eres??!');
                        </script>
                        <?php
                    }
                } elseif ($_POST['puntos'] == 'Puntuación') {
                    ?>
                    <script type="text/javascript">
                        alert('¡Esto no es una puntuación!');
                    </script>
                    <?php
                } else {
                    //Cuando no clicas o vacío
                }
                

                $consulta = mysqli_query($connect, "SELECT avg(valor) FROM votos WHERE id_post = '".$post['id_post']."';");
                $media = mysqli_fetch_array($consulta);
                $idvoto = mysqli_query($connect, "SELECT count(id_voto) FROM votos WHERE id_post = '".$post['id_post']."';");
                $voto = mysqli_fetch_array($idvoto);
                    echo "<br><span style='display: inline-flex; background-color: #F7912D; border-radius: 100%'><h1><u>".round($media[0],2)."</u><img src='rsc/img/STARS/9.png' width='25'/></h1><p>(media con ".$voto[0]." votos)</p></span><br>";
            echo "<br>";
            
            for($i=0; $i<=4; $i++) { 
            
                if ($media[0] >= 1) {
                    echo '<img src="rsc/img/STARS/9.png" width="100"/>';
                    
                   
                } else {

                    if ($media[0] >= 0.1 && $media[0]<0.2) {
                        echo '<img src="rsc/img/STARS/2.png" width="100"/>';
                        
                        
                    } elseif ($media[0] >= 0.2 && $media[0]<0.3) {
                        echo '<img src="rsc/img/STARS/3.png" width="100"/>';
                        
                        
                    } elseif ($media[0] >= 0.3 && $media[0]<0.45) {
                        echo '<img src="rsc/img/STARS/4.png" width="100"/>';
                        
                        
                    } elseif ($media[0] >= 0.45 && $media[0]<0.55) {
                        echo '<img src="rsc/img/STARS/5.png" width="100"/>';
                        
                        
                    } elseif ($media[0] >= 0.55 && $media[0]<0.65) {
                        echo '<img src="rsc/img/STARS/6.png" width="100"/>';
                        
                        
                    } elseif ($media[0] >= 0.65 && $media[0]<0.75) {
                        echo '<img src="rsc/img/STARS/7.png" width="100"/>';
                        
                        
                    } elseif ($media[0] >= 0.75) {
                        echo '<img src="rsc/img/STARS/8.png" width="100"/>';
                        
                        
                    } else {
                        echo '<img src="rsc/img/STARS/1.png" width="100"/>';
                        
                    }
                }

                $media[0]--;
            }
            
            ?>
            </div>
            <script type="text/javascript">
                function volver(){
                    window.history.back();
                }
                document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
                document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['usuario']." "; echo $_SESSION['imagenperfil']; ?>';
            </script>   
        </body>
    </html>