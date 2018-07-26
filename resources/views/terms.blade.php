@extends('layouts.app')

@section('content')
<section id="introductoin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-title color-blue">Terms and condition</h2>
                <div class="section-content text-justify">
                    <p>Terms1</p>
                    <p>Terms1</p>
                    <p>Terms1</p>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <a href="{{ url('/') }}" class="btn btn-primary"> Back to Homepage </a>
            </div>
        </div>
    </div>
</section>

@endsection