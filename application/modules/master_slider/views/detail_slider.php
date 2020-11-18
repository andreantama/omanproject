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
				<form action="<?= base_url('master_slider/editSliderSubmit') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_slider" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_SLIDER); ?>"/>
					<div class="form-group">
						<label>Judul Slider</label>
						<input type="text" name="judul_slider" class="form-control" value="<?= $detail->JUDUL_SLIDER ?>" required/>
					</div>
					<div class="form-group">
						<label>Deskripsi Slider</label>
						<textarea name="deskripsi_slider" class="form-control" required><?= $detail->DESKRIPSI_SLIDER ?></textarea>
					</div>
					<div class="form-group">
						<label>Foto Slider</label>
						<input type="file" name="file_foto" class="form-control"/>
					</div>
					<p class="text-muted">kosongi jika tidak ingin mengganti slider.</p>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_slider') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>