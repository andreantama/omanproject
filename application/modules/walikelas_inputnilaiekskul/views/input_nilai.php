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
				<form action="<?= base_url('walikelas_inputnilaiekskul/inputNilaiSubmit') ?>" method="post">
				<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($detail->NO_SISWA); ?>"/>
				<h4>Nilai Ekskul</h4>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Pramuka</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->PRAMUKA ?>" name="pramuka"/>
					</div>
					<div class="form-group">
						<label>Hadroh</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->TAHFIDZH ?>" name="tahfidzh"/>
					</div>
					<div class="form-group">
						<label>Badminton</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->BADMINTON ?>" name="badminton"/>
					</div>
					<div class="form-group">
						<label>Futsal</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->FUTSAL ?>" name="futsal"/>
					</div>
					<div class="form-group">
						<label>Karate</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->SILAT ?>" name="silat"/>
					</div>
					<div class="form-group">
						<label>Seni Lukis</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->LUKIS_KALIGRAFI ?>" name="lukis_kaligrafi"/>
					</div>
					<div class="form-group">
						<label>Marching Band</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->MARCHING_BAND ?>" name="marching_band"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>English Club</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->ENGLISH_CLUB ?>" name="english_club"/>
					</div>
					<div class="form-group">
						<label>Science Club</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->SCIENCE ?>" name="science"/>
					</div>
					<div class="form-group">
						<label>Archery Club</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->ARCHERY_CLUB ?>" name="archery_club"/>
					</div>
					<div class="form-group">
						<label>Arabic Club</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->ARABIC_CLUB ?>" name="arabic_club"/>
					</div>
					<div class="form-group">
						<label>Theater Club</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->THEATER_CLUB ?>" name="theater_club"/>
					</div>
					<div class="form-group">
						<label>Tari Kreasi</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->TARI_KREASI ?>" name="tari_kreasi"/>
					</div>
				</div>
				</div>
				<h4>Nilai Akhlak</h4>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label>Kedisiplinan</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->KEDISIPLINAN ?>" name="kedisiplinan"/>
					</div>
					<div class="form-group">
						<label>Kebersihan</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->KEBERSIHAN ?>" name="kebersihan"/>
					</div>
					<div class="form-group">
						<label>Kerapian</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->KERAPIAN ?>" name="kerapian"/>
					</div>
					<div class="form-group">
						<label>Tanggung Jawab</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->TANGGUNG_JAWAB ?>" name="tanggung_jawab"/>
					</div>
					<div class="form-group">
						<label>Sopan santun</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->SOPAN_SANTUN ?>" name="sopan_santun"/>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label>Kompetitif</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->KOMPETITIF ?>" name="kompetitif"/>
					</div>
					<div class="form-group">
						<label>Hubungan Sosial</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->HUBUNGAN_SOSIAL ?>" name="hubungan_sosial"/>
					</div>
					<div class="form-group">
						<label>Kejujuran</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->KEJUJURAN ?>" name="kejujuran"/>
					</div>
					<div class="form-group">
						<label>Kemandirian</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->KEMANDIRIAN ?>" name="kemandirian"/>
					</div>
					<div class="form-group">
						<label>Pelaksanaan Ibadah Ritual</label>
						<input type="text" class="form-control" value="<?= @$detail_nilai->PELAKSANAAN_IBADAH_RITUAL ?>" name="pelaksaan_ibadah_ritual"/>
					</div>
					</div>
				</div>
				<h4>Nilai Akhlak</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Catatan 1</label>
							<input type="text" class="form-control" value="<?= @$detail_nilai->CATATAN_1 ?>" name="catatan_1"/>
						</div>
						<div class="form-group">
							<label>Catatan 2</label>
							<input type="text" class="form-control" value="<?= @$detail_nilai->CATATAN_2 ?>" name="catatan_2"/>
						</div>
						<div class="form-group">
							<label>Catatan 3</label>
							<input type="text" class="form-control" value="<?= @$detail_nilai->CATATAN_3 ?>" name="catatan_3"/>
						</div>
						<div class="form-group">
							<label>Catatan 4</label>
							<input type="text" class="form-control" value="<?= @$detail_nilai->CATATAN_4 ?>" name="catatan_4"/>
						</div>
					</div>
				</div>
					<input type="submit" class="btn btn-default" value="Terapkan Nilai"/> <a class="btn btn-info" href="<?= base_url('walikelas_inputnilaiekskul') ?>">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
