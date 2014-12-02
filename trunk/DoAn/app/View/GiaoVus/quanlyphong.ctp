<?php
	echo $this->GiaoVu->form_phongs($listKhuvuc,$listthietbi);
	echo $this->GiaoVu->listDanhsachPhonghoc($data);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyphong",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>