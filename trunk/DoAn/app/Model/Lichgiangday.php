<?php
class Lichgiangday extends AppModel{
	var $name="Lichgiangday";
	var $hasMany = array(
			'Lichnghi' => array(
					'className' => 'Lichnghi',
					'foreignKey' => 'maThoiKhoabieu',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Lichthi' => array(
					'className' => 'Lichthi',
					'foreignKey' => 'malichgiangday',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>