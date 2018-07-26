<!-- Main navigation -->
<?php
$route = \Route::currentRouteName();
?>
<div class="sidebar-category sidebar-category-visible">
	<div class="category-content no-padding">
		<ul class="navigation navigation-main navigation-accordion">
			<!-- Main -->
			<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
			<li class="<?php echo ($route == 'userDashboard') ? 'active' : ''; ?>">
			<a href="{{ url('userDashboard') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
			<li class="<?php echo ($route == 'buy-token') ? 'active' : ''; ?>">
				<a href="#"><i class="icon-stack2"></i> <span>Buy Token</span></a>
				<ul>
					<li><a href="{{ url('buy-token') }}">Buy AVR Tokens</a></li>
				</ul>
			</li>
			<li class="<?php echo ($route == 'user-transactions') ? 'active' : ''; ?>">
				<a href="#"><i class="icon-copy"></i> <span>My Transactions</span></a>
				<ul>
					<li><a href="{{ url('user-transactions') }}" id="layout1">All Transactions</a></li>
				</ul>
			</li>
			<li class="<?php echo (in_array($route, array('kycs', 'kyc_pending', 'kyc_approved'))) ? 'active' : ''; ?>">
				<a href="#"><i class="icon-droplet2"></i> <span>KYC</span></a>
				<ul>
					<li><a href="{{ url('kycs') }}">KYC Details</a></li>
				</ul>
			</li>
			<li class="<?php echo ($route == 'user-profile') ? 'active' : ''; ?>"><a href="{{ url('user-profile') }}"><i class="icon-gear position-left"></i> <span>Profile</span></a></li>
			<li class="<?php echo ($route == 'changePassword') ? 'active' : ''; ?>"><a href="{{ url('changePassword') }}"><i class="icon-user-lock"></i> <span>Change Password</span></a></li>
			<li><a href="{{ url('logout') }}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
			<!-- /main -->
		</ul>
	</div>
</div>
<!-- /main navigation -->