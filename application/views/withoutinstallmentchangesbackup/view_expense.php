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



		<!-- File Uploads css-->



        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />



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


  <link rel="stylesheet" href="<?=base_url();?>resources/demos/style.css">

    <style>
#mceu_20{
	pointer-events: none;
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



								<li class="breadcrumb-item active" aria-current="page">View Expense</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Expense List",$r)) { ?>

									<a href="<?php echo base_url('Expense/view_expense_list');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>
											View Expense List
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



										<h3 class="card-title">View Expense Details</h3>



									</div>



									<div class="card-body">



										 <?php  if(!empty($expense))
                              			{

                              	 			foreach ($expense as $inc){?>




											<div class="form-group">



												<div class="row">



													<div class="col-lg-6 col-md-12">



															<label>Ledger Head</label>



																																	

																		<input type="text" id="ledger_head" name="ledger_head" class="form-control" placeholder="Enter Ledger Head" value="<?php echo $inc['expense_ledger_head']; ?>" readonly>
																		
														</div>

													<div class="col-lg-6 col-md-12">



															<label>Ledger Number</label>



																																	

																		<input type="text" id="ledger_number" name="ledger_number" class="form-control" placeholder="Enter Ledger Number" value="<?php echo $inc['expense_ledger_number']; ?>" readonly>

														</div>

													</div>

												</div>			



											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>Property Name</label>



														<input type="text" id="ledger_number" name="ledger_number" class="form-control" placeholder="Enter Ledger Number" value="<?php echo $inc['property_name']; ?>" readonly>

																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Expense Title</label>



														<input type="text" id="expense_title" name="expense_title" class="form-control" placeholder="Enter expense Title" value="<?php echo $inc['expense_title']; ?>" readonly>

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Expense Amount</label>



														<input type="text" id="expense_amount" name="expense_amount" class="form-control" placeholder="Enter expense Amount" value="<?php echo $inc['expense_amount']; ?>" readonly>		

													</div>

											

													<div class="col-lg-3 col-md-12">



														<label>Expense Date</label>



														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control"  name="expense_date" autocomplete="off" placeholder="Enter expense Date" type="text" value="<?php echo date("d-m-Y", strtotime($inc['expense_date'])); ?>" readonly>
																			
																			</div>



														</div>

																					

													</div>

												</div>	

											</div>		



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">



														<label>Expense Type</label>

														<input type="text" class="form-control" value="<?php echo $inc['expense_type'];?>" readonly>

													</div>



														<div class="col-lg-4 col-md-12">



															<label>Expense Source Party Name</label>
															
															<input type="text" class="form-control" value="<?php echo $inc['username'];?>" readonly>						

														</div>



														<div class="col-lg-4 col-md-12">



															<label>Invoice Number</label>



																																	

																		<input type="text" id="invoice_number" name="invoice_number" class="form-control" placeholder="Enter Invoice Number" value="<?php echo $inc['expense_invoice_number']; ?>" readonly>

														</div>

													

												</div>

											</div>
	

											<?php if(empty($inc['next_recurring_date'])) { ?>

												<div class="form-group">



													<div class="row">



														<div class="col-lg-3 col-md-12">



															<label>TDS Percentage</label>

															<input type="text" name="tds_percentage" id="tds_percentage" class="form-control" placeholder="Enter TDS Percentage(%)" value="<?php echo $inc['tds_percentage']; ?>" readonly>
															
														</div>



															<div class="col-lg-3 col-md-12">



																<label>GST Percentage</label>

																<input type="text" name="gst_percentage" id="gst_percentage" class="form-control" placeholder="Enter GST Percentage(%)" value="<?php echo $inc['gst_percentage']; ?>" readonly>																

															</div>



															<div class="col-lg-3 col-md-12">



																<label>Paid By</label>																						

																<?php foreach ($paid_by as $by){?>

																	<input type="text" class="form-control" value="<?php echo $by['username'];?>" readonly>

																<?php } ?>
															</div>



															<div class="col-lg-3 col-md-12">



																<label>Recurring Expense</label>



																<label class="custom-control custom-radio">



																	<input type="radio" class="custom-control-input" name="recurring_expense" value="Yes" <?php if($inc['recurring_expense'] == 'Yes') { echo "Checked"; }?> disabled>



																	<span class="custom-control-label" style="color:black;" value="<?php if($inc['recurring_expense'] == 'Yes') { echo "Checked"; }?>">Yes</span>



																</label>



																<label class="custom-control custom-radio">



																	<input type="radio" class="custom-control-input" name="recurring_expense" value="No" <?php if($inc['recurring_expense'] == 'No') { echo "Checked"; }?> disabled>



																	<span class="custom-control-label" style="color:black;" value="<?php if($inc['recurring_expense'] == 'No') { echo "Checked"; }?>">No</span>



																</label>

															</div>

														

													</div>

												</div>
											<?php } ?>	


											<?php if(!empty($inc['next_recurring_date'])) { ?>

												<div class="form-group" id="next_date">



													<div class="row">

														<div class="col-lg-2 col-md-12">



														<label>TDS Percentage</label>

														<input type="text" name="tds_percentage" id="tds_percentage" class="form-control" placeholder="Enter TDS Percentage(%)" value="<?php echo $inc['tds_percentage']; ?>" readonly>
														
													</div>



														<div class="col-lg-2 col-md-12">



															<label>GST Percentage</label>

															<input type="text" name="gst_percentage" id="gst_percentage" class="form-control" placeholder="Enter GST Percentage(%)" value="<?php echo $inc['gst_percentage']; ?>" readonly>																

														</div>



														<div class="col-lg-3 col-md-12">



															<label>Paid By</label>																						

															<?php foreach ($paid_by as $by){?>


																<input type="text" class="form-control" value="<?php echo $by['username'];?>" readonly>

															<?php } ?>
														</div>



														<div class="col-lg-2 col-md-12">



															<label>Recurring Expense</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="recurring_expense" value="Yes" <?php if($inc['recurring_expense'] == 'Yes') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($inc['recurring_expense'] == 'Yes') { echo "Checked"; }?>">Yes</span>



															</label>



															<label class="custom-control custom-radio">



																<input type="radio" class="custom-control-input" name="recurring_expense" value="No" <?php if($inc['recurring_expense'] == 'No') { echo "Checked"; }?> disabled>



																<span class="custom-control-label" style="color:black;" value="<?php if($inc['recurring_expense'] == 'No') { echo "Checked"; }?>">No</span>



															</label>

														</div>
	

															<div class="col-lg-3 col-md-12">



																<label>Next Recurring Date</label>

																<div class="wd-200 mg-b-30">



																				<div class="input-group">



																					<div class="input-group-prepend">



																						<div class="input-group-text">



																							<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																						</div>



																					</div><input class="form-control" name="next_recurring_date" autocomplete="off" placeholder="Enter Next Recurring Date" type="text" value="<?php echo date("d-m-Y", strtotime($inc['next_recurring_date'])); ?>" readonly>



																				</div>



															</div>

															</div>

													</div>

												</div>		
											<?php } ?>				



											<div class="form-group">



												<div class="row">



														<div class="col-lg-12 col-md-12">



															<label>Expense Description</label>

															<textarea id="elm1" name="expense_description"><?php echo $inc['expense_description']; ?></textarea>

																																					

														</div>

												</div>

											</div>		




											<div class="form-group">

												<div class="row">

													<div class="col-lg-12 col-md-12">



															<label>View Invoice</label>


															<?php $image =  base64_decode($inc['invoice_upload']);
																	$img_extension = strrchr($image,'.');
																	$ext = array($img_extension);


															if((in_array('.zip',$ext)) OR (in_array('.rar',$ext))){ ?>
																	<br/>
																<h5><b>View of This Document is Not Available Please Download the Document.</b> <a href="<?php echo base_url('assets/images/uploads/invoice_upload/expense/'.(base64_decode($inc['invoice_upload'])));?>"></h5> 
															<?php } else { ?>

																<a href="<?php echo base_url('expense/download_expense_invoice/'.base64_encode($inc['expense_id']));?>"><embed src="<?php echo base_url('assets/images/uploads/invoice_upload/expense/'.(base64_decode($inc['invoice_upload'])));?>" width="100%" height="500px"></a>				
															<?php } ?>	
																																			

														</div>

													

												</div>

											</div>

											<div class="form-group"  style="float:right;">



												<div class="row">



													<a href="<?php echo base_url('expense/download_expense_invoice/'.base64_encode($inc['expense_id']));?>" class="btn btn-primary">Expense Invoice Download</a>

												</div>

											</div>					


												<!--Wizrad Completes Here-->



										<?php }} ?>


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



		<!--<script>

			function sale_property(val){

				 var element=document.getElementById('markassold');

				 if(val=='Sale Property')

				   element.style.display='block';

				 else  

				   element.style.display='none';

				}

		</script>-->



		<script type="text/javascript">

			var element=document.getElementById('next_date');

			$('input[type=radio][name=recurring_expense]').change(function() {

			    if (this.value == 'Yes') {

			         element.style.display='block';

			    }

			    else{

			        element.style.display='none';

			    }

			});

		</script>		





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



		<!-- File uploads js -->



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>





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









		<!-- Custom js-->



		<script src="<?=base_url();?>assets/js/custom.js"></script>







	</body>



</html>