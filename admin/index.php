<?php
session_start();
error_reporting(0);
include("dbconnection.php");
if (isset($_POST['login'])) {
  $ret = mysqli_query($con, "SELECT * FROM admin WHERE name='" . $_POST['username'] . "' and password='" . $_POST['password'] . "' and area='" . $_POST['areaSelect'] . "'");
  $num = mysqli_fetch_array($ret);
  echo $num;
  if ($num > 0 ) {
    
    $_SESSION['alogin'] = $_POST['username'];
    $_SESSION['id'] = $num['id'];
    $_SESSION['area'] = $num['area'];
    if($_SESSION['area']=='TI' || $_SESSION['area'] =='Direccion'){
      $extra = "home.php";
      echo "<script>window.location.href='" . $extra . "'</script>";
    }
    if($_SESSION['area']=='ERP SILVA'){
      $extra = "manage-tickets-CRM.php";
      echo "<script>window.location.href='" . $extra . "'</script>";
    }
    if($_SESSION['area']=='COMPRAS'){
      $extra = "manage-tickets-COMPRAS.php";
      echo "<script>window.location.href='" . $extra . "'</script>";
    }
    if($_SESSION['area']=='MANTENIMIENTO'){
      $extra = "manage-tickets-MANTENIMIENTO.php";
      echo "<script>window.location.href='" . $extra . "'</script>";
    }
    else{
      $extra = "manage-tickets.php";
      echo "<script>window.location.href='" . $extra . "'</script>";
    }
    
    exit();
  } else {
    $_SESSION['action1'] = "*Usuario o Contraseña Inválidos";
    $extra = "index.php";

    echo "<script>window.location.href='" . $extra . "'</script>";
    exit();
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>IVRA Acceso Administrativo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="./../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="./../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="./../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
  <link href="./../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="./../assets/css/animate.min.css" rel="stylesheet" type="text/css" />
  <link href="./../assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="./../assets/css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="./../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />

</head>

<body class="error-body no-top">
  <div class="container">
    <div class="login-container">
      <div class="col-md-5">
        <h2 class="text-center text-white"><strong>Acceso Administrativo</strong></h2>
        <hr>
      </div>
      <div class="col-md-5 ">
        <form id="login-form" class="login-form" action="" method="post">
          <p style="color: #F00">
            <?php echo $_SESSION['action1']; ?>
            <?php echo $_SESSION['action1'] = ""; ?>
          </p>
          <div class="form-group">
            <label for="username" class="control-label">Usuario</label>
            <input type="text" class="form-control rounded-0" id="username" name="username" required="required">
          </div>
          <div class="form-group">
            <label for="password" class="control-label">Contraseña</label>
            <input type="password" class="form-control rounded-0" id="password" name="password" required="required">
          </div>
          <div class="col-md-6 col-xs-12">
            <label class="col-md-6 col-xs-12 control-label"><strong style="color: #ffffff">Area:</strong></label>
            <div class="col-md-6 col-xs-12">
              <select name="areaSelect" class="form-control select" required>
                <option value="TI">TI</option>
                <option value="DIRECCION">DIRECCION</option>
                <option value="ERP SILVA">ERP SILVA</option>
                <option value="COMPRAS">COMPRAS</option>
                <option value="MANTENIMIENTO">MANTENIMIENTO</option>
              </select>
            </div>
          </div>
          <div class="form-group text-center">
            <a href="./../">Volver al Sitio</a>
            <button class="btn btn-primary btn-cons pull-right" name="login" type="submit">Acceder</button>
          </div>
        </form>
      </div>


    </div>
  </div>
  <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
  <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="assets/js/login.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/highcharts.js"></script>
  <script type="text/javascript" src="js/exporting.js"></script>
</body>

</html>