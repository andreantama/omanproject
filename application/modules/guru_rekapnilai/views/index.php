<div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">

			<div class="panel-body">

				<?php if(@$status_rekap): ?>
				<?php if(@$status_input_2): ?>
				<div class="form-group">

					<label>Mata Pelajaran</label>
					<select class="form-control" id="id_mapel" name="id_mapel">
						<option value="0">- Pilih Mapel -</option>
						<?php foreach($list_mapel as $list_mapel): ?>
							<?php
								$detail_mapel = $this->guru_rekapnilai->tampilData('tbl_mapel','*', array('ID_MAPEL' => $list_mapel->ID_MAPEL), TRUE);
							?>
							<option value="<?= $detail_mapel->ID_MAPEL; ?>"><?= $detail_mapel->MAPEL; ?></option>
						<?php endforeach; ?>
					</select>

				</div>

				<div class="form-group">

				<label>Pilih Kelas :</label>

	            <select id="id_kelas" class="form-control">

	             <?php

	                 foreach($data_kelas_filter as $data_kelas_filter):

	            ?>

	              <option value="<?= $data_kelas_filter->ID_KELAS ?>"><?= $data_kelas_filter->NAMA_KELAS ?></option>

	              <?php endforeach; ?>

	              </select>

	            </div>

	            <div class="form-group">

				<label>Pilih Semester :</label>

	            <select id="id_semester" class="form-control">

			             <?php

			                 foreach($data_semester as $data_semester):

			             ?>

			              <option value="<?= $data_semester->ID_TAHUN_PEL ?>"><?= $data_semester->TAHUN_PEL.' ( Semester '.$data_semester->SEMESTER.' )' ?></option>

			              <?php endforeach; ?>

			              </select>

	            </div>

	            <button type="button" class="btn btn-primary" id="filter_kelasnya">Rekap Nilai Siswa</button>
				<?php else: ?>
				Anda belum memiliki kelas mengajar, silahkan hubungi administator.
				<?php endif; ?>
	            <?php else: ?>

	            Rekap nilai tidak bisa dilakukan jika mata pelajaran belum ditentukan. Silahkan hubungi Administrator untuk lebih lanjut.

	            <?php endif; ?>

			</div>

		</div>

	</div>

	<div class="col-md-12">

		<div id="sts"></div>

	</div>

</div>

<script>

   $(document).ready(function () {

   		$('#filter_kelasnya').click(function(){

   			$('#sts').html('Memuat data...');

   			$.ajax({

				method : "POST",

				url : '<?= base_url("guru_rekapnilai/filterKelas") ?>',

				data : 'id_kelas=' + $('#id_kelas').val() + '&id_semester=' + $('#id_semester').val() + '&id_mapel=' + $('#id_mapel').val(),

				success:function(data){

					$('#sts').html(data);

				}

			});

   		});



		});

</script>