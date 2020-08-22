<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h2>Data Siswa</h2>
			<?php

			if ($_SESSION['user'] == 'guru') {
				$id_kelasFromWali = $_SESSION['id_kelas'];
				// echo"helo";
				$data['listKelas'] = $this->SiswaModel->getKelasByid_kelas($id_kelasFromWali);
				$data['siswa'] = $this->SiswaModel->getSiswaByid_kelas($id_kelasFromWali);
			}

			// var_dump($_SESSION);die;
			?>
			<style>
				#image {
					max-width: 50px;
					display: block;
				}
			</style>

			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">

					<div class="card-box table-responsive">

						<button type="button" class="btn btn-primary btn_tambah" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>

						<table id="datatable_siswa" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>NISN</th>
									<th>Nama Lengkap</th>
									<th>Tanggal Lahir</th>
									<th>Tempat Lahir</th>
									<th>Jenis Kelamin</th>
									<th>Alamat</th>
									<th>Kelas</th>
									<th>Foto</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade bs-example-modal-lg" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<form id="form">
			<div class="modal-content">
				<?php
				if ($_SESSION['user'] == 'guru') { ?>

					<input type="hidden" name="id_kelasFromSession" id="id_kelasFromSession" value="<?php echo $id_kelasFromWali ?>">
				<?php
				} ?>

				<input type="hidden" name="SessionUser" id="SessionUser" value="<?php echo $_SESSION['user']  ?>">


				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<h4>Detail User</h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">

								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> NISN <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nisn" name="nisn" class="form-control " placeholder="Isikan Nama" readonly type="number" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nama" name="nama" class="form-control " placeholder="Isikan Nama" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Alamat <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="alamat" name="alamat" class="form-control " placeholder="Isikan Alamat" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kelas <span class="required">*</span>
											</label>
											<div class="col-sm-9">
												<select class="form-control select col-md-8 col-sm-8" name="kelas" id="kelas">
													<option value="default" desable>Pilih Kelas</option>


													<?php
													foreach ($listKelas as $r) {

														// die;
														echo '
							<option value="' . $r->id_kelas . '">' . $r->nama_kelas . '</option>
							';
													}
													?>
												</select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Jenis Kelamin <span class="required">*</span>
											</label>
											<div class="col-sm-9">
												<select class="form-control select col-md-8 col-sm-8 " id="jk" name="jk">
													<option value="Laki-laki">Laki-laki</option>
													<option value="Perempuan">Perempuan</option>
												</select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tanggal Lahir <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tanggal_lahir" name="tanggal_lahir" class="form-control " placeholder="Isikan kelas" type="date" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tempat Lahir <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tempat_lahir" name="tempat_lahir" class="form-control " placeholder="Isikan tempat lahir" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="username" name="username" class="form-control " placeholder="Isikan Username" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="password" name="password" class="form-control " placeholder="Isikan Password" type="text" class="form-control">

											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Foto <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<img style="width: 100px; display: block;" src="<?php echo base_url() . "upload/"; ?>images/" id="image" alt="image">
												<div id="foto_wrappers" class="mb-2">

													<div class="col-xs-12">
														<label for="photo">Photo Profile</label>
														<input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg;" name="foto" id="foto">
													</div>
												</div>

											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="Edit">Save changes</button>

					<button type="button" class="btn btn-success" id="tambah_act">Tambah</button>
				</div>
			</div>
		</form>

	</div>
