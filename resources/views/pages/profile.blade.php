@extends('pages.layouts.user-master')
@section('content')
<div class="main-content login-signup">
   <div class="container">
      <div class="row signup login">
         <div class="col-md-12">
            <h2>Edit Details</h2>
        	@if(Session::has('fail'))
	        <div class="alert alert-danger">{{Session::get('fail')}}
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        </div>
	        @else
	        @endif
	        @if(Session::has('success'))
	          <div class="alert alert-success">                               {{Session::get('success')}}
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	          </div>
	        @else
	        @endif
            <form class="form-inline" action="{{route('post-user-profile')}}" method="post" onsubmit="return PassWordCheck();">
               <div class="col-md-6 individual-form">
                  <h4>Login Info:</h4>
                  <div class="form-group">
                     <label for="exampleInputuname1">Email</label>
                     <input type="email" class="form-control" id="email" name="email" required="" value="{{$logged_user->email}}">
                     <em>[ Email is being used for login username ]</em>
                  </div>
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" id="name" name="name" required="" value="{{$logged_user->user_details->name}}">
                  </div>
                  <div class="form-group">
                     <label for="address">Address Line 1</label>
                     <textarea class="form-control" rows="10" name="address_line_1" required="">{{$logged_user->user_details->address_line_1}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="address">Address Line 2</label>
                     <textarea class="form-control" rows="10" name="address_line_2">{{$logged_user->user_details->address_line_2}}</textarea>
                  </div>
                  <div class="form-group">
                     <div class="col-md-5">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" required="true" value="{{$logged_user->user_details->city}}" class="form-control"></input>
                     </div>
                     <div class="col-md-4">
                        <label for="state">State</label>
                        <input type="text" name="state" id="state" required="true" value="{{$logged_user->user_details->state}}" class="form-control"></input>
                     </div>
                     <div class="col-md-3">
                        <label for="zip">Zip Code</label>
                        <input type="text" name="zip" id="zip" required="true" value="{{$logged_user->user_details->zip}}" class="form-control"></input>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 individual-form">
                  <h4>Personal Info:</h4>
                  <div class="form-group">
                     <label for="phone">Phone</label>
                     <input type="number" class="form-control" id="Phone" placeholder="Format: 123-456-7890" name="personal_phone" required="" value="{{$logged_user->user_details->personal_ph}}">
                  </div>
                  <div class="form-group">
                     <label for="cellphone">Cell Phone (optional)</label>
                     <input type="number" class="form-control" id="cellphone" placeholder="Format: 123-456-7890" name="cell_phone" value="{{$logged_user->user_details->cell_phone ==0 ? '' : $logged_user->user_details->cell_phone}}">
                  </div>
                  <div class="form-group">
                     <label for="officephone">Office Phone (optional)</label>
                     <input type="number" class="form-control" id="officephone" placeholder="Format: 123-456-7890" name="office_phone" value="{{$logged_user->user_details->off_phone ==0 ? '' : $logged_user->user_details->off_phone}}">
                  </div>
                  <div class="form-group">
                     <label for="school_donation_id">Selected School</label>
                     <select name="school_donation_id" id="schoolNameDropDown" class="form-control">
                       <option value="">Select School</option>
                       @foreach($school_list as $school)
                       <option value="{{$school->id}}">{{$school->school_name}}</option>
                       @endforeach
                     </select>
                  </div>
               </div>
               <div class="clear50"></div>
               <div class="col-md-6 individual-form">
                  <h4>Special Instructions:</h4>
                  <div class="form-group">
                     <label for="address">Default Special Instructions (optional)</label>
                     <textarea class="form-control" rows="10" name="spcl_instruction">{{$logged_user->user_details->spcl_instructions != null ?  $logged_user->user_details->spcl_instructions : ''}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="address">Default Driving Instructions (optional)</label>
                     <textarea class="form-control" rows="10" name="driving_instruction">{{$logged_user->user_details->driving_instructions != null ?  $logged_user->user_details->driving_instructions : ''}}</textarea>
                  </div>
               </div>
               <div class="col-md-6 individual-form">
                  <h4>Credit Card Info:</h4>
                  <div class="form-group">
                     <label for="cardholder">Card Holder Name</label>
                     <input type="text" class="form-control" id="cardholder" name="cardholder_name" required="" value="{{$logged_user->card_details !=null ? $logged_user->card_details->name :'' }}">
                  </div>
                  <div class="form-group">
                     <label for="cardholder">Card Type</label>
                     <select class="form-control" id="cardtype" name="cardtype" required="">
                        <option>Select Card Type</option>
                        <option value="Visa">Visa</option>
                        <option value="Mastercard">Master Card</option>
                        <option value="AmericanExpress">American Express</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="cardnumber">Credit Card Number</label>
                     <input type="text" class="form-control" id="card_no" name="card_no" required="" onkeyup="return creditCardValidate();" value="{{$logged_user->card_details !=null ? $logged_user->card_details->card_no :''}}">
                      <p class="log"></p>
                     <em>[ Please do not enter spaces or hyphens (-) ]</em>
                  </div>
                  <div class="form-group">
                     <label for="cvv">CVV2 (optional)</label>
                     <input type="text" class="form-control" id="cvv" name="cvv" value="{{$logged_user->card_details != null ? $logged_user->card_details->cvv: ''}}">
                     <em>[ CVV2 is a 3-digit value at the end of your account number printed on the back of your credit card. On American Express cards, CVV2 number consists of 3-4 digits located on the front of the card.]</em>
                  </div>
                  <div class="form-group">
                     <label for="cardholder">Expiration Date</label>
                     <select class="form-control expiration" id="select_month" name="select_month" required="">
                        <option value="">Select Month</option>
			    		<option value="01">January</option>
			    		<option value="02">February</option>
			    		<option value="03">March</option>
			    		<option value="04">April</option>
			    		<option value="05">May</option>
			    		<option value="06">June</option>
			    		<option value="07">July</option>
			    		<option value="08">August</option>
			    		<option value="09">September</option>
			    		<option value="10">October</option>
			    		<option value="11">November</option>
			    		<option value="12">December</option>
                     </select>
                     <select class="form-control expiration" id="select_year" name="select_year" required="">
                        <option value="">Select Year</option>
			    		<option value="16">2016</option>
			    		<option value="17">2017</option>
			    		<option value="18">2018</option>
			    		<option value="19">2019</option>
			    		<option value="20">2020</option>
			    		<option value="21">2021</option>
			    		<option value="22">2022</option>
			    		<option value="23">2023</option>
			    		<option value="24">2024</option>
			    		<option value="25">2025</option>
			    		<option value="26">2026</option>
			    		<option value="27">2027</option>
			    		<option value="28">2028</option>
                     </select>
                  </div>
               </div>
               <div class="clear50"></div>
               <button type="submit" class="btn btn-default">Save Details</button>
               <input type="hidden" name="_token" value="{{Session::token()}}"></input>
               <p class="offer">You Will Become Eligible For A Discount When The Person You Recommended Signs Up At U-Rang.Com And Places Their First Order. If Your Submission Is Presently A Client, You Will Not Qualify For A Discount.</p>
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
	var err;
	function PassWordCheck() {
		creditCardValidate();
		if(err==0)
		{
		return true;
		}
		else
		{
			return false;
		}
	}
	function creditCardValidate(){
		$('#card_no').validateCreditCard(function(result) {
			err=0
			if (result.valid && result.length_valid && result.luhn_valid) 
			{
				err=0;
				$('.log').html('<br><div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> vaild credit card number <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>');
				
				//return err;
			}
			else
			{
				err=1;
				$('.log').html('<br><div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> This is not a valid credit card number <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
				//return err;
				
			}
			
    	});
	}
	$(document).ready(function(){
		var SelectCardType = $.trim('{{$logged_user->card_details !=null ? $logged_user->card_details->card_type :'' }}');
		var SelectMonth = $.trim('{{$logged_user->card_details !=null ? $logged_user->card_details->exp_month :'' }}');
		var SelectYear = $.trim('{{$logged_user->card_details !=null ? $logged_user->card_details->exp_year :'' }}');
		$('#cardtype').val(SelectCardType);
		$('#select_year').val(SelectYear);
		$('#select_month').val(SelectMonth);
      $('#schoolNameDropDown').val('{{$logged_user->user_details->school_id}}');
	});
</script>
@endsection