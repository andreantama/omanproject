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
				<form action="<?= base_url('guru_gantipassword/editAkunSubmit') ?>" method="post">
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password</label>
						<input type="password" name="con_password" class="form-control" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
				</form>
			</div>
		</div>
	</div>
</div>