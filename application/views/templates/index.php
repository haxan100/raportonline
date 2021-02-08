<?php $this->load->view('templates/header') ?>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="dashboard" class="site_title">Raport Online<i class="fa fa-paw"></i> <span> </span></a>
					</div>

					<div class="clearfix"></div>
					<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

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
									<a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user pull-right"></i> Settings</a>

									<a class="dropdown-item" href="<?php echo site_url('login/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>





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
						// $userSiapa == "guru"
						// var_dump($userSiapa == "guru");die;
						// var_dump($userSiapa == "guru");die;
						$who = "";
						if ($userSiapa == "admin") {
							$who = "admin";

							$pu = $this->db->query('select * from admin where id_user=' . $_SESSION['id_user']);
						
							foreach ($pu->result_array() as $p) {
						?>
							<div class="modal-body">
								<form class="form-group" action="<?= base_url('Murid/formProfil') ?>" method="post">
									<div>
										<input type="hidden" name="id_user" class="form-control" value="<?= $p['id_user']; ?>" required="required" />

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
							<?php ?>

						<?php } }else if ($userSiapa == "wali") {
							$who = "wali";
							// var_dump($_SESSION); die();

							$id_user = $_SESSION['id_user'];
							$id_kelas = $_SESSION['id_kelas'];
							$pu = $this->db->query('select * from wali_kelas where kode_wali='.$id_user.' and id_kelas='.$id_kelas.'' );
						
							foreach ($pu->result_array() as $p) {
								// var_dump($p);die;
						?>
							<div class="modal-body">
								<form class="form-group" action="<?= base_url('Wali/formProfil') ?>" method="post">
									<div>
										<input type="hidden" name="id_user" class="form-control" value="<?= $p['kode_wali']; ?>" required="required" />
										<input type="hidden" name="id_kelas" class="form-control" value="<?= $p['id_kelas']; ?>" required="required" />

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
							
						<?php } }else if ($userSiapa == "guru") {
							$who = "wali";
							// var_dump($_SESSION); die();

							$id_user = $_SESSION['id_user'];
							$id_kelas = $_SESSION['id_kelas'];
							$pu = $this->db->query('select * from wali_kelas where kode_wali='.$id_user.' and id_kelas='.$id_kelas.'' );
							// var_dump($pu->result_array());die;
						
							foreach ($pu->result_array() as $p) {
								// var_dump($p);die;
						?>
							<div class="modal-body">
								<form class="form-group" action="<?= base_url('Guru/formProfil') ?>" method="post">
									<div>
										<input type="hidden" name="id_user" class="form-control" value="<?= $p['id_wali_kelas']; ?>" required="required" />
										<input type="hidden" name="id_kelas" class="form-control" value="<?= $p['id_kelas']; ?>" required="required" />

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
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Closes</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
							</form>

						<?php } }else if ($userSiapa == "siswa") {
							$who = "siswa";

							$pu = $this->db->query('select * from siswa where nisn=' . $_SESSION['id_user']);
							// var_dump($pu);die;
							foreach ($pu->result_array() as $p) {
						?>
							<div class="modal-body">
								<form class="form-group" action="<?= base_url('Murid/formProfilSiswa') ?>" method="post">
									<div>
										<input type="hidden" name="id_user" class="form-control" value="<?= $p['nisn']; ?>" required="required" />
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
							<?php } }  ?>

					</div>
				</div>
			</div>

			<div class="right_col" role="main">
				<!-- top tiles -->

				<!-- /top tiles -->

				<section class="content">
					<?php if ($this->session->flashdata('flash_data')) : ?>
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
