<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <link href="Estilo.css" rel="stylesheet" type="text/css" />
    </head>
	<body>
		<?php
			
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["idUsuario"])){
                include 'connection.php';
                $conexion = getConnection();
        
                $consulQuery = "select * from usuario where idUsuario='" . $_SESSION["idUsuario"] . "';";
                $consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
            
                if (mysqli_num_rows($consulRes) != 1)
                    echo "<script type='text/javascript'>alert('Usuario no encontrado'); document.location='index.php';</script>";
                else{
                    $inUser = mysqli_fetch_assoc($consulRes);

                    $entradaValida = True;
                    $nomProy = $swag = "";
    
                    if(empty($_POST["nomProy"]))
                        $entradaValida = False;
                    else
                        $nomProy = test_input($_POST["nomProy"]);
                        
                    $swag = test_input($_POST["swag"]);
    
                    if($entradaValida){
                        $consulQuery = "select * from portafolio where idUsuario='" . $inUser["idUsuario"] . "' and Portafolio='" . $nomProy . "';";
                        $consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
    
                        if (mysqli_num_rows($consulRes) > 0)
                            echo "<script type='text/javascript'>alert('Portafolio ya existente'); document.location='Inicio.php'</script>";
                        else{
                            $execQuery = "insert into portafolio (Portafolio, Estado, FechaCreacion, Swag, idUsuario) values('" . $nomProy . "', 1, '" . date("Y-m-d") . "', '" . $swag . "', '" . $inUser["idUsuario"] . "')";
                            $execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
                            
                            echo "<script type='text/javascript'>alert('Portafolio creado exitosamente'); document.location='Inicio.php';</script>";
                        }
                    }
                    else
                        echo "<script type='text/javascript'>alert('Entrada invalida'); document.location='Inicio.php';</script>";

                }
                mysqli_close($conexion);
            }
            else
                echo "<script type='text/javascript'>document.location='Inicio.php'</script>";

			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
	</body>
</html>