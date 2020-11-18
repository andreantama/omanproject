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
				<form action="<?= base_url('master_jenisptk/editJenisPtkSubmit') ?>" method="post">
					<input type="hidden" name="id_jenisptk" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_JNS_PTK); ?>"/>
					<input type="hidden" name="jenisptk_form" value="<?= $detail->JNS_PTK ?>"/>
					<div class="form-group">
						<label>Jenis PTK</label>
						<input type="text" name="jenisptk" class="form-control" value="<?= $detail->JNS_PTK ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_jenisptk') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>