<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
</head>
<body>
	<?php echo $this->GiaoVu->form_Hocphan((isset($hocphan)?$hocphan:null)); 
		echo $this->GiaoVu->danhsachHocPhan($data);
	?>
	
</body></html>