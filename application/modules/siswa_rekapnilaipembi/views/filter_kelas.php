<div class="row">

<div class="col-md-12">

<div class="panel panel-default">

	<div class="panel-body">
	<h4>Siswa kelas <?= $detail_kelas->NAMA_KELAS ?></h4>
<hr/>
	<div class="form-group">
		<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('<?= base_url('siswa_rekapnilaipembi/cetakRekapNilaiPembi/'.$this->jariprom_tools->base64_encode_fix($detail_kelas->ID_KELAS).'/'.$detail_semester) ?>', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">Cetak Nilai</a>
	</div>
	<div style="overflow: auto">
	
		<div style="overflow: auto;margin-bottom: 10px">
			
		<table class="table table-striped table-bordered" style="width: 1500px">
        	<tr valign="middle" style="font-weight: bold" align="center">
        		<td>No</td>
        		<td>Nama Siswa</td>
        		<td>L/P</td>
        		<td>NIS</td>
        		<td>NISN</td>
        		<td>Wudhu</td>
        		<td>Sholat</td>
        		<td>Tahsin</td>
        		<td>Surat Pendek</td>
        		<td>Hadits</td>
        		<td>Do'a</td>
        		<td>Tahfidzh 1</td>
        		<td>Tahfidzh 2</td>
        		<td>Jumlah</td>
        		<td>Rata - Rata</td>
        	</tr>
        	<?php
				$a = 1;
				
				if($rekap_nilai):
				foreach($rekap_nilai as $rekap_nilai):
				$count_all_pembi = 6;
				$detail_nilai = $this->siswa_rekapnilaipembi->tampilData('tbl_nilai_pembiasaan','*', array('ID_TAHUN_PEL' => $detail_semester, 'NO_SISWA' => $rekap_nilai->NO_SISWA), TRUE);
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
					$cek_surah_1 = $this->siswa_rekapnilaipembi->tampilData('tbl_nilai_pembiasaan','NAMA_SURAH, TAHFIDZH',array('NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester), TRUE);
					if(@$cek_surah_1->NAMA_SURAH != '' && @$cek_surah_1->TAHFIDZH):
				?>
				<td><?= @$detail_nilai->TAHFIDZH; ?></td>
				<?php else: ?>
				<td></td>
				<?php $count_all_pembi++;endif; ?>
				<?php
					$cek_surah_2 = $this->siswa_rekapnilaipembi->tampilData('tbl_nilai_pembiasaan','NAMA_SURAH_2, TAHFIDZH_2',array('NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester), TRUE);
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
		</div>
    </div>
		

	</div>

</div>

	</div>

</div>