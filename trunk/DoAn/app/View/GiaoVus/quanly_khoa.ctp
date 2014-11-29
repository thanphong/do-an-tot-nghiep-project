
	<?php echo $this->Giaovu->creatFormKhoa((isset($khoa)?$khoa:null)); 
		echo $this->Giaovu->danhSachKhoa($data);

	?>
	<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyKhoa",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>