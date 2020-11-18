<div class="row">

   <div class="col-md-12">

      <?php

         if($this->session->flashdata('notif')):

         

         ?>

      <div class="callout callout-<?= $this->session->flashdata('clr') ?>">

         <?= $this->session->flashdata('notif') ?>

      </div>

      <?php endif; ?>

      <form action="<?= base_url('master_guru/addGuruSubmit') ?>" method="post" enctype="multipart/form-data">

         <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">

               <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle"></i> Informasi</a></li>

               <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-user"></i> Data Suami/Istri</a></li>

               <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-home"></i> Data Bank</a></li>

               <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-list"></i> Informasi Lainnya</a></li>

            </ul>

            <div class="tab-content">

               <div class="tab-pane active" id="tab_1">

                  <div class="row">

                     <div class="col-md-6">

                        <div class="form-group">

                           <label>NIP <span style="color:red">*</span></label>

                           <input type="text" name="nip" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>NRP <span style="color:red">*</span></label>

                           <input type="text" name="nuptk" class="form-control"/>

                           <p class="text-muted">Digunakan untuk login</p>

                        </div>

                        <div class="form-group">

                           <label>Nama <span style="color:red">*</span></label>

                           <input type="text" name="nama" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Jenis Kelamin <span style="color:red">*</span></label>

                           <select name="id_jk" class="form-control select2">

                              <option value="1">Laki- Laki</option>

                              <option value="2">Perempuan</option>

                           </select>

                        </div>

                         <div class="form-group">

                           <label>Kepegawaian</label>

                           <select name="id_kepegawaian" class="form-control select2">

                              <?php

                                 foreach($data_kepegawaian as $data_kepegawaian):

                                 

                                 ?>

                              <option value="<?= $data_kepegawaian->ID_KEPEGAWAIAN ?>"><?= $data_kepegawaian->KEPEGAWAIAN ?></option>

                              <?php endforeach; ?>

                           </select>

                        </div>

                        <div class="form-group">

                           <label>Jenis PTK</label>

                           <select name="id_jenis_ptk" class="form-control select2">

                              <?php

                                 foreach($data_jenis_ptk as $data_jenis_ptk):

                                 

                                 ?>

                              <option value="<?= $data_jenis_ptk->ID_JNS_PTK ?>"><?= $data_jenis_ptk->JNS_PTK ?></option>

                              <?php endforeach; ?>

                           </select>

                        </div>

                        <div class="form-group">

                           <label>Telepon</label>

                           <input type="text" name="no_telepon" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>No HP <span style="color:red">*</span></label>

                           <input type="text" name="no_hp" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Email</label>

                           <input type="text" name="email" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Password <span style="color:red">*</span></label>

                           <input type="password" name="password" class="form-control"/>

                        </div>

                     </div>

                     <div class="col-md-6">

                        <div class="form-group">

                           <label>Agama <span style="color:red">*</span></label>

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

                           <label>Tempat Lahir <span style="color:red">*</span></label>

                           <input type="text" name="tempat_lahir_guru" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Tanggal Lahir <span style="color:red">*</span></label>

                           <input type="text" name="tgl_lahir_guru" id="tgl_lahir_guru" readonly class="form-control"/>

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

                           <label>Foto Guru</label>

                           <input type="file" name="file_foto" class="form-control"/>

                        </div>
                        <div class="form-group">

                           <label>TTD Guru</label>

                           <input type="file" name="file_ttd_guru" class="form-control"/>
                           <p>Ukuran maks ( 200x100 pixel )</p>
                        </div>

                     </div>

                  </div>

               </div>

               <div class="tab-pane" id="tab_2">

                  <div class="row">

                     <div class="col-md-6">

                        <div class="form-group">

                           <label>NIK Suami/Istri</label>

                           <input type="text" name="nik_suami_istri" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Nama Suami/Istri</label>

                           <input type="text" name="nama_suami_istri" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>NIP Suami/Istri</label>

                           <input type="text" name="nip_suami_istri" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Pekerjaan Suami/Istri</label>

                           <select name="id_pekerjaan_suami_istri" class="form-control select2">

                              <?php

                                 foreach($data_pekerjaan as $data_pekerjaan):

                                 

                                 ?>

                              <option value="<?= $data_pekerjaan->ID_PEKERJAAN ?>"><?= $data_pekerjaan->PEKERJAAN ?></option>

                              <?php endforeach; ?>

                           </select>

                        </div>

                     </div>

                     <div class="col-md-6">

                     	 <div class="form-group">

                           <label>Tamat PNS</label>

                           <input type="text" name="tamat_pns" class="form-control"/>

                        </div>

                        <div class="form-group">

							<input type="checkbox" name="lisensi_kepala_sekolah" value="true" id="id_kps"/> Sudah lisensi kepala sekolah

						</div>

						<div class="form-group">

							<input type="checkbox" name="diklat_kepengawasan" value="true" id="id_kps"/> Pernah Diklat Kepengawasan

						</div>

						<div class="form-group">

							<input type="checkbox" name="keahlian_braille" value="true" id="id_kps"/> Keahlian Braille

						</div>

						<div class="form-group">

							<input type="checkbox" name="keahlian_bahasa_isyarat" value="true" id="id_kps"/> Keahlian Bahasa Isyarat

						</div>

                     </div>

                  </div>

               </div>

			<div class="tab-pane" id="tab_3">

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

                     <div class="col-md-6">

                     	 <div class="form-group">

                           <label>NPWP</label>

                           <input type="text" name="npwp" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Nama Wajib Pajak</label>

                           <input type="text" name="nama_wajib_pajak" class="form-control"/>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="tab-pane" id="tab_4">

                  <div class="row">

                     <div class="col-md-6">

                        <div class="form-group">

                           <label>SK CPNS</label>

                           <input type="text" name="sk_cpns" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Tanggal CPNS </label>

                           <input type="text" name="tgl_cpns" id="tgl_cpns" readonly class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>SK Pengangkatan</label>

                           <input type="text" name="sk_pengangkatan" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Tamat Pengangkatan</label>

                           <input type="text" name="tmt_pengangkatan" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Kewarganegaraan</label>

                           <input type="text" name="kewarganegaraan" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Tugas Tambahan</label>

                           <textarea class="form-control" name="tugas_tambahan"></textarea>

                        </div>

                     </div>

                     <div class="col-md-6">

                     	<div class="form-group">

                           <label>Lembaga Pengangkatan</label>

                           <select name="id_lembaga_pengangkatan" class="form-control select2">

                              <option value="1">Kepala Sekolah</option>

                              <option value="2">Ketua Yayasan</option>

                           </select>

                        </div>

                        <div class="form-group">

                           <label>Pangkat Golongan</label>

                           <input type="text" name="pangkat_golongan" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Sumber Gaji</label>

                           <select name="id_sumber_gaji" class="form-control select2">

                              <?php

                                 foreach($data_sumber_gaji as $data_sumber_gaji):

                                 

                                 ?>

                              <option value="<?= $data_sumber_gaji->ID_SUMBER_GAJI ?>"><?= $data_sumber_gaji->SUMBER_GAJI ?></option>

                              <?php endforeach; ?>

                           </select>

                        </div>

                        <div class="form-group">

                           <label>Nama Ibu Kandung</label>

                           <input type="text" name="nama_ibu_kandung" class="form-control"/>

                        </div>

                        <div class="form-group">

                           <label>Status Perkawinan</label>

                           <select name="id_status_perkawinan" class="form-control select2">

                              <option value="1">Sudah Kawin</option>

                              <option value="2">Belum Kawin</option>

                           </select>

                        </div>

                     </div>

                  </div>

               </div>

            </div>

         </div>

         <div class="panel panel-default">

            <div class="panel-body">

               <input type="submit" class="btn btn-default" value="Tambah Guru"/>

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

   	$(".select2").select2();

   $('#tgl_lahir_guru').datepicker({



			  autoclose: true,



			  format: 'yyyy-mm-dd'



			});

			$('#tgl_cpns').datepicker({



			  autoclose: true,



			  format: 'yyyy-mm-dd'



			});

   });

   

</script>