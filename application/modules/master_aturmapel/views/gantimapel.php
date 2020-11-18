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
			<form action="<?= base_url('master_aturmapel/gantiMapelSubmit') ?>" method="post">
			<input type="hidden" name="id_guru" value="<?= $this->jariprom_tools->base64_encode_fix($detail->NO_GURU); ?>" class="form-control"/>
			<input type="hidden" name="id_rel_mapel" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_REL_MAPEL); ?>" class="form-control"/>
			<div class="form-group">
				<label>NUPTK</label>
				<p><?= $detail_guru->NUPTK ?></p>
			</div>
			<div class="form-group">
				<label>Nama Guru</label>
				<p><?= $detail_guru->NAMA ?></p>
			</div>
			<div class="form-group">
				<label>Mengajar</label><br/>
				<?= $detail_mapel->MAPEL ?>
			</div>
			<div class="form-group">
				<label>Ganti Dengan</label>
				<select name="id_mata_pelajaran" class="form-control">
		             <?php
		             	$a = 0;
		                 foreach($data_mapel as $data_mapel):
		                 
		                 ?>
		                 <?php if($a != 0): ?>
		              <option value="<?= $data_mapel->ID_MAPEL ?>"><?= $data_mapel->MAPEL ?></option>
		              <?php endif; ?>
		              <?php $a++;endforeach; ?>
		              </select>
			</div>
			<input type="submit" class="btn btn-default" value="Ganti Mata Pelajaran"/> <a href="<?= base_url('master_aturmapel') ?>" class="btn btn-info">Kembali</a>
			</form>
		</div>
	</div>
</div>
</div>