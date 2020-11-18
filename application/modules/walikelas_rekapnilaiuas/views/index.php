<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
				<label>Kelas :</label>
				<input type="hidden" id="id_kelas" value="<?= $id_kelas->ID_KELAS ?>"/>
	            <p><?= $id_kelas->NAMA_KELAS ?></p>
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
				url : '<?= base_url("walikelas_rekapnilaiuas/filterKelas") ?>',
				data : 'id_kelas=' + $('#id_kelas').val() + '&id_semester=' + $('#id_semester').val() + '&id_mapel=' + $('#id_mapel').val(),
				success:function(data){
					$('#sts').html(data);
				}
			});
   		});

		});
</script>