<?php  
    $querygeneral = "SELECT *, (SELECT SUM((SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes)) FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries = beneficiaries.id_Beneficiaries) AS HORAS  from Beneficiaries";
    if (isset($_GET['fechaMin'])) {
      $querygeneral .= " WHERE beneficiary_birth >='".$_GET['fechaMin']."' and beneficiary_birth <= '".$_GET['fechaMax']."' and beneficiary_condition_years >= ".$_GET["indigenciaMin"]." and beneficiary_condition_years <= ".$_GET["indigenciaMax"];
      if (!$_GET['horasMin']==0) {
        $querygeneral .= " and (SELECT SUM((SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes)) FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries = beneficiaries.id_Beneficiaries) >= ".$_GET['horasMin']." and (SELECT SUM((SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes)) FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries = beneficiaries.id_Beneficiaries) <= ".$_GET['horasMax'];
      }else{
        $querygeneral .= " and ((SELECT SUM((SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes)) FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries = beneficiaries.id_Beneficiaries) IS NULL or (SELECT SUM((SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes)) FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries = beneficiaries.id_Beneficiaries) <= ".$_GET['horasMax'].")";
      }
      if (isset($_GET['genero'])) {
        $querygeneral .= " AND beneficiary_gender =";
        if ($_GET['genero']=='m') {
           $querygeneral .= "'masculino'";
        }else{
          $querygeneral .= "'femenino'";
        }
      }
      if (isset($_GET['nacionalidades'])) {
        $nac_fil = unserialize($_GET['nacionalidades']);
        $querygeneral .= " and (";
        foreach ($nac_fil as $row) {
          $querygeneral .= "beneficiary_nationality = '".$row."' or ";
        }
        $querygeneral = substr($querygeneral, 0, -3);  
        $querygeneral .= ")";
      }
      if (isset($_GET['oficios'])) {
        $oficios_fil = unserialize($_GET['oficios']);
        $querygeneral .= " and (";
        foreach ($oficios_fil as $row) {
          $querygeneral .= "beneficiary_profesion = '".$row."' or ";
        }
        $querygeneral = substr($querygeneral, 0, -3);  
        $querygeneral .= ")";
      }
      if (isset($_GET['provin'])) {
        $prov_fil = unserialize($_GET['provin']);
        $querygeneral .= " and (";
        foreach ($prov_fil as $row) {
          $querygeneral .= "beneficiary_province = '".$row."' or ";
        }
        $querygeneral = substr($querygeneral, 0, -3);  
        $querygeneral .= ")";
      }
      if (isset($_GET['cant'])) {
        $cant_fil = unserialize($_GET['cant']);
        $querygeneral .= " and (";
        foreach ($cant_fil as $row) {
          $querygeneral .= "beneficiary_canton = '".$row."' or ";
        }
        $querygeneral = substr($querygeneral, 0, -3);  
        $querygeneral .= ")";
      }
      if (isset($_GET['dist'])) {
        $dist_fil = unserialize($_GET['dist']);
        $querygeneral .= " and (";
        foreach ($dist_fil as $row) {
          $querygeneral .= "beneficiary_district = '".$row."' or ";
        }
        $querygeneral = substr($querygeneral, 0, -3);  
        $querygeneral .= ")";
      }

    }
    //echo $querygeneral;
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $con = $conex->usarConexion();
    $query_profesiones = "SELECT DISTINCT beneficiaries.beneficiary_profesion FROM beneficiaries WHERE beneficiaries.beneficiary_profesion is not null";
    $profesiones = $conex->consulta_varios($query_profesiones, $con);
    $query_nacionalidades = "SELECT DISTINCT beneficiaries.beneficiary_nationality FROM beneficiaries WHERE beneficiaries.beneficiary_nationality is not null";
    $nacionalidades = $conex->consulta_varios($query_nacionalidades, $con);
    $query_provincias = "SELECT DISTINCT beneficiaries.beneficiary_province FROM beneficiaries WHERE beneficiaries.beneficiary_province is not null";
    $provincias = $conex->consulta_varios($query_provincias, $con);
    $query_cantones = "SELECT DISTINCT beneficiaries.beneficiary_canton FROM beneficiaries WHERE beneficiaries.beneficiary_canton is not null";
    $cantones = $conex->consulta_varios($query_cantones, $con);
    $query_distritos = "SELECT DISTINCT beneficiaries.beneficiary_district FROM beneficiaries WHERE beneficiaries.beneficiary_district is not null";
    $distritos = $conex->consulta_varios($query_distritos, $con);
    $query_formacion_max = "SELECT    MAX((SELECT SUM((SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes)) FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries = beneficiaries.id_Beneficiaries)) AS formacionmaxima from Beneficiaries";
    $max_formacion = $conex->consultaunica($query_formacion_max, $con);
    $query_edad_min = "Select MAX(beneficiaries.beneficiary_birth) as nacimientominima FROM beneficiaries";
    $min_nacimiento = $conex->consultaunica($query_edad_min, $con);
    $naciemiento_min = new DateTime($min_nacimiento["nacimientominima"]);
    $today = new DateTime();
    $min_edad = $today->diff($naciemiento_min)->y;
    $query_edad_max = "Select MIN(beneficiaries.beneficiary_birth) as nacimientomaximo FROM beneficiaries";
    $max_nacimiento = $conex->consultaunica($query_edad_max, $con);
    $naciemiento_max = new DateTime($max_nacimiento["nacimientomaximo"]);    
    $max_edad = $today->diff($naciemiento_max)->y;


    $query_indigencia_min = "Select MIN(beneficiaries.beneficiary_condition_years) as indigenciaminima FROM beneficiaries";
    $min_indigencia = $conex->consultaunica($query_indigencia_min, $con);
    $query_indigencia_max = "Select MAX(beneficiaries.beneficiary_condition_years) as indigenciamaxima FROM beneficiaries";
    $max_indigencia = $conex->consultaunica($query_indigencia_max, $con);

    $profesiones = $conex->consulta_varios($query_profesiones, $con);
    $registro = $conex->consulta_varios($querygeneral, $con);
    $tam = count($registro);
    $conex->destruir();
