<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

				<aside class="app-sidebar toggle-sidebar">

					<div class="app-sidebar__user">

						<div class="user-info">

							<a href="#" class=""><span class="app-sidebar__user-name font-weight-semibold"><?php echo $username;?><?php $role = explode(",",$roles);?></span><br>

							</a>

						</div>

					</div>

					<ul class="side-menu toggle-menu">

						<li>

							<a class="side-menu__item" href="<?php echo site_url('Admin/dashboard/');?>"><i class="side-menu__icon typcn typcn-device-desktop"></i><span class="side-menu__label">Dashboard</span></a>

							

						</li>

						<?php $user_array = array("Users Master","View Users List","User Type Master","Set Roles","View Roles","Unblocked Users"); ?>

							<?php $common_user = array_intersect($role,$user_array);?>

							<?php if(count($common_user) >= 1) { ?>

						<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon mdi mdi-account"></i><span class="side-menu__label">Users</span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">
								
									<?php for($i=0;$i<count($role);$i++) { ?>
										
									<?php if($role[$i] == "Users Master"){?><li><a href="<?php echo site_url('Users/add_user/'); ?>" class="slide-item">Users Master</a></li><?php } ?>
									
									<?php if($role[$i] == "View Users List"){?><li><a href="<?php echo site_url('Users/view_user/')?>" class="slide-item"> View Users List</a></li><?php } ?>
								

									<?php if($role[$i] == "User Type Master"){?><li><a href="<?php echo site_url('Users/add_user_type/')?>" class="slide-item"> User Type Master</a></li><?php } ?>

									<?php if($role[$i] == "Set Roles"){?><li><a href="<?php echo site_url('Admin/set_roles/')?>" class="slide-item">Set Roles</a></li><?php } ?>

									<?php if($role[$i] == "View Roles"){?><li><a href="<?php echo site_url('Admin/view_role/')?>" class="slide-item">View Roles</a></li><?php } ?>

									<?php if($role[$i] == "Unblocked Users"){?><li><a href="<?php echo site_url('Admin/blocked_users/')?>" class="slide-item">Unblocked Users</a></li><?php } ?>

									<?php } ?>
								
							</ul>

						</li>
					<?php } ?>

						<?php $property_array = array("Property Master","View Property List","Property Type Master","Unit Master","Land Type Master","Property Jurisdiction","Property Status Master","Property Financial Status Master","Fixed Expense Type","Property Group Master");?>

							<?php $common_property = array_intersect($role,$property_array);?>

							<?php if(count($common_property) >= 1) { ?>

							<li class="slide">

								<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-home"></i><span class="side-menu__label">Properties</span><i class="angle fa fa-angle-right"></i></a>

								<ul class="slide-menu">
									<?php for($i=0;$i<count($role);$i++) { ?>
										
									<?php if($role[$i] == "Property Master"){?><li><a href="<?php echo site_url('Property/property_master/')?>" class="slide-item"> Property Master</a></li><?php } ?>

									<?php if($role[$i] == "View Property List"){?><li><a href="<?php echo site_url('Property/view_property_list/')?>" class="slide-item"> View Property List</a></li><?php } ?>

									<?php if($role[$i] == "Property Type Master"){?><li><a href="<?php echo site_url('Property/property_type_master/')?>" class="slide-item">Property Type Master</a></li><?php } ?>

									<?php if($role[$i] == "Unit Master"){?><li><a href="<?php echo site_url('Property/unit_master/')?>" class="slide-item">Unit Master</a></li><?php } ?>

									<?php if($role[$i] == "Land Type Master"){?><li><a href="<?php echo site_url('Property/land_type_master/')?>" class="slide-item">Land Type Master</a></li><?php } ?>
									
									<?php if($role[$i] == "Property Jurisdiction Master"){?><li><a href="<?php echo site_url('Property/property_jurisdiction_master/')?>" class="slide-item">Property Jurisdiction</a></li><?php } ?>

									<?php if($role[$i] == "Property Status Master"){?><li><a href="<?php echo site_url('Property/property_status_master/')?>" class="slide-item">Property Status Master</a></li><?php } ?>

									<?php if($role[$i] == "Property Financial Status Master"){?><li><a href="<?php echo site_url('Property/property_financial_status_master/')?>" class="slide-item">Property Financial Status<br/>Master</a></li><?php } ?>

									<?php if($role[$i] == "Fixed Expense Type"){?><li><a href="<?php echo site_url('Property/property_fixed_expense_type/')?>" class="slide-item">Fixed Expense Type</a></li><?php } ?>

									<?php if($role[$i] == "Property Group Master"){?><li><a href="<?php echo site_url('Property/property_group_master/')?>" class="slide-item">Property Group Master</a></li><?php } ?>
									
									<?php }?>
								</ul>

							</li>
						<?php } ?>	

							<?php $document_array = array("Document Master","Document Lists","Document Type Master","Document Summary","Document Authority","List of Renewals");?>

							<?php $common_document = array_intersect($role,$document_array);?>

							<?php if(count($common_document) >= 1) { ?>

						<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-file-text"></i><span class="side-menu__label">Document</span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">
								<?php for($i=0;$i<count($role);$i++) { ?>

								<?php if($role[$i] == "Document Master"){?><li><a href="<?php echo site_url('Document/document_master/')?>" class="slide-item">Document Master</a></li><?php } ?>

								<?php if($role[$i] == "Document Lists"){?><li><a href="<?php echo site_url('Document/document_list/')?>" class="slide-item">Document Lists</a></li><?php } ?>

								<?php if($role[$i] == "Document Type Master"){?><li><a href="<?php echo site_url('Document/document_type_master/')?>" class="slide-item">Document Type Master</a></li><?php } ?>

								<?php if($role[$i] == "Document Summary"){?><li><a href="<?php echo site_url('Document/document_summary/')?>" class="slide-item"> Document Summary</a></li><?php } ?>

								<?php if($role[$i] == "Document Authority"){?><li><a href="<?php echo site_url('Document/document_authority/')?>" class="slide-item"> Document Authority</a></li><?php } ?>

								<?php if($role[$i] == "List of Renewals"){?><li><a href="<?php echo site_url('Document/document_list_renewals/')?>" class="slide-item"> List of Renewals</a></li><?php } ?>

								<?php } ?>	
							</ul>

						</li>

					<?php } ?>

						<?php $loan_array = array("Loan Master","View Loan List","View Loan Installments","Loan Type Master","Bank Master","Loan Officer Master");?>

							<?php $common_loan = array_intersect($role,$loan_array);?>

							<?php if(count($common_loan) >= 1) { ?>

						<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-bank"></i><span class="side-menu__label">Loan</span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">

								<?php for($i=0;$i<count($role);$i++) { ?>

								<?php if($role[$i] == "Loan Master"){?><li><a href="<?php echo site_url('Loan/loan_master/')?>" class="slide-item">Loan Master</a></li><?php } ?>

								<?php if($role[$i] == "View Loan List"){?><li><a href="<?php echo site_url('Loan/view_loan_list/')?>" class="slide-item"> View Loan List</a></li><?php } ?>


								<?php if($role[$i] == "View Loan Installments"){?><li><a href="<?php echo site_url('Loan/loan_installments/')?>" class="slide-item"> View Loan Installments</a></li><?php } ?>
								
								<?php if($role[$i] == "Loan Type Master"){?><li><a href="<?php echo site_url('Loan/loan_type_master/')?>" class="slide-item">Loan Type Master</a></li><?php } ?>

								<?php if($role[$i] == "Bank Master"){?><li><a href="<?php echo site_url('Loan/bank_master/')?>" class="slide-item">Bank Master</a></li><?php } ?>

								<?php if($role[$i] == "Loan Officer Master"){?><li><a href="<?php echo site_url('Loan/loan_officer_master/')?>" class="slide-item">Loan Officer Master</a></li><?php } ?>

								<?php } ?>

							</ul>


						</li>

					<?php } ?>

					<?php $lease_array = array("Rent Payable","View Rent Payable List","Rent Payable Installments","Rent Payable Contract Status Master","Rent Receivable","View Rent Receivable List","Rent Receivable Installments","Rent Receivable Contract Status Master");?>

							<?php $common_lease = array_intersect($role,$lease_array);?>

							<?php if(count($common_lease) >= 1) { ?>

						<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-th-list"></i><span class="side-menu__label">Lease</span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">

								<?php for($i=0;$i<count($role);$i++) { ?>

								<?php if($role[$i] == "Rent Payable"){?><li><a href="<?php echo site_url('Lease/lease_own/')?>" class="slide-item">Rent Payable</a></li><?php } ?>

								<?php if($role[$i] == "View Rent Payable List"){?><li><a href="<?php echo site_url('Lease/lease_own_report/')?>" class="slide-item">View Rent Payable List</a></li><?php } ?>

								<?php if($role[$i] == "Rent Payable Installments"){?><li><a href="<?php echo site_url('Lease/lease_own_installment/')?>" class="slide-item">Rent Payable <br/>Installments</a></li><?php } ?>

								<?php if($role[$i] == "Rent Payable Contract Status Master"){?><li><a href="<?php echo site_url('Lease/rent_payable_contract_status/')?>" class="slide-item">Rent Payable Contract<br/>Status Master</a></li><?php } ?>

								<?php if($role[$i] == "Rent Receivable"){?><li><a href="<?php echo site_url('Lease/lease_given/')?>" class="slide-item">Rent Receivable</a></li><?php } ?>

								<?php if($role[$i] == "View Rent Receivable List"){?><li><a href="<?php echo site_url('Lease/lease_given_report/')?>" class="slide-item">View Rent Receivable List</a></li><?php } ?>

								<?php if($role[$i] == "Rent Receivable Installments"){?><li><a href="<?php echo site_url('Lease/lease_given_installment/')?>" class="slide-item">Rent Receivable<br/> Installments</a></li><?php } ?>

								<?php if($role[$i] == "Rent Receivable Contract Status Master"){?><li><a href="<?php echo site_url('Lease/rent_receivable_contract_status/')?>" class="slide-item">Rent Receivable Contract<br/>Status Master</a></li><?php } ?>
								
								<?php } ?>

							</ul>

						</li>

					<?php } ?>

					<?php $legal_array = array("Legal Master","View Legal Master","Hearing Master","View Hearing List","Upcoming Hearing","External Opinion Master","View External Opinion","Case By Master","Case Against Master","Police Station Master","Court & Authorty Master","Case Status Master");?>

							<?php $common_legal = array_intersect($role,$legal_array);?>

							<?php if(count($common_legal) >= 1) { ?>

						<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-legal"></i><span class="side-menu__label">Legal</span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">

								<?php for($i=0;$i<count($role);$i++) { ?>

								<?php if($role[$i] == "Legal Master"){?><li><a href="<?php echo site_url('Legal/legal_master/')?>" class="slide-item"> Legal Master </a></li><?php } ?>

								<?php if($role[$i] == "View Legal Master"){?><li><a href="<?php echo site_url('Legal/view_legal_master/')?>" class="slide-item"> View Legal Master </a></li><?php } ?>


								<?php if($role[$i] == "Hearing Master"){?><li><a href="<?php echo site_url('Legal/hearing_master/')?>" class="slide-item"> Hearing Master </a></li><?php } ?>

								<?php if($role[$i] == "View Hearing List"){?><li><a href="<?php echo site_url('Legal/view_hearing_list/')?>" class="slide-item"> View Hearing List </a></li><?php } ?>

								<?php if($role[$i] == "Upcoming Hearing"){?><li><a href="<?php echo site_url('Legal/upcoming_hearing_master/')?>" class="slide-item"> Upcoming Hearing</a></li><?php } ?>

								<?php if($role[$i] == "External Opinion Master"){?><li><a href="<?php echo site_url('Legal/external_opinion_master/')?>" class="slide-item"> External Opinion Master </a></li><?php } ?>

								<?php if($role[$i] == "View External Opinion"){?><li><a href="<?php echo site_url('Legal/view_external_opinion/')?>" class="slide-item"> View External Opinion</a></li><?php } ?>


								<?php if($role[$i] == "Case By Master"){?><li><a href="<?php echo site_url('Legal/case_by_master/')?>" class="slide-item"> Case By Master </a></li><?php } ?>

								<?php if($role[$i] == "Case Against Master"){?><li><a href="<?php echo site_url('Legal/case_against_master/')?>" class="slide-item"> Case Against Master </a></li><?php } ?>

								<?php if($role[$i] == "Police Station Master"){?><li><a href="<?php echo site_url('Legal/police_station_master/')?>" class="slide-item"> Police Station Master </a></li><?php } ?>

								<?php if($role[$i] == "Court & Authority Master"){?><li><a href="<?php echo site_url('Legal/court_authority_master/')?>" class="slide-item"> Court & Authority Master </a></li><?php } ?>


								<?php if($role[$i] == "Case Status Master"){?><li><a href="<?php echo site_url('Legal/case_status_master/')?>" class="slide-item"> Case Status Master </a></li><?php } ?>
								
								<?php } ?>

							</ul>

						</li>

					<?php } ?>

					<?php $legal_array = array("Insurance Master","View Insurance List","List of Renewal","Claim Master","View Claim List","Insurance Company","Insurance Type");?>

							<?php $common_legal = array_intersect($role,$legal_array);?>

							<?php if(count($common_legal) >= 1) { ?>

							<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-briefcase"></i><span class="side-menu__label">Insurance</span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">

								<?php for($i=0;$i<count($role);$i++) { ?>

								<?php if($role[$i] == "Insurance Master"){?><li><a href="<?php echo site_url('Insurance/insurance_master/'); ?>" class="slide-item"> Insurance Master </a></li><?php } ?>

								<?php if($role[$i] == "View Insurance List"){?><li><a href="<?php echo site_url('Insurance/view_insurance_list/'); ?>" class="slide-item"> View Insurance List </a></li><?php } ?>


								<?php if($role[$i] == "List of Renewal"){?><li><a href="<?php echo site_url('Insurance/insurance_renewal_list/'); ?>" class="slide-item"> List of Renewal </a></li><?php } ?>

								<?php if($role[$i] == "Claim Master"){?><li><a href="<?php echo site_url('Insurance/claim_master/'); ?>" class="slide-item"> Claim Master</a></li><?php } ?>

								<?php if($role[$i] == "View Claim List"){?><li><a href="<?php echo site_url('Insurance/view_claim_list/'); ?>" class="slide-item"> View Claim List </a></li><?php } ?>

								<?php if($role[$i] == "Insurance Company"){?><li><a href="<?php echo site_url('Insurance/insurance_company_master/'); ?>" class="slide-item"> Insurance Company</a></li><?php } ?>

								<?php if($role[$i] == "Insurance Type"){?><li><a href="<?php echo site_url('Insurance/insurance_type_master/'); ?>" class="slide-item"> Insurance Type</a></li><?php } ?>

							<?php } ?>


							</ul>

						</li>

					<?php } ?>

					<?php $income_array = array("Income Master","Income Type Master","View Income List","Recurring Income List");?>

							<?php $common_income = array_intersect($role,$income_array);?>

							<?php if(count($common_income) >= 1) { ?>

						<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label"> Income </span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">

								<?php for($i=0;$i<count($role);$i++) { ?>

								<?php if($role[$i] == "Income Master"){?><li><a href="<?php echo site_url('Income/income_master/'); ?>" class="slide-item">Income Master</a></li><?php } ?>

								<?php if($role[$i] == "Income Type Master"){?><li><a href="<?php echo site_url('Income/income_type_master/'); ?>" class="slide-item">Income Type Master</a></li><?php } ?>

								<?php if($role[$i] == "View Income List"){?><li><a href="<?php echo site_url('Income/view_income_list/'); ?>" class="slide-item"> View Income List</a></li><?php } ?>

								<?php if($role[$i] == "Recurring Income List"){?><li><a href="<?php echo site_url('Income/recurring_income_list/'); ?>" class="slide-item"> Recurring Income List</a></li><?php } ?>
								
								<?php } ?>

							</ul>

						</li>

					<?php } ?>

					<?php $expense_array = array("Expense Master","Expense Type Master","View Expense List","Recurring Expense List");?>

							<?php $common_expense = array_intersect($role,$expense_array);?>

							<?php if(count($common_expense) >= 1) { ?>

						<li class="slide">

							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-credit-card"></i><span class="side-menu__label">Expense</span><i class="angle fa fa-angle-right"></i></a>

							<ul class="slide-menu">

								<?php for($i=0;$i<count($role);$i++) { ?>

								<?php if($role[$i] == "Expense Master"){?><li><a href="<?php echo site_url('Expense/expense_master/'); ?>" class="slide-item">Expense Master</a></li><?php } ?>

								<?php if($role[$i] == "Expense Type Master"){?><li><a href="<?php echo site_url('Expense/expense_type_master/'); ?>" class="slide-item">Expense Type Master</a></li><?php } ?>

								<?php if($role[$i] == "View Expense List"){?><li><a href="<?php echo site_url('Expense/view_expense_list/'); ?>" class="slide-item"> View Expense List</a></li><?php } ?>

								<?php if($role[$i] == "Recurring Expense List"){?><li><a href="<?php echo site_url('Expense/recurring_expense_list/'); ?>" class="slide-item"> Recurring Expense List</a></li><?php } ?>

								<?php } ?>
								
							</ul>

						</li>

					<?php } ?>

					<?php $log_array = array("View Log");?>

							<?php $common_log = array_intersect($role,$log_array);?>

							<?php if(count($common_log) >= 1) { ?>

					<li>

						<a class="side-menu__item" href="<?php echo site_url('Admin/log/');?>"><i class="side-menu__icon fa fa-th-list"></i><span class="side-menu__label">View Log</span></a>

						<a class="side-menu__item" href="<?php echo site_url('Users/view_faq/');?>"><i class="side-menu__icon fa fa-question-circle"></i><span class="side-menu__label">FAQ</span></a>


							

					</li>

					<?php } ?>

						
					</ul>

				</aside>