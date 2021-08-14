
<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h2>Data Materi Kelas</h2>
			<?php $bu = base_url(); ?>
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

						<?php
						if ($_SESSION['user'] == 'guru') {
							$id_kelasFromWali = $_SESSION['id_kelas'];
						?>

							<input type="hidden" name="id_kelasFromSession" id="id_kelasFromSession" value="<?php echo $id_kelasFromWali ?>">
						<?php
						} ?>

						<input type="hidden" name="SessionUser" id="SessionUser" value="<?php echo $_SESSION['user']  ?>">

						<div class="form-group row">
							<!-- <label class="control-label col-md-3 col-sm-3 ">Select</label> -->
							<div class="col-md-3 col-sm-3 ">
								<select class="form-control" id="kelas">
									<option data-id=0>Pilih Kelas</option>
									<?php
									foreach ($listKelas as $r) {
										echo '
												<option data-id="' . $r->id_kelas . '" value="' . $r->id_kelas . '">' . $r->nama_kelas . '</option>
											';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<!-- <label class="control-label col-md-3 col-sm-3 ">Select</label> -->
							<div class="col-md-3 col-sm-3 ">
								<select class="form-control" id="mapel">
									<option>Pilih Mapel</option>
									<?php
									foreach ($listMapel as $r) {
										echo '
												<option data-id= "' . $r->kode_mapel . ' " value="' . $r->kode_mapel . '">' . $r->nama_mapel . '</option>
											';
									}
									?>
								</select>
							</div>
						</div>
						<button type="button" class="btn btn-primary btn_tambah" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>
						<table id="datatable_siswa" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Kelas</th>
									<th>Mapel</th>
									<th>Materi</th>
									<th>Status</th>
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
					<h4 id="tambahmateri">Tambah Materi </h4>
					<h4 id="idmateri">Edit Materi </h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">

								<input id="id_materi" name="id_materi" type="hidden">

								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Kelas<span class="required">*</span>
											</label>
											<div class="col-md-9 col-sm-9 ">	
											<select class="form-control" name="kelas" id="kelasInput">
												<option value="" data-id=0>Pilih Kelas</option>
												<?php
												foreach ($listKelas as $r) {
													echo '
															<option data-id="' . $r->id_kelas . '" value="' . $r->id_kelas . '">' . $r->nama_kelas . '</option>
														';
												}
												?>
											</select>

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Mapel<span class="required">*</span>
											</label>
											<div class="col-md-9 col-sm-9 ">
											<select class="form-control" id="mapelInput" name="mapel">
											<option value="">Pilih Mapel</option>
											<?php
											foreach ($listMapel as $r) {
												echo '
														<option data-id= "' . $r->kode_mapel . ' " value="' . $r->kode_mapel . '">' . $r->nama_mapel . '</option>';
											}
											?>
										</select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Materi<span class="required">*</span>
											</label>
											<div class="col-md-9 col-sm-9 ">
												<textarea class="form-control" id="materi" name="materi" rows="5"></textarea>
												<!-- <div id="materi"></div> -->
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Link<span class="required">*</span>
											</label>
											<div class="col-md-9 col-sm-9 ">
												<input id="link" name="link" class="form-control " placeholder="www.heyiamhasan.com" type="text" class="form-control">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Status<span class="required">*</span>
											</label>
											<div class="col-md-9 col-sm-9 ">
											<select class="form-control" id="status" name="status">
											<option value="1">Publish</option>
											<option value="0">Draft</option>
											</select>

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
		var url_form_ubah = bu + 'Siswa/ubah_materi';
		var url_form_tambah = bu + 'Siswa/tambah_materi_proses';

		// var editor = new FroalaEditor('#materi')
		//  new FroalaEditor('div#materi', {
		// 	heightMin: 100,
		// 	heightMax: 200,
		// 	editor.toolbar.disable();
		// 	editor.toolbar.hide();
		// },
		// function () {			
		// 	editor.toolbar.disable();
		// 	editor.toolbar.hide();
		// });
		// var editor = new FroalaEditor('#materi', {}, function () {			
		// 	editor.toolbar.disable();
		// 	editor.toolbar.hide();
		// })

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
			$('#idmateri').show();
			$('#tambahmateri').hide();

			// return false;
			var id_materi = $(this).data('id_materi');
			var nama = $(this).data('nama');
			var nama_mapel = $(this).data('nama_mapel');
			var id_kelas = $(this).data('id_kelas');
			var status = $(this).data('status');
			var id_mapel = $(this).data('id_mapel');
			var link = $(this).data('link');
			console.log(id_kelas,id_mapel)
			$.ajax({
				url: "<?php echo site_url('Nilai/getMateriById'); ?>",
				method: "POST",
				data: {
					id_materi: id_materi
				},
				async: true,
				dataType: 'json',
				success: function(data) {
					$('#materi').val(data.materi);	
				}
			});
			$('#mapelInput').val(id_mapel);
			$('#kelasInput').val(id_kelas);
			$('#id_materi').val(id_materi);
			$('#status').val(status);
			$('#link').val(link);
			$('#link').val(link);
			$('#Edit').show();


		});
		$('#Edit').on('click', function() {

			var id_materi = $('#id_materi').val();
			var id_kelasInput = $('#kelasInput').val();
			var id_mapelInput = $('#mapelInput').val();
			var materi = $('#materi').val();
			var link = $('#link').val();
			var statusInput = $('#status').val();
			console.log(id_materi,id_kelasInput,id_mapelInput,materi,link,statusInput)
			// return false
			if (
				id_materi && id_kelasInput
			) {
				$("#form").submit();
				// console.log(_foto);
				// return;
				// console.log("draft");
			}
			// return false;
		});
		$('body').on('click', '.hapus', function() {
			var id_materi = $(this).data('id_materi');
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan Menghapus Materi Ini ?: ",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				if (result.value) {
					$.ajax({
						url: bu + 'Nilai/hapusMateri',
						dataType: 'json',
						method: 'POST',
						data: {
							id_materi: id_materi
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
			$("#nisn").removeAttr('readonly');



		});
		$('body').on('click', '.tomboldetail', function() {
			window.location = '<?= $bu; ?>Nilai/kelas_detail/' + $(this).data('id_kelas');
		});

		$('#tambah_act').on('click', function() {
			$('#idmateri').hide();
			$('#tambahmateri').show();
			$('#tambah_act').show();
			
			var kelas = $('#kelas').val();
			var mapel = $('#mapelInput').val();
			var materi = $('#materiInput').val();
			var link = $('#link').val();
			var status = $('#status').val();
			console.log(kelas,mapel,materi,link,status)
			if (
				mapel && kelas && materi && link && status
				) {
				$("#form").submit();
			}
			// return false;
		});
		$('body').on('click', '.btn_pilih', function() {
			var kelas = $('#kelas').find(':selected').data('id');
			var mapel = $('#mapel').find(':selected').val()
			// console.log(kelas)
			if (kelas == 0) {
				// alert("Pilih Kelas");
				Swal.fire(
					'Error!',
					"Pilih Kelas",
					'error'
				)
				return false

			} else if (mapel == "Pilih Mapel") {

				Swal.fire(
					'Error!',
					"Pilih Mapel",
					'error'
				)
				// alert("Pilih Mapel");

				return false
			}
			// console.log(kelas, mapel);
			// return false;
			var url = bu + 'Nilai/nilaiKelas/';
			// url += '&tipe_bid='+tipe_bid;
			// url += '&status=' + status;
			// url += '&selectDate=' + selectDate;
			// url += '&date=' + date;
			// url += '&id_user=' + id_user;
			url += +mapel;

			window.location = url;
			console.log(url);
			return false;
		});
		var id_kelas = $("#id_kelasFromSession").val();
		var sessionUser = $("#SessionUser").val();

		if (sessionUser == "guru") {
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
				},{
					"targets": 4,
					"className": "dt-head-center"
				}, {
					"targets": 5,
					"className": "dt-head-center"
				},
			],
				"order": [
					[1, "desc"]
				],
				'ajax': {
					url: bu + 'Nilai/getMateri',
					type: 'POST',
					"data": function(d) {
						// d.kelas = d.id_kelas = id_kelas;

						d.kelas = $('#kelas').val();
						d.mapel = $('#mapel').val();
						// return false;

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
		} else {
			// console.log("admin");
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
				},{
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
				},  {
					"targets": 9,
					"className": "dt-head-center",
					
					"orderable": false
				},   {
					"targets": 10,
					"className": "dt-head-center",					
					"orderable": false
				},
			],
				"order": [
					[1, "desc"]
				],
				'ajax': {
					url: bu + 'Nilai/getKelas',
					type: 'POST',
					"data": function(d) {
						// d.kelas = $('#kelas').find(':selected').data('id');
						// d.mapel = $('#mapel').find(':selected').data('id');
						// console.log(d);
						// return false;

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

		}


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
					datatable.ajax.reload();


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