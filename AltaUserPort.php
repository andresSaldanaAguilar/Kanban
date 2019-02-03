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
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["idUsuario"]) && isset($_SESSION["idPortafolio"])){
                include 'connection.php';
                $conexion = getConnection();
        
                $consulQuery = "select * from usuario where idUsuario='" . $_SESSION["idUsuario"] . "';";
                $consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
            
                if (mysqli_num_rows($consulRes) != 1)
                    echo "<script type='text/javascript'>alert('Usuario no encontrado'); document.location='index.php';</script>";
                else{
                    $inUser = mysqli_fetch_assoc($consulRes);

                    $consulQuery = "select * from portafolio where idUsuario='" . $inUser["idUsuario"] . "' and idPortafolio='" . $_SESSION["idPortafolio"] . "';";
                    $consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");

                    if (mysqli_num_rows($consulRes) != 1)
                        echo "<script type='text/javascript'>alert('Portafolio no encontrado'); document.location='Inicio.php';</script>";
                    else{
                        $inPortafolio = mysqli_fetch_assoc($consulRes);

                        $entradaValida = True;
                        $idNewUser = "";
        
                        if(empty($_POST["idUsuario"]))
                            $entradaValida = False;
                        else
                            $idNewUser = test_input($_POST["idUsuario"]);


                        if($idNewUser == $inUser['idUsuario'])
                            echo "<script type='text/javascript'>alert('Ya eres parte del portafolio'); document.location='MenuTablero.php'</script>";
                        else if($entradaValida){
                            $consulQuery = "select * from usuario where idUsuario='" . $idNewUser . "';";
                            $consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
        
                            if (mysqli_num_rows($consulRes) != 1)
                                echo "<script type='text/javascript'>alert('Usuario a agregar no existente'); document.location='MenuTablero.php'</script>";
                            else{
                                $consulQuery = "select * from miembrouserport where idUsuario='" . $idNewUser . "' and idPortafolio='" . $inPortafolio['idPortafolio'] . "';";
                                $consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
            
                                if (mysqli_num_rows($consulRes) > 0)
                                    echo "<script type='text/javascript'>alert('Usuario a agregar ya existente'); document.location='MenuTablero.php'</script>";
                                else{
                                    $execQuery = "insert into miembrouserport (idUsuario, idPortafolio) values('" . $idNewUser . "', '" . $inPortafolio["idPortafolio"] . "')";
                                    $execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
                                    
                                    echo "<script type='text/javascript'>alert('Usuario agregado exitosamente'); document.location='MenuTablero.php';</script>";
                                }
                            }
                        }
                        else
                            echo "<script type='text/javascript'>alert('Entrada invalida'); document.location='MenuTablero.php';</script>";
                    }
                }
                mysqli_close($conexion);
            }
            else
                echo "<script type='text/javascript'>document.location='MenuTablero.php'</script>";

			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
	</body>
</html>