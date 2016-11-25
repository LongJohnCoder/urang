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
		height: 270px !important;
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
	    margin-top: -28px !important;
	}
	tr {
		background: #DCDCDC;
	}
	#show_my_calender:hover {
		cursor: pointer;
	}
	#show_my_calender:active {
		cursor: pointer;
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
	                    <p style="display: inline;"><div id="show_my_calender"><i class="fa fa-calendar" aria-hidden="true"></i></div> Manage Request Numbers</p>
	                    <button type="button" class="btn btn-primary btn-xs custom-xs-btn" id="time_set_btn" data-toggle="modal" data-target="#myModal">Setup Time</button>
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <table class="table table-bordered table-striped">
		                            <thead>
				                        <tr>
				                           <th>Day</th>
				                           <th>Opening Time</th>
				                           <th>Closing Time</th>
				                           <th>Pickup Start Time</th>
				                           <th>Pickup End Time</th>
				                           <th>Status</th>
				                           <th>Action</th>
				                        </tr>
				                     </thead>

		                            <tbody>
		                            	@if(count($pick_up_schedule) > 0)
		                            		@foreach($pick_up_schedule as $times)
		                            			<tr>
		                            				<td>{{isset($times) && $times!=null ? App\Helper\SiteHelper::getWeekDays($times->day) : "No Data"}}</td>
		                            				<td>{{isset($times) && $times!=null ? $times->opening_time: "No Data"}}</td>
		                            				<td>{{isset($times) && $times!=null ? $times->closing_time: "No Data"}}</td>
		                            				<td>{{isset($times) && $times!=null ? $times->pickup_start: "No Data"}}</td>
		                            				<td>{{isset($times) && $times!=null ? $times->pickup_end: "No Data"}}</td>
		                            				<td>
		                            					@if(isset($times) && $times!=null)
		                            						@if($times->closedOrNot == 1)
		                            							<!--closed goes here-->
		                            							<button type="button" class="btn btn-warning btn-xs" onclick="changeStatus({{$times->id}});" id="btn_chng_status_{{$times->id}}">Mark as open</button>
		                            						@else
		                            							<button type="button" class="btn btn-danger btn-xs" onclick="changeStatus({{$times->id}});" id="btn_chng_status_{{$times->id}}">Mark as close</button>
		                            						@endif
		                            					@else
		                            						<p>No Data</p>
		                            					@endif
		                            				</td>
		                            				<td>
		                            					@if(isset($times) && $times!=null)
		                            						<button type="button" class="btn btn-warning btn-xs" onclick="editDateTime({{$times->id}});"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
		                            					@else
		                            						<p>No Data</p>
		                            					@endif
		                            				</td>
		                            			</tr>
		                            		@endforeach
		                            	@else
		                            		<tr>
		                            			<td>
		                            				No Data Set Yet... <a href="#">click here to set</a>
		                            			</td>
		                            		</tr>
		                            	@endif
		                            </tbody>
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
				if ($.trim(opening_time_val) && $.trim(closing_time_val)) {
					if(comPareTimes(opening_time_val, closing_time_val)){
						$('#pickup_start').removeAttr('disabled');
						$('#pickup_end').removeAttr('disabled');
					} else {
						$('#pickup_start').attr('disabled', 'true');
						$('#pickup_end').attr('disabled', 'true');
						$('#errorTimeOpen').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Start time always should be less than end time!</span>');
					}
				}
			});
			//opeing time check
			$('#opening_time').change(function(e) {
				e.preventDefault();
				$('#errorTimeOpen').html("");
				var opening_time_val = $(this).val()
				var closing_time_val = $('#closing_time').val();
				/*console.log(opening_time_val, closing_time_val);
				return;*/
				if ($.trim(opening_time_val) && $.trim(closing_time_val)) {
					if(comPareTimes(opening_time_val, closing_time_val)){
					$('#pickup_start').removeAttr('disabled');
					$('#pickup_end').removeAttr('disabled');
					} else {
						$('#pickup_start').attr('disabled', 'true');
						$('#pickup_end').attr('disabled', 'true');
						$('#errorTimeOpen').html('<span style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Start time always should be less than end time!</span>');
					}
				}
			});

			//pick up opeing time check
			$('#pickup_start').change(function(e) {
				e.preventDefault();
				$('#errorTimeOpenPickup').html("");
				var opening_time_val = $(this).val()
				var closing_time_val = $('#pickup_end').val();
				if ($.trim(opening_time_val) && $.trim(closing_time_val)) {
					if(comPareTimes(opening_time_val, closing_time_val)){
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
				}
			});
			//pick up closing time check
			$('#pickup_end').change(function(e) {
				e.preventDefault();
				$('#errorTimeOpenPickup').html("");
				var opening_time_val = $('#pickup_start').val()
				var closing_time_val = $(this).val();
				if ($.trim(opening_time_val) && $.trim(closing_time_val)) {
					if(comPareTimes(opening_time_val, closing_time_val)){
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
				}
			});
			//check pick up start with open and closing time
		});
		//compare times greater or not validation
		function comPareTimes(start_time, end_time) {
			if (start_time.indexOf('am') > 0 || start_time.indexOf('pm') > 0) {
				if (end_time.indexOf('am') > 0 || end_time.indexOf('pm') > 0) {
					var number_value_start_time = start_time.indexOf('am') > 0 ? start_time.split('am')[0] : start_time.split('pm')[0];
					var number_value_end_time = end_time.indexOf('am') > 0 ? end_time.split('am')[0] : end_time.split('pm')[0];
					//console.log(number_value_start_time, number_value_end_time);
					//return;
					if (number_value_start_time && number_value_end_time) {
						//hour min of start time
						var getHour_startTime = parseFloat(number_value_start_time.split(':')[0]);
						var getMin_startTime = parseFloat(number_value_start_time.split(':')[1]);
						//hour min of end time
						var getHour_endTime = parseFloat(number_value_end_time.split(':')[0]);
						var getMin_endTime = parseFloat(number_value_end_time.split(':')[1]);
						//console.log(getHour_startTime , getMin_startTime, getHour_endTime, getMin_endTime);
						//return;
						if (!isNaN(getHour_startTime) && !isNaN(getMin_startTime) && !isNaN(getHour_endTime) && !isNaN(getMin_endTime)) {
							var total_start_time_mins = start_time.indexOf('am') > 0 && getHour_startTime != 12 ? ((getHour_startTime*60)+(getMin_startTime)):(((getHour_startTime+12)*60)+(getMin_startTime));

							var total_end_time_mins = end_time.indexOf('am') > 0 &&  getHour_endTime != 12 ? ((getHour_endTime*60)+(getMin_endTime)):(((getHour_endTime+12)*60)+(getMin_endTime));

							//12 am start time
							if (start_time.indexOf('am') > 0 && getHour_startTime == 12) {
								//12 am is here
								total_start_time_mins = getMin_startTime;
							}
							//12 am end time
							if (end_time.indexOf('am') > 0 && getHour_endTime == 12) {
								//12 am is here
								total_end_time_mins = getMin_endTime;
							}
							//12 pm start time
							if (start_time.indexOf('pm') > 0 && getHour_startTime == 12) {
								//12 pm is here
								total_start_time_mins = ((getHour_startTime*60)+(getMin_startTime));
							}
							//12 pm end time
							if (end_time.indexOf('pm') > 0 && getHour_endTime == 12) {
								//12 pm is here
								total_end_time_mins = ((getHour_endTime*60)+(getMin_endTime));
							}
							
							//console.log(total_start_time_mins, total_end_time_mins);
							//return;
							//console.log()
							if (total_start_time_mins < total_end_time_mins) {
								return true;
							} else if (total_start_time_mins == total_end_time_mins) {
								return false;
							} else if (total_start_time_mins > total_end_time_mins) {
								return false;
							} else {
								return false;
							}
						} else {
							return false;
						}
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		function comparePickUpStart(start_time, end_time, pickup_time) {
			//checking before am or pm input is correct or not
			if (start_time.indexOf('am') > 0 || start_time.indexOf('pm') > 0) {
				if (end_time.indexOf('am') > 0 || end_time.indexOf('pm') > 0 ) {
					if (pickup_time.indexOf('am') > 0 || pickup_time.indexOf('pm') > 0) {
						//get the values before am and pm
						var number_value_start_time = start_time.indexOf('am') > 0 ? start_time.split('am')[0] : start_time.split('pm')[0];
						var number_value_end_time = end_time.indexOf('am') > 0 ? end_time.split('am')[0] : end_time.split('pm')[0];
						var number_value_pickup_time = pickup_time.indexOf('am') > 0 ? pickup_time.split('am')[0] : pickup_time.split('pm')[0];
						//get the hour and minutes
						if (number_value_start_time && number_value_end_time && number_value_pickup_time) {
							//hour min of start time
							var getHour_startTime = parseFloat(number_value_start_time.split(':')[0]);
							var getMin_startTime = parseFloat(number_value_start_time.split(':')[1]);
							//hour min of end time
							var getHour_endTime = parseFloat(number_value_end_time.split(':')[0]);
							var getMin_endTime = parseFloat(number_value_end_time.split(':')[1]);
							//hour min of pickup time
							var getHour_pickupTime = parseFloat(number_value_pickup_time.split(':')[0]);
							var getMin_pickupTime = parseFloat(number_value_pickup_time.split(':')[1]);
							//check every thing is no or some bad inputs
							if (!isNaN(getHour_startTime) && !isNaN(getMin_startTime) && !isNaN(getHour_endTime) && !isNaN(getMin_endTime) && !isNaN(getHour_pickupTime) && !isNaN(getMin_pickupTime)) {
								//start here
								var total_start_time_mins = start_time.indexOf('am') > 0 && getHour_startTime != 12 ? ((getHour_startTime*60)+(getMin_startTime)):(((getHour_startTime+12)*60)+(getMin_startTime));

								var total_end_time_mins = end_time.indexOf('am') > 0 &&  getHour_endTime != 12 ? ((getHour_endTime*60)+(getMin_endTime)):(((getHour_endTime+12)*60)+(getMin_endTime));

								var total_pickup_time_mins = pickup_time.indexOf('am') > 0 && getHour_pickupTime !=12 ? ((getHour_pickupTime*60)+(getMin_pickupTime)):(((getHour_pickupTime+12)*60)+(getMin_pickupTime));
								//console.log(total_start_time_mins, "||", total_end_time_mins, "||", total_pickup_time_mins);
								//12 am start time
								if (start_time.indexOf('am') > 0 && getHour_startTime == 12) {
									//12 am is here
									total_start_time_mins = getMin_startTime;
								}
								//12 am end time
								if (end_time.indexOf('am') > 0 && getHour_endTime == 12) {
									//12 am is here
									total_end_time_mins = getMin_endTime;
								}
								//12 am pick up time
								if (pickup_time.indexOf('am') > 0 && getHour_pickupTime == 12) {
									//12 am is here
									total_pickup_time_mins = getMin_pickupTime;
								}
								//12 pm start time
								if (start_time.indexOf('pm') > 0 && getHour_startTime == 12) {
									//12 pm is here
									total_start_time_mins = ((getHour_startTime*60)+(getMin_startTime));
								}
								//12 pm end time
								if (end_time.indexOf('pm') > 0 && getHour_endTime == 12) {
									//12 pm is here
									total_end_time_mins = ((getHour_endTime*60)+(getMin_endTime));
								}
								//12 pm pick up time
								if (pickup_time.indexOf('pm') > 0 && getHour_pickupTime == 12) {
									//12 pm is here
									total_pickup_time_mins = ((getHour_pickupTime*60)+(getMin_pickupTime));
								}
								if (total_start_time_mins <= total_pickup_time_mins && total_end_time_mins >= total_pickup_time_mins) {
									return true;
								} else {
									return false;
								}
							} else {
								return false;
							}
						} else {
							return false;
						}
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		function changeStatus(id) {
			var sure = confirm("Are You Sure ?");
			var status = $('#btn_chng_status_'+id).text() === 'Mark as close' ? 1 : 0;
			if (sure === true) {
				//console.log('ajax here');
				$.ajax({
					url:"{{route('updateManageReqNoStatus')}}",
					type: "POST",
					data: {id: id, status: status, _token: "{{Session::token()}}"}, 
					success: function(data) {
						/*console.log(data);
						return;*/
						if (data == 1) {
							location.reload();
						} else {
							sweetAlert("Oops!", "Could not update status"+" "+data, "error");
							return;
						}
					}
				})
			}
		}
	</script>
	@if(count($pick_up_schedule) > 0)
		<script type="text/javascript">
			function editDateTime(id) {
				<?php foreach ($pick_up_schedule as $key => $data_to_update): ?>
					if ('{{isset($data_to_update) && $data_to_update != null ? $data_to_update->id: ""}}' ==id) {
						//console.log('<?php echo $data_to_update?>');
						$('#myModal').modal('show');
						$('#opening_time').removeAttr('disabled');
						$('#closing_time').removeAttr('disabled');
						$('#pickup_start').removeAttr('disabled');
						$('#pickup_end').removeAttr('disabled');
						$('#btn_save_time').removeAttr('disabled');
						$('#day').val('day{{isset($data_to_update) && $data_to_update != null ? $data_to_update->day: ""}}');
						$('#opening_time').val('{{isset($data_to_update) && $data_to_update != null ? $data_to_update->opening_time: ""}}');
						$('#closing_time').val('{{isset($data_to_update) && $data_to_update != null ? $data_to_update->closing_time: ""}}');
						$('#pickup_start').val('{{isset($data_to_update) && $data_to_update != null ? $data_to_update->pickup_start: ""}}');
						$('#pickup_end').val('{{isset($data_to_update) && $data_to_update != null ? $data_to_update->pickup_end: ""}}');
					}
				<?php endforeach ?>
			}
		</script>
	@endif
	<script type="text/javascript">
		//date picker script
		$(function(){
			var date = new Date();
			var dateString = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear().toString();
			console.log(dateString);
			$('#show_my_calender').click(function(){
				var events = [ 
				    { Title: "Five K for charity", Date: new Date(dateString) }, 
				    { Title: "Dinner", Date: new Date() }, 
				    { Title: "Meeting with manager", Date: new Date() }
				];
				$("#show_my_calender").datepicker({
				    beforeShowDay: function(date) {
				        var result = [true, '', null];
				        var matching = $.grep(events, function(event) {
				            return event.Date.valueOf() === date.valueOf();
				        });
				        
				        if (matching.length) {
				            result = [true, 'highlight', null];
				        }
				        return result;
				    },
				    onSelect: function(dateText) {
				        var date,
			            selectedDate = new Date(dateText),
			            i = 0,
			            event = null;
				        
				        while (i < events.length && !event) {
				            date = events[i].Date;

				            if (selectedDate.valueOf() === date.valueOf()) {
				                event = events[i];
				            }
				            i++;
				        }
				        if (event) {
				            alert(event.Title);
				        }
				    }
				});
			});
		});
	</script>
@endsection