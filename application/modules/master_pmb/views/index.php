<div class="row">

<div class="col-md-12">
<div class="panel panel-default">

	<div class="panel-body">
	<form action="" method="GET">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<select name="pendidikan" id="" class="form-control">
						<option value="SMP">SMP</option>
						<option value="SD">SD</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type="submit" name="submitcari" class="btn btn-primary" value="Filter">
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

var base_url = "<?php echo base_url("master_pmb/getPmb/SMP") ?>";

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