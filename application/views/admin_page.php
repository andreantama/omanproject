<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="<?php echo base_url() ?>assets-admin/plugins/jQuery/jQuery-2.2.0.min.js"></script>
</head>
<body class="hold-transition skin-red sidebar-mini layout-boxed">
<div class="wrapper">
	<?php
		switch($this->session->userdata('user_level')){
			case 1:
				$title_template = 'SP';
				$title_template_long = '<b>Siswa</b> Panel';
				$detail = $this->db->query('SELECT NAMA FROM tbl_siswa WHERE NO_SISWA='.$this->session->userdata('user_access_id'))->row();
				$nama = explode(' ',$detail->NAMA);$nama = $nama[0];
				$level = 'Siswa';
				break;
			case 2:
				$title_template = 'GBP';
				$title_template_long = '<b>Guru BP</b> Panel';
				$detail = $this->db->query('SELECT NAMA FROM tbl_guru WHERE NO_GURU='.$this->session->userdata('user_access_id'))->row();
				$nama = explode(' ',$detail->NAMA);$nama = $nama[0];
				$level = 'Guru BP';
				break;
			case 3:
				$title_template = 'GP';
				$title_template_long = '<b>Guru</b> Panel';
				$detail = $this->db->query('SELECT NAMA FROM tbl_guru WHERE NO_GURU='.$this->session->userdata('user_access_id'))->row();
				$nama = explode(' ',$detail->NAMA);$nama = $nama[0];
				$level = 'Guru';
				break;
			case 4:
				$title_template = 'WKP';
				$title_template_long = '<b>Wali Kelas</b> Panel';
				$detail = $this->db->query('SELECT NAMA FROM tbl_guru WHERE NO_GURU='.$this->session->userdata('user_access_id'))->row();
				$nama = explode(' ',$detail->NAMA);$nama = $nama[0];
				$level = 'Wali Kelas';
				break;
			case 5:
				$title_template = 'AP';
				$title_template_long = '<b>Admin</b> Panel';
				$detail = $this->db->query('SELECT NAME FROM tbl_admin WHERE ID_ADMIN='.$this->session->userdata('user_access_id'))->row();
				$nama = explode(' ',$detail->NAME);$nama = $nama[0];
				$level = ($this->session->userdata('level_admin') == 1 ? "Super Admin" : "Admin");
				break;
			default:
				break;
		}
	?>
  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b><?= $title_template ?></b></span>
      <span class="logo-lg"><?= $title_template_long ?></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets-admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $nama ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?= $level ?></a>
        </div>
      </div>
      <ul class="sidebar-menu">

      	<?php if($this->session->userdata("user_level") == 2){ ?>
      	<li <?= ($modul_active == 'gurubp_dashboard' ? "class='active'" : ""); ?>><a href="<?php echo base_url('gurubp_dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
        <li <?= ($modul_active == 'gurubp_inputabsensi' ? "class='active'" : ""); ?>><a href="<?php echo base_url('gurubp_inputabsensi') ?>"><i class="fa fa-th text-aqua"></i> <span>Input & Rekap Absensi</span></a></li>
        <li <?= ($modul_active == 'gurubp_pesan' ? "class='active'" : ""); ?>><a href="<?php echo base_url('gurubp_pesan') ?>"><i class="fa fa-envelope text-aqua"></i> <span>Kirim Pesan</span></a></li>
        <li <?= ($modul_active == 'gurubp_kotakkeluar' ? "class='active'" : ""); ?>><a href="<?php echo base_url('gurubp_kotakkeluar') ?>"><i class="fa fa-upload text-aqua"></i> <span>Kotak Keluar</span></a></li>
      	<?php } ?>

      	<?php if($this->session->userdata("user_level") == 3){ ?>
      	<li <?= ($modul_active == 'guru_dashboard' ? "class='active'" : ""); ?>><a href="<?php echo base_url('guru_dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
      	
      	<li class="treeview <?= ($modul_active == 'guru_inputnilai' ? "active" : ""); ?>">
          <a href="#">
            <i class="fa fa-archive text-aqua"></i> <span>Input Data</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('guru_inputnilaimapel') ?>"><i class="fa fa-archive"></i> Input Nilai Mapel</a></li>
	          <li><a href="<?php echo base_url('guru_inputnilaiuts') ?>"><i class="fa fa-archive"></i> Input Nilai UTS</a></li>
	          <li><a href="<?php echo base_url('guru_inputnilaiuas') ?>"><i class="fa fa-archive"></i> Input Nilai UAS</a></li>
          </ul>
        </li>
        <li class="treeview <?= ($modul_active == 'guru_rekap' ? "active" : ""); ?>">
          <a href="#">
            <i class="fa fa-archive text-aqua"></i> <span>Rekap Data</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('guru_rekapnilai') ?>"><i class="fa fa-print"></i> Nilai Mata Pelajaran</a></li>
          </ul>
        </li>
        <li <?= ($modul_active == 'guru_detailakun' ? "class='active'" : ""); ?>><a href="<?php echo base_url('guru_detailakun') ?>"><i class="fa fa-user text-aqua"></i> <span>Detail Akun</span></a></li>
        <li <?= ($modul_active == 'guru_gantipassword' ? "class='active'" : ""); ?>><a href="<?php echo base_url('guru_gantipassword') ?>"><i class="fa fa-lock text-aqua"></i> <span>Ganti Password</span></a></li>
      	<?php } ?>

		<?php if($this->session->userdata("user_level") == 4){ ?>
      	<li <?= ($modul_active == 'walikelas_dashboard' ? "class='active'" : ""); ?>><a href="<?php echo base_url('walikelas_dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
	      <li <?= ($modul_active == 'walikelas_inputpem_uts' ? "class='active'" : ""); ?>><a href="<?php echo base_url('walikelas_inputnilaipembiuts') ?>"><i class="fa fa-th text-aqua"></i> <span>Input Nilai UTS Pembiasaan</span></a></li>
	      <li <?= ($modul_active == 'walikelas_inputpem' ? "class='active'" : ""); ?>><a href="<?php echo base_url('walikelas_inputnilaipembi') ?>"><i class="fa fa-th text-aqua"></i> <span>Input Nilai Pembiasaan</span></a></li>
      	 <li <?= ($modul_active == 'walikelas_inputekskul' ? "class='active'" : ""); ?>><a href="<?php echo base_url('walikelas_inputnilaiekskul') ?>"><i class="fa fa-th text-aqua"></i> <span>Input Nilai Ekskul & Akhlak</span></a></li>
	       <li <?= ($modul_active == 'walikelas_inputperingkat' ? "class='active'" : ""); ?>><a href="<?php echo base_url('walikelas_inputperingkat') ?>"><i class="fa fa-th text-aqua"></i> <span>Input Bintang Kelas</span></a></li>
        
      	 <li class="treeview <?= ($modul_active == 'walikelas_rekap' ? "active" : ""); ?>">
          <a href="#">
            <i class="fa fa-archive text-aqua"></i> <span>Rekap Data</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('walikelas_rekapnilai') ?>"><i class="fa fa-print"></i> Nilai Mata Pelajaran</a></li>
	          <li><a href="<?php echo base_url('walikelas_rekapnilaiuts') ?>"><i class="fa fa-print"></i> Nilai UTS</a></li>
	          <li><a href="<?php echo base_url('walikelas_rekapnilaiuas') ?>"><i class="fa fa-print"></i> Nilai UAS</a></li>
            <li><a href="<?php echo base_url('walikelas_rekapabsensi') ?>"><i class="fa fa-print"></i> Absensi</a></li>
            <li><a href="<?php echo base_url('walikelas_rekapnilaipembi') ?>"><i class="fa fa-print"></i> Nilai Pembiasaan</a></li>
            <li><a href="<?php echo base_url('walikelas_rekapnilaipembiuts') ?>"><i class="fa fa-print"></i> Nilai Pembiasaan UTS</a></li>
          </ul>
        </li>
        <li class="treeview <?= ($modul_active == 'walikelas_raport' ? "active" : ""); ?>">
          <a href="#">
            <i class="fa fa-archive text-aqua"></i> <span>Cetak Raport</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('walikelas_raportuts') ?>"><i class="fa fa-print"></i> Nilai UTS</a></li>
            <li><a href="<?php echo base_url('walikelas_raportnilai') ?>"><i class="fa fa-print"></i> Nilai Mata Pelajaran</a></li>
            <li><a href="<?php echo base_url('walikelas_raportnilaipembi') ?>"><i class="fa fa-print"></i> Nilai Pembiasaan</a></li>
            <li><a href="<?php echo base_url('walikelas_raportnilaipembiuts') ?>"><i class="fa fa-print"></i> Nilai Pembiasaan UTS</a></li>
            <li><a href="<?php echo base_url('walikelas_raportnilaiekskul') ?>"><i class="fa fa-print"></i> Nilai Ekskul & Akhlak</a></li>
            <li><a href="<?php echo base_url('walikelas_raportk13') ?>"><i class="fa fa-print"></i> Format K13</a></li>
          </ul>
        </li>
      	<li <?= ($modul_active == 'walikelas_pesan' ? "class='active'" : ""); ?>><a href="<?php echo base_url('walikelas_pesan') ?>"><i class="fa fa-envelope text-aqua"></i> <span>Kirim Pesan</span></a></li>
        <li <?= ($modul_active == 'walikelas_kotakkeluar' ? "class='active'" : ""); ?>><a href="<?php echo base_url('walikelas_kotakkeluar') ?>"><i class="fa fa-upload text-aqua"></i> <span>Kotak Keluar</span></a></li>
      	
      	<?php } ?>

      	<?php if($this->session->userdata("user_level") == 1){ ?>
      	<li <?= ($modul_active == 'siswa_dashboard' ? "class='active'" : ""); ?>><a href="<?php echo base_url('siswa_dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
      	<li class="treeview <?= ($modul_active == 'siswa_rekap' ? "active" : ""); ?>">
          <a href="#">
            <i class="fa fa-list text-aqua"></i> <span>Nilai</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
	          <li><a href="<?php echo base_url('siswa_rekapnilaiuts') ?>"><i class="fa fa-archive"></i> Nilai UTS</a></li>
	          <li><a href="<?php echo base_url('siswa_rekapnilaipembiuts') ?>"><i class="fa fa-archive"></i> Nilai UTS Pembiasaan </a></li>
	          <li><a href="<?php echo base_url('siswa_rekapnilaiuas') ?>"><i class="fa fa-archive"></i> Nilai UAS</a></li>
	          <li><a href="<?php echo base_url('siswa_rekapnilai') ?>"><i class="fa fa-archive"></i> Nilai Mata Pelajaran</a></li>
	          <li><a href="<?php echo base_url('siswa_rekapnilaipembi') ?>"><i class="fa fa-archive"></i> Nilai Pembiasaan</a></li>
            <?php /*
	          <li><a href="<?php echo base_url('siswa_rekapperingkat') ?>"><i class="fa fa-archive"></i> Peringkat Kelas</a></li>
	          */?>
          </ul>
        </li>
        <li <?= ($modul_active == 'siswa_rekapabsen' ? "class='active'" : ""); ?>><a href="<?php echo base_url('siswa_rekapabsensi') ?>"><i class="fa fa-th text-aqua"></i> <span>Absensi</span></a></li>
        <li <?= ($modul_active == 'siswa_pesan' ? "class='active'" : ""); ?>><a href="<?php echo base_url('siswa_pesan') ?>"><i class="fa fa-envelope text-aqua"></i> <span>Pesan Masuk</span></a></li>
        <li <?= ($modul_active == 'siswa_detailakun' ? "class='active'" : ""); ?>><a href="<?php echo base_url('siswa_detailakun') ?>"><i class="fa fa-user text-aqua"></i> <span>Detail Akun</span></a></li>
        <li <?= ($modul_active == 'siswa_gantipassword' ? "class='active'" : ""); ?>><a href="<?php echo base_url('siswa_gantipassword') ?>"><i class="fa fa-lock text-aqua"></i> <span>Ganti Password</span></a></li>
      	<?php } ?>

      	<?php 
        if($this->session->userdata("user_level") == 5){ 
          // 1 = Super Administrator, 2 = Admin Master Data, 3 = Admin PPDB, 4 = Admin Web
          $level_admin = $this->session->userdata("level_admin");

          switch ($level_admin) {
            case 1:
              $this->load->view('partials/v_super_admin');
              break;
            case 2:
              $this->load->view('partials/v_admin_masterdata');
              break;
            case 3:
              $this->load->view('partials/v_admin_ppdb');
              break;
            case 4:
              $this->load->view('partials/v_admin_web');
              break;
          }
       
        } ?>
        
        <li><a href="<?php echo base_url('master_login/logout') ?>"><i class="fa fa-lock text-aqua"></i> <span>Logout</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo @$judul_page; ?>
        <small><?php echo @$des_page; ?></small>
      </h1>
    </section>
    <section class="content">
		<?php $this->load->view($page); ?>
    </section>
  </div>

  <footer class="main-footer">
    <strong>&copy; Jariprom 2014-2016. All rights reserved.
  </footer>
</div>
<script src="<?php echo base_url() ?>assets-admin/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo base_url() ?>assets-admin/dist/js/app.min.js"></script>
<script src="<?php echo base_url() ?>assets-admin/dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url() ?>assets-admin/plugins/ckeditor/ckeditor.js"></script>
</body>
</html>
