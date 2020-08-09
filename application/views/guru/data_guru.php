<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h2>Data Guru</h2>
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

						<button type="button" class="btn btn-primary btn_tambah" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>

						<table id="datatable_siswa" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>NIK</th>
									<th>Nama Lengkap</th>
									<th>Kelas</th>
									<th>Mapel</th>
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
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<h4>Detail Guru</h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">

								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Id Guru <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="id_guru" name="id_guru" class="form-control " placeholder="Isikan Nama" readonly type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> NIK<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nik" name="nik" class="form-control " placeholder="Isikan NIK" type="text" class="form-control">

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
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Mapel <span class="required">*</span>
											</label>
											<div class="col-sm-9">
												<select class="form-control select col-md-8 col-sm-8" name="mapel" id="mapel">
													<option value="">Pilih</option>
												</select>
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
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tempat Lahir <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tempat_lahir" name="tempat_lahir" class="form-control " placeholder="Isikan Tempat Lahir" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tanggal Lahir <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="tanggal_lahir" name="tanggal_lahir" class="form-control " placeholder="Isikan Tempat Lahir" type="date" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Alamat<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="alamat" name="alamat" class="form-control " placeholder="Isikan Tempat Alamat" type="Alamat" class="form-control">

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


		$("#kelas").change(function() {
			// Ketika user mengganti atau memilih data provinsi
			// $("#kota").hide(); // Sembunyikan dulu combobox kota nya
			// $("#loading").show(); // Tampilkan loadingnya
			var kelas = $("#kelas").val()
			// console.log(kelas);return false;
			$.ajax({
				type: "POST", // Method pengiriman data bisa dengan GET atau POST
				url: "<?php echo base_url("Wali/getMapelFromKelas"); ?>", // Isi dengan url/path file php yang dituju
				data: {
					kelas: kelas
				}, // data yang akan dikirim ke file yang dituju
				dataType: "json",
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(res) { // Ketika proses pengiriman berhasil
					console.log(res);
					// return false;
					$("#loading").hide(); // Sembunyikan loadingnya
					// set isi dari combobox kota
					// lalu munculkan kembali combobox kotanya
					// $("#mapel").html(res.list_kota).show();
					$("#mapel").html(res.list_kota).show();
				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});
		});



		var bu = '<?= base_url(); ?>';
		var url_form_ubah = bu + 'wali/ubah_guru_proses';
		var url_form_tambah = bu + 'wali/tambah_guru_proses';

		function mapels(kelas, mapel) {

			// var kelas = $(this).data('id_kelas');
			// console.log(kelas);
			// console.log(mapel);
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: "<?php echo base_url("Wali/getMapelFromKelasAndMapel"); ?>",

				data: {
					kelas: kelas,
					mapel: mapel,
				},
				dataType: "json",
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(res) { // Ketika proses pengiriman berhasil
					console.log(res);
					// return false;
					$("#loading").hide(); // Sembunyikan loadingnya
					// set isi dari combobox kota
					// lalu munculkan kembali combobox kotanya
					// $("#mapel").html(res.list_kota).show();
					$("#mapel").html(res.list_kota).show();
				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});
		}

		$('body').on('click', '.btn_edit', function() {
			url_form = url_form_ubah;
			// console.log(url_form);
			$('#tambah_act').hide();
			// $("#kode_wali").removeAttr('readonly');
			$("#kode_wali").prop("readonly", true);
			var nik = $(this).data('kode_wali');
			var id_guru = $(this).data('id_guru');
			var nama = $(this).data('nama');
			var kelas = $(this).data('id_kelas');
			var mapel = $(this).data('id_mapel');
			var username = $(this).data('username');
			var password = $(this).data('password');
			var tempat_lahir = $(this).data('tempat_lahir');
			var tanggal_lahir = $(this).data('tanggal_lahir');
			var alamat = $(this).data('alamat');
			// console.log(mapel);

			$('#nik').val(nik);
			$('#id_guru').val(id_guru);
			$('#nama').val(nama);
			$('#kelas').val(kelas);
			$('#mapel').val(mapel);
			mapels(kelas, mapel);
			$('#username').val(username);
			$('#password').val(password);

			$('#tempat_lahir').val(tempat_lahir);
			$('#tanggal_lahir').val(tanggal_lahir);
			$('#alamat').val(alamat);

			$('#Edit').show();
			$("#kelas").val(parseInt(kelas));


		});
		$('#Edit').on('click', function() {

			var id_guru = $('#id_guru').val();
			var nik = $('#nik').val();
			var nama = $('#nama').val();
			var kelas = $('#kelas').val();
			var mapel = $('#mapel').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var tempat_lahir = $('#tempat_lahir').val();
			var tanggal_lahir = $('#tanggal_lahir').val();
			var alamat = $('#alamat').val();
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

			var id_guru = $(this).data('id_guru');
			var nama = $(this).data('nama');
			// var foto = $(this).data('foto');
			// console.log(kode_wali)
			// return false;
			// var c = confirm('Apakah anda yakin akan menghapus Siswa: "' + nama + '" ?');
			// $('#Edit').hide();
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan Menghapus Guru: " + nama,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				if (result.value) {
					$.ajax({
						url: bu + 'wali/hapusGuru',
						dataType: 'json',
						method: 'POST',
						data: {
							id_guru: id_guru
						}
					}).done(function(e) {
						console.log(e);
						Swal.fire(
							'Deleted!',
							e.message,
							'success'
						)
						$('#modal-detail').modal('hide');
						datatable.ajax.reload();



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
				console.log(e);
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
			$("#kode_wali").removeAttr('readonly');



		});

		$('#tambah_act').on('click', function() {

			var id_guru = $('#id_guru').val();
			var nama = $('#nama').val();
			var kelas = $('#kelas').val();
			var mapel = $('#mapel').val();
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
				},
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'wali/getAllGuru',
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
					title: 'Data Guru Kelas',

					exportOptions: {
						columns: [1, 2, 3,4]
					}
				}, {
					text: "PDF",
					extend: "pdfHtml5",
					className: "<br>btn btn-round btn-danger",
					title: 'Data Guru Kelas',

					exportOptions: {
						columns: [1, 2, 3,4]
					}
				}





			],
			language: {
				searchPlaceholder: "Cari",

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


	});
</script>
