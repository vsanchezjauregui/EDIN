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
                      <option value="AF">Afganistán</option>
                      <option value="AL">Albania</option>
                      <option value="DE">Alemania</option>
                      <option value="AD">Andorra</option>
                      <option value="AO">Angola</option>
                      <option value="AI">Anguilla</option>
                      <option value="AQ">Antártida</option>
                      <option value="AG">Antigua y Barbuda</option>
                      <option value="AN">Antillas Holandesas</option>
                      <option value="SA">Arabia Saudí</option>
                      <option value="DZ">Argelia</option>
                      <option value="AR">Argentina</option>
                      <option value="AM">Armenia</option>
                      <option value="AW">Aruba</option>
                      <option value="AU">Australia</option>
                      <option value="AT">Austria</option>
                      <option value="AZ">Azerbaiyán</option>
                      <option value="BS">Bahamas</option>
                      <option value="BH">Bahrein</option>
                      <option value="BD">Bangladesh</option>
                      <option value="BB">Barbados</option>
                      <option value="BE">Bélgica</option>
                      <option value="BZ">Belice</option>
                      <option value="BJ">Benin</option>
                      <option value="BM">Bermudas</option>
                      <option value="BY">Bielorrusia</option>
                      <option value="MM">Birmania</option>
                      <option value="BO">Bolivia</option>
                      <option value="BA">Bosnia y Herzegovina</option>
                      <option value="BW">Botswana</option>
                      <option value="BR">Brasil</option>
                      <option value="BN">Brunei</option>
                      <option value="BG">Bulgaria</option>
                      <option value="BF">Burkina Faso</option>
                      <option value="BI">Burundi</option>
                      <option value="BT">Bután</option>
                      <option value="CV">Cabo Verde</option>
                      <option value="KH">Camboya</option>
                      <option value="CM">Camerún</option>
                      <option value="CA">Canadá</option>
                      <option value="TD">Chad</option>
                      <option value="CL">Chile</option>
                      <option value="CN">China</option>
                      <option value="CY">Chipre</option>
                      <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
                      <option value="CO">Colombia</option>
                      <option value="KM">Comores</option>
                      <option value="CG">Congo</option>
                      <option value="CD">Congo, República Democrática del</option>
                      <option value="KR">Corea</option>
                      <option value="KP">Corea del Norte</option>
                      <option value="CI">Costa de Marfíl</option>
                      <option value="CR" selected="selected">Costa Rica</option>
                      <option value="HR">Croacia (Hrvatska)</option>
                      <option value="CU">Cuba</option>
                      <option value="DK">Dinamarca</option>
                      <option value="DJ">Djibouti</option>
                      <option value="DM">Dominica</option>
                      <option value="EC">Ecuador</option>
                      <option value="EG">Egipto</option>
                      <option value="SV">El Salvador</option>
                      <option value="AE">Emiratos Árabes Unidos</option>
                      <option value="ER">Eritrea</option>
                      <option value="SI">Eslovenia</option>
                      <option value="ES">España</option>
                      <option value="US">Estados Unidos</option>
                      <option value="EE">Estonia</option>
                      <option value="ET">Etiopía</option>
                      <option value="FJ">Fiji</option>
                      <option value="PH">Filipinas</option>
                      <option value="FI">Finlandia</option>
                      <option value="FR">Francia</option>
                      <option value="GA">Gabón</option>
                      <option value="GM">Gambia</option>
                      <option value="GE">Georgia</option>
                      <option value="GH">Ghana</option>
                      <option value="GI">Gibraltar</option>
                      <option value="GD">Granada</option>
                      <option value="GR">Grecia</option>
                      <option value="GL">Groenlandia</option>
                      <option value="GP">Guadalupe</option>
                      <option value="GU">Guam</option>
                      <option value="GT">Guatemala</option>
                      <option value="GY">Guayana</option>
                      <option value="GF">Guayana Francesa</option>
                      <option value="GN">Guinea</option>
                      <option value="GQ">Guinea Ecuatorial</option>
                      <option value="GW">Guinea-Bissau</option>
                      <option value="HT">Haití</option>
                      <option value="HN">Honduras</option>
                      <option value="HU">Hungría</option>
                      <option value="IN">India</option>
                      <option value="ID">Indonesia</option>
                      <option value="IQ">Irak</option>
                      <option value="IR">Irán</option>
                      <option value="IE">Irlanda</option>
                      <option value="BV">Isla Bouvet</option>
                      <option value="CX">Isla de Christmas</option>
                      <option value="IS">Islandia</option>
                      <option value="KY">Islas Caimán</option>
                      <option value="CK">Islas Cook</option>
                      <option value="CC">Islas de Cocos o Keeling</option>
                      <option value="FO">Islas Faroe</option>
                      <option value="HM">Islas Heard y McDonald</option>
                      <option value="FK">Islas Malvinas</option>
                      <option value="MP">Islas Marianas del Norte</option>
                      <option value="MH">Islas Marshall</option>
                      <option value="UM">Islas menores de Estados Unidos</option>
                      <option value="PW">Islas Palau</option>
                      <option value="SB">Islas Salomón</option>
                      <option value="SJ">Islas Svalbard y Jan Mayen</option>
                      <option value="TK">Islas Tokelau</option>
                      <option value="TC">Islas Turks y Caicos</option>
                      <option value="VI">Islas Vírgenes (EEUU)</option>
                      <option value="VG">Islas Vírgenes (Reino Unido)</option>
                      <option value="WF">Islas Wallis y Futuna</option>
                      <option value="IL">Israel</option>
                      <option value="IT">Italia</option>
                      <option value="JM">Jamaica</option>
                      <option value="JP">Japón</option>
                      <option value="JO">Jordania</option>
                      <option value="KZ">Kazajistán</option>
                      <option value="KE">Kenia</option>
                      <option value="KG">Kirguizistán</option>
                      <option value="KI">Kiribati</option>
                      <option value="KW">Kuwait</option>
                      <option value="LA">Laos</option>
                      <option value="LS">Lesotho</option>
                      <option value="LV">Letonia</option>
                      <option value="LB">Líbano</option>
                      <option value="LR">Liberia</option>
                      <option value="LY">Libia</option>
                      <option value="LI">Liechtenstein</option>
                      <option value="LT">Lituania</option>
                      <option value="LU">Luxemburgo</option>
                      <option value="MK">Macedonia, Ex-República Yugoslava de</option>
                      <option value="MG">Madagascar</option>
                      <option value="MY">Malasia</option>
                      <option value="MW">Malawi</option>
                      <option value="MV">Maldivas</option>
                      <option value="ML">Malí</option>
                      <option value="MT">Malta</option>
                      <option value="MA">Marruecos</option>
                      <option value="MQ">Martinica</option>
                      <option value="MU">Mauricio</option>
                      <option value="MR">Mauritania</option>
                      <option value="YT">Mayotte</option>
                      <option value="MX">México</option>
                      <option value="FM">Micronesia</option>
                      <option value="MD">Moldavia</option>
                      <option value="MC">Mónaco</option>
                      <option value="MN">Mongolia</option>
                      <option value="MS">Montserrat</option>
                      <option value="MZ">Mozambique</option>
                      <option value="NA">Namibia</option>
                      <option value="NR">Nauru</option>
                      <option value="NP">Nepal</option>
                      <option value="NI">Nicaragua</option>
                      <option value="NE">Níger</option>
                      <option value="NG">Nigeria</option>
                      <option value="NU">Niue</option>
                      <option value="NF">Norfolk</option>
                      <option value="NO">Noruega</option>
                      <option value="NC">Nueva Caledonia</option>
                      <option value="NZ">Nueva Zelanda</option>
                      <option value="OM">Omán</option>
                      <option value="NL">Países Bajos</option>
                      <option value="PA">Panamá</option>
                      <option value="PG">Papúa Nueva Guinea</option>
                      <option value="PK">Paquistán</option>
                      <option value="PY">Paraguay</option>
                      <option value="PE">Perú</option>
                      <option value="PN">Pitcairn</option>
                      <option value="PF">Polinesia Francesa</option>
                      <option value="PL">Polonia</option>
                      <option value="PT">Portugal</option>
                      <option value="PR">Puerto Rico</option>
                      <option value="QA">Qatar</option>
                      <option value="UK">Reino Unido</option>
                      <option value="CF">República Centroafricana</option>
                      <option value="CZ">República Checa</option>
                      <option value="ZA">República de Sudáfrica</option>
                      <option value="DO">República Dominicana</option>
                      <option value="SK">República Eslovaca</option>
                      <option value="RE">Reunión</option>
                      <option value="RW">Ruanda</option>
                      <option value="RO">Rumania</option>
                      <option value="RU">Rusia</option>
                      <option value="EH">Sahara Occidental</option>
                      <option value="KN">Saint Kitts y Nevis</option>
                      <option value="WS">Samoa</option>
                      <option value="AS">Samoa Americana</option>
                      <option value="SM">San Marino</option>
                      <option value="VC">San Vicente y Granadinas</option>
                      <option value="SH">Santa Helena</option>
                      <option value="LC">Santa Lucía</option>
                      <option value="ST">Santo Tomé y Príncipe</option>
                      <option value="SN">Senegal</option>
                      <option value="SC">Seychelles</option>
                      <option value="SL">Sierra Leona</option>
                      <option value="SG">Singapur</option>
                      <option value="SY">Siria</option>
                      <option value="SO">Somalia</option>
                      <option value="LK">Sri Lanka</option>
                      <option value="PM">St Pierre y Miquelon</option>
                      <option value="SZ">Suazilandia</option>
                      <option value="SD">Sudán</option>
                      <option value="SE">Suecia</option>
                      <option value="CH">Suiza</option>
                      <option value="SR">Surinam</option>
                      <option value="TH">Tailandia</option>
                      <option value="TW">Taiwán</option>
                      <option value="TZ">Tanzania</option>
                      <option value="TJ">Tayikistán</option>
                      <option value="TF">Territorios franceses del Sur</option>
                      <option value="TP">Timor Oriental</option>
                      <option value="TG">Togo</option>
                      <option value="TO">Tonga</option>
                      <option value="TT">Trinidad y Tobago</option>
                      <option value="TN">Túnez</option>
                      <option value="TM">Turkmenistán</option>
                      <option value="TR">Turquía</option>
                      <option value="TV">Tuvalu</option>
                      <option value="UA">Ucrania</option>
                      <option value="UG">Uganda</option>
                      <option value="UY">Uruguay</option>
                      <option value="UZ">Uzbekistán</option>
                      <option value="VU">Vanuatu</option>
                      <option value="VE">Venezuela</option>
                      <option value="VN">Vietnam</option>
                      <option value="YE">Yemen</option>
                      <option value="YU">Yugoslavia</option>
                      <option value="ZM">Zambia</option>
                      <option value="ZW">Zimbabue</option>
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