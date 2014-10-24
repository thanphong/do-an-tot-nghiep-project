<?php
class Thietbi extends AppModel{
	var $name="Thietbi";
	var $hasMany = array(
			'Phongthietbi' => array(
					'className' => 'Phongthietbi',
					'foreignKey' => 'mathietbi',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>