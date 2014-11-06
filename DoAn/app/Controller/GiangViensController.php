<?php
class GiangViensController extends AppController{
	var $name="GiangViens";
	var $layout = "giangvien";
	public $uses = array('Khuvuc','Phong','Hocki','Lichgiangday','Tuanhoc','Lophocphan','Giangvien','Thongbao');
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','BaongiDaybu'));
		if(!$this->isGiangvien()&&!$this->isGiaovu()){
			$this->redirect(array("controller"=>"Users",'action'=>'index'));
		}
		if($this->isGiaovu()){
			$layout="giaovu";
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
	public function BaongiDaybu() {
		$idgv=$this->Session->read('Auth.User.Giangvien.id');
		$this->set("hockys", $this->Hocki->find("all",array('recursive'=>-1)));
	}
	public function thoikhoabieu(){
		$this->layout=null;
		$hocky=$this->request->data['hocky'];
		$idgv=$this->Session->read('Auth.User.Giangvien.id');
		$lichday=$this->Lichgiangday->find('all',array('conditions'=>array('Lichgiangday.mahocky'=>$hocky,'Lichgiangday.magiangvien'=>$idgv),'recursive'=>-1));
		for($i=0;$i<count($lichday);$i++){
			$lhp=$this->Lophocphan->find("first",array('conditions'=>array('Lophocphan.id'=>$lichday[$i]['Lichgiangday']['malophocphan']),'recursive'=>-1));
			$mahocphan=$this->Phong->find("first",array('conditions'=>array('Phong.id'=>$lichday[$i]['Lichgiangday']['maphong']),'recursive'=>-1));
			$lichday[$i]['Lophocphan']=$lhp;
			$lichday[$i]['phong']=$mahocphan;
		}
		$this->set("Lichgiangday",$lichday);
	}
}
?>