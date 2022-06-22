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

		<!--Daterangepicker css-->



		<link href="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />







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



								<li class="breadcrumb-item active" aria-current="page">List Of Renewals</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">
									<?php $r = explode(",",$roles); if(in_array("Document Summary",$r)) { ?>
									<a href="<?php echo site_url('Document/upload_document/')?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Upload Document">

										<span>
											<i class="fa fa-plus">Upload Document</i>
										</span>

									</a> &nbsp;&nbsp;

								  <?php } ?>

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


						<?php if($this->session->flashdata('select_data')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('select_data'); ?>
                                </div>
      							
    						<?php endif;?> 
					

						<div class="row">



							<div class="col-md-12 col-lg-12">

								<?php if($this->session->flashdata('document_renewal_fail')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('document_renewal_fail'); ?>
                                </div>
      							
    						<?php endif;?> 

    						<?php if($this->session->flashdata('document_renewal_success')) :?>

								<div class="alert alert-success alert-dismissable">
                                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('document_renewal_success'); ?>
                                </div>
      							
    						<?php endif;?> 



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">List Of Renewals</div>



								</div>



								<div class="card-body">

										<?php echo form_open('Document/document_renewal_filter/',array("method"=>"POST")); ?>		
										<div class="form-group">

											<div class="row">

												<div class="col-lg-5 col-md-12">

													<label>Renewal Start Date</label>

													<div class="wd-200 mg-b-30">



														<div class="input-group">



															<div class="input-group-prepend">



																<div class="input-group-text">



																	<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																</div>



															</div>

															<input class="form-control" id="datepicker1" name="renewal_start_date" autocomplete="off" placeholder="Enter Renewal Start Date" type="text" value="<?php echo set_value('renewal_start_date');?>">



														</div>

														<font color="red"><?=form_error("renewal_start_date");?></font>

													</div>

												</div>



												<div class="col-lg-5 col-md-12">

													<label>Renewal End Date</label>

													<div class="wd-200 mg-b-30">



														<div class="input-group">



															<div class="input-group-prepend">



																<div class="input-group-text">



																	<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																</div>



															</div>

															<input class="form-control" id="datepicker2" name="renewal_end_date" autocomplete="off" placeholder="Enter Renewal End Date" type="text" value="<?php echo set_value('renewal_end_date');?>">



														</div>

														<font color="red"><?=form_error("renewal_end_date");?></font>

													</div>

												</div>

												<div class="col-lg-2 col-md-12">
														<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:80px;">
														
														<a class="btn btn-primary" href="<?php echo base_url('Document/document_list_renewals/');?>" style="margin-top:24px;width:80px;">Reset</a>
												</div>


											</div>

										</div>
								 	</form>	
									



                                	<div class="table-responsive">



										<table id="example" class="table table-striped table-bordered text-nowrap w-100">



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>

													<th class="wd-15p">Property Name</th>


													<th class="wd-15p">Document Type</th>



													<th class="wd-15p">Renewal Date</th>



													<th class="wd-15p">Authority</th>



													<th class="wd-15p">Status</th>



													<th class="wd-20p">Renewal Status</th>



												</tr>



											</thead>



											<tbody>

												<?php $access = explode(",",$prop_access);?>

												<?php
												$count = 1;
													foreach ($document_summary as $doc){

														$property_id[] = $doc['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $doc['property_id']){ 	
												?>

												<tr>

												<td><?= $count;?></td>

												<td><?= $doc['property_name'];?></td>

												<td><?= $doc['document_type'];?></td>

												<?php if(!empty($doc['renewal_date'])){?>

												<td><?= date("d-m-Y", strtotime($doc['renewal_date']));?></td>
											<?php } else {?>
												<td><b>Not Available</b></td>
											<?php } ?>

												<td><?= $doc['document_authority'];?></td>

												<?php if(!empty($doc['renewal_date']) AND ($doc['is_renewed'] == 0)){?>

												<td><input type="submit" class="btn btn-yellow" data-toggle="modal" data-target="#exampleModa<?= $count; ?>" name="mark_as" value="Mark Document As Renewed" style="width:100%;"></td>
											<?php } else {?>
												<td><a class="btn btn-success" href="#" style="width:100%;">Renewal Not Required</a></td>
											<?php }?>		

											<?php if(($doc['is_renewed'] == 1)) {?>													
												<td><button class="btn btn-success">Renewed</button></td>
											<?php } else { if(empty($doc['renewal_date'])) { ?>
												<td><button class="btn btn-success">Renewed</button></td>
											<?php } else { ?> <td><button class="btn btn-danger">Pending</button></td> <?php  } }  ?>
												</tr>

												<div class="modal fade" id="exampleModa<?= $count; ?>" tabindex="-1" role="dialog"  aria-hidden="true">



<div class="modal-dialog" role="document">



	<div class="modal-content">

		
<?php echo form_open('Document/markrenew',array("method"=>"POST")); ?>

												<input type="hidden" name="did" value="<?= $doc['upload_document_id']; ?>">
 
		<div class="modal-header">



			<h5 class="modal-title" id="example-Modal3">Mark Document As Renewed </h5>



			<input type="submit" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" value="&times;" name="close">



		</div>


		<div class="modal-body">


				<div class="form-group">



					<div class="row">				



							<div class="col-lg-6 col-md-12">



								<label for="renewal_date" class="form-control-label">
								Property Name:</label>

								<input type="text" class="form-control" name="property_name" placeholder="Enter Property Name" value="<?php echo $doc['property_name']?>" readonly="">

								<input type="hidden" class="form-control" name="document_id" value="<?php echo $doc['document_id']?>">
								<input type="hidden" class="form-control" name="upload_document_id" value="<?php echo $doc['upload_document_id']?>">

							</div>



								<div class="col-lg-6 col-md-12">



								<label for="renewal_date" class="form-control-label">Document Name:</label>



								<input type="text" class="form-control" name="document_name" placeholder="Enter Document Name" value="<?php echo $doc['document_name']?>" readonly="">

							</div>



					</div>			



				</div>

				<div class="form-group">



					<div class="row">				



							<div class="col-lg-6 col-md-12">



								<label for="renewal_date" class="form-control-label">
								Document For:</label>

								<input type="text" class="form-control" name="document_for" placeholder="Enter Document For" value="<?php echo $doc['document_for']?>" readonly="">

							</div>



								<div class="col-lg-6 col-md-12">



								<label for="renewal_date" class="form-control-label">Document Authority:</label>



								<input type="text" class="form-control" name="document_authority" placeholder="Enter Document Authority" value="<?php echo $doc['document_authority']?>" readonly="">

							</div>



					</div>			



				</div>



					<div class="form-group">



						<div class="row">				



							<div class="col-lg-6 col-md-12">





								<label for="renewal_date" class="form-control-label">Document No:</label>



								<input type="text" class="form-control" name="document_no" placeholder="Enter Document No" value="<?php echo $doc['document_number']?>" readonly="">

							</div>	





							<div class="col-lg-6 col-md-12">


									<label for="renewal_date" class="form-control-label">Next Renewal Date:</label>

									<div class="wd-200 mg-b-30">



													<div class="input-group">



														<div class="input-group-prepend">



															<div class="input-group-text">



																<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



															</div>



														</div><input class="form-control datepicker2" autocomplete="off" placeholder="Next Renewal Date" type="text" name="next_renewal_date" value="<?php echo date("d-m-Y", strtotime($doc['renewal_date']));?>">

													



													</div>



												</div>



							</div>	

						</div>	



				</div>

			
	

		</div>



		<div class="modal-footer">



			<input type="button" class="btn btn-secondary" data-dismiss="modal" name="close" value="CLose">



			<input type="submit" class="btn btn-primary" value="Mark Document As Renewed" name="mark_as_renewed">


		</div>

		</form>

	</div>



</div>



</div>

												<?php $count++; }}} ?>

<!-- 

												<tr>



													<td>2</td>



													<td>Pan Card</td>



													<td>My1 Property</td>



													<td>14/12/2020</td>



													<td>Aadhar Card</td>



                                                     <td><input type="submit" class="btn btn-yellow" data-toggle="modal" data-target="#exampleModa" name="mark_as" value="Mark Document As Renewed" style="width:100%;"></td>



													<td><button class="btn btn-warning">Pending</button></td>



												</tr> -->

											





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



		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>






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
				$( ".datepicker2").datepicker({ dateFormat: 'dd-mm-yy',
				changeYear: true,
				changeMonth: true,
				yearRange: "-50:+50" });

		});
	});


</script>







	</body>



</html>