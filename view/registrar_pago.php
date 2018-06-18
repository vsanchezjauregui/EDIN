<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $query_pagos = "SELECT payments.payment_date as fecha, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = payments.id_open_mod) as modulo, payments.payment_value as bolsas, payments.id_open_mod, (SELECT beneficiaries.beneficiary_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = payments.id_beneficiary) as nombre_beneficiario, (SELECT beneficiaries.beneficiary_last_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = payments.id_beneficiary) as apellido_beneficiario, payments.id_beneficiary FROM payments ORDER by fecha;";
    $query_modulos = "SELECT bridge_benef_openmods.id_open_mod, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM `open_mods` WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as MODULO, (SELECT open_mods.open_mod_value FROM open_mods WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as VALOR, (SELECT beneficiaries.beneficiary_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) as nombre_beneficiario, (SELECT beneficiaries.beneficiary_last_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) as apellido_beneficiario, bridge_benef_openmods.id_beneficiary FROM bridge_benef_openmods;";
    $con = $conex->usarConexion();
    $pagos_realizados = $conex->consulta_varios($query_pagos, $con);
    $modulos_matriculados = $conex->consulta_varios($query_modulos, $con);
    $deudas = [];
    $deuda_total = 0;
    foreach ($modulos_matriculados as $row) {
      $pago_modulo = 0;
      foreach ($pagos_realizados as $row2) {
        if ($row2["id_open_mod"]==$row["id_open_mod"] and $row2["id_beneficiary"]==$row["id_beneficiary"]) {
          $pago_modulo += $row2["bolsas"];
        }
      }

      $deuda = $row["VALOR"] - $pago_modulo;
      if ($deuda>0) {
        array_push($deudas, array($deuda, $row["MODULO"], $row["nombre_beneficiario"]." ".$row["apellido_beneficiario"], $row["id_beneficiary"]));
      }
      $deuda_total += $deuda;
    }
    $conex->destruir();

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDIN | Ver pagos realizados</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!--skin-->
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
        <li class="active">
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
        Pagos pendientes y realizados por los beneficiarios
        <small>Los pagos se realizan en forma de bolsas de desechos recogidos</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <button type="button" class="btn btn-block btn-primary btn-flat" data-toggle="modal" href="#modal-registrar_pago">Registrar pago</button>
      <br>
      <div class="row">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header">
              <h4 class="box-title">Pagos realizados</h4>
              <small class="pull-right">Se han registrado <b><?php
                $total_bolsas = 0;
                foreach ($pagos_realizados as $row) {
                  $total_bolsas += $row["bolsas"];
                }
                echo $total_bolsas;
              ?>
              </b> bolsas de desechos pagadas</small>
            </div>
            <div class="box-body table-resposive">
              <table id="example2" class="table table-striped table-hover">
                <?php 
                  if (count($pagos_realizados)==0) {
                    echo "No se ha registrado ningún pago";
                  }else{
                    $cadena = "<thead><tr><th>Fecha</th><th>Beneficiario</th><th>Módulo pagado</th><th>Bolsas</th></tr></thead><tbody>";
                    foreach ($pagos_realizados as $row) {
                      $cadena .= '<tr><td>'.$row["fecha"].'</td><td>'.$row["nombre_beneficiario"].' '.$row["apellido_beneficiario"].'</td><td>'.$row["modulo"].'</td><td>'.$row["bolsas"].'</td></tr>';
                    }
                    $cadena .= "</tbody>";
                    echo $cadena;
                  }
                ?>           
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header">
              <h4 class="box-title">Deudas pendientes</h4>
              <small class="pull-right">Hay <b><?php echo $deuda_total; ?></b> bolsas de desechos pendientes por pagar</small>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-striped table-hover">
                <?php 
                  if ($deuda_total==0) {
                    echo "No hay deudas pendientes";
                  }else{
                    $cadena = "<thead><tr><th>Beneficiario</th><th>Módulo pagado</th><th>Bolsas</th></tr></thead><tbody>";

                    for ($i=0; $i < count($deudas) ; $i++) { 
                        $cadena .= '<tr><td>'.$deudas[$i][2].'</td><td>'.$deudas[$i][1].'</td><td>'.$deudas[$i][0].'</td></tr>';
                      }
                    $cadena .= "</tbody>";
                    echo $cadena;
                  }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- form start -->
      <div class="modal fade" id="modal-registrar_pago">
        <div class="modal-dialog">
          <form role="form" action="../controller/registrar_pago.php" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar nuevo pago de Módulo</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">Beneficiario que abona</label>
                    <select class="form-control select2" style="width: 100%;" id="beneficiario" name="beneficiario" required>
                      <?php
                        if (count($deudas)!=0) { 
                          $cadena= '<option ></option>';
                          for ($i=0; $i < count($deudas); $i++) { 
                            $cadena .='<option value="'.$deudas[$i][3].'">'.$deudas[$i][2].'</option>';
                          }
                          echo $cadena;
                        } 
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Módulo al que abona</label>
                    <select class="form-control select2" style="width: 100%;" id="moduloAbonado" name="moduloAbonado">
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">
                      Descripción del pago realizado
                      <small>(Cantidad de bolsas)</small>
                    </label>
                    <input class="form-control col-sm-2" type="number" id="valorPagado" name="valorPagado" min="1" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Fecha del abono</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" required>
                    </div>
                  </div>
                  <b>Nota:</b> Si se ingresa un pago mayor al monto de la deuda correspondinte a un módulo, se registrará únicamente el valor de la deuda como pago.
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Registrar"></input>
              </div>
            </div>
          </form>
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
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="../controller/registrar_pago.js"></script>
<!-- Page script -->
<script>
  $(function () {

    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    //Money Euro
    $('[data-mask]').inputmask()

        //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
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
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
</script>
</body>
</html>