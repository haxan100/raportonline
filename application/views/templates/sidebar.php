					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<!-- <?php echo base_url(); ?> -->
							<ul class="nav side-menu">
								<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('dashboard') ?>">Dashbsoard</a></li>
										<li><a href="<?php echo site_url('Wali') ?>">Wali Kelas</a></li>
									</ul>
								</li>
								<li><a><i class="glyphicon glyphicon-user"></i> Master  <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('siswa') ?>">Master Siswa</a></li>
										<li><a href="<?php echo site_url('siswa/Kelas') ?>">Master Kelas</a></li>
										<li><a href="<?php echo site_url('siswa/Mapel') ?>">Master Mapel</a></li>										
										<li><a href="<?php echo site_url('Wali/Guru') ?>">Master Guru</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-edit"></i> Nilai  <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('Nilai') ?>">Isi Nilai</a></li>
									</ul>
								</li>
								<li><a><i class="glyphicon glyphicon-print"></i> Cetak <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('Laporan/SiswaAll') ?>">Semua Siswa</a></li>
										<li><a href="<?php echo site_url('Laporan/GuruAll') ?>">Semua Guru</a></li>
										<li><a href="<?php echo site_url('Laporan/MapelAll') ?>">Semua Mapel</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-desktop"></i> Administrator<span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									
										<li><a href="<?php echo site_url('Konfig') ?>">Konfig</a></li>
									
									</ul>
		
							</ul>
						</div>

					</div>
