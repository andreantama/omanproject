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
				<form action="<?= base_url('master_bank/editBankSubmit') ?>" method="post">
					<input type="hidden" name="id_bank" value="<?= $this->jariprom_tools->base64_encode_fix($detail->ID_BANK); ?>"/>
					<input type="hidden" name="bank_form" value="<?= $detail->BANK ?>"/>
					<div class="form-group">
						<label>Bank</label>
						<input type="text" name="bank" class="form-control" value="<?= $detail->BANK ?>" required/>
					</div>
					<input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
					<a href="<?= base_url('master_bank') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>