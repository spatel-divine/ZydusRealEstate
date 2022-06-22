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



		<!-- File Uploads css-->



        <link href="<?=base_url();?>assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />



		<!-- WYSIWYG Editor css -->



		<link href="<?=base_url();?>assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />







		<!--Summernote css-->



		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/summernote/summernote-bs4.css">









		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />



		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>


  		<link rel="stylesheet" href="<?=base_url();?>resources/demos/style.css">

  		<style type="text/css">
  			
  			#notification_day {
			  /* for Firefox */
			  -moz-appearance: none;
			  /* for Chrome */
			  -webkit-appearance: none;
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



								<li class="breadcrumb-item active" aria-current="page">Add Upload Document Details</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">

								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("Document Summary",$r)) { ?>

									<a href="<?php echo base_url('Document/document_summary');?>" class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All">

										<span>
											View Document Summary List
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



						<!-- End page-header -->







						<!--row open-->



						<div class="row">



							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Upload Document Details</h3>



									</div>



									<div class="card-body">

										<?php echo form_open_multipart('Document/document_detail', array('method' => 'POST'));?>

											<div class="form-group">



												<div class="row">



													<div class="col-lg-3 col-md-12">



														<label>Property Name</label>

														<?php $access = explode(",",$prop_access);?>



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

														</select>

																					

													</div>



														<div class="col-lg-3 col-md-12">



														<label>Document Name</label>

														<input type="hidden" name="abcd1" id="document_name_1_1" value="<?php echo set_value('document_name'); ?>">

														<select id="document_name" name="document_name" class="form-control">

															<option value="">Choose Document Name</option>

															<?php foreach($document as $doc):?>
	    													<option value="<?php echo $doc['document_id'];?>" <?php echo (set_value('document_name')== $doc['document_id'])?" selected=' selected'":""?>><?php echo $doc['document_name'];?></option>
	    													<?php endforeach; ?>

														</select>
														<font color="red"><?=form_error("document_name");?></font>

																					

													</div>



													<div class="col-lg-3 col-md-12">



														<label>Document For</label>



														<select id="document_for" name="document_for" class="form-control">

															<option value="">Choose Document For</option>

															<option value="Sales" <?php echo (set_value('document_for')== 'Sales')?" selected=' selected'":""?>>Sales</option>

															<option value="Purchase" <?php echo (set_value('document_for')== 'Purchase')?" selected=' selected'":""?>>Purchase</option>

															<option value="Lease" <?php echo (set_value('document_for')== 'Lease')?" selected=' selected'":""?>>Lease</option>

														</select>
														<font color="red"><?=form_error("document_for");?></font>
																					

													</div>





													<div class="col-lg-3 col-md-12">



														<label>Document Authority</label>



														<select id="document_authority" name="document_authority" class="form-control">

															<option value="">Choose Document Name</option>

															<?php foreach($document_authority as $auth):?>
	    													<option value="<?php echo $auth['document_auth_id'];?>" <?php echo (set_value('document_authority')== $auth['document_auth_id'])?" selected=' selected'":""?>><?php echo $auth['document_authority'];?></option>
	    													<?php endforeach; ?>

														</select>
														<font color="red"><?=form_error("document_authority");?></font>

																					

													</div>



												</div>

											</div>	

											

										

											<div class="form-group">



												<div class="row">

													<!-- show if renewal is yes in document_master-->

													<div class="col-lg-6 col-md-12" id="renewal_date">



														<label>Renewal Date</label>

																		<div class="wd-200 mg-b-30" >



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker0" autocomplete="off" name="renewal_date" placeholder="Renewal Date" type="text" value="<?php echo set_value('renewal_date');?>">


																			</div>



																		</div>
																		<font color="red"><?=form_error("renewal_date");?></font>

													</div>



													<div class="col-lg-6 col-md-12">



														<label>Document Number</label>

															<input type="text" name="document_number" id="document_number" class="form-control" placeholder="Enter Document Number" value="<?php echo set_value('document_number');?>">
														<font color="red"><?=form_error("document_number");?></font>				

													</div>



												</div>

											</div>



											<div class="form-group">



												<div class="row">



													<div class="col-lg-4 col-md-12">

														<label>Date of Registration</label>

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" autocomplete="off" placeholder="Date of Registration" type="text" name="registration_date" value="<?php echo set_value('registration_date');?>">


																			</div>



																		</div>
																		<font color="red"><?=form_error("registration_date");?></font>

													</div>



													<div class="col-lg-4 col-md-12">

														<label>Date of Execution</label>

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker2" autocomplete="off" placeholder="Date of Execution" type="text" name="execution_date" value="<?php echo set_value('execution_date');?>">


																			</div>



																		</div>
																		<font color="red"><?=form_error("execution_date");?></font>
																</div>

														<div class="col-lg-4 col-md-12">



														<label>How Many Day Before Want Notification?</label>

														<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div>
																				
																				<select name="notification_day" class="form-control" id="notification_day">
																					<option value="">Choose Notiifcation Day</option>
																					<?php
																					$month = date('m');

																					if($month == 02){

																						for ($i=1; $i<=28; $i++)
																						    {
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('notification_day') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					}
																					else if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){

																						  for ($i=1; $i<=31; $i++)
																						    {
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('notification_day') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					} 
																				    else if($month == 4 || $month == 6 || $month == 9 || $month == 11){

																						 for ($i=1; $i<=30; $i++)
																						    {
																						        ?>
																						            <option value="<?php echo $i;?>"  <?php echo (set_value('notification_day') == $i)?" selected=' selected'":""?>><?php echo $i;?></option>
																						        <?php
																						    }

																					} 
																					?>
																				</select>

																			</div>



																		</div>

																		<font color="red"><?=form_error("notification_day");?></font>

														

													</div>		

												</div>

													

											</div>

											<div class="form-group">

												<div class="row">	

													<div class="col-lg-12 col-md-12">

														<label>Document Upload</label>

														<input type="file" name="userfile" id="document_upload" class="dropify" value="<?php echo set_value('document_upload');?>">
															<?php $new_in = $this->session->flashdata('new_in');
															if($new_in==2) { ?> <font color="red"> Supported Document Type is JPEG/JPG/PNG/PDF/Zip/RAR.Document should not be exceed more than 500mb</font> <?php } ?></font>	
														<font color="red"><?=form_error("userfile");?></font>
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

		<script type="text/javascript">

			 $(document).ready(function(){
 
            $('#property_name').change(function(){
                var id=$(this).val();
                 $.ajax({
                    url : "<?php echo site_url('Document/get_document');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;

                        $('#document_name').find('option').not(':first').remove();

                        for(i=0; i<data.length; i++){
                           $('#document_name').append( '<option value='+data[i].document_id+'>'+data[i].document_name+'</option>');
                        $('#document_name_1_1').val(data[i].document_id);
                        }
 
                    }
                });
                return false;
            });
         });   
		</script>

		<script type="text/javascript">
			 $(document).ready(function(){ 
			 	setTimeout(function() {
        				scall($('#document_name_1_1').val());
        		},200);

        		 function scall(eid)
                 {
 
	                var id=$("#property_name").val();
			            if(eid == '' ||eid == null)
		                {
		                	var doc_id = $('#document_name_1_1').val();
		                }
		                else
		                {
		                	var doc_id = eid;
		                }
	                 $.ajax({
	                    url : "<?php echo site_url('Document/get_document');?>",
	                    method : "POST",
	                    data : {id: id},
	                    async : true,
	                    dataType : 'json',
	                    success: function(data){
	                         
	                        var html = '';
	                        var i;

	                        $('#document_name').find('option').not(':first').remove();

	                        for(i=0; i<data.length; i++){
	                        	if(doc_id == data[i].document_id){
	                           $('#document_name').append( '<option value='+data[i].document_id+' selected>'+data[i].document_name+'</option>');
	                            $('#document_name_1_1').val(data[i].document_id);
	                            }
	                            else{
	                            	 $('#document_name').append( '<option value='+data[i].document_id+'>'+data[i].document_name+'</option>');
	                            $('#document_name_1_1').val(data[i].document_id);
	                            }
	                        }
	 
                    	}
                });
	         }
                return false;
            });  
		</script>


		<script type="text/javascript">
			 $(document).ready(function(){
 
            $('#document_name').change(function(){
                var id=$(this).val();
                 $.ajax({
                    url : "<?php echo site_url('Document/get_document_renewal');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;

                        if(data[0].document_renewal == "Yes"){
                        	var element = document.getElementById('renewal_date');
                        	element.style.display = 'block';
                        }
                        else{
                        	var element = document.getElementById('renewal_date');
                        	element.style.display = 'none';
                        } 
 
                    }
                });
                return false;
            });
         });   
		</script>

		<script type="text/javascript">
			 $(document).ready(function(){ 

                var id=$("#document_name_1_1").val();
                 $.ajax({
                    url : "<?php echo site_url('Document/get_document_renewal');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;
                        
                        if(typeof data[0] !== 'undefined'){

                        	if(data[0].document_renewal == "Yes"){
                        	var element = document.getElementById('renewal_date');
                        	element.style.display = 'block';
                        }
                        else{
                        	var element = document.getElementById('renewal_date');
                        	element.style.display = 'none';
                        } 

                        }
                        

                    }
                });
                return false;
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



		<!-- Timepicker js -->



		<script src="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.js"></script>



		<script src="<?=base_url();?>assets/plugins/time-picker/toggles.min.js"></script>





		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>





		<!-- File uploads js -->



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify.js"></script>



		<script src="<?=base_url();?>assets/plugins/fileuploads/js/dropify-demo.js"></script>




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