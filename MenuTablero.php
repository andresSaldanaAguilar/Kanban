<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Menu</title> 
		<link href='Estilo.css' rel='stylesheet' type='text/css' />
		<meta http-equiv='Cache-control' content='no-cache' />
        <script type="text/javascript" src="GenScript.js" ></script>
        <script type='text/javascript' src='MenuTablero.js' ></script>
	</head>
	
    <?php
        if(isset($_SESSION["idUsuario"])){
            include 'connection.php';
            $conexion = getConnection();
    
            $consulQuery = "select * from usuario where idUsuario='" . $_SESSION["idUsuario"] . "';";
            $consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
        
            if (mysqli_num_rows($consulRes) != 1)
                echo "<script type='text/javascript'>alert('Usuario no encontrado'); document.location='index.php';</script>";
            else{
                $inUser = mysqli_fetch_assoc($consulRes);

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $entradaValida = True;
                    $idPortafolio = "";
    
                    if(empty($_POST["idPortafolio"]))
                        $entradaValida = False;
                    else
                        $idPortafolio = test_input($_POST["idPortafolio"]);
    
                    if($entradaValida){
                        $consulQuery = "select * from portafolio where idUsuario='" . $inUser["idUsuario"] . "' and idPortafolio='" . $idPortafolio . "';";
                        $consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
    
                        if (mysqli_num_rows($consulRes) == 1){
                            $inPortafolio = mysqli_fetch_assoc($consulRes);
                            $_SESSION["idPortafolio"] = $inPortafolio["idPortafolio"];
                            $isAdmin = True;
                        }
                        else{
                            $consulQuery = "select p.* from portafolio p, miembrouserport x where p.idPortafolio=x.idPortafolio and x.idUsuario='" . $inUser["idUsuario"] . "' and p.idPortafolio='" . $idPortafolio . "';";
                            $consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());
        
                            if (mysqli_num_rows($consulRes) == 1){
                                $inPortafolio = mysqli_fetch_assoc($consulRes);
                                $_SESSION["idPortafolio"] = $inPortafolio["idPortafolio"];
                                $isAdmin = False;
                            }
                            else
                                echo "<script type='text/javascript'>alert('Portafolio no encontrado'); document.location='Inicio.php'</script>";
                        }
                        
                    }
                    else
                        echo "<script type='text/javascript'>alert('Entrada invalida'); document.location='Inicio.php';</script>";
                }
                else if(isset($_SESSION["idPortafolio"])){
                    $consulQuery = "select * from portafolio where idUsuario='" . $inUser["idUsuario"] . "' and idPortafolio='" . $_SESSION["idPortafolio"] . "';";
                    $consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
                
                    if (mysqli_num_rows($consulRes) == 1){
                        $inPortafolio = mysqli_fetch_assoc($consulRes);
                        $isAdmin = True;
                    }
                    else{
                        $consulQuery = "select p.* from portafolio p, miembrouserport x where p.idPortafolio=x.idPortafolio and x.idUsuario='" . $inUser["idUsuario"] . "' and p.idPortafolio='" . $_SESSION["idPortafolio"] . "';";
                        $consulRes = mysqli_query($conexion, $consulQuery) or die ("Error en la consulta");
                    
                        if (mysqli_num_rows($consulRes) == 1){
                            $inPortafolio = mysqli_fetch_assoc($consulRes);
                            $isAdmin = False;
                        }
                        else
                            echo "<script type='text/javascript'>alert('Portafolio no encontrado'); document.location='Inicio.php';</script>";
                    }
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
        <!--<input id='Busqueda' name='Busqueda' class='texto' type='text' placeholder='Buscar Usuario' style='position: absolute; left:900px; width:600px;' onKeyup='makeRequest()'/>-->
        
        <div class='Menu'>
			<div class='menuTitle'><b>Menú de Tableros</b></div>
			<p class='menuSub'><?php echo (isset($inPortafolio) ? $inPortafolio["Portafolio"] : "") . ($isAdmin  ? " (Admin)" : "") ?>.</p>
			<form action='Salir.php' method='post'>
				<input class='boton' type='submit' value='Salir'/>
				<input class='boton' type='submit' formaction='Inicio.php' formmethod='get' value='Regresar'/>
			</form>
        </div>
        
        <div id='gestion1' class='contenido' style=''>
			<div id='border' name='border' class='border'>
				<table id='tabla' name='tabla' width='100%' id='tabla'>
					<tr>
					<td colspan='2' class='Titulo'>
					<center><b>Gestión de Tableros</b></center>
					</td>
					</tr>
					<tr>
					<th width='20%' class='Titulo'>
					Nombre
					</th>
					<th width='20%' class='Titulo'>
					Visualizar
					</th>
                    <?php
                        if(isset($inPortafolio)){
                            $conexion = getConnection();
                            
                            $consulQuery = "select * from portafolio p , tablero t where p.idPortafolio=t.idPortafolio and p.idPortafolio='" . $inPortafolio["idPortafolio"] . "';";
                            $consulRes = mysqli_query($conexion,$consulQuery) or die ("Error en la consulta");
                        
                            while( $fila = mysqli_fetch_array($consulRes) )
                            {
                                echo "<tr>";
                                echo "<td>";
                                echo $fila['Nombre'];
                                echo "</td>";
    
                                echo "<td>";
                                echo "<form action='Tablero.php' method='post'>";
                                echo "<input type='hidden' name='idTablero' value='" . $fila["idTablero"] . "'>";
                                echo "<center><input type='image' src='Imagen/view.png' width='30px' height='30px'></center>";
                                echo "</form>";
                                echo "</td>";
                            }

                            mysqli_close($conexion);
                        }
					?>
                </table>
                <?php
                    if(isset($inPortafolio) && $isAdmin)
                        echo "<center><input type='image' id='crearTabBtn' src='Imagen/add.jpg' width='40px' height='40px'></center>";
                ?>
			</div>

            <?php
                if(isset($inPortafolio) && $isAdmin){
                    echo "<div id='border' name='border' class='border'>";
                    echo "<table id='tabla' name='tabla' width='100%' id='tabla'>";
                    echo "<tr>";
                    echo "<td colspan='4' class='Titulo'>";
                    echo "<center><b>Gestión de Miembros</b></center>";
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th width='20%' class='Titulo'>";
                    echo "UserName";
                    echo "</th>";
                    echo "<th width='20%' class='Titulo'>";
                    echo "Nombre";
                    echo "</th>";
                    echo "<th width='20%' class='Titulo'>";
                    echo "Correo";
                    echo "</th>";
                    echo "<th width='20%' class='Titulo'>";
                    echo "Remover";
                    echo "</th>";

                    $conexion = getConnection();
                    
                    $consulQuery = "select u.* from portafolio p, miembrouserport x, usuario u where u.idUsuario=x.idUsuario and p.idPortafolio=x.idPortafolio and p.idPortafolio='" . $inPortafolio["idPortafolio"] . "';";
                    $consulRes = mysqli_query($conexion,$consulQuery) or die ("Error en la consulta");
                
                    while( $fila = mysqli_fetch_array($consulRes) )
                    {
                        echo "<tr>";

                        echo "<td>";
                        echo $fila['userName'];
                        echo "</td>";

                        echo "<td>";
                        echo $fila['Nombre'] . " " . $fila['ApPaterno'] . " " . $fila['ApMaterno'];
                        echo "</td>";
                        
                        echo "<td>";
                        echo $fila['Correo'];
                        echo "</td>";

                        echo "<td>";
                        echo "<form name='formTab' action='BajaUserPort.php' method='post'>";
                        echo "<input type='hidden' name='idUsuario' value='" . $fila["idUsuario"] . "'>";
                        echo "<center><span class='modalGenClose' onclick='formTab.submit()'>&times;</span></center>";
                        echo "</form>";
                        echo "</td>";

                        echo "</tr>";
                    }
                    echo "</table>";

                    echo "<div id='userPortModal' class='modal'>";
                    echo "<div class='modalCont'>";
                    echo "<div class='modalHeader'>";
                    echo "<span id='userPortModalClose' class='modalClose'>&times;</span>";
                    echo "<h3>Agregar Usuario al Portafolio</h3>";
                    echo "</div>";
                    echo "<form action='AltaUserPort.php' method='post'>";
                    echo "<div class='modalBody'>";

                    
                    echo "<div class='dropdown'>";

                    echo "<input type='text' id='busqueda' name='busqueda' autocomplete='off' placeholder='Buscar Usuario' onkeyup='autocompletar(this.value)' />";
                    echo "<div id='autoCompleteDropdown' class='dropdownContent'>";
                    echo "</div>";

                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";




                    echo "<center><input type='image' src='Imagen/useradd.png' id='addUserPortBtn' width='30px' height='30px' /></center>";
                    echo "</div>";

                    mysqli_close($conexion);
                }
            ?>
		</div>


		<div id="tabModal" class="modal">
			<div class="modalCont">
				<div class="modalHeader">
					<span id="tabModalClose" class="modalClose">&times;</span>
					<h3>Nuevo Tablero</h3>
				</div>
				<form action="AltaTab.php" method="post">
					<div class="modalBody" id="modalBody">
						<br/>
						<input type="text" class="modalField" name="nomTab" required="required" placeholder="Nombre del Tablero" />
						<br/>
                        <p class="modalField">Columnas:</p>
					    <span id="tabModalAdd" class="modalAdd">&plus;</span>
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