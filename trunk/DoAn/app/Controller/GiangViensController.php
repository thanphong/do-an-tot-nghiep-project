<?php
class GiangViensController extends AppController{
	var $name="GiangViens";
	var $layout = "giangvien";
	public $uses = array('Khuvuc','Phong','Hocki','Lichgiangday','Tuanhoc','Lophocphan','Giangvien','Thongbao','Lichnghi','Lichdaybu','User','Khoa');
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('index','BaongiDaybu'));
		if(!$this->isGiangvien()&&!$this->isGiaovu()){
			$this->redirect(array("Controller"=>"Users",'action'=>'index'));
		}
		if($this->isGiaovu()){
			$layout="giaovu";
		}
	}
	function index(){
		$this->redirect(array("Controller"=>"Users",'action'=>'index'));
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
	//
	public function gethocky(){
		$this->layout=null;
		$hocky=$this->request->data['hocky'];
		$hockys=$this->Hocki->find("first",array('conditions'=>array("Hocki.id"=>$hocky),'recursive'=>-1));
		$this->set("hocky",$hockys);
	}
	//json
	public function thoikhoabieu(){
		$this->layout=null;
		$hocky=$this->request->data['hocky'];
		$idgv=$this->Session->read('Auth.User.Giangvien.id');
		$lichday=$this->Lichgiangday->find('all',array('conditions'=>array('Lichgiangday.mahocky'=>$hocky,'Lichgiangday.magiangvien'=>$idgv)));

		$this->set("Lichgiangday",$lichday);
	}
	//
	public function canhan() {
		
		$user=$this->Session->read('Auth.User');
		$khoa=$this->Session->read('Auth.User.Giangvien.khoa');
		$khoas=$this->Khoa->find("first",array('conditions'=>array('Khoa.id'=>$khoa),'recursive'=>-1));
		$this->set("Khoa",$khoas);
		$this->set("user",$user);
		
	}
	public function thaydoimatkhau() {
		$this->request->data['newMatkhau'] = Security::hash($this->request->data['newMatkhau'],NULL,TRUE);	
		if($this->request->is('post')){
			$this->User->updateAll(array('User.matKhau' =>"'".$this->request->data('newMatkhau')."'")
					,array('User.id' =>$this->Session->read('Auth.User.id')));
			$this->set('success','success');
			$this->redirect(array('controller' => 'giangviens', 'action' => 'canhan'));	
		//	$this->render('canhan');
		}
		
	}
	public function kiemtramatkhau() {
		$this->layout=null;
		if($this->request->is('post')){
			$pass=AuthComponent::password($this->request->data['pass']);
			$data=$this->User->find("all",array('conditions'=>array('User.maGiangvien'=>$this->Session->read('Auth.User.Giangvien.id'),'User.matKhau'=>$pass),'recursive'=>-1));
			$this->set("data",$data);	
		}
	}
	public function lichbaonghi() {
		$this->layout=null;
		$hocky=$this->request->data['hocky'];
		$idgv=$this->Session->read('Auth.User.Giangvien.id');
		
		$lichday=$this->Lichgiangday->query("select lichgiangdays.id,lophocphans.tenLopHocPhan,lophocphans.maLopHocPhan,lichgiangdays.thu,lichgiangdays.tutiet,lichgiangdays.dentiet from lichnghis,lichgiangdays,lophocphans
				where lichnghis.maThoiKhoabieu=lichgiangdays.id and lichgiangdays.malophocphan=lophocphans.id and lichgiangdays.magiangvien=".$idgv." and lichgiangdays.mahocky=".$hocky." group by lichnghis.maThoiKhoabieu");
		$i=0;
		foreach ($lichday as $items){
			$sotietnghi=0;
			$sotietdabu=0;
			$lichbaonghi=$this->Lichnghi->find("all",array('conditions'=>array('Lichnghi.maThoiKhoabieu'=>$items['lichgiangdays']['id'])));
			foreach ($lichbaonghi as $items){
				$sotietnghi+=$items['Lichnghi']['soTiet'];
				$daybus=$items['Lichdaybu'];
				$sotietbu=0;
				foreach ($daybus as $item){
					$sotietbu+=$item['dentiet']-$item['tutiet']+1;	
				}
				$sotietdabu+=$sotietbu;
			}
			$lichday[$i]['sotietnghi']=$sotietnghi;
			$lichday[$i]['sotietbu']=$sotietdabu;
			$lichday[$i]['lichnghi']=$lichbaonghi;
			$i++;
			//array_push($lichday,$lichbaonghi);
		
		}
		$this->set("lichnghi",$lichday);
	}
	//endjson
	public function createbaonghi() {
		if($this->request->is('post')){
			
			if(isset($this->request->data)){
				$num=$this->request->data['numberLhp'];
				$ngaybao=date('Y/m/d', time());
				$lydo=$this->request->data['lydo'];
				
				for ($i=1;$i<=$num;$i++){
					$lichngi=array();
					$thongbao=array();
					$idtkb=$this->request->data['idTKB'.$i];
					$ngayngi=$this->request->data['ngayngi'.$i];
					$sotiet=$this->request->data['sotiet'.$i];
					array_push($lichngi,array("maThoiKhoabieu"=>$idtkb,"ngaynghi"=>$ngayngi,"soTiet"=>$sotiet,"lydo"=>$lydo,"ngaybaongi"=>$ngaybao));
					$this->Lichnghi->saveAll($lichngi);
					$tkb=$this->Lichgiangday->find("first",array("conditions"=>array("Lichgiangday.id"=>$idtkb)));
					array_push($thongbao,array("loaithongbao"=>2,"tieude"=>"Thông báo đến lớp [".$tkb['Lophocphan']['maLopHocPhan']."]".$tkb['Lophocphan']['tenLopHocPhan'],"noidung"=>"Lớp nghỉ học ngày ".$ngayngi,"nguoidang"=>$tkb['Lichgiangday']['magiangvien']));
					$this->Thongbao->saveAll($thongbao);
				}
			}
		}
		$this->redirect(array( 'controller'=>'GiangViens','action' => 'baonghibaobu'));
	}
	//
	public function timphonghoc() {
		$this->layout=null;
		$mgv=$this->Session->read('Auth.User.Giangvien.id');
		$ky=$this->request->data['hocky'];
		$tutiet=$this->request->data['tutiet'];
		$dentiet=$this->request->data['dentien'];
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
		$sql='SELECT * FROM lichgiangdays where (lichgiangdays.tutiet >='.$tutiet.' and lichgiangdays.tutiet <='.$dentiet.' and lichgiangdays.magiangvien ='.$mgv.' and lichgiangdays.mahocky ='.$ky.' and lichgiangdays.thu ='.$thu.')
					or (lichgiangdays.tutiet <='.$tutiet.' and lichgiangdays.dentiet >='.$dentiet.' and lichgiangdays.magiangvien ='.$mgv.' and lichgiangdays.mahocky ='.$ky.' and lichgiangdays.thu ='.$thu.')
					or (lichgiangdays.dentiet >='.$tutiet.' and lichgiangdays.dentiet <='.$dentiet.' and lichgiangdays.magiangvien ='.$mgv.' and lichgiangdays.mahocky ='.$ky.' and lichgiangdays.thu ='.$thu.')
					or (lichgiangdays.tutiet >='.$tutiet.' and lichgiangdays.dentiet <='.$dentiet.' and lichgiangdays.magiangvien ='.$mgv.' and lichgiangdays.mahocky ='.$ky.' and lichgiangdays.thu ='.$thu.')';

		$lichday=$this->Lichgiangday->query($sql);
		$num=60;
		$data=null;
		if(count($lichday)<1){
			$ngay="'".$ngay."'";
			$data=$this->Phong->query("CALL timphong(".$thu.",".$tutiet.",".$dentiet.",".$ky.",".$ngay.",".$num.")");
		}
		$this->set("lisphong",$data);
	}
	//
	public function createbaobu() {
		if($this->request->is("post")){
			$number=$this->request->data["numberLopbaobu"];
			$mgv=$this->Session->read('Auth.User.Giangvien.id');
			$ngaybao=date('Y/m/d', time());
			for($i=1;$i<=$number;$i++){
				$lichbu=array();
				$thongbao=array();
				$iddkbu=$this->request->data['mabaobu'.$i];
				$ngaybu=$this->request->data['ngaybu'.$i];
				$tutiet=$this->request->data['tutiet'.$i];
				$dentiet=$this->request->data['dentiet'.$i];
				$maphong=$this->request->data['maphong'.$i];
				$tenphong=$this->request->data['tenphong'.$i];
				$malhp=$this->request->data['malhp'.$i];
				array_push($lichbu,array("malichnghi"=>$iddkbu,"maphong"=>$maphong,"ngaydaybu"=>$ngaybu,"tutiet"=>$tutiet,"dentiet"=>$dentiet,"ngaybao"=>$ngaybao));
				$this->Lichdaybu->saveAll($lichbu);
				$lophp=$this->Lophocphan->find("first",array("conditions"=>array("Lophocphan.maLopHocPhan"=>$malhp),'recursive'=>-1));
				array_push($thongbao,array("loaithongbao"=>2,"tieude"=>"Thông báo đến lớp [".$lophp['Lophocphan']['maLopHocPhan']."]".$lophp['Lophocphan']['tenLopHocPhan'],"noidung"=>"Lớp học bù ngày ".$ngaybu." tại phòng ".$tenphong." từ tiết ".$tutiet." đến tiết ".$dentiet,"nguoidang"=>$mgv));
				$this->Thongbao->saveAll($thongbao);
			}
		}
		$this->redirect(array( 'controller'=>'GiangViens','action' => 'baonghibaobu'));
	}

	//
	public function huybaobu() {
		if($this->request->is("post")){
			$number=$this->request->data["numberLopbaobu"];
			for ($i=1;$i<=$number;$i++){
				$iddkbu=$this->request->data['mabaobu'.$i];
				$this->Lichdaybu->deleteAll(array('Lichdaybu.id'=>$iddkbu));
			}
			$this->redirect(array( 'controller'=>'GiangViens','action' => 'baonghibaobu'));
		}
	}
	public function huybaonghi() {
		if($this->request->is("post")){
			$number=$this->request->data["numberLopbaobu"];
			for ($i=1;$i<=$number;$i++){
				$iddkbu=$this->request->data['mabaonghi'.$i];
				$this->Lichnghi->deleteAll(array('Lichnghi.id'=>$iddkbu));
			}
			$this->redirect(array( 'controller'=>'GiangViens','action' => 'baonghibaobu'));
		}
	}
	
}
?>