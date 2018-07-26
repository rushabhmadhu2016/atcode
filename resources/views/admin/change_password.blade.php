@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Change Password</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">Change Password</a></li>
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
					<form action="{{ url('change-password')}}" method="post" id="change-password" name="change-password">
					{{ csrf_field() }}
						<div class="panel panel-flat">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<div class="form-group">
											<label>Current Password:</label>
											<input type="password" class="form-control" placeholder="Enter current password" name="current_password" id="current_password">
										</div>

										<div class="form-group">
											<label>Enter new password:</label>
											<input type="password" name="new_password" class="form-control" value="" placeholder="Enter new password" id="new_password">
										</div>

										<div class="form-group">
											<label>Confirm new password:</label>
											<input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm new password" id="confirm_new_password">
										</div>

										<div class="text-right">
											<button type="submit" class="btn btn-primary">Change password <i class="icon-arrow-right14 position-right"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
		</div>
		<!-- /default ordering -->
		@include('admin.layouts.footer')
	</div>
	<!-- /content area -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("form[name='change-password']").validate({
				//debug: true,
				rules:{
					current_password:{
						required:true,
                		minlength:5,
                		maxlength:20,
                		normalizer: function(value) {return $.trim(value);}
					},
					new_password:{
						required:true,
                		minlength:5,
                		maxlength:20,
		                normalizer: function(value) {return $.trim(value);}
					},
					confirm_new_password:{
						required:true,
                		minlength:5,
                		maxlength:20,
                		equalTo: "#new_password",
	                	normalizer: function(value) {return $.trim(value);}
					},
				},
				highlight: function(element) {
            		$(element).closest('.form-group').addClass('has-error');
            		$(element).addClass('has-error');
	        	},
		        unhighlight: function(element) {
		            $(element).closest('.form-group').removeClass('has-error');
		            $(element).removeClass('has-error');
		        },
		        errorElement: 'span',
		        errorClass: 'help-block',
	        	errorPlacement: function(error, element) {
	            if(element.parent('.input-group').length) {
	                error.insertAfter(element.parent());
	            }
	            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
	                error.appendTo( element.parent() );
	            }
	            else if (element.parents('div').hasClass('choice')){
	                error.appendTo( element.parent().parent().parent().parent() );
	            }
	            else {
	                error.insertAfter(element);
	            }
	        },
			messages:{
				current_password:{
					required:"Please enter current password",
	                noSpace: "No space allowed.",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
				},
				new_password:{
					required:"Please enter new password",
	                noSpace: "No space allowed.",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
				},
				confirm_new_password:{
					required:"Please enter confirm password",
	                noSpace: "No space allowed.",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
					equalTo:"Please enter the same password as above",
				},
			},
			submitHandler:function(form){
				form.submit();
			}
		});
	});
	</script>
@endsection