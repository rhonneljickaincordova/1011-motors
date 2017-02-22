<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-edit"></i> 
		Update Current Stock In
	</h3>
	<br>
	<?php echo form_open('stock_ins/edit/' . $stock_in->get_id(), 'class="form-horizontal"'); ?>
		<?php if (form_error('employee_id')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Employee', 'employee_id', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_dropdown('employee_id', $employees, set_value('employee_id', $stock_in->get_employee_id()->get_id()), 'class="form-control" required'); ?>
				<?php echo form_error('employee_id'); ?>
			</div>
		</div>
		<?php if (form_error('item_id')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Item', 'item_id', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_dropdown('item_id', $items, set_value('item_id', $stock_in->get_item_id()->get_id()), 'class="form-control" data-live-search="true" required'); ?>
				<?php echo form_error('item_id'); ?>
			</div>
		</div>
		<?php if (form_error('quantity')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Quantity', 'quantity', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_input('quantity', set_value('quantity', $stock_in->get_quantity()), 'class="form-control" required'); ?>
				<?php echo form_error('quantity'); ?>
			</div>
		</div>
		<?php if (form_error('price')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Price', 'price', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_input('price', set_value('price', $stock_in->get_price()), 'class="form-control" required'); ?>
				<?php echo form_error('price'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="control-label col-lg-1"></div>
			<div class="col-lg-11">
				<a class="btn btn-primary" href="<?php echo base_url('stock_ins'); ?>">Back</a>
				<?php echo form_submit('', 'Submit', 'class="btn btn-primary"'); ?>
			</div>
		</div>
	<?php echo form_close(); ?>
<?php $this->load->view('layout/footer'); ?>