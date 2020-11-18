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

			<form action="<?= base_url('master_aturwalikelas/gantiWaliKelasSubmit') ?>" method="post">

			<div class="form-group">

				<label>Nama Kelas</label>

				<input type="hidden" name="id_kelas" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_KELAS); ?>" class="form-control"/>

				<p><?= $detail->NAMA_KELAS ?></p>

			</div>

			<div class="form-group">

				<label>Ganti Dengan</label>

				<select class="form-control select2" name="id_guru" required></select>

				<p>Masukkan <b>NRP</b></p>

			</div>

			<input type="submit" class="btn btn-default" value="Ganti Wali Kelas"/> <a href="<?= base_url('master_aturwalikelas') ?>" class="btn btn-info">Kembali</a>

			</form>

		</div>

	</div>

</div>

</div>

<script>

   $(document).ready(function () {

		   $('.select2').select2({

	        placeholder: '--- Pilih Guru ---',

	        ajax: {

	          url: '<?= base_url("master_aturwalikelas/searchGuru") ?>',

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