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



								<li class="breadcrumb-item active" aria-current="page">View Loan Details</li>



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

								<?php if($this->session->flashdata('insert_loan')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insert_loan'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('delete_loan')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('delete_loan'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('update_loan')) :?>

								<div class="alert alert-success alert-dismissable">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('update_loan'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('check_loan_inserted')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('check_loan_inserted'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('check_loan_edit')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('check_loan_edit'); ?>
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



									<div class="card-title">Loan Lists</div>



								</div>

								<h5 style="display: none;" id="show_block">Select Any Field</h5>

								<div class="card-body">

									<?php echo form_open('Loan/loan_filter',array("method"=>"POST","id"=>"my_form")); ?>
										<div class="form-group">

										<div class="row">

											<div class="col-lg-2 col-md-12">

												<label>Filter By Property</label>

												<select class="form-control" name="property_id" id="property_id">

												<option value="">Choose Property</option>
												<?php $access = explode(",",$prop_access);?>

													<?php foreach($property as $prop):
														$property_id[] = $prop['property_id'];	
																$common_access = array_intersect($access,$property_id);
																?>
													<?php foreach($access as $acc){if($acc == $prop['property_id']) { ?>

	    												<option value="<?php echo $prop['property_id'];?>" <?php if(isset($_POST['property_id'])){
	    													if($_POST['property_id'] == $prop['property_id']){ echo 'Selected';}}?>><?php echo $prop['property_name'];?></option>
	    											<?php }} ?>			
	    											<?php endforeach; ?>

												</select>

											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Interest Type</label>

												<select name="interest_type" class="form-control" id="interest_type">

													<option value="">Interest Type Type</option>

													<option value="Simple Interest" <?php if(isset($_POST['interest_type'])){
	    													if($_POST['interest_type'] == "Simple Interest"){ echo 'Selected';}}?>>Simple Interest</option>

													<option value="Compound Interest" <?php if(isset($_POST['interest_type'])){
	    													if($_POST['interest_type'] == "Compound Interest"){ echo 'Selected';}}?>>Compound Interest</option>

												</select>


											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Bank</label>

												<select id="bank_id" name="bank_id" class="form-control">

															<option value="">Loan With Bank</option>

															<?php foreach($bank as $bank):?>
	    													<option value="<?php echo $bank['bank_id'];?>" <?php if(isset($_POST['bank_id'])){
	    													if($_POST['bank_id'] == $bank['bank_id']){ echo 'Selected';}}?>><?php echo $bank['bank_name'];?></option>
	    													<?php endforeach; ?>

														</select>
											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Loan Beneficary</label>

												<select id="loan_beneficary" name="loan_beneficary" class="form-control">	

															<option value="">Beneficary Person</option>

																<?php foreach($loan_ben as $controller):?>
																	<option value="<?php echo $controller['user_id'];?>"<?php if(isset($_POST['loan_beneficary'])){ if($_POST['loan_beneficary'] == $controller['user_id']){ echo 'Selected';}}?>><?php echo $controller['username'];?></option>
	    														<?php endforeach; ?>

															</select>	
											</div>

											<div class="col-lg-2 col-md-12">

												<label>Filter By Loan Type</label>

												<select class="form-control" id="loan_type_id" name="loan_type_id">

																<option value="">Loan Type</option>

																<?php foreach($loan_type as $type):?>
																	<option value="<?php echo $type['loan_type_id'];?>"<?php if(isset($_POST['loan_type_id'])){ if($_POST['loan_type_id'] == $type['loan_type_id']){ echo 'Selected';}}?>><?php echo $type['loan_type'];?></option>
	    														<?php endforeach; ?>

															</select>

											
											</div>

											<div class="col-lg-2 col-md-12">
													<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
													
													<a class="btn btn-primary" href="<?php echo base_url('Loan/view_loan_list/');?>" style="margin-top:24px;width:80px;">Reset</a>
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



													<th class="wd-15p">Bank Name</th>



													<th class="wd-15p">Loan Officer</th>



													<th class="wd-20p">Loan Amount</th>



													<th class="wd-20p">Loan Tenure Start Date</th>



													<th class="wd-20p">Loan Tenure Due Date</th>

													<th class="wd-20p">Download</th>


													<th class="wd-20p">View More</th>


													<th class="wd-20p">Delete</th>


												</tr>



											</thead>



											<tbody>

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


													<td><?= $ln['bank_name'];?></td>



													<td><?= $ln['loan_officer_name'];?></td>



													<td><?= $ln['loan_amount'];?></td>



													<td><?= date("d-m-Y", strtotime($ln['start_date']));?></td>



													<td><?= date("d-m-Y", strtotime($ln['end_date']));?></td>

													<td><a class="btn btn btn-success" href="<?php echo base_url('loan/download_uploaded_loan_document/'.base64_encode($ln['loan_id']));?>"><i class="fa fa-download"></i>Download</a></td>



													<td><a class="btn btn btn-info" href="<?php echo base_url('Loan/view_loan_detail/'.base64_encode($ln["loan_id"]));?>"><i class="fe fe-plus mr-2"></i> View More</a></td>


												<td><a class="btn btn-danger" href="<?php echo base_url('Loan/delete_loan_detail/'.base64_encode($ln["loan_id"]));?>" onclick="return confirm('Are You Sure You Want To Delete Loan Detail With Deleting this record Installment Delete is also Deleted.?');"><i class="fa fa-trash"></i> Delete</a></td>


												</tr>

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

		<!--<script type="text/javascript">

	            $("#btn-filter").on("click", function() { debugger

	            	var property = document.getElementById('property_id').value;
	            	var interest_type = document.getElementById('interest_type').value;
	            	var bank_id = document.getElementById('bank_id').value;
	            	var loan_beneficary = document.getElementById('loan_beneficary').value;
	            	var loan_type_id = document.getElementById('loan_type_id').value;

	            	if(property == '' && interest_type == '' && bank_id == '' && loan_beneficary == '' && loan_type_id == ''){
	            			            		("#show_block").show();
	            		alert("please Select Any Field For Filter");
	            		e.preventDefault();

	            	} else {
	            		$("#my_form").attr('action', 'Loan/loan_filter');
	            	}

	            })  	
		</script>-->





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