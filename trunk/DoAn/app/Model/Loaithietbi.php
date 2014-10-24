<?php
class Loaithietbi extends AppModel{
	var $name="Loaithietbi";
	var $hasMany = array(
			'Thietbi' => array(
					'className' => 'Thietbi',
					'foreignKey' => 'loaiThietbi',
					'conditions' => '',
					'order' => '',
					'limit' => '',
					'dependent'=> true
			)
	);
}
?>