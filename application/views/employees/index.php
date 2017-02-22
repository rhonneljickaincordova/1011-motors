<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-users"></i> 
		Employees
	</h3>
	<br>
	<a class="btn btn-primary" href="<?php echo base_url('employees/create'); ?>">
		Create A New Employee
	</a>
	<br>
	<br>
	<?php if ($employees): ?>
		<table class="table table table-striped table-hover">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Position</th>
					<?php if ($this->session->userdata('position') == 'administrator'): ?>
						<th></th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($employees as $employee): ?>
					<tr>
						<td><?php echo $employee->get_first_name(); ?></td>
						<td><?php echo $employee->get_last_name(); ?></td>
						<td><?php echo ucfirst($employee->get_position_id()->get_description()); ?></td>
						<?php if ($this->session->userdata('position') == 'administrator'): ?>
							<td>
								<a class="fa fa-edit fa-2x" href="<?php echo base_url('employees/edit/' . $employee->get_id()); ?>"></a>
								<a class="fa fa-trash fa-2x" href="<?php echo base_url('employees/delete/' . $employee->get_id()); ?>"></a>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $links; ?>
	<?php elseif ($this->input->get('keyword')): ?>
		Your search - <b><?php echo $this->input->get('keyword') ?></b> - did not match any employees.
	<?php else: ?>
		There are no employees that are currently available.
	<?php endif; ?>
<?php $this->load->view('layout/footer'); ?>