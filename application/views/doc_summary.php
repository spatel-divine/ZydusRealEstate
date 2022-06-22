<!doctype html>



<html lang="en" dir="ltr">



	<head>



		<!-- Favicon -->



		<link rel="icon" href="<?=base_url();?>assets/images/brand/favicon.ico" type="image/x-icon"/>



		<link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>assets/images/brand/favicon.ico" />


		<title>Zydus

		</title>

		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">


		<link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" />

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



			<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />







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



								<li class="breadcrumb-item active" aria-current="page">Document Summary</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Document Summary",$r)) { ?>

										<a href="<?php echo site_url('Document/upload_document/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Upload Document">

										<span>
											<i class="fa fa-plus">Upload Document</i>
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



							<div class="col-md-12">


								<?php if($this->session->flashdata('document_upload')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('document_upload'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('check_property_upload')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('check_property_upload'); ?>
                                </div>
      							
    						<?php endif;?> 






								<div class="card">



									<div class="card-header pb-0">



										<h3 class="mb-0 card-title">View Document Summary Details</h3>



									</div>



									<div class="card-body">

										<?php echo form_open('Document/document_summary_filter/',array("method"=>"POST","id"=>"form-filter")); ?>	

									<div class="form-group">

										<div class="row">

											<div class="col-lg-10 col-md-12">

												<?php $access = explode(",",$prop_access);?>

												<label>Filter By Property</label>

												<select id="property_name" name="property_name" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):
																$property_id[] = $prop['property_id'];	
																$common_access = array_intersect($access,$property_id);
																?>

																<?php foreach($access as $acc){if($acc == $prop['property_id']) { ?>
																
	    															<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_name')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    														<?php }} ?>
	    													<?php  endforeach; ?>
	    													

														</select>

											</div>

											<div class="col-lg-2 col-md-12">
													<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
													
													<a class="btn btn-primary" href="<?php echo base_url('Document/document_summary/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>


										</div>

									</div>
								</form>		



								<div class="form-group">



									<div class="row">



							<div class="col-md-12 col-lg-12">



							<div class="card">



								<div class="card-header pb-0">



									<div><h4><b>Uploaded Document Summary</b></h4></div>



								</div>



								<div class="card-body">



                                	<div class="table-responsive">



										<table id="example1" class="table table-striped table-bordered text-wrap w-100">

											<!--Case ACcroding Property Selection-->



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>

													<th class="wd-15p">Property Name</th>



													<th class="wd-15p">Document Name</th>



													<th class="wd-15p">Complusory</th>



													<th class="wd-15p">Document Number</th>



													<th class="wd-15p">Renewal Date</th>

													<th class="wd-15p">State</th>



													<th class="wd-15p">View More</th>



													<th class="wd-15p">Download</th>



												</tr>



											</thead>



											<tbody>


												 <?php  if(!empty($document_summary))
                             					 {
                              						$count = 1;

                              	 					foreach ($document_summary as $doc){

                              	 						$property_id[] = $doc['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $doc['property_id']){ 	



                              	 				?>




												<tr>



													<td><?= $count;?></td>

													<?php if(!empty($doc['property_name'])){ ?>

													 <td><?= $doc['property_name'];?></td>
													<?php } else {?>
														 <td>-</td>
													<?php } ?>

												   <td><?= $doc['document_name'];?></td>

													 <td><?= $doc['document_nature'];?></td>

													 <?php if(!empty($doc['document_number'])){ ?>


													<td><?= $doc['document_number'];?></td>	
													<?php } else {?>
														 <td>-</td>
													<?php } ?>

													<?php if(!empty($doc['renewal_date'])){ ?>


													<td><?= date("d-m-Y", strtotime($doc['renewal_date']));?></td>
													<?php } else {?>
														 <td>-</td>
													<?php } ?>	

													<td><?= $doc['document_state'];?></td>

													<?php if(!empty($doc['upload_document_id'])) {?>
													<td><a class="btn btn-info" href="<?php echo base_url('Document/view_document_summary_data/'.base64_encode($doc["upload_document_id"]));?>"><i class="fa fa-view"></i> View Details</a></td>
												<?php } else {?>

												<td><a class="btn btn-info" style="color:white;width:100%">No Details</a></td>
												<?php } ?>

												<?php if(!empty($doc['upload_document_id'])) {?>

													<td><a class="btn btn-success" href="<?php echo base_url('document/download_document/'.base64_encode($doc['upload_document_id']));?>"><i class="fa fa-download"></i> Download</a></td>

													<?php } else {?>

												<td><a class="btn btn-success" style="color:white;">No Document</a></td>
												<?php } ?>

												</tr>


												<?php  $count++;}}}} ?>


											</tbody>

											

										</table>



									</div>



                                </div>



								<!-- table-wrapper -->



							</div>
							 <?php  if(!empty($document_summary1)){ ?>
								<div class="card">



									<div class="card-header pb-0">



										<div><h4><b>Pending Document Upload</b></h4></div>



									</div>



									<div class="card-body">



	                                	<div class="table-responsive">



											<table id="example" class="table table-striped table-bordered text-wrap w-100">



												<thead>



													<tr>



														<th class="wd-15p">SR No</th>

														<th class="wd-15p">Property Name</th>



														<th class="wd-15p">Document Name</th>



														<th class="wd-15p">Complusory</th>



														<th class="wd-15p">Document Number</th>



														<th class="wd-15p">Renewal Date</th>

														<th class="wd-15p">State</th>



														<th class="wd-15p">View More</th>



														<th class="wd-15p">Download</th>

														<th class="wd-15p">Upload Doc</th>



													</tr>



												</thead>



												
												<tbody>

													 <?php  if(!empty($document_summary1))
	                             					 {
	                             					 	$count1 = 1;

	                              	 					foreach ($document_summary1 as $doc){

	                              	 				?>




													<tr>



														<td><?= $count1;?></td>

														
															 <td>-</td>

													   <td><?= $doc['document_name'];?></td>

														 <td><?= $doc['document_nature'];?></td>

														 
															 <td>-</td>
														
															 <td>-</td>

															  <td><?= $doc['document_state'];?></td>
														
													<td><a class="btn btn-info" style="color:white;width:100%">No Summary</a></td>
													
													<td><a class="btn btn-success" style="color:white;">No Document</a></td>

													<td>

														<?php foreach($fin_status as $fin){ if($fin['financial_status'] !== "Sold"){?>

															<a class="btn btn-primary" style="color:white;" href="<?php echo site_url('Document/upload_document/')?>">Upload Doc</a>

														<?php } else { ?>
															<a class="btn btn-success" style="color:white;" href="#">Sold</a>
														<?php }} ?>		

													</td>
												
													</tr>


													<?php  $count1++;}} ?>


												</tbody>



											</table>



										</div>



	                                </div>



									<!-- table-wrapper -->



								</div>

							<?php } ?>




							<!-- section-wrapper -->



							</div>



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

		<!-- Data tables js-->



		<script src="<?=base_url();?>assets/plugins/datatable/jquery.dataTables.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable-2.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.responsive.min.js"></script>











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



