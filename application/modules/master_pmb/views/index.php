<div class="row">

<div class="col-md-12">
<div class="panel panel-default">

	<div class="panel-body">
	<form action="" method="GET">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
				<label for="">Jenjang Pendidikan</label>
					<select name="pendidikan" id="" class="form-control">
						<option value="null">--Pilih Pencarian--</option>
						<option value="SMP" <?php if($searchPendidikan == "SMP") { echo "selected"; }?>>SMP</option>
						<option value="SD" <?php if($searchPendidikan == "SD") { echo "selected"; }?>>SD</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				<label for="">Angkatan</label>
					<select name="angkatan" id="" class="form-control">
					<option value="null">--Pilih Pencarian--</option>
					<?php foreach($angkatan as $rowAng):?>
						<option value="<?php echo $rowAng->angkatan;?>" <?php if($searchAngkatan == $rowAng->angkatan) { echo "selected"; }?>><?php echo $rowAng->angkatan;?></option>
					<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Awal Tanggal</label>
					<input type="text" name="searchStart" id="idSearchStart" readonly="" class="form-control" value="<?php if($searchStart != null) { echo $searchStart; }?>">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Akhir Tanggal</label>
					<input type="text" name="searchEnd" id="idSearchEnd" readonly="" class="form-control" value="<?php if($searchEnd != null) { echo $searchEnd; }?>">
					</div>
				</div>
			</div>
			
		<div class="row">
			<div class="col-md-12">
				<input type="submit" name="submitcari" class="btn btn-primary" value="Filter">
				<?php if($searchStatus == true):?>
					<a href="<?php echo base_url("master_pmb/master_pmb"); ?>" class="btn btn-danger"> Reset Filter</a>
				<?php endif;?>
			</div>
		</div>
	</form>
	</div>
</dov>
</div>
<div class="col-md-12">

<div class="panel panel-default">

	<div class="panel-body">

	<?php

		if($this->session->flashdata('notif')):

	?>

	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">

		<?= $this->session->flashdata('notif') ?>

	</div>

	<?php endif; ?>
		<?php if($active->ACTIVE_PMB == 1): ?>
		<div class="form-group">
			<a href="<?= base_url('master_pmb/updatePpdb/0') ?>" class="btn btn-warning">Tutup PPDB</a>
		</div>
		<?php else: ?>
		<div class="form-group">
			<a href="<?= base_url('master_pmb/updatePpdb/1') ?>" class="btn btn-success">Buka PPDB</a>
		</div>
		<?php endif; ?>
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">

        <thead>

            <tr>

                <th>Nama</th>

                <th>No Handphone</th>

                <th>Nama Ayah</th>

                <th>Aksi</th>

            </tr>

        </thead>

    </table>

	</div>

</div>

	</div>

</div>

	



<script>

$(document).ready(function() {
	$('#idSearchStart').datepicker({

		autoclose: true,

		format: 'yyyy-mm-dd'

	});
	$('#idSearchEnd').datepicker({

autoclose: true,

format: 'yyyy-mm-dd'

});
var base_url = "<?php echo base_url("master_pmb/getPmb/$searchPendidikan/$searchAngkatan/$searchStart/$searchEnd") ?>";

$('#example').dataTable({

	"processing": true,

    "serverSide": true,

    "order":[],

    "ajax":{  

	    url: base_url

	},

	"columnDefs":[

	{

		"targets":[1,2,3],

		"orderable":false,  

    },

   ],

   "aLengthMenu": [[5, 10, 15, 20, 25], [5, 10, 15, 20, 25]],

   "iDisplayLength": 5,

   "bInfo": false,

   "bAutoWidth": false 

   });

});

    </script>