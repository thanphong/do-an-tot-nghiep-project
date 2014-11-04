<?php
echo $this->giaovu->form_giangviens($listquyen,$listKhoa,null);
echo $this->giaovu->listDanhsachGiangvien($danhsachGv);
?>
	<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("Giaovus","quanlyGiangVien",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>