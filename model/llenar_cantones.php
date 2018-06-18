<?php
    include ('../model/conexion.php');
    $provincia = $_GET["provincia"];

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
        //Pregunto el valor que evio el primer combo
        
                $query = "SELECT canton.nombre, canton.numerocanton FROM canton WHERE canton.numeroProvincia=".$provincia." ORDER BY canton.nombre ASC";
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena="";
                //Recorro el arreglo de respuesta
                while ($row = $resultado->fetch_array()) { 
                    $cadena .= '<option value="' . $row['numerocanton'] . '">' . $row['nombre'] . '</option>';
                } 
                echo $cadena;
                $conex->destruir();     
    }
    

