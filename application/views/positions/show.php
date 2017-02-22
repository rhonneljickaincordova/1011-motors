<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-eye"></i> 
		Position Information
	</h3>
	<br>
	Description: <?php echo $position->get_description(); ?><br>
	<a class="btn btn-primary" href="<?php echo base_url('positions'); ?>">Back</a>
<?php $this->load->view('layout/footer'); ?>