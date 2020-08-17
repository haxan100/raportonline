<?php $this->load->view('templates/header') ?>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.htddml" class="site_title">dd<i class="fa fa-paw"></i> <span>Gentelella sAlela!</span></a>
					</div>

					<div class="clearfix"></div>
					<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="<?php echo base_url() . "templates/"; ?>/production/images/img.jpg" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2>John Dsoe</h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<?php $this->load->view('templates/sidebar') ?>
					<!-- /sidebar menu -->

				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src=" <?php echo base_url() . "templates/"; ?>images/img.jpg" alt="">John Doe
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="javascript:;"> Profile</a>
									<a class="dropdown-item" href="javascript:;">
										<span class="badge bg-red pull-right">50%</span>
										<span>Settings</span>
									</a>
									<a class="dropdown-item" href="javascript:;">Help</a>
									<a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<!-- top tiles -->
				<div class="row" style="display: inline-block;">
					<div class="tile_count">
						<div class="col-md-2 col-sm-4  tile_stats_count">
							<span class="count_top"><i class="fa fa-user"></i> Total Users</span>
							<div class="count">2500</div>
							<span class="count_bottom"><i class="green">4% </i> From last Week</span>
						</div>
						<div class="col-md-2 col-sm-4  tile_stats_count">
							<span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
							<div class="count">123.50</div>
							<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
						</div>
						<div class="col-md-2 col-sm-4  tile_stats_count">
							<span class="count_top"><i class="fa fa-user"></i> Total Males</span>
							<div class="count green">2,500</div>
							<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
						</div>
						<div class="col-md-2 col-sm-4  tile_stats_count">
							<span class="count_top"><i class="fa fa-user"></i> Total Females</span>
							<div class="count">4,567</div>
							<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
						</div>
						<div class="col-md-2 col-sm-4  tile_stats_count">
							<span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
							<div class="count">2,315</div>
							<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
						</div>
						<div class="col-md-2 col-sm-4  tile_stats_count">
							<span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
							<div class="count">7,325</div>
							<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
						</div>
					</div>
				</div>
				<!-- /top tiles -->
				<?php $this->load->view('produk/data_produk') ?>

				<br />
			</div>



			<!-- /page content -->

			<!-- footer content -->
			<?php $this->load->view('templates/footer'); ?>

			</html>
