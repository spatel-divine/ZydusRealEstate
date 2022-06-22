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



		<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />







		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />



		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>



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



								<li class="breadcrumb-item active" aria-current="page">View Property Details</li>



							</ol><!-- End breadcrumb -->



							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Property Master",$r)) { ?>

									<a href="<?php echo base_url('Property/property_master');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">

										<span>

											<i class="fa fa-plus">Add Property Details</i>

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

								<?php if($this->session->flashdata('insert_property')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insert_property'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('mark_sold')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('mark_sold'); ?>
                                </div>
      							
    						<?php endif;?> 


    						<?php if($this->session->flashdata('delete_property')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('delete_property'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('update_property')) :?>

								<div class="alert alert-success alert-dismissable">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('update_property'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('delete_property_image')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('delete_property_image'); ?>
                                </div>
      							
    						<?php endif;?> 



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Property Lists</div>



								</div>



								<div class="card-body">

									<?php echo form_open('Property/property_filter/',array("method"=>"POST")); ?>

										<div class="form-group">

										<div class="row">

											<div class="col-lg-2 col-md-12">

												<label>Filter By Property Type</label>

												<select class="form-control" name="property_type_id">
														<option value="">Property Type</option>
															<?php foreach($property_type as $prop):?>


																						
																<option value="<?php echo $prop['property_type_id'];?>" <?php if($_POST['property_type_id'] == $prop['property_type_id']){ echo 'Selected';}?>><?php echo $prop['property_type'];?></option>
	    													<?php endforeach; ?>
												</select>

											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Property Contract</label>

												<select name="property_contract" class="form-control">

													<option value="">Contract Type</option>

													<option value="Lease" <?php if($_POST['property_contract'] == "Lease"){ echo 'Selected';}?>>Lease</option>

													<option value="Buy" <?php if($_POST['property_contract'] == "Buy"){ echo 'Selected';}?>>Buy</option>

												</select>


											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Property Group</label>

												<select class="form-control" name="property_group_id">

													<option value="">Property Group</option>
														<?php foreach($property_group as $group):?>
															<option value="<?php echo $group['property_group_id'];?>" <?php if($_POST['property_group_id'] == $group['property_group_id']){ echo 'Selected';}?>><?php echo $group['property_group'];?></option>
	    												<?php endforeach; ?>

												</select>
											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Financial Status</label>

												<select class="form-control" name="financial_status_id">	
														<option value="">Financial Status</option>						

															<?php foreach($financial_status as $fin):?>
			    													<option value="<?php echo $fin['financial_status_id'];?>"<?php if($_POST['financial_status_id'] == $fin['financial_status_id']){ echo 'Selected';}?>><?php echo $fin['financial_status'];?></option>
			    											<?php endforeach; ?>
    											</select>

											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Property Status</label>

												<select class="form-control" id="status" name="property_status_id">

													<option value="">Choose Status</option>
														<?php foreach($property_status as $pstatus):?>
															<option value="<?php echo $pstatus['property_status_id'];?>" <?php if($_POST['property_status_id'] == $pstatus['property_status_id']){ echo 'Selected';}?>><?php echo $pstatus['property_status'];?></option>
	    												<?php endforeach; ?>

												</select>

											</div>

											<div class="col-lg-2 col-md-12">
													<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
													
													<a class="btn btn-primary" href="<?php echo base_url('Property/view_property_list/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>


										</div>

									</div>
									</form>



                                	<div class="table-responsive">



										<table id="example" class="table table-striped table-bordered text-wrap w-100">



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>



													<th class="wd-15p">Property Title</th>



													<th class="wd-15p">Property Contract</th>



													<th class="wd-20p">Total Price</th>

													<th class="wd-20p">Financial Status</th>

													<th class="wd-20p">Property Group</th>


													<th class="wd-20p">Mark Property As Sold</th>



													<th class="wd-20p">View More</th>



													<th class="wd-20p">Edit</th>



													<th class="wd-20p">Delete</th>



												</tr>



											</thead>



											<tbody>

											<?php $access = explode(",",$prop_access);?>


												<?php  if(!empty($property))
                             					 {
                              						$count = 1;

                              	 					foreach ($property as $prop){ 

                              	 						$property_id[] = $prop['property_id'];

                              	 						$common_access = array_intersect($access,$property_id);

                              	 						foreach($common_access as $acc){
                              	 							if($acc == $prop['property_id']){ 	

                              	 						

                              	 				?>



												<tr>



													<td><?= $count;?></td>


													<td><?= $prop['property_name'];?></td>



													<td><?= $prop['property_contract'];?></td>



													<td><?= $prop['total_price'];?></td>

													<td><?= $prop['financial_status'];?><?php if($prop['loan_lean_status'] == 'Lean Mark'){ echo "," .$prop['loan_lean_status']; }?></td>

													<td><?= $prop['property_group'];?></td>

													<?php if($prop['mark_property_as_sold'] == 'No' AND $prop['property_contract'] == 'Buy'){?>

													<td><a class="btn btn btn-warning" href="<?php echo base_url('Property/mark_property_sold/'.base64_encode($prop["property_id"]));?>" onclick="return confirm('Are You Sure You Want To Sold this Property?');" style="width:100%;">Mark Property As Sold</a></td>
												<?php } else if($prop['property_contract'] == 'Lease'){?>
													<td><a class="btn btn btn-danger" href="#">Can't Sold Leased Property</a></td>
												<?php } else {?>
													<td><a class="btn btn btn-success" style="width:100%;color:white;">Property Sold</a></td>
												<?php }?>

													<td><a class="btn btn btn-info" href="<?php echo base_url('Property/view_property_data/'.base64_encode($prop["property_id"]));?>"><i class="fe fe-plus mr-2"></i> View More</a></td>


													<?php if($prop['financial_status'] != 'Sold'){?>
													<td><a class="btn btn-primary" href="<?php echo base_url('Property/edit_property_detail/'.base64_encode($prop["property_id"]));?>" style="width:100%;"><i class="fa fa-edit"></i> Edit</a></td>
												<?php } else {?>
													<td><a class="btn btn-success" href="#">Property Sold</a></td>
												<?php } ?>	

													<?php if($prop['property_contract'] == 'Buy') {?>

													<td><a class="btn btn-danger"  href="<?php echo base_url('Property/delete_buy_property/'.base64_encode($prop["property_id"]));?>" onclick="return confirm('Are You Sure You Want To Delete Property Details? If You are Deleting Property than all related data with Property in Document,Loan,Lean Mark Loan,Lease,Legal,Hearing,External Opinion,Insurance,Claim,Income,Expense And All Installlment Data will be Deleted.');"><i class="fa fa-trash"></i> Delete</button></a>
												<?php } else { ?>
													<td><a class="btn btn-danger"  href="<?php echo base_url('Property/delete_lease_property/'.base64_encode($prop["property_id"]));?>" onclick="return confirm('Are You Sure You Want To Delete Property Details? If You are Deleting Property than all related data with Property in Document,Loan,Lean Mark Loan,Loan Installment,Lease,Lease Installment,Legal,Hearing,External Opinion,Insurance,Claim,Income,Expense And All Installlment Data will be Deleted.');"><i class="fa fa-trash"></i> Delete</button></a>
												<?php } ?>	


												</tr>

											
											<?php $count++;}}}}
											?>
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







		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>







	</body>



</html>