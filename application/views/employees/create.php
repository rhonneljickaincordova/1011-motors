<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-plus"></i> 
		Create New Employee
	</h3>
	<br>
	<?php echo form_open('employees/create', 'class="form-horizontal"'); ?>
		<?php if (form_error('first_name')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('First Name', 'first_name', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_input('first_name', set_value('first_name'), 'class="form-control" required'); ?>
				<?php echo form_error('first_name'); ?>
			</div>
		</div>
		<?php if (form_error('last_name')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Last Name', 'last_name', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_input('last_name', set_value('last_name'), 'class="form-control" required'); ?>
				<?php echo form_error('last_name'); ?>
			</div>
		</div>
		<?php if (form_error('username')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Username', 'username', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_input('username', set_value('username'), 'class="form-control" required'); ?>
				<?php echo form_error('username'); ?>
			</div>
		</div>
		<div class="form-group">
			<?php echo form_label('Password', 'password', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_password('password', set_value('password'), 'class="form-control"'); ?>
			</div>
		</div>
		<div class="form-group">
			<?php echo form_label('Confirm Password', 'confirm_password', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_password('confirm_password', set_value('confirm_password'), 'class="form-control"'); ?>
			</div>
		</div>
		<?php if (form_error('position_id')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Position', 'position_id', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_dropdown('position_id', $positions, set_value('position_id'), 'class="form-control" required'); ?>
				<?php echo form_error('position_id'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="control-label col-lg-1"></div>
			<div class="col-lg-11">
				<a class="btn btn-primary" href="<?php echo base_url('employees'); ?>">Back</a>
				<?php echo form_submit('', 'Submit', 'class="btn btn-primary"'); ?>
			</div>
		</div>
	<?php echo form_close(); ?>
<?php $this->load->view('layout/footer'); ?>