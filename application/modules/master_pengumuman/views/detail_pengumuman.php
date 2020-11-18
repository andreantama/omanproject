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
				<div class="form-group">
					<label>Waktu Posting</label>
					<p><?= $detail->TGL_POSTING.' - '.$detail->TIME_POSTING ?></p>
				</div>
				<form action="<?= base_url('master_pengumuman/editPengumumanSubmit') ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_pengumuman" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_PENGUMUMAN); ?>" class="form-control"/>
					<div class="form-group">
						<label>Judul Pengumuman</label>
						<input type="text" name="judul_pengumuman" class="form-control" value="<?= $detail->JUDUL_PENGUMUMAN ?>" required/>
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<div>
							<label class="radio-inline"><input type="radio" value="0" name="kategori" <?php echo ($detail->KATEGORI == 0 ? 'checked' : '');?>>Umum</label>
							<label class="radio-inline"><input type="radio" value="1" name="kategori" <?php echo ($detail->KATEGORI == 1 ? 'checked' : '');?>>TKIT</label>
							<label class="radio-inline"><input type="radio" value="2" name="kategori" <?php echo ($detail->KATEGORI == 2 ? 'checked' : '');?>>SMPIT</label>
						</div>
					</div>
					<div class="form-group">
                       <label>Status</label>
                       <select name="sts_publish" class="form-control select2">
                          <option value="1" <?= ($detail->STS_PUBLISH == 1 ? "selected" : ""); ?>>Publish</option>
                          <option value="2" <?= ($detail->STS_PUBLISH == 2 ? "selected" : ""); ?>>Draft</option>
                       </select>
                    </div>
                    <div class="form-group">
	                   <label>Gambar</label><br/>
	                   <?php if($detail->IMAGE != ''): ?>
                       <img src="<?= base_url('assets/images/berita/'.$detail->IMAGE) ?>" width="130" class="img-thumbnail"/>
                       <?php else: ?>
                       <p>-</p>
                       <?php endif; ?>
	                 	<input type="file" class="form-control" name="file_foto"/>
	                 	<p>Kosongi jika tidak ingin mengganti gambar</p>
	                </div>
					<div class="form-group">
						<label>Pengumuman</label>
						<textarea id="editor1" name="pengumuman"><?= $detail->PENGUMUMAN ?></textarea>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_pengumuman') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
  $(function () {
  	$(".select2").select2();
    CKEDITOR.replace('editor1')
  })
</script>