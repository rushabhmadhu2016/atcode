@extends('layouts.app')
@section('title') Emails @endsection
@section('content')
<?php
$count = 1;
?>
<div class="row">
	<div class="col-lg-12">
		<!-- Bordered table -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h4 class="panel-title text-center">Email List</h4>
			</div>
			<table class="table datatable-basic table-bordered" id="email_template">
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
                        <td class="text-center"><a href="{{ route('putemail',['id'=>$data->id]) }}" title="Edit" class="edit"><i class="icon-pencil"></i></a></td>
                      </tr>
                      <?php $count++;?>
                    @endforeach
                </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('content_footer_js')
	<script type="text/javascript">var is_form_edit = true;</script>
    <script type="text/javascript" src="{{ Helper::assets('js/app/email.js') }}"></script>
@endsection
