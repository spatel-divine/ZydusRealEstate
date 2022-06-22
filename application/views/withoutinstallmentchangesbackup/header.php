<div class="app-header header d-flex">

					<div class="container-fluid">

						<div class="d-flex">

						    <a class="header-brand" href="index.php">

								<img src="<?=base_url();?>assets/img/logo.jpg" class="header-brand-img main-logo" alt="">

								<img src="<?=base_url();?>assets/img/logo.jpg" class="header-brand-img icon-logo" alt="">

							</a><!-- logo-->

							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>

							<a href="#" data-toggle="search" class="nav-link nav-link  navsearch"><i class="fa fa-search"></i></a><!-- search icon -->



							

						

							<div class="d-flex order-lg-2 ml-auto header-rightmenu">



								<div class="dropdown">

									<a  class="nav-link icon full-screen-link" id="fullscreen-button">

										<i class="fe fe-maximize-2"></i>

									</a>

								</div><!-- full-screen -->

								<div class="dropdown header-notify">

									<a class="nav-link icon" data-toggle="dropdown" aria-expanded="false">

										<i class="fe fe-bell "></i>

										<span class="pulse bg-success"></span>

									</a>

									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">

										<a href="#" class="dropdown-item text-center">4 New Notifications</a>

										<div class="dropdown-divider"></div>

										<a href="#" class="dropdown-item d-flex pb-3">

											<div class="notifyimg bg-green">

												<i class="fe fe-mail"></i>

											</div>

											<div>

												<strong>Message Sent.</strong>

												<div class="small text-muted">12 mins ago</div>

											</div>

										</a>

										<a href="#" class="dropdown-item d-flex pb-3">

											<div class="notifyimg bg-pink">

												<i class="fe fe-shopping-cart"></i>

											</div>

											<div>

												<strong>Order Placed</strong>

												<div class="small text-muted">2  hour ago</div>

											</div>

										</a>

										<a href="#" class="dropdown-item d-flex pb-3">

											<div class="notifyimg bg-blue">

												<i class="fe fe-calendar"></i>

											</div>

											<div>

												<strong> Event Started</strong>

												<div class="small text-muted">1  hour ago</div>

											</div>

										</a>

										<a href="#" class="dropdown-item d-flex pb-3">

											<div class="notifyimg bg-orange">

												<i class="fe fe-monitor"></i>

											</div>

											<div>

												<strong>Your Admin Lanuch</strong>

												<div class="small text-muted">2  days ago</div>

											</div>

										</a>

										<div class="dropdown-divider"></div>

										<a href="#" class="dropdown-item text-center">View all Notifications</a>

									</div>

								</div><!-- notifications -->

								<div class="dropdown header-user">

									<a class="nav-link leading-none siderbar-link"  data-toggle="sidebar-right" data-target=".sidebar-right">

										<span class="mr-3 d-none d-lg-block ">

											<span class="text-gray-white"><span class="ml-2"><?php echo $username;?></span></span>

										</span>

										<span class="avatar avatar-md brround"></span>

									</a>

									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

										<div class="header-user text-center mt-4 pb-4">

											<span class="avatar avatar-xxl brround"><img src="<?=base_url();?>assets/images/users/avatars/19.png" alt="Profile-img" class="avatar avatar-xxl brround"></span>

											<a href="#" class="dropdown-item text-center font-weight-semibold user h3 mb-0"><?php echo $username;?></a>

											<small>Web Designer</small>

										</div>

										<a class="dropdown-item" href="#">

											<i class="dropdown-icon mdi mdi-account-outline "></i> Spruko technologies

										</a>

										<a class="dropdown-item" href="#">

											<i class="dropdown-icon  mdi mdi-account-plus"></i> Add another Account

										</a>

										<div class="card-body border-top">

											<div class="row">

												<div class="col-6 text-center">

													<a class="" href=""><i class="dropdown-icon mdi  mdi-message-outline fs-30 m-0 leading-tight"></i></a>

													<div>Inbox</div>

												</div>

												<div class="col-6 text-center">

													<a class="" href=""><i class="dropdown-icon mdi mdi-logout-variant fs-30 m-0 leading-tight"></i></a>

													<div>Sign out</div>

												</div>

											</div>

										</div>

									</div>

								</div><!-- profile -->

								<div class="header-form">

									<form class="form-inline">

										<div class="search-element mr-3">

											<input class="form-control" type="search" placeholder="Search" aria-label="Search">

											<span class="Search-icon"><i class="fa fa-search"></i></span>

										</div>

									</form><!-- search-bar -->

								</div>

								<div class="dropdown">

									<a  class="nav-link icon siderbar-link" data-toggle="sidebar-right" data-target=".sidebar-right">

										<i class="fe fe-more-horizontal"></i>

									</a>

								</div><!-- Right-siebar-->

							</div>

						</div>

					</div>

				</div>


				<div class="container-fluid bg-white news-ticker">

					<div class="bg-white">

						<div class="best-ticker" id="newsticker">

							<div class="bn-news">

								<ul>

									<li><span class="fa fa-newspaper-o mr-1 bg-success-transparent text-success"></span>Zydus and XOMA Announce IL-2-Based Immuno-Oncology Therapy Licensing Agreement<span class="bn-positive mr-5"></span></li>
									<li><span class="fa fa-newspaper-o mr-1 bg-success-transparent text-success"></span>Zydus Cadila in talks to sell two units for Rs 1,200 crore11:53<span class="bn-positive mr-5"></span></li>
									<li><span class="fa fa-newspaper-o mr-1 bg-success-transparent text-success"></span>Zydus Cadila gets DGCI nod for diabetes treatment drug<span class="bn-positive mr-5"></span></li>
									<li><span class="fa fa-newspaper-o mr-1 bg-success-transparent text-success"></span>Zydus receives final approval from the USFDA for Emtricitabine and Tenofovir Disoproxil Fumarate Tablets 200 mg/300 mg<span class="bn-positive mr-5"></span></li>

								</ul>

							</div>

						</div>

					</div>

				</div>