<html>

	<head>

		<title>Cetak Detail Akun</title>

		<style>

			label{

				font-weight: bold;

				margin: 0;

			}

			p{

				margin-bottom: 5px;

				margin-top: 5px;

			}

		</style>

	</head>

	<body onload="window.print()">

		<table width="100%" style="margin-bottom: 20px;border: 1px solid black;padding:10px;">

			<tr>

				<td align="center" width="30%">

					<img src="<?= base_url('assets-admin/img/logo/'.$data_infosekolah->LOGO) ?>" width="150px"/>

				</td>

				<td align="center" width="70%" style="font-family: Arial">

					<h3 style="margin: 0">YAYASAN PENDIDIKAN DAN DAKWAH PELITA TAQWA</h3>

					<h3 style="margin: 0">SEKOLAH DASAR ISLAM TERPADU</h3>

					<h3 style="margin: 0"><?= $data_infosekolah->NAMA_SEKOLAH ?></h3>

					<h5 style="margin: 0"><?= $data_infosekolah->ALAMAT_SEKOLAH ?></h5>

				</td>

			</tr>

		</table>

		<div style="text-align: center;margin-bottom: 20px;font-family: Arial;">

			<h4>Biodata <?= $detail->NAMA ?></h4>

		</div>

		<h3 style="font-family: Arial">Informasi Profil</h3>

		<table width="100%" style="font-family: Arial;font-size: 15px;">

			<tr>

				<td valign="top" width="40%">

					<div class="col-md-6">

                        <div class="form-group">

                           <label>NIP</label>

                           <p><?= $detail->NIP ?></p>

                        </div>

                        <div class="form-group">

                           <label>NRP</label>

                          <p><?= $detail->NUPTK ?></p>

                        </div>

                        <div class="form-group">

                           <label>Nama</label>

                           <p><?= $detail->NAMA ?></p>

                        </div>

                        <div class="form-group">

                           <label>Jenis Kelamin</label>

                           <p><?= ($detail->JK == 1 ? "Laki - Laki" : "Perempuan"); ?></p>

                        </div>

                         <div class="form-group">

                           <label>Kepegawaian</label>

                           <?php

                                foreach($data_kepegawaian as $data_kepegawaian):

                             

                             ?>

                             <?= ($data_kepegawaian->ID_KEPEGAWAIAN == $detail->ID_KEPEGAWAIAN ? "<p>".$data_kepegawaian->KEPEGAWAIAN."</p>" : ""); ?>

                          <?php endforeach; ?>

                        </div>

                        <div class="form-group">

                           <label>Jenis PTK</label>

                              <?php

                                 foreach($data_jenis_ptk as $data_jenis_ptk):

                                 

                                 ?>

                                 <?= ($data_jenis_ptk->ID_JNS_PTK == $detail->ID_JNS_PTK ? "<p>".$data_jenis_ptk->JNS_PTK."</p>" : ""); ?>

                              <?php endforeach; ?>

                        </div>

                        <div class="form-group">

                           <label>Telepon</label>

                           <p><?= $detail->TELEPON ?></p>

                        </div>

                        <div class="form-group">

                           <label>No HP <span style="color:red">*</span></label>

                          <p><?= $detail->NO_HP ?></p>

                        </div>

                        <div class="form-group">

                           <label>Email</label>

                           <p><?= $detail->EMAIL ?></p>

                        </div>

                     </div>

				</td>

				<td valign="top" width="45%">

					<div class="col-md-6">

                        <div class="form-group">

                           <label>Agama</label>

                           <p><?= ($detail->AGAMA == 1 ? "Islam" : ($detail->AGAMA == 2 ? "Konghocu" : ($detail->AGAMA == 3 ? "Kristen" : ($detail->AGAMA == 4 ? "Katholik" : ($detail->AGAMA == 5 ? "Buddha" : ($detail->AGAMA == 6 ? "Hindu" : "")))))); ?></p>

                        </div>

                        <div class="form-group">

                           <label>Tempat Lahir</label>

                           <p><?= $detail->TMPT_LAHIR ?></p>

                        </div>

                        <div class="form-group">

                        	<label>Tanggal Lahir</label>

                          <p><?= $detail->TGL_LAHIR ?></p>

                        </div>

                        <div class="form-group">

                        	<label>RT / RW</label>

                          <p><?= $detail->RT ?> / <?= $detail->RW ?></p>

                        </div>

                        <div class="form-group">

                        	<label>Kode POS</label>

                          <p><?= $detail->KODE_POS ?></p>

                        </div>

                        <div class="form-group">

                           <label>Dusun</label>

                           <p><?= $detail->NAMA_DUSUN ?></p>

                        </div>

                        <div class="form-group">

                           <label>Kelurahan</label>

                           <p><?= $detail->DESA_KELURAHAN ?></p>

                        </div>

                        <div class="form-group">

                           <label>Kecamatan</label>

                           <p><?= $detail->KECAMATAN ?></p>

                        </div>

                        <div class="form-group">

                           <label>Alamat</label>

                           <p><?= $detail->ALAMAT_JALAN ?></p>

                        </div>

                        

                     </div>

				</td>

				<td width="15%" valign="top" align="left">

					<div class="form-group">

                           <label>Foto Guru</label><br/>

                           <?php if($detail->FOTO != ''): ?>

                           <img src="<?= base_url('assets-admin/img/guru/'.$detail->FOTO) ?>" width="180" class="img-circle"/>

                           <?php else: ?>

                           <p>-</p>

                           <?php endif; ?>

                        </div>

				</td>

			</tr>

		</table>

		<h3 style="font-family: Arial">Suami / Istri</h3>

		<table width="100%" style="font-family: Arial;font-size: 15px;">

			<tr>

				<td valign="top" width="50%">

					<div class="col-md-6">

                        <div class="form-group">

                           <label>NIK Suami/Istri</label>

                           <p><?= $detail->NIK ?></p>

                        </div>

                        <div class="form-group">

                           <label>Nama Suami/Istri</label>

                           <p><?= $detail->NAMA_SUAMI_ISTRI ?></p>

                        </div>

                        <div class="form-group">

                           <label>NIP Suami/Istri</label>

                           <p><?= $detail->NIP_SUAMI_ISTRI ?></p>

                        </div>

                        <div class="form-group">

                           <label>Pekerjaan Suami/Istri</label>

                           <?php

                                 foreach($data_pekerjaan as $data_pekerjaan):

                                 

                                 ?>

                                 <?= ($data_pekerjaan->ID_PEKERJAAN == $detail->ID_PEKERJAAN_SUAMI_ISTRI ? "<p>".$data_pekerjaan->PEKERJAAN."</p>" : ""); ?>

                              <?php endforeach; ?>

                        </div>

                     </div>

				</td>

				<td valign="top" width="50%">

					<div class="col-md-6">

                     	 <div class="form-group">

                           <label>Tamat PNS</label>

                           <p><?= $detail->TMT_PNS ?></p>

                        </div>

                        <div class="form-group">

                        	<label>Sudah lisensi kepala sekolah</label>

                        	<p><?= ($detail->STS_LISENSI_KEPALA_SEKOLAH == 1 ? "Ya" : "Tidak"); ?></p>

						</div>

						<div class="form-group">

                        	<label>Pernah Diklat Kepengawasan</label>

                        	<p><?= ($detail->STS_DIKLAT_KEPEGAWAIAN == 1 ? "Ya" : "Tidak"); ?></p>

						</div>

						<div class="form-group">

                        	<label>Keahlian Braille</label>

                        	<p><?= ($detail->STS_KEAHLIAN_BRAILLE == 1 ? "Ya" : "Tidak"); ?></p>

						</div>

						<div class="form-group">

                        	<label>Keahlian Bahasa Isyarat</label>

                        	<p><?= ($detail->STS_KEAHLIAN_BAHASA_ISYARAT == 1 ? "Ya" : "Tidak"); ?></p>

						</div>

                     </div>

				</td>

			</tr>

		</table>

		<h3 style="font-family: Arial">Data Bank</h3>

		<table width="100%" style="font-family: Arial;font-size: 15px;">

			<tr>

				<td valign="top">

					<div class="col-md-6">

                        <div class="form-group">

                           <label>Bank</label>

                           <p><?php

                                 foreach($data_bank as $data_bank):

                                 

                                 ?>

                                 <?= ($data_bank->ID_BANK == $detail->ID_BANK ? "<p>".$data_bank->BANK."</p>" : ""); ?>

                              <?php endforeach; ?></p>

                        </div>

                        <div class="form-group">

                           <label>No Rekening Bank</label>

                           <p><?= $detail->NOMOR_REKENING_BANK ?></p>

                        </div>

                        <div class="form-group">

                           <label>Atas Nama</label>

                           <p><?= $detail->REKENING_ATAS_NAMA ?></p>

                        </div>

                     </div>

				</td>

			</tr>

		</table>

		<h3 style="font-family: Arial">Informasi Lainnya</h3>

		<table width="100%" style="font-family: Arial">

			<tr>

				<td valign="top" width="50%">

					<div class="col-md-6">

                        <div class="form-group">

                           <label>SK CPNS</label>

                           <p><?= $detail->SK_CPNS ?></p>

                        </div>

                        <div class="form-group">

                           <label>Tanggal CPNS </label>

                           <p><?= $detail->TGL_CPNS ?></p>

                        </div>

                        <div class="form-group">

                           <label>SK Pengangkatan</label>

                           <p><?= $detail->SK_PENGANGKATAN ?></p>

                        </div>

                        <div class="form-group">

                           <label>Tamat Pengangkatan</label>

                           <p><?= $detail->TMT_PENGANGKATAN ?></p>

                        </div>

                        <div class="form-group">

                           <label>Kewarganegaraan</label>

                           <p><?= $detail->KEWARGANEGARAAN ?></p>

                        </div>

                        <div class="form-group">

                           <label>Tugas Tambahan</label>

                           <p><?= $detail->TUGAS_TAMBAHAN ?></p>

                        </div>

                     </div>

				</td>

				<td valign="top" width="50%">

					 <div class="col-md-6">

                     	<div class="form-group">

                           <label>Lembaga Pengangkatan</label>

                           <p><?= ($detail->ID_LEMBAGA_PENGANGKATAN == 1 ? "Kepala Sekolah" : "Ketua Yayasan"); ?></p>

                        </div>

                        <div class="form-group">

                           <label>Pangkat Golongan</label>

                           <p><?= $detail->PANGKAT_GOLONGAN ?></p>

                        </div>

                        <div class="form-group">

                           <label>Sumber Gaji</label>

                           <p><?php

                                 foreach($data_sumber_gaji as $data_sumber_gaji):

                                 

                                 ?>

                                 <?= ($data_sumber_gaji->ID_SUMBER_GAJI == $detail->ID_SUMBER_GAJI ? "<p>".$data_sumber_gaji->SUMBER_GAJI."</p>" : ""); ?>

                              <?php endforeach; ?>

                           </p>

                        </div>

                        <div class="form-group">

                           <label>Nama Ibu Kandung</label>

                           <p><?= $detail->NAMA_IBU_KANDUNG ?></p>

                        </div>

                        <div class="form-group">

                           <label>Status Perkawinan</label>

                           <p><?= ($detail->STS_PERKAWINAN == 1 ? "Sudah Kawin" : "Belum Kawin"); ?></p>

                        </div>

                     </div>

				</td>

			</tr>

		</table>

	</body>

</html>