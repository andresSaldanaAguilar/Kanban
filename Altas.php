<?php
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
			
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$entradaValida = True;
				$nombre = $apPat = $apMat = $user = $email = $cont = "";
				
				if(empty($_POST["nombre"]))
					$entradaValida = False;
				else{
					$nombre = test_input($_POST["nombre"]);
					if(!preg_match('/^[\p{L} ]+$/u', $nombre))
						$entradaValida = False;
				}

				if(empty($_POST["apPat"]))
					$entradaValida = False;
				else{
					$apPat = test_input($_POST["apPat"]);
					if(!preg_match('/^[\p{L} ]+$/u', $apPat))
						$entradaValida = False;
				}

				if(empty($_POST["apMat"]))
					$entradaValida = False;
				else{
					$apMat = test_input($_POST["apMat"]);
					if(!preg_match('/^[\p{L} ]+$/u', $apMat))
						$entradaValida = False;
				}

				if(empty($_POST["user"]))
					$entradaValida = False;
				else
					$user = test_input($_POST["user"]);

				if(empty($_POST["email"]))
					$entradaValida = False;
				else{
					$email = test_input($_POST["email"]);
					if(!filter_var($email, FILTER_VALIDATE_EMAIL))
						$entradaValida = False;
				}

				if(empty($_POST["cont"]))
					$entradaValida = False;
				else
					$cont = test_input($_POST["cont"]);

				if($entradaValida)
				{
					include 'connection.php';
					$conexion = getConnection();
			
					$consulQuery = "select * from usuario where Correo='$email' or userName='$user';";
					$consulRes = mysqli_query($conexion, $consulQuery) or die ("Algo ha ido mal".mysql_error());

					if (mysqli_num_rows($consulRes) > 0)
						echo "<script type='text/javascript'>alert('Usuario o correo ya existente');</script>";
					else{
						$execQuery = "insert into usuario (userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) values('$user','$nombre','$apPat','$apMat','$email','$cont')";
						$execRes = mysqli_query($conexion, $execQuery) or die ("Algo ha ido mal".mysql_error());
						
						echo "<script type='text/javascript'>alert('Usuario creado exitosamente');</script>";
					}
					mysqli_close($conexion);
				}
			}

			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
		<script type='text/javascript'>document.location='Registro.php'</script>
	</body>
</html>