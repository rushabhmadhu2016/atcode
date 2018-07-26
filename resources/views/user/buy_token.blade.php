@extends('user.layouts.app')

@section('content')
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> Buy Token</h4>
		</div>
	</div>
</div>
<div class="content">
	<div class="row">
		@include('user.layouts.message_div')
		<form action="{{ url('start_monitoring') }}" id="buy_token" method="post">
			{{ csrf_field() }}
			<div class="col-md-12">
				<h1> Calculator</h1>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label><span class="currency_name">NEO</span></label>
					<input type="text" name="currency" class="form-control currency_amount" id="currency" value="1">
					<label><span class="currency_message"></span></label>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label>AVR</label>
					<input type="text" name="token_amount" class="form-control" id="token_amount" value="{{ $settings->token_price_neo }}" readonly="readonly">
					<label>Bonus : <span class="bonus_amount_message">0</span></label>
				</div>
			</div>
			<div class="col-md-12">
				<div class="row col-md-offset-1">
					<div class="col-md-3">
						<div class="selection_cover" data-currency="ETH">
							<img src="{{ url('images/ethereum.png') }}" class="we-supports-img" alt="ETH">
							<p> 1 ETH = {{ round($settings->token_price_eth,0) }} AVR</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="selection_cover active" data-currency="NEO">
							<img src="{{ url('images/neo.png') }}" class="we-supports-img" alt="NEO">
							<p> 1 NEO = {{ round($settings->token_price_neo,2) }} AVR</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="selection_cover" data-currency="BTC">
							<img src="{{ url('images/bitcoin.png') }}" class="we-supports-img" alt="BTC">
							<p> 1 BTC = {{ round($settings->token_price_bth,2) }} AVR</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-10 text-center token_buy_complete_msg_div">
				Complete your purchase by sending <span class="selected_currency_show"></span> To the AVR Public wallet address.
			</div>
			<div class="col-md-12">
				<div class="inner_selected_currency">
				</div>
			</div>
			<div class="col-md-10 text-center">
				<div class="send_currency">
					<buton type="submit" class="send_currency_btn btn btn-primary" data-text="I have Sent">I have Sent NEO</buton>
				</div>
			</div>
			<?php
if (count($current_tracker) > 0) {
	$tracker_start_time = date('Y-m-d H:i:s');
	$tracker_end_time = $current_tracker->end_time;

	if (strtotime($tracker_end_time) > strtotime($tracker_start_time)) {
		?>
			<div class="col-md-10 text-center">
				<p> Thank You for purchasing ALT Tokens. </p>
				<p> We will send over tokens as soon as we receive your Amount in our address. </p>
			</div>

			<div class="col-md-10 counters_div">
				<div class="monitoring_counter">
				<span id="timer"></span>
					<div class="col-md-4 monitoring_counter monitoring_hh hh text-center">00
					</div>
					<div class="col-md-4 monitoring_counter monitoring_mm mm text-center">00
					</div>
					<div class="col-md-4 monitoring_counter monitoring_ss ss text-center">00
					</div>
				</div>
			</div>

			<div class="col-md-10 send_more_section text-center">
				<p> You can send more <?php echo $current_tracker->currency_type; ?> to our Address (<?php echo $current_tracker->address; ?>) within this time frame. </p>
			</div>
			<?php }}?>
			<input type="hidden" name="selected_currency" class="selected_currency" id="user_selected_currency" value="NEO">
			<input type="hidden" name="monitor_address" class="monitor_address" value="{{ $user_neo_address }}">
		</form>
	</div>
</div>
<div class="modal fade bd-example-modal-lg" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        			<h3 id="myModalLabel"><u>Confirm order</u></h3>
    		</div>
    		<div class="modal-body">
    			<div class="row">
    				<p>Please confirm that you have <span class="selected_currency"></span> send to our Address.</p>
    			</div>
    			<div class="row">
	        		<div class="col-md-6">
	            		<button id="yes_send_btn" type="button" class="btn btn-success">Yes, Sent</button>
	        		</div>
			        <div class="col-md-6">
			            <button id="not_send_btn" type="button" class="btn btn-danger">Not Sent Yet!</button>
			        </div>
		        </div>
    		</div>
     	</div>
    </div>
</div>

