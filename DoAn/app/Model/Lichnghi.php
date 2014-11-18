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
}
?>