<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-eye"></i> 
		Employee Information
	</h3>
	<br>
	Name: <?php echo $employee->get_name(); ?><br>
	Username: <?php echo $employee->get_username(); ?><br>
	Position: <?php echo $employee->get_position_id()->get_id(); ?><br>
	<a class="btn btn-primary" href="<?php echo base_url('employees'); ?>">Back</a>
<?php $this->load->view('layout/footer'); ?>