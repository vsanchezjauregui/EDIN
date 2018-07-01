<?php  
    $fechaactual = date('Y-m-d');
    $edadMin = explode(",", $_POST['edad'])[0];
    $edadMax = explode(",", $_POST['edad'])[1];
    if ($edadMax==$edadMin){
        $edadMin = strtotime ('-'.$edadMin.' year' , strtotime($fechaactual)); 
        $edadMax = strtotime ('-'.$edadMax.' year -364 day' , strtotime($fechaactual));
        $edadMin = date ('Y-m-d',$edadMin);
        $edadMax = date ('Y-m-d',$edadMax);
    } else {
        $edadMin = strtotime ('-'.$edadMin.' year' , strtotime($fechaactual)); 
        $edadMax = strtotime ('-'.$edadMax.' year' , strtotime($fechaactual));
        $edadMin = date ('Y-m-d',$edadMin);
        $edadMax = date ('Y-m-d',$edadMax);
    }

    $horasMin = explode(",", $_POST['horas'])[0];
    $horasMax = explode(",", $_POST['horas'])[1];
    $indigenciaMin = explode(",", $_POST['indigen'])[0];
    $indigenciaMax = explode(",", $_POST['indigen'])[1];
    

    
    $ruta = 'Location: ../view/listar_beneficiarios.php?fechaMin='.$edadMax.'&fechaMax='.$edadMin.'&horasMin='.$horasMin.'&horasMax='.$horasMax.'&indigenciaMax='.$indigenciaMax.'&indigenciaMin='.$indigenciaMin;
    
    if( (isset($_POST['masculino']) && isset($_POST['femenino'])) || ((!isset($_POST['masculino']) && !isset($_POST['femenino']))) ){  
    } elseif (isset($_POST['masculino'])) {
        $ruta .= '&genero=m';
    } else {
        $ruta .= '&genero=f';
    }
    if (isset($_POST['nac'])) {
        $nacionalidades = $_POST['nac'];
        $ruta .= '&nacionalidades='.serialize($nacionalidades);
    }
    if (isset($_POST['prof'])) {
        $oficios = $_POST['prof'];
        $ruta .= '&oficios='.serialize($oficios);
    }
    if (isset($_POST['provin'])) {
        $provincias = $_POST['provin'];
        $ruta .= '&provicias='.serialize($provincias);
    }
    if (isset($_POST['cant'])) {
        $cantones = $_POST['cant'];
        $ruta .= '&cantones='.serialize($cantones);
    }
    if (isset($_POST['dist'])) {
        $distritos = $_POST['dist'];
        $ruta .= '&distritos='.serialize($distritos);
    }
     
    header($ruta);


?>
