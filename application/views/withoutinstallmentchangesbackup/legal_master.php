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



								<li class="breadcrumb-item active" aria-current="page">Add Legal</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Legal Master",$r)) { ?>

									<a href="<?php echo site_url('Legal/view_legal_master/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>

											View Legal Details

										</span>

									</a>
									
									<?php } ?>


								</div>

							</div>



						</div>



						<!-- End page-header -->



						<?php if($this->session->flashdata('insert_legal')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insert_legal'); ?>
                                </div>
      							
    						<?php endif;?> 



						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Legal Details</h3>



									</div>



									<div class="card-body">



										<?php echo form_open_multipart('Legal/legal_master_redirect',array("method"=>"POST")); ?>

											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">
														<span style="color:red;">Note : Hold down the Ctrl (windows) or Command (Mac) button to select multiple options For Case By,Case Against and Advocate Name.</span>
													</div>
												</div>
											</div>			



											<div class="form-group">



												<div class="row">



													

													<div class="col-lg-3 col-md-12">



														<label>Property Name</label>

														<?php $access = explode(",",$prop_access);?>

														<select id="property_name" name="property_name" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):
																$property_id[] = $prop['property_id'];	
																$common_access = array_intersect($access,$property_id);
																?>
																<?php foreach($access as $acc){if($acc == $prop['property_id']) { ?>

	    															<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_name')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    														<?php }} ?>	
	    															
	    													<?php endforeach; ?>

														</select>

															<font color="red"><?=form_error("property_name");?></font>							

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Case Number</label>



														<input type="text" name="case_number" id="case_number" class="form-control" placeholder="Case Number" value="<?php echo set_value('case_number'); ?>">

														<font color="red"><?=form_error("case_number");?></font>								

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Case By</label>

														<select id="case_by[]" name="case_by[]" class="form-control" multiple>	

																	<?php foreach($case_by as $by):?>
																		<option value="<?php echo $by['case_by_id'];?>" <?php echo  set_select('case_by[]', $by['case_by_id']); ?>><?php echo $by['case_by_contact_person'];?></option>
		    														<?php endforeach; ?>

														</select>		
														<font color="red"><?=form_error("case_by[]");?></font>						

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Case Against</label>


														<select id="case_against[]" name="case_against[]" class="form-control" multiple>	

																	<?php foreach($case_against as $against):?>
																		<option value="<?php echo $against['case_against_id'];?>" <?php echo  set_select('case_against[]', $against['case_against_id']); ?>><?php echo $against['case_against_contact_person'];?></option>
		    														<?php endforeach; ?>

														</select>	
														<font color="red"><?=form_error("case_against[]");?></font>	
																					

													</div>



												</div>	

											</div>	


											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Police Station</label>



														<select id="police_station" name="police_station" class="form-control">

															<option value=" ">Choose Police Station</option>

															<?php foreach($police_station as $police):?>
																		<option value="<?php echo $police['police_station_id'];?>" <?php echo (set_value('police_station')== $police['police_station_id'])?" selected=' selected'":""?>><?php echo $police['police_station_name'];?></option>
		    														<?php endforeach; ?>

														</select>

															<font color="red"><?=form_error("police_station");?></font>							

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Act & Section Applied</label>



														<input type="text" id="act_section" name="act_section" class="form-control" placeholder="Enter Act & Section Applied" value="<?php echo set_value('act_section'); ?>">

														<font color="red"><?=form_error("act_section");?></font>								

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Case Type</label>



														<select id="case_type" name="case_type" class="form-control">

															<option value="">Case Type</option>

															<option vlaue="Civil" <?php echo (set_value('case_type')== 'Civil')?" selected=' selected'":""?>>Civil</option>

															<option vlaue="Criminal" <?php echo (set_value('case_type')== 'Criminal')?" selected=' selected'":""?>>Criminal</option>

														</select>

															<font color="red"><?=form_error("case_type");?></font>							

													</div>



												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">

														<label>Case Registred Date</label>



														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Case Registred Date" type="text" name="registred_date" value="<?php echo set_value('registred_date'); ?>">
																				
																			</div>



																		</div>

																		<font color="red"><?=form_error("registred_date");?></font>	

			

													</div>



														<div class="col-lg-4 col-md-12">



															<label>Advocate Name</label>

															<select id="advocate_name[]" name="advocate_name[]" class="form-control" multiple>	

																<?php foreach($advocate as $controller):?>
																	<option value="<?php echo $controller['user_id'];?>" <?php echo  set_select('advocate_name[]', $controller['user_id']); ?>><?php echo $controller['username'];?></option>
	    														<?php endforeach; ?>

															</select>	
																																					
															<font color="red"><?=form_error("advocate_name[]");?></font>	
														</div>




														<div class="col-lg-4 col-md-12">



															<label>Court & Authority Details</label>																						

															<select id="court_authority" name="court_authority" class="form-control">

															<option value="">Choose Court & Authority</option>

															<?php foreach($court_authority as $court):?>
																		<option value="<?php echo $court['legal_authority_id'];?>" <?php echo (set_value('court_authority')== $court['legal_authority_id'])?" selected=' selected'":""?>><?php echo $court['legal_court_authority'];?></option>
		    														<?php endforeach; ?>

														</select>																				<font color="red"><?=form_error("court_authority");?></font>			

														</div>

												</div>

											</div>

											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>Upload Case Document</label>
																	

															<input type="file" class="dropify" name="case_upload" id="case_upload" class="dropify" value="<?php echo set_value('case_upload');?>">

															<font color="red">
																<?php $new_in = $this->session->flashdata('new_in');
															if($new_in==2) { echo "Upload Case Document in Zip/Pdf/Jpg/Jpeg/Png/RAR Format Only.<br/>Document size should not be exceed more than 20mb"; } ?></font>
 															<?php if(empty($this->input->post(('case_upload')))){?>		
																<font color="red"><?=form_error("case_upload");?></font>
															<?php } ?>	
															
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