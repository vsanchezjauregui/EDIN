<?php  
    require_once '../model/conexion.php';
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $query_alianzas = "SELECT * FROM alliances;";
    $con = $conex->usarConexion();
    $alianzas = $conex->consulta_varios($query_alianzas, $con);
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
            <li><a href="registrar_clase.php">Registrar clase impartida</a></li>
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
        <small>Selecciona una institución para ver sus cooperaciones</small>
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
                      $cadena .= '<tr><td><a onclick="verparticipaciones('.$row["id_Alliances"].')" style="cursor:pointer">'.$row["alliance_name"].'</a></td><td>'.$row["alliance_type"].'</td><td>'.$row["alliance_beg_time"].'</td><td>'.$row["alliane_adress"].'</td></tr>';
                    }
                    $cadena .= '</tbody>';
                    echo $cadena;
                  }
                ?>
              </table>
            </div>
          </div>
        </div>


        <div class="col-md-6"><!--Cooperaciones-->
          <div id="titulo_temp">
            <h4 >
              Seleccione una institución
            </h4>
          </div>
          <div id="bloque_participaciones" class="box box-primary box-solid" style="display:none">
          </div>
            
        </div>
      </div>
      <div class="modal fade" id="modal-ver_cooperacion" name="modal-ver_cooperacion"><!--Ver cooperacion-->
        <!--

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
        </div>
        -->
      </div>
      <div class="modal fade" id="modal-ver_clase"><!--Ver clase-->
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
  function verparticipaciones(idalianza){
    //alert(idalianza);
    document.getElementById("bloque_participaciones").setAttribute("style","display:block");
    document.getElementById("titulo_temp").setAttribute("style","display:none");
    $.get("../model/cargar_participaciones.php", {idalianza: idalianza}, function(data) {
      //alert(data);
      $("#bloque_participaciones").empty();
      $("#bloque_participaciones").html(data);
    });
  }

  function verclase(id){
    $( function(){
      //alert(id);
      $.get("../controller/cargar_clase.php", { id: id}, function(data) {
        //alert(data);
        $("#modal-ver_clase").empty();
        $("#modal-ver_clase").html(data);
        
      });
    })
  }
  function verparticipacion(clase, id){
    $( function(){
      $.get("../model/cargar_participacion.php", { id: id, clase: clase}, function(data) {
        //alert(data);
        $("#modal-ver_cooperacion").empty();
        $("#modal-ver_cooperacion").html(data);
      });
    })
  }
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