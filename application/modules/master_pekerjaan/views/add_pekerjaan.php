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
				<form action="<?= base_url('master_pekerjaan/addPekerjaanSubmit') ?>" method="post">
					<div class="form-group">
						<label>Pekerjaan</label>
						<input type="text" name="pekerjaan" class="form-control" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Pekerjaan"/>
					<a href="<?= base_url('master_pekerjaan') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>