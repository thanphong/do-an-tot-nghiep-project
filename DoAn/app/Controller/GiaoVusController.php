<?php
class GiaoVusController extends AppController{
	var $name="GiaoVus";
	var $layout = "giaovu";
	public $uses = array('Khoa','Giangvien','Hocphan','Hocky','Khuvuc','Loaithietbi','Lophocphan','Phong','Quyen','Thietbi','Thongbao','User','Quyengiangvien');
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('quanlyGiangVien','themGiangvien','index');
		if(!$this->isGiaovu()){
			if(!$this->isGiangvien())
				$this->redirect(array( 'controller'=>'Users','action' => 'index'));
			else
				$this->redirect(array( 'controller'=>'Giangviens','action' => 'index'));
		}
	}
	function index(){
		$this->redirect(array( 'controller'=>'Users','action' => 'index'));
	}
	//quản lý giảng viên
	public function quanlyGiangVien($page=null,$end=null) {
		$listquyen=$this->Quyen->find("all",array('recursive'=>-1));
		$this->set("listquyen",$listquyen);
		$listKhoa=$this->Khoa->find("all",array('recursive'=>-1));
		$this->set("listKhoa",$listKhoa);
		
		$this->populateGiangvien($page,$end);
	}
	public function themGiangvien() {
		if($this->request->is('post')){
			$user=array();
			$roles=$this->request->data["roles"];
			$khoas=$this->request->data("khoas");
			$magiangvien=$this->taoMagiangvien($this->request->data);
			$user['User']['maGiangvien']=$magiangvien;
			$this->request->data["maGiangvien"]=$magiangvien;
			$ngaysinh=split("-",$this->request->data("ngaySinh"));
			$mk=$ngaysinh[2]."".$ngaysinh[1]."".($ngaysinh[0]%100);
			$user['User']['matKhau'] =$mk;
			$this->Giangvien->save($this->request->data);
			$gv=$this->Giangvien->find('first',array('conditions' => array('Giangvien.maGiangvien' => $magiangvien),'recursive'=>-1));
			$user['User']['id']=$gv['Giangvien']['id'];
			$this->User->create();
			$this->User->save($user);
			foreach ($roles as $item){
				$gvRole=array();
				$gvRole['Quyengiangvien']['magiangvien']=$gv['Giangvien']['id'];
				$gvRole['Quyengiangvien']['maquyen']=$item;
				$this->Quyengiangvien->create();
				$this->Quyengiangvien->save($gvRole);
			}
		}
		$this->render('quanlyGiangVien');
		//$this->redirect(array( 'action' => 'quanlyGiangVien'));
	}
	public function taoMagiangvien($giangvien){
		$khoa=$giangvien['khoas'][0];

		$khoas=$this->Khoa->find("first",array('conditions' => array('Khoa.id' => $khoa),'recursive'=>-1));
		$arr=$this->Giangvien->find("first",array('conditions' => array('Giangvien.maGiangvien like ' =>'%'. $khoas['Khoa']['maKhoa'].'%'),'order'=>array('Giangvien.maGiangvien'=>'DESC')));
		if(isset($arr) && $arr!=null){
			$magiangvien=split($khoas['Khoa']['maKhoa'],$arr['Giangvien']['maGiangvien']);
			if($magiangvien[1]+1<10){
				return $khoas['Khoa']['maKhoa'].'0'.($magiangvien[1]+1);
			}
			return $khoas['Khoa']['maKhoa'].($magiangvien[1]+1);
		}
		return $khoas['Khoa']['maKhoa']."01";
	}
	public function populateGiangvien($page=null,$end=null){
	
		$page=(($page==null || !isset($page))?1:$page);
		$end=(($end==null)||!isset($end)?$this->numberpage:$end);
		$numberrecord=$this->Giangvien->find('count');
		$this->set("danhsachGv",$this->Giangvien->find("all",array('limit' => $this->numberRecord, 'offset'=>($page-1)*$this->numberRecord,'recursive'=>-1)));
		$this->pagination($page, $numberrecord,$end);
	}
	//Vy 6-11-2014
	public function xemGiangvien($id) {
		$gvien=$this->Giangvien->find('first', array('conditions' => array('Giangvien.id' => $id),'recursive'=>-1));
		$this->set("data",$gvien);
	}
	//Khoa
	public function quanlyKhoa() {
		$data=$this->Khoa->find('all',array('recursive'=>-1));
		$this->set("data",$data);
	}

	public function themMoiKhoas() {
		if($this->request->is('post')){
			$makhoa=$this->TaoMaKhoa($this->request->data['tenKhoa']);
			$this->request->data['maKhoa']=$makhoa;
			$this->Khoa->save($this->request->data);
		}
		$this->redirect(array( 'action' => 'quanlyKhoa'));
		
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
		$khoa=$this->Khoa->find('first', array('conditions' => array('Khoa.id' => $id),'recursive'=>-1));
		$this->set("data",$khoa);
	}
	public function suaKhoa($id) {
		if($this->request->is('post')){
			$this->Khoa->updateAll(array('Khoa.tenKhoa' =>"'".$this->request->data('tenKhoa')."'",
					'Khoa.mota'=>"'".$this->request->data('mota')."'"),array('Khoa.id' => $id));
		}else{
			$khoa=$this->Khoa->find('first', array('conditions' => array('Khoa.id' => $id),'recursive'=>-1));
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

	//học phần
	public function quanlyHocphan() {
		$this->set("listKhoa",$this->Khoa->find('all',array('recursive'=>-1)));
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
		$id=$this->Auth->user("id");
		$listhongbao=$this->Thongbao->find("all",array('conditions' => array('Thongbao.nguoidang' => $id),'order'=>array('Thongbao.ngaydang'=>'ASC')));
		$this->set("listThongbao",$listhongbao);
		
	}
	public function themThongbao(){
		if($this->request->is("POST")){
			$id=$this->Auth->user("id");
			$this->request->data['ngaydang']=date('y/m/d h:i:s',time());
			$this->request->data['ngayCapnhap']=date('y/m/d h:i:s',time());
			$this->request->data['nguoidang']=$id;
		}
		$this->render("quanlyThongbao");
	}
	//

}

?>