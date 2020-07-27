			<div class="row" style="display: inline-block;">
				<div class="tile_count">
					<div class="col-md-3 col-sm-4  tile_stats_count">
						<span class="count_top"><i class="fa fa-user"></i> Total Siswa</span>

						<div class="count"><?php echo (count($siswa->result())); ?></div>
					</div>

					<div class="col-md-3 col-sm-4  tile_stats_count">
						<span class="count_top"><i class="fa fa-clock-o"></i> Total Kelas</span>
						<div class="count"><?php echo (count($kelas)); ?></div>
					</div>


					<div class="col-md-3 col-sm-4  tile_stats_count">
						<span class="count_top"><i class="fa fa-user"></i> Total Guru</span>
						<div class="count green"><?php echo (count($guru)); ?></div>
					</div>
					<div class="col-md-3 col-sm-4  tile_stats_count">
						<span class="count_top"><i class="fa fa-user"></i> Mapel</span>
						<div class="count"><?php echo (count($mapel)); ?></div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 col-sm-6 ">
						<div class="x_panel">
							<div class="x_title">
								<h2>Recent Activities <small>Sessions</small></h2>
								<ul class="nav navbar-right panel_toolbox">
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="dashboard-widget-content">

									<ul class="list-unstyled timeline widget">
										<li>
										</li>
										<li>
											<div class="block">
												<div class="block_content">
													<h2 class="title">
														<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
													</h2>
													<div class="byline">
														<span>13 hours ago</span> by <a>Jane Smith</a>
													</div>
													<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
													</p>
												</div>
											</div>
										</li>
										<li>
											<div class="block">
												<div class="block_content">
													<h2 class="title">
														<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
													</h2>
													<div class="byline">
														<span>13 hours ago</span> by <a>Jane Smith</a>
													</div>
													<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
													</p>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>

						</div>
					</div>
					<div class="col-md-6 col-sm-6 ">
						<div class="x_panel">
							<div class="x_title">
								<h2><?= $konfig[0]->nama ?><small></small></h2>
								<ul class="nav navbar-right panel_toolbox">
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="dashboard-widget-content">

									<ul class="list-unstyled timeline widget">
										<li>
										</li>
										<li>
											<div class="block">
												<div class="block_content">
													<h2 class="title">
														<a>Alamat</a>
													</h2>
													<p class="excerpt"><?= $konfig[0]->deskripsi ?></a>
													</p>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>

						</div>
					</div>


					<div class="col-md-8 col-sm-8 ">

					</div>
