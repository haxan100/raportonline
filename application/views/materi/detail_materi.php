		<div class="col-md-12">
			<?php
			// var_dump($data);die;	
			?>
			
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Materi Mapel : <?= $data->nama_mapel ?> <small></small></h2>

                    <div class="clearfix"></div>
					<a href="<?= base_url() ?>/Laporan/Materi/<?=$data->id_materi?>" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> Download PDF </a>
                  </div>
                  <div class="x_content">

                    <div class="col-md-12 col-lg-12 col-sm-12">
                      <blockquote>
						  <?= $data->materi ?>
                      </blockquote>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-12">
						<hr>
                      <h4>Link</h4>
                      <span class="btn btn-success btn-xs link"><?= $data->link ?></span>
                    </div>
                  </div>
                </div>
              <!-- </div>
            </div> -->
          </div>
        <!-- </div> -->

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		
		$( ".link" ).click(function() {
			window.location.href = '<?= $data->link ?>';
		});
		




	});
</script>