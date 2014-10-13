<?php
class UsersController extends AppController{
	var $name="Users";
	// 		function beforeFilter(){
	// 			parent::beforeFilter();
	// 			Security::setHash("md5");
	// 			$this->Auth->userModel = 'User';
	// 			$this->Auth->authorize = 'controller';
	// 			$this->Auth->fields = array('username' => 'username', 'password' => 'password');

	// 			//$this->Auth->loginAction = array('controller'=>'users','action'=>'index'); //action se chuyen toi sau khi access trang we
	// 			//$this->Auth->loginRedirect = array('controller'=>'users','action'=>'profile');//action se chuyen den sau khi logi
	// 			$this->Auth->logoutRedirect=array('admin' =>false,'controller'=>'users','action'=>'index');
	// 			$this->Auth->loginError = 'Failed to login';//thong bao dang nhap bi lo
	// 			$this->Auth->authError = 'Access denied'; //thong bao truy cap khong dung khu vuc
	// 			$this->Auth->allow(array('index', 'register',"CheckUser"));
	// 		}
	function index(){
			
	}
}
?>