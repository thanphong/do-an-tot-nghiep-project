<?php
class Khoa extends AppModel{
	var $name="Khoa";
	var $hasMany = array(
			'Giangvien' => array(
					'className' => 'Giangvien',
					'foreignKey' => 'Khoa',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Hocphan' => array(
					'className' => 'Hocphan',
					'foreignKey' => 'Khoa',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Giangvienkhoa' => array(
					'className' => 'Giangvienkhoa',
					'foreignKey' => 'makhoa',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>