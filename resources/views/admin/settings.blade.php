@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">ICO Settings</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">ICO Settings</a></li>
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
					<form action="{{ url('settings')}}" method="post">
					{{ csrf_field() }}
						<div class="panel panel-flat">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<div class="form-group">
											<label>Website Title:</label>
											<input type="text" class="form-control" value="{{ $settings->title }}" name="title">
										</div>

										<div class="form-group">
											<label>AVR Tokens as per 1 NEO:</label>
											<input type="text" class="form-control" name="token_price_neo" value="{{ $settings->token_price_neo }}">
										</div>

										<div class="form-group hidden-xs hidden-sm hidden-md hidden-lg">
											<label>AVR Tokens as per 1 BTC: (Auto Calculate)</label>
											<input type="text" class="form-control" name="token_price_bth" value="{{ $settings->token_price_bth }}">
										</div>

										<div class="form-group hidden-xs hidden-sm hidden-md hidden-lg">
											<label>AVR Tokens as per 1 ETH: (Auto Calculate)</label>
											<input type="text" class="form-control" name="token_price_eth" value="{{ $settings->token_price_eth }}">
										</div>

										<div class="form-group">
											<label>Avtar Admin Email</label>
											<input type="text" name="admin_email" class="form-control" value="{{ $settings->admin_email }}">
										</div>

										<div class="form-group">
											<label>Developer Email</label>
											<input type="text" name="developer_email" class="form-control" value="{{ $settings->developer_email }}">
										</div>

										<div class="form-group">
											<label>Referral Discount (In Percentage)</label>
											<input type="text" name="referral_bouns_amount" class="form-control" value="{{ $settings->referral_bouns_amount }}">
										</div>
									</div>
									<div class="col-md-10 col-md-offset-1">
										<div class="col-md-6">
											<div class="form-group">
												<label>Discount Range 1 (NEO Amount) </label>
												<input type="text" name="r1_start_bouns_amount" class="form-control" value="{{ $settings->r1_start_bouns_amount }}" class="only_numbers range_texts"> To
												<input type="text" name="r1_end_bouns_amount" class="form-control" value="{{ $settings->r1_end_bouns_amount }}" class="only_numbers range_texts">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Discount Range 2 (NEO Amount) </label>
												<input type="text" name="r2_start_bouns_amount" class="form-control" value="{{ $settings->r2_start_bouns_amount }}" class="only_numbers range_texts"> To
												<input type="text" name="r2_end_bouns_amount" class="form-control" value="{{ $settings->r2_end_bouns_amount }}" class="only_numbers range_texts">
											</div>
										</div>
									</div>
									<div class="col-md-10 col-md-offset-1">
										<div class="text-right">
											<button type="submit" class="btn btn-primary">Update Settings <i class="icon-arrow-right14 position-right"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
			</div>
		</div>
		<!-- /default ordering -->
		@include('admin.layouts.footer')
	</div>
	<!-- /content area -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#users_list').DataTable();
			$(".userstatus").click(function(){
				var id=$(this).attr('data-id');
				var status=$(this).attr('data-status');
				window.location='manage_user_status?id='+id+'&status='+status;
			})
		});
	</script>
@endsection