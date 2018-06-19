<?php  
    if( (isset($_POST['masculino']) && isset($_POST['femenino'])) || ((!isset($_POST['masculino']) && !isset($_POST['femenino']))) ){  
        $genero = false;
    } elseif (isset($_POST['masculino'])) {
        $genero = true;
        echo "masculino";
    } else {
        $genero = true;
        echo "femenino";
    }
    $edadMin = explode(",", $_POST['edad'])[0];
    $edadMax = explode(",", $_POST['edad'])[1];

    $nacionalidad = $_POST['nac'];
    echo $nacionalidad;
    /*$oficio;
    $Provincias;
    $cantones;
    $distritos;
    $horasMin;
    $horasMax;
    $indigencia;






    $alianza = $_POST["nombreInstitucion"];
    $tipo = $_POST["tipoInstitucion"];
    $fecha = substr($_POST["datepicker"], 6)."/".substr($_POST["datepicker"], 0,2)."/".substr($_POST["datepicker"], 3,2);
    $direccion = $_POST["direccion"];

    $query = "INSERT INTO alliances (alliances.alliance_name, alliances.alliance_type, alliances.alliance_beg_time, alliances.alliane_adress) VALUES ('$alianza', '$tipo', '$fecha', '$direccion');";

    //echo $query;
    /*$insertar = mysqli_query($con,$query);
    
    if ($insertar) {
        header("Location:".$_SERVER['HTTP_REFERER']);
    }else{
        echo "Ha ocurrido un error <br>";
        echo $query;
    }*/
?>
