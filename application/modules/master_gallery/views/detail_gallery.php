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
				<form action="<?= base_url('master_gallery/editGallerySubmit') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_gallery" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_GALLERY); ?>"/>
					<div class="form-group">
						<label>Judul Gallery</label>
						<input type="text" name="judul_gallery" class="form-control" value="<?= $detail->NAMA_GALLERY ?>" required/>
					</div>
					<div class="form-group">
						<label>Foto Gallery</label>
						<input type="file" name="file_foto" class="form-control"/>
					</div>
					<p class="text-muted">kosongi jika tidak ingin mengganti gallery.</p>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_gallery') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>