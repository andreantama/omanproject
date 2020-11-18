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
				<form action="<?= base_url('master_kelas/addKelasSubmit') ?>" method="post">
					<div class="form-group">
						<label>Nama Kelas</label>
						<input type="text" name="nama_kelas" class="form-control" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Kelas"/>
					<a href="<?= base_url('master_kelas') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>