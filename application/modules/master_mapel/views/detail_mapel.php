<div class="row">
	<div class="col-md-12">
	<?php
		if($this->session->flashdata('notif')):
	?>
	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">
		<?= $this->session->flashdata('notif') ?>
	</div>
	<?php endif; ?>
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="<?= base_url('master_mapel/editMapelSubmit') ?>" method="post">
					<input type="hidden" name="id_nama_mapel" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_MAPEL); ?>"/>
					<input type="hidden" name="nama_mapel_form" value="<?= $detail->MAPEL ?>"/>
					<div class="form-group">
						<label>Mata Pelajaran</label>
						<input type="text" name="nama_mapel" class="form-control" value="<?= $detail->MAPEL ?>" required/>
					</div>
					<div class="form-group">
						<label>KKM</label>
						<input type="text" name="kkm" class="form-control" value="<?= $detail->KKM ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_mapel') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>