?>

<!DOCTYPE html>

<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDIN | Ver Beneficiarios</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>


</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>EDIN</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>EDIN</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"></span>
      </a>
      <a href="blank.php" class="navbar-brand">Municipalidad de San José</a>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Módulos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="ver_modulos.php">Ver Módulos</a></li>
            <li><a href="abrir_modulo.php">Abrir Módulo</a></li>
            <li><a href="registrar_clase.php">Registrar clase</a></li>
            <li><a href="ver_modulos_impartidos.php">Ver Clases y Módulos impartidos</a></li>
          </ul>
        </li>
        <li class="treeview active">
          <a href="#"><i class="fa fa-users"></i> <span>Beneficiarios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="registrar_beneficiario.php">Nuevo Beneficiario</a></li>
            <li><a href="listar_beneficiarios.php">Ver Beneficiarios</a></li>
          </ul>
        </li>
        <li>
          <a href="registrar_pago.php">
            <i class="fa fa-dollar"></i> <span>Pagos</span>
          </a>
        </li>
        <li>
          <a href="ver_instituciones.php">
            <i class="fa fa-handshake-o"></i> <span>Instituciones aliadas</span>
          </a>
        </li>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Beneficiarios inscritos en EDIN
          <small>(Haga click en un beneficiario para ver sus detalles)</small>
        </h1>
      </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" href="#modal-filtro">Busqueda avanzada</button>
              </div>
              <br>
              <table id="tabla" class="table table-hover table-striped">
                <thead>
                <tr>

                  <th>Nombre</th>
                  <th><i class="fa fa-venus-mars"></i></th>
                  <th>Edad</th>
                  <th>País</th>
                  <th>Distrito</th>
                  <th>Oficio</th>
                  <th>Indigencia</th>
                  <th>Formación</th>
                </tr>
                </thead>
                <tbody id="tabla_beneficiarios">
                  <?php
                      if ($tam==0) {
                        echo "No hay beneficiarios que mostrar";
                      } else{
                        foreach ($registro as $row) {
                          if ($row["beneficiary_gender"]=="masculino") {
                            $genero = "M";
                          } else {
                            $genero = "F";
                          }    
                          $naciemiento = new DateTime($row["beneficiary_birth"]);
                          $hoy = new DateTime();
                          $edad = $hoy->diff($naciemiento)->y;
                          echo '<tr><td><a href="detalles_beneficiario.php?idbeneficiario='.$row["id_Beneficiaries"].'">'.$row["beneficiary_name"].' '.$row["beneficiary_last_name"].'</a></td><td>'.$genero.'</td><td>'.$edad.'</td><td><img src="dist/img/flags/md/'.$row["beneficiary_nationality"].'.png" alt="'.$row["beneficiary_nationality"].'"></td><td>'.$row["beneficiary_district"].'</td><td>'.$row["beneficiary_profesion"].'</td><td>'.$row["beneficiary_condition_years"].' años</td><td>';
                          if (is_null($row["HORAS"])) {
                            echo "0";
                          }else{
                            echo $row["HORAS"];
                          }
                          echo ' horas</td></tr>';
                        };
                      }
                    ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-filtro">
        <div class="modal-dialog">
          <div class="modal-content">
            <form role="form" action="../controller/aplicar_filtro.php" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Busqueda Avanzada</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group"><!--Genero-->
                        <label>Genero</label>
                        <div>
                          <div class="col-md-3">
                            <input type="checkbox" checked class="minimal" value="" id="masculino" name="masculino">
                            <i class="fa fa-mars"></i>
                            <br>
                          </div>
                          <div class="col-md-3">
                            <input type="checkbox" checked class="minimal-red" value="" id="femenino" name="femenino">
                            <i class="fa fa-venus"></i>
                          </div>
                        </div>
                      </div>
                      <br>                   
                      <div class="form-group"><!--Edad-->
                        <label>Edad</label><br>

                        <div class="col-sm-2 no-margin no-padding"><?php echo $min_edad?> años</div>
                        <div class="col-sm-7">
                        <input id="edad" name="edad" type="text" value="" class="slider form-control no-margin no-padding" data-slider-min="<?php echo $min_edad?>" data-slider-max="<?php echo $max_edad?>" data-slider-step="1" data-slider-value="[<?php echo $min_edad.','.$max_edad?>]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue">

                       
                        </div>
                        <div class="col-sm-3 no-margin no-padding"><?php echo $max_edad?> años</div>
                      </div>
                      <br>
                      <div class="form-group"><!--Nacionalidad-->
                        <label>Nacionalidad</label>
                        <small>Para todos, deje este campo vacío</small>
                        <select name="nac[]" id="nac[]" class="form-control select2" multiple="multiple" multiple style="width: 100%;">
                        <!--------Hay que arreglar los "codigos de pais" por los paises respectivos. -------->
                        <!--      Me parece prudente corregirlo desde la insersion pero eso implica buscar luego para pasar las banderas
                      -->
                          <?php 
                            foreach ($nacionalidades as $nacionalidad) {
                              echo "<option value='".$nacionalidad["beneficiary_nationality"]."'>".$nacionalidad["beneficiary_nationality"]."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group"><!--Oficio-->
                        <label>Oficio</label>
                        <small> Para todos, deje este campo vacío</small>
                        <!----------Verificar los posibles cambios. Agregar name="prof[]" id="prof[]"---------->
                        <select name="prof[]" id="prof[]" class="form-control select2" multiple="multiple" multiple style="width: 100%;">
                          <?php 
                            foreach ($profesiones as $profesion) {
                              echo "<option value='".$profesion["beneficiary_profesion"]."'>".$profesion["beneficiary_profesion"]."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group"><!--Indigencia-->
                        <label>Tiempo en condición de indigencia</label><br>
                        <div class="col-sm-2 no-margin no-padding"><?php echo $min_indigencia['indigenciaminima'] ?> años</div>
                        <div class="col-sm-7">
                        <input name="indigen" id="indigen" type="text" value="" class="slider form-control no-margin no-padding" data-slider-min="<?php echo $min_indigencia['indigenciaminima'] ?>" data-slider-max="<?php echo $max_indigencia['indigenciamaxima'] ?>" data-slider-step="1" data-slider-value="[<?php echo  $min_indigencia['indigenciaminima'].','.$max_indigencia['indigenciamaxima']  ?>]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue">
                        </div>
                        <div class="col-sm-3 no-margin no-padding"><?php echo $max_indigencia['indigenciamaxima'] ?> años</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group"><!--Provincia-->
                        <label>Provincia</label>
                        <small> Para todas, deje este campo vacío</small>
                        
                        <select name="provin[]" id="provin[]" class="form-control select2" multiple="multiple" multiple style="width: 100%;">
                          <?php 
                            foreach ($provincias as $provincia) {
                              echo "<option value='".$provincia["beneficiary_province"]."'>".$provincia["beneficiary_province"]."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group"><!--Canton-->
                        <label>Cantón</label>
                        <small>Para todos, deje este campo vacío</small>
                        
                        <select name="cant[]" id="cant[]" class="form-control select2" multiple="multiple" multiple style="width: 100%;">
                          <?php 
                            foreach ($cantones as $canton) {
                              echo "<option value='".$canton["beneficiary_canton"]."'>".$canton["beneficiary_canton"]."</option>";
                            }
                          ?>                          
                        </select>
                      </div>
                      <div class="form-group"><!--Distrito-->
                        <label>Distrito</label>
                        <small>Para todos, deje este campo vacío</small>
                        
                        <select name="dist[]" id="dist[]" class="form-control select2" multiple="multiple" multiple style="width: 100%;">
                          <?php 
                            foreach ($distritos as $distrito) {
                              echo "<option value='".$distrito["beneficiary_district"]."'>".$distrito["beneficiary_district"]."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group"><!--Formacion-->
                        <label>Horas de formación recibidas</label><br>
                        <div class="col-sm-2 no-margin no-padding">0 horas</div>
                        <div class="col-sm-7">
                        <input name="horas" id="horas" type="text" value="" class="slider form-control no-margin no-padding" data-slider-min="0" data-slider-max="<?php echo $max_formacion['formacionmaxima'] ?>" data-slider-step="1" data-slider-value="[0,<?php echo $max_formacion['formacionmaxima'] ?>]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue">
                        </div>
                        <div class="col-sm-3 no-margin no-padding"><?php echo $max_formacion['formacionmaxima'] ?> horas</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Listo"></input>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    <strong>Elaborado por Victor Sánchez Jáuregui. TCU Universidad Magister. 2018</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
  <!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Bootstrap slider -->
<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>

<!-- page script -->
<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').slider()
  })
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    //Money Euro
    $('[data-mask]').inputmask()
    //iCheck for checkbox and radio inputs

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

  })
  $(function () {
    $('#tabla').DataTable()
  })

</script>

</body>
</html>
