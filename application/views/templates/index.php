<?php $this->load->view('templates/header') ?>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.html" class="site_title">Raport Online<i class="fa fa-paw"></i> <span> </span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
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
									<img src=" <?php echo base_url() . "templates/"; ?>images/img.jpg" alt=""><?= $_SESSION['nama'] ?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
						
									<a class="dropdown-item" href="javascript:;">
						
									</a>
								
									<a class="dropdown-item" href="<?php echo site_url('login/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>

			<div class="right_col" role="main">
				<!-- top tiles -->

				<!-- /top tiles -->

				<?php $this->load->view($content) ?>

				<br />
			</div>



			<!-- /page content -->

			<!-- footer content -->
			<?php $this->load->view('templates/footer'); ?>

			</html>
