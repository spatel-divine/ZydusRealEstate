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



		<!-- Time picker css-->



		<link href="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />







		<!-- Date Picker css-->



		<link href="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.css" rel="stylesheet" />





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



		<!-- File Uploads css-->



        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />



		<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />



		<!-- WYSIWYG Editor css -->



		<link href="<?=base_url();?>assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />







		<!--Summernote css-->



		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/summernote/summernote-bs4.css">









		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />



		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>





		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="<?=base_url();?>resources/demos/style.css">

  <style>

#mceu_20{
	pointer-events: none;
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



								<li class="breadcrumb-item active" aria-current="page">View Insurance Details</li>



							</ol><!-- End breadcrumb -->

								<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("View Insurance List",$r)) { ?>
									<a href="<?php echo site_url('Insurance/view_insurance_list/')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Insurance">
										<span>
											View All Insurance
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



										<h3 class="card-title">View Insurance Details</h3>



									</div>



									<div class="card-body">

										 <?php  if(!empty($insurance))
                              {

                              	 foreach ($insurance as $inc){?>

											<div class="form-group">



												<div class="row">



													<div class="col-lg-6 col-md-12">



														<label>Property Name</label>



														<input type="text" class="form-control" value="<?php echo $inc['property_name'];?>" readonly>

													</div>



													<div class="col-lg-6 col-md-12">



														<label>Insurance Name</label>



														<input type="text" name="insurance_name" class="form-control"  value="<?php echo $inc['insurance_name'];?>" readonly>

													</div>

												</div>	

											</div>

											<div class="form-group">



												<div class="row">



													<div class="col-lg-6 col-md-12">



														<label>Insurance Company</label>



														<input type="text" class="form-control" value="<?php echo $inc['insurance_company'];?>" readonly>
													</div>



													<div class="col-lg-6 col-md-12">



														<label>Policy No</label>



														<input type="text" name="policy_no" class="form-control" value="<?php echo $inc['policy_no'];?>" readonly>
																					

													</div>



													

												</div>	

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>Insurance Type</label>

														<h4><b>		
															<?php foreach($insurance_type as $type) { ?>
																<?= $type['insurance_type'].",";?>
															<?php } ?>	
														</b></h4>			
														
													</div>

													<div class="col-lg-3 col-md-12">



														<label>Coverage Amount</label>



														<input type="text" name="coverage_amount" class="form-control"  value="<?php echo $inc['coverage_amount'];?>" readonly>

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Premium Amount</label>



														<input type="text" name="premium_amount" class="form-control"  value="<?php echo $inc['premium_amount'];?>" readonly>

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Contact Agent</label>



														<input type="text" class="form-control" value="<?php echo $inc['username'];?>" readonly>
														</select>		

													</div>



												</div>

											</div>		

	



											<div class="form-group">



												<div class="row">

													<div class="col-lg-2 col-md-12">

														<label>Lean Mark</label>



														<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="Yes" <?php if($inc['lean_mark'] == 'Yes') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($inc['lean_mark'] == 'Yes') { echo "Checked"; }?>">Yes</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="No" <?php if($inc['lean_mark'] == 'No') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($inc['lean_mark'] == 'Yes') { echo "Checked"; }?>">No</span>



															</label>



													</div>	



														<div class="col-lg-5 col-md-12">

															<label>Next Premium Date</label>																						
																<input type="text" class="form-control" value="<?php echo date("d-m-Y", strtotime($inc['next_premium_date']));?>" readonly>

																							

														</div>



													<div class="col-lg-5 col-md-12">



														<label>Insurance Expiry Date</label>
															<input type="text" class="form-control" value="<?php echo date("d-m-Y", strtotime($inc['insurance_expiry_date']));?>" readonly>


																					

													</div>

												</div>

											</div>

											<?php if($inc['lean_mark'] == 'Yes') { ?>

												<div class="form-group">



													<div class="row">

														<div class="col-lg-6 col-md-12">

															<label>Company Name / Person Name</label>

																<input type="text" class="form-control" value="<?php echo $inc['lean_person_name'];?>" readonly>

														</div>

														<div class="col-lg-6 col-md-12">

															<label>Amount</label>

																<input type="text" class="form-control" value="<?php echo $inc['lean_amount'];?>" readonly>
														</div>

													</div>

												</div>	
											<?php } ?>		

												<div class="form-group">

													<div class="row">		



														<div class="col-lg-4 col-md-12">

															<label>Policy Owner</label>

															<h4><b>		
															<?php foreach($policy_owner as $owner) { ?>
																<?= $owner['username'].",";?>
															<?php } ?>	
														</b></h4>		

														
														</div>



															<div class="col-lg-4 col-md-12">



															<label>Policy Payer</label>


																<input type="text" class="form-control" value="<?php echo $inc['policy_payer'];?>" readonly>				

														</div>



														<div class="col-lg-4 col-md-12">

															<label>Beneficaries</label>

															<h4><b>		
															<?php foreach($policy_ben as $ben) { ?>
																<?= $ben['username'].",";?>
															<?php } ?>	
														</b></h4>		


														</div>

													

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-6 col-md-12">



															<label>Ledger Number</label>

																<input type="text" class="form-control" value="<?php echo $inc['ledger_number'];?>" readonly>

														</div>





														<div class="col-lg-6 col-md-12">



															<label>Ledger Head</label>
																<input type="text" class="form-control" value="<?php echo $inc['ledger_head'];?>" readonly>

														</div>



												</div>

											</div>



											<?php if(!empty($inc['insurance_remark'])){ ?>

											<div class="form-group">

												

												<div class="row">				



														<div class="col-lg-12 col-md-12">



															<label>Remark</label>



																																	

															<textarea class="form-control" name="insurance_remark" id="elm1"><?php echo  $inc['insurance_remark'];?></textarea>

																					

														</div>

													

												</div>

											</div>	
										<?php } ?>					

												<!--Wizrad Completes Here-->

									<?php }}?>

									</div>



								</div>



							</div>



						</div>



						<!--row closed-->



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



		<!-- File uploads js -->



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>





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



		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



		<!-- Timepicker js -->



		<script src="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.js"></script>



		<script src="<?=base_url();?>assets/plugins/time-picker/toggles.min.js"></script>





		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>



		<!-- WYSIWYG Editor js -->



		<script src="<?=base_url();?>assets/plugins/wysiwyag/jquery.richtext.js"></script>



		<script src="<?=base_url();?>assets/plugins/wysiwyag/richText1.js"></script>







		<!--Summernote js-->



		<script src="<?=base_url();?>assets/plugins/summernote/summernote-bs4.js"></script>



		<script src="<?=base_url();?>assets/js/summernote.js"></script>







		<!--ckeditor js-->



		<script src="<?=base_url();?>assets/plugins/tinymce/tinymce.min.js"></script>



		<script src="<?=base_url();?>assets/js/formeditor.js"></script>









		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>







	</body>



</html>