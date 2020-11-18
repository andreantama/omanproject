<html>
	<head>
		<title>Cetak Nilai</title>
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
			<h4 style="margin: 0">DAFTAR NILAI</h4>
			<h4 style="margin: 0">MATA PELAJARAN <?= $detail_mapel->MAPEL ?></h4>
			<h4 style="margin: 0">T.A <?= $semester_aktif->TAHUN_PEL ?> / SEMESTER <?= $semester_aktif->SEMESTER ?></h4>
		</div>
		<p style="font-family: Arial;margin-bottom: 10px">Kelas : <?= $detail_kelas->NAMA_KELAS ?></p>
		<table width="100%" border="1" style="border-collapse: collapse;font-family: Arial;margin-bottom: 40px;" cellpadding="5">
        <thead>
            <tr valign="middle" align="center">
				<th rowspan="2">No</th>
				<th rowspan="2">Nama Siswa</th>
				<th colspan="3">UH</th>
				<th rowspan="2">Rata - Rata</th>
				<th colspan="12">TUGAS DAN PEKERJAAN RUMAH</th>
				<th rowspan="2">Rata - Rata</th>
				<th colspan="2">ULANGAN</th>
				<th rowspan="2">2UU</th>
				<th rowspan="2">RAPORT</th>
            </tr>
			<tr valign="middle" align="center">
				<th>UH 1</th>
				<th>UH 2</th>
				<th>UH 3</th>
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
				<th>9</th>
				<th>10</th>
				<th>11</th>
				<th>12</th>
				<th>TS</th>
				<th>UAS</th>
			</tr>
        </thead>
		<tbody>
			<?php
				$a = 1;
				foreach($rekap_nilai as $rekap_nilai):
			?>
			<tr valign="middle" align="center">
				<td><?= $a++?></td>
				<td><?= $rekap_nilai->NAMA?></td>
				<?php
				
					$ul_ts = $this->walikelas_rekapnilai->getNilaiUts(array('NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester, 'ID_MAPEL' => $id_mapel));
					$nilai_uas = $this->walikelas_rekapnilai->tampilData('tbl_nilai_uas','*', array('ID_TAHUN_PEL' => $detail_semester, 'NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_MAPEL' => $id_mapel), TRUE);
					$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;
					$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;
				
					$detail_nilai = $this->walikelas_rekapnilai->tampilData('tbl_nilai_mapel','*', array('ID_TAHUN_PEL' => $detail_semester, 'NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_MAPEL' => $id_mapel), TRUE);
					if($detail_nilai){
						$uh_1 = $detail_nilai->UH_1;
						$uh_2 = $detail_nilai->UH_2;
						$uh_3 = $detail_nilai->UH_3;
						$tugas_1 = $detail_nilai->TUGAS_1;
						$tugas_2 = $detail_nilai->TUGAS_2;
						$tugas_3 = $detail_nilai->TUGAS_3;
						$tugas_4 = $detail_nilai->TUGAS_4;
						$tugas_5 = $detail_nilai->TUGAS_5;
						$tugas_6 = $detail_nilai->TUGAS_6;
						$tugas_7 = $detail_nilai->TUGAS_7;
						$tugas_8 = $detail_nilai->TUGAS_8;
						$tugas_9 = $detail_nilai->TUGAS_9;
						$tugas_10 = $detail_nilai->TUGAS_10;
						$tugas_11 = $detail_nilai->TUGAS_11;
						$tugas_12 = $detail_nilai->TUGAS_12;
					}
					else{
						$uh_1 = 0;
						$uh_2 = 0;
						$uh_3 = 0;
						$tugas_1 = 0;
						$tugas_2 = 0;
						$tugas_3 = 0;
						$tugas_4 = 0;
						$tugas_5 = 0;
						$tugas_6 = 0;
						$tugas_7 = 0;
						$tugas_8 = 0;
						$tugas_9 = 0;
						$tugas_10 = 0;
						$tugas_11 = 0;
						$tugas_12 = 0;
					}
				?>
				<td>
					<?= $uh_1 ?>
				</td>
				<td>
					<?= $uh_2 ?>
				</td>
				<td>
					<?= $uh_3 ?>
				</td>
				<td>
					<?= $rt_uh = round(($uh_1+$uh_2+$uh_3)/3) ?>
				</td>
				<td>
					<?= $tugas_1 ?>
				</td>
				<td>
					<?= $tugas_2 ?>
				</td>
				<td>
					<?= $tugas_3 ?>
				</td>
				<td>
					<?= $tugas_4 ?>
				</td>
				<td>
					<?= $tugas_5 ?>
				</td>
				<td>
					<?= $tugas_6 ?>
				</td>
				<td>
					<?= $tugas_7 ?>
				</td>
				<td>
					<?= $tugas_8 ?>
				</td>
				<td>
					<?= $tugas_9 ?>
				</td>
				<td>
					<?= $tugas_10 ?>
				</td>
				<td>
					<?= $tugas_11 ?>
				</td>
				<td>
					<?= $tugas_12 ?>
				</td>
				<td>
					<?= $rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12) ?>
				</td>
				<td>
					<?= $ul_ts ?>
				</td>
				<td>
					<?= $uas ?>
				</td>
				<td>
					<?= $rt_uu2 = ($uu_2*2) ?>
				</td>
				<td>
					<?= round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
    </table>
    <table width="100%">
    	<tr>
    		<td width="70%"></td>
    		<td align="left" width="30%">
    			Lubuklinggau, ...........................<br/>Guru Mata Pelajaran,
    			<br/><br/><br/><br/>
    			...........................
    		</td>
    	</tr>
    </table>
	</body>
</html>
