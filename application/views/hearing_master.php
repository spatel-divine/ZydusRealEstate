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



								<li class="breadcrumb-item active" aria-current="page">Add Case Hearing Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Hearing List",$r)) { ?>

									<a href="<?php echo base_url('Legal/view_hearing_list');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>
											View Hearing List
										</span>

									</a> &nbsp;&nbsp;

								<?php } ?>

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



							<?php if($this->session->flashdata('insert_hearing')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insert_hearing'); ?>
                                </div>
      							
    						<?php endif;?> 


    						<?php if($this->session->flashdata('check_hearing_inserted')) :?>

								<div class="alert alert-danger alert-dismissable" style="background-color: #ec2d38;

    						border-color: #ec2d38;color:white;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('check_hearing_inserted'); ?>
                                </div>
      							
    						<?php endif;?> 



						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Case Hearing Details</h3>



									</div>



									<div class="card-body">



										<?php echo form_open_multipart('Legal/hearing_master_redirect/',array("method"=>"POST","id"=>"form-filter")); ?>	



											<div class="form-group">



												<div class="row">



													<div class="col-lg-11 col-md-12">



														<label>Property Name</label>

														<?php $access = explode(",",$prop_access);?>
														
														<?php if(isset($property_id)) { ?>
														<input type="hidden" name="abcd1" id="property_name_1_1" value="<?php echo $property_id; ?>">
													<?php } ?>

														<select id="property_name" name="property_name" class="form-control">

															<option value="">Choose Property</option>

															<?php foreach($property as $prop):
																$property_id[] = $prop['property_id'];	
																$common_access = array_intersect($access,$property_id);
																?>
																<?php foreach($access as $acc){if($acc == $prop['property_id']) { ?>
	    															<option value="<?php echo $prop['property_id'];?>" <?php echo (set_value('property_name')== $prop['property_id'])?" selected=' selected'":""?>><?php echo $prop['property_name'];?></option>
	    														<?php }} ?>		
	    													<?php endforeach; ?>

														</select>

															<font color="red"><?=form_error("property_name");?></font>						

													</div>

													<div class="col-lg-1 col-md-12">
														<input type="submit" class="btn btn-primary" value="Filter" id="btn-filter" name="filter" style="margin-top:24px;width:70px;">
														
													
													</div>


												</div>

											</div>
										

											<div class="form-group">



									<div class="row">



							<div class="col-md-12 col-lg-12">



							<div class="card">



								<div class="card-header pb-0">



									<div class="card-title">Hearing Case Details</div>



								</div>



								<div class="card-body">



                                	<div class="table-responsive">

                                		<font color="red"><?=form_error("case_selection");?></font>

										<table id="example" class="table table-striped table-bordered text-wrap w-100">

											<!--Case ACcroding Property Selection-->



											<thead>



												<tr>



													<th class="wd-15p">SR No</th>

													<th class="wd-15p">Case Number</th>

													<th class="wd-15p">Case By</th>



													<th class="wd-15p">Case Against</th>



													<th class="wd-15p">Police Station</th>



													<th class="wd-15p">Case Type</th>



													<th class="wd-15p">Case Registration Date</th>



													<th class="wd-20p">Advocate</th>

													<th class="wd-20p">Case Selection</th>



												</tr>



											</thead>

											<tbody>


											 <?php  if(!empty($legal))
                             					 {
                              						$count = 1;

                              	 					foreach ($legal as $legal){

                              	 				?>


												<tr>



												<td><?= $count;?></td>

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
                										<?php }} ?>
                											
                								</td>

												<td><?= $legal['police_station_name'];?></td>



												<td><?= $legal['case_type'];?></td>


												<td><?= date("d-m-Y", strtotime($legal['case_registered_date']));?></td>

												<td><?php foreach($advocate as $adv) {
																	if($adv['legal_id'] === $legal['legal_id']){
																		?>




			                													<?= $adv['username'].",";?>
		                										<?php }} ?>
		                											
		                						</td>	

		                						<td><input type="radio" id="case_selection" name="case_selection" value="<?php echo $legal['legal_id']?>" class="form-control" <?php echo (set_value('case_selection') == $legal['legal_id'])?" Checked=' Checked'":""?>></td>	

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



								<input type="hidden" id="property_id" name="property_id" value="<?php echo set_value('property_id');?>">
								<input type="hidden" id="legal_id" name="legal_id" value="<?php echo set_value('legal_id');?>">	
											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Hearing Date</label>



														

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker0" autocomplete="off" placeholder="Case Hearing Date" type="text" name="hearing_date" value="<?php echo set_value('hearing_date'); ?>">



																			</div>



																		</div>

																	<font color="red"><?=form_error("hearing_date");?></font>				

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Next Hearing Date</label>



														

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Case Next Hearing Date" type="text" name="next_hearing_date" value="<?php echo set_value('next_hearing_date'); ?>">



																			</div>



																		</div>

																	<font color="red"><?=form_error("next_hearing_date");?></font>				

													</div>



													<div class="col-lg-4 col-md-12">



														<label>Case Status</label>



														<select id="case_status" name="case_status" class="form-control">

															<option value="">Choose Case Status</option>

															<?php foreach($case_status as $status):?>
	    													<option value="<?php echo $status['case_status_id'];?>" <?php echo (set_value('case_status')== $status['case_status_id'])?" selected=' selected'":""?>><?php echo $status['case_status'];?></option>
	    													<?php endforeach; ?>

														</select>
														<font color="red"><?=form_error("case_status");?></font>
																					

													</div>



												</div>

											</div>

											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>Upload Case Documents</label>



																																	

															<input type="file" class="dropify" name="case_upload" id="case_upload" class="dropify" value="<?php echo set_value('case_upload');?>">
															<font color="red">
																<?php $new_in = $this->session->flashdata('new_in');
															if($new_in==2) { echo "Upload Case Document in zip/pdf/jpeg/jpg/png/RAR Format Only.<br/>Size should not be exceed more than 20mb"; } ?></font>
 															<?php if(empty($this->input->post(('case_upload')))){?>		
																<font color="red"><?=form_error("case_upload");?></font>
															<?php } ?>	
																					

													</div>

												</div>

											</div>			





											<div class="form-group">



												<div class="row">



													<div class="col-lg-12 col-md-12">

														<label>Hearing Comment</label>

														<textarea id="elm1" name="hearing_comment"><?php echo set_value('hearing_comment'); ?></textarea>							

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
         $('input[name="case_selection"]').change(function(){
            var radioValue = $("input[name='case_selection']:checked").val();

             $("#legal_id").val(radioValue);   
           
        });
    });
</script>

    <script>
  $("#datepicker1").change(function() {
    var startDate = document.getElementById("datepicker0").value;
    var endDate = document.getElementById("datepicker1").value;

    ndate = startDate.split("-").reverse().join("-");
    ndate1 = endDate.split("-").reverse().join("-");

    if ((Date.parse(ndate1) <= Date.parse(ndate))) {
      alert("Next Hearing Date should be greater than Hearing Date");
      document.getElementById("datepicker1").value = "";
    }
  });
</script>

    <script>
  $("#datepicker0").change(function() {
    var startDate = document.getElementById("datepicker0").value;
    var endDate = document.getElementById("datepicker1").value;

    ndate = startDate.split("-").reverse().join("-");
    ndate1 = endDate.split("-").reverse().join("-");

    if(startDate != '' && endDate != ''){

    	 if ((Date.parse(ndate) >= Date.parse(ndate1))) {
	      alert("Hearing Date should be Lesser than Next Hearing Date");
	      document.getElementById("datepicker0").value = "";
	      document.getElementById("datepicker1").value = "";
    	}

    }

   
  });
</script>


	</body>



</html>