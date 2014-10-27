<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
</head>
<body>
<?php
echo $this->Session->flash('auth');
?>
<?php echo $this->Html->link('Khoa',array('controller' => 'GiaoVus','action' => 'quanlyKhoa','full_base' => true),array('class'=>'title'));
echo $this->Html->link('Giảng Viên',array('controller' => 'GiaoVus','action' => 'quanlyGiangVien','full_base' => true),array('class'=>'title'));
echo $this->Html->link('Học phần',array('controller' => 'GiaoVus','action' => 'quanlyHocphan','full_base' => true),array('class'=>'title'));
echo $this->Html->link('phong',array('controller' => 'GiaoVus','action' => 'quanlyphong','full_base' => true),array('class'=>'title'));
echo $this->Html->link('Thiết bị',array('controller' => 'GiaoVus','action' => 'quanlyThietbi','full_base' => true),array('class'=>'title'));
echo $this->Html->link('Lớp học phần',array('controller' => 'GiaoVus','action' => 'quanlyLophocphans','full_base' => true),array('class'=>'title'));
echo $this->Html->link('Thông báo',array('controller' => 'GiaoVus','action' => 'quanlyThongbao','full_base' => true),array('class'=>'title'));

?>
</body></html>
        