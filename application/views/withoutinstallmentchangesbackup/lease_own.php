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

      		<style type="text/css">
  			
  			#date {
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



								<li class="breadcrumb-item active" aria-current="page">Add Rent Payable</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Rent Payable List",$r)) { ?>

									<a href="<?php echo site_url('Lease/lease_own_report/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>

											View Rent Payable Details

										</span>

									</a>

								  <?php } ?>

								</div>

							</div>

						</div>



						<!-- End page-header -->



						<?php if($this->session->flashdata('add_lease_own')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('add_lease_own'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('check_lease_own_inserted')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('check_lease_own_inserted'); ?>
                                </div>
      							
    						<?php endif;?> 



						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Rent Payable Details</h3>



									</div>



									<div class="card-body">



										 <?php echo form_open_multipart('Lease/lease_own_redirect',array("method"=>"POST")); ?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-6 col-md-12">



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


													<div class="col-lg-6 col-md-12">

														<label>Lessor Name</label>


	
														<select id="lessor_name[]" name="lessor_name[]" class="form-control" multiple>
															<!--<option value="">Choose Lessor</option>-->
	 
															<?php foreach($lessor as $b):?>
																<option value="<?php echo $b['user_id'];?>" <?php echo  set_select('lessor_name[]', $b['user_id']); ?>><?php echo $b['username'];?></option>
	    													<?php endforeach; ?>

															</select>
															<span style="color:red;">Note : Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</span>
															<font color="red"><?=form_error("lessor_name[]");?></font>

																					

													</div>

													

												</div>	

											</div>	


											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>Lease Tenure Start Date</label>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker0" autocomplete="off" placeholder="Start Date" type="text" value="<?php echo set_value('start_date');?>" name="start_date">



																			</div>



																		</div>
																		<font color="red"><?=form_error("start_date");?></font>


																					

													</div>



														<div class="col-lg-3 col-md-12">



															<label>Lease Tenure End Date</label>



																																	

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Due Date" type="text" name="end_date" value="<?php echo set_value('end_date');?>">



																			</div>



																		</div>
																		<font color="red"><?=form_error("end_date");?></font>
																					

														</div>

														<div class="col-lg-2 col-md-12">



															<label>Lease Payment Type</label>
		

															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="payment_type" value="Monthly" checked <?php echo (set_value('payment_type')== "Monthly")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('payment_type');?>">Monthly</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="payment_type" value="Yearly" <?php echo (set_value('payment_type')== "Yearly")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('payment_type');?>">Yearly</span>



															</label>

															<font color="red"><?=form_error("payment_type");?></font>				

																					

														</div>




														<div class="col-lg-4 col-md-12">



															<label>Payment Date</label>																						

															
															<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>

																				<select name="payment_date1" class="form-control"  id="date">
																					<option value="">Choose Payment Day</option>
																					<?php
																					$month = date('m');

																					if($month == 02){

																						for ($i=1; $i<=28; $i++)
																						    {
																						    	$numlength = strlen((string)$i);
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('payment_date1') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					}
																					else if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){

																						  for ($i=1; $i<=31; $i++)
																						    {
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('payment_date1') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					} 
																				    else if($month == 4 || $month == 6 || $month == 9 || $month == 11){

																						 for ($i=1; $i<=30; $i++)
																						    {
 

																						    	
																						        ?>
																						            <option value="<?php echo $i; ?>"  <?php echo (set_value('payment_date1') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					} 
																					?>
																				</select>	


																				
																				<input class="form-control" id="datepicker2" autocomplete="off" placeholder="Payment Date" type="text" name="payment_date" value="<?php echo set_value('payment_date');?>" style="display: none;">


																			</div>



																		</div>
																		<font color="red"><?=form_error("payment_date1");?></font>
																		<font color="red"><?=form_error("payment_date");?></font>
																							

														</div>

													</div>

												</div>

												<div class="form-group">

													<div class="row">		



														<div class="col-lg-3 col-md-12">



															<label>Lease Amount</label>



																																	

																		<input type="text" id="lease_amount" name="lease_amount" class="form-control" placeholder="Enter Lease Amount" value="<?php echo set_value('lease_amount');?>">
																		<font color="red"><?=form_error("lease_amount");?></font>
																					

														</div>



														<div class="col-lg-2 col-md-12">



															<label>Lease Increment Type</label>


															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Percentage" checked <?php echo (set_value('increment_type')== "Percentage")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('increment_type');?>">Percentage</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Rupees" <?php echo (set_value('increment_type')== "Rupees")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('increment_type');?>">Rupees</span>



															</label>

															<font color="red"><?=form_error("increment_type");?></font>				

																					

														</div>



														<div class="col-lg-3 col-md-12">



															<label>Lease Increment</label>



																																	

																		<input type="text" id="lease_increment" name="lease_increment" class="form-control" placeholder="Lease Increment" value="<?php echo set_value('lease_increment');?>">

																					
																		<font color="red"><?=form_error("lease_increment");?></font>
														</div>



														<div class="col-lg-4 col-md-12">



															<label>Enter Number of Month for Lease Increment</label>



																																	

																		<input type="text" id="month_lease_increment" name="month_lease_increment" class="form-control" placeholder="Lease Month" value="<?php echo set_value('month_lease_increment');?>">
																		<font color="red"><?=form_error("month_lease_increment");?></font>
																					

														</div>



														

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



															<label>Area Taken on Lease</label>



																																	

																		<input type="text" id="lease_area" name="lease_area" class="form-control" placeholder="Lease Area" value="<?php echo set_value('lease_area');?>" readonly>

																			<font color="red"><?=form_error("lease_area");?></font>		

														</div>


														<div class="col-lg-2 col-md-12">



															<label>Unit</label>



																																	

																		<input type="text" id="unit" name="unit" class="form-control" placeholder="Property Unit" value="<?php echo set_value('unit');?>" readonly>

																		<font color="red"><?=form_error("unit");?></font>


														</div>




													



														<div class="col-lg-4 col-md-12">



															<label>Lease Security Deposit</label>



																																	

															<input type="text" id="lease_security_deposit" name="lease_security_deposit" class="form-control" placeholder="Enter Lease Security Deposit" value="<?php echo set_value('lease_security_deposit');?>">
															<font color="red"><?=form_error("lease_security_deposit");?></font>
																					

														</div>



														<div class="col-lg-3 col-md-12">



															<label>Lease Contract Status</label>
																	

															<select id="lease_contract_status" name="lease_contract_status" class="form-control">

																<option value="">Lease Contract Status</option>

																<?php foreach($contract_status as $status):?>

																	<option value="<?php echo $status['lease_own_status_id'];?>" <?php echo (set_value('lease_contract_status')== $status['lease_own_status_id'])?" selected=' selected'":""?>><?php echo $status['lease_own_status'];?></option>

														
															<?php endforeach;?>

															</select>

																<font color="red"><?=form_error("lease_contract_status");?></font>					

														</div>

													

												</div>

											</div>



											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>Lease Contract Upload</label>



																																	

															<input type="file" class="dropify" name="lease_contract_upload" id="lease_contract_upload" class="dropify" value="<?php echo set_value('lease_contract_upload');?>">

															<font color="red"><?php $new_in = $this->session->flashdata('new_in');
 															if($new_in==2) { echo "Upload Contract in Zip/JPEG/JPG/PNG/PDF/RAR Format Only.<br/> Rent Payable Document size should not be exceed more than 20mb"; } ?></font>
 															<?php if(empty($this->input->post(('lease_contract_upload')))){?>		
																<font color="red"><?=form_error("lease_contract_upload");?></font>
															<?php } ?>	
													</div>

												</div>

											</div>			



											<div class="form-group">

												

												<div class="row">			



														<div class="col-lg-6 col-md-12">



															<label>Lease Terms</label>



																																	

															<textarea id="elm1" name="lease_terms"><?php echo set_value('lease_terms');?></textarea>
															<font color="red"><?=form_error("lease_terms");?></font>
																					

														</div>

														<div class="col-lg-6 col-md-12">



															<label>Lease Remark</label>



																																	

															<textarea id="elm1" name="lease_remark"><?php echo set_value('lease_remark');?></textarea>

																					

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


    <script type="text/javascript">
    	 $(document).ready(function() {

    	 	var element=document.getElementById('date');
    	 	var element1=document.getElementById('datepicker2');

	            $('input[type=radio][name=payment_type]').change(function() {

		            if (this.value == 'Monthly') {

				         element1.style.display='none';
				         element.style.display='block';
				         element1.val('');
				    }

				    else{

				        element.style.display='none';
				        element1.style.display='block';
				        element.val('');
				    }
	            });
	    })        	
    </script>

        <script type="text/javascript">
    	 $(document).ready(function() {

    	 	if($("input[type=radio][name=payment_type]").is(":checked")) {
    	 		var element=document.getElementById('date');
    	 		var element1=document.getElementById('datepicker2');

    	 		var element2=$('input[name="payment_type"]:checked').val();

    	 		if (element2 == 'Monthly') {
    	 				 element.style.display='block';	
				         element1.style.display='none';
				    }

				    else{

				        element.style.display='none';
				        element1.style.display='block';
				    }
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


    <script type="text/javascript">
			 $(document).ready(function(){
 
            $('#property_name').change(function(){
                var id=$(this).val();
                 $.ajax({
                    url : "<?php echo site_url('Lease/get_lease_area');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;

                        $('#lease_area').find('option').not(':first').remove();

                        for(i=0; i<data.length; i++){
                           $('#lease_area').val(data[i].property_unit);
                           $('#unit').val(data[i].unit);
                        }
 
                    }
                });
                return false;
            });
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