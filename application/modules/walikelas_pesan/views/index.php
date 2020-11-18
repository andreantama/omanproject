<div class="row">
<div class="col-md-12">
<?php
		if($this->session->flashdata('notif')):
	?>
	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">
		<?= $this->session->flashdata('notif') ?>
	</div>
	<?php endif; ?>
	<form action="<?= base_url('walikelas_pesan/kirimPesan') ?>" method="post">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label>Tujuan</label>
					<select class="form-control select2" name="id_siswa[]" required multiple="multiple"></select>
					<p>Masukkan NIPD / nama siswa</p>
				</div>
				<div class="form-group">
					<label>Judul</label>
					<input type="text" class="form-control" name="judul" required/>
				</div>
				<div class="form-group">
						<label>Isi Pesan</label>
						<textarea id="editor1" name="pengumuman"></textarea>
					</div>
	            <input type="submit" value="Kirim Pesan" class="btn btn-primary"/>
			</div>
		</div>
		</form>
</div>
</div>
<script>
   $(document).ready(function () {
   	CKEDITOR.replace('editor1');
		   $('.select2').select2({
	        placeholder: '--- Pilih Siswa ---',
	        ajax: {
	          url: '<?= base_url("walikelas_pesan/searchSiswa") ?>',
	          dataType: 'json',
	          delay: 250,
	          processResults: function (data) {
	            return {
	              results: data
	            };
	          },
	          cache: true
	        }
	      });

		});
</script>