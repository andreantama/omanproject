<div class="side-menu-bg">
	<div class="top"></div>
		<div class="middle">
			<ul id="side-menu">
	<div style="display:none;">
		</div>
			<?php
				$check = $this->db->query('SELECT * FROM tbl_menu where ID_MENUWEB='.$this->uri->segment(3))->row();
				if($check->ID_PARENT == 0):
					$sql = $this->db->query('SELECT * FROM tbl_menu where ID_PARENT='.$this->uri->segment(3))->result();
				?>
        	<?php foreach($sql as $data): ?>
            <li><a href="<?= base_url('homepage_halaman/detail/'.$data->ID_MENUWEB) ?>"><?= $data->NAMA_MENU ?></a></li>
            <?php endforeach; ?>
            <?php else: ?>
            <?php
            	$id_parent = $this->db->query('SELECT * FROM tbl_menu where ID_MENUWEB='.$this->uri->segment(3))->row();
            	$sql = $this->db->query('SELECT * FROM tbl_menu where ID_PARENT='.$id_parent->ID_PARENT)->result();
            ?>
            <?php foreach($sql as $data): ?>
            <li><a href="<?= base_url('homepage_halaman/detail/'.$data->ID_MENUWEB) ?>"><?= $data->NAMA_MENU ?></a></li>
            <?php endforeach; ?>
			<?php endif; ?>	
			</ul>					</div>
					<div class="bottom"></div>
				</div>