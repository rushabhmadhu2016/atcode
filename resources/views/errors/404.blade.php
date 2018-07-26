@extends('layouts.app')

@section('content')
<section id="login" class="login">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('status'))
                <div class="alert alert-warning">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">404</div>
                <div class="panel-body">
                    404 - Page Not found
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
