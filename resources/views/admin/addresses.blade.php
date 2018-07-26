@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Addresses (Unique Addresses) </span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Addresses</a></li>
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
			<table class="table datatable-sorting" id="address_list">
				<thead>
					<tr>
						<th> # </th>
						<th>Currency</th>
						<th>Address</th>
						<th>Assigned To</th>
					</tr>
				</thead>
				<tbody>
					@foreach($addresses as $addres)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $addres->currency_type }}</td>
							<td>{{ $addres->address }}</td>
							<td><?php if (isset($addres->user)) {echo $addres->user->fullname;}
?>							</td>
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
			$('#address_list').DataTable();
		});
	</script>
@endsection