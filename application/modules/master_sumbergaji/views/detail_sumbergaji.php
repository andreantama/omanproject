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
				<form action="<?= base_url('master_sumbergaji/editSumberGajiSubmit') ?>" method="post">
					<input type="hidden" name="id_sumbergaji" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_SUMBER_GAJI); ?>"/>
					<input type="hidden" name="sumbergaji_form" value="<?= $detail->SUMBER_GAJI ?>"/>
					<div class="form-group">
						<label>Sumber Gaji</label>
						<input type="text" name="sumbergaji" class="form-control" value="<?= $detail->SUMBER_GAJI ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_sumbergaji') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>