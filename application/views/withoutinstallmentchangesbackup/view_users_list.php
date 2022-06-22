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

		<!-- File Uploads css-->



        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />



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

								<li class="breadcrumb-item active" aria-current="page">View User Details</li>

							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("Users Master",$r)) { ?>
									<a href="<?php echo site_url('Users/add_user/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">
										<span>
											<i class="fa fa-plus">Add User Details</i>
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

								<?php if($this->session->flashdata('user')) :?>

								<div class="alert alert-success alert-dismissable">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('user'); ?>
                                </div>
      							
    						<?php endif;?> 

    							<?php if($this->session->flashdata('user_delete')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('user_delete'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('user_update')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('user_update'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('upload_document')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('upload_document'); ?>
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

									<div class="card-title">User Lists</div>

								</div>

								<div class="card-body">

									<?php echo form_open('Users/user_filter/',array("method"=>"POST","id"=>"form-filter")); ?>	

									<div class="form-group">

										<div class="row">

											<div class="col-lg-10 col-md-12">

												<label>Filter By User Type</label>

												<select class="form-control" name="user_type">	
														<option value="">Choose User Type</option>						

															<?php foreach($user_types as $user_type):?>
			    													<option value="<?php echo $user_type['user_type_id'];?>" <?php echo (set_value('user_type')== $user_type['user_type_id'])?" selected=' selected'":""?>><?php echo $user_type['user_type'];?></option>
			    											<?php endforeach; ?>
    											</select>

											</div>

											<div class="col-lg-2 col-md-12">
													<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
													
													<a class="btn btn-primary" href="<?php echo base_url('Users/view_user/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>


										</div>

									</div>
								</form>		

                                	<div class="table-responsive">

										<table id="example" class="table table-striped table-bordered text-wrap w-100">

											<thead>

												<tr>

													<th class="wd-15p">SR No</th>


													<th class="wd-15p">Name</th>

													<th class="wd-15p">User Type</th>

													<th class="wd-15p">Email</th>

													<th class="wd-15p">Mobile Number</th>

													<th>Document Upload</th>

													<!--<th class="wd-20p">State</th>-->

													<th class="wd-20p">View More</th>

													<th class="wd-20p">Edit</th>

													<th class="wd-20p">Delete</th>

												</tr>

											</thead>


											<tbody>


											 <?php  if(!empty($users))
				                              {
				                              	$count = 1;

				                              	 foreach ($users as $user){
				                              	 	?>


												<tr>

													<td><?= $count;?></td>


													<td><?= $user['username'];?></td>

													<td><?= $user['user_type'];?></td>

													<td><?= $user['email'];?></td>

													<td><?= $user['mobileno'];?></td>

													<td><a class="btn btn-primary" href="<?php echo base_url('Users/user_document_upload/'.base64_encode($user["user_id"]));?>"><i class="fa fa-edit"></i> Document Upload</a></td>

													<td><a class="btn btn btn-info" href="<?php echo base_url('Users/view_user_detail/'.base64_encode($user["user_id"]));?>"><i class="fe fe-plus mr-2"></i> View More</a></td>

													<td><a class="btn btn-primary" href="<?php echo base_url('Users/edit_user_detail/'.base64_encode($user["user_id"]));?>"><i class="fa fa-edit"></i> Edit</a></td>

													<td><a class="btn btn-danger" href="<?php echo base_url('Users/delete_user_detail/'.base64_encode($user["user_id"]));?>" onclick="return confirm('Are You Sure You Want To Delete User');"><i class="fa fa-trash"></i> Delete</a></td>

												</tr>


												<?php $count++;}}?>
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

		<!-- File uploads js -->



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>



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