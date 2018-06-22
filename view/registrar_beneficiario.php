<?php 
if(isset($_GET['variable'])) {
    if ($_GET['variable']) {
      echo '<script language="javascript">alert("Se almacenó con éxito");</script>';
    }else{
      echo '<script language="javascript">alert("Ocurrió un error en el envío. Intentelo de nuevo.");</script>';
    }
}
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EDIN | Nuevo beneficiario</title>
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
        Crear Nuevo Beneficiario
        <small>Ingresa los datos del nuevo participante</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <!-- form start -->
      <form role="form" action="../controller/crear_beneficiario.php" method="post">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-info" id="datosPersonales">
              <div class="box-header with-border">
                <h3 class="box-title">Datos Personales</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <small>(Campo obligatorio)</small>
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre del beneficiario" required>
                </div>
                
                <div class="form-group">
                  <label class="control-label">Apellidos</label>
                  <small>(Campo obligatorio)</small>
                  <input type="text" class="form-control" name="apellidos" placeholder="Ingrese ambos apellidos" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Cédula</label>
                  <small>(Campo obligatorio)</small>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-id-card-o"></i>
                    </div>
                    <input type="text" class="form-control" name="cedula" data-inputmask='"mask": "9-9999-9999"' data-mask required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Estado Civil</label>
                  <input type="text" class="form-control" name="estadoCivil" placeholder="">
                </div>
                <div class="form-group">
                  <label class="control-label">Número de hijos</label>
                  <input type="number" min="0" class="form-control" name="hijos" placeholder="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nacionalidad</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-globe"></i>
                    </div>
                    <select class="form-control select2" style="width: 100%;" name="nacionalidad">
                      <option value="Afganistan">Afganistán</option>
                      <option value="Alemania">Alemania</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                      <option value="Antillas Holandesas">Antillas Holandesas</option>
                      <option value="Arabia Saudi">Arabia Saudí</option>
                      <option value="Argelia">Argelia</option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaiyan">Azerbaiyán</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrein">Bahrein</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belgica">Bélgica</option>
                      <option value="Belice">Belice</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermudas">Bermudas</option>
                      <option value="Bielorrusia">Bielorrusia</option>
                      <option value="Birmania">Birmania</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Brasil">Brasil</option>
                      <option value="Brunei">Brunei</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Butan">Bután</option>
                      <option value="Cabo Verde">Cabo Verde</option>
                      <option value="Camboya">Camboya</option>
                      <option value="Camerun">Camerún</option>
                      <option value="Canada">Canadá</option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Chipre">Chipre</option>
                      <option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comores">Comores</option>
                      <option value="Congo">Congo</option>
                      <option value="Congo, República Democratica">Congo, República Democrática</option>
                      <option value="Corea">Corea</option>
                      <option value="Corea del Norte">Corea del Norte</option>
                      <option value="Costa de Marfil">Costa de Marfíl</option>
                      <option value="Costa Rica" selected="selected">Costa Rica</option>
                      <option value="Croacia">Croacia</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Dinamarca">Dinamarca</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egipto">Egipto</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Eslovenia">Eslovenia</option>
                      <option value="España">España</option>
                      <option value="Estados Unidos">Estados Unidos</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Etiopia">Etiopía</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Filipinas">Filipinas</option>
                      <option value="Finlandia">Finlandia</option>
                      <option value="Francia">Francia</option>
                      <option value="Gabon">Gabón</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Granada">Granada</option>
                      <option value="Grecia">Grecia</option>
                      <option value="Groenlandia">Groenlandia</option>
                      <option value="Guadalupe">Guadalupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guayana">Guayana</option>
                      <option value="Guayana Francesa">Guayana Francesa</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
                      <option value="Guinea-Bissau">Guinea-Bissau</option>
                      <option value="Haiti">Haití</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hungria">Hungría</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Inglaterra">Inglaterra</option>
                      <option value="Irak">Irak</option>
                      <option value="Iran">Irán</option>
                      <option value="Irlanda">Irlanda</option>
                      <option value="Isla Bouvet">Isla Bouvet</option>
                      <option value="Isla de Christmas">Isla de Christmas</option>
                      <option value="Islandia">Islandia</option>
                      <option value="Islas Caiman">Islas Caimán</option>
                      <option value="Islas Cook">Islas Cook</option>
                      <option value="Islas de Cocos">Islas de Cocos</option>
                      <option value="Islas Faroe">Islas Faroe</option>
                      <option value="Islas Heard y McDonald">Islas Heard y McDonald</option>
                      <option value="Islas Malvinas">Islas Malvinas</option>
                      <option value="Islas Marianas del Norte">Islas Marianas del Norte</option>
                      <option value="Islas Marshall">Islas Marshall</option>
                      <option value="Islas menores de Estados Unidos">Islas menores de Estados Unidos</option>
                      <option value="Islas Palau">Islas Palau</option>
                      <option value="Islas Salomón">Islas Salomón</option>
                      <option value="Islas Svalbard y Jan Mayen">Islas Svalbard y Jan Mayen</option>
                      <option value="Islas Tokelau">Islas Tokelau</option>
                      <option value="Islas Turks y Caicos">Islas Turks y Caicos</option>
                      <option value="Islas Wallis y Futuna">Islas Wallis y Futuna</option>
                      <option value="Israel">Israel</option>
                      <option value="Italia">Italia</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japon">Japón</option>
                      <option value="Jordania">Jordania</option>
                      <option value="Kazajistan">Kazajistán</option>
                      <option value="Kenia">Kenia</option>
                      <option value="Kirguizistan">Kirguizistán</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Laos">Laos</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Letonia">Letonia</option>
                      <option value="Libano">Líbano</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libia">Libia</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lituania">Lituania</option>
                      <option value="Luxemburgo">Luxemburgo</option>
                      <option value="Macedonia">Macedonia</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malasia">Malasia</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Maldivas">Maldivas</option>
                      <option value="Mali">Malí</option>
                      <option value="Malta">Malta</option>
                      <option value="Marruecos">Marruecos</option>
                      <option value="Martinica">Martinica</option>
                      <option value="Mauricio">Mauricio</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">México</option>
                      <option value="Micronesia">Micronesia</option>
                      <option value="Moldavia">Moldavia</option>
                      <option value="Monaco">Mónaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Níger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk">Norfolk</option>
                      <option value="Noruega">Noruega</option>
                      <option value="Nueva Caledonia">Nueva Caledonia</option>
                      <option value="Nueva Zelanda">Nueva Zelanda</option>
                      <option value="Omán">Omán</option>
                      <option value="Países Bajos">Países Bajos</option>
                      <option value="Panama">Panamá</option>
                      <option value="Papua Nueva Guinea">Papúa Nueva Guinea</option>
                      <option value="Paquistan">Paquistán</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Perú</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Polinesia Francesa">Polinesia Francesa</option>
                      <option value="Polonia">Polonia</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Reino Unido">Reino Unido</option>
                      <option value="Republica Centroafricana">República Centroafricana</option>
                      <option value="Republica Checa">República Checa</option>
                      <option value="Republica de Sudáfrica">República de Sudáfrica</option>
                      <option value="Repuulica Dominicana">República Dominicana</option>
                      <option value="Republica Eslovaca">República Eslovaca</option>
                      <option value="Reunion">Reunión</option>
                      <option value="Ruanda">Ruanda</option>
                      <option value="Rumania">Rumania</option>
                      <option value="Rusia">Rusia</option>
                      <option value="Sahara Occidental">Sahara Occidental</option>
                      <option value="Saint Kitts y Nevis">Saint Kitts y Nevis</option>
                      <option value="Samoa">Samoa</option>
                      <option value="Samoa Americana">Samoa Americana</option>
                      <option value="San Marino">San Marino</option>
                      <option value="San Vicente y Granadinas">San Vicente y Granadinas</option>
                      <option value="Santa Helena">Santa Helena</option>
                      <option value="Santa Lucia">Santa Lucía</option>
                      <option value="Santo Tome y Principe">Santo Tomé y Príncipe</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leona">Sierra Leona</option>
                      <option value="Singapur">Singapur</option>
                      <option value="Siria">Siria</option>
                      <option value="Somalia">Somalia</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="St Pierre y Miquelon">St Pierre y Miquelon</option>
                      <option value="Suazilandia">Suazilandia</option>
                      <option value="Sudan">Sudán</option>
                      <option value="Suecia">Suecia</option>
                      <option value="Suiza">Suiza</option>
                      <option value="Surinam">Surinam</option>
                      <option value="Tailandia">Tailandia</option>
                      <option value="Taiwa">Taiwán</option>
                      <option value="Tanzania">Tanzania</option>
                      <option value="Tayikistan">Tayikistán</option>
                      <option value="Timor Oriental">Timor Oriental</option>
                      <option value="Togo">Togo</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                      <option value="Tunez">Túnez</option>
                      <option value="Turkmenistan">Turkmenistán</option>
                      <option value="Turquia">Turquía</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Ucrania">Ucrania</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistán</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Vietnam">Vietnam</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Yugoslavia">Yugoslavia</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabue">Zimbabue</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label class="control-label">Fecha de Nacimiento</label>
                    <small>(Campo obligatorio)</small> 
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="fecha_nacimiento" name="fecha_nacimiento" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label>Genero</label>
                    <div class="col-sm-12" >
                    <label>
                      <input type="radio" class="minimal" name="genero" value="Masculino" checked>
                    </label>
                    <label>
                      Masculino
                    </label>
                    <label>
                      <input type="radio" class="minimal-red" name="genero" value="Femenino">
                    </label>
                    <label>
                      Femenino
                    </label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Años como indigente</label>
                      <input type="number" min="0" class="form-control" name="indigencia" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Profesión u oficio</label>
                  <input type="text" class="form-control" name="profesion" placeholder="">
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box box-info" id="nivelAcademico">
              <div class="box-header with-border">
                <h3 class="box-title">Nivel Académico</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label class="control-label">Último título adquirido</label>
                  <input type="text" class="form-control" name="ultimoTitulo">
                </div>
                <div class="form-group">
                  <label class="control-label">Centro de estudios</label>
                  <input type="text" class="form-control" name="centroEstudios">
                </div>
                <div class="form-group">
                  <label class="control-label">Año de culminación</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="anoCulminacion" data-inputmask='"mask": "9999"' data-mask>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info" id="direccion">
              <div class="box-header with-border">
                <h3 class="box-title">Dirección</h3>
              </div>
              <!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">Provincia</label>
                    <select class="form-control select2" style="width: 100%;" id="provincia" name="provincia">
                      <option value="1" cheked>San José</option>
                      <option value="3">Cartago</option>
                      <option value="4">Heredia</option>
                      <option value="6">Puntarenas</option>
                      <option value="2">Alajuela</option>
                      <option value="7">Limón</option>
                      <option value="5">Guanacaste</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Cantón</label>
                    <select class="form-control select2" style="width: 100%;" id="canton" name="canton" required>
                      <option value="11">Acosta</option>
                      <option value="9">Alajuelita</option>
                      <option value="5">Aserri</option>
                      <option value="17">Curridabat</option>
                      <option value="3">Desamparados</option>
                      <option value="16">Dota</option>
                      <option value="2">Escazu</option>
                      <option value="7">Goicoechea</option>
                      <option value="19">Leon Cortez</option>
                      <option value="14">Montes de Oca</option>
                      <option value="6">Mora</option>
                      <option value="13">Moravia</option>
                      <option value="18">Perez Zeledon</option>
                      <option value="4">Puriscal</option>
                      <option value="1" cheked>San Jose</option>
                      <option value="8">Santa Ana</option>
                      <option value="12">Tibas</option>
                      <option value="15">Turrubares</option>
                      <option value="10">Vasquez de Coronado</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Distrito</label>
                    <select class="form-control select2" style="width: 100%;" id="distrito" name="distrito" required>
                      <option value="1" cheked>Carmen</option>
                      <option value="4">Catedral</option>
                      <option value="10">Hatillo</option>
                      <option value="3">Hospital</option>
                      <option value="8">Mata Redonda</option>
                      <option value="2">Merced</option>
                      <option value="9">Pavas</option>
                      <option value="6">San Francisco de Dos Rios</option>
                      <option value="11">San Sebastian</option>
                      <option value="7">Uruca</option>
                      <option value="5">Zapote</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Señas</label>
                    <textarea class="form-control" rows="3" name="senas" ></textarea>
                  </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box box-info" id="datosContacto">
              <div class="box-header with-border">
                <h3 class="box-title">Datos de contacto</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label class="control-label">Teléfono casa</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-home"></i>
                    </div>
                    <input type="text" class="form-control" name="telCasa" data-inputmask='"mask": "9999-9999"' data-mask>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Teléfono oficina</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-building"></i>
                    </div>
                    <input type="text" class="form-control" name="telOfinina" data-inputmask='"mask": "9999-9999"' data-mask>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Teléfono celular</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-mobile"></i>
                    </div>
                    <input type="text" class="form-control" name="telCelular" data-inputmask='"mask": "9999-9999"' data-mask>
                  </div>
                <div class="form-group">
                  <label class="control-label">Correo electrónico</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email" class="form-control" name="correo">
                  </div>
                </div>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box box-info" id="informacionMedica">
              <div class="box-header with-border">
                <h3 class="box-title">Información Médica</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label class="control-label">Enfermedades</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-heartbeat"></i>
                    </div>
                    <input type="text" class="form-control" name="enfermedades" placeholder="Especifique">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Medicamentos</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-medkit"></i>
                    </div>
                    <input type="text" class="form-control" name="medicamentos" placeholder="Especifique">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
        <input type="submit" class="btn btn-block btn-primary btn-flat" value="Registrar"></input>
      </form>
      <div class="modal fade" id="modal-exito"><!--Ver cooperacion-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <div class="box-body" style="text-align:justify;">
                Beneficiario almacenado con éxito
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-error"><!--Ver cooperacion-->
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <div class="box-body" style="text-align:justify;">
                No se pudo almacenar el beneficiario
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
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
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="../controller/java.js"></script>

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
</script>
</body>
</html>