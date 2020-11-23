<div class="row">
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
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">

        <thead>

            <tr>

                <th>Nama</th>

                <th>Berkas</th>
				<th></th>
				<th>Tanggal</th>
				<th>Waktu</th>
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
var base_url = "<?php echo base_url("master_bukti/getData") ?>";

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