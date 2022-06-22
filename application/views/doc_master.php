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



								<li class="breadcrumb-item active" aria-current="page">Add Document</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("Document Lists",$r)) { ?>
									<a href="<?php echo site_url('Document/document_list/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Document List">
										<span>
											View All Document List
										</span>
									</a>
								 <?php } ?>
								</div>
							</div>


							


						</div>



						<!-- End page-header -->


							<?php if($this->session->flashdata('add_document')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('add_document'); ?>
                                </div>
      							
    						<?php endif;?> 




						<!-- row -->



						<div class="row">



							<div class="col-md-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="mb-0 card-title">Add Document Details</h3>



									</div>



									<div class="card-body">

											<?php echo form_open('Document/document_master_insert',array("method"=>"POST")); ?>


										<div class="row">



											<div class="col-md-12">





												<div class="form-group">



													<label>Document Name</label>

													<input type="text" class="form-control" name="document_name" placeholder="Document Name" value="<?php echo set_value('document_name');?>">
														<font color="red"><?=form_error("document_name");?></font>



												</div>





											</div>



                                            <div class="col-md-12">



												<div class="form-group">

													<label>Document Type</label>



														<select class="form-control" name="document_type" id="document_type">

															<option value="">Choose Document Type</option>

															<?php foreach($document_type as $type):?>
	    													<option value="<?php echo $type['document_type_id'];?>" <?php echo (set_value('document_type')== $type['document_type_id'])?" selected=' selected'":""?>><?php echo $type['document_type'];?></option>
	    											<?php endforeach; ?>

														</select>
														<font color="red"><?=form_error("document_type");?></font>


                                                 </div>



                                            </div>







											<div class="col-md-12">					 		



												<div class="form-group">



													<label>Document Nature</label>



														<select class="form-control" name="document_nature" id="document_nature">

															<option value="">Choose Document Nature</option>

															<option value="Compulsory" <?php echo (set_value('document_nature')== 'Compulsory')?" selected=' selected'":""?>>Compulsory</option>

															<option value="Not complsoury" <?php echo (set_value('document_nature')== 'Not complsoury')?" selected=' selected'":""?>>Not complsoury</option>

														</select>
														<font color="red"><?=form_error("document_nature");?></font>



												</div>



											</div>


											<div class="col-md-12">					 		

												<div class="form-group">

													<label>Document State</label>

														<select class="form-control" name="document_state" id="document_state">

															<option value="">Choose Document State</option>
															<option value="Andhra Pradesh" <?php echo (set_value('document_state')== 'Andhra Pradesh')?" selected=' selected'":""?>>Andhra Pradesh</option>
															<option value="Andaman and Nicobar Islands" <?php echo (set_value('document_state')== 'AAndaman and Nicobar Islands')?" selected=' selected'":""?>>Andaman and Nicobar Islands</option>
															<option value="Arunachal Pradesh" <?php echo (set_value('document_state')== 'Arunachal Pradesh')?" selected=' selected'":""?>>Arunachal Pradesh</option>
															<option value="Assam" <?php echo (set_value('document_state')== 'Assam')?" selected=' selected'":""?>>Assam</option>
															<option value="Bihar" <?php echo (set_value('document_state')== 'Bihar')?" selected=' selected'":""?>>Bihar</option>
															<option value="Chandigarh" <?php echo (set_value('document_state')== 'Chandigarh')?" selected=' selected'":""?>>Chandigarh</option>
															<option value="Chhattisgarh" <?php echo (set_value('document_state')== 'Chhattisgarh')?" selected=' selected'":""?>>Chhattisgarh</option>
															<option value="Dadar and Nagar Haveli" <?php echo (set_value('document_state')== 'Dadar and Nagar Haveli')?" selected=' selected'":""?>>Dadar and Nagar Haveli</option>
															<option value="Daman and Diu" <?php echo (set_value('document_state')== 'Daman and Diu')?" selected=' selected'":""?>>Daman and Diu</option>
															<option value="Delhi" <?php echo (set_value('document_state')== 'Delhi')?" selected=' selected'":""?>>Delhi</option>
															<option value="Lakshadweep" <?php echo (set_value('document_state')== 'Lakshadweep')?" selected=' selected'":""?>>Lakshadweep</option>
															<option value="Puducherry" <?php echo (set_value('document_state')== 'Puducherry')?" selected=' selected'":""?>>Puducherry</option>
															<option value="Goa" <?php echo (set_value('document_state')== 'Goa')?" selected=' selected'":""?>>Goa</option>
															<option value="Gujarat" <?php echo (set_value('document_state')== 'Gujarat')?" selected=' selected'":""?>>Gujarat</option>
															<option value="Haryana" <?php echo (set_value('document_state')== 'Haryana')?" selected=' selected'":""?>>Haryana</option>
															<option value="Himachal Pradesh" <?php echo (set_value('document_state')== 'Himachal Pradesh')?" selected=' selected'":""?>>Himachal Pradesh</option>
															<option value="Jammu and Kashmir" <?php echo (set_value('document_state')== 'Jammu and Kashmir')?" selected=' selected'":""?>>Jammu and Kashmir</option>
															<option value="Jharkhand" <?php echo (set_value('document_state')== 'Jharkhand')?" selected=' selected'":""?>>Jharkhand</option>
															<option value="Karnataka" <?php echo (set_value('document_state')== 'Karnataka')?" selected=' selected'":""?>>Karnataka</option>
															<option value="Kerala" <?php echo (set_value('document_state')== 'Kerala')?" selected=' selected'":""?>>Kerala</option>
															<option value="Madhya Pradesh" <?php echo (set_value('document_state')== 'Madhya Pradesh')?" selected=' selected'":""?>>Madhya Pradesh</option>
															<option value="Maharashtra" <?php echo (set_value('document_state')== 'Maharashtra')?" selected=' selected'":""?>>Maharashtra</option>
															<option value="Manipur" <?php echo (set_value('document_state')== 'Manipur')?" selected=' selected'":""?>>Manipur</option>
															<option value="Meghalaya" <?php echo (set_value('document_state')== 'Meghalaya')?" selected=' selected'":""?>>Meghalaya</option>
															<option value="Mizoram" <?php echo (set_value('document_state')== 'Mizoram')?" selected=' selected'":""?>>Mizoram</option>
															<option value="Nagaland" <?php echo (set_value('document_state')== 'Nagaland')?" selected=' selected'":""?>>Nagaland</option>
															<option value="Odisha" <?php echo (set_value('document_state')== 'Odisha')?" selected=' selected'":""?>>Odisha</option>
															<option value="Punjab" <?php echo (set_value('document_state')== 'Punjab')?" selected=' selected'":""?>>Punjab</option>
															<option value="Rajasthan" <?php echo (set_value('document_state')== 'Rajasthan')?" selected=' selected'":""?>>Rajasthan</option>
															<option value="Sikkim" <?php echo (set_value('document_state')== 'Sikkim')?" selected=' selected'":""?>>Sikkim</option>
															<option value="Tamil Nadu" <?php echo (set_value('document_state')== 'Tamil Nadu')?" selected=' selected'":""?>>Tamil Nadu</option>
															<option value="Telangana" <?php echo (set_value('document_state')== 'Telangana')?" selected=' selected'":""?>>Telangana</option>
															<option value="Tripura" <?php echo (set_value('document_state')== 'Tripura')?" selected=' selected'":""?>>Tripura</option>
															<option value="Uttar Pradesh" <?php echo (set_value('document_state')== 'Uttar Pradesh')?" selected=' selected'":""?>>Uttar Pradesh</option>
															<option value="Uttarakhand" <?php echo (set_value('document_state')== 'Uttarakhand')?" selected=' selected'":""?>>Uttarakhand</option>
															<option value="West Bengal" <?php echo (set_value('document_state')== 'West Bengal')?" selected=' selected'":""?>>West Bengal</option>

														</select>
														<font color="red"><?=form_error("document_state");?></font>



												</div>



											</div>







                                            <div class="col-md-12">



												<div class="form-group">





                                                  <label>Renewal</label>

													<label class="custom-control custom-radio">

													<input type="radio" class="custom-control-input" name="renewal" value="Yes" <?php echo (set_value('renewal')== "Yes")?" Checked=' Checked'":""?> checked>

													<span class="custom-control-label" style="color:black;" value="<?php echo set_value('renewal');?>">Yes</span>

												</label>

												<label class="custom-control custom-radio">

													<input type="radio" class="custom-control-input" name="renewal" value="No" <?php echo (set_value('renewal')== "No")?" Checked=' Checked'":""?>>

													<span class="custom-control-label" style="color:black;" value="<?php echo set_value('renewal');?>">No</span>

												</label>

												<font color="red"><?=form_error("renewal");?></font>


                                                </div>









										    </div>



										    <div class="col-md-6">

                                                  &nbsp;

										    	</div>







                                             <div class="col-md-6">





												 <input type="submit" name="submit" class="btn btn-primary float-right" value="Submit">



												</div>



											</div>

											</form>

                                           </div>





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



