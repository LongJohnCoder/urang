@extends('pages.layouts.user-master')
@section('content')

<style type="text/css">
   .form2 .message{color: #333;}
   p{font-size: 14px;}
   /*.required{font-size: 13px;}*/
   #select_month{margin: 0;}
   #select_year{margin: 0; right: 0;}
</style>
   <div class="register-page1" style="padding-top:2%; background: #1a1a1a;">
          <div class="container">
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
              @if(count($errors) > 0)
                  <div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <ul>
                          @foreach($errors->all() as $error)
                              <li>{{$error}}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form2">
            <form class="login-form" role="form2" method="post" action="{{route('postNewCreditCard')}}" id="signUpForm">
                <h2>Enter New Credit Card Details</h2>
                <div class="row custom-margin">
                   <div class="col-md-12 col-sm-12">
                      <div class="page_sub_heading">
                      <label>&nbsp;</label>
                      </div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Card Holder Name:</label> <span style="color: red;">*</span>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="text" style="" id="cardholder" name="cardholder_name"  value="{{ old('cardholder_name') }}" onkeyup="$('#errorInputCardHolder').html('');" >
                        <div id="errorInputCardHolder" style="color: red;"></div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Credit Card No:</label> <span style="color: red;">*</span>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="text" id="card_no" name="card_no" required="" onkeyup="return creditCardValidate();">
                      <div id="errorInputCardNo" style="color: red;"></div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                   &nbsp;
                   </div>
                   <div class="col-md-6 col-sm-6">
                    <p class="log"></p>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                   &nbsp;
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <div class="required">
                        [ Please do not enter spaces or hyphens (-) ]
                      </div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                    <label>CVV2 (optional):</label>
                   </div>
                   <div class="col-md-6 col-sm-6">
                    <input type="password"  id="cvv" name="cvv" maxlength="4" size="10" value="{{old('cvv')}}">
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      &nbsp;
                   </div>
                   <div class="col-md-6 col-sm-6 required">
                      <p>
                        [ CVV2 is a 3-digit value at the end of your account number printed on the back of your credit card. On American Express cards, CVV2 number consists of 3-4 digits located on the front of the card.] 
                      </p>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Expiration Date:</label> <span style="color: red;">*</span>
                   </div>
                   <div class="col-md-4 col-sm-4">
                      <select id="select_month" name="select_month" onchange="$('#select_month').removeAttr('style'); $('#errorInputDate').html('');" style="position:static; margin:0;">
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
                   </div>
                   <div class="col-md-4 col-sm-4">
                      <select id="select_year" name="select_year" onchange="$('#select_year').removeAttr('style'); $('#errorInputDate').html('');" style="position:static; margin:0;">
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
                   <div id="errorInputDate" style="color: red;"></div>
                </div>
                <hr>

                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">&nbsp;</div> 
                   <div class="col-md-4 col-sm-4">
                        <button type="submit" style="margin-top: 10px" onclick="IsValid(event);" id="sign_up_cus">Continue</button>
                      <input type="hidden" name="_token" value="{{Session::token()}}" />
                      <input type="hidden" id="card_no_checker" />
                   </div>
                </div>
                </div>
            </form>
          </div>
              </div>  
            </div>  
          </div>


          
        </div>
<script>
    /*$( ".login-form" ).validate({
      rules: {
        Phone: {
          required: true,
          phoneUS: true
        },
      }
    });*/
    var err;
    function creditCardValidate(){
      $('#errorInputCardNo').html('');
       $('#card_no').validateCreditCard(function(result) {
          //err=0;
          if (result.valid && result.length_valid && result.luhn_valid) 
          {
             err=0;
             $('.log').html('<br><span style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> vaild credit card number</span>');
             $('#card_no_checker').val(1);
             //return err;
          }
          else
          {
             err=1;
             $('.log').html('<br><span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> This is not a valid credit card number </span>');
             //return err;
             $('#card_no_checker').val(0);
          }
          
       });
    }
    //form submit done by this
    function IsValid(event) {
      //$('.login-form').submit();
      //return true;
       event.preventDefault();
       var name_on_card = $('#cardholder').val();
       var card_number = $('#card_no').val();
       var month_val = $('#select_month').val();
       var year_val = $('#select_year').val();
       var card_no_checker = $('#card_no_checker').val();
       if ($.trim(name_on_card) && $.trim(card_number) && $.trim(month_val) && $.trim(year_val))
       {
          if($.trim(card_no_checker))
          {
            $('.login-form').submit();
          }
         else
         {
            //alert('some error occured form cannot be submitted');
            sweetAlert("Oops..", "Error Occured Hint: Credit card number is valid" ,"error");
            return false;
         }
       } else {
        if (!name_on_card)
        {
          $('#cardholder').attr('style', 'border-color: red;');
                $('#errorInputCardHolder').html("This Field is Required!");
        }
        if (!card_number) 
        {
          $('#card_no').attr('style', 'border-color: red;');
                $('#errorInputCardNo').html("This Field is Required!");
        }
        if (!month_val) 
        {
          $('#select_month').attr('style', 'border-color:red;');
          $('#errorInputDate').html("This Field is Required!");
        }
        if (!year_val) 
        {
          $('#select_year').attr('style', 'border-color:red;');
          $('#errorInputDate').html("This Field is Required!");
        }
        return false;
       }
    }

</script>
@endsection