<?php
class Khuvuc extends AppModel{
	var $name="Khuvuc";
	var $hasMany = array(
			'Phong' => array(
					'className' => 'Phong',
					'foreignKey' => 'khuVuc',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			));
}
?>