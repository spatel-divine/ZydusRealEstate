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



		<!-- Time picker css-->



		<link href="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />







		<!-- Date Picker css-->



		<link href="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.css" rel="stylesheet" />





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



		<!-- WYSIWYG Editor css -->



		<link href="<?=base_url();?>assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />







		<!--Summernote css-->



		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/summernote/summernote-bs4.css">









		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />



		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>

		<!-- File Uploads css-->

        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />



  <link rel="stylesheet" href="<?=base_url();?>resources/demos/style.css">



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



								<li class="breadcrumb-item active" aria-current="page">Edit Claim Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Claim List",$r)) { ?>

									<a href="<?php echo base_url('Insurance/view_claim_list');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>
											View Claim List
										</span>

									</a>

								<?php } ?>

								</div>

							</div>

						</div>



						<!-- End page-header -->







						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Edit Claim Details</h3>



									</div>



									<div class="card-body">



										<?php foreach($claim_list as $claim) {?>

										<?php echo form_open_multipart('Insurance/edit_claim_detail_redirect/'.base64_encode($claim['claim_id']),array("method"=>"POST")); ?>	



											<div class="form-group">



												<div class="row">



													<div class="col-lg-12 col-md-12">



														<label>Property Name</label>

														<input type="text" class="form-control" value="<?php echo $claim['property_name'];?>" readonly>					

													</div>

												</div>

											</div>
						<div class="form-group">



							<div class="row">



							<div class="col-md-12 col-lg-12">



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Insurance Claim Details</div>



								</div>



								<div class="card-body">



                                	<div class="table-responsive">

										<table id="example" class="table table-striped table-bordered text-wrap w-100">

											<!--Case ACcroding Property Selection-->



											<thead>



												<tr>


													<th class="wd-15p">Insurance Name</th>

													<th class="wd-15p">Coverage Amount</th>


													<th class="wd-15p">Insurance Comapny</th>



													<th class="wd-15p">Policy No</th>



													<th class="wd-15p">Poilcy Owner</th>



													<th class="wd-15p">Ledger Head</th>



													<th class="wd-20p">Ledger Number</th>

											
												</tr>



											</thead>

											<tbody>

												<tr>


												<td>
	                								<?= $claim['insurance_name'];?>
                											
                								</td>

                								<td>
	                								<?= $claim['coverage_amount'];?>
                											
                								</td>

												<td>
	                								<?= $claim['insurance_company'];?>
                											
                								</td>

												<td><?= $claim['policy_no'];?></td>



												<td><?= $claim['username'];?></td>


												<td><?= $claim['ledger_head'];?></td>

												<td><?= $claim['ledger_number'];?></td>

												</tr>

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

												<input type="hidden" id="property_id" name="property_id" value="<?php echo set_value('property_id');?>">
												<input type="hidden" id="insurance_id" name="insurance_id" value="<?php echo set_value('insurance_id');?>">		

											<div class="form-group">

												<div class="row">

													<div class="col-lg-4 col-md-12">
														<label>Damage Remark</label>
														<?php if($this->input->post('submit') && $this->input->post('damage_remark') !== $claim['damage_remark']) { ?>
															<textarea name="damage_remark" class="form-control" placeholder="Enter Damage Remark"><?php echo set_value('damage_remark');?></textarea>
														<?php } else { ?>
															<textarea name="damage_remark" class="form-control" placeholder="Enter Damage Remark"><?php echo $claim['damage_remark'];?></textarea>
														<?php } ?>	
														
													</div>
													<div class="col-lg-4 col-md-12">
														<label>Claim Date Launch</label>
														<div class="wd-200 mg-b-30">
																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>

																				<?php if($this->input->post('submit') && $this->input->post('claim_date_launch') !== $claim['claim_date_lunch']) { ?>
																					<input class="form-control" id="datepicker0" autocomplete="off" placeholder="Claim Date Launch" type="text" name="claim_date_launch" value="<?php echo set_value('claim_date_launch'); ?>">
																				<?php } else { ?>
																					<input class="form-control" id="datepicker0" autocomplete="off" placeholder="Claim Date Launch" type="text" name="claim_date_launch" value="<?php echo date("d-m-Y", strtotime($claim['claim_date_lunch'])); ?>">
																				<?php } ?>	


																			</div>



																		</div>
																		<font color="red"><?=form_error("claim_date_launch");?></font>
													</div>
													<div class="col-lg-4 col-md-12">
														<label>Claim Amount</label>

														<?php if($this->input->post('submit') && $this->input->post('claim_amount') !== $claim['claim_amount']) { ?>
															<input type="text" name="claim_amount" class="form-control" value="<?php echo set_value('claim_amount');?>" placeholder="Enter Claim Amount">
														<?php } else { ?>
															<input type="text" name="claim_amount" class="form-control" value="<?php echo $claim['claim_amount'];?>" placeholder="Enter Claim Amount">
														<?php } ?>
														
														<font color="red"><?=form_error("claim_amount");?></font>
													</div>
												</div>
											</div>

											<div class="form-group">

												<div class="row">

													<div class="col-lg-4 col-md-12">
														<label>Surveyer Name</label>
														<?php if($this->input->post('submit') && $this->input->post('surveyer_name') !== $claim['surveryer_name']) { ?>
															<input type="text" name="surveyer_name" class="form-control" value="<?php echo set_value('surveyer_name');?>" placeholder="Enter Surveyer Name">
														<?php } else { ?>
															<input type="text" name="surveyer_name" class="form-control" value="<?php echo $claim['surveryer_name'];?>" placeholder="Enter Surveyer Name">
														<?php } ?>	
														
													</div>
													<div class="col-lg-4 col-md-12">
														<label>Surveyer Number</label>
														<?php if($this->input->post('submit') && $this->input->post('surveyer_number') !== $claim['surveyer_number']) { ?>
															<input type="text" name="surveyer_number" class="form-control" value="<?php echo set_value('surveyer_number');?>" placeholder="Enter Surveyer Number">
														<?php } else { ?>
															<input type="text" name="surveyer_number" class="form-control" value="<?php echo $claim['surveyer_number'];?>" placeholder="Enter Surveyer Number">
														<?php } ?>	
														
													</div>
													<div class="col-lg-4 col-md-12">
														<label>Surveyer Staus</label>
														<?php if($this->input->post('submit') && $this->input->post('surveyer_status') !== $claim['surveyer_status']) { ?>
															<select name="surveyer_status" class="form-control">
																<option value="">Choose Surveyer Status</option>
																<option value="Processing" <?php echo (set_value('surveyer_status')== "Processing")?" selected=' selected'":""?>>Processing</option>
																<option value="Rejected" <?php echo (set_value('surveyer_status')== "Rejected")?" selected=' selected'":""?>>Rejected</option>
																<option value="Passed" <?php echo (set_value('surveyer_status')== "Passed")?" selected=' selected'":""?>>Passed</option>
															</select>
														<?php } else { ?>
															<select name="surveyer_status" class="form-control">
																<option value="">Choose Surveyer Status</option>
																<option value="Processing" <?php if($claim['surveyer_status']== 'Processing'){ echo 'Selected'; }?>>Processing</option>
																<option value="Rejected" <?php if($claim['surveyer_status']== 'Rejected'){ echo 'Selected'; }?>>Rejected</option>
																<option value="Passed" <?php if($claim['surveyer_status']== 'Passed'){ echo 'Selected'; }?>>Passed</option>
															</select>
														<?php } ?>	
														
													</div>
												</div>
											</div>

											<div class="form-group">

												<div class="row">
													<div class="col-lg-12 col-md-12">
														<label>Upload Claim Document</label> &nbsp;&nbsp;<?php
												if(!empty($claim['upload_claim_document'])) {
												?><a href="<?php echo base_url('insurance/download_claim_document/'.base64_encode($claim['claim_id']));?>" class="btn btn-primary btn-sm">Download Current Claim Document</a><?php } ?>

														<input type="file" class="dropify" name="claim_document" id="claim_document" class="dropify" value="<?php echo set_value('claim_document');?>">
														<font color="red">
																<?php $new_in = $this->session->flashdata('new_in');
															if($new_in==2) { echo "Upload Claim Document in zip/pdf/jpeg/jpg/png/RAR Format Only.<br/>Size should not be exceed more than 20mb"; } ?></font>
													</div>	
													
												</div>
											</div>						
										

											
											<div class="form-group"  style="float:right;">



												<div class="row">



													
													<input type="submit" name="submit" value="Submit" class="btn btn-app btn-primary mr-2 mt-1 mb-1">

												</div>

											</div>		





												<!--Wizrad Completes Here-->



										</form>

										<?php } ?>



									</div>



								</div>



							</div>



						</div>



						<!--row closed-->



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



		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



		<!-- Timepicker js -->



		<script src="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.js"></script>



		<script src="<?=base_url();?>assets/plugins/time-picker/toggles.min.js"></script>





		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>



		<!-- WYSIWYG Editor js -->



		<script src="<?=base_url();?>assets/plugins/wysiwyag/jquery.richtext.js"></script>



		<script src="<?=base_url();?>assets/plugins/wysiwyag/richText1.js"></script>







		<!--Summernote js-->



		<script src="<?=base_url();?>assets/plugins/summernote/summernote-bs4.js"></script>



		<script src="<?=base_url();?>assets/js/summernote.js"></script>







		<!--ckeditor js-->



		<script src="<?=base_url();?>assets/plugins/tinymce/tinymce.min.js"></script>



		<script src="<?=base_url();?>assets/js/formeditor.js"></script>




		<!-- File uploads js -->

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>

		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>




		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>

		<script type="text/javascript">
			 $(document).ready(function(){
 
            $('#property_name').change(function(){
            	
                var id=$(this).val();

                $("#property_id").val(id);


         });   
       })     
		</script>

		     <script type="text/javascript">
 
           $(document).ready(function(){

              var id = $('#property_name_1_1').val();
                   
                $("#property_id").val(id);    

         });   
		</script>

		<script>
    $(document).ready(function(){
         $('input[name="insurance_selection"]').change(function(){
            var radioValue = $("input[name='insurance_selection']:checked").val();

             $("#insurance_id").val(radioValue);   
           
        });
    });
</script>


	</body>



</html>