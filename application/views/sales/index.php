<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-dollar"></i> 
		Sales
	</h3>
	<br>
	<a class="btn btn-primary" href="<?php echo base_url('sales/create'); ?>">
		Create A New Sale
	</a>
	<br>
	<br>
	<?php if ($sales): ?>
		<table class="table table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Customer</th>
					<th>Quantity</th>
					<th>Item</th>
					<th>Price</th>
					<th>Remarks</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($sales as $sale): ?>
					<tr>
						<td><?php echo $sale->get_employee_id()->get_name(); ?></td>
						<td><?php echo $sale->get_customer(); ?></td>
						<td><?php echo $sale->get_quantity(); ?></td>
						<td><?php echo $sale->get_item_id()->get_description(); ?></td>
						<td><?php echo $sale->get_price(); ?></td>
						<td><?php echo $sale->get_remarks(); ?></td>
						<td>
							<a class="fa fa-edit fa-2x" href="<?php echo base_url('sales/edit/' . $sale->get_id()); ?>"></a>
							<?php if ($this->session->userdata('position') == 'administrator'): ?>
								<a class="fa fa-trash fa-2x" href="<?php echo base_url('sales/delete/' . $sale->get_id()); ?>"></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $links; ?>
	<?php elseif ($this->input->get('keyword')): ?>
		Your search - <b><?php echo $this->input->get('keyword') ?></b> - did not match any sales.
	<?php else: ?>
		There are no sales that are currently available.
	<?php endif; ?>
<?php $this->load->view('layout/footer'); ?>