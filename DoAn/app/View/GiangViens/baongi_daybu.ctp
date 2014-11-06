<div class="contentmain marginBottom">
	<?php
	echo $this->Html->script("gianvien_baongibaobu.js");
	echo $this->Giangvien->formbaongidaybu($hockys);
	?>
</div>
<div>
<table id="thoikhoabieu" class='left Grid' style="width:100%;border-collapse:collapse;">
	<tr class="GridHeader"><td colspan="4" class="GridHeaderCell">Danh sách lớp giảng dạy trong kỳ</td></tr>
	<tr class="GridHeader"><td class="GridHeaderCell"> STT</td><td class="GridHeaderCell">Tên lớp học phần</td><td class="GridHeaderCell">TKB</td><td class="GridHeaderCell">có báo nghỉ</td></tr>
<table>
</div>