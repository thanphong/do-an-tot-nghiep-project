<?php
class GiaoVuHelper extends HtmlHelper{
// 	var $Gioitinhs=array("Nam","Nữ");
// 	var $Hocvis=array("Ts"=>"Tiến sĩ","Ths"=>"Thạc sĩ","Ks"=>"Kỹ sư");
// 	var $Hochams=array("GS"=>"Giáo sư","PGS"=>"Phó giáo sư");
	function create_menu($username){
	
		$menu="<ul class='nav'><li id='home' class='highlight'>".$this->link('Thông báo',array('controller' => 'Users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li id='lophocphan'>".$this->link('Lớp học phần',array('controller' => 'Users','action' => '','full_base' => true))."</li>";
		$menu.="<li id='phonghoc'>".$this->link('Phòng học',array('controller' => 'Users','action' => 'xemPhonghoc','full_base' => true))."</li>";
		$menu.="<li id='dankynghibu'>".$this->link('Đăng ký nghỉ dạy/dạy bù',array('controller' => 'GiangViens','action' => 'baonghibaobu','full_base' => true))."</li>";
		$menu.="<li id='nghibu'><a href='#'>Quản lý</a>";
		$menu.="<ul><li>".$this->link("Quản lý học phần",array('controller' => 'GiaoVus','action' => 'quanlyHocphan','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Quản lý giảng viên",array('controller' => 'GiaoVus','action' => 'quanlyGiangVien','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Quản lý khoa",array('controller' => 'GiaoVus','action' => 'quanlyKhoa','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Quản lý phòng học",array('controller' => 'GiaoVus','action' => 'quanlyphong','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Quản lý thông báo",array('controller' => 'GiaoVus','action' => 'quanlyThongbao','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Quản lý thiết bị",array('controller' => 'GiaoVus','action' => 'quanlyThietbi','full_base' => true))."</li></ul></li>";
		$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'Users','action' => 'logout','full_base' => true))."</li>";
		$menu.="<li id='canhan' style='float:right'>".$this->link('Cá nhân',array('controller' => 'GiaoVus','action' => 'canhan','full_base' => true,$username))."</li>";
		$menu.="<span class='titlelog'>Xin chào: ".$username."<b class='line'>|</b></span>";
		$menu.="</ul>";
		return $menu;
	}
	function creatFormKhoa($data=null){
		$name="";
		$mota="";
		$action="/DoAn/GiaoVus/themMoiKhoas";
		if(isset($data)){
			$name=$data['Khoa']['tenKhoa'];
			$mota=$data['Khoa']['mota'];
			$register="<div class='contentmain'><h2>Tạo mới Khoa</h2>";
			$action="/DoAn/GiaoVus/suaKhoa/".$data['Khoa']['id'];
		}	
		$register="<div class='contentmain'><h2>Cập nhật khoa</h2>";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Khoa' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Tên Khoa</label></td>";
		$register.="<td><input type='text' name='tenKhoa' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Mô tả</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='mota' id='mota' >".$mota."</textarea></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form></div>";
		return $register;
	}
	function danhSachKhoa($data){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="<table class='list'><tr><thead><th>STT</th><th>Mã Khoa</th><th>Tên khoa</th><th>Mô tả</th><th>Tác vụ</th></thead></tr>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Khoa']['maKhoa']."</td><td>".$item['Khoa']['tenKhoa']."</td><td>".$item['Khoa']['mota']."</td>";
				$register.="<td>".$this->link('',array('controller' => 'GiaoVus', 'action' => 'xemKhoas', $item['Khoa']['id']),array('class'=>'icview','title'=>'xem'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'suaKhoa', $item['Khoa']['id']),array('class'=>'icedit','title'=>'sửa'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'xoaKhoa', $item['Khoa']['id']),array('class'=>'icdelete','title'=>'xóa'));
				$register.="</td></tr>";
				$i++;
			}
			$register.="</table>";
		}
		return $register;
	}
	//giangvien
	function form_giangviens($listquyen,$listKhoa,$giangvien){
		$name="";
		$diachi="";
		$gioitinh=0;
		$hocham="";
		$hocvi="";
		$chuyennganh="";
		$monday;
		$quyens=array();
		$khoa=0;
		$ngaysinh;
		$action="/DoAn/GiaoVus/themGiangvien";
		$selected="";
		if(isset($giangvien)){
			$action="/DoAn/GiaoVus/capnhapGiangvien/".$giangvien['Giangvien']['id'];
			$name=$giangvien['Giangvien']['ten'];
			$diachi=$giangvien['Giangvien']['diachi'];
			$hocvi=$giangvien['Giangvien']['hocvi'];
			$hocham=$giangvien['Giangvien']['hocham'];
			$khoa=$giangvien['Giangvien']['khoa'];
			foreach ($giangvien['Quyengiangvien'] as $item){
				array_push($quyens,$item['maquyen']);
			}
			$chuyennganh=$giangvien['Giangvien']['chuyennganh'];
			$ngaysinh=$giangvien['Giangvien']['ngaySinh'];
			$monday=$giangvien['Giangvienhocphan'];
		}
		$register="<div class='contentmain'><h2>Tạo mới giảng viên</h2>";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Giangvien' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Tên giảng viên</label></td>";
		$register.="<td><input type='text' name='ten' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Địa chỉ</label></td>";
		$register.="<td><input type='text' name='diachi' value='".$diachi."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Số điện thoại</label></td>";
		$register.="<td><input type='text' name='sodienthoai' value='".$diachi."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Email</label></td>";
		$register.="<td><input type='text' name='email' value='".$diachi."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Giới tính</label></td>";
		$register.="<td><select name='gioitinh' id=''>";
		for ($i=0;$i<2;$i++){
			if($gioitinh==$i){
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
		$selected="";
		foreach($this->Hochams as $x=>$x_value){
			if($hocham==$x){
				$selected="selected";
			}
  			$register.="<option value='".$x."' ".$selected.">".$x_value."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Học vị</label></td>";
		$register.="<td><select name='hocvi' id=''>";
		$selected="";
		foreach($this->Hocvis as $x=>$x_value) {
			if($hocvi==$x){
				$selected="selected";
			}
  			$register.="<option value='".$x."' ".$selected.">".$x_value."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_name'>Chuyên ngành</label></td>";
		$register.="<td><input type='text' name='chuyennganh' value='".$chuyennganh."' id='chuyennganh' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Môn dạy</label></td>";
		$register.="<td><input type='text' name='monday' value='' id='monday' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Quyền</label></td><td><fieldset class='group'> <legend>Chọn quyền</legend><ul class='checkbox1'>";
		foreach ($listquyen  as $item){
			$check="";
			if(in_array($item['Quyen']['id'],$quyens)){
				$check="checked";
			}
			$register.="<li><input type='checkbox' name='roles[]' value='".$item['Quyen']['id']."' ".$check."><label for='cb".$item['Quyen']['id']."'>".$item['Quyen']['maquyen']."</label></li>";
		}
		$register.="</ul></fieldset></td></tr>";
		$register.="<tr><td><label for='register_uername'>Khoa</label></td>";
		$register.="<td><select name='khoa' id=''>";
		$selected="";
		foreach ($listKhoa as $item){
			if($khoa==$item['Khoa']['id']){
				$selected="selected";
			}
			$register.="<option value='".$item['Khoa']['id']."' ".$selected.">".$item['Khoa']['tenKhoa']."</option>";
		}
		$register.="</select></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form></div>";
		return $register;
	}
	function listDanhsachGiangvien($data){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="<table class='list'><thead><tr><th>STT</th><th>Mã giảng viên</th><th>Tên giảng viên</th><th>Địa chỉ</th><th>Số điện thoại</th><th>Tác vụ</th></tr></thead>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Giangvien']['maGiangvien']."</td><td class='tdcolname'>".$item['Giangvien']['ten']."</td><td>".$item['Giangvien']['diachi']."</td>";
				$register.="<td>".$item['Giangvien']['sodienthoai']."</td>";
				$register.="<td>".$this->link('',array('controller' => 'GiaoVus', 'action' => 'xemGiangvien', $item['Giangvien']['id']),array('class'=>'icview','title'=>'xem'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'suaGiangvien', $item['Giangvien']['id']),array('class'=>'icedit','title'=>'sửa'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'xoaGiangvien', $item['Giangvien']['id']),array('class'=>'icdelete','title'=>'xóa'));
				$register.="</td></tr>";
				$i++;
			}
			$register.="</table>";
		}
		return $register;
	}
//
	function form_Hocphan($data=null,$listKhoa){		
		$action="/DoAn/GiaoVus/themMoiHocphan";
		$name="";
		$mota="";
		if(isset($data)){
			$name=$data['Hocphan']['tenhocphan'];
			$mota=$data['Hocphan']['mota'];
			$action="/DoAn/GiaoVus/CapnhapHocphan/".$data['Hocphan']['id'];
		}
		$register="<div class='contentmain'><h2>Tạo mới học phần</h2>";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Hocphan' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Khoa</label></td>";
		$register.="<td><select name='' id=''>";
		foreach ($listKhoa as $item){
			$register.="<option value='".$item['Khoa']['id']."'>".$item['Khoa']['tenKhoa']."</option>";
		}
		$register.="<tr><td><label for='register_name'>Ngành</label></td>";
		$register.="<td><select name='' id=''>";
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_name'>Tên học phần</label></td>";
		$register.="<td><input type='text' name='tenhocphan' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Số tín chỉ</label></td>";
		$register.="<td><select name='tinchi' id=''>";
		for ($i=1;$i<11;$i++){
			$register.="<option value='".$i."'>".$i."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_name'>Trạng thái</label></td>";
		$register.="<td><select name='trangthai' id=''>";
		$register.="<option value='1'>Chưa học</option><option value='2'>Đang học</option><option value='3'>Kết thúc</option></select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Mô tả</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='mota' id='mota' >".$mota."</textarea></td></td>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form></div>";
		return $register;
	}
	function danhsachHocPhan($data=null){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="<table class='list'><thead><tr><th>STT</th><th>Mã học phần</th><th>Tên học phần</th><th>Trạng thái</th><th>Mô tả</th><th>Tác vụ</th></tr></thead>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Hocphan']['maHocPhan']."</td><td>".$item['Hocphan']['tenhocphan']."</td><td>".$item['Hocphan']['trangthai']."</td><td>".$item['Hocphan']['mota']."</td>";
				$register.="<td>".$this->link('',array('controller' => 'GiaoVus', 'action' => 'xemHocphan', $item['Hocphan']['id']),array('class'=>'icview','title'=>'xem'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'suaHocphan', $item['Hocphan']['id']),array('class'=>'icedit','title'=>'sửa'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'xoaHocphan', $item['Hocphan']['id']),array('class'=>'icdelete','title'=>'xóa'));
				$register.="</td></tr>";
				$i++;
			}
			$register.="</table>";
		}
		return $register;
	}
	//quản lý phòng
	function form_phongs($listKhuvuc,$listThietbi){
		$action="/DoAn/GiaoVus/themMoiPhong";
		$name="";
		$mota="";
		$register="<div class='contentmain'><h2>Tạo mới phòng</h2>";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Phong' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Tên phòng</label></td>";
		$register.="<td><input type='text' name='tenPhong' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Số lượng ghế</label></td>";
		$register.="<td><input type='number' name='soLuongGhe' value='' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Trạng thái</label></td>";
		$register.="<td><select name='trangthai' id=''>";
		$register.="<option value='1'>Tốt</option><option value='0'>Hư hỏng</option></select></td></tr>";
		$register.="<tr><td><label for='register_name'>Khu vực</label></td>";
		$register.="<td><select name='khuVuc' id=''>";
		foreach ($listKhuvuc as $item){
			$register.="<option value='".$item['Khuvuc']['id']."'>".$item['Khuvuc']['tenKhuVuc']."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Thiết bị</label></td><td>";
		foreach ($listThietbi as $item){
			$register.="<input type='checkbox' name='thietbi' value='".$item['Thietbi']['id']."'>".$item['Thietbi']['tenThietbi']."<br>";
		}
		$register.="</td></tr>";
		$register.="<tr><td><label for='register_uername'>Mô tả</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='mota' id='mota' >".$mota."</textarea></td></td>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form></div>";
		return $register;
	}
	function listDanhsachPhonghoc($data){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="<table class='list'><thead><tr><th>STT</th><th>Mã phòng</th><th>Tên phòng</th><th>Số lượng ghế</th><th>Trạng thái</th><th>Khu vực</th><th>Tác vụ</th></tr></thead>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Phong']['maPhong']."</td><td class='tdcolname'>".$item['Phong']['tenPhong']."</td><td>".$item['Phong']['soLuongGhe']."</td>";
				$register.="<td>".$item['Phong']['trangThai']."</td><td>".$item['Khuvuc']['tenKhuVuc']."</td>";
				$register.="<td>".$this->link('',array('controller' => 'GiaoVus', 'action' => 'xemPhonghoc', $item['Phong']['id']),array('class'=>'icview','title'=>'xem'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'suaPhonghoc', $item['Phong']['id']),array('class'=>'icedit','title'=>'sửa'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'xoaPhonghoc', $item['Phong']['id']),array('class'=>'icdelete','title'=>'xóa'));
				$register.="</td></tr>";
				$i++;
			}
			$register.="</table>";
		}
		return $register;
	}
	//
	//quản lý thiết bị
	function form_thietbi($thietbi=null,$listLoaithietbi){
		$action="/DoAn/GiaoVus/quanlyThietbi";
		$name="";
		$mota="";
		$loai=-1;
		$trangthai=-1;
		$register="<div class='contentmain'><h2>Tạo mới thiết bị</h2>";
		if(isset($thietbi)){
			$name=$thietbi['Thietbi']['tenThietbi'];
			$loai=$thietbi['Thietbi']['loaiThietbi'];
			$trangthai=$thietbi['Thietbi']['trangThai'];
			$action="/DoAn/GiaoVus/suaThietbi/".$thietbi['Thietbi']['id'];
			$register="<div class='contentmain'><h2>Cập nhật thiết bị</h2>";
		}				
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Thietbi' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Tên thiết bị</label></td>";
		$register.="<td><input type='text' name='tenThietbi' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_name'>Loại thiết bị</label></td>";
		$register.="<td><select name='loaiThietbi' id=''>";
		foreach ($listLoaithietbi as $item){
			$checked="";
			if($loai==$item['Loaithietbi']['id']){
				$checked="selected";
			}
			$register.="<option value='".$item['Loaithietbi']['id']."' ".$checked.">".$item['Loaithietbi']['tenLoai']."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Trạng thái</label></td>";
		$checked1="";$checked2="";$checked3="";
		if($trangthai==1){$checked1="selected";}
		if($trangthai==2){$checked2="selected";}
		if($trangthai==3){$checked3="selected";}
		$register.="<td><select name='trangThai' id=''>";
		$register.="<option value='1' ".$checked1.">Tốt</option><option value='2' ".$checked2.">Hỏng</option><option value='3' ".$checked3.">Đang sửa chữa</option>";
		$register.="</select></td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form></div>";
		return $register;
	}
	function listDanhsachThietbi($data){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="<table class='list'><thead><tr><th>STT</th><th>Mã thiết bị</th><th>Tên thiết bị</th><th>Loại thiết bị</th><th>Trạng thái</th><th>Tác vụ</th></tr></thead>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Thietbi']['mathietbi']."</td><td class='tdcolname'>".$item['Thietbi']['tenThietbi']."</td><td>".$item['Loaithietbi']['tenLoai']."</td>";
				$register.="<td>".($item['Thietbi']['trangThai']==1?'Tốt':($item['Thietbi']['trangThai']==2?'Hỏng':'Đang sửa chữa'))."</td>";
				$register.="<td>".$this->link('',array('controller' => 'GiaoVus', 'action' => 'xemThietbi', $item['Thietbi']['id']),array('class'=>'icview','title'=>'xem'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'suaThietbi', $item['Thietbi']['id']),array('class'=>'icedit','title'=>'sửa'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'xoaThietbi', $item['Thietbi']['id']),array('class'=>'icdelete','title'=>'xóa'));
				$register.="</td></tr>";
				$i++;
			}
			$register.="</table>";
		}
		return $register;
	}

