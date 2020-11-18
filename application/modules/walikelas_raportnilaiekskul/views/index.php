
<script>$(document).ready(function () {$('#tanggal-cetak').datepicker({autoclose:true,format:'dd-mm-yyyy'});});</script>
<div style="position: absolute;top: 60px;right: 20px;">
	<div class="form-group">
		Tanggal Cetak
		<input id="tanggal-cetak" value="<?php echo date('d-m-Y');?>" class="form-control" readonly=""  type="text" style="width:100px; display: inline-block;">		
	</div>
</div>


<div class="row">

<div class="col-md-12">

<div class="panel panel-default">

	<div class="panel-body">

	

		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">

        <thead>

            <tr>

                <th>NIPD</th>

                <th>Nama</th>

                <th>Kelas</th>

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

var base_url = "<?php echo base_url("walikelas_raportnilaiekskul/getSiswa/".$id_kelas) ?>";

$('#example').dataTable({

	"processing": true,

    "serverSide": true,

    "order":[],

    "ajax":{  

	    url: base_url

	},

	"columnDefs":[

	{

		"targets":[3],

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
	

