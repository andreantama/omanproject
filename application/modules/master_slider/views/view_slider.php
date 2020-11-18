<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
	<div class="panel-body">
	<?php
		if($this->session->flashdata('notif')):
	?>
	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">
		<?= $this->session->flashdata('notif') ?>
	</div>
	<?php endif; ?>
	<a href="<?= base_url('master_slider/addSlider') ?>" class="btn btn-success">Tambah Slider</a>
</div>
	</div>
	<div class="panel panel-default">
	<div class="panel-body">
		<?php if($data_slider): ?>
		<?php foreach($data_slider as $data_slider): ?>
		<div class="media">
		  <div class="media-left">
		    <a href="#">
		      <img class="media-object" src="<?= base_url('assets/images/slider/'.$data_slider->GAMBAR) ?>" width="200px" alt="...">
		    </a>
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading"><?= $data_slider->JUDUL_SLIDER; ?></h4>
		    <p><?= $data_slider->DESKRIPSI_SLIDER; ?></p>
		    <p><a href="<?= base_url('master_slider/detailSlider/'.$this->jariprom_tools->base64_encode_fix($data_slider->ID_SLIDER)) ?>" class="btn btn-info">Detail</a> <a onclick="return confirm('Apakah Anda yakin ?')" href="<?= base_url('master_slider/hapusSlider/'.$this->jariprom_tools->base64_encode_fix($data_slider->ID_SLIDER)) ?>" class="btn btn-danger">Hapus</a></p>
		  </div>
		</div>
		<?php endforeach; ?>
		<?php else: ?>
		Tidak ada data.
		<?php endif; ?>
	</div>
</div>
</div>