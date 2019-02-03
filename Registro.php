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
            
            <div id="loginTitulo" style="width: 100px"><b>Registro</b></div>
            
            <center>
                <div id="caja2">
                    <b>Registro</b>
                    
                    <form action="Altas.php" method="post">
                        <input name="nombre" class="texto" type="text" placeholder="Nombre(s)" style=" height: 30px; position:absolute; top: 80px; left: 120px;" required="required" oncopy="return false" onpaste="return false"/>
                        <input name="apPat" class="texto" type="text" placeholder="Apellido Paterno" style=" height: 30px; position:absolute; top: 120px; left: 120px;" required="required" oncopy="return false" onpaste="return false"/>
						<input name="apMat" class="texto" type="text" placeholder="Apellido Materno" style=" height: 30px; position:absolute; top: 160px; left: 120px;" required="required" oncopy="return false" onpaste="return false"/>
                        <input name="user" class="texto" type="text" placeholder="Usuario" style=" height: 30px; position:absolute; top: 200px; left: 120px;" required="required" oncopy="return false" onpaste="return false"/>
                        <input name="email" id='correo' class="texto" type="email" placeholder="Correo Electronico" style=" height: 30px; position:absolute; top: 240px; left: 120px;" required="required" oncopy="return false" onpaste="return false"/>
                        <input name="cont" class="texto" type="password" placeholder="Contraseña" style=" height: 30px; position:absolute; top: 280px; left: 120px;" required="required" oncopy="return false" onpaste="return false"/>
						<input name="boton2" class="boton2" type="submit" value="Registrar"/>
                    </form>
                </div>
            </center>
            
            <form action="index.php">
                <input class="boton" id="btnReg" type="submit" value="Regresar"/>
            </form>
        </div>  
    </body>
</html>
