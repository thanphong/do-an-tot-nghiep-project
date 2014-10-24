<?php
class Phong extends AppModel{
	var $name="Phong";
	var $hasMany = array(
			'Phongthietbi' => array(
					'className' => 'Phongthietbi',
					'foreignKey' => 'maphong',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Lichgiangday' => array(
					'className' => 'Lichgiangday',
					'foreignKey' => 'maphong',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}