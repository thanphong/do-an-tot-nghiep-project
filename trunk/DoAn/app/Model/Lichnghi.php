<?php
class Lichnghi extends AppModel{
	var $name="Lichnghi";
	var $hasMany = array(
			'Lichdaybu' => array(
					'className' => 'Lichdaybu',
					'foreignKey' => 'malichnghi',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
	var $belongsTo = array(
			'Lichgiangday'=> array(
					'className' => 'Lichgiangday',
					'foreignKey' => 'maThoiKhoabieu',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>