<?php if($bulan != '00'): ?>

	<div class="panel panel-default">

		<div class="panel-body">

			<h4>Data Absensi</h4>

			<hr/>

			<div style="overflow: auto;margin-bottom: 10px">

				<table class="table table-bordered" style="width: 2200px">

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

					<?php if($data_siswa): ?>

					<?php $a = 1;foreach($data_siswa as $data_siswa): ?>

					<?php

						$detail_absen = $this->walikelas_rekapabsensi->tampilData('tbl_absen','*', array('NO_SISWA' => $data_siswa->NO_SISWA, 'ID_KELAS' => $id_kelas, 'ID_TAHUN_PEL' => $detail_semester, 'MONTH' => (int)$bulan), TRUE);

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
							<?php
								if(@$detail_absen->{"TGL_".$as} == 0){
									echo '-';
								}
								elseif(@$detail_absen->{"TGL_".$as} == 1){
									echo 'H';
								}
								elseif(@$detail_absen->{"TGL_".$as} == 2){
									echo 'S';
								}
								elseif(@$detail_absen->{"TGL_".$as} == 3){
									echo 'I';
								}
								elseif(@$detail_absen->{"TGL_".$as} == 4){
									echo 'A';
								}
							?>
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

				</div>

				<p>Keterangan :

				<ul>

					<li>H : HADIR</li>

					<li>S : SAKIT</li>

					<li>I : IZIN</li>

					<li>A : ALPHA</li>

				</ul>

				</p>

				<div class=" form-group">

				

				<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('<?= base_url('walikelas_rekapabsensi/cetakAbsen/'.$id_kelas.'/'.$detail_semester.'/'.$bulan) ?>', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">Cetak Absen</a> <a href="<?= base_url('gurubp_inputabsensi') ?>" class="btn btn-info">Kembali</a>

				</div>

		</div>

	</div>

				

				<?php endif; ?>