<!doctype html>
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

		<!-- Sidemenu css -->
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

		<!-- Color-skins css -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>
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
				<?php include("sidebar.php");?>
				<!--sidemenu end-->

                <!-- app-content-->
				<div class="app-content  my-3 my-md-5">
					<div class="side-app">

					    <!-- page-header -->
						<div class="page-header">
							<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="#">Pages</a></li>
								<li class="breadcrumb-item active" aria-current="page">Faq</li>
							</ol><!-- End breadcrumb -->
							<div class="ml-auto">
								<div class="input-group">
									<a href="<?php echo site_url('Users/add_faq')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">
										<span>
											<i class="fa fa-plus">Add FAQ Details</i>
										</span>
									</a>
								</div>
							</div>
						</div>
						<!-- End page-header -->



							<?php if($this->session->flashdata('add_faq')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('add_faq'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('select_data')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('select_data'); ?>
                                </div>
      							
    						<?php endif;?> 


						<!-- row -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header pb-0">
										<h4 class="card-title">FAQS</h4>
									</div>
									<div class="card-body">
										<?php echo form_open('Users/filter_faq/',array("method"=>"POST","id"=>"form-filter")); ?>	

										<div class="form-group">

											<div class="row">

												<div class="col-lg-10 col-md-12">

													<label>Filter By FAQ Title</label>

													<input type="text" name="faq_title" value="<?php echo set_Value('faq_title');?>" placeholder="Enter FAQ Title" class="form-control">

												
												</div>

												<div class="col-lg-2 col-md-12">
														<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
														
														<a class="btn btn-primary" href="<?php echo base_url('Users/view_faq/');?>" style="margin-top:24px;width:80px;">Reset</a>
													</div>

											</div>

										</div>
									</form>
										<div class="acc-1 js-accordion"><?php foreach($view_faq as $faq){ ?>
											<div class="accordion__item js-accordion-item">
												<div class="accordion-header js-accordion-header"><?=$faq['faq_title'];?></div>
												<div class="accordion-body js-accordion-body">
													<div class="accordion-body__contents">
														<?= htmlspecialchars_decode(stripslashes($faq['faq_description']));?>
													</div>

												</div>
											</div>
											<?php } if(empty($view_faq)){ ?>
											<h4><center><strong>No FAQ's are Available</strong></center></h4>
										<?php } ?>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<!-- row end -->

					</div>

					<!-- Right-sidebar-->
					<?php include("right_sidebar.php");?>
					<!-- End Rightsidebar-->

					<!--footer-->
					<?php include("footer.php");?>
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

		<!--Time Counter js-->
		<script src="<?=base_url();?>assets/plugins/counters/jquery.missofis-countdown.js"></script>
		<script src="<?=base_url();?>assets/plugins/counters/counter.js"></script>

		<!-- Daterangepicker js-->
		<script src="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

		<!--Side-menu js-->
		<script src="<?=base_url();?>assets/plugins/side-menu/sidemenu.js"></script>

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

		<!-- Accordion js-->
		<script src="<?=base_url();?>assets/js/accordiation.js"></script>

		<!-- Custom js-->
		<script src="<?=base_url();?>assets/js/custom.js"></script>

	</body>
</html>