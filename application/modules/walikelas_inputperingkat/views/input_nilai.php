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
							<p><?= $detail->NAMA ?></p>
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
	</div>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="<?= base_url('walikelas_inputperingkat/inputNilaiSubmit') ?>" method="post">
				<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($detail->NO_SISWA); ?>"/>
				<h4>Bintang Mata Pelajaran</h4>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Pelajaran</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->PERINGKAT ?>" name="peringkat"/>
						<input type="hidden" class="form-control" value="<?= @$detail->ID_KELAS ?>" name="id_kelas"/>
					</div>

					
				</div>
				</div>
						<h4>Catatan untuk siswa</h4>
				<div class="row">
					<div class="col-md-6">
					<!--<div class="form-group">
						<label>Predikat</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->PREDIKAT ?>" name="predikat"/>
					</div>-->
					<div class="form-group">
						<label>Catatan</label>
						<textarea class="form-control" name="catatan"><?= @$detail_nilai->CATATAN ?></textarea>
					</div>
					</div>
				</div>
					<input type="submit" class="btn btn-default" value="Terapkan Nilai"/> <a class="btn btn-info" href="<?= base_url('walikelas_inputperingkat') ?>">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>