<!DOCTYPE html>

<html>
	<head>
		<link href='Estilo.css' rel='stylesheet' type='text/css' />
		<title>Tarea</title>
	</head>
	<body>
		<?php
			session_start();
			include 'connection.php';
			
			if( $_POST["gestion"] == "alta" )
			{
				$conexion = getConnection();
				
				$execQuery = "insert into tarea (FechaMod, ValorNegocios, Titulo, Estado, FechaCreacion, TipoTarea , idColumna , idTablero , idUsuario , Prioridad , Progreso , Swag , Bloqueo) ";
				$execQuery .= "values('" . date("Y-m-d") . "',".$_POST["ValorNegocios"].",'".$_POST["Titulo"]."','".$_POST["Estado"]."','" . date("Y-m-d") . "','".$_POST["Tipo"]."',".$_SESSION["Columna"].",".$_SESSION["idTablero"].",".$_POST["idUsuario"].",".$_POST["Prioridad"].",".$_POST["Progreso"].",'".$_POST["Swag"]."','')";
				$execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());

				echo "<script type='text/javascript'>alert('Tarea creada exitosamente');</script>";
			}
			if( $_POST["gestion"] == "cambio" )
			{
				$conexion = getConnection();
				
				$execQuery = "update tarea set FechaMod='".date("Y")."-".date("m")."-".date("d")."' , 
												ValorNegocios= ".$_POST["ValorNegocios"]." , 
												Titulo='".$_POST["Titulo"]."', 
												Estado='".$_POST["Estado"]."', 
												TipoTarea='".$_POST["Tipo"]."', 
												idColumna=".$_POST["idColumna"].", 
												idTablero=".$_SESSION["idTablero"].", 
												idUsuario=".$_POST["idUsuario"].", 
												Prioridad=".$_POST["Prioridad"].", 
												Progreso=".$_POST["Progreso"].", 
												Swag='".$_POST["Swag"]."',
												Bloqueo='".$_POST["Bloqueo"]."'
						where idTarea=".$_POST["idTarea"].""; 
				$execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
				
				echo "<script type='text/javascript'>alert('Tarea modificada exitosamente');</script>";
			}
			if( $_POST["gestion"] == "baja" )
			{
				$conexion = getConnection();
				
				$execQuery = "delete from tarea where idTarea='".$_POST["idTarea"]."' ";
				$execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
				
				echo "<script type='text/javascript'>alert('Tarea eliminada exitosamente');</script>";
			}
		
			echo "<script type='text/javascript'>document.location='Tablero.php'</script>";							

		?>	
		
	</body>
</html>