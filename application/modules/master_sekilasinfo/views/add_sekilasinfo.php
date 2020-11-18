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
				<form action="<?= base_url('master_sekilasinfo/addSekilasInfoSubmit') ?>" method="post">
					<div class="form-group">
						<label>Sekilas Info</label>
						<textarea name="sekilasinfo" class="form-control" required></textarea>
						<p>Maksimal 250 Karakter.</p>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Sekilas Info"/>
					<a href="<?= base_url('master_sekilasinfo') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>