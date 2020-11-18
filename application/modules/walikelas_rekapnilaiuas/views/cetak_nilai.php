<html>
	<head>
		<title>Cetak Detail Akun</title>
		<style>
			table { page-break-inside:auto }
		    tr    { page-break-inside:avoid; page-break-after:auto }
		    thead { display:table-header-group }
		    tfoot { display:table-footer-group }
			label{
				font-weight: bold;
				margin: 0;
			}
			body{
				font-family: Arial;
				font-size: 15px;
			}
			p{
				margin-bottom: 5px;
				margin-top: 5px;
			}
			@page { size: landscape; }
		</style>
	</head>
	<body onload="window.print()">
		<table width="100%" style="margin-bottom: 20px;border: 1px solid black;padding:10px;">
			<tr>
				<td align="center" width="20%">
					<img src="<?= base_url('assets-admin/img/logo/'.$data_infosekolah->LOGO) ?>" width="150px"/>
				</td>
				<td align="center" width="70%" style="font-family: Arial">
					<h3 style="margin: 0">YAYASAN PENDIDIKAN DAN DAKWAH PELITA TAQWA</h3>
					<h3 style="margin: 0">SEKOLAH DASAR ISLAM TERPADU</h3>
					<h3 style="margin: 0"><?= $data_infosekolah->NAMA_SEKOLAH ?></h3>
					<h5 style="margin: 0"><?= $data_infosekolah->ALAMAT_SEKOLAH ?></h5>
				</td>
			</tr>
		</table>
		<div style="text-align: center;margin-bottom: 20px;font-family: Arial;">
			<h4 style="margin: 0">DAFTAR NILAI MATA PELAJARAN</h4>
			<h4 style="margin: 0">UJIAN AKHIR SEMESTER <?= $semester_aktif->SEMESTER ?></h4>
			<h4 style="margin: 0">TAHUN PELAJARAN <?= $semester_aktif->TAHUN_PEL ?></h4>
		</div>
		<p style="font-family: Arial;margin-bottom: 10px">Kelas : <?= $detail_kelas->NAMA_KELAS ?></p>
		<table width="100%" border="1" style="border-collapse: collapse;font-family: Arial;margin-bottom: 40px;" cellpadding="5">
		<thead>
			
		
        <tr valign="middle" style="font-weight: bold" align="center">
        		<td>No</td>
        		<td>NISN</td>
        		<td>Nama Siswa</td>
        		<td>L/P</td>
        		<?php $jum_mapel = 0;foreach($data_mapel as $data_mapel):?>
        		<?php if($jum_mapel != 0): ?>
        		<td><?= $data_mapel->SHORT_MAPEL ?></td>
        		<?php endif; ?>
        		<?php $jum_mapel++;endforeach; ?>
        		<td>Jumlah</td>
        		<td>Rata - Rata</td>
        	</tr>
        	</thead>
        	<?php
				$a = 1;
				if($rekap_nilai):
				foreach($rekap_nilai as $rekap_nilai):
			?>
			<tr valign="middle" align="center">
				<td><?= $a; ?></td>
				<td><?= $rekap_nilai->NISN; ?></td>
				<td><?= $rekap_nilai->NAMA; ?></td>
				<td><?= ($rekap_nilai->JK == 1 ? "L" : "P") ?></td>
				
					<?php
						$sql = $this->db->query('SELECT * FROM tbl_mapel')->result();
						$total = 0;
						$average = 0;
						foreach($sql as $key){
							if($key->ID_MAPEL != 1){
								$detail_nilai = $this->walikelas_rekapnilaiuas->tampilData('tbl_nilai_uas','*', array('NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester, 'ID_MAPEL' => $key->ID_MAPEL), TRUE);
								if($detail_nilai){
									if($detail_nilai->ID_MAPEL == $key->ID_MAPEL){
										$average++;
										$asa = round($detail_nilai->UAS);
										echo '<td>'.round($detail_nilai->UAS).'</td>';
										$total = $total + $asa;
									}
									else{
										echo '<td> - </td>';
									}
								}
								else{
									echo '<td> - </td>';
								}
							}
						}
					?>
				<td><?= $total; ?></td>
				<td><?php if($total == 0): ?>
					<?php
						echo 0;
					?>
					<?php else: ?>
					<?php echo round($total/$average); ?>
					<?php endif; ?>
				</td>
			</tr>
			<?php $a++;endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="20">Tidak ada data.</td>
			</tr>
			<?php endif; ?>
    </table>
    <table width="100%">
    	<tr>
    		<td align="left" width="70%">
    			Wali Kelas,<br/>
    			<br/><br/><br/>
    			...........................
    		</td>
    		<td align="left" width="30%">
    			Lubuklinggau, ...........................<br/>Guru Pendamping,
    			<br/><br/><br/>
    			...........................
    		</td>
    	</tr>
    </table>
    <table width="100%">
    	<tr>
    		<td align="center">
    			MENGETAHUI, ...........................<br/>KEPALA SDIT MUTIARA CENDEKIA,
    			<br/><br /><br /><br />
    			...........................
    		</td>
    	</tr>
    </table>
	</body>
</html>
