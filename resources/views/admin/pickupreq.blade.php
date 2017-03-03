@extends('admin.layouts.master')
@section('content')
<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-heading">
				@if(Session::has('fail'))
                		<div class="alert alert-danger">{{Session::get('fail')}}
                			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                		</div>
                	@else
                	@endif
                	@if(Session::has('success'))
                		<div class="alert alert-success">	                             	{{Session::get('success')}}
                			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                		</div>
                	@else
                	@endif
		         	<h1>Schedule Pick Up</h1>
		        </div>
		        <div class="panel-body">
		        	<div class="row">
		                <div class="col-lg-12">
		                	<form role="form" action="{{route('postPickUpReq')}}" method="post">
								<div class="form-group">
								    <label>Select a Customer</label>
								    <select name="user_id" class="form-control" required="" id="cus_email">
								    	@if(count($users) > 0)
								    		<option value="">Select a customer</option>
									    	@foreach($users as $user)
									    		<option value="{{$user->id}}">{{$user->email}}</option>
									    	@endforeach
									    @else
									    	<option value="">No Customer</option>
								    	@endif
								    </select>
								</div>
								<div class="form-group">
								    <label>Customer Address Line 1</label>
								    <textarea class="form-control" name="address" id="user_add" required=""></textarea>
								</div>
								<div class="form-group">
				                	<label for="address_line_2">Customer Address Line 2 (optional)</label>
				                	<textarea class="form-control" name="address_line_2" id="address_line_2"></textarea>
				              	</div>
					            <div class="form-group">
					            	<label for="apt_no">Apartment Number (if any optional)</label>
					                <input type="text" name="apt_no" id="apt_no" placeholder="eg. 33b" class="form-control"></input>
					            </div>
					            <!--city-->
								<div class="form-group">
								    <label>City</label>
								    <input type="text" name="city" id="city" required="true" placeholder="city" class="form-control"></input>
                      				<div id="errorInputCity" style="color: red;"></div>
								</div>
								<!--state-->
								<div class="form-group">
								    <label>State</label>
								    <input type="text" class="form-control" name="state" id="state" required="true" placeholder="state"></input>
                      				<div id="errorInputState" style="color: red;"></div>
								</div>
								<!--zip-->
								<div class="form-group">
								    <label>Zip</label>
								    <input type="text" class="form-control" name="zip" id="zip" required="true" placeholder="Zip Code"></input>
                      				<div id="errorInputZip" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label>Personal Phone Number</label>
								    <input class="form-control" placeholder="Format: 123-456-7890" name="personal_ph" id="Phone" type="text">
								    <div id="errorInputPhone" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label for="name">Cell Phone Number (optional)</label>
								    <input class="form-control" name="cellph_no" id="cellphone" placeholder="Format: 123-456-7890">
								    <div id="errorInputCellPhone" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label for="name">Office Phone Number (optional)</label>
								    <input class="form-control" name="officeph_no" id="officephone" type="text" placeholder="Format: 123-456-7890" >
								    <div id="errorInputOfficePhone" style="color: red;"></div>
								</div>
								<div class="form-group">
								    <label>Pick up date</label>
								    <input class="form-control" name="pick_up_date" type="text" required="" id='datepicker'>
								</div>
								<div class="form-group">
								    <label for="schedule">Schedule</label>
								    <br>
								    <label>
								    	<input type="radio" name="schedule" id="inlineRadio1" value="For the time specified only"> For the time specified only.
								    </label>
								    <br>
								  	<label>
								  		<input type="radio" name="schedule" id="inlineRadio2" value="Daily at this time except weekends"> Daily at this time except weekends.
								  	</label>	
					                 <label>
					                 	<input type="radio" name="schedule" id="inlineRadio3" value="Daily at this time including weekends">  Daily at this time including weekends.	
					                 </label>
					                 <br>
					                 <label>
					                 	<input type="radio" name="schedule" id="inlineRadio4" value="Weekly on this day of the week">  Weekly on this day of the week.
					                </label>
					                <label>
					                  <input type="radio" name="schedule" id="inlineRadio5" value="Monthly on this day of the month">  Monthly on this day of the month.
					                </label>
								</div>
								<div class="form-group">
								    <label>How Would You Like Your Shirts</label>
						              <div class="checkbox">
						                <label>
						                  <input type="radio" name="boxed_or_hung" value="Boxed" id="boxed"> Boxed
						              </label>
						              </div>
						              <div class="checkbox">
						                <label>
						                  <input type="radio" name="boxed_or_hung" value="Hung" id="hung"> Hung
						                </label>
								</div>
								<div class="form-group">
									<label id="str_typ" style="display: none;">Strach type:</label>
				                  <select name="strach_type" class="form-control" id="strach_type" style="display: none;">
					                <option value="No">No Starch</option>
					                <option value="Very_light_starch">Very Light Starch</option>
					                <option value="Light_starch">Light Starch</option>
					                <option value="Medium_starch">Medium Starch</option>
					                <option value="Heavy_starch">Heavy Starch</option>
					              </select>
								</div>
								<div class="form-group">
								    <label>Doorman</label>
					              	<select name="doorman" class="form-control" id="doorman">
						                <option value="1">Yes</option>
						                <option value="0">No</option>
					              	</select>
								</div>
								<div class="form-group" id="time_frame" style="display: none;">
					              <label for="time_frame">Give Us a Time Frame</label>
					              <div class="row">
						              <div class="col-md-5 col-sm-5">
						              	<input type="text" name="time_frame_start" id="time_frame_start" class="form-control" placeholder="Start time">
						              </div>
						              <div class="col-md-1 col-sm-1" style="text-align: center;"> To </div>
						              <div class="col-md-5 col-sm-5">
						              	<input type="text" name="time_frame_end" id="time_frame_end" class="form-control" placeholder="End time">
						              </div>
					              </div>
					              <div style="color: red;" id="errorTime"></div>
					            </div>
								<div class="form-group">
              						<input type="checkbox" name="wash_n_fold" id="wash_n_fold"> Wash and fold ? (<span style="color: red;">make sure you put your wash and fold cloths in seperate bag</span>)</input>
            					</div>
								<div class="form-group">
									 <label>
                    					<input type="checkbox" name="urang_bag" id="urang_bag"> Please click this box if you need U-Rang bag.
                  					</label>
								</div>
								<div class="form-group">
					                <label>Special Instructions</label>
					                <textarea class="form-control" rows="3" name="spcl_ins" id="spcl_ins"></textarea>
					            </div>
					            <div class="form-group">
					                <label>Driving Instructions</label>
					                <textarea class="form-control" rows="3" name="driving_ins" id="driving_ins"></textarea>
					            </div>
					             <div class="form-group">
					              <label>Select Payment Method</label><br>
					                <label>
					                  <input type="radio" name="pay_method" id="inlineRadio6" value="1" required="" checked> Charge my credit card this time for amount $ 
					                </label><br>
					                <!-- <label>
					                  <input type="radio" name="pay_method" id="inlineRadio8" value="2"> COD
					                </label><br> -->
					                <label>
					                  <input type="radio" name="pay_method" id="inlineRadio9" value="3"> Check
					                </label>
					            </div>
					            <div class="form-group">
					                <select id="order_type" name="order_type" id="order_type"required="" class="form-control">
					                  <option value="">Type of order</option>
					                  <option value="1">Fast Pickup</option>
					                  <option value="0">Detailed Pickup</option>
					                </select>
					            </div>
					            <!-- <div class="form-group">
					              <label for="wash_n_fold">Wash and fold?</label>
					              <select name="wash_n_fold" id="wash_n_fold" required="" class="form-control">
					                <option value="1">Yes</option>
					                <option value="0">No</option>
					              </select>
					            </div> -->
					            <!-- <div class="form-group">
					              <label for="client_type">What type of client you are ?</label>
					              <select name="client_type" id="client_type" required="" class="form-control">
					                <option value="">Client Type</option>
					                <option value="new_client">New Client</option>
					                <option value="key_client">Key Client</option>
					                <option value="corporate_client">Corporate Client</option>
					                <option value="reff">Referral</option>
					              </select>
					            </div> -->
					            <div class="form-group">					                
					            	<label>Is it a emergency service ? <p style="color: red;">$7 extra</p></label>
					                <input type="checkbox" name="isEmergency" id="isEmergency"></input>
					            </div>
					            <div class="form-group">
					               <label>Do you have a coupon code ?<p style="color: red;">Please leave the field blank if you dont have any.</p></label>
					              	<input type="text" name="coupon" id="coupon" class="form-control" />
					              	<div id="validity"></div>
					            </div>
					            <div class="form-group">
					            	<label>Donate to a school in your neighborhood ?</label>
                  					<input onclick="openCheckBoxSchool()" id="school_checkbox" type="checkbox" name="isDonate"></input>
              					</div>
              					<div class="form-group">
				                <span>
				                  <select name="school_donation_id" id="schoolNameDropDown" class="form-control">
				                    <option value="">Select School</option>
				                    @foreach($school_list as $school)
				                    <option value="{{$school->id}}">{{$school->school_name}}</option>
				                    @endforeach
				                  </select>
				                </span>
				              </div>

				              <div class="form-group">
				                <label for="name">Refer Someone?(Optional)</label>


				                <input type="email" placeholder="Enter email here" class="form-control" id="emailReferal" name="emailReferal" onkeyup="return IsValidReferalEmail();">
				                <input type="hidden" name="email_checker_referal" id="email_checker_referal" value="0">
				                      <div id="emailExist"></div>
				                      <div id="errorInputEmail" style="color: red;">
				                      </div>
				                <p style="color: red;font-weight: bold;">You will become eligible for a discount when the person you recommended signs up at U-Rang.Com and places their first order. If your submission is presently a client, you will not qualify for a discount.</p>
				              </div>


              					<button type="submit" class="btn btn-primary btn-lg btn-block" id="schedule_pick_up">Schedule Pick up</button>
								<input type="hidden" name="_token" value="{{Session::token()}}"></input>
								<input type="hidden" name="identifier" value="admin"></input>
								<div id="myModal" class="modal fade" role="dialog">
						        <div class="modal-dialog">
						          <!-- Modal content-->
						          <div class="modal-content">
						            <div class="modal-header">
						              <button type="button" class="close" data-dismiss="modal">&times;</button>
						              <h2>Select items you want</h2>
						            </div>
						            <div class="modal-body">
						              <table class = "table table-striped">
						                <thead>
						                  <tr>
						                    <th>No of Items</th>
						                    <th>Item Name</th>
						                    <th>Item Price</th>
						                    <!-- <th>Action</th> -->
						                  </tr>
						                </thead>
						                <tbody> 
						              @if(count($price_list) > 0)
						                @foreach($price_list as $list)
						                  <tr>
						                    <td>
						                      <select name="number_of_item" id="number_{{$list->id}}" onchange="return addListItems('{{$list->id}}');">
						                        @for($i=0; $i<=10; $i++)
						                          <option value="{{$i}}">{{$i}}</option>
						                        @endfor
						                      </select>
						                    </td>
						                    <td id="item_{{$list->id}}">{{$list->item}}</td>
						                    <td id="price_{{$list->id}}">{{$list->price}}</td>
						                    <!-- <td><button type="button" class="btn btn-primary btn-xs" onclick="add_id({{$list->id}})" id="btn_{{$list->id}}">Add</button></td> -->
						                  </tr>
						                @endforeach
						              @else
						                <tr><td>No Data</td></tr>
						              @endif
						                </tbody>
						              </table>
						            </div>
						            <div class="modal-footer">
						              <button type="button" class="btn btn-default" id="modal-close">Save Changes</button>
						            </div>
						          </div>

						        </div>
						      </div>
						      <input type="hidden" name="list_items_json" id="list_items_json"></input>
		                	</form>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		var start_time = '';
    	var end_time = '';
		$('#doorman').on('change', function(){
	      var value = $(this).val();
	      //console.log(value);
	      if (value == 0) {
	        //sweetAlert("now")
	        $('#time_frame').show();
	        $('#time_frame_start').timepicker({'step': 30});
	        $('#time_frame_start').timepicker('option', { 'timeFormat': 'h:i A' });
	        $('#time_frame_end').timepicker({'step': 30});
	        $('#time_frame_end').timepicker('option', { 'maxTime': '11:59pm' , 'timeFormat': 'h:i A' });
	      } else {
	        $('#time_frame').hide();
	      }
	    });
	    $('#time_frame_start').change(function(){
	        start_time = $('#time_frame_start').val();
	        $('#time_frame_end').timepicker('option', { 'minTime': start_time, 'maxTime': '11:59pm' , 'timeFormat': 'h:i A' });
	        checkTime();
	        //console.log(start_time);
	    });
	    $('#time_frame_end').change(function(){
	       end_time = $('#time_frame_end').val();
	       checkTime();
	    });
		$('#order_type').change(function(){
			var value_type = $('#order_type').val();
	      	if (value_type!="") {
		        if (value_type == 0) 
		        {
		          $('#myModal').modal('show');
		        }
		        else if (value_type == 1)
		        {
		          $('#myModal').modal('hide');
		        }
		        else
		        {
		          console.log("U-rang Order page");
		        }
	      }
	      else
	      {
	        console.log('U-rang Order page. Hint: Developer guide');
	      }
	   	});
		//generating address of user and school
		$('#cus_email').change(function(){
			if ($.trim($('#cus_email').val()) != null) 
			{
				$.ajax({
			      url: "{{route('lastPickUpReq')}}",
			      type: "POST",
			      data: {user_id: $('#cus_email').val(), _token: "{{Session::token()}}"},
			      success: function(data) {
			       
			        
			        if (data != 0) 
			        {

			        	 console.log(data);
			          //mandetory address
			          $('#user_add').text(data.address);
			          //optional addressline 2
			          $('#address_line_2').text(data.address_line_2);
			          //apartment number
			          $('#apt_no').val(data.apt_no);
			          $('#city').val(data.user_detail.city);
			          $('#state').val(data.user_detail.state);
			          $('#zip').val(data.user_detail.state);
			          if(data.user_detail.personal_ph!=0)
			          {
			          $('#Phone').val(data.user_detail.personal_ph);
			      	  }
			      	 else 
			          {
			          	 $('#Phone').val("");
			          }
			           if(data.user_detail.cell_phone!=0)
			          {
			          $('#cellphone').val(data.user_detail.cell_phone);
			      	  }
			      	 else 
			          {
			          	 $('#cellphone').val("");
			          }
			           if(data.user_detail.off_phone!=0 )
			          {
			          $('#officephone').val(data.user_detail.off_phone);
			      	  }
			      	 else 
			          {
			          	 $('#officephone').val("");
			          }
			          //schedule
			          if (data.schedule == "For the time specified only") 
			          {
			            $('#inlineRadio1').prop('checked', true);
			          }
			          else if (data.schedule == "Daily at this time except weekends") 
			          {
			            $('#inlineRadio2').prop('checked', true);
			          }
			          else if (data.schedule == "Daily at this time including weekends") 
			          {
			            $('#inlineRadio3').prop('checked', true);
			          }
			          else if (data.schedule == "Weekly on this day of the week") 
			          {
			            $('#inlineRadio4').prop('checked', true);
			          }
			          else if (data.schedule == "Monthly on this day of the month")
			          {
			            $('#inlineRadio5').prop('checked', true);
			          }
			          else
			          {
			            $('#inlineRadio1').prop('checked', false);
			          }
			          //delivary type
			          if (data.delivary_type == "Boxed") {
			            $('#boxed').prop('checked', true);
			          }
			          else if (data.delivary_type == "Hung") {
			            $('#hung').prop('checked', true);
			          }
			          else
			          {
			            $('#boxed').prop('checked', false);
			          }
			          //starch type
			          //$('#strach_type').val(data.starch_type);
			          //wash and fold
			          if (data.wash_n_fold == 1) 
			          {
			            $('#wash_n_fold').prop('checked', true);
			          }
			          //need bag
			          if (data.need_bag == 1) 
			          {
			            $('#urang_bag').prop('checked', true);
			          }
			          //spcl instruction
			          $('#spcl_ins').text(data.special_instructions);
			          //driving ins
			          $('#driving_ins').text(data.driving_instructions);
			          //emergency
			          if (data.is_emergency == 1) 
			          {
			            $('#isEmergency').prop('checked', true);
			          }
			          //coupon
			          //$('#coupon').val(data.coupon);
			          //check coupon validity
			          $.ajax({
			            url : "{{route('checkCouponVailidity')}}",
			            type: "POST",
			            data: {coupon_value : data.coupon, _token: "{{Session::token()}}"},
			            success: function(response) {
			              //console.log(response);
			              if (response == 1) {
			                $('#coupon').val(data.coupon);
			              }
			              else
			              {
			                $('#coupon').val("");
			              }
			            }
			          });
			          //school donation
			          if (data.school_donation_id != null) 
			          {
			            $('#school_checkbox').prop('checked', true);
			            openCheckBoxSchool();
			            $('#schoolNameDropDown').val(data.school_donation_id);
			          }
			        }
			      }
			    });
									    	
			}
			else
			{
				return;
			}
		    
		});
		var todays_date=  $.datepicker.formatDate('mm/dd/yy', new Date());
     	$('#datepicker').val(todays_date);
     	var dateToday = new Date(); 
     	$( "#datepicker" ).datepicker({
     		minDate: dateToday
     	});
     	$('#modal-close').click(function(){
	        if($('#list_items_json').val() == '')
	        {
	          sweetAlert("Oops...", "You can't request a Detailed Pickup without selecting any item", "warning");
	          $('#myModal').modal('hide');
	          $('#order_type>option:eq(0)').prop('selected', true);
	          return;
	        }
        	$('#myModal').modal('hide');
        	swal("Success!", "Your items are select now please place an order", "success");
     	});
     	//starch show on select boxed or hung
     	$('input[type=radio][name=boxed_or_hung]').change(function() {
     		$('#strach_type').show();
     		$('#str_typ').show();
     		$('#starch_type').attr('required', 'true');
     	});
     	//check time
	    function checkTime() {
	      //console.log(time_start);
	      //console.log(time_end);
	      if ($.trim(start_time) && $.trim(end_time)) 
	      {
	        if (convertTo24(start_time) < convertTo24(end_time)) 
	        {
	          //console.log('ok');
	          $('#errorTime').html('');
	          $('#schedule_pick_up').attr('type', 'submit');
	        }
	        else if (convertTo24(start_time) > convertTo24(end_time)) {
	          //console.log('not ok');
	          $('#errorTime').html('* start time cannot be greater than end time. Wrong Input!');
	          $('#schedule_pick_up').attr('type', 'button');
	          return false;
	        }
	        else
	        {
	          //console.log('not ok');
	          $('#errorTime').html('Wrong Input! check the input and put it again.');
	          $('#schedule_pick_up').attr('type', 'button');
	          return false;
	        }
	        //return false;
	      } 
	    }
	    function convertTo24(time)
	    {
	       //console.log(time);
	        var hours = Number(time.match(/^(\d+)/)[1]);
	        var minutes = Number(time.match(/:(\d+)/)[1]);
	        var AMPM = time.match(/\s(.*)$/)[1];
	        if (AMPM == "PM" && hours < 12) hours = hours + 12;
	        if (AMPM == "AM" && hours == 12) hours = hours - 12;
	        var sHours = hours.toString();
	        var sMinutes = minutes.toString();
	        if (hours < 10) sHours = "0" + sHours;
	        if (minutes < 10) sMinutes = "0" + sMinutes;
	        return (sHours +':'+sMinutes);
	    }
	    //coupon validity
	     $(document).on('input', '#coupon',  function() {    
	        //console.log('test')
	        var coupon_value = $('#coupon').val();
	        //console.log(coupon_value);
	        $.ajax({
	          url: "{{route('checkCouponVailidity')}}",
	          type: "POST",
	          data: {coupon_value: coupon_value, _token:"{{Session::token()}}"},
	          success: function(data) {
	            //console.log(data);
	            if (data == 1) {
	              $('#validity').html("");
	              $('#schedule_pick_up').attr('type', 'submit');
	            }
	            else if (data == 2) {
	              $('#validity').html('<span style="color: red;">Old coupon code. Coupon is not valid!</span>');
	              $('#schedule_pick_up').attr('type', 'button');
	            }
	            else
	            {
	              $('#validity').html('<span style="color: red;">Invalid coupon code!</span>');
	              $('#schedule_pick_up').attr('type', 'button');
	            }
	          }
	        })
	     });
  	});
  jsonArray = [];

    function addListItems(id) {
    //alert(id);
    var no_of_item = $('#number_'+id).val();
    //console.log(no_of_item);
    if (no_of_item > 0) {
      for(var m=0; m< jsonArray.length; m++) {
        //console.log(jsonArray[m]);
        if (jsonArray[m].id == id) {
          jsonArray.splice(m,1);
        }
      }
      list_item = {};
      list_item['id'] = id;
      list_item['number_of_item'] = $('#number_'+id).val();
      list_item['item_name'] = $('#item_'+id).text();
      list_item['item_price'] = $('#price_'+id).text();
      jsonArray.push(list_item);
      jsonString = JSON.stringify(jsonArray);
      //console.log(jsonString);
    }
    else if (no_of_item == 0)
    {
      for(var j=0; j< jsonArray.length; j++) {
        if (jsonArray[j].id == id) 
        {
          //console.log(jsonArray);
          jsonArray.splice(j,1);
          jsonString = JSON.stringify(jsonArray);
          //console.log(jsonString);
        }
      }
    }
    else
    {
      console.log("Developer's guide");
    }
    //console.log(jsonString);
    $('#list_items_json').val(jsonString);
    //console.log(jsonString);
  }
  $('#schoolNameDropDown').hide();
  $('#schoolDonationAmount').hide();
  function openCheckBoxSchool()
  {
    $('#schoolNameDropDown').toggle();
  }

  function IsValidReferalEmail() {
       //return true;
       $('#emailReferal').attr('style', 'width: 270px');
       $('#errorInputEmail').html("");
       var email = $('#emailReferal').val();
       var isValidEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       if ($.trim(email)) 
       {
          //return isValidEmail.test(email);
          if (isValidEmail.test(email)) 
          {
             //$('#emailExist').html('');
             $.ajax({
                url : "{{route('postEmailReferalChecker')}}",
                type: "POST",
                data: {email: email, _token: "{{Session::token()}}"},
                success : function(data){
                   //$('#email_checker').val(data);
                   //console.log(data);
                   //alert(data)
                   //return data;
                   //$('#emailExist').html(data);
                   //console.log("data :: "+data);
                   if (data == 1) 
                   {
                      $('#emailExist').html("<div class='alert alert-danger'><i class='fa fa-check' aria-hidden='true'></i> Email address is already in referal list ! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
                      $('#email_checker_referal').val(0);
                      return false;

                   }
                   else if(data==2)
                   {
                      $('#emailExist').html("<div class='alert alert-success'><i class='fa fa-check' aria-hidden='true'></i> Email address is valid! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
                      $('#email_checker_referal').val(1);
                      return true;
                   }
                   else
                   {
                      $('#emailExist').html("<div class='alert alert-danger'><i class='fa fa-times-circle' aria-hidden='true'></i> Hold on! email already exists! try another one. <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
                      $('#email_checker_referal').val(0);
                      return false;
                   }
                   //return data;
                }
             });
          }
          else
          {
             $('#emailExist').html("<div class='alert alert-danger'><i class='fa fa-times-circle' aria-hidden='true'></i> Not A Valid Email Address! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
             return false;
          }
       }
       else
       {
          $('#emailExist').html("<div class='alert alert-danger'><i class='fa fa-times-circle' aria-hidden='true'></i> Please Enter an Email Address! <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div></div>");
          return false;
       }
    }
</script>
@endsection