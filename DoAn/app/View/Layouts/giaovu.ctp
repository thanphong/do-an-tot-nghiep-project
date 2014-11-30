<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			<?php 
 				echo "Đại học Bách Khoa";
			 ?>
			</title>
			<link rel="shortcut icon" href="icon.png" type="image/x-icon">
			<!-- Include external files and scripts here (See HTML helper for more info.) -->
		<?php
			echo $this->Html->css(array("styles.css","BeatPicker.min.css","giaovu.css"));
			echo $this->Html->script(array("datetimepicket/jquery-1.11.0.min.js","datetimepicket/BeatPicker.min.js","giaovu.js","general.js"));
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
			$data=$this->Common->general();
		?>
	</head>
	<body>
	<div id='wrapper'>
		<div id="header">
			<?php
				echo $data['header'];
			?>
    		<div id="menu">
    			<div id='menu-nav'> <?php echo $this->Giaovu->create_menu($this->Session->read('Auth.User.Giangvien.ten')); ?> </div>
    		</div>
		</div>
		<div class="cach"></div>
			<!-- Here's where I want my views to be displayed -->
			<!--hiển thị nội dung ở đây-->
		<?php echo $this->fetch('content'); ?>
		
		<!-- Add a footer to each displayed page -->
		<div id="footer">
			<?php
				echo $data['footer'];
			?>
		</div>
	</div>
	</body>
</html>