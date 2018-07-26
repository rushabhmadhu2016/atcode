@extends('layouts.app')
@section('title') Email Edit @endsection
@section('content')
<div class="row">
	<form action="{{ route('editemail') }}" method="post" class="form-horizontal form-validate" name="cartform">
	 	{{ csrf_field() }}

		<div class="col-md-12">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h4 class="panel-title text-center">Edit Email</h4>
				</div>
				<div class="col-xs-12 mb-10 mt-10">
					<h6><strong>Keywords: </strong>{{ implode(', ',config('constant.email_template_tag')) }}</h6>
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
							<a href="{{ route('email_management') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>
@endsection
@section('content_footer_js')
	<script type="text/javascript">var is_form_edit = true;</script>
    <script type="text/javascript" src="{{ Helper::assets('js/app/email.js') }}"></script>
    <script type="text/javascript" src="{{ Helper::assets('js/plugins/editors/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" >
$(function () {
    CKEDITOR.replace('emat_email_message', {
        height: '400px',
        removeButtons: 'Subscript,Superscript,Image',
        toolbarGroups: [
            {name: 'styles'},
            {name: 'editing', groups: ['find', 'selection']},
            {name: 'basicstyles', groups: ['basicstyles']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align']},
            {name: 'links'},
            {name: 'insert'},
            {name: 'colors'},
            {name: 'tools'},
            {name: 'others'},
            {name: 'document', groups: ['mode', 'document', 'doctools']}
        ]
    });
});
</script>
@endsection