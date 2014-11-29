<?php
echo $this->Giaovu->form_giangviens($listquyen,$listKhoa,null);
echo $this->Giaovu->listDanhsachGiangvien($danhsachGv);
?>
	<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyGiangVien",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>