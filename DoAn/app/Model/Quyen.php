<?php
class Quyen extends AppModel{
	var $name="Quyen";
	var $hasMany = array(
			'Quyengiangvien' => array(
					'className' => 'Quyengiangvien',
					'foreignKey' => 'maquyen',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			));
}
?>