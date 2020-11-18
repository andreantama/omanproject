<div class="panel panel-default">
	<div class="panel-body">
		<h4><i class="fa fa-list"></i> Cek & Cetak Pendaftaran</h4>
		<div class="form-group">
			<label>No Handphone</label>
			<input type="text" class="form-control" id="no_handphone"/>
			<p class="text-muted">Masukkan no handphone yang digunakan untuk pendaftaran</p>
		</div>
		<div class="form-group">
			<input type="button" id="cek_pmb" value="Cek Pendaftaran" class="btn btn-default"/>
			<a href="<?= base_url('homepage_pmb') ?>" class="btn btn-info">Kembali</a>
		</div>
		<div id="sts"></div>
	</div>
</div>
<script>
	$(document).ready(function () {
   		$('#cek_pmb').click(function(){
   			$('#sts').html('Memuat data...');
   			$.ajax({
				method : "POST",
				url : '<?= base_url("homepage_pmb/cekPMBSubmit") ?>',
				data : 'no_handphone=' + $('#no_handphone').val(),
				success:function(data){
					$('#sts').html(data);
				}
			});
   		});
   });
</script>