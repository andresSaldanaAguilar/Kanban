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
                        $nomTab = "";
                        $nomCols = [];
                        $wipCols = [];
        
                        if(empty($_POST["nomTab"]))
                            $entradaValida = False;
                        else
                            $nomTab = test_input($_POST["nomTab"]);
        
                        if(empty($_POST["nomCols"]))
                            $entradaValida = False;
                        else{
                            $nomCols = $_POST["nomCols"];
                            if(count($nomCols) < 2)
                                $entradaValida = False;
                            else{
                                for($i = 0; $i < count($nomCols); $i++){
                                    if(empty($nomCols[$i])){
                                        $entradaValida = False;
                                        break;
                                    }
                                    else
                                        $nomCols[$i] = test_input($nomCols[$i]);
                                }
                            }
                        }
        
                        if(empty($_POST["wipCols"]))
                            $entradaValida = False;
                        else{
                            $wipCols = $_POST["wipCols"];
                            if(count($wipCols) < 2)
                                $entradaValida = False;
                            else{
                                for($i = 0; $i < count($wipCols); $i++){
                                    if(empty($wipCols[$i]) || !ctype_digit($wipCols[$i]) || ((int)$wipCols[$i]) < 1){
                                        $entradaValida = False;
                                        break;
                                    }
                                }
                            }
                        }
        
                        if($entradaValida && count($nomCols) == count($wipCols)){
                            $consulQuery = "select * from tablero where idPortafolio='" . $inPortafolio["idPortafolio"] . "' and Nombre='" . $nomTab . "';";
                            $consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
        
                            if (mysqli_num_rows($consulRes) > 0)
                                echo "<script type='text/javascript'>alert('Tablero ya existente'); document.location='Inicio.php'</script>";
                            else{
                                $execQuery = "insert into tablero (Nombre, idPortafolio) values('" . $nomTab . "', '" . $inPortafolio["idPortafolio"] . "')";
                                $execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
                                
                                $consulQuery = "select * from tablero where idPortafolio='" . $inPortafolio["idPortafolio"] . "' and Nombre='" . $nomTab . "';";
                                $consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
                                
                                $inTablero = mysqli_fetch_assoc($consulRes);

                                for($i = 0; $i < count($nomCols); $i++){
                                    $execQuery = "insert into columna (Nombre, NumColumna, LimitesWIP, idTablero) values('" . $nomCols[$i] . "', '" . ($i + 1) . "', '" . $wipCols[$i] . "', '" . $inTablero["idTablero"] . "')";
                                    $execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
                                }

                                echo "<script type='text/javascript'>alert('Tablero creado exitosamente'); document.location='MenuTablero.php';</script>";
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