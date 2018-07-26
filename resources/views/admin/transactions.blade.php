@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Transactions</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Transactions</a></li>
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
			@include('admin.layouts.message_div')
			<table class="table datatable-sorting" id="transaction_list">
				<thead>
					<tr>
						<th> # </th>
						<th>Currency</th>
						<th>Receiver</th>
						<th>Tx Date</th>
						<th>Tokens Allocate</th>
				<!-- 		<th>Withdraw</th> -->
					</tr>
				</thead>
				<tbody>
					@foreach($transactions as $transaction)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $transaction->amount }} {{ $transaction->currency }} </td>
							<td>{{ $transaction->deposit_address }}</td>
							<td>{{ date('d/m/Y H:i:s', strtotime($transaction->created_at)) }}</td>
							<td class="text-center">
							{{ $transaction->net_token }}
							</td>
					<!-- 		<td class="text-center">
					<?php echo ($transaction->is_withdrawed) ? 'Yes' : 'No'; ?>
					</td> -->
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
			$('#transaction_list').DataTable();
		});
	</script>
@endsection