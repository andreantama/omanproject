<div class="row">
	<div class="col-md-12">
		<?php
		if($this->session->flashdata('notif')):
	?>
	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">
		<?= $this->session->flashdata('notif') ?>
	</div>
	<?php endif; ?>
	</div>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="<?= base_url('master_aturtahunpel/updateSetTahunPelSubmit') ?>" method="post">
					<div class="form-group">
						<label>Semester</label>
						<select name="id_tahun_pel" class="form-control">
			             <?php
			                 foreach($data_semester as $data_semester):
			             ?>
			              <option value="<?= $data_semester->ID_TAHUN_PEL ?>" <?= ($detail->ID_TAHUN_PEL == $data_semester->ID_TAHUN_PEL ? "selected" : "") ?>><?= $data_semester->TAHUN_PEL.' ( Semester '.$data_semester->SEMESTER.' )' ?></option>
			              <?php $a++;endforeach; ?>
			              </select>
					</div>
					<input type="submit" class="btn btn-default" value="Terapkan"/>
				</form>
			</div>
		</div>
	</div>
</div>