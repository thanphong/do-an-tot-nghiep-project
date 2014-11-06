<?php 
class UserformHelper extends FormHelper{
	function formlogin(){
		$login = "<div class='login' style='display:none'>";
		//$login.= $this->Session->flash('auth');
		$login.="<div class='title'><h1>Login</h1><a href='#' class='close'></a></div>";
		$login.=$this->create("User",array('action'=>'login'));
		$login.="<fieldset class='left clear'>".$this->input('maGiangvien', array('label' => 'Mã giảng viên'));
    	$login.=$this->input('matKhau',array('label' => 'Mật khẩu','type'=>'password'));
    	$login.="</fieldset>".$this->end(__("Login"))."</div></ul>";
		return $login;
	}
}

?>