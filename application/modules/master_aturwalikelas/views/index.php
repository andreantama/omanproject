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
				Pilih wali kelas dengan mamasukkan <b>NRP</b>, dan tentukan kelas yang akan dipilih. Anda dapat melepas jabatan wali kelas atau mengganti dengan guru yang lain.
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<form action="<?= base_url('master_aturwalikelas/pilihWaliKelasSubmit') ?>" method="post">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<h4>Pilih Guru</h4>
				<select class="form-control select2" name="id_guru" required></select>
				</div>
				<div class="form-group">
		            <h4>Menjadi Wali Kelas</h4>
		            <select name="id_kelas" class="form-control" required>
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
	<div class="panel panel-default">
		<div class="panel-body">
		<h4>Daftar Wali Kelas</h4>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NRP</th>
                <th>Nama</th>
                <th>Wali Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
	</div>
</div>
	</div>
</div>
<script>
   $(document).ready(function () {
var base_url = "<?php echo base_url("master_aturwalikelas/viewWaliKelas") ?>";
$('#example').dataTable({
"processing": true,
"searching": false,
"serverSide": true,
"order":[],
"ajax":{  
url: base_url
},
"columnDefs":[
{
"targets":[0,1,2,3],
"orderable":false,  
},
],
"aLengthMenu": [[5, 10, 15, 20, 25], [5, 10, 15, 20, 25]],
"iDisplayLength": 5,
"bInfo": false,
"bAutoWidth": false 
});
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