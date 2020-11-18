<li <?php echo ($modul_active == 'master_dashboard' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
<li <?php echo ($modul_active == 'master_pmb' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_pmb') ?>"><i class="fa fa-list text-aqua"></i> <span>PPDB</span></a></li>
<li <?php echo ($modul_active == 'master_pmbdaftarulang' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_pmb/daftarUlang') ?>"><i class="fa fa-list text-aqua"></i> <span>Daftar Ulang</span></a></li>
<li <?php echo ($modul_active == 'master_detailakun' ? "class='active'" : ""); ?>><a href="<?php echo base_url('master_detailakun') ?>"><i class="fa fa-user text-aqua"></i> <span>Detail Akun</span></a></li>

