<?php
	echo $this->giaovu->form_Hocphan(null,$listKhoa);
	echo $this->giaovu->danhsachHocPhan($data);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("Giaovus","quanlyHocphan",$page,$pagebgin,$pageend,$numberrecord);
	?>
</div>