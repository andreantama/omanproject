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
	<div class="form-group">
		<a href="<?= base_url('master_pekerjaan/addPekerjaan') ?>" class="btn btn-success">Tambah Pekerjaan</a>
	</div>
	
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pekerjaan</th>
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
var base_url = "<?php echo base_url("master_pekerjaan/getPekerjaan") ?>";
$('#example').dataTable({
	"processing": true,
    "serverSide": true,
    "order":[],
    "ajax":{  
	    url: base_url
	},
	"columnDefs":[
	{
		"targets":[2],
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