@extends('pages.layouts.user-master')
@section('content')
<style type="text/css">
  .custom-checkbox input[type="checkbox"]{width: auto;}
</style>
<div class="main-content nycpick">
<div class="fixed-div">
  <h2><label>Contact Us:</label> (646)902-5326</h2>
  <h2><label>Email-Id:</label> <a href="mailto:lisa@u-rang.com">lisa@u-rang.com</a></h2>
  <div class="open-square"><i class="fa fa-comments-o" aria-hidden="true"></i> Support</div>
</div>
    <div class="container">
      <div class="row signup login">
        <div class="col-md-12">
          @if(Session::has('fail'))
            <div class="alert alert-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> {{Session::get('fail')}}
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
          @else
          @endif
          @if(Session::has('success'))
            <div class="alert alert-success"> {{Session::get('success')}}
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
          @else
          @endif
          <form class="form-inline form2" method="post" action="{{route('postPickUpReq')}}">
          <h2>NYC Pick-up</h2>
          <h3>Individual Clients</h3>
          <p class="reg-heading">We will pick-up and deliver the entire City, No Doorman, Work late, Your Neighborhood Cleaner closes before you awake on a Saturday? No Problem. U-Rang we answer. You indicate the time, the place, the requested completion day and your clothes will arrive clean and hassle free. We will accommodate your difficult schedules and non-doorman buildings, if no one is home during the day, we can schedule you for a late night delivery.</p>
              <h4>Schedule Pick-up - Regular Customer</h4>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" value="{{auth()->guard('users')->user()->email}}" readonly="">
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="{{auth()->guard('users')->user()->user_details->name}}" readonly="">
              </div>
              <div class="form-group">
                <label for="address">Pick-Up Address</label>
                <textarea class="form-control" rows="3" name="address" id="address_line_1" required="">   {{auth()->guard('users')->user()->user_details->address}} </textarea>
              </div>
              <div class="form-group">
                <label for="address_line_2">Address Line 2 (optional)</label>
                <textarea class="form-control" rows="3" name="address_line_2" id="address_line_2"></textarea>
              </div>
              <div class="form-group">
                <label for="apt_no">Apartment Number (if any optional)</label>
                <input type="text" name="apt_no" id="apt_no" placeholder="eg. 33b" class="form-control"></input>
              </div>
              <div class="form-group">
                <label for="address">Pick-Up Date</label>
                <div class='input-group date'>
                    <input type='text' class="form-control" id='datepicker' required="" name="pick_up_date" required="" />
                    <span class="input-group-addon">
                        <a href="#" class="calendar"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                    </span>
                </div>
              </div>
            <div class="form-group schedule">
              <label for="schedule">Schedule</label>
              <div class="schedule-radio">
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio1" value="For the time specified only"> For the time specified only.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio2" value="Daily at this time except weekends"> Daily at this time except weekends.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio3" value="Daily at this time including weekends">  Daily at this time including weekends.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio4" value="Weekly on this day of the week">  Weekly on this day of the week.
                </label>
                <br>
                <label class="radio">
                  <input type="radio" name="schedule" id="inlineRadio5" value="Monthly on this day of the month">  Monthly on this day of the month.
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>How Would You Like Your Shirts</label>
              <div class="checkbox">
                <label>
                  <input type="radio" name="boxed_or_hung" id="boxed" value="Boxed"> Boxed
              </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="radio" name="boxed_or_hung" id="hung" value="Hung"> Hung
                </label>
              </div>
              <select name="strach_type" id="strach_type" style="display: none;">
                <option value="No">No Starch</option>
                <option value="Very_light_starch">Very Light Starch</option>
                <option value="Light_starch">Light Starch</option>
                <option value="Medium_starch">Medium Starch</option>
                <option value="Heavy_starch">Heavy Starch</option>
              </select>
            </div>
            <div class="form-group">
              <label for="doorman">Doorman</label>
              <select name="doorman" id="doorman">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group" style="display: none;" id="time_frame">
              <label for="time_frame">Give Us a Time Frame</label>
              <input type="text" name="time_frame_start" id="time_frame_start" class="form-control" style="width: 25%" placeholder="Start time"></input> To
              <input type="text" name="time_frame_end" id="time_frame_end" class="form-control" style="width: 25%" placeholder="End time"></input>
              <div style="color: red;" id="errorTime"></div>
            </div>
            <div class="form-group custom-checkbox">
              <input type="checkbox" name="wash_n_fold" id="wash_n_fold"> Wash and fold ? (<span style="color: red;">make sure you put your wash and fold cloths in seperate bag</span>)</input>
            </div>
             <div class="form-group">
                <div class="checkbox checkbox-large">
                  <label>
                    <input type="checkbox" name="urang_bag" id="urang_bag"> Please click this box if you need U-Rang bag.
                  </label>
              </div>
            </div>
            <p>We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions.</p>
            <div class="clear50"></div>
            <div class="form-group">
                <label>Special Instructions</label>
                <textarea class="form-control" rows="3" name="spcl_ins" id="spcl_ins"></textarea>
            </div>
            <div class="form-group">
                <label>Driving Instructions</label>
                <textarea class="form-control" rows="3" name="driving_ins" id="driving_ins"></textarea>
            </div>
            <div class="form-group schedule">
              <label for="schedule">How to pay </label>
              <div class="schedule-radio">
                <label class="radio">
                  <input type="radio" name="pay_method" id="inlineRadio6" value="1" required="" checked> Charge my credit card this time for amount $ 
                </label>
                <br>
                <!-- <label class="radio">
                  <input type="radio" name="pay_method" id="inlineRadio8" value="2"> COD
                </label>
                <br> -->
                <label class="radio">
                  <input type="radio" name="pay_method" id="inlineRadio9" value="3"> Check
                </label>
              </div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <select id="order_type" name="order_type" class="col-xs-5" required="true">
                  <option value="">Type of order</option>
                  <option value="1">Fast Pickup</option>
                  <option value="0">Detailed Pickup</option>
                </select>
            </div>
            <div style="display: none;">
              <?php
                $price_list = \App\PriceList::all();
              ?>
            </div>
            <!-- <div class="form-group">
              <label for="wash_n_fold">Wash and fold?</label>
              <select name="wash_n_fold" id="wash_n_fold" required="">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div> -->
            <!-- <div class="form-group">
              <label for="client_type">What type of client you are ?</label>
              <select name="client_type" id="client_type" required="">
                <option value="">Client Type</option>
                <option value="new_client">New Client</option>
                <option value="key_client">Key Client</option>
                <option value="corporate_client">Corporate Client</option>
                <option value="reff">Referral</option>
              </select>
            </div> -->
            <div class="form-group">
              <div class="checkbox checkbox-large">
                <label>
                  <input type="checkbox" name="isEmergency" id="isEmergency">
                Is it a emergency service ? <span style="color: red;">$7 extra</span>
                </label>
              </div>
            </div>
            <div class="form-group">
                <label>Do you have a coupon code ?<p style="color: red;">Please leave the field blank if you dont have any.</p></label>
                <input type="text" name="coupon" id="coupon" class="form-control" />
                <div id="validity"></div>
            </div>
            <div class="form-group">
                <div class="checkbox checkbox-large">
                  <label>
                  <input onclick="openCheckBoxSchool()" id="school_checkbox" type="checkbox" name="isDonate">
                  Donate to a school in your neighborhood ?
                  <p style="color: red;font-weight: bold;">We believe in investing in our community. We will donate 10% of our profit to the school of your choice. Please send us an email if you do not see the school listed. our email <a href="mailto:lisa@u-rang.com">lisa@u-rang.com</a></p>                
                  </label>
                </div>
            </div>
            <div class="form-group">
                  <?php 
                  $school_list = \App\SchoolDonations::all();
                ?>
                <span>
                  <select name="school_donation_id" id="schoolNameDropDown">
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
                
              </div>
               <button type="submit" class="btn btn-default" id="schedule_pick_up">Schedule Pick up</button>
               <input type="hidden" name="_token" value="{{Session::token()}}"></input>
            <!-- <p class="offer">Referrals - 10 percent discount on your next order if you refer a friend.</p> -->
            <p class="offer">You will become eligible for a discount when the person you recommended signs up at U-Rang.Com and places their first order. If your submission is presently a client, you will not qualify for a discount.</p>
            </div>
           
            
                  <!-- Modal -->
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
  <script type="text/javascript">
  $(document).ready(function(){
    var time_start = '';
    var time_end = '';
    //last inserted row data feeding
    $.ajax({
      url: "{{route('lastPickUpReq')}}",
      type: "POST",
      data: {user_id: "{{auth()->guard('users')->user()->id}}", _token: "{{Session::token()}}"},
      success: function(data) {
        //console.log(data);
        if (data != 0) 
        {
          //mandetory address
          $('#address_line_1').text(data.address);
          //optional addressline 2
          if(data.address_line_2==null)
          {
            $('#address_line_2').text("");
          }
          else
          {
            $('#address_line_2').text(data.address_line_2);
          }
          //apartment number
          $('#apt_no').val(data.apt_no);
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
            //$('#boxed').prop('checked', true);
          }
          else if (data.delivary_type == "Hung") {
            //$('#hung').prop('checked', true);
          }
          else
          {
            $('#boxed').prop('checked', false);
          }
          //starch type
          $('#strach_type').val(data.starch_type);
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
          }
        }
      }
    });
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
      $('#time_frame_start').change(function(){
        time_start = $('#time_frame_start').val();
        $('#time_frame_end').timepicker('option', { 'minTime': time_start, 'maxTime': '11:59pm' , 'timeFormat': 'h:i A' });
        checkTime();
      });
      $('#time_frame_end').change(function(){
        time_end = $('#time_frame_end').val();
        checkTime();
      });
    });

    $('#time_frame_start').keyup(function() {
      $('#errorTime').html('* Please select from the dropdown.');
      $('#schedule_pick_up').attr('type', 'button');
    });
    $('#time_frame_end').keyup(function(){
      $('#errorTime').html('* Please select from the dropdown.');
      $('#schedule_pick_up').attr('type', 'button');
    });
    //starch show on select boxed or hung
    $('input[type=radio][name=boxed_or_hung]').change(function() {
      //alert(this.value);
      $('#strach_type').show();
      $('#starch_type').attr('required', 'true');
    });
    //check time
    function checkTime() {
      //console.log(time_start);
      //console.log(time_end);
      if ($.trim(time_start) && $.trim(time_end)) 
      {
        console.log("start time "+convertTo24(time_start)+" end time "+convertTo24(time_end));
        if (convertTo24(time_start) < convertTo24(time_end)) 
        {
          //console.log('ok');
          $('#errorTime').html('');
          $('#schedule_pick_up').attr('type', 'submit');
        }
        else if (convertTo24(time_start) > convertTo24(time_end)) {
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

    $(".fixed-div").click(function(){

       $(this).toggleClass("open");

       if($(this).hasClass("open")){
         $( this ).animate({
            left: "0"
          }, 500, function() {
          });
        }
      else{
        $( this ).animate({
            left: "-240px"
          }, 500, function() {
          });
      }

    });
      $('#schoolNameDropDown').val("{{auth()->guard('users')->user()->user_details->school_id}}");
      var dateToday = new Date(); 
      $( "#datepicker" ).datepicker({
        minDate: dateToday
      });
      $( ".calendar" ).click(function(e) {
        e.preventDefault();
        $( "#datepicker" ).focus();
      });
      //alert('test')
     var todays_date=  $.datepicker.formatDate('mm/dd/yy', new Date());
     $('#datepicker').val(todays_date);

     $('#order_type').change(function(){
      var value_type = $('#order_type').val();
      /*alert(value_type);
      return;*/
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