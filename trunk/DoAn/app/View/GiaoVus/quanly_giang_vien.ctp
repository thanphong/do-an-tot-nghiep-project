<?php
$giangvien=(isset($giangvien)?$giangvien:null);
echo $this->GiaoVu->form_giangviens($listquyen,$listKhoa,$giangvien);
echo $this->GiaoVu->listDanhsachGiangvien($danhsachGv);
?>
	<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyGiangVien",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>