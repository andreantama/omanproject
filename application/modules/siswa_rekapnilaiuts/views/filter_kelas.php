<div class="row">

<div class="col-md-12">

<div class="panel panel-default">

	<div class="panel-body">
	<h4>Siswa kelas <?= $detail_kelas->NAMA_KELAS ?></h4>
<hr/>
	<div class="form-group">
		<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('<?= base_url('siswa_rekapnilaiuts/cetakRekapNilaiUts/'.$this->jariprom_tools->base64_encode_fix($detail_kelas->ID_KELAS).'/'.$detail_semester) ?>', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">Cetak Nilai</a>
	</div>
	
	<div style="overflow: auto">
	
		<div style="overflow: auto;margin-bottom: 10px">
			
		<table class="table table-striped table-bordered" style="width: 1500px">
        	<tr valign="middle" style="font-weight: bold" align="center">
        		<td>No</td>
        		<td>NISN</td>
        		<td>Nama Siswa</td>
        		<td>L/P</td>
        		<?php $jum_mapel = 0;foreach($data_mapel as $data_mapel):?>
        		<?php if($jum_mapel != 0): ?>
        		<td><?= $data_mapel->SHORT_MAPEL ?></td>
        		<?php endif; ?>
        		<?php $jum_mapel++;endforeach; ?>
        		<td>Jumlah</td>
        		<td>Rata - Rata</td>
        	</tr>
        	<?php
				$a = 1;
				if($rekap_nilai):
				foreach($rekap_nilai as $rekap_nilai):
			?>
			<tr valign="middle" align="center">
				<td><?= $a; ?></td>
				<td><?= $rekap_nilai->NISN; ?></td>
				<td><?= $rekap_nilai->NAMA; ?></td>
				<td><?= ($rekap_nilai->JK == 1 ? "L" : "P") ?></td>
				
					<?php
						$sql = $this->db->query('SELECT * FROM tbl_mapel')->result();
						$total = 0;
						$average = 0;
						foreach($sql as $key){
							if($key->ID_MAPEL != 1){
								$detail_nilai = $this->siswa_rekapnilaiuts->tampilData('tbl_nilai_uts','*', array('NO_SISWA' => $rekap_nilai->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester, 'ID_MAPEL' => $key->ID_MAPEL), TRUE);
								if($detail_nilai){
									if($detail_nilai->ID_MAPEL == $key->ID_MAPEL){
										$average++;
										$asa = round($detail_nilai->UTS);
										echo '<td>'.round($detail_nilai->UTS).'</td>';
										$total = $total + $asa;
									}
									else{
										echo '<td> - </td>';
									}
								}
								else{
									echo '<td> - </td>';
								}
							}
						}
					?>
				<td><?= $total; ?></td>
				<td><?php if($total == 0): ?>
					<?php
						echo 0;
					?>
					<?php else: ?>
					<?php echo round($total/$average); ?>
					<?php endif; ?>
				</td>
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