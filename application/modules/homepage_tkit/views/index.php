<div id="content-container">
	<div id="content-bg">
		<div class="container">
			<div class="banner-title">
				<h2>TKIT</h2>
			</div>
			<div class="img-mask"></div>
		</div>
		<div class="bg-container">
			<div class="bg">
				<div class="banner-bg"></div>
				<?php $this->load->view($menu_left) ?>
				<div class="container-1">
					
					<h2>Informasi Terkini Dari TKIT</h2>
<div class="container_list" id="paging_container1">
	<ul id="news" class="content">
	<?php
	if($berita) {
		foreach($berita as $berita):
	?>
			<li class="news-item">
				<h1 class="title"><a href="<?= base_url('homepage_tkit/detail/'.$berita->ID_PENGUMUMAN) ?>"><?= $berita->JUDUL_PENGUMUMAN ?></a></h1>
				<h6 class="date"><?= $berita->TGL_POSTING.' '.$berita->TIME_POSTING ?></h6>
				<div class="textarea">
											<span class="img-area">
							<span class="img">
								<?php if($berita->IMAGE == NULL): ?>
								<img class="content-image" src="<?php echo base_url('assets/images/none.jpg') ?>" alt="" title="" style="width: 140px; height: 100px; cursor: pointer;">
								<?php else: ?>
								<img class="content-image" src="<?php echo base_url('assets/images/berita/'.$berita->IMAGE) ?>" alt="" title="" style="width: 140px; height: 100px; cursor: pointer;">
								<?php endif; ?>
								</span>
						</span>
						<?= substr(strip_tags($berita->PENGUMUMAN),0,500).' ...'; ?>
						<a class="content-readmore" href="<?= base_url('homepage_tkit/detail/'.$berita->ID_PENGUMUMAN) ?>">
								Read more...			
					</a>
				</div>
			</li>
		<?php endforeach; 
	} else {
		echo 'Konten Belum Tersedia';
	}?>
		<ul class="pagination-area">
			<ul class="pagination">
			<?php echo $paging_list ?>
			</ul>
		</ul>
	</ul>
	<!-- PAGINATION -->
	
</div>				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>