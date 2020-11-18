<div class="row">
	<div class="col-md-12">
		<?php
		if($this->session->flashdata('notif')):
	?>
	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">
		<?= $this->session->flashdata('notif') ?>
	</div>
	<?php endif; ?>
	<form action="<?= base_url('gurubp_inputabsensi/submitAbsen') ?>" method="post">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<input type="hidden" id="id_semester" name="id_semester" value="<?= $detail_semester->ID_TAHUN_PEL ?>"/>
						<input type="hidden" id="id_kelas" name="id_kelas" value="<?= $id_kelas ?>"/>
						<div class="form-group">
							<label>Semester</label>
							<p><?= $detail_semester->SEMESTER ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Tahun Ajaran</label>
							<p><?= $detail_semester->TAHUN_PEL ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Bulan</label>
							<?php $data_tgl = date('m'); ?>
							<select class="form-control input-sm" id="bulan" name="bulan">
								<option value="00">- Pilih Bulan -</option>
								<option value="01" <?= ($data_tgl == '01' ? "selected" : "") ?>>Januari</option>
								<option value="02" <?= ($data_tgl == '02' ? "selected" : "") ?>>Februari</option>
								<option value="03" <?= ($data_tgl == '03' ? "selected" : "") ?>>Maret</option>
								<option value="04" <?= ($data_tgl == '04' ? "selected" : "") ?>>April</option>
								<option value="05" <?= ($data_tgl == '05' ? "selected" : "") ?>>Mei</option>
								<option value="06" <?= ($data_tgl == '06' ? "selected" : "") ?>>Juni</option>
								<option value="07" <?= ($data_tgl == '07' ? "selected" : "") ?>>Juli</option>
								<option value="08" <?= ($data_tgl == '08' ? "selected" : "") ?>>Agustus</option>
								<option value="09" <?= ($data_tgl == '09' ? "selected" : "") ?>>September</option>
								<option value="10" <?= ($data_tgl == '10' ? "selected" : "") ?>>Oktober</option>
								<option value="11" <?= ($data_tgl == '11' ? "selected" : "") ?>>November</option>
								<option value="12" <?= ($data_tgl == '12' ? "selected" : "") ?>>Desember</option>
							</select>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div id="sts"></div>
		</form>
	</div>
</div>
<script>
	function loadAbsen(){
   			$('#sts').html('Memuat data...');
   			$.ajax({
				method : "POST",
				url : '<?= base_url("walikelas_rekapabsensi/loadAbsen") ?>',
				data : 'id_kelas=' + $('#id_kelas').val() + '&bulan=' + $('#bulan').val(),
				success:function(data){
					$('#sts').html(data);
				}
			});
	}
   $(document).ready(function () {
   		loadAbsen();
   		$('#bulan').change(function(){
   			$('#sts').html('Memuat data...');
   			$.ajax({
				method : "POST",
				url : '<?= base_url("walikelas_rekapabsensi/loadAbsen") ?>',
				data : 'id_kelas=' + $('#id_kelas').val() + '&bulan=' + $('#bulan').val(),
				success:function(data){
					$('#sts').html(data);
				}
			});
   		});
   		

		});
</script>