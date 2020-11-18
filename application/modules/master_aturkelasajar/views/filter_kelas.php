<div class="row">



<div class="col-md-12">



<div class="panel panel-default">



	<div class="panel-body">

	<h4>Mengajar di kelas <?= $detail_kelas->NAMA_KELAS ?></h4>

<hr/>

		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">



        <thead>



            <tr>



                <th>NRP</th>

                <th>Nama</th>

                <th>Kelas</th>
                <th>Mengajar</th>

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



var base_url = "<?php echo base_url("master_aturkelasajar/getKelasAjar/".$id_kelas) ?>";



$('#example').dataTable({



	"processing": true,

	"search": false,

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



});



    </script>