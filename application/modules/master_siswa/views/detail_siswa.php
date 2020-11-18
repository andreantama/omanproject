<div class="row">
   <div class="col-md-12">
      <?php
         if($this->session->flashdata('notif')):
         
         ?>
      <div class="callout callout-<?= $this->session->flashdata('clr') ?>">
         <?= $this->session->flashdata('notif') ?>
      </div>
      <?php endif; ?>
      <form action="<?= base_url('master_siswa/editSiswaSubmit') ?>" method="post" enctype="multipart/form-data">
      	<input type="hidden" name="id_siswa" value="<?= $this->jariprom_tools->base64_encode_fix($detail->NO_SISWA); ?>" class="form-control"/>
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
                           <input type="hidden" name="nisn_form" value="<?= $detail->NISN ?>" class="form-control"/>
                           <input type="text" name="nisn" value="<?= $detail->NISN ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>NIPD <span style="color:red">*</span></label>
                           <input type="hidden" name="nipd_form" value="<?= $detail->NIPD ?>" class="form-control"/>
                           <input type="text" name="nipd" value="<?= $detail->NIPD ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Nama <span style="color:red">*</span></label>
                           <input type="text" name="nama" value="<?= $detail->NAMA ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Jenis Kelamin <span style="color:red">*</span></label>
                           <select name="id_jk" class="form-control select2">
                              <option value="1" <?= ($detail->JK == 1 ? "selected" : ""); ?>>Laki- Laki</option>
                              <option value="2" <?= ($detail->JK == 2 ? "selected" : ""); ?>>Perempuan</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Jenis Transportasi <span style="color:red">*</span></label>
                           <select name="id_jenis_transportasi" class="form-control select2">
                              <?php
                                 foreach($data_transportasi as $data_transportasi):
                                 
                                 ?>
                              <option value="<?= $data_transportasi->ID_ALAT_TRANSPORTASI ?>" <?= ($data_transportasi->ID_ALAT_TRANSPORTASI == $detail->ID_ALAT_TRANSPORTASI ? "selected" : ""); ?>><?= $data_transportasi->ALAT_TRANSPORTASI ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Jenis Tinggal <span style="color:red">*</span></label>
                           <select name="id_jenis_tinggal" class="form-control select2">
                              <?php
                                 foreach($data_jenis_tinggal as $data_jenis_tinggal):
                                 
                                 ?>
                              <option value="<?= $data_jenis_tinggal->ID_JENIS_TINGGAL ?>" <?= ($data_jenis_tinggal->ID_JENIS_TINGGAL == $detail->ID_JENIS_TINGGAL ? "selected" : ""); ?>><?= $data_jenis_tinggal->JENIS_TINGGAL ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Telepon</label>
                           <input type="text" name="no_telepon" value="<?= $detail->TELEPON ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>No HP <span style="color:red">*</span></label>
                           <input type="hidden" name="no_hp_form" value="<?= $detail->NO_HP ?>" class="form-control"/>
                           <input type="text" name="no_hp" value="<?= $detail->NO_HP ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Email</label>
                        	<input type="hidden" name="email_form" value="<?= $detail->EMAIL ?>" class="form-control"/>
                           	<input type="text" name="email" value="<?= $detail->EMAIL ?>" class="form-control"/>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Agama <span style="color:red">*</span></label>
                           <select name="id_agama" class="form-control select2">
                              <option value="1" <?= ($detail->AGAMA == 1 ? "selected" : ""); ?>>Islam</option>
                              <option value="2" <?= ($detail->AGAMA == 2 ? "selected" : ""); ?>>Konghocu</option>
                              <option value="3" <?= ($detail->AGAMA == 3 ? "selected" : ""); ?>>Kristen</option>
                              <option value="4" <?= ($detail->AGAMA == 4 ? "selected" : ""); ?>>Katholik</option>
                              <option value="5" <?= ($detail->AGAMA == 5 ? "selected" : ""); ?>>Buddha</option>
                              <option value="6" <?= ($detail->AGAMA == 6 ? "selected" : ""); ?>>Hindu</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Tempat Lahir <span style="color:red">*</span></label>
                           <input type="text" name="tempat_lahir_siswa" value="<?= $detail->TMPT_LAHIR ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Tanggal Lahir <span style="color:red">*</span></label>
                           <input type="text" name="tgl_lahir_siswa" value="<?= $detail->TGL_LAHIR ?>" id="tgl_lahir_siswa" readonly class="form-control"/>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>RT</label>
                                 <input type="text" name="rt" value="<?= $detail->RT ?>" class="form-control"/>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>RW</label>
                                 <input type="text" name="rw" value="<?= $detail->RW ?>" class="form-control"/>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label>Kode POS</label>
                           <input type="text" name="kode_pos" value="<?= $detail->KODE_POS ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Dusun</label>
                           <input type="text" name="dusun" value="<?= $detail->DUSUN ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Kelurahan</label>
                           <input type="text" name="kelurahan" value="<?= $detail->KELURAHAN ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Kecamatan</label>
                           <input type="text" name="kecamatan" value="<?= $detail->KECAMATAN ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Alamat</label>
                           <textarea name="alamat" class="form-control"><?= $detail->ALAMAT ?></textarea>
                        </div>
                        <div class="form-group">
                           <label>Foto Siswa</label><br/>
                           <?php if($detail->FOTO != ''): ?>
                           <img src="<?= base_url('assets-admin/img/siswa/'.$detail->FOTO) ?>" width="130" class="img-circle"/>
                           <?php else: ?>
                           <p>-</p>
                           <?php endif; ?>
                           <input type="file" name="file_foto" class="form-control"/>
                           <p>Kosongi jika tidak ingin mengganti foto.</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="tab_2">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>NIK <span style="color:red">*</span></label>
                           <input type="text" name="nik_ayah" value="<?= $detail->NIK_AYAH ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Nama Ayah <span style="color:red">*</span></label>
                           <input type="text" name="nama_ayah" value="<?= $detail->NAMA_AYAH ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Penghasilan Ayah</label>
                           <div class="row">
                              <div class="col-md-5">
                                 <input type="text" name="penghasilan_ayah_1" value="<?= $detail->PENGHASILAN_AYAH_1 ?>" class="form-control"/>
                              </div>
                              <div class="col-md-2 text-center">
                                 S/d
                              </div>
                              <div class="col-md-5">
                                 <input type="text" name="penghasilan_ayah_2" value="<?= $detail->PENGHASILAN_AYAH_2 ?>" class="form-control"/>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Tanggal Lahir <span style="color:red">*</span></label>
                           <input type="text" name="tgl_lahir_ayah" value="<?= $detail->TGL_LAHIR_AYAH ?>" id="tgl_lahir_ayah" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Jenjang Pendidikan <span style="color:red">*</span></label>
                           <select name="id_jenjang_ayah" class="form-control select2">
                              <?php
                                 foreach($data_jenjang_pendidikan_ayah as $data_jenjang_pendidikan_ayah):
                                 
                                 ?>
                              <option value="<?= $data_jenjang_pendidikan_ayah->ID_JENJANG_PENDIDIKAN ?>" <?= ($data_jenjang_pendidikan_ayah->ID_JENJANG_PENDIDIKAN == $detail->ID_JENJANG_PENDIDIKAN_AYAH ? "selected" : ""); ?>><?= $data_jenjang_pendidikan_ayah->JENJANG_PENDIDIKAN ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Pekerjaan Ayah <span style="color:red">*</span></label>
                           <select name="id_pekerjaan_ayah" class="form-control select2">
                              <?php
                                 foreach($data_pekerjaan_ayah as $data_pekerjaan_ayah):
                                 
                                 ?>
                              <option value="<?= $data_pekerjaan_ayah->ID_PEKERJAAN ?>" <?= ($data_pekerjaan_ayah->ID_PEKERJAAN == $detail->ID_PEKERJAAN_AYAH ? "selected" : ""); ?>><?= $data_pekerjaan_ayah->PEKERJAAN ?></option>
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
                           <label>NIK <span style="color:red">*</span></label>
                           <input type="text" name="nik_ibu" value="<?= $detail->NIK_IBU ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Nama Ibu <span style="color:red">*</span></label>
                           <input type="text" name="nama_ibu" value="<?= $detail->NAMA_IBU ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Penghasilan Ibu</label>
                           <div class="row">
                              <div class="col-md-5">
                                 <input type="text" name="penghasilan_ibu_1" value="<?= $detail->PENGHASILAN_IBU_1 ?>" class="form-control"/>
                              </div>
                              <div class="col-md-2 text-center">
                                 S/d
                              </div>
                              <div class="col-md-5">
                                 <input type="text" name="penghasilan_ibu_2" value="<?= $detail->PENGHASILAN_IBU_2 ?>" class="form-control"/>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Tanggal Lahir <span style="color:red">*</span></label>
                           <input type="text" name="tgl_lahir_ibu" id="tgl_lahir_ibu" value="<?= $detail->TGL_LAHIR_IBU ?>" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Jenjang Pendidikan <span style="color:red">*</span></label>
                           <select name="id_jenjang_ibu" class="form-control select2">
                              <?php
                                 foreach($data_jenjang_pendidikan_ibu as $data_jenjang_pendidikan_ibu):
                                 
                                 ?>
                              <option value="<?= $data_jenjang_pendidikan_ibu->ID_JENJANG_PENDIDIKAN ?>" <?= ($data_jenjang_pendidikan_ibu->ID_JENJANG_PENDIDIKAN == $detail->ID_JENJANG_PENDIDIKAN_IBU ? "selected" : ""); ?>><?= $data_jenjang_pendidikan_ibu->JENJANG_PENDIDIKAN ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Pekerjaan Ibu <span style="color:red">*</span></label>
                           <select name="id_pekerjaan_ibu" class="form-control select2">
                              <?php
                                 foreach($data_pekerjaan_ibu as $data_pekerjaan_ibu):
                                 
                                 ?>
                              <option value="<?= $data_pekerjaan_ibu->ID_PEKERJAAN ?>" <?= ($data_pekerjaan_ibu->ID_PEKERJAAN == $detail->ID_PEKERJAAN_IBU ? "selected" : ""); ?>><?= $data_pekerjaan_ibu->PEKERJAAN ?></option>
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
                           <input type="text" value="<?= $detail->NIK_WALI ?>" name="nik_wali" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Nama Wali</label>
                           <input type="text" name="nama_wali" value="<?= $detail->NAMA_WALI ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Penghasilan Wali</label>
                           <div class="row">
                              <div class="col-md-5">
                                 <input type="text" name="penghasilan_wali_1" value="<?= $detail->PENGHASILAN_WALI_1 ?>" class="form-control"/>
                              </div>
                              <div class="col-md-2 text-center">
                                 S/d
                              </div>
                              <div class="col-md-5">
                                 <input type="text" name="penghasilan_wali_2" value="<?= $detail->PENGHASILAN_WALI_2 ?>" class="form-control"/>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Tanggal Lahir</label>
                           <input type="text" name="tgl_lahir_wali" value="<?= $detail->TGL_LAHIR_WALI ?>" id="tgl_lahir_wali" readonly class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Jenjang Pendidikan</label>
                           <select name="id_jenjang_wali" class="form-control select2">
                              <?php
                                 foreach($data_jenjang_pendidikan_wali as $data_jenjang_pendidikan_wali):
                                 
                                 ?>
                              <option value="<?= $data_jenjang_pendidikan_wali->ID_JENJANG_PENDIDIKAN ?>" <?= ($data_jenjang_pendidikan_wali->ID_JENJANG_PENDIDIKAN == $detail->ID_JENJANG_PENDIDIKAN_WALI ? "selected" : ""); ?>><?= $data_jenjang_pendidikan_wali->JENJANG_PENDIDIKAN ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Pekerjaan Wali</label>
                           <select name="id_pekerjaan_wali" class="form-control select2">
                              <?php
                                 foreach($data_pekerjaan_wali as $data_pekerjaan_wali):
                               ?>
                              <option value="<?= $data_pekerjaan_wali->ID_PEKERJAAN ?>" <?= ($data_pekerjaan_wali->ID_PEKERJAAN == $detail->ID_PEKERJAAN_WALI ? "selected" : ""); ?>><?= $data_pekerjaan_wali->PEKERJAAN ?></option>
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
                              <option value="<?= $data_bank->ID_BANK ?>" <?= ($data_bank->ID_BANK == $detail->ID_BANK ? "selected" : ""); ?>><?= $data_bank->BANK ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>No Rekening Bank</label>
                           <input type="text" name="no_rekening" value="<?= $detail->NOMOR_REKENING_BANK ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Atas Nama</label>
                           <input type="text" name="atas_nama" value="<?= $detail->REKENING_ATAS_NAMA ?>" class="form-control"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="tab_6">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>No. Peserta Ujian Nasional</label>
                           <input type="text" name="no_peserta_ujian_nasional" value="<?= $detail->NO_PESERTA_UJIAN_NASIONAL ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>SKHUN</label>
                           <input type="text" name="skhun" value="<?= $detail->SKHUN ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>No. Seri Ijazah</label>
                           <input type="text" name="no_seri_ijazah" value="<?= $detail->NO_SERI_IJAZAH ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>No KKS</label>
                           <input type="text" name="no_kks" value="<?= $detail->NOMOR_KKS ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Sekolah Asal</label>
                           <input type="text" name="sekolah_asal" value="<?= $detail->SEKOLAH_ASAL ?>" class="form-control"/>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>No Registrasi Akta Lahir</label>
                           <input type="text" name="no_registrasi_lahir" value="<?= $detail->NO_REGISTRASI_AKTA_LAHIR ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Layak PIP</label>
                           <input type="text" name="layak_pip" value="<?= $detail->LAYAK_PIP ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <label>Kebutuhan Khusus</label>
                           <textarea name="kebutuhan_khusus" class="form-control"><?= $detail->KEBUTUHAN_KHUSUS ?></textarea>
                        </div>
                        <div class="form-group">
                           <label>Rombel</label>
                           <input type="text" name="rombel" value="<?= $detail->ROMBEL ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <input type="checkbox" name="name_kps" <?= ($detail->NO_KPS != '' ? "checked" : ""); ?> value="true" id="id_kps"/> Penerima KPS
                        </div>
                        <div class="form-group ex_kps" style="display: none;">
                           <label>No KPS</label>
                           <input type="text" name="no_kps" id="val_kps" value="<?= ($detail->NO_KPS != '' ? $detail->NO_KPS : ""); ?>" class="form-control"/>
                        </div>
                        <div class="form-group">
                           <input type="checkbox" id="id_kip" value="true" <?= ($detail->NOMOR_KIP != '' ? "checked" : ""); ?> name="name_kip"/> Penerima KIP
                        </div>
                        <div class="form-group ex_kip" style="display: none;">
                           <label>No KIP</label>
                           <input type="text" name="no_kip" id="val_kip" value="<?= ($detail->NOMOR_KIP != '' ? $detail->NOMOR_KIP : ""); ?>" class="form-control"/>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel panel-default">
            <div class="panel-body">
               <input type="submit" class="btn btn-default" value="Perbaharui Informasi"/>
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