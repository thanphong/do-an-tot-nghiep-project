<?php
class GiaoVuHelper extends HtmlHelper{
	function creatFormKhoa($data=null){
		$name="";
		$mota="";
		$action="/DoAn/giaovus/themMoiKhoas";
		if(isset($data)){
			$name=$data['Khoa']['tenKhoa'];
			$mota=$data['Khoa']['mota'];
			$action="/DoAn/giaovus/suaKhoa/".$data['Khoa']['id'];
		}
		
		$register="<form action='".$action."' method='POST' id='registration_form' name='Khoa'><table>";
		$register.="<tr><td><label for='register_name'>Tên Khoa</label></td>";
		$register.="<td><input type='text' name='tenKhoa' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Mô tả</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='mota' id='mota' >".$mota."</textarea></td></tr>";
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
			$register="<Table><tr><Td>STT</td><td>Mã Khoa</td><td>Tên khoa</td><td>Mô tả</td><td>Tác vụ</td></tr>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Khoa']['maKhoa']."</td><td>".$item['Khoa']['tenKhoa']."</td><td>".$item['Khoa']['mota']."</td>";
				$register.="<td>".$this->link('Xem',array('controller' => 'Giaovus', 'action' => 'xemKhoas', $item['Khoa']['id']));
				$register.=$this->link('Sửa',array('controller' => 'Giaovus', 'action' => 'suaKhoa', $item['Khoa']['id']));
				$register.=$this->link('Xóa',array('controller' => 'Giaovus', 'action' => 'xoaKhoa', $item['Khoa']['id']));
				$register.="</td></tr>";
			}
			$register.="</table>";
		}
		return $register;
	}
	function form_giangviens(){
		$register= $this->css(array('BeatPicker.min.css'));
		$register.= $this->script(array('datetimepicket/jquery-1.11.0.min.js','datetimepicket/BeatPicker.min.js'));
		$action="/DoAn/giangviens/themGiangvien";
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
	function form_Hocphan($data=null){
		
		$action="/DoAn/giaovus/themMoiHocphan";
		$name="";
		$mota="";
		if(isset($data)){
			$name=$data['Hocphan']['tenhocphan'];
			$mota=$data['Hocphan']['mota'];
			$action="/DoAn/giaovus/suaHocphan/".$data['Hocphan']['id'];
		}
		$register="<form action='".$action."' method='POST' id='registration_form' name='Hocphan'><table>";
		$register.="<tr><td><label for='register_name'>Tên học phần</label></td>";
		$register.="<td><input type='text' name='tenhocphan' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Trạng thái</label></td>";
		$register.="<td><select name='trangthai' id=''>";
		$register.="<option value='1'>Còn học</option><option value='0'>Ngừng</option></select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Mô tả</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='mota' id='mota' >".$mota."</textarea></td></td>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form>";
		return $register;
	}
	function danhsachHocPhan($data=null){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="<Table><tr><Td>STT</td><td>Mã học phần</td><td>Tên học phần</td><td>Trạng thái</td><td>Mô tả</td><td>Tác vụ</td></tr>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Hocphan']['maHocPhan']."</td><td>".$item['Hocphan']['tenhocphan']."</td><td>".$item['Hocphan']['trangthai']."</td><td>".$item['Hocphan']['mota']."</td>";
				$register.="<td>".$this->link('Xem',array('controller' => 'Giaovus', 'action' => 'xemHocphan', $item['Hocphan']['id']));
				$register.=$this->link('Sửa',array('controller' => 'Giaovus', 'action' => 'suaHocphan', $item['Hocphan']['id']));
				$register.=$this->link('Xóa',array('controller' => 'Giaovus', 'action' => 'xoaHocphan', $item['Hocphan']['id']));
				$register.="</td></tr>";
				$i++;
			}
			$register.="</table>";
		}
		return $register;
	}
}
?>