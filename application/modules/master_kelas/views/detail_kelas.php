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
				<form action="<?= base_url('master_kelas/editKelasSubmit') ?>" method="post">
					<input type="hidden" name="id_nama_kelas" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_KELAS); ?>"/>
					<input type="hidden" name="nama_kelas_form" value="<?= $detail->NAMA_KELAS ?>"/>
					<div class="form-group">
						<label>Nama Kelas</label>
						<input type="text" name="nama_kelas" class="form-control" value="<?= $detail->NAMA_KELAS ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_kelas') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>