</div>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {

		var bu = '<?= base_url(); ?>';
		var url_form_ubah = bu + 'siswa/ubah_siswa_proses';
		var url_form_tambah = bu + 'siswa/tambah_siswa_proses';



		$('body').on('click', '.btn_detail', function() {

			var nisn = $(this).data('nisn');
			var nama = $(this).data('nama');
			var kelas = $(this).data('id_kelas');
			var jenkel = $(this).data('jen');
			var tanggal_lahir = $(this).data('tanggal_lahir');
			var tempat_lahir = $(this).data('tempat_lahir');
			var foto = $(this).data('foto');
			// var foto = $(this).data('foto');
			// console.log(kelas)

			// $('#nama').createAttribute('readonly');
			document.getElementById("nama").readOnly = true;
			document.getElementById("alamat").readOnly = true;
			document.getElementById("kelas").readOnly = true;
			document.getElementById("jk").readOnly = true;
			document.getElementById("tanggal_lahir").readOnly = true;
			document.getElementById("tempat_lahir").readOnly = true;
			document.getElementById("username").readOnly = true;
			document.getElementById("password").readOnly = true;


			$('#nisn').val(nisn);
			$('#nama').val(nama);
			// $('#kelas').val(kelas);
			$('#jenkel').val(jenkel);
			$('#tempat_lahir').val(tempat_lahir);
			$('#tanggal_lahir').val(tanggal_lahir);
			$('#image').prop('src', 'upload/images/' + foto);

			$("#kelas select").val(2).prop('selected', true);

			$('#Edit').hide();
			$('#tambah_act').hide();




		});
		$('body').on('click', '.btn_edit', function() {
			url_form = url_form_ubah;
			// console.log(url_form);
			$('#tambah_act').hide();

			// return false;
			var nisn = $(this).data('nisn');
			var nama = $(this).data('nama');
			var kelas = $(this).data('id_kelas');
			var jenkel = $(this).data('jen');
			var tanggal_lahir = $(this).data('tanggal_lahir');
			var tempat_lahir = $(this).data('tempat_lahir');
			var alamat = $(this).data('alamat');
			var username = $(this).data('username');
			var password = $(this).data('password');
			// console.log(username)

			var foto = $(this).data('foto');
			// var foto = $(this).data('foto');
			// console.log(kelas)

			$('#nisn').val(nisn);
			$('#nama').val(nama);
			$('#kelas').val(kelas);
			$('#jenkel').val(jenkel);
			$('#tempat_lahir').val(tempat_lahir);
			$('#tanggal_lahir').val(tanggal_lahir);
			$('#alamat').val(alamat);
			$('#username').val(username);
			$('#password').val(password);

			$('#image').prop('src', 'upload/images/' + foto);
			$('#Edit').show();
			$("#kelas").val(parseInt(kelas));


		});
		$('#Edit').on('click', function() {

			var nisn = $('#nisn').val();
			var nama = $('#nama').val();
			var kelas = $('#kelas').val();
			var jenis_kelamin = $('#jk').val();
			var tanggal_lahir = $('#tanggal_lahir').val();
			var tempat_lahir = $('#tempat_lahir').val();
			// var foto = cekDeskripsi();

			// console.log(nama, kelas, jenis_kelamin, tanggal_lahir, tempat_lahir);
			// return (false);
			// _draft = 1;
			if (
				nama && kelas
			) {
				$("#form").submit();
				// console.log(_foto);
				// return;
				// console.log("draft");
			}
			// return false;
		});
		// var table = $('#datatable-buttons').DataTable({
		// 	lengthChange: false,
		// 	buttons: ['copy', 'excel', 'pdf']
		// });
		$('body').on('click', '.hapus', function() {

			var nisn = $(this).data('nisn');
			var nama = $(this).data('nama');
			// var foto = $(this).data('foto');
			console.log(nisn)
			// return false;
			// var c = confirm('Apakah anda yakin akan menghapus Siswa: "' + nama + '" ?');
			// $('#Edit').hide();
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan Menghapus Siswa: " + nama,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				if (result.value) {
					$.ajax({
						url: bu + 'siswa/hapusSiswa',
						dataType: 'json',
						method: 'POST',
						data: {
							nisn: nisn
						}
					}).done(function(e) {
						// console.log(e);
						Swal.fire(
							'Deleted!',
							e.message,
							'success'
						)
						$('#modal-detail').modal('hide');
						setTimeout(function() {
							location.reload();
						}, 4000);


					}).fail(function(e) {
						console.log('gagal');
						console.log(e);
						var message = 'Terjadi Kesalahan. #JSMP01';
						// notifikasi('#alertNotif', message, true);
					});




				}
			})




		});

		function notifikasi(sel, msg, err) {
			var alert_type = 'alert-success ';
			if (err) alert_type = 'alert-danger ';
			var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$(sel).html(html);
			$('html, body').animate({
				// scrollTop: $(sel).offset().top - 75
			}, 500);
		}

		$("#form").submit(function(e) {
			console.log('form submitted');
			// return false;

			$.ajax({
				url: url_form,
				method: 'post',
				dataType: 'json',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
			}).done(function(e) {
				console.log(e);
				if (e.status) {
					notifikasi('#alertNotif', e.message, false);
					// Swal.fire(e.message)
					Swal.fire(
						':)',
						e.message,
						'success'
					);

					$('#modal-detail').modal('hide');
					// setTimeout(function() {
					// 	location.reload();
					// }, 4000);
					datatable.ajax.reload();
					// window.location.reload();
					// resetForm();
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'terjadi kesalahan!',

					})
				}
			}).fail(function(e) {
				// console.log(e);
				notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			});
			return false;
		});

		function notifikasiModal(modal, sel, msg, err) {
			var alert_type = 'alert-success ';
			if (err) alert_type = 'alert-danger ';
			var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$(sel).html(html);
			$(modal).animate({
				// scrollTop: $(sel).offset().top - 75
			}, 500);
		}

		$('body').on('click', '.btn_tambah', function() {
			url_form = url_form_tambah;
			console.log(url_form);
			$('#Edit').hide();
			$("#nisn").removeAttr('readonly');



		});

		$('#tambah_act').on('click', function() {

			var nisn = $('#nisn').val();
			var nama = $('#nama').val();
			var alamat = $('#alamat').val();
			var kelas = $('#kelas').val();
			var jenis_kelamin = $('#jk').val();
			var tanggal_lahir = $('#tanggal_lahir').val();
			var tempat_lahir = $('#tempat_lahir').val();
			var user_name = $('#username').val();
			var password = $('#password').val();

			if (
				nama && kelas
			) {
				$("#form").submit();
				// console.log(_foto);
				// return;
				// console.log("draft");
			}
			// return false;
		});
		// if($_)
		var id_kelas = $("#id_kelasFromSession").val();
		var sessionUser = $("#SessionUser").val();
		// alert(sessionValue)
		// console.log(sessionUser)

		if (sessionUser == "guru") {
			var datatable = $('#datatable_siswa').DataTable({
				dom: "Bfrltip",
				'pageLength': 10,
				"responsive": true,
				"processing": true,
				"bProcessing": true,
				"autoWidth": false,
				"serverSide": true,


				"columnDefs": [{
						"targets": 0,
						"className": "dt-body-center dt-head-center",
						"width": "20px",
						"orderable": false
					},
					{
						"targets": 1,
						"className": "dt-head-center"
					},
					{
						"targets": 2,
						"className": "dt-head-center"
					}, {
						"targets": 3,
						"className": "dt-head-center"
					}, {
						"targets": 4,
						"className": "dt-head-center"
					}, {
						"targets": 5,
						"className": "dt-head-center"
					}, {
						"targets": 6,
						"className": "dt-head-center"
					}, {
						"targets": 7,
						"className": "dt-head-center"
					}, {
						"targets": 8,
						"className": "dt-head-center"
					}, {
						"targets": 9,
						"className": "dt-head-center"
					},
				],
				"order": [
					[1, "desc"]
				],
				'ajax': {
					url: bu + 'siswa/getAllSiswa',
					type: 'POST',
					"data": function(d) {
						d.id_kelas = id_kelas;

						return d;
					}
				},

				buttons: [

					// 'excelHtml5',
					// 'pdfHtml5'
					{
						text: "Excel",
						extend: "excelHtml5",
						className: "btn btn-round btn-info",

						title: 'Data Siswa',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7]
						}
					}, {
						text: "PDF",
						extend: "pdfHtml5",
						className: "<br>btn btn-round btn-danger",
						title: 'Data Siswa',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7]
						}
					}





				],
				language: {
					searchPlaceholder: "Cari..",

				},
				// columnDefs: [{
				// 	targets: -1,
				// 	visible: false
				// }],
				"lengthMenu": [
					[10, 25, 50, 1000],
					[10, 25, 50, 1000]
				]

			});

		} else {
			var datatable = $('#datatable_siswa').DataTable({
				dom: "Bfrltip",
				'pageLength': 10,
				"responsive": true,
				"processing": true,
				"bProcessing": true,
				"autoWidth": false,
				"serverSide": true,


				"columnDefs": [{
						"targets": 0,
						"className": "dt-body-center dt-head-center",
						"width": "20px",
						"orderable": false
					},
					{
						"targets": 1,
						"className": "dt-head-center"
					},
					{
						"targets": 2,
						"className": "dt-head-center"
					}, {
						"targets": 3,
						"className": "dt-head-center"
					}, {
						"targets": 4,
						"className": "dt-head-center"
					}, {
						"targets": 5,
						"className": "dt-head-center"
					}, {
						"targets": 6,
						"className": "dt-head-center"
					}, {
						"targets": 7,
						"className": "dt-head-center"
					}, {
						"targets": 8,
						"className": "dt-head-center"
					}, {
						"targets": 9,
						"className": "dt-head-center"
					},
				],
				"order": [
					[1, "desc"]
				],
				'ajax': {
					url: bu + 'siswa/getAllSiswa',
					type: 'POST',
					"data": function(d) {

						return d;
					}
				},

				buttons: [

					// 'excelHtml5',
					// 'pdfHtml5'
					{
						text: "Excel",
						extend: "excelHtml5",
						className: "btn btn-round btn-info",

						title: 'Data Siswa',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7]
						}
					}, {
						text: "PDF",
						extend: "pdfHtml5",
						className: "<br>btn btn-round btn-danger",
						title: 'Data Siswa',
						exportOptions: {
							columns: [1, 2, 3, 4, 5, 6, 7]
						}
					}





				],
				language: {
					searchPlaceholder: "Cari..",

				},
				// columnDefs: [{
				// 	targets: -1,
				// 	visible: false
				// }],
				"lengthMenu": [
					[10, 25, 50, 1000],
					[10, 25, 50, 1000]
				]

			});
		}



	});
</script>
