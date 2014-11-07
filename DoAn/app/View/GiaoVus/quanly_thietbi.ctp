<?php
	echo $this->giaovu->form_thietbi((isset($thietbi)?$thietbi:null),$listLoaiThietbi); 
	echo $this->giaovu->listDanhsachThietbi($data);
	//print_r($thietbi);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("Giaovus","quanlyThietbi",$page,$pagebgin,$pageend,$numberrecord);
	?>
</div>