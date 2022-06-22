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





		<!-- Time picker css-->



		<link href="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />







		<!-- Date Picker css-->



		<link href="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.css" rel="stylesheet" />





		<!-- WYSIWYG Editor css -->



		<link href="<?=base_url();?>assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />







		<!--Summernote css-->



		<link rel="stylesheet" href="<?=base_url();?>assets/plugins/summernote/summernote-bs4.css">





		<!-- Color-skins css -->



		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />



		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>

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


				<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 250px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>






                <!-- app-content-->



				<div class="app-content  my-3 my-md-5">



					<div class="side-app">







						<!-- page-header -->



						<div class="page-header">



							<ol class="breadcrumb"><!-- breadcrumb -->



								<li class="breadcrumb-item"><a href="#">Pages</a></li>



								<li class="breadcrumb-item active" aria-current="page">Add Property</li>



							</ol><!-- End breadcrumb -->

							<div class="ml-auto">
								<div class="input-group">

									<?php $r = explode(",",$roles); if(in_array("View Property List",$r)) { ?>
									<a href="<?php echo site_url('Property/view_property_list/')?>"  class="btn btn-secondary text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="View All Property">
										<span>
											View All Property
										</span>
									</a>

									&nbsp;&nbsp;

									<?php } ?>

									<input type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#measureModa"  value="Property Measures Table" style="float:right;">

									<div class="modal fade" id="measureModa" tabindex="-1" role="dialog"  aria-hidden="true">

										<div class="modal-dialog modal-lg" role="document">

											<div class="modal-content">

								
												<div class="modal-header">



													<h5 class="modal-title" id="example-Modal3">Proerty Measures Table</h5>

													<input type="submit" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" value="&times;" name="close">

												</div>


												<div class="modal-body">
													
													<div class="card">
														<!--First Measure Table-->
														<div class="card-header pb-0">

															<h3 class="card-title">List of Some of the Common Land Measurement Units:</h3> 
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table table-striped table-bordered text-wrap w-100">
																	<thead>
																		<tr>
																			<th class="wd-15p">Unit of Area</th>
																			<th class="wd-15p">Conversion Unit</th>
																		</tr>
																		<tr>
																			<td>1 Square Feet (sq ft)</td>
																			<td>144 sq in (1 feet is 12 inches)</td>	
																		</tr>
																		<tr>
																			<td>1 Square Centimeters</td>
																			<td>0.00107639 sq ft</td>	
																		</tr>
																		<tr>
																			<td>1 Square Inch</td>
																			<td>0.0069444 sq ft</td>	
																		</tr>
																		<tr>
																			<td>1 Square Kilometer (sq km)</td>
																			<td>247.1 acres</td>	
																		</tr>
																		<tr>
																			<td>1 Square Meter (sq m)</td>
																			<td>10.76391042 sq ft</td>	
																		</tr>
																		<tr>
																			<td>1 Square Mile</td>
																			<td>640 acres or 259 hectares</td>	
																		</tr>
																		<tr>
																			<td>1 Square Yard (sq yd)</td>
																			<td>9 sq ft</td>	
																		</tr>
																		<tr>
																			<td>1 Acre</td>
																			<td>4840 sq yd or 100.04 cents (standard unit to measure land)</td>	
																		</tr>
																		<tr>
																			<td>1 Hectare</td>
																			<td>10000 sq m or 2.49 acres approximately</td>	
																		</tr>
																	</thead>				
																</table>	
															</div>	
														</div>	
														<!--End First Measure Table-->

														<!--Second Measure Table-->
														<div class="card-header pb-0">

															<h3 class="card-title">Land Measurement Units Used in North India:</h3> 
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table table-striped table-bordered text-wrap w-100">
																	<thead>
																		<tr>
																			<th class="wd-15p">Unit</th>
																			<th class="wd-15p">States Used In</th>
																			<th class="wd-15p">Conversion</th>
																		</tr>
																		<tr>
																			<td>1 Bigha-Pucca</td>
																			<td>Bihar and parts of UP, Punjab, and Haryana</td>	
																			<td>3025 sq yd, 1 Pucca-Bigha=165 ft*165 ft</td>
																		</tr>
																		<tr>
																			<td>1 Bigha</td>
																			<td>Parts of Himachal Pradesh and Uttarakhand</td>	
																			<td>968 sq yd</td>
																		</tr>
																		<tr>
																			<td>Bigha- Kachha (Kachha Bigha is one-third of Pucca Bigha.)</td>
																			<td>Some parts of Punjab, Haryana, UP</td>	
																			<td>1008.33 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Biswa – Pucca</td>
																			<td>Upper parts of UP, Punjab, Haryana</td>	
																			<td>151.25 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Biswa</td>
																			<td>Some parts of HP,  Uttarakhand</td>	
																			<td>48.4 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Biswa  (Kaccha) (1/20 of Bigha Kaccha)</td>
																			<td>Lower parts of Punjab, Haryana,  UP</td>	
																			<td>50.417 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Biswansi</td>
																			<td>UP, Punjab, Haryana, Himachal Pradesh and Uttarakhand</td>	
																			<td>1/20 Biswa. 1 Biswa has 20 Biswansis</td>
																		</tr>
																		<tr>
																			<td>1 Killa</td>
																			<td>Parts of Haryana and Punjab</td>	
																			<td>4840 sq yd (An Acre is also known as Killa)</td>
																		</tr>
																		<tr>
																			<td>1 Ghumaon</td>
																			<td>Some parts of Himachal Pradesh, Haryana and Punjab</td>	
																			<td>4840 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Kanal</td>
																			<td>Haryana, Punjab, Himachal Pradesh and Jammu and Kashmir</td>	
																			<td>5445 sq ft. 8 Kanals is 1 Acre</td>
																		</tr>
																	</thead>				
																</table>	
															</div>	
														</div>	
														<!--End Second Measure Table-->

														<!--Third Measure Table-->
														<div class="card-header pb-0">

															<h3 class="card-title">Land Measurement Units Used in South India:</h3> 
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table table-striped table-bordered text-wrap w-100">
																	<thead>
																		<tr>
																			<th class="wd-15p">Unit</th>
																			<th class="wd-15p">States Used In</th>
																			<th class="wd-15p">Conversion</th>
																		</tr>
																		<tr>
																			<td>1 Ankanam</td>
																			<td>Parts of Andhra Pradesh and Karnataka</td>	
																			<td>72 sqft, 1Acre=605 Ankanams</td>
																		</tr>
																		<tr>
																			<td>1 Cent</td>
																			<td>Tamil Nadu, Kerala and Karnataka</td>	
																			<td>435.6 sq ft</td>
																		</tr>
																		<tr>
																			<td>1 Ground</td>
																			<td>Parts of Tamil Nadu</td>	
																			<td>2400 sq ft</td>
																		</tr>
																		<tr>
																			<td>1 Guntha</td>
																			<td>Andhra Pradesh and Karnataka</td>	
																			<td>1089 sq ft</td>
																		</tr>
																		<tr>
																			<td>1 Kuncham</td>
																			<td>Andhra Pradesh</td>	
																			<td>484 sq yd, 1 Kuncham=10 cents</td>
																		</tr>
																	</thead>				
																</table>	
															</div>	
														</div>	
														<!--End Third Measure Table-->

														<!--Fourth Measure Table-->
														<div class="card-header pb-0">

															<h3 class="card-title">Land Measurement Units Used in East India:</h3> 
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table table-striped table-bordered text-wrap w-100">
																	<thead>
																		<tr>
																			<th class="wd-15p">Unit</th>
																			<th class="wd-15p">States Used In</th>
																			<th class="wd-15p">Conversion</th>
																		</tr>
																		<tr>
																			<td>1 Chatak</td>
																			<td>West Bengal</td>	
																			<td>180 sq ft</td>
																		</tr>
																		<tr>
																			<td>1 Decimal</td>
																			<td>West Bengal</td>	
																			<td>48.4 sq yd, 1Acre=100 decimals</td>
																		</tr>
																		<tr>
																			<td>1 Dhur</td>
																			<td>Bihar and Jharkhand</td>	
																			<td>68.0625 sq ft</td>
																		</tr>
																		<tr>
																			<td>1 Dhur</td>
																			<td>Tripura</td>	
																			<td>3.6 sq ft</td>
																		</tr>
																		<tr>
																			<td>1 Kattha</td>
																			<td>Assam</td>	
																			<td>2880 sq ft, 1 Bigha (Assam) has 5 Katthas</td>
																		</tr>
																		<tr>
																			<td>1 Kattha</td>
																			<td>Bengal</td>	
																			<td>720 sq ft, 1 Bigha (Bengal) has 20 Katthas</td>
																		</tr>
																		<tr>
																			<td>1 Kattha</td>
																			<td>Bihar</td>	
																			<td>1361.25 sq ft, 1 Bigha (Bihar) has 20 Katthas</td>
																		</tr>
																		<tr>
																			<td>1 Lecha</td>
																			<td>Assam</td>	
																			<td>144 sq ft, 20 Lechas is 1 Kattha</td>
																		</tr>
																	</thead>				
																</table>	
															</div>	
														</div>	
														<!--End Fourth Measure Table-->

														<!--Fifth Measure Table-->
														<div class="card-header pb-0">

															<h3 class="card-title">Land Measurement Units Used in West India:</h3> 
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table table-striped table-bordered text-wrap w-100">
																	<thead>
																		<tr>
																			<th class="wd-15p">Unit</th>
																			<th class="wd-15p">States Used In</th>
																			<th class="wd-15p">Conversion</th>
																		</tr>
																		<tr>
																			<td>1 Bigha</td>
																			<td>Bihar and parts of Rajasthan</td>	
																			<td>Pucca 3025 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Bigha</td>
																			<td>Gujarat and parts of Rajasthan</td>	
																			<td>1936 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Biswa</td>
																			<td>Upper parts of Rajasthan</td>	
																			<td>Pucca 151.25 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Biswa</td>
																			<td>Lower parts of Rajasthan</td>	
																			<td>96.8 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Biswansi</td>
																			<td>Rajasthan</td>	
																			<td>1/20 Biswa, 1 Biswa has 20 Biswansis</td>
																		</tr>
																	</thead>				
																</table>	
															</div>	
														</div>	
														<!--End Fifth Measure Table-->

														<!--Sixth Measure Table-->
														<div class="card-header pb-0">

															<h3 class="card-title">Land Measurement Units Used in Central India:</h3> 
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table table-striped table-bordered text-wrap w-100">
																	<thead>
																		<tr>
																			<th class="wd-15p">Unit</th>
																			<th class="wd-15p">States Used In</th>
																			<th class="wd-15p">Conversion</th>
																		</tr>
																		<tr>
																			<td>1 Bigha</td>
																			<td>Parts of Madhya Pradesh</td>	
																			<td>1333.33 sq yd</td>
																		</tr>
																		<tr>
																			<td>1 Kattha</td>
																			<td>Madhya Pradesh</td>	
																			<td>600 sq ft, 1 Bigha (MP) has 20 Kathas</td>
																		</tr>
																	</thead>				
																</table>	
															</div>	
														</div>	
														<!--End Sixth Measure Table-->
													</div>	
													
												</div>	
											</div>
										</div>	
									</div>
								</div>	
							</div>

						</div>

						<!-- End page-header -->

						<?php if($this->session->flashdata('insert_property')) :?>

								<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('insert_property'); ?>
                                </div>
      							
    						<?php endif;?> 



						<!--row open-->




						<div class="row">


							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

								<?php if($this->input->post('submit')) {?>
								<?php if(empty($this->input->post('broker_name'))){?>
							<span style="color:red;">Broker Name is Required.</span>
						<?php } ?>

							

						<?php if(empty($this->input->post('commission_type'))){?>
							<br/>
							<span style="color:red;">Broker Commission Type is Required.</span>
						<?php } ?>

							

						<?php if(empty($this->input->post('brokerage_amount'))){?>
							<br/>
							<span style="color:red;">Brokerage Amount is Required.</span>
						<?php } ?>

						

						<?php if(empty($this->input->post('brokerage_amount_paid'))){?>
							<br/>	
							<span style="color:red;">Brokerage Amount To Paid is Required.</span>
						<?php } ?>	


						<?php if($this->input->post('payment_status') == 'Partically Paid' AND empty($this->input->post('partical_amount'))){?>

						<br/>	
							<span style="color:red;">Partically Paid Amount is Required.</span>
						<?php } ?>

							

						<?php if(empty($this->input->post('payment_date'))){?>
							<br/>
							<span style="color:red;">Payment Date is Required.</span>
							<br/>
						<?php } ?>	

						<?php if($this->input->post('property_contract') == 'Lease'){?>

							<span style="color:red;">Please Select Lessee And Lessor Again</span>

								<?php if(empty($this->input->post('leasse_name[0]'))){?>
								<br/>
								<span style="color:red;">Lessee Name is Required.</span>
							<?php } ?>	

							<?php if(empty($this->input->post('leasse_share_in_property[0]'))){?>
								<br/>
								<span style="color:red;">Lessee Share in Property Required.</span>
							<?php } ?>	

							<?php if(empty($this->input->post('leassor_name[0]'))){?>
								<br/>
								<span style="color:red;">Lessor Name is Required.</span>
							<?php } ?>	

							<?php if(empty($this->input->post('leassor_share_in_property[0]'))){?>
								<br/>
								<span style="color:red;">Lessor Share in Property is Required.</span>
							<?php } ?>	
	  
						<?php } ?>	
						
						<?php if($this->input->post('property_contract') == 'Buy'){?>

							<span style="color:red;">Please Select Seller And Purchaser Again</span>

							<?php if(empty($this->input->post('seller_name[0]'))){?>
								<br/>
								<span style="color:red;">Seller Name is Required.</span>
							<?php } ?>	

							<?php if(empty($this->input->post('share_in_property[0]'))){?>
								<br/>
								<span style="color:red;">Seller Share in Property Required.</span>
							<?php } ?>	

							<?php if(empty($this->input->post('purchaser_name[0]'))){?>
								<br/>
								<span style="color:red;">Purchaser Name is Required.</span>
							<?php } ?>	

							<?php if(empty($this->input->post('purchaser_share_in_property[0]'))){?>
								<br/>
								<span style="color:red;">Purchaser Share in Property is Required.</span>
							<?php } ?>	
						<?php } ?>

						<?php if(empty($this->input->post('add_expense[0]'))){?>
								<br/>
								<span style="color:red;">Expense Type is Required.</span>
						<?php } ?>	

						<?php if(empty($this->input->post('expense_amount[0]'))){?>
								<br/>
								<span style="color:red;">Expense Amount is Required.</span>
						<?php } ?>	

						<br/><br/>

					<?php }?>



								<div class="card">



									<div class="card-header pb-0">



										<h3 class="card-title">Add Property Details</h3>



									</div>



									<div class="card-body">




										<?php echo form_open_multipart('Property/property_add', array('id' => 'form'));?>




											<div class="list-group">

												<div class="list-group-item py-3" data-acc-step>

													<h5 class="mb-0" data-acc-title>Property Details</h5>

													<div data-acc-content>

														<div class="my-3">



																	<div class="form-group">



																		<div class="row">



																			<div class="col-lg-6 col-md-12">



																				<label>Property Type</label>



																				<select class="form-control" name="property_type" id="property_type">
																					<option value="">Choose Property Type</option>
																					<?php foreach($property_type as $prop):?>
																						
																						<option value="<?php echo $prop['property_type_id'];?>" <?php echo (set_value('property_type')== $prop['property_type_id'])?" selected=' selected'":""?>><?php echo $prop['property_type'];?></option>
	    																			<?php endforeach; ?>
																				</select>
																				<font color="red"><?=form_error("property_type");?></font>

																			</div>



																			<div class="col-lg-6 col-md-12">





																				<label>Property Title</label>



																				<input type="text" class="form-control" id="property_name" name="property_name" placeholder="Enter Property Title" value="<?php echo set_value('property_name');?>">
																				<font color="red"><?=form_error("property_name");?></font>


																			</div>



																		</div>	

																	</div>



																<div class="form-group">



																	<div class="row">



																		<div class="col-lg-6 col-md-12">



																			<label>Address</label>



																			<input type="text" autocomplete="off" class="form-control" id="my-address" onchange="codeAddress();"  name="address" placeholder="Enter Property Address" value="<?php echo set_value('address');?>">
																				<font color="red"><?=form_error("address");?></font>



																		</div>



																		<div class="col-lg-2 col-md-12">





																			<label>City</label>



																			<input type="text" class="form-control" id="city" name="city" readonly value="<?php echo set_value('city');?>">
																				<font color="red"><?=form_error("city");?></font>





																		</div>



																		<div class="col-lg-2 col-md-12">





																			<label>State</label>



																			<input type="text" class="form-control" id="state" name="state" readonly value="<?php echo set_value('state');?>">
																				<font color="red"><?=form_error("state");?></font>





																		</div>

																		<div class="col-lg-2 col-md-12">





																			<label>Pincode</label>



																			<input type="text" class="form-control" id="pincode" name="pincode"value="<?php echo set_value('pincode');?>">
																				<font color="red"><?=form_error("pincode");?></font>



																		</div>



																	</div>

																</div>





															<div class="form-group">



																<div class="row">



																	<div class=" col-lg-3 col-md-12">



																		<label>Latitude</label>



																		<input type="text" class="form-control" id="lat" name="latitude" readonly value="<?php echo set_value('latitude');?>">
																				<font color="red"><?=form_error("latitude");?></font>



																	</div>





																	<div class="col-lg-3 col-md-12">





																		<label>Longitude</label>



																		<input type="text" class="form-control" id="long" name="longitude" readonly value="<?php echo set_value('longitude');?>">
																				<font color="red"><?=form_error("longitude");?></font>





																	</div>

																	<div class="col-lg-6 col-md-12">



																		<label>Or drag the marker to property position</label>



																		<div style="width: 100%" id="map"></div>
																				
																	</div>												



																</div>	



															</div>



															

															<div class="form-group">



																<div class="row">



																	<div class="col-lg-3 col-md-12">



																		<label>Property Contract</label>			

																		<select name="property_contract" id="property_contract" onchange='checkcontract(this.value);' class="form-control">

																		<option value="Lease" <?php echo (set_value('property_contract')== "Lease")?" selected=' selected'":""?>>Lease</option>

																		<option value="Buy" <?php echo (set_value('property_contract')== "Buy")?" selected=' selected'":""?>>Buy</option>

																		</select>

																		<font color="red"><?=form_error("property_contract");?></font>



																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Unit</label>									

																		<select class="form-control" id="unit" name="unit">

																			<option value="">Choose Property Unit</option>
																					<?php foreach($unit as $u):?>
																						<option value="<?php echo $u['unit_id'];?>" <?php echo (set_value('unit')== $u['unit_id'])?" selected=' selected'":""?>><?php echo $u['unit'];?></option>
	    																			<?php endforeach; ?>

																		

																		</select>
																		<font color="red"><?=form_error("unit");?></font>


																	</div>

																	<div class="col-lg-2 col-md-12">



																		<label>Property Unit</label>



																		<input type="text" class="form-control" id="property_unit" name="property_unit" placeholder="Property Unit" value="<?php echo set_value('property_unit');?>">
																		<font color="red"><?=form_error("property_unit");?></font>	



																	</div>

																	<div class="col-lg-2 col-md-12">





																		<label>Property Price Per Unit</label>



																		<input type="text" class="form-control" id="property_price_per_unit" name="property_price_per_unit" placeholder="Enter Price Per Unit" value="<?php echo set_value('property_price_per_unit');?>">
																		<font color="red"><?=form_error("property_price_per_unit");?></font>





																	</div>

																	<div class="col-lg-2 col-md-12">





																		<label>Total Price</label>



																		<input type="text" class="form-control" id="property_total_price" name="property_total_price" placeholder="Enter Total Price" value="<?php echo set_value('property_total_price');?>" readonly>
																		<font color="red"><?=form_error("property_total_price");?></font>

																	

																	</div>



																</div>	



															</div>



															<div class="form-group" id="building" style="display: none;">



																<div class="row">



																	<div class="col-lg-6 col-md-12">

																		<label>RERA Number</label>



																		<input type="text" class="form-control" id="rera_number" name="rera_number" placeholder="Enter RERA Number" value="<?php echo set_value('rera_number');?>">
																		<font color="red"><?=form_error("rera_number");?></font>

																	</div>

																	

																	<div class="col-lg-6 col-md-12">

																		<label>BU Permission Application Number</label>



																		<input type="text" class="form-control" id="bu_number" name="bu_number" placeholder="Enter BU Number" value="<?php echo set_value('bu_number');?>">
																		<font color="red"><?=form_error("bu_number");?></font>

																	</div>

																</div>

															</div>



																<div class="form-group" id="land" style="display: none;">



																<div class="row">



																	<div class="col-lg-6 col-md-12">

																		<label>Nature of Land</label>



																		 <select class="form-control" id="nature_of_land" name="nature_of_land">

									                                        <option value="">Choose Nature of Land</option>

									                                        <option value="Industrial" <?php echo (set_value('nature_of_land')== "Industrial")?" selected=' selected'":""?>>Industrial</option>

									                                        <option value="Commercial" <?php echo (set_value('nature_of_land')== "Commercial")?" selected=' selected'":""?>>Commercial</option>

									                                        <option value="Residential"  <?php echo (set_value('nature_of_land')== "Residential")?" selected=' selected'":""?>>Residential</option>

                                    									</select>
                                    									<font color="red"><?=form_error("nature_of_land");?></font>

																	</div>

																	

																	<div class="col-lg-6 col-md-12">

																		<label>Type of Land</label>



																		<select class="form-control" id="type_of_land" name="type_of_land">

									                                        	<option value="">Choose Land Type</option>
																					<?php foreach($land_type as $land):?>
																						<option value="<?php echo $land['land_type_id'];?>" <?php echo (set_value('type_of_land')== $land['land_type_id'])?" selected=' selected'":""?>><?php echo $land['land_type'];?></option>
	    																			<?php endforeach; ?>



                                    									</select>
                                    									<font color="red"><?=form_error("type_of_land");?></font>

																	</div>

																</div>

															</div>			


															<div class="form-group">



																<div class="row">



																	<div class="col-lg-4 col-md-12">



																		<label>Property Controller</label>



																		<select class="form-control" name="property_controller">

																			<option value="">Choose Property Controller</option>
																					<?php foreach($property_controller as $controller):?>
																						<option value="<?php echo $controller['user_id'];?>" <?php echo (set_value('property_controller')== $controller['user_id'])?" selected=' selected'":""?>><?php echo $controller['username'];?></option>
	    																			<?php endforeach; ?>

																		</select>
																		<font color="red"><?=form_error("property_controller");?></font>

																	</div>

																	<div class="col-lg-4 col-md-12">



																		<label>Property Group</label>



																		<select class="form-control" name="property_group">

																			<option value="">Choose Property Group</option>
																					<?php foreach($property_group as $group):?>
																						<option value="<?php echo $group['property_group_id'];?>" <?php echo (set_value('property_group')== $group['property_group_id'])?" selected=' selected'":""?>><?php echo $group['property_group'];?></option>
	    																			<?php endforeach; ?>

																		</select>
																		<font color="red"><?=form_error("property_group");?></font>

																	</div>



																	<div class="col-lg-4 col-md-12">



																		<label>Property Jurisdiction</label>



																		<select class="form-control" id="property_jurisdiction" name="property_jurisdiction">

																			<option value="">Choose Property Jurisdiction</option>
																					<?php foreach($jurisdiction as $juri):?>
																						<option value="<?php echo $juri['jurisdiction_id'];?>" <?php echo (set_value('property_jurisdiction')== $juri['jurisdiction_id'])?" selected=' selected'":""?>><?php echo $juri['property_jurisdiction'];?></option>
	    																			<?php endforeach; ?>

																		</select>	
																		<font color="red"><?=form_error("property_jurisdiction");?></font>


																	</div>



																</div>	



															</div>


															<div class="form-group">



																<div class="row">



																	<div class="col-lg-6 col-md-12">



																		<label>Property Purchase Date</label>



																		

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker0" autocomplete="off" placeholder="Purchase Date" name="purchase_date" type="text" value="<?php echo set_value('purchase_date');?>">
																				

																			</div>



																		</div>

																		<font color="red"><?=form_error("purchase_date");?></font>



																	</div>

																	<div class="col-lg-6 col-md-12">



																		<label>Property Satus</label>


																		<select class="form-control" id="status" name="status">

																			<option value="">Choose Property Status</option>
																					<?php foreach($property_status as $pstatus):?>
																						<option value="<?php echo $pstatus['property_status_id'];?>" <?php echo (set_value('status')== $pstatus['property_status_id'])?" selected=' selected'":""?>><?php echo $pstatus['property_status'];?></option>
	    																			<?php endforeach; ?>


																		</select>

																		<font color="red"><?=form_error("status");?></font>


																	</div>



																</div>	



															</div>





															<div class="form-group">



																<div class="row">



																	<div class="col-lg-12 col-md-12">



																		<label>Property Remark</label>



																		<textarea id="elm1" name="property_remark"><?php echo set_value('property_remark');?>
																				</textarea>	


																			<font color="red"><?=form_error("property_remark");?></font>
																	</div>



																	<div class="col-lg-12 col-md-12">

																		<br/>

																		<label>Property Images</label>
																		<br/><label style="color:red;">Supported Image Type is JPEG/JPG/PNG.Size of Image Must not Exceed More than 3 MB.</label>



																	<!-- 	<input type="file" class="dropify" name="property_images[]" id="property_images" multiple="" class="dropify" value="<?php echo set_value('property_images');?>"> -->

																		<input name="userfile[]" id="userfile" type="file" multiple="" class="dropify"/>


																	<font color="red">
																<?php $new_in = $this->session->flashdata('new_in');
															if($new_in==2) { echo "Supported Image Type is JPEG/JPG/PNG.Size of Image Must not Exceed More than 3 MB."; } ?></font>	
																	<font color="red">
																<?php $no_image = $this->session->flashdata('no_image');
															if($no_image==3) { echo "Property Image is Required."; } ?></font>

																	<font color="red" id="preview"></font>



																	</div>

																	

																</div>	



															</div>









														</div>



													</div>



												</div>



												<div class="list-group-item py-3" data-acc-step>



													<h5 class="mb-0" data-acc-title>Broker Details</h5>



													<div data-acc-content>



														<div class="my-3">



															<div class="form-group">



																<div class="row">



																	<div class="col-lg-3 col-md-12">



																		<label>Broker Name</label>



																		<select name="broker_name" id="broker_name" class="form-control">

																			<option value="">Choose Broker</option>

																			<?php foreach($broker as $b):?>

																						<option value="<?php echo $b['user_id'];?>" <?php echo (set_value('broker_name')== $b['user_id'])?" selected=' selected'":""?>><?php echo $b['username'];?></option>
	    																			<?php endforeach; ?>

																		</select>
																		<font color="red"><?=form_error("broker_name");?></font>

																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Broker Comission Type</label>



																			<label class="custom-control custom-radio">



																				<input type="radio" class="custom-control-input" name="commission_type" value="Percentage" <?php echo (set_value('commission_type')== "Percentage")?" Checked=' Checked'":""?>>



																				<span class="custom-control-label" style="color:black;" value="<?php echo set_value('commission_type');?>">Percentage</span>



																			</label>



																			<label class="custom-control custom-radio">



																				<input type="radio" class="custom-control-input" name="commission_type" value="Fixed Amount" <?php echo (set_value('commission_type')== "Fixed Amount")?" Checked=' Checked'":""?>>



																				<span class="custom-control-label" style="color:black;" value="<?php echo set_value('commission_type');?>">Fixed Amount</span>



																			</label>

																			<font color="red"><?=form_error("commission_type");?></font>

																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Brokerage Amount</label>

																		<input type="text" name="brokerage_amount" id="brokerage_amount" name="brokerage_amount" class="form-control" value="<?php echo set_value('brokerage_amount');?>" placeholder="Enter Brokerage Amount">
																		<font color="red"><?=form_error("brokerage_amount");?></font>	

																		

																	</div>



																	<div class="col-lg-3 col-md-12">



																		<label>Brokerage Amount To Be Paid</label>

																		<input type="text" name="brokerage_amount_paid" id="brokerage_amount_paid" name="brokerage_amount_paid" class="form-control" readonly value="<?php echo set_value('brokerage_amount_paid');?>" placeholder="Brokerage Amount To Be Paid">
																				<font color="red"><?=form_error("brokerage_amount_paid");?></font>	

																		

																	</div>



																</div>

															</div>	



															<div class="form-group">



																<div class="row">



																	<div class="col-lg-6 col-md-12">



																		<label>Payment Status</label>


																		<select class="form-control" id="payment_status" name="payment_status" onchange='checkpayment(this.value);'>

																			<option value="Paid" <?php echo (set_value('payment_status')== "Paid")?" selected=' selected'":""?>>Paid</option>

																			<option value="Partically Paid" <?php echo (set_value('payment_status')== "Partically Paid")?" selected=' selected'":""?>>Partically Paid</option>

																			<option value="Not Paid" <?php echo (set_value('payment_status')== "Not Paid")?" selected=' selected'":""?>>Not Paid</option>

																		</select>	

																		<font color="red"><?=form_error("payment_status");?></font>

																	</div>



																	<div class="col-lg-6 col-md-12">



																		<label>Payment Date</label>

																		<div class="wd-200 mg-b-30">



																			<div class="input-group">



																				<div class="input-group-prepend">



																					<div class="input-group-text">



																						<i class="fa fa-calendar tx-16 lh-0 op-6"></i>



																					</div>



																				</div><input class="form-control" id="datepicker1" placeholder="Payment Date" type="text" name="payment_date" value="<?php echo set_value('payment_date');?>">
																				

																			</div>



																		</div>
																		<font color="red"><?=form_error("payment_date");?></font>

																	</div>

																</div>

															</div>



															<div id="partically_paid_amount" style="display: none;">	

																<div class="form-group">



																	<div class="row">



																		<div class="col-lg-6 col-md-12">



																			<label>Partically Paid Amount</label>

																			<input type="text" class="form-control" id="partical_amount" name="partical_amount" placeholder="Enter Partically Paid Amount" value="<?php echo set_value('partical_amount');?>">
																			<font color="red"><?=form_error("partical_amount");?></font>

																		</div>

																	</div>

																</div>

															</div>	



														</div>



													</div>



												</div>





												<div id="leasse_seller">



														<div class="list-group-item py-3" data-acc-step>



														<!--Lease-->

														

															<div id="leasse">



																	<h5 class="mb-0" data-acc-title>Leasse Details</h5>



																	<div data-acc-content>



																		<div class="my-3">



																				<div class="form-group">



																					<div class="row">



																						<div class="col-lg-4 col-md-12 drop">



																							<label>Lessee Name</label>

																							<select id="leasse_name[0]" name="leasse_name[0]" class="form-control">

																								<option value="">Choose Lessee Name</option>

																							 <?php foreach($lesse as $b):?>
																						<option value="<?php echo $b['user_id'];?>" <?php echo (set_value('leasse_name[0]')== $b['user_id'])?" selected=' selected'":""?>><?php echo $b['username'];?></option>
	    																			<?php endforeach; ?>

																							</select>
																							<font color="red"><?=form_error("leasse_name[0]");?></font>

																						</div>





																						<div class="col-lg-4 col-md-12">

																							<label>Share in Property(%)</label>

																							<input type="text" class="form-control" id="leasse_share_in_property[0]"  name="leasse_share_in_property[0]" value="<?php echo set_value('leasse_share_in_property[0]');?>" placeholder="Share in Property">
																							<font color="red"><?=form_error("leasse_share_in_property[0]");?></font>

																						</div>



																						<div class="col-lg-4 col-md-12" style="margin-top: 23px;">

																							<input type="button" class="btn btn-primary" id="addleasse" value="Add" onclick='show_leasse(this.value);'></button>

													                                        <input type="button" class="btn btn-primary" id="removeleasse" value="Remove" disabled></button>



																						</div>



																					</div>

																				</div>



																				<div id="leasse_div" style="display: none;"></div> 



																		</div>



																	</div>

															</div>	



															<!--seller-->

															<div id="seller" style="display:none;">

																

																<h5 class="mb-0" data-acc-title>Seller Details</h5>



																<div data-acc-content>



																	<div class="my-3">



																			<div class="form-group">



																				<div class="row">



																					<div class="col-lg-4 col-md-12">



																						<label>Seller Name</label>

																				

																							<select id="seller_name[0]" name="seller_name[0]" class="form-control" class="temp">

																							<option value="">Choose Seller</option>

																							  <?php foreach($seller as $b):?>
																						<option value="<?php echo $b['user_id'];?>" <?php echo (set_value('seller_name[0]')== $b['user_id'])?" selected=' selected'":""?>><?php echo $b['username'];?></option>
	    																			<?php endforeach; ?>
																							</select>
																							<font color="red"><?=form_error("seller_name[0]");?></font>

																					</div>



																					<div class="col-lg-4 col-md-12">

																						<label>Share in Property(%)</label>

																						<input type="text" class="form-control" id="share_in_property[0]"  name="share_in_property[0]" value="<?php echo set_value('share_in_property[0]');?>" placeholder="Share in Property">
																						<font color="red"><?=form_error("share_in_property[0]");?></font>

																					</div>





																					<div class="col-lg-4 col-md-12" style="margin-top: 23px;">

																						<input type="button" class="btn btn-primary" id="adddoc1" value="Add" onclick='show_seller(this.value);'></button>

												                                        <input type="button" class="btn btn-primary" id="removedoc1" value="Remove" disabled></button>



																					</div>

																				</div>

																			</div>



																			<div id="documentadd1" style="display: none;"></div> 



																		</div>



																	</div>



																</div>

															</div>	



														</div>



												</div>	



												<div id="leassor_purchaser">

													<div class="list-group-item py-3" data-acc-step>

														<div id="leassor">

															<h5 class="mb-0" data-acc-title>Leassor Details</h5>



															<div data-acc-content>



																<div class="my-3">



																	<div class="form-group">



																			<div class="row">



																				<div class="col-lg-4 col-md-12">



																					<label>Lessor Name</label>

																				

																							<select id="leassor_name[0]" name="leassor_name[0]" class="form-control">

																								<option value="">Choose Lessor</option>

																							  <?php foreach($lessor as $b):?>
																						<option value="<?php echo $b['user_id'];?>" <?php echo (set_value('leassor_name[0]')== $b['user_id'])?" selected=' selected'":""?>><?php echo $b['username'];?></option>
	    																			<?php endforeach; ?>

																							</select>
																							<font color="red"><?=form_error("leassor_name[0]");?></font>



																				</div>



																				<div class="col-lg-4 col-md-12">

																					<label>Share in Property(%)</label>

																					<input type="text" class="form-control" id="leassor_share_in_property[0]"  name="leassor_share_in_property[0]" value="<?php echo set_value('leassor_share_in_property[0]');?>" placeholder="Share in Property">
																					<font color="red"><?=form_error("leassor_share_in_property[0]");?></font>
																				</div>





																				<div class="col-lg-4 col-md-12" style="margin-top: 23px;">

																					<input type="button" class="btn btn-primary" id="leassoradd" value="Add" onclick='show_leassor(this.value);'></button>

											                                        <input type="button" class="btn btn-primary" id="leassorremove" value="Remove" disabled></button>



																				</div>



																				



																			</div>

																	</div>



																		<div id="leassor_div" style="display: none;"></div> 



																</div>



															</div>

														</div>

														<div id="purchaser_div" style="display: none;">



															<h5 class="mb-0" data-acc-title>Purchaser Details</h5>



															<div data-acc-content>



																<div class="my-3">



																	<div class="form-group">



																		<div class="row">



																				<div class="col-lg-4 col-md-12">



																					<label>Purchaser Name</label>

																							<select id="purchaser_name[0]" name="purchaser_name[0]" class="form-control">

																							<option value="">Choose Purchaser</option>	

																							  <?php foreach($purchaser as $b):?>
																						<option value="<?php echo $b['user_id'];?>" <?php echo (set_value('purchaser_name[0]')== $b['user_id'])?" selected=' selected'":""?>><?php echo $b['username'];?></option>
	    																			<?php endforeach; ?>

																							</select>
																							<font color="red"><?=form_error("purchaser_name[0]");?></font>

																				</div>



																				<div class="col-lg-4 col-md-12">

																					<label>Share in Property(%)</label>

																					<input type="text" class="form-control" id="purchaser_share_in_property[0]"  name="purchaser_share_in_property[0]" value="<?php echo set_value('purchaser_share_in_property[0]');?>" placeholder="Share in Property">
																					<font color="red"><?=form_error("purchaser_share_in_property[0]");?></font>

																				</div>





																				<div class="col-lg-4 col-md-12" style="margin-top: 23px;">

																					<input type="button" class="btn btn-primary" id="purchaser_add" value="Add" onclick='show_purchaser(this.value);'></button>

											                                        <input type="button" class="btn btn-primary" id="purchaser_remove" value="Remove" disabled></button>



																				</div>



																				



																		</div>

																	</div>		



																		<div id="purchaser" style="display: none;"></div> 



																</div>



															</div>

														</div>	

													</div>	

												</div>	



												<div class="list-group-item py-3" data-acc-step>



													<h5 class="mb-0" data-acc-title>Property Fixed Expenses</h5>

													<div data-acc-content>

														<div class="my-3">

															<div class="form-group">



																<div class="row">



																	<div class="col-lg-4 col-md-12">



																		<label>Add Expense</label>



																		<select class="form-control" id="add_expense[0]" name="add_expense[0]" onchange='show_expense(this.value);'>

																			<option value="">Choose Fixed Expense</option>
																					<?php foreach($fixed_expense as $expense):?>
																						<option value="<?php echo $expense['fixed_expense_id'];?>" <?php echo (set_value('add_expense[0]')== $expense['fixed_expense_id'])?" selected=' selected'":""?>><?php echo $expense['fixed_expense'];?></option>
	    																			<?php endforeach; ?>

																		</select>

																		<font color="red"><?=form_error("add_expense[0]");?></font>

																	</div>



																	<div class="col-lg-4 col-md-12">



																		<label>Expense Amount</label>

																		<input type="text" class="form-control" id="expense_amount[0]" name="expense_amount[0]" placeholder="Enter Expense Amount" value="<?php echo set_value('expense_amount[0]');?>">
																		<font color="red"><?=form_error("expense_amount[0]");?></font>


																	</div>



																	<div class="col-lg-4 col-md-12" style="margin-top: 23px;">

																		<input type="button" class="btn btn-primary" id="expense_add" value="Add" onclick='showmore_expense(this.value);'></button>

											                            <input type="button" class="btn btn-primary" id="expense_remove" value="Remove" disabled></button>



																	</div>

																</div>

															</div>

															



																

															<div id="expense_more" class="expense_more" style="display: none;"></div>  					

														</div>

													</div>

												</div>





												<!--Wizrad Completes Here-->



											</div>



										</form>



									</div>



								</div>



							</div>



						</div>



						<!--row closed-->







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



        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfDqf_FB1kdwhjUeTPsUViVuzaamCrHwU&libraries=places&callback=initMap"></script>


		<script src="<?=base_url();?>assets/js/gmap.js"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfDqf_FB1kdwhjUeTPsUViVuzaamCrHwU&libraries=places&callback=initMap"></script>

