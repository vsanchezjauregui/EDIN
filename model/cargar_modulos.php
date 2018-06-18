<?php
    include ('../model/conexion.php');

    $tecnico = $_GET["idTecnico"];
    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
        //Pregunto el valor que evio el primer combo
                $query = "SELECT * FROM modules WHERE modules.id_Technitian = $tecnico";
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena="";
                //Recorro el arreglo de respuesta

                while ($row = $resultado->fetch_array()) {
                    //<a href=""><span class="text">".$row["technician_name"]."</span></a>
                    $idModule=$row["id_Modules"];
                    $modulo = $row["module_name"];
                    $descripcion = $row["module_desription"];
                    $duracion = $row["module_duration"];
                    $cadena .="<div class='panel box box-solid'><div class='box-header'><h4 class='box-title'><a data-toggle='collapse' data-parent='#accordion' href='#collapse$idModule'>$modulo</a></h4></div><div id='collapse$idModule' class='panel-collapse collapse'><div class='box-body' style='text-align: justify;'>$descripcion<br><br><div class='pull-right'>Horas de formación: <b>$duracion</b></div></div></div></div>";
                } 
                echo $cadena;
                $conex->destruir();     
    }

