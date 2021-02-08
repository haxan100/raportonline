<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h2>Data Nilai Siswa </h2>
			<?php $bu = base_url();
			$urlid = $this->uri->segment(3);
			$nisn = $urlid;
			// var_dump($urlid);
			$role=0;
			?>
			<style>
				#image {
					max-width: 100px;
					display: block;
				}
			</style>

			<div class="clearfix"></div>
			<div class="clearfix">
				<h2> <?php echo strtoupper($nama); ?></h2>
			</div>
		</div>
		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">

					<div class="card-box table-responsive">

						<input type="hidden" id="nisn" value="<?= $nisn ?>" />


							<?php if($_SESSION['user']=="guru" or $_SESSION['user']=="admin" ){
										?>
											<button type="button" class="btn btn-primary btn_tambah" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah</button>
									<?php 
									} 
									?>
					

						<button type="button" class="btn btn-primary btn_tambah" id="cetakNilai" >Cetak Nilai</button>

						<table id="datatable_siswa" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Kelas</th>
									<th>Nama Mapel</th>
									<td>Nilai Harian</td>
									<td>Nilai UTS</td>
									<td>Nilai UAS</td>
									<td>Nilai Pengetahuan</td>
									<td>Nilai Karakter</td>
									<td>Keterangan</td>

									<?php if($_SESSION['user']=="guru" or $_SESSION['user']=="admin" ){
										$role=1;
										?>
										<th>Opsi</th>
									<?php 
									} 
									?>
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
					<h4>Detail Nilai</h4>

					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<input name="nisn" hidden id="nisn" value="<?php echo intval($nisn); ?>">
								<input type="hidden" name="id_nilai" id="id_nilai">
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Mapel <span class="required">*</span>
											</label>
											<div class="col-sm-9">
												<select class="form-control select col-md-8 col-sm-8" name="mapel" id="mapel">
													<option value="default" desable>Pilih Mapel</option>


													<?php
													foreach ($listMapel	 as $r) {	// die;
														echo '
													<option value="' . $r->kode_mapel . '">' . $r->nama_mapel . '</option>
													';
													}
													?>
												</select>
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
		var url_form_ubah = bu + 'nilai/ubah_nilai_siswa_proses';
		var url_form_tambah = bu + 'nilai/tambah_nilai_siswa_proses';

    var role_harga_awal = <?= $role; ?>;	


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

			var mapel = $(this).data('kode_mapel');
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
			console.log(mapel)

			$('#id_nilai').val(id_nilai);
			$('#nama_mapel').val(nama_mapel);
			$('#mapel').val(mapel);
			$('#nama_siswa').val(nama);
			$('#nilai_harian').val(nilai_harian);
			$('#nilai_uts').val(nilai_uts);
			$('#nilai_uas').val(nilai_uas);
			$('#nilai_pengetahuan').val(nilai_pengetahuan);
			$('#nilai_karakter').val(nilai_karakter);
			$('#keterangan').val(keterangan);
			$('#Edit').show();


		});

		$('#cetakNilai').on('click', function() {
			// console.log("sssss")

			var url = bu + 'Laporan/CetakNilaiByNISN/';
			var nisn = $('#nisn').val();
			console.log(url+nisn)
			// return false
			window.open(url+nisn);

			
		});
		$('#Edit').on('click', function() {

			var id_nilai = $('#id_nilai').val();
			var nilai_harian = $('#nilai_harian').val();
			var nilai_uts = $('#nilai_uts').val();
			var nilai_uas = $('#nilai_uas').val();
			var nilai_pengetahuan = $('#nilai_pengetahuan').val();
			var nilai_karakter = $('#nilai_karakter').val();
			var keterangan = $('#keterangan').val();
			if (
				id_nilai && nilai_uas
			) {
				$("#form").submit();
			}
			// return false;
		});
		$('body').on('click', '.hapus', function() {

			var id_nilai = $(this).data('id_nilai');
			var nama = $(this).data('nama_mapel');

			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Anda akan Menghapus Nilai Siswa: " + nama,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				if (result.value) {
					$.ajax({
						url: bu + 'nilai/hapusMapelSiswa',
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
						// location.reload();
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
						text: e.message,

					})
					notifikasiModal('#modalProduk', '#alertNotifModal', e.message, true);
					$.each(e.errorInputs, function(key, val) {
						// console.log(val[0], val[1]);
						validasi(val[0], false, val[1]);
						$(val[0])
							.parent()
							.find('.input-group-text')
							.addClass('form-control is-invalid');
					});
				}
			}).fail(function(e) {
				console.log(e);
				notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
			});
			return false;
		});

		function validasi(id, valid, message = '') {
			if (valid) {
				$(id)
					// .addClass('is-valid')
					.removeClass('is-invalid')
					.parent()
					.find('small')
					// .addClass('valid-feedback')
					.removeClass('invalid-feedback')
					.html(message);
			} else {
				$(id)
					// .removeClass('is-valid')
					.addClass('is-invalid')
					.parent()
					.find('small')
					// .removeClass('valid-feedback')
					.addClass('invalid-feedback')
					.html(message);
			}
		}

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
		$('body').on('click', '.tomboldetail', function() {
			window.location = '<?= $bu; ?>Nilai/detail_nilai_siswa/' + $(this).data('nisn');
		});

		$('#tambah_act').on('click', function() {

			var mapel = $('#mapel').val();
			var nisn = $('#nisn').val();
			var nilai_harian = $('#nilai_harian').val();
			var nilai_uts = $('#nilai_uts').val();
			var nilai_uas = $('#nilai_uas').val();
			var nilai_pengetahuan = $('#nilai_pengetahuan').val();
			var nilai_karakter = $('#nilai_karakter').val();
			var Keterangan = $('#Keterangan').val();
			console.log(mapel);
			// return false;
			// var nilai = $('#nilai').val();

			if (
				nisn && mapel
			) {
				$("#form").submit();
				// console.log(_foto);
				// return;
				// console.log("draft");
			}
			// return false;
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
					"orderable": false,
					"visible": false,
				},
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'Nilai/getDetailNilaiSiswa',
				type: 'POST',
				"data": function(d) {
					d.nisn = $('#nisn').val();

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
			language: {
				searchPlaceholder: "Cari Mapel",

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
	function coba() {
            var column = datatable.column(9);	
            $(this).toggleClass("active");
            column.visible(!column.visible());
	  }
	  if(role_harga_awal==1){
	  	coba()
	  }

	});
</script>
