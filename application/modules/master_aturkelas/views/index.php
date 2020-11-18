<div class="row">
	<div class="col-md-12">
		<?php
		if($this->session->flashdata('notif')):
	?>
	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">
		<?= $this->session->flashdata('notif') ?>
	</div>
	<?php endif; ?>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
				Tentukan kelas siswa dengan mamasukkan <b>NIPD</b>, hanya siswa yang belum memiliki kelas yang dapat ditentukan.
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
				<label>Lihat data siswa berdasarkan kelas :</label>
	            <select id="id_kelas" class="form-control" required>
	             <?php
	                 foreach($data_kelas_filter as $data_kelas_filter):
	            ?>
	              <option value="<?= $data_kelas_filter->ID_KELAS ?>"><?= $data_kelas_filter->NAMA_KELAS ?></option>
	              <?php endforeach; ?>
	              </select>
	            </div>
	            <button type="button" class="btn btn-primary" id="filter_kelasnya">Filter Data</button>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<form action="<?= base_url('master_aturkelas/pilihKelasSubmit') ?>" method="post">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<h4>Pilih Siswa</h4>
				<select class="form-control select2" name="id_siswa[]" required multiple="multiple"></select>
				</div>
				<div class="form-group">
		            <h4>Pilih Kelas</h4>
		            <select name="id_kelas" class="form-control" required>
		             <?php
		                 foreach($data_kelas as $data_kelas):
		                 
		                 ?>
		              <option value="<?= $data_kelas->ID_KELAS ?>"><?= $data_kelas->NAMA_KELAS ?></option>

		              <?php endforeach; ?>
		              </select>
	            </div>
	            <input type="submit" value="Terapkan" class="btn btn-primary"/>
			</div>
		</div>
		</form>
	</div>
</div>
<div class="row">
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
				url : '<?= base_url("master_aturkelas/filterKelas") ?>',
				data : 'id_kelas=' + $('#id_kelas').val(),
				success:function(data){
					$('#sts').html(data);
				}
			});
   		});
		   $('.select2').select2({
	        placeholder: '--- Pilih Siswa ---',
	        ajax: {
	          url: '<?= base_url("master_aturkelas/searchSiswa") ?>',
	          dataType: 'json',
	          delay: 250,
	          processResults: function (data) {
	            return {
	              results: data
	            };
	          },
	          cache: true
	        }
	      });

		});
</script>