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
				<form action="<?= base_url('master_sekilasinfo/editSekilasInfoSubmit') ?>" method="post">
				<input type="hidden" name="id_sekilasinfo" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_SEKILAS_INFO); ?>" class="form-control"/>
					<div class="form-group">
						<label>Waktu</label>
						<p><?= $detail->TGL_POSTING.' - '.$detail->TIME_POSTING ?></p>
					</div>
					<div class="form-group">
						<label>Sekilas Info</label>
						<textarea name="sekilasinfo" class="form-control" required><?= $detail->SEKILAS_INFO ?></textarea>
						<p>Maksimal 250 Karakter.</p>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_sekilasinfo') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>