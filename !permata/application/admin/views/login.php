<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator Control Panel</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="noindex, nofollow">

	<link rel="shortcut icon" type="image/x-icon" href="" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/my.login.css" />

	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/library.js"></script>
</head>
<body>

<div id="logo">
	<a href="<?php echo site_url(); ?>"><img src="<?php echo site_url(); ?>assets/images/logo.png" alt="" title="" /></a>
</div>

<div id="form-login">

	<?php echo form_open('login/validate', array('id' => 'fLogin', 'autocomplete' => 'off')); ?>

		<div><?php echo form_input(array('name' => 'username', 'placeholder' => 'Username')); ?></div>
		<div>
			<?php echo form_password(array('name' => 'password', 'placeholder' => 'Password', 'style' => 'margin-right:5px')); ?>
			<?php echo form_submit(array('value' => 'Log In')); ?>
			<div class="bar"></div>
		</div>
		<div class="msg"></div>

	<?php echo form_close(); ?>

</div>

<div id="footer">
	&copy; <?php echo site_name(); ?> <?php echo site_year(); ?> | By <?php echo anchor($developer_url,$developer, array('target' => '_blank')); ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#fLogin').submit(function(){
		$.post('<?php echo site_url(); ?>login/validate', $(this).serialize(), function(){}, 'script');
		return false;
	});
});
</script>

</body>
</html>