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
				<form action="<?= base_url('master_pekerjaan/editPekerjaanSubmit') ?>" method="post">
					<input type="hidden" name="id_pekerjaan" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_PEKERJAAN); ?>"/>
					<input type="hidden" name="pekerjaan_form" value="<?= $detail->PEKERJAAN ?>"/>
					<div class="form-group">
						<label>Pekerjaan</label>
						<input type="text" name="pekerjaan" class="form-control" value="<?= $detail->PEKERJAAN ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_pekerjaan') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>