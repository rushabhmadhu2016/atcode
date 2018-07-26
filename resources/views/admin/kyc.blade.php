@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">KYC (Know Your Customer) </span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">KYC</a></li>
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
			<table class="table datatable-sorting" id="kyc_list">
				<thead>
					<tr>
						<th> # </th>
						<th>Investor Name</th>
						<th>Document Type</th>
						<th>Document</th>
						<th>Applied On</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($kycs as $kyc)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $kyc->fullname }}</td>
							<td>{{ $kyc->document_type }}</td>
							<td></td>
							<td>{{ date('d/m/Y H:i:s', strtotime($kyc->created_at)) }}</td>
							<td class="text-center">
							<?php echo ($kyc->status) ? '<span class="label label-success">Approved</span>' : '<span class="label label-danger">Not Approved</span>'; ?>
							</td>
							<td><button type="button" class="btn btn-default btn-sm" id="kyc_action_btn" data-toggle="modal" data-target="#modal_default" data-id="{{ $kyc->id }}">Take Action<i class="icon-play3 position-right"></i></button></td>
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
			$('#kyc_list').DataTable();
			$("#kyc_action_btn").click(function(){
				var url1 = "{{ url('approve_kyc') }}/"+$(this).attr('data-id');
				var url2 = "{{ url('reject_kyc') }}/"+$(this).attr('data-id');
				console.log(url1);
				console.log(url2);
				$("#reject_kyc_btn").attr('data-href',url2);
				$("#approve_kyc_btn").attr('data-href',url1);
			});

			$("#approve_kyc_btn").click(function(){
				$("#approve_kyc_btn").attr('disabled',true);
				$("#reject_kyc_btn").attr('disabled',true);
				window.location=$(this).attr('data-href');
			});


			$("#reject_kyc_btn").click(function(){
				$("#approve_kyc_btn").attr('disabled',true);
				$("#reject_kyc_btn").attr('disabled',true);
				window.location=$(this).attr('data-href');
			});
		});
	</script>
	  <!-- Basic modal -->
	<div id="modal_default" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">KYC Verification</h5>
				</div>

				<div class="modal-body">
					<h6 class="text-semibold">Investor Details</h6>
					<p></p>

					<hr>

					<h6 class="text-semibold">Documents of Investor</h6>
					<p></p>
				</div>

				<div class="modal-footer">

				<button type="button" class="btn btn-success" id="approve_kyc_btn" data-url="">Approve KYC</button>
				<button type="button" class="btn btn-danger" id="reject_kyc_btn" data-url="">Reject KYC</button>

				<button type="button" class="btn btn-secondry" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /basic modal -->

@endsection