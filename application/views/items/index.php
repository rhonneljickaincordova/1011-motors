<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-tags"></i> 
		Items
	</h3>
	<br>
	<a class="btn btn-primary" href="<?php echo base_url('items/create'); ?>">
		Create A New Item
	</a>
	<br>
	<br>
	<?php if ($items): ?>
		<table class="table table table-striped table-hover">
			<thead>
				<tr>
					<th>Employee</th>
					<th>Description</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($items as $item): ?>
					<tr>
						<td><?php echo $item->get_employee_id()->get_name(); ?></td>
						<td><?php echo $item->get_description(); ?></td>
						<td>
							<a class="fa fa-edit fa-2x" href="<?php echo base_url('items/edit/' . $item->get_id()); ?>"></a>
							<?php if ($this->session->userdata('position') == 'administrator'): ?>
								<a class="fa fa-trash fa-2x" href="<?php echo base_url('items/delete/' . $item->get_id()); ?>"></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $links; ?>
	<?php elseif ($this->input->get('keyword')): ?>
		Your search - <b><?php echo $this->input->get('keyword') ?></b> - did not match any items.
	<?php else: ?>
		There are no items that are currently available.
	<?php endif; ?>
<?php $this->load->view('layout/footer'); ?>