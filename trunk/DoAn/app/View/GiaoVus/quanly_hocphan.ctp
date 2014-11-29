<?php
	echo $this->Giaovu->form_Hocphan(null,$listKhoa);
	echo $this->Giaovu->danhsachHocPhan($data);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyHocphan",$page,$pagebgin,$pageend,$numberrecord);
	?>
</div>