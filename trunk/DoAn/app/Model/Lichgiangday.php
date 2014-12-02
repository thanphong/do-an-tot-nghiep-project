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
	var $belongsTo = array(
			'Lophocphan'=> array(
					'className' => 'Lophocphan',
					'foreignKey' => 'malophocphan',
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
			),
			'Tuanhoc'=> array(
					'className' => 'Tuanhoc',
					'foreignKey' => 'tuanbatdau',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			),
			'Tuanhoc1'=> array(
					'className' => 'Tuanhoc',
					'foreignKey' => 'tuanketthuc',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>