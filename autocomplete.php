<?php
	if($_SERVER["REQUEST_METHOD"] == "GET"){
        $entradaValida = True;
        $prefix = "";

        if(empty($_GET["q"]))
            $entradaValida = False;
        else
            $prefix = test_input($_GET["q"]);
        
        if(isset($_GET["idPortafolio"]))
            $idPortafolio = test_input($_GET["idPortafolio"]);

        if($entradaValida){
            include 'connection.php';
            $conexion = getConnection();

            $users = array();
            if(isset($idPortafolio))
                $consulQuery = "select u.idUsuario, u.userName, u.Nombre, u.ApPaterno, u.ApMaterno from usuario u, miembrouserport x where x.idPortafolio='" . $idPortafolio . "' and x.idUsuario=u.idUsuario and (u.userName like '" . $prefix . "%' or u.Nombre like '" . $prefix . "%' or u.ApPaterno like '" . $prefix . "%' or u.ApMaterno like '" . $prefix . "%' or u.Correo like '" . $prefix . "%') group by u.idUsuario limit 5;";
            else
                $consulQuery = "select idUsuario, userName, Nombre, ApPaterno, ApMaterno from usuario where userName like '" . $prefix . "%' or Nombre like '" . $prefix . "%' or ApPaterno like '" . $prefix . "%' or ApMaterno like '" . $prefix . "%' or Correo like '" . $prefix . "%' group by idUsuario limit 5;";
            $consulRes = mysqli_query($conexion,$consulQuery) or die ("Error en la consulta");
            while($fila = mysqli_fetch_array($consulRes))
                $users[] = array('idUsuario' => $fila["idUsuario"], 'userName' => $fila["userName"], 'Nombre' => $fila["Nombre"], 'ApPaterno' => $fila["ApPaterno"], 'ApMaterno' => $fila["ApMaterno"]);
            
            echo json_encode($users);

            mysqli_close($conexion);
        }
        else
            echo "";
    }
    
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>