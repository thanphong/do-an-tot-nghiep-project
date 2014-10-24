<?php
class GiaoVusController extends AppController{
	var $name="GiaoVus";
	var $layout = "giaovu";
	public $uses = array('Khoa','Giangvien','Hocphan','Hocky','Khuvuc','Loaithietbi','Lophocphan','Phong','Quyen','Thietbi','Thongbao');
	function index(){

	}
	//quản lý giảng viên
	public function quanlyGiangVien() {
		$listquyen=$this->Quyen->find("all",array('recursive'=>-1));
		$this->set("listquyen",$listquyen);	
		$listKhoa=$this->Khoa->find("all",array('recursive'=>-1));
		$this->set("listKhoa",$listKhoa);
	}
	
	//
	public function quanlyKhoa() {

	}

	public function themMoiKhoas() {
		if($this->request->is('post')){
			$makhoa=$this->TaoMaKhoa($this->request->data['tenKhoa']);
			$this->request->data['maKhoa']=$makhoa;
			$this->Khoa->save($this->request->data);
		}
		$data=$this->Khoa->find('all',array('recursive'=>-1));
		$this->set("data",$data);
	}
	public function TaoMaKhoa($tenkhoa){
		$name=$pieces = explode(" ", $tenkhoa);
		$makhoa="";
		foreach ($name as $value){
			$makhoa.=substr($value,0,1);
		}
		return $makhoa;
	}
	public function xemKhoas($id) {
		$khoa=$this->Khoa->find('first', array('conditions' => array('Khoa.id' => $id)));
		$this->set("data",$khoa);
	}
	public function suaKhoa($id) {
		if($this->request->is('post')){
			$this->Khoa->updateAll(array('Khoa.tenKhoa' =>"'".$this->request->data('tenKhoa')."'",
					'Khoa.mota'=>"'".$this->request->data('mota')."'"),array('Khoa.id' => $id));
		}else{
			$khoa=$this->Khoa->find('first', array('conditions' => array('Khoa.id' => $id)));
			$this->set("khoa",$khoa);
		}

		$data=$this->Khoa->find('all',array('recursive'=>-1));
		$this->set("data",$data);
		$this->render('themMoiKhoas');
	}
	public function xoaKhoa($id) {
		$this->Khoa->deleteAll(array('Khoa.id'=>$id));
		$data=$this->Khoa->find('all',array('recursive'=>-1));
		$this->set("data",$data);
		$this->redirect(array('action' => 'themMoiKhoas'));
		//$this->render('themMoiKhoas');
	}
	public function themGiangvien() {
		
		if($this->request->is('post')){
			$this->Giangvien->save($this->request->data);
		}
	}
	//học phần
	public function quanlyHocphan() {
	
	}
	public function themMoiHocphan() {
		if($this->request->is('post')){
				$this->Hocphan->saveAll($this->request->data);
		}
			$this->set("data",$this->Hocphan->find("all",array('recursive'=>-1)));
	}
	public function suaHocphan($id) {
		if($this->request->is("post")){
			$this->Hocphan->updateAll(array('Hocphan.tenhocphan' =>"'".$this->request->data('tenhocphan')."'",'Hocphan.trangthai'=>$this->request->data('trangthai'),
					'Hocphan.mota'=>"'".$this->request->data('mota')."'"),array('Hocphan.id' => $id));
			$this->redirect(array('controller' => 'giaovus', 'action' => 'themMoiHocphan'));
		}
		else{
			$hocphan=$this->Hocphan->find("first",array('conditions' => array('Hocphan.id' => $id)));
			$this->set("hocphan",$hocphan);
			$this->set("data",$this->Hocphan->find("all",array('recursive'=>-1)));
			$this->render('themMoiHocphan');
		}	
	}
	public function xoaHocphan($id) {
		$this->Hocphan->deleteAll(array('Hocphan.id'=>$id));
		$this->redirect(array('controller' => 'giaovus', 'action' => 'themMoiHocphan'));
	}
	public function xemHocphan() {
		
	}
	//quản lý phòng
	public function quanlyphong() {
		$listthietbi=$this->Thietbi->find("all",array('recursive'=>-1));
		$this->set("listthietbi",$listthietbi);
		$listKhuvuc=$this->Khuvuc->find("all",array('recursive'=>-1));
		$this->set("listKhuvuc",$listKhuvuc);
	}
	//
	//quản lý thiết bị
	public function quanlyThietbi() {
		$listLoaiThietbi=$this->Loaithietbi->find("all",array('recursive'=>-1));
		$this->set("listLoaiThietbi",$listLoaiThietbi);
	}
	//quản lý lớp học phần
	public function quanlyLophocphan() {
		$listKhoa=$this->Khoa->find("all",array('recursive'=>-1));
		$this->set("listKhoa",$listKhoa);
	}
	//
	//quản lý thông báo
	public function quanlyThongbao() {
		
	}
	//
	
	
}

?>