<script>
	function initMap(lat,long) {

		

		var setlat = '<?php echo set_value("latitude");?>';
		var setlng = '<?php echo set_value("longitude");?>';


		if((setlat !== '' || setlng !== ''))
		{

		//	
			
			var lat = document.getElementById("lat").value;
			var lng = document.getElementById("long").value;

			

			var myLatLng = { lat: parseFloat(lat), lng: parseFloat(lng) };

		}
		else if((lat == '' || long == '') || (lat == undefined || long == undefined))
		{
			var myLatLng = {lat: 23.022505, lng: 72.5713621};
		}
		else
		{
			var myLatLng = {lat: lat, lng: long};
		}
	


var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 10,
  center: myLatLng
});

var marker = new google.maps.Marker({
  position: myLatLng,
  map: map,
  draggable: true,
  title: 'Hello World!'
});

var lat = marker.getPosition().lat();
var lng = marker.getPosition().lng();

document.getElementById("lat").value = marker.getPosition().lat();
		document.getElementById("long").value = marker.getPosition().lng();

		google.maps.event.addListener(marker, 'dragend', function (event) {
document.getElementById("lat").value = this.getPosition().lat();
document.getElementById("long").value = this.getPosition().lng();
coordinates_to_address(this.getPosition().lat(), this.getPosition().lng());
});


}

