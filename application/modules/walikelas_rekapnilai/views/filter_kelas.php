<div class="row">

<div class="col-md-12">

<div class="panel panel-default">

	<div class="panel-body">
	<h4>Siswa kelas <?= $detail_kelas->NAMA_KELAS ?></h4>
<hr/>
	<div class="form-group">
		<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('<?= base_url('walikelas_rekapnilai/cetakRekapNilaiMapel/'.$this->jariprom_tools->base64_encode_fix($detail_kelas->ID_KELAS).'/'.$detail_semester.'/'.$id_mapel) ?>', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">Cetak Nilai</a>
	</div>
	
	<div style="overflow: auto">
	
		<div style="overflow: auto;margin-bottom: 10px">
			
		<table class="table table-striped table-bordered" style="width: 1200px">
        <thead>
            <tr valign="middle" style="font-weight: bold" align="center">
				<td rowspan="2">No</td>
				<td rowspan="2">Nama Siswa</td>
				<td colspan="3">UH</td>
				<td rowspan="2">Rata - Rata</td>
				<td colspan="12">TUGAS DAN PEKERJAAN RUMAH</td>
				<td rowspan="2">Rata - Rata</td>
				<td colspan="2">ULANGAN</td>
				<td rowspan="2">2UU</td>
				<td rowspan="2">RAPORT</td>
            </tr>
			<tr valign="middle" style="font-weight: bold" align="center">
				<td>UH 1</td>
				<td>UH 2</td>
				<td>UH 3</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>TS</td>
				<td>UAS</td>
			</tr>
        </thead>
		<tbody>
			<?php
				$a = 1;
				if($rekap_nilai):
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
			<?php else: ?>
			<tr>
				<td colspan="23">Tidak ada data.</td>
			</tr>
			<?php endif; ?>
		</tbody>
    </table>
		</div>
    </div>
		

	</div>

</div>

	</div>

</div>