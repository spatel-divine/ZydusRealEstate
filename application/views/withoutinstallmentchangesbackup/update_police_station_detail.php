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



		<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />







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



								<li class="breadcrumb-item active" aria-current="page">Edit Poilce Station Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Police Station Master",$r)) { ?>

									<a href="<?php echo site_url('Legal/police_station_master/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>

											View Police Station Details

										</span>

									</a> 

								<?php } ?>

								</div>

							</div>




						</div>



						<!-- End page-header -->







						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Edit Police Station Details</h3>



									</div>



									<div class="card-body">

										<?php foreach($police_station as $police){?>

										<?php echo form_open('Legal/update_police_station_detail_redirect/'.base64_encode($police['police_station_id']),array("method"=>"POST")); ?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Police Station Name</label>

														<?php if($this->input->post('submit') && $this->input->post('police_station_name') !== $police['police_station_name']) { ?>
															<input type="text" class="form-control" name="police_station_name" id="police_station_name" placeholder="Enter Police Station Name" value="<?php echo set_value('police_station_name');?>">
														<?php } else { ?>	
															<input type="text" class="form-control" name="police_station_name" id="police_station_name" placeholder="Enter Police Station Name" value="<?php echo $police['police_station_name'];?>">
														<?php } ?>	

														
																		
														<font color="red"><?=form_error("police_station_name");?></font>
													</div>



													<div class="col-lg-4 col-md-12">



														<label>Contact Number</label>

														<?php if($this->input->post('submit') && $this->input->post('contact_number') !== $police['police_station_contact_number']) { ?>
															<input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number"  value="<?php echo set_value('contact_number');?>">
														<?php } else { ?>	
															<input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number"  value="<?php echo $police['police_station_contact_number'];?>">
														<?php } ?>	

														
													<font color="red"><?=form_error("contact_number");?></font>
													</div>



													<div class="col-lg-4 col-md-12">



														<label>Branch</label>

														<?php if($this->input->post('submit') && $this->input->post('branch') !== $police['police_station_branch']) { ?>
															<input type="text" class="form-control" name="branch" id="branch" placeholder="Enter Police Station Branch"  value="<?php echo set_value('branch');?>">
														<?php } else { ?>	
															<input type="text" class="form-control" name="branch" id="branch" placeholder="Enter Police Station Branch"  value="<?php echo $police['police_station_branch'];?>">
														<?php } ?>	

														
														<font color="red"><?=form_error("branch");?></font>						

													</div>

												</div>

											</div>



											<div class="form-group">



												<div class="row">		



													<div class="col-lg-3 col-md-12">



														<label>Address</label>


														<?php if($this->input->post('submit') && $this->input->post('address') !== $police['police_station_address']) { ?>
															<textarea class="form-control" name="address" id="address" placeholder="Enter Address"><?php echo set_value('address');?></textarea>
														<?php } else { ?>
														<textarea class="form-control" name="address" id="address" placeholder="Enter Address"><?php echo $police['police_station_address'];?></textarea>	
														<?php } ?>	
														
														<font color="red"><?=form_error("address");?></font>
													</div>



													<div class="col-lg-3 col-md-12">



														<label>State</label>

														<?php if($this->input->post('submit') && $this->input->post('state') !== $police['police_station_state']) { ?>
															<input type="text" class="form-control" name="state" id="state" placeholder="Enter State"  value="<?php echo set_value('state');?>">
														<?php } else { ?>
														<input type="text" class="form-control" name="state" id="state" placeholder="Enter State"  value="<?php echo $police['police_station_state'];?>">	
														<?php } ?>	

														
														<font color="red"><?=form_error("state");?></font>
																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>City</label>

														<?php if($this->input->post('submit') && $this->input->post('city') !== $police['police_station_city']) { ?>
															<input type="text" class="form-control" name="city" id="city" placeholder="Enter City"  value="<?php echo set_value('city');?>">
														<?php } else { ?>	
															<input type="text" class="form-control" name="city" id="city" placeholder="Enter City"  value="<?php echo $police['police_station_city'];?>">
														<?php } ?>	

														
														<font color="red"><?=form_error("city");?></font>					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Pincode</label>

														<?php if($this->input->post('submit') && $this->input->post('pincode') !== $police['police_station_pincode']) { ?>
															<input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode"  value="<?php echo set_value('pincode');?>">
														<?php } else { ?>	
															<input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode"  value="<?php echo $police['police_station_pincode'];?>">
														<?php } ?>	

														
														<font color="red"><?=form_error("pincode");?></font>
													</div>



												</div>	

											</div>



											<div class="form-group"  style="float:right;">



												<div class="row">



													<input type="submit" name="submit" value="Submit" class="btn btn-app btn-primary mr-2 mt-1 mb-1">

												</div>

											</div>		





												<!--Wizrad Completes Here-->



										</form>
										<?php } ?>


									</div>



								</div>



							</div>



						</div>



					</div>



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







		<!--Time Counter js-->



		<script src="<?=base_url();?>assets/plugins/counters/jquery.missofis-countdown.js"></script>



		<script src="<?=base_url();?>assets/plugins/counters/counter.js"></script>







		<!-- Rightsidebar js -->



		<script src="<?=base_url();?>assets/plugins/sidebar/sidebar.js"></script>





		<!-- Forn-wizard js-->



		<script src="<?=base_url();?>assets/plugins/formwizard/jquery.smartWizard.js"></script>



		<script src="<?=base_url();?>assets/plugins/formwizard/fromwizard.js"></script>







		<!--Advanced Froms js-->



		<script src="<?=base_url();?>assets/js/advancedform.js"></script>



			<!-- Data tables js-->



		<script src="<?=base_url();?>assets/plugins/datatable/jquery.dataTables.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable-2.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.responsive.min.js"></script>







		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>







	</body>



</html>