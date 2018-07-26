@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Messages</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Messages</a></li>
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
			if(isset($_REQUEST["page"])){
				$i=(($_REQUEST["page"]-1)*10)+1;
			}else{
				$i=1;
			}
			@endphp
			<table class="table datatable-sorting" id="users_list">
				<thead>
					<tr>
						<th> # </th>
						<th>Message Text</th>
						<th>Message Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach($messages as $message)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $message->text }}</td>
								<td>{{ date('d-m-Y H:i:s', strtotime($message->created_at)) }}</td>
							</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<p align="center"> {{ $messages->links() }} </p>
		<!-- /default ordering -->
		@include('admin.layouts.footer')
	</div>
	<!-- /content area -->
	<script type="text/javascript">
		$(document).ready(function(){

		});
	</script>
@endsection