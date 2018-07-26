@extends('admin.layouts.app')

@section('content')
<?php
$route = \Route::currentRouteName();
?>
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Pre ICO </span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Pre ICO </a></li>
			</ul>
		</div>
	</div>
	<div class="content">
		@include('admin.layouts.message_div')
		<div class="panel panel-flat">
		<?php
$presale_status = array(2 => "Completed", 1 => "Running", "0" => "Upcomming");
$i = 1
?>
			<table class="table datatable-sorting" id="pre_sale">
				<thead>
					<tr>
						<th> # </th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Discount of Range1</th>
						<th>Discount of Range2</th>
						<th>Status</th>
						<th>Operation</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pre_sales as $pre_sale)
						<tr>
							<td>{{ $i++ }} </td>
							<td>{{ date('d-m-Y',strtotime($pre_sale->start_time)) }} </td>
							<td>{{ date('d-m-Y',strtotime($pre_sale->end_time)) }}</td>
							<td>{{ $pre_sale->bonus }} %</td>
							<td>{{ $pre_sale->bonus2 }} %</td>
							<td>{{ $presale_status[$pre_sale->is_completed] }}</td>
							<td><a href="{{ url('edit-presale') }}/{{ $pre_sale->id }}" class="btn btn-primary">Edit</a></td>
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
			$('#pre_sale').DataTable();
		})
	</script>
@endsection