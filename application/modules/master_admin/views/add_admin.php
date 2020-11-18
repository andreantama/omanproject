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
				<form action="<?= base_url('master_admin/addAdminSubmit') ?>" method="post">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password</label>
						<input type="password" name="con_password" class="form-control" required/>
					</div>
					<div class="form-group">
                       <label>Level</label>
                       <select name="level" class="form-control select2">
                          <option value="2">Admin Master Data</option>
                          <option value="3">Admin PPDB</option>
                          <option value="4">Admin Web</option>
                       </select>
                    </div>
					<input type="submit" class="btn btn-default" value="Tambah Admin"/>
					<a href="<?= base_url('master_admin') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
   $(document).ready(function () {
   		$(".select2").select2();
   });
   
</script>