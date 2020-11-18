
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets-admin/plugins/select2/select2.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>">Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php if($this->session->flashdata('notif')): ?>
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<?php endif; ?>

    <form action="<?php echo base_url('master_login/loginSubmit') ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" value="<?php echo $this->session->flashdata('username') ?>" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      	<label>Level</label>
       <select class="form-control" name="level">
       		<option value="2">Guru BP</option>
       		<option value="3">Guru</option>
       		<option value="4">Wali Kelas</option>
       		<option value="5">Admin</option>
       </select>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-flat">Masuk</button>
         <a href="<?php echo base_url() ?>" class="btn btn-info btn-flat">Kembali</a>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?php echo base_url() ?>assets-admin/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets-admin/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
