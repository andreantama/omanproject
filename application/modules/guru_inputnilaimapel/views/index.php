<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php if($status_input): ?>
				<?php if($status_input_2): ?>
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
	            <button type="button" class="btn btn-primary" id="filter_kelasnya">Filter Data</button>
	            <?php else: ?>
	            Anda belum memiliki kelas mengajar, silahkan hubungi administator.
	            <?php endif; ?>
	            <?php else: ?>
	            Input nilai tidak bisa dilakukan jika mata pelajaran belum ditentukan, silahkan hubungi Administrator untuk lebih lanjut.
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
				url : '<?= base_url("guru_inputnilaimapel/filterKelas") ?>',
				data : 'id_kelas=' + $('#id_kelas').val(),
				success:function(data){
					$('#sts').html(data);
				}
			});
   		});

		});
</script>