<?php
/**
 * @author ADMIN-PC
 *
 */
class CommonHelper extends HtmlHelper{
	function general(){
		$footer="<span>Bản quyền (C) 2013 thuộc Hồ Ngọc Duy</span></br><span>Trường Đại học Bách Khoa - Đại học Đà Nẵng</span></br>";
		$footer.="<span>Email:Thanphong.dct@gmail.com </span></br><span>Điện thoại: 01649568431</span>";
		$header="<div id='logo'>".
				$this->image("images/logoBK.png", array('alt' => 'Đại học bách khoa','style' => 'margin:10px 0 0 10px'))
				."
						<div class='today'>Hôm nay: ". date('d-m-Y')."</div></div>";
		//		$header="<div id='logo'><image class='logoleft' src='img/image/logo.jpg' alt='luatvn'/></div><div class='today'>Hôm nay :". date('d-m-Y')."</div> <div class='clear'></div>";
		$data = array(
				"header" => $header,
				"footer" => $footer,
		);

		return $data;
	}
	function create_menu(){
	
		$menu="<ul class='nav'><li class='highlight'>".$this->link('Thông báo',array('controller' => 'users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Lớp học phần',array('controller' => 'users','action' => '','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Phòng học',array('controller' => 'users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Trợ giúp',array('controller' => 'users','action' => 'index','full_base' => true));
		$menu.="<ul><li>".$this->link("Cá nhân",array('controller' => 'users','action' => 'formConsulting','full_base' => true))."</li>";
		$menu.="<li>".$this->link("quản lý",array('controller' => 'users','action' => 'index','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Tài liệu biểu mẫu",array('controller' => 'users','action' => 'index','full_base' => true))."</li></ul></li>";
		$menu.="<li id='login' style='float:right'><a href='#'>Đăng nhập</a></li>";
		$menu.=$this->login()."</ul>";
		return $menu;
	}
	function login(){
		$login = "<div class='login' style='display:none'>";
		$login.="<div class='title'><h1>Login</h1><a href='#' class='close'></a></div>";
	
		$login.="<form method='post' action='/luatvnam/users/login'>";
		$login.="<p><input type='text' id='username' name='username' value='' placeholder='Username'></p>";
		$login.="<input type='password' id='password' name='password' value='' placeholder='Password'></p>";
		$login.="<p id='btnLogin' class='submit'><input type='submit' name='ok' value='Login'></p>";
		$login.="</form></div>";
		return $login;
	}
}
?>