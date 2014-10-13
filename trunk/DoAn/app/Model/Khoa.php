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
			));
}
?>