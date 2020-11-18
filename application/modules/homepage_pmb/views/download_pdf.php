<div style="text-align: center"><img src="assets-admin/img/logo/<?= $detail->LOGO_HOMEPAGE ?>" style="width: 300px"/></div>
<h2>No Pendaftaran : <?= $this->jariprom_tools->formatPmb($detail_registrasi->ID_PMB, 4); ?></h2>
<br/><br/>
<table style="width: 100%;border-collapse: collapse" border="1" cellpadding="5px">
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