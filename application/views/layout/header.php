<?php date_default_timezone_set('Asia/Manila');

if ( ! $this->session->userdata('employee_id'))
{
	redirect('sign_in?current_url=' . current_url());
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>1011 Motors <?php echo ($this->uri->segment(1)) ? ' - ' . ucwords(str_replace('_', ' ', $this->uri->segment(1))) : NULL ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/components-font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/bootswatch/paper/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/bootstrap-notify/css/bootstrap-notify.css'); ?>">
	<style type="text/css">
		body {
			margin-top: 70px;
		}
	</style>
</head>
<body>
	<?php $this->load->view('layout/navbar'); ?>
	<div class='notifications top-right'></div>
	<div class="container">
