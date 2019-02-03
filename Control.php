<!DOCTYPE html>

<html>
	<head>
		<link href='Estilo.css' rel='stylesheet' type='text/css' />
		<title>Tarea</title>
		<script>
			function mandar() 
			{
				document.getElementById("myForm").submit();
			}
		</script>
	</head>
	<body onLoad="mandar()">
		<?php
			session_start();
			include 'connection.php';

			$conexion = getConnection();
			$contador = $_POST["Contador"];
			
			for( $i = 0 ; $i < $contador ; $i++ )
			{
				$execQuery = "update tarea set idColumna=".$_POST["columna".$i]." where idTarea=".$_POST["tarea".$i].""; 
				$execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
			}

			if( $_POST["gestion"] == 'b1' )
			{
				echo "<form id='myForm' action='Tarea.php' method='post' >";
				echo "<input type='hidden' name='gestion' value='alta' />";
			}
			if( $_POST["gestion"] == 'b2' )
			{
				echo "<form id='myForm' action='MenuTablero.php' method='get' >";
			}
			if( $_POST["gestion"] == 'bsalir' )
			{
				echo "<form id='myForm' action='Salir.php' method='post' >";
			}
			if( $_POST["gestion"] == 'b3' )
			{
				echo "<form id='myForm' action='Tarea.php' method='post' >";
				echo "<input type='hidden' name='gestion' value='gestion' />";
				echo "<input type='hidden' name='idTarea' value=".$_POST["idTarea"]." />";
			}
			
			echo "</form>"
		?>	
		
	</body>
</html>