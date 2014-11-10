<?php
class Hocphan extends AppModel{
	var $name="Hocphan";
	var $hasMany = array(
			'Lophocphan' => array(
					'className' => 'Lophocphan',
					'foreignKey' => 'maHocPhan',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
			,
			'Giangvienhocphan' => array(
					'className' => 'Giangvienhocphan',
					'foreignKey' => 'maHocphan',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
	var $belongsTo = array(
			'Nganh'=> array(
					'className' => 'Nganh',
					'foreignKey' => 'nganh',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>