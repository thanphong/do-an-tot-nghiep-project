<?php
class GiangvienHelper extends HtmlHelper{
	
	function create_menu($username){
		$menu="<ul class='nav'><li class='highlight'>".$this->link('Thông báo',array('controller' => 'users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Lớp học phần',array('controller' => 'users','action' => '','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Phòng học',array('controller' => 'users','action' => 'xemPhonghoc','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Quản lý',array('controller' => 'users','action' => 'index','full_base' => true));
		$menu.="<ul><li>".$this->link("Báo ngỉ-Báo bù",array('controller' => 'Giangviens','action' => 'baonghibaobu','full_base' => true))."</li>";
		$menu.="</ul></li>";
		$menu.="<li class=''>".$this->link('Trợ giúp',array('controller' => 'users','action' => 'index','full_base' => true));
		$menu.="<ul><li>".$this->link("Cá nhân",array('controller' => 'users','action' => 'formConsulting','full_base' => true))."</li>";
		$menu.="<li>".$this->link("quản lý",array('controller' => 'users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Tài liệu biểu mẫu",array('controller' => 'users','action' => 'index','full_base' => true))."</li></ul></li>";
		$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li>";
		$menu.="<li style='float:right'>".$this->link('Cá nhân',array('controller' => 'giangviens','action' => 'canhan','full_base' => true,$username))."</li>";
		$menu.="<span class='titlelog'>Xin chào: ".$username." <b class='line'>|</b></span>";
		$menu.="</ul>";
		return $menu;
	}
	function formbaongidaybu($hocky){
		$out="";
		$out.="<select name='hocky' id='hocky' style='width:210px'>";
		foreach ($hocky as $item){
			$out.="<option value='".$item['Hocki']['id']."'>Học kỳ".$item['Hocki']['mahocky']." năm học ".$item['Hocki']['namhoc']."</option>";
		}
		$out.="</select>";
		$out.="<input class='button2 sizebutton2' id='btnbaonghi' type='button' value='Báo nghỉ' name='bn'/>";
		$out.="<input class='button2 sizebutton2' id='btnbaobu' type='button' value='Báo bù' name='bn'/>";
		$out.="<input class='button2 sizebutton2' id='btnhuybaonghi' type='button' value='Hủy báo nghỉ' name='bn'/>";
		$out.="<input class='button2 sizebutton2' id='btnhuybaobu' type='button' value='Hủy báo bù' name='bn'/>";
		return $out;
	}
	function formCanhan($user){
	
		$action="/DoAn/giangviens/Capnhapthongtin";
		$selected="";
		$register="<div class='contentmain'><h2>Thông tin cá nhân</h2>";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Giangvien' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Tên giảng viên</label></td>";
		$register.="<td><input type='text' name='ten' value='".$user['Giangvien']['ten']."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Địa chỉ</label></td>";
		$register.="<td><input type='text' name='diachi' value='".$user['Giangvien']['diachi']."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Số điện thoại</label></td>";
		$register.="<td><input type='text' name='sodienthoai' value='".$user['Giangvien']['sodienthoai']."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Email</label></td>";
		$register.="<td><input type='text' name='email' value='".$user['Giangvien']['email']."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Giới tính</label></td>";
		$register.="<td><select name='gioitinh' id=''>";
		for ($i=0;$i<2;$i++){
			$selected="";
			if($user['Giangvien']['gioitinh']==$i){
				$selected="selected";
			}
			$register.="<option value='".$i."' ".$selected.">".$this->Gioitinhs[$i]."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Ngày sinh</label></td>";
		$register.="<td><input type='text' name='ngaySinh' data-beatpicker='true' data-beatpicker-id='myDatePicker'></td>";
		$register.="<tr><td><label for='register_uername'>Học hàm</label></td>";
		$register.="<td><select name='hocham' id=''>";
		$register.="<option value='' disabled selected>Chọn học hàm</option>";
		
		foreach($this->Hochams as $x=>$x_value){
			$selected="";
			if($user['Giangvien']['hocham']==$x){
				$selected="selected";
			}
			$register.="<option value='".$x."' ".$selected.">".$x_value."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Học vị</label></td>";
		$register.="<td><select name='hocvi' id=''>";
		
		foreach($this->Hocvis as $x=>$x_value) {
			$selected="";
			if($user['Giangvien']['hocvi']==$x){
				$selected="selected";
			}
			$register.="<option value='".$x."' ".$selected.">".$x_value."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_name'>Chuyên ngành</label></td>";
		$register.="<td><input type='text' name='chuyennganh' value='".$user['Giangvien']['chuyennganh']."' id='chuyennganh' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Môn dạy</label></td>";
		$register.="<td><input type='text' name='monday' value='' id='monday' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Khoa</label></td><td><fieldset class='group'> <legend>Chọn khoa</legend><ul class='checkbox'>";
// 		foreach ($listKhoa as $item){
// 			$cheked="";
// 			if (in_array($item['Khoa']['id'], $khoa)) {
// 				$cheked="checked";
// 			}
// 			$register.="<li><input type='checkbox' name='khoas[]' value='".$item['Khoa']['id']."' ".$cheked."><label for='cb".$item['Khoa']['id']."'>".$item['Khoa']['tenKhoa']."</label></li>" ;
// 		}
// 		$register.="</ul></fieldset></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				</div></form></div>";
		return $register;
	}
	function formThaydoiMatkhau(){
		$register="";
		$action="/DoAn/giangviens/thaydoimatkhau";
		$register="<div class='contentmain'><h2>Thay đổi mật khẩu</h2>";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Giangvien' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Mật khẩu cũ:</label></td><td><input type='password' name='oldMatkhau' value='' id='oldMatkhau' /><br><label for='checkpass' id='chekpass'></label></br></td>";
		$register.="<td><label for='register_name'>Mật khẩu mới:</label></td><td><input type='password' name='newMatkhau' value='' id='newMatkhau' /></td>";
		$register.="<td><label for='register_name'>Xác nhận mật khẩu:</label></td><td><input type='password' name='comfirmMatkhau' value='' id='comfirmMatkhau' /></td><td><input class='button2 sizebutton2' id='updatepas' type='button' value='Thay đổi mật khẩu' name='updatepass'/></td>";
		$register.="</tr></table></form></div>";
		return $register;
	}
}
?>