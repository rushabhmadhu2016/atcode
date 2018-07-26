@extends('user.layouts.app')

@section('content')
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> Dashboard</h4>
		</div>
	</div>
</div>
<!-- Content area -->
<?php
$current_date = date('Y-m-d');
if ((strtotime($current_date) >= strtotime($pre_sales[0]->start_time)) && (strtotime($current_date) <= strtotime($pre_sales[0]->end_time))) {
	$round1 = 1;
	$round1_message = "Buy Now";
	$round1_url = url('/buy-token');
} else if (strtotime($current_date) > strtotime($pre_sales[0]->end_time)) {
	$round1 = -2;
	$round1_message = "Completed";
	$round1_url = 'javascript:void(0)';
} else {
	$round1 = 0;
	$round1_message = "Cooming Soon";
	$round1_url = 'javascript:void(0)';
}

if ((strtotime($current_date) >= strtotime($pre_sales[1]->start_time)) && (strtotime($current_date) <= strtotime($pre_sales[1]->end_time))) {
	$round2 = 1;
	$round2_message = "Buy Now";
	$round2_url = url('/buy-token');
} else if (strtotime($current_date) > strtotime($pre_sales[1]->end_time)) {
	$round2 = 0;
	$round2_message = "Completed";
	$round2_url = 'javascript:void(0)';
} else {
	$round2 = 0;
	$round2_message = "Cooming Soon";
	$round2_url = 'javascript:void(0)';
}

if ((strtotime($current_date) >= strtotime($pre_sales[2]->start_time)) && (strtotime($current_date) <= strtotime($pre_sales[2]->end_time))) {
	$round3 = 1;
	$round3_message = "Buy Now";
	$round3_url = url('/buy-token');
} else if (strtotime($current_date) > strtotime($pre_sales[2]->end_time)) {
	$round3 = 0;
	$round3_message = "Completed";
	$round3_url = 'javascript:void(0)';
} else {
	$round3 = 0;
	$round3_message = "Cooming Soon";
	$round3_url = 'javascript:void(0)';
}
?>
<div class="content">
		@include('user.layouts.message_div')
		<p class="header-text text-center"> Thanks for your interest in purchasing AvtarLife Tokens. </p>
		<p class="header text-center"> You can purchase based on the following schedule. </p>
		<div id="products" class="row list-group">
	        <div class="item  col-xs-12 col-lg-4">
	            <div class="thumbnail">
	                <img class="group list-group-image" src="{{ url('images/round1.png') }}" alt="" />
	                <div class="caption">
	                    <h4 class="group inner list-group-item-heading">
	                        Upto <?php echo $pre_sales[0]->bonus; ?>%</h4>
	                    <p class="group inner list-group-item-text">Round 1</p>
	                    <div class="row">
	                        <div class="col-xs-12 col-md-12 text-center">
	     						<a class="btn btn-success" href="{{ $round1_url }}">
	                            {{ $round1_message }}</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="item  col-xs-12 col-lg-4">
	            <div class="thumbnail">
	                <img class="group list-group-image" src="{{ url('images/round2.png') }}" alt="" />
	                <div class="caption">
	                    <h4 class="group inner list-group-item-heading">
	                        Upto <?php echo $pre_sales[1]->bonus; ?> %</h4>
	                    <p class="group inner list-group-item-text">Round 2</p>
	                    <div class="row">
	                        <div class="col-xs-12 col-md-12 text-center">
	     						<a class="btn btn-success" href="{{ $round2_url }}">
	                            {{ $round2_message }}</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="item  col-xs-12 col-lg-4">
	            <div class="thumbnail">
	                <img class="group list-group-image" src="{{ url('images/round3.png') }}" alt="" />
	                <div class="caption">
	                    <h4 class="group inner list-group-item-heading">
	                        Upto <?php echo $pre_sales[2]->bonus; ?> %</h4>
	                    <p class="group inner list-group-item-text">Round 3</p>
	                    <div class="row">
	                        <div class="col-xs-12 col-md-12 text-center">
	     						<a class="btn btn-success" href="{{ $round3_url }}">
	                            {{ $round3_message }}</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		<p class="second-header text-center"> We Accepts </p>
		<div class="row text-center">
			<div class="col-md-12 text-center">
				<img src="{{ url('images/ethereum.png') }}" class="we-supports-img" alt="ETH">
				<img src="{{ url('images/neo.png') }}" class="we-supports-img" alt="NEO">
				<img src="{{ url('images/bitcoin.png') }}" class="we-supports-img" alt="BTC">
			</div>
		</div>
	</div>
	<style type="text/css">

	</style>
@endsection