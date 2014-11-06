<?php
	echo $this->giaovu->form_phongs($listKhuvuc,$listthietbi);
	echo $this->giaovu->listDanhsachPhonghoc($data);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("Giaovus","quanlyphong",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>