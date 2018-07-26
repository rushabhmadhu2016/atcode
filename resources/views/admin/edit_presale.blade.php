@extends('admin.layouts.app')

@section('content')
<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">ICO Presale</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="{{ url('/adminDashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a class="active">ICO PreSale</a></li>
			</ul>
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">
		@include('admin.layouts.message_div')
			<div class="row">
				<div class="col-md-12">
					<form action="{{ url('update-presale')}}" method="post" name="pre-sale" id="pre-sale">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{ $pre_sale->id }}">
						<div class="panel panel-flat">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Start Date:</label>
											<input type="text" class="form-control start_time" value="{{ $pre_sale->start_time }}" name="start_time">
										</div>
										<div class="form-group">
											<label>End Date:</label>
											<input type="text" class="form-control end_time" name="end_time" value="{{ $pre_sale->end_time }}">
										</div>
										<div class="form-group">
											<label>Bonus for Range1 (<?php echo $settings->r1_start_bouns_amount; ?> to <?php echo $settings->r1_end_bouns_amount; ?>)</label>
											<input type="text" class="form-control" name="bonus" value="{{ $pre_sale->bonus }}">
										</div>
										<div class="form-group">
											<label>Bonus for Range2 (<?php echo $settings->r2_start_bouns_amount; ?> to <?php echo $settings->r2_end_bouns_amount; ?>)</label>
											<input type="text" class="form-control" name="bonus2" value="{{ $pre_sale->bonus2 }}">
										</div>
										<div class="text-right form-group">
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
	<script type="text/javascript">
		$(document).ready(function(){
			$('.start_time').datepicker({
				dateFormat: 'yy-mm-dd',
				changeYear: true,
				changeMonth: true,
			});

			$('.end_time').datepicker({
				dateFormat: 'yy-mm-dd',
				changeYear: true,
				changeMonth: true ,
			});
		});

		$(document).on("focusin", ".start_time", function() {
	        $(this).prop('readonly', true);
	    });

		$(document).on("focusin", ".end_time", function() {
	        $(this).prop('readonly', true);
	    });

	    $(document).on("focusout", ".start_time", function() {
	        $(this).prop('readonly', false);
	    });

	    $(document).on("focusout", ".end_time", function() {
	        $(this).prop('readonly', false);
	    });
	</script>
@endsection