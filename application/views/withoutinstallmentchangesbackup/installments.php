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



								<li class="breadcrumb-item active" aria-current="page">View Loan Installments</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Loan Master",$r)) { ?>

									<a href="<?php echo site_url('Loan/loan_master/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">

										<span>

											<i class="fa fa-plus">Add Loan Details</i>

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
								<?php if($this->session->flashdata('loan_installment')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('loan_installment'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('loan_fully_installment')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('loan_fully_installment'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('loan_not_fully_installment')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('loan_not_fully_installment'); ?>
                                </div>
      							
    						<?php endif;?> 



							<div class="col-md-12 col-lg-12">



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">View Loan Installments List</div>



								</div>



								<div class="card-body">

									<?php echo form_open('Loan/loan_installment_filter/',array("method"=>"POST")); ?>		
										<div class="form-group">

											<div class="row">

												<div class="col-lg-5 col-md-12">

													<label>Payment Start Day</label>

													<div class="wd-200 mg-b-30">



														<div class="input-group">



															<div class="input-group-prepend">



																<div class="input-group-text">



																	<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																</div>



															</div>

															<input class="form-control datepicker2" name="payment_start_day" autocomplete="off" placeholder="Enter Payment Start Day" type="text" value="<?php echo set_value('payment_start_day');?>">



														</div>

														<font color="red"><?=form_error("payment_start_day");?></font>

													</div>

												</div>



												<div class="col-lg-5 col-md-12">

													<label>Payment End Day</label>

													<div class="wd-200 mg-b-30">



														<div class="input-group">



															<div class="input-group-prepend">



																<div class="input-group-text">



																	<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																</div>



															</div>

															<input class="form-control datepicker2" name="payment_end_day" autocomplete="off" placeholder="Enter Payment End Day" type="text" value="<?php echo set_value('payment_end_day');?>">



														</div>

														<font color="red"><?=form_error("payment_end_day");?></font>

													</div>

												</div>

												<div class="col-lg-2 col-md-12">
														<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
														
														<a class="btn btn-primary" href="<?php echo base_url('Loan/loan_installments/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>


											</div>

										</div>
								 	</form>	
									



                                	<div class="table-responsive">



										<table id="example" class="table table-striped table-bordered text-wrap w-100">



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>



													<th class="wd-15p">Property Name</th>



													<th class="wd-15p">Loan Date</th>

													<th class="wd-15p">Loan Amount</th>

													<th class="wd-15p">Installment Amount</th>



													<th class="wd-20p">Reminder Day</th>



													<th class="wd-20p">Status</th>

													<th>Installment History</th>

												</tr>



											</thead>



											<tbody>
												<?php $access = explode(",",$prop_access);?>

												 <?php  if(!empty($loan))
                             					 {
                              						$count = 1;

                              	 					foreach ($loan as $ln){

                              	 						$property_id[] = $ln['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $ln['property_id']){ 

                              	 				?>

                              	 				<tr>



													<td><?= $count;?></td>



													<td><?= $ln['property_name'];?></td>


													<td><?= date("d-m-Y", strtotime($ln['start_date']));?></td>

													<td><?= $ln['loan_amount'];?></td>


													<td><?= $ln['installment_amount'];?></td>


													<td><?= $ln['reminder_day'];?></td>

													<td>

													<?php 

													 $current_date = date("d");
													 $reminder_day  = $ln['reminder_day'];
													 $payment_day  = $ln['payment_date'];

																							
																						
													?>

													<?php if ($ln['mark_property_as_sold'] == "No") {?>

														<?php if($ln['loan_installment_status'] == 'Not Paid'){ ?>
															<input type="submit" class="btn btn-yellow" data-toggle="modal" data-target="#exampleModa<?php echo $count; ?>" name="mark_as" value="Mark Loan Installment As Paid" style="width:100%;">
															
														<?php } else if($ln['loan_installment_status'] == 'Paid') { ?>
															<a class="btn btn btn-success" href="#" style="width:100%;">Paid</a>
														<?php } else if($ln['loan_installment_status'] == 'Fully Paid') { ?>
															<a class="btn btn btn-success" href="#" style="width:100%;">Fully Paid</a>
														<?php }} else {?>

															<a class="btn btn btn-success" href="#" style="width:100%;">Property Sold</a>

														<?php } ?>	
														
												
												
												</td>
												<td><a class="btn btn btn-info" href="<?php echo base_url('Loan/view_loan_installments/'.base64_encode($ln["loan_id"]));?>">Installment Histroy</a></td>

												</tr>

												<div class="modal fade" id="exampleModa<?php echo $count; ?>" tabindex="-1" role="dialog"  aria-hidden="true">



						<div class="modal-dialog" role="document">



							<div class="modal-content">

								

							<?php echo form_open('Loan/loan_installment_paid/'.base64_encode($ln['loan_id']),array("method"=>"POST")); ?>
								<div class="modal-header">



									<h5 class="modal-title" id="example-Modal3">Mark Loan As Paid </h5>



									<input type="submit" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" value="&times;" name="close">



								</div>


								<div class="modal-body">


										<div class="form-group">



											<div class="row">				



													<div class="col-lg-6 col-md-12">



														<label for="renewal_date" class="form-control-label">
														Property Name:</label>

														<input type="text" class="form-control" name="property_name" placeholder="Enter Property Name" value="<?php echo $ln['property_name'];?>" readonly="">

													</div>

													<div class="col-lg-6 col-md-12">



														<label for="renewal_date" class="form-control-label">Next Installment Date:</label>



															<div class="wd-200 mg-b-30">



																<div class="input-group">



																	<div class="input-group-prepend">



																		<div class="input-group-text">



																			<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																		</div>



																	</div>
																		<input class="form-control datepicker2" autocomplete="off" placeholder="Next Installment Date" type="text" name="next_renewal_date" value="<?php echo $ln['payment_date'];?>">

																</div>
															</div>

														</div>


											</div>			



										</div>

										<div class="form-group">



											<div class="row">	


												<div class="col-lg-6 col-md-12">



														<label for="renewal_date" class="form-control-label">Loan Installment Amount:</label>



														<input type="text" class="form-control" name="installment_amount" placeholder="Enter Installment" value="<?php echo $ln['installment_amount'];?>" readonly="">

														</div>
			



													<div class="col-lg-6 col-md-12">



														<label for="renewal_date" class="form-control-label">
														Bank Name:</label>

														<input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="<?php echo $ln['bank_name'];?>" readonly="">

													</div>


											</div>			



										</div>



											<div class="form-group">



											 	<div class="row">	

													<div class="col-lg-6 col-md-12">



															<label for="renewal_date" class="form-control-label">Payment Refrence:</label>



															<input type="text" class="form-control" name="payment_refrence" placeholder="Enter Payment Refrence">

															<font color="red"><?=form_error("payment_refrence");?></font>

														</div>
				



													<div class="col-lg-6 col-md-12">





														<label for="renewal_date" class="form-control-label">Remark:</label>

														<textarea class="form-control" name="remark" placeholder="Enter Remark"><?php echo strip_tags($ln['loan_remark']);?></textarea>

													</div>	
													
												</div>	
											</div>

											<div class="form-group form-elements m-0">

														<div class="custom-controls-stacked">
															<label class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" name="fully_paid" value="Fully Paid" >
																<span class="custom-control-label" style="color:black;">Mark Loan As Fully Paid</span>
															</label>
														</div>	
											 
											</div>

										</div>



								<div class="modal-footer">



									<input type="button" class="btn btn-secondary" data-dismiss="modal" name="close" value="CLose">



									<input type="submit" class="btn btn-primary" value="Mark Loan As Paid" name="mark_as_renewed">


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

		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>






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







		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>



		<script>
	$(document).ready(function(){
		$(function() 
		{
				$( ".datepicker2").datepicker({ dateFormat: 'dd' });

		});
	});


</script>



	</body>



</html>