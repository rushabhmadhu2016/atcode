@extends('admin.layouts.app')

@section('content')
<?php
$route = \Route::currentRouteName();
?>
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Subscribers</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Subscribers</a></li>
			</ul>
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
		<!-- Default ordering -->
		<div class="panel panel-flat">
			@php
			$i=1
			@endphp
			<table class="table datatable-sorting" id="subscribers">
				<thead>
					<tr>
						<th> # </th>
						<th>Email</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					@foreach($subscribers as $subscriber)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $subscriber->email }}</td>
							<td>{{ ($subscriber->status==1) ? 'Subscribed':'Pop-out' }}</td>
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
		$("#subscribers").DataTable();
	});
	</script>
@endsection