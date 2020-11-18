<div id="content-container">
	<div id="content-bg">
		<div class="container">
			<div class="banner-title">
				<h2><?= $detail_page->NAMA_MENU ?></h2>
			</div>
			<div class="img-mask"></div>
		</div>
		<div class="bg-container">
			<div class="bg">
				<div class="banner-bg"></div>
				<?php $this->load->view($menu_left) ?>
				<div class="container-1">
					
					<!-- Component Article -->
	
	
	
	
		
	
	<h2><?= $detail_page->NAMA_MENU ?></h2>
	<hr />
	<div class="container_list textarea">
	<?= $detail_page->ISI_MENU ?>
	</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>