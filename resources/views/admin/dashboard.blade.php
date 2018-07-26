@extends('admin.layouts.app')

@section('content')
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
			</div>
		</div>
		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li class="active">Dashboard</li>
			</ul>
		</div>
	</div>
	<div class="content">
	<div class="row">
	<div class="col-lg-12">
		@include('admin.layouts.message_div')
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Overall Transactions</h6>
			</div>

			<div class="table-responsive">
				<table class="table table-lg text-nowrap">
					<tbody>
						<tr>
							<td class="col-md-4">
								<div class="media-left">
									<div id="campaigns-donut"></div>
								</div>

								<div class="media-left">
									<h4>NEO</h4>
									<h5 class="text-semibold no-margin">38,289 <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+16.2%)</small></h5>
									<ul class="list-inline list-inline-condensed no-margin">
										<li>
											<span class="status-mark border-success"></span>
										</li>
										<li>
											<span class="text-muted">May 12, 12:30 am</span>
										</li>
									</ul>
								</div>
							</td>

							<td class="col-md-4">
								<div class="media-left">
									<div id="campaign-status-pie"></div>
								</div>

								<div class="media-left">
									<h4>ETH</h4>
									<h5 class="text-semibold no-margin">2,458 <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i> (- 4.9%)</small></h5>
									<ul class="list-inline list-inline-condensed no-margin">
										<li>
											<span class="status-mark border-danger"></span>
										</li>
										<li>
											<span class="text-muted">Jun 4, 4:00 am</span>
										</li>
									</ul>
								</div>
							</td>

							<td class="col-md-4">
								<div class="media-left">
									<div id="campaigns-donut"></div>
								</div>

								<div class="media-left">
									<h4>BTC</h4>
									<h5 class="text-semibold no-margin">38,289 <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+16.2%)</small></h5>
									<ul class="list-inline list-inline-condensed no-margin">
										<li>
											<span class="status-mark border-success"></span>
										</li>
										<li>
											<span class="text-muted">May 12, 12:30 am</span>
										</li>
									</ul>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-responsive">
				<table class="table text-nowrap">
					<thead>
						<tr>
							<th>Campaign</th>
							<th class="col-md-2">Client</th>
							<th class="col-md-2">Changes</th>
							<th class="col-md-2">Budget</th>
							<th class="col-md-2">Status</th>
							<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
						</tr>
					</thead>
					<tbody>
						<tr class="active border-double">
							<td colspan="5">Today</td>
							<td class="text-right">
								<span class="progress-meter" id="today-progress" data-progress="30"></span>
							</td>
						</tr>
						<tr>
							<td>
								<div class="media-left media-middle">
									<a href="#"><img src="{{ url('assets/images/brands/facebook.png') }}" class="img-circle img-xs" alt=""></a>
								</div>
								<div class="media-left">
									<div class=""><a href="#" class="text-default text-semibold">NEO</a></div>
									<div class="text-muted text-size-small">
										<span class="status-mark border-blue position-left"></span>
										02:00 - 03:00
									</div>
								</div>
							</td>
							<td><span class="text-muted">NEO</span></td>
							<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 2.43%</span></td>
							<td><h6 class="text-semibold">$5,489</h6></td>
							<td><span class="label bg-blue">Active</span></td>
							<td class="text-center">
								<ul class="icons-list">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
											<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
											<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
											<li class="divider"></li>
											<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<div class="media-left media-middle">
									<a href="#"><img src="{{ url('assets/images/brands/youtube.png') }}" class="img-circle img-xs" alt=""></a>
								</div>
								<div class="media-left">
									<div class=""><a href="#" class="text-default text-semibold">ETH</a></div>
									<div class="text-muted text-size-small">
										<span class="status-mark border-danger position-left"></span>
										13:00 - 14:00
									</div>
								</div>
							</td>
							<td><span class="text-muted">ETH</span></td>
							<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 3.12%</span></td>
							<td><h6 class="text-semibold">$2,592</h6></td>
							<td><span class="label bg-danger">Closed</span></td>
							<td class="text-center">
								<ul class="icons-list">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
											<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
											<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
											<li class="divider"></li>
											<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<div class="media-left media-middle">
									<a href="#"><img src="{{ url('assets/images/brands/spotify.png') }}" class="img-circle img-xs" alt=""></a>
								</div>
								<div class="media-left">
									<div class=""><a href="#" class="text-default text-semibold">BTC</a></div>
									<div class="text-muted text-size-small">
										<span class="status-mark border-grey-400 position-left"></span>
										10:00 - 11:00
									</div>
								</div>
							</td>
							<td><span class="text-muted">BTC</span></td>
							<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - 8.02%</span></td>
							<td><h6 class="text-semibold">$1,268</h6></td>
							<td><span class="label bg-grey-400">Hold</span></td>
							<td class="text-center">
								<ul class="icons-list">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
											<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
											<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
											<li class="divider"></li>
											<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>

						<tr class="active border-double">
							<td colspan="5">Yesterday</td>
							<td class="text-right">
								<span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
							</td>
						</tr>
						<tr>
							<td>
								<div class="media-left media-middle">
									<a href="#"><img src="{{ url('assets/images/brands/bing.png') }}" class="img-circle img-xs" alt=""></a>
								</div>
								<div class="media-left">
									<div class=""><a href="#" class="text-default text-semibold">Bing campaign</a></div>
									<div class="text-muted text-size-small">
										<span class="status-mark border-success position-left"></span>
										15:00 - 16:00
									</div>
								</div>
							</td>
							<td><span class="text-muted">Metrics</span></td>
							<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - 5.78%</span></td>
							<td><h6 class="text-semibold">$970</h6></td>
							<td><span class="label bg-success-400">Pending</span></td>
							<td class="text-center">
								<ul class="icons-list">
									<li class="dropup">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
											<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
											<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
											<li class="divider"></li>
											<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<div class="media-left media-middle">
									<a href="#"><img src="{{ url('assets/images/brands/amazon.png') }}" class="img-circle img-xs" alt=""></a>
								</div>
								<div class="media-left">
									<div class=""><a href="#" class="text-default text-semibold">Amazon ads</a></div>
									<div class="text-muted text-size-small">
										<span class="status-mark border-danger position-left"></span>
										18:00 - 19:00
									</div>
								</div>
							</td>
							<td><span class="text-muted">Blueish</span></td>
							<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 6.79%</span></td>
							<td><h6 class="text-semibold">$1,540</h6></td>
							<td><span class="label bg-blue">Active</span></td>
							<td class="text-center">
								<ul class="icons-list">
									<li class="dropup">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
											<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
											<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
											<li class="divider"></li>
											<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<div class="media-left media-middle">
									<a href="#"><img src="{{ url('assets/images/brands/dribbble.png') }}" class="img-circle img-xs" alt=""></a>
								</div>
								<div class="media-left">
									<div class=""><a href="#" class="text-default text-semibold">Dribbble ads</a></div>
									<div class="text-muted text-size-small">
										<span class="status-mark border-blue position-left"></span>
										20:00 - 21:00
									</div>
								</div>
							</td>
							<td><span class="text-muted">Teamable</span></td>
							<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> 9.83%</span></td>
							<td><h6 class="text-semibold">$8,350</h6></td>
							<td><span class="label bg-danger">Closed</span></td>
							<td class="text-center">
								<ul class="icons-list">
									<li class="dropup">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
											<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
											<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
											<li class="divider"></li>
											<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /marketing campaigns -->
	</div>
	</div>
	<!-- /dashboard content -->
	@include('admin.layouts.footer')
	</div>
@endsection