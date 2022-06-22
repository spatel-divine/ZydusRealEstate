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



								<li class="breadcrumb-item active" aria-current="page">Edit Rent Receivable</li>



							</ol><!-- End breadcrumb -->



						</div>



						<!-- End page-header -->







						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Edit Rent Receivable Details</h3>



									</div>



									<div class="card-body">



										 <?php 

										 
										 foreach($lease_given as $lease){

										 	echo form_open_multipart('Lease/edit_lease_given_detail_redirect/'.base64_encode($lease['lease_given_id']),array("method"=>"POST"));

										  ?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-5 col-md-12">



														<label>Property Name</label>



														<?php if($this->input->post('submit') && $this->input->post('property_name') !== $lease['property_id']) { ?>
															<select id="property_name" name="property_name" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_name')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    													<?php endforeach; ?>

															</select>
														<?php } else{?>
															<select id="property_name" name="property_name" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):?>
	    													<option value="<?php echo $prop['property_id'];?>" <?php if($prop['property_id'] == $lease['property_id']){ echo 'Selected';}?>><?php echo $prop['property_name'];?></option>
	    											<?php endforeach; ?>

														</select>

														<?php } ?>	

														<font color="red"><?=form_error("property_name");?></font>
																					

													</div>



													<div class="col-lg-5 col-md-12">

														<?php $one = 0;  foreach($lessee1 as $les){?>

															<div class="form-group removethis3">
																<div class="row">


																	<label>Lessee Name</label>



																	<select id="lessee_name[<?= $one ?>]" name="lessee_name[<?= $one ?>]" class="form-control">

																		<option value="">Choose Lessee</option>

																		<?php foreach($lesse as $b):?>
																			<option value="<?php echo $b['user_id'];?>" <?php if ($les['lessee_id']== $b['user_id']) { echo 'Selected';}?>><?php echo $b['username'];?></option>
				    													<?php endforeach; ?>

																	</select>
																</div>			
															</div>
															<?php $one++; } ?>

															<font color="red"><?=form_error("lessee_name[0]");?></font>
													</div>



													<div class="col-lg-2 col-md-12" style="margin-top: 23px;">



														<input type="button" class="btn btn-primary" id="adddoc1" value="Add" onclick='show_lessee(this.value);'></button>

												        <input type="button" class="btn btn-primary" id="removedoc1" value="Remove"></button>			

													</div>



													

												</div>	

											</div>	



											<div id="documentadd1" style="display: none;"></div> 	



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">

														<?php if($this->input->post('submit') && $this->input->post('start_date') !== $lease['start_date']) { ?>
															<label>Lease Tenure Payment Start Date</label>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker0" autocomplete="off" placeholder="Start Date" type="text" value="<?php echo set_value('start_date');?>" name="start_date">



																			</div>



																		</div>
													<?php } else {?>
														<label>Lease Tenure Payment Start Date</label>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker0" autocomplete="off" placeholder="Start Date" type="text" value="<?php echo date('d-m-Y', strtotime($lease['start_date']));?>" name="start_date">



																			</div>



																		</div>
													<?php } ?>		

														
																		<font color="red"><?=form_error("start_date");?></font>


																					

													</div>



														<div class="col-lg-4 col-md-12">



															<label>Lease Tenure Payment End Date</label>

																<?php if($this->input->post('submit') && $this->input->post('end_date') !== $lease['end_date']) { ?>

																	<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Due Date" type="text" name="end_date" value="<?php echo set_value('end_date');?>">



																			</div>



																		</div>

																<?php } else{?>

																	<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Due Date" type="text" name="end_date" value="<?php echo date('d-m-Y', strtotime($lease['end_date']));?>">



																			</div>



																		</div>

																<?php }?>																	

																		
																		<font color="red"><?=form_error("end_date");?></font>
																					

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Payment Date</label>																						
															<?php if($this->input->post('submit') && $this->input->post('payment_date') !== $lease['payment_date']) { ?>

																<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="date" autocomplete="off" placeholder="Payment Day" type="text" name="payment_date" value="<?php echo set_value('payment_date');?>">


																			</div>



																		</div>

																<?php } else{?>
																	<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="date" autocomplete="off" placeholder="Payment Day" type="text" name="payment_date" value="<?php echo $lease['payment_date'];?>">


																			</div>



																		</div>

																<?php }?>		
															
															
																		<font color="red"><?=form_error("payment_date");?></font>
																							

														</div>

													</div>

												</div>

												<div class="form-group">

													<div class="row">		



														<div class="col-lg-3 col-md-12">



															<label>Lease Amount</label>


																	<?php if($this->input->post('submit') && $this->input->post('lease_amount') !== $lease['lease_amount']) { ?>

																		<input type="text" id="lease_amount" name="lease_amount" class="form-control" placeholder="Enter Lease Amount" value="<?php echo set_value('lease_amount');?>">

																<?php } else{?>

																		<input type="text" id="lease_amount" name="lease_amount" class="form-control" placeholder="Enter Lease Amount" value="<?php echo $lease['lease_amount'];?>">

																<?php }?>		
																																	

																	
																		<font color="red"><?=form_error("lease_amount");?></font>
																					

														</div>



														<div class="col-lg-2 col-md-12">



															<label>Lease Increment Type</label>



																																	
															<?php if($this->input->post('submit') && $this->input->post('increment_type') !== $lease['lease_increment_type']) { ?>

																<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Percentage" checked <?php echo (set_value('increment_type')== "Percentage")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('increment_type');?>">Percentage</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Rupees" <?php echo (set_value('increment_type')== "Rupees")?" Checked=' Checked'":""?>>



																<span class="custom-control-label" style="color:black;" value=" <?php echo set_value('increment_type');?>">Rupees</span>



															</label>

																<?php } else{?>
																	<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Percentage" <?php if($lease['lease_increment_type'] == 'Percentage') { echo "Checked"; }?>>



																<span class="custom-control-label" style="color:black;" value="<?php if($lease['lease_increment_type'] == 'Percentage') { echo "Checked"; }?>">Percentage</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Rupees" <?php if($lease['lease_increment_type'] == 'Rupees') { echo "Checked"; }?>>



																<span class="custom-control-label" style="color:black;" value="<?php if($lease['lease_increment_type'] == 'Rupees') { echo "Checked"; }?>">Rupees</span>



															</label>

																<?php }?>		
																		

															
															<font color="red"><?=form_error("increment_type");?></font>				

																					

														</div>



														<div class="col-lg-3 col-md-12">



															<label>Lease Increment</label>


															<?php if($this->input->post('submit') && $this->input->post('lease_increment') !== $lease['lease_increment']) { ?>

																	<input type="text" id="lease_increment" name="lease_increment" class="form-control" placeholder="Lease Increment" value="<?php echo set_value('lease_increment');?>">

																<?php } else{?>

																		<input type="text" id="lease_increment" name="lease_increment" class="form-control" placeholder="Lease Increment" value="<?php echo $lease['lease_increment'];?>">
																<?php }?>		
																																

																					
																		<font color="red"><?=form_error("lease_increment");?></font>
														</div>



														<div class="col-lg-4 col-md-12">



															<label>Enter Number of Month for Lease Increment</label>


																	<?php if($this->input->post('submit') && $this->input->post('month_lease_increment') !== $lease['lease_increment_month']) { ?>

																		<input type="text" id="month_lease_increment" name="month_lease_increment" class="form-control" placeholder="Lease Month" value="<?php echo set_value('month_lease_increment');?>">

																<?php } else{?>
																	<input type="text" id="month_lease_increment" name="month_lease_increment" class="form-control" placeholder="Lease Month" value="<?php echo $lease['lease_increment_month'];?>">
																<?php }?>		
																																	

																		
																		<font color="red"><?=form_error("month_lease_increment");?></font>
																					

														</div>



														

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-2 col-md-12">



															<label>Area Given on Lease</label>


																	<?php if($this->input->post('submit') && $this->input->post('lease_area') !== $lease['area_given_on_lease']) { ?>
																		<input type="text" id="lease_area" name="lease_area" class="form-control" placeholder="Lease Area" value="<?php echo set_value('lease_area');?>">
																<?php } else{?>

																		
																		<input type="text" id="lease_area" name="lease_area" class="form-control" placeholder="Lease Area" value="<?php echo $lease['area_given_on_lease'];?>">
																<?php }?>			
																																	


																			<font color="red"><?=form_error("lease_area");?></font>		

														</div>

														<div class="col-lg-2 col-md-12">



															<label>Unit</label>


																	<?php if($this->input->post('submit') && $this->input->post('unit') !== $lease['unit']) { ?>
																																	

																		<input type="text" id="unit" name="unit" class="form-control" placeholder="Property Unit" value="<?php echo set_value('unit');?>" readonly>

																	<?php } else {?>

																		<input type="text" id="unit" name="unit" class="form-control" placeholder="Property Unit" value="<?php echo $lease['unit'];?>" readonly>
																	<?php } ?>	


														</div>



													



														<div class="col-lg-4 col-md-12">



															<label>Lease Security Deposit</label>
															
															<?php if($this->input->post('submit') && $this->input->post('lease_security_deposit') !== $lease['lease_security_deposit']) { ?>

															<input type="text" id="lease_security_deposit" name="lease_security_deposit" class="form-control" placeholder="Enter Lease Security Deposit" value="<?php echo set_value('lease_security_deposit');?>">

																<?php } else{?>
																	<input type="text" id="lease_security_deposit" name="lease_security_deposit" class="form-control" placeholder="Enter Lease Security Deposit" value="<?php echo $lease['lease_security_deposit'];?>">
																<?php }?>		

															<font color="red"><?=form_error("lease_security_deposit");?></font>
																					

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Lease Contract Status</label>
														
															<?php if($this->input->post('submit') && $this->input->post('lease_contract_status') !== $lease['lease_contract_status']) { ?>

																	<select id="lease_contract_status" name="lease_contract_status" class="form-control">

																<option value="">Lease Contract Status</option>

																<?php foreach($contract_status as $status):?>

																	<option value="<?php echo $status['lease_given_status_id'];?>" <?php echo (set_value('lease_contract_status')== $status['lease_given_status_id'])?" selected=' selected'":""?>><?php echo $status['lease_given_status'];?></option>

														
															<?php endforeach;?>

															</select>
																<?php } else{?>			

															<select id="lease_contract_status" name="lease_contract_status" class="form-control">

																<option value="">Lease Contract Status</option>

																<?php foreach($contract_status as $status):?>

																	<option value="<?php echo $status['lease_given_status_id'];?>" <?php echo ($lease['lease_contract_status']== $status['lease_given_status_id'])?" selected=' selected'":""?>><?php echo $status['lease_given_status'];?></option>

														
															<?php endforeach;?>

															</select>

														<?php }?>

																<font color="red"><?=form_error("lease_contract_status");?></font>					

														</div>

													

												</div>

											</div>



											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>Lease Contract Upload &nbsp;&nbsp; <a href="<?php echo base_url('lease/download_lease_given_contract/'.base64_encode($lease['lease_given_id']));?>" class="btn btn-primary btn-sm">Download Current Rent Receivable Contract</a></label>



																																	

															<input type="file" class="dropify" name="lease_contract_upload" id="lease_contract_upload" class="dropify" value="<?php echo set_value('lease_contract_upload');?>">

															<font color="red"><?php $new_in = $this->session->flashdata('new_in');
 															if($new_in==2) { echo "Upload Contract in Zip/JPEG/JPG/PNG/PDF Format Only.<br/>Zip size should not be exceed more than 5mb"; } ?></font>
													</div>

												</div>

											</div>			



											<div class="form-group">

												

												<div class="row">			



														<div class="col-lg-6 col-md-12">



															<label>Lease Terms</label>


															<?php if($this->input->post('submit') && $this->input->post('lease_terms') !== $lease['lease_terms']) { ?>
																	<textarea id="elm1" name="lease_terms"><?php echo set_value('lease_terms');?></textarea>
																<?php } else{?>
																	<textarea id="elm1" name="lease_terms"><?php echo $lease['lease_terms'];?></textarea>
																<?php }?>		
																																	

															
															<font color="red"><?=form_error("lease_terms");?></font>
																					

														</div>

														<div class="col-lg-6 col-md-12">



															<label>Lease Remark</label>

															<?php if($this->input->post('submit') && $this->input->post('lease_remark') !== $lease['lease_remarks']) { ?>

																<textarea id="elm1" name="lease_remark"><?php echo set_value('lease_remark');?></textarea>

																<?php } else{?>
																	<textarea id="elm1" name="lease_remark"><?php echo $lease['lease_remarks'];?></textarea>
																<?php }?>		
					

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

		<script>

	          var max_fields      = 10;

	    	  var x = <?php if(!empty($lessee1)) { echo count($lessee1); } else { echo 1; } ?>;

	        $(document).ready(function() { 

	            $("#adddoc1").on("click", function() {

	                if(x < max_fields){ 



	               $("#documentadd1").append('<div class="form-group"><div class="row"><div class="col-lg-5 col-md-12"></div><div class="col-lg-5 col-md-12"><div class="form-group"><div class="row"><label>Lessee Name</label><select id="lessee_name['+x+']" name="lessee_name['+x+']" class="form-control"><option value="">Choose Lessee</option><?php foreach($lesse as $b):?><option value="<?php echo $b['user_id'];?>"><?php echo $b['username'];?></option><?php endforeach; ?></select></div></div></div></div></div>');

	                x++;

	            }

	             $('#removedoc1').attr("disabled", false);

	            

	            

	            });

	             	
             $("#removedoc1").on("click", function() {

             	var acount = <?php echo count($lessee1); ?>

             	if(x > acount)
             	{
             		 $("#documentadd1").children().last().remove();
             	}
             	else
             	{
             		 $(".removethis3").children().last().remove();
             	}
             	x3--;


            });


	        });



    </script>



    <script type="text/javascript">

    	function show_lessee(val){

				 var element=document.getElementById('documentadd1');

				   element.style.display='block';

				}



    </script>

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