<?php
class GiangvienHelper extends HtmlHelper{
	function create_menu($username){
		$menu="<ul class='nav'><li class='highlight'>".$this->link('Thông báo',array('controller' => 'users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Lớp học phần',array('controller' => 'users','action' => '','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Phòng học',array('controller' => 'users','action' => 'xemPhonghoc','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Quản lý',array('controller' => 'users','action' => 'index','full_base' => true));
		$menu.="<ul><li>".$this->link("Báo ngỉ-dạy bù",array('controller' => 'Giangviens','action' => 'BaongiDaybu','full_base' => true))."</li>";
		$menu.="</ul></li>";
		$menu.="<li class=''>".$this->link('Trợ giúp',array('controller' => 'users','action' => 'index','full_base' => true));
		$menu.="<ul><li>".$this->link("Cá nhân",array('controller' => 'users','action' => 'formConsulting','full_base' => true))."</li>";
		$menu.="<li>".$this->link("quản lý",array('controller' => 'users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Tài liệu biểu mẫu",array('controller' => 'users','action' => 'index','full_base' => true))."</li></ul></li>";
		$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li>";
		$menu.="<li style='float:right'>".$this->link('Cá nhân',array('controller' => 'users','action' => 'profile','full_base' => true,$username))."</li>";
		$menu.="<span class='titlelog'>Xin chào: ".$username." </span>";
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
		return $out;
	}
}
?>