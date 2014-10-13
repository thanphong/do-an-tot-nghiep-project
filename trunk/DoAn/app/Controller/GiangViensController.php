<?php
class GiangViensController extends AppController{
	var $name="GiangViens";
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