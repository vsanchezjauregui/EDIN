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
    $finalizados = $finalizados["FINALIZADOS"];
    $abiertos = $conex->consultaunica($query_abiertos, $con);
    $abiertos = $abiertos["ABIERTOS"];
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
              <h4 class="box-title">Módulos en curso</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="panel" id="tabla_cursando">
              <?php
                          if ($abiertos == 0) {
                            echo "No hay módulos abiertos";
                          } else {
                            echo '  <table class="table table-hover">
                                      <thead>
                                        <tr>
                                            <th>Módulo</th>
                                            <th>Desde</th>
                                            <th>Horas</th>
                                            <th>Clases</th>
                                        </tr>
                                      </thead>
                                      <tbody >';
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
                            echo        '<tr>
                                            <td>'.$modulo["MODULO"].'</td>
                                            <td>'.$modulo["FECHA_FROM"].'</td>
                                            <td>'.$horas_modulo.' horas</td>
                                            <td><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$modulo["id"].'"><b>'.$clases_modulo.' clases</b></a></td>
                                        </tr>
                                        ';
                                echo    '<tr id="collapse'.$modulo["id"].'" class="panel-collapse collapse" style="text-align:right">
                                          <td colspan="5">';
                                foreach ($clases as $clase) {
                                  if ($clase["id_Open_mods"]==$modulo["id"]) {
                                    echo    $clase["class_date"].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$clase["class_time"].' horas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a data-toggle="modal" onclick="verclase('.$clase["id_Classes"].')" href="#modal-ver_clase">ver clase</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>';  

                                  }
                                }            
                                echo    ' </td>
                                        </tr>';
                              }
                            }
                                echo '</tbody>
                                    </table>
                                    ';
                          }
              ?>
              </div>
            </div>
          </div> 
          <div class="box box-primary box-solid">
            <div class="box-header">
              <h4 class="box-title">Módulos Finalizados</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="panel" id="tabla_finalizados">
                        <?php
                          if ($finalizados == 0) {
                            echo "No hay módulos finalizados";
                          } else {
                            echo '  <table class="table table-hover">
                                      <thead>
                                        <tr>
                                            <th>Módulo</th>
                                            <th>Desde</th>
                                            <th>Hasta</th>
                                            <th>Horas</th>
                                            <th>Clases</th>
                                        </tr>
                                      </thead>
                                      <tbody >';
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
                            echo        '<tr>
                                            <td>'.$modulo["MODULO"].'</td>
                                            <td>'.$modulo["FECHA_FROM"].'</td>
                                            <td>'.$modulo["FECHA_TO"].'</td>
                                            <td>'.$horas_modulo.' horas</td>
                                            <td><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$modulo["id"].'"><b>'.$clases_modulo.' clases</b></a></td>
                                        </tr>
                                        ';
                                echo    '<tr id="collapse'.$modulo["id"].'" class="panel-collapse collapse" style="text-align:right">
                                          <td colspan="5">';
                                foreach ($clases as $clase) {
                                  if ($clase["id_Open_mods"]==$modulo["id"]) {
                                    echo    $clase["class_date"].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$clase["class_time"].' horas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a data-toggle="modal" onclick="verclase('.$clase["id_Classes"].')" href="#modal-ver_clase">ver clase</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>';  

                                  }
                                }            
                                echo    ' </td>
                                        </tr>';
                              }
                            }
                                echo '</tbody>
                                    </table>
                                    ';
                          }
                        ?>        
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-3">
          <div class="box box-default collapsed-box box-solid" >
            <div class="box-header with-border" data-widget="collapse" style="cursor: pointer">
              <h3 class="box-title" data-widget="collapse" style="cursor: pointer">Opciones</h3>

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
      </div>

      <div class="modal fade" id="modal-cerrar_modulo"><!--Cerrar Modulo-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Cerrar Módulo</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Indique el Módulo que desea Cerrar</label>
                  <select class="form-control" id="modulo_a_cerrar" onchange="cargarmatriculados()">
                    <?php
                        echo '<option value"0"></option>';
                        foreach ($modulos as $modulo) {
                          if ($modulo["ESTATUS"] == 1) {
                            echo '<option value="'.$modulo["id"].'" cheked>'.$modulo["MODULO"].'</option>';
                          }
                        }
                    ?>
                  </select>
              </div>
              <div class="box-body no-padding" id="tabla_aprobados" name="tabla_aprobados" style="display: none">
                <label>Seleccione los beneficiarios que aprobaron el Módulo</label>
                <div class="mailbox-controls">
                  <!-- Check all button -->
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                  </button><small>   Seleccionar todos</small>
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
              <br>
              <strong>Advertencia!</strong> Una vez que guarde los cambios, el curso quedará como cerrado y no podrá registrar más clases impartidas en él.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" disabled="true" id="cerrar_modulo" onclick="validarCerrarModulo()">Cerrar Modulo</button>
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

function cargarmatriculados(){
    var modulo = document.getElementById("modulo_a_cerrar").value;
    if (modulo>0){
        document.getElementById("cerrar_modulo").removeAttribute("disabled");
        document.getElementById("tabla_aprobados").setAttribute("style", "display:block")
      $.get("../controller/cargar_matriculados.php", { modulo: modulo}, function(data) {
        $("#aprobados").val('');
        $("#aprobados").html(data);
        //alert(data);
      });    
    } else {
        document.getElementById("cerrar_modulo").setAttribute("disabled", "disabled");
        document.getElementById("tabla_aprobados").setAttribute("style", "display:none")
    }
    
}

function verclase(id){
    $( function(){
      //alert(id);
      $.get("../controller/cargar_clase.php", { id: id}, function(data) {
        $("#modal-ver_clase").empty();
        $("#modal-ver_clase").html(data);
        
      });
    })
}
function cerrarModulo(modulo, aprobados){
    $.get("../controller/cerrar_modulo.php", { modulo: modulo, aprobados: aprobados}, function(data) {
      $("#modulo_a_cerrar").find('option[value="'+modulo+'"]').remove();
      document.getElementById("tabla_aprobados").setAttribute("style", "display:none")
      alert(data);
    })
    $.get("../model/cargar_finalizadios.php", {}, function(data) {
      $("#tabla_finalizados").empty();
      $("#tabla_finalizados").html(data);
    });
    $.get("../model/cargar_abiertos.php", {}, function(data) {
      $("#tabla_cursando").empty();
      $("#tabla_cursando").html(data);
    });
}

function validarCerrarModulo(){
    var modulo = document.getElementById("modulo_a_cerrar").value;
    var aprobados = new Array();
    $('input[type=checkbox]:checked').each(function() {
        aprobados.push($(this).val());
    });
    
    if (aprobados.length==0){
      var r = confirm("Esta apunto de cerrar un módulo con ningún beneficiario aprobado. ¿Desea continuar?");
      if (r){
        cerrarModulo(modulo,aprobados)
      } 
    } else {
      cerrarModulo(modulo,aprobados)
    }
  }



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

    
</script>




</body>
</html>
