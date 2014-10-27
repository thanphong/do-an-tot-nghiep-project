<?php

class UsersController extends AppController {
	var $layout = "user";
	public $uses = array('Quyengiangvien');
    public function beforeFilter() {
       parent::beforeFilter();
       $this->Auth->allow(array('index','login','logout'));
       $this->isGiangvien();
       $this->isGiaovu();
    }
	public function login() {
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				//$this->Auth->user('Quyengiangvien')=
				$user=$this->Quyengiangvien->find("list",array('conditions' => array('Quyengiangvien.magiangvien' => $this->Auth->user('id')),'fields' => array('Quyengiangvien.maquyen'),'recursive'=>-1));
				$this->Session->write("roles",$user);
				$this->Session->setFlash(__('Welcome, '. $this->Auth->user('Giangvien.ten')));
				$this->redirect($this->Auth->redirectUrl());
			}
		} 
		
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('controller'=>'Giangviens','action' => 'index'));
		}
		$this->redirect($this->Auth->redirect());
	}

	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}

    public function index() {
    	//print_r($this->User->find('first', array('conditions' => array('User.id' => 45))));
    	//print_r($this->Auth->user());
    	//print_r($this->Session->read('roles'));
    }

}

?>