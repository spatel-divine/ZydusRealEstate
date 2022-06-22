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



								<li class="breadcrumb-item active" aria-current="page">View Rent Receivable Installment Details</li>



							</ol><!-- End breadcrumb -->



							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Rent Receivable",$r)) { ?>

									<a href="<?php echo site_url('Lease/lease_given/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">

										<span>

											<i class="fa fa-plus">Add Rent Receivable Details</i>

										</span>

									</a>

								<?php } ?>

								</div>

							</div>



						</div>



						<!-- End page-header -->

						<?php if($this->session->flashdata('select_data')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('select_data'); ?>
                                </div>
      							
    						<?php endif;?> 



							<!-- row -->



						<div class="row">



							<div class="col-md-12 col-lg-12">

								<?php if($this->session->flashdata('lease_given_installment')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('lease_given_installment'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('installment_pay_fail')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('installment_pay_fail'); ?>
                                </div>
      							
    						<?php endif;?> 



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Lease Rent Receivable Lists</div>



								</div>



								<div class="card-body">

									<?php echo form_open('Lease/rent_receivable_installment_filter/',array("method"=>"POST")); ?>		
										<div class="form-group">
											<div class="row">
												<div class="col-lg-4 col-md-12">

													<label>Payment Type</label>

													<select class="form-control" name="payment_type" id="payment_type">

																<option value="Monthly" <?php echo (set_value('payment_type')== 'Monthly')?" selected=' selected'":""?>>Monthly</option>

																<option value="Yearly" <?php echo (set_value('payment_type')== 'Yearly')?" selected=' selected'":""?>>Yearly</option>

															</select>
												</div>

												<div class="col-lg-3 col-md-12" id="display0">

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



												<div class="col-lg-3 col-md-12" id="display1">

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

												<div class="col-lg-3 col-md-12" id="display2" style="display: none;">

													<label>Payment Start Date</label>

													<div class="wd-200 mg-b-30">



														<div class="input-group">



															<div class="input-group-prepend">



																<div class="input-group-text">



																	<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																</div>



															</div>

															<input class="form-control" id="datepicker1" name="payment_start_day1" autocomplete="off" placeholder="Enter Payment Start Date" type="text" value="<?php echo set_value('payment_start_day1');?>">



														</div>

														<font color="red"><?=form_error("payment_start_day1");?></font>

													</div>

												</div>



												<div class="col-lg-3 col-md-12" id="display3" style="display: none;">

													<label>Payment End Date</label>

													<div class="wd-200 mg-b-30">



														<div class="input-group">



															<div class="input-group-prepend">



																<div class="input-group-text">



																	<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																</div>



															</div>

															<input class="form-control" id="datepicker2" name="payment_end_day1" autocomplete="off" placeholder="Enter Payment End Date" type="text" value="<?php echo set_value('payment_end_day1');?>">



														</div>

														<font color="red"><?=form_error("payment_end_day1");?></font>

													</div>

												</div>
											
											<div class="col-lg-2 col-md-12">
														<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
														
														<a class="btn btn-primary" href="<?php echo base_url('Lease/lease_given_installment/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>



											</div>
										</div>
									</form>			

                                	<div class="table-responsive">



										<table id="example" class="table table-striped table-bordered text-wrap w-100">



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>


													<th class="wd-15p">Property</th>


													<th class="wd-20p">Lease Amount</th>



													<th class="wd-15p">Start Date</th>


													<th class="wd-15p">End Date</th>

													<th class="wd-15p">Payment Day</th>

													<th class="wd-20p">Rent Installment Paid</th>
													<th class="wd-20p">Lease Status</th>
													<th class="wd-15p">History</th>

												</tr>



											</thead>



											<tbody>



												<?php  if(!empty($lease_given))
                             					 {
                              						$count = 1;

                              	 					foreach ($lease_given as $own){

                              	 						$access = explode(",",$prop_access);

                              	 						$property_id[] = $own['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $own['property_id']){ 

                              	 				?>

												<tr>



													<td><?= $count;?></td>



													<td><?= $own['property_name'];?></td>



													<td><?= $own['lease_amount'];?></td>

													<td><?= date("d-m-Y", strtotime($own['start_date']));?></td>



													<td><?= date("d-m-Y", strtotime($own['end_date']));?></td>

													<td>
														<?php if($own['payment_type'] == 'Monthly') {?>
															<?= $own['payment_date'];?>
														<?php } else { ?>
															<?=  date("d-m-Y", strtotime($own['payment_date']));?>
														<?php } ?>	
														</td>




													<?php $current_date = date('Y-m-d');?>


													<td>

													<?php if ($own['mark_property_as_sold'] == "No") {?>	
														<?php 

													if($own['lease_payment_status'] == 'Not Received' AND $current_date <= $own['end_date']) {

													 ?>
																<input type="submit" class="btn btn-yellow" data-toggle="modal" data-target="#exampleModa<?php echo $count; ?>" name="mark_as" value="Mark Installment As Paid" style="width:100%;">
															
														<?php } else if($own['lease_payment_status'] == 'Paid' AND $current_date <= $own['end_date']) { ?>

															<a class="btn btn-success" href="#" style="width:100%;">Received</a>

														<?php } else if($current_date >= $own['end_date']) { ?>

															<a class="btn btn-danger" href="#" style="width:100%;"> Lease is Expired</a>
														
														<?php }} else { ?>

															<a class="btn btn btn-success" href="#" style="width:100%;">Property Sold</a>

														<?php } ?>	
													</td>

													<td>
													<?php if ($own['mark_property_as_sold'] == "No") {?>	

														<?php

													if($own['end_date'] >= $current_date) {

													 ?>

													 	<a class="btn btn-success" href="#"> Ongoing</a>
														
														
													<?php }  else { ?>
														<a class="btn btn-danger" href="#" style="width:100%;"> Expired</a>
													<?php }} else { ?>

														<a class="btn btn btn-success" href="#" style="width:100%;">Property Sold</a>

													<?php } ?>	
													</td>

													<td><a class="btn btn btn-info" href="<?php echo base_url('Lease/view_lease_given_installments_history/'.base64_encode($own["lease_given_id"]));?>"><i class="fa fa-history"></i>History</a></td>




												</tr>

												<div class="modal fade" id="exampleModa<?php echo $count; ?>" tabindex="-1" role="dialog"  aria-hidden="true">



						<div class="modal-dialog" role="document">



							<div class="modal-content">

								

							<?php echo form_open('Lease/lease_given_installment_paid/'.base64_encode($own['lease_given_id']),array("method"=>"POST")); ?>
								<div class="modal-header">



									<h5 class="modal-title" id="example-Modal3">Mark Rent Receivable As Paid </h5>



									<input type="submit" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" value="&times;" name="close">



								</div>


								<div class="modal-body">


										<div class="form-group">



											<div class="row">				



													<div class="col-lg-6 col-md-12">

														<input type="hidden" name="payment_type" value="<?php echo $own['payment_type'];?>">
														<input type="hidden" name="lease_given_id" value="<?php echo $own['lease_given_id'];?>">

														<label for="renewal_date" class="form-control-label">
														Property Name:</label>

														<input type="text" class="form-control" name="property_name" placeholder="Enter Property Name" value="<?php echo $own['property_name'];?>" readonly="">

													</div>

													<div class="col-lg-6 col-md-12">



														<label for="renewal_date" class="form-control-label">
														Lease Amount:</label>

														<input type="text" class="form-control" name="lease_amount" placeholder="Enter Lease Amount" value="<?php echo $own['lease_amount'];?>" readonly="">

													</div>


													

											</div>			



										</div>

										<div class="form-group">



											<div class="row">	


												<div class="col-lg-6 col-md-12">



														<label for="start_date" class="form-control-label">Start Date:</label>



															<div class="wd-200 mg-b-30">



																<div class="input-group">



																	<div class="input-group-prepend">



																		<div class="input-group-text">



																			<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																		</div>



																	</div>
																		<input class="form-control" autocomplete="off" placeholder="Start Date" type="text" name="start_date" value="<?php echo date("d-m-Y", strtotime($own['start_date']));?>" readonly>

																</div>
															</div>

														</div>



													
												<div class="col-lg-6 col-md-12">



														<label for="start_date" class="form-control-label">End Date:</label>



															<div class="wd-200 mg-b-30">



																<div class="input-group">



																	<div class="input-group-prepend">



																		<div class="input-group-text">



																			<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																		</div>



																	</div>
																		<input class="form-control" autocomplete="off" placeholder="End Date" type="text" name="end_date" value="<?php echo date("d-m-Y", strtotime($own['end_date']));?>" readonly>

																</div>
															</div>

														</div>
											</div>			



										</div>



											<div class="form-group">



											 	<div class="row">	


												<div class="col-lg-6 col-md-12">



														<label for="start_date" class="form-control-label">Payment Day:</label>



															<div class="wd-200 mg-b-30">



																<div class="input-group">



																	<div class="input-group-prepend">



																		<div class="input-group-text">



																			<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																		</div>



																	</div>

																	<?php if($own['payment_type'] == 'Monthly') { ?>
																		<input class="form-control datepicker2" autocomplete="off" placeholder="Payment Day" type="text" name="payment_date1" value="<?php echo $own['payment_date'];?>">
																	<?php } else { ?>
																		<input class="form-control date" autocomplete="off" placeholder="Payment Day" type="text" name="payment_date" value="<?php echo date("d-m-Y", strtotime($own['payment_date']));?>" readonly>
																	<?php } ?>	

																</div>
															</div>

														</div>

													<div class="col-lg-6 col-md-12">



															<label for="renewal_date" class="form-control-label">Payment Refrence:</label>



															<input type="text" class="form-control" name="payment_refrence" placeholder="Enter Payment Refrence">

															<font color="red"><?=form_error("payment_refrence");?></font>

														</div>
			
													
												</div>	
											</div>

											
										</div>



								<div class="modal-footer">



									<input type="button" class="btn btn-secondary" data-dismiss="modal" name="close" value="CLose">



									<input type="submit" class="btn btn-primary" value="Mark Rent Receivable As Paid" name="mark_as_renewed">


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

    	  $('#payment_type').change(function() {

    	 	var payment_type=document.getElementById('payment_type').value;
    	 	var element=document.getElementById('display0');//day
    	 	var element1=document.getElementById('display1');  //day
    	 	var element2=document.getElementById('display2'); //date
    	 	var element3=document.getElementById('display3'); //date

		            if (payment_type == 'Monthly') {

		            	 element2.style.display='none';
		            	 element3.style.display='none';
				         element.style.display='block';
				         element1.style.display='block';
				         element.val('');
				         element1.val('');
				    }

				    else{
				         element.style.display='none';
				         element1.style.display='none';
				         element2.style.display='block';
		            	 element3.style.display='block';
				         element2.val('');
				         element3.val('');
				    }
	            });       	
    </script>

       <script type="text/javascript">
    	 $(document).ready(function() {

    	 	var payment_type=document.getElementById('payment_type').value;
    	 	var element=document.getElementById('display0');//day
    	 	var element1=document.getElementById('display1');  //day
    	 	var element2=document.getElementById('display2'); //date
    	 	var element3=document.getElementById('display3'); //date

		            if (payment_type == 'Monthly') {

		            	 element2.style.display='none';
		            	 element3.style.display='none';
				         element.style.display='block';
				         element1.style.display='block';
				         element.val('');
				         element1.val('');
				    }

				    else{
				         element.style.display='none';
				         element1.style.display='none';
				         element2.style.display='block';
		            	 element3.style.display='block';
				         element2.val('');
				         element3.val('');
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
				$( ".datepicker2").datepicker({ dateFormat: 'dd' });
				$( ".date").datepicker({ 
					dateFormat: 'dd-mm-yy',
					changeMonth : true,
					changeYear : true
				 });

		});
	});


</script>





	</body>



</html>