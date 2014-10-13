<?php
class KhoasController extends AppController{
	var $name="Khoas";
	function index(){

	}
	public function persit() {
		if (!empty($this->data)) {
			if ($this->Khoa->save($this->data)) {
				$this->Session->setFlash('Your data has been saved.');
				//$this->redirect(array('action' => 'index'));
			}
		}

	}

}
?>