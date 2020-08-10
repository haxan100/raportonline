<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<style>
			.dropzone {
				min-height: 30px;
				border: 1px solid #e5e5e5;
			}
		</style>
		<div class="x_title">
			<h2>Data Sekolah</h2>
			<style>
				#image {
					max-width: 100px;
					display: block;
				}
			</style>

			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">

					<div class="card-box table-responsive">

						<table id="datatable_config" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Sekolah</th>
									<th>Alamat</th>
									<th>No Telp</th>
									<th>Kepala Sekolah</th>
									<th>Deskripsi</th>
									<th>Logo</th>
									<th>Edit</th>
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
	<!-- // visi misi -->
	<div class="x_panel">
		<div class="x_title">
			<h2>Visi</h2>
			<style>
				#image {
					max-width: 100px;
					display: block;
				}
			</style>

			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">

					<div class="card-box table-responsive">

						<button type="button" class="btn btn-primary btn_tambah_visi" data-toggle="modal" data-target=".modal_visi">Tambah</button>

						<table id="datatable_visi_config" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Visi</th>
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
	<div class="x_panel">
		<div class="x_title">
			<h2>Misi</h2>
			<style>
				#image {
					max-width: 100px;
					display: block;
				}
			</style>

			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">

					<div class="card-box table-responsive">

						<table id="datatable_misi" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Misi</th>
									<th>Edit</th>
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
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<h4>Detail Sekolah</h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">

								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Sekolah<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nama_sekolah" name="nama_sekolah" class="form-control " placeholder="Isikan Nama Sekolah" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Alamat<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="alamat" name="alamat" class="form-control " placeholder="Isikan Alamat" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> No Telp <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="no_telp" name="no_telp" class="form-control " placeholder="Isikan Nama" type="text" class="form-control">

											</div>
										</div>



										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kepala Sekolah <span class="required">*</span>
											</label>
											<div class="col-sm-9">
												<input id="kepala_sekolah" name="kepala_sekolah" class="form-control " placeholder="Isikan Nama Kepala Sekolah" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Deskripsi <span class="required">*</span>
											</label>
											<div class="col-sm-9">
												<input id="Deskripsi" name="Deskripsi" class="form-control " placeholder="Isikan Deskripsi" type="text" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Logo <span class="required">*</span>
											</label>
											<div class="col-sm-9">
												<input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg;" name="foto" id="foto" class="dropzone biz-dropzone">

											</div>
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

<div class="modal fade modal_visi" id="modal-visi" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<form id="formVisi">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<h4>Visi Sekolah</h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">

								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<input type="text" name="id_visi" id="id_visi" hidden>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Visi<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea name="visi" id="visi" cols="15" rows="10" class="form-control"></textarea>


											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="EditVisi">Save changes</button>

					<button type="button" class="btn btn-success" id="tambah_Visi">Tambah</button>
				</div>
			</div>
		</form>

	</div>
</div>




