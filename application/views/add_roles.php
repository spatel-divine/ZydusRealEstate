<!doctype html>

<html lang="en" dir="ltr">

	<head>

		<!-- Favicon -->

		<link rel="icon" href="<?=base_url();?>assets/images/brand/favicon.ico" type="image/x-icon"/>

		<link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>assets/images/brand/favicon.ico" />





		<!-- Title -->

		<title>Zydus
		</title>



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



		<!--Select2 css -->

		<link href="<?=base_url();?>assets/plugins/select2/select2.min.css" rel="stylesheet" />



		<!-- Time picker css-->

		<link href="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />



		<!-- Date Picker css-->

		<link href="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.css" rel="stylesheet" />



		<!-- File Uploads css-->

        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />



		<!--Mutipleselect css-->

		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/multipleselect/multiple-select.css">



		<!-- Color-skins css -->

		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />

		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>
		<link href="<?=base_url();?>assets/css/flex-tree.min.css" rel="stylesheet">

	</head>



	<body class="app sidebar-mini">



		<!--Global-Loader-->

		<div id="global-loader">

			<img src="<?=base_url();?>assets/images/brand/icon.png" alt="loader">

		</div>



		<div class="page">

			<div class="page-main">

				<?php include('header.php'); ?>

				<!--/app-header-->

				<!-- Sidebar menu-->

				<?php include('sidebar.php'); ?>


				<div class="app-content  my-3 my-md-5">

					<div class="side-app">



						<!-- page-header -->

						<div class="page-header">

							<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="#">Pages</a></li>

								<li class="breadcrumb-item active" aria-current="page">Add New Role</li>

							</ol><!-- End breadcrumb -->

							<!--<div class="ml-auto">
								<div class="input-group">

									<a href="<?php echo site_url('Users/view_user/')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Users">
										<span>
											View All Users
										</span>
									</a>

								</div>
							</div>-->

						</div>

						<!-- End page-header -->

						<?php if($this->session->flashdata('add_role')) :?>

								<div class="alert alert-success alert-dismissable">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('add_role'); ?>
                                </div>
      							
    							<?php endif;?> 



						<!-- row -->

						<div class="row">

							<div class="col-md-12">

								<div class="card">

									<div class="card-header pb-0">

										<h3 class="mb-0 card-title">Add New Roles</h3>

									</div>

									<div class="card-body">
										 <?php echo form_open('Admin/add_roles',array("method"=>"POST")); ?>


										<div class="form-group">
											<div class="row">				
												<div class="col-lg-6 col-md-12">
													<label>Username</label>
													<input type="text" class="form-control" name="username" placeholder="Enter User Name" value="<?php echo set_value('username');?>">
													<font color="red"><?=form_error("username");?></font>

												</div>
												<div class="col-lg-6 col-md-12">
													<label>Password</label>
													<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php echo set_value('password');?>">
													<font color="red"><?=form_error("password");?></font> 
												</div>
												
											</div>
										</div>	

										<div class="form-group">
											<div class="row">				
												<div class="col-lg-4 col-md-12">
													<label>Role Name</label>
													<input type="text" class="form-control" name="role_name" placeholder="Enter Role Name"  value="<?php echo set_value('role_name');?>">
													<font color="red"><?=form_error("role_name");?></font>
												</div>
												<div class="col-lg-2 col-md-12">
													<label>Menu Access Selection</label>
														<div id="flex-tree-check"></div>
														<font color="red"><?=form_error("foo[]");?></font>
												</div>
	
												<?php $checkarray = []; foreach($role_names as $rn){?>

												<span><?php $checkarray[] = $rn; ?></span>

												<?php } ?>	

												<div class="col-lg-3 col-md-12">
													<label>Property Group</label>
													<select multiple id="property_group" name="property_group" class="form-control" style="height:300px">
															<?php foreach($property_group as $group):?>
	    													<option value="<?php echo $group['property_group_id'];?>" <?php echo  set_select('property_group', $group['property_group_id']); ?>><?php echo $group['property_group'];?></option>
	    													<?php endforeach; ?>

														</select>

														<input type="hidden" name="group_id_append" id="group_id_append" value="">

															<font color="red"><?=form_error("property_group");?></font>						
											    </div>


											<div class="col-lg-3 col-md-12">
													<label>Property Access</label>

														<select id="property_name" name="property_name[]" class="form-control" multiple style="height:300px">

															

														</select>

															<font color="red"><?=form_error("property_name[]");?></font>						
                                       <span style="color:red;">Note : Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</span>
											</div>

										</div>
									</div>								

												
				                                 <input type="submit" class="btn btn-primary float-right" value="Submit" name="submit" id="submit">

											


										</div>

									</div>

								</div>


							</div>

						</div>


					
						

						</div>

						



					</div>



				<?php include('right_sidebar.php'); ?>



					<!--footer-->

				<?php include('footer.php');?>

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

		<script src="<?=base_url();?>assets/js/flex-tree.min.js"></script>



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



		<!-- Rightsidebar js -->

		<script src="<?=base_url();?>assets/plugins/sidebar/sidebar.js"></script>



		<!-- File uploads js -->

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>



		<!--Select2 js -->

		<script src="<?=base_url();?>assets/plugins/select2/select2.full.min.js"></script>

		<script src="<?=base_url();?>assets/js/select2.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>



		<!--Time Counter js-->

		<script src="<?=base_url();?>assets/plugins/counters/jquery.missofis-countdown.js"></script>

		<script src="<?=base_url();?>assets/plugins/counters/counter.js"></script>



		<!-- Timepicker js -->

		<script src="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.js"></script>

		<script src="<?=base_url();?>assets/plugins/time-picker/toggles.min.js"></script>



		<!-- Datepicker js -->

		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>

		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>

		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>



		<!--MutipleSelect js-->

		<script src="<?=base_url();?>assets/plugins/multipleselect/multiple-select.js"></script>

		<script src="<?=base_url();?>assets/plugins/multipleselect/multi-select.js"></script>



		<!-- Custom js-->

		<script src="<?=base_url();?>assets/js/custom.js"></script>


		<script>
