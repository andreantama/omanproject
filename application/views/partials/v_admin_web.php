<li <?php echo ($modul_active == 'master_dashboard' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>

<li class="treeview <?php echo ($modul_active == 'master_blog' ? "active" : ""); ?>">
	<a href="#">
		<i class="fa fa-globe text-aqua"></i> <span>Website</span> <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
		<li><a href="<?php echo base_url('master_pengumuman') ?>"><i class="fa fa-newspaper-o"></i> Berita</a></li>
		<li><a href="<?php echo base_url('master_menu') ?>"><i class="fa fa-list"></i> Halaman</a></li>
		<li><a href="<?php echo base_url('master_sekilasinfo') ?>"><i class="fa fa-info-circle"></i> Sekilas Info</a></li>
		<li><a href="<?php echo base_url('master_slider') ?>"><i class="fa fa-image"></i> Slider</a></li>
		<li><a href="<?php echo base_url('master_sistempendik') ?>"><i class="fa fa-star"></i> Sistem Pendidikan</a></li>
		<li><a href="<?php echo base_url('master_gallery') ?>"><i class="fa fa-image"></i> Gallery</a></li>
	</ul>
</li>
<li <?php echo ($modul_active == 'master_detailakun' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_detailakun') ?>"><i class="fa fa-user text-aqua"></i> <span>Detail Akun</span></a></li>
