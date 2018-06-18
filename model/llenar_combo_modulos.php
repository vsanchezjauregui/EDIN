<?php
    include ('../model/conexion.php');
    $tecnico = $_GET["idtecnico"];

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
        //Pregunto el valor que evio el primer combo
        
                $query = "SELECT * FROM modules WHERE modules.id_Technitian = $tecnico ORDER BY modules.module_name ASC";
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena="";
                //Recorro el arreglo de respuesta
                while ($row = $resultado->fetch_array()) {
                    $cadena .= '<option value="' . $row["id_Modules"] . '">' . $row["module_name"] . '</option>';
                } 
                echo $cadena;
                $conex->destruir();     
    }

