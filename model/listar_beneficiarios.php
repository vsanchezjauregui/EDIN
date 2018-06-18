<?php
    include ('../model/conexion.php');

    //Creo variable que va a hacer la conexion
    $conex =  new ConexionMySQL();

    //Intento conectar
    $resulta = $conex->conectar();

    //atrapo la conexion
    $con = $conex->usarConexion();

    //Si conecto
    if ($resulta) {
        //Pregunto el valor que evio el primer combo
                
                $query = "SELECT * from Beneficiaries";
                //Ejecuto la consulta
                $resultado = mysqli_query($con, $query);
                //Inicio la cadena
                $cadena="";
                //$cadena="<thead><tr><th>Nombre</th><th><i class='fa fa-venus-mars'></i></th><th>Edad</th><th>País</th><th>Distrito</th><th>Oficio</th><th>Indigencia</th><th>Formación</th></tr></thead>";
                //Recorro el arreglo de respuesta
                while ($row = $resultado->fetch_array()) {
                    //<a href=""><span class="text">".$row["technician_name"]."</span></a>
                    if ($row["beneficiary_gender"]=="masculino") {
                        $genero = "M";
                    } else {
                        $genero = "F";
                    }    
                    $naciemiento = new DateTime($row["beneficiary_birth"]);
                    $hoy = new DateTime();
                    $edad = $hoy->diff($naciemiento)->y;

                    $cadena .= '<tr><td><a href="detalles_beneficiario.php">'.$row["beneficiary_name"].' '.$row["beneficiary_last_name"].'</a></td><td>'.$genero.'</td><td>'.$edad.'</td><td><img src="dist/img/flags/md/'.$row["beneficiary_nationality"].'.png" alt="'.$row["beneficiary_nationality"].'"></td><td>'.$row["beneficiary_district"].'</td><td>'.$row["beneficiary_profesion"].'</td><td>'.$row["beneficiary_condition_years"].' años</td><td>38 horas</td></tr>';
                } 
                echo $cadena;
                $conex->destruir();     
    }

