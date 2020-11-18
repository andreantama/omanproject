<div class="row">

	<div class="col-md-12">

	<?php

		if($this->session->flashdata('notif')):

	?>

	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">

		<?= $this->session->flashdata('notif') ?>

	</div>

	<?php endif; ?>

		<div class="panel panel-default">

			<div class="panel-body">

				<form action="<?= base_url('master_infosekolah/editInfoSubmit') ?>" method="post" enctype="multipart/form-data">

					<input type="hidden" name="id_info" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_INFO); ?>" class="form-control"/>

					<div class="row">

						<div class="col-md-6">

						<div class="form-group">

						<label>Nama Sekolah</label>

						<input type="text" name="nama_sekolah" value="<?= $detail->NAMA_SEKOLAH ?>" class="form-control" required/>

					</div>

					<div class="form-group">

						<label>Alamat</label>

						<textarea class="form-control" name="alamat"><?= $detail->ALAMAT_SEKOLAH ?></textarea>

					</div>

					<div class="form-group">

						<label>No. Telepon</label>

						<input type="text" name="no_telepon" value="<?= $detail->TELP_SEKOLAH ?>" class="form-control"/>

					</div>

					<div class="form-group">

						<label>Fax</label>

						<input type="text" name="fax" value="<?= $detail->FAX ?>" class="form-control"/>

					</div>

					<div class="form-group">

						<label>Email</label>

						<input type="text" name="email" value="<?= $detail->EMAIL_SEKOLAH ?>" class="form-control"/>

					</div>

					<div class="form-group">

						<label>Website</label>

						<input type="text" name="web_sekolah" value="<?= $detail->WEBSITE_SEKOLAH ?>" class="form-control"/>

					</div>

					<div class="form-group">

						<label>Facebook</label>

						<input type="text" name="facebook" value="<?= $detail->FACEBOOK ?>" class="form-control"/>

					</div>

					<div class="form-group">

						<label>Twitter</label>

						<input type="text" name="twitter" value="<?= $detail->TWITTER ?>" class="form-control"/>

					</div>

					<div class="form-group">

						<label>Instagram</label>

						<input type="text" name="instagram" value="<?= $detail->INSTAGRAM ?>" class="form-control"/>

					</div>

					<div class="form-group">

						<label>Google</label>

						<input type="text" name="google" value="<?= $detail->GOOGLE ?>" class="form-control"/>

					</div>
					<div class="form-group">

						<label>Angakatan Aktif</label>

						<input type="text" name="angkatan" value="<?= $detailAngkatan->angkatan ?>" class="form-control"/>

					</div>

						</div>

						<div class="col-md-6">

							<div class="form-group">

			                   <label>Logo</label><br/>

			                   <?php if($detail->LOGO != ''): ?>

			                   <img src="<?= base_url('assets-admin/img/logo/'.$detail->LOGO) ?>" width="130" class="img-circle"/>

			                   <?php else: ?>

			                   <p>-</p>

			                   <?php endif; ?>

			                   <input type="file" name="file_foto" class="form-control"/>

			                   <p>Kosongi jika tidak ingin mengganti logo.</p>

			                </div>

			                <div class="form-group">

			                   <label>Logo Homepage</label><br/>

			                   <?php if($detail->LOGO_HOMEPAGE != ''): ?>

			                   <img src="<?= base_url('assets-admin/img/logo/'.$detail->LOGO_HOMEPAGE) ?>" width="300"/>

			                   <?php else: ?>

			                   <p>-</p>

			                   <?php endif; ?>

			                   <input type="file" name="homepage" class="form-control"/>

			                   <p>Kosongi jika tidak ingin mengganti logo.</p>

			                </div>
			                <div class="form-group">
			                   <label>TKIT</label><br/>
			                   <?php if($detail->FOTO_TKIT != ''): ?>
			                   <img src="<?= base_url('assets/images/banner/'.$detail->FOTO_TKIT) ?>" width="180"/>
			                   <?php else: ?>
			                   <p>-</p>
			                   <?php endif; ?>
			                   <input type="file" name="tkit" class="form-control"/>
			                   <p>Kosongi jika tidak ingin mengganti foto.</p>
			                </div>
			                <div class="form-group">
			                   <label>SMPIT</label><br/>
			                   <?php if($detail->FOTO_SMPIT != ''): ?>
			                   <img src="<?= base_url('assets/images/banner/'.$detail->FOTO_SMPIT) ?>" width="180"/>
			                   <?php else: ?>
			                   <p>-</p>
			                   <?php endif; ?>
			                   <input type="file" name="smpit" class="form-control"/>
			                   <p>Kosongi jika tidak ingin mengganti foto.</p>
			                </div>
							<div class="form-group">
			                   <label>Dokumen Formulir</label><br/>
			                   <?php if($detail->DOKUMEN_PDF != ''): ?>
							   <?= $detail->DOKUMEN_PDF ?>
			                   <?php else: ?>
			                   <p>-</p>
			                   <?php endif; ?>
			                   <input type="file" name="dokumen" class="form-control"/>
			                   <p>Kosongi jika tidak ingin mengganti dokumen.</p>
			                </div>
						</div>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_admin') ?>" class="btn btn-info">Kembali</a>
				</form>

			</div>

		</div>

	</div>

</div>
