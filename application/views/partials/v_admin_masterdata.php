<li <?php echo ($modul_active == 'master_dashboard' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
<li class="treeview <?php echo ($modul_active == 'master_data' ? "active" : ""); ?>">
	<a href="#">
		<i class="fa fa-archive text-aqua"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
		<li><a href="<?php echo base_url('master_pekerjaan') ?>"><i class="fa fa-archive"></i> Pekerjaan</a></li>
		<li><a href="<?php echo base_url('master_mapel') ?>"><i class="fa fa-archive"></i> Mata Pelajaran</a></li>
		<li><a href="<?php echo base_url('master_kepegawaian') ?>"><i class="fa fa-archive"></i> Kepegawaian</a></li>
		<li><a href="<?php echo base_url('master_sumbergaji') ?>"><i class="fa fa-archive"></i> Sumber Gaji</a></li>
		<li><a href="<?php echo base_url('master_bank') ?>"><i class="fa fa-archive"></i> Bank</a></li>
		<li><a href="<?php echo base_url('master_alattransportasi') ?>"><i class="fa fa-archive"></i> Alat Transportasi</a></li>
		<li><a href="<?php echo base_url('master_jenisptk') ?>"><i class="fa fa-archive"></i> Jenis PTK</a></li>
		<li><a href="<?php echo base_url('master_kelas') ?>"><i class="fa fa-archive"></i> Kelas</a></li>
		<li><a href="<?php echo base_url('master_admin') ?>"><i class="fa fa-archive"></i> Admin</a></li>
		<li><a href="<?php echo base_url('master_siswa') ?>"><i class="fa fa-archive"></i> Siswa</a></li>
		<li><a href="<?php echo base_url('master_guru') ?>"><i class="fa fa-archive"></i> Guru</a></li>
		<li><a href="<?php echo base_url('master_jenjangpendidikan') ?>"><i class="fa fa-archive"></i> Jenjang Pendidikan</a></li>
		<li><a href="<?php echo base_url('master_tahunpel') ?>"><i class="fa fa-archive"></i> Tahun Pelajaran</a></li>
	</ul>
</li>
<li class="treeview <?php echo ($modul_active == 'master_setting' ? "active" : ""); ?>">
	<a href="#">
		<i class="fa fa-cogs text-aqua"></i> <span>Setting</span> <i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
		<li><a href="<?php echo base_url('master_aturwalikelas') ?>"><i class="fa fa-cog"></i> Atur Wali Kelas</a></li>
		<li><a href="<?php echo base_url('master_aturkelas') ?>"><i class="fa fa-cog"></i> Atur Kelas</a></li>
		<li><a href="<?php echo base_url('master_aturmapel') ?>"><i class="fa fa-cog"></i> Atur Guru Pengajar</a></li>
		<li><a href="<?php echo base_url('master_aturkelasajar') ?>"><i class="fa fa-cog"></i> Atur Kelas Mengajar</a></li>
		<li><a href="<?php echo base_url('master_aturtahunpel') ?>"><i class="fa fa-cog"></i> Atur Semester Aktif</a></li>
		<li><a href="<?php echo base_url('master_pindahkelas') ?>"><i class="fa fa-cog"></i> Pindah Kelas</a></li>
	</ul>
</li>
<li <?php echo ($modul_active == 'master_infoweb' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_infosekolah') ?>"><i class="fa fa-cogs text-aqua"></i> <span>Setting Informasi Sekolah</span></a></li>
<li <?php echo ($modul_active == 'master_detailakun' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_detailakun') ?>"><i class="fa fa-user text-aqua"></i> <span>Detail Akun</span></a></li>
