<h4>Pilih mata pelajaran</h4>
<select name="id_listmapelguru[]" multiple="multiple" class="form-control select5" required>
 <?php
 	$a = 0;
     foreach($list_mapel as $list_mapel):
     
     ?>
  <option value="<?= $list_mapel->ID_MAPEL ?>"><?= $list_mapel->MAPEL ?></option>
  <?php endforeach; ?>
  </select>
  <script>
  	$('.select5').select2();
  </script>