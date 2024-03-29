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
			echo $this->Html->css(array("styles.css"));
			echo $this->Html->script(array("jquery-1.9.1.min.js","general.js"));
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
    			<div id='menu-nav'> <?php echo $this->Common->create_menu(); ?> </div>
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