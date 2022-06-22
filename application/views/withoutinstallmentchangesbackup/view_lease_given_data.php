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

      <style>
#mceu_20{
	pointer-events: none;
}
#mceu_63-body{
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



								<li class="breadcrumb-item active" aria-current="page">View Rent Receivable Details</li>



							</ol><!-- End breadcrumb -->


							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Rent Receivable List",$r)) { ?>

									<a href="<?php echo site_url('Lease/lease_given_report/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>

											View Rent Receivable Details

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



										<h3 class="card-title">View Rent Receivable Details</h3> &nbsp;&nbsp;

										<?php foreach($lease_given as $given){?>
											<a href="<?php echo base_url('lease/download_lease_given_contract/'.base64_encode($given['lease_given_id']));?>" class="btn btn-primary btn-sm">Download Current Rent Receivable Contract</a>
										<?php } ?>



									</div>



									<div class="card-body">



										 <?php foreach($lease_given as $given) {?>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-6 col-md-12">



														<label>Property Name</label>



														<input type="text" class="form-control" value="<?php echo $given['property_name'];?>" readonly>
																					

													</div>



													<div class="col-lg-6 col-md-12">



														<label>Lessor Name</label>
														<h4>

														<?php 
															foreach($lease_given_lessee as $name){

																if($name['lease_given_id'] == $given['lease_given_id']){
														?>

														<?php echo $name['username'].",";?>

														

														<?php }} ?>
														</h4>
																					

													</div>


													

												</div>	

											</div>	



											<div id="documentadd1" style="display: none;"></div> 	



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



																				</div>
																					<input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($given['start_date']));?>" readonly>
																			</div>



																		</div>		

																					

													</div>



														<div class="col-lg-3 col-md-12">



															<label>Lease Tenure End Date</label>

																<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>

																					<input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($given['end_date']));?>" readonly>
																			</div>



																		</div>		
																					

														</div>

														<div class="col-lg-2 col-md-12">



															<label>Lease Payment Type</label>
		

															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="payment_type" value="Monthly" <?php if($given['payment_type'] == 'Monthly') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($given['payment_type'] == 'Monthly') { echo "Checked"; }?>">Monthly</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="payment_type" value="Yearly" <?php if($given['payment_type'] == 'Yearly') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value=" <?php if($given['payment_type'] == 'Yearly') { echo "Checked"; }?>">Yearly</span>



															</label>

															<font color="red"><?=form_error("payment_type");?></font>				

																					

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Payment Date</label>																						

															
															<?php if($given['payment_type'] == 'Monthly') {?>
																<input type="text" class="form-control" value="<?php echo $given['payment_date'];?>" readonly>
															<?php } else { ?>
																<input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($given['payment_date']));?>" readonly>
															<?php } ?>	
													</div>

												</div>
											</div>	

												<div class="form-group">

													<div class="row">		



														<div class="col-lg-3 col-md-12">



															<label>Lease Amount</label>

																<input type="text" class="form-control" value="<?php echo $given['lease_amount'];?>" readonly>
																					

														</div>



														<div class="col-lg-2 col-md-12">



															<label>Lease Increment Type</label>



																																	

																		

															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Percentage" <?php if($given['lease_increment_type'] == 'Percentage') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($given['lease_increment_type'] == 'Percentage') { echo "Checked"; }?>">Percentage</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="increment_type" value="Rupees" <?php if($given['lease_increment_type'] == 'Rupees') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($given['lease_increment_type'] == 'Rupees') { echo "Checked"; }?>">Rupees</span>



															</label>

															<font color="red"><?=form_error("increment_type");?></font>				

																					

														</div>



														<div class="col-lg-3 col-md-12">



															<label>Lease Increment</label>

																<input type="text" class="form-control" value="<?php echo $given['lease_increment'];?>" readonly>
														</div>



														<div class="col-lg-4 col-md-12">



															<label>Enter Number of Month for Lease Increment</label>

																<input type="text" class="form-control" value="<?php echo $given['lease_increment_month'];?>" readonly>
																					

														</div>



														

													

												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



															<label>Total Area Available For Lease</label>

																<input type="text" class="form-control" value="<?php echo $given['area_given_on_lease'];?>" readonly>

														</div>

														<div class="col-lg-2 col-md-12">



															<label>Area Given on Lease</label>

																<input type="text" class="form-control" value="<?php echo $given['area_given_on_lease_2'];?>" readonly>

														</div>



														<div class="col-lg-1 col-md-12">



															<label>Unit</label>

															<input type="text" class="form-control" value="<?php echo $given['unit'];?>" readonly>				

														</div>
													

														<div class="col-lg-2 col-md-12">



															<label>Finacial Status</label>

															<input type="text" class="form-control" value="<?php echo $given['financial_status'];?>" readonly>				

														</div>



														<div class="col-lg-2 col-md-12">



															<label>Lease Security Deposit</label>



														<input type="text" class="form-control" value="<?php echo $given['lease_security_deposit'];?>" readonly>
																					

														</div>



														<div class="col-lg-2 col-md-12">



															<label>Lease Contract Status</label>

															<input type="text" class="form-control" value="<?php echo $given['lease_given_status'];?>" readonly>				

														</div>

													

												</div>

											</div>



											<div class="form-group">

												

												<div class="row">			



														<div class="col-lg-6 col-md-12">



															<label>Lease Terms</label>



																																	

															<textarea id="elm1" name="lease_terms"><?php echo $given['lease_terms'];?></textarea>
														
														</div>

														<div class="col-lg-6 col-md-12">



															<label>Lease Terms</label>



																																	
															<label>Lease Remark</label>

															<textarea id="elm1" name="lease_remark"><?php echo $given['lease_remarks'];?></textarea>
														
														</div>

												</div>

											</div>			


											<!--<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>View Lease Own Contract</label>



																																	

															<a href="<?php echo base_url('Lease/download_lease_own_contract/'.base64_encode($given['lease_own_id']));?>"><embed src="<?php echo base_url('assets/images/uploads/lease/lease_own/'.(base64_decode($given['contract_upload'])));?>" width="100%" height="500px"></a>					

														</div>

													

												</div>

											</div>

											<div class="form-group"  style="float:right;">



												<div class="row">



													<a href="<?php echo base_url('lease/download_lease_given_contract/'.base64_encode($given['lease_given_id']));?>" class="btn btn-primary">Download Lease Own Contract</a>

												</div>

											</div>-->					




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

		<script>

	          var max_fields      = 10;

	    	  var x = 1;

	        $(document).ready(function() {

	            $("#adddoc1").on("click", function() {

	                if(x < max_fields){ 



	               $("#documentadd1").append('<div class="form-group"><div class="row"><div class="col-lg-5 col-md-12"></div><div class="col-lg-5 col-md-12"><label>Lessor Name</label><select id="lessor_name['+x+']" name="lessor_name['+x+']" class="form-control"><option value="">Choose Lessor</option><?php foreach($lessor as $b):?><option value="<?php echo $b['user_id'];?>"><?php echo $b['username'];?></option><?php endforeach; ?></select></div></div></div>');

	                x++;

	            }

	             $('#removedoc1').attr("disabled", false);

	            

	            

	            });

	             $("#removedoc1").on("click", function() {

	                $("#documentadd1").children().last().remove();

	            });

	        });



    </script>



    <script type="text/javascript">

    	function show_lessor(val){

				 var element=document.getElementById('documentadd1');

				   element.style.display='block';

				}



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







	</body>



</html>