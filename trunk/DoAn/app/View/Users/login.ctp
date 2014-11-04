<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<!--<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('maGiangvien');
        echo $this->Form->input('matKhau',array('label' => 'Mật khẩu','type'=>'password'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>-->
<?php 
		echo $this->Form->create("User");
		echo "<fieldset>".$this->Form->input('maGiangvien', array('label' => 'Mã giảng viên'));
    	echo $this->Form->input('matKhau',array('label' => 'Mật khẩu','type'=>'password'));
    	echo "</fieldset>".$this->Form->end(__("Login"));
   ?>
</div>