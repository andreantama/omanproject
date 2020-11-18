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
				<form action="<?= base_url('master_jenjangpendidikan/editJenjangPendidikanSubmit') ?>" method="post">
					<input type="hidden" name="id_jenjangpendidikan" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_JENJANG_PENDIDIKAN); ?>"/>
					<input type="hidden" name="jenjangpendidikan_form" value="<?= $detail->JENJANG_PENDIDIKAN ?>"/>
					<div class="form-group">
						<label>Jenjang Pendidikan</label>
						<input type="text" name="jenjangpendidikan" class="form-control" value="<?= $detail->JENJANG_PENDIDIKAN ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_jenjangpendidikan') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>