<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		var bu = '<?= base_url(); ?>';
		var url_form_ubah = bu + 'konfig/ubah_konfig_proses';
		var url_form_ubah_visi = bu + 'konfig/ubah_konfig_visi_proses';

		var url_form_visi_tambah = bu + 'konfig/tambah_visi_proses';
		var url_form_tambah = bu + 'wali/tambah_guru_proses';



		$('body').on('click', '.btn_edit_det', function() {
			url_form = url_form_ubah;
			// console.log(url_form);
			$('#tambah_act').hide();
			// $("#kode_wali").removeAttr('readonly');
			// $("#kode_wali").prop("readonly", true);
			var nama = $(this).data('nama');
			var alamat = $(this).data('alamat');
			var no_telp = $(this).data('no_telp');
			var kepala_sekolah = $(this).data('kepala_sekolah');
			var deskripsi = $(this).data('deskripsi');
			// console.log(deskripsi);

			$('#nama_sekolah').val(nama);
			$('#alamat').val(alamat);
			$('#no_telp').val(no_telp);
			$('#kepala_sekolah').val(kepala_sekolah);
			$('#Deskripsi').val(deskripsi);

			$('#Edit').show();
			// $("#kelas").val(parseInt(kelas));


		});

		$('body').on('click', '.btn_edit_visi', function() {
			url_form = url_form_ubah_visi;
			// console.log(url_form);
			$('#tambah_Visi').hide();
			var visi = $(this).data('ket');
			var id_visi = $(this).data('id_visi');
			// console.log(id_visi);
			$('#visi').val(visi);
			$('#id_visi').val(id_visi);

			$('#Edit').show();
			// $("#kelas").val(parseInt(kelas));


		});
		$('#EditVisi').on('click', function() {

			var visi = $('#visi').val();
			// console.log(visi);
			// return false;
			$("#formVisi").submit();
		});

		// btn_tambah_visi
		$('.btn_tambah_visi').on('click', function() {
			var visi = $('#visi').val();
			url_form = url_form_visi_tambah;
			// console.log(visi);
			// return false;
			// EditVisi
			$('#EditVisi').hide()

		})
		$('#tambah_Visi').on('click', function() {
			var visi = $('#visi').val();
			// url_form = url_form_visi_tambah;

			console.log(visi);
			// return false;
			// EditVisi
			$('#EditVisi').hide()
			$("#formVisi").submit();
		})



		$('#Edit').on('click', function() {

			var nama = $('#nama_sekolah').val();
			var alamat = $('#alamat').val();
			var no_telp = $('#no_telp').val();
			var kepala_sekolah = $('#kepala_sekolah').val();
			var madeskripsipel = $('#deskripsi').val();

			if (
				nama && alamat
			) {
				$("#form").submit();
				// console.log(_foto);
				// return;
				// console.log("draft");
			}
			// return false;
		});

		// $('#Edit').on('click', function() {

		// 	var nama = $('#nama_sekolah').val();
		// 	var alamat = $('#alamat').val();
		// 	var no_telp = $('#no_telp').val();
		// 	var kepala_sekolah = $('#kepala_sekolah').val();
		// 	var madeskripsipel = $('#deskripsi').val();

		// 	if (
		// 		nama && alamat
		// 	) {
		// 		$("#form").submit();
		// 		// console.log(_foto);
		// 		// return;
		// 		// console.log("draft");
		// 	}
		// 	// return false;
		// });


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
				// console.log(e);
				if (e.status) {
					notifikasi('#alertNotif', e.message, false);
					// Swal.fire(e.message)
					Swal.fire(
						':)',
						e.message,
						'success'
					)

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
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'terjadi kesalahan!',

				})
				notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			});
			return false;
		});
		$("#formVisi").submit(function(e) {
			// console.log('form submitted');
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
				// console.log(e);
				if (e.status) {
					notifikasi('#alertNotif', e.message, false);
					// Swal.fire(e.message)
					Swal.fire(
						':)',
						e.message,
						'success'
					)

					$('#modal-visi').modal('hide');
					// setTimeout(function() {
					// 	location.reload();
					// }, 4000);
					datatable2.ajax.reload();
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
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'terjadi kesalahan!',

				})
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

		var datatable2 = $('#datatable_visi_config').DataTable({
			// dom: "Bfrltip",
			// 'pageLength': 10,
			"bLengthChange": false,
			"dom": "lfrti",
			"searching": false,
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
				},
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'Konfig/getAllVisi',
				type: 'POST',
				"data": function(d) {

					return d;
				}
			},
			language: {
				searchPlaceholder: "Cari",

			},

		});

		var datatable = $('#datatable_config').DataTable({
			// dom: "Bfrltip",
			// 'pageLength': 10,
			"bLengthChange": false,
			"dom": "lfrti",
			"searching": false,
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
				},
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'Konfig/getAllKonfig',
				type: 'POST',
				"data": function(d) {

					return d;
				}
			},
			language: {
				searchPlaceholder: "Cari",

			},

		});


	});
</script>
