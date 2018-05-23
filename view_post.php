<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            session_start();
            session_id();
            session_name();
            include('acceso.php');
        ?>
        <span style="top: 0; right: 0; float: right; position: absolute; padding: 8px"><b id="acceso" ></b><a id="usuario" href='#'>Usuario</a></span>
        </br>
        
        <div id="imgperfil" style="float: right;">
            <?php
            if (isset($_SESSION['usuario'])) {
            //$extension = strtolower(substr($_SESSION["nombreimg"], strpos($_SESSION["nombreimg"], '.') + 1));
            echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';
            //echo '<img src="data:image/'.$extension.';base64,'.base64_encode($_SESSION['imagendeperfil']).'" width="100"/>';
            } else {
            }
            
            ?>
        </div>
        <span style="float: right; right: 0; padding: 0px; padding-top: 15px; clear: both;">
            <a href='cerrarsesion.php' title='Cerrar sesión' id="salir" style="right: 0px">Salir</a></span>
            <?php
                include('conexion.php');
                $consulta = mysqli_query($connect, "SELECT * FROM posts WHERE titulo LIKE '".$_GET['post']."';");
                $post = mysqli_fetch_assoc($consulta);
                $video = substr($post['video'], strpos($post['video'], "=") + 1);
            ?>
            <h1><?php echo utf8_decode($post['titulo']); ?></h1>
            <label><?php echo utf8_decode($post['contenido'])."<br>"; ?></label>
            <?php
                echo '<img src="data:image/jpeg;base64,'.base64_encode($post['imagen']).'" width="300"/><br>';
            ?>
            <iframe type="text/html" width="420" height="315"
            src="https://www.youtube.com/embed/<?php echo $video;?>" frameborder="0" allowfullscreen></iframe><br>
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

                $id = mysqli_query($connect, "SELECT count(id_voto) FROM votos WHERE id_usuario='".$idusu[0]."';");
                $idxpost = mysqli_fetch_array($id);

                if($_POST['puntos'] >= 1){

                    if (count($idusu[0])==1 && $idxpost[0]==0) {
                        mysqli_query($connect, "INSERT INTO votos (id_voto, valor, id_usuario, id_post) VALUES (NULL,'".$_POST['puntos']."', '".$idusu[0]."', '".$post['id_post']."');");
                            echo "<br>".count($idusu[0]);

                    } elseif ($idxpost[0]>=1) {
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
            <script type="text/javascript">
            document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
            document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['usuario']." "; echo $_SESSION['imagenperfil']; ?>';
            </script>   
        </body>
    </html>