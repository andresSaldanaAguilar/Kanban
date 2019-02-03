<?php
	function getConnection(){
		$user = "root";
		$password = "root";
		$server = "127.0.0.1";
		$database = "proyectoisw";
	
		$connection = mysqli_connect($server, $user, $password, $database) or die ("No se pudo conectar usuario con servidor");
	
		//$db=mysqli_select_db($conexion,$basededatos) or die ("No se pudo conectar con la base de datos");	
		
		return $connection;
	}
?>
