<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label>Kepada</label>
					<p><?= $detail_siswa->NAMA ?></p>
				</div>
				<div class="form-group">
					<label>Subject</label>
					<p><?= $detail_pesan->SUBJECT ?></p>
				</div>
				<div class="form-group">
					<label>Waktu</label>
					<p><?= $detail_pesan->WKT_KIRIM.' - '.$detail_pesan->TGL_KIRIM ?></p>
				</div>
				<div class="form-group">
					<label>Status</label>
					<p><?= ($detail_pesan->STS_READ == 0 ? '<span class="label label-info">Masuk</span>' : '<span class="label label-success">Sudah Baca</span>') ?></p>
				</div>
				<div class="form-group">
					<label>Isi Pesan</label>
					<p><?= $detail_pesan->ISI_PESAN ?></p>
				</div>
				<a href="<?= base_url('siswa_pesan') ?>" class="btn btn-info">Kembali</a>
			</div>
		</div>
	</div>
</div>