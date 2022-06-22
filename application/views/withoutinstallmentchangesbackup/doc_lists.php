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



			<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />







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



								<li class="breadcrumb-item active" aria-current="page">Document Lsits</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("Document Master",$r)) { ?>
									<a href="<?php echo site_url('Document/document_master/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">
										<span>
											<i class="fa fa-plus">Add Document Details</i>
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





						<div class="row">



							<div class="col-md-12 col-lg-12">

								<?php if($this->session->flashdata('add_document')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('add_document'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('document_delete')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('document_delete'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('document_update')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('document_update'); ?>
                                </div>
      							
    						<?php endif;?> 



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Document List Details</div>



								</div>



								<div class="card-body">

									<?php echo form_open('Document/document_filter/',array("method"=>"POST","id"=>"form-filter")); ?>	

									<div class="form-group">

										<div class="row">

											<div class="col-lg-5 col-md-12">

												<label>Filter By Document Type</label>

												<select class="form-control" name="document_type">

															<option value="">Choose Document Type</option>

															<?php foreach($document_type as $type):?>
	    														<option value="<?php echo $type['document_type_id'];?>" <?php echo (set_value('document_type')== $type['document_type_id'])?" selected=' selected'":""?>><?php echo $type['document_type'];?></option>
	    													<?php endforeach; ?>

												</select>

											</div>

											<div class="col-lg-5 col-md-12">

												<label>Filter By Document Nature</label>

												<select class="form-control" name="document_nature">

															<option value="">Choose Document Nature</option>

															<option value="Compulsory" <?php echo (set_value('document_nature')== 'Compulsory')?" selected=' selected'":""?>>Compulsory</option>

															<option value="Not complsoury" <?php echo (set_value('document_nature')== 'Not complsoury')?" selected=' selected'":""?>>Not complsoury</option>

														</select>
											</div>

											<div class="col-lg-2 col-md-12">
													<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
													
													<a class="btn btn-primary" href="<?php echo base_url('Document/document_list/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>


										</div>

									</div>
								</form>	



                                	<div class="table-responsive">



										<table id="example" class="table table-striped table-bordered text-nowrap w-100">



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>



													<th class="wd-15p">Document Name</th>



													<th class="wd-15p">Document Type</th>

													<th class="wd-15p">Document Nature</th>

													<th class="wd-15p">State</th>

													<th class="wd-15p">Renewal</th>

													<th class="wd-20p">Edit</th>

													<th class="wd-20p">Delete</th>



												</tr>



											</thead>



											<tbody>
												 <?php  if(!empty($document))
                             					 {
                              						$count = 1;

                              	 					foreach ($document as $doc){
                              	 						
                              	 				?>



												<tr>


												   <td><?= $count;?></td>
												   <td><?= $doc['document_name'];?></td>
													<td><?= $doc['document_type'];?></td>

													<td><?= $doc['document_nature'];?></td>

													<td><?= $doc['document_state'];?></td>

													<td><?= $doc['document_renewal'];?></td>

													<td>

													<?php 

														if($doc['code_count'] >= 1){

														?>
														 <a class="btn btn-danger" href="#" style="width: 100%;">Edit N/A</a>
													<?php } else { ?>

														 <a class="btn btn-primary" href="<?php echo base_url('Document/edit_document_detail/'.base64_encode($doc["document_id"]));?>" style="width:100%;"><i class="fa fa-edit"></i> Edit</a>

													<?php  } ?>	

													</td>

													<td><a class="btn btn-danger" href="<?php echo base_url('Document/delete_document_detail/'.base64_encode($doc["document_id"]));?>" onclick="return confirm('Are You Sure You Want To Delete Document Detail? If you delete document detail with this uploaded document will also deleted.');"><i class="fa fa-trash"></i> Delete</a></td>



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





			<!-- Data tables js-->



		<script src="<?=base_url();?>assets/plugins/datatable/jquery.dataTables.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable-2.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.responsive.min.js"></script>







		<!--MutipleSelect js-->



		<script src="<?=base_url();?>assets/plugins/multipleselect/multiple-select.js"></script>



		<script src="<?=base_url();?>assets/plugins/multipleselect/multi-select.js"></script>







		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>







	</body>



</html>



