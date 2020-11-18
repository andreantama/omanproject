<div class="panel panel-default">
	<div class="panel-body">
		<h3>Input nilai <?= $detail_mapel->MAPEL ?></h3>
		<hr />
		<form action="<?= base_url('guru_inputnilaiuts/inputNilaiSubmit') ?>" method="post">
		<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($no_siswa); ?>"/>
		<input type="hidden" name="id_mapel" value="<?= $this->jariprom_tools->base64_encode_fix($id_mapel); ?>"/>
		<input type="hidden" name="id_kelas" value="<?= $id_kelas; ?>"/>
		<h4>Nilai UTS</h4>
		<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>UTS</label>
				<input type="text" class="form-control" value="<?= @$detail_nilai->UTS ?>" name="uts"/>
			</div>
		</div>
		</div>
			<input type="submit" class="btn btn-default" value="Terapkan Nilai"/>
			<a href="<?= base_url('guru_inputnilaiuts') ?>" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div>