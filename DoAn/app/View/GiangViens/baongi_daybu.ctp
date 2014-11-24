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

<!--POPUP huy bao bu-->    
			<div id="popUphuybaobu" style="display:none;">
				<form id="formhuybaobu" action="/DoAn/Giangviens/createbaonghi" method='POST'>
				    <div class='contentpoup' id='contentpoup'>
				    	<a class='right close' onclick="popup('popUphuybaobu')"></a>
				    	<div class='headtt'><span class='note'></span><span>Danh sách báo bù</span></div>
				    </div>
				    <div class="clear">				    	
					    <table id="danhsachlopbaobu" class='Grid' style="border-collapse:collapse;">
							<tr class="GridHeader">
								<td colspan="5" class="GridHeaderCell"><b>Danh sách lớp báo bù</b></td>
							</tr>
							<tr class="GridHeader">
								<td class="GridHeaderCell"><b> STT</b></td>
								<td class="GridHeaderCell"><b>Tên lớp học phần</b></td>
								<td class="GridHeaderCell"><b>Ngày bù</b></td>
								<td class="GridHeaderCell"><b>Từ tiết</b></td>
								<td class="GridHeaderCell"><b>Đến tiết</b></td>
							</tr>
						</table>					
				    </div>
				 </form>
			     
			</div>
<div class="cach"></div>
				 <div class='groupButton'>
			    	<input class='button2' type='button' name='luu' value="Lưu" id="huybaobu" />
			    	<input class='button2' type='button' name='huy' value="Hủy" id="huy" />
				 </div>