function coordinates_to_address(lat, lng) {
	

	var geocoder = new google.maps.Geocoder();


var latlng = new google.maps.LatLng(lat, lng);

geocoder.geocode({'latLng': latlng}, function(results, status) {
	
	if(status == google.maps.GeocoderStatus.OK) {
		if(results[0]) {
			$('#my-address').val(results[0].formatted_address);
			var add= results[0].formatted_address ;
			var  value=add.split(",");

				count=value.length;
				country=value[count-1];
				state=value[count-2];
				city=value[count-3];

				var pincode  = state.split(" ");
				var lastVar = pincode.pop();
				var restVar = pincode.join(" ");

				$('#state').val(restVar);
				$('#city').val(city);
				$('#pincode').val(lastVar);
				

		} else {
			alert('No results found');
		}
	} else {
		var error = {
			'ZERO_RESULTS': 'Kunde inte hitta adress'
		}

		// alert('Geocoder failed due to: ' + status);
		$('#my-address').html('<span class="color-red">' + error[status] + '</span>');
	}
});
}

</script>

 


																			

		<!-- Forn-wizard js-->



		<script src="<?=base_url();?>assets/plugins/formwizard/jquery.smartWizard.js"></script>



		<script src="<?=base_url();?>assets/plugins/formwizard/fromwizard.js"></script>







		<!--Accordion-Wizard-Form js-->



		<script src="<?=base_url();?>assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>



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



		<!-- WYSIWYG Editor js -->



		<script src="<?=base_url();?>assets/plugins/wysiwyag/jquery.richtext.js"></script>



		<script src="<?=base_url();?>assets/plugins/wysiwyag/richText1.js"></script>







		<!--Summernote js-->



		<script src="<?=base_url();?>assets/plugins/summernote/summernote-bs4.js"></script>



		<script src="<?=base_url();?>assets/js/summernote.js"></script>







		<!--ckeditor js-->



		<script src="<?=base_url();?>assets/plugins/tinymce/tinymce.min.js"></script>



		<script src="<?=base_url();?>assets/js/formeditor.js"></script>







		



		<!-- Timepicker js -->



		<script src="<?=base_url();?>assets/plugins/time-picker/jquery.timepicker.js"></script>



		<script src="<?=base_url();?>assets/plugins/time-picker/toggles.min.js"></script>







		<!-- Datepicker js -->



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/spectrum.js"></script>



		<script src="<?=base_url();?>assets/plugins/spectrum-date-picker/jquery-ui.js"></script>



		<script src="<?=base_url();?>assets/plugins/input-mask/jquery.maskedinput.js"></script>









		<!--Advanced Froms js-->



		<script src="<?=base_url();?>assets/js/advancedform.js"></script>


		<script>
