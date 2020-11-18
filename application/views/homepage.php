<?php
$detail = $this->db->query('SELECT * FROM tbl_info_sekolah')->row();
?>
<!DOCTYPE HTML>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link href="<?= base_url('assets-admin/img/logo/'.$detail->LOGO) ?>" rel="shortcut icon" type="image/x-icon">

		<title><?= $detail->NAMA_SEKOLAH ?></title>
		<meta name="robots" content="index, follow" />
		<meta name="language" content="id" />

		<!-- CSS INCLUDES -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>frontpage/includes/css/reset.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>frontpage/includes/fonts/fonts.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>frontpage/includes/css/style.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>frontpage/includes/css/textarea.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>frontpage/includes/css/imagepopup.css" />

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo base_url();?>frontpage/includes/css/direct-share-buttons.css">

		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/jquery.easing.compatibility.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/easySlider1.7.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/jquery.zaccordion.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/script.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/imagepopup.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/jquery.blueberry.js"></script>


	</head>
	<body id="template-home" class="">
		<div id="top-wrap">

			<div id="bg-repeat" class="bg-repeat-home">
				<div id="bg"></div>
				<div id="bg-shadow"></div>
			</div>

			<div id="wrapper">

							<div id="header">



<span class="logo">
		<a href="" title=""><img src='<?= base_url('assets-admin/img/logo/'.$detail->LOGO_HOMEPAGE) ?>' width="300px" /></a>
	</span>
				<div class="social-icon">
					<div class="title"></div>



	<div class="socmed-icon">
		<a href="<?= $detail->FACEBOOK ?>" title="" target="_blank">
		<img alt="" class="providerButton-img" src="<?php echo base_url() ?>frontpage/assets/fb-icon.png" width="28" height="29" /></a>
	</div>
	<div class="socmed-icon">
		<a href="<?= $detail->TWITTER ?>" title="" target="_blank">
		<img alt="" class="providerButton-img" src="<?php echo base_url() ?>frontpage/assets/twitt-icon.png" width="28" height="29" /></a>
	</div>
				</div>

				<div class="clear"></div>
				<div class="menu">
					<div class="bg-left"></div>
					<div class="bg-center"></div>
					<div class="bg-right"></div>

					<div class="main-menu">
	<ul>
								<li>
				<a href="<?php echo base_url(); ?>" title="Home">Beranda</a>
			</li>
			<?php $sql = $this->db->query('SELECT * FROM tbl_menu WHERE ID_PARENT = 0')->result(); ?>
                    	<?php foreach($sql as $data): ?>
                    	<?php if(!in_array($data->ID_MENUWEB, array(8,9))): ?>
                        <li><a href="<?= base_url('homepage_halaman/detail/'.$data->ID_MENUWEB) ?>"><?= $data->NAMA_MENU ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <li><a href="<?= base_url('homepage_gallery') ?>">GALLERY</a></li>
						<li><a href="<?= base_url('homepage_berita') ?>">BERITA</a></li>
                        <li><a href="<?= base_url('homepage_pmb/daftarUlang') ?>">E-REGISTRASI</a></li>
			</ul>
</div>
					<div class="clear"></div>
				</div>
			</div>
<?= $this->load->view($page); ?>
			</div>
		</div> <!-- #top-wrap -->

		<div id="middle">

<div class='news-container'>

<div class="bg-news News Ticker">
	<div class="bg-left news"></div>
	<div class="bg-center news"></div>
	<div class="bg-right news"></div>
	<h2>Sekilas Info</h2>
	<span>
		<p>
			<marquee direction="left" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();" >
			<?php
				$data_sekil = array();
				$sekil = $this->db->query('SELECT * FROM tbl_sekilas_info ORDER BY ID_SEKILAS_INFO DESC LIMIT 5')->result();
				foreach($sekil as $sekil){
					$data_sekil[] = '['.$sekil->TGL_POSTING.' - '.$sekil->TIME_POSTING.'] '.$sekil->SEKILAS_INFO;
				}
				echo implode(' ',$data_sekil);
			?>
			</marquee>
		</p>
	</span>
</div>	</div>
	<div class="container-icon">
		<div class="nav-menu-left">
			<a href="#"></a>
		</div>



	<div class="link-middle">
		<div class="icon">
			<img src="<?php echo base_url('assets/images/004-graduates.png') ?>" />
		</div>
		<div class="container">
			<h3 id="ewarta-title">Prestasi Sekolah</h3>
			<h4 id="desc"><?php echo ucwords(strtolower($detail->NAMA_SEKOLAH)) ?></h4>
			<span class="readmore">
				<a href="http://mutiaracendekia.sch.id/homepage_halaman/detail/8"></a>
			</span>
		</div>
	</div>
	<div class="link-middle">
		<div class="icon">
			<img src="<?php echo base_url('assets/images/002-clipboard.png') ?>" />
		</div>
		<div class="container">
			<h3 id="ewarta-title">PPDB Online</h3>
			<h4 id="desc"><?= ucwords(strtolower($detail->NAMA_SEKOLAH)) ?></h4>
			<span class="readmore">
				<a href="<?= base_url('homepage_pmb') ?>"></a>
			</span>
		</div>
	</div>
	<div class="link-middle">
		<div class="icon">
			<img src="<?php echo base_url('assets/images/003-login.png') ?>" />
		</div>
		<div class="container">
			<h3 id="ewarta-title">Login Siswa</h3>
			<h4 id="desc">Login Siswa</h4>
			<span class="readmore">
				<a href="<?= base_url('homepage_loginsiswa') ?>"></a>
			</span>
		</div>
	</div>
	<div class="link-middle">
		<div class="icon">
			<img src="<?php echo base_url('assets/images/exam2.png') ?>" />
		</div>
		<div class="container">
			<h3 id="ewarta-title">Ujian Online</h3>
			<h4 id="desc"><?= ucwords(strtolower($detail->NAMA_SEKOLAH)) ?></h4>
			<span class="readmore">
				<a href="http://ujian.mutiaracendekia.sch.id/"></a>
			</span>
		</div>
	</div>

		<div class="nav-menu-right">
			<a href="#"></a>
		</div>
	</div>
</div>
		<div id="footer">
	<div class="container-foot">
		<p>&copy;&nbsp;<?php echo date('Y') ?> <?= $detail->NAMA_SEKOLAH ?>.  All rights reserved.</p>
	</div>
</div>
	</body>
		<script type="text/javascript" src="<?php echo base_url() ?>frontpage/includes/js/script_home.js"></script>
</html>
