@extends('pages.layouts.master-black')
@section('content')

<style type="text/css">
   .form2 .message{color: #333;}
   p{font-size: 14px;}
   /*.required{font-size: 13px;}*/
   #select_month{margin: 0;}
   #select_year{margin: 0; right: 0;}
</style>
   <div class="register-page1" style="padding-top:10%;">
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

          <h1 class="h1-black-title">Sign Up</h1>
          <div class="container white-bg">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form2">
            <!--<form class="register-form" role="form" method="post" action="register.php">
              <input type="text" placeholder="name"/>
              <input type="password" placeholder="password"/>
              <input type="text" placeholder="email address"/>
              <button>create</button>
              <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>-->
            <form class="login-form" role="form2" method="post" action="{{route('postSignUp')}}" id="signUpForm">
                <h2>Customer Registration</h2>
                <h3>Individual Clients</h3>
                <p class="message">We will pick-up and deliver the entire City, No Doorman, Work late, Your Neighborhood Cleaner closes before you awake on a Saturday? No Problem. U-Rang we answer. You indicate the time, the place, the requested completion day and your clothes will arrive clean and hassle free. We will accommodate your difficult schedules and non-doorman buildings, if no one is home during the day, we can schedule you for a late night delivery. </p><br>
                <span class="required">NOTE:</span> If you already have an account with us, please login at the <a href="{{route('getLogin')}}">login page.</a>
                <span class="warning" style="padding-left:18px;" align="left">
                <span class="warning" style="padding-left:18px;" align="left">
                <span class="warning" style="padding-left:18px;" align="left">
                <div style="height: 40px;"></div>
                <div class="txt-left">
                <div class="row custom-margin">
                  <div class="col-md-4 col-sm-4">
                  Today's Date:
                  </div>
                  <div class="col-md-6 col-sm-6">
                  <?= date('l,');?>&nbsp;<?= date('F d, Y');?>
                  </div>
                </div>
                <hr>
                <div class="row custom-margin">
                  <div class="col-md-4 col-sm-4">
                    <label>Email:</label> <span style="color: red;">*</span>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="email" id="email" name="email" style="" onkeyup="return IsValidEmail();">
                      <div id="emailExist" style="margin-top: 2%"></div>
                      <div id="errorInputEmail" style="color: red;">
                      </div>
                  </div>
                </div>
                <div class="row custom-margin">
                  <div class="col-md-4 col-sm-4">
                    <label>Password:</label> <span style="color: red;">*</span>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="password"  id="password" name="password" style="" onkeyup="return PassWordCheck();">
                    <div id="errorInputPassword" style="color: red;"></div>
                  </div>
                </div>
                <div class="row custom-margin">
                  <div class="col-md-4 col-sm-4">
                    <label>Confirm Password:</label> <span style="color: red;">*</span>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="password"  id="conf_password" name="conf_password" style="" onkeyup="return PassWordCheck();">
                    <div id="errorInputConfPassword" style="color: red;"></div>
                  </div>
                </div>
                <div class="row custom-margin">
                  <div class="col-md-4 col-sm-4">
                  &nbsp;
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div id="passcheck"></div>
                  </div>
                </div> 
                <div class="row custom-margin">
                  <div class="col-md-12 col-sm-12">
                    <div class="page_sub_heading">
                    <label>Personal Info:</label></div>
                  </div>
                </div>
                <div class="row custom-margin">
                  <div class="col-md-4 col-sm-4">
                    <label>Name:</label> <span style="color: red;">*</span>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" id="name" name="name" style="" value="{{old('name')}}" onkeyup="$('#name').attr('style', 'width:270px;'); $('#errorInputName').html('');">
                      <div id="errorInputName" style="color: red;"></div>
                  </div>
                </div>
                  <div class="row custom-margin">
                    <div class="col-md-4 col-sm-4">
                      <label>Street Address Line 1:</label> <span style="color: red;">*</span>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <input type="text" name="strt_address_1" id="strt_address_1" required="true" placeholder="Address" value="{{old('strt_address_1')}}" onkeyup="$('#strt_address_1').attr('style', ''); $('#errorInputAddress1').html('');"></input>
                      <div id="errorInputAddress1" style="color: red;"></div>
                    </div>
                  </div>
                  <div class="row custom-margin">
                    <div class="col-md-4 col-sm-4">
                      <label>Street Address Line 2:</label>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <input type="text" name="strt_address_2" id="strt_address_2" placeholder="Address continues.." value="{{old('strt_address_2')}}" onkeyup="$('#strt_address_2').attr('style', ''); $('#errorInputAddress2').html('');"></input>
                      <div id="errorInputAddress2" style="color: red;"></div>
                    </div>
                  </div>
                  <div class="row custom-margin">
                    <div class="col-md-4 col-sm-4">
                      <label for="city">City</label> <span style="color: red;">*</span>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <input type="text" name="city" id="city" required="true" placeholder="city" value="{{old('city')}}" onkeyup="$('#city').attr('style', ''); $('#errorInputCity').html('');"></input>
                      <div id="errorInputCity" style="color: red;"></div>
                    </div>
                  </div>
                  <div class="row custom-margin">
                    <div class="col-md-4 col-sm-4">
                      <label for="state">State</label> <span style="color: red;">*</span>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <input type="text" name="state" id="state" required="true" placeholder="state" value="{{old('state')}}" onkeyup="$('#state').attr('style', ''); $('#errorInputState').html('');"></input>
                      <div id="errorInputState" style="color: red;"></div>
                    </div>
                  </div>
                  <div class="row custom-margin">
                    <div class="col-md-4 col-sm-4">
                      <label for="zip">Zip Code</label> <span style="color: red;">*</span>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <input type="text" name="zip" id="zip" required="true" placeholder="Zip Code" value="{{old('zip')}}" onkeyup="$('#zip').attr('style', ''); $('#errorInputZip').html('');"></input>
                      <div id="errorInputZip" style="color: red;"></div>
                    </div>
                  </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Phone:</label> <span style="color: red;">*</span>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="text" id="Phone" placeholder="Format: 123-456-7890" name="personal_phone" value="{{old('personal_phone')}}" onkeyup="$('#Phone').attr('style', ''); $('#errorInputPhone').html('');" />
                      <div id="errorInputPhone" style="color: red;"></div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Cell phone (optional):</label>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="text" id="cellphone" placeholder="Format: 123-456-7890" name="cell_phone" value="{{old('cell_phone')}}" onkeyup="$('#cellphone').attr('style', ''); $('#errorInputCellPhone').html('');"/>
                      <div id="errorInputCellPhone" style="color: red;"></div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Office phone (optional):</label>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="text" id="officephone" placeholder="Format: 123-456-7890" name="office_phone" value="{{old('office_phone')}}" onkeyup="$('#officephone').attr('style', ''); $('#errorInputOfficePhone').html('');" />
                      <div id="errorInputOfficePhone" style="color: red;"></div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-12 col-sm-12">
                      <div class="page_sub_heading">
                      <label>Special Instructions:</label>
                      </div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-12 col-sm-12">
                      <p>
                        We will pick-up and deliver on the designated date but not at a specific time unless specified under specific instructions.  Unless otherwise noted pick-up will be at address listed above.
                      </p>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Default Special Instructions (optional):</label>
                   </div>
                   <div class="col-md-6 col-sm-6">
                    <textarea  cols="30" rows="3" name="spcl_instruction" style="margin-top: 10px;">{{old('spcl_instruction')}}</textarea>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Default Driving Instructions (optional):</label>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <textarea  cols="30" rows="3" name="driving_instruction" style="margin-top: 10px;">{{old('driving_instruction')}}</textarea>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-12 col-sm-12">
                      <div class="page_sub_heading">
                      <label>Credit Card Info:</label>
                      </div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-12 col-sm-12">
                      <p>
                        It is corporate policy to use our services we must have a credit card on file. You may choose another form of payment but for security purposes we need your credit info. <strong>Your credit card is NOT being charged at this time and is only being kept on file for security purposes.</strong>
                      </p>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Card Holder Name:</label> <span style="color: red;">*</span>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="text" style="" id="cardholder" name="cardholder_name"  value="{{ old('cardholder_name') }}" onkeyup="$('#cardholder').attr('style', 'width:270px;'); $('#errorInputCardHolder').html('');" >
                        <div id="errorInputCardHolder" style="color: red;"></div>
                   </div>
                </div>
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">
                      <label>Credit Card No:</label> <span style="color: red;">*</span>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="text" id="card_no" name="card_no" required="" onkeyup="return creditCardValidate();" style="">
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
                   <div class="col-md-4 col-sm-4">
                      <label>Tell Us the Referrer Email (optional) :</label>
                   </div>
                   <div class="col-md-6 col-sm-6">
                      <input type="email" name="ref_name" id="ref_name" value="{{old('ref_name')}}"></input>
                      <div id="email_identifier_noti"></div>
                   </div>
                </div>
                 <div class="row custom-margin">
                  <div class="col-md-12 col-sm-12">
                    <span style="color: red;">Note: </span><strong style="font-size: 14px;">You will become eligible for a discount when the person you recommended signs up at U-Rang.Com and places their first order. If your submission is presently a client, you will not qualify for a discount.</strong><br><br>
                  </div>
                </div>  
                <div class="row custom-margin">
                   <div class="col-md-4 col-sm-4">&nbsp;</div> 
                   <div class="col-md-4 col-sm-4">
                        <button type="submit" style="margin-top: 10px" onclick="IsValid(event);" id="sign_up_cus">Sign Up</button>
                      <input type="hidden" name="_token" value="{{Session::token()}}"></input>
                      <input type="hidden" id="email_checker"></input>
                      <input type="hidden" id="card_no_checker"></input>
                      <input type="hidden" id="email_checker_ref" value="0"></input>
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
    function PassWordCheck() {
       //password and confirm password match function
       $('#password').attr('style', 'width: 270px;');
       $('#conf_password').attr('style', 'width: 270px;')
       $('#errorInputPassword').html("");
       $('#errorInputConfPassword').html("");
       var password = $('#password').val();
       var status='';
       var conf_password = $('#conf_password').val();
       if (password && password.length >= 6) 
       {
          if (password && conf_password) 
          {
             if (password === conf_password) 
             {
                $('#passcheck').html('<br><span style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> password and confirm password matched!</span>');
                   return true;
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
             else
             {
                $('#passcheck').html('<br><span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> password and confirm password did not match! </span>');
                return false;
             }
          }
          else
          {
             $('#passcheck').html('<br><span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> password and confirm password should be same!</span>');
             return false;
          }
       }
       else
       {
          $('#passcheck').html('<br><span style="color:red;"><i class="fa fa-times" aria-hidden="true"></i> password should atleast be 6 charecters!</span>');
          return false;
       }
    }
    function creditCardValidate(){
      $('#card_no').attr('style', 'width:270px;'); 
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
    function IsValidEmail() {
       //return true;
       $('#email').attr('style', 'width: 270px');
       $('#errorInputEmail').html("");
       var email = $('#email').val();
       var isValidEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       if ($.trim(email)) 
       {
          //return isValidEmail.test(email);
          if (isValidEmail.test(email)) 
          {
             //$('#emailExist').html('');
             $.ajax({
                url : "{{route('postEmailChecker')}}",
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
                      $('#emailExist').html("<span style='color:green;'><i class='fa fa-check' aria-hidden='true'></i> Email address is available ! </span>");
                      $('#email_checker').val(data);
                      return true;

                   }
                   else
                   {
                      $('#emailExist').html("<span style='color:red;'><i class='fa fa-times-circle' aria-hidden='true'></i> email already exists! try another one. </span>");
                      $('#email_checker').val(0);
                      return false;
                   }
                   //return data;
                }
             });
          }
          else
          {
             $('#emailExist').html("<span style='color:red;'><i class='fa fa-times-circle' aria-hidden='true'></i> Not A Valid Email Address! </span>");
             return false;
          }
       }
       else
       {
          $('#emailExist').html("<span style='color:red;'><i class='fa fa-times-circle' aria-hidden='true'></i> Please Enter an Email Address! </span>");
          return false;
       }
    }
    //form submit done by this
    function IsValid(event) {
      //$('.login-form').submit();
      //return true;
       event.preventDefault();
       var email = $('#email').val();
       var password = $('#password').val();
       var conf_password = $('#conf_password').val();
       var name = $('#name').val();
       //address line 1
       var add_line_1 = $('#strt_address_1').val();
       //address line 2
       var add_line_2 = $('#strt_address_2').val();
       //city
       var city = $('#city').val();
       //state
       var state = $('#state').val();
       //zip
       var zip = $('#zip').val();
       var phone = $('#Phone').val();
       var name_on_card = $('#cardholder').val();
       var card_number = $('#card_no').val();
       var month_val = $('#select_month').val();
       var year_val = $('#select_year').val();
       var pass_check=PassWordCheck();
       var email_check = $('#email_checker').val();
       var card_no_checker = $('#card_no_checker').val();
       var ref_email_checker = $('#email_checker_ref').val();
       var cellphone = $('#cellphone').val();
       var officephone = $('#officephone').val();
       if ($.trim(email) && $.trim(password) && $.trim(conf_password) && $.trim(name) && $.trim(add_line_1) && $.trim(city) && $.trim(state)&& $.trim(zip) && $.trim(phone) && $.trim(name_on_card) && $.trim(card_number) && $.trim(month_val) && $.trim(year_val)) 
       {
          if(pass_check && $.trim(email_check) == 1 && $.trim(card_no_checker) == 1 && ref_email_checker != 1)
          {
            
            $('.login-form').submit();
            /*var isUs = checkUsPhoneOrNOt(phone, cellphone, officephone);
            console.log(isUs);
            //return;
            if (isUs == 200) {
              
            } else if (isUs == 1)  {
              $('#Phone').attr('style', 'border-color: red;');
              $('#errorInputPhone').html("Phone number is not valid!");
            } else if (isUs == 2) {
              //cell
              $('#cellphone').attr('style', 'border-color: red;');
              $('#errorInputCellPhone').html("Phone number is not valid!");
            } else {
              //office
              $('#officephone').attr('style', 'border-color: red;');
              $('#errorInputOfficePhone').html("Phone number is not valid!");
            }*/
            
          }
         else
         {
            //alert('some error occured form cannot be submitted');
            sweetAlert("Oops..", "Error Occured Hint: 1. make sure password and confirm password is same, 2. Email is available, 3. Credit card number is valid","4. check reference email" ,"error");
            return false;
         }
       } else {
        if (!email) 
        {
          $('#email').attr('style', 'border-color: red;');
          $('#errorInputEmail').html("This Field is Required!");
        }
        if (!password) 
        {
          $('#password').attr('style', 'border-color: red;');
          $('#errorInputPassword').html("This Field is Required!");
        }
        if (!conf_password) 
        {
          $('#conf_password').attr('style', 'border-color: red;');
          $('#errorInputConfPassword').html("This Field is Required!");
        }  
        if (!name) 
        {
            $('#name').attr('style', 'border-color: red;');
            $('#errorInputName').html("This Field is Required!");
        }
        if (!add_line_1) 
        {
          $('#strt_address_1').attr('style', 'border-color: red;');
          $('#errorInputAddress1').html("This Field is Required!");
        }  
        if (!city) {
          $('#city').attr('style', 'border-color: red;');
          $('#errorInputCity').html("This Field is Required!");
        } 
        if (!state) {
          $('#state').attr('style', 'border-color: red;');
          $('#errorInputState').html("This Field is Required!");
        }
        if (!zip) {
          $('#zip').attr('style', 'border-color: red;');
          $('#errorInputZip').html("This Field is Required!");
        }
        if (!phone) 
        {
          $('#Phone').attr('style', 'border-color: red;');
          $('#errorInputPhone').html("This Field is Required!");
        }      
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
    /*function checkUsPhoneOrNOt(phone, cellphone=null, officephone= null) {
      
      var regex = /^(?:\+?1[-. ]?)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      var checkUsCell = true;
      var checkUsOffice = true;

      var checkUsPhone = regex.test(phone);
      
      if ($.trim(cellphone)) {
        checkUsCell = regex.test(cellphone);
      }
      if ($.trim(officephone)) {
        checkUsOffice = regex.test(officephone);
      }
      //console.log(regex.test(phone));
      console.log(checkUsPhone+ " " + checkUsCell + " " + checkUsOffice);
      if (checkUsPhone && checkUsCell && checkUsOffice) {
        return 200;
       } else if (!checkUsPhone) {
        return 1;
       } else if (!checkUsCell) {
        return 2;
       } else {
        return 3;
       }
      //return true;
    }*/
    $(function(){
      $('#ref_name').on('input propertychange',function(){
        var email = $(this).val();
        if (email.length > 0) {
            if ($.trim(email)  && $.trim(email) != $.trim($('#email').val())) {
            $.ajax({
               url : "{{route('postEmailCheckerRef')}}",
                  type: "POST",
                  data: {email: email, _token: "{{Session::token()}}"},
                  success : function(data){
                    if (data == 1) {
                      $('#email_identifier_noti').html('');
                      $('#email_checker_ref').val(0);
                    }
                    else
                    {
                      $('#email_identifier_noti').html('<div style="color:red;">Email is already exist in our databse . Please refer someone else.</div>');
                      $('#email_checker_ref').val(1);
                    }
                  }
            });
          }
          else
          {
            $('#email_identifier_noti').html('<div style="color:red;">Sign Up email and refer email could not be the same</div>');
            $('#email_checker_ref').val(1);
          }
        }
        else {
          return true;
        }
      });
    });

</script>
@endsection