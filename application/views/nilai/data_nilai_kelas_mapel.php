<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h2>Data Nilai Kelas</h2>
			<?php
			$u = $this->uri->segment(3);

			// var_dump($listSiswa);
			?>



			<?php $bu = base_url(); ?>
			<style>
				#image {
					max-width: 100px;
					display: block;
				}
			</style>
			<input type="hidden" name="kelas" id="kelas" value="<?php echo $kelas[0]->id_kelas ?>">

			<div class="clearfix"></div>
			<h2>Mapel : <b><?php echo $mapel[0]->nama_mapel ?></b></h2>
			<br>
			<br>
			<h2>Kelas : <b><?php echo $kelas[0]->nama_kelas ?></b></h2>

			<div class="clearfix"></div>


		</div>

		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<!-- <button type="button" class="btn btn-primary btn_tambah" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button> -->
						<table id="datatable_siswa_kelas" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Siswa</th>
									<th>Foto</th>
								</tr>
							</thead>

							<tbody>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<button type="button" class="btn btn-primary btn_tambah" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>
						<table id="datatable_siswa" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Mapel</th>
									<th>Nama Siswa</th>
									<td>Nilai Harian</td>
									<td>Nilai UTS</td>
									<td>Nilai UAS</td>
									<td>Nilai Pengetahuan</td>
									<td>Nilai Karakter</td>
									<td>Keterangan</td>
									<th>Opsi</th>
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
					<h4>Detail Nillai </h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">

								<input id="id_nilai" name="id_nilai" type="hidden">
								<input type="hidden" name="mapel" id="mapel" value="<?php echo $u ?>">

								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Pilih Siswa <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control select col-md-8 col-sm-8" name="siswa" id="siswa">
													<option value="default" desable>Pilih Siswa</option>
													<?php
													foreach ($listSiswa as $r) {
														// die;
														echo '
														<option value="' . $r->nisn . '"  data-nilai="' . $r->nama_lengkap . '">' . $r->nama_lengkap . '</option>
														';
													}
													?>
												</select>

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Mapel <span class="required" value=>*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nama_mapel" name="nama_mapel" class="form-control " readonly value="<?php echo $mapel[0]->nama_mapel ?>" placeholder="Isikan Nama Mapel" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nilai Harian <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nilai_harian" name="nilai_harian" class="form-control " placeholder="Isikan Nilai Harian" type="number" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nilai UTS<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nilai_uts" name="nilai_uts" class="form-control " placeholder="Isikan UTS" type="number" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nilai Uas <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nilai_uas" name="nilai_uas" class="form-control " placeholder="Isikan UAS" type="number" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nilai Pengetahuan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nilai_pengetahuan" name="nilai_pengetahuan" class="form-control " placeholder="Isikan Nilai Pengetahuan" type="number" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nilai Karakter <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nilai_karakter" name="nilai_karakter" class="form-control " placeholder="Isikan Nilai Karakter" type="number" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Keterangan<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="keterangan" name="keterangan" class="form-control " placeholder="Keterangan" type="text" class="form-control">

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
		var url_form_ubah = bu + 'Nilai/ubah_nilai_siswa_proses';
		var url_form_tambah = bu + 'Nilai/tambah_nilai_proses';



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
			console.log(url_form);
			$('#tambah_act').hide();

			// return false;
			var id_nilai = $(this).data('id_nilai');
			var nama = $(this).data('nama');
			var nama_mapel = $(this).data('nama_mapel');
			var nilai_harian = $(this).data('nilai_harian');
			var nilai_uts = $(this).data('nilai_uts');
			var nilai_uas = $(this).data('nilai_uas');
			var nilai_pengetahuan = $(this).data('nilai_pengetahuan');
			var nilai_karakter = $(this).data('nilai_karakter');
			var keterangan = $(this).data('keterangan');
			// var foto = $(this).data('foto');
			// console.log(kelas)

			$('#id_nilai').val(id_nilai);
			$('#nama_mapel').val(nama_mapel);
			$('#nama_siswa').val(nama);
			$('#nilai_harian').val(nilai_harian);
			$('#nilai_uts').val(nilai_uts);
			$('#nilai_uas').val(nilai_uas);
			$('#nilai_pengetahuan').val(nilai_pengetahuan);
			$('#nilai_karakter').val(nilai_karakter);
			$('#keterangan').val(keterangan);
			$('#Edit').show();


		});
		$('#Edit').on('click', function() {

			var id_nilai = $('#id_nilai').val();
			var nilai_harian = $('#nilai_harian').val();
			var nilai_uts = $('#nilai_uts').val();
			var nilai_uas = $('#nilai_uas').val();
			var nilai_pengetahuan = $('#nilai_pengetahuan').val();
			var nilai_karakter = $('#nilai_karakter').val();
			var keterangan = $('#keterangan').val();
			// var foto = cekDeskripsi();

			// console.log(nama, kelas, jenis_kelamin, tanggal_lahir, tempat_lahir);
			// return (false);
			// _draft = 1;
			if (
				id_nilai && nilai_uts
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

			var id_nilai = $(this).data('id_nilai');
			var nama = $(this).data('nama');
			// var foto = $(this).data('foto');
			// console.log(nisn)
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
						url: bu + 'Nilai/hapusNilai',
						dataType: 'json',
						method: 'POST',
						data: {
							id_nilai: id_nilai
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

						// setTimeout(function() {
						// 	// location.reload();
						// }, 4000);


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
						title: 'Maaf...',
						text: e.message,
						

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
			// console.log(url_form);
			$('#Edit').hide();
			$("#nisn").removeAttr('readonly');



		});
		$('body').on('click', '.tomboldetail', function() {
			window.location = '<?= $bu; ?>Nilai/kelas_detail/' + $(this).data('id_kelas');
		});

		$('#tambah_act').on('click', function() {

			var nisn = $('#siswa').val();
			var nama_siswa = $('#siswa').data('nilai');
			var nilai_harian = $('#nilai_harian').val();
			var nilai_uts = $('#nilai_uts').val();
			var nilai_uas = $('#nilai_uas').val();
			var nilai_pengetahuan = $('#nilai_pengetahuan').val();
			var nilai_karakter = $('#nilai_karakter').val();
			var keterangan = $('#keterangan').val();
			var user_name = $('#username').val();
			var password = $('#password').val();
			var mapel = $('#mapel').val();
			// console.log(nama_siswa)
			// return false;

			if (
				nisn && nilai_harian
			) {
				$("#form").submit();
				// console.log(_foto);
				// return;
				// console.log("draft");
			}
			// return false;
		});
		$('body').on('click', '.btn_pilih', function() {
			var kelas = $('#kelas').find(':selected').data('id');
			var mapel = $('#mapel').find(':selected').val()
			console.log(kelas, mapel);
			return false;
			var url = bu + 'Nilai/nilaiKelas/?';
			// url += '&tipe_bid='+tipe_bid;
			// url += '&status=' + status;
			// url += '&selectDate=' + selectDate;
			// url += '&date=' + date;
			// url += '&id_user=' + id_user;
			url += '&idMapel=' + mapel;

			// window.location = url;
			console.log(url);
			return false;
		});

		var datatable_siswa = $('#datatable_siswa_kelas').DataTable({
			// dom: "Bfrltip",
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
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'Nilai/getSiswaKelas',
				type: 'POST',
				"data": function(d) {
					d.kelas = $('#kelas').val();
					d.mapel = $('#mapel').val();
					// d.mapel = $('#mapel').find(':selected').data('id');
					// console.log(d);
					return false;

					return d;
				}
			},
			"lengthMenu": [
				[10, 25, 50, 1000],
				[10, 25, 50, 1000]
			]

		});



		var datatable = $('#datatable_siswa').DataTable({
			// dom: "Bfrltip",
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
				url: bu + 'Nilai/getKelas',
				type: 'POST',
				"data": function(d) {
					d.kelas = $('#kelas').val();
					d.mapel = $('#mapel').val();
					// console.log(d);
					return false;

					return d;
				}
			},

			// buttons: [

			// 	// 'excelHtml5',
			// 	// 'pdfHtml5'
			// 	{
			// 		text: "Excel",
			// 		extend: "excelHtml5",
			// 		className: "btn btn-round btn-info",
			// 		tittle: '',
			// 		exportOptions: {
			// 			columns: [1, 2, 3, 4, 5, 6, 7]
			// 		}
			// 	}, {
			// 		text: "PDF",
			// 		extend: "pdfHtml5",
			// 		className: "<br>btn btn-round btn-danger",
			// 		tittle: '',
			// 		exportOptions: {
			// 			columns: [1, 2, 3, 4, 5, 6, 7]
			// 		}
			// 	}





			// ],
			// language: {
			// 	searchPlaceholder: "Cari Kelas",

			// },
			// columnDefs: [{
			// 	targets: -1,
			// 	visible: false
			// }],
			"lengthMenu": [
				[10, 25, 50, 1000],
				[10, 25, 50, 1000]
			]

		});


		$('#kelas').on('change', function() {
			var id = $(this).val();
			// console.log(id)
			// return false
			// 	datatable.ajax.reload();
			$.ajax({
				url: "<?php echo site_url('Nilai/getMapelByKelas'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].kode_mapel + '>' + data[i].nama_mapel + '</option>';
					}
					$('#mapel').html(html);

				}
			});
			return false;
		});

		// });
		$('#mapel').on('change', function() {
			datatable.ajax.reload();
		});


	});
</script>
