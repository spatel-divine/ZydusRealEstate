<style type="text/css">
			.card-title
			{
				font-size: 20 !important;
			}
		</style>

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



		<!--Sidemenu css-->

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

		<!-- Data table css -->



		<link href="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />



		<link href="<?=base_url();?>assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />




		<!-- Color-skins css -->

		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?=base_url();?>assets/colors/color-skins/color.css" />

		<link rel="stylesheet" href="<?=base_url();?>assets/css/demo-styles.css"/>

		<style>
			.input-color {
    			position: relative;
			}
			.input-color input {
			    padding-left: 20px;
			}
			.input-color .color-box {
			    width: 10px;
			    height: 10px;
			    display: inline-block;
			    background-color: #ccc;
			    position: absolute;
			    left: 5px;
			    top: 5px;
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

				<!--/app-header-->

				<!-- Sidebar menu-->

				<?php include('sidebar.php'); ?>

				<!--sidemenu end-->

                <!-- app-content-->

				<div class="app-content  my-3 my-md-5">

					<div class="side-app">



					    <!-- page-header -->
						<div class="page-header">

							<ol class="breadcrumb"><!-- breadcrumb -->

								<li class="breadcrumb-item"><a href="#">Home</a></li>

								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>

							</ol><!-- End breadcrumb -->

							<ol class="breadcrumb"><!-- breadcrumb -->

								<li> <b>Last Login Date & Time: </b><?php foreach ($last_log as $log){ $ip = $log['ip'];?><?=  date("d-m-Y", strtotime($log['date']))." ".$log['time']; ?><?php?>&nbsp;&nbsp; <b>Last Login IP Address :</b> <?= $ip;?> <?php }?></li>

							</ol><!-- End breadcrumb -->

							<!-- <div class="ml-auto">

								<div class="input-group">

									<a href="#" class="btn btn-secondary text-white mr-2 btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Rating">

										<span>

											<i class="fa fa-star"></i>

										</span>

									</a>

									<a href="lockscreen.html" class="btn btn-primary text-white mr-2 btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="lock">

										<span>

											<i class="fa fa-lock"></i>

										</span>

									</a>

									<a href="#" class="btn btn-warning text-white btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add New">

										<span>

											<i class="fa fa-plus"></i>

										</span>

									</a>

								</div>

							</div> -->

						</div>

						<!-- End page-header -->
					

						<div class="row">



							<?php $access = explode(",",$prop_access);?>

							<div class="col-sm-12 col-lg-6 col-xl-3">

								<div class="card overflow-hidden">

									<div class="card-header custom-header pb-0">

										<div>

											<h1 class="card-title">Total Properties</h2>

											<!-- <h6 class="card-subtitle"></h6> -->

										</div>

										<!-- <div class="card-options">

											<label class="custom-switch">

												<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" checked>

												<span class="custom-switch-indicator"></span>

											</label>

										</div> -->

									</div>

									<div class="card-body">

									

										<div class="row">

											<div class="col-8">

												<!-- <h6 class="text-body text-uppercase font-weight-semibold">Total Projects</h6> -->

												<h2 class="text-primary count mt-0 font-30 mb-0">

													<?php foreach ($total_property as $prop){

                              	 						$property_id[] = $prop['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $prop['property_id']){ ?><?php $property += count($prop['property_id']); ?><?php }}} if(!empty($property)){ ?><?= $property; ?><?php } else { echo 0; }?>
														

													</h2>

											</div>

											<div class="col-4">

												<img src="<?=base_url();?>assets/images/svg/chart.svg" alt="imag" class="w-40 text-right float-right">

											</div>

										</div>

									</div>

								</div>

							</div><!-- col end -->



							<div class="col-sm-12 col-lg-6 col-xl-3">

								<div class="card overflow-hidden">

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Property Given on Rent</h3>

											<!-- <h6 class="card-subtitle">Overview of this month</h6> -->

										</div>

										<!-- <div class="card-options">

											<label class="custom-switch">

												<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" >

												<span class="custom-switch-indicator"></span>

											</label>

										</div> -->

									</div>

									<div class="card-body">

										

										<div class="row">

											<div class="col-8">

												<!-- <h6 class="text-body text-uppercase font-weight-semibold">Total Employess</h6> -->

												<h2 class="text-primary count mt-0 font-30 mb-0">                              	 					<?php foreach ($property_given_on_rent as $given){

                              	 						$property_id[] = $given['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $given['property_id']){ ?><?php $property_given += count($given['lease_given_id']); ?><?php }}} if(!empty($property_given)){ ?><?= $property_given; ?><?php } else { echo 0; }?></h2>

											</div>

											<div class="col-4">

												<img src="<?=base_url();?>assets/images/svg/businessman.svg" alt="imag" class="w-40 text-right float-right">

											</div>

										</div>

									</div>

								</div>

							</div><!-- col end -->

							<div class="col-sm-12 col-lg-6 col-xl-3">

								<div class="card overflow-hidden">

									<div class="card-header custom-header pb-0">

										<div>

										<h3 class="card-title">Property Taken on Rent</h3>

											<!-- <h6 class="card-subtitle">Overview of this month</h6> -->

										</div>

										<!-- <div class="card-options">

											<label class="custom-switch">

												<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">

												<span class="custom-switch-indicator"></span>

											</label>

										</div> -->

									</div>

									<div class="card-body">

									

										<div class="row">

											<div class="col-8">

												<!-- <h6 class="text-body text-uppercase font-weight-semibold">Total Tasks</h6> -->

												<h2 class="text-primary count mt-0 font-30 mb-0">                              	 					<?php foreach ($property_taken_on_rent as $taken){

                              	 						$property_id[] = $taken['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $taken['property_id']){ ?><?php $property_taken += count($taken['lease_own_id']); ?><?php }}} if(!empty($property_taken)){ ?><?= $property_taken; ?><?php } else { echo 0; }?></h2>

											</div>

											<div class="col-4">

												<img src="<?=base_url();?>assets/images/svg/list.svg" alt="imag" class="w-40 text-right float-right">

											</div>

										</div>

									</div>

								</div>

							</div><!-- col end -->

							<div class="col-sm-12 col-lg-6 col-xl-3">

								<div class="card overflow-hidden">

									<div class="card-header custom-header pb-0">

										<div>

										<h3 class="card-title">Total Legal Cases</h3>

											<!-- <h6 class="card-subtitle">Overview of this month</h6> -->

										</div>

										<!-- <div class="card-options">

											<label class="custom-switch">

												<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">

												<span class="custom-switch-indicator"></span>

											</label>

										</div> -->

									</div>

									<div class="card-body">

										

										<div class="row">

											<div class="col-8">

												<!-- <h6 class="text-body text-uppercase font-weight-semibold">Total Earnings</h6> -->

												<h2 class="text-primary count mt-0 font-30 mb-0">                              	 					<?php foreach ($legal_cases as $case){

                              	 						$property_id[] = $case['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $case['property_id']){ ?><?php $total_cases += count($case['legal_id']); ?><?php }}} if(!empty($total_cases)){ ?><?= $total_cases; ?><?php } else { echo 0; }?></h2>

												
											</div>

											<div class="col-4">

												<img src="<?=base_url();?>assets/images/svg/investment.svg" alt="imag" class="w-40 text-right float-right">

											</div>

										</div>

									</div>

								</div>

							</div><!-- col end -->

						</div>



						<div class="row">

							<div class="col-xxl-12 col-lg-12 col-md-12">

								<div class="card icon-iconfont">

									<div class="row">

										<div class="col-lg-4 border-right">

											<div class="card-body iconfont">

												<div class="row">

													<div class="col">

														<h6 class="text-uppercase">Rent Payable</h6>

															<h3 class="mt-2 mb-1 text-dark mainvalue font-weight-semibold"> 	<?php foreach ($rent_payable_total as $payable){

                              	 						$property_id[] = $payable['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $payable['property_id']){ $rent_payable += $payable['lease_amount'];  }}}?> <?php if(!empty($rent_payable)){ ?><?= ₹."".$rent_payable; ?> <?php } else { echo "0.00"; }?></h3>
                                                               

														<p class="text-muted"><span class="text-body font-weight-semibold"> </span> in this month</p>

													</div>

													<div class="col col-auto feature">

														<div class="fa-stack fa-lg fa-1x border bg-primary mb-3">

															<i class="fa fa-rupee fa-stack-1x text-white"></i>

														</div>

													</div>

												</div>


											</div>

										</div>

										<div class="col-lg-4 border-right">

											<div class="card-body iconfont">

												<div class="row">

													<div class="col">

														<h6 class="text-uppercase">Installment Payable</h6>

														
														<h3 class="mt-2 mb-1 text-dark mainvalue font-weight-semibold"><?php foreach ($installment_payable_total as $installment){

                              	 						$property_id[] = $installment['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $installment['property_id']){ $loan_installment += $installment['installment_amount'];  }}}?> <?php if(!empty($loan_installment)){ ?><?= ₹."".$loan_installment; ?> <?php } else { echo "0.00"; }?></h3>

														<p class="text-muted"><span class="text-body font-weight-semibold"></span> in this month</p>

													</div>

													<div class="col col-auto feature">

														<div class="fa-stack fa-lg fa-1x border bg-secondary mb-3">

															<i class="fa fa-rupee fa-stack-1x text-white"></i>

														</div>

													</div>

												</div>
											
											</div>

										</div>

										<div class="col-lg-4">

											<div class="card-body iconfont">

												<div class="row">

													<div class="col">

														<h6 class="text-uppercase">Insurance Renewable</h6>


															<h3 class="mt-2 mb-1 text-dark mainvalue font-weight-semibold"><?php foreach ($insurance_renew_total as $insurance){

                              	 						$property_id[] = $insurance['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $insurance['property_id']){ $insurance_premium += $insurance['premium_amount'];  }}}?> <?php if(!empty($insurance_premium)){ ?><?= ₹."".$insurance_premium; ?> <?php } else { echo "0.00"; }?></h3>

														<p class="text-muted"><span class="text-body font-weight-semibold"></span> in this month</p>

													</div>

													<div class="col col-auto feature">

														<div class="fa-stack fa-lg fa-1x border bg-red mb-3">

															<i class="fa fa-rupee fa-stack-1x text-white"></i>

														</div>

													</div>

												</div>

												<!-- <div class="progress progress-sm mb-0 mt-0">

													<div class="progress-bar progress-bar-striped progress-bar-animated bg-red w-70"></div>

												</div> -->

											</div>

										</div>

									</div>

								</div>


							</div>

							

						</div>

						<?php foreach ($total_property as $prop){

                              		$property_id[] = $prop['property_id'];

                              		$count_property += count($prop['property_id']);
                              } 					
                              $access_count = count($access); if($access_count == $count_property){ ?>

                              							<div class="row row-deck">

								<div class="col-xxl-4  col-xl-4 col-lg-4 col-md-12">

									<div class="card d-inline-block overflow-hidden">

										<div class="card-header custom-header pb-0">

											<div>

												<h3 class="card-title">Property Count</h3>

												<h6 class="card-subtitle">Property Type Wise</h6>

											</div>

										

										</div>

										<div class="card-body">


											<div id="pieChart1" class="mn-auto"></div>
														
													 <div class="input-color">
											            <input style="border:0px;" type="text" value="Type 1" readonly />
											            <div class="color-box" style="background-color: rgba(70, 127, 207, 0.85);"></div>
											            <!-- Replace "#FF850A" to change the color -->
											        </div>

											        <div class="input-color" style="float: right;margin-top: -27px;margin-right: -4px;">
											            <input style="border:0px;" type="text" value="House/Flat" readonly/>
											            <div class="color-box" style="background-color: rgba(94, 186, 0, 0.85);"></div>
											            <!-- Replace "#FF850A" to change the color -->
											        </div>		

											        <div class="input-color" style="overflow:visible;">
											            <input type="text" style="border:0px; width: 288px !important;padding-bottom: 4px;" value="Building/Warehouse/Commercial Building" readonly/>
											            <div class="color-box" style="background-color: rgba(255, 202, 74, 0.85);"></div>
											            <!-- Replace "#FF850A" to change the color -->
											        </div>		

											        <div class="input-color">
											            <input style="border:0px;" type="text" value="Agricultural Land" readonly/>
											            <div class="color-box" style="background-color: rgba(255, 102, 102, 0.85);"></div>
											            <!-- Replace "#FF850A" to change the color -->
											        </div>		

											        <div class="input-color" style="float: right;margin-top: -20px;margin-right: -4px;">
											            <input style="border:0px;" type="text" value="N/A Land" readonly/>
											            <div class="color-box" style="background-color: rgba(15, 134, 134, 0.85);"></div>
											            <!-- Replace "#FF850A" to change the color -->
											        </div>				
										</div>

									</div>

								</div>

							<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12">
								<div class="card">

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Insurance Renewals (Current Month)</h3>


										</div>

										

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table id="example" class="table border table-bordered text-nowrap mb-0">

												<thead>

													<tr>

														<th>NO</th>

														<th>Property Name</th>

														<th>Premium Amount</th>

														<th>Premium Date</th>														

													</tr>

												</thead>

												<tbody>

													<?php $i = 1; foreach ($insurance_renew_list as $list) {
														$property_id[] = $list['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $list['property_id']){ 
													 ?>

													<tr>

														<td><?php echo $i++; ?></td>

														<td><?php echo $list['property_name']; ?></td>

														<td><?php echo $list['premium_amount']; ?></td>

														<td><?php echo  date("d-m-Y", strtotime($list['next_premium_date'])); ?></td>

														
													</tr>

												<?php }}} ?>

													

												</tbody>

											</table>

										</div>

									</div>

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Installments Payable (Current Month)</h3>


										</div>

										

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table id="example1" class="table border table-bordered text-nowrap mb-0">

												<thead>

													<tr>

														<th>NO</th>

														<th>Property Name</th>

														<th>Installment Amount</th>

														<th>Bank Name</th>														

													</tr>

												</thead>

												<tbody>

													<?php $i = 1; foreach ($installment_payable_list as $list) {

														$property_id[] = $list['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $list['property_id']){ 
													 ?>

													<tr>

														<td><?php echo $i++; ?></td>

														<td><?php echo $list['property_name']; ?></td>

														<td><?php echo $list['installment_amount']; ?></td>

														<td><?php echo $list['bank_name']; ?></td>

														
													</tr>

												<?php }}} ?>

													

												</tbody>

											</table>

										</div>

									</div>

								</div>
							</div>

						</div>

                       <?php } else { ?> 

						<div class="row row-deck">

							<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
								<div class="card">

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Insurance Renewals (Current Month)</h3>


										</div>

										

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table id="example" class="table border table-bordered text-nowrap mb-0">

												<thead>

													<tr>

														<th>NO</th>

														<th>Property Name</th>

														<th>Premium Amount</th>

														<th>Premium Date</th>														

													</tr>

												</thead>

												<tbody>

													<?php $i = 1; foreach ($insurance_renew_list as $list) {
														$property_id[] = $list['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $list['property_id']){ 
													 ?>

													<tr>

														<td><?php echo $i++; ?></td>

														<td><?php echo $list['property_name']; ?></td>

														<td><?php echo $list['premium_amount']; ?></td>

														<td><?php echo  date("d-m-Y", strtotime($list['next_premium_date'])); ?></td>

														
													</tr>

												<?php }}} ?>

													

												</tbody>

											</table>

										</div>

									</div>

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Installments Payable (Current Month)</h3>


										</div>

										

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table id="example1" class="table border table-bordered text-nowrap mb-0">

												<thead>

													<tr>

														<th>NO</th>

														<th>Property Name</th>

														<th>Installment Amount</th>

														<th>Bank Name</th>														

													</tr>

												</thead>

												<tbody>

													<?php $i = 1; foreach ($installment_payable_list as $list) {

														$property_id[] = $list['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $list['property_id']){ 
													 ?>

													<tr>

														<td><?php echo $i++; ?></td>

														<td><?php echo $list['property_name']; ?></td>

														<td><?php echo $list['installment_amount']; ?></td>

														<td><?php echo $list['bank_name']; ?></td>

														
													</tr>

												<?php }}} ?>

													

												</tbody>

											</table>

										</div>

									</div>

								</div>
							</div>

						</div>

                       <?php } ?>


						<div class="row row-deck">

							<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
								<div class="card">

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Rent Payable Intimation</h3>


										</div>

										

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table class="table border table-bordered text-nowrap mb-0 example5">

												<thead>

													<tr>

														<th>NO</th>

														<th>Property Name</th>

														<th>Start Date</th>

														<th>End Date</th>

														<th>Lease Amount</th>	

														<th>Increment Date</th>	

														<th>Status</th>												

													</tr>

												</thead>

												<tbody>

													<?php $i = 1; foreach ($lease_own as $own) {


                              	 						$property_id[] = $own['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $own['property_id']){ 

													 ?>

													<tr>

														<td><?php echo $i++; ?></td>

														<td><?php echo $own['property_name']; ?></td>

														<td><?php echo  date("d-m-Y", strtotime($own['start_date'])); ?></td>

														<td><?php echo  date("d-m-Y", strtotime($own['end_date'])); ?></td>

														<td><?php echo $own['lease_amount']; ?></td>

														<?php if(!empty($own['lease_increment_date'])){ ?>

															<td><?php echo  date("d-m-Y", strtotime($own['lease_increment_date'])); ?></td>

														<?php } else { ?>
															<td><b>Increment Date Not Available</b></td>
														<?php } ?> 

													<td><?php $current_date = date('Y-m-d');

													if($own['end_date'] > $current_date ) {

													 ?>

													 	<a class="btn btn-success" href="#"> Ongoing</a>
														
														
													<?php }  else { ?>
														<a class="btn btn-danger" href="#"> Expired</a>
													<?php } ?>	
													</td>
														
													</tr>

												<?php }}} ?>

													

												</tbody>

											</table>

										</div>

									</div>

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Rent Receivable Intimation</h3>


										</div>

										

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table class="table border table-bordered text-nowrap mb-0 example5">

												<thead>

													<tr>

														<th>NO</th>

														<th>Property Name</th>

														<th>Start Date</th>

														<th>End Date</th>

														<th>Lease Amount</th>	

														<th>Increment Date</th>		

														<th>Status</th>												

													</tr>

												</thead>

												<tbody>

													<?php $i = 1; foreach ($lease_given as $given) {
														$property_id[] = $given['property_id'];

														$common_access = array_intersect($access,$property_id);

														foreach($common_access as $acc){
                              	 							if($acc == $given['property_id']){
													 ?>

													<tr>

														<td><?php echo $i++; ?></td>

														<td><?php echo $given['property_name']; ?></td>

														<td><?php echo  date("d-m-Y", strtotime($given['start_date'])); ?></td>

														<td><?php echo  date("d-m-Y", strtotime($given['end_date'])); ?></td>

														<td><?php echo $given['lease_amount']; ?></td>

														<?php if(!empty($given['lease_increment_date'])){ ?>

															<td><?php echo  date("d-m-Y", strtotime($given['lease_increment_date'])); ?></td>

														<?php } else { ?>
															<td><b>Increment Date Not Available</b></td>
														<?php } ?> 
														
														<td><?php $current_date1 = date('Y-m-d');

													if($given['end_date'] > $current_date1 ) {

													 ?>

													 	<a class="btn btn-success" href="#"> Ongoing</a>
														
														
													<?php }  else { ?>
														<a class="btn btn-danger" href="#"> Expired</a>
													<?php } ?>	
													</td>
														
													</tr>

												<?php }}} ?>

													

												</tbody>

											</table>

										</div>

									</div>

								</div>
							</div>

						</div>

						<div class="row row-deck">

							<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
								<div class="card">

									<div class="card-header custom-header pb-0">

										<div>

											<h3 class="card-title">Recent Logs</h3>


										</div>

										

									</div>

									<div class="card-body">

										<div class="table-responsive">

											<table class="table border table-bordered text-nowrap mb-0 example5">

												<thead>

													<tr>

														<th>NO</th>

														<th>User</th>

														<th>Activity</th>

														<th>IP</th>

														<th>Date</th>	

														<th>Time</th>	

													
													</tr>

												</thead>

												<tbody>

													<?php $i = 1; foreach ($log_details as $log) {


													 ?>

													<tr>

														<td><?php echo $i++; ?></td>

														<td><?php echo $log['username']; ?></td>

														<td><?php echo wordwrap($log['message'],50,"<br>\n"); ?></td>

														<td><?php echo $log['ip']; ?></td>

														<td><?php echo  date("d-m-Y", strtotime($log['date'])); ?></td>

														<td><?php echo  $log['time']; ?></td>
														
														
													</tr>

												<?php } ?>

													

												</tbody>

											</table>

										</div>

									</div>

								</div>
							</div>

						</div>
					</div>


					


					</div><!--End side app-->

					<!-- Right-sidebar-->
					<?php include("right_sidebar.php");?>
					<!-- End Rightsidebar-->



					<!--footer-->

                    <?php include ('footer.php');?>
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

		<script src="<?=base_url();?>assets/plugins/side-menu/sidemenu-1/sidemenu-1.js"></script>



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



		<!--Time Counter js-->

		<script src="<?=base_url();?>assets/plugins/counters/jquery.missofis-countdown.js"></script>

		<script src="<?=base_url();?>assets/plugins/counters/counter.js"></script>



		<!-- ApexChart -->

		<script src="<?=base_url();?>assets/js/apexcharts.js"></script>



		<!-- Charts js-->

		<script src="<?=base_url();?>assets/plugins/chart/chart.bundle.js"></script>

		<script src="<?=base_url();?>assets/plugins/chart/utils.js"></script>



		<!--Peitychart js-->

		<script src="<?=base_url();?>assets/plugins/peitychart/jquery.peity.min.js"></script>

		<script src="<?=base_url();?>assets/plugins/peitychart/peitychart.init.js"></script>


			<!-- Data tables js-->



		<script src="<?=base_url();?>assets/plugins/datatable/jquery.dataTables.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/datatable-2.js"></script>



		<script src="<?=base_url();?>assets/plugins/datatable/dataTables.responsive.min.js"></script>






		<!-- Custom-charts js-->

		<script src="<?=base_url();?>assets/js/index1.js"></script>


		<?php

		$farray = '';
		$farray1 = '';

		foreach ($property_count as $count) {


			$farray .= "'".$count['property_type']."',";
			$farray1 .= "".$count['code_count'].",";

			
		}

		?>

		<script type="text/javascript">
			$(function(e){
  					'use strict'

  						//Radial chart
	var options = {
		chart: {
			type: 'radialBar',
			background: 'transparent',
			stroke: "#fff",
			color: "#fff",
			width: "100%",
		},
		plotOptions: {
			radialBar: {
				size: undefined,
				inverseOrder: false,
				startAngle: 0,
				endAngle: 360,
				offsetX: 0,
				offsetY: 0,
				hollow: {
					margin: 5,
					size: '50%',
					background: 'transparent',
					image: undefined,
					imageWidth: 150,
					imageHeight: 150,
					imageOffsetX: 0,
					imageOffsetY: 0,
					imageClipped: true,
					position: 'front',
					dropShadow: {
						enabled: false,
						top: 0,
						left: 0,
						blur: 3,
						opacity: 0.5
					}
				},
				track: {
					show: true,
					startAngle: undefined,
					endAngle: undefined,
					background: '#f9f9f9',
					strokeWidth: '97%',
					opacity: 1,
					margin: 5,
					dropShadow: {
						enabled: false,
						top: 0,
						left: 0,
						blur: 3,
						opacity: 0.5
					}
				},
				dataLabels: {
					show: true,
					name: {
						show: true,
						fontSize: '18px',
						fontFamily: undefined,
						color: undefined,
						offsetY: -10
					},
					value: {
						show: true,
						fontSize: '16px',
						fontFamily: undefined,
						color: undefined,
						offsetY: 16,
						formatter: function(val) {
							return val
						}
					},
					total: {
						show: false,
						label: 'Total',
						color: '#373d3f',
						formatter: function(w) {
							return w.globals.seriesTotals.reduce((a, b) => {
								return a + b
							}, 0) / w.globals.series.length
						}
					}
				},
				
			}
		},
		stroke: {
			lineCap: "round"
		},
		series: [<?php echo $farray1; ?>],
		labels: [<?php echo $farray; ?>],
		colors: ['#467fcf', '#5eba00', '#ffca4a', '#ff6666', '#fs8686'],
	}
	var chart = new ApexCharts(document.querySelector("#pieChart1"), options);
	chart.render();
	//Radial chart
});

		</script>

		<script type="text/javascript">
			$(document).ready( function () {
    $('.example5').DataTable();
} );
		</script>



		<!-- Custom js-->

		<script src="<?=base_url();?>assets/js/custom.js"></script>



	</body>

</html>