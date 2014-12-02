<div class="baocao">
	<div>
		<?php
		echo $this->Html->css(array("baongibu.css","dialog.css"));
		echo $this->Html->script(array("gianvien_baongibaobu.js","baonghi.js","baobu.js","css-pop.js","dialog.js"));
		echo $this->Giangvien->formbaongidaybu($hockys);
		?>
	</div>
	<div style="width: 100%;" >
		<div class="baonghibu">
			<table id="thoikhoabieu" class='Grid' style="width:100%;border-collapse:collapse;">
				<tr class="GridHeader"><td colspan="4" class="GridHeaderCell"><b>Danh sách lớp giảng dạy trong kỳ</b></td></tr>
					<tr class="GridHeader">
					<td class="GridHeaderCell"><b> STT</b></td>
					<td class="GridHeaderCell"><b>Tên lớp học phần</b></td>
					<td class="GridHeaderCell"><b>TKB</b></td>
					<td class="GridHeaderCell"><b>có báo nghỉ</b></td>
				</tr>
			</table>
		</div>
		<div class="baonghibu" style="margin-left:5px">
			<table id="danhsachbaongi" class='Grid' style="width:100%;border-collapse:collapse;">
				<tr class="GridHeader">
					<td colspan="6" class="GridHeaderCell"><b>Danh sách lớp báo nghỉ</b></td>
				</tr>
				<tr class="GridHeader">
					<td class="GridHeaderCell"><b> STT</b></td>
					<td class="GridHeaderCell"><b>Ngày báo</b></td>
					<td class="GridHeaderCell"><b>Ngày nghỉ</b></td>
					<td class="GridHeaderCell"><b>Số tiết nghỉ</b></td>
					<td class="GridHeaderCell"><b>Số tiết bù</b></td>
				</tr>
			</table>
		</div>
	</div>
	<!--POPUP-->    
	    <div id="blanket" style="display:none;"></div>
			<div id="popUpDiv" style="display:none;">
				<form id="formDangkyngi" action="/DoAn/GiangViens/createbaonghi" method='POST'>
				    <div class='contentpoup' id='contentpoup'>
				    	<a class='right close' onclick="popup('popUpDiv')"></a>
				    	<div class='headtt'><span class='note'></span><span>Danh sách báo nghỉ</span></div>
				    	<table id="tableBaongi">
				    		<!--<tr>
				    			<td><b>Ngày báo:</b></td>
				    			<td><input style='width:300px' type='text' name='ngaybao' data-beatpicker='true' data-beatpicker-id="baongi" /></td>
				    		</tr>-->
				    		<tr>
				    			<td><b>Lý do:</b></td>
				    			<td><input style='width:720px' type='text' name='lydo'></td>
				    		</tr>
				    	</table>
				    </div>
				    <div class="cach"></div>
				    <div class="clear">				    	
					    <table id="danhsachlhp" class='Grid' style="border-collapse:collapse;">
							<tr class="GridHeader">
								<td colspan="7" class="GridHeaderCell"><b>Danh sách lớp báo nghỉ</b></td>
							</tr>
							<tr class="GridHeader">
								<td class="GridHeaderCell"><b> STT</b></td>
								<td class="GridHeaderCell"><b>Tên lớp học phần</b></td>
								<td class="GridHeaderCell"><b>TKB</b></td>
								<td class="GridHeaderCell"><b>Ngày nghỉ</b></td>
								<td class="GridHeaderCell"><b>Số tiết</b></td>
								<td class="GridHeaderCell"><b>Cả buổi</b></td>
								<td class="GridHeaderCell"><b>Đã hủy</b></td>
							</tr>
						</table>					
				    </div>
				 </form>
			     <div class="cach"></div>
				 <div class='groupButton'>
			    	<input class='button2' type='button' name='luu' value="Lưu" id="luudknghi" />
				 </div>
 	
		</div>	
	<!-- / POPUP-->
		<div id="popupBaoBu" style="display:none;">
			<form id="formDangkybu" action="/DoAn/GiangViens/createbaobu" method='POST'>
			    <div class='contentpoup' id='contentpoupbaobu'>
			    	<a class='right close' onclick="popup('popupBaoBu')"></a>
			    	<div class='headtt'><span class='note'></span><span>Danh sách báo dạy bù</span></div>
			  	
			    	<!--<table id="tableBaobu">
			    		<tr>
			    			<td><b>Ngày báo:</b></td>
			    			<td><input style='width:300px' type='text' name='ngaybao' data-beatpicker='true' data-beatpicker-id="baongi" /></td>
			    		</tr>
			    	</table>-->
			    </div>
			    <div class="cach"></div>
			    <div class="clear">
				    <table id="lhpBaobu" class='Grid' style="width:100%;border-collapse:collapse;">
						<tr class="GridHeader">
							<td colspan="8" class="GridHeaderCell"><b>Danh sách lớp báo dạy bù</b></td>
						</tr>
						<tr class="GridHeader">
							<td class="GridHeaderCell"><b> STT</b></td>
							<td class="GridHeaderCell"><b>Mã lớp học phần</b></td>
							<td class="GridHeaderCell"><b>Tên lớp học phần</b></td>
							<td class="GridHeaderCell"><b>Ngày bù</b></td>
							<td class="GridHeaderCell"><b>Tiết đầu</b></td>
							<td class="GridHeaderCell"><b>Tiết cuối</b></td>
							<td class="GridHeaderCell"><b>Phòng</b></td>
							<td class="GridHeaderCell"><b>Đã hủy</b></td>
						</tr>
					</table>
					
			    </div>
			</form>
			<div class="cach"></div>
			<div class='groupButton'>
			    <input class='button2' type='button' name='luu' value="Lưu" id="luudkbu"/>
			</div>
			<div style="display:none; overflow: scroll;width:100%;height: 350px" id="danhsachphong"  >
			  	<table class='Grid' >
					<tr class="GridHeader" >
				    	<td class="GridHeaderCell" colspan="3">Danh sách phòng phù hợp</td>
				   	</tr>
			    	<tr class="GridHeader" >
			    		<td class="GridHeaderCell"><b> STT</b></td>
			    		<td class="GridHeaderCell"><b>Phòng</b></td>
			    		<td class="GridHeaderCell"><b> Số chỗ</b></td>
			    	</tr>
			    </table>
			</div>
		</div>
		<!--POPUP huy bao bu-->    
		<div id="popUphuybaobu" style="display:none;">
			<form id="formhuybaobu" action="/DoAn/GiangViens/huybaobu" method='POST'>
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
			<div class='groupButton'>
			    	<input class='button2' type='button' name='luu' value="Lưu" id="huybaobu" />
			    	<input class='button2' type='button' name='huy' value="Hủy" id="huy" onclick="popup('popUphuybaobu')" />
			</div>
			<div style="display:none; overflow: scroll;width:100%;height: 350px" id="divbaobuNotdelete"  >
			  	<table class='Grid' id="baobuNotdelete" >
					<tr class="GridHeader" >
				    	<td class="GridHeaderCell" colspan="5">Danh sách lớp học phần không được hủy</td>
				   	</tr>
			    	<tr class="GridHeader" >
			    		<td class="GridHeaderCell"><b> STT</b></td>
						<td class="GridHeaderCell"><b>Tên lớp học phần</b></td>
						<td class="GridHeaderCell"><b>Ngày bù</b></td>
						<td class="GridHeaderCell"><b>Từ tiết</b></td>
						<td class="GridHeaderCell"><b>Đến tiết</b></td>
			    	</tr>
			    </table>
			</div>
		</div>
		<!-- -->	
		<!--POPUP huy bao nghi-->    
		<div id="popUphuybaonghi" style="display:none;">
			<form id="formhuybaonghi" action="/DoAn/GiangViens/huybaonghi" method='POST'>
				    <div class='contentpoup' id='contentpoup'>
				    	<a class='right close' onclick="popup('popUphuybaonghi')"></a>
				    	<div class='headtt'><span class='note'></span><span>Danh sách hủy báo nghỉ </span></div>
				    </div>
				    <div class="clear">				    	
					    <table id="danhsachhuybaonghi" class='Grid' style="border-collapse:collapse;">
							<tr class="GridHeader">
								<td colspan="5" class="GridHeaderCell"><b>Danh sách lớp báo nghỉ</b></td>
							</tr>
							<tr class="GridHeader">
								<td class="GridHeaderCell"><b> STT</b></td>
								<td class="GridHeaderCell"><b>Tên lớp học phần</b></td>
								<td class="GridHeaderCell"><b>TKB</b></td>
								<td class="GridHeaderCell"><b>Ngày nghỉ</b></td>
								<td class="GridHeaderCell"><b>Số tiết</b></td>
							</tr>
						</table>					
				    </div>
				 </form>
			<div class='groupButton'>
			    	<input class='button2' type='button' name='luu' value="Lưu" id="huybaonghi" />
			    	<input class='button2' type='button' name='huy' value="Hủy" id="huybn" onclick="popup('popUphuybaonghi')" />
			</div>
			<div style="display:none; overflow: scroll;width:100%;height: 350px" id="divnothuynghi"  >
			  	<table class='Grid' id="baonghiNotdelete">
					<tr class="GridHeader" >
				    	<td class="GridHeaderCell" colspan="5">Danh sách lớp học phần không được hủy</td>
				   	</tr>
			    	<tr class="GridHeader" >
			    		<td class="GridHeaderCell"><b> STT</b></td>
			    		<td class="GridHeaderCell"><b>Tên lớp học phần</b></td>
						<td class="GridHeaderCell"><b>TKB</b></td>
						<td class="GridHeaderCell"><b>Ngày nghỉ</b></td>
						<td class="GridHeaderCell"><b>Số tiết</b></td>
			    	</tr>
			    </table>
			</div>
		</div>
		<!-- -->	
			<div id="dialogoverlay"></div>
				<div id="dialogbox">
					 <div>
					    <div id="dialogboxhead"></div>
					     <div class="cach"></div>
					    <div id="dialogboxbody"></div>
					     <div class="cach"></div>
					    <div id="dialogboxfoot"></div>
					  </div>
					</div>  
</div>