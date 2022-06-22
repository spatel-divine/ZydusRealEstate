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



		<!-- WYSIWYG Editor css -->



		<link href="<?=base_url();?>assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />







		<!--Summernote css-->



		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/summernote/summernote-bs4.css">









		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />



		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>

		<!-- File Uploads css-->

        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />



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



								<li class="breadcrumb-item active" aria-current="page">View Case Hearing Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Hearing List",$r)) { ?>

									<a href="<?php echo base_url('Legal/view_hearing_list');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>
											View Hearing List
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



										<h3 class="card-title">View Case Hearing Details</h3> &nbsp;&nbsp;

											<?php foreach($hearing_data as $hearing){?>
											<a href="<?php echo base_url('legal/download_hearing_document/'.base64_encode($hearing['hearing_id']));?>" class="btn btn-primary btn-sm">Download Current Hearing Case Document</a>
										
											<?php } ?>



									</div>



									<div class="card-body">



										<?php foreach($hearing_data as $hearing) { ?>	



											<div class="form-group">



												<div class="row">



													<div class="col-lg-12 col-md-12">



														<label>Property Name</label>

														<input type="text" value="<?php echo $hearing['property_name'];?>" class="form-control" readonly>
					

													</div>

													


												</div>

											</div>
										

											<div class="form-group">



									<div class="row">



							<div class="col-md-12 col-lg-12">



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Hearing Case Details</div>



								</div>



								<div class="card-body">



                                	<div class="table-responsive">


										<table class="table table-striped table-bordered text-wrap w-100">

											<!--Case ACcroding Property Selection-->



											<thead>



												<tr>

													<th class="wd-15p">Case Number</th>

													<th class="wd-15p">Case By</th>



													<th class="wd-15p">Case Against</th>



													<th class="wd-15p">Police Station</th>



													<th class="wd-15p">Case Type</th>



													<th class="wd-15p">Case Registration Date</th>



													<th class="wd-20p">Advocate</th>

													

												</tr>



											</thead>

											<td><?= $hearing['case_number'];?></td>

												<td><?php foreach($case_by as $by) {
															if($by['legal_id'] === $hearing['legal_id']){
																?>




	                													<?= $by['case_by_contact_person'].",";?>
                										<?php }} ?>
                											
                								</td>

												<td><?php foreach($case_against as $against) {
															if($against['legal_id'] === $hearing['legal_id']){
																?>




	                													<?= $against['case_against_contact_person'].",";?>
                										<?php }} ?>
                											
                								</td>

												<td><?= $hearing['police_station_name'];?></td>



												<td><?= $hearing['case_type'];?></td>


												<td><?= date("d-m-Y", strtotime($hearing['case_registered_date']));?></td>

												<td><?php foreach($advocate as $adv) {
																	if($adv['legal_id'] === $hearing['legal_id']){
																		?>




			                													<?= $adv['username'].",";?>
		                										<?php }} ?>
		                											
		                						</td>	


												</tr>


											</tbody>


										</table>



									</div>



                                </div>



								<!-- table-wrapper -->



							</div>



							<!-- section-wrapper -->



							</div>



						</div>

												</div>	
	

											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Hearing Date</label>



														

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker123" autocomplete="off" placeholder="Case Hearing Date" type="text" name="hearing_date" value="<?php echo date('d-m-Y', strtotime($hearing['hearing_date'])); ?>" readonly>



																			</div>



																		</div>				

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Next Hearing Date</label>



														

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" autocomplete="off" placeholder="Case Next Hearing Date" type="text" name="next_hearing_date" value="<?php echo date('d-m-Y', strtotime($hearing['next_hearing_date'])); ?>" readonly>



																			</div>



																		</div>
													</div>



													<div class="col-lg-4 col-md-12">



														<label>Case Status</label>


															<input type="text" class="form-control" value="<?php echo $hearing['case_status'];?>" readonly>
																					

													</div>



												</div>

											</div>



											<?php if(!empty($hearing['hearing_comments'])) { ?>		
												<div class="form-group">



													<div class="row">



														<div class="col-lg-12 col-md-12">

															<label>Hearing Comment</label>

															<textarea id="elm1" name="hearing_comment"><?php echo $hearing['hearing_comments']; ?></textarea>							

														</div>



													</div>

												</div>
											<?php } ?>	

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




		<!-- File uploads js -->

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>




		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>


	</body>



</html>