	//
	
	//quản lý lớp học phần
	function form_lopHocPhan($listKhoa){
		$action="/DoAn/GiaoVus/themMoiLopHocPhan";
		$name="";
		$mota="";
		$register="<div class='contentmain'><h2>Tạo mới lớp học phần</h2>";
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Lophocphan' class='left'><table>";
		$register.="<tr><td><label for='register_name'>Khoa</label></td>";
		$register.="<td><select name='' id=''>";
		foreach ($listKhoa as $item){
			$register.="<option value='".$item['Khoa']['id']."'>".$item['Khoa']['tenKhoa']."</option>";
		}
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_name'>Học phần</label></td>";
		$register.="<td><select name='maHocPhan' id=''>";
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_name'>Tên lớp học phần</label></td>";
		$register.="<td><input type='text' name='tenLopHocPhan' value='".$name."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Số lượng sinh viên</label></td>";
		$register.="<td><input type='number' name='soLuong' value='' id='register_name' /><td></tr>";
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form></div>";
		return $register;
	}
	//
	//quản lý thông báo
	function form_thongbao($thongbao=null){
		$action="/DoAn/GiaoVus/quanlyThongbao";
		$tieude="";
		$noidung="";
		$register="<div class='contentmain'><h2>Tạo mới thông báo</h2>";
		if(isset($thongbao)){
			$tieude=$thongbao['Thongbao']['tieude'];
			$noidung=$thongbao['Thongbao']['noidung'];
			$action="/DoAn/GiaoVus/suaThongbao/".$thongbao['Thongbao']['id'];
			$register="<div class='contentmain'><h2>Cập nhật thông báo</h2>";
		}
		$register.="<form action='".$action."' method='POST' id='registration_form' name='Thongbao' class='contentmain'><table>";
		$register.="<tr><td><label for='register_name'>Tiêu đề</label></td>";
		$register.="<td><input type='text' name='tieude' value='".$tieude."' id='register_name' /><td></tr>";
		$register.="<tr><td><label for='register_uername'>Nội dung</label></td>";
		$register.="<td><textarea rows='4' cols='50' name='noidung' id='noidung_news' >".$noidung."</textarea><td></tr>";
		$register.="<tr><td><label for='register_uername'>Tập tin đính kèm</label></td>";
		$register.="<td><input type='file' name='file' id='file' accept='*'/></td></tr>";	
		$register.="</table>";
		$register.="<div class='left clear cachbtleft cachbt'>
				<input class='button2 sizebutton2' id='btnUsermn' type='submit' value='Lưu' name='ok'/>
				<input class='button2 sizebutton2' id='' type='reset' value='Nhập lại'/>
				<input class='button2' id='' type='button' value='Tìm kiếm' name='search'/>
				</div></form></div>";
		return $register;
	}
	function listThongbao($data){
		$register="<p>Không tìm thấy danh sách</p>";
		if(isset($data)&&count($data)>0){
			$register="<table class='list'><thead><tr><th>STT</th><th>Tiêu đề</th><th>file đính kèm</th><th>Ngày đăng</th><th>Tác vụ</th></tr></thead>";
			$i=1;
			foreach ($data as $item){
				$register.="<tr><td>".$i."</td><td>".$item['Thongbao']['tieude']."</td><td></td><td>".$item['Thongbao']['ngaydang']."</td>";
				$register.="<td>".$this->link('',array('controller' => 'GiaoVus', 'action' => 'xemThongbao', $item['Thongbao']['id']),array('class'=>'icview','title'=>'xem'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'suaThongbao', $item['Thongbao']['id']),array('class'=>'icedit','title'=>'sửa'));
				$register.=$this->link('',array('controller' => 'GiaoVus', 'action' => 'xoaThongbao', $item['Thongbao']['id']),array('class'=>'icdelete','title'=>'xóa'));
				$register.="</td></tr>";
				$i++;
			}
			$register.="</table>";
		}
		return $register;
	}
	//Function Genneral
	function convertViewdate($inputdate){
		$date= $inputdate;
		$d = getdate(strtotime($date));
		echo $ngay= $d['mday'].' - '.$d['mon'].' - '.$d['year'];
	}
	
}
?>