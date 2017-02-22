<?php

$active[$this->uri->segment(1)] = 'active';

if ($this->uri->segment(1) == 'items' || $this->uri->segment(1) == 'stock_ins' || $this->uri->segment(1) == 'stock_outs') {
	$active['stocks'] = 'active';
}

if ($this->uri->segment(1) == 'employees' || $this->uri->segment(1) == 'positions') {
	$active['options'] = 'active';
}

?>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<i class="fa fa-lg fa-fw fa-wrench"></i> 1011 Motors
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="<?php echo @$active['dashboard']; ?>">
					<a href="<?php echo base_url('dashboard'); ?>">
						<i class="fa fa-lg fa-fw fa-dashboard"></i> Dashboard
					</a>
				</li>
				<li class="<?php echo @$active['sales']; ?>">
					<a href="<?php echo base_url('sales'); ?>">
						<i class="fa fa-lg fa-fw fa-dollar"></i> Sales
					</a>
				</li>
				<li class="<?php echo @$active['stocks']; ?> dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-lg fa-fw fa-cubes"></i> Stocks <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li class="<?php echo @$active['items']; ?>">
							<a href="<?php echo base_url('items'); ?>">
								<i class="fa fa-lg fa-fw fa-tags"></i> Items
							</a>
						</li>
						<li class="<?php echo @$active['stock_ins']; ?>">
							<a href="<?php echo base_url('stock_ins'); ?>">
								<i class="fa fa-lg fa-fw fa-download"></i> Stocks In
							</a>
						</li>
						<li class="<?php echo @$active['stock_outs']; ?>">
							<a href="<?php echo base_url('stock_outs'); ?>">
								<i class="fa fa-lg fa-fw fa-upload"></i> Stocks Out
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="<?php echo @$active['options']; ?> dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-lg fa-fw fa-user"></i> Rhonnel <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<?php if ($this->session->userdata('position') == 'administrator'): ?>
							<li class="<?php echo @$active['employees']; ?>">
								<a href="<?php echo base_url('employees'); ?>">
									<i class="fa fa-lg fa-fw fa-users"></i> Employees
								</a>
							</li>
							<li class="<?php echo @$active['positions']; ?>">
								<a href="<?php echo base_url('positions'); ?>">
									<i class="fa fa-lg fa-fw fa-comments"></i> Positions
								</a>
							</li>
							<li class="divider"></li>
						<?php endif; ?>
						<li>
							<a href="<?php echo base_url('sign_out'); ?>">
								<i class="fa fa-lg fa-fw fa-sign-out"></i> Sign out
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>