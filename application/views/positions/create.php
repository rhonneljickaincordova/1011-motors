<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-plus"></i> 
		Create New Position
	</h3>
	<br>
	<?php echo form_open('positions/create', 'class="form-horizontal"'); ?>
		<?php if (form_error('description')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Description', 'description', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_input('description', set_value('description'), 'class="form-control" required'); ?>
				<?php echo form_error('description'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="control-label col-lg-1"></div>
			<div class="col-lg-11">
				<a class="btn btn-primary" href="<?php echo base_url('positions'); ?>">Back</a>
				<?php echo form_submit('', 'Submit', 'class="btn btn-primary"'); ?>
			</div>
		</div>
	<?php echo form_close(); ?>
<?php $this->load->view('layout/footer'); ?>