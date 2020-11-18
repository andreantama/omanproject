<div id="content-container">
	<div id="content-bg">
		<div class="container">
			<div class="banner-title">
				<h2>Sekilas Info</h2>
			</div>
			<div class="img-mask"></div>
		</div>
		<div class="bg-container">
			<div class="bg">
				<div class="banner-bg"></div>
				<?php $this->load->view($menu_left) ?>
				<div class="container-1">
					
					<h2>Sekilas Info</h2>
<div class="container_list" id="paging_container1">
	<ul id="news" class="content">
	<?php
		foreach($sekilas_info as $sekilas_info):
	?>
			<li class="news-item">
				<h6 class="date"><?= $sekilas_info->TGL_POSTING.' '.$sekilas_info->TIME_POSTING ?></h6>
				<div class="textarea">
						<?= $sekilas_info->SEKILAS_INFO; ?>
				</div>
			</li>
		<?php endforeach; ?>
		<ul class="pagination-area">
		<ul class="pagination">
		<?= $paging_list ?>
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