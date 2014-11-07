<?php
class Thietbi extends AppModel{
	var $name="Thietbi";
	var $hasMany = array(
			'Phongthietbi' => array(
					'className' => 'Phongthietbi',
					'foreignKey' => 'mathietbi',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
	var $belongsTo = array(
			'Loaithietbi'=> array(
					'className' => 'Loaithietbi',
					'foreignKey' => 'loaiThietbi',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>