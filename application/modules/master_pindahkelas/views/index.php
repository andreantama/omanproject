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
				Masukkan <b>NIPD</b> untuk melakukan pindah kelas, pindah kelas dapat diinput lebih dari satu siswa. Hanya siswa yang sudah memiliki kelas yang dapat melakukan pindah kelas.
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<form action="<?= base_url('master_pindahkelas/pindahKelasSubmit') ?>" method="post">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<h4>Pilih Siswa</h4>
				<select class="form-control select2" name="id_siswa[]" required multiple="multiple"></select>
				</div>
				<div class="form-group">
		            <h4>Pindah Kelas</h4>
		            <select name="id_kelas" class="form-control">
		             <?php
		             	$a = 0;
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
<script>
   $(document).ready(function () {
		   $('.select2').select2({
	        placeholder: '--- Pilih Siswa ---',
	        ajax: {
	          url: '<?= base_url("master_pindahkelas/searchSiswa") ?>',
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