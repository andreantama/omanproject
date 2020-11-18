<div class="container_1">
	<div class="bg-usaha">
		<div class="list2-left"></div>
		<h2>Gallery</h2>
		<div class="list2-right"></div>
		<div class="container">
		<div class="clear"></div>
		<div class="textarea">
		<?php
			foreach($gallery as $gallery):
		?>
			<span class="img-area">
				<span class="img">
					<img class="content-image" src="<?php echo base_url('assets/images/gallery/'.$gallery->GAMBAR) ?>" alt="" title="" style="width: 140px; height: 100px; cursor: pointer;">
				</span>
			</span>
		<?php endforeach; ?>
		</div>
		<div class="clear"></div>
		<div>
			<ul class="pagination-area">
		<ul class="pagination">
		<?= $paging_list ?>
		</ul>
		</ul>
		</div>
		
		</div>
	</div>
</div>