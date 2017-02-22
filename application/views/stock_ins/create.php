<?php $this->load->view('layout/header'); ?>
	<h3>
		<i class="fa fa-lg fa-fw fa-plus"></i> 
		Create New Stock In
	</h3>
	<br>
	<?php echo form_open('stock_ins/create', 'class="form-horizontal"'); ?>
		<?php if (form_error('item_id')): ?>
			<div class="form-group has-error">
		<?php else: ?>
			<div class="form-group">
		<?php endif; ?>
			<?php echo form_label('Item', 'item_id', array('class' => 'control-label col-lg-1')); ?>
			<div class="col-lg-11">
				<?php echo form_dropdown('item_id', $items, set_value('item_id'), 'class="form-control" data-live-search="true" required'); ?>
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
				<?php echo form_input('quantity', set_value('quantity'), 'class="form-control" required'); ?>
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
				<?php echo form_input('price', set_value('price'), 'class="form-control" required'); ?>
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