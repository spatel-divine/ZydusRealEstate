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



								<li class="breadcrumb-item active" aria-current="page">View Legal Details</li>



							</ol><!-- End breadcrumb -->



							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Legal Master",$r)) { ?>

									<a href="<?php echo site_url('Legal/legal_master/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">

										<span>

											<i class="fa fa-plus">Add Legal Details</i>

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

								<?php if($this->session->flashdata('insert_legal')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insert_legal'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('delete_legal')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('delete_legal'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('update_legal')) :?>

								<div class="alert alert-success alert-dismissable">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('update_legal'); ?>
                                </div>
      							
    						<?php endif;?> 





							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Legal Lists</div>



								</div>



								<div class="card-body">

									<?php $access = explode(",",$prop_access);?>

									<?php echo form_open('Legal/legal_filter/',array("method"=>"POST")); ?>		
										<div class="form-group">
											<div class="row">
												<div class="col-lg-4 col-md-12">

													<label>Filter By Property Name</label>



														<select name="property_id" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):
																$property_id[] = $prop['property_id'];	
																$common_access = array_intersect($access,$property_id);
																?>
																<?php foreach($access as $acc){if($acc == $prop['property_id']) { ?>

	    															<option value="<?php echo $prop['property_id'];?>" <?php if($_POST['property_id'] == $prop['property_id']){ echo 'Selected';}?>><?php echo $prop['property_name'];?></option>
	    														<?php }} ?>	
	    													<?php endforeach; ?>

														</select>

													
												</div>

												<div class="col-lg-3 col-md-12">

													<label>Filter By Case Type</label>

													<select id="case_type" name="case_type" class="form-control">

															<option value="">Case Type</option>

															<option vlaue="Civil" <?php if($_POST['case_type'] == "Civil"){ echo 'Selected';}?>
															>Civil</option>

															<option vlaue="Criminal" <?php if($_POST['case_type'] == "Criminal"){ echo 'Selected';}?>
															>Criminal</option>

														</select>

													
												</div>

												<div class="col-lg-3 col-md-12">

													<label>Filter By Court & Authority Details</label>																						

															<select name="court_authority_id" class="form-control">

															<option value="">Choose Court & Authority</option>

															<?php foreach($court_authority as $court):?>
																		<option value="<?php echo $court['legal_authority_id'];?>" <?php if($_POST['court_authority_id'] == $court['legal_authority_id']){ echo 'Selected';}?>><?php echo $court['legal_court_authority'];?></option>
		    														<?php endforeach; ?>

														</select>										
													
												</div>

												<div class="col-lg-2 col-md-12">
														<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
														
														<a class="btn btn-primary" href="<?php echo base_url('Legal/view_legal_master/');?>" style="margin-top:24px;width:80px;">Reset</a>	
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

													<th class="wd-15p">Case Number</th>


													<th class="wd-15p">Case By</th>



													<th class="wd-15p">Case Against</th>



													<th class="wd-20p">Police Station</th>



													<th class="wd-20p">Case Type</th>


													<th class="wd-20p">Case Registred Date</th>



													<th class="wd-20p">View More</th>



													<th class="wd-20p">Delete</th>



												</tr>



											</thead>



											<tbody>

												 <?php  if(!empty($legal))
                             					 {
                              						$count = 1;

                              	 					foreach ($legal as $legal){

                              	 						$property_id[] = $legal['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $legal['property_id']){ 

                              	 				?>


												<tr>



												<td><?= $count;?></td>



												<td><?= $legal['property_name'];?></td>

												<td><?= $legal['case_number'];?></td>


											    <td><?php foreach($case_by as $by) {
															if($by['legal_id'] === $legal['legal_id']){
																?>




	                													<?= $by['case_by_contact_person'].",";?>
                										<?php }} ?>
                													</td>



													<td><?php foreach($case_against as $against) {
															if($against['legal_id'] === $legal['legal_id']){
																?>




	                													<?= $against['case_against_contact_person'].",";?>
                										<?php }} ?></td>



													<td><?= $legal['police_station_name'];?></td>



													<td><?= $legal['case_type'];?></td>

													<td><?= date("d-m-Y", strtotime($legal['case_registered_date']));?></td>



													<td><a class="btn btn-info" href="<?php echo base_url('Legal/view_legal_data/'.base64_encode($legal["legal_id"]));?>"><i class="fe fe-plus mr-2"></i> View More</a></td>


													<td><a class="btn btn-danger" href="<?php echo base_url('Legal/delete_legal_detail/'.base64_encode($legal["legal_id"]));?>" onclick="return confirm('Are You Sure You Want To Delete Legal Detail? Deleting Legal Data Hearing and Externel Opinion Data for Particular Legal Data Will be Deleted');"><i class="fa fa-trash"></i> Delete</a></td>



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