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
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
				Pilih guru dengan memasukkan <b>NRP</b>, lalu pilih mata pelajaran yang akan dipilih. Anda dapat memilih kelas lebih dari satu.
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
				<label>Lihat kelas pengajar :</label>
	            <select id="id_kelas" class="form-control" required>
	             <?php
	             	$a = 0;
	                 foreach($data_kelas_filter as $data_kelas_filter):
	            ?>
	              <option value="<?= $data_kelas_filter->ID_KELAS ?>"><?= $data_kelas_filter->NAMA_KELAS ?></option>

	              <?php endforeach; ?>
	              </select>
	            </div>
	            <button type="button" class="btn btn-primary" id="filter_kelasnya">Filter Data</button>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<form action="<?= base_url('master_aturkelasajar/pilihKelasAjarSubmit') ?>" method="post">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<h4>Pilih Guru</h4>
					<input type="hidden" id="no_guru"/>
				<select class="form-control select2" name="id_guru" required></select>
				</div>
				<div class="form-group" id="mapel_list"></div>
				<div class="form-group">
		            <h4>Pilih Kelas</h4>
		            <select name="id_kelasajar[]" multiple="multiple" class="form-control select1" required>
		             <?php
		             	$a = 0;
		                 foreach($data_kelas as $data_kelas):
		                 
		                 ?>
		                 <?php if($a != 0): ?>
		              <option value="<?= $data_kelas->ID_KELAS ?>"><?= $data_kelas->NAMA_KELAS ?></option>
		              <?php endif; ?>
		              <?php $a++;endforeach; ?>
		              </select>
	            </div>
	            <input type="submit" value="Terapkan" class="btn btn-primary"/>
			</div>
		</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="sts"></div>
	</div>
</div>
<script>
	
	function getMapelGuru(){
		$.ajax({
			method : "POST",
			url : '<?= base_url("master_aturkelasajar/getListMapelGuru") ?>',
			data : 'no_guru=' + $('#no_guru').val(),
			success:function(data){
				$('#mapel_list').html(data);
			}
		});
	}

   $(document).ready(function () {
   		$('#filter_kelasnya').click(function(){
   			$('#sts').html('Memuat data...');
   			$.ajax({
				method : "POST",
				url : '<?= base_url("master_aturkelasajar/filterKelas") ?>',
				data : 'id_kelas=' + $('#id_kelas').val(),
				success:function(data){
					$('#sts').html(data);
				}
			});
   		});
	   $('.select2').select2({
        placeholder: '--- Pilih Guru ---',
        ajax: {
          url: '<?= base_url("master_aturkelasajar/searchGuru") ?>',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: $.map(data, function (item) {
                    return {
                        text: item.NAMA,
                        slug: $('#no_guru').val(item.NO_GURU) + getMapelGuru(),
                        id: item.NO_GURU
                    }
                })
            };
          }
        }
      });
	      $('.select1').select2();

		});
</script>