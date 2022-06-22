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



								<li class="breadcrumb-item active" aria-current="page">View Loan Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("View Loan List",$r)) { ?>
									<a href="<?php echo site_url('Loan/view_loan_list/')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Loan">
										<span>
											View All Loan
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



										<h3 class="card-title">View Loan Details</h3> &nbsp;&nbsp;

										<?php foreach($loan as $ln){?>
											<a href="<?php echo base_url('loan/download_uploaded_loan_document/'.base64_encode($ln['loan_id']));?>" class="btn btn-primary btn-sm">Download Current Uploaded Loan Document</a>
										<?php } ?>	



									</div>



									<div class="card-body">



										 
										 <?php  if(!empty($loan))
                             			 {

                              	 			foreach ($loan as $ln){?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>Property Name</label>



														<input type="text" class="form-control" value="<?php echo $ln['property_name'];?>" readonly>

																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Loan With Bank</label>
														
														<input type="text" class="form-control" value="<?php echo $ln['bank_name'];?>" readonly>
																					

													</div>

											

													<div class="col-lg-3 col-md-12">



														<label>Loan Officer Name</label>
														<input type="text" class="form-control" value="<?php echo $ln['loan_officer_name'];?>" readonly>
																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Beneficary Person</label>



														<input type="text" class="form-control" value="<?php echo $ln['username'];?>" readonly>

													</div>



												</div>	

											</div>		



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Loan Amount</label>



														<input type="text" class="form-control" value="<?php echo $ln['loan_amount'];?>" readonly>							

													</div>



														<div class="col-lg-4 col-md-12">



															<label>Loan Tenure Start Date</label>



																																	

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" autocomplete="off" placeholder="Loan Tenure Start Date" type="text" name="start_date" value="<?php echo date("d-m-Y", strtotime($ln['start_date'])); ?>" readonly>



																			</div>



																		</div>			

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Loan Tenure End Date</label>



																																	

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" autocomplete="off" name="end_date" placeholder="Loan Tenure End Date" type="text" value="<?php echo date("d-m-Y", strtotime($ln['end_date'])); ?>" readonly>



																			</div>



																		</div>			

														</div>

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-2 col-md-12">



														<label>Interest Type</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="interest_type" value="Simple Interest" <?php if($ln['interest_type'] == 'Simple Interest') { echo "Checked"; }?> id="interest_type" disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($ln['interest_type'] == 'Simple Interest') { echo "Checked"; }?>">Simple Interest</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="interest_type" value="Compound Interest" <?php if($ln['interest_type'] == 'Compound Interest') { echo "Checked"; }?> id="interest_type" disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($ln['interest_type'] == 'Compound Interest') { echo "Checked"; }?>">Compound Interest</span>



															</label>					

													</div>



														<div class="col-lg-2 col-md-12">



															<label>Installment Interest</label>

															<input type="text" class="form-control" value="<?php echo $ln['installment_interest'];?>" readonly>	
																																					

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Installment Amount</label>																						

															<input type="text" class="form-control" value="<?php echo $ln['installment_amount'];?>" readonly>	
														</div>


														<div class="col-lg-4 col-md-12">



															<label>Total Loan Amount</label>																						

															<input type="text" class="form-control" value="<?php echo $ln['total_loan_amount'];?>" readonly>	
														</div>
													

												</div>

											</div>	


											<div class="form-group">



												<div class="row">


														<div class="col-lg-4 col-md-12">



															<label>Payment Date</label>		

															<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control"  autocomplete="off" placeholder="Payment Day" type="text" name="payment_date" value="<?php echo $ln['payment_date'];?>" readonly>


																			</div>



																		</div>																			
	

														</div>




														<div class="col-lg-4 col-md-12">



														<label>Loan Type</label>



															<input type="text" class="form-control" value="<?php echo $ln['loan_type'];?>" readonly>	

																					

													</div>

													<div class="col-lg-4 col-md-12">
														
														<?php if($ln['lean_mark'] == 'Yes') { ?>

															<div class="col-lg-12 col-md-12">
																<label>Lean Mark</label>
																<input type="text" class="form-control" value="<?php echo $ln['lean_mark'];?>" readonly>
																
															</div><br/>
															<div class="col-lg-12 col-md-12">
																<label>Lean Mark Property</label>
																<?php foreach($lean_loan as $loan){ ?>
																	<input type="text" class="form-control" value="<?php echo $loan['property_name'];?>" readonly>
															   <?php } ?>
															</div>		

														<?php } else { ?>
															<div class="col-lg-12 col-md-12">
																<label>Lean Mark</label>
																<input type="text" class="form-control" value="<?php echo $ln['lean_mark'];?>" readonly>
															</div>	
														<?php } ?>	
													</div>	

													

												</div>

											</div>		



											<div class="form-group">



												<div class="row">



														<div class="col-lg-12 col-md-12">



															<label>Loan Remarks</label>
															<!-- For Remark use str replace for 's problem-->

															<textarea id="elm1" name="remark"><?php echo $ln['loan_remark']; ?></textarea>
														</div>

												</div>

											</div>





												<!--Wizrad Completes Here-->



										<?php } } ?>



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