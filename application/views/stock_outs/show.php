<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-eye"></i> 
		Stock Out Information
	</h3>
	<br>
	Employee: <?php echo $stock_out->get_employee_id()->get_id(); ?><br>
	Item: <?php echo $stock_out->get_item_id()->get_id(); ?><br>
	Quantity: <?php echo $stock_out->get_quantity(); ?><br>
	<a class="btn btn-primary" href="<?php echo base_url('stock_outs'); ?>">Back</a>
<?php $this->load->view('layout/footer'); ?>