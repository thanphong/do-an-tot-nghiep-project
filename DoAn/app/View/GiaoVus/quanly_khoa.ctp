
	<?php echo $this->GiaoVu->creatFormKhoa((isset($khoa)?$khoa:null)); 
		echo $this->GiaoVu->danhSachKhoa($data);

	?>
	<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("Giaovus","quanlyKhoa",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>