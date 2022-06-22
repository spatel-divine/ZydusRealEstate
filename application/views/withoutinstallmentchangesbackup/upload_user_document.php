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



		<!--Mutipleselect css-->

		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/multipleselect/multiple-select.css">



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

								<li class="breadcrumb-item active" aria-current="page">Upload User Document</li>

							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("View Users List",$r)) { ?>
									<a href="<?php echo site_url('Users/view_user/')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Users">
										<span>
											View All Users
										</span>
									</a>
								<?php } ?>
								</div>
							</div>

						</div>

						<!-- End page-header -->



						<!-- row -->

						<div class="row">

							<div class="col-md-12">

								<div class="card">

									<div class="card-header pb-0">

										<h3 class="mb-0 card-title">Upload User Document Details</h3>

									</div>

									<div class="card-body">

										<?php foreach($user as $user){ ?>
										 <?php echo form_open_multipart('Users/user_document_upload_redirect/'.$this->uri->segment(3),array("method"=>"POST")); ?>

										 <div class="form-group">



											<div class="row">
												<input type="hidden" name="user_id" class="form-control" value="<?php echo base64_decode($this->uri->segment(3));?>">

												<div class="col-lg-12 col-md-12">

													<h5 style="color:red;">Please Upload Document in Jpg/Jpeg/Png/PDF Format Only.Size Must not Exceed More than 2 MB.</h5>
												</div>
											</div>
									</div>				

										<div class="form-group">



											<div class="row">				



													<div class="col-lg-6 col-md-12">

														<label>Pancard No</label>

														<?php if($this->input->post('submit') && $this->input->post('pancard_no') !== $user['pancard_no']) { ?>

															<input type="text" class="required form-control" name="pancard_no" placeholder="Pan Card Number"  value="<?php echo set_value('pancard_no');?>">

														<?php } else { ?>

															<input type="text" class="required form-control" name="pancard_no" placeholder="Pan Card Number"  value="<?php echo $user['pancard_no'];?>">
														
														<?php } ?>	

														
														<font color="red"><?= form_error('pancard_no');?></font>

													</div>

													<div class="col-lg-6 col-md-12">

														<label>Aadharcard No</label>

														<?php if($this->input->post('submit') && $this->input->post('adharcard_no') !== $user['adharcard_no']) { ?>

															<input type="text" class="required form-control" name="adharcard_no" placeholder="Aadhar card Number"  value="<?php echo set_value('adharcard_no');?>">

														<?php } else { ?>

															<input type="text" class="required form-control" name="adharcard_no" placeholder="Aadhar card Number"  value="<?php echo $user['adharcard_no'];?>">
														
														<?php } ?>	

														
														<font color="red"><?= form_error('adharcard_no');?></font>
													</div>
											</div>			



										</div>


										<div class="form-group">



											<div class="row">	


												<div class="col-lg-6 col-md-12">

						                                            <div class="card">
							                                             <div class="card-header pb-0">
								                                          	<h3 class="mb-0 card-title">Upload Pan card</h3>
							                                             </div>
								                                         <div class="card-body">
										                                      <input type="file" class="form-control dropify" name="pancard"/>				
										                                      <font color="red"><?php $notsuccess = $this->session->flashdata('notsuccess');
 																					if($notsuccess==2) { echo "Image Invalid."; } ?></font>	
								                                          </div>
								                                           
						                                             </div>

													</div>

														<div class="col-lg-6 col-md-12">
					                                                <div class="card">
						                                                <div class="card-header pb-0">
							                                           		<h3 class="mb-0 card-title">Upload Aadhar card</h3>
						                                                </div>
						                                             	<div class="card-body">
									                                         <input type="file" class="form-control dropify"  name="adharcard"/>
									                                         <font color="red"><?php $unsuccess = $this->session->flashdata('unsuccess');
 																			if($unsuccess==1) { echo "Image Invalid"; } ?></font>
							                                            </div>
							                                            
					                                                </div>
														</div>


											</div>			



										</div>

										<div class="form-group">

												<div class="row">

													<div class="preview col-lg-6 col-md-12">
														<?php if(!empty($user['pancard_image'])) {?>
            											<a href="<?php echo base_url('Users/download_pancard/'.base64_encode($user['user_id']));?>"><embed src="<?php echo base_url('/assets/images/uploads/pancard/'.(base64_decode($user['pancard_image'])));?>" width="100%" height="500px"></a>
            											<?php } else { ?>
            												<h4>No Image Found</h4>
            											<?php } ?>	

												
													</div>
													<div class="preview col-lg-6 col-md-12">
														<?php if(!empty($user['adharcard_image'])) {?>
														<a href="<?php echo base_url('Users/download_aadharcard/'.base64_encode($user['user_id']));?>"><embed src="<?php echo base_url('/assets/images/uploads/adharcard/'.(base64_decode($user['adharcard_image'])));?>" width="100%" height="500px"></a>
															<?php } else { ?>
            												<h4>No Image Found</h4>
            											<?php } ?>	
	
													
													</div>

												</div>
										</div>




                                                <input type="submit" class="btn btn-primary float-right" value="Submit" name="submit" id="submit">




											</div>


                                            </form>
                                        <?php } ?>
											


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


	</body>

</html>

