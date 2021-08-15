<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h2>Data Materi</h2>
			<?php $bu = base_url();
			$urlid = $this->uri->segment(3);
			$nisn = $urlid;
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
						
						<div class="form-group row">
							<!-- <label class="control-label col-md-3 col-sm-3 ">Select</label> -->
							<div class="col-md-3 col-sm-3 ">
								<select class="form-control" id="mapel">
									<option value='default'>Pilih Mapel</option>
									<?php
									foreach ($listMapel as $r) {
										echo '
												<option data-id= "' . $r->kode_mapel . '" value="' . $r->kode_mapel . '">' . $r->nama_mapel . '</option>
											';
									}
									?>
								</select>
							</div>
						</div>

						<input type="hidden" id="nisn" value="<?= $nisn ?>" />
						<table id="datatable_siswa" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Kelas</th>
									<th>Mapel</th>
									<th>Materi</th>
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


<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {

		var bu = '<?= base_url(); ?>';
		var url_form_ubah = bu + 'nilai/ubah_nilai_siswa_proses';
		var url_form_tambah = bu + 'nilai/tambah_nilai_siswa_proses';

   		var role_harga_awal = <?= $role; ?>;	


		$('body').on('click', '.btn_detail', function() {
			console.log($(this).data())
			window.location.href = '<?= base_url() ?>/Nilai/DetailMateri/'+$(this).data('id_materi');
			return false

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
		$('body').on('click', '.tomboldetail', function() {
			window.location = '<?= $bu; ?>Nilai/detail_nilai_siswa/' + $(this).data('nisn');
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
				}, 
			],
			"order": [
				[1, "desc"]
			],
			'ajax': {
				url: bu + 'Nilai/getMateriForKelas',
				type: 'POST',
				"data": function(d) {
					d.id_kelas = '<?= $id_kelas ?>';
					d.mapel = $('#mapel').val();

					return d;
				}
			},
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
		$('#mapel').on('change', function() {
			datatable.ajax.reload();
		});

	});
</script>
