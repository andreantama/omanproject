<div class="panel panel-default">
	<div class="panel-body">
		 <?php if($this->session->flashdata('notif')): ?>
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<?php endif; ?>
		<?php if($active->ACTIVE_PMB == 1): ?>
		<form action="<?= base_url('homepage_pmb/daftarPMBSubmit') ?>" method="post">
			<div class="form-group">
				<label>Nama Calon Siswa</label>
				<input type="text" class="form-control" name="nama"/>
			</div>
			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select class="form-control" name="jk">
					<option value="1">Laki - Laki</option>
					<option value="2">Perempuan</option>
				</select>
			</div>
			<div class="form-group">
				<label>Jenjang Pendidikan</label>
				<select name="pendidikan" id="" class="form-control" required>
					<option value="SD">SD</option>
					<option value="SMP">SMP</option>
				</select>
			</div>
			<div class="form-group">
				<label>Tempat Lahir</label>
				<input type="text" class="form-control" name="ttl"/>
			</div>
			<div class="form-group">
				<label>Tanggal Lahir</label>
				<input type="text" class="form-control" name="tgl_ttl"/>
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat"></textarea>
			</div>
			<div class="form-group">
				<label>Nama Ayah</label>
				<input type="text" class="form-control" name="nama_ayah"/>
			</div>
			<div class="form-group">
				<label>Nama Ibu</label>
				<input type="text" class="form-control" name="nama_ibu"/>
			</div>
			<div class="form-group">
				<label>No Handphone</label>
				<input type="text" class="form-control" name="no_hp"/>
				<p>Nomer ini dapat digunakan untuk mengecek pendaftaran</p>
			</div>
			<input type="submit" class="btn btn-default" value="Daftar"/> <a href="<?= base_url('homepage_pmb') ?>" class="btn btn-info">Kembali</a>
		</form>
		<?php else: ?>
		<div class="form-group">
				Jalur PPDB sudah ditutup.
		</div>
		<a href="<?php echo base_url('homepage_pmb') ?>" class="btn btn-info">Kembali</a>
		<?php endif; ?>
	</div>
</div>