<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-eye"></i> 
		Sale Information
	</h3>
	<br>
	Employee: <?php echo $sale->get_employee_id()->get_id(); ?><br>
	Customer: <?php echo $sale->get_customer(); ?><br>
	Quantity: <?php echo $sale->get_quantity(); ?><br>
	Item: <?php echo $sale->get_item_id()->get_id(); ?><br>
	Price: <?php echo $sale->get_price(); ?><br>
	Remarks: <?php echo $sale->get_remarks(); ?><br>
	<a class="btn btn-primary" href="<?php echo base_url('sales'); ?>">Back</a>
<?php $this->load->view('layout/footer'); ?>