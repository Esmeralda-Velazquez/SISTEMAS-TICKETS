<?php
session_start();

include("dbconnection.php");
include("checklogin.php");

check_login();

function getColorByStatus($status) {
    switch ($status) {
        case 'Abierto':
            return '#B01411'; // Color rojo
        case 'En espera':
            return '#D7B40C'; // Color amarillo
        case 'Cerrado':
            return '#000000'; // Color negro
        default:
            return '#B9A99C'; // Color negro por defecto
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="assets/img/icon.png" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Usuario | Tickets de Soporte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
    <!-- END CSS TEMPLATE -->
</head>

<body class="">
    <?php include("header.php"); ?>
    <div class="page-container row">
        <?php include("leftbar.php"); ?>
        <div class="clearfix"></div>
    </div>
    </div>
    <div class="page-content">
        <div id="portlet-config" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"></button>
                <h3>Widget Settings</h3>
            </div>
            <div class="modal-body"> Widget settings form goes here </div>
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <ul class="breadcrumb">
                <li>
                    <p>Inicio</p>
                </li>
                <li><a href="#" class="active">Ver Tickets</a></li>
            </ul>
            <div class="page-title">
                <h3>Ticket de Soporte</h3>
            </div>
            <div class="clearfix"></div>

            <h4> <span class="semi-bold">Tickets</span></h4>
            <br>
            <?php
            $rt = mysqli_query($con, "select * from ticket where email_id='" . $_SESSION['login'] . "'");
            $num = mysqli_num_rows($rt);
            if ($num > 0) {
                while ($row = mysqli_fetch_array($rt)) {
            ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple no-border">
                                <div class="grid-title no-border descriptive clickable">
                                    <h4 class="semi-bold"><?php echo $row['subject']; ?></h4>
                                    <p><span class="text-success bold">Ticket #<?php echo $row['ticket_id']; ?><br></span> - Fecha de Creación <?php echo $row['posting_date']; ?><br>
                                    </span> - Fecha de Finalización <?php echo $row['closing_date']; ?><br>
                                        <span class="label label-important" style="background-color: <?php echo getColorByStatus($row['status']); ?>"><?php echo $row['status']; ?></span>
                                    </p>
                                    <div class="actions"> <a class="view" href="javascript:;"><i class="fa fa-angle-down"></i></a> </div>
                                </div>
                                <div class="grid-body  no-border" style="display:none">
                                    <div class="post">

                                        <div class="user-profile-pic-wrapper">
                                            <div class="user-profile-pic-normal"> <img width="35" height="35" data-src-retina="assets/img/user.png" data-src="assets/img/user.png" src="assets/img/user.png" alt=""> </div>
                                        </div>

                                        <div class="info-wrapper">

                                            <div class="info"><?php echo $row['ticket']; ?> </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <br>
                                    <div id="comments-container">
                                        <p class="info" style="font-weight: bold; font-size: 15px; color:#0E3A88">Respuesta: </p>
                                        <?php
                                        $idTicketActual = $row['id'];
                                        $commentsResult = mysqli_query($con, "SELECT DISTINCT coment, name_admin, commentdate FROM comments WHERE ticket_id='$idTicketActual'");
                                        // Mostrar los comentarios
                                        while ($commentRow = mysqli_fetch_array($commentsResult)) {
                                            echo "<p><strong>{$commentRow['name_admin']}:</strong> {$commentRow['coment']}</p>";
                                            echo "<p>{$commentRow['commentdate']}</p>";
                                        }
                                        ?>
                                    </div>

                                    <?php if ($row['admin_remark'] != '') : ?>
                                        <div class="form-actions">
                                            <div class="post col-md-12">
                                                <div class="user-profile-pic-wrapper">
                                                    <div class="user-profile-pic-normal"> <img width="35" height="35" data-src-retina="assets/img/admin.png" data-src="assets/img/admin.png" src="assets/img/admin.png" alt="Admin"> </div>
                                                </div>
                                                <div class="info-wrapper">
                                                    <br>
                                                    <!-- <p class="small-text">Publicado en <?php //echo $row['admin_remark_date']; ?></p> -->
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php } }                     
            ?>
            </script>
            </div>
        </div>
    </div>
        </div>
            </div>
                </div>
                     </div>
                         </div>
                            </div>
                                 </div>
                                    </div>
                                        </div>
                                             </div>
                                                    </body>
</html>
<script>
    // NO SE UTILIZA POR EL MOMENTO
    function actualizarComentarios(idTicketActual) {

        console.log('ID del ticket actual: ' + idTicketActual);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("comments-container").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "get_comments.php?id=" + idTicketActual, true);
        xhttp.send();
    }
</script>
