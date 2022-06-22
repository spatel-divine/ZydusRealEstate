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


  <link rel="stylesheet" href="<?=base_url();?>resources/demos/style.css">




	</head>







	<body class="app sidebar-mini">







		<!--Global-Loader-->



		<!--<div id="global-loader">



			<img src="<?=base_url();?>assets/images/brand/icon.png" alt="loader">



		</div>-->







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



								<li class="breadcrumb-item active" aria-current="page">Edit Loan</li>



							</ol><!-- End breadcrumb -->



						</div>



						<!-- End page-header -->







						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Edit Loan Details</h3>



									</div>



									<div class="card-body">


										<?php foreach($loan as $ln){?>
										 <?php echo form_open('Loan/edit_loan_detail_redirect/'.base64_encode($ln['loan_id']),array("method"=>"POST","id"=>"myForm")); ?>

											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">

														
														<label>Property Name</label>


														<?php if($this->input->post('submit') && $this->input->post('property_name') !== $ln['property_id']) { ?>
															<select id="property_name" name="property_name" class="form-control">
														<option value="">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_name')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    													<?php endforeach; ?>

														</select>
														<?php } else { ?>
															<select id="property_name" name="property_name" class="form-control">
														<option value=" ">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php if($prop['property_id'] == $ln['property_id']){ echo 'Selected';}?>><?php echo $prop['property_name'];?></option>
	    													<?php endforeach; ?>

														</select>		
														<?php } ?>	

																
														<font color="red" id="errors7"><?=form_error("property_name");?></font>
													</div>



													<div class="col-lg-3 col-md-12">



														<label>Loan With Bank</label>

														<?php if($this->input->post('submit') && $this->input->post('loan_wih_bank') !== $ln['bank_id']) { ?>
															<select id="loan_wih_bank" name="loan_wih_bank" class="form-control">

															<option value="">Choose Loan With Bank</option>

															<?php foreach($bank as $bank):?>
	    													<option value="<?php echo $bank['bank_id'];?>" <?php echo (set_value('loan_wih_bank')== $bank['bank_id'])?" selected=' selected'":""?>><?php echo $bank['bank_name'];?></option>
	    													<?php endforeach; ?>

														</select>
														<?php } else { ?>
															<select id="loan_wih_bank" name="loan_wih_bank" class="form-control">

															<option value=" ">Choose Loan With Bank</option>

															<?php foreach($bank as $bank):?>
	    													<option value="<?php echo $bank['bank_id'];?>" <?php if($bank['bank_id'] == $ln['bank_id']){ echo 'Selected';}?>><?php echo $bank['bank_name'];?></option>
	    													<?php endforeach; ?>

														</select>
														<?php } ?>	

														
														<font color="red"><?=form_error("loan_wih_bank");?></font>							

													</div>

											

													<div class="col-lg-3 col-md-12">



														<label>Loan Officer Name</label>

														<?php if($this->input->post('submit') && $this->input->post('loan_officer_name') !== $ln['loan_officer_id']) { ?>
															<input type="hidden" name="abcd1" id="loan_officer_name_1_1" value="<?php echo set_value('loan_officer_name'); ?>">
															<select id="loan_officer_name" name="loan_officer_name" class="form-control">

															<option value="">Choose Loan Officer</option>

														</select>
														<?php } else { ?>

															<input type="hidden" name="abcd" id="loan_officer_name_1" value="<?php echo $ln['loan_officer_id']; ?>">

															<select id="loan_officer_name" name="loan_officer_name" class="form-control">

															<option value="">Choose a Loan Officer</option>

														</select>
														<?php } ?>	

														
															<font color="red"><?=form_error("loan_officer_name");?></font>						

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Beneficary Person</label>

														<?php if($this->input->post('submit') && $this->input->post('beneficary') !== $ln['loan_beneficary']) {?>
															<select id="beneficary" name="beneficary" class="form-control">

															<option value="">Choose Beneficary Person</option>

																<?php foreach($loan_ben as $controller):?>
																	<option value="<?php echo $controller['user_id'];?>" <?php echo (set_value('beneficary')== $controller['user_id'])?" selected=' selected'":""?>><?php echo $controller['username'];?></option>
	    														<?php endforeach; ?>

															</select>	
														<?php } else { ?>

														<select id="beneficary" name="beneficary" class="form-control">	

															<option value=" ">Choose Beneficary Person</option>

																<?php foreach($loan_ben as $controller):?>
																	<option value="<?php echo $controller['user_id'];?>" <?php if($controller['user_id'] == $ln['loan_beneficary']){ echo 'Selected';}?>><?php echo $controller['username'];?></option>
	    														<?php endforeach; ?>

															</select>		
														<?php } ?>	

															<font color="red"><?=form_error("beneficary");?></font>
													</div>



												</div>	

											</div>		



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Loan Amount</label>

														<?php if($this->input->post('submit') && $this->input->post('loan_amount') !== $ln['loan_amount']) { ?>
															<input onchange="checkinterest();" type="text" id="loan_amount" name="loan_amount" class="form-control" placeholder="Enter Loan Amount" value="<?php echo set_value('loan_amount'); ?>" readonly>	
														<?php } else { ?>
															<input onchange="checkinterest();" type="text" id="loan_amount" name="loan_amount" class="form-control" placeholder="Enter Loan Amount" value="<?php echo $ln['loan_amount']; ?>" readonly>	
														<?php } ?>	

																			
														<font color="red" id="errors"><?=form_error("loan_amount");?></font>
													</div>



														<div class="col-lg-4 col-md-12">



															<label>Loan Tenure Start Date</label>


															<?php if($this->input->post('submit') && $this->input->post('start_date') !== $ln['start_date']) { ?>
																<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" autocomplete="off" placeholder="Loan Tenure Start Date" type="text" name="start_date" value="<?php echo set_value('start_date'); ?>" onchange="checkinterest();" readonly>



																			</div>



																		</div>
														<?php } else { ?>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input  onchange="checkinterest();"  class="form-control" autocomplete="off" placeholder="Loan Tenure Start Date" type="text" name="start_date" value="<?php echo date("d-m-Y", strtotime($ln['start_date'])); ?>" readonly>



																			</div>



																		</div>
														<?php } ?>	
																																	

																<font color="red" id="errors1"><?=form_error("start_date");?></font>
														</div>



														<div class="col-lg-4 col-md-12">



															<label>Loan Tenure End Date</label>


															<?php if($this->input->post('submit') && $this->input->post('end_date') !== $ln['end_date']) { ?>

																<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" autocomplete="off" name="end_date" placeholder="Loan Tenure End Date" type="text" value="<?php echo set_value('end_date'); ?>" onchange="checkinterest();" readonly>



																			</div>



																		</div>		
														<?php } else { ?>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input  onchange="checkinterest();"  class="form-control" autocomplete="off" name="end_date" placeholder="Loan Tenure End Date" type="text" value="<?php echo date("d-m-Y", strtotime($ln['end_date'])); ?>" readonly>



																			</div>



																		</div>		
														<?php } ?>	
																																	

																		<font color="red" id="errors2"><?=form_error("end_date");?></font>
														</div>

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-2 col-md-12">



														<label>Interest Type</label>

														<input type="hidden" name="interest_type" value="<?php echo $ln['interest_type'];?>">

														<?php if($this->input->post('submit') && $this->input->post('interest_type') !== $ln['interest_type']) { ?>
															<label class="custom-control custom-radio">



																<input onchange="checkinterest();" type="radio" class="custom-control-input" name="interest_type" value="Simple Interest" id="interest_type" checked <?php echo (set_value('interest_type')== "Simple Interest")?" Checked=' Checked'":""?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('interest_type');?>" disabled>Simple Interest</span>



															</label>



															<label class="custom-control custom-radio">



																<input onchange="checkinterest();" type="radio" class="custom-control-input" name="interest_type" value="Compound Interest" id="interest_type" <?php echo (set_value('interest_type')== "Compound Interest")?" Checked=' Checked'":""?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('interest_type');?>" disabled>Compound Interest</span>



															</label>
														<?php } else { ?>
															<label class="custom-control custom-radio">



																<input onchange="checkinterest();"  type="radio" class="custom-control-input" name="interest_type" value="Simple Interest" id="interest_type" <?php if($ln['interest_type'] == 'Simple Interest') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($ln['interest_type'] == 'Simple Interest') { echo "Checked"; }?>" disabled>Simple Interest</span>



															</label>



															<label class="custom-control custom-radio">



																<input onchange="checkinterest();"  type="radio" class="custom-control-input" name="interest_type" value="Compound Interest" id="interest_type" <?php if($ln['interest_type'] == 'Compound Interest') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($ln['interest_type'] == 'Compound Interest') { echo "Checked"; }?>" disabled>Compound Interest</span>



															</label>
														<?php } ?>	


															
				
															<font color="red" id="errors3"><?=form_error("interest_type");?></font>
													</div>



														<div class="col-lg-2 col-md-12">



															<label>Installment Interest</label>

															<?php if($this->input->post('submit') && $this->input->post('installment_interest') !== $ln['installment_interest']) { ?>
																<input  onchange="checkinterest();"  type="text" name="installment_interest" id="installment_interest" class="form-control" placeholder="Insatllemt Interest(%)" value="<?php echo set_value('installment_interest'); ?>" readonly>
														<?php } else { ?>
															<input  onchange="checkinterest();"  type="text" name="installment_interest" id="installment_interest" class="form-control" placeholder="Insatllemt Interest(%)" value="<?php echo $ln['installment_interest']; ?>" readonly>
														<?php } ?>	

															
															<font color="red" id="errors4"><?=form_error("installment_interest");?></font>	
													
														</div>



														<div class="col-lg-4 col-md-12">



															<label>Installment Amount</label>																						
															<?php if($this->input->post('submit') && $this->input->post('installment_amount') !== $ln['installment_amount']) { ?>
																<input type="text" name="installment_amount" id="installment_amount" class="form-control" placeholder="Installment Amount" readonly value="<?php echo $set_value('installment_amount'); ?>">	
														<?php } else { ?>
															<input type="text" name="installment_amount" id="installment_amount" class="form-control" placeholder="Installment Amount" readonly value="<?php echo $ln['installment_amount']; ?>">	
														<?php } ?>	

															
															<font color="red" id="errors5"><?=form_error("installment_amount");?></font>									
														</div>


														<div class="col-lg-4 col-md-12">



															<label>Total Loan Amount</label>													
															<?php if($this->input->post('submit') && $this->input->post('total_loan_amount') !== $ln['total_loan_amount']) { ?>
																<input type="text" name="total_loan_amount" id="total_loan_amount" class="form-control" placeholder="Total Loan Amount" readonly value="<?php echo set_value('total_loan_amount'); ?>">	
														<?php } else { ?>
															<input type="text" name="total_loan_amount" id="total_loan_amount" class="form-control" placeholder="Total Loan Amount" readonly value="<?php echo $ln['total_loan_amount']; ?>">	
														<?php } ?>										

															
															<font color="red" id="errors6"><?=form_error("total_loan_amount");?></font>		

															<input type="hidden" name="total_no_installments" id="total_no_installments" value="<?php echo set_value('total_no_installments'); ?>">

														</div>
													

												</div>

											</div>	


											<div class="form-group">



												<div class="row">


														<div class="col-lg-6 col-md-12">



															<label>Payment Date</label>		
															<?php if($this->input->post('submit') && $this->input->post('payment_date') !== $ln['payment_date']) { ?>
																<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="date" autocomplete="off" placeholder="Payment Day" type="text" name="payment_date" value="<?php echo set_value('payment_date');?>">


																			</div>



																		</div>
														<?php } else { ?>
															<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="date" autocomplete="off" placeholder="Payment Day" type="text" name="payment_date" value="<?php echo $ln['payment_date'];?>">


																			</div>



																		</div>
														<?php } ?>	

															
																		<font color="red"><?=form_error("payment_date");?></font>
																	

														</div>

														<div class="col-lg-6 col-md-12">



														<label>Loan Type</label>

														<?php if($this->input->post('submit') && $this->input->post('loan_type') !== $ln['loan_type_id']) { ;?>
																<select class="form-control" id="loan_type" name="loan_type">

																<option value="">Choose Loan Type</option>

																<?php foreach($loan_type as $type):?>
																	<option value="<?php echo $type['loan_type_id'];?>" <?php echo (set_value('loan_type')== $type['loan_type_id'])?" selected=' selected'":""?>><?php echo $type['loan_type'];?></option>
	    														<?php endforeach; ?>

															</select>	
															
															
														<?php } else { ;?>

															<select class="form-control" id="loan_type" name="loan_type">

																<option value="">Choose Loan Type</option>

																<?php foreach($loan_type as $type):?>
																	<option value="<?php echo $type['loan_type_id'];?>" <?php if($type['loan_type_id'] == $ln['loan_type_id']){ echo 'Selected';}?>><?php echo $type['loan_type'];?></option>
	    														<?php endforeach; ?>

															</select>	
														
														<?php } ?>	

															
															<font color="red"><?=form_error("loan_type");?></font>	

																					

													</div>

													

												</div>

											</div>		



											<div class="form-group">



												<div class="row">



														<div class="col-lg-12 col-md-12">



															<label>Loan Remarks</label>

															<?php if($this->input->post('submit') && $this->input->post('remark') !== $ln['loan_remark']) { ?>

																<textarea id="elm1" name="remark"><?php echo set_value('remark'); ?></textarea>

														<?php } else { ?>
															<textarea id="elm1" name="remark"><?php echo $ln['loan_remark']; ?></textarea>
														<?php } ?>	

															
																		

														</div>

												</div>

											</div>

		
											<div class="form-group"  style="float:right;">



												<div class="row">



													<input type="submit" name="submit" value="Submit" id="submit" class="btn btn-app btn-primary mr-2 mt-1 mb-1">


												</div>

											</div>		





												<!--Wizrad Completes Here-->



										</form>

										<?php }?>

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


		<script type="text/javascript">

             function checkinterest()
             {

             	var loan_amount=$('#loan_amount').val();
        	var start_date=document.getElementById('datepicker1').value;
        	var end_date=document.getElementById('datepicker2').value;
        	var interest_type=$('input[name="interest_type"]:checked').val();
        	var installment_interest=document.getElementById('installment_interest').value;
        	var installment_amount=$('#installment_amount').val();
        	var total_loan_amount=$('#total_loan_amount').val();
        	$('#submit').attr("disabled", false);
        	if(loan_amount == "" || start_date == "" || end_date == "" || interest_type == "" || installment_interest == "" || installment_amount == "" || total_loan_amount == "" ){
        		
	        		 var x = document.forms["myForm"]["loan_amount"].value;
	        		  var x1 = document.forms["myForm"]["datepicker1"].value;
	        		  var x2 = document.forms["myForm"]["datepicker2"].value;
	        		   var x4 = document.forms["myForm"]["installment_interest"].value;
	        		    var x5 = document.forms["myForm"]["installment_amount"].value;
	        		    var x6 = document.forms["myForm"]["total_loan_amount"].value;
	        		    var valid = true;
					  if (x == "") {
					  	$('#submit').attr("disabled", true);
					  	document.getElementById("installment_amount").value = parseInt(0);
        				$("#total_loan_amount").val(parseInt(0));
					    document.getElementById("errors").innerHTML=" Loan Amount is Required";
					    valid = false;
					   
					  } /*else{
					  	 document.getElementById("errors").style.display = 'none';
					  }*/
					  if(x1 == ""){
					  	$('#submit').attr("disabled", true);
					  	document.getElementById("installment_amount").value = parseInt(0);
        				$("#total_loan_amount").val(parseInt(0));
					  	 document.getElementById("errors1").innerHTML=" Loan Tenure Start Date is Required";
					  	 valid = false;
					  }
					  /*else{
					  	 document.getElementById("errors1").style.display = 'none';
					  }*/
					 
					  if(x2 == ""){
					  	$('#submit').attr("disabled", true);
					  	document.getElementById("installment_amount").value = parseInt(0);
        				$("#total_loan_amount").val(parseInt(0));
					  	 document.getElementById("errors2").innerHTML=" Loan Tenure End Date is Required";
					  	 valid = false;
					  }
					  /*else{
					  	 document.getElementById("errors2").style.display = 'none';
					  }*/
					
					  if(x4 == "0" || x4==""){
					  	$('#submit').attr("disabled", true);
					  	$("#installment_interest").val(parseInt(0));
					  	document.getElementById("installment_amount").value = parseInt(0);
        				$("#total_loan_amount").val(parseInt(0));
					  	 document.getElementById("errors4").innerHTML=" Installment Interest is Required";
					  	 valid = false;
					  } 
					  
					 /* if(x5 == "0" || x5==""){
					  	 document.getElementById("errors5").innerHTML=" Installment Amount is Required";
					  	 valid = false;
					  }
					  
					  if(x6 == "0" || x6==""){
					  	  document.getElementById("errors6").innerHTML=" Total Loan Amount is Required";
					  	 valid = false;
					  }*/
					  

				
        	}
        	else
        	{
        		  if($("input[type=radio][name=interest_type]").is(":checked")) {

                 	var date1 = document.getElementById('datepicker1').value

                 	t1=date1.split('-');
					var dt_t1=new Date(t1[2],t1[1],t1[0]);
					var dt_t1_tm=dt_t1.getTime(); // time in milliseconds for day 1

					

					var date2 = document.getElementById('datepicker2').value

					t2=date2.split('-');
					var dt_t2=new Date(t2[2],t2[1],t2[0]);
					var dt_t2_tm=dt_t2.getTime(); 

					var mon =  (dt_t2.getFullYear() - dt_t1.getFullYear()) * 12;
					mon += dt_t2.getMonth() - dt_t1.getMonth();


					var year = (dt_t2.getFullYear() - dt_t1.getFullYear()) ;

					
					var one_day = 24*60*60*1000; // hours*minutes*seconds*milliseconds
					var diff_days=Math.abs((dt_t1_tm - dt_t2_tm)/one_day); // difference in days 
					diff_days=Math.floor(diff_days);  // round off the difference in days to lower value

					var loan_amount = document.getElementById('loan_amount').value;
					var interest = document.getElementById('installment_interest').value;


 			 	var element1=$('input[name="interest_type"]:checked').val();

 			 	  if (element1 == 'Simple Interest') {
 
 			 	  		var yr = mon/12;

 			 	  		var rin = interest/100;

 			 	  		var intrest1 = loan_amount*(1 + (rin * yr));

 			 	  		//10000(1 + (0.03875 × 0.416667))

 			 	  		var n = intrest1.toFixed(2);

 			 	  		var onem = n / mon;


 			 	  		var final = onem.toFixed(2);


 			 	  	//var intrest = 
 			 	  	 $("#installment_amount").val(final);
 			 	  	 $("#total_loan_amount").val(n);
 			 	  	 $("#total_no_installments").val(mon);
			    }

			    else{

			    		var x = (1 + (interest/12)/100);

						var intrest1 = loan_amount * (Math.pow(x,mon));

			    		var n = intrest1.toFixed(2);

			    		var onem = n / mon;

			    		var final = onem.toFixed(2);

			    		$("#installment_amount").val(final);
 			 	  	    $("#total_loan_amount").val(n);
 			 	  	    $("#total_no_installments").val(mon);
			    }
      //its checked
  		}
        	}

             	
             		     
             }
          
              

             
    
    </script>	


		<script type="text/javascript">
        $(document).ready(function(){

        		setTimeout(function() {
        				scall($('#loan_officer_name_1_1').val());
        		},200);

                     function scall(eid)
                     {
                     	 var id = $('#loan_wih_bank').val();
                	
                if(eid == '' ||eid == null)
                {
                	var loanofficer = $('#loan_officer_name_1').val();
                }
                else
                {
                	var loanofficer = eid;
                }
                $.ajax({
                    url : "<?php echo site_url('Loan/get_loan_officer');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;

                        $('#loan_officer_name').find('option').not(':first').remove();

                        for(i=0; i<data.length; i++){

                        	if(data[i].loan_officer_id  === loanofficer)
								{
								$('#loan_officer_name').append( '<option value='+data[i].loan_officer_id+' selected>'+data[i].loan_officer_name+'</option>');
								}
								else
								{
								$('#loan_officer_name').append( '<option value='+data[i].loan_officer_id+'>'+data[i].loan_officer_name+'</option>');
								}
								//$('#loan_officer_name_1_1').val(data[i].loan_officer_id);

                        }
                        //$('#loan_officer_name').html(html);
 
                    }
                });
                return false;
                     }
                 


               
            }); 
            
    </script>

		<script type="text/javascript">
 
            $('#loan_wih_bank').change(function(){
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('Loan/get_loan_officer');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;

                        $('#loan_officer_name').find('option').not(':first').remove();

                        for(i=0; i<data.length; i++){
                           $('#loan_officer_name').append( '<option value='+data[i].loan_officer_id+'>'+data[i].loan_officer_name+'</option>');
                           $('#loan_officer_name_1_1').val(data[i].loan_officer_id);
                        }
                        //$('#loan_officer_name').html(html);
 
                    }
                });
                return false;
            }); 


	</script>


	
	</body>



</html>