@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                
	                <!-- /.panel-heading -->
	                <div class="panel-body">
	                    <div class="table-responsive table-bordered">
	                    	<div style="background: transparent; display: none;" id="loaderBody" align="center">
								<p>Please wait...</p>
								<img src="{{url('/')}}/public/img/reload.gif">
							</div>
							<div class="col-md-12 col-sm-12 col-cs-12" style="border: 1px solid #DCDCDC;">
								<div class="col-md-7 col-sm-7 col-cs-7">
									<p style="font-size: 20px;margin-left: -23px;">User Referral ( Currently Set as : {{$getCurrentRefPercentage->percentage}} % )</p>
								</div>
								<div class="col-md-5 col-sm-5 col-cs-5">
									<button class="btn btn-danger btn-xs" type="button" style="float: right;margin-top: 1%;margin-right: 3%;" id="set_ref_per">Set Referral %</button>
								</div>
							</div>
							<hr>
	                        <table class="table">
	                            <thead>
	                                <tr>
	                                    <th>Referred By</th>
	                                    <th>Referred Person</th>
	                                    <th>Referred On</th>
	                                    <th>Offer Count</th>
	                                    <th>Status</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	@if(count($refs) > 0)
	                            		@foreach($refs as $ref)
		                            		<tr>
		                            			<td>{{$ref->referral_email==null?"No data found!":$ref->referral_email}}</td>
		                            			<td>{{$ref->referred_person}}</td>
		                            			<td>
		                            			{{$ref->created_at}}
		                            			
		                            			</td>
		                            			<td> 
		                            				<span id="discountCountValue{{$ref->id}}" class="btn btn-warning btn-xs">{{$ref->discount_count}}</span> 
		                            				<button id="change_discount_count" onclick="changeDiscountCount({{$ref->id}})" class="btn btn-xs" type="button"><i class="fa fa-pencil"></i></button>
		                            			</td>
		                            			<td>{{$ref->is_expired==0?"Active":"Deactive"}}</td>
		                            			<td>
		                            				@if($ref->is_expired==0)
		                            					<button id="change_ref_action" onclick="deactiveReferral({{$ref->id}})" class="btn btn-primary btn-xs" type="button">Make Deactive</button>
		                            				@else
		                            					<button id="change_ref_action" onclick="activeReferral({{$ref->id}})" class="btn btn-primary btn-xs" type="button">Make Active</button>
		                            				@endif
		                            			</td>
		                            		</tr>
		                            	@endforeach
	                            	@else
	                            		<tr>
	                            			<td>No Data</td>
	                            		</tr>
	                            	@endif
	                            </tbody>
	                        </table>
	                        <span style="float: right;">{!!$refs->render()!!}</span>
	                    </div>
	                    <!-- /.table-responsive -->
	                </div>
	                <!-- /.panel-body -->
	            </div>
	            <!-- /.panel -->
	        </div>
	        <!-- /.col-lg-6 -->
	    </div>
</div>

<script type="text/javascript">
	var baseUrl = "{{url('/')}}";
	function deactiveReferral(id)
	{
		
		swal({   
				title: "Are you sure?",   
				text: "By deactivation this the referred user will not be able to avail his/her discount!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Yes, Deactivate it!",   
				closeOnConfirm: false }, 
				function(){
					$.ajax({
							url: baseUrl+"/deactivate-referral-user",
							type: "POST",
							data: {id: id, _token: '{!!csrf_token()!!}'},
							success: function(data) {
								if(data==1)
								{
									location.reload();
								}
								else
								{
									swal("Sorry!", data, "error");
								}
							}
						});
				});
	}
	function activeReferral(id)
	{
		
		swal({   
				title: "Are you sure?",   
				text: "By deactivation this the referred user will not be able to avail his/her discount!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Yes, Activate it!",   
				closeOnConfirm: false }, 
				function(){
					$.ajax({
							url: baseUrl+"/activate-referral-user",
							type: "POST",
							data: {id: id, _token: '{!!csrf_token()!!}'},
							success: function(data) {
								if(data==1)
								{
									location.reload();
								}
								else
								{
									swal("Sorry!", data, "error");
								}
							}
						});
				});
	}
	function changeDiscountCount(rowid)
	{
		

				swal({
				  title: "Enter Number",
				  text: "Enter the new count number here.",
				  type: "input",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  animation: "slide-from-top",
				  inputPlaceholder: "Enter the new count",
				  showLoaderOnConfirm: true
				},
				function(inputValue){
				  if (inputValue === false) return false;
				  
				  if (inputValue === "") {
				    swal.showInputError("The count cannot be empty!");
				    return false;
				  }
				  if(isNaN(inputValue))
				  {
				  	swal.showInputError("Count have to be a number!");
				    return false;
				  }
				  $.ajax({
							url: baseUrl+"/change-ref-offer-count",
							type: "POST",
							data: {id: rowid, value: inputValue, _token: '{!!csrf_token()!!}'},
							success: function(data) {
								if(data==1)
								{
									location.reload();
								}
								else
								{
									swal("Sorry!", data, "error");
								}
							}
						});
				  //swal("Nice!", "You wrote: " + inputValue, "success");
				});
	}
	$(function(){
		$('#set_ref_per').click(function(){
			swal({
				  title: "Enter Percentage",
				  text: "Enter the referral percentage",
				  type: "input",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  animation: "slide-from-top",
				  inputPlaceholder: "Set referral percentage",
				  showLoaderOnConfirm: true
				},
				function(inputValue){
				  if (inputValue === false) return false;
				  
				  if (inputValue === "") {
				    swal.showInputError("The count cannot be empty!");
				    return false;
				  }
				  if (isNaN(inputValue)) {
				  	swal.showInputError("Percentage should be a number!");
				    return false;
				  }
				  if (inputValue%1 == 0 || inputValue%1 != 0) {
				  	$.ajax({
							url: "{{route('postSavePercentageRef')}}",
							type: "POST",
							data: {percentage: inputValue, _token: '{!!csrf_token()!!}'},
							success: function(data) {
								console.log(data);
								if (data == 1) {
									location.reload();
								} else {
									swal.showInputError("Some Error occured please try again later!");
									console.log("Developer Hint:" + " " + data);
				    				return false;
								}
							}
					});
				  }
				  
				});
		});
	});
</script>
@endsection