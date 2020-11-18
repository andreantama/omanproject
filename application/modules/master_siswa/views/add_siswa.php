<div class="row">

	<div class="col-md-12">

	<?php

		if($this->session->flashdata('notif')):

	?>

	<div class="callout callout-<?= $this->session->flashdata('clr') ?>">

		<?= $this->session->flashdata('notif') ?>

	</div>

	<?php endif; ?>

	<form action="<?= base_url('master_siswa/addSiswaSubmit') ?>" method="post" enctype="multipart/form-data">

	<div class="nav-tabs-custom">

            <ul class="nav nav-tabs">

              <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle"></i> Informasi</a></li>

              <li class=""><a href="#tab_2" data-toggle="tab"><i class="fa fa-user"></i> Data Ayah</a></li>

              <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-user"></i> Data Ibu</a></li>

              <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-user"></i> Data Wali</a></li>

              <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-home"></i> Data Bank</a></li>

              <li><a href="#tab_6" data-toggle="tab"><i class="fa fa-list"></i> Informasi Lainnya</a></li>

            </ul>

            <div class="tab-content">

              <div class="tab-pane active" id="tab_1">

              	<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>NISN <span style="color:red">*</span></label>

							<input type="text" name="nisn" class="form-control"/>

						</div>

						<div class="form-group">

							<label>NIPD <span style="color:red">*</span></label>

							<input type="text" name="nipd" class="form-control"/>

							<p class="text-muted">Digunakan untuk login</p>

						</div>

						<div class="form-group">

							<label>Nama <span style="color:red">*</span></label>

							<input type="text" name="nama" class="form-control"/>

						</div>

						<div class="form-group">

			      			<label>Jenis Kelamin</label>

			      			<select name="id_jk" class="form-control select2">

			      				 <option value="1">Laki- Laki</option>

			      				 <option value="2">Perempuan</option>

			      			</select>

			      		</div>

						<div class="form-group">

			      			<label>Jenis Transportasi</label>

			      			<select name="id_jenis_transportasi" class="form-control select2">

			      				<?php

			      					foreach($data_transportasi as $data_transportasi):

			      				?>

			      				 <option value="<?= $data_transportasi->ID_ALAT_TRANSPORTASI ?>"><?= $data_transportasi->ALAT_TRANSPORTASI ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

			      		<div class="form-group">

			      			<label>Jenis Tinggal</label>

			      			<select name="id_jenis_tinggal" class="form-control select2">

			      				<?php

			      					foreach($data_jenis_tinggal as $data_jenis_tinggal):

			      				?>

			      				 <option value="<?= $data_jenis_tinggal->ID_JENIS_TINGGAL ?>"><?= $data_jenis_tinggal->JENIS_TINGGAL ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

						<div class="form-group">

							<label>Telepon</label>

							<input type="text" name="no_telepon" class="form-control"/>

						</div>

						<div class="form-group">

							<label>No HP</label>

							<input type="text" name="no_hp" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Email</label>

							<input type="text" name="email" class="form-control"/>

						</div>
					</div>

					<div class="col-md-6">

						<div class="form-group">

			      			<label>Agama</label>

			      			<select name="id_agama" class="form-control select2">

			      				 <option value="1">Islam</option>

			      				 <option value="2">Konghocu</option>

			      				 <option value="3">Kristen</option>

			      				 <option value="4">Katholik</option>

			      				 <option value="5">Buddha</option>

			      				 <option value="6">Hindu</option>

			      			</select>

			      		</div>

						<div class="form-group">

							<label>Tempat Lahir</label>

							<input type="text" name="tempat_lahir_siswa" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Tanggal Lahir</label>

							<input type="text" name="tgl_lahir_siswa" id="tgl_lahir_siswa" readonly class="form-control"/>

						</div>

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label>RT</label>

									<input type="text" name="rt" class="form-control"/>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label>RW</label>

									<input type="text" name="rw" class="form-control"/>

								</div>

							</div>

						</div>

						<div class="form-group">

							<label>Kode POS</label>

							<input type="text" name="kode_pos" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Dusun</label>

							<input type="text" name="dusun" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Kelurahan</label>

							<input type="text" name="kelurahan" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Kecamatan</label>

							<input type="text" name="kecamatan" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Alamat</label>

							<textarea name="alamat" class="form-control"></textarea>

						</div>

						<div class="form-group">

							<label>Foto Siswa</label>

							<input type="file" name="file_foto" class="form-control"/>

						</div>

					</div>

				</div>

              </div>

              <div class="tab-pane" id="tab_2">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>NIK</label>

							<input type="text" name="nik_ayah" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Nama Ayah</label>

							<input type="text" name="nama_ayah" class="form-control"/>

						</div>

			      		<div class="form-group">

			      			<label>Penghasilan Ayah</label>

			      			<div class="row">

								<div class="col-md-5">

									<input type="text" name="penghasilan_ayah_1" class="form-control"/>

								</div>

								<div class="col-md-2 text-center">

									S/d

								</div>

								<div class="col-md-5">

									<input type="text" name="penghasilan_ayah_2" class="form-control"/>

								</div>

							</div>

			      		</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Tanggal Lahir</label>

							<input type="text" name="tgl_lahir_ayah" id="tgl_lahir_ayah" readonly class="form-control"/>

						</div>

						<div class="form-group">

			      			<label>Jenjang Pendidikan</label>

			      			<select name="id_jenjang_ayah" class="form-control select2">

			      				<?php

			      					foreach($data_jenjang_pendidikan_ayah as $data_jenjang_pendidikan_ayah):

			      				?>

			      				 <option value="<?= $data_jenjang_pendidikan_ayah->ID_JENJANG_PENDIDIKAN ?>"><?= $data_jenjang_pendidikan_ayah->JENJANG_PENDIDIKAN ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

			      		<div class="form-group">

			      			<label>Pekerjaan Ayah</label>

			      			<select name="id_pekerjaan_ayah" class="form-control select2">

			      				<?php

			      					foreach($data_pekerjaan_ayah as $data_pekerjaan_ayah):

			      				?>

			      				 <option value="<?= $data_pekerjaan_ayah->ID_PEKERJAAN ?>"><?= $data_pekerjaan_ayah->PEKERJAAN ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

					</div>

				</div>

              </div>

              <div class="tab-pane" id="tab_3">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>NIK</label>

							<input type="text" name="nik_ibu" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Nama Ibu</label>

							<input type="text" name="nama_ibu" class="form-control"/>

						</div>

			      		<div class="form-group">

			      			<label>Penghasilan Ibu</label>

			      			<div class="row">

								<div class="col-md-5">

									<input type="text" name="penghasilan_ibu_1" class="form-control"/>

								</div>

								<div class="col-md-2 text-center">

									S/d

								</div>

								<div class="col-md-5">

									<input type="text" name="penghasilan_ibu_2" class="form-control"/>

								</div>

							</div>

			      		</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Tanggal Lahir</label>

							<input type="text" name="tgl_lahir_ibu" id="tgl_lahir_ibu" readonly class="form-control"/>

						</div>

						<div class="form-group">

			      			<label>Jenjang Pendidikan</label>

			      			<select name="id_jenjang_ibu" class="form-control select2">

			      				<?php

			      					foreach($data_jenjang_pendidikan_ibu as $data_jenjang_pendidikan_ibu):

			      				?>

			      				 <option value="<?= $data_jenjang_pendidikan_ibu->ID_JENJANG_PENDIDIKAN ?>"><?= $data_jenjang_pendidikan_ibu->JENJANG_PENDIDIKAN ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

			      		<div class="form-group">

			      			<label>Pekerjaan Ibu</label>

			      			<select name="id_pekerjaan_ibu" class="form-control select2">

			      				<?php

			      					foreach($data_pekerjaan_ibu as $data_pekerjaan_ibu):

			      				?>

			      				 <option value="<?= $data_pekerjaan_ibu->ID_PEKERJAAN ?>"><?= $data_pekerjaan_ibu->PEKERJAAN ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

					</div>

				</div>

              </div>

              <div class="tab-pane" id="tab_4">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>NIK</label>

							<input type="text" name="nik_wali" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Nama Wali</label>

							<input type="text" name="nama_wali" class="form-control"/>

						</div>

			      		<div class="form-group">

			      			<label>Penghasilan Wali</label>

			      			<div class="row">

								<div class="col-md-5">

									<input type="text" name="penghasilan_wali_1" class="form-control"/>

								</div>

								<div class="col-md-2 text-center">

									S/d

								</div>

								<div class="col-md-5">

									<input type="text" name="penghasilan_wali_2" class="form-control"/>

								</div>

							</div>

			      		</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Tanggal Lahir</label>

							<input type="text" name="tgl_lahir_wali" id="tgl_lahir_wali" readonly class="form-control"/>

						</div>

						<div class="form-group">

			      			<label>Jenjang Pendidikan</label>

			      			<select name="id_jenjang_wali" class="form-control select2">

			      				<?php

			      					foreach($data_jenjang_pendidikan_wali as $data_jenjang_pendidikan_wali):

			      				?>

			      				 <option value="<?= $data_jenjang_pendidikan_wali->ID_JENJANG_PENDIDIKAN ?>"><?= $data_jenjang_pendidikan_wali->JENJANG_PENDIDIKAN ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

			      		<div class="form-group">

			      			<label>Pekerjaan Wali</label>

			      			<select name="id_pekerjaan_wali" class="form-control select2">

			      				<?php

			      					foreach($data_pekerjaan_wali as $data_pekerjaan_wali):

			      				?>

			      				 <option value="<?= $data_pekerjaan_wali->ID_PEKERJAAN ?>"><?= $data_pekerjaan_wali->PEKERJAAN ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

					</div>

				</div>

              </div>

              <div class="tab-pane" id="tab_5">

                <div class="row">

				<div class="col-md-6">

						<div class="form-group">

			      			<label>Bank</label>

			      			<select name="id_bank" class="form-control select2">

			      				<?php

			      					foreach($data_bank as $data_bank):

			      				?>

			      				 <option value="<?= $data_bank->ID_BANK ?>"><?= $data_bank->BANK ?></option>

			      				 <?php endforeach; ?>

			      			</select>

			      		</div>

			      		<div class="form-group">

							<label>No Rekening Bank</label>

							<input type="text" name="no_rekening" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Atas Nama</label>

							<input type="text" name="atas_nama" class="form-control"/>

						</div>

				</div>

              </div>

              </div>

				<div class="tab-pane" id="tab_6">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>No. Peserta Ujian Nasional</label>

							<input type="text" name="no_peserta_ujian_nasional" class="form-control"/>

						</div>

						<div class="form-group">

							<label>SKHUN</label>

							<input type="text" name="skhun" class="form-control"/>

						</div>

						

						<div class="form-group">

							<label>No. Seri Ijazah</label>

							<input type="text" name="no_seri_ijazah" class="form-control"/>

						</div>

						<div class="form-group">

							<label>No KKS</label>

							<input type="text" name="no_kks" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Sekolah Asal</label>

							<input type="text" name="sekolah_asal" class="form-control"/>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>No Registrasi Akta Lahir</label>

							<input type="text" name="no_registrasi_lahir" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Layak PIP</label>

							<input type="text" name="layak_pip" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Kebutuhan Khusus</label>

							<input type="text" name="kebutuhan_khusus" class="form-control"/>

						</div>

						<div class="form-group">

							<label>Rombel</label>

							<input type="text" name="rombel" class="form-control"/>

						</div>

						<div class="form-group">

							<input type="checkbox" name="name_kps" value="true" id="id_kps"/> Penerima KPS

						</div>

						<div class="form-group ex_kps" style="display: none;">

							<label>No KPS</label>

							<input type="text" name="no_kps" id="val_kps" class="form-control"/>

						</div>

						<div class="form-group">

							<input type="checkbox" id="id_kip" value="true" name="name_kip"/> Penerima KIP

						</div>

						<div class="form-group ex_kip" style="display: none;">

							<label>No KIP</label>

							<input type="text" name="no_kip" id="val_kip" class="form-control"/>

						</div>

					</div>

				</div>

              </div>

            </div>

          </div>

	<div class="panel panel-default">

		<div class="panel-body">

			<input type="submit" class="btn btn-default" value="Tambah Siswa"/>

			<a href="<?= base_url('master_siswa') ?>" class="btn btn-info">Kembali</a>

		</div>

	</div>

	</form>

	</div>

</div>

<script>

	 	$(document).ready(function () {

	 		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

				  $(".select2").select2();

			});

			$('#id_kps').change(function() {

		        if(this.checked) {

		            $('.ex_kps').show();

		            $('#val_kps').val('');

		        }

		        else{

					$('.ex_kps').hide();

					$('#val_kps').val('');

				}

		    });

		    $('#id_kip').change(function() {

		        if(this.checked) {

		            $('.ex_kip').show();

		            $('#val_kip').val('');

		        }

		        else{

					$('.ex_kip').hide();

					$('#val_kip').val('');

				}

		    });

 			$(".select2").select2();

 			$('#tgl_lahir_siswa').datepicker({

			  autoclose: true,

			  format: 'yyyy-mm-dd'

			});

			$('#tgl_lahir_ayah').datepicker({

			  autoclose: true,

			  format: 'yyyy-mm-dd'

			});

			$('#tgl_lahir_ibu').datepicker({

			  autoclose: true,

			  format: 'yyyy-mm-dd'

			});

			$('#tgl_lahir_wali').datepicker({

			  autoclose: true,

			  format: 'yyyy-mm-dd'

			});

 		});

</script>