<?php

	function getKKM($id_mapel){

		$ci =& get_instance();

		$kkm = $ci->db->query('SELECT KKM FROM tbl_mapel WHERE ID_MAPEL='.$id_mapel)->row();

		return $kkm->KKM;

	}



 function getNilaiUtsViaQuery($a='', $b='', $c=''){return true;}



	function getNilai($no_siswa, $id_mapel, $semester_aktifnya){

		$ci =& get_instance();

		$nilai = $ci->db->query('SELECT * FROM tbl_nilai_uts WHERE ID_MAPEL='.$id_mapel.' AND NO_SISWA='.$no_siswa.' AND ID_TAHUN_PEL='.$semester_aktifnya)->row();



		if($nilai)

			return round($nilai->UTS);

		return 0;



	}



	function getRatarata($id_kelas, $id_mapel, $semester_aktifnya){

		$ci =& get_instance();

		$nilai = $ci->db->query('SELECT AVG(UTS) AS AVG FROM tbl_nilai_uts WHERE ID_MAPEL='.$id_mapel.' AND ID_KELAS='.$id_kelas.' AND ID_TAHUN_PEL='.$semester_aktifnya)->row();



		if($nilai)

			return round($nilai->AVG);



		return 0;



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

  <style>

  	table tr td th{

		font-size: 11px;

	}

  </style>

</head>



<body class="A4" onload="window.print()">

    <?php

    	$jum_all_mapel_siswa = 0;

    	$id_mapel_siswa_list = array();

    ?>

    <div style="text-align: center">

    	<img src="assets-admin/img/logo/<?= $data_infosekolah->LOGO ?>" width="130px"/>

    </div>



	<table width="100%">

		<tr>

			<td colspan="2" align="center">

				<strong>KARTU HASIL UJIAN TENGAH SEMESTER<br>TAHUN PELAJARAN <?php echo $semester_aktif->TAHUN_PEL ?></strong>

			</td>

		</tr>



		<tr>

			<td width="50%">

				<table width="100%" cellpadding="1">

					<tr align="left">

						<td width="40%">Nama Peserta Didik</td>

						<td width="2%">:</td>

						<td width="58%" <?= (strlen($detail_siswa->NAMA) >= 20 ? 'style="font-size:15px"' : '') ?>><b><?= ucwords(strtolower($detail_siswa->NAMA)) ?></b></td>

					</tr>

					<tr>

						<td>NIS / NISN</td>

						<td>:</td>

						<td><?= $detail_siswa->NIPD ?> / <?= $detail_siswa->NISN ?></td>

					</tr>

					<!--

					<tr>

						<td>Nama Sekolah</td>

						<td>:</td>

						<td><?= $data_infosekolah->NAMA_SEKOLAH ?></td>

					</tr>

					-->

				</table>

			</td>

			<td width="50%">

				<table width="100%" cellpadding="1" >

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

					<!--

					<tr>

						<td>Tahun Ajaran</td>

						<td>:</td>

						<td><?php echo $semester_aktif->TAHUN_PEL ?></td>

					</tr>

					-->

				</table>

			</td>

		</tr>

		<!--

		<tr>

			<td width="100%" colspan="2">

				<table width="100%">

						<td width="19.5%">Alamat Sekolah</td>

						<td width="1%">:</td>

						<td><?= $data_infosekolah->ALAMAT_SEKOLAH ?></td>

				</table>

			</td>

		</tr>

		-->

	</table>

	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="2">

		<tr align="center" valign="middle">

			<th rowspan="2" width="5%">No</th>

			<th rowspan="2">Mata Pelajaran</th>

			<th rowspan="2" width="10%">KKM</th>

			<th rowspan="2" width="10%">Rata-Rata Kelas</th>

			<th colspan="2">Nilai</th>

			<th rowspan="2">Catatan Guru</th>

		</tr>

		<tr>

			<th width="10%">

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

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 4), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Al-Quran dan Hadits</td>

			<td align="center"><?php $kkm = getKKM(4); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 4, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 4, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 4;$jum_all_mapel_siswa++; endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 2), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Aqidah Akhlak</td>

			<td align="center"><?php $kkm = getKKM(2); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 2, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 2, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 2;$jum_all_mapel_siswa++; endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 3), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Fiqih</td>

			<td align="center"><?php $kkm = getKKM(3); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 3, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 3, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 3;$jum_all_mapel_siswa++; endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 15), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Sejarah Kebudayan Islam ( SKI )</td>

			<td align="center"><?php $kkm = getKKM(15); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 15, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 15, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 15;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 5), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				2

			</td>

			<td>Pendidikan Kewarganegaraan (PKn)</td>

			<td align="center"><?php $kkm = getKKM(5); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 5, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 5, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 5;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 6), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				3

			</td>

			<td>Bahasa Indonesia</td>

			<td align="center"><?php $kkm = getKKM(6); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 6, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 6, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 6;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 14), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				4

			</td>

			<td>Matematika</td>

			<td align="center"><?php $kkm = getKKM(14); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 14, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 14, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 14;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 7), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				5

			</td>

			<td>Ilmu Pengetahuan Alam ( IPA )</td>

			<td align="center"><?php $kkm = getKKM(7); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 7, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 7, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 7;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 8), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				6

			</td>

			<td>Ilmu Pengetahuan Sosial ( IPS )</td>

			<td align="center"><?php $kkm = getKKM(8); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 8, $semester_aktifnya);?></td>

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

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 11), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Bahasa Inggris</td>

			<td align="center"><?php $kkm = getKKM(11); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 11, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 11, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 11;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 12), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Bahasa Arab</td>

			<td align="center"><?php $kkm = getKKM(12); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 12, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 12, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 12;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 13), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td></td>

			<td>Teknologi Informasi dan Komunikasi<br/>( TIK )</td>

			<td align="center"><?php $kkm = getKKM(13); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 13, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 13, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 13;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 10), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				8

			</td>

			<td>Pendidikan Jasmani Olahraga dan Kesehatan</td>

			<td align="center"><?php $kkm = getKKM(10); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 10, $semester_aktifnya);?></td>

			<td align="center"><?php $ab = getNilai($detail_siswa->NO_SISWA, 10, $semester_aktifnya); echo $ab; ?></td>

			<td><?= ucwords($this->jariprom_tools->terbilang($ab)) ?></td>

			<td><?php if($ab >= $kkm) echo 'Tuntas';else echo 'Tidak Tuntas'; ?></td>

		</tr>

		<?php $id_mapel_siswa_list[] = 10;$jum_all_mapel_siswa++;endif; ?>

		<?php

			$cek_mapel = $this->walikelas_raportuts->tampilData('tbl_nilai_uts','*', array('ID_KELAS' => $detail_siswa->ID_KELAS, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => 9), TRUE);

			if($cek_mapel):

		?>

		<tr valign="middle">

			<td align="center">

				9

			</td>

			<td>Seni Budaya dan Ketrampilan</td>

			<td align="center"><?php $kkm = getKKM(9); echo $kkm; ?></td>

			<td align="center"><?php echo getRatarata($detail_siswa->ID_KELAS, 9, $semester_aktifnya);?></td>

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

			<td align="center"><b><?php $hayo = ($jum_all_mapel_siswa != 0) ? round($jum_all_nilai_siswa/$jum_all_mapel_siswa) : 0;echo $hayo; ?></b></td>

			<td colspan="2"><b><?= ucwords($this->jariprom_tools->terbilang($hayo)) ?></b></td>

		</tr>

		<!--

		<tr>

			<td></td>

			<td colspan="6"><b>Bintang Mata Pelajaran : <?php echo $peringkat ? $peringkat->PERINGKAT  : '';?></b></td>

		</tr>

	-->

	</table>

    <!--

	<br/>

	<?php

		$detail_absen = $this->walikelas_raportuts->tampilData('tbl_absen','*', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_KELAS' => $detail_kelas->ID_KELAS, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL));

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

	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="2">

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

	-->

    *KKM : Kriteria Ketuntasan Minimal

  </section>













  <section class="sheet" style="page-break-inside:avoid;padding-top: 50px;padding-left: 20px;padding-right: 20px;padding-bottom: 20px;">



	<?php $count_all_pembi = 6; ?>



	<h4 style="text-align: center">LAPORAN HASIL PENGEMBANGAN DIRI DAN PEMBIASAAN</h4>



	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="2">

		<tr align="center" valign="middle">

			<th rowspan="2" width="5%">No</th>

			<th rowspan="2" width="25%">Praktik dan Hapalan</th>

			<th colspan="3">Nilai</th>

			<th rowspan="2">Keterangan</th>

		</tr>

		<tr>

			<th width="12%">

				Rata-Rata<br/>Kelas

			</th>

			<th>

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

			<td>Ibadah</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

		</tr>

		<tr>

			<td></td>

			<td>a. Wudhu</td>

			<td align="center">

				<?php

					$rata2_wudhu = 0;

					$count_wudhu = 0;

					foreach($rekap_nilai as $wudu){

						$count_wudhu++;

						$wudu = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','WUDHU',array('NO_SISWA' => $wudu->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($wudu){

							$rata2_wudhu = $rata2_wudhu + $wudu->WUDHU;

						}

						else{

							$rata2_wudhu = $rata2_wudhu + 0;

						}

					}

					$rumus_wudhu = ($rata2_wudhu/$count_wudhu);

					echo round($rumus_wudhu);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->WUDHU ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->WUDHU)) ?>

			</td>

			<td></td>

		</tr>

		<tr>

			<td></td>

			<td>b. Sholat</td>

			<td align="center">

				<?php

					$rata2_sholat = 0;

					$count_sholat = 0;

					foreach($rekap_nilai as $sholat){

						$count_sholat++;

						$sholat = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','SHOLAT',array('NO_SISWA' => $sholat->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($sholat){

							$rata2_sholat = $rata2_sholat + $sholat->SHOLAT;

						}

						else{

							$rata2_sholat = $rata2_sholat + 0;

						}

					}

					$rumus_sholat = ($rata2_sholat/$count_sholat);

					echo round($rumus_sholat);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->SHOLAT ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->SHOLAT)) ?>

			</td>

			<td></td>

		</tr>

		<tr valign="middle">

			<td align="center">

				2

			</td>

			<td>TTQ</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

		</tr>

		<tr>

			<td></td>

			<td>a. Tahsin</td>

			<td align="center">

				<?php

					$rata2_tahsin = 0;

					$count_tahsin = 0;

					foreach($rekap_nilai as $tahsin){

						$count_tahsin++;

						$tahsin = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','TAHSIN',array('NO_SISWA' => $tahsin->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($tahsin){

							$rata2_tahsin = $rata2_tahsin + $tahsin->TAHSIN;

						}

						else{

							$rata2_tahsin = $rata2_tahsin + 0;

						}

					}

					$rumus_tahsin = ($rata2_tahsin/$count_tahsin);

					echo round($rumus_tahsin);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->TAHSIN ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->TAHSIN)) ?>

			</td>

			<td></td>

		</tr>

		<tr>

			<td></td>

			<td>b. Tahfidz Quran</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

		</tr>

		<?php

			$cek_surah_1 = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','NAMA_SURAH, TAHFIDZH',array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

			if(@$cek_surah_1->NAMA_SURAH != '' && @$cek_surah_1->TAHFIDZH):

		?>

		<tr>

			<td></td>

			<td><?= $cek_surah_1->NAMA_SURAH ?></td>

			<td align="center">

				<?php

					$rata2_tahfidzh = 0;

					$count_tahfidzh = 0;

					foreach($rekap_nilai as $tahfidzh){

						$count_tahfidzh++;

						$tahfidzh = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','TAHFIDZH',array('NO_SISWA' => $tahfidzh->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($tahfidzh){

							$rata2_tahfidzh = $rata2_tahfidzh + $tahfidzh->TAHFIDZH;

						}

						else{

							$rata2_tahfidzh = $rata2_tahfidzh + 0;

						}

					}

					$rumus_tahfidzh = ($rata2_tahfidzh/$count_tahfidzh);

					echo round($rumus_tahfidzh);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->TAHFIDZH ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->TAHFIDZH)) ?>

			</td>

			<td></td>

		</tr>

		<?php $count_all_pembi++;endif; ?>

		<?php

			$cek_surah_2 = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','NAMA_SURAH_2, TAHFIDZH_2',array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

			if(@$cek_surah_2->NAMA_SURAH_2 != '' && @$cek_surah_2->TAHFIDZH_2):

		?>

		<tr>

			<td></td>

			<td><?= $cek_surah_2->NAMA_SURAH_2 ?></td>

			<td align="center">

				<?php

					$rata2_tahfidzh_2 = 0;

					$count_tahfidzh_2 = 0;

					foreach($rekap_nilai as $tahfidzh_2){

						$count_tahfidzh_2++;

						$tahfidzh_2 = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','TAHFIDZH_2',array('NO_SISWA' => $tahfidzh_2->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($tahfidzh_2){

							$rata2_tahfidzh_2 = $rata2_tahfidzh_2 + $tahfidzh_2->TAHFIDZH_2;

						}

						else{

							$rata2_tahfidzh_2 = $rata2_tahfidzh_2 + 0;

						}

					}

					$rumus_tahfidzh_2 = ($rata2_tahfidzh_2/$count_tahfidzh_2);

					echo round($rumus_tahfidzh_2);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->TAHFIDZH_2 ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->TAHFIDZH_2)) ?>

			</td>

			<td></td>

		</tr>

		<?php $count_all_pembi++;endif; ?>

		<tr valign="middle">

			<td align="center">

				3

			</td>

			<td>Hafalan</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

		</tr>

		<tr>

			<td></td>

			<td>a. Surat Pendek</td>

			<td align="center">

				<?php

					$rata2_surat_pendek = 0;

					$count_surat_pendek = 0;

					foreach($rekap_nilai as $surat_pendek){

						$count_surat_pendek++;

						$surat_pendek = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','SURAT_PENDEK',array('NO_SISWA' => $surat_pendek->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($surat_pendek){

							$rata2_surat_pendek = $rata2_surat_pendek + $surat_pendek->SURAT_PENDEK;

						}

						else{

							$rata2_surat_pendek = $rata2_surat_pendek + 0;

						}

					}

					$rumus_surat_pendek = ($rata2_surat_pendek/$count_surat_pendek);

					echo round($rumus_surat_pendek);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->SURAT_PENDEK ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->SURAT_PENDEK)) ?>

			</td>

			<td></td>

		</tr>

		<tr>

			<td></td>

			<td>b. Hadits</td>

			<td align="center">

				<?php

					$rata2_hadits = 0;

					$count_hadits = 0;

					foreach($rekap_nilai as $hadits){

						$count_hadits++;

						$hadits = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','HADITS',array('NO_SISWA' => $hadits->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($hadits){

							$rata2_hadits = $rata2_hadits + $hadits->HADITS;

						}

						else{

							$rata2_hadits = $rata2_hadits + 0;

						}

					}

					$rumus_hadist = ($rata2_hadits/$count_hadits);

					echo round($rumus_hadist);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->HADITS ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->HADITS)) ?>

			</td>

			<td></td>

		</tr>

		<tr>

			<td></td>

			<td>c. Doa Harian</td>

			<td align="center">

				<?php

					$rata2_doa = 0;

					$count_doa = 0;

					foreach($rekap_nilai as $doa){

						$count_doa++;

						$doa = $this->walikelas_raportuts->tampilData('tbl_nilai_pembiasaan_uts','DOA',array('NO_SISWA' => $doa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

						if($doa){

							$rata2_doa = $rata2_doa + $doa->DOA;

						}

						else{

							$rata2_doa = $rata2_doa + 0;

						}

					}

					$rumus_doa = ($rata2_doa/$count_doa);

					echo round($rumus_doa);

				?>

			</td>

			<td align="center">

				<?= @$detail_nilai->DOA ?>

			</td>

			<td>

				<?= ucwords($this->jariprom_tools->terbilang(@$detail_nilai->DOA)) ?>

			</td>

			<td></td>

		</tr>

		<tr>

			<td></td>

			<td colspan="2"><b>Jumlah</b></td>

			<td align="center"><b>

				<?php

					$rata_all_nya = round(@$detail_nilai->DOA) + round(@$detail_nilai->HADITS) + round(@$detail_nilai->SURAT_PENDEK) + round(@$detail_nilai->TAHSIN) + round(@$detail_nilai->SHOLAT) + round(@$detail_nilai->WUDHU);

					if(@$cek_surah_1->NAMA_SURAH != '' && @$cek_surah_1->TAHFIDZH){

						$rata_all_nya = $rata_all_nya + round($cek_surah_1->TAHFIDZH);

					}

					if(@$cek_surah_2->NAMA_SURAH_2 != '' && @$cek_surah_2->TAHFIDZH_2){

						$rata_all_nya = $rata_all_nya + round($cek_surah_2->TAHFIDZH_2);

					}

					echo $rata_all_nya

				?>



				</b></td>

			<td colspan="2"><b><?= ucwords($this->jariprom_tools->terbilang($rata_all_nya)) ?></b></td>

		</tr>

		<tr>

			<td></td>

			<td colspan="2"><b>Rata-Rata</b></td>

			<td align="center"><b><?php $hayo = round($rata_all_nya/$count_all_pembi);echo $hayo; ?></b></td>

			<td colspan="2"><b><?= ucwords($this->jariprom_tools->terbilang($hayo)) ?></b></td>

		</tr>

	<!--

		<tr>

			<td></td>

			<td colspan="2"><b>Predikat</b></td>

			<td align="center"><b>

				<?php

				$nilaihuruf = '';

				if (($hayo >= 80) && ($hayo <= 100))

				{

				$nilaihuruf = "A";

				}

				else if (($hayo >= 70) && ($hayo <= 79))

				{

				$nilaihuruf = "B";

				}

				else if (($hayo >= 60) && ($hayo <= 69))

				{

				$nilaihuruf = "C";

				}

				else if (($hayo >= 50) && ($hayo <= 59))

				{

				$nilaihuruf = "D";

				}

				echo $nilaihuruf;

			?>

			</b></td>



			<td colspan="2"><b><?= ($nilaihuruf == 'A' ? 'Sangat Baik' : ($nilaihuruf == 'B' ? 'Baik' : ($nilaihuruf == 'C' ? 'Cukup' : ($nilaihuruf == 'D' ? 'Kurang' : '')))) ?></b></td>

		</tr>



		<tr>

			<td></td>

			<td colspan="6"><b>Bintang Mata Pelajaran : <?php echo $peringkat ? $peringkat->PERINGKAT  : '';?></b></td>

		</tr>

	-->

	</table>

	<br/>

	<!--

	<table style="border-collapse: collapse;margin-bottom: 30px" border="1" width="100%" cellpadding="1">

		<tr>

			<td>

				<h4 style="margin: 0">CATATAN</h4><br/>

				<?= $detail_nilai->CATATAN ?>

			</td>

		</tr>

	</table>

	-->

	<table width="100%" style="padding: 50px 100px 30px 0px;">

		<tr>

			<td align="right">

				Diberikan di : Lubuklinggau<br/>

				Tanggal : <?= $this->jariprom_tools->tglIndo( (isset($_GET['print-date']) ? date('Y-m-d', strtotime($_GET['print-date'])) : date('Y-m-d')) ) ?>

			</td>

		</tr>

	</table>

	<table width="100%">

		<tr>

			<td width="50%" align="center">

				Mengetahui<br/>Orang Tua / Wali,<br/><br/><br/><br/><br/>

				<b><?= ucwords(strtolower($detail_siswa->NAMA_AYAH)) ?></b>

			</td>

			<td width="50%" align="center">
				<br/><br/>
				<?php
					if($detail_walikelas->FOTO_TTD == null):
				?>
				Guru Kelas<br/><br/><br/><br/><br/><br/>
				<?php else: ?>
				Guru Kelas<br/><img style="margin-bottom:10px" src="assets-admin/img/ttd_guru/<?= $detail_walikelas->FOTO_TTD ?>" width="130px"/><br/>
				<?php endif; ?>

				<b><?= ucwords(strtolower($detail_walikelas->NAMA)) ?></b><br/>

				<b>NRP <?= ucwords(strtolower($detail_walikelas->NUPTK)) ?></b>

			</td>

		</tr>

	</table>



</body>



</html>
