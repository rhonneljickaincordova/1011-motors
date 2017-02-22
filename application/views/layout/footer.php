	</div>
	<script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js'); ?>"></script>
	<script src="<?php echo base_url('bower_components/bootstrap-notify/js/bootstrap-notify.js'); ?>"></script>
	<script type="text/javascript">
		$('select').selectpicker();
		<?php if ($this->session->flashdata('notification')): ?>
			$('.top-right').notify({
				type: '<?php echo $this->session->flashdata("alert"); ?>',
				message: { text: '<?php echo $this->session->flashdata("notification"); ?>' },
				closable: false
			}).show();
		<?php endif; ?>
	</script>
</body>
</html>