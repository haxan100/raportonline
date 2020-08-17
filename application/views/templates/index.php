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
					<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


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

									<a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-sign-out pull-right"></i> Settings</a>




								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						$userSiapa = $_SESSION['user'];
						// echo($_SESSION); 
						// die;

						if ($userSiapa == "guru") {
							$pu = $this->db->query('select * from wali_kelas where kode_wali=' . $_SESSION['id_user']);
						}




						foreach ($pu->result_array() as $p) {
						?>
							<div class="modal-body">
								<form class="form-group" action="<?= base_url('Wali/formProfil') ?>" method="post">
									<div>
										<input type="hidden" name="id_user" class="form-control" value="<?= $p['kode_wali']; ?>" required="required" />

										<label for="exampleInputEmail1">Username</label>
										<input type="text" class="form-control" id="username" aria-describedby="username" name="username" placeholder=" Enter username" value="<?= $p['username']; ?>">
										<small id="username" class="form-text text-muted">We'll never share your email with anyone else.</small>
									</div>
									<div class="form-group">
										<label for="password">Password</label>
										<input type="text" class="form-control" id="password" name="password" placeholder=" password" value="<?= $p['password']; ?>">
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">Check me out</label>
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
							</form>

						<?php } ?>
					</div>
				</div>
			</div>

			<div class="right_col" role="main">
				<!-- top tiles -->

				<!-- /top tiles -->

				<section class="content">
					<?php if ($this->session->flashdata()) : ?>
						<script>
							Swal.fire(
								
								'Berhasil!',
								'Sukses Update Profile',
								'success'
							)
						</script>
					<?php endif ?>

					<?php $this->load->view($content) ?>

					<br />
			</div>



			<!-- /page content -->

			<!-- footer content -->
			<?php $this->load->view('templates/footer'); ?>

			</html>
