@extends('layouts.app')

@section('content')
<section id="register" class="register">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" name="register" id="register">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Full Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="terms" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                            <label class="accept_label"> I Accept the <a href="{{ url('terms') }}" target="_new">Terms and conditions </a> of Avatarlife.io.</label>
                            <input type="checkbox" name="terms" id="terms">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            <p> Already a Member ? </p> <br />
                                <a href="{{ url('/login') }}" class="btn btn-primary">Login </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
    $.validator.addMethod("email",function(value,element){
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,9}$/.test(value);
    },"email like name@domain.com");

    $("form[name='register']").validate({
        //debug: true,
        rules:{
            name:{
                required:true,
                minlength:5,
                maxlength:50,
                normalizer: function(value) {return $.trim(value);}
            },
            email:{
                required:true,
                minlength:5,
                maxlength:50,
                email:true,
                normalizer: function(value) {return $.trim(value);}
            },
            password:{
                required:true,
                minlength:5,
                maxlength:50,
                normalizer: function(value) {return $.trim(value);}
            },
            password_confirmation:{
                required:true,
                minlength:5,
                maxlength:50,
                equalTo: "#password",
                normalizer: function(value) {return $.trim(value);}
            },
            terms: {
              required: true,
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
        name:{
            required:"Please enter Full name",
            noSpace: "No space allowed.",
            minlength: jQuery.validator.format("At least {0} characters required"),
            maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
        },
        email:{
            required:"Please enter Email",
            noSpace: "No space allowed.",
            minlength: jQuery.validator.format("At least {0} characters required"),
            maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
        },
        password:{
            required:"Please enter Password",
            noSpace: "No space allowed.",
            minlength: jQuery.validator.format("At least {0} characters required"),
            maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
        },
        password_confirmation:{
            required:"Please enter Confirm password",
            noSpace: "No space allowed.",
            minlength: jQuery.validator.format("At least {0} characters required"),
            maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
            equalTo:"Please enter the same password as above",
        },
        terms:{
            required:"Terms and condition are required.",
        },
    },
    submitHandler:function(form){
        form.submit();
    }
    });
});
</script>
@endsection
