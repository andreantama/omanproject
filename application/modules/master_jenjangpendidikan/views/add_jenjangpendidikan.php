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
				<form action="<?= base_url('master_jenjangpendidikan/addJenjangPendidikanSubmit') ?>" method="post">
					<div class="form-group">
						<label>Sumber Gaji</label>
						<input type="text" name="jenjangpendidikan" class="form-control" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Sumber Gaji"/>
					<a href="<?= base_url('master_jenjangpendidikan') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>