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
				<form action="<?= base_url('walikelas_inputnilaipembi/inputNilaiSubmit') ?>" method="post">
				<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($detail->NO_SISWA); ?>"/>
				<h4>Nilai Pembiasaan</h4>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Wudhu</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->WUDHU ?>" name="wudhu"/>
					</div>
					<div class="form-group">
						<label>Sholat</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->SHOLAT ?>" name="sholat"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Surat Pendek</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->SURAT_PENDEK ?>" name="surat_pendek"/>
					</div>
					<div class="form-group">
						<label>Tahsin</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->TAHSIN ?>" name="tahsin"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Hadist</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->HADITS ?>" name="hadist"/>
					</div>
					<div class="form-group">
						<label>Doa</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->DOA ?>" name="doa"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tahfidz 1</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->TAHFIDZH ?>" name="tahfidz"/>
					</div>
					<div class="form-group">
						<label>Nama Surah 1</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->NAMA_SURAH ?>" name="nama_surah"/>
					</div>
					<div class="form-group">
						<label>Tahfidz 2</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->TAHFIDZH_2 ?>" name="tahfidz_2"/>
					</div>
					<div class="form-group">
						<label>Nama Surah 2</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->NAMA_SURAH_2 ?>" name="nama_surah_2"/>
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
					<input type="submit" class="btn btn-default" value="Terapkan Nilai"/> <a class="btn btn-info" href="<?= base_url('walikelas_inputnilaipembi') ?>">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>