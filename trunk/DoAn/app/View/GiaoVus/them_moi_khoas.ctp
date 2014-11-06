<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
</head>
<body>
	<?php echo $this->GiaoVu->creatFormKhoa((isset($khoa)?$khoa:null)); 
		echo $this->GiaoVu->danhSachKhoa($data);
	?>
	<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("Giaovus","quanlyKhoa",$page,$pagebgin,$pageend,$numberrecord);
	?>
    </div>
	
</body></html>