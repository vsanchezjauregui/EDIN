<?php  

  require_once '../model/conexion.php';
  $conex =  new ConexionMySQL();
  $resulta = $conex->conectar();
  $query_alianzas = "SELECT * FROM alliances;";
  $con = $conex->usarConexion();
  $alianzas = $conex->consulta_varios($query_alianzas, $con);
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDIN | Registrar Clase Impartida</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="dist/img/EduHCa Solo logo.png">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
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

<body class="hold-transition skin-blue sidebar-mini" >
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
        <li>
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
        Registrar clase impartida
        <small>Ingresa los datos de la clase se que se impartió</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row col-md-12" id="contenidoNO">
        <h4 style="text-align:center">No se pueden abrir módulos hasta que haya al menos un módulo abierto</h4>
        <div style="display:flex; justify-content:center">
            <button class="btn btn-primary" onclick="window.location.href='abrir_modulo.php'"><i class="fa fa-book"></i> Abrir un Módulo</button>
        </div>
      </div>
      <div class="row" id="contenidoSI">
        <!-- left column -->
        <div class="col-md-4"><!--Clase-->
          <div class="box box-info" id="nuevoModulo">
            <div class="box-body">
              <div class="form-group"><!--Tecnico-->
                <label class="control-label">Indique el Técnico</label>
                <select class="form-control" id="tecnico" name="tecnico">

                </select>
              </div>
              <div class="form-group"><!--Modulo-->
                <label class="control-label">Indique el Módulo</label>
                <select class="form-control" id="modulo" name="modulo" required>
                </select>
              </div>
              <div class="form-group"><!--Fecha-->
                <label class="control-label">Fecha en que se impartió</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" required>
                </div>
              </div>
              <div class="form-group"><!--Horas-->
                <label class="control-label">Horas de clase impartidas</label>
                <input type="number" min="0" class="form-control" id="horas" name="horas" required>
              </div>
              <div class="form-group"><!--Observaciones-->
                <label class="control-label">Observaciones</label>
                <textarea class="form-control" rows="3" id="observaciones" name="observaciones"></textarea>
              </div>                
            </div>
          </div>
        </div>
        <div class="col-md-4"><!--Alumnos-->
          <div class="box box-info" id="asistentes">
            <div class="box-header">
              <h3 class="box-title">Beneficiarios asistentes</h3>
            </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="box box-solid">
                <div class="box-body no-padding" id="tabla_matriculados">
                  <p style="text-align:center">
                    Seleccione un Módulo
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4"><!--Alianzas-->
          <div class="box box-info">
            <div class="box-header">
            <h3 class="box-title">Instituciones participantes</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
            <ul class="todo-list" id="participaciones_creadas" name="participaciones_creadas">
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix no-border">
            <?php 
              if (count($alianzas)==0) {
                echo '<button type="button" class="btn btn-default pull-right" disabled="true"><i class="fa fa-user-plus"></i> No hay insitituciones registradas</button>';
              } else{
                echo '<button type="button" class="btn btn-default pull-right" data-toggle="modal" href="#modal-agregar_alianza"><i class="fa fa-user-plus"></i> Agregar Institución</button>';
              }
            ?>
          </div>
          </div>
        </div>
        <div class="col-md-12">
          <button type="button" class="btn btn-block btn-primary btn-flat" onclick='registrarClase()' value="">Registrar</button>
        </div>
      </div>

      <div class="modal fade" id="modal-agregar_alianza"><!--Agregar alianza-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Agregar instituciones participantes</h4>
            </div>
            <div class="modal-body">
              <div class="box-body">
                <select class="form-control" id="alianza" name="alianza">
                  <?php 
                    foreach ($alianzas as $alianza) {
                      echo '<option value="'.$alianza["id_Alliances"].'">'.$alianza["alliance_name"].'</option>';
                    }
                  ?>
                </select>
                <br>
                <label>Describa la cooperación brindada por la Institución</label>
                <textarea class="form-control" rows="3" id="participacion" name="participacion"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Listo</button>
              <button type="button" class="btn btn-primary" onclick='crear()'>Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-ver_cooperacion" name="modal-ver_cooperacion"><!--Ver cooperacion-->
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
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>




<!-- Page script -->
<script>

  window.onload = function () {
    $.get("../controller/eliminar_temporal.php", { }, function(data) {});
    $.get("../model/contar_abiertos.php", { }, function(data) {
      if (data != 0) {
        document.getElementById("contenidoNO").setAttribute("style","display:none");
        document.getElementById("contenidoSI").setAttribute("style","display:block");
      } else {
        document.getElementById("contenidoSI").setAttribute("style","display:none");
        document.getElementById("contenidoNO").setAttribute("style","display:block");
      };
    });
  }
  
  function registrarClase(){
    $( function(){
      //Traigo los valores de la ventana
      var modulo = $("#modulo").val();
      var fecha = $("#datepicker").val();
      var horas = $("#horas").val();
      var alumnos = new Array();
      $('input[type=checkbox]:checked').each(function() {
          alumnos.push($(this).val());
      });
      var observaciones = $("#observaciones").val();

      //Hago las validaciones
      if (modulo == 0) {
        //Valido que el Modulo este selecionado
        alert("Por favor seleccione un módulo");
      } else if (fecha=='') {
        //Valido la fecha de la clase
        alert("Por favor seleccione la fecha en que se impartió");
      } else if (horas == '') {
        //Valido las horas impartidas
        alert("Por favor indique la cantidad de horas de clases impartidas");
      } else if (alumnos.length == 0) {
        //Valido que hayan alumnos asistentes
        alert("Por favor seleccione al menos un beneficiario asistente");
      } else {
        //Si paso todas las validaciones, Ejecuto el PHP que va a almacenar la clase
         $.get("../controller/crear_clase.php", { modulo: modulo, fecha : fecha, horas : horas, alumnos: alumnos, observaciones: observaciones}, function(data) {
         //alert(data);
         //Muestro una alerta con el mensaje de exito o error
         alert(data.split('=')[1]);
         //Recargo la pagina
         location.reload(true);
        });
      }
    })
  }
  function crear(){
    $( function(){
      var id_alianza = $("#alianza").val();
      var descripcion = $("#participacion").val();
      if (descripcion == '') {
        alert("Debe indicar la participación que realizó la institución");
      } else {
        $.get("../controller/agregar_participacion.php", { alianza: id_alianza, participacion : descripcion}, function(data) {
          $("#participaciones_creadas").empty();
          $("#participaciones_creadas").html(data);
          $("#participacion").val('');
          $("#alianza").find("option[value='"+id_alianza+"']").prop("disabled",true);
          $("#alianza").val('');
        });
        alert('Se agregó una participación a la clase. Puede agregar otra o haga click en "Listo" si desea continuar con el registro de la clase');
      };
    })
  }
  function participacion(id){
    $( function(){
      //alert("entro");
      $.get("../controller/cargar_participacion.php", { id: id}, function(data) {
        $("#modal-ver_cooperacion").empty();
        $("#modal-ver_cooperacion").html(data);
      });
    })
  }
  function eliminar(id){
    $( function(){
      $.get("../controller/eliminarparticipacion.php", { id: id}, function(data) {
        $("#participaciones_creadas").empty();
        $("#participaciones_creadas").html(data);
        $("#alianza").find("option[value='"+id+"']").prop("disabled",false);
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

    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });


    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<script src="../controller/registrar_clase.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
