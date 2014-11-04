<?php
class Hocki extends AppModel{
	var $name="Hocki";
	var $hasMany = array(
			'Lichgiangday' => array(
					'className' => 'Lichgiangday',
					'foreignKey' => 'mahocky',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>