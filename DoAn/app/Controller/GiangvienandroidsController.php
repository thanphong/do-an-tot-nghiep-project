<?php
class GiangvienandroidsController extends AppController{
	var $layout = null;
	var $name="Gianvienadroids";
	public $uses = array("Thongbao","Giangvien","Lichgiangday",'Hocki','Lophocphan','Phong','Lichnghi','Lichdaybu','Lichthi','Thongbao');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}
	public function checklocgin(){
		if($this->request->is("post")){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);

			$this->request->data['User']['maGiangvien']=$obj->{'accountName'};
			$this->request->data['User']['matKhau']=$obj->{'pass'};
			//$this->Auth->user['matKhau']=$obj->{'pass'};
			if ($this->Auth->login()) {
				$data=array();
				$data['accountId']=$this->Auth->user('Giangvien.id');
				$data['accountName']=$this->Auth->user('Giangvien.ten');
				$data['pass']=$obj->{'pass'};
				$this->set("user",$data);
			}else{
				$this->set("ok",$obj);
			}
		}
	}
	public function test($id){
		$this->autoRender = false;
		$this->set("test","ok");
		header('Content-type: application/json');
		json_encode( "ok" );
	}
	public function getNews(){
		$listnews=$this->Thongbao->find("all",array( 'conditions'=>array('Thongbao.loaithongbao'=>1),'order' => array('Thongbao.ngaydang DESC'),'limit' => 3));
		$data =array();
		foreach ($listnews as $item){
			$new=array();
			$new['tieude']=$item['Thongbao']['tieude'];
			$new['noidung']=$item['Thongbao']['noidung'];
			$new['id']=$item['Thongbao']['id'];
			$d = getdate(strtotime($item['Thongbao']['ngaydang']));
			$ngay= $d['mday'].'/'.$d['mon'].'/'.$d['year'];
			$new['ngay']=$ngay;
			array_push($data,$new);
		}
		$this->set("Listnews",$data);
	}
	public function getTkbieu($idgv){
		$date = date('Y/m/d', time());
		$hocky=$this->Hocki->find("first",array('conditions'=>array('Hocki.batdau <='=>$date,'Hocki.kethuc >='=>$date)));
		$ky=$hocky['Hocki']['id'];
		$tkbieus=$this->Lichgiangday->find("all",array('conditions'=>array('Lichgiangday.mahocky'=>$ky,'Lichgiangday.magiangvien'=>$idgv)));
		$data =array();
		foreach ($tkbieus as $item){
			$tkb=array();
			$tkb['lophp']=$item['Lophocphan']['tenLopHocPhan'];
			$tkb['malophp']=$item['Lophocphan']['maLopHocPhan'];
			$tkb['maphong']=$item['Phong']['tenPhong'];
			$tkb['thu']=$item['Lichgiangday']['thu'];
			$tkb['tutiet']=$item['Lichgiangday']['tutiet'];
			$tkb['dentiet']=$item['Lichgiangday']['dentiet'];
			$tkb['idlichday']=$item['Lichgiangday']['id'];
			$tkb['ngaybatdau']=$item['Tuanhoc']['ngaybatdau'];
			$tkb['ngayketthuc']=$item['Tuanhoc1']['ngaykethuc'];
			$tkb['baongi']=count($item['Lichnghi']);
			array_push($data,$tkb);
		}
		$this->set("tkbieu",$data);
	}
	//
	public function baonghi($magv){
		if($this->request->is("post")){
			$date = date('Y-m-d');
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			$lydo=html_entity_decode($obj[0]->{'lydo'});
			foreach ($obj as $item){
				$lichngi=array();
				$thongbao=array();
				$idtkb=$item->{'idlichday'};
				$lhp=$item->{'lophp'};
				$malhp=$item->{'malophp'};
				$ngayngi=html_entity_decode($item->{'ngaynghi'},ENT_QUOTES);
				$sotiet=$item->{'sotietnghi'};
				array_push($lichngi,array("maThoiKhoabieu"=>$idtkb,"ngaynghi"=>$ngayngi,"soTiet"=>$sotiet,"lydo"=>$lydo,"ngaybaongi"=>$date));
				$this->Lichnghi->saveAll($lichngi);
				array_push($thongbao,array("loaithongbao"=>2,"tieude"=>"Thông báo đến lớp [".$malhp."]".$lhp,"noidung"=>"Lớp nghỉ học ngày ".$ngayngi." vì lý do:".$lydo,"nguoidang"=>$magv));
				$this->Thongbao->saveAll($thongbao);
			}
			$this->set("data",$obj);
		}
	}
	public function getLichnghi($magv){
		$date = date('Y/m/d', time());
		$hocky=$this->Hocki->find("first",array('conditions'=>array('Hocki.batdau <='=>$date,'Hocki.kethuc >='=>$date)));
		$ky=$hocky['Hocki']['id'];
		$lichngi=$this->Lichnghi->query("select lichnghis.maThoiKhoabieu,lophocphans.tenLopHocPhan,lophocphans.maLopHocPhan from lichnghis,lichgiangdays,lophocphans
				where lichnghis.maThoiKhoabieu=lichgiangdays.id and lichgiangdays.malophocphan=lophocphans.id and lichgiangdays.magiangvien=".$magv." and lichgiangdays.mahocky=".$ky." group by lichnghis.maThoiKhoabieu");
		$TkbBaonghiJsons=array();
		foreach ($lichngi as $itemss){
			$sotietnghi=0;
			$sotietdabu=0;
			$TkbBaonghiJson=array();
			$TkbBaonghiJson['maLophp']=$itemss['lophocphans']['maLopHocPhan'];
			$TkbBaonghiJson['lophp']=$itemss['lophocphans']['tenLopHocPhan'];
			$TkbBaonghiJson['id']=$itemss['lichnghis']['maThoiKhoabieu'];
			$lichbaonghi=$this->Lichnghi->find("all",array('conditions'=>array('Lichnghi.maThoiKhoabieu'=>$itemss['lichnghis']['maThoiKhoabieu'])));
			$lichnghiJsons=array();
			foreach ($lichbaonghi as $items){
				$lichnghiJson=array();
				$daybus=$items['Lichdaybu'];
				$lichdaybuJsons=array();
				$sotietnghi+=$items['Lichnghi']['soTiet'];
				//print_r($items);
				$sotietbu=0;
				foreach ($daybus as $item){
					$lichdaybuJson=array();
					$lichdaybuJson['id']=$item['id'];
					$lichdaybuJson['lichnghi']=$items['Lichnghi']['id'];
					$sotietbu+=$item['dentiet']-$item['tutiet']+1;
					$lichdaybuJson['sotietbu']=$item['dentiet']-$item['tutiet']+1;
					$lichdaybuJson['maphong']=$item['maphong'];
					$lichdaybuJson['ngaybao']=$item['ngaybao'];
					$lichdaybuJson['ngayday']=$item['ngaydaybu'];
					array_push($lichdaybuJsons,$lichdaybuJson);
				}
				$lichnghiJson['jsondaybu']=json_encode( $lichdaybuJsons,JSON_UNESCAPED_UNICODE);
				$lichnghiJson['id']=$items['Lichnghi']['id'];
				$lichnghiJson['ngayngi']=$items['Lichnghi']['ngaynghi'];
				$lichnghiJson['ngaybao']=$items['Lichnghi']['ngaybaongi'];
				$lichnghiJson['sotiet']=$items['Lichnghi']['soTiet'];
				$lichnghiJson['sotietbu']=$sotietbu;
				array_push($lichnghiJsons,$lichnghiJson);
				$sotietdabu+=$sotietbu;
			}
			$jslichnghi=json_encode( $lichnghiJsons,JSON_UNESCAPED_UNICODE);
			$TkbBaonghiJson['soTietBaoNghi']=$sotietnghi;
			$TkbBaonghiJson['soTietBaoBu']=$sotietdabu;
			$TkbBaonghiJson['lichnghi']=json_encode( $lichnghiJsons,JSON_UNESCAPED_UNICODE);
			array_push($TkbBaonghiJsons,$TkbBaonghiJson);
			//print_r($lichbaonghi);
		}
		$this->set("TKBnghi",$TkbBaonghiJsons);
	}
	//
	public function getPhong($mgv){
		$date = date('Y/m/d', time());
		$hocky=$this->Hocki->find("first",array('conditions'=>array('Hocki.batdau <='=>$date,'Hocki.kethuc >='=>$date)));
		$ky=$hocky['Hocki']['id'];
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$idlichnghi=$obj->{'lichnghi'};
		$lhp=$this->Lophocphan->query("SELECT lophocphans.soLuong FROM lophocphans,lichgiangdays,lichnghis where lophocphans.id=lichgiangdays.malophocphan and lichgiangdays.id=lichnghis.maThoiKhoabieu and lichnghis.id=".$idlichnghi);
		$soghe=$lhp[0]['lophocphans']['soLuong'];
		$ngadaybu=$obj->{'ngayday'};
		$tutiet=$obj->{'tietdau'};
		$dentiet=$obj->{'tietcuoi'};
		$date_stamp = strtotime(date('Y-m-d', strtotime($ngadaybu)));
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
		$phongjson=array();
		if(count($lichday)<1){
			$ngadaybu="'".$ngadaybu."'";
			$phongs=$this->Phong->query('CALL timphong('.$thu.','.$tutiet.','.$dentiet.','.$ky.','.$ngadaybu.','.$soghe.')');
			$i=0;
			foreach ($phongs as $item){
				$phong=array();
				$phong['id']=$item['phongs']['id'];
				$phong['maphong']=$item['phongs']['maPhong'];;
				$phong['soluong']=$item['phongs']['soLuongGhe'];
				array_push($phongjson,$phong);
				if($i>20){
					break;
				}
				$i++;
			}
		}
		$this->set("phongs",$phongjson);
	}
	public function baobu($magv){
		if($this->request->is("post")){
			$date = date('Y-m-d');
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			foreach ($obj as $item){
				$lichbu=array();
				$thongbao=array();
				$idtkb=$item->{'lichnghi'};
				$ngaybu=html_entity_decode($item->{'ngayday'},ENT_QUOTES);
				$tutiet=$item->{'tietdau'};
				$dentiet=$item->{'tietcuoi'};
				$maphong=$item->{'idphong'};
				$lichnghi=$this->Lichnghi->find("first",array("conditions"=>array("Lichnghi.id"=>$idtkb),'recursive'=>-1));
				$lichgiangday=$this->Lichgiangday->find("first",array("conditions"=>array("Lichgiangday.id"=>$lichnghi['Lichnghi']['maThoiKhoabieu'])));
				array_push($lichbu,array("malichnghi"=>$idtkb,"ngaydaybu"=>$ngaybu,"tutiet"=>$tutiet,"dentiet"=>$dentiet,"maphong"=>$maphong,"ngaybao"=>$date));
				$this->Lichdaybu->saveAll($lichbu);
				array_push($thongbao,array("loaithongbao"=>2,"tieude"=>"Thông báo đến lớp [".$lichgiangday['Lophocphan']['maLopHocPhan']."]".$lichgiangday['Lophocphan']['tenLopHocPhan'],"noidung"=>"Lớp học bù ngày ".$ngaybu." tại phòng ".$lichgiangday['Phong']['tenPhong']." từ tiết ".$tutiet." đến tiết ".$dentiet,"nguoidang"=>$magv));
				$this->Thongbao->saveAll($thongbao);
			}
			$this->set("data",$obj);
		}
	}
	public function sendsms($mgv){
		if($this->request->is("post")){
			$date = date('Y-m-d');
			$json = file_get_contents('php://input');
			//$obj = json_decode($json);

			list($cp, $malhp, $ngayngi,$sotiet,$lydo)=split(" ",$json);
			$lhp=$this->Lophocphan->find("first",array("conditions"=>array("Lophocphan.maLopHocPhan"=>$malhp)));
			$lichgiangday=$this->Lichgiangday->find("first",array("conditions"=>array('Lichgiangday.magiangvien'=>$mgv,'Lichgiangday.malophocphan'=>$lhp['Lophocphan']['Id'])));
			$idlichgiangday=$lichgiangday['Lichgiangday']['id'];
			$lichnghi=array();
			$lichnghi['maThoiKhoabieu']=$idlichgiangday;
			$lichnghi['ngaynghi']=$ngayngi;
			$lichnghi['soTiet']=$sotiet;
			$lichnghi['ngaybaongi']=$date;
			$lichnghi['lydo']=$lydo;
			$this->Lichnghi->saveAll($lichnghi);
			$lichnghiresult=$this->Lichnghi->find("first",array('conditions'=>array('Lichnghi.maThoiKhoabieu'=>$idlichgiangday,'Lichnghi.ngaynghi'=>$ngayngi)));
			$lichnghijson=array();
			array_push($lichnghijson,array("id"=>$lichnghiresult['Lichnghi']['id'],"ngayngi"=>$lichnghiresult['Lichnghi']['ngaynghi'],"sotiet"=>$lichnghiresult['Lichnghi']['soTiet']));
			$this->set("data",$lichnghijson);
		}
	}
	public function sms($phonenumber){
		if($this->request->is("post")){
			$smsJson=array();
			$date = date('Y-m-d');
			$json = file_get_contents('php://input');
			$content="";
			
			$cp=split(" ",$json)[0];
			if(strcasecmp ($cp,"HD")==0 ){
				$content.="Soan tin theo cu phap:HD goi den tong dai de xem huong dan";
// 				$content.="Soan tin theo cu phap:HD";
				$content.="Soan tin theo cu phap:BN Malhp ngaynghi sotiet lydo goi den tong dai de dang ky bao nghi.";
				array_push($smsJson,array("phonenumber"=>$phonenumber,"content"=>$content));
			}
			else{
				if(strcasecmp ($cp,"BN")==0){
					list($cp, $malhp, $ngayngi,$sotiet,$lydo)=split(" ",$json);
					$giangvien=$this->Giangvien->find("first",array("conditions"=>array("Giangvien.sodienthoai"=>$phonenumber),'recursive'=>-1));
					$lhp=$this->Lophocphan->find("first",array("conditions"=>array("Lophocphan.maLopHocPhan"=>$malhp),'recursive'=>-1));
					$lichgianday=$this->Lichgiangday->find("first",array('conditions'=>array("Lichgiangday.magiangvien"=>$giangvien['Giangvien']['id'],'Lichgiangday.malophocphan'=>$lhp['Lophocphan']['Id']),'recursive'=>-1));
					$idlichgiangday=$lichgianday['Lichgiangday']['id'];
					$lichnghi=array();
					$thongbao=array();
					$lichnghi['maThoiKhoabieu']=$idlichgiangday;
					$lichnghi['ngaynghi']=$ngayngi;
					$lichnghi['soTiet']=$sotiet;
					$lichnghi['ngaybaongi']=$date;
					$lichnghi['lydo']=$lydo;
					$this->Lichnghi->saveAll($lichnghi);
					$lichnghiresult=$this->Lichnghi->find("first",array('conditions'=>array('Lichnghi.maThoiKhoabieu'=>$idlichgiangday,'Lichnghi.ngaynghi'=>$ngayngi)));
					if(isset($lichnghiresult)&& $lichnghiresult!=null){
// 						$content.="Đăng ký nghỉ thành công.Vui lòng đăng nhập website để kiểm tra thông tin.";
						$content="Dang ky nghi thanh cong.Vui long dang nhap website de kiem tra thong tin";
						array_push($smsJson,array("phonenumber"=>$phonenumber,"content"=>$content));
						array_push($thongbao,array("loaithongbao"=>2,"tieude"=>"Thông báo đến lớp [".$lhp['Lophocphan']['maLopHocPhan']."]".$lhp['Lophocphan']['tenLopHocPhan'],"noidung"=>"Lớp nghỉ học ngày ".$ngayngi,"nguoidang"=>$giangvien['Giangvien']['id']));
						$this->Thongbao->saveAll($thongbao);
					}
				}
				else{
					$content.="Tin nhan sai cu phap vui long soan tin nhan:HD goi den tong dai de xem huong dan.";
					array_push($smsJson,array("phonenumber"=>$phonenumber,"content"=>$content));
				}
			}
			$this->set("data",$smsJson);
		}
	}
}
?>