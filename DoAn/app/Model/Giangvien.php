<?php
class Giangvien extends AppModel{
	var $name="Giangvien";
	var $hasMany = array(
			'Thongbao' => array(
					'className' => 'Thongbao',
					'foreignKey' => 'nguoidang',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Giangvienhocphan' => array(
					'className' => 'Giangvienhocphan',
					'foreignKey' => 'maGiangvien',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Giangvienkhoa' => array(
					'className' => 'Giangvienkhoa',
					'foreignKey' => 'magiangvien',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Quyengiangvien' => array(
					'className' => 'Quyengiangvien',
					'foreignKey' => 'magiangvien',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Lichgiangday' => array(
					'className' => 'Lichgiangday',
					'foreignKey' => 'magiangvien',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
			
	);
	function index(){

	}
}
?>