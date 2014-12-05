<?php
class UserHelper extends HtmlHelper  {
	function listnews($lisnew,$listnewlhp){
		//$idtloai=1;//xemlai
		$out="<input type='hidden' id='note' value='home'/>";
		$out.="<div class='div-text'><ul id='tabs'><li><a href='#' name='tab1'>Thông báo chung</a></li>";
		$out.="<li><a href='#' name='tab2'>Thông báo lớp học phần</a></li></ul>";
		$out.="<div class='contentmain' id='contenttab'>";		
			$out.="<div id='tab1' class='blockcontent-body'>";
			foreach ($lisnew as $item) {
				//$id_tintuc= $item['Thongbao']['id'];
				$tieude= $item['Thongbao']['tieude'];
				$date= $item['Thongbao']['ngaydang'];
				$noidung=$item['Thongbao']['noidung'];
				$d = getdate(strtotime($date));
				$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
				$out.="<span class='left clear'>";
				$out.="<span class='left' style='padding:2px 5px;'>";
				$out.="<b><span style='color: red;font-size:13.0pt;line-height:100%;font-family:times new roman,serif'>".$ngay.":</span></b>";
				$out.="&nbsp;&nbsp;&nbsp;&nbsp;";
				$out.="<span class='tdthongbao'>".$tieude."</span></span>";
				$out.="<span class='containTin'>".$noidung."</span></span>";			
			}
			$out.="</div>";
			$out.="<div id='tab2' class='blockcontent-body'";
			foreach ($listnewlhp as $item) {
				//$id_tintuc= $item['Thongbao']['id'];
				$tieude= $item['Thongbao']['tieude'];
				$date= $item['Thongbao']['ngaydang'];
				$noidung=$item['Thongbao']['noidung'];
				$d = getdate(strtotime($date));
				$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
				$out.="<span class='left clear'>";
				$out.="<span class='left' style='padding:2px 5px;'>";
				$out.="<b><span style='color: red;font-size:13.0pt;line-height:100%;font-family:times new roman,serif'>".$ngay.":</span></b>";
				$out.="&nbsp;&nbsp;&nbsp;&nbsp;";
				$out.="<span class='tdthongbao'>".$tieude."</span></span>";
				$out.="<span class='containTin'>".$noidung."</span></span>";
			}
			$out.="</div></div>";
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
	//
	function xemphonghoc($listGiangduong,$listTuan){
		$register="<input type='hidden' id='note' value='phonghoc'/>";
		$register.="<table>";
		$register.="<tr><td><b for='register_uername'>Giảng đường</b></td>";
		$register.="<td><select name='' id='giangduong'>";
		foreach($listGiangduong as $item){
			$register.="<option value='".$item['Khuvuc']['id']."'>".$item['Khuvuc']['tenKhuVuc']."</option></option>";
		}
		
		$register.="</select></td></tr>";
		$register.="<tr><td><b for='register_uername'>Ngày</b></td>";
		$register.="<td><input type='text' name='ngay' data-beatpicker='true' data-beatpicker-id='myDatePicker' id='ngayxem'/></td>";
		$register.="<td><select name='' id='tuan'>";
		foreach($listTuan as $item){
			$register.="<option value='".$item['Tuanhoc']['id']."'>Tuần ".$item['Tuanhoc']['tuan']."(".$item['Tuanhoc']['ngaybatdau']."-".$item['Tuanhoc']['ngaykethuc'].")</option></option>";
		}
		
		$register.="</select></td></tr>";
		$register.="<table>";
		return $register;
	}
}
?>