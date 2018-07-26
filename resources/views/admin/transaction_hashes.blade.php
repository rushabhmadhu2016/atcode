@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Transaction Hash</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Transaction Hash</a></li>
			</ul>

			<ul class="breadcrumb-elements">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-gear position-left"></i>
						Settings
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
						<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
						<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-gear"></i> All settings</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
		<!-- Default ordering -->
		@include('admin.layouts.message_div')
		<div class="panel panel-flat">
			@php
			$i=1
			@endphp
			<table class="table datatable-sorting" id="transaction_hashes">
				<thead>
					<tr>
						<th> # </th>
						<th>Investor Name</th>
						<th>Currency</th>
						<th>Amount</th>
						<th>Tx Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($transaction_hashes as $hash)
						<tr>
							<td>{{ $i++ }}</td>
							<td>
							<?php
if ($hash->fullname) {
	echo $hash->fullname;
}
?>
							</td>
							<td>{{ $hash->currency_type }}</td>
							<td>{{ $hash->amount }}</td>
							<td>{{ $hash->created_at }}</td>
							<td>{{ ($hash->status==0)?'No Action Taken':'' }}</td>
							<td>{{ ($hash->status==0)?'Action Pending':'' }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /default ordering -->
		@include('admin.layouts.footer')
	</div>
	<!-- /content area -->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#transaction_hashes").DataTable();
	});
	</script>
@endsection