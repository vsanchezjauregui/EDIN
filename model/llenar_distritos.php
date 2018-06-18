<?php
    include ('../model/conexion.php');
    $provincia = $_GET["provincia"];
    $canton = $_GET["canton"];

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
        //Pregunto el valor que evio el primer combo
        
                $query = 'SELECT distrito.nombre, distrito.numeroDistrito FROM distrito WHERE distrito.numeroCanton='.$canton.' ORDER BY distrito.nombre ASC';
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena="";
                //Recorro el arreglo de respuesta
                while ($row = $resultado->fetch_array()) {
                    $cadena .= '<option value="' . $row["numeroDistrito"] . '">' . $row["nombre"] . '</option>';
                } 
                echo $cadena;
                $conex->destruir();     
    }

