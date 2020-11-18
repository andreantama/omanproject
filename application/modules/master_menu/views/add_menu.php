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
				<form action="<?= base_url('master_menu/addMenuSubmit') ?>" method="post">
					<div class="form-group">
						<label>Judul Halaman</label>
						<input type="text" name="judul_halaman" class="form-control" required/>
					</div>
					<div class="form-group">
						<label>Sub Menu</label>
                       <select name="id_parent" class="form-control select2">
                       	<option value="0">Tidak Ada</option>
                           <?php
                             foreach($data_menu as $data_menu):
                        	?>
                            <option value="<?= $data_menu->ID_MENUWEB ?>"><?= $data_menu->NAMA_MENU ?></option>
                            <?php endforeach; ?>
                       </select>
					</div>
					<div class="form-group">
					<label>Status</label>
                       <select name="sts_publish" class="form-control select2">
                          <option value="1">Publish</option>
                          <option value="2">Draft</option>
                       </select>
					</div>
					<div class="form-group">
						<label>Isi Halaman</label>
						<textarea id="editor1" name="isi_halaman"></textarea>
					</div>
					<input type="submit" class="btn btn-default" value="Tambah Halaman"/>
					<a href="<?= base_url('master_menu') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
   $(document).ready(function () {
   		CKEDITOR.replace('editor1');
   		$(".select2").select2();
   });
   
</script>