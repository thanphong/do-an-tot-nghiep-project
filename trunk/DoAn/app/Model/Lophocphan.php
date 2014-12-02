<?php
class Lophocphan extends AppModel{
	var $name="Lophocphan";
	var $hasMany = array(
			'Lichgiangday' => array(
					'className' => 'Lichgiangday',
					'foreignKey' => 'malophocphan',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>