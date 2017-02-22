<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-download"></i> 
		Stock Ins
	</h3>
	<br>
	<a class="btn btn-primary" href="<?php echo base_url('stock_ins/create'); ?>">
		Create A New Stock In
	</a>
	<br>
	<br>
	<?php if ($stock_ins): ?>
		<table class="table table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($stock_ins as $stock_in): ?>
					<tr>
						<td><?php echo $stock_in->get_employee_id()->get_name(); ?></td>
						<td><?php echo $stock_in->get_item_id()->get_description(); ?></td>
						<td><?php echo $stock_in->get_quantity(); ?></td>
						<td><?php echo $stock_in->get_price(); ?></td>
						<td>
							<a class="fa fa-edit fa-2x" href="<?php echo base_url('stock_ins/edit/' . $stock_in->get_id()); ?>"></a>
							<?php if ($this->session->userdata('position') == 'administrator'): ?>
								<a class="fa fa-trash fa-2x" href="<?php echo base_url('stock_ins/delete/' . $stock_in->get_id()); ?>"></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $links; ?>
	<?php elseif ($this->input->get('keyword')): ?>
		Your search - <b><?php echo $this->input->get('keyword') ?></b> - did not match any stock ins.
	<?php else: ?>
		There are no stock ins that are currently available.
	<?php endif; ?>
<?php $this->load->view('layout/footer'); ?>