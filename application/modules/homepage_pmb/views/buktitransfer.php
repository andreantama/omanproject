<div class="panel panel-default">
	<div class="panel-body">
        <?php if($this->session->flashdata('notif')): ?>
        <div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('notif'); ?>
        </div>
        <?php endif; ?>
        <form action="<?= base_url('homepage_pmb/buktiTransferSubmit') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama"/>
			</div>
            <div class="form-group">
			   <label>Upload Bukti Transfer</label><br/>
			   <input type="file" name="dokumen" class="form-control"/>
			   <p>File yang diperbolehkan jpg png JPEG jpeg.</p>
			</div>
            <input type="submit" class="btn btn-default" value="Daftar"/> <a href="<?= base_url('homepage_pmb') ?>" class="btn btn-info">Kembali</a>
        </form>
    </div>
</div>