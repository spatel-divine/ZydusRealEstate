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



								<li class="breadcrumb-item active" aria-current="page">Add Income</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Income List",$r)) { ?>

									<a href="<?php echo base_url('Income/view_income_list');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>
											View Income List
										</span>

									</a> &nbsp;&nbsp;

								<?php } ?>

								<?php $r = explode(",",$roles); if(in_array("Income Type Master",$r)) { ?>

									<a href="<?php echo base_url('Income/income_type_master');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">

										<span>

											<i class="fa fa-plus">Add Income Type</i>

										</span>

									</a>

								<?php } ?>


								</div>

							</div>



						</div>



						<!-- End page-header -->


							<?php if($this->session->flashdata('add_income')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('add_income'); ?>
                                </div>
      							
    						<?php endif;?> 




						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Income Details</h3>



									</div>



									<div class="card-body">



										 <?php echo form_open_multipart('Income/income_master_redirect',array("method"=>"POST")); ?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-6 col-md-12">



															<label>Ledger Head</label>



																																	

																		<input type="text" id="ledger_head" name="ledger_head" class="form-control" placeholder="Enter Ledger Head" value="<?php echo set_value('ledger_head'); ?>">
																		<font color="red"><?=form_error("ledger_head");?></font>
																					

														</div>

													<div class="col-lg-6 col-md-12">



															<label>Ledger Number</label>



																																	

																		<input type="text" id="ledger_number" name="ledger_number" class="form-control" placeholder="Enter Ledger Number" value="<?php echo set_value('ledger_number'); ?>">

																		<font color="red"><?=form_error("ledger_number");?></font>			

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



														<label>Income Title</label>



														<input type="text" id="income_title" name="income_title" class="form-control" placeholder="Enter Income Title" value="<?php echo set_value('income_title'); ?>">			
														<font color="red"><?=form_error("income_title");?></font>	

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Income Amount</label>



														<input type="text" id="income_amount" name="income_amount" class="form-control" placeholder="Enter Income Amount" value="<?php echo set_value('income_amount'); ?>">	
														<font color="red"><?=form_error("income_amount");?></font>			

													</div>

											

													<div class="col-lg-3 col-md-12">



														<label>Income Date</label>



														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" name="income_date" autocomplete="off" placeholder="Enter Income Date" type="text" value="<?php echo set_value('income_date'); ?>">
																				


																			</div>
																		<font color="red"><?=form_error("income_date");?></font>
		

														</div>

																					

													</div>

												</div>	

											</div>		



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Income Type</label>



														<select id="income_type" name="income_type" class="form-control">

															<option value="">Choose Income Type</option>

															<?php foreach($income_type as $type):?>
	    													<option value="<?php echo $type['income_type_id'];?>" <?php echo (set_value('income_type')== $type['income_type_id'])?" selected=' selected'":""?>><?php echo $type['income_type'];?></option>
	    													<?php endforeach; ?>

														</select>
														<font color="red"><?=form_error("income_type");?></font>	

													</div>



														<div class="col-lg-4 col-md-12">



															<label>Income Source Vendor Name</label>



																																	

														<select id="party" name="party" class="form-control">

															<option value="">Choose Income Source Vendor Name</option>

																<?php foreach($income_source as $source):?>
																	<option value="<?php echo $source['user_id'];?>" <?php echo (set_value('party')== $source['user_id'])?" selected=' selected'":""?>><?php echo $source['username'];?></option>
	    														<?php endforeach; ?>

														</select>

															<font color="red"><?=form_error("party");?></font>						

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Invoice Number</label>



																																	

																		<input type="text" id="invoice_number" name="invoice_number" class="form-control" placeholder="Enter Invoice Number" value="<?php echo set_value('invoice_number'); ?>">

																			<font color="red"><?=form_error("invoice_number");?></font>		

														</div>

													

												</div>

											</div>



											<!--<div class="form-group" id="markassold" style="display: none;">



												<div class="row">



													<div class="col-lg-12 col-md-12">



															<label class="custom-control custom-checkbox">



																<input type="checkbox" class="custom-control-input" name="mark_as_sold" value="Mark Property AS Sold" checked>



																<span class="custom-control-label" style="color:black;">Mark Property AS Sold</span>



															</label>			

													</div>

												</div>

											</div>	-->



											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>Invoice Upload</label>



																																	

															<input type="file" class="form-control dropify" name="invoice_images" class="dropify" value="<?php echo set_value('invoice_images'); ?>">

															<font color="red"><?php $new_in = $this->session->flashdata('new_in');
 															if($new_in==2) { echo "Supported Invoice Upload Types are JPG/JPEG/PNG/PDF/ZIP/RAR.<br/>Size should not be exceed more than 20mb"; } ?></font>

															<?php if(empty($this->input->post(('invoice_images')))){?>
															<font color="red"><?=form_error("invoice_images");?></font>
															<?php } ?>											

														</div>

													

												</div>

											</div>			



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>TDS Percentage</label>

														<input type="text" name="tds_percentage" id="tds_percentage" class="form-control" placeholder="Enter TDS Percentage(%)" value="<?php echo set_value('tds_percentage'); ?>">
														<font color="red"><?=form_error("tds_percentage");?></font>
																		

													</div>



														<div class="col-lg-3 col-md-12">



															<label>GST Percentage</label>

															<input type="text" name="gst_percentage" id="gst_percentage" class="form-control" placeholder="Enter GST Percentage(%)" value="<?php echo set_value('gst_percentage'); ?>">	

																<font color="red"><?=form_error("gst_percentage");?></font>																					

														</div>



														<div class="col-lg-3 col-md-12">



															<label>Received By</label>																						

															<select id="received_by" name="received_by" class="form-control">

																<option value="">Choose Received By</option>

																<?php foreach($recieved_by as $by):?>
																	<option value="<?php echo $by['user_id'];?>" <?php echo (set_value('received_by')== $by['user_id'])?" selected=' selected'":""?>><?php echo $by['username'];?></option>
	    														<?php endforeach; ?>

															</select>																							
															<font color="red"><?=form_error("received_by");?></font>
														</div>



														<div class="col-lg-3 col-md-12">



															<label>Recurring Income</label>



																<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="recurring_income" value="Yes" <?php echo (set_value('recurring_income')== "Yes")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('recurring_income');?>">Yes</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="recurring_income" value="No" <?php echo (set_value('recurring_income')== "No")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('recurring_income');?>">No</span>

															</label>

															<font color="red"><?=form_error("recurring_income");?></font>																						
															
														</div>

													

												</div>

											</div>



											<div class="form-group" id="next_date" style="display: none;">



												<div class="row">



														<div class="col-lg-9 col-md-12">

														</div>	

														<div class="col-lg-3 col-md-12">



															<label>Next Recurring Date</label>

															<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker2" name="next_recurring_date" autocomplete="off" placeholder="Enter Next Recurring Date" type="text" value="<?php echo set_value('next_recurring_date'); ?>">



																			</div>



														</div>

															<font color="red"><?=form_error("next_recurring_date");?></font>																						

														</div>

												</div>

											</div>					



											<div class="form-group">



												<div class="row">



														<div class="col-lg-12 col-md-12">



															<label>Income Description</label>

															<textarea id="elm1" name="income_description"><?php echo set_value('income_description'); ?></textarea>

																																					

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



		<!--<script>

			function sale_property(val){

				 var element=document.getElementById('markassold');

				 if(val=='Sale Property')

				   element.style.display='block';

				 else  

				   element.style.display='none';

				}

		</script>-->



<script type="text/javascript">

			var element=document.getElementById('next_date');

			$('input[type=radio][name=recurring_income]').change(function() {

			    if (this.value == 'Yes') {

			         element.style.display='block';

			    }

			    else{

			        element.style.display='none';

			    }

			});

			$(document).ready(function() {
 			 if($("input[type=radio][name=recurring_income]").is(":checked")) {
 			 	var element=document.getElementById('next_date');


 			 	var element1=$('input[name="recurring_income"]:checked').val();

 			 	  if (element1 == 'Yes') {

			         element.style.display='block';

			    }

			    else{

			        element.style.display='none';

			    }
			}
		})	    

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