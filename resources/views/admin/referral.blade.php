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
	                        <table class="table">
	                            <thead>
	                                <tr>
	                                    <th>Referred By</th>
	                                    <th>Referred Person</th>
	                                    <th>Referred On</th>
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
		                            			<td>{{$ref->discount_status==1?"Active":"Deactive"}}</td>
		                            			<td>
		                            				@if($ref->discount_status==1)
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
</script>
@endsection