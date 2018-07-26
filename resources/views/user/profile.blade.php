@extends('user.layouts.app')

@section('content')
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> Profile</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		@include('user.layouts.message_div')
		<div class="row">
			<div class="col-md-12">
				<form action="{{ url('update-profile')}}" method="post" id="change-password" name="profile-form">
				{{ csrf_field() }}
					<div class="panel panel-flat">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="form-group">
										<label>Fullname:</label>
										<input type="text" class="form-control" placeholder="Enter fullname" required name="fullname" id="fullname" value="<?php echo $profile->fullname; ?>">
									</div>

									<div class="form-group">
										<label> Email id:</label>
										<input type="text" name="email" class="form-control" placeholder="Email id" id="email" readonly="readonly" value="<?php echo $profile->email; ?>">
									</div>

									<div class="form-group">
										<label>Address:</label>
										<textarea name="address" id="address" class="form-control"><?php echo $profile->address; ?></textarea>
									</div>

									<div class="form-group">
										<label>Country:</label>
										<input type="text" name="country" class="form-control" placeholder="Country" id="country" name="country" value="<?php echo $profile->country; ?>">
									</div>

									<div class="form-group">
										<label>Zip code:</label>
										<input type="text" name="zip_code" class="form-control" placeholder="Zip code" id="zip_code" name="zip_code" value="<?php echo $profile->zip_code; ?>">
									</div>

									<div class="form-group">
										<label>Unique Referral Link :</label>
										<input type="text" name="referral_link" class="form-control" placeholder="Unique Referral link" id="referral_link" name="referral_link" value="<?php echo $profile->referral_link; ?>" readonly="readonly">
									</div>

									<div class="form-group">
										<label>NEO Wallet Address: <small><small>(This will be the address on which your Tokens will be credited when you withdraw.)</small></small></label>
										<input type="text" name="neo_wallet_detail" class="form-control" placeholder="NEO Wallet Address" id="neo_wallet_detail" name="neo_wallet_detail" value="<?php echo $profile->neo_wallet_detail; ?>">
									</div>

									<div class="text-right">
										<button type="submit" class="btn btn-primary">Update Profile <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<form action="{{ url('update-withdrawal_request')}}" method="post" name="withdraw_funds-form" id="withdraw_funds_form">
				{{ csrf_field() }}
					<div class="panel panel-flat">
						<div class="panel-body">
							<div class="form-group">
								<label>Withdraw Tokens ? </label>
								<input type="radio" name="withdraw_funds" class="withdraw_funds_chk" value="1"> Yes
								<input type="radio" name="withdraw_funds" class="withdraw_funds_chk" value="0" checked="checked"> No
							</div>
							<div class="form-group text-right">
							<input type="button" name="submit_withdraw_request" class="btn btn-primary submit_withdraw_request" value="Update Request" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
	<!-- /dashboard content -->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".submit_withdraw_request").click(function(){
				var address = $("#neo_wallet_detail").val();
				if(confirm("Are you sure to withdraw your funds in "+address+" ? ")){
					$("#withdraw_funds_form").submit();
				}
			})
			$("form[name='profile-form']").validate({
				//debug: true,
				rules:{
					fullname:{
						required:true,
                		minlength:5,
                		maxlength:50,
                		normalizer: function(value) {return $.trim(value);}
					},
					address:{
						required:true,
                		minlength:5,
                		maxlength:50,
		                normalizer: function(value) {return $.trim(value);}
					},
					country:{
						required:true,
                		minlength:3,
                		maxlength:50,
	                	normalizer: function(value) {return $.trim(value);}
					},
					zip_code:{
						required:true,
                		minlength:3,
                		maxlength:50,
	                	normalizer: function(value) {return $.trim(value);}
					},
					neo_wallet_detail:{
						required:true,
                		minlength:34,
                		maxlength:34,
                		normalizer: function(value) {return $.trim(value);}
					}
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
				fullname:{
					required:"Please enter Name",
	                noSpace: "No space allowed.",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
				},
				address:{
					required:"Please enter address",
	                noSpace: "No space allowed.",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
				},
				country:{
					required:"Please enter countryname",
	                noSpace: "No space allowed.",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
	            },
                zip_code:{
					required:"Please enter zip_code",
	                noSpace: "No space allowed.",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
				},
				neo_wallet_detail:{
					required:"Please enter NEO Address",
	                minlength: jQuery.validator.format("At least {0} characters required"),
	                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
				},
			},
			submitHandler:function(form){
				form.submit();
			}
		});
	});
	</script>
	</div>
@endsection