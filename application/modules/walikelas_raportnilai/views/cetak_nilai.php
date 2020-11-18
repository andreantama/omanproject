<?php

	function getKKM($id_mapel){

		$ci =& get_instance();

		$kkm = $ci->db->query('SELECT KKM FROM tbl_mapel WHERE ID_MAPEL='.$id_mapel)->row();

		return $kkm->KKM;

	}

	

	function getNilaiUtsViaQuery($data){

		$ci =& get_instance();

		$result = $ci->db->query('SELECT * FROM tbl_nilai_uts WHERE ID_MAPEL='.$data['ID_MAPEL'].' AND NO_SISWA='.$data['NO_SISWA'].' AND ID_TAHUN_PEL='.$data['ID_TAHUN_PEL'])->row();

		

		if($result)

			return round($result->UTS);

		

		return 0;

	}



	function getNilai($no_siswa, $id_mapel, $semester_aktifnya){

		$ci =& get_instance();

			

		$ul_ts = getNilaiUtsViaQuery(array('NO_SISWA' => $no_siswa, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => $id_mapel));

		$nilai_uas = $ci->db->query('SELECT * FROM tbl_nilai_uas WHERE ID_MAPEL='.$id_mapel.' AND NO_SISWA='.$no_siswa.' AND ID_TAHUN_PEL='.$semester_aktifnya)->row();

		$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

		$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;			



		$nilai = $ci->db->query('SELECT * FROM tbl_nilai_mapel WHERE ID_MAPEL='.$id_mapel.' AND NO_SISWA='.$no_siswa.' AND ID_TAHUN_PEL='.$semester_aktifnya)->row();

		if($nilai){

			$uh_1 = $nilai->UH_1;

			$uh_2 = $nilai->UH_2;

			$uh_3 = $nilai->UH_3;

			$tugas_1 = $nilai->TUGAS_1;

			$tugas_2 = $nilai->TUGAS_2;

			$tugas_3 = $nilai->TUGAS_3;

			$tugas_4 = $nilai->TUGAS_4;

			$tugas_5 = $nilai->TUGAS_5;

			$tugas_6 = $nilai->TUGAS_6;

			$tugas_7 = $nilai->TUGAS_7;

			$tugas_8 = $nilai->TUGAS_8;

			$tugas_9 = $nilai->TUGAS_9;

			$tugas_10 = $nilai->TUGAS_10;

			$tugas_11 = $nilai->TUGAS_11;

			$tugas_12 = $nilai->TUGAS_12;

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

		$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

		$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

		$rt_uu2 = ($uu_2*2);

		$rumus = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5);

		return $rumus; 

	}

?>

<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="utf-8">

  <title>A4</title>

  <!-- Load paper.css for happy printing -->

  <link rel="stylesheet" href="<?= base_url('assets-admin/bootstrap/css/print.css') ?>">



  <!-- Set page size here: A5, A4 or A3 -->

  <!-- Set also "landscape" if you need -->

  <style>@page { size: A4 }

  	table tr td {

		font-size: 15px;

	}

	table tr th {

		font-size: 15px;

	}

  </style>

</head>



