<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-eye"></i> 
		Item Information
	</h3>
	<br>
	Employee: <?php echo $item->get_employee_id()->get_id(); ?><br>
	Description: <?php echo $item->get_description(); ?><br>
	<a class="btn btn-primary" href="<?php echo base_url('items'); ?>">Back</a>
<?php $this->load->view('layout/footer'); ?>