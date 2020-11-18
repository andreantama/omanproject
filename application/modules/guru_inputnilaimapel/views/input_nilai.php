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
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<h4><i class="fa fa-user"></i> Informasi Siswa</h4>
						<div class="form-group">
							<label>NIPD</label>
							<p><?= $detail->NIPD ?></p>
						</div>
						<div class="form-group">
							<label>Nama Siswa</label>
							<input type="hidden" id="id_siswa" value="<?= $detail->NO_SISWA ?>"/>
							<p><?= $detail->NAMA ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<h4><i class="fa fa-list"></i> Informasi Kelas</h4>
						<div class="form-group">
							<label>Kelas</label>
							<p><?= $detail_kelas->NAMA_KELAS ?></p>
						</div>
						<div class="form-group">
							<label>Mata Pelajaran</label>
							<select class="form-control" id="id_mapel" name="id_mapel">
								<option value="0">- Pilih Mapel -</option>
								<?php
									$get_rel_mapel = $this->guru_inputnilaimapel->tampilData('tbl_rel_kelasajar', '*', array('ID_KELAS' => $id_kelas, 'NO_GURU' => $this->session->userdata('user_access_id')));
									if($get_rel_mapel){
										foreach($get_rel_mapel as $get_rel_mapel){
											$mapel_kelas = json_decode($get_rel_mapel->ID_MAPEL);
											foreach($mapel_kelas as $mapel_list){
												$mapel_all_kelas[] = $mapel_list;
											}
										}	
									}
								?>
								<?php foreach($list_mapel as $list_mapel): ?>
									<?php
										if(in_array($list_mapel->ID_MAPEL, $mapel_all_kelas)):
										$detail_mapel = $this->guru_inputnilaimapel->tampilData('tbl_mapel','*', array('ID_MAPEL' => $list_mapel->ID_MAPEL), TRUE);
									?>
									<option value="<?= $detail_mapel->ID_MAPEL; ?>"><?= $detail_mapel->MAPEL; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<h4><i class="fa fa-check-circle"></i> Status Aktif Semester</h4>
						<div class="form-group">
							<label>Semester</label>
							<p><?= $semester_aktif->SEMESTER ?></p>
						</div>
						<div class="form-group">
							<label>Tahun Ajaran</label>
							<p><?= $semester_aktif->TAHUN_PEL ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="sts"></div>
	</div>
</div>
<script>
	$('#id_mapel').change(function(){
		$('#sts').html('Memuat data...');
		$.ajax({
			method : "POST",
			url : '<?= base_url("guru_inputnilaimapel/filterNilai") ?>',
			data : 'id_mapel=' + $('#id_mapel').val() + '&id_siswa='  +  $('#id_siswa').val(),
			success:function(data){
				$('#sts').html(data);
			}
		});
	});
</script>