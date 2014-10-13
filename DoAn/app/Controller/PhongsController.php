<?php
class PhongsController extends AppController{
	var $name="Phongs";
	function view($id){
		$data=$this->Phong->findTinbyId($id);
		$this->set('data', $data);
	}
}
?>