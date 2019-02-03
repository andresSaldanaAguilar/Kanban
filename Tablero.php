<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link href='Estilo.css' rel='stylesheet' type='text/css' />
		<link href="FrameWorkInteract\estilos.css" rel="stylesheet"></link>
		<script src="GenScript.js"></script>
		<script src="FrameWorkInteract\interact.js"></script>
		<script src="FrameWorkInteract\principal.js"></script>
	</head>
	
	<?php
        if(isset($_SESSION["idUsuario"]) && isset($_SESSION["idPortafolio"])){
            include 'connection.php';
            $conexion = getConnection();
    
            $consulQuery = "select * from usuario where idUsuario='" . $_SESSION["idUsuario"] . "';";
            $consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
        
            if (mysqli_num_rows($consulRes) != 1)
                echo "<script type='text/javascript'>alert('Usuario no encontrado'); document.location='index.php';</script>";
            else{
                $inUser = mysqli_fetch_assoc($consulRes);
    
				$consulQuery = "select * from portafolio where idUsuario='" . $inUser["idUsuario"] . "' and idPortafolio='" . $_SESSION['idPortafolio'] . "';";
				$consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());

				if (mysqli_num_rows($consulRes) == 1){
					$inPortafolio = mysqli_fetch_assoc($consulRes);
					$isAdmin = True;
				}
				else{
					$consulQuery = "select p.* from portafolio p, miembrouserport x where p.idPortafolio=x.idPortafolio and x.idUsuario='" . $inUser["idUsuario"] . "' and p.idPortafolio='" . $_SESSION['idPortafolio'] . "';";
					$consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());

					if (mysqli_num_rows($consulRes) == 1){
						$inPortafolio = mysqli_fetch_assoc($consulRes);
						$isAdmin = False;
					}
				}

				if(isset($inPortafolio)){
					if($_SERVER["REQUEST_METHOD"] == "POST"){
						$entradaValida = True;
						$idTablero = "";
		
						if(empty($_POST["idTablero"]))
							$entradaValida = False;
						else
							$idTablero = test_input($_POST["idTablero"]);
		
						if($entradaValida){
							$consulQuery = "select * from tablero where idTablero='" . $idTablero . "' and idPortafolio='" . $inPortafolio['idPortafolio'] . "';";
							$consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
		
							if (mysqli_num_rows($consulRes) == 1){
								$inTablero = mysqli_fetch_assoc($consulRes);
								$_SESSION["idTablero"] = $inTablero["idTablero"];
							}
							else
								echo "<script type='text/javascript'>alert('Tablero no encontrado'); document.location='MenuTablero.php'</script>";							
						}
						else
							echo "<script type='text/javascript'>alert('Entrada invalida'); document.location='MenuTablero.php';</script>";
					}
					else if(isset($_SESSION["idTablero"])){
						$consulQuery = "select * from tablero where idTablero='" . $_SESSION['idTablero'] . "' and idPortafolio='" . $inPortafolio['idPortafolio'] . "';";
						$consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
					
						if (mysqli_num_rows($consulRes) == 1)
							$inTablero = mysqli_fetch_assoc($consulRes);
						else
							echo "<script type='text/javascript'>alert('Tablero no encontrado'); document.location='MenuTablero.php';</script>";
					}
					else
						echo "<script type='text/javascript'>document.location='MenuTablero.php';</script>";
				}
				else
					echo "<script type='text/javascript'>document.location='Inicio.php';</script>";
			}
            mysqli_close($conexion);
        }
        else
            echo "<script type='text/javascript'>document.location='index.php'</script>";

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>	
	
	<body>
        <div id='RelojDiv'>
			<div id='Reloj'></div>
		</div>
		
		<div class='Menu'>
			<div class='menuTitle'><b>Tablero</b></div>
			<p class='menuSub'><?php echo (isset($inTablero) ? $inTablero["Nombre"] : "") . ($isAdmin  ? " (Admin)" : "") ?>.</p>
			<form id='Envio2' name='Envio2' action='Control.php' method='post'>
				<input class='boton' type='button' name='bsalir' value='Salir' onclick='guardar(this)' />
				<input class='boton' type='button' name='b2' value='Regresar' onclick='guardar(this)' />
			</form>
		</div>
		
		<input id='Busqueda' name='Busqueda' class='texto' type='text' placeholder='Buscar Tarea' style=' position: absolute; top: 2.5%; left:20%; width:600px;' onKeyup='makeRequest()'/>
			
			
		<div class="Tablero" >
		
			<div class='menuTitle' id='titulo' style='width: 300px'><b> Tablero </b></div>
		
		
			<?php
				if($isAdmin){
					echo "<form id='Envio1' name='Envio1' action='Control.php' method='post'>";
					echo "<input type='button' name='b1' class='boton' style=' position: absolute; top: 0px; left:60%; width:250px' value='Agregar Tarea' onclick='verificar(this)' />";
					echo "</form>";
				}
			?>
		
			<div id="grid">
				<?php
					if(isset($inTablero)){
						$conexion = getConnection();
						
						$consulQuery = "select c.Nombre , c.NumColumna , c.LimitesWIP , c.idColumna from columna as c , tablero as t where c.idTablero=t.idTablero and t.idTablero=".$_SESSION["idTablero"].";";
						$consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
						
						while( $fila = mysqli_fetch_array($consulRes) )
						{
							$pos = (($fila["NumColumna"] - 1)* 400 )+ 100;
							$val = $fila["NumColumna"] % 10;
							
							if( $fila["NumColumna"] == 1)
								$_SESSION["Columna"] = $fila["idColumna"];
							
							
							if( $val == 1) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(242, 173, 84,1); ' limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 2) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(90, 196, 125,1); ' limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 3) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(210, 81, 95,1); '  limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 4) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(54, 133, 187,1); ' limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 5) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(152, 101, 213,1);' limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 6) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(196, 196, 196,1);' limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 7) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(55, 124, 80,1); '  limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 8) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(98, 155, 244,1); ' limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 9) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba(231, 222, 41,1); ' limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							if( $val == 0) 
								echo "<div id='columna' class='columna' style='  position: absolute; left: ".$pos."px; background-color: rgba( 0, 0, 0,1); '     limite='".$fila["LimitesWIP"]."' idColumna='".$fila["idColumna"]."' >";
							
								echo "</br>";
								echo "<center><b>".$fila["Nombre"]."</b></center>";
							echo "</div>";
						}
						
						$consulQuery = "select * from tarea as tar , tablero as tab , usuario as user where tar.idTablero=tab.idTablero and tar.idTablero=".$_SESSION["idTablero"]." and tar.idUsuario=user.idUsuario order by idTarea;";
						$consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
						$contador = 0;
						
						while( $fila = mysqli_fetch_array($consulRes) )
						{
							if( $fila["Bloqueo"] != "" )
							{
								$com = 1;
							}
							else
							{
								$com = 0;
							}
							echo "<div class='draggable' onmouseover='positionIn(this)' onmouseout='positionOut(this)' onclick='acomodar(this)' idTarea='".$fila["idTarea"]."' idColumna='".$fila["idColumna"]."' Prioridad='".$fila["Prioridad"]."' Valor='".$fila["ValorNegocios"]."' Progreso='".$fila["Progreso"]."' Usuario='".$fila["userName"]."' Bloqueo='".$com."'>";
								echo "<span class='tooltip' style='visibility: hidden;'>(0,0)</span>";
								echo "&nbsp;&nbsp;<b>".$fila["Titulo"]."</b>     <span style=' font-size:10px ' >".$fila["userName"]."</span>";
								echo "<br/>&nbsp;&nbsp;".$fila["Estado"]."";
								echo "<form id='Envio3".$contador."' name='Envio3".$contador."' action='Control.php' method='post'>";
								echo "<input type='hidden' name='idTarea' value=".$fila["idTarea"]." />";
								echo "</form>";
								//Prioridad
								if( $fila["Prioridad"] == "1" || $fila["Prioridad"] == "2" )
									echo "<input type='image'  src='Imagen/low.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 10px; '/>";
								if( $fila["Prioridad"] == "3" )
									echo "<input type='image'  src='Imagen/medium.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 10px; '/>";
								if( $fila["Prioridad"] == "4" || $fila["Prioridad"] == "5" )
									echo "<input type='image'  src='Imagen/high.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 10px; '/>";
								
								//Valor
								if( $fila["ValorNegocios"] == "1" || $fila["ValorNegocios"] == "2" || $fila["ValorNegocios"] == "3" )
									echo "<input type='image'  src='Imagen/lowd.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 40px; '/>";
								if( $fila["ValorNegocios"] == "4" || $fila["ValorNegocios"] == "5" || $fila["ValorNegocios"] == "6" || $fila["ValorNegocios"] == "7" )
									echo "<input type='image'  src='Imagen/mediumd.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 40px; '/>";
								if( $fila["ValorNegocios"] == "8" || $fila["ValorNegocios"] == "9" || $fila["ValorNegocios"] == "10" )
									echo "<input type='image'  src='Imagen/highd.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 40px; ' />";
								
								//Terminado
								if( $fila["Progreso"] == "100" )
									echo "<input type='image'  src='Imagen/success.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 70px; ' />";
								
								//Bloqueo
								if( $fila["Bloqueo"] != "" )
									echo "<input type='image'  src='Imagen/block.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 100px; ' />";
								
								echo "<input type='image'  src='Imagen/plus.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 220px; ' />";
								
								echo "<input type='image' class='expand' name='b3' value='".$contador."' src='Imagen/plus.png' width='20px' height='20px' style='  position: absolute; top: 50px; left: 220px;' onclick='guardar(this)' />";
								
							echo "</div>";
							$contador++;
							
						}
					}
				?>
			</div>
			
			<input type='image' id='res' name='res' src='Imagen/return.png' width='80px' height='60px' style='  position: absolute; top: 90%; left: 5%; ' onclick='filtro(this)'/>
		
			<input type='image' id='pri' name='pri' src='Imagen/high.png' width='60px' height='60px' style='  position: absolute; top: 90%; left: 15%; '  onclick='filtro(this)'/>
			
			<input type='image' id='val' name='val' src='Imagen/highd.png' width='60px' height='60px' style='  position: absolute; top: 90%; left: 25%; '  onclick='filtro(this)'/>
			
			<input type='image' id='suc' name='suc' src='Imagen/success.png' width='60px' height='60px' style='  position: absolute; top: 90%; left: 35%; ' onclick='filtro(this)'/>
	
		</div>
			
			
		
		</body>
</html>