<?php
class UserHelper extends HtmlHelper  {
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
	//
	function xemphonghoc($listGiangduong){
		
		$register="<table>";
		$register.="<tr><td><label for='register_uername'>Giảng đường</label></td>";
		$register.="<td><select name='' id='giangduong'>";
		foreach($listGiangduong as $item){
			$register.="<option value='".$item['Khuvuc']['id']."'>".$item['Khuvuc']['tenKhuVuc']."</option></option>";
		}
		
		$register.="</select></td></tr>";
		$register.="<tr><td><label for='register_uername'>Ngày:</label></td>";
		$register.="<td><input type='text' name='ngay' data-beatpicker='true' data-beatpicker-id='myDatePicker' id='ngayxem'/></td>";
		$register.="<table>";
		return $register;
	}
}
?>