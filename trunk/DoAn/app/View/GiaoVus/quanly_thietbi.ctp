<?php
	echo $this->GiaoVu->form_thietbi((isset($thietbi)?$thietbi:null),$listLoaiThietbi); 
	echo $this->GiaoVu->listDanhsachThietbi($data);
	//print_r($thietbi);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyThietbi",$page,$pagebgin,$pageend,$numberrecord);
	?>
</div>