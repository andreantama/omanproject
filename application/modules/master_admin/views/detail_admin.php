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
				<form action="<?= base_url('master_admin/editAdminSubmit') ?>" method="post">
					<input type="hidden" name="id_admin" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_ADMIN); ?>" class="form-control"/>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Username</label>
								<p><?= $detail->USERNAME ?></p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Terakhir Login</label>
								<p><?= $detail->LAST_LOGIN ?></p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>IP Terkahir</label>
								<p><?= $detail->LAST_IP ?></p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" value="<?= $detail->NAME ?>" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control"/>
						<p>Kosongi jika tidak ingin mengganti password</p>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password</label>
						<input type="password" name="con_password" class="form-control"/>
					</div>
					<div class="form-group">
                       <label>Level</label>
                       <select name="level" class="form-control select2">
                           <option value="">- PIIH LEVEL-</option>
                          <option value="2" <?php echo ($detail->LEVEL == 2 ? 'selected="selected"' : '');?>>Admin Master Data</option>
                          <option value="3" <?php echo ($detail->LEVEL == 3 ? 'selected="selected"' : '');?>>Admin PPDB</option>
                          <option value="4" <?php echo ($detail->LEVEL == 4 ? 'selected="selected"' : '');?>>Admin Web</option>
                       </select>
                    </div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
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