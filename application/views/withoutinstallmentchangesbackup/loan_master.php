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


		<!-- File Uploads css-->

        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />

    		<style type="text/css">
  			
  			#payment_day {
			  /* for Firefox */
			  -moz-appearance: none;
			  /* for Chrome */
			  -webkit-appearance: none;
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



								<li class="breadcrumb-item active" aria-current="page">Add Loan</li>



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



							<?php if($this->session->flashdata('insert_loan')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insert_loan'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('check_loan_inserted')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('check_loan_inserted'); ?>
                                </div>
      							
    						<?php endif;?> 



						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Loan Details</h3>



									</div>



									<div class="card-body">



										 <?php echo form_open_multipart('Loan/loan_master_insert',array("method"=>"POST")); ?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">
														
														<?php $access = explode(",",$prop_access);?>


														<label>Property Name</label>



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



														<label>Loan With Bank</label>



														<select id="loan_wih_bank" name="loan_wih_bank" class="form-control">

															<option value="">Choose Loan With Bank</option>

															<?php foreach($bank as $bank):?>
	    													<option value="<?php echo $bank['bank_id'];?>" <?php echo (set_value('loan_wih_bank')== $bank['bank_id'])?" selected=' selected'":""?>><?php echo $bank['bank_name'];?></option>
	    													<?php endforeach; ?>

														</select>
														<font color="red"><?=form_error("loan_wih_bank");?></font>
																					

													</div>

											

													<div class="col-lg-3 col-md-12">



														<label>Loan Officer Name</label>


															<input type="hidden" name="abcd1" id="loan_officer_name_1_1" value="<?php echo set_value('loan_officer_name'); ?>">
														<select id="loan_officer_name" name="loan_officer_name" class="form-control">
														
															<option value="">Choose Loan Officer</option>

														</select>
														<font color="red"><?=form_error("loan_officer_name");?></font>
																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Beneficary Person</label>



														<select id="beneficary" name="beneficary" class="form-control">	

															<option value="">Choose Beneficary Person</option>

																<?php foreach($loan_ben as $controller):?>
																	<option value="<?php echo $controller['user_id'];?>" <?php echo (set_value('beneficary')== $controller['user_id'])?" selected=' selected'":""?>><?php echo $controller['username'];?></option>
	    														<?php endforeach; ?>

															</select>	
															<font color="red"><?=form_error("beneficary");?></font>		

													</div>



												</div>	

											</div>		



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Loan Amount</label>



														<input type="text" id="loan_amount" name="loan_amount" class="form-control" placeholder="Enter Loan Amount" value="<?php echo set_value('loan_amount'); ?>">

														<font color="red"><?=form_error("loan_amount");?></font>							

													</div>



														<div class="col-lg-4 col-md-12">



															<label>Loan Tenure Start Date</label>



																																	

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker0" autocomplete="off" placeholder="Loan Tenure Start Date" type="text" name="start_date" value="<?php echo set_value('start_date'); ?>">



																			</div>



																		</div>

																	<font color="red"><?=form_error("start_date");?></font>				

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Loan Tenure End Date</label>



																																	

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" name="end_date" placeholder="Loan Tenure End Date" type="text" value="<?php echo set_value('end_date'); ?>">



																			</div>



																		</div>

																	<font color="red"><?=form_error("end_date");?></font>				

														</div>

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-2 col-md-12">



														<label>Interest Type</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="interest_type" value="Simple Interest" id="interest_type" checked <?php echo (set_value('interest_type')== "Simple Interest")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('interest_type');?>">Simple Interest</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="interest_type" value="Compound Interest" id="interest_type" <?php echo (set_value('interest_type')== "Compound Interest")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('interest_type');?>">Compound Interest</span>



															</label>

																<font color="red"><?=form_error("interest_type");?></font>					

													</div>



														<div class="col-lg-2 col-md-12">



															<label>Installment Interest</label>

															<input type="text" name="installment_interest" id="installment_interest" class="form-control" placeholder="Insatllemt Interest(%)" value="<?php echo set_value('installment_interest'); ?>">	
															<font color="red"><?=form_error("installment_interest");?></font>
																																					

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Installment Amount</label>																						

															<input type="text" name="installment_amount" id="installment_amount" class="form-control" placeholder="Installment Amount" readonly value="<?php echo set_value('installment_amount'); ?>">																							
															<font color="red"><?=form_error("installment_amount");?></font>
														</div>


														<div class="col-lg-4 col-md-12">



															<label>Total Loan Amount</label>																						

															<input type="text" name="total_loan_amount" id="total_loan_amount" class="form-control" placeholder="Total Loan Amount" readonly value="<?php echo set_value('total_loan_amount'); ?>">																							
															<font color="red"><?=form_error("total_loan_amount");?></font>

															<input type="hidden" name="total_no_installments" id="total_no_installments" value="<?php echo set_value('total_no_installments'); ?>">
														</div>
													

												</div>

											</div>	


											<div class="form-group">



												<div class="row">


														<div class="col-lg-6 col-md-12">



															<label>Payment Day</label>		

															<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>

																				<select name="payment_date" class="form-control"  id="payment_day">
																					<option value="">Choose Payment Day</option>
																					<?php
																					$month = date('m');

																					if($month == 02){

																						for ($i=1; $i<=28; $i++)
																						    {
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('payment_date') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					}
																					else if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){

																						  for ($i=1; $i<=31; $i++)
																						    {
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('payment_date') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					} 
																				    else if($month == 4 || $month == 6 || $month == 9 || $month == 11){

																						 for ($i=1; $i<=30; $i++)
																						    {
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('payment_date') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					} 
																					?>
																				</select>	


																			</div>



																		</div>

																		<font color="red"><?=form_error("payment_date");?></font>																				


														</div>



														<div class="col-lg-6 col-md-12">



														<label>Loan Type</label>



															<select class="form-control" id="loan_type" name="loan_type">

																<option value="">Choose Loan Type</option>

																<?php foreach($loan_type as $type):?>
																	<option value="<?php echo $type['loan_type_id'];?>" <?php echo (set_value('loan_type')== $type['loan_type_id'])?" selected=' selected'":""?>><?php echo $type['loan_type'];?></option>
	    														<?php endforeach; ?>

															</select>	
															<font color="red"><?=form_error("loan_type");?></font>	

																					

													</div>

													

												</div>

											</div>	

											<div class="form-group">
												<div class="row">
													<div class="col-lg-3 col-md-12">
														<label>Lean Mark</label>



														<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="Yes" <?php echo (set_value('lean_mark')== "Yes")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('lean_mark');?>">Yes</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="lean_mark" value="No"  <?php echo (set_value('lean_mark')== "No")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value="<?php echo set_value('lean_mark');?>">No</span>



															</label>

															<font color="red"><?=form_error("lean_mark");?></font>

															<br/>

															<div class="form-group" style="display: none;" id="lean_div">

																<label>Lean Mark Property</label>
															<select id="lean_property_name" name="lean_property_name" class="form-control">
														<option value="">Choose Property</option>

															<?php foreach($lean_property as $prop):
																$property_id[] = $prop['property_id'];	
																$common_access = array_intersect($access,$property_id);
																?>
																<?php foreach($access as $acc){if($acc == $prop['property_id']) { ?>
	    															<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('lean_property_name')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    														<?php }} ?>	
	    													<?php endforeach; ?>

														</select>
														<font color="red"><?=form_error("lean_property_name");?></font>	
													</div></div>
													<div class="col-lg-9 col-md-12">
															<label>Loan Document Upload</label>

															<input type="file" class="dropify" name="loan_document" id="loan_document" class="dropify" value="<?php echo set_value('loan_document');?>">
														<font color="red">
																<?php $new_in = $this->session->flashdata('new_in');
															if($new_in==2) { echo "Upload Loan Document in zip/pdf/jpeg/jpg/png/RAR Format Only.<br/>Size should not be exceed more than 20mb"; } ?></font>
															<font color="red"><?=form_error("loan_document");?></font>	
													</div>	
												</div>
											</div>		



														<div class="form-group">
															<div class="row">
																<div class="col-lg-12 col-md-12">

																<label>Loan Remarks</label>
															<!-- For Remark use str replace for 's problem-->

															<textarea id="elm1" name="remark"><?php echo set_value('remark'); ?></textarea>

																	<font color="red"><?=form_error("remark");?></font>																				
																</div>
															</div>
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

		<!-- File uploads js -->

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>


		<!--ckeditor js-->



		<script src="<?=base_url();?>assets/plugins/tinymce/tinymce.min.js"></script>



		<script src="<?=base_url();?>assets/js/formeditor.js"></script>









		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>


		<script type="text/javascript">
        $(document).ready(function(){
 
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

              $('#installment_interest').change(function(){
                 if($("input[type=radio][name=interest_type]").is(":checked")) {

                 	var date1 = document.getElementById('datepicker0').value

                 	t1=date1.split('-');
					var dt_t1=new Date(t1[2],t1[1],t1[0]);
					var dt_t1_tm=dt_t1.getTime(); // time in milliseconds for day 1

					

					var date2 = document.getElementById('datepicker1').value

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
              
            }); 
             
        });
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
                	var loanofficer = $('#loan_officer_name_1_1').val();
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

                        	if(loanofficer == data[i].loan_officer_id)
								{
								$('#loan_officer_name').append( '<option value='+data[i].loan_officer_id+' selected>'+data[i].loan_officer_name+'</option>');
								$('#loan_officer_name_1_1').val(data[i].loan_officer_id);
								}
								else
								{
								$('#loan_officer_name').append( '<option value='+data[i].loan_officer_id+'>'+data[i].loan_officer_name+'</option>');
								$('#loan_officer_name_1_1').val(data[i].loan_officer_id);
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

    
    <script>
  $("#datepicker1").change(function() {
    var startDate = document.getElementById("datepicker0").value;
    var endDate = document.getElementById("datepicker1").value;

    ndate = startDate.split("-").reverse().join("-");
    ndate1 = endDate.split("-").reverse().join("-");

    if ((Date.parse(ndate1) <= Date.parse(ndate))) {
      alert("End date should be greater than Start date");
      document.getElementById("datepicker1").value = "";
    }
  });
</script>

    <script>
  $("#datepicker0").change(function() {
    var startDate = document.getElementById("datepicker0").value;
    var endDate = document.getElementById("datepicker1").value;

    ndate = startDate.split("-").reverse().join("-");
    ndate1 = endDate.split("-").reverse().join("-");

    if(startDate != '' && endDate != ''){

    	 if ((Date.parse(ndate) >= Date.parse(ndate1))) {
	      alert("Start date should be Lesser than End date");
	      document.getElementById("datepicker0").value = "";
	      document.getElementById("datepicker1").value = "";
    	}

    }

   
  });
</script>


	</body>



</html>