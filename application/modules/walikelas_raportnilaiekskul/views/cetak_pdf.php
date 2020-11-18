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

		padding: 2px 5px;

	}

	table tr th {

		font-size: 15px;

	}

  </style>

</head>



<body class="A4" onload="window.print()">



  <section class="sheet padding-10mm">



    <!-- Write HTML just like a web page -->

    <div style="text-align: center">

    	<img src="<?= base_url('assets-admin/img/logo/'.$data_infosekolah->LOGO) ?>" width="130px"/>

    </div>

	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="4">

		<tr>

			<th colspan="6">Kegiatan Intrakurikuler / Ekstrakurikuler</th>

		</tr>

		<tr>

			<th>No</th>

			<th>Jenis Kegiatan</th>

			<th>Nilai</th>

			<th>No</th>

			<th>Jenis Kegiatan</th>

			<th>Nilai</th>

		</tr>

		<tr>

			<td align="center">1</td>

			<td>Pramuka</td>

			<td align="center"><?= $detail_nilai->PRAMUKA ?></td>

			<td align="center">8</td>

			<td>English Club</td>

			<td align="center"><?= $detail_nilai->ENGLISH_CLUB ?></td>

		</tr>

		<tr>

			<td align="center">2</td>

			<td>Hadroh</td>

			<td align="center"><?= $detail_nilai->TAHFIDZH ?></td>

			<td align="center">9</td>

			<td>Science Club</td>

			<td align="center"><?= $detail_nilai->SCIENCE ?></td>

		</tr>

		<tr>

			<td align="center">3</td>

			<td>Badminton</td>

			<td align="center"><?= $detail_nilai->BADMINTON ?></td>

			<td align="center">10</td>
            <td>Archery Club</td>

			<td align="center"><?= $detail_nilai->ARCHERY_CLUB ?></td>

		</tr>

		<tr>

			<td align="center">4</td>

			<td>Futsal</td>

			<td align="center"><?= $detail_nilai->FUTSAL ?></td>

			<td align="center">11</td>
            <td>Arabic Club</td>

			<td align="center"><?= $detail_nilai->ARABIC_CLUB ?></td>

		</tr>

		<tr>

			<td align="center">5</td>

			<td>Karate</td>

			<td align="center"><?= $detail_nilai->SILAT ?></td>

			<td align="center">12</td>

            <td>Theater Club</td>

			<td align="center"><?= $detail_nilai->THEATER_CLUB ?></td>

		</tr>

        <tr>

			<td align="center">6</td>

			<td>Seni Tari Kreasi</td>

			<td align="center"><?= $detail_nilai->TARI_KREASI?></td>

			<td align="center">13</td>

            <td>Seni Lukis</td>

            <td align="center"><?= $detail_nilai->LUKIS_KALIGRAFI ?></td>

		</tr>

        <tr>

			<td align="center">7</td>

			<td>Marching Band</td>

			<td align="center"><?= $detail_nilai->MARCHING_BAND ?></td>

			<td align="center"></td>

			<td></td>

			<td align="center"></td>

		</tr>

	</table>

	<br/>

	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="4">

		<tr>

			<th colspan="3">Akhlak / Character Building</th>

		</tr>

		<tr>

			<th>No</th>

			<th>Aspek yang Dinilai</th>

			<th>Nilai</th>

		</tr>

		<tr>

			<td align="center">1</td>

			<td>Kedisiplinan</td>

			<td align="center"><?= $detail_nilai->KEDISIPLINAN ?></td>

		</tr>

		<tr>

			<td align="center">2</td>

			<td>Kebersihan</td>

			<td align="center"><?= $detail_nilai->KEBERSIHAN ?></td>

		</tr>

		<tr>

			<td align="center">3</td>

			<td>Kerapian</td>

			<td align="center"><?= $detail_nilai->KERAPIAN ?></td>

		</tr>

		<tr>

			<td align="center">4</td>

			<td>Tanggung Jawab</td>

			<td align="center"><?= $detail_nilai->TANGGUNG_JAWAB ?></td>

		</tr>

		<tr>

			<td align="center">5</td>

			<td>Sopan Santun</td>

			<td align="center"><?= $detail_nilai->SOPAN_SANTUN ?></td>

		</tr>

		<tr>

			<td align="center">6</td>

			<td>Kompetitif</td>

			<td align="center"><?= $detail_nilai->KOMPETITIF ?></td>

		</tr>

		<tr>

			<td align="center">7</td>

			<td>Hubungan Sosial</td>

			<td align="center"><?= $detail_nilai->HUBUNGAN_SOSIAL ?></td>

		</tr>

		<tr>

			<td align="center">8</td>

			<td>Kejujuran</td>

			<td align="center"><?= $detail_nilai->KEJUJURAN ?></td>

		</tr>

		<tr>

			<td align="center">9</td>

			<td>Kemandirian</td>

			<td align="center"><?= $detail_nilai->KEMANDIRIAN ?></td>

		</tr>

		<tr>

			<td align="center">10</td>

			<td>Pelaksanaan Ibadah Ritual</td>

			<td align="center"><?= $detail_nilai->PELAKSANAAN_IBADAH_RITUAL ?></td>

		</tr>

	</table>



	<table width="100%">

		<tr>

			<td>Keterangan : </td>

			<td>A : Sangat Baik</td>

			<td>B : Baik</td>

			<td>C : Cukup</td>

			<td>D : Kurang</td>

		</tr>

	</table>



	<table style="margin-top: 5px; margin-bottom: 10px; border-collapse: collapse;" border="1" width="100%" cellpadding="4">

		<tr>

			<td>

				<h4 style="margin: 0">CATATAN</h4>

				<ol style="margin:0">

					<?php if($detail_nilai->CATATAN_1 != ''): ?>

					<li><?= $detail_nilai->CATATAN_1 ?></li>

					<?php endif; ?>

					<?php if($detail_nilai->CATATAN_2 != ''): ?>

					<li><?= $detail_nilai->CATATAN_2 ?></li>

					<?php endif; ?>

					<?php if($detail_nilai->CATATAN_3 != ''): ?>

					<li><?= $detail_nilai->CATATAN_3 ?></li>

					<?php endif; ?>

					<?php if($detail_nilai->CATATAN_4 != ''): ?>

					<li><?= $detail_nilai->CATATAN_4 ?></li>

					<?php endif; ?>

				</ol>

			</td>

		</tr>

	</table>



	<?php if($semester_aktif->SEMESTER == 1){ ?>

	<table width="100%" style="margin-bottom: 20px">

		<tr>

			<td  style="padding-left: 400px;">

				Diberikan di &nbsp;: Lubuklinggau<br/>

				Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $this->jariprom_tools->tglIndo( (isset($_GET['print-date']) ? date('Y-m-d', strtotime($_GET['print-date'])) : date('Y-m-d')) ) ?>&nbsp;&nbsp;

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

				Wali Kelas<br/><br/><br/><br/><br/>

				<b><span style="text-decoration: underline;"><?= ucwords(strtolower($detail_walikelas->NAMA)) ?></span></b><br/>

				<b>NRP <?= ucwords(strtolower($detail_walikelas->NUPTK)) ?></b>

			</td>

		</tr>

	</table>

	<?php } else { ?>

	<table width="100%">

		<tr>

			<td width="30%" align="center" valign="bottom">

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

			</td>

			<td width="30%" align="center" valign="bottom">

				Wali Kelas<br/><br/><br/><br/><br/>

				<b><span style="text-decoration: underline;"><?= ucwords(strtolower($detail_walikelas->NAMA)) ?></span></b><br/>

				<b>NRP <?= ucwords(strtolower($detail_walikelas->NUPTK)) ?></b>

			</td>

			<td width="40%" align="left" style="border:1px solid black; padding: 5px;">

				Keputusan:<br>

				Berdasarkan hasil yang telah dicapai pada semester 1 dan 2, maka peserta didik ini ditetapkan:<br/>

				<div style="height: 10px;">&nbsp;</div>

				Naik Kelas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ___  ____<br>

				Tinggal di kelas &nbsp;&nbsp;&nbsp;&nbsp;: ___  ____<br>

				<div style="height: 20px;">&nbsp;</div>
				Lubuklinggau, <?= $this->jariprom_tools->tglIndo( (isset($_GET['print-date']) ? date('Y-m-d', strtotime($_GET['print-date'])) : date('Y-m-d')) ) ?><br>
                <?php
					if($detail_kepsek->FOTO_TTD == null):
				?>
                Kepala Sekolah,<br><br><br><br>
                <?php else: ?>
                Kepala Sekolah,<br/><img src="assets-admin/img/ttd_guru/<?=@ $detail_kepsek->FOTO_TTD ?>" width="130px"/><br/>
                <?php endif; ?>
				<b><span style="text-decoration: underline"><?= ucwords(strtolower(@$detail_kepsek->NAMA)) ?></span></b><br/>

				<b>NRP <?= ucwords(strtolower(@$detail_kepsek->NUPTK)) ?></b>

			</td>

		</tr>

	</table>

	<?php } ?>

  </section>



</body>



</html>
