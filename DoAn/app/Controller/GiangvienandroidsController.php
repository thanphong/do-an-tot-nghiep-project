<?php
class GiangvienandroidsController extends AppController{
	var $layout = null;
	var $name="Gianvienadroids";
	public $uses = array("Thongbao","Lichgiangday",'Hocki','Lophocphan','Phong','Lichnghi','Lichdaybu','Lichthi');
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
		$listnews=$this->Thongbao->find("all",array( 'order' => array('Thongbao.ngaydang DESC'),'limit' => 3));
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
			$lhp=$this->Lophocphan->find("first",array('conditions'=>array('Lophocphan.id'=>$item['Lichgiangday']['malophocphan']),'recursive'=>-1));
			$phong=$this->Phong->find("first",array('conditions'=>array('Phong.id'=>$item['Lichgiangday']['maphong']),'recursive'=>-1));
			$tkb['lophp']=$lhp['Lophocphan']['tenLopHocPhan'];
			$tkb['maphong']=$phong['Phong']['tenPhong'];
			$tkb['thu']=$item['Lichgiangday']['thu'];
			$tkb['tutiet']=$item['Lichgiangday']['tutiet'];
			$tkb['dentiet']=$item['Lichgiangday']['dentiet'];
			$tkb['idlichday']=$item['Lichgiangday']['id'];
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
				$idtkb=$item->{'idlichday'};
				$ngayngi=html_entity_decode($item->{'ngaynghi'},ENT_QUOTES);
				$sotiet=$item->{'sotietnghi'};
				array_push($lichngi,array("maThoiKhoabieu"=>$idtkb,"ngaynghi"=>$ngayngi,"soTiet"=>$sotiet,"lydo"=>$lydo,"ngaybaongi"=>$date));
				$this->Lichnghi->saveAll($lichngi);
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
}
?>