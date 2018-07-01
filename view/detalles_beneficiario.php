<?php  
    require_once '../model/conexion.php';
    $beneficiario = $_GET["idbeneficiario"];
    $conex =  new ConexionMySQL();
    $resulta = $conex->conectar();
    $query_datos = "SELECT * from Beneficiaries WHERE id_Beneficiaries=$beneficiario";
    $query_modulos = "SELECT (SELECT open_mods.id_Open_mods FROM open_mods WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as id, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM `open_mods` WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as MODULO,  bridge_benef_openmods.status_benef, (SELECT open_mods.open_mod_date_from FROM open_mods WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as FECHA, (SELECT open_mods.open_mod_value FROM open_mods WHERE open_mods.id_Open_mods = bridge_benef_openmods.id_open_mod) as VALOR FROM bridge_benef_openmods WHERE bridge_benef_openmods.id_beneficiary=$beneficiario;";
    $query_modulos_ganados = "SELECT COUNT(*) AS ganados FROM bridge_benef_openmods WHERE bridge_benef_openmods.status_benef = 'ganado' and bridge_benef_openmods.id_beneficiary=$beneficiario;";
    $query_clases = "SELECT (SELECT (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules ) FROM `open_mods` WHERE open_mods.id_Open_mods = classes.id_Open_mods ) FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes ) as MODULO, ( SELECT classes.class_date FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes ) as FECHA, ( SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes ) as DURACION FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries=$beneficiario;";
    $query_horas = "SELECT SUM((SELECT classes.class_time FROM classes WHERE classes.id_Classes = bridge_class_benef.id_classes)) as total_horas FROM bridge_class_benef WHERE bridge_class_benef.id_Beneficiaries=$beneficiario;";
    $query_pagos = "SELECT payments.payment_date as fecha, (SELECT (SELECT modules.module_name FROM modules WHERE modules.id_Modules = open_mods.id_Modules) FROM open_mods WHERE open_mods.id_Open_mods = payments.id_open_mod) as modulo, payments.payment_value as bolsas, payments.id_open_mod as id_mod FROM payments WHERE payments.id_beneficiary = $beneficiario;";
    $con = $conex->usarConexion();
    $horas_recibidas = $conex->consultaunica($query_horas, $con); 
    $datos_beneficiario = $conex->consulta_varios($query_datos, $con);
    $modulos_matriculados = $conex->consulta_varios($query_modulos, $con);
    $clases_recibidas = $conex->consulta_varios($query_clases, $con);
    $pagos_realizados = $conex->consulta_varios($query_pagos, $con);
    $total_modulos = $conex->consultaunica($query_modulos_ganados, $con);
    $deudas = [];
    $deuda_total = 0;
    foreach ($modulos_matriculados as $row) {
      $pago_modulo = 0;
      foreach ($pagos_realizados as $row2) {
        if ($row2["id_mod"]==$row["id"]) {
          $pago_modulo += $row2["bolsas"];
        }
      }
      $deuda = $row["VALOR"] - $pago_modulo;
      if ($deuda>0) {
        array_push($deudas, array($deuda, $row["MODULO"], $row["id"]));
      }

      $deuda_total += $deuda;
    }
    $conex->destruir();
    $total_mods = count($modulos_matriculados);
    $total_clases = count($clases_recibidas);
    $total_pagos = 0;
    foreach ($pagos_realizados as $row) {
      $total_pagos += $row["bolsas"];
    }
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDIN | Detalles del Beneficiario</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12"><!--Datos personales-->
          <div class="box box-info">
            <div class="box-header with-border">
              <?php
                foreach ($datos_beneficiario as $row) {
                  echo '<h3 "box-title">'.$row["beneficiary_name"].' '.$row["beneficiary_last_name"].'</h3>';
                };
              ?>
                
            </div>
            <div class="box-body">
              <div class="row ">
                <div class="col-md-4">
                  <div class="box">
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-calendar"></i>
                        Fecha de Nacimiento: 
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.$row["beneficiary_birth"].'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-birthday-cake"></i>
                        Edad
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            $naciemiento = new DateTime($row["beneficiary_birth"]);
                            $hoy = new DateTime();
                            $edad = $hoy->diff($naciemiento)->y;
                          };
                        ?>
                        <b><?php echo $edad ?> años</b>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-globe"></i>
                        Nacionalidad  
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<img src="dist/img/flags/md/'.$row["beneficiary_nationality"].'.png" alt="'.$row["beneficiary_nationality"].'">';
                          };
                        ?>
                          
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-id-card"></i>
                        Cédula
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            $cedula = $row["beneficiary_id_num"];
                            echo '<b>'.$cedula[0].'-'.substr($cedula,1,4).'-'.substr($cedula,5,4).'</b>';
                          };
                        ?>
                        
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-diamond"></i>
                        Estado civil
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.$row["beneficiary_marital_status"].'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-child"></i>
                        Número de hijos
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.$row["beneficiary_sons"].'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-venus-mars"></i>
                        Género
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_gender"]).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-7">
                        <i class="fa fa-briefcase"></i>
                        Profesión u oficio
                      </div>
                      <div class="col-sm-5">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_profesion"]).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box" style="height: 220px">
                    <div class="form-group">
                      <div class="col-sm-6">
                        Provincia
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_province"]).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        Cantón
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_canton"]).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        Distrito
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_district"]).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        Señas
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_addres"]).'</b>';
                          };
                        ?>
                      </div><br>
                    </div><br>
                    <br>
                  </div>
                  <div class="box">
                    <div class="form-group">
                      <div class="col-sm-6">
                        Último título adquirido
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_degree"]).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        Centro de estudios
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.ucfirst($row["beneficiary_study_center"]).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        Año de culminación
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.$row["beeficiary_degree_year"].'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box">
                    <div class="form-group">
                      <div class="col-sm-6">
                        Teléfono de casa
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            $telefono = $row["beneficiary_house_phone"];
                            echo '<b>'.substr($telefono,0,4).'-'.substr($telefono,5,4).'</b>';
                          };
                        ?>
                      </div>
                    </div>  
                    <br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        Teléfono celular
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            $telefono = $row["beneficiary_cell_phone"];
                            echo '<b>'.substr($telefono,0,4).'-'.substr($telefono,5,4).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        Teléfono trabajo
                      </div>
                      <div class="col-sm-6">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            $telefono = $row["beneficiary_office_phone"];
                            echo '<b>'.substr($telefono,0,4).'-'.substr($telefono,5,4).'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="col-sm-12" style="display: flex; justify-content: center;">
                        <?php
                          foreach ($datos_beneficiario as $row) {
                            echo '<b>'.$row["beneficiary_mail"].'</b>';
                          };
                        ?>
                      </div>
                    </div>
                    <br>
                  </div>
                  <div class="box">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-4">
                          Enfermedades
                        </div>
                        <div class="col-sm-8">
                        <?php
                            echo '<b>'.$row["beneificary_illness"].'</b>';
                        ?>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-sm-4">
                          Medicamentos
                        </div>
                        <div class="col-sm-8">
                        <?php
                            echo '<b>'.$row["beneficiary_meds"].'</b>';
                        ?>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12"><!--Clases y modulos-->
          <div class="col-md-6"><!--Modulos-->
            <div class="box box-success">
              <div class="box-header">
                <h4 class="box-title">Módulos Matriculados</h4>
                <small class="pull-right">Ha ganado <b><?php echo $total_modulos["ganados"];?></b> Módulos</small>
              </div>
              <div class="box-body">
                <?php
                    if ($total_mods==0) {
                      echo "No ha cursado ningún Módulo";
                    } else{
                      echo '<table id="example2" class="table table-striped table-hover"><thead><tr><th>Fecha Matrícula</th><th>Módulo</th><th>Estado</th></tr></thead><tbody>';
                      foreach ($modulos_matriculados as $row) {
                        echo '<tr><td>'.$row["FECHA"].'</td><td>'.$row["MODULO"].'</td><td>'.ucfirst($row["status_benef"]).'</td></tr>';
                      };
                      echo '</tbody></table>';
                    }
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-6"><!--Clases-->
            <div class="box box-success">
              <div class="box-header">
                <h4 class="box-title">Clases recibidas</h4>
                <small class="pull-right">Ha recibido <b><?php if (is_null($horas_recibidas["total_horas"])) {
                  echo "0";
                }else{
                  echo $horas_recibidas["total_horas"];
                };?></b> horas de formación</small>
              </div>
              <div class="box-body">
                <?php
                    if (is_null($horas_recibidas[0])) {
                      echo "No ha recibido ninguna Clase";
                    } else{
                      echo '<table id="example1" class="table table-striped table-hover"><thead><tr><th>Fecha</th><th>Módulo</th><th>Horas</th></tr></thead><tbody>';
                      foreach ($clases_recibidas as $row) {
                        echo '<tr><td>'.$row["FECHA"].'</td><td>'.$row["MODULO"].'</td><td>'.$row["DURACION"].'</td></tr>';
                      };
                      echo '</tbody></table>';
                    }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12" id="padosydeudas" name="pagosydeudas"><!--Pagos y deudas-->
          <div class="col-md-6"><!--Pagos-->
            <div class="box box-warning">
              <div class="box-header">
                <h4 class="box-title">Pagos realizados</h4>
                <small class="pull-right">Ha pagado con <b><?php echo $total_pagos?></b> bolsas</small>
              </div>
              <div class="box-body">
                <?php
                    if ($total_pagos==0) {
                      echo "No ha realizado ningún pago";
                    } else{
                      echo '<table id="example3" class="table table-striped table-hover"><thead><tr><th>Fecha</th><th>Módulo</th><th>Bolsas pagadas</th></tr></thead><tbody>';
                      foreach ($pagos_realizados as $row) {
                        echo '<tr><td>'.$row["fecha"].'</td><td>'.$row["modulo"].'</td><td>'.$row["bolsas"].'</td></tr>';
                      };
                      echo '</tbody></table>';
                    }
                ?>
              </div>
            </div>
          </div>
          <div class="col-md-6"><!--Deudas-->
            <div class="box box-warning">
              <div class="box-header">
                <h4 class="box-title">Deudas pendientes</h4>
                <small class="pull-right">Debe <b><?php echo $deuda_total;?></b> bolsas</small>
              </div>
              <div class="box-body">
                <?php
                    if ($deuda_total==0) {
                      echo "No tiene deudas";
                    } else{
                      echo '<table id="example4" class="table table-striped table-hover"><thead><tr><th>Módulo</th><th>Saldo</th></tr></thead><tbody>';
                      /*echo "<pre>";
                      print_r($deudas);
                      echo "</pre>";*/
                      for ($i=0; $i < count($deudas) ; $i++) { 
                        
                          echo "<tr><td>".$deudas[$i][1]."</td><td>".$deudas[$i][0]."</td></tr>";
                        
                      }
                      echo '</tbody></table>';
                    }
                ?>

                <button type="button" class="btn btn-block btn-primary btn-flat" data-toggle="modal" href="#modal-registrar_pago"<?php if ($deuda_total==0) {echo 'style="display:none"';}?>>Registrar pago</button>
              </div>
            </div>
          </div>
        </div>
      <!--MODAL REISTRAR PAGO-->
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
                    <select class="form-control select2" style="width: 100%;" id="beneficiario" name="beneficiario">
                      <?php
                        foreach ($datos_beneficiario as $row) {
                          echo '<option value ="'.$row["id_Beneficiaries"].'">'.$row["beneficiary_name"].' '.$row["beneficiary_last_name"].'</option>';
                        };
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Módulo al que abona</label>
                    <select class="form-control select2" style="width: 100%;" id="moduloAbonado" name="moduloAbonado">
                      <?php
                        for ($i=0; $i < count($deudas) ; $i++) { 
                          echo '<option value="'.$deudas[$i][2].'-'.$deudas[$i][0].'">'.$deudas[$i][1].'</option>';
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">
                      Descripción del pago realizado
                      <small>(Cantidad de bolsas)</small>
                    </label>
                    <input class="form-control col-sm-2" type="number" id="valorPagado" name="valorPagado" min="0" required>
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
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>

<!-- page script -->
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

    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example4').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>