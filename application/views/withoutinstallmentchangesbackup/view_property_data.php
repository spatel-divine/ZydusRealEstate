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





		<!-- Time picker css-->



		<link href="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />







		<!-- Date Picker css-->



		<link href="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.css" rel="stylesheet" />





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
	.modal {
    position: fixed;
    top: 7% !important;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: hidden;
    outline: 0;
    padding-right: 0 !important;
    margin: 0 !important;

 
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



								<li class="breadcrumb-item active" aria-current="page">View Property</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("View Property List",$r)) { ?>
									<a href="<?php echo site_url('Property/view_property_list/')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Property">
										<span>
											View All Property
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



										<h3 class="card-title">View Property Details</h3>



									</div>



									<div class="card-body">

										<?php foreach($property as $prop){?>

										<form id="form">



											<div class="list-group">



												<div class="list-group-item py-3" data-acc-step>

													<br/>

													<h4 class="mb-0" style="color:black;"><u>1. Property Details</u></h4><br/>



																	<div class="form-group">



																		<div class="row">



																			<div class="col-lg-4 col-md-12">



																				<label>Property Type</label>

																					<input type="text" class="form-control" value="<?php echo $prop['property_type'];?>" readonly>


																			</div>



																			<div class="col-lg-3 col-md-12">





																				<label>Property Title</label>



																				<input type="text" class="form-control" value="<?php echo $prop['property_name'];?>" readonly>


																			</div>

																			<div class="col-lg-2 col-md-12">





																				<label>Asset Number</label>



																				<input type="text" class="form-control" value="<?php echo $prop['asset_number'];?>" readonly>


																			</div>


																		<div class="col-lg-3 col-md-12">



																			<label>Address</label>



																			<textarea type="text" class="form-control" readonly><?php echo $prop['property_address'];?></textarea>



																		</div>





																		</div>	

																	</div>



																<div class="form-group">



																	<div class="row">




																		<div class="col-lg-2 col-md-12">





																			<label>City</label>


																				<input type="text" class="form-control" value="<?php echo $prop['city'];?>" readonly>





																		</div>



																		<div class="col-lg-2 col-md-12">





																			<label>State</label>

																			
																			<input type="text" class="form-control" value="<?php echo $prop['state'];?>" readonly>





																		</div>

																		<div class="col-lg-2 col-md-12">





																			<label>Pincode</label>


																				<input type="text" class="form-control" value="<?php echo $prop['pincode'];?>" readonly>



																		</div>


																	<div class=" col-lg-3 col-md-12">



																		<label>Latitude</label>



																		<input type="text" class="form-control" value="<?php echo $prop['latitude'];?>" readonly>



																	</div>





																	<div class="col-lg-3 col-md-12">





																		<label>Longitude</label>



																		<input type="text" class="form-control" value="<?php echo $prop['longitude'];?>" readonly>





																	</div>




																	</div>

																</div>





															<!--<div class="form-group">



																<div class="row">



																<div class="col-lg-6 col-md-12">



																		<label>Or drag the marker to property position</label>



																		<div style="width: 100%"><iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&amp;height=500&amp;hl=en&amp;coord=22.8817559,72.4040166&amp;q=Sarkhej-Bhavla%20Road%2C%20NH%208A%20%2C%20Matada%2C%20Sari%2C%20Gujarat%20382220+(Zydus%20Real%20Estate)&amp;ie=UTF8&amp;t=&amp;z=13&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
																				
																	</div>										



																</div>	



															</div>	-->	



															

															<div class="form-group">



																<div class="row">



																	<div class="col-lg-3 col-md-12">



																		<label>Property Contract</label>			

																		<input type="text" class="form-control" value="<?php echo $prop['property_contract'];?>" readonly>



																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Unit</label>									

																		<input type="text" class="form-control" value="<?php echo $prop['unit'];?>" readonly>


																	</div>

																	<div class="col-lg-2 col-md-12">



																		<label>Property Unit</label>



																		<input type="text" class="form-control" value="<?php echo $prop['property_unit'];?>" readonly>	



																	</div>

																	<div class="col-lg-2 col-md-12">





																		<label>Property Price Per Unit</label>



																		<input type="text" class="form-control" value="<?php echo $prop['property_price_per_unit'];?>" readonly>





																	</div>

																	<div class="col-lg-2 col-md-12">





																		<label>Total Price</label>



																		<input type="text" class="form-control" value="<?php echo $prop['total_price'];?>" readonly>

																		
																	</div>



																</div>	



															</div>


															<?php if($prop['property_type'] === 'Building/Warehouse/Commercial Building'){?>
															<div class="form-group">



																<div class="row">



																	<div class="col-lg-6 col-md-12">

																		<label>RERA Number</label>



																		<input type="text" class="form-control" value="<?php echo $prop['rera_number'];?>" readonly>

																	</div>

																	

																	<div class="col-lg-6 col-md-12">

																		<label>BU Number</label>



																		<input type="text" class="form-control" value="<?php echo $prop['bu_number'];?>" readonly>

																	</div>

																</div>

															</div>
														<?php } ?>


																<?php if($prop['property_type'] === 'N/A Land' OR $prop['property_type'] === 'Agricultural Land'){?>
																<div class="form-group">



																<div class="row">



																	<div class="col-lg-6 col-md-12">

																		<label>Nature of Land</label>



																		 <input type="text" class="form-control" value="<?php echo $prop['nature_of_land'];?>" readonly>

																	</div>

																	

																	<div class="col-lg-6 col-md-12">

																		<label>Type of Land</label>

																			<input type="text" class="form-control" value="<?php echo $prop['land_type'];?>" readonly>

																	</div>

																</div>

															</div>			
														<?php }?>


															<div class="form-group">



																<div class="row">



																	<div class="col-lg-4 col-md-12">



																		<label>Property Controller</label>

																		<?php foreach($property_controller as $controller){?>

																			<input type="text" class="form-control" value="<?php echo $controller['username'];?>" readonly>
																		<?php } ?>	
																	</div>

																	<div class="col-lg-4 col-md-12">



																		<label>Property Group</label>

																		
																		<input type="text" class="form-control" value="<?php echo $prop['property_group'];?>" readonly>


																	</div>



																	<div class="col-lg-4 col-md-12">



																		<label>Property Jurisdiction</label>

																		
																		<input type="text" class="form-control" value="<?php echo $prop['property_jurisdiction'];?>" readonly>


																	</div>


																</div>	



															</div>

															<div class="form-group">



																<div class="row">


																	<div class="col-lg-6 col-md-12">



																		<label>Property Purchase Date</label>



																		

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" autocomplete="off"  type="text" value="<?php echo date("d-m-Y", strtotime($prop['property_purchase_date']))?>" readonly>
																				

																			</div>



																		</div>


																	</div>

																	<div class="col-lg-6 col-md-12">



																		<label>Property Satus</label>

																			<input type="text" class="form-control" value="<?php echo $prop['property_status'];?>" readonly>


																	</div>



																</div>	



															</div>


															<?php if(!empty($prop['property_remarks'])) { ?>


															<div class="form-group">



																<div class="row">



																	<div class="col-lg-12 col-md-12">



																		<label>Property Remark</label>



																		<textarea id="elm1" name="property_remark"><?php echo $prop['property_remarks'];?>
																				</textarea>	



																	</div>
																</div>
															</div>		
																<?php } ?>

															
																<div class="form-group">



																<div class="row">


																	<div class="col-lg-12 col-md-12">


																		<br/>
																		<?php  if(!empty($property_images)) { ?>
																		<label>View Property Images</label>
																		<br/>
																		<?php } ?>

																		<?php 
																		$count = 1;
																			foreach($property_images as $images){ $image =  base64_decode($images['property_image']);
																		?>

																		<embed data-toggle="modal" data-target="#exampleModa<?php echo $count; ?>" src="<?php echo base_url('assets/images/uploads/property/'.$image);?>" style="height:80px;widht:150px;;"></embed>


																				<div class="modal fade" id="exampleModa<?php echo $count; ?>" tabindex="-1" role="dialog"  aria-hidden="true">

	<div class="modal-dialog" role="document">



							<div class="modal-content">

								
								<div class="modal-header">



									<h5 class="modal-title" id="example-Modal3">View Property Images List for <?php echo $p['property_name'];?></h5>



									<input type="submit" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" value="&times;" name="close">



								</div>


								<div class="modal-body">



												<center><a href="<?php echo base_url('Property/download_property_images/'.base64_encode($images['property_image_id']));?>">
																		
																		<embed src="<?php echo base_url('assets/images/uploads/property/'.$image);?>" style="height:auto; width:100%;"> </embed></a></center> 
																		<br>


													<a class="btn btn-success" href="<?php echo base_url('Property/download_property_images/'.base64_encode($images['property_image_id']));?>" style="float: right;"><i class="fa fa-download"></i> Download</a>


								
												


							</div>
						</div>
					</div>
				</div>			



																		
																		<?php $count++; }?>



																	</div>

																	

																</div>	



															</div>

															


															<h4 class="mb-0" style="color:black;"><u>2. Broker Details</u></h4><br/>

															<?php foreach($broker as $brok){

																if($prop['property_id'] == $brok['property_id']){ ?>

																<div class="form-group">



																<div class="row">



																	<div class="col-lg-3 col-md-12">



																		<label>Broker Name</label>



																		<input type="text" class="form-control" value="<?php echo $brok['username'];?>" readonly>


																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Broker Comission Type</label>


																			<input type="text" class="form-control" value="<?php echo $brok['broker_commission_type'];?>" readonly>


																		
																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Brokerage Amount/Percentage</label>

																		<input type="text" class="form-control" value="<?php echo $brok['brokerage_amount'];?>" readonly>	

																		

																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Brokerage Amount To Be Paid</label>

																		<input type="text" class="form-control" value="<?php echo $brok['brokerage_amount_to_paid'];?>" readonly>


																		

																	</div>



																</div>

															</div>	


															<div class="form-group">



																<div class="row">



																	<div class="col-lg-6 col-md-12">



																		<label>Payment Status</label>


																		<input type="text" class="form-control" value="<?php echo $brok['payment_status'];?>" readonly>


																	</div>



																	<div class="col-lg-6 col-md-12">



																		<label>Payment Date</label>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control"  type="text" name="payment_date" value="<?php echo date("d-m-Y", strtotime($brok['payment_date']));?>" readonly>
																				

																			</div>



																		</div>

																	</div>

																</div>

															</div>


															<?php if($brok['payment_status'] == 'Partically Paid'){?>
															<div id="partically_paid_amount">	

																<div class="form-group">



																	<div class="row">



																		<div class="col-lg-12 col-md-12">



																			<label>Partically Paid Amount</label>

																			<input type="text" class="form-control" value="<?php echo $brok['partically_paid_amount'];?>" readonly>


																		</div>

																	</div>

																</div>

															</div>

																<?php }}} ?>



															<br/>

															<?php if($prop['property_contract'] == 'Lease') {?>
																
															<h4 class="mb-0" style="color:black;"><u>3. Lessee Details</u></h4><br/>
															<?php foreach($lessee as $les) {
																?>
																																
																				<div class="form-group">
																					
																					<div class="row">



																						<div class="col-lg-6 col-md-12">



																							<label>Leasse Name</label>

																							<input type="text" class="form-control" value="<?php echo $les['username'];?>" readonly>

																						</div>



																						<div class="col-lg-6 col-md-12">

																							<label>Share in Property</label>

																							<input type="text" class="form-control" value="<?php echo $les['share_in_property'];?>" readonly>

																						</div>


																					</div>

																				</div>

																			<?php  }} if($prop['property_contract'] == 'Buy') {?>


															<br/>	

															<h4 class="mb-0" style="color:black;"><u>3. Seller Details</u></h4><br/>

															<?php foreach($seller as $sel) {
																?>

															<div class="form-group">



																				<div class="row">



																					<div class="col-lg-6 col-md-12">



																						<label>Seller Name</label>

																						<input type="text" class="form-control" value="<?php echo $sel['username'];?>" readonly>
																					</div>



																					<div class="col-lg-6 col-md-12">

																						<label>Share in Property</label>

																						<input type="text" class="form-control" value="<?php echo $sel['share_in_property'];?>" readonly>

																					</div>


																				</div>

																			</div>
																		<?php }} if($prop['property_contract'] == 'Lease') {?>
																		<br/>	

															<h4 class="mb-0" style="color:black;"><u>4. Lessor Details</u></h4><br/>

															<?php foreach($lessor as $les1) {
																?>

																		<div class="form-group">



																			<div class="row">



																				<div class="col-lg-6 col-md-12">



																					<label>Leassor Name</label>

																					<input type="text" class="form-control" value="<?php echo $les1['username'];?>" readonly>


																				</div>



																				<div class="col-lg-6 col-md-12">

																					<label>Share in Property</label>

																					<input type="text" class="form-control" value="<?php echo $les1['share_in_property'];?>" readonly>

																				</div>



																			</div>

																	</div>

																	<?php }} if($prop['property_contract'] == 'Buy') {?>

															<br/>

															<h4 class="mb-0" style="color:black;"><u>4. Purchaser Details</u></h4><br/>

															<?php foreach($purchaser as $phur) {?>

																	<div class="form-group">



																		<div class="row">



																				<div class="col-lg-6 col-md-12">



																					<label>Purchaser Name</label>

																					<input type="text" class="form-control" value="<?php echo $phur['username'];?>" readonly>

																				</div>



																				<div class="col-lg-6 col-md-12">

																					<label>Share in Property</label>

																					<input type="text" class="form-control" value="<?php echo $phur['share_in_property'];?>" readonly>

																				</div>


																		</div>

																	</div>

																<?php }} ?>

															<br/>

															<h4 class="mb-0" style="color:black;"><u>5. Property Fixed Expense Details</u></h4><br/>

															<?php foreach($fixed_expense as $expense){?>

															 <div class="form-group">



																<div class="row">



																	<div class="col-lg-6 col-md-12">



																		<label>Expense Type</label>



																		<input type="text" class="form-control" value="<?php echo $expense['fixed_expense'];?>" readonly>

																	</div>



																	<div class="col-lg-6 col-md-12">



																		<label>Expense Amount</label>

																		<input type="text" class="form-control" value="<?php echo $expense['expense_amount'];?>" readonly>


																	</div>


																</div>

															</div>

														<?php } ?>

															<!--End of Content-->

														</div>






												<!--Wizrad Completes Here-->



											</div>



										</form>

									<?php }	?>

									</div>



								</div>



							</div>



						</div>



						<!--row closed-->







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



																			

		<!-- Forn-wizard js-->



		<script src="<?=base_url();?>assets/plugins/formwizard/jquery.smartWizard.js"></script>



		<script src="<?=base_url();?>assets/plugins/formwizard/fromwizard.js"></script>







		<!--Accordion-Wizard-Form js-->



		<script src="<?=base_url();?>assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>



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



		<!-- WYSIWYG Editor js -->



		<script src="<?=base_url();?>assets/plugins/wysiwyag/jquery.richtext.js"></script>



		<script src="<?=base_url();?>assets/plugins/wysiwyag/richText1.js"></script>







		<!--Summernote js-->



		<script src="<?=base_url();?>assets/plugins/summernote/summernote-bs4.js"></script>



		<script src="<?=base_url();?>assets/js/summernote.js"></script>







		<!--ckeditor js-->



		<script src="<?=base_url();?>assets/plugins/tinymce/tinymce.min.js"></script>



		<script src="<?=base_url();?>assets/js/formeditor.js"></script>







		



		<!-- Timepicker js -->



		<script src="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.js"></script>



		<script src="<?=base_url();?>assets/plugins/time-picker/toggles.min.js"></script>







		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>









		<!--Advanced Froms js-->



		<script src="<?=base_url();?>assets/js/advancedform.js"></script>


 

 <!-- Custom js-->



 <script src="<?=base_url();?>assets/js/custom.js"></script>





	</body>



</html>