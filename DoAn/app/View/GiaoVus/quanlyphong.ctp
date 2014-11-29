<?php
	echo $this->Giaovu->form_phongs($listKhuvuc,$listthietbi);
	echo $this->Giaovu->listDanhsachPhonghoc($data);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyphong",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>