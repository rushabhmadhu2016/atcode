@extends('user.layouts.app')

@section('content')
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> My Referrals</h4>
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
					<th>Referral Name</th>
					<th>Referral registered date</th>
					<th>Referral Discount</th>
				</tr>
			</thead>
			<tbody>
				@foreach($referrals as $referral)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $referral->fullname }}</td>
						<td>{{ date('d/m/Y H:i:s', strtotime($referral->created_at)) }}</td>
						<td class="text-center">0</td>
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