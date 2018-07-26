@extends('user.layouts.app')

@section('content')
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> My Token</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		@include('user.layouts.message_div')
		<div class="row">
			<div class="col-md-12 mytoken-div">
				<?php
$balance = Auth::user()->token_balance;
$bonus = Auth::user()->bouns_token_balance;
$total_balance = $balance + $bonus;
?>
				<h1>{{ $total_balance }}</h1>
			</div>
			<div class="col-md-12 user-transaction-div">
			<section id="faq">
 			    <div class="container">
        			<div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               				<div class="section-content">
			                    <div class="row">
			                        <div class="col-md-12 col-sm-12 col-xs-12">
			                            <ul class="nav nav-pills faq-pills">
			                                <li class="active"><a data-toggle="tab" href="#general">Deposits</a></li>
			                                <li><a data-toggle="tab" href="#presale">Withdraws</a></li>
			                            </ul>
			                        </div>
			                        <div class="tab-content">
			                            <div id="general" class="tab-pane fade in active">
			                                <div class="col-md-6 col-sm-12 col-xs-12">
			                                    <ul>
					@foreach($transactions as $transaction)
						<li> {{ $transaction->token_to_allocate }} AVR Purchased on {{ date('d-M-Y', strtotime($transaction->created_at)) }} </li>
					@endforeach
				</ul>
			                                </div>
			                            </div>
			                            <div id="presale" class="tab-pane fade">
			                              <div class="col-md-6 col-sm-12 col-xs-12">
			                                    <h4 class="color-blue"> KYC Status : <?php echo (Auth::user()->kyc_status) ? "verified" : "Unverified"; ?></h4>
			                                    <p class="text-justify">
			<?php
if (Auth::user()->kyc_status == 1) {
	echo "Withdrawal Done";
} else {
	echo "Please get KYC verified to withdraw token.";
}
?>
			                                    </p>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</section>

			</div>
		</div>
	</div>
</div>
<!-- Content area -->
<div class="content">
</div>
@endsection