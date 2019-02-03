<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <link href="Estilo.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="GenScript.js" ></script>
        <script type="text/javascript">
            window.onload = function(){
                parallax();
            };
        </script>
    </head>
    <body>
        <div class="Principal" >
            
            <div class="menuTitle" style="width: 200px"><b>Proyecto ISW</b></div>
            
            <div id="caja">
                <center>
                    <img width=192 height=192 alt="img" src="./Imagen/login3.jpg" ID="imagen" style="border-radius: 50%; max-width: 70%; max-height: 70%;" >
                </center>
                
                <form action="Inicio.php" method="post">
                    <input name="user" id="Usuario" class="texto" type="text" required="required" placeholder="Usuario" style=" height: 30px; position:absolute; top: 250px; left: 40px;" oncopy="return false" onpaste="return false"/>
                    <input name="cont" id="Contrasena" class="texto" type="password" required="required" placeholder="Contraseña" style=" height: 30px; position:absolute; top: 290px; left: 40px;" oncopy="return false" onpaste="return false"/>

                    <input class="boton2" type="submit" value="Iniciar"/>
                </form>
            </div>
            
            <form action="Registro.php">
                <input class="boton" id="btnReg" type="submit" value="Registro"/>
            </form>
        </div>
    </body>
</html>
