
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Input nilai <?= $detail_mapel->MAPEL ?></h3>
				<hr />
				<form action="<?= base_url('guru_inputnilaimapel/inputNilaiSubmit') ?>" method="post">
				<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($no_siswa); ?>"/>
				<input type="hidden" name="id_mapel" value="<?= $this->jariprom_tools->base64_encode_fix($id_mapel); ?>"/>
				<h4>Nilai Tugas</h4>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Tugas 1</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_1 ?>" name="tugas_1"/>
						</div>
						<div class="form-group">
							<label>Tugas 2</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_2 ?>" name="tugas_2"/>
						</div>
						<div class="form-group">
							<label>Tugas 3</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_3 ?>" name="tugas_3"/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Tugas 4</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_4 ?>" name="tugas_4"/>
						</div>
						<div class="form-group">
							<label>Tugas 5</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_5 ?>" name="tugas_5"/>
						</div>
						<div class="form-group">
							<label>Tugas 6</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_6 ?>" name="tugas_6"/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Tugas 7</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_7 ?>" name="tugas_7"/>
						</div>
						<div class="form-group">
							<label>Tugas 8</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_8 ?>" name="tugas_8"/>
						</div>
						<div class="form-group">
							<label>Tugas 9</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_9 ?>" name="tugas_9"/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Tugas 10</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_10 ?>" name="tugas_10"/>
						</div>
						<div class="form-group">
							<label>Tugas 11</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_11 ?>" name="tugas_11"/>
						</div>
						<div class="form-group">
							<label>Tugas 12</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->TUGAS_12 ?>" name="tugas_12"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4>Nilai Ulangan Harian</h4>
						<div class="form-group">
							<label>Ulangan Harian 1</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->UH_1 ?>" name="uh_1"/>
						</div>
						<div class="form-group">
							<label>Ulangan Harian 2</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->UH_2 ?>" name="uh_2"/>
						</div>
						<div class="form-group">
							<label>Ulangan Harian 3</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->UH_3 ?>" name="uh_3"/>
						</div>
					</div>
					<?php /* revis 1 2
					<div class="col-md-4">
						<h4>Nilai Ulangan</h4>
						<div class="form-group">
							<label>Ulangan TS</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->UL_TS ?>" name="ul_ts"/>
						</div>

						<div class="form-group">
							<label>Ulangan Umum</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->UL_UMUM ?>" name="ul_umum"/>
						</div>
					</div>

					<div class="col-md-4">
						<h4>UU2</h4>
						<div class="form-group">
							<label>UU2</label>
							<input type="text" class="form-control" maxlength="3" value="<?= @$detail_nilai->UU_2 ?>" name="uu_2"/>
						</div>
					</div>
					*/?>
				</div>
					<input type="submit" class="btn btn-default" value="Terapkan Nilai"/>
					<a href="<?= base_url('guru_inputnilaimapel') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>