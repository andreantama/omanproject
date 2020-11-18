	<style>
		.alert{
			width: 96%;
			padding: 10px;
			border-radius: 6px;
			margin-bottom: 20px;
		}
		
		.alert-success{
			background-color: #2ecc71;
			color: white;
		}
		
		.alert-info{
			background-color: #2ecc71;
			color: white;
		}
		
		.alert-danger{
			background-color: #e74c3c;
			color: white;
		}
		
		.form-group{
			margin-bottom:10px;
		}
		
		.form-control{
			font-size: 16px;
			width: 97%;
		}
		
		form label{
			font-weight: bold;
			font-family: arial;
			margin-bottom: 6px;
			color: #ffffff;
		}
		
		.container-login{
			padding: 10px;
			background: #3498db;
			width: 500px;
			margin: auto;
			border-radius: 6px;
		}
		
		.container-login p{
			margin-top: 10px;
			color: #ffffff;
		}
		
		.container-login ol li{
			color: #ffffff;
			margin-top: 10px;
		}
	</style>
<div class="container_1">
	<div class="bg-usaha">
		<div class="list2-left"></div>
		<h2>Login</h2>
		<div class="list2-right"></div>
		<div class="container">
		<div class="clear"></div>
			<div class="container-login">
			<?php if($this->session->flashdata('notif')): ?>
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<?php endif; ?>
				<form action="<?php echo base_url('master_login/loginSubmit') ?>" method="post">
					<div class="form-group">
					<label>NIS</label>
					<input type="text" class="form-control" name="username"/>
				</div>
				<div class="form-group">
					<label>PASSWORD</label>
					<input type="password" class="form-control" name="password"/>
				</div>
				<input type="hidden" name="level" value="1"/>
				<input type="submit" class="btn" value="Masuk"/>
					</form>
					<p>
						Kiat :
						<ol>
							<li>- Silahkan login menggunakan username dan password Anda.</li>
							<li>- Jika lupa password silahkan hubungi Administrator.</li>
						</ol>
					</p>
			</div>
				
		</div>
	</div>
</div>