<?php
class Nganh extends AppModel{
	var $name="Nganh";
	var $hasMany = array(
			'Hocphan' => array(
					'className' => 'Hocphan',
					'foreignKey' => 'nganh',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)			
	);
	var $belongsTo = array(
			'Khoa'=> array(
					'className' => 'Khoa',
					'foreignKey' => 'Makhoa',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>