<script type="text/javascript">
	var btc_price = {{ round($settings->token_price_bth,2) }};
	var etc_price = {{ round($settings->token_price_eth,2) }};
	var neo_price = {{ round($settings->token_price_neo,2) }};
	var discount_range1_start = {{ $settings->r1_start_bouns_amount }};
	var discount_range2_start = {{ $settings->r2_start_bouns_amount }};
	var discount_range1_end = {{ $settings->r1_end_bouns_amount }};
	var discount_range2_end = {{ $settings->r2_end_bouns_amount }};
	var user_neo_address = '{{ $user_neo_address }}';
	var user_eth_address = '{{ $user_eth_address }}';
	var user_btc_address = '{{ $user_btc_address }}';
	var round = {{ $round }};
	var bonus_rate1 = {{ $bonus_rate1 }};
	var bonus_rate2 = {{ $bonus_rate2 }};
	var bonus_rate=0;
	console.log(bonus_rate1);
	console.log(bonus_rate2);
	$(document).ready(function(){

		var amount = $(".currency_amount").val();
		var selected_currency = $(".selected_currency").val();

		if(amount<=discount_range1_end){
			bonus_rate = bonus_rate1;
		}else{
			bonus_rate = bonus_rate2;
		}
		if(selected_currency=="BTC"){
			$("#token_amount").val(amount*btc_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
		}else if(selected_currency=="ETH"){
			$("#token_amount").val(amount*etc_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
		}else if(selected_currency=="NEO"){
			$("#token_amount").val(amount*neo_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
		}
		$(".inner_selected_currency").html(user_neo_address);
		$(".selected_currency_show").html($(".selection_cover.active").attr('data-currency'));
	});

	$(".currency_amount").keyup(function(){
		var amount = $(this).val();
		var selected_currency = $(".selected_currency").val();
		if(amount<=discount_range1_end){
			bonus_rate = bonus_rate1;
		}else{
			bonus_rate = bonus_rate2;
		}
		if(selected_currency=="BTC"){
			$("#token_amount").val(amount*btc_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
		}else if(selected_currency=="ETH"){
			$("#token_amount").val(amount*etc_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
		}else if(selected_currency=="NEO"){
			$("#token_amount").val(amount*neo_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
		}
	});
	$(".selection_cover").click(function(){
		var amount=$("#currency").val();
		if(amount<=discount_range1_end){
			bonus_rate = bonus_rate1;
		}else{
			bonus_rate = bonus_rate2;
		}
		$(".selection_cover").removeClass('active');
		$(".selected_currency").val($(this).attr('data-currency'));
		$(".selected_currency_show").html($(this).attr('data-currency'));
		$(this).addClass('active');
		$(".currency_name").html($(this).attr('data-currency'));
		if($(this).attr('data-currency')=="BTC"){
			$("#token_amount").val(amount*btc_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
			$(".inner_selected_currency").html(user_btc_address);
			$(".monitor_address").val(user_btc_address);
			$(".send_currency_btn").text($(".send_currency_btn").attr('data-text')+" BTC");
		}else if($(this).attr('data-currency')=="ETH"){
			$("#token_amount").val(amount*etc_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
			$(".inner_selected_currency").html(user_eth_address);
			$(".monitor_address").val(user_eth_address);
			$(".send_currency_btn").text($(".send_currency_btn").attr('data-text')+" ETH");
		}else if($(this).attr('data-currency')=="NEO"){
			$("#token_amount").val(amount*neo_price);
			$(".bonus_amount_message").html((($("#token_amount").val()*bonus_rate)/100).toFixed(2));
			$(".inner_selected_currency").html(user_neo_address);
			$(".monitor_address").val(user_neo_address);
			$(".send_currency_btn").text($(".send_currency_btn").attr('data-text')+" NEO");
		}
	});

	$(".send_currency_btn").click(function(){
		$('#confirmation').modal('toggle');
	});

	$("#yes_send_btn").click(function() {
		$("#buy_token").submit();
		$('#confirmation').modal('toggle');
	});

	$("#not_send_btn").click(function() {
		$('#confirmation').modal('toggle');
	});
</script>
<script type="text/javascript">
<?php
if (count($current_tracker)) {
	?>

var start_time='<?php echo strtotime(date('Y-m-d H:i:s')); ?>';
var end_time='<?php echo strtotime($current_tracker->end_time); ?>';
var diff=end_time-start_time;
var count=diff; //3600
console.log(diff);
var counter=setInterval(timer, 1000); //1000 will  run it every 1 second

function timer()
{
  	count=count-1;
  	if (count <= 0)
   	{
    	clearInterval(counter);
    	return;
    }
	var count_mm = Math.floor(count/(60));
	var count_ss = count-(count_mm*(60));
	if (count_ss<=1){
		count_ss=59;
		count_mm=count_mm-1;
	}
	if(count_mm==0){
		clearInterval(counter);
	}
	$(".monitoring_ss").html(count_ss); // watch for spelling
	$(".monitoring_mm").html(count_mm);
}
<?php
}
?>
</script>

@endsection