<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-comments"></i> 
		Positions
	</h3>
	<br>
	<a class="btn btn-primary" href="<?php echo base_url('positions/create'); ?>">
		Create A New Position
	</a>
	<br>
	<br>
	<?php if ($positions): ?>
		<table class="table table table-striped table-hover">
			<thead>
				<tr>
					<th>Description</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($positions as $position): ?>
					<tr>
						<td><?php echo ucfirst($position->get_description()); ?></td>
						<td>
							<a class="fa fa-edit fa-2x" href="<?php echo base_url('positions/edit/' . $position->get_id()); ?>"></a>
							<a class="fa fa-trash fa-2x" href="<?php echo base_url('positions/delete/' . $position->get_id()); ?>"></a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $links; ?>
	<?php elseif ($this->input->get('keyword')): ?>
		Your search - <b><?php echo $this->input->get('keyword') ?></b> - did not match any positions.
	<?php else: ?>
		There are no positions that are currently available.
	<?php endif; ?>
<?php $this->load->view('layout/footer'); ?>