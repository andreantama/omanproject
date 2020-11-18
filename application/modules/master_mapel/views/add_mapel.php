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
				<form action="<?= base_url('master_mapel/addMapelSubmit') ?>" method="post">
					<div class="form-group">
						<label>Mata Pelajaran</label>
						<input type="text" name="nama_mapel" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>KKM</label>
						<input type="text" name="nama_mapel" class="form-control" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Mata Pelajaran"/>
					<a href="<?= base_url('master_mapel') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>