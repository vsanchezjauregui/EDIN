<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $con = $conex->usarConexion();
    $query_modulos = "SELECT open_mods.id_Open_mods as id, (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) as MODULO, open_mods.open_mod_estatus as ESTATUS, open_mods.open_mod_value as VALOR, open_mods.open_mod_date_from as FECHA_FROM, open_mods.open_mode_date_to as FECHA_TO FROM open_mods;";
    $query_clases = "SELECT classes.id_Classes, classes.id_Open_mods, classes.class_date, classes.class_time, classes.class_observations, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = classes.id_Open_mods) as MODULO FROM classes;";
    $query_finalizados = "SELECT COUNT(open_mods.id_Open_mods) as FINALIZADOS FROM open_mods WHERE open_mods.open_mod_estatus = 0";
    $query_abiertos = "SELECT COUNT(open_mods.id_Open_mods) as ABIERTOS FROM open_mods WHERE open_mods.open_mod_estatus = 1";
    $finalizados = $conex->consultaunica($query_finalizados, $con);
    $finalizados = $finalizados["ABIERTOS"];
    $abiertos = $conex->consultaunica($query_abiertos, $con);
    $abiertos = $abiertos["FINALIZADOS"];
    $modulos = $conex->consulta_varios($query_modulos, $con);
    $clases =$conex->consulta_varios($query_clases, $con);

    $conex->destruir();
    
?>



