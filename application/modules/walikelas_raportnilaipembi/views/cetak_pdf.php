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

    table tr {line-height: 16px;}

    table tr td {

		font-size: 15px;

		padding: 2px 5px;

	}

	table tr th {

		font-size: 15px;

	}

  </style>

</head>



<body class="A4" onload="window.print()">

	<?php

		$count_all_pembi = 6;

	?>

  <section class="sheet padding-10mm">



    <!-- Write HTML just like a web page -->

    <div style="text-align: center">

    	<img src="assets-admin/img/logo/<?= $data_infosekolah->LOGO ?>" width="130px"/>

    </div>

	<table width="100%">

		<tr>

			<td width="50%">

				<table width="100%" cellpadding="1">

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
					<tr>
						<td width="19.5%">Alamat Sekolah</td>

						<td width="1%">:</td>

						<td><?= $data_infosekolah->ALAMAT_SEKOLAH ?></td>

					</tr>

				</table>

			</td>

		</tr>

	</table>

	<?php



	?>

	<h4 style="text-align: center; margin: 5px 0px;">LAPORAN HASIL PENGEMBANGAN DIRI DAN PEMBIASAAN</h4>

	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="4">

		<tr align="center" valign="middle">

			<th rowspan="2">No</th>

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

						$wudu = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','WUDHU',array('NO_SISWA' => $wudu->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

						$sholat = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','SHOLAT',array('NO_SISWA' => $sholat->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

						$tahsin = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','TAHSIN',array('NO_SISWA' => $tahsin->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

			$cek_surah_1 = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','NAMA_SURAH, TAHFIDZH',array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

						$tahfidzh = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','TAHFIDZH',array('NO_SISWA' => $tahfidzh->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

			$cek_surah_2 = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','NAMA_SURAH_2, TAHFIDZH_2',array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

						$tahfidzh_2 = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','TAHFIDZH_2',array('NO_SISWA' => $tahfidzh_2->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

						$surat_pendek = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','SURAT_PENDEK',array('NO_SISWA' => $surat_pendek->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

						$hadits = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','HADITS',array('NO_SISWA' => $hadits->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

						$doa = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','DOA',array('NO_SISWA' => $doa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktifnya), TRUE);

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

		<tr>

			<td></td>

			<td colspan="2"><b>Predikat</b></td>

			<td align="center"><b>

				<?php

				$nilaihuruf = '';

				if (($hayo >= 90) && ($hayo <= 100))

				{

				$nilaihuruf = "A";

				}

				else if (($hayo >= 80) && ($hayo <= 89))

				{

				$nilaihuruf = "B";

				}

				else if (($hayo >= 70) && ($hayo <= 79))

				{

				$nilaihuruf = "C";

				}

				else if (($hayo >= 60) && ($hayo <= 79))

				{

				$nilaihuruf = "D";

				}
				else{
					$nilaihuruf = "E";
				}

				echo $nilaihuruf;

			?>

			</b></td>



			<td colspan="2"><b><?= ($nilaihuruf == 'A' ? 'Sangat Baik' : ($nilaihuruf == 'B' ? 'Baik' : ($nilaihuruf == 'C' ? 'Cukup' : ($nilaihuruf == 'D' ? 'Kurang' : '')))) ?></b></td>

		</tr>

		<!--<tr>

			<td></td>

			<?php $peringkat = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_peringkat','PERINGKAT', array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_KELAS' => $detail_kelas->ID_KELAS, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL), TRUE); ?>

			<td colspan="6"><b>Bintang Mata Pelajaran : <?php echo $peringkat ? $peringkat->PERINGKAT  : '';?></b></td>

		</tr>-->

	</table>

	<br/>

	<table style="border-collapse: collapse;margin-bottom: 30px" border="1" width="100%" cellpadding="4">

		<tr>

			<td>

				<h4 style="margin: 0">CATATAN</h4>

				<?= $detail_nilai->CATATAN ?>

			</td>

		</tr>

	</table>

	<table width="100%" style="margin-bottom: 30px">

		<tr>

			<td style="padding-left: 380px;">

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diberikan di : Lubuklinggau<br/>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $this->jariprom_tools->tglIndo( (isset($_GET['print-date']) ? date('Y-m-d', strtotime($_GET['print-date'])) : date('Y-m-d')) ) ?>&nbsp;&nbsp;

			</td>

		</tr>

	</table>

	<table width="100%">

		<tr>

			<td width="50%" align="center">

			Mengetahui<br/>Orang Tua / Wali,<br/><br/><br/><br/><br/>

				<b><span style="text-decoration: underline">

					<?php

					echo (isset($detail_siswa->NAMA_AYAH) && $detail_siswa->NAMA_AYAH !='')

						? ucwords(strtolower($detail_siswa->NAMA_AYAH))

						: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'

					?>

				</span></b>

				<br/>

				<br/>

				<br/>

			</td>

			<td width="50%" align="center">
				<?php
					if($detail_walikelas->FOTO_TTD == null):
				?>
				Wali Kelas<br/><br/><br/><br/><br/>
				<?php else: ?>
				Wali Kelas<br/><img src="assets-admin/img/ttd_guru/<?= $detail_walikelas->FOTO_TTD ?>" width="130px"/><br/>
				<?php endif; ?>
				<b><span style="text-decoration: underline;"><?= ucwords(strtolower($detail_walikelas->NAMA)) ?></span></b><br/>

				<b>NRP <?= ucwords(strtolower($detail_walikelas->NUPTK)) ?></b>

			</td>

		</tr>

	</table>



  </section>



</body>



</html>
