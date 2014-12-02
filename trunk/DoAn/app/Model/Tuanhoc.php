<?php
	class Tuanhoc extends AppModel{
		var $name="Tuanhoc";
		var $hasMany = array(
				'Lichgiangday' => array(
						'className' => 'Lichgiangday',
						'foreignKey' => 'tuanbatdau',
						'conditions' => '',
						'order' => '',
						'limit' => '',
						'dependent'=> true
				),
				'Lichgiangday1' => array(
						'className' => 'Lichgiangday',
						'foreignKey' => 'tuanketthuc',
						'conditions' => '',
						'order' => '',
						'limit' => '',
						'dependent'=> true
				)
		);
	}
?>
