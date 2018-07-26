@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Users</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Users</a></li>
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
			<table class="table datatable-sorting" id="users_list">
				<thead>
					<tr>
						<th> # </th>
						<th>Investor Name</th>
						<th>Investor Email</th>
						<th>Country</th>
						<th>KYC Status</th>
						<th>Register Date</th>
						<th>Status</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						@if($user->user_type==1)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $user->fullname }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->country }}</td>
								<td><span class="label label-danger">InApproved</span></td>
								<td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
								<td class="text-center">
								@if ($user->status)
									<span class="label label-success">Active</span>
								@else
									<span class="label label-danger">Inactive</span>
								@endif
								</td>
								<td class="text-center">
								@if ($user->status==1)
									<button class="btn btn-danger userstatus" data-id="{{$user->id}}" data-status="0">Make Inactive </button>
								@else
									<button class="btn btn-primary userstatus" data-id="{{$user->id}}" data-status="1">Make Active </button>
								@endif
								</td>
							</tr>
							@endif
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
			$('#users_list').DataTable();
			$(".userstatus").click(function(){
				var id=$(this).attr('data-id');
				var status=$(this).attr('data-status');
				window.location='manage_user_status?id='+id+'&status='+status;
			})
		});
	</script>
@endsection