const EL_browse  = document.getElementById('userfile');
const EL_preview = document.getElementById('preview');

const readImage  = file => {
  if ( !(/^image\/(png|jpe?g|gif)$/).test(file.type) )
    return EL_preview.insertAdjacentHTML('beforeend', `Unsupported format ${file.type}: ${file.name}<br>`);

  const img = new Image();

  
  if((Math.round(file.size/1024) > 3072))
    {
      img.addEventListener('load', () => {
    EL_preview.insertAdjacentHTML('beforeend', `<div>FILE TOO LARGE PLEASE UPLOAD FILE LESS THEN 3 MB.<div>`);
    window.URL.revokeObjectURL(img.src); // Free some memory

		$('.btn-primary').css('pointer-events','none');

  });
    }
	else
	{
		$('.btn-primary').css('pointer-events','auto');
	}

  
  
  
  img.src = window.URL.createObjectURL(file);
}

EL_browse.addEventListener('change', ev => {
  EL_preview.innerHTML = ''; // Remove old images and data
  const files = ev.target.files;
  if (!files || !files[0]) return alert('File upload not supported');
  [...files].forEach( readImage );
});
</script>






		<script>


			$(document).ready(function(){
				$('input:submit').attr('name','submit');

				
	});
		</script>


		<script>

			 $(document).ready(function() {
	
			 		var val = document.getElementById('payment_status').value;
			 		checkpayment(val);

			 	
			 });


			function checkpayment(val){

				 var element=document.getElementById('partically_paid_amount');

				 if(val=='Partically Paid')

				   element.style.display='block';

				 else  

				   element.style.display='none';

				}





				function show_seller(val){

				 var element=document.getElementById('documentadd1');

				   element.style.display='block';

				}



				function show_purchaser(val){

				 var element=document.getElementById('purchaser');

				   element.style.display='block';

				}



				function show_leasse(val){

				 var element=document.getElementById('leasse_div');

				   element.style.display='block';

				}



				function show_leassor(val){

				 var element=document.getElementById('leassor_div');

				   element.style.display='block';

				}



				function showmore_expense(val){

				 var element=document.getElementById('expense_more');

				   element.style.display='block';

				}



				$('#property_type').on('change',function(){
				   var val = this.options[this.selectedIndex].text;
				   
				    var element=document.getElementById('building');


				    if(val=='Building/Warehouse/Commercial Building'){

					   element.style.display='block'; }

					 else  { 

					   element.style.display='none';

					}



					 var element1=document.getElementById('land');



					  if(val=='Agricultural Land' || val=='N/A Land'){

					   element1.style.display='block'; }

					 else  { 

					   element1.style.display='none';

					}

				});

				


		</script>

		<script type="text/javascript">
			$(document).ready(function() { 
								   var val = $('#property_type option:selected').html();
								  
				    var element=document.getElementById('building');


				    if(val=='Building/Warehouse/Commercial Building'){

					   element.style.display='block'; }

					 else  { 

					   element.style.display='none';

					}



					 var element1=document.getElementById('land');



					  if(val=='Agricultural Land' || val=='N/A Land'){

					   element1.style.display='block'; }

					 else  { 

					   element1.style.display='none';

					}	
			});
		</script>

		

		<script type="text/javascript">		


			 $(document).ready(function() {
	
			 		var val = document.getElementById('property_contract').value;
			 		checkcontract(val);

			 	
			 });



				function checkcontract(val){

				 var element=document.getElementById('seller');

				 var element1=document.getElementById('purchaser_div');

				 var element2=document.getElementById('leasse');

				 var element3=document.getElementById('leassor');

				 if(val=='Buy'){

				   element.style.display='block';

				    element1.style.display='block';

				   }

				 else { 

				   element.style.display='none';

				   element1.style.display='none';

				}



				if(val=='Lease'){

				   element2.style.display='block';

				    element3.style.display='block';

				   }

				 else { 

				   element2.style.display='none';

				   element3.style.display='none';

				}

			}	

				

		</script>





		<script>

          var max_fields      = 10;

    var x = 1;

        $(document).ready(function() {

            $("#adddoc1").on("click", function() {

                if(x < max_fields){ 



               $("#documentadd1").append('<div class="form-group"><div class="row"><div class="col-lg-4 col-md-12"><label>Seller Name</label><select id="seller_name['+x+']" name="seller_name['+x+']" class="form-control"><option value="">Choose Seller</option><?php foreach($seller as $b):?><option value="<?php echo $b['user_id'];?>"><?php echo $b['username'];?></option><?php endforeach; ?></select></div><div class="col-lg-4 col-md-12"><label>Share in Property</label><input type="text" class="form-control" id="share_in_property['+x+']"  name="share_in_property['+x+']" placeholder="Share in Property"></div></div></div>');

                x++;

            }

             $('#removedoc1').attr("disabled", false);

            

            

            });

             $("#removedoc1").on("click", function() {

                $("#documentadd1").children().last().remove();

            });

        });



    </script>



	<script>

          var max_fields      = 10;

    var x1 = 1;

        $(document).ready(function() { 

            $("#purchaser_add").on("click", function() {

                if(x1 < max_fields){ 



               $("#purchaser").append('<div class="form-group"><div class="row"><div class="col-lg-4 col-md-12"><label>Purchaser Name</label><select id="purchaser_name['+x1+']" name="purchaser_name['+x1+']" class="form-control"><option value="">Choose Purchaser</option><?php foreach($purchaser as $b):?><option value="<?php echo $b['user_id'];?>"><?php echo $b['username'];?></option><?php endforeach; ?></select></div><div class="col-lg-4 col-md-12"><label>Share in Property</label><input type="text" class="form-control" id="purchaser_share_in_property['+x1+']"  name="purchaser_share_in_property['+x1+']" placeholder="Share in Property"></div></div></div>');

                x1++;

            }

             $('#purchaser_remove').attr("disabled", false);

            

            

            });

             $("#purchaser_remove").on("click", function() {

                $("#purchaser").children().last().remove();

            });

        });



    </script>



    <script>


          var max_fields      = 10;

    var x2 = 1;

        $(document).ready(function() {

            $("#addleasse").on("click", function() {

                if(x2 < max_fields){ 
					

               $("#leasse_div").append('<div class="form-group"><div class="row"><div class="col-lg-4 col-md-12"><label>Lessee Name</label><select  id="leasse_name['+x2+']" name="leasse_name['+x2+']" class="form-control" class="temp"><option value="">Choose Lessee</option> <?php foreach($lesse as $b):?><option value="<?php echo $b['user_id'];?>"><?php echo $b['username'];?></option><?php endforeach; ?></select></div><div class="col-lg-4 col-md-12"><label>Share in Property</label><input type="text" class="form-control" id="leasse_share_in_property['+x2+']"  name="leasse_share_in_property['+x2+']" placeholder="Share in Property"></div></div></div>');			

                x2++;

            }

             $('#removeleasse').attr("disabled", false);
            

            });

             $("#removeleasse").on("click", function() {

                $("#leasse_div").children().last().remove();

            });

 


            /* $('.drop').on('change', function () {

             	var selectedValue = $("option:selected", this).val();
  				var elementName = ($(this).attr('id'));
       				$(this).siblings('.drop').find('option[value="' + $(selectedValue).val() + '"]').remove();
  			});*/



        });



    </script>



	<script>

          var max_fields      = 10;

    var x3 = 1;

        $(document).ready(function() {
            $("#leassoradd").on("click", function() {

                if(x3 < max_fields){ 



               $("#leassor_div").append('<div class="form-group"><div class="row"><div class="col-lg-4 col-md-12"><label>Lessor Name</label><select id="leassor_name['+x3+']" name="leassor_name['+x3+']" class="form-control"><option value="">Choose Lessor</option><?php foreach($lessor as $b):?><option value="<?php echo $b['user_id'];?>"><?php echo $b['username'];?></option><?php endforeach; ?></select></div><div class="col-lg-4 col-md-12"><label>Share in Property</label><input type="text" class="form-control" id="leassor_share_in_property['+x3+']"  name="leassor_share_in_property['+x3+']" placeholder="Share in Property"></div></div></div>');

                x3++;

            }

             $('#leassorremove').attr("disabled", false);

            

            

            });

             $("#leassorremove").on("click", function() {

                $("#leassor_div").children().last().remove();

            });

        });



    </script>



    <script>

          var max_fields      = 10;

    var x4 = 1;

        $(document).ready(function() {

            $("#expense_add").on("click", function() {

                if(x4 < max_fields){ 



			   $("#expense_more").append('<div class="form-group"><div class="row"><div class="col-lg-4 col-md-12"><label>Add Expense</label><select class="form-control" id="add_expense['+x4+']" name="add_expense['+x4+']"><option value="">Choose Fixed Expense</option><?php foreach($fixed_expense as $expense):?><option value="<?php echo $expense['fixed_expense_id'];?>"><?php echo $expense['fixed_expense'];?></option><?php endforeach; ?></select></div><div class="col-lg-4 col-md-12"><label>Expense Amount</label><input type="text" class="form-control" id="expense_amount['+x4+']" name="expense_amount['+x4+']" placeholder="Enter Expense Amount"></div><div class="col-lg-4 col-md-12" style="margin-top: 23px;"></div></div></div>');

			   

                x4++;

            }

             $('#expense_remove').attr("disabled", false);

            

            

            });

             $("#expense_remove").on("click", function() {

                $("#expense_more").children().last().remove();

            });



             

        });



    </script>

    <script>
    	$('#property_price_per_unit').change(function(){
            
                 	var unit = document.getElementById('property_unit').value;
                 	var price_per_unit = document.getElementById('property_price_per_unit').value;

                 	var total_price = unit * price_per_unit;

                 var price = total_price.toFixed(2);
 			 
 			 	  	 $("#property_total_price").val(price);
 			 	  
            }); 

    	$('#brokerage_amount').change(function(){
            if($("input[type=radio][name=commission_type]").is(":checked")) {

            	var element1=$('input[name="commission_type"]:checked').val();

 			 	  if (element1 == 'Fixed Amount') {
 			 	  	var brokerage_amount = document.getElementById('brokerage_amount').value;
 			 	  	  var amount = parseFloat(brokerage_amount).toFixed(2);
 			 	  	 $("#brokerage_amount_paid").val(amount);
 			 	  }
 			 	  else{

 			 	  	var brokerage_amount = document.getElementById('brokerage_amount').value;
 			 	  	var total_price = document.getElementById('property_total_price').value;

 			 	  	var amount_to_paid = (total_price * brokerage_amount) / 100;
 			 	  	  var amount = amount_to_paid.toFixed(2);
 			 	  	 $("#brokerage_amount_paid").val(amount);

 			 	  }
            }
                 	
            }); 
             
             
    </script>


 

 <!-- Custom js-->



 <script src="<?=base_url();?>assets/js/custom.js"></script>





	</body>



</html>