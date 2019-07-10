<h3>List Surat Al-Qur'an</h3>
<ul class="list-group">
  <?php foreach($list as $l) : ?>
	  <li class="list-group-item"><?php echo $l->nomor;?>. <?php echo $l->nama;?> <?php echo $l->asma;?> (<?php echo $l->arti;?>) <br><br>
    <p style="text-align:justify;"><?php echo $l->keterangan;?></p> <br>
      <audio controls>
        <source src="<?php echo $l->audio;?>">
      </audio>
    </li>
  <?php endforeach;?>
</ul>