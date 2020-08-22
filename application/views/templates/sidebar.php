					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<?php
								$userSiapa = $_SESSION['user'];
								$who = "";
								if($userSiapa=="guru"){
									$who="guru";								
								}else if($userSiapa=="admin"){
									$who="admin";								
								}else if($userSiapa=="murid"){
									$who="murid";								
								}

							?>
							<!-- <?php echo base_url(); ?> -->
							<ul class="nav side-menu">
								<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('dashboard') ?>">Dashbsoard</a></li>
										<?php if ( $who =="admin"){  ?>
										<li><a href="<?php echo site_url('Wali') ?>">Wali Kelas</a></li>
										<?php }?>

									</ul>
								</li>
								<?php if ($who =="admin"){  ?>

								<li><a><i class="glyphicon glyphicon-user"></i> Master  <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('siswa') ?>">Master Siswa</a></li>
										<li><a href="<?php echo site_url('siswa/Kelas') ?>">Master Kelas</a></li>
										<li><a href="<?php echo site_url('siswa/Mapel') ?>">Master Mapel</a></li>										
										<li><a href="<?php echo site_url('Wali/Guru') ?>">Master Guru</a></li>
									</ul>
								</li>
									<?php }?>
																				<?php if ($who =="guru"){  ?>

								<li><a><i class="glyphicon glyphicon-user"></i> Master  <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('siswa') ?>">Master Siswa</a></li>

										<li><a href="<?php echo site_url('siswa/Mapel') ?>">Master Mapel</a></li>		
									</ul>
								</li>
									<?php }?>


								<li><a><i class="fa fa-edit"></i> Nilai  <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									<?php 
										$id_user = $_SESSION['id_user'];
										// var_dump($id_user);
										?>
												<?php if($_SESSION['user']=="guru" or $_SESSION['user']=="admin" ){
												?>
													<li><a href="<?php echo site_url('Nilai') ?>">Isi Nilai</a></li>
												<?php 
													} else{
												?>
									

										<li><a href="<?php echo site_url('Nilai/detail_nilai_siswa/'.$id_user) ?>">Lihat Nilai Saya</a></li>
													<?php }?>

									</ul>
								</li>
								<li><a><i class="glyphicon glyphicon-print"></i> Cetak <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">

										<?php 
										$id_user = $_SESSION['id_user'];
										// var_dump($id_user);
										?>
											<?php if($_SESSION['user']=="guru" or $_SESSION['user']=="admin" ){
												?>												
										<li><a href="<?php echo site_url('Laporan/SiswaAll') ?>">Semua Siswa</a></li>
										<li><a href="<?php echo site_url('Laporan/GuruAll') ?>">Semua Guru</a></li>
										<li><a href="<?php echo site_url('Laporan/MapelAll') ?>">Semua Mapel</a></li>

												<?php 
													} else{
												?>
										<li><a href="<?php echo site_url('Laporan/CetakNilaiByNISN/'.$id_user) ?>">Cetak Nilai Saya</a></li>
													<?php }?>						

									</ul>
								</li>
								
								<?php if ($who =="admin"){  ?>
								<li><a><i class="fa fa-desktop"></i> Administrator<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									
										<li><a href="<?php echo site_url('Konfig') ?>">Konfig</a></li>
									
									</ul>
		
							</ul>
								<?php }?>
						</div>

					</div>
