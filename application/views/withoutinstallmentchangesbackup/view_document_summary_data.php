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



		<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />



		<!-- File Uploads css-->



        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />



		<!-- WYSIWYG Editor css -->



		<link href="<?=base_url();?>assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />







		<!--Summernote css-->



		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/summernote/summernote-bs4.css">









		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />



		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>


  		<link rel="stylesheet" href="<?=base_url();?>resources/demos/style.css">



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



								<li class="breadcrumb-item active" aria-current="page">View Upload Document Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Document Summary",$r)) { ?>

									<a href="<?php echo base_url('Document/document_summary');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>
											View Document Summary List
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



										<h3 class="card-title">View Upload Document Details</h3>



									</div>



									<div class="card-body">



										<?php foreach($document_summary as $doc){?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>Property Name</label>



														<input type="text" value="<?php echo $doc['property_name'];?>" class="form-control" readonly>

																					

													</div>



														<div class="col-lg-3 col-md-12">



														<label>Document Name</label>



														<input type="text" value="<?php echo $doc['document_name'];?>" class="form-control" readonly>
																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Document For</label>



														<input type="text" value="<?php echo $doc['document_for'];?>" class="form-control" readonly>
																					

													</div>





													<div class="col-lg-3 col-md-12">



														<label>Document Authority</label>



														<input type="text" value="<?php echo $doc['document_authority'];?>" class="form-control" readonly>

													</div>



												</div>

											</div>	

											

										

											<div class="form-group">



												<div class="row">

													<!-- show if renewal is yes in document_master-->

													<div class="col-lg-6 col-md-12">



														<label>Renewal Date</label>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>

																				<?php if(!empty($doc['renewal_date'])) { ?>

																				<input class="form-control" autocomplete="off" name="renewal_date" placeholder="Renewal Date" type="text" value="<?php echo date("d-m-Y", strtotime($doc['renewal_date']));?>" readonly>
																			<?php } else {?>

																				<input class="form-control" autocomplete="off" name="renewal_date" placeholder="Renewal Date" type="text" readonly>

																			<?php } ?>


																			</div>



																		</div>
																		
													</div>



													<div class="col-lg-6 col-md-12">



														<label>Document Number</label>

															<input type="text" value="<?php echo $doc['document_number'];?>" class="form-control" readonly>
													</div>



												</div>

											</div>



											<div class="form-group">



												<div class="row">



												

														<div class="col-lg-3 col-md-12">



														<label>State</label>

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">






																				</div><input class="form-control" autocomplete="off" placeholder="State" type="text" name="document_state" value="<?php echo $doc['document_state'];?>" readonly>


																			</div>



																		</div>

																	

													</div>		

													<div class="col-lg-3 col-md-12">

<label>Date of Registration</label>

<div class="wd-200 mg-b-30">



					<div class="input-group">



						<div class="input-group-prepend">



							<div class="input-group-text">



								<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



							</div>



						</div><input class="form-control" autocomplete="off" placeholder="Date of Registration" type="text" name="registration_date" value="<?php echo date("d-m-Y", strtotime($doc['registration_date']));?>" readonly>


					</div>



				</div>
	
</div>



<div class="col-lg-3 col-md-12">

<label>Date of Execution</label>

<div class="wd-200 mg-b-30">



					<div class="input-group">



						<div class="input-group-prepend">



							<div class="input-group-text">



								<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



							</div>



						</div><input class="form-control" autocomplete="off" placeholder="Date of Execution" type="text" name="execution_date" value="<?php echo date("d-m-Y", strtotime($doc['execution_date']));?>" readonly>


					</div>



				</div>
			
		</div>

<div class="col-lg-3 col-md-12">



<label>How Many Day Before Want Notification?</label>

<div class="wd-200 mg-b-30">



					<div class="input-group">



						<div class="input-group-prepend">



							<div class="input-group-text">



								<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



							</div>



						</div><input class="form-control" autocomplete="off" placeholder="Enter Notification Day" type="text" name="notification_day" value="<?php echo $doc['notification_day'];?>" readonly>


					</div>



				</div>

			

</div>

												</div>

													

											</div>



											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															


															<?php $image =  base64_decode($doc['document_upload']);
															$img_extension = strrchr($image,'.');

															$ext = array($img_extension);

															if((in_array('.zip',$ext)) OR (in_array('.rar',$ext))){
															?>
															<br/>
															<h5><b>View of This Document is Not Available Please Download the Document.</b> <a href="<?php echo base_url('document/download_document/'.base64_encode($doc['upload_document_id']));?>" class="btn btn-primary btn-sm" style="float:right;">Document Download</a></h5> 
															

															<?php } else { ?>

																<label>View Document</label> <a href="<?php echo base_url('document/download_document/'.base64_encode($doc['upload_document_id']));?>" class="btn btn-primary btn-sm" style="float:right;">Document Download</a>
															<br/>
															<br/>
																																		

															<a href="<?php echo base_url('Document/download_document/'.base64_encode($doc['upload_document_id']));?>"><embed src="<?php echo base_url('assets/images/uploads/documents/'.$image);?>" width="100%" height="500px"></embed> </a>
																
															<?php } ?>					

														</div>

													

												</div>

											</div>

									
												<!--Wizrad Completes Here-->



										<?php } ?>



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





		<!-- File uploads js -->



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>



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