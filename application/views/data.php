<style type="text/css">
			.card-title
			{
				font-size: 20 !important;
			}
		</style>

<html lang="en" dir="ltr">

	<head>

		<!-- Favicon -->

		<link rel="icon" href="<?=base_url();?>assets/images/brand/favicon.ico" type="image/x-icon"/>

		<link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>assets/images/brand/favicon.ico" />



		<!-- Title -->

		<title>Zydus</title>



		<!--Bootstrap.min css-->

		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">



		<!-- Dashboard css -->

		<link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" />



		<!-- Perfect scroll bar css-->

		<link href="<?=base_url();?>assets/plugins/pscrollbar/perfect-scrollbar.css" rel="stylesheet" />



		<!--Sidemenu css-->

		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/side-menu/sidemenu-1/closed-sidemenu.css">



		<!--Daterangepicker css-->

		<link href="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />



		<!-- Sidebar Accordions css -->

		<link href="<?=base_url();?>assets/plugins/sidemenu-responsive-tabs/css/easy-responsive-tabs.css" rel="stylesheet">



		<!-- Rightsidebar css -->

		<link href="<?=base_url();?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">



		<!--News ticker css -->

		<link href="<?=base_url();?>assets/plugins/newsticker/breaking-news-ticker.css" rel="stylesheet" />



		<!---Font icons css-->

		<link href="<?=base_url();?>assets/plugins/webfonts/plugin.css" rel="stylesheet" />

		<link href="<?=base_url();?>assets/plugins/webfonts/icons.css" rel="stylesheet" />

		<link  href="<?=base_url();?>assets/fonts/fonts/font-awesome.min.css" rel="stylesheet">

		<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />




		<!-- Color-skins css -->

		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />

		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>

		<style>
			.input-color {
    			position: relative;
			}
			.input-color input {
			    padding-left: 20px;
			}
			.input-color .color-box {
			    width: 10px;
			    height: 10px;
			    display: inline-block;
			    background-color: #ccc;
			    position: absolute;
			    left: 5px;
			    top: 5px;
			}
		</style>

	</head>



	<body class="app sidebar-mini">


		



		<!--Global-Loader-->

		<div id="global-loader">

			<img src="<?=base_url();?>assets/images/brand/icon.png" alt="loader">

		</div>



		<div class="page">

			<div class="page-main">

				<!--app-header-->

				<?php include('header.php'); ?>

				<!--/app-header-->

				<!-- Sidebar menu-->

				<?php include('sidebar.php'); ?>

				<!--sidemenu end-->

                <!-- app-content-->

				<div class="app-content  my-3 my-md-5">

					<div class="side-app">



					    <!-- page-header -->
						<div class="page-header">

							<ol class="breadcrumb"><!-- breadcrumb -->

								<li class="breadcrumb-item"><a href="#">Home</a></li>

								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>

							</ol><!-- End breadcrumb -->

						</div>

						<!-- End page-header -->


											<div class="form-group">



												<div class="row">

													<?php echo form_open("Admin/create_backup",array("method"=>"POST"))?>		

														<input type="submit" class="btn-lg btn btn-primary" value="Submit" name="submit">
												   </form>

												</div>

											</div>		



					</div>


					


					</div><!--End side app-->

					<!-- Right-sidebar-->
					<?php include("right_sidebar.php");?>
					<!-- End Rightsidebar-->



					<!--footer-->

                    <?php include ('footer.php');?>
					<!-- End Footer-->



				</div>

				<!-- End app-content-->

			</div>

		</div>

		<!-- End Page -->



		<!-- Back to top -->

		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



		<!-- Jquery js-->

		<script src="<?=base_url();?>assets/js/vendors/jquery-3.2.1.min.js"></script>



		<!--Bootstrap.min js-->

		<script src="<?=base_url();?>assets/plugins/bootstrap/popper.min.js"></script>

		<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>



		<!--Jquery Sparkline js-->

		<script src="<?=base_url();?>assets/js/vendors/jquery.sparkline.min.js"></script>



		<!-- Chart Circle js-->

		<script src="<?=base_url();?>assets/js/vendors/circle-progress.min.js"></script>



		<!-- Star Rating js-->

		<script src="<?=base_url();?>assets/plugins/rating/jquery.rating-stars.js"></script>



		<!--Moment js-->

		<script src="<?=base_url();?>assets/plugins/moment/moment.min.js"></script>



		<!-- Daterangepicker js-->

		<script src="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>



		<!--Side-menu js-->

		<script src="<?=base_url();?>assets/plugins/side-menu/sidemenu-1/sidemenu-1.js"></script>



		<!--News Ticker js-->

		<script src="<?=base_url();?>assets/plugins/newsticker/breaking-news-ticker.min.js"></script>

		<script src="<?=base_url();?>assets/plugins/newsticker/newsticker.js"></script>



		<!-- Sidebar Accordions js -->

		<script src="<?=base_url();?>assets/plugins/sidemenu-responsive-tabs/js/easyResponsiveTabs.js"></script>



		<!-- Perfect scroll bar js-->

		<script src="<?=base_url();?>assets/plugins/pscrollbar/perfect-scrollbar.js"></script>

		<script src="<?=base_url();?>assets/plugins/pscrollbar/p-scroll.js"></script>



		<!-- Rightsidebar js -->

		<script src="<?=base_url();?>assets/plugins/sidebar/sidebar.js"></script>



		<!--Time Counter js-->

		<script src="<?=base_url();?>assets/plugins/counters/jquery.missofis-countdown.js"></script>

		<script src="<?=base_url();?>assets/plugins/counters/counter.js"></script>



		<!-- ApexChart -->

		<script src="<?=base_url();?>assets/js/apexcharts.js"></script>



		<!-- Charts js-->

		<script src="<?=base_url();?>assets/plugins/chart/chart.bundle.js"></script>

		<script src="<?=base_url();?>assets/plugins/chart/utils.js"></script>



		<!--Peitychart js-->

		<script src="<?=base_url();?>assets/plugins/peitychart/jquery.peity.min.js"></script>

		<script src="<?=base_url();?>assets/plugins/peitychart/peitychart.init.js"></script>


			<!-- Data tables js-->



		<script src="<?=base_url();?>assets/plugins/datatable/jquery.dataTables.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable-2.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.responsive.min.js"></script>






		<!-- Custom-charts js-->

		<script src="<?=base_url();?>assets/js/index1.js"></script>


		<?php

		$farray = '';
		$farray1 = '';

		foreach ($property_count as $count) {


			$farray .= "'".$count['property_type']."',";
			$farray1 .= "".$count['code_count'].",";

			
		}

		?>

		<script type="text/javascript">
			$(function(e){
  					'use strict'

  						//Radial chart
	var options = {
		chart: {
			type: 'radialBar',
			background: 'transparent',
			stroke: "#fff",
			color: "#fff",
			width: "100%",
		},
		plotOptions: {
			radialBar: {
				size: undefined,
				inverseOrder: false,
				startAngle: 0,
				endAngle: 360,
				offsetX: 0,
				offsetY: 0,
				hollow: {
					margin: 5,
					size: '50%',
					background: 'transparent',
					image: undefined,
					imageWidth: 150,
					imageHeight: 150,
					imageOffsetX: 0,
					imageOffsetY: 0,
					imageClipped: true,
					position: 'front',
					dropShadow: {
						enabled: false,
						top: 0,
						left: 0,
						blur: 3,
						opacity: 0.5
					}
				},
				track: {
					show: true,
					startAngle: undefined,
					endAngle: undefined,
					background: '#f9f9f9',
					strokeWidth: '97%',
					opacity: 1,
					margin: 5,
					dropShadow: {
						enabled: false,
						top: 0,
						left: 0,
						blur: 3,
						opacity: 0.5
					}
				},
				dataLabels: {
					show: true,
					name: {
						show: true,
						fontSize: '18px',
						fontFamily: undefined,
						color: undefined,
						offsetY: -10
					},
					value: {
						show: true,
						fontSize: '16px',
						fontFamily: undefined,
						color: undefined,
						offsetY: 16,
						formatter: function(val) {
							return val
						}
					},
					total: {
						show: false,
						label: 'Total',
						color: '#373d3f',
						formatter: function(w) {
							return w.globals.seriesTotals.reduce((a, b) => {
								return a + b
							}, 0) / w.globals.series.length
						}
					}
				},
				
			}
		},
		stroke: {
			lineCap: "round"
		},
		series: [<?php echo $farray1; ?>],
		labels: [<?php echo $farray; ?>],
		colors: ['#467fcf', '#5eba00', '#ffca4a', '#ff6666', '#fs8686'],
	}
	var chart = new ApexCharts(document.querySelector("#pieChart1"), options);
	chart.render();
	//Radial chart
});

		</script>

		<script type="text/javascript">
			$(document).ready( function () {
    $('.example5').DataTable();
} );
		</script>



		<!-- Custom js-->

		<script src="<?=base_url();?>assets/js/custom.js"></script>



	</body>

</html>