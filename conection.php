<?php
	function getConnection(){
		$usuario="root";
		$password="root";
		$servidor="localhost";
		$basededatos="proyectoisw";
	
		$conexion=mysqli_connect($servidor, $usuario, $password, $basededatos) or die ("No se pudo conectar usuario con servidor");
	
		//$db=mysqli_select_db($conexion,$basededatos) or die ("No se pudo conectar con la base de datos");	
		
		return $conexion;
	}
?>
