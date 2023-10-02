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

    $tt = $_POST['tasktype'];

    if ($_POST['tasktype'] === "Equipo-") {
        $tt .= " " . $_POST['equipoOption'];
    } elseif ($_POST['tasktype'] === "Programa-") {
        $tt .= " " . $_POST['programasOption'];
    } elseif ($_POST['tasktype'] === "Reparacion-") {
        $tt .= " " . $_POST['reparacionOption'];
    } elseif ($_POST['tasktype'] === "Compras-") {
        $tt .= " " . $_POST['comprasOption'];
    }
    $priority = $_POST['priority'];
    $ticket = $_POST['description'];
    $st = "Abierto";
    // Verifica si se envió un archivo adjunto
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $adminDir = 'admin/';
        $uploadDir = 'uploads/';
        $fullUploadDir = $adminDir . $uploadDir; // Directorio donde deseas guardar los archivos adjuntos
        $uploadFile = $fullUploadDir . basename($_FILES['attachment']['name']);

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadFile)) {
            // Obtén la ruta del archivo adjunto
            $archivo_adj = $uploadFile;
        } else {
            // Ocurrió un error al cargar el archivo, puedes manejar el error aquí si lo deseas.
            echo "<script>alert('Error al cargar el archivo adjunto'); location.replace(document.referrer)</script>";
            exit; // Detiene la ejecución del script si hay un error.
        }
    } else {
        // No se ha enviado un archivo adjunto, establece $archivo_adj en null o un valor predeterminado.
        $archivo_adj = null; 
    }

    // Inserta los datos en la base de datos (incluso si no hay archivo adjunto)
    $stmt = mysqli_prepare($con, "INSERT INTO ticket (ticket_id, email_id, subject, task_type, prioprity, ticket, status, posting_date, name, area, respuesta, archivo_adj) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, 0, ?)");
    mysqli_stmt_bind_param($stmt, "ssssssssss", $tid, $user, $subject, $tt, $priority, $ticket, $st, $name, $area, $archivo_adj);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Ticket Registrado Correctamente'); location.replace(document.referrer)</script>";
    } else {
        echo "<script>alert('Error al registrar el ticket'); location.replace(document.referrer)</script>";
    }
    mysqli_stmt_close($stmt);
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

                        <form class="form-horizontal" name="form1" method="post" action="" onSubmit="return valid();" enctype="multipart/form-data">
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
                                            <option value="Reparacion-">Reparacion</option> 
                                            <option value="Compras-">Compras</option>    
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
                                        <div id="reparacionOptions" style="display: none;">
                                            <label>Reparacion:</label>
                                            <select name="reparacionOption" class="form-control select">
                                            <option value="">Seleccionar</option>
                                            <option value="Oficna">Oficinas</option>
                                            <option value="Bodega">Bodega</option>
                                            <option value="Baños">Baños</option>
                                            <option value="Comedor">Comedor</option>
                                            <option value="Caseta">Caseta</option>
                                            <option value="Otros">Otros</option>
                                            
                                            </select>
                                        </div>
                                        <div id="comprasOptions" style="display: none;">
                                            <label>Compras:</label>
                                            <select name="comprasOption" class="form-control select">
                                            <option value="">Seleccionar</option>
                                            <option value="Mantenimiento">Mantenimiento</option>
                                            <option value="Computo">Computo</option>
                                            <option value="Papeleria">Suministros de Papeleria</option>
                                            <option value="Toners">Suministros de Toners</option>
                                            <option value="Insumos">Compras Generales</option>
                                            <option value="Otros">Otros</option>      
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
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Adjuntar Archivo</label>
                                        <div class="col-md-6 col-xs-12">
                                        <input type="file" name="attachment" class="form-control" />
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
    var reparacionOptions = document.getElementById("reparacionOptions");
    var comprasOptions = document.getElementById("comprasOptions");

    // Ocultar todas las opciones secundarias
    equipoOptions.style.display = "none";
    programasOptions.style.display = "none";
    reparacionOptions.style.display = "none";
    comprasOptions.style.display = "none";

    if (selectedValue === "Equipo-") {
      equipoOptions.style.display = "block";
    } else if (selectedValue === "Programa-") {
      programasOptions.style.display = "block";
    }else if (selectedValue === "Reparacion-") {
      reparacionOptions.style.display = "block";
    } else if (selectedValue === "Compras-") {
      comprasOptions.style.display = "block";
    }

    // Mostrar las opciones secundarias
    subOptions.style.display = selectedValue ? "block" : "none";
  }
</script>

</body>

</html>