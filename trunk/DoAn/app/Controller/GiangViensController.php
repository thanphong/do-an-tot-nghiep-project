<?php
class GiangViensController extends AppController{
	var $name="GiangViens";
	var $layout = "giangvien";
	public $uses = array('Khuvuc','Phong','Hocki','Lichgiangday','Tuanhoc','Lophocphan','Giangvien','Thongbao','Lichnghi','Lichdaybu');
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
	public function baonghibaobu() {
		$idgv=$this->Session->read('Auth.User.Giangvien.id');
		$this->set("hockys", $this->Hocki->find("all",array('recursive'=>-1)));
	}
	//json
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
<<<<<<< .mine
	//
	public function canhan() {
		$user=$this->Session->read('Auth.User');
		$this->set("user",$user);
		
	}
	public function thaydoimatkhau() {
	
	}
	public function kiemtramatkhau() {
		$this->layout=null;
		if($this->request->is('post')){
			$pass=AuthComponent::password($this->request->data['pass']);
			$data=$this->User->find("all",array('conditions'=>array('User.maGiangvien'=>$this->Session->read('Auth.User.Giangvien.id'),'User.matKhau'=>$pass),'recursive'=>-1));
			$this->set("data",$data);	
		}
	}
=======
	public function lichbaonghi() {
		$this->layout=null;
		$hocky=$this->request->data['hocky'];
		$idgv=$this->Session->read('Auth.User.Giangvien.id');
		$lichngi=$this->Lichnghi->query("select lichnghis.id,lichnghis.ngaynghi,lichnghis.soTiet,lichnghis.ngaybaongi,lophocphans.tenLopHocPhan,lichnghis.id,lophocphans.maLopHocPhan from lichnghis,lichgiangdays,lophocphans
        where lichnghis.maThoiKhoabieu=lichgiangdays.id and lichgiangdays.malophocphan=lophocphans.id and lichgiangdays.magiangvien=".$idgv." and lichgiangdays.mahocky=".$hocky);
		
		$this->set("lichnghi",$lichngi);
	}
	//endjson
	public function createbaonghi() {
		if($this->request->is('post')){
			if(isset($this->request->data)){
				$num=$this->request->data['numberLhp'];
				$ngaybao=$this->request->data['ngaybao'];
				$lydo=$this->request->data['lydo'];
				for ($i=1;$i<=$num;$i++){
					$lichngi=array();
					$idtkb=$this->request->data['idTKB'.$i];
					$ngayngi=$this->request->data['ngayngi'.$i];
					$sotiet=$this->request->data['sotiet'.$i];
					array_push($lichngi,array("maThoiKhoabieu"=>$idtkb,"ngaynghi"=>$ngayngi,"soTiet"=>$sotiet,"lydo"=>$lydo,"ngaybaongi"=>$ngaybao));
					$this->Lichnghi->saveAll($lichngi);
				}
			}
		}
		$this->redirect(array( 'controller'=>'Giangviens','action' => 'baonghi'));
	}
	//
	public function timphonghoc() {
		$this->layout=null;
		$tutiet=$this->request->data['tutiet'];
		$dentien=$this->request->data['dentien'];
		$ngay=$this->request->data['ngay'];
		$date_stamp = strtotime(date('Y-m-d', strtotime($ngay)));
		$stamp = date('l', $date_stamp);
		$thu=0;
		switch ($stamp){
			case "Sunday":
				$thu=8;
				break;
			case "Monday":
				$thu=2;
				break;
			case "Tuesday":
				$thu=3;
				break;
			case "Wednesday":
				$thu=4;
				break;
			case "Thursday":
				$thu=5;
				break;
			case "Friday":
				$thu=6;
				break;
			case "Saturday":
				$thu=7;
				break;
			default:
				$thu=-1;
		}
		
		//$data=$this->Lichgiangday->find("all",array('conditions'=>array('Lichgiangday.thu'=>$thu,'Lichgiangday.tutiet <='=>$tutiet,'Lichgiangday.dentiet >='=>$dentien)));
		$data=$this->Phong->query("CALL timphong(".$thu.",".$tutiet.",".$dentien.")");
		$this->set("lisphong",$data);
	}
	//
	public function createbaobu() {
		if($this->request->is("post")){
			$number=$this->request->data["numberLopbaobu"];
			$ngaybao=$this->request->data['ngaybao'];
			for($i=1;$i<=$number;$i++){
				$lichbu=array();
				$iddkbu=$this->request->data['mabaobu'.$i];
				$ngaybu=$this->request->data['ngaybu'.$i];
				$tutiet=$this->request->data['tutiet'.$i];
				$dentiet=$this->request->data['dentiet'.$i];
				$maphong=$this->request->data['maphong'.$i];
				array_push($lichbu,array("malichnghi"=>$iddkbu,"maphong"=>$maphong,"ngaydaybu"=>$ngaybu,"tutiet"=>$tutiet,"dentiet"=>$dentiet,"ngaybao"=>$ngaybao));
				$this->Lichdaybu->saveAll($lichbu);
			}
		}
		$this->redirect(array( 'controller'=>'Giangviens','action' => 'baonghi'));
	}
	
	
	//
}
?>