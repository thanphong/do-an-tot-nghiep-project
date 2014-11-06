<?php
class UserHelper extends HtmlHelper  {
	function listnews($lisnew){
		//$idtloai=1;//xemlai
		$out="<div class='contentmain'>";
		foreach ($lisnew as $item) {
			//$id_tintuc= $item['Thongbao']['id'];
			$tieude= $item['Thongbao']['tieude'];
			$date= $item['Thongbao']['ngaydang'];
			$noidung=$item['Thongbao']['noidung'];
			$d = getdate(strtotime($date));
			$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
			$out.="<div class='left'>";
			$out.="<div class='left' style='padding:2px 10px;'>";
			$out.="<b><span style='color: red;font-size:13.0pt;line-height:100%;font-family:times new roman,serif'>".$ngay.":</span></b>";
			$out.="&nbsp;&nbsp;&nbsp;&nbsp;";
			$out.="<span style='color:#009900;font-size:13.0pt;line-height:100%;font-family:times new roman,serif'>".$tieude."</span></div>";
			$out.="<div style='padding:5px 10px 15px 10px;font-size:12.0pt;line-height:100%;font-family:times new roman,serif'>".$noidung."</div></div>";			
		}
		$out.="</div>";
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
	function xemphonghoc($listGiangduong){
		
		$register="<table>";
		$register.="<tr><td><b for='register_uername'>Giảng đường</b></td>";
		$register.="<td><select name='' id='giangduong'>";
		foreach($listGiangduong as $item){
			$register.="<option value='".$item['Khuvuc']['id']."'>".$item['Khuvuc']['tenKhuVuc']."</option></option>";
		}
		
		$register.="</select></td></tr>";
		$register.="<tr><td><b for='register_uername'>Ngày</b></td>";
		$register.="<td><input type='text' name='ngay' data-beatpicker='true' data-beatpicker-id='myDatePicker' id='ngayxem'/></td>";
		$register.="<table>";
		return $register;
	}
}
?>