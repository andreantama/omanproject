<div class="panel panel-default">
	<div class="panel-body">
		<h3>Input nilai <?= $detail_mapel->MAPEL ?></h3>
		<hr />
		<form action="<?= base_url('guru_inputnilaiuas/inputNilaiSubmit') ?>" method="post">
		<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($no_siswa); ?>"/>
		<input type="hidden" name="id_mapel" value="<?= $this->jariprom_tools->base64_encode_fix($id_mapel); ?>"/>
		<h4>Nilai UAS</h4>
		<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>UAS</label>
				<input type="text" class="form-control" value="<?= @$detail_nilai->UAS ?>" name="uas"/>
			</div>
		</div>
		</div>
			<input type="submit" class="btn btn-default" value="Terapkan Nilai"/>
			<a href="<?= base_url('guru_inputnilaiuas') ?>" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div>