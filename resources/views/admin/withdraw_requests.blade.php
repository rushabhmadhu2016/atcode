@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Withdraw requests</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Withdraw requests</a></li>
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
						<th>Investor Name</th>
						<th>Investor NEO Address</th>
						<th>Tokens Allocate</th>
						<th>Withdrawal Request date</th>
						<th>Status</th>
				- 		<th>Action</th>
					</tr>
				</thead>
				<tbody>

					@foreach($allrequests as $transaction)
						<tr class="row-{{ $i }}">
							<td>{{ $i }}</td>
							<td>{{ $transaction->fullname }}</td>
							<td>{{ $transaction->neo_wallet_detail }}</td>
							<td>{{ $transaction->token_amount }}</td>
							<td>{{ $transaction->created_at }}</td>
							<td>
							<?php
if ($transaction->status == 1) {
	echo "Pending";
} else {
	echo "Transferred";
}
?></td>							<td><button type="button" class="btn btn-info btn-lg sendTokenBtn" data-toggle="modal" data-target="#myModal" data-address="{{ $transaction->neo_wallet_detail }}" data-token_amount="{{ $transaction->token_amount }}" data-rowId="row-{{ $i }}" data-request_id="{{ $transaction->id }}">Send Token</button></td>
						</tr>
						<?php $i++;?>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /default ordering -->
		@include('admin.layouts.footer')
	</div>
	<!-- /content area -->
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Send Token</h4>
	      </div>
	      <div class="modal-body">
	      	<form method="post" id="sendTokenForm">
		      	{{ csrf_field() }}
		      	<p> Please enter correct value in textbox to transfer token </p>
		        <div class="form-group">
		        	<label> Receiver NEO Address : <span class="receiver_address"></span></label>
		        	<input type="text" name="receiver_address" class="form-control" />
		        </div>
		        <div class="form-group">
		        	<label> Token Amount to Send : <span class="token_amount"></span></label>
		        	<input type="text" name="token_amount" class="form-control" />
		        </div>
		        <div class="form-group">
		        	<label> Sender NEO Address : </label>
		        	<input type="text" name="send_address" class="form-control" />
		        </div>
		        <div class="form-group">
		        	<label> Sender Private key : </label>
		        	<input type="text" name="sender_private_key" class="form-control" />
		        </div>
		        <input type="hidden" name="row_id" class="row_id" />
		        <input type="hidden" name="request_id" class="request_id" />
	        </form>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-success sendNow">Send Token</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#transaction_list').DataTable();
			$(".sendTokenBtn").click(function(){
				$(".receiver_address").html($(this).attr('data-address'));
				$(".token_amount").html($(this).attr('data-token_amount'));
				$(".row_id").val($(this).attr('data-rowId'));
				$(".request_id").val($(this).attr('data-request_id'));

			});

			$(".sendNow").click(function(){
				$.ajax({
					url: '{{ url("/send-token")}}',
					data: $("#sendTokenForm").serialize(),
					method: "post",
					success:function(response){
						var rowId= $(".row_id").val();
						$("."+rowId).remove();
						$("#myModal").modal("hide");
					},
					error: function(error){
						console.log(error);
						$("#myModal").modal("hide");
					},
				}).done(function(){
					$("#myModal").modal("hide");
				})
			});
		});
	</script>
@endsection