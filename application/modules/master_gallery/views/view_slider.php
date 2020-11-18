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
	<a href="<?= base_url('master_gallery/addGallery') ?>" class="btn btn-success">Tambah Gallery</a>
</div>
	</div>
	<div class="panel panel-default">
	<div class="panel-body">
		<?php if($data_gallery): ?>
		<?php foreach($data_gallery as $data_gallery): ?>
		<div class="media">
		  <div class="media-left">
		    <a href="#">
		      <img class="media-object" src="<?= base_url('assets/images/gallery/'.$data_gallery->GAMBAR) ?>" width="200px" alt="...">
		    </a>
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading"><?= $data_gallery->NAMA_GALLERY; ?></h4>
		    <p><a href="<?= base_url('master_gallery/detailGallery/'.$this->jariprom_tools->base64_encode_fix($data_gallery->ID_GALLERY)) ?>" class="btn btn-info">Detail</a> <a onclick="return confirm('Apakah Anda yakin ?')" href="<?= base_url('master_gallery/hapusSlider/'.$this->jariprom_tools->base64_encode_fix($data_gallery->ID_GALLERY)) ?>" class="btn btn-danger">Hapus</a></p>
		  </div>
		</div>
		<?php endforeach; ?>
		<?php else: ?>
		Tidak ada data.
		<?php endif; ?>
	</div>
</div>
</div>