@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Email Templates </span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Email Templates</a></li>
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
			$count=1
			@endphp
			<table class="table datatable-sorting" id="emails_list">
				<thead>
					<tr>
						<th>Sr No.</th>
						<th>Email Name</th>
						<th>Email Subject</th>
						<th>Date Updated</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($email as $key => $data)
                      <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $data->emat_email_name }}</td>
                        <td>{{ $data->emat_email_subject }}</td>
                        <td>{{ $data->updated_at }}</td>
                        <td class="text-center"><a href="{{ route('updatemail',['id'=>$data->id]) }}" title="Edit" class="edit"><i class="icon-pencil"></i></a></td>
                      </tr>
                      <?php $count++;?>
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
			$('#emails_list').DataTable();
		});
	</script>
@endsection