<div class="panel panel-default">
	<div class="panel-body">
		 <?php if($this->session->flashdata('notif')): ?>
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<?php endif; ?>
		<p>
			Silahkan ikuti intruksi dibawah ini :
		</p>
		<ol>
			<li>
				Download formulir registrasi terlebih dahulu, <a href="<?= base_url('homepage_pmb/downloadPdfInstruction') ?>">Klik Disini</a>.
			</li>
			<li>
				Setelah download formulir, silahkan cetak formulir registrasi.
			</li>
			<li>
				Selanjutnya isi sesuai dengan intruksi yang ada di formulir.
			</li>
			<li>
				Jika formulir sudah diisi, foto / scan formulir, lalu jadikan satu folder untuk diarsipkan. Bisa menggunakan winrar/winzip
			</li>
			<li>
				Jika Anda tidak punya alat scanner bisa download aplikasi <a href="https://play.google.com/store/apps/details?id=pdf.tap.scanner">berikut ini di playstore</a>, sebagai pengganti alat scanner.
			</li>
			<li>
				Setelah diarsipkan, silahkan Anda isi form berikut ini.
			</li>
		</ol>
		<form action="<?= base_url('homepage_pmb/daftarPmbUlangSubmit') ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama"/>
			</div>
			<div class="form-group">
				<label>No Handphone</label>
				<input type="text" class="form-control" name="no_hp"/>
			</div>
			<div class="form-group">
			   <label>Upload Dokumen Formulir</label><br/>
			   <input type="file" name="dokumen" class="form-control"/>
			   <p>File yang diperbolehkan rar, zip, dan pdf.</p>
			</div>
			<input type="submit" class="btn btn-default" value="Daftar"/> <a href="<?= base_url('homepage_pmb') ?>" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div>
