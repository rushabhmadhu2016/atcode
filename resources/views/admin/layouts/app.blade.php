<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AvatarLife Token : Home</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ url('admin_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('admin_assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('admin_assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('admin_assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('admin_assets/css/colors.css') }}" rel="stylesheet" type="text/css">

	<link href="{{ url('admin_assets/css/developer_style.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ url('admin_assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/pickers/daterangepicker.js') }}"></script>

	<script type="text/javascript" src="{{ url('admin_assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/pages/datatables_basic.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('admin_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{ url('js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/picker.js') }}"></script>
	<!-- /theme JS files -->
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/') }}">AvatarLife Token</a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<p class="navbar-text"><span class="label bg-success">Online</span></p>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ url('admin_assets/images/placeholder.jpg') }}" alt="">
						<span>Admin</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{ url('settings') }}"><i class="icon-cog5"></i> Account settings</a></li>
						<li><a href="{{ url('change-password') }}"><i class="icon-user-lock"></i> Change Password</a></li>
						<li>
						<a href="{{ url('messages') }}"><span class="badge bg-teal-400 pull-right">
						<?php
echo $counter = DB::table('messages')->count();
?>
						</span> <i class="icon-comment-discussion"></i> Messages</a></li>
						<li class="divider"></li>
						<li><a href="{{ url('logout') }}"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="{{ url('admin_assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"> &nbsp; ICO Admin</span>
									<div class="text-size-mini text-muted">
										<i class="text-size-small"></i>Avtar Life Token
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="#"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->
					@include('admin.layouts.sidebar')
				</div>
			</div>
			<!-- /main sidebar -->
			<div class="content-wrapper">
				@yield('content')
			</div>
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->
</body>
</html>
