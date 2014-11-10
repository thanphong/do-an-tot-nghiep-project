<?php
class Khoa extends AppModel{
	var $name="Khoa";
	var $hasMany = array(
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
			),
			'Nganh' => array(
					'className' => 'Nganh',
					'foreignKey' => 'Makhoa',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>