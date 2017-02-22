<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-upload"></i> 
		Stock Outs
	</h3>
	<br>
	<a class="btn btn-primary" href="<?php echo base_url('stock_outs/create'); ?>">
		Create A New Stock Out
	</a>
	<br>
	<br>
	<?php if ($stock_outs): ?>
		<table class="table table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Item</th>
					<th>Quantity</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($stock_outs as $stock_out): ?>
					<tr>
						<td><?php echo $stock_out->get_employee_id()->get_name(); ?></td>
						<td><?php echo $stock_out->get_item_id()->get_description(); ?></td>
						<td><?php echo $stock_out->get_quantity(); ?></td>
						<td>
							<a class="fa fa-edit fa-2x" href="<?php echo base_url('stock_outs/edit/' . $stock_out->get_id()); ?>"></a>
							<?php if ($this->session->userdata('position') == 'administrator'): ?>
								<a class="fa fa-trash fa-2x" href="<?php echo base_url('stock_outs/delete/' . $stock_out->get_id()); ?>"></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $links; ?>
	<?php elseif ($this->input->get('keyword')): ?>
		Your search - <b><?php echo $this->input->get('keyword') ?></b> - did not match any stock outs.
	<?php else: ?>
		There are no stock outs that are currently available.
	<?php endif; ?>
<?php $this->load->view('layout/footer'); ?>