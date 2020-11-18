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
				<form action="<?= base_url('master_sistempendik/editSistemPendikSubmit') ?>" method="post">
					<input type="hidden" name="id_sistempendik" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_SISTEM_PENDIDIKAN); ?>"/>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" value="<?= $detail->NAMA ?>" name="nama" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Font</label>
						<input type="text" name="font" value="<?= $detail->FONT ?>" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="form-control" name="deskripsi" required><?= $detail->DESKRIPSI ?></textarea>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_sistempendik') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>