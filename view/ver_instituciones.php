<!--INSERT INTO alliances (alliances.alliance_name, alliances.alliance_type, alliances.alliance_beg_time, alliances.alliane_adress) VALUES ('Cruz Roja', 'Humanitria', '2017-12-15', 'Frente a Casa Presidencial');-->


<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $query_alianzas = "SELECT * FROM alliances;";
    //$query_clases = "SELECT bridge_benef_openmods.id_open_mod, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM `open_mods` WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as MODULO, (SELECT open_mods.open_mod_value FROM open_mods WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as VALOR, (SELECT beneficiaries.beneficiary_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) as nombre_beneficiario, (SELECT beneficiaries.beneficiary_last_name FROM beneficiaries WHERE beneficiaries.id_Beneficiaries = bridge_benef_openmods.id_beneficiary) as apellido_beneficiario, bridge_benef_openmods.id_beneficiary FROM bridge_benef_openmods;";
    $con = $conex->usarConexion();
    $alianzas = $conex->consulta_varios($query_alianzas, $con);
    //$modulos_matriculados = $conex->consulta_varios($query_modulos, $con);
    //$deudas = [];
    //$deuda_total = 0;
    /*foreach ($modulos_matriculados as $row) {
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
    }*/
    $conex->destruir();
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDIN | Ver Instituciones aliadas</title>
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
        <li>
          <a href="registrar_pago.php">
            <i class="fa fa-dollar"></i> <span>Pagos</span>
          </a>
        </li>
        <li class="active">
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
        Instituciones aliadas al Programa EDIN | Municipalidad de San José
        <small>Selecciona una insitución para ver sus cooperaciones</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" href="#modal-registrar_nueva_institucion">Registrar nueva Institución aliada</button>
      <br>
      <div class="row">
        <div class="col-md-6"><!--Instituciones-->
          <div class="box box-primary box-solid">
            <div class="box-header">
              <h4 class="box-title">Instituciones</h4>
            </div>
            <div class="box-body table-resposive">
              <table id="example2" class="table table-striped table-hover">
                <?php 
                  if (count($alianzas)==0) {
                    echo "No se ha registrado ninguna alianza";
                  } else {
                    $cadena = '<thead><tr><th>Institución</th><th>Tipo</th><th>Desde</th><th>Dirección</th></tr></thead><tbody>';
                    foreach ($alianzas as $row) {
                      $cadena .= '<tr><td><a href="">'.$row["alliance_name"].'</a></td><td>'.$row["alliance_type"].'</td><td>'.$row["alliance_beg_time"].'</td><td>'.$row["alliane_adress"].'</td></tr>';
                    }
                    $cadena .= '</tbody>';
                    echo $cadena;
                  }
                ?>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6"   ><!--Cooperaciones-->
          <div class="box box-primary box-solid">
            <div class="box-header">
              <h4 class="box-title">Participaciones de <b>Municipalidad de San José</b></h4><br>
              <small class="pull-right">Ha participado en <b>10</b> clases</small>
            </div>
            <div class="box-body"> <!--Cooperaciones-->
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Módulo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>01/02/2018</td>
                    <td>Introducción a la informática</td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_clase">
                        ver clase
                      </a>
                    </td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_cooperacion">
                        ver participación
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>01/02/2018</td>
                    <td>Mercadeo</td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_clase">
                        ver clase
                      </a>
                    </td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_cooperacion">
                        ver participación
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>01/02/2018</td>
                    <td>Administración</td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_clase">
                        ver clase
                      </a>
                    </td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_cooperacion">
                        ver participación
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>01/02/2018</td>
                    <td>Contabilidad</td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_clase">
                        ver clase
                      </a>
                    </td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_cooperacion">
                        ver participación
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>01/02/2018</td>
                    <td>Matemáticas</td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_clase">
                        ver clase
                      </a>
                    </td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_cooperacion">
                        ver participación
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>01/02/2018</td>
                    <td>Aduanas</td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_clase">
                        ver clase
                      </a>
                    </td>
                    <td>
                      <a data-toggle="modal" href="#modal-ver_cooperacion">
                        ver participación
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-ver_cooperacion"><!--Ver cooperacion-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Cruz Roja</h4>
            </div>
            <div class="modal-body">
              <div class="box-body" style="text-align:justify;">
                Participó enviando un isntructor que dico 3 horas a dar clases de primeros auxilios. Brindó las herramientas necesarias para realizar la práctica respectiva. Realizó la evaluación de los estudiantes.
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-ver_clase"><!--Ver clase-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Clase Impartida</h4>
            </div>
            <div class="modal-body">
              <div class="box-body" style="text-align:justify;">
                <div class="col-sm-6"><!--Datos de la Clase-->
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
                <div class="col-sm-6"><!--Alumnos-->
                  <div class="box box-solid box-info" id="matriculados">
                    <div class="box-header">
                    <h4 class="box-title">Beneficiarios asistentes</h4>
                    </div>
                    <!-- /.box-header -->
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
                <div class="col-sm-12"><!--Alianzas-->
                  <div class="box box-solid box-info" id="matriculados">
                    <div class="box-header">
                      <h4 class="box-title">Instituciones participantes</h4>
                    </div>
                    <!-- /.box-header -->
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-registrar_nueva_institucion"><!--Nueva alianza-->
        <div class="modal-dialog">
          <form role="form" action="../controller/registrar_alianza.php" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar nueva Institución</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">Nombre de la Institución</label>
                    <input type="text" class="form-control" id="nombreInstitucion" name="nombreInstitucion" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Tipo de Institución</label>
                    <input type="text" class="form-control" id="tipoInstitucion" name="tipoInstitucion" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Dirección</label>
                      <textarea class="form-control" rows="3" id="direccion" name="direccion" required></textarea>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Inicio de la Alianza</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" required>
                    </div>
                  </div>
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