<?php
  require_once '../model/conexion.php';
  $conex =  new ConexionMySQL();
  $resulta = $conex->conectar();
  $con = $conex->usarConexion();
  $query_contar_beneficiarios = "SELECT COUNT(beneficiaries.id_Beneficiaries) as BENEFICIARIOS FROM beneficiaries";
  $query_contar_clases = "SELECT COUNT(classes.id_Classes) AS CLASES FROM classes";
  $query_contar_alianzas = "SELECT COUNT(alliances.id_Alliances) as ALIANZAS FROM alliances";
  $query_contar_pagos = "SELECT SUM(payments.payment_value) as BOLSAS FROM payments";
  $beneficiarios = $conex->consultaunica($query_contar_beneficiarios, $con);
  $clases = $conex->consultaunica($query_contar_clases, $con);
  $alianzas = $conex->consultaunica($query_contar_clases, $con);
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Información Gerencial EDIN | Municipalidad de San José</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="dist/img/EduHCa Solo logo.png">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        Bienvenidos al Sistema de Información Gerencial del Programa <strong>EDIN | Municipalidad de San José</strong>
      </h1>
    </section>
    <section class="content" >
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" >
            <div class="inner">
              <h3><?php echo $beneficiarios["BENEFICIARIOS"]?></h3>
              <p>Beneficiarios</p>
            </div>
            <div class="icon" onclick="window.location.href='registrar_beneficiario.php'" style="cursor:pointer">
              <i class="fa fa-users"></i>
            </div>
            <a href="listar_beneficiarios.php" class="small-box-footer">
              Ver todos <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?php echo $beneficiarios["BENEFICIARIOS"]?></h3>
              <p>Clases impartidas</p>
            </div>
            <div class="icon" onclick="window.location.href='registrar_clase.php'" style="cursor:pointer">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="ver_modulos_impartidos.php" class="small-box-footer">
              Ver todas <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $beneficiarios["BENEFICIARIOS"]?></h3>
              <p>Instituciones</p>
            </div>
            <div class="icon">
              <i class="fa fa-handshake-o"></i>
            </div>
            <a href="ver_instituciones.php" class="small-box-footer">
              Ver todas <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $beneficiarios["BENEFICIARIOS"]?><sup style="font-size: 15px"> bolsas</sup></h3>
              <p>Recolectadas</p>
            </div>
            <div class="icon">
              <i class="fa fa-recycle"></i>
            </div>
            <a href="registrar_pago.php" class="small-box-footer">
              Ver y reistrar pagos <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <!--<section class="content container-fluid">
      <input type="button" class="btn btn-flat btn-block"  onclick="window.open('../controller/verificar_conexion.php');" value="Probar"/>
    </section>-->
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

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>