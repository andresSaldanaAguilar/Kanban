<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link href='Estilo.css' rel='stylesheet' type='text/css' />
		<script type='text/javascript' src='GenScript.js' ></script>
		<script type='text/javascript' src='Tarea.js' ></script>
	</head>
	<?php
        if(isset($_SESSION["idUsuario"]) && isset($_SESSION["idPortafolio"]) && isset($_SESSION["idTablero"])){
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

				if (mysqli_num_rows($consulRes) != 1)
					echo "<script type='text/javascript'>alert('No eres administrador del portafolio'); document.location='Tablero.php'</script>";							
				else{
					$inPortafolio = mysqli_fetch_assoc($consulRes);
					
					$consulQuery = "select * from tablero where idTablero='" . $_SESSION['idTablero'] . "' and idPortafolio='" . $inPortafolio['idPortafolio'] . "';";
					$consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());

					if (mysqli_num_rows($consulRes) != 1)
						echo "<script type='text/javascript'>alert('Tablero no encontrado'); document.location='MenuTablero.php'</script>";							
					else{
						$inTablero = mysqli_fetch_assoc($consulRes);
						
						if($_SERVER["REQUEST_METHOD"] == "POST"){
							$entradaValida = True;
							$idTarea = $gestion = "";
			
							if(empty($_POST["gestion"]))
								$entradaValida = False;
							else
								$gestion = test_input($_POST["gestion"]);

							if($gestion != "alta" && $gestion != "gestion")
								$entradaValida = False;

							if($entradaValida){
								$_SESSION["gestion"] = $gestion;
								
								if($gestion == "gestion"){
									if(empty($_POST["idTarea"]))
										echo "<script type='text/javascript'>alert('Entrada invalida'); document.location='Tablero.php';</script>";
									else{
										$idTarea = test_input($_POST["idTarea"]);
										$consulQuery = "select * from tarea where idTarea='" . $idTarea . "' and idTablero='" . $inTablero['idTablero'] . "';";
										$consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
									
										if (mysqli_num_rows($consulRes) == 1){
											$inTarea = mysqli_fetch_assoc($consulRes);
											$_SESSION["idTarea"] = $inTarea["idTarea"];
										}
										else
											echo "<script type='text/javascript'>alert('Tarea no encontrada'); document.location='Tablero.php';</script>";
									}
								}
							}
							else
								echo "<script type='text/javascript'>alert('Entrada invalida $gestion'); document.location='Tablero.php';</script>";
						}
						else if(isset($_SESSION["idTarea"])&& isset($_SESSION["gestion"])){
							$consulQuery = "select * from tarea where idTarea='" . $_SESSION['idTarea'] . "' and idTablero='" . $inTablero['idTablero'] . "';";
							$consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
						
							if (mysqli_num_rows($consulRes) == 1)
								$inTarea = mysqli_fetch_assoc($consulRes);
							else
								echo "<script type='text/javascript'>alert('Tarea no encontrada'); document.location='Tablero.php';</script>";
						}
						else
							echo "<script type='text/javascript'>document.location='Tablero.php';</script>";
					}
				}
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
			<div class='menuTitle'><b>Tarea</b></div>
			<p class='menuSub'><?php echo (isset($inTarea) ? $inTarea["Titulo"] : "Nueva Tarea") ?>.</p>
			<form action='Salir.php' method='post'>
				<input class='boton' type='submit' value='Salir'/>
				<input class='boton' type='submit' formaction='Tablero.php' formmethod='get' value='Regresar'/>
			</form>
		</div>
		
		<div id='gestion1' class='contenido' style=' font-family: sans-serif; font-size: 20px;'>
			
			<?php
				if(isset($_SESSION["gestion"])){
					$conexion = getConnection();
					
					echo "<form action='GestionTarea.php' method='post'>";
					
					if($_SESSION["gestion"] == "alta"){
						echo "<div id='titulo' class='menuTitle' style='width: 190px'><b> Nueva Tarea </b></div>";
						
						echo "<input name='Titulo' class='texto' type='text' placeholder='Título' style=' height: 30px; position:absolute; top: 80px; left: 120px;' required='required' oncopy='return false' onpaste='return false'/>";
						echo "<input name='Tipo' class='texto' type='text' placeholder='Tipo' style=' height: 30px; position:absolute; top: 130px; left: 120px;' required='required' oncopy='return false' onpaste='return false'  />";
						echo "<input name='Estado' class='texto' type='text' placeholder='Estado' style=' height: 30px; position:absolute; top: 180px; left: 120px;' required='required' oncopy='return false' onpaste='return false' />";
						echo "<span style=' height: 30px; position:absolute; top: 240px; left: 120px;'>Progreso</span>";
						echo "<input type='number' name='Progreso' min='0' max='100' value='0' style=' height: 30px; position:absolute; top: 230px; left: 220px;'/>";    
						echo "<span style=' height: 30px; position:absolute; top: 240px; left: 320px;'>Valor de Negocios</span>";
						echo "<input type='number' name='ValorNegocios' min='1' max='10' value='1' style=' height: 30px; position:absolute; top: 230px; left: 500px;'/>"; 
						echo "<span style=' height: 30px; position:absolute; top: 240px; left: 600px;'>Prioridad</span>";
						echo "<input type='number' name='Prioridad' min='1' max='5' value='1' style=' height: 30px; position:absolute; top: 230px; left: 700px;'/>";						
						echo "<span style=' height: 30px; position:absolute; top: 300px; left: 120px;'>Swag</span>";
						echo "<textarea rows='6' cols='70' name='Swag'  placeholder='Swag' style=' position:absolute; top: 350px; left: 120px;' required='required' oncopy='return false' onpaste='return false' ></textarea>";
						echo "<span style=' height: 30px; position:absolute; top: 480px; left: 120px;'>Usuario Responsable</span>";

						echo "<div class='userMod'>";
						echo "<input type='hidden' name='idUsuario' />";
						echo "<span id='modClose' class='modalGenClose'>&times</span>";

						echo "</div>";

						//echo "<input name='idUsuario' class='texto' type='text' placeholder='Usuario' style=' height: 30px; position:absolute; top: 470px; left: 320px;' required='required' oncopy='return false' onpaste='return false' />";
						echo "<input type='hidden' name='gestion' value='alta' >";
						
						echo "<input id='boton' class='boton2' type='submit' value='Guardar'/>";
						echo "</form>";
					}
					else{
						echo "<div id='titulo' class='menuTitle' style='width: 190px'><b> Tarea </b></div>";
						echo "<input name='Titulo' class='texto' type='text' placeholder='Título' style=' height: 30px; position:absolute; top: 80px; left: 120px;' required='required' oncopy='return false' onpaste='return false' value='".$inTarea["Titulo"]."'/>";
						echo "<input name='Tipo' class='texto' type='text' placeholder='Tipo' style=' height: 30px; position:absolute; top: 130px; left: 120px;' required='required' oncopy='return false' onpaste='return false' value='".$inTarea["TipoTarea"]."'/>";
						echo "<input name='Estado' class='texto' type='text' placeholder='Estado' style=' height: 30px; position:absolute; top: 180px; left: 120px;' required='required' oncopy='return false' onpaste='return false' value='".$inTarea["Estado"]."'/>";
						echo "<span style=' height: 30px; position:absolute; top: 240px; left: 120px;'>Progreso</span>";
						echo "<input type='number' name='Progreso' min='0' max='100'  style=' height: 30px; position:absolute; top: 230px; left: 220px;' value='".$inTarea["Progreso"]."'/>";    
						echo "<span style=' height: 30px; position:absolute; top: 240px; left: 320px;'>Valor de Negocios</span>";
						echo "<input type='number' name='ValorNegocios' min='1' max='10'  style=' height: 30px; position:absolute; top: 230px; left: 500px;'  value='".$inTarea["ValorNegocios"]."'/>";  
						echo "<span style=' height: 30px; position:absolute; top: 240px; left: 600px;'>Prioridad</span>";
						echo "<input type='number' name='Prioridad' min='1' max='5'  style=' height: 30px; position:absolute; top: 230px; left: 700px;' value='".$inTarea["Prioridad"]."'/>";  
						echo "<span style=' height: 30px; position:absolute; top: 300px; left: 120px;'>Swag</span>";
						echo "<textarea rows='6' cols='70' name='Swag'  placeholder='Swag' style=' position:absolute; top: 350px; left: 120px;' required='required' oncopy='return false' onpaste='return false' >".$inTarea["Swag"]."</textarea>";
						echo "<span style=' height: 30px; position:absolute; top: 300px; left: 700px;'>Bloqueo</span>";
						echo "<textarea rows='6' cols='40' name='Bloqueo'  placeholder='Bloqueo' style=' position:absolute; top: 350px; left: 700px;'  oncopy='return false' onpaste='return false' >".$inTarea["Bloqueo"]."</textarea>";
						echo "<span style=' height: 30px; position:absolute; top: 480px; left: 120px;'>Usuario Responsable</span>";

						$consulQuery = "select * from usuario where idUsuario='" . $inTarea["idUsuario"] . "';";
						$consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
					
						$inUserTar = mysqli_fetch_assoc($consulRes);

						echo "<div class='userMod'>";
						echo "<div>" . $inUserTar['userName'] . " (" . $inUserTar['Nombre']." " . $inUserTar['ApPaterno']." ". $inUserTar['ApMaterno'].")</div>";
						echo "<input type='hidden' name='idUsuario' value='" . $inUserTar['idUsuario'] . "' />";
						echo "<span id='modClose' class='modalGenClose'>&times</span>";

						echo "</div>";						
						
						echo "<input type='hidden' name='gestion' value='cambio' >";
						echo "<input type='hidden' name='idTarea' value=".$inTarea["idTarea"].">";
						echo "<input type='hidden' name='idColumna' value=".$inTarea["idColumna"].">";
						echo "<input id='boton' class='boton2' type='submit' value='Guardar'/>";
						echo "</form>";
						
						echo "<form id='borrar' name='borrar' action='GestionTarea.php' method='post'>";
						echo "<input type='hidden' name='gestion' value='baja' >";
						echo "<input type='hidden' name='idTarea' value=".$inTarea["idTarea"].">";
						echo "<input type='hidden' id='block' name='block' value=".$inTarea["Bloqueo"].">";
						echo "</form>";
						echo "<input type='image'  src='Imagen/trash.png' width='80px' height='80px' style='  position: absolute; top: 0px; left:90%; ' onclick='validar(this)' />";
					}
				
					echo "<form action='Tablero.php' method='post'>";
					echo "<input type='hidden' name='idTablero' value=".$_SESSION["idTablero"].">";
					echo "<input type='submit' class='boton' style=' position: absolute; top: 0px; left:60%; width:150px' value='Regresar'/>";
					echo "</form>";
				}
			?>
		</div>
		
		<script type='text/javascript'>addEventUserMod('<?php (isset(($_SESSION["gestion"])) && $_SESSION["gestion"] != "alta") ? $inPortafolio['idPortafolio'] : "" ?>');</script>
	</body>
</html>