<!DOCTYPE html>

<html>
	<head>
		<title>Menu</title> 
		<link href='Estilo.css' rel='stylesheet' type='text/css' />
		<meta http-equiv='Cache-control' content='no-cache' />
	</head>
	
	<script type='text/javascript' src='Script.js' ></script>
	<script type='text/javascript' src='AJAX3.js' ></script>
	
	<body onLoad='reloj()'>	
        
        <div id='Reloj' class='Reloj' align='center'></div>
        <input id='Busqueda' name='Busqueda' class='texto' type='text' placeholder='Buscar Usuario' style='position: absolute; left:900px; width:600px;' onKeyup='makeRequest()'/>
        <input type='hidden' id='usuariop' name='usuariop' class='texto' value='"+usuario+"'/>
        
        <div class='Menu'>
			<div id='titulo' style='width: 190px'><b>Menú - Alumno</b></div>
			
			<br/><br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style=' font-family: sans-serif; font-size: 30px;'></b>
			<br/>
        
			<form action='index.php' method='post'>
				<input id='boton' type='submit' value='Salir'/>
			</form>
        </div>
        
        
        <div id='gestion1' class='contenido' style=''>
			<div id='border' name='border' class='border' style='position:relative; margin: 30px auto; left:100px; width:80%;'>
			</div>     
		</div>
		
	</body>
</html>