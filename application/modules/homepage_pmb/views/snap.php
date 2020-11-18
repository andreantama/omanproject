<?php if($this->session->flashdata('notif')): ?>
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<?php endif; ?>
<div class="panel panel-default">
	<div class="panel-body">
		<h4>No Pendaftaran : <?= $this->jariprom_tools->formatPmb($detail_registrasi->ID_PMB, 4); ?></h4>
		<table class="table table-striped">
			<tr>
				<td>
					Nama
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->NAMA; ?>
				</td>
			</tr>
			<tr>
				<td>
					Jenis Kelamin
				</td>
				<td>
					:
				</td>
				<td>
					<?= ($detail_registrasi->JK == 1 ? 'Laki - Laki' : 'Perempuan'); ?>
				</td>
			</tr>
			<tr>
				<td>
					Tempat Lahir
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->TMPT_LAHIR; ?>
				</td>
			</tr>
			<tr>
				<td>
					Tanggal Lahir
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->TGL_LAHIR; ?>
				</td>
			</tr>
			<tr>
				<td>
					Alamat
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->ALAMAT; ?>
				</td>
			</tr>
			<tr>
				<td>
					Nama Ayah
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->NAMA_AYAH; ?>
				</td>
			</tr>
			<tr>
				<td>
					Nama Ibu
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->NAMA_IBU; ?>
				</td>
			</tr>
			<tr>
				<td>
					No Handphone
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->NO_HANDPHONE; ?>
				</td>
			</tr>
			<tr>
				<td>
					Waktu Pendaftaran PMB
				</td>
				<td>
					:
				</td>
				<td>
					<?= $detail_registrasi->TGL_PMB.' '.$detail_registrasi->WKT_PMB; ?>
				</td>
			</tr>
		</table>
		<a href="#" onclick="window.open('<?php echo base_url('homepage_pmb/cetakPmb/'.$this->jariprom_tools->base64_encode_fix($detail_registrasi->ID_PMB))?>', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0')" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a> <a href="<?= base_url('homepage_pmb/cetakPdf/'.$this->jariprom_tools->base64_encode_fix($detail_registrasi->ID_PMB)) ?>" class="btn btn-default"><i class="fa fa-file"></i> Unduh PDF</a> <a href="<?= base_url('homepage_pmb/') ?>" class="btn btn-info">Kembali</a>
	</div>
</div>