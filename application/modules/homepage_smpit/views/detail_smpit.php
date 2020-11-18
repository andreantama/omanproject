
<div id="content-container">
	<div id="content-bg">
		<div class="container">
			<div class="banner-title">
				<h2>SMPIT</h2>
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

						<div class="social-media" style="margin-top:40px;">
							<?php
							$url 	= base_url(uri_string());
							$title 	= $berita->JUDUL_PENGUMUMAN;
							$detail = $this->db->query('SELECT * FROM tbl_info_sekolah')->row();
							$twitter= $detail->TWITTER;
							?>

							<a target="_blank" href="//www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>" class="dsb-btn dsb-facebook-bg dsb-white"><i class="fa fa-facebook"></i> Share</a>

							<a target="_blank" href="//twitter.com/intent/tweet/?text=<?php echo $title;?>&amp;url=<?php echo $url;?>&amp;via=<?php echo $title;?>" class="dsb-btn dsb-twitter-bg dsb-white"><i class="fa fa-twitter"></i> Tweet</a>

							<a target="_blank" href="//plus.google.com/share?url=<?php echo $url;?>" class="dsb-btn dsb-googleplus-bg dsb-white"><i class="fa fa-google-plus"></i> Share</a>

							<a target="_blank" href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;//assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="dsb-btn dsb-pinterest-bg dsb-white"><i class="fa fa-pinterest-p"></i> Pin It</a>

							<a target="_blank" href="//www.linkedin.com/shareArticle?url=<?php echo $url;?>&amp;title=<?php echo $title;?>&amp;summary=<?php echo $title;?>" class="dsb-btn dsb-linkedin-bg dsb-white"><i class="fa fa-linkedin"></i> Share</a>
						</div>

					</div>
				</div>

				

				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
