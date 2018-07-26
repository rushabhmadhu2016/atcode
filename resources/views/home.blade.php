@extends('layouts.app')

@section('content')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
            </div>
        </div>
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ul>
        </div>
    </div>
    <div class="content">
    <div class="row">
    <div class="col-lg-12">
        @include('admin.layouts.message_div')
        <div class="panel panel-flat">
            <div class="table-responsive">

            </div>
        </div>
        <!-- /marketing campaigns -->
    </div>
    </div>
    <!-- /dashboard content -->
    @include('admin.layouts.footer')
    </div>
@endsection