<?php

$detail = $this->db->query('SELECT * FROM tbl_info_sekolah')->row();

?>

<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Halaman PPDB</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="<?= base_url('assets-admin/img/logo/'.$detail->LOGO) ?>" rel="shortcut icon" type="image/x-icon">

	

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  </head>

  <body style="margin-top: 30px;">

    <div class="container">

    	<div class="row">

	    	<div class="col-md-3"></div>

	    	<div class="col-md-6">

	    		<div class="panel panel-default">

	    			<div class="panel-body">

	    				<div class="row">

	    					<div class="col-md-6">

	    						<a href="" title=""><img src='<?= base_url('assets-admin/img/logo/'.$detail->LOGO_HOMEPAGE) ?>' width="250px" /></a>

	    					</div>

	    					<div class="col-md-6"><h3>Halaman Registrasi</h3></div>

	    				</div>

	    			</div>

	    		</div>

	    		<?php $this->load->view($page); ?>

	    		<div class="panel panel-default">

	    			<div class="panel-body">

	    				&copy;&nbsp;<?php echo date('Y') ?> <?= $detail->NAMA_SEKOLAH ?>.  All rights reserved.

	    			</div>

	    		</div>

	    	</div>

	    	<div class="col-md-3"></div>

	    </div>

    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>

</html>