<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDIN | Ver Módulos Impartidos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        <li class="treeview active">
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
        <li class="treeview">
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
        Módulos y clases impartidas
        <small>Haga click en el número de clases para ver el detalle</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-9"><!--Modulos en curso y finalizados-->
          <div class="box box-primary box-solid">
            <div class="box-header">
              <h4 class="box-title">Módulos Finalizados</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="panel">
                <div class="col-sm-12"><!--header-->
                  <div class="col-sm-4">
                    <b>Módulo</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Desde</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Hasta</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Horas</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Clases</b>
                  </div>
                </div>            
                <br><br>  
                <div class="col-md-12">
                <?php
                  if ($finalizados == 0) {
                    echo "No hay módulos completados";
                  }else{
                    foreach ($modulos as $modulo) {
                      if ($modulo["ESTATUS"] == 0) {
                        $horas_modulo = 0;
                        $clases_modulo = 0;
                        foreach ($clases as $clase) {
                          if ($clase["id_Open_mods"]==$modulo["id"]) {
                            $horas_modulo += $clase["class_time"];
                            $clases_modulo += 1;
                          }
                        }

                        echo '  <div id="'.$modulo["id"].'">
                                  <div class="col-sm-4">
                                    <b>'.$modulo["MODULO"].'</b>
                                  </div>
                                <div class="col-sm-2">
                                  <b>'.$modulo["FECHA_FROM"].'</b>
                                </div>
                                <div class="col-sm-2">
                                  <b>'.$modulo["FECHA_TO"].'</b>
                                </div>
                                <div class="col-sm-2">
                                  <b>'.$horas_modulo.' horas</b>
                                </div>
                                <div class="col-sm-2">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$modulo["id"].'"><b>'.$clases_modulo.' clases</b></a>
                                </div>
                                <div id="collapse'.$modulo["id"].'" class="panel-collapse collapse col-sm-12">';
                        foreach ($clases as $clase) {
                          if ($clase["id_Open_mods"]==$modulo["id"]) {
                            echo '  <div class="col-sm-12>"
                                      <div class="col-sm-2 pull-right">
                                        <a data-toggle="modal" onclick="verclase('.$clase["id_Classes"].')" href="#modal-ver_clase">ver clase</a>
                                      </div>
                                      <div class="col-sm-2 pull-right">
                                        '.$clase["class_time"].' horas
                                      </div>
                                      <div class="col-sm-2 pull-right">
                                        '.$clase["class_date"].'
                                      </div>
                                    </div>';
                          }
                        }
                      }
                    }
                  }
                ?>
                </div>
              </div>
            </div>
          </div>
          <div class="box box-primary box-solid">
            <div class="box-header">
              <h4 class="box-title">Módulos en curso</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="panel">
                <div class="col-sm-12"><!--header-->
                  <div class="col-sm-5">
                    <b>Módulo</b>
                  </div>
                  <div class="col-sm-3">
                    <b>Desde</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Horas</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Clases</b>
                  </div>
                </div>            
                <br><br>  
                <div class="col-md-12">
                <?php
                  if ($abiertos == 0) {
                    echo "No hay módulos en curso";
                  }else{
                    foreach ($modulos as $modulo) {
                      if ($modulo["ESTATUS"] == 1) {
                        $horas_modulo = 0;
                        $clases_modulo = 0;
                        foreach ($clases as $clase) {
                          if ($clase["id_Open_mods"]==$modulo["id"]) {
                            $horas_modulo += $clase["class_time"];
                            $clases_modulo += 1;
                          }
                        }

                        echo '<div id="'.$modulo["id"].'"><div class="col-sm-5"><b>'.$modulo["MODULO"].'</b></div><div class="col-sm-3"><b>'.$modulo["FECHA_FROM"].'</b></div><div class="col-sm-2"><b>'.$horas_modulo.' horas</b></div><div class="col-sm-2"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$modulo["id"].'"><b>'.$clases_modulo.' clases</b></a></div><div id="collapse'.$modulo["id"].'" class="panel-collapse collapse col-sm-12">';
                        foreach ($clases as $clase) {
                          if ($clase["id_Open_mods"]==$modulo["id"]) {
                            echo '<div class="col-sm-12"><div class="col-sm-2 pull-right"><a  data-toggle="modal" onclick="verclase('.$clase["id_Classes"].')" href="#modal-ver_clase">ver clase</a></div><div class="col-sm-2 pull-right">'.$clase["class_time"].' horas</div><div class="col-sm-2 pull-right">'.$clase["class_date"].'</div></div>';
                          }
                        }
                        echo "</div></div>";
                      }
                    }
                  }
                ?>

                </div>
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-3">
          <div class="box box-default collapsed-box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title" data-widget="collapse">Opciones</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul><a href="abrir_modulo.php"><b>Abrir nuevo Módulo</b></a></ul>
              <?php 
              if (!$abiertos == 0) {
                    echo '<ul><a data-toggle="modal" href="#modal-cerrar_modulo"><b>Cerrar Módulos en curso</b></a></ul>';
              }
              ?>
              <ul><a href="registrar_clase.php"><b>Registrar clase impartida</b></a></ul>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-ver_clase"><!--Ver clase-->
        <!-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Clase Impartida</h4>
            </div>
            <div class="modal-body">
              <div class="box-body" style="text-align:justify;">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Técnico</label><br>
                    Técnico en Administración de Empresas
                  </div>
                  <div class="form-group">
                    <label>Módulo</label><br>
                    Introducción a la Informática
                  </div>
                  <div class="form-group">
                    <label>Fecha en que se impartió</label><br>
                    01/02/2018
                  </div>
                  <div class="form-group">
                    <label>Horas impartidas</label><br>
                    4 horas
                  </div>
                  <div class="form-group">
                    <label>Observaciones</label><br>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque ducimus velit, earum quidem, iusto dolorem. Et ipsam totam quas blanditiis, pariatur maxime ipsa iste, doloremque neque doloribus, error. Corrupti, tenetur.
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="box box-solid box-info" id="matriculados">
                    <div class="box-header">
                    <h4 class="box-title">Beneficiarios asistentes</h4>
                    </div>
                    <div class="box-body">
                      <table class="table table-striped table-hover">
                        <tbody>
                          <tr>
                            <td>Diego Miranda</td>
                          </tr>
                          <tr>
                            <td>Marvin Herrera</td>
                          </tr>
                          <tr>
                            <td>Rodolfo Delgado</td>
                          </tr>
                          <tr>
                            <td>Michael Lazio</td>
                          </tr>
                          <tr>
                            <td>Richard Calderon</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box box-solid box-info" id="matriculados">
                    <div class="box-header">
                      <h4 class="box-title">Instituciones participantes</h4>
                    </div>

                    <div class="box-body">
                      <table class="table table-striped table-hover">
                        <tbody>
                          <tr>
                            <td>Cruz Roja</td>
                          </tr>
                          <tr>
                            <td>Municipalidad de San José</td>
                          </tr>
                          <tr>
                            <td>Fundación Génesis</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
        </!-->
      </div>
      <div class="modal fade" id="modal-cerrar_modulo"><!--Cerrar Modulo-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <!--------------Verificar ortografia-------------->
              <h4 class="modal-title">Cerrar Modulo</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Indique el Módulo que desea Cerrar</label>
                  <select class="form-control" id="modulo">
                    <?php
                        foreach ($modulos as $modulo) {
                          if ($modulo["ESTATUS"] == 1) {
                            echo '<option value="'.$modulo["id"].'" cheked>.$modulo["MODULO"].</option>';
                          }
                        }
                    ?>
                    <option value="info" cheked>Introduccióna la Informática</option>
                  </select>
              </div>
              <div class="box-body no-padding" id="tabla_aprobados" name="tabla_aprobados">
                <div class="mailbox-controls">
                  <!-- Check all button -->
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                  </button> Seleccionar todos
                  <!-- /.pull-right -->
                </div>
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tbody id="aprobados" name="aprobados">
                    </tbody>
                  </table>
                  <!-- /.table -->
                </div>
              </div>
              <strong>Advertencia!</strong> Una vez que guarde los cambios, el curso quedará como cerrado y no podrá registrar más clases impartidas en él.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Guardar y cerrar otro</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>
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
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>


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
//Enable iCheck plugin for checkboxes
//iCheck for checkbox and radio inputs
$('.mailbox-messages input[type="checkbox"]').iCheck({
  checkboxClass: 'icheckbox_flat-blue',
  radioClass: 'iradio_flat-blue'
});
    
</script>


  function verclase(id){
    $( function(){
      //alert(id);
      $.get("../controller/cargar_clase.php", { id: id}, function(data) {
        $("#modal-ver_clase").empty();
        $("#modal-ver_clase").html(data);
      });
    })
  }

</script>


</body>
</html>
