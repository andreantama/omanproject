<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="utf-8">

  <title>Format K13</title>
<link rel="stylesheet" href="<?= base_url('assets-admin/bootstrap/css/print.css') ?>">
  <!-- Load paper.css for happy printing -->



  <!-- Set page size here: A5, A4 or A3 -->

  <!-- Set also "landscape" if you need -->

  <style>@page { size: A4 }

  	table tr td {

		font-size: 15px;

	}

	table tr th {

		font-size: 15px;

	}
	h3{margin:0;padding:0 0 5px 0;line-height:17px;}

  </style>

</head>

<!--window.print()-->

<body class="A4" onload="" style="padding-top: 10px;padding-left: 20px;padding-right: 20px;padding-bottom: 10px;">
<section class="sheet" style="padding-top: 10px;padding-left: 20px;padding-right: 20px;padding-bottom: 10px;">
	<?php

		$count_all_pembi = 6;

	?>

  



    <!-- Write HTML just like a web page -->
    <div style="float:right;position:absolute;top:0;right:0;padding:5px;">K13</div>
    <div style="text-align: center">

    	<img src="<?= base_url('assets-admin/img/logo/'.$data_infosekolah->LOGO) ?>" width="130px"/>

    </div>
    <!--
	<table  width="100%" style="margin-bottom: 0px;border: 1px solid black;padding:10px;">

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

						<td width="19.5%">Alamat Sekolah</td>

						<td width="1%">:</td>

						<td><?= $data_infosekolah->ALAMAT_SEKOLAH ?></td>

				</table>

			</td>

		</tr>

	</table>
