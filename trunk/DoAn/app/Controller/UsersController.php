<?php
class UsersController extends AppController{
	var $layout = "usertemplate";
	public $uses = array('Thongbao');
	var $name="Users";
	
	function beforeFilter(){
// 		parent::beforeFilter();
// 		Security::setHash("md5");
// 		$this->Auth->userModel = 'Giangvien';
// 		$this->Auth->authorize = 'controller';
// 		$this->Auth->fields = array('username' => 'maGiangvien', 'password' => 'MatKhau');
// 		$this->Auth->loginAction = array('controller'=>'users','action'=>'index'); //action se chuyen toi sau khi access trang we
// 		$this->Auth->loginRedirect = array('controller'=>'giaovus','action'=>'index');//action se chuyen den sau khi logi
// 		$this->Auth->logoutRedirect=array('admin' =>false,'controller'=>'users','action'=>'index');
// 		$this->Auth->loginError = 'Failed to login';//thong bao dang nhap bi lo
// 		$this->Auth->authError = 'Access denied'; //thong bao truy cap khong dung khu vuc
// 		$this->Auth->allow(array('index'));
	}
	function index(){
		$listnew=$this->Thongbao->find('all',array('limit' => 10,'page' => 1));
		$this->set("listnew",$listnew);
		//tin lien quan
		$tinlienquan=$this->Thongbao->find('all',array('limit' => 10,'page' => 11));
		$this->set("tinlienquan",$tinlienquan);
	}
	public function login() {
	
	}
}
?>