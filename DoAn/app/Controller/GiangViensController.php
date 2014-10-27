<?php
class GiangViensController extends AppController{
	var $name="GiangViens";
	var $layout = "giangvien";
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index'));
		if(!$this->isGiangvien()&&!$this->isGiaovu()){
			$this->redirect(array("controller"=>"Users",'action'=>'index'));
		}
	}
	function index(){
		
	}
	function view($id){
		$data=$this->GiangVien->findTinbyId($id);
		$this->set('data', $data);
	}
	function persit(){
		if (!empty($this->data)) {
			if ($this->GiangViens->save($this->data)) {
				$this->Session->setFlash('Your data has been saved.');
				//$this->redirect(array('action' => 'index'));
			}
		}

	}
	function merge($id){
		$gianvien=$this->GiangVien->findTinbyId($id);
		if (!empty($this->data)) {
			if ($this->GiangViens->save($this->data)) {
				$this->Session->setFlash('Your data has been saved.');
				//$this->redirect(array('action' => 'index'));
			}
		}
	}
	}
?>