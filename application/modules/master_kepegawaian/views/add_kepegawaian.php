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
				<form action="<?= base_url('master_kepegawaian/addKepegawaianSubmit') ?>" method="post">
					<div class="form-group">
						<label>Kepegawaian</label>
						<input type="text" name="kepegawaian" class="form-control" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Kepegawaian"/>
					<a href="<?= base_url('master_kepegawaian') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>