$(document).ready(function(){
  jQuery('#flex-tree-check').flexTree({
  type: 'checkbox',
  name: 'foo[]',
  collapsed: true,
  items: [
  {
    label: 'Users',
    childrens: [
	    {
	      label: 'Users Master',
	      value: 'Users Master',
	      checked:'<?php if(in_array("Users Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Users List',
	      value: 'View Users List',
	      checked:'<?php if(in_array("View Users List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'User Type Master',
	      value: 'User Type Master',
	      checked:'<?php if(in_array("User Type Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Set Roles',
	      value: 'Set Roles',
	      checked:'<?php if(in_array("Set Roles", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'View Roles',
	      value: 'View Roles',
	      checked:'<?php if(in_array("View Roles", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Unblocked Users',
	      value: 'Unblocked Users',
	      checked:'<?php if(in_array("Unblocked Users", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }
	]  
	    
    

 },

 {
    label: 'Properties',
    childrens: [
	    {
	      label: 'Property Master',
	      value: 'Property Master',
	      checked:'<?php if(in_array("Property Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Property List',
	      value: 'View Property List',
	      checked:'<?php if(in_array("View Property List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'Property Type Master',
	      value: 'Property Type Master',
	      checked:'<?php if(in_array("Property Type Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Unit Master',
	      value: 'Unit Master',
	      checked:'<?php if(in_array("Unit Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Land Type Master',
	      value: 'Land Type Master',
	      checked:'<?php if(in_array("Land Type Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Property Jurisdiction Master',
	      value: 'Property Jurisdiction Master',
	      checked:'<?php if(in_array("Property Jurisdiction Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Property Status Master',
	      value: 'Property Status Master',
	      checked:'<?php if(in_array("Property Status Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Property Financial Status Master',
	      value: 'Property Financial Status Master',
	      checked:'<?php if(in_array("Property Financial Status Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {

	      label: 'Fixed Expense Type',
	      value: 'Fixed Expense Type',
	      checked:'<?php if(in_array("Fixed Expense Type", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },


	{

	      label: 'Property Group Master',
	      value: 'Property Group Master',
	      checked:'<?php if(in_array("Property Group Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	]  
	    
    

 },

 {
    label: 'Document',
    childrens: [
	    {
	      label: 'Document Master',
	      value: 'Document Master',
	      checked:'<?php if(in_array("Document Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Document Lists',
	      value: 'Document Lists',
	      checked:'<?php if(in_array("Document Lists", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'Document Type Master',
	      value: 'Document Type Master',
	      checked:'<?php if(in_array("Document Type Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Document Summary',
	      value: 'Document Summary',
	      checked:'<?php if(in_array("Document Summary", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Document Authority',
	      value: 'Document Authority',
	      checked:'<?php if(in_array("Document Authority", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'List of Renewals',
	      value: 'List of Renewals',
	      checked:'<?php if(in_array("List of Renewals", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	]  
	    
    

 },

 {
    label: 'Loan',
    childrens: [
	    {
	      label: 'Loan Master',
	      value: 'Loan Master',
	      checked:'<?php if(in_array("Loan Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Loan List',
	      value: 'View Loan List',
	      checked:'<?php if(in_array("View Loan List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'View Loan Installments',
	      value: 'View Loan Installments',
	      checked:'<?php if(in_array("View Loan Installments", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Loan Type Master',
	      value: 'Loan Type Master',
	      checked:'<?php if(in_array("Loan Type Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Bank Master',
	      value: 'Bank Master',
	      checked:'<?php if(in_array("Bank Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'Loan Officer Master',
	      value: 'Loan Officer Master',
	      checked:'<?php if(in_array("Loan Officer Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	]  
	    
    

 },

 {
    label: 'Lease',
    childrens: [
	    {
	      label: 'Rent Payable',
	      value: 'Rent Payable',
	      checked:'<?php if(in_array("Rent Payable", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Rent Payable List',
	      value: 'View Rent Payable List',
	      checked:'<?php if(in_array("View Rent Payable List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'Rent Payable Installments',
	      value: 'Rent Payable Installments',
	      checked:'<?php if(in_array("Rent Payable Installments", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Rent Payable Contract Status Master',
	      value: 'Rent Payable Contract Status Master',
	      checked:'<?php if(in_array("Rent Payable Contract Status Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Rent Receivable',
	      value: 'Rent Receivable',
	      checked:'<?php if(in_array("Rent Receivable", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Rent Receivable List',
	      value: 'View Rent Receivable List',
	      checked:'<?php if(in_array("View Rent Receivable List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'Rent Receivable Installments',
	      value: 'Rent Receivable Installments',
	      checked:'<?php if(in_array("Rent Receivable Installments", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Rent Receivable Contract Status Master',
	      value: 'Rent Receivable Contract Status Master',
	      checked:'<?php if(in_array("Rent Receivable Contract Status Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	]  
	    
    

 },

 {
    label: 'Legal',
    childrens: [
	    {
	      label: 'Legal Master',
	      value: 'Legal Master',
	      checked:'<?php if(in_array("Legal Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Legal Master',
	      value: 'View Legal Master',
	      checked:'<?php if(in_array("View Legal Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'Hearing Master',
	      value: 'Hearing Master',
	      checked:'<?php if(in_array("Hearing Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Hearing List',
	      value: 'View Hearing List',
	      checked:'<?php if(in_array("View Hearing List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Upcoming Hearing',
	      value: 'Upcoming Hearing',
	      checked:'<?php if(in_array("Upcoming Hearing", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'External Opinion Master',
	      value: 'External Opinion Master',
	      checked:'<?php if(in_array("External Opinion Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'View External Opinion',
	      value: 'View External Opinion',
	      checked:'<?php if(in_array("View External Opinion", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Case By Master',
	      value: 'Case By Master',
	      checked:'<?php if(in_array("Case By Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Case Against Master',
	      value: 'Case Against Master',
	      checked:'<?php if(in_array("Case Against Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {
	      label: 'Police Station Master',
	      value: 'Police Station Master',
	      checked:'<?php if(in_array("Police Station Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },

	    {
	      label: 'Court & Authority Master',
	      value: 'Court & Authority Master',
	      checked:'<?php if(in_array("Court & Authority Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Case Status Master',
	      value: 'Case Status Master',
	      checked:'<?php if(in_array("Case Status Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	]  
	    
    

 },

  {
    label: 'Insurance',
    childrens: [
	    {
	      label: 'Insurance Master',
	      value: 'Insurance Master',
	      checked:'<?php if(in_array("Insurance Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Insurance List',
	      value: 'View Insurance List',
	      checked:'<?php if(in_array("View Insurance List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'List of Renewal',
	      value: 'List of Renewal',
	      checked:'<?php if(in_array("List of Renewal", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Claim Master',
	      value: 'Claim Master',
	      checked:'<?php if(in_array("Claim Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'View Claim List',
	      value: 'View Claim List',
	      checked:'<?php if(in_array("View Claim List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Insurance Company',
	      value: 'Insurance Company',
	      checked:'<?php if(in_array("Insurance Company", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'Insurance Type',
	      value: 'Insurance Type',
	      checked:'<?php if(in_array("Insurance Type", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	]      

 },

   {
    label: 'Income',
    childrens: [
	    {
	      label: 'Income Master',
	      value: 'Income Master',
	      checked:'<?php if(in_array("Income Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Income Type Master',
	      value: 'Income Type Master',
	      checked:'<?php if(in_array("Income Type Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'View Income List',
	      value: 'View Income List',
	      checked:'<?php if(in_array("View Income List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Recurring Income List',
	      value: 'Recurring Income List',
	      checked:'<?php if(in_array("Recurring Income List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	]      

 },


   {
    label: 'Expense',
    childrens: [
	    {
	      label: 'Expense Master',
	      value: 'Expense Master',
	      checked:'<?php if(in_array("Expense Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Expense Type Master',
	      value: 'Expense Type Master',
	      checked:'<?php if(in_array("Expense Type Master", $checkarray)) { echo true; } else { echo false; }  ?>',
	    }  ,

	    {

	      label: 'View Expense List',
	      value: 'View Expense List',
	      checked:'<?php if(in_array("View Expense List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	    {
	      label: 'Recurring Expense List',
	      value: 'Recurring Expense List',
	      checked:'<?php if(in_array("Recurring Expense List", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	]      

 },

    {
    label: 'Log',
    childrens: [
	    {
	      label: 'View Log',
	      value: 'View Log',
	      checked:'<?php if(in_array("View Log", $checkarray)) { echo true; } else { echo false; }  ?>',
	    },
	   
	]      

 },

] });

  	})

  </script>

  		<script type="text/javascript">
        $(document).ready(function(){
 			var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    		csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
 			$('#property_group').val("");
 			$('#property_group').change(function(){
                var id=$(this).val();
                var group_id = $("#group_id_append").val();
                concat_data_id = id+","
                var join_data = concat_data_id.concat(group_id);
                $('#group_id_append').val(join_data);

                $.ajax({
                    url : "<?php echo site_url('Admin/get_property_by_group');?>",
                    method : "POST",
                    data : {[csrfName]: csrfHash,id: id},
                    async : false,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;

                        //$("#bydefault_property").css("display", "none");
								//$("#property_by_group_id").css("display", "block");
								$("#property_group option[value="+id+"]").remove();
                        for(i=0; i<data.length; i++){
                           $('#property_name').append( '<option value='+data[i].property_id+'>'+data[i].property_name+'</option>');
                        }
 
                    }
                });
                return false;
            });     
        });
    </script>          	
	</body>

</html>

