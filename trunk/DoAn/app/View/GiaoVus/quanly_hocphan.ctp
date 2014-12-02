<?php
	echo $this->GiaoVu->form_Hocphan(null,$listKhoa);
	echo $this->GiaoVu->danhsachHocPhan($data);
?>
<div class="clear"></div>
	<div id="paging" class="right">
	<?php 
		    echo $this->Common->pagination("GiaoVus","quanlyHocphan",$page,$pagebgin,$pageend,$numberrecord);
	?>
</div>