@extends('admin.layouts.master')
@section('content')
<style type="text/css">
	form button {
		border-radius: 0px !important;
		background: #4d90fe !important;
		border: 1px solid #3079ed !important;
		/*font-weight: bold !important;*/
		box-shadow: inset 0 0 0 0 #4d90fe;
		-webkit-transition: all ease 0.8s !important;
		-moz-transition: all ease 0.8s !important;
		transition: all ease 0.8s !important;
	}
	form button:hover {
		
		background: #2B60DE !important;
	}
	form button:active {
		box-shadow: inset 0 0 0 200px #4d90fe !important;
	}
	form select {
	    width: 93% !important;
	    margin-left: 31px !important;
	}
	.modal-body {
		height: 262px !important;
	}
	.modal-content {
		border-radius: 0px !important;
	}
	.modal-header {
	    background: #2B60DE;
	    text-align: center;
	    color: #fff;
	    font-weight: bold;
	}
	.modal-header button {
		color: whitesmoke !important;
	}
	#time_set_btn {
		float: right !important;
	    border-radius: 0px !important;
	    width: 100px !important;
	    font-weight: bold !important;
	}
</style>
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	        	@if(Session::has('success'))
	        		<div class="alert alert-success">
	        			<i class="fa fa-check" aria-hidden="true"></i>
	        			<strong>Success!</strong> {{Session::get('success')}}
	        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        		</div>
	        	@else
	        	@endif

	        	@if(Session::has('error'))
	        		<div class="alert alert-danger">
	        			<i class="fa fa-warning" aria-hidden="true"></i>
	        			<strong>Error!</strong> {{Session::get('error')}}
	        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        		</div>
	        	@else
	        	@endif
	            <h1 class="page-header">Pickup Request Manager</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Manage Request Numbers
	                    <button type="button" class="btn btn-primary btn-xs custom-xs-btn" id="time_set_btn" data-toggle="modal" data-target="#myModal">Setup Time</button>
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <table class="table table-bordered">
	                            	<tr>
	                            		<td>
	                            			table here
	                            		</td>
	                            		
	                            	</tr>
	                            </table>
	                            <!-- Modal -->
								<div id="myModal" class="modal fade" role="dialog">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
										  <div class="modal-header">
										    <button type="button" class="close" data-dismiss="modal">&times;</button>
										    <h4 class="modal-title"><i class="fa fa-cogs" aria-hidden="true"></i> Pickup Request Manager</h4>
										  </div>
										  <div class="modal-body">
										    <form role="form" action="{{route('postSetTime')}}" method="POST">
												<div class="form-group">
													<select name="day" id="day" required="true" class="form-control">
														<option value="">Select Weekday</option>
														<option value="day1" id="day1">Monday</option>
														<option value="day2" id="day2">Tuesday</option>
														<option value="day3" id="day3">Wednesday</option>
														<option value="day4" id="day4">Thursday</option>
														<option value="day5" id="day5">Friday</option>
														<option value="day6" id="day6">Saturday</option>
														<option value="day7" id="day7">Sunday</option>
													</select>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1%;">
													<div class="col-md-6 col-sm-6 col-xs-6">
														<label for="opening_time">Opening Time</label>
														<input type="text" name="opening_time" id="opening_time" class="form-control" required="true" placeholder="Opening time" disabled="true"></input>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-6">
														<label for="closing_time">Closing Time</label>
														<input type="text" name="closing_time" id="closing_time" class="form-control" required="true" placeholder="Closing time" disabled="true"></input>
													</div>
													<div id="errorTimeOpen" class="col-md-12" style="text-align: center;"></div>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1%;">
													<div class="col-md-6 col-sm-6 col-xs-6">
														<label for="pickup_start">Pickup Start Time</label>
														<input type="text" name="pickup_start" id="pickup_start" class="form-control" required="true" placeholder="Pickup start time" disabled="true"></input>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-6">
														<label for="pickup_end">Pickup End Time</label>
														<input type="text" name="pickup_end" id="pickup_end" class="form-control" required="true" placeholder="Pickup end time" disabled="true"></input>
													</div>
													<div id="errorTimeOpenPickup" class="col-md-12" style="text-align: center;"></div>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1%;">
													<div class="col-md-4 col-sm-4 col-xs-4"></div>
													<div class="col-md-4 col-sm-4 col-xs-4">
														<button type="submit" class="btn btn-info btn-lg btn-block" id="btn_save_time" disabled="true">save</button>
														<input type="hidden" name="_token" value="{{Session::token()}}"></input>
													</div>
													<div class="col-md-4 col-sm-4 col-xs-4"></div>
												</div>
											</form>
										  </div>
										</div>
									</div>
		                        </div>
	                    </div>
	                    <!-- /.row (nested) -->
	                </div>
	                <!-- /.panel-body -->
	            </div>
	            <!-- /.panel -->
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	</div>
	<script type="text/javascript">
		$(function(){
			//setting up time picker
			$('#opening_time').timepicker({'step': 1});
			$('#closing_time').timepicker({'step': 1});
			$('#pickup_start').timepicker({'step': 1});
			$('#pickup_end').timepicker({'step': 1});

			//==========================================
			//validation opeing inputs
			$('#day').on('change', function(e){
				e.preventDefault();
				if ($.trim($(this).val())) {
					/*$('#btn_save_time').removeAttr('disabled');*/
					$('#opening_time').removeAttr('disabled');
					$('#closing_time').removeAttr('disabled');
				} else {
					$('#opening_time').attr('disabled', 'true');
					$('#closing_time').attr('disabled', 'true');
				}
			});

			//clsong time check
			$('#closing_time').change(function(e) {
				e.preventDefault();
				$('#errorTimeOpen').html("");
				var opening_time_val = $('#opening_time').val()
				var closing_time_val = $(this).val();
				/*console.log(opening_time_val+""+closing_time_val);
				
				console.log(comPareTimes(opening_time_val, closing_time_val));
				return;*/
				if(comPareTimes(opening_time_val, closing_time_val)){
					$('#pickup_start').removeAttr('disabled');
					$('#pickup_end').removeAttr('disabled');
				} else {
					$('#pickup_start').attr('disabled', 'true');
					$('#pickup_end').attr('disabled', 'true');
					$('#errorTimeOpen').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Start time always should be less than end time!</span>');
				}
			});
			//opeing time check
			$('#opening_time').change(function(e) {
				e.preventDefault();
				$('#errorTimeOpen').html("");
				var opening_time_val = $(this).val()
				var closing_time_val = $('#closing_time').val();
				//console.log(opening_time_val+""+closing_time_val);
				//return;
				if(comPareTimes(opening_time_val, closing_time_val)){
					$('#pickup_start').removeAttr('disabled');
					$('#pickup_end').removeAttr('disabled');
				} else {
					$('#pickup_start').attr('disabled', 'true');
					$('#pickup_end').attr('disabled', 'true');
					$('#errorTimeOpen').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Start time always should be less than end time!</span>');
				}
			});
			//pick up opeing time check
			$('#pickup_start').change(function(e) {
				e.preventDefault();
				$('#errorTimeOpenPickup').html("");
				var opening_time_val = $(this).val()
				var closing_time_val = $('#pickup_end').val();
				if(comPareTimes(opening_time_val, closing_time_val)){
					$('#btn_save_time').removeAttr('disabled');
					//console.log("imopen");
					//check with opeing and closing time
					if (!comparePickUpStart($('#opening_time').val(),$('#closing_time').val(),$(this).val())) {
						$('#btn_save_time').attr('disabled', 'true');
						$('#errorTimeOpenPickup').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pickup start time always should be in between opeing time and closing time & less than pickup close time!</span>');
					} else {
						$('#btn_save_time').removeAttr('disabled');
						$('#errorTimeOpenPickup').html("");
					}
				} else {
					$('#btn_save_time').attr('disabled', 'true');
					$('#errorTimeOpenPickup').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Start time always should be less than end time!</span>');
				}
			});
			//pick up closing time check
			$('#pickup_end').change(function(e) {
				e.preventDefault();
				$('#errorTimeOpenPickup').html("");
				var opening_time_val = $('#pickup_start').val()
				var closing_time_val = $(this).val();
				if(comPareTimes(opening_time_val, closing_time_val)){
					$('#btn_save_time').removeAttr('disabled');
					//console.log("im");
					//check with opeing and closing time
					if (!comparePickUpStart($('#opening_time').val(),$('#closing_time').val(),$(this).val())) {
						$('#btn_save_time').attr('disabled', 'true');
						$('#errorTimeOpenPickup').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pickup end time always should be in between opeing time and closing time & greater than pickup opening time!</span>');
					} else {
						$('#btn_save_time').removeAttr('disabled');
						$('#errorTimeOpenPickup').html("");
					}
				} else {
					$('#btn_save_time').attr('disabled', 'true');
					$('#errorTimeOpenPickup').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Start time always should be less than end time!</span>');
				}
			});
			//check pick up start with open and closing time
		});
		//compare times greater or not validation
		function comPareTimes(start_time, end_time) {
			if (start_time >= end_time) {
				return false;
			} else if(start_time < end_time) {
				return true;
			} else {
				return false;
			}
		}
		function comparePickUpStart(start_time, end_time, pickup_start_time) {
			if (pickup_start_time >= start_time && pickup_start_time <= end_time) {
				return true;
			} else {
				return false;
			}
		}
	</script>
@endsection