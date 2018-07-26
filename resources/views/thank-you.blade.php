@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            <h1>Thank You </h1>
            <p>Thanks to show intrest in avtarlife.io.</p>
            @if ($message)
                <div class="alert alert-success">
                    <ul>
                        <li>{!! $message !!}</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection