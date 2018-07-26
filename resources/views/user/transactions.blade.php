@extends('user.layouts.app')

@section('content')
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> Transactions</h4>
		</div>
	</div>
</div>
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
					<th>Sender/Receiver</th>
					<th>Tx Hash</th>
					<th>Tx Date</th>
					<th>Tokens Allocate</th>
					<th>Withdraw</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $transaction->amount }} {{ $transaction->currency }} </td>
						<td>From : {{ $transaction->sender_address }} To <br /> {{ $transaction->depost_address }}</td>
						<td>{{ $transaction->transaction_hash}}</td>
						<td>{{ date('d/m/Y H:i:s', strtotime($transaction->created_at)) }}</td>
						<td class="text-center">
						{{ $transaction->net_token }}
						</td>
						<td class="text-center">
						<?php echo ($transaction->is_withdrawed) ? 'Yes' : 'No'; ?>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<!-- /content area -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#transaction_list').DataTable();
	});
</script>
@endsection