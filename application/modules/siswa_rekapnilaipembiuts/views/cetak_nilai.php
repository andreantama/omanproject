<html>
	<head>
		<title>Cetak Detail Akun</title>
		<style>
			label{
				font-weight: bold;
				margin: 0;
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
				<td align="center" width="30%">
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
			<h4 style="margin: 0">REKAP NILAI UJIAN PRAKTIK</h4>
			<h4 style="margin: 0">UJIAN TENGAH SEMESTER <?= $semester_aktif->SEMESTER ?></h4>
			<h4 style="margin: 0">TAHUN PELAJARAN <?= $semester_aktif->TAHUN_PEL ?></h4>
		</div>
		<p style="font-family: Arial;margin-bottom: 10px">Kelas : <?= $detail_kelas->NAMA_KELAS ?></p>
		<table width="100%" border="1" style="border-collapse: collapse;font-family: Arial;margin-bottom: 40px;" cellpadding="5">
        <thead>
        <tr valign="middle" style="font-weight: bold" align="center">
        		<th>No</th>
        		<th>Nama Siswa</th>
        		<th>L/P</th>
        		<th>NIS</th>
        		<th>NISN</th>
        		<th>Wudhu</th>
        		<th>Sholat</th>
        		<th>Tahsin</th>
        		<th>Surat Pendek</th>
        		<th>Hadits</th>
        		<th>Do'a</th>
        		<th>Tahfidzh 1</th>
        		<th>Tahfidzh 2</th>
        		<th>Jumlah</th>
        		<th>Rata - Rata</th>
        	</tr>
        	</thead>
        	<?php
				$a = 1;
				
				if($rekap_nilai):
				foreach($rekap_nilai as $rekap_nilai):
				$count_all_pembi = 6;
				$detail_nilai = $this->siswa_rekapnilaipembiuts->tampilData('tbl_nilai_pembiasaan_uts','*', array('ID_TAHUN_PEL' => $detail_semester, 'NO_SISWA' => $rekap_nilai->NO_SISWA), TRUE);
			?>
			<tr valign="middle" align="center">
				<td><?= $a; ?></td>
				<td><?= @$rekap_nilai->NAMA; ?></td>
				<td><?= @($rekap_nilai->JK == 1 ? "L" : "P") ?></td>
				<td><?= @$rekap_nilai->NIPD; ?></td>
				<td><?= @$rekap_nilai->NISN; ?></td>
				<td><?= @$detail_nilai->WUDHU; ?></td>
				<td><?= @$detail_nilai->SHOLAT; ?></td>
				<td><?= @$detail_nilai->TAHSIN; ?></td>
				<td><?= @$detail_nilai->SURAT_PENDEK; ?></td>
				<td><?= @$detail_nilai->HADITS; ?></td>
				<td><?= @$detail_nilai->DOA; ?></td>
				<?php
					$cek_surah_1 = $this->siswa_rekapnilaipembiuts->tampilData('tbl_nilai_pembiasaan_uts','NAMA_SURAH, TAHFIDZH',array('NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester), TRUE);
					if(@$cek_surah_1->NAMA_SURAH != '' && @$cek_surah_1->TAHFIDZH):
				?>
				<td><?= @$detail_nilai->TAHFIDZH; ?></td>
				<?php else: ?>
				<td></td>
				<?php $count_all_pembi++;endif; ?>
				<?php
					$cek_surah_2 = $this->siswa_rekapnilaipembiuts->tampilData('tbl_nilai_pembiasaan_uts','NAMA_SURAH_2, TAHFIDZH_2',array('NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester), TRUE);
					if(@$cek_surah_2->NAMA_SURAH_2 != '' && @$cek_surah_2->TAHFIDZH_2):
				?>
				<td><?= @$detail_nilai->TAHFIDZH_2; ?></td>
				<?php else: ?>
				<td></td>
				<?php $count_all_pembi++;endif; ?>
				<td>
					<?php
						$total = round(@$detail_nilai->WUDHU+@$detail_nilai->SHOLAT+@$detail_nilai->TAHSIN+@$detail_nilai->SURAT_PENDEK+@$detail_nilai->HADITS+@$detail_nilai->DOA);
						if(@$cek_surah_1->NAMA_SURAH != '' && @$cek_surah_1->TAHFIDZH){
							$total = $total + round($cek_surah_1->TAHFIDZH);
						}
						if(@$cek_surah_2->NAMA_SURAH_2 != '' && @$cek_surah_2->TAHFIDZH_2){
							$total = $total + round($cek_surah_2->TAHFIDZH_2);
						}
						echo $total;
					?>
					
				</td>
				<td><?= round($total/$count_all_pembi) ?></td>
			</tr>
			<?php $a++;endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="20">Tidak ada data.</td>
			</tr>
			<?php endif; ?>
    </table>
	</body>
</html>
