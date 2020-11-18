<div class="panel panel-default">
	<div class="panel-body">
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
	</div>
</div>
<div class="list-group" style="font-size: 20px;">
  <a href="<?= base_url('homepage_pmb/cekPMB') ?>" class="list-group-item"><i class="fa fa-list fa-fw"></i> Cek & Cetak Pendaftaran</a>
  <a href="<?= base_url('homepage_pmb/daftarPMB'); ?>" class="list-group-item"><i class="fa fa-users fa-fw"></i> Pendaftaran Baru</a>
  <a href="<?= base_url(); ?>" class="list-group-item"><i class="fa fa-globe fa-fw"></i> Kembali ke situs mutiara cendekia</a>
</div>