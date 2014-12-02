<?php
class Lichdaybu extends AppModel{
	var $name="Lichdaybu";
	var $belongsTo = array(
			'Lichnghi'=> array(
					'className' => 'Lichnghi',
					'foreignKey' => 'malichnghi',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Phong'=> array(
					'className' => 'Phong',
					'foreignKey' => 'maphong',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>