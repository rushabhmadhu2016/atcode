@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Email Template</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Email Template</a></li>
			</ul>
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
		<!-- Default ordering -->
		@include('admin.layouts.message_div')
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-flat">
							<div class="panel-body">
								<div class="row">
	<form action="{{ route('editemail') }}" method="post" class="form-horizontal form-validate" name="cartform">
	 	{{ csrf_field() }}

		<div class="col-md-12">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h4 class="panel-title text-center">Edit Email</h4>
				</div>
				<hr class='divider clear'>
				<div class="panel-body">
					<input type="hidden" value="{{ base64_encode($email->id) }}" name="email_id">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-12">Email Name <span class="text-danger">*</span></label>
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" class="form-control" name="emat_email_name" id="emat_email_name" autofocus="autofocus" tabindex="0" value="{{ $email->emat_email_name }}">
								@if ($errors->has('emat_email_name'))
			                        <label class="validation-error-label">{{ $errors->first('emat_email_name') }}
			                        </label>
			                    @endif
							</div>
						</div>
					</div>

					<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-12">Email Subject <span class="text-danger">*</span></label>
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" class="form-control" name="emat_email_subject" id="emat_email_subject" autofocus="autofocus" tabindex="0" value="{{ $email->emat_email_subject }}">
								@if ($errors->has('emat_email_subject'))
			                        <label class="validation-error-label">{{ $errors->first('emat_email_subject') }}
			                        </label>
			                    @endif
							</div>
						</div>
					</div>

					<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-lg-3 col-md-3 col-sm-4 col-xs-12">Email Body <span class="text-danger">*</span></label>
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 ckeditor">
								<textarea name="emat_email_message" id="emat_email_message" rows="10" cols="80" placeholder="Rental Agreement">{{ $email->emat_email_message }}</textarea>
								@if ($errors->has('emat_email_message'))
			                        <label class="validation-error-label">{{ $errors->first('emat_email_message') }}
			                        </label>
			                    @endif
							</div>
						</div>
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
					</div>
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="text-center">
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{ route('emails') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>
							</div>

			</div>
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