-->

    <h3>A. SIKAP<br>
	<small>1. Sikap Spiritual</small></h3>
    <table style="border-collapse: collapse;margin-bottom:10px;" border="1" width="100%" cellpadding="2">
        <tr valign="middle">
			<td align="center" width="15%">
				<strong>Predikat</strong>
			</td>
			<td align="center">
			    <strong>Deskripsi</strong>
			</td>
		</tr>
		<tr valign="top">
			<td align="center">
				<?php
				$sumA = $this->db->query('SELECT ((WUDHU+SHOLAT+TAHSIN+SURAT_PENDEK+HADITS+DOA+TAHFIDZH+TAHFIDZH_2)/8) as TotalNil FROM tbl_nilai_pembiasaan WHERE NO_SISWA="'.$detail_siswa->NO_SISWA.'" AND ID_TAHUN_PEL="'.$semester_aktif->ID_TAHUN_PEL.'"')->result();
				 foreach($sumA as $totA){
				     if($totA->TotalNil<50){
				         $Ket='Ananda '.ucwords(strtolower($detail_siswa->NAMA)).' Buruk dalam Sikap Spiritual.<br>';
				         echo 'Buruk';
				     }elseif($totA->TotalNil>=51 && $totA->TotalNil<=60){
				         $Ket='Ananda '.ucwords(strtolower($detail_siswa->NAMA)).' Kurang Memiliki Sikap Spiritual.<br>';
				         echo 'Kurang';
				     }elseif($totA->TotalNil>=61 && $totA->TotalNil<=75){
				         $Ket='Ananda '.ucwords(strtolower($detail_siswa->NAMA)).' Cukup Memiliki Sikap Spiritual.<br>';
				         echo 'Cukup';
				     }elseif($totA->TotalNil>=76 && $totA->TotalNil<=90){
				         $Ket='Alhamdulillah Ananda '.ucwords(strtolower($detail_siswa->NAMA)).' Memiliki Sikap Spiritual yang Baik.<br>';
				         echo 'Baik';
				     }elseif($totA->TotalNil>=91){
				         $Ket='Alhamdulillah Ananda '.ucwords(strtolower($detail_siswa->NAMA)).' Memiliki Sikap Spiritual yang Sangat Baik.<br>';
				         echo 'Sangat Baik';
				     }
				 }
				?>
			</td>
			<td align="left">
				<?php
				$descA = $this->db->query('SELECT CATATAN FROM tbl_nilai_pembiasaan WHERE NO_SISWA="'.$detail_siswa->NO_SISWA.'" AND ID_TAHUN_PEL="'.$semester_aktif->ID_TAHUN_PEL.'"')->result();
				 foreach($descA as $rdescA){
				     echo $Ket . $rdescA->CATATAN;
				 }
				?>
			</td>
		</tr>
    </table>
    
    <h3><small>2. Sikap Sosial</small></h3>
    
    <table style="border-collapse: collapse;margin-bottom:10px;" border="1" width="100%" cellpadding="2">
       <tr valign="middle">
			<td align="center" width="15%">
				<strong>Predikat / Deskripsi</strong>
			</td>
		</tr>
		<tr valign="top">
			<td align="left">
				<?php
				$descB = $this->db->query('SELECT CATATAN_1,CATATAN_2,CATATAN_3,CATATAN_4 FROM tbl_ekskul_akhlak WHERE NO_SISWA="'.$detail_siswa->NO_SISWA.'" AND ID_TAHUN_PEL="'.$semester_aktif->ID_TAHUN_PEL.'"')->result();
				 foreach($descB as $rdescB){
				     if($rdescB->CATATAN_1!=""){
				         echo ucwords($rdescB->CATATAN_1).'<br>';
				     }
				     if($rdescB->CATATAN_2!=""){
				         echo ucwords($rdescB->CATATAN_2).'<br>';
				     }
				     if($rdescB->CATATAN_3!=""){
				         echo ucwords($rdescB->CATATAN_3).'<br>';
				     }
				     if($rdescB->CATATAN_4!=""){
				         echo ucwords($rdescB->CATATAN_4).'<br>';
				     }
				 }
				?>
			</td>
		</tr>
    </table>
    <br>
    <h3>B. PENGETAHUAN DAN KETERAMPILAN</h3>
	<table style="border-collapse: collapse" border="1" width="100%" cellpadding="1">

		<tr align="center" valign="middle">

			<th rowspan="2">No</th>

			<th rowspan="2" width="35%">Muatan Pelajaran</th>
			<th rowspan="2">KKM</th>

			<th colspan="3">Pengetahuan</th>

			<th colspan="3">Keterampilan</th>

		</tr>

		<tr>

			<th>

			Nilai

			</th>

			<th>

				Predikat

			</th>

			<th>

				Deskripsi

			</th>
            <th>

			Nilai

			</th>

			<th>

				Predikat

			</th>

			<th>

				Deskripsi

			</th>
		</tr>
    
        <?php
        $sql = $this->db->query('SELECT * FROM tbl_mapel WHERE JNS_MAPEL="PAI"')->result();
        ?>
        <tr valign="middle">
			<td align="center" valign="top" rowspan="<?php echo (count($sql)+1);?>">1</td>
			<td colspan="8">Pendidikan Agama Islam</td>
		</tr>
		<?php
		    
		    foreach($sql as $key){
		        $ul_ts = $this->Walikelas_raportk13->getNilaiUts(array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => $key->ID_MAPEL));
				$nilai_uas = $this->Walikelas_raportk13->tampilData('tbl_nilai_uas','*', array('ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_MAPEL' => $key->ID_MAPEL), TRUE);
				$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;
				$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;
			
				$detail_nilai = $this->Walikelas_raportk13->tampilData('tbl_nilai_mapel','*', array('ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_MAPEL' => $key->ID_MAPEL), TRUE);
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
				$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);
				$rt_uu2 = ($uu_2*2);
				$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);
				$NilRaport=round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5);
		        ?>
		        <tr valign="middle">

			        <td><?php echo $key->MAPEL;?></td>
        
        			<td align="center"><?php echo $key->KKM;?></td>
        
        			<td align="center"><?php if($NilRaport<=0) echo '-'; else $NilRaport;?></td>
        
        			<td align="center"><?php if($NilRaport<=0) {echo '-'; $des='-';}
        			else {
        			    if($NilRaport<50){
        			        $des='Sangat Buruk';
    				         echo 'E';
    				     }elseif($NilRaport>=51 && $NilRaport<=60){
    				         $des='Buruk';
    				         echo 'D';
    				     }elseif($NilRaport>=61 && $NilRaport<=75){
    				         $des='Cukup';
    				         echo 'C';
    				     }elseif($NilRaport>=76 && $NilRaport<=90){
    				         $des='Baik';
    				         echo 'B';
    				     }elseif($NilRaport>=91){
    				         $des='Sangat Baik';
    				         echo 'A';
    				     }
    				     
        			}?></td>
        
        			<td align="center"><?php echo $des;?></td>
        
        		</tr>
		        <?php 
			}
				
		?>
		<?php
        $sqlpu = $this->db->query('SELECT * FROM tbl_mapel WHERE JNS_MAPEL="PU"')->result();
        $nom=1;
		    foreach($sqlpu as $keypu){
		        $nom++;
		        $ul_ts = $this->Walikelas_raportk13->getNilaiUts(array('NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'ID_MAPEL' => $keypu->ID_MAPEL));
				$nilai_uas = $this->Walikelas_raportk13->tampilData('tbl_nilai_uas','*', array('ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_MAPEL' => $keypu->ID_MAPEL), TRUE);
				$uas = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;
				$uu_2 = (isset($nilai_uas->UAS)) ? $nilai_uas->UAS : 0;
			
				$detail_nilai = $this->Walikelas_raportk13->tampilData('tbl_nilai_mapel','*', array('ID_TAHUN_PEL' => $semester_aktif->ID_TAHUN_PEL, 'NO_SISWA' => $detail_siswa->NO_SISWA, 'ID_MAPEL' => $keypu->ID_MAPEL), TRUE);
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
				$rt_uh = round(($uh_1+$uh_2+$uh_3)/3);
				$rt_uu2 = ($uu_2*2);
				$rt_tugas = round(($tugas_1+$tugas_2+$tugas_3+$tugas_4+$tugas_5+$tugas_6+$tugas_7+$tugas_8+$tugas_9+$tugas_10+$tugas_11+$tugas_12)/12);
				$NilRaport=round(($rt_tugas+$rt_uh+$rt_uu2+$ul_ts)/5);
		        ?>
		        <tr valign="top">
                    <td align="center" valign="top"><?php echo $nom;?></td>
			        <td><?php echo $keypu->MAPEL;?></td>
        
        			<td align="center"><?php echo $keypu->KKM;?></td>
        
        			<td align="center"><?php if($NilRaport<=0) echo '-'; else $NilRaport;?></td>
        
        			<td align="center"><?php if($NilRaport<=0) {echo '-'; $des='-';}
        			else {
        			    if($NilRaport<50){
        			        $des='Sangat Buruk';
    				         echo 'E';
    				     }elseif($NilRaport>=51 && $NilRaport<=60){
    				         $des='Buruk';
    				         echo 'D';
    				     }elseif($NilRaport>=61 && $NilRaport<=75){
    				         $des='Cukup';
    				         echo 'C';
    				     }elseif($NilRaport>=76 && $NilRaport<=90){
    				         $des='Baik';
    				         echo 'B';
    				     }elseif($NilRaport>=91){
    				         $des='Sangat Baik';
    				         echo 'A';
    				     }
    				     
        			}?></td>
        
        			<td align="center"><?php echo $des;?></td>
        
        		</tr>
		        <?php 
			}
				
		?>
		
		

	</table>


	<table width="100%" style="margin-bottom: 30px">

		<tr>

			<td style="padding-left: 380px;">

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diberikan di : Lubuklinggau<br/>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $this->jariprom_tools->tglIndo( (isset($_GET['print-date']) ? date('Y-m-d', strtotime($_GET['print-date'])) : date('Y-m-d')) ) ?>&nbsp;&nbsp;

			</td>

		</tr>

	</table>
	
</section>


</body>



</html>