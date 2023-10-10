<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<title>CWEB Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="../assets/plugins/jquery-metrojs/MetroJs.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../assets/plugins/shape-hover/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="../assets/plugins/shape-hover/css/component.css" />
	<link rel="stylesheet" type="text/css" href="../assets/plugins/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" type="text/css" href="../assets/plugins/owl-carousel/owl.theme.css" />
	<link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css"
		media="screen" />
	<link rel="stylesheet" href="../assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css"
		media="screen">
	<link rel="stylesheet" href="../assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen">
	<link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/magic_space.css" rel="stylesheet" type="text/css" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/plugins/morris.css" rel="stylesheet">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>

<body class="">
	<?php include("header.php"); ?>
	<div class="page-container row">

		<?php include("leftbar.php"); ?>

		<div class="clearfix"></div>
		<!-- END SIDEBAR MENU -->
	</div>
	</div>
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
		<div class="content sm-gutter">
			<div class="page-title">
			</div>
			<!-- BEGIN DASHBOARD TILES -->
			<div class="row">
				<div class="col-md-3 col-vlg-3 col-sm-6">
					<div class="tiles green m-b-10">
						<div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;"
									class="remove"></a> </div>
							<div class="tiles-title ">Visitantes </div>
							<br>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<?php $ov = mysqli_query($con, "select * from usercheck");
									$num = mysqli_num_rows($ov);
									?>
									<span class="item-title">General</span> <span
										class="item-count animate-number semi-bold" data-value="<?php echo $num; ?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last">
									<?php
									$tdate = date("Y/m/d");

									$tv1 = mysqli_query($con, "select * from usercheck where logindate='$tdate'");
									$num11 = mysqli_num_rows($tv1);
									?>

									<span class="item-title">Hoy</span> <span
										class="item-count animate-number semi-bold" data-value="<?php echo $num11; ?>"
										data-animation-duration="700">0</span>
									<?php

									?>
								</div>
							</div>


						</div>
					</div>


				</div>
				<div class="col-md-3 col-vlg-3 col-sm-6" style="width: 320px;">
					<div class="tiles purple m-b-10">
						<div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;"
									class="remove"></a> </div>
							<div class="tiles-title ">Tickets </div>
							<br>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<?php
									$qr = mysqli_query($con, "select * from ticket");
									$oq = mysqli_num_rows($qr);
									?>
									<span class="item-title">General</span> <span
										class="item-count animate-number semi-bold" data-value="<?php echo $oq ?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<?php
									$qr1 = mysqli_query($con, "select * from ticket where status='Abierto'");
									$oq1 = mysqli_num_rows($qr1);
									?>
									<span class="item-title">Nuevo</span> <span
										class="item-count animate-number semi-bold" data-value="<?php echo $oq1; ?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last">
									<?php
									$qr2 = mysqli_query($con, "select * from ticket where status='En espera'");
									$oq2 = mysqli_num_rows($qr2);
									?>
									<span class="item-title">En espera</span> <span
										class="item-count animate-number semi-bold" data-value="<?php echo $oq2; ?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last">
									<?php
									$qr2 = mysqli_query($con, "select * from ticket where status='Cerrado'");
									$oq2 = mysqli_num_rows($qr2);
									?>
									<span class="item-title">Cerrados</span> <span
										class="item-count animate-number semi-bold" data-value="<?php echo $oq2; ?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Apartado de calculo de tiempo de espera -->
               <div class="col-md-3 col-vlg-3 col-sm-6" style="width: 390px; ">
					<div class="tiles red m-b-10">
						<div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;"
									class="remove"></a> </div>
							<div class="tiles-title " style=' font-size: 14px;'>Tiempo promedio de atención de tickets por hora </div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<?php
									$qr = mysqli_query($con, "SELECT AVG(TIMESTAMPDIFF(HOUR, posting_date, closing_date)) AS promedio_horas, AVG(TIMESTAMPDIFF(DAY, posting_date, closing_date)) AS promedio_dias FROM ticket WHERE closing_date IS NOT NULL AND status = 'cerrado' AND MONTH(posting_date) = MONTH(CURRENT_DATE) AND YEAR(posting_date) = YEAR(CURRENT_DATE) AND area_asig = 'TI';");
									$respuesta = mysqli_fetch_assoc($qr)
									
									?>
									<span class="item-title">TI</span> 
									<span class="item-count animate-number semi-bold" data-value="<?php echo number_format($respuesta['promedio_horas'],2)?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<?php
									$qr = mysqli_query($con, "SELECT AVG(TIMESTAMPDIFF(HOUR, posting_date, closing_date)) AS promedio_horas, AVG(TIMESTAMPDIFF(DAY, posting_date, closing_date)) AS promedio_dias FROM ticket WHERE closing_date IS NOT NULL AND status = 'cerrado' AND MONTH(posting_date) = MONTH(CURRENT_DATE) AND YEAR(posting_date) = YEAR(CURRENT_DATE) AND area_asig = 'COMPRAS';");
									$respuesta = mysqli_fetch_assoc($qr)
									
									?>
									<span class="item-title">COMPRAS</span> 
									<span class="item-count animate-number semi-bold" data-value="<?php echo number_format($respuesta['promedio_horas'],2)?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<?php
									$qr = mysqli_query($con, "SELECT AVG(TIMESTAMPDIFF(HOUR, posting_date, closing_date)) AS promedio_horas, AVG(TIMESTAMPDIFF(DAY, posting_date, closing_date)) AS promedio_dias FROM ticket WHERE closing_date IS NOT NULL AND status = 'cerrado' AND MONTH(posting_date) = MONTH(CURRENT_DATE) AND YEAR(posting_date) = YEAR(CURRENT_DATE) AND area_asig = 'MANTENIMIENTO';");
									$respuesta = mysqli_fetch_assoc($qr)
									
									?>
									<span class="item-title">MANTENIMIENTO</span> 
									<span class="item-count animate-number semi-bold" data-value=" <?php echo number_format($respuesta['promedio_horas'],2)?>"
										data-animation-duration="700">0</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button class="btn-descarga" onclick="descargarExcel()">Descargar reporte mensual</button>

		<!-- END DASHBOARD TILES -->
		<!-- START DASHBOARD CHART -->
		<div class="col-lg-12" style="min-height:280px;">
			<div class="panel panel-red">
				<div class="panel-heading">
					<h3 class="panel-title" style="color:#193A63;"><i class="fa fa-long-arrow-right"></i> Todas las
						Visitas de Usuario del mes </h3>

					<script type="text/javascript">
						var visitorsCount = [];
						var myCat = [];
					</script>
					<?php
					$totaldays = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));

					$month_array = array();
					for ($i = 1; $i <= $totaldays; $i++) {
						if (!array_key_exists($i, $month_array)) {
							$key = '';
							if ($i < 10) {
								$key = '0' . $i;
								$month_array[$key] = 0;
							} else {
								$month_array[$i] = 0;
							}
							?>
							<script type="text/javascript">
								var myKey = "Day " + '<?php echo $i; ?>';

								myCat.push(myKey);
							</script>
							<?php

						}
					}
					$results = mysqli_query($con, "SELECT logindate FROM usercheck");

					if (mysqli_num_rows($results) > 0) {
						while ($row = mysqli_fetch_row($results)) {
							$user_date = $row[0];
							$dateArray = explode('/', $user_date);
							$year = $dateArray[0];
							$monthName = date("M", mktime(0, 0, 0, $dateArray[1], 10));
							$currentMonth = date('m', mktime(0, 0, 0, $dateArray[1], 10));

							if ($year == date("Y") && $currentMonth == date("m")) {

								if (array_key_exists($dateArray[2], $month_array)) {
									$month_array[$dateArray[2]] = $month_array[$dateArray[2]] + 1;
								}
							}
						}
					}
					foreach ($month_array as $key => $value) {
						?>
						<script type="text/javascript">
							visitorsCount.push(<?php echo $value; ?>);
						</script>
						<?php
					}
					?>

					<script type="text/javascript">
						var d = new Date();
						var month = new Array();
						month[0] = "Enero";
						month[1] = "Febrero";
						month[2] = "Marzo";
						month[3] = "Abril";
						month[4] = "Mayo";
						month[5] = "Junio";
						month[6] = "Julio";
						month[7] = "Agosto";
						month[8] = "Septiembre";
						month[9] = "Octubre";
						month[10] = "Noviembre";
						month[11] = "Diciembre";
						var n = month[d.getMonth()];
						$(function () {
							$('#container').highcharts({
								title: {
									text: 'Gráfico de visitantes diarios de ' + n,
									x: -20 //center
								},
								subtitle: {
									text: '',
									x: -20
								},
								xAxis: {
									categories: myCat
								},
								yAxis: {
									min: 0,
									title: {
										text: 'Cuenta de Visitantes'
									},
									plotLines: [{
										value: 0,
										width: 1,
										color: '#808080'
									}]
								},
								tooltip: {
									valueSuffix: ' Users'
								},
								legend: {
									layout: 'vertical',
									align: 'right',
									verticalAlign: 'middle',
									borderWidth: 0
								},
								series: [{
									name: 'visitorsCount',
									data: visitorsCount
								}]
							});
						});
					</script>
					<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

				</div>
			</div>
		</div>

	</div>
	<!-- END DASHBOARD CHART -->
	</div>
	
	</div>
	<!-- BEGIN CHAT -->

	</div>
	<script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
	<!-- END CORE JS FRAMEWORK -->
	<!-- BEGIN PAGE LEVEL JS -->
	<script src="../assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
	<script src="../assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
	<script src="../assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
	<script src="../assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
	<script src="../assets/plugins/skycons/skycons.js"></script>
	<script src="../assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
	<script type="../text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="../assets/plugins/jquery-gmap/gmaps.js" type="text/javascript"></script>
	<script src="assets/plugins/Mapplic/js/jquery.easing.js" type="text/javascript"></script>
	<script src="../assets/plugins/Mapplic/js/jquery.mousewheel.js" type="text/javascript"></script>
	<script src="../assets/plugins/Mapplic/js/hammer.js" type="text/javascript"></script>
	<script src="../assets/plugins/Mapplic/mapplic/mapplic.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
	<script src="../assets/js/core.js" type="text/javascript"></script>
	<script src="../assets/js/chat.js" type="text/javascript"></script>
	<script src="../assets/js/demo.js" type="text/javascript"></script>
	<script src="../assets/js/dashboard_v2.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/highcharts.js"></script>
	<script type="text/javascript" src="js/exporting.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".live-tile,.flip-list").liveTile();
		});
	</script>
	<script>
		function descargarExcel() {
			window.location.href = 'generar_excel.php';
		}
	</script>

</body>
<style>
	.btn-descarga {
		background-color: #294365;
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 16px 25px;
		cursor: pointer;
		border-radius: 8px;
	}

	.btn-descarga:active {
		background-color: #475166;
	}
</style>

</html>