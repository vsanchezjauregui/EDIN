<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $con = $conex->usarConexion();

    $beneficiario = $_POST["beneficiario"];
    $modulo = explode("-",$_POST["moduloAbonado"])[0];
    $fecha = substr($_POST["datepicker"], 6)."/".substr($_POST["datepicker"], 0,2)."/".substr($_POST["datepicker"], 3,2);
    $deuda = (explode("-",$_POST["moduloAbonado"]))[1];
    $valor = $_POST["valorPagado"];
    
    if ($valor>$deuda) {
        $valor = $deuda;
    }
    //echo "value ".$_POST["moduloAbonado"]."<br>";
    //echo "beneficiario $beneficiario, modulo $modulo, fecha $fecha, valor $valor <br>";

    $query = "INSERT INTO payments (payments.id_open_mod, payments.id_beneficiary, payments.payment_value, payments.payment_date) VALUES ($modulo, $beneficiario, $valor, '$fecha')";

    $insertar = mysqli_query($con,$query);
    
    if ($insertar) {
        header("Location:".$_SERVER['HTTP_REFERER']);
    }else{
        echo "Ha ocurrido un error <br>";
        echo $query;
    }

    $conex->destruir();
?>
