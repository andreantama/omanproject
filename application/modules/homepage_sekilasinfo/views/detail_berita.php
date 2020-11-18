<div id="content-container">
	<div id="content-bg">
		<div class="container">
			<div class="banner-title">
				<h2>Berita</h2>
			</div>
			<div class="img-mask"></div>
		</div>
		<div class="bg-container">
			<div class="bg">
				<div class="banner-bg"></div>
				<?php $this->load->view($menu_left) ?>
				<div class="container-1">
	
<h2><?= $berita->JUDUL_PENGUMUMAN ?></h2>
<hr>
<h3 class="date"><?= $berita->TGL_POSTING.' '.$berita->TIME_POSTING ?></h3>
<div class="container_list textarea">
			<span class="img-area">
			<span class="img">
								<?php if($berita->IMAGE == NULL): ?>
								<img class="content-image" src="<?php echo base_url('assets/images/none.jpg') ?>" alt="" title="" style="width: 140px; height: 100px; cursor: pointer;">
								<?php else: ?>
								<img class="content-image" src="<?php echo base_url('assets/images/berita/'.$berita->IMAGE) ?>" alt="" title="" style="width: 140px; height: 100px; cursor: pointer;">
								<?php endif; ?>
			</span>
		</span>
		<?= $berita->PENGUMUMAN ?>
		</div>
		</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>