<?php
$detail = $this->db->query('SELECT * FROM tbl_info_sekolah')->row();
?>
<div id="content-container">
	<div id="content-bg" class="front-page">
	
		<div class="area"> <!--Banner Slider-->
<div class="bannerleft-bg">
	<div class="container" id="banner-left">
			<?php
				$a = 1;
				$slider = $this->db->query('SELECT * FROM tbl_slider')->result();
				foreach($slider as $slider):
			?>
			<div class="bannerleft">
				<img src="<?= base_url('assets/images/slider/'.$slider->GAMBAR) ?>" width="472px" height="299px" />
			</div>
			<?php $a++;endforeach; ?>
	</div>
</div>
	
<div class="banner-right">
	<div id="banner-right">
			<?php
				$slider_des = $this->db->query('SELECT * FROM tbl_slider')->result();
				foreach($slider_des as $slider_des):
			?>
			<div class="banner-right-bg">
				<div class="bannerright">
					<div class="container">
						<h1 class="banner-title"><?= $slider_des->JUDUL_SLIDER ?></h1>
						<h3 class="banner-desc"><?= $slider_des->DESKRIPSI_SLIDER; ?></h3>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
			</div>
</div>

<div id="nav-slider">
	<span class="nav-left">
		<a class="nav" rel="prev" href="javascript:void(0);"></a>
	</span>
		<?php
			$a = $a - 1;
			for($b = 1; $b <= $a;$b++):
		?>
		<span class="button">
			<a class="nav" rel="<?= $b ?>" href="javascript:void(0);"></a>
		</span>
		<?php endfor; ?>
			<span class="nav-right">
		<a class="nav" rel="next" href="javascript:void(0);"></a>
	</span>
</div>			
		</div> <!-- Akhir Banner Slider -->
		<div class="left"></div>
		<div class="right"></div>
		
	</div>
	<div id="content-bottom">
		<div class="bottom1">
			<h3>Berita Terbaru</h3>
			<div class="latestnews-slides" style="height: 130px;">
				<ul class="slides">
				<?php
					$berita = $this->db->query('SELECT * FROM tbl_pengumuman WHERE STS_PUBLISH=1 ORDER BY RAND() LIMIT 5')->result();
					foreach($berita as $berita):
				?>
					<li class="btn1-container">
							<?php if($berita->IMAGE == NULL): ?>
							<img src="<?php echo base_url('assets/images/none.jpg') ?>" style="width: 50px;height:50px;"/>
							<?php else: ?>
							<img src="<?php echo base_url('assets/images/berita/'.$berita->IMAGE) ?>" style="width: 50px;height:50px;"/>
							<?php endif; ?>
						<div class="btn-desc">
							<a class="latestnews-title"  href="<?= base_url('homepage_berita/detailBerita/'.$berita->ID_PENGUMUMAN) ?>" ><?= $berita->JUDUL_PENGUMUMAN ?></a>
							<p><?php echo character_limiter(strip_tags($berita->PENGUMUMAN), 250); ?></p>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>	
			<div style="margin-left: 22px;">
				<a href="<?php echo base_url('homepage_berita');?>" title="INFORMASI TERKAIT DARI TKIT" class="btn-selengkapnya">READ MORE</a>			
			</div>
		</div>	

		<div class="bottom2">
			<h3>Info Terkini Dari TKIT</h3>
			<div class="btn2-container">
				<a href="<?php echo base_url('homepage_tkit');?>" title="INFORMASI TERKAIT DARI TKIT">
					<img src="<?php echo base_url('assets/images/banner/'.$detail->FOTO_TKIT) ?>" width="232px" height="120px" border="1px solid #fff" border-radius="8px" />
				</a>
				<a href="<?php echo base_url('homepage_tkit');?>" title="INFORMASI TERKAIT DARI TKIT" class="btn-selengkapnya">READ MORE</a>

			</div>
		</div>

		<div class="bottom3">
			<h3>Info Terkini Dari SMPIT</h3>
			<div class="btn3-container">
				<a href="<?php echo base_url('homepage_smpit');?>" title="INFORMASI TERKAIT DARI TKIT">
					<img src="<?php echo base_url('assets/images/banner/'.$detail->FOTO_SMPIT) ?>" width="232px" height="120px" border="1px solid #fff" border-radius="8px" />
				</a>
				<a href="<?php echo base_url('homepage_smpit');?>" title="INFORMASI TERKAIT DARI TKIT" class="btn-selengkapnya">READ MORE</a>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.btn-selengkapnya{
		margin: 15px 0;
    	font-size: 16px;
    	display: inline-block;
    	padding: 8px 12px;
	    text-align: center;
	    cursor: pointer;
	    border: 2px solid;
	    background: none;
	    color: #FFFFFF;
	    border-color: #FFFFFF;
	    background: #2274b2;
	    font-weight: 600;
	} 
	.btn-selengkapnya:hover{
		background: #FFFFFF;
		color: #2274b2;
	}
</style>