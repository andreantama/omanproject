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
				<form action="<?= base_url('master_pengumuman/addPengumumanSubmit') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Judul Pengumuman</label>
						<input type="text" name="judul_pengumuman" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<div>
							<label class="radio-inline"><input type="radio" value="0" name="kategori" checked>Umum</label>
							<label class="radio-inline"><input type="radio" value="1" name="kategori">TKIT</label>
							<label class="radio-inline"><input type="radio" value="2" name="kategori">SMPIT</label>
						</div>
					</div>
					<div class="form-group">
	                   <label>Status</label>
	                   <select name="sts_publish" class="form-control select2">
	                      <option value="1">Publish</option>
	                      <option value="2">Draft</option>
	                   </select>
	                </div>
	                <div class="form-group">
	                   <label>Gambar</label>
	                 <input type="file" class="form-control" name="file_foto"/>
	                </div>
					<div class="form-group">
						<label>Pengumuman</label>
						<textarea id="editor1" name="pengumuman"></textarea>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Pengumuman"/>
					<a href="<?= base_url('master_pengumuman') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
  $(function () {
  	$(".select2").select2();
    CKEDITOR.replace('editor1');
  })
</script>