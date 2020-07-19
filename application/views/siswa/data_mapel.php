<div class="col-md-12 col-sm-12 ">
	<?php $bu = base_url(); ?>
	<div class="x_panel">
		<div class="x_title">
			<h2>Data Mata Pelajaran</h2>
			<style>
				.dataTables_filter {
					margin-left: 75%;
				}
			</style>

			<div class="clearfix"></div>
		</div>

		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">

					<div class="card-box table-responsive">
						<!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#myImport" class="btn m-t-20 btn-info waves-effect waves-light btnTambah">
							<i class="fas fa-upload "></i>
							<i class="fa fa-file-excel"></i> Import Mapel
						</a> -->

						<button type="button" class="btn btn-primary btn_tambah" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>

						<p id="alertNotif" class="mt-2"></p>

						<?php
						if ($this->session->flashdata('flash_oke')) : ?>
							<script type="text/javascript">
								document.addEventListener("DOMContentLoaded", function(event) {
									Swal.fire(
										'Import!',
										'Sukses Import Kelas',
										'success'
									)
								});
							</script>
						<?php endif; ?>
						<?php
						if ($this->session->flashdata('flash_error')) : ?>
							<script type="text/javascript">
								document.addEventListener("DOMContentLoaded", function(event) {
									Swal.fire(
										'Import!',
										'Gagal Import Kelas, terdapat duplikat',
										'error'
									)
								});
							</script>
						<?php endif; ?>

						<table id="table_siswa" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Mapel</th>
									<th>Nama Mapel</th>
									<th>KKM</th>
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
					<h4>Detail Mapel</h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">

								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Mapel<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="kode_mapel" name="kode_mapel" class="form-control " placeholder="ID Kelas" readonly type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Mapel <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="nama" name="nama" class="form-control " placeholder="Isikan Nama Kelas" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> KKM<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="kkm" name="kkm" class="form-control " min="1" max="999" placeholder="Isikan KKM" type="number" class="form-control">

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

<!-- // MODAL Import -->
<div id="myImport" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Harga </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">

					<form method="post" enctype="multipart/form-data" action="<?= $bu; ?>Import/import_harga">

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<p> Pilih File : </p>
								<input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL" required="required" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

								<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
							</div>
						</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="submit" name="upload" class="btn btn-success"> IMPORT </button>
				<button type="button" class="btn btn-default" data-dismiss="modal"> BATAL </button>
			</div>
		</div>

		</form>

	</div>
</div>


<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		var bu = '<?= base_url(); ?>';
		var buttonCommon = {
			exportOptions: {
				format: {
					body: function(data, row, column, node) {
						// Strip $ from salary column to make it numeric
						return column === 5 ?
							data.replace(/[$,]/g, '') :
							data;
					}
				}
			}
		};

		var datatable = $('#table_siswa').DataTable({
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
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'siswa/getAllMapel',
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
					tittle: '',
					exportOptions: {
						columns: [1, 2]
					}
				}, {
					text: "PDF",
					extend: "pdfHtml5",
					className: "<br>btn btn-round btn-danger",
					tittle: '',
					exportOptions: {
						columns: [1, 2]
					}
				}





			],
			language: {
				searchPlaceholder: "Cari disini..",

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

		var url_form_ubah = bu + 'siswa/ubah_mapel';
		var url_form_tambah = bu + 'siswa/tambah_mapel_proses';


		$('body').on('click', '.btn_edit', function() {
			url_form = url_form_ubah;
			console.log(url_form);
			$('#tambah_act').hide();

			// return false;
			var nama = $(this).data('nama');
			var kode_mapel = $(this).data('kode_mapel');
			var kkm = $(this).data('kkm');
			console.log(nama, kode_mapel, kkm)

			$('#nama').val(nama);
			$('#kode_mapel').val(kode_mapel);
			$('#Edit').show();
			$("#kode_mapel").val(parseInt(kode_mapel));
			$("#kkm").val(parseInt(kkm));


		});
		$('#Edit').on('click', function() {

			var nama = $('#nama').val();
			var kode_mapel = $('#kode_mapel').val();
			var kkm = $('#kkm').val();

			if (
				nama
			) {
				$("#form").submit();
			}
			// return false;
		});



		$('body').on('click', '.hapus', function() {

			var kode_mapel = $(this).data('kode_mapel');
			var nama = $(this).data('nama');
			// var foto = $(this).data('fid_kelasoto');
			console.log(kode_mapel)
			// return false;
			// var c = confirm('Apakah anda yakin akan menghapus Siswa: "' + nama + '" ?');
			// $('#Edit').hide();
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan Menghapus Mapel: " + nama,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				if (result.value) {
					$.ajax({
						url: bu + 'siswa/hapusMapel',
						dataType: 'json',
						method: 'POST',
						data: {
							kode_mapel: kode_mapel
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
					// notifikasi('#alertNotif', e.message, false);
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
			console.log(url_form);
			$('#Edit').hide();

		});

		$('#tambah_act').on('click', function() {

			var nama = $('#nama').val();
			var kkm = $('#kkm').val();

			if (
				nama
			) {
				$("#form").submit();
				// console.log(_foto);
			}
			// return false;
		});




	});
</script>