<body class="A4" onload="window.print()">



  <section class="sheet" style="padding-top: 20px;padding-left: 20px;padding-right: 20px;padding-bottom: 20px;">



    <?php

    	$jum_all_mapel_siswa = 0;

    	$id_mapel_siswa_list = array();

    ?>

    <div style="text-align: center">

    	<img src="<?= base_url('assets-admin/img/logo/'.$data_infosekolah->LOGO) ?>" width="130px"/>

    </div>

	<table width="100%">

		<tr>

			<td width="50%">

				<table width="100%" cellpadding="2">

					<tr align="left">

						<td width="40%">Nama Peserta Didik</td>

						<td width="2%">:</td>

						<td width="58%"><b><?= ucwords(strtolower($detail_siswa->NAMA)) ?></b></td>

					</tr>

					<tr>

						<td>NIS / NISN</td>

						<td>:</td>

						<td><?= $detail_siswa->NIPD ?> / <?= $detail_siswa->NISN ?></td>

					</tr>

					<tr>

						<td>Nama Sekolah</td>

						<td>:</td>

						<td><?= $data_infosekolah->NAMA_SEKOLAH ?></td>

					</tr>

					

				</table>

			</td>

			<td width="50%">

				<table width="100%" cellpadding="2" >

					<tr align="left">

						<td width="40%">Kelas</td>

						<td width="2%">:</td>

						<td width="58%"><?= $detail_kelas->NAMA_KELAS ?></td>

					</tr>

					<tr>

						<td>Semester</td>

						<td>:</td>

						<td><?= ($semester_aktif->SEMESTER == 1 ? "1 (Satu) / Ganjil" : "2 (Dua) / Genap") ?></td>

					</tr>

					<tr>

						<td>Tahun Ajaran</td>

						<td>:</td>

						<td><?php echo $semester_aktif->TAHUN_PEL ?></td>

					</tr>

				</table>

			</td>

		</tr>

		<tr>

			<td width="100%" colspan="2">

				<table width="100%">

						<td width="19.5%">Alamat Sekolah</td>

						<td width="1%">:</td>

						<td><?= $data_infosekolah->ALAMAT_SEKOLAH ?></td>

				</table>

			</td>

		</tr>

	</table>

	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="4">

		<tr align="center" valign="middle">

			<th rowspan="2">No</th>

			<th rowspan="2">Mata Pelajaran</th>

			<th rowspan="2">KKM</th>

			<th rowspan="2" width="10%">Rata-Rata Kelas</th>

			<th colspan="2">Nilai</th>

			<th rowspan="2">Catatan Guru</th>

		</tr>

		<tr>

			<th width="12%">

				Angka

			</th>

			<th>

				Huruf

			</th>

		</tr>

		<tr valign="middle">

			<td align="center">

				1

			</td>

			<td>Pendidikan Agama Islam</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

		</tr>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 4), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Al-Quran dan Hadist</td>

			<td align="center"><?php $kkm = getKKM(4); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_alquran = 0;

					$count_alquran = 0;

					foreach($rekap_nilai as $alquran){

						$count_alquran++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $alquran->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 4));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $alquran->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 4), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;



						$alquran = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $alquran->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 4), TRUE);

						if($alquran){

							$uh_1 = $alquran->UH_1;

							$uh_2 = $alquran->UH_2;

							$uh_3 = $alquran->UH_3;

							$tugas_1 = $alquran->TUGAS_1;

							$tugas_2 = $alquran->TUGAS_2;

							$tugas_3 = $alquran->TUGAS_3;

							$tugas_4 = $alquran->TUGAS_4;

							$tugas_5 = $alquran->TUGAS_5;

							$tugas_6 = $alquran->TUGAS_6;

							$tugas_7 = $alquran->TUGAS_7;

							$tugas_8 = $alquran->TUGAS_8;

							$tugas_9 = $alquran->TUGAS_9;

							$tugas_10 = $alquran->TUGAS_10;

							$tugas_11 = $alquran->TUGAS_11;

							$tugas_12 = $alquran->TUGAS_12;							

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_alquran = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_alquran;

					}

					$rumus_alquran = ($rata2_alquran/$count_alquran);

					echo round($rumus_alquran);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 4, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 4;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 2), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Aqidah Akhlak</td>

			<td align="center"><?php $kkm = getKKM(2); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_aqidah = 0;

					$count_aqidah = 0;

					foreach($rekap_nilai as $aqidah){

						$count_aqidah++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $aqidah->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 2));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $aqidah->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 2), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;



						$aqidah = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $aqidah->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 2), TRUE);

						if($aqidah){

							$uh_1 = $aqidah->UH_1;

							$uh_2 = $aqidah->UH_2;

							$uh_3 = $aqidah->UH_3;

							$tugas_1 = $aqidah->TUGAS_1;

							$tugas_2 = $aqidah->TUGAS_2;

							$tugas_3 = $aqidah->TUGAS_3;

							$tugas_4 = $aqidah->TUGAS_4;

							$tugas_5 = $aqidah->TUGAS_5;

							$tugas_6 = $aqidah->TUGAS_6;

							$tugas_7 = $aqidah->TUGAS_7;

							$tugas_8 = $aqidah->TUGAS_8;

							$tugas_9 = $aqidah->TUGAS_9;

							$tugas_10 = $aqidah->TUGAS_10;

							$tugas_11 = $aqidah->TUGAS_11;

							$tugas_12 = $aqidah->TUGAS_12;							

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_aqidah = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_aqidah;

					}

					$rumus_aqidah = ($rata2_aqidah/$count_aqidah);

					echo round($rumus_aqidah);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 2, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 2;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 3), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Fiqih</td>

			<td align="center"><?php $kkm = getKKM(3); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_fiqih = 0;

					$count_fiqih = 0;

					foreach($rekap_nilai as $fiqih){

						$count_fiqih++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $fiqih->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 3));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $fiqih->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 3), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						$fiqih = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $fiqih->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 3), TRUE);

						if($fiqih){

							$uh_1 = $fiqih->UH_1;

							$uh_2 = $fiqih->UH_2;

							$uh_3 = $fiqih->UH_3;

							$tugas_1 = $fiqih->TUGAS_1;

							$tugas_2 = $fiqih->TUGAS_2;

							$tugas_3 = $fiqih->TUGAS_3;

							$tugas_4 = $fiqih->TUGAS_4;

							$tugas_5 = $fiqih->TUGAS_5;

							$tugas_6 = $fiqih->TUGAS_6;

							$tugas_7 = $fiqih->TUGAS_7;

							$tugas_8 = $fiqih->TUGAS_8;

							$tugas_9 = $fiqih->TUGAS_9;

							$tugas_10 = $fiqih->TUGAS_10;

							$tugas_11 = $fiqih->TUGAS_11;

							$tugas_12 = $fiqih->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_fiqih = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_fiqih;

					}

					$rumus_fiqih = ($rata2_fiqih/$count_fiqih);

					echo round($rumus_fiqih);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 3, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 3;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 15), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Sejarah Kebudayan Islam ( SKI )</td>

			<td align="center"><?php $kkm = getKKM(15); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_ski = 0;

					$count_ski = 0;

					foreach($rekap_nilai as $ski){

						$count_ski++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $ski->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 15));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $ski->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 15), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

					

						$ski = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $ski->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 15), TRUE);

						if($ski){

							$uh_1 = $ski->UH_1;

							$uh_2 = $ski->UH_2;

							$uh_3 = $ski->UH_3;

							$tugas_1 = $ski->TUGAS_1;

							$tugas_2 = $ski->TUGAS_2;

							$tugas_3 = $ski->TUGAS_3;

							$tugas_4 = $ski->TUGAS_4;

							$tugas_5 = $ski->TUGAS_5;

							$tugas_6 = $ski->TUGAS_6;

							$tugas_7 = $ski->TUGAS_7;

							$tugas_8 = $ski->TUGAS_8;

							$tugas_9 = $ski->TUGAS_9;

							$tugas_10 = $ski->TUGAS_10;

							$tugas_11 = $ski->TUGAS_11;

							$tugas_12 = $ski->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_ski = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_ski;

					}

					$rumus_ski = ($rata2_ski/$count_ski);

					echo round($rumus_ski);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 15, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 15;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 5), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				2

			</td>

			<td>Pendidikan Kewarganegaraan (PKn)</td>

			<td align="center"><?php $kkm = getKKM(5); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_pkn = 0;

					$count_pkn = 0;

					foreach($rekap_nilai as $pkn){

						$count_pkn++;

					

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $pkn->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 5));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $pkn->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 5), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						$pkn = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $pkn->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 5), TRUE);

						if($pkn){

							$uh_1 = $pkn->UH_1;

							$uh_2 = $pkn->UH_2;

							$uh_3 = $pkn->UH_3;

							$tugas_1 = $pkn->TUGAS_1;

							$tugas_2 = $pkn->TUGAS_2;

							$tugas_3 = $pkn->TUGAS_3;

							$tugas_4 = $pkn->TUGAS_4;

							$tugas_5 = $pkn->TUGAS_5;

							$tugas_6 = $pkn->TUGAS_6;

							$tugas_7 = $pkn->TUGAS_7;

							$tugas_8 = $pkn->TUGAS_8;

							$tugas_9 = $pkn->TUGAS_9;

							$tugas_10 = $pkn->TUGAS_10;

							$tugas_11 = $pkn->TUGAS_11;

							$tugas_12 = $pkn->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_pkn = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_pkn;

					}

					$rumus_pkn = ($rata2_pkn/$count_pkn);

					echo round($rumus_pkn);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 5, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 5;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 6), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				3

			</td>

			<td>Bahasa Indonesia</td>

			<td align="center"><?php $kkm = getKKM(6); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_bind = 0;

					$count_bind = 0;

					foreach($rekap_nilai as $bind){

						$count_bind++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $bind->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 6));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $bind->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 6), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

					

						$bind = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $bind->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 6), TRUE);

						if($bind){

							$uh_1 = $bind->UH_1;

							$uh_2 = $bind->UH_2;

							$uh_3 = $bind->UH_3;

							$tugas_1 = $bind->TUGAS_1;

							$tugas_2 = $bind->TUGAS_2;

							$tugas_3 = $bind->TUGAS_3;

							$tugas_4 = $bind->TUGAS_4;

							$tugas_5 = $bind->TUGAS_5;

							$tugas_6 = $bind->TUGAS_6;

							$tugas_7 = $bind->TUGAS_7;

							$tugas_8 = $bind->TUGAS_8;

							$tugas_9 = $bind->TUGAS_9;

							$tugas_10 = $bind->TUGAS_10;

							$tugas_11 = $bind->TUGAS_11;

							$tugas_12 = $bind->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_bind = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_bind;

					}

					$rumus_bind = ($rata2_bind/$count_bind);

					echo round($rumus_bind);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 6, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 6;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 14), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				4

			</td>

			<td>Matematika</td>

			<td align="center"><?php $kkm = getKKM(14); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_mat = 0;

					$count_mat = 0;

					foreach($rekap_nilai as $mat){

						$count_mat++;



						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $mat->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 14));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $mat->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 14), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

					

						$mat = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $mat->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 14), TRUE);

						if($mat){

							$uh_1 = $mat->UH_1;

							$uh_2 = $mat->UH_2;

							$uh_3 = $mat->UH_3;

							$tugas_1 = $mat->TUGAS_1;

							$tugas_2 = $mat->TUGAS_2;

							$tugas_3 = $mat->TUGAS_3;

							$tugas_4 = $mat->TUGAS_4;

							$tugas_5 = $mat->TUGAS_5;

							$tugas_6 = $mat->TUGAS_6;

							$tugas_7 = $mat->TUGAS_7;

							$tugas_8 = $mat->TUGAS_8;

							$tugas_9 = $mat->TUGAS_9;

							$tugas_10 = $mat->TUGAS_10;

							$tugas_11 = $mat->TUGAS_11;

							$tugas_12 = $mat->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_mat = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_mat;

					}

					$rumus_mat = ($rata2_mat/$count_mat);

					echo round($rumus_mat);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 14, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 14;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 7), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				5

			</td>

			<td>Ilmu Pengetahuan Alam ( IPA )</td>

			<td align="center"><?php $kkm = getKKM(7); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_ipa = 0;

					$count_ipa = 0;

					foreach($rekap_nilai as $ipa){

						$count_ipa++;



						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $ipa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 7));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $ipa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 7), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						$ipa = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $ipa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 7), TRUE);

						if($ipa){

							$uh_1 = $ipa->UH_1;

							$uh_2 = $ipa->UH_2;

							$uh_3 = $ipa->UH_3;

							$tugas_1 = $ipa->TUGAS_1;

							$tugas_2 = $ipa->TUGAS_2;

							$tugas_3 = $ipa->TUGAS_3;

							$tugas_4 = $ipa->TUGAS_4;

							$tugas_5 = $ipa->TUGAS_5;

							$tugas_6 = $ipa->TUGAS_6;

							$tugas_7 = $ipa->TUGAS_7;

							$tugas_8 = $ipa->TUGAS_8;

							$tugas_9 = $ipa->TUGAS_9;

							$tugas_10 = $ipa->TUGAS_10;

							$tugas_11 = $ipa->TUGAS_11;

							$tugas_12 = $ipa->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_ipa = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_ipa;

					}

					$rumus_ipa = ($rata2_ipa/$count_ipa);

					echo round($rumus_ipa);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 7, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 7;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 8), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				6

			</td>

			<td>Ilmu Pengetahuan Sosial ( IPS )</td>

			<td align="center"><?php $kkm = getKKM(8); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_ips = 0;

					$count_ips = 0;

					foreach($rekap_nilai as $ips){

						$count_ips++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $ips->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 8));

						// begin revisi 1 2

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $ips->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 8), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						$ips = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $ips->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 8), TRUE);

						if($ips){

							$uh_1 = $ips->UH_1;

							$uh_2 = $ips->UH_2;

							$uh_3 = $ips->UH_3;

							$tugas_1 = $ips->TUGAS_1;

							$tugas_2 = $ips->TUGAS_2;

							$tugas_3 = $ips->TUGAS_3;

							$tugas_4 = $ips->TUGAS_4;

							$tugas_5 = $ips->TUGAS_5;

							$tugas_6 = $ips->TUGAS_6;

							$tugas_7 = $ips->TUGAS_7;

							$tugas_8 = $ips->TUGAS_8;

							$tugas_9 = $ips->TUGAS_9;

							$tugas_10 = $ips->TUGAS_10;

							$tugas_11 = $ips->TUGAS_11;

							$tugas_12 = $ips->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_ips = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_ips;

					}

					$rumus_ips = ($rata2_ips/$count_ips);

					echo round($rumus_ips);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 8, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 8;$jum_all_mapel_siswa++;endif; ?>
		
		<tr valign="middle">

			<td align="center">

				7

			</td>

			<td>Muatan Lokal</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

		</tr>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 11), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Bahasa Inggris</td>

			<td align="center"><?php $kkm = getKKM(11); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_ing = 0;

					$count_ing = 0;

					foreach($rekap_nilai as $ing){

						$count_ing++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $ing->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 11));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $ing->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 11), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						

						$ing = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $ing->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 11), TRUE);

						if($ing){

							$uh_1 = $ing->UH_1;

							$uh_2 = $ing->UH_2;

							$uh_3 = $ing->UH_3;

							$tugas_1 = $ing->TUGAS_1;

							$tugas_2 = $ing->TUGAS_2;

							$tugas_3 = $ing->TUGAS_3;

							$tugas_4 = $ing->TUGAS_4;

							$tugas_5 = $ing->TUGAS_5;

							$tugas_6 = $ing->TUGAS_6;

							$tugas_7 = $ing->TUGAS_7;

							$tugas_8 = $ing->TUGAS_8;

							$tugas_9 = $ing->TUGAS_9;

							$tugas_10 = $ing->TUGAS_10;

							$tugas_11 = $ing->TUGAS_11;

							$tugas_12 = $ing->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_ing = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_ing;

					}

					$rumus_ing = ($rata2_ing/$count_ing);

					echo round($rumus_ing);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 11, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 11;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 12), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Bahasa Arab</td>

			<td align="center"><?php $kkm = getKKM(12); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_arab = 0;

					$count_arab = 0;

					foreach($rekap_nilai as $arab){

						$count_arab++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $arab->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 12));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $arab->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 12), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						$arab = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $arab->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 12), TRUE);

						if($arab){

							$uh_1 = $arab->UH_1;

							$uh_2 = $arab->UH_2;

							$uh_3 = $arab->UH_3;

							$tugas_1 = $arab->TUGAS_1;

							$tugas_2 = $arab->TUGAS_2;

							$tugas_3 = $arab->TUGAS_3;

							$tugas_4 = $arab->TUGAS_4;

							$tugas_5 = $arab->TUGAS_5;

							$tugas_6 = $arab->TUGAS_6;

							$tugas_7 = $arab->TUGAS_7;

							$tugas_8 = $arab->TUGAS_8;

							$tugas_9 = $arab->TUGAS_9;

							$tugas_10 = $arab->TUGAS_10;

							$tugas_11 = $arab->TUGAS_11;

							$tugas_12 = $arab->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_arab = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_arab;

					}

					$rumus_arab = ($rata2_arab/$count_arab);

					echo round($rumus_arab);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 12, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 12;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 13), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Teknologi Informasi dan Komunikasi<br/>( TIK )</td>

			<td align="center"><?php $kkm = getKKM(13); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_tik = 0;

					$count_tik = 0;

					foreach($rekap_nilai as $tik){

						$count_tik++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $tik->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 13));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $tik->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 13), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						$tik = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $tik->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 13), TRUE);

						if($tik){

							$uh_1 = $tik->UH_1;

							$uh_2 = $tik->UH_2;

							$uh_3 = $tik->UH_3;

							$tugas_1 = $tik->TUGAS_1;

							$tugas_2 = $tik->TUGAS_2;

							$tugas_3 = $tik->TUGAS_3;

							$tugas_4 = $tik->TUGAS_4;

							$tugas_5 = $tik->TUGAS_5;

							$tugas_6 = $tik->TUGAS_6;

							$tugas_7 = $tik->TUGAS_7;

							$tugas_8 = $tik->TUGAS_8;

							$tugas_9 = $tik->TUGAS_9;

							$tugas_10 = $tik->TUGAS_10;

							$tugas_11 = $tik->TUGAS_11;

							$tugas_12 = $tik->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_tik = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_tik;

					}

					$rumus_tik = ($rata2_tik/$count_tik);

					echo round($rumus_tik);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 13, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 13;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 10), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				8

			</td>

			<td>Pendidikan Jasmani Olahraga dan Kesehatan</td>

			<td align="center"><?php $kkm = getKKM(10); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_jasma = 0;

					$count_jasma = 0;

					foreach($rekap_nilai as $jasma){

						$count_jasma++;

						

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $jasma->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 10));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $jasma->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 10), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

					

						$jasma = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $jasma->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 10), TRUE);

						if($jasma){

							$uh_1 = $jasma->UH_1;

							$uh_2 = $jasma->UH_2;

							$uh_3 = $jasma->UH_3;

							$tugas_1 = $jasma->TUGAS_1;

							$tugas_2 = $jasma->TUGAS_2;

							$tugas_3 = $jasma->TUGAS_3;

							$tugas_4 = $jasma->TUGAS_4;

							$tugas_5 = $jasma->TUGAS_5;

							$tugas_6 = $jasma->TUGAS_6;

							$tugas_7 = $jasma->TUGAS_7;

							$tugas_8 = $jasma->TUGAS_8;

							$tugas_9 = $jasma->TUGAS_9;

							$tugas_10 = $jasma->TUGAS_10;

							$tugas_11 = $jasma->TUGAS_11;

							$tugas_12 = $jasma->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_jasma = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_jasma;

					}

					$rumus_jasma = ($rata2_jasma/$count_jasma);

					echo round($rumus_jasma);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 10, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 10;$jum_all_mapel_siswa++;endif; ?>
		<?php

			$cek_mapel = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 9), TRUE);

			if($cek_mapel):

		?>
		<tr valign="middle">

			<td align="center">

				9

			</td>

			<td>Seni Budaya dan Keterampilan</td>

			<td align="center"><?php $kkm = getKKM(9); echo $kkm; ?></td>

			<td align="center">

				<?php

					$rata2_seni = 0;

					$count_seni = 0;

					foreach($rekap_nilai as $seni){

						$count_seni++;

							

						$ul_ts = $this->walikelas_raportnilai->getNilaiUts(array('NO_SISWA' => $seni->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 9));

						$nilai_uas = $this->walikelas_raportnilai->tampilData('tbl_nilai_uas','*',array('NO_SISWA' => $seni->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 9), TRUE);

						$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;

						

						$seni = $this->walikelas_raportnilai->tampilData('tbl_nilai_mapel','*',array('NO_SISWA' => $seni->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya, 'ID_MAPEL' => 9), TRUE);

						if($seni){

							$uh_1 = $seni->UH_1;

							$uh_2 = $seni->UH_2;

							$uh_3 = $seni->UH_3;

							$tugas_1 = $seni->TUGAS_1;

							$tugas_2 = $seni->TUGAS_2;

							$tugas_3 = $seni->TUGAS_3;

							$tugas_4 = $seni->TUGAS_4;

							$tugas_5 = $seni->TUGAS_5;

							$tugas_6 = $seni->TUGAS_6;

							$tugas_7 = $seni->TUGAS_7;

							$tugas_8 = $seni->TUGAS_8;

							$tugas_9 = $seni->TUGAS_9;

							$tugas_10 = $seni->TUGAS_10;

							$tugas_11 = $seni->TUGAS_11;

							$tugas_12 = $seni->TUGAS_12;

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

						$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);

						$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);

						$rt_uu2 = ($uu_2*2);

						$rata2_seni = round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5) + $rata2_seni;

					}

					$rumus_seni = ($rata2_seni/$count_seni);

					echo round($rumus_seni);

				?>

			</td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 9, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 9;$jum_all_mapel_siswa++;endif; ?>
		<tr>

			<td></td>

			<td colspan="3"><b>Jumlah</b></td>

			<td align="center"><b>

				<?php

					$jum_all_nilai_siswa = 0;

					foreach($id_mapel_siswa_list as $rata_all_nya){

						$jum_all_nilai_siswa = round(getNilai($detail_siswa->NO_SISWA, $rata_all_nya, $semester_aktifnya)) + $jum_all_nilai_siswa;

					}

					echo $jum_all_nilai_siswa;

				?>

			</b></td>

			<td colspan="2"><b><?= ucwords($this->jariprom_tools->terbilang($jum_all_nilai_siswa)) ?></b></td>

		</tr>

		<tr>

			<td></td>

			<td colspan="3"><b>Rata - Rata</b></td>

			<td align="center"><b><?php $hayo = round($jum_all_nilai_siswa/$jum_all_mapel_siswa);echo $hayo; ?></b></td>

			<td colspan="2"><b><?= ucwords($this->jariprom_tools->terbilang($hayo)) ?></b></td>

		</tr>

		<tr>

			<td></td>

			<?php $peringkat = $this->walikelas_raportnilai->tampilData('tbl_nilai_peringkat','PERINGKAT', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_KELAS' => $detail_kelas->ID_KELAS, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL), TRUE); ?>

			<td colspan="6"><b>Bintang Mata Pelajaran : <?php echo $peringkat ? $peringkat->PERINGKAT  : '';?></b></td>

		</tr>

	</table>

	<br/>

	<?php

		$detail_absen = $this->walikelas_raportnilai->tampilData('tbl_absen','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_KELAS' => $detail_kelas->ID_KELAS, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL));

		if($detail_absen){

			$sakit = 0;

			$izin = 0;

			$alpha = 0;

			foreach($detail_absen as $jum_absen){

				for($as = 1;$as <= 31; $as++){

					if($jum_absen->{"TGL_".$as} == 2){

						$sakit = $sakit + 1;

					}

					elseif($jum_absen->{"TGL_".$as} == 3){

						$izin = $izin + 1;

					}

					elseif($jum_absen->{"TGL_".$as} == 4){

						$alpha = $alpha + 1;

					}

				}

			}

			

		}

		else{

			$sakit = 0;

			$alpha = 0;

			$izin = 0;

		}

	?>

	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="4">

		<tr>

			<th width="5%">No.</th>

			<th>Ketidakhadiran</th>

			<th>Jumlah Hari</th>

		</tr>

		<tr>

			<td align="center">

				1

			</td>

			<td>

				Sakit

			</td>

			<td align="center">

				<?= $sakit ?>

			</td>

		</tr>

		<tr>

			<td align="center">

				2

			</td>

			<td>

				Izin

			</td>

			<td align="center">

				<?= $izin ?>

			</td>

		</tr>

		<tr>

			<td align="center">

				3

			</td>

			<td>

				Tanpa Keterangan

			</td>

			<td align="center">

				<?= $alpha ?>

			</td>

		</tr>

	</table>

	*KKM : Kriteria Ketuntasan Minimal

  </section>



</body>



</html>