<html>
	<head>
		<title>Cetak Absensi</title>
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
	<body onload="window.print();">
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
			<h4 style="margin: 0">ABSENSI</h4>
			<h4 style="margin: 0">KELAS <?= $detail_kelas->NAMA_KELAS ?></h4>
			<h4 style="margin: 0"><?= $data_infosekolah->NAMA_SEKOLAH ?></h4>
		</div>
		<table width="100%">
			<tr>
				<td align="left"><p style="font-family: Arial;margin-bottom: 10px">Bulan : <?= date('F', mktime(0, 0, 0, $bulan, 10)); ?></p></td>
				<td align="right"><p style="font-family: Arial;margin-bottom: 10px">Tahun Ajaran : <?= $detail_semesternya->TAHUN_PEL ?></p></td>
			</tr>
		</table>
		<table width="100%" border="1" style="border-collapse: collapse;font-family: Arial;margin-bottom: 20px;" cellpadding="5">
		<thead>
        <tr valign="middle" style="font-weight: bold" align="center">
						<td rowspan="2">No</td>
						<td rowspan="2">Nama Siswa</td>
						<td colspan="31">Tanggal</td>
						<td colspan="3">Jumlah</td>
					</tr>
					<tr valign="middle" style="font-weight: bold" align="center">
						<?php for($a = 1;$a <= 31;$a++):?>
						<td><?= $a ?></td>
						<?php endfor; ?>
						<td>S</td>
						<td>I</td>
						<td>A</td>
					</tr>
		</thead>
					<?php if($data_siswa): ?>
					<?php $a = 1;foreach($data_siswa as $data_siswa): ?>
					<?php
						$detail_absen = $this->gurubp_inputabsensi->tampilData('tbl_absen','*', array('NO_SISWA' => $data_siswa->NO_SISWA, 'ID_KELAS' => $id_kelas, 'ID_TAHUN_PEL' => $detail_semester, 'MONTH' => (int)$bulan), TRUE);
					?>
					<tr>
						<td>
							<?= $a ?>	
						</td>
						<td><?= $data_siswa->NAMA; ?></td>
						<?php $sakit = 0;
							$izin = 0;
							$alpha = 0;for($as = 1;$as <= 31; $as++): ?>
						<?php
							if(@$detail_absen->{"TGL_".$as} == 2){
								$sakit = $sakit + 1;
							}
							elseif(@$detail_absen->{"TGL_".$as} == 3){
								$izin = $izin + 1;
							}
							elseif(@$detail_absen->{"TGL_".$as} == 4){
								$alpha = $alpha + 1;
							}
						?>
						<td>
							<?= (@$detail_absen->{"TGL_".$as} == 0 ? "-" : (@$detail_absen->{"TGL_".$as} == 1 ? "H" : (@$detail_absen->{"TGL_".$as} == 2 ? "S" : (@$detail_absen->{"TGL_".$as} == 3) ? "I" : (@$detail_absen->{"TGL_".$as} == 4 ? "A":"")))) ?>
						</td>
						<?php endfor; ?>
						<td><?= $sakit ?></td>
						<td><?= $izin ?></td>
						<td><?= $alpha ?></td>
					</tr>
					<?php $a++;endforeach; ?>
					<?php else: ?>
					<tr>
						<td colspan="36">Tidak ada data.</td>
					</tr>
					<?php endif; ?>
    </table>
    Keterangan :
    <table width="40%">
    	<tr>
    		<td>H</td>
    		<td>HADIR</td>
    	</tr>
    	<tr>
    		<td>S</td>
    		<td>SAKIT</td>
    	</tr>
    	<tr>
    		<td>I</td>
    		<td>IZIN</td>
    	</tr>
    	<tr>
    		<td>A</td>
    		<td>ALPHA</td>
    	</tr>
    </table>
	<br/><br/>
    <table width="100%">
    	<tr>
    		<td align="left" width="70%">
    			Wali Kelas,<br/>
    			<br/><br/><br/><br/>
    			...........................
    		</td>
    		<td align="left" width="30%">
    			Lubuklinggau, ...........................<br/>Guru Mata Pelajaran,
    			<br/><br/><br/><br/>
    			...........................
    		</td>
    	</tr>
    </table>
	</body>
</html>
