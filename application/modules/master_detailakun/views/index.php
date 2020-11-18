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
				<form action="<?= base_url('master_detailakun/editAkunSubmit') ?>" method="post">
					<input type="hidden" name="id_admin" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_ADMIN); ?>" class="form-control"/>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Username</label>
								<p><?= $detail->USERNAME ?></p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Terakhir Login</label>
								<p><?= $detail->LAST_LOGIN ?></p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>IP Terkahir</label>
								<p><?= $detail->LAST_IP ?></p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" value="<?= $detail->NAME ?>" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control"/>
						<p>Kosongi jika tidak ingin mengganti password</p>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password</label>
						<input type="password" name="con_password" class="form-control"/>
					</div>
					<div class="form-group">
						<label>level</label>
						<p><?= ($detail->LEVEL == 1 ? "Super Admin" : "Admin"); ?></p>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_admin') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>