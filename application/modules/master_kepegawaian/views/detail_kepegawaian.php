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
				<form action="<?= base_url('master_kepegawaian/editKepegawaianSubmit') ?>" method="post">
					<input type="hidden" name="id_kepegawaian" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_KEPEGAWAIAN); ?>"/>
					<input type="hidden" name="kepegawaian_form" value="<?= $detail->KEPEGAWAIAN ?>"/>
					<div class="form-group">
						<label>Kepegawaian</label>
						<input type="text" name="kepegawaian" class="form-control" value="<?= $detail->KEPEGAWAIAN ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_kepegawaian') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>