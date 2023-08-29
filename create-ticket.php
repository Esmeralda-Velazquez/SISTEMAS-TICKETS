<?php
session_start();
//echo $_SESSION['id'];
//$_SESSION['msg'];
include("dbconnection.php");
include("checklogin.php");
check_login();
if (isset($_POST['send'])) {
    $count_my_page = ("hitcounter.txt");
    $hits = file($count_my_page);
    $hits[0]++;
    $fp = fopen($count_my_page, "w");
    fputs($fp, "$hits[0]");
    fclose($fp);
    $tid = $hits[0];
    $user = $_SESSION['login'];
    $name = $_SESSION['name'];
    $area = $_SESSION['area'];
    $subject = $_POST['subject'];

    $tt = $_POST['tasktype']. " " . $_POST['equipoOption']. " ". $_POST['programasOption'];

    $priority = $_POST['priority'];
    $ticket = $_POST['description'];
    $st = "Abierto";
    $a = mysqli_query($con, "insert into ticket(ticket_id,email_id,subject,task_type,prioprity,ticket,status,posting_date,name,area,respuesta)  values('$tid','$user','$subject','$tt','$priority','$ticket','$st',NOW(),'$name','$area',0)");
    if ($a) {
        echo "<script>alert('Ticket Registrado Correctamente'); location.replace(document.referrer)</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="assets/img/icon.png"/>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>CWEB Crear Ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>

<body class="">
    <?php include("header.php"); ?>
    <div class="page-container row-fluid">
        <?php include("leftbar.php"); ?>
        <div class="clearfix"></div>
        <!-- END SIDEBAR MENU -->
    </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div id="portlet-config" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"></button>
                <h3>Widget Settings</h3>
            </div>
            <div class="modal-body"> Widget settings form goes here </div>
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <div class="page-title">
                <h3>Crear ticket</h3>
                <div class="row">
                    <div class="col-md-12">

                        <form class="form-horizontal" name="form1" method="post" action="" onSubmit="return valid();">
                            <div class="panel panel-default">

                                <div class="panel-body bg-white">
                                    <?php if (isset($_SESSION['msg1'])) : ?>
                                        <p align="center" style="color:#FF0000"><?= $_SESSION['msg1']; ?><?= $_SESSION['msg1'] = ""; ?></p>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Asunto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="subject" id="subject" value="" required class="form-control" />
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tipo de Tarea</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select name="tasktype" class="form-control select" required onchange="showSubOptions(this.value)">
                                            <option value="">Seleccionar</option>
                                            <option value="Equipo-">Equipo</option>
                                            <option value="Programa-">Programas</option>
                                            <option value="Internet">Internet</option>
                                            </select>
                                        </div>
                                        </div>

                                        <div id="subOptions" style="display: none;">
                                        <div id="equipoOptions" style="display: none;">
                                            <label>Equipo:</label>
                                            <select name="equipoOption" class="form-control select">
                                            <option value="">Seleccionar</option>
                                            <option value="Monitor">Monitor</option>
                                            <option value="Teclado">Teclado</option>
                                            <option value="Mouse">Mouse</option>
                                            <option value="CPU">CPU</option>
                                            <option value="Impresora">Impresora</option>
                                            <option value="Control de acceso">Control de acceso</option>
                                            <option value="CCTV">CCTV</option>
                                            <option value="Telefono">Telefono</option>
                                            <option value="Otro">Otro</option>
                                            
                                            </select>
                                        </div>

                                        <div id="programasOptions" style="display: none;">
                                            <label>Programas:</label>
                                            <select name="programasOption" class="form-control select">
                                            <option value="">Seleccionar</option>
                                            <option value="Appmovil">AppMovil</option>
                                            <option value="Office">Office</option>
                                            <option value="Contpaq">Contpaq</option>
                                            <option value="Checador">Checador</option>
                                            <option value="Server">Server</option>
                                            <option value="NAS">NAS</option>
                                            <option value="Camaras">Camaras</option>
                                            <option value="Windows">Windows</option>
                                            <option value="Antivirus">Antivirus</option>
                                            <option value="Silvasoft">Silvasoft</option>
                                            <option value="Apple Cubos">Apple Cubos</option>
                                            <option value="StrawBerry">StrawBerry</option>
                                            <option value="Cherry">Cherry</option>
                                            <option value="BlackBerry">BlackBerry</option>
                                            <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Prioridad</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select name="priority" class="form-control select">
                                                <option value="">Seleccionar</option>
                                                <option value="Importante">Importante</option>
                                                <option value="Urgente-(Problema Funcional)">Urgente (Problema Funcional)</option>
                                                <option value="No-Urgente">No Urgente</option>
                                                <option value="Pregunta">Pregunta</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Descripción</label>
                                        <div class="col-md-6 col-xs-12">
                                            <textarea name="description" required class="form-control" rows="5"></textarea>

                                        </div>
                                    </div>


                                </div>









                            </div>

                            <div class="panel-footer">
                                <button class="btn btn-default">Resetear</button>
                                <input type="submit" value="Enviar" name="send" class="btn btn-primary pull-right">
                            </div>
                    </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>

    </div>
    <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="assets/js/core.js" type="text/javascript"></script>
    <script src="assets/js/chat.js" type="text/javascript"></script>
    <script src="assets/js/demo.js" type="text/javascript"></script>
    <script>
  function showSubOptions(selectedValue) {
    var subOptions = document.getElementById("subOptions");
    var equipoOptions = document.getElementById("equipoOptions");
    var programasOptions = document.getElementById("programasOptions");

    // Ocultar todas las opciones secundarias
    equipoOptions.style.display = "none";
    programasOptions.style.display = "none";

    if (selectedValue === "Equipo-") {
      equipoOptions.style.display = "block";
    } else if (selectedValue === "Programa-") {
      programasOptions.style.display = "block";
    }

    // Mostrar las opciones secundarias
    subOptions.style.display = selectedValue ? "block" : "none";
  }
</script>

</body>

</html>