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
	function listnews($lisnew){
		//$idtloai=1;//xemlai
		$out="";
		foreach ($lisnew as $item) {
			$id_tintuc= $item['thongbaos']['id'];
			$tieude= $item['thongbaos']['tieude'];
			$date= $item['thongbaos']['ngaydang'];
			$d = getdate(strtotime($date));
			$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
			$out.="<div class='blockcontent-body'>";
			$out.="<ul><li>";
			$tt=$item['tbltintucs']['tieude'];
			$out.=$this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$item['tbltintucs']['id_tintuc']))."<p><span class='bitsmall'>($ngay)</span><span class='bitsmall'>($solanxem lần xem)</span></p>";
			$out.="</ul></li></div>";
		
		}
		return $out;
	}
	function tinlienquan($lisnews){
		$output ='<div class="clear more left">';
		$output .='<div class="tinthem left"><div class="left iconleft"></div>MORE</div>';
		foreach ($lisnews as $item) {
			if(!$this->checkDisplay($item, $datatin)){
				$id_tintuc= $item['thongbaos']['id'];
				$tieude= $item['thongbaos']['tieude'];
				$date= $item['thongbaos']['ngaydang'];
				$d = getdate(strtotime($date));
				$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
				$tt=$item['thongbaos']['tieude'];
				$output .= '<div class="left"><span class="icontin"></span>' . $this->link($tt,array('controller' => 'Users','action' => 'view',$item['thongbaos']['id']))."<p style='margin-left:10px;'><span class='bitsmall'>($ngay)</span></p></div>";
			}
		}
		$output .='</div>';
		return $output;
	}
}
?>