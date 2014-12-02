<div>
<?php echo	$this->Giangvien->formCanhan($user,$Khoa);
?>
<hr>

<?php 
	echo	$this->Giangvien->formThaydoiMatkhau((isset($success)?$success:null));
?>
</div>