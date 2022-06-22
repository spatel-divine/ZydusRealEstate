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







		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />


		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>

		<style>
			.ui-datepicker {

 z-index: 999999 !important;
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



								<li class="breadcrumb-item active" aria-current="page">View Insurnce Renewal Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Insurance Master",$r)) { ?>

									<a href="<?php echo base_url('Insurance/insurance_master');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">

										<span>

											<i class="fa fa-plus">Add Insurnce Details</i>

										</span>

									</a>

								<?php } ?>

								</div>

							</div>


						</div>



						<!-- End page-header -->



							<!-- row -->



						<div class="row">



							<div class="col-md-12 col-lg-12">
								<?php if($this->session->flashdata('insurance_renew')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insurance_renew'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('insurance_close')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insurance_close'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('insurance_renew_fail')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insurance_renew_fail'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('select_data')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('select_data'); ?>
                                </div>
      							
    						<?php endif;?> 




							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Insurnce Renewal Lists</div>



								</div>



								<div class="card-body">
									<?php $access = explode(",",$prop_access);?>
									<?php echo form_open('Insurance/filter_insurance/',array("method"=>"POST","id"=>"form-filter")); ?>
										<div class="form-group">

											<div class="row">

												<div class="col-lg-5 col-md-12">

													<label>Filter By Insurance Renewal Date</label>

													<div class="wd-200 mg-b-30">



														<div class="input-group">



															<div class="input-group-prepend">



																<div class="input-group-text">



																	<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																</div>



															</div>

															<input class="form-control" id="datepicker1" name="date" autocomplete="off" placeholder="Filter By Date" type="text" value="<?php echo set_value('date');?>">



														</div>



													</div>

												</div>

												<div class="col-lg-5 col-md-12">

													<label>Filter By Property</label>

													<select id="property_id" name="property_id" class="form-control">

																<option value="">Choose Property</option>

																<?php foreach($property as $prop):
																$property_id[] = $prop['property_id'];	
																$common_access = array_intersect($access,$property_id);
																?>
																<?php foreach($access as $acc){if($acc == $prop['property_id']) { ?>
		    														<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_id')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
		    													<?php }} ?>	
		    											<?php endforeach; ?>

															</select>

												</div>


												<div class="col-lg-2 col-md-12">
													<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
													
													<a class="btn btn-primary" href="<?php echo base_url('Insurance/insurance_renewal_list/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>

											</div>

										</div>
									</form>	


                                	<div class="table-responsive">


										<table id="example1" class="table table-striped table-bordered text-wrap w-100">



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>



													<th class="wd-15p">Property Name</th>



													<th class="wd-15p">Insurance Name</th>



													<th class="wd-20p">Policy No</th>



													<th class="wd-20p">Insurance Company</th>

													<th class="wd-20p">Renewal Date </th>

													<th class="wd-20p">Expiry Date</th>


													<th class="wd-20p">Mark As Renewed</th>

													<th class="wd-20p">Insurance Status</th>

													<th> History </th>




												</tr>



											</thead>



											<tbody>
												 <?php  if(!empty($insurance))
                              {
                              	$count = 1;

                              	 foreach ($insurance as $inc){

                              	 	$property_id[] = $inc['property_id'];

									$common_access = array_intersect($access,$property_id);

										foreach($common_access as $acc){
                              	 			if($acc == $inc['property_id']){ 

                              	 	?>



												<tr>



													<td><?= $count;?></td>



													<td><?= $inc['property_name'];?></td>



													<td><?= $inc['insurance_name'];?></td>



													<td><?= $inc['policy_no'];?></td>



													<td><?= $inc['insurance_company'];?></td>

													<!--Renewal Date means Next Premium Date-->

													<td><?= date("d-m-Y", strtotime($inc['next_premium_date']));?></td>

													<td><?= date("d-m-Y", strtotime($inc['insurance_expiry_date']));?></td>


												     <?php $date=date_create($inc['next_premium_date']);
															date_sub($date,date_interval_create_from_date_string("30 days"));
											
															$ren_date =  date_format($date,"Y-m-d"); // renewal date 30 days before next premium date

															date_default_timezone_set("Asia/Kolkata");
															$current_date = date('Y-m-d');
															?>
														<td>

															<?php if ($inc['mark_property_as_sold'] == "No") {?>
														
													    <?php if($inc['insurance_renewed'] == 0 AND $current_date <= $inc['insurance_expiry_date']){ ?>
														<input type="submit" class="btn btn-yellow" data-toggle="modal" data-target="#exampleModa<?php echo $count; ?>" name="mark_as" value="Mark Insurance As Renewed">
													<?php } else if($inc['insurance_renewed'] == 1 AND $current_date <= $inc['insurance_expiry_date']){?>
														<input type="submit" class="btn btn-yellow" data-toggle="modal" data-target="#exampleModa<?php echo $count; ?>" name="mark_as" value="Mark Insurance As Renewed">
													<?php } else if(($current_date >= $inc['insurance_expiry_date'] AND $inc['insurance_renewed'] !== 2)){?>
														<input type="submit" class="btn btn-yellow" data-toggle="modal" data-target="#exampleModa<?php echo $count; ?>" name="mark_as" value="Mark Insurance As Renewed">
													
													<?php } else { ?>
														<button class="btn btn btn-danger" style="width:100%">Closed</button>
													<?php } } else { ?>
														<a class="btn btn btn-success" href="#" style="width:100%;">Property Sold</a>

													<?php } ?>	
													</td>

													<td>
														<?php if ($inc['mark_property_as_sold'] == "No") {?>
														<?php if($inc['insurance_renewed'] == 2) { ?>
															<button class="btn btn btn-danger" style="width:100%">Closed</button>
														<?php } else { ?>
															<button class="btn btn btn-success" style="width:100%">Ongoing</button>
														<?php }} else {?>
															<a class="btn btn btn-success" href="#" style="width:100%;">Property Sold</a>

														<?php } ?>		
													</td>

													<td><a class="btn btn btn-info" href="<?php echo base_url('Insurance/view_insurance_pay_history/'.base64_encode($inc["insurance_id"]));?>"><i class="fa fa-history"></i>History</a></td>

												</tr>


												<div class="modal fade" id="exampleModa<?php echo $count; ?>" tabindex="-1" role="dialog"  aria-hidden="true">



						<div class="modal-dialog" role="document">



							<div class="modal-content">

								

															<?php echo form_open('Insurance/insurance_edit_renewal_list/'.base64_encode($inc['insurance_id']),array("method"=>"POST")); ?>
								



								<div class="modal-header">



									<h5 class="modal-title" id="example-Modal3">Mark Insurance As Renewed </h5>



									<input type="submit" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" value="&times;" name="close">



								</div>


								<div class="modal-body">


										<div class="form-group">



											<div class="row">				



													<div class="col-lg-6 col-md-12">



														<label for="renewal_date" class="form-control-label">Property Name:</label>

														<input type="text" class="form-control" name="property_name" placeholder="Enter Property Name" value="<?php echo $inc['property_name']; ?>" readonly="">

													</div>



														<div class="col-lg-6 col-md-12">



														<label for="renewal_date" class="form-control-label">Insurance Name:</label>



														<input type="text" class="form-control" name="insurance_name" placeholder="Enter Insurance Name" value="<?php echo $inc['insurance_name']; ?>" readonly="">

													</div>



											</div>			



										</div>



											<div class="form-group">



												<div class="row">				



													<div class="col-lg-6 col-md-12">





														<label for="renewal_date" class="form-control-label">Policy No:</label>



														<input type="text" class="form-control" name="policy_no" placeholder="Enter Renewal Policy No" value="<?php echo $inc['policy_no']; ?>">

													</div>	





													<div class="col-lg-6 col-md-12">



														<!--Nex Premium Date in this user is going to add date and we need to update this date in next premium date and set flag 1 for renewal is done-->

															<label for="renewal_date" class="form-control-label">Next Renewal Date:</label>

															<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control datepicker2" autocomplete="off" placeholder="Next Renewal Date" type="text" name="next_renewal_date" value="<?php echo date("d-m-Y", strtotime($inc['next_premium_date'])); ?>">

																			



																			</div>



																		</div>



													</div>	

												</div>	



										</div>



											<div class="form-group">



												<div class="row">				



													<div class="col-lg-6 col-md-12">





														<label for="ledger_head" class="form-control-label">Premium Amount:</label>



														<input type="text" class="form-control" name="premium_amount" placeholder="Enter Premium Amount" value="<?php echo $inc['premium_amount']; ?>">



													</div>	





													<div class="col-lg-6 col-md-12">





														<label for="ledger_head" class="form-control-label">Policy Payer:</label>



														<input type="text" class="form-control" name="policy_payer" placeholder="Enter Policy Payer" value="<?php echo $inc['policy_payer']; ?>">



													</div>	

												</div>	



										</div>



										<div class="form-group">



												<div class="row">				



													<div class="col-lg-6 col-md-12">





														<label for="ledger_head" class="form-control-label">Ledger Head:</label>



														<input type="text" class="form-control" name="ledger_head" placeholder="Enter Ledger Head" value="<?php echo $inc['ledger_head']; ?>">



							



													</div>	





													<div class="col-lg-6 col-md-12">





														

														<label for="ledger_head" class="form-control-label">Ledger Number:</label>



														<input type="text" class="form-control" name="ledger_number" placeholder="Enter Ledger Number" value="<?php echo $inc['ledger_number']; ?>">





													</div>	

												</div>	



										</div>

										<div class="form-group form-elements m-0">

														<div class="custom-controls-stacked">
															<label class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" name="insurance_renewed" value="2" >
																<span class="custom-control-label" style="color:black;">Mark Insurance As Closed</span>
															</label>
														</div>	
											 
											</div>


									
							

								</div>



								<div class="modal-footer">



									<input type="button" class="btn btn-secondary" data-dismiss="modal" name="close" value="CLose">



									<input type="submit" class="btn btn-primary" value="Mark Insurance As Renewed" name="mark_as_renewed">


								</div>

								</form>

							</div>

						

						</div>



					</div>


						<?php $count++;}}}}?>

											</tbody>



										</table>



									</div>



                                </div>



								<!-- table-wrapper -->



							</div>




							<!-- section-wrapper -->



							</div>



						</div>



						<!-- row end -->



					</div>



					</div>






							<!-- Message Modal -->

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



		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>







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







		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>

	<script>
	$(document).ready(function(){
		$(function() 
		{
				$( ".datepicker2").datepicker({ dateFormat: 'dd-mm-yy' , minDate: '0' });

		});
	});


</script>

	</body>



</html>