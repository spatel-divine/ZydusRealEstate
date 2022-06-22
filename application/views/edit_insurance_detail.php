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



								<li class="breadcrumb-item active" aria-current="page">Edit Insurance</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<a href="<?php echo site_url('Insurance/view_insurance_list/')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Insurance">
										<span>
											View All Insurance
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



										<h3 class="card-title">Edit Insurance Details</h3>



									</div>



									<div class="card-body">


										<?php foreach ($insurance as $i){
												?>

										 <?php echo form_open('Insurance/edit_insurance_detail_redirect/'.base64_encode($i['insurance_id']),array("method"=>"POST")); ?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>Property Name</label>

														<?php if($this->input->post('submit') && $this->input->post('property_id') !== $i['property_id']) { ?>
															<select id="property_id" name="property_id" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_id')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    											<?php endforeach; ?>

														</select>
														<?php } else { ?>
																<select id="property_id" name="property_id" class="form-control">

															<option value=" ">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php if($prop['property_id'] == $i['property_id']){ echo 'Selected';}?>><?php echo $prop['property_name'];?></option>
	    											<?php endforeach; ?>

														</select>
														<?php } ?>	

													

														<font color="red"><?=form_error("property_id");?></font>

																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Insurance Name</label>

														<?php if($this->input->post('submit') && $this->input->post('insurance_name') !== $i['insurance_name']) { ?>
															<input type="text" name="insurance_name" class="form-control" placeholder="Enter Insurance Name" value="<?php echo set_value('insurance_name');?>">
														<?php } else { ?>
															<input type="text" name="insurance_name" class="form-control" placeholder="Enter Insurance Name" value="<?php echo $i['insurance_name'];?>">
														<?php } ?>	

														

														<font color="red"><?=form_error("insurance_name");?></font>

																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Insurance Company</label>


														<?php if($this->input->post('submit') && $this->input->post('insurance_company_id') !== $i['insurance_company_id']) { ?>
											<select id="insurance_company_id" name="insurance_company_id" class="form-control">
															<option value="">Choose Insurance Company</option>

															<?php foreach($insurance_company as $company):?>
	    													<option value="<?php echo $company['insurance_company_id'];?>" <?php echo (set_value('insurance_company_id')== $company['insurance_company_id'])?" selected=' selected'":""?>><?php echo $company['insurance_company'];?></option>
	    											<?php endforeach; ?>

														</select>	
														<?php } else { ?>
															<select id="insurance_company_id" name="insurance_company_id" class="form-control">
															<option value=" ">Choose Insurance Company</option>

															<?php foreach($insurance_company as $company):?>
	    													<option value="<?php echo $company['insurance_company_id'];?>" <?php if($company['insurance_company_id'] == $i['insurance_company_id']){ echo 'Selected';}?>><?php echo $company['insurance_company'];?></option>
	    											<?php endforeach; ?>

														</select>	
														<?php } ?>	

														

														<font color="red"><?=form_error("insurance_company_id");?></font>	

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Policy No</label>

														<?php if($this->input->post('submit') && $this->input->post('policy_no') !== $i['policy_no']) { ?>
															<input type="text" name="policy_no" class="form-control" placeholder="Enter Policy No" value="<?php echo set_value('policy_no');?>">
														<?php } else { ?>
															<input type="text" name="policy_no" class="form-control" placeholder="Enter Policy No" value="<?php echo $i['policy_no'];?>">
														<?php } ?>	

														
														<font color="red"><?=form_error("policy_no");?></font>
																					

													</div>



													

												</div>	

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Insurance Type</label>

														<?php if($this->input->post('submit') && $this->input->post('insurance_type_id') !== $i['insurance_type_id']) { ?>
															<select id="insurance_type_id" name="insurance_type_id" class="form-control">

															<option value="">Choose Insurance Type</option>

															<?php foreach($insurance_type as $type):?>
	    													<option value="<?php echo $type['insurance_type_id'];?>" <?php echo (set_value('insurance_type_id')== $type['insurance_type_id'])?" selected=' selected'":""?>><?php echo $type['insurance_type'];?></option>
	    											<?php endforeach; ?>
														</select>
														<?php } else { ?>
															<select id="insurance_type_id" name="insurance_type_id" class="form-control">

															<option value=" ">Choose Insurance Type</option>

															<?php foreach($insurance_type as $type):?>
	    													<option value="<?php echo $type['insurance_type_id'];?>" <?php if($type['insurance_type_id'] == $i['insurance_type_id']){ echo 'Selected';}?>><?php echo $type['insurance_type'];?></option>
	    											<?php endforeach; ?>
														</select>
														<?php } ?>	

														

														<font color="red"><?=form_error("insurance_type_id");?></font>		

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Premium Amount</label>

														<?php if($this->input->post('submit') && $this->input->post('premium_amount') !== $i['premium_amount']) { ?>
															<input type="text" name="premium_amount" class="form-control" placeholder="Enter Premium Amount" value="<?php echo set_value('premium_amount');?>">
														<?php } else { ?>
															<input type="text" name="premium_amount" class="form-control" placeholder="Enter Premium Amount" value="<?php echo $i['premium_amount'];?>">
														<?php } ?>	

														<font color="red"><?=form_error("premium_amount");?></font>

																					

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Contact Agent</label>


														<?php if($this->input->post('submit') && $this->input->post('contact_agent') !== $i['contact_agent']) { ?>
															<select id="contact_agent" name="contact_agent" class="form-control">

															<option value="">Choose Contact Agent</option>

															<?php foreach($contact_agent as $contact_agent):?>
	    													<option value="<?php echo $contact_agent['user_id'];?>" <?php echo (set_value('contact_agent')== $contact_agent['user_id'])?" selected=' selected'":""?>><?php echo $contact_agent['username'];?></option>
	    											<?php endforeach; ?>

														</select>		
														<?php } else { ?>
															<select id="contact_agent" name="contact_agent" class="form-control">

															<option value=" ">Choose Contact Agent</option>

															<?php foreach($contact_agent as $contact_agent):?>
	    													<option value="<?php echo $contact_agent['user_id'];?>" <?php if($contact_agent['user_id'] == $i['contact_agent']){ echo 'Selected';}?>><?php echo $contact_agent['username'];?></option>
	    											<?php endforeach; ?>

														</select>		
														<?php } ?>	

														

														<font color="red"><?=form_error("contact_agent");?></font>

													</div>



												</div>

											</div>		

	



											<div class="form-group">



												<div class="row">

													<div class="col-lg-2 col-md-12">

														<label>Lean Mark</label>


														<?php if($this->input->post('submit') && $this->input->post('lean_mark') !== $i['lean_mark']) { ?>

														<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="Yes" <?php echo (set_value('lean_mark')== "Yes")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('lean_mark');?>">Yes</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="No"  <?php echo (set_value('lean_mark')== "No")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('lean_mark');?>">No</span>



															</label>
														<?php } else { ?>
															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="Yes" <?php if($i['lean_mark'] == 'Yes') { echo "Checked"; }?>>



																<span class="custom-control-label" style="color:black;" value="<?php if($i['lean_mark'] == 'Yes') { echo "Checked"; }?>">Yes</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="No" <?php if($i['lean_mark'] == 'No') { echo "Checked"; }?>>



																<span class="custom-control-label" style="color:black;" value="<?php if($i['lean_mark'] == 'Yes') { echo "Checked"; }?>">No</span>



															</label>


														<?php } ?>	
														

															<font color="red"><?=form_error("lean_mark");?></font>



													</div>	



														<div class="col-lg-5 col-md-12">

															<label>Next Premium Date</label>													
															<?php if($this->input->post('submit') && $this->input->post('next_premium_date') !== $i['next_premium_date']) { ?>

																<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Next Premium Date" type="text" name="next_premium_date" value="<?php echo set_value('next_premium_date');?>">



																			</div>



																		</div>
														<?php } else { ?>
															<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Next Premium Date" type="text" name="next_premium_date" value="<?php echo date("d-m-Y", strtotime($i['next_premium_date']));?>">



																			</div>



																		</div>
														<?php } ?>											

														

																		<font color="red"><?=form_error("next_premium_date");?></font>	

																							

														</div>



													<div class="col-lg-5 col-md-12">


														<label>Insurance Expiry Date</label>

														<?php if($this->input->post('submit') && $this->input->post('insurance_expiry_date') !== $i['insurance_expiry_date']) { ?>
																<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker2" autocomplete="off" placeholder="Insurance Expiry Date" type="text" name="insurance_expiry_date" value="<?php echo set_value('insurance_expiry_date');?>">



																			</div>



																		</div>
														<?php } else { ?>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker2" autocomplete="off" placeholder="Insurance Expiry Date" type="text" name="insurance_expiry_date" value="<?php echo date("d-m-Y", strtotime($i['insurance_expiry_date']));?>">



																			</div>



																		</div>
														<?php } ?>	



																		<font color="red"><?=form_error("insurance_expiry_date");?></font>


																					

													</div>


													</div>

												</div>

												

												<div class="form-group" style="display: none;" id="lean_div">



													<div class="row">

														<div class="col-lg-6 col-md-12">

															<label>Company Name / Person Name</label>



																		<?php if($this->input->post('submit') && $this->input->post('cp_name') !== $i['lean_person_name']) { ?>
																			<input type="text" id="cp_name" name="cp_name" class="form-control" placeholder="Enter Company / Person Name" value="<?php echo set_value('cp_name');?>">
																		<?php } else { ?>
																			<input type="text" id="cp_name" name="cp_name" class="form-control" placeholder="Enter Company / Person Name" value="<?php echo $i['lean_person_name'];?>">
																		<?php } ?>																

																		
																		<font color="red"><?=form_error("cp_name");?></font>

														</div>

														<div class="col-lg-6 col-md-12">

															<label>Amount</label>


															<?php if($this->input->post('submit') && $this->input->post('lean_amount') !== $i['lean_amount']) { ?>
																<input type="text" id="lean_amount" name="lean_amount" class="form-control" placeholder="Enter Lean Amount" value="<?php echo set_value('lean_amount');?>">
														<?php } else { ?>
															<input type="text" id="lean_amount" name="lean_amount" class="form-control" placeholder="Enter Lean Amount" value="<?php echo $i['lean_amount'];?>">
														<?php } ?>	
																																	

																		
																		<font color="red"><?=form_error("lean_amount");?></font>

														</div>

													</div>

												</div>		


												<div class="form-group">

													<div class="row">		



														<div class="col-lg-4 col-md-12">



															<label>Policy Owner</label>


															<?php if($this->input->post('submit') && $this->input->post('policy_owner') !== $i['policy_owner']) { ?>
																<select id="policy_owner" name="policy_owner" class="form-control">

																<option value="">Choose Policy Owner</option>

															<?php foreach($policy_owner as $policy_owner):?>
	    													<option value="<?php echo $policy_owner['user_id'];?>" <?php echo (set_value('policy_owner')== $policy_owner['user_id'])?" selected=' selected'":""?>><?php echo $policy_owner['username'];?></option>
	    													<?php endforeach; ?>

															</select>		
														<?php } else { ?>
															<select id="policy_owner" name="policy_owner" class="form-control">

																<option value=" ">Choose Policy Owner</option>

															<?php foreach($policy_owner as $policy_owner):?>
	    													<option value="<?php echo $policy_owner['user_id'];?>" <?php if($policy_owner['user_id'] == $i['policy_owner']){ echo 'Selected';}?>><?php echo $policy_owner['username'];?></option>
	    													<?php endforeach; ?>

															</select>		
														<?php } ?>	
																																	

															

																<font color="red"><?=form_error("policy_owner");?></font>					

														</div>



															<div class="col-lg-4 col-md-12">



															<label>Policy Payer</label>

															<?php if($this->input->post('submit') && $this->input->post('policy_payer') !== $i['policy_payer']) { ?>
																<input type="text" id="policy_payer" name="policy_payer" class="form-control" placeholder="Enter Policy Payer" value="<?php echo set_value('policy_payer');?>">
														<?php } else { ?>
																<input type="text" id="policy_payer" name="policy_payer" class="form-control" placeholder="Enter Policy Payer" value="<?php echo $i['policy_payer'];?>">
														<?php } ?>	

																																	

																	

																	<font color="red"><?=form_error("policy_payer");?></font>				

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Beneficaries</label>

															<?php if($this->input->post('submit') && $this->input->post('insurance_beneficaries') !== $i['insurance_beneficiary']) { ?>
																<select id="insurance_beneficaries" name="insurance_beneficaries" class="form-control">

																<option value="">Choose Insurance Beneficaries</option>

															<?php foreach($insurance_beneficary as $ben):?>
	    													<option value="<?php echo $ben['user_id'];?>" <?php echo (set_value('insurance_beneficaries')== $ben['user_id'])?" selected=' selected'":""?>><?php echo $ben['username'];?></option>
	    													<?php endforeach; ?>

															</select>	
														<?php } else { ?>
															<select id="insurance_beneficaries" name="insurance_beneficaries" class="form-control">

																<option value=" ">Choose Insurance Beneficaries</option>

															<?php foreach($insurance_beneficary as $ben):?>
	    													<option value="<?php echo $ben['user_id'];?>"<?php if($ben['user_id'] == $i['insurance_beneficiary']){ echo 'Selected';}?>><?php echo $ben['username'];?></option>
	    													<?php endforeach; ?>

															</select>	
														<?php } ?>	

																

															<font color="red"><?=form_error("insurance_beneficaries");?></font>						

														</div>

													

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



															<label>Ledger Number</label>


															<?php if($this->input->post('submit') && $this->input->post('ledger_number') !== $i['ledger_number']) { ?>
																<input type="text" id="ledger_number" name="ledger_number" class="form-control" placeholder="Enter Ledger Number" value="<?php echo set_value('ledger_number');?>">
														<?php } else { ?>
																<input type="text" id="ledger_number" name="ledger_number" class="form-control" placeholder="Enter Ledger Number" value="<?php echo $i['ledger_number'];?>">
														<?php } ?>	
																																	

																	

																		<font color="red"><?=form_error("ledger_number");?></font>			

														</div>





														<div class="col-lg-4 col-md-12">



															<label>Ledger Head</label>


															<?php if($this->input->post('submit') && $this->input->post('ledger_head') !== $i['ledger_head']) { ?>
																	<input type="text" id="ledger_head" name="ledger_head" class="form-control" placeholder="Enter Ledger Head" value="<?php echo set_value('ledger_head');?>">
														<?php } else { ?>
															<input type="text" id="ledger_head" name="ledger_head" class="form-control" placeholder="Enter Ledger Head" value="<?php echo $i['ledger_head'];?>">
														<?php } ?>	
																																	

															

															<font color="red"><?=form_error("ledger_head");?></font>						

														</div>

														<div class="col-lg-4 col-md-12">
															<label>Mark Insurance As Closed</label>
															<input type="hidden" name="db_insurance_renewed" value="<?php echo $i['insurance_renewed']?>">
															<div class="form-group form-elements m-0">

																<div class="custom-controls-stacked">
																	<label class="custom-control custom-checkbox">
																		<input type="checkbox" class="custom-control-input" name="insurance_renewed" value="2" <?php if($i['insurance_renewed'] == '2') { echo "Checked"; }?>>
																		<span class="custom-control-label" style="color:black;" value="<?php if($i['insurance_renewed'] == '2') { echo "Checked"; }?>">Mark Insurance As Closed</span>
																	</label>
																</div>	
											 
															</div>
										

														</div>	



												</div>

											</div>



											

											<div class="form-group">

												

												<div class="row">				



														<div class="col-lg-12 col-md-12">



															<label>Remark</label>

															<?php if($this->input->post('submit') && $this->input->post('insurance_remark') !== $i['insurance_remark']) { ?>
																<textarea id="elm1" name="insurance_remark"><?php echo set_value('insurance_remark');?></textarea>

															<?php } else { ?>
																<textarea id="elm1" name="insurance_remark"><?php echo $i['insurance_remark'];?></textarea>

															<?php } ?>	
																																	

															
																					

														</div>

													

												</div>

											</div>	

														



											<div class="form-group"  style="float:right;">



												<div class="row">



													<input type="submit" class="btn btn-primary float-right" value="Submit" name="submit">

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

		var element=document.getElementById('lean_div');

			$('input[type=radio][name=lean_mark]').change(function() {

			    if (this.value == 'Yes') {

			         element.style.display='block';

			    }

			    else{

			        element.style.display='none';

			    }

			});

			$(document).ready(function() {
 			 if($("input[type=radio][name=lean_mark]").is(":checked")) {
 			 	var element=document.getElementById('lean_div');


 			 	var element1=$('input[name="lean_mark"]:checked').val();

 			 	  if (element1 == 'Yes') {

			         element.style.display='block';

			    }

			    else{

			        element.style.display='none';

			    }
      //its checked
  		}
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


				    <script>
  $("#datepicker2").change(function() {
    var startDate = document.getElementById("datepicker1").value;
    var endDate = document.getElementById("datepicker2").value;

    ndate = startDate.split("-").reverse().join("-");
    ndate1 = endDate.split("-").reverse().join("-");

    if ((Date.parse(ndate1) <= Date.parse(ndate))) {
      alert("Expiry date should be greater than Premium date");
      document.getElementById("datepicker2").value = "";
    }
  });
</script>

    <script>
  $("#datepicker1").change(function() {
    var startDate = document.getElementById("datepicker1").value;
    var endDate = document.getElementById("datepicker2").value;

    ndate = startDate.split("-").reverse().join("-");
    ndate1 = endDate.split("-").reverse().join("-");

    if(startDate != '' && endDate != ''){

    	 if ((Date.parse(ndate) >= Date.parse(ndate1))) {
	      alert("Premium date should be Lesser than Expiry date");
	      document.getElementById("datepicker1").value = "";
	      document.getElementById("datepicker2").value = "";
    	}

    }

   
  });
</script>




	</body>



</html>