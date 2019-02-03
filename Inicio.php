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
		<script type="text/javascript" src="GenScript.js" ></script>
		<script type="text/javascript" src="Inicio.js" ></script>
    </head>
	
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$entradaValida = True;
			$user = $cont = "";

			if(empty($_POST["user"]))
				$entradaValida = False;
			else
				$user = test_input($_POST["user"]);

			if(empty($_POST["cont"]))
				$entradaValida = False;
			else
				$cont = test_input($_POST["cont"]);

		
			if($entradaValida){
				include 'connection.php';
				$conexion = getConnection();

				$consulQuery = "select * from usuario where (userName='$user' and Contrasena='$cont') or (Correo='$user' and Contrasena='$cont');";
				$consulRes = mysqli_query($conexion,$consulQuery) or die ("Error en la consulta");
			
				if (mysqli_num_rows($consulRes) != 1)
					echo "<script type='text/javascript'>alert('Usuario no encontrado'); document.location='index.php';</script>";
				else{
					$inUser = mysqli_fetch_assoc($consulRes);
					$_SESSION["idUsuario"] = $inUser["idUsuario"];
				}

				mysqli_close($conexion);
			}
			else
				echo "<script type='text/javascript'>alert('Entrada invalida'); document.location='index.php';</script>";
		}
		else if(isset($_SESSION["idUsuario"])){
			include 'connection.php';
			$conexion = getConnection();

			$consulQuery = "select * from usuario where idUsuario='" . $_SESSION["idUsuario"] . "';";
			$consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
		
			if (mysqli_num_rows($consulRes) != 1)
				echo "<script type='text/javascript'>alert('Usuario no encontrado'); document.location='index.php';</script>";
			else
				$inUser = mysqli_fetch_assoc($consulRes);

			mysqli_close($conexion);
		}
		else
			echo "<script type='text/javascript'>document.location='index.php';</script>";

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
        <!--<input id='Busqueda' name='Busqueda' class='texto' type='text' placeholder='Buscar Usuario' style='position: absolute; left:900px; width:600px;' onKeyup='makeRequest()'/>-->
        
        <div class='Menu'>
			<div class='menuTitle'><b>Menú Principal</b></div>
			<p class='menuSub'><?php echo "" . (isset($inUser) ? "Bienvenido, " . $inUser["Nombre"] . " " . $inUser["ApPaterno"] . " " . $inUser["ApMaterno"] : ""); ?>.</p>
			<form action='Salir.php' method='post'>
				<input class='boton' type='submit' value='Salir'/>
			</form>
        </div>
        
        
        <div id='gestion1' class='contenido'>
			<div id='border' name='border' class='border' style='position:relative; margin: 30px auto; left:100px; width:80%;'>
			
				<table id='tabla' name='tabla' width='100%' id='tabla'>
					<tr>
					<td colspan='5' class='Titulo'>
					<center><b>Gestión de Portafolios</b></center>
					</td>
					</tr>
					<tr>
					<th width='20%' class='Titulo'>
					Nombre
					</th>
					<th width='20%' class='Titulo'>
					Fecha de creación
					</th>
					<th width='20%' class='Titulo'>
					Estado
					</th>
					<th width='20%' class='Titulo'>
					Swag
					</th>
					<th width='20%' class='Titulo'>
					Expandir
					</th>
					</tr>
					<?php
						if(isset($inUser)){
							$conexion = getConnection();
							
							$consulQuery = "select p.* from usuario u, portafolio p where u.idUsuario=p.idUsuario and u.idUsuario=" . $inUser["idUsuario"] . ";";
							$consulRes = mysqli_query($conexion,$consulQuery) or die ("Error en la consulta");
						
							while( $fila = mysqli_fetch_array($consulRes) )
							{
								echo "<tr>";
								echo "<td>";
								echo $fila['Portafolio'];
								echo "</td>";
								
								echo "<td>";    
								echo $fila['FechaCreacion'];
								echo "</td>";
	
								echo "<td>";    
								echo ($fila['Estado'] == '1') ? "Activo" : "Finalizado";
								echo "</td>";
	
								echo "<td>";    
								echo $fila['Swag'];
								echo "</td>";
	
								echo "<td>";
								echo "<form action='MenuTablero.php' method='post'>";
								echo "<input type='hidden' name='idPortafolio' value='" . $fila["idPortafolio"] . "' />";
								echo "<center><input type='image'  src='Imagen/folderview.png' width='30px' height='30px'></center>";
								echo "</form>";
								echo "</td>";
							}
							
							$consulQuery = "select p.* from usuario u, portafolio p, miembrouserport x where u.idUsuario=x.idUsuario and p.idPortafolio=x.idPortafolio and u.idUsuario=" . $inUser["idUsuario"] . ";";
							$consulRes = mysqli_query($conexion,$consulQuery) or die ("Error en la consulta");
						
							while( $fila = mysqli_fetch_array($consulRes) )
							{
								echo "</tr>";

								echo "<td>";
								echo $fila['Portafolio'];
								echo "</td>";
								
								echo "<td>";    
								echo $fila['FechaCreacion'];
								echo "</td>";
	
								echo "<td>";    
								echo ($fila['Estado'] == '1') ? "Activo" : "Finalizado";
								echo "</td>";
	
								echo "<td>";    
								echo $fila['Swag'];
								echo "</td>";
	
								echo "<td>";
								echo "<form action='MenuTablero.php' method='post'>";
								echo "<input type='hidden' name='idPortafolio' value='" . $fila["idPortafolio"] . "' />";
								echo "<center><input type='image' src='Imagen/folderview.png' width='30px' height='30px' /></center>";
								echo "</form>";
								echo "</td>";

								echo "</tr>";
							}
							mysqli_close($conexion);
						}
					?>
				</table>
				<center><input type='image' id='crearPortBtn' src='Imagen/folderadd.png' width='40px' height='40px'></center>
			</div>     
		</div>

		<div id="portModal" class="modal">
			<div class="modalCont">
				<div class="modalHeader">
					<span id="portModalClose" class="modalClose">&times;</span>
					<h3>Nuevo Portafolio</h3>
				</div>
				<form action="AltaPort.php" method="post">
					<div class="modalBody">
						<br/>
						<input type="text" class="modalField" name="nomProy" required="required" placeholder="Nombre del Proyecto" />
						<br/>
						<textarea rows="4" class="modalField modalArea" name="swag" placeholder="Swag"></textarea>
						<br/>
					</div>
					<div class="modalFooter">
						<input class="modalButton" type="submit" value="Crear Portafolio" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
