<?php
	echo $this->giaovu->form_thietbi($listLoaiThietbi);
	echo $this->giaovu->listDanhsachThietbi($data);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("Giaovus","quanlyThietbi",$page,$pagebgin,$pageend,$numberrecord);
	?>
</div>