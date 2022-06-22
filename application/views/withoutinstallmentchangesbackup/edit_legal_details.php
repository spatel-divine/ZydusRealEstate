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



		<link href="assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />







		<!-- Date Picker css-->



		<link href="assets/plugins/spectrum-date-picker/spectrum.css" rel="stylesheet" />





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



		<link href="assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />







		<!--Summernote css-->



		<link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css">









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

									<a href="<?php echo site_url('Legal/view_legal_master/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>

											View Legal Details

										</span>

									</a>



								</div>

							</div>

	

						</div>



						<!-- End page-header -->







						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Legal Details</h3>



									</div>



									<div class="card-body">

										<?php foreach($legal as $l){?>

										<?php echo form_open_multipart('Legal/edit_legal_details_redirect/'.base64_encode($l['legal_id']),array("method"=>"POST")); ?>



											<div class="form-group">



												<div class="row">



													

													<div class="col-lg-2 col-md-12">



														<label>Property Name</label>

														<?php if($this->input->post('submit') && $this->input->post('property_name') !== $l['property_id']) { ?>

														<select id="property_name" name="property_name" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_name')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    													<?php endforeach; ?>

														</select>

													<?php } else { ?>

														<select id="property_name" name="property_name" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php if($l['property_id']== $prop['property_id']){ echo 'Selected';}?>><?php echo $prop['property_name'];?></option>
	    													<?php endforeach; ?>

														</select>

													<?php }  ?>
															<font color="red"><?=form_error("property_name");?></font>							

													</div>



													<div class="col-lg-2 col-md-12">



														<label>Case Number</label>


														<?php if($this->input->post('submit') && $this->input->post('case_number') !== $l['case_number']) { ?>
															<input type="text" name="case_number" id="case_number" class="form-control" placeholder="Case Number" value="<?php echo set_value('case_number'); ?>">
														<?php } else { ?>
															<input type="text" name="case_number" id="case_number" class="form-control" placeholder="Case Number" value="<?php echo $l['case_number']; ?>">
														<?php } ?>	

														<font color="red"><?=form_error("case_number");?></font>								

													</div>



													<div class="col-lg-2 col-md-12">

														<?php $one = 0;  foreach($case_by1 as $by1){?>

														<div class="form-group removethis3">
																<div class="row">

																	<label>Case By</label>

																	<select id="case_by[<?= $one ?>]" name="case_by[<?= $one ?>]" class="form-control">	

																		<option value="">Choose Case By</option>

																				<?php foreach($case_by as $by):?>
																					<option value="<?php echo $by['case_by_id'];?>" <?php if($by1['case_by_id']== $by['case_by_id']){ echo 'Selected';}?>><?php echo $by['case_by_contact_person'];?></option>
					    														<?php endforeach; ?>

																	</select>		
		
																</div>				
														</div>
														<?php $one++; } ?>
														<font color="red"><?=form_error("case_by[0]");?></font>
													</div>



													<div class="col-lg-2 col-md-12" style="margin-top: 23px;">



														<input type="button" class="btn btn-primary" id="addcaseby" value="Add" onclick='show_caseby(this.value);'>

													    <input type="button" class="btn btn-primary" id="removecaseby" value="Remove">

																					

													</div>



											

													<div class="col-lg-2 col-md-12">

														<?php $one = 0;  foreach($case_against1 as $against1){?>

														<div class="form-group removethis4">
																<div class="row">	

																	<label>Case Against</label>


																	<select id="case_against[<?= $one ?>]" name="case_against[<?= $one ?>]" class="form-control">	

																		<option value="">Case Against</option>

																				<?php foreach($case_against as $against):?>
																					<option value="<?php echo $against['case_against_id'];?>" <?php if(
																						$against1['case_against_id']== $against['case_against_id']){ echo 'Selected';}?>><?php echo $against['case_against_contact_person'];?></option>
					    														<?php endforeach; ?>

																	</select>	
																</div>
														</div>				
														
														<?php $one++;} ?>	

														<font color="red"><?=form_error("case_against[0]");?></font>							

													</div>



													<div class="col-lg-2 col-md-12" style="margin-top: 23px;">



														<input type="button" class="btn btn-primary" id="addcaseagainst" value="Add" onclick='show_caseagainst(this.value);'>

													    <input type="button" class="btn btn-primary" id="removecaseagainst" value="Remove">

																					

													</div>



												</div>	

											</div>	



													<div id="case_by_add" class="col-lg-8" style="display: none;">

													</div>

													<div id="case_against_add" style="display: none;">

													</div>

										

											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Police Station</label>

														<?php if($this->input->post('submit') && $this->input->post('police_station') !== $l['police_station_id']) { ?>

															<select id="police_station" name="police_station" class="form-control">

																<option value=" ">Choose Police Station</option>

																<?php foreach($police_station as $police):?>
																			<option value="<?php echo $police['police_station_id'];?>" <?php echo (set_value('police_station')== $police['police_station_id'])?" selected=' selected'":""?>><?php echo $police['police_station_name'];?></option>
			    														<?php endforeach; ?>

															</select>

														<?php } else { ?>

															<select id="police_station" name="police_station" class="form-control">

																<option value=" ">Choose Police Station</option>

																<?php foreach($police_station as $police):?>
																			<option value="<?php echo $police['police_station_id'];?>" <?php if($l['police_station_id']== $police['police_station_id']){ echo 'Selected'; }?>><?php echo $police['police_station_name'];?></option>
			    														<?php endforeach; ?>

															</select>

														<?php } ?>	

															<font color="red"><?=form_error("police_station");?></font>							

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Act & Section Applied</label>

														<?php if($this->input->post('submit') && $this->input->post('act_section') !== $l['act_section_applied']) { ?>

															<input type="text" id="act_section" name="act_section" class="form-control" placeholder="Enter Act & Section Applied" value="<?php echo set_value('act_section'); ?>">

														<?php } else {?>
															<input type="text" id="act_section" name="act_section" class="form-control" placeholder="Enter Act & Section Applied" value="<?php echo $l['act_section_applied']; ?>">
														<?php } ?>	

														<font color="red"><?=form_error("act_section");?></font>								

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Case Type</label>

														<?php if($this->input->post('submit') && $this->input->post('case_type') !== $l['case_type']) { ?>

															<select id="case_type" name="case_type" class="form-control">

																<option value="">Case Type</option>

																<option vlaue="Civil" <?php echo (set_value('case_type')== 'Civil')?" selected=' selected'":""?>>Civil</option>

																<option vlaue="Criminal" <?php echo (set_value('case_type')== 'Criminal')?" selected=' selected'":""?>>Criminal</option>

															</select>

													<?php } else { ?>

														<select id="case_type" name="case_type" class="form-control">

																<option value="">Case Type</option>

																<option vlaue="Civil" <?php if($l['case_type']== 'Civil'){ echo 'Selected';}?>>Civil</option>

																<option vlaue="Criminal" <?php if($l['case_type'] == 'Criminal'){ echo 'Selected';}?>>Criminal</option>

															</select>

													<?php } ?>
															<font color="red"><?=form_error("case_type");?></font>							

													</div>



												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">

														<label>Case Registred Date</label>


														<?php if($this->input->post('submit') && $this->input->post('registred_date') !== $l['	case_registered_date']) { ?>
														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>
																					
																				
																					<input class="form-control" id="datepicker1" autocomplete="off" placeholder="Case Registred Date" type="text" name="registred_date" value="<?php echo set_value('registred_date'); ?>">
																			
																			</div>



																		</div>

																	<?php } else { ?>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>
																					

																					<input class="form-control" id="datepicker1" autocomplete="off" placeholder="Case Registred Date" type="text" name="registred_date" value="<?php echo date("d-m-Y", strtotime($l['case_registered_date'])); ?>">

																			</div>



																		</div>
																	<?php } ?>	

																		<font color="red"><?=form_error("registred_date");?></font>	

			

													</div>



														<div class="col-lg-4 col-md-12">

															<?php $one = 0;  foreach($advocate1 as $ad){?>

															<div class="form-group removethis5">
																<div class="row">

																	<label>Advocate Name</label>

																	<select id="advocate_name[<?= $one ?>]" name="advocate_name[<?= $one ?>]" class="form-control">	

																	<option value="">Choose Advocate</option>

																		<?php foreach($advocate as $controller):?>
																			<option value="<?php echo $controller['user_id'];?>" <?php if($ad['advocate_id']== $controller['user_id']){echo 'Selected';}?>><?php echo $controller['username'];?></option>
			    														<?php endforeach; ?>

																	</select>	
																</div>
															</div>		
																																					
															<?php $one++; } ?>

															<font color="red"><?=form_error("advocate_name[0]");?></font>	
														</div>



														<div class="col-lg-2 col-md-12" style="margin-top: 23px;">



														<input type="button" class="btn btn-primary" id="addadvocate" value="Add" onclick='show_advocate(this.value);'>

													    <input type="button" class="btn btn-primary" id="removeadvocate" value="Remove">

																					

													</div>



														<div class="col-lg-3 col-md-12">



															<label>Court & Authority Details</label>																						
															<?php if($this->input->post('submit') && $this->input->post('court_authority') !== $l['	court_authority_id']) { ?>
																<select id="court_authority" name="court_authority" class="form-control">

																	<option value="">Choose Court & Authority</option>

																	<?php foreach($court_authority as $court):?>
																				<option value="<?php echo $court['legal_authority_id'];?>" <?php echo (set_value('court_authority')== $court['legal_authority_id'])?" selected=' selected'":""?>><?php echo $court['legal_court_authority'];?></option>
				    												<?php endforeach; ?>		

																</select>																			
															<?php } else { ?>

																<select id="court_authority" name="court_authority" class="form-control">

																	<option value="">Choose Court & Authority</option>

																	<?php foreach($court_authority as $court):?>
																				<option value="<?php echo $court['legal_authority_id'];?>" <?php if($l['court_authority_id']== $court['legal_authority_id']){ echo 'Selected';}?>><?php echo $court['legal_court_authority'];?></option>
				    												<?php endforeach; ?>		

																</select>			

															<?php } ?>	
																<font color="red"><?=form_error("court_authority");?></font>			

														</div>

												</div>

											</div>

											<div style="display: none;" id="advocate_div"></div>


											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>Upload Case Document</label>&nbsp;&nbsp; <a href="<?php echo base_url('legal/download_case_document/'.base64_encode($l['legal_id']));?>" class="btn btn-primary btn-sm">Download Current Case Document</a>



																																	

															<input type="file" class="dropify" name="case_upload" id="case_upload" class="dropify" value="<?php echo set_value('case_upload');?>">

															<font color="red">
																<?php $new_in = $this->session->flashdata('new_in');
															if($new_in==2) { echo "Upload Case Document in Zip Format Only.<br/>Zip size should not be exceed more than 5mb"; } ?></font>
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



		<script type="text/javascript">

			function show_caseby(val){

				 var element=document.getElementById('case_by_add');

				   element.style.display='block';

				}



				function show_caseagainst(val){

				 var element=document.getElementById('case_against_add');

				   element.style.display='block';

				}



				function show_advocate(val){

				 var element=document.getElementById('advocate_div');

				   element.style.display='block';

				}

		</script>



		<script type="text/javascript">

		var max_fields      = 10;

    	var x = <?php if(!empty($case_by1)) { echo count($case_by1); } else { echo 1; } ?>;

        $(document).ready(function() {

            $("#addcaseby").on("click", function() {

                if(x < max_fields){ 



               $("#case_by_add").append('<div class="form-group"><div class="row"><div class="col-lg-6 col-md-12"></div><div class="col-lg-5 col-md-12"><div class="form-group"><div class="row"><label>Case By</label><select id="case_by['+x+']" name="case_by['+x+']" class="form-control"><option value="">Choose Case By</option><?php foreach($case_by as $by):?><option value="<?php echo $by['case_by_id'];?>" <?php echo (set_value('case_by')== $by['case_by_id'])?" selected=' selected'":""?>><?php echo $by['case_by_contact_person'];?></option><?php endforeach; ?></select></div></div></div></div></div>');

                x++;

            }

             $('#removecaseby').attr("disabled", false);

            

            

            });

             $("#removecaseby").on("click", function() {

             	var acount = <?php echo count($case_by1); ?>

	             	if(x > acount)
	             	{
	             		 $("#case_by_add").children().last().remove();
						 x--;
	             	}
	             	else
	             	{
	             		 $(".removethis3").children().last().remove();
	             	}        	
            });

        });

		</script>



		<script type="text/javascript">

		var max_fields      = 10;

    	var x1 = <?php if(!empty($case_against1)) { echo count($case_against1); } else { echo 1; } ?>;

        $(document).ready(function() { 

            $("#addcaseagainst").on("click", function() {

                if(x1 < max_fields){ 



               $("#case_against_add").append('<div class="form-group"><div class="row"><div class="col-lg-8 col-md-12"></div><div class="col-lg-3 col-md-12"><div class="form-group"><div class="row"><label>Case Against</label><select id="case_against['+x1+']" name="case_against['+x1+']" class="form-control"><option value="">Case Against</option><?php foreach($case_against as $against):?><option value="<?php echo $against['case_against_id'];?>" <?php echo (set_value('case_against')== $against['case_against_id'])?" selected=' selected'":""?>><?php echo $against['case_against_contact_person'];?><?php endforeach; ?></select></div></div></div></div></div>');

                x1++;

            }

             $('#removecaseagainst').attr("disabled", false);

            

            

            });

             $("#removecaseagainst").on("click", function() {

             	var acount = <?php echo count($case_against1); ?>

             	if(x1 > acount)
	             	{
	             		 $("#case_against_add").children().last().remove();
						 x1--;
	             	}
	             	else
	             	{
	             		 $(".removethis4").children().last().remove();
	             	}      

            });

        });

		</script>



		<script type="text/javascript">

		var max_fields      = 10;

    	var x2 = <?php if(!empty($advocate1)) { echo count($advocate1); } else { echo 1; } ?>;

        $(document).ready(function() {

            $("#addadvocate").on("click", function() {

                if(x2 < max_fields){ 



               $("#advocate_div").append('<div class="form-group"><div class="row"><div class="col-lg-3 col-md-12"></div><div class="col-lg-5 col-md-12"><div class="form-group"><div class="row"><label>Advocate Name</label><select id="advocate_name['+x2+']" name="advocate_name['+x2+']" class="form-control"><option value="">Choose Advocate</option><?php foreach($advocate as $controller):?><option value="<?php echo $controller['user_id'];?>" <?php echo (set_value('advocate_name')== $controller['user_id'])?" selected=' selected'":""?>><?php echo $controller['username'];?></option><?php endforeach; ?></select></div></div></div></div></div>');

                x2++;

            }


             $('#removeadvocate').attr("disabled", false);

            

            

            });

             $("#removeadvocate").on("click", function() {
             	var acount = <?php echo count($advocate1); ?>

             	if(x2 > acount)
	             	{
	             		 $("#advocate_div").children().last().remove();
						 x2--;
	             	}
	             	else
	             	{
	             		 $(".removethis5").children().last().remove();
	             	}  

            });

        });

		</script>





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



		<script src="assets/plugins/time-picker/jquery.timepicker.js"></script>



		<script src="assets/plugins/time-picker/toggles.min.js"></script>





		<!-- Datepicker js -->



		<script src="assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="assets/plugins/input-mask/jquery.maskedinput.js"></script>



		<!-- WYSIWYG Editor js -->



		<script src="assets/plugins/wysiwyag/jquery.richtext.js"></script>



		<script src="assets/plugins/wysiwyag/richText1.js"></script>







		<!--Summernote js-->



		<script src="assets/plugins/summernote/summernote-bs4.js"></script>



		<script src="assets/js/summernote.js"></script>







		<!--ckeditor js-->



		<script src="assets/plugins/tinymce/tinymce.min.js"></script>



		<script src="assets/js/formeditor.js"></script>




		<!-- File uploads js -->

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>




		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>







	</body>



</html>