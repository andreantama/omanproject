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
				<form action="<?= base_url('master_siswa/resetPasswordSiswaSubmit') ?>" method="post">
				<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($detail->NO_SISWA); ?>" class="form-control"/>
					<div class="form-group">
						<label>NIPD</label>
						<p><?= $detail->NIPD ?></p>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<p><?= $detail->NAMA ?></p>
					</div>
					<div class="form-group">
						<label>Password Baru</label>
						<input type="password" name="password" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password Baru</label>
						<input type="password" name="con_password" class="form-control" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Reset Password"/>
					<a href="<?= base_url('master_siswa') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>