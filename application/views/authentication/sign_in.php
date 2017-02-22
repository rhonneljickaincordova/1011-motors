<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>1011 Motors</title>
	<link rel="stylesheet" type="text/css" href="bower_components/components-font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="bower_components/bootswatch/paper/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/sign_in.css">
</head>
<body>
	<?php echo form_open('sign_in/verify?current_url=' . $this->input->get('current_url'), 'class="form-signin"'); ?>
		<h2 class="form-signin-heading">
			<center>1011 Motors</center>
		</h2>
		<?php echo form_input('username', NULL, 'id="username" class="form-control" placeholder="Username" required autofocus'); ?>
		<?php echo form_password('password', NULL, 'id="password" class="form-control" placeholder="Password" required'); ?>
		<button class="btn btn-lg btn-primary btn-block" type="submit">
			Sign in
		</button>
		<?php if ($this->session->flashdata('notification')): ?>
			<br>
			<div class="form-signin alert alert-<?php echo $this->session->flashdata("alert"); ?>" role="alert">
				<center><?php echo $this->session->flashdata('notification'); ?></center>
			</div>
		<?php endif; ?>
	<?php echo form_close(); ?>
</body>
</html>