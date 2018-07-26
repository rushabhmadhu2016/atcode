<!-- Main navigation -->
<?php
$route = \Route::currentRouteName();
?>
<div class="sidebar-category sidebar-category-visible">
	<div class="category-content no-padding">
		<ul class="navigation navigation-main navigation-accordion">
			<!-- Main -->
			<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
			<li class="<?php echo ($route == 'adminDashboard') ? 'active' : ''; ?>">
			<a href="{{ url('adminDashboard') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
			<li class="<?php echo ($route == 'users') ? 'active' : ''; ?>">
				<a href="#"><i class="icon-stack2"></i> <span>Users</span></a>
				<ul>
					<li><a href="{{ url('users') }}">All Users</a></li>
				</ul>
			</li>
			<li class="<?php echo ($route == 'transactions') ? 'active' : ''; ?>">
				<a href="#"><i class="icon-copy"></i> <span>Transactions</span></a>
				<ul>
					<li><a href="{{ url('transactions') }}" id="layout1">All Transactions</a></li>
				</ul>
			</li>
			<li class="<?php echo (in_array($route, array('kycs', 'kyc_pending', 'kyc_approved'))) ? 'active' : ''; ?>">
				<a href="#"><i class="icon-droplet2"></i> <span>KYC</span></a>
				<ul>
					<li><a href="{{ url('kycs') }}">All</a></li>
					<li><a href="{{ url('kyc_pending') }}">KYC Pending</a></li>
					<li><a href="{{ url('kyc_approved') }}">KYC Approved</a></li>
				</ul>
			</li>
			<li class="<?php echo (in_array($route, array('neo_addresses', 'eth_addresses', 'btc_addresses'))) ? 'active' : ''; ?>">
				<a href="#"><i class="icon-stack"></i> <span>Addresses</span></a>
				<ul>
					<li><a href="{{ url('neo_addresses')}}">NEO</a></li>
					<li><a href="{{ url('eth_addresses')}}">ETH</a></li>
					<li><a href="{{ url('btc_addresses')}}">BTC</a></li>
				</ul>
			</li>
			<li class="<?php echo ($route == 'pre_ico_sale') ? 'active' : ''; ?>"><a href="{{ url('pre_ico_sale') }}"><i class="icon-alarm"></i> <span>Pre ICO Sale</span></a>
			</li>
			<li class="<?php echo ($route == 'subscribers') ? 'active' : ''; ?>"><a href="{{ url('subscribers') }}"><i class="icon-list-unordered"></i> <span>Subscribers </span></a></li>
			<li class="<?php echo ($route == 'invalid_transactions') ? 'active' : ''; ?>"><a href="{{ url('invalid_transactions') }}"><i class="icon-width"></i> <span>Invalid Transactions</span></a></li>
			<li class="<?php echo ($route == 'settings') ? 'active' : ''; ?>"><a href="{{ url('settings') }}"><i class="icon-gear position-left"></i> <span>Account Settings</span></a></li>
			<li class="<?php echo ($route == 'messages') ? 'active' : ''; ?>"><a href="{{ url('messages') }}"><i class="icon-bubbles4"></i> <span>Messages</span></a></li>
			<li class="<?php echo ($route == 'emails') ? 'active' : ''; ?>">
			<a href="{{ url('emails') }}"><i class="icon-envelop2"></i> <span>Email Templates</span></a>
			</li>
			<li class="<?php echo ($route == 'changePassword') ? 'active' : ''; ?>"><a href="{{ url('change-password') }}"><i class="icon-user-lock"></i> <span>Change Password</span></a></li>
			<li class="<?php echo ($route == 'withdraw_requests') ? 'active' : ''; ?>"><a href="{{ url('withdraw_requests') }}"><i class="icon-user-lock"></i> <span>Withdrawal Requests</span></a></li>
			<!-- /main -->
		</ul>
	</div>
</div>
<!-- /main navigation -->