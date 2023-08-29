<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();
$userAdmin = $_SESSION['alogin'];

if (isset($_POST['update'])) {
  $status = $_POST['statusUpdate'];
  $assigned = $_POST['assignedUpdate'];
  $fid = $_POST['frm_id'];
  print_r($status);
  mysqli_query($con, "UPDATE ticket SET status='$status', name_Admin='$userAdmin', assigned_user='$assigned' WHERE id='$fid'");
  
  $comment = $_POST['aremark'];
  if($comment !=""){
    mysqli_query($con, "INSERT INTO comments (ticket_id, coment, name_admin, commentdate) VALUES ('$fid', '$comment', '$userAdmin', NOW())");
  }
  echo '<script>alert("Ticket ha sido actualizado correctamente"); location.replace(document.referrer)</script>';
}
$query = "SELECT MAX(id) as max_id FROM ticket";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$lastTicketId = $row['max_id'];
?>


<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>Usuari@ | Soporte Ticket</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="../assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
  <audio id="notificationSound">
    
</audio>
 

</head>
<input type="hidden" id="lastTicketId" value="<?php echo $lastTicketId; ?>">
<body class="">
<script src="./check_new_ticket.js"></script>
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
        <li><a href="#" class="active">Ver Ticket</a></li>
      </ul>
      <div class="clearfix"></div>
  
      <!------------------------------------------------------------------------------------------------------->
      <?php
      $statuses = array('Abierto', 'Visto','En Espera','Cerrado');
      foreach ($statuses as $status) {

        echo '<div class="column">';
        echo '<h3 style="color: #2b4c7e;"><strong>' . $status . '</strong></h3>';
        $rt = mysqli_query($con, "SELECT * FROM ticket WHERE status = '$status' and area_asig = 'MANTENIMIENTO' ORDER BY id DESC");
        while ($row = mysqli_fetch_array($rt)) {
          ?>
          <div class="row">
            <div class="col-md-12">
              <div class="grid simple no-border">
                <div class="grid-title no-border descriptive clickable">
                 
                <h4 class="semi-bold" >
                <strong>  <?php echo $row['subject']; ?> / <?php echo $row['task_type']; ?></strong>
                  </h4>
                  <p style="width:700px"><span class="text-success bold">Ticket #
                      <?php echo $_SESSION['sid'] = $row['ticket_id']; ?>
                    </span> - Fecha de creación
                    <?php echo $row['posting_date']; ?>
                    <span class="label label-important"
                      style="background-color: <?php echo getColorByStatus($row['status']); ?>"><?php echo $row['status']; ?></span>
                    <span class="label label-important"
                      style="background-color: <?php echo getColorByPrioprity($row['prioprity']); ?>"><?php echo $row['prioprity']; ?></span>
                      <span class="label label-important"
                      style="background-color: #000000;"><?php echo $row['assigned_user']; ?></span>
                  </p>
                  <div class="actions"> <a class="view" href="javascript:;"><i class="fa fa-angle-down"></i></a> </div>
                </div>
                <div class="grid-body  no-border" style="display:none">
                  <div class="post">
                    <div class="user-profile-pic-wrapper">
                      <div class="user-profile-pic-normal"> <img width="35" height="35"
                          data-src-retina="../assets/img/user.png" data-src="../assets/img/user.png"
                          src="../assets/img/user.png" alt=""> </div>
                    </div>
                    <div class="info-wrapper" >
                      <div class="info"><strong style="color: #000000">Usuario de reporte: </strong>
                        <?php echo $row['name']; ?>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="info-wrapper">
                      <div class="info"><strong style="color: #000000">Area:</strong>
                        <?php echo $row['area']; ?>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    
                    <div class="info-wrapper">
                      <div class="info"><strong style="color: #000000">Descripción:<br></strong>
                      
                        <?php echo $row['ticket']; ?>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <br>
                  <!--FORMULARIO-->
  
                  <div class="form-group">
                    <div class="post col-md-12">
                      <div class="col-md-6 col-xs-12">
  
                        <form name="adminr" method="post" enctype="multipart/form-data">
  
                          <div class="row" style="width: 800px;">
                          <?php
                          $rol= $_SESSION['alogin'];
                            if ($rol === "Carlos De La Cruz") {
                              ?>
                              <div class="col-md-6 col-xs-12">
                                <label class="col-md-6 col-xs-12 control-label"><strong style="color: #000000">Asignado:</strong></label>
                                <div class="col-md-6 col-xs-12">
                                  <select name="assignedUpdate" class="form-control select" required>
                                    <?php
                                    $sql2 = "SELECT * FROM admin";
                                    $result = $con->query($sql2);
                                    while ($row2 = $result->fetch_assoc()) {
                                      $atender = htmlspecialchars($row2["name"]);
                                      echo "<option value=\"$atender\">$atender</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <?php
                            }
                            else{
                              ?>
                              <input type="hidden" name="assignedUpdate" value="<?php echo $row['assigned_user']; ?>">
                              <?php
                            }
                          ?>
  
                            <div class="col-md-6 col-xs-12">
                              <label class="col-md-6 col-xs-12 control-label"><strong style="color: #000000">Status:</strong></label>
                              <div class="col-md-6 col-xs-12">
                                 <select name="statusUpdate" class="form-control select" required>
                                 <option value="Visto">VISTO</option>
                                  <option value="Abierto">Abierto</option>
                                  <option value="En espera">En espera</option>
                                  <option value="Cerrado">Cerrado</option>
                                  <option value="COMPRAS">COMPRAS</option>
                                </select>
                              </div>
                            </div>
                          </div>
  
  
  
                          <div class="user-profile-pic-wrapper">
                            <div class="user-profile-pic-normal"> <img width="35" height="35"
                                data-src-retina="../assets/img/admin.png" data-src="../assets/img/admin.png"
                                src="../assets/img/admin.png" alt=""> </div>
                          </div>
                          <br>
                          <div class="info-wrapper">
                            <div class="info"> Comentario:   
                              <br>
                            </div>
                             <div class="clearfix"></div>
                          </div>
                         
                          <br>
                          <textarea name="aremark" cols="50" rows="2"style="border:2px solid #193A63"></textarea>
                             
                          <hr>                      
                          <hr>
                          <p class="small-text">
                            <input name="update" type="submit" class="txtbox1" id="Update" value="ACTUALIZAR" size="40" style="background-color: #193A63;color: #FFFFFF"/>
                            <input name="frm_id" type="hidden" id="frm_id" value="<?php echo $row['id']; ?>" />
                          </p>
                        </form>
                        
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <!--FIN FORMULARIO -->
  
                  <!-- AGREGAR COMENTARIOS -->
                  <div id="comments-container">
                    <?php
                    $idTicketActual = $row['id'];
  
                    $commentsResult = mysqli_query($con, "SELECT * FROM comments WHERE ticket_id='$idTicketActual'");
                    // Mostrar los comentarios
                    while ($commentRow = mysqli_fetch_array($commentsResult)) {
                      echo "<p><strong>{$commentRow['name_admin']}:</strong> {$commentRow['coment']}</p>";
                      echo "<p>{$commentRow['commentdate']}</p>";
                    ?>
                       <script>
                        /*setInterval(function() {
                          actualizarComentarios(<?php //echo $idTicketActual; ?>);
                        }, 60000); // 60000 milisegundos = 1 minuto
                        */
                      </script>
                    <?php
                    }
                    ?>
                  </div>
  
  
                  
                </div>
              </div>
            </div>
          </div>
          <?php
        }
    
        echo '</div>';
    }
  
      ?>
<!---------------------------------------------------------------------------------------------------------------->

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

  </div>
  <!-- END CONTAINER -->
  <!-- BEGIN CORE JS FRAMEWORK-->
  <script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
  <!-- END CORE JS FRAMEWORK -->
  <!-- BEGIN PAGE LEVEL JS -->
  <script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
  <script src="../assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
  <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
  <script src="../assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <script src="../assets/js/support_ticket.js" type="text/javascript"></script>
  <!-- BEGIN CORE TEMPLATE JS -->
  <script src="../assets/js/core.js" type="text/javascript"></script>
  <script src="../assets/js/chat.js" type="text/javascript"></script>
  <script src="../assets/js/demo.js" type="text/javascript"></script>
  <!-- END CORE TEMPLATE JS -->

  <?php
  function getColorByStatus($status)
  {
    switch ($status) {
      case 'Abierto':
        return '#B01411'; 
      case 'En espera':
        return '#D7B40C'; 
      case 'Cerrado':
        return '#000000'; 
      case 'COMPRAS':
        return '#7e638c';
      case 'Visto':
        return '#8bc59b';    
      default:
        return '#B9A99C'; // Color gris por defecto
    }
  }

  function getColorByPrioprity($prioprity)
  {
    switch ($prioprity) {
      case 'Importante':
        return '#193A63'; // Color azul
      case 'Urgente-(Problema Funcional)':
        return '#B01411'; // Color rojo
      case 'No-Urgente':
        return '#2D6529'; // Color verde
      case 'Pregunta':
        return '#D1650B'; //Color Naranja
      default:
        return '#B9A99C'; // Color gris por defecto
    }
  }
  ?>



<script>
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
</body>

</html>