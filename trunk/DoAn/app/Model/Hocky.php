<?php
class Hocky extends AppModel{
	var $name="Hocky";
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