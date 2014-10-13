<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
</head>
<body>
<?php
echo "aaaa";
?>
<?php echo $this->Html->link('Thêm mới',array('controller' => 'khoas','action' => 'persit','full_base' => true),array('class'=>'title'));
echo $this->Html->link('Cập nhập',array('controller' => 'khoas','action' => 'index','full_base' => true),array('class'=>'title'));
echo $this->Html->link('Xóa',array('controller' => 'khoas','action' => 'index','full_base' => true),array('class'=>'title'));
?>

</body></html>
        