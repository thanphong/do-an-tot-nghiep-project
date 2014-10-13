<?php
class UserHelper extends HtmlHelper  {
	function creatFormKhoa(){
		$action="themMoiKhoas";
		$register="<form action='".$action."' method='POST' id='registration_form' name='Khoa'><table>";
		$register.="<tr><td><label for='register_name'>Tên Khoa</label></td>";
		$register.="<td><input type='text' name='tenKhoa' value='' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Mô tả</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='mota' id='mota' ></textarea></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form>";
		return $register;
	}
	function danhSachKhoa($data=null){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="";
			foreach ($data as $item){
				$register.="<div class='consulting'><h4>".$this->link($item['Consulting']['title'],array('controller' => 'Tuvan','action' => 'detail','full_base' => true,$item['Consulting']['id']))."</h4>";
				$register.="<p>".$this->noidungtt(30,$item['Consulting']['contents'])."</p>";
				//chuyen doi ngay
				$date = $item['Consulting']['consulting_date'];
				$d = getdate(strtotime($date));
				$inngay = $d['mday'].'/'.$d['mon'].'/'.$d['year'] .' '. $d['hours'].':'.$d['minutes'].':' .$d['seconds'];
				//		$indate=date('d/m/Y H:i:s', $date);
				$register.="<i>".$inngay."</i></div>";
			}
		}
		return $register;
	}
	function form_giangviens(){
		$register= $this->css(array('BeatPicker.min.css'));
		$register.= $this->script(array('datetimepicket/jquery-1.11.0.min.js','datetimepicket/BeatPicker.min.js'));
		$action="/doan/giangviens";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Khoa'><table>";
		$register.="<tr><td><label for='register_name'>Tên giảng viên</label></td>";
		$register.="<td><input type='text' name='ten' value='' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Địa chỉ</label></td>";
		$register.="<td><input type='text' name='diachi' value='' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Giới tính</label></td>";
		$register.="<td><select name='gioitinh' id=''>";
		$register.="<option value='1'>Nam</option><option value='1'>Nữ</option></select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Ngày sinh</label></td>";
		$register.="<td><input type='text' data-beatpicker='true' data-beatpicker-position='['right','bottom']'></td>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form>";
		return $register;
	}
}
?>