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
				<form action="<?= base_url('master_tahunpel/addTahunPelSubmit') ?>" method="post">
					<div class="form-group">
						<label>Tahun Pelajaran</label>
						<input type="text" name="tahunpel" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Semester</label>
						<select name="semester" class="form-control select2">

			      				 <option value="1">Ganjil</option>

			      				 <option value="2">Genap</option>

			      			</select>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Tahun Pelajaran"/>
					<a href="<?= base_url('master_tahunpel') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
<script>

	 	$(document).ready(function () {
			$(".select2").select2();
		});
	</script>