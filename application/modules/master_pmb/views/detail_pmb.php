<div class="row">
	<div class="col-md-12">
	<?php
		if($this->session->flashdata('notif')):
	?>
	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">
		<?= $this->session->flashdata('notif') ?>
	</div>
	<?php endif; ?>
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="<?= base_url('master_pmb/editPmbSubmit') ?>" method="post">
					<input type="hidden" name="id_pmb" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_PMB); ?>"/>
					<div class="form-group">
						<label>Nama Calon Siswa</label>
						<input type="text" class="form-control" value="<?= $detail->NAMA ?>" name="nama"/>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select class="form-control" name="jk">
							<option value="1" <?= ($detail->JK == 1 ? 'selected' : '') ?>>Laki - Laki</option>
							<option value="2" <?= ($detail->JK == 2 ? 'selected' : '') ?>>Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tempat Lahir</label>
						<input type="text" class="form-control" value="<?= $detail->TMPT_LAHIR ?>" name="ttl"/>
					</div>
					<div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="text" class="form-control" value="<?= $detail->TGL_LAHIR ?>" name="tgl_ttl"/>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat"><?= $detail->ALAMAT ?></textarea>
					</div>
					<div class="form-group">
						<label>Nama Ayah</label>
						<input type="text" class="form-control" value="<?= $detail->NAMA_AYAH ?>" name="nama_ayah"/>
					</div>
					<div class="form-group">
						<label>Nama Ibu</label>
						<input type="text" class="form-control" value="<?= $detail->NAMA_IBU ?>" name="nama_ibu"/>
					</div>
					<div class="form-group">
						<label>No Handphone</label>
						<p>
							<?= $detail->NO_HANDPHONE ?>
						</p>
						<p>
							No Handphone tidak bisa diganti.
						</p>
					</div>
					<div class="form-group">
						<label>Waktu pendaftaran</label>
						<p>
							<?= $detail->TGL_PMB.' - '.$detail->WKT_PMB ?>
						</p>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_pmb') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
