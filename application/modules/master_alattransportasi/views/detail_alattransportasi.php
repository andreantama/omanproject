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
				<form action="<?= base_url('master_alattransportasi/editAlatTransportasiSubmit') ?>" method="post">
					<input type="hidden" name="id_alattransportasi" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_ALAT_TRANSPORTASI); ?>"/>
					<input type="hidden" name="alattransportasi_form" value="<?= $detail->ALAT_TRANSPORTASI ?>"/>
					<div class="form-group">
						<label>Alat Transportasi</label>
						<input type="text" name="alattransportasi" class="form-control" value="<?= $detail->ALAT_TRANSPORTASI ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_alattransportasi') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>