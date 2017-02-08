@extends('admin.layouts.master')
@section('content')
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        
        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        /* What is does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }
        
        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
                
        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto; 
        }
        
        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }
        
        /* What it does: A work-around for iOS meddling in triggered links. */
        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color:inherit !important;
            text-decoration: underline !important;
        }
      
    </style>
    
    <!-- Progressive Enhancements -->
    <style>
        
        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }
        .reset-password{
            background: #fff;
            padding: 20px;
            margin: 40px 0;
            text-align: left;
        }

        .social{
            display: inline-block;
            width: 40%;
        }

        .tblheading{
            background: #fff;
            margin: 20px 0 10px;
            text-align: left;
            display: inline-block;
            width: 100%;
            padding: 20px;
            border-top: 5px solid #666;
        }

        .tblheading h1, .reset-password h1{
            font-size: 25px;
            display: inline-block;
            color: #666;
            padding-bottom: 10px;
            margin-top: 10px;
        }

        .tblheading img{
            float: right;
            display: inline-block;
        }
        .form-group{background:#F0F0F0; padding: 15px 0;}
        input[type="text"]{border: 1px solid #ccc; padding: 5px;}
        textarea.form-control{border: 1px solid #ccc; padding: 5px; border-radius: 0px;}
        .login{background:#ff6400; border: none; color: #fff; padding: 5px; display: inline-block;}
        .login:hover{color: #fff; text-decoration: none;}

    </style>



    <center style="width: 100%; background: #e4e1e1;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            (Optional) Email From U-rang.
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!--    
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
            2. MSO tags for Desktop Windows Outlook enforce a 600px width.
        -->
        <div style="max-width: 600px; margin: auto;">
            <!--[if mso]>
            <table cellspacing="0" cellpadding="0" border="0" width="600" align="center">
            <tr>
            <td>
            <![endif]-->
            <div class="tblheading">
                <h1>Complaints Template</h1>
                <img src="http://u-rang.com/public/images/logo.png" alt="u-rang logo" class="img-responsive">
            </div>
            <!-- Email Header : BEGIN -->
            <!-- <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;" role="presentation">
                <tr>
                    <td style="padding: 20px 0; text-align: center">
                        <img src="http://u-rang.tier5-portfolio.com/public/new/img/logo-white.png" width="200" height="50" alt="u-rang logo" border="0">
                    </td>
                </tr>
            </table> -->
            <!-- Email Header : END -->
            
            <!-- Email Body : BEGIN -->
            
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="width: 100%;" role="presentation">
                
                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <img src="{{$complaintsEmail->cover_image}}" width="600" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 600px;">
                        <br><br>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" type="text" name="value" value="{{$complaintsEmail->cover_image}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="cover_image">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>    
                        </form>
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                    <section name="customer_details" style="background:#d3d3d3;height: 250px;border-radius: 10px;">
                                            <div class="row">
                                                <div class="col-md-5"></div>
                                                <div class="col-md-2">
                                                    <img src="http://u-rang.tier5-portfolio.com/public/images/cus_icon.png" alt="customer icon" style="height: 60px; width:60px;margin-top: 10px;"> 
                                                </div>
                                                <div class="col-md-5"></div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <label for="name"><b>Customer Name:</b> first last</label><br><br>
                                                <label for="email"><b>Customer Email:</b>email </label><br><br>
                                                <label for="no"><b>Phone Number:</b>phone </label>
                                            </div>
                                    </section>
                                    <br><br>
                                    <!-- Button : Begin -->
                                    <!-- <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;">
                                        <tr>
                                            <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                                                <a href="http://www.google.com" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">A Button</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </a>
                                            </td>
                                        </tr>
                                    </table> -->
                                    <!-- Button : END -->
                                    <br>
                                    <!-- Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat. -->
                                </td>
                                </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : BEGIN -->
               
                <!-- 2 Even Columns : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff" align="center" height="100%" valign="top" width="100%" style="padding-bottom: 40px">
                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:560px;">
                            <tr>
                                <td align="center" valign="top" width="50%">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;">
                                        <tr>
                                            <td style="text-align: center; padding: 0 10px;">
                                                <img src="http://u-rang.tier5-portfolio.com/public/images/com_small.png" alt="complaint_logo" style="height: 100px;" class="center-on-narrow">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding: 10px 10px 0;" class="stack-column-center">
                                                complain body
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                                <textarea name="value" class="form-control" rows="10">
                                    {{$complaintsEmail->company_info}}
                                </textarea>
                                    <input type="hidden" name="_token" value="{{Session::token()}}">
                                    <input type="hidden" name="field_to_update" value="company_info">
                                    <br>
                                    <button type="submit" class="btn btn-info btn-sm">Change</button>
                                </form>
                                </td>
                                </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;" bgcolor="#ffffff">
                        <!-- <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion> -->
                        <a href="http://u-rang.tier5-portfolio.com/" target="_blank" style="">Visit our website</a>
                        <br>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" type="text" name="value" value="{{$complaintsEmail->website_link}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="website_link">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>    
                        </form>
                        <br><br>
                        <strong>U-rang</strong>
                        <br>
                        <span class="mobile-link--footer">{{$complaintsEmail->address}}</span>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <div class="form-group">
                            <input required="required" type="text" name="value" value="{{$complaintsEmail->address}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="address">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                            </div>
                        </form>
                        <br>

                        <span class="mobile-link--footer">{{$complaintsEmail->phone_no}}</span>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <div class="form-group">
                            <input required="required" type="text" name="value" value="{{$complaintsEmail->phone_no}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="phone_no">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                            </div>
                        </form>
                        <br><br>
                        <unsubscribe style="color:#888888; text-decoration:underline;">{{$complaintsEmail->support_email}}</unsubscribe>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <div class="form-group">
                            <input required="required" type="text" name="value" value="{{$complaintsEmail->support_email}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="support_email">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
                <!-- Two Even Columns : END -->


                <!-- 1 Column Text + Button : BEGIN -->
                
                <!-- 1 Column Text + Button : BEGIN -->

            </table>
            <!-- Email Body : END -->
          
            <!-- Email Footer : BEGIN -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" role="presentation">
                
            </table>
            <!-- Email Footer : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
<div class="tblheading">            
    <h1>Sign up confirmation</h1>
    <img src="http://u-rang.com/public/images/logo.png" alt="logo" class="img-responsive" />
</div>
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

            <div class="content">
            <table>
                <tr>
                    <td>
                        
                        <h3>Welcome, Customer Name</h3>
                        <p class="lead">
                        <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                            <textarea name="value" class="form-control">
                                {{$signup_temp->first_writeup}}
                            </textarea>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="first_writeup">
                            <br>
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                        </p>
                        
                        <!-- A Real Hero (and a real human being) -->
                        <p><img src="{{$signup_temp->image_link}}" />
                        <br>
                        <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" type="text" name="value" class="" value="{{$signup_temp->image_link}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_link">
                           
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                            </div>
                        </form>
                        </p><!-- /hero -->
                        <!-- Callout Panel -->
                        <p class="callout" style="text-align:center">
                            You have successfully registered with u-rang, new york city's #1 laundry service. <a class="login" href="{{$signup_temp->login_link}}">Login Now! &raquo;</a>
                            <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                            <div class="form-group">
                                <input required="required" type="text" name="value" class="" value="{{$signup_temp->login_link}}">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <input type="hidden" name="field_to_update" value="login_link">
                                
                                <button type="submit" class="btn btn-info btn-sm">Change</button>
                                </div>
                            </form>
                        </p><!-- /Callout Panel -->
                        
                        <h3>Your Account Details</h3>
                        <div style="width:48%; float:left">
                        <small><b>Login Credentials: </b></small><br/><br/>
                        <p>User email : customer@urang.com</p>
                        <p>Password: password</p>
                        </div>
                        <div style="width:48%; float:left">
                        <small><b>Other Details: </b></small><br/><br/>
                        <p>Name: Customer Name</p>
                        <p>Address: Customer Address</p>
                        <p>Phone Number: 0000000</p>
                        <p>Regards, </p>
                        <p>The Team at U-Rang.com</p>
                        <a class="" href="{{$signup_temp->website_link}}">Our Website!</a>
                        </div>
                        <div style="clear:both;"></div>
                        <br>
                        <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                                <div class="form-group">
                                <input required="required" type="text" name="value" class="" value="{{$signup_temp->website_link}}">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <input type="hidden" name="field_to_update" value="website_link">
                                
                                <button type="submit" class="btn btn-info btn-sm">Change</button>
                                </div>
                            </form>                    
                        <br/>
                        <br/>                           
                                                
                        <!-- social & contact -->
                        <div class="social">
                            <h5 class="">Connect with Us:</h5>
                            <p class="">

                            <a href="{{$signup_temp->fb_link}}" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #3B5998!important;">Facebook</a>
                            
                            <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                            <div class="form-group">
                                <input required="required" type="text" name="value" class="" value="{{$signup_temp->fb_link}}" style="width:65%">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <input type="hidden" name="field_to_update" value="fb_link">
                                
                                <button type="submit" class="btn btn-info btn-sm">Change</button>
                                </div>
                            </form>
                            <br>
                             <a href="{{$signup_temp->twitter_link}}" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #1daced!important;">Twitter</a>
                             
                            <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                            <div class="form-group">
                                <input required="required" type="text" name="value" class="" value="{{$signup_temp->twitter_link}}" style="width:65%;">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <input type="hidden" name="field_to_update" value="twitter_link">
                                
                                <button type="submit" class="btn btn-info btn-sm">Change</button>
                                </div>
                            </form>
                            <br>

                              <a href="{{$signup_temp->google_link}}" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #DB4A39!important;">Google+</a></p>

                            
                            <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                            <div class="form-group">

                                <input required="required" type="text" name="value" class="" value="{{$signup_temp->google_link}}" style="width:65%;">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <input type="hidden" name="field_to_update" value="google_link">
                                
                                <button type="submit" class="btn btn-info btn-sm">Change</button>

                             </div>   
                            </form>
                            <br>
                        </div>
                        <div class="social pull-right text-right"> 
                            <h5 class="">Contact Info:</h5>             
                            <p>Phone: <strong>{{$signup_temp->phone_no}}</strong>
                            <br>
                            <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                            <div class="form-group">
                                <input required="required" type="text" style="width:65%" name="value" class="" value="{{$signup_temp->phone_no}}">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <input type="hidden" name="field_to_update" value="phone_no">
                                
                                <button type="submit" class="btn btn-info btn-sm">Change</button>
                            </div>    
                            </form>
                            
                            <br/>Email: <strong><a href="{{$signup_temp->email_link}}">{{$signup_temp->email_link}}</a>
                            <br>
                            <form class="text-center" action="{{route('postSignUpEmailChange')}}" method="post">
                            <div class="form-group">
                                <input required="required" type="text" name="value" class="" value="{{$signup_temp->email_link}}" style="width:65%;">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <input type="hidden" name="field_to_update" value="email_link">
                                
                                <button type="submit" class="btn btn-info btn-sm">Change</button>
                            </div>    
                            </form>
                            <br></strong></p>
                        </div>
                                    
                                </td>
                            </tr>
                        </table><!-- /social & contact -->
                    </td>
                </tr>
            </table>               

<div class="tblheading">            
    <h1>Pick up confirmation</h1>
    <img src="http://u-rang.com/public/images/logo.png" alt="logo" class="img-responsive" />
</div>
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

            <div class="content">
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;" role="presentation">
                <tr>
                    <td style="padding: 20px 0; text-align: center">
                        <img src="http://u-rang.tier5-portfolio.com/public/new/img/logo-white.png" width="200" height="50" alt="u-rang logo" border="0">
                    </td>
                </tr>
            </table>
            <!-- Email Header : END -->
            
            <!-- Email Body : BEGIN -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;" role="presentation">
                
                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff" style="text-align: center;">
                        <p><h2 style="color: #ff6400;">Hey USERNAME, <br>{{$order_confirm->thank_you_text}}</h2></p>
                        <form class="text-center" action="{{route('postOrderConfirmEmailChange')}}" method="post">
                                <textarea name="value" class="form-control" rows="2">
                                    {{$order_confirm->thank_you_text}}
                                </textarea>
                                    <input type="hidden" name="_token" value="{{Session::token()}}">
                                    <input type="hidden" name="field_to_update" value="thank_you_text">
                                    <br>
                                    <button type="submit" class="btn btn-info btn-sm">Change</button>
                                </form>
                        <img src="{{$order_confirm->image_link}}" alt="alt_text" border="0" align="center" style="width: 40%; max-width: 600px;">
                        <form class="text-center" action="{{route('postOrderConfirmEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" type="text" name="value" class="" value="{{$order_confirm->image_link}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_link">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>    
                        </form>
                    </td>
                </tr>
                
                <tr>
                    <td bgcolor="#ffffff" align="center" height="100%" valign="top" width="100%" style="padding-bottom: 40px">
                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:560px;">
                            <tr>
                                <td align="center" valign="top" width="50%">
                                    <table cellspacing="0" cellpadding="0" border="0" width="90%" style="font-size: 14px;text-align: left;">
                                        <tr>
                                            <td>
                                                <div class="row"  style="margin-top: 20px;">
                                                    <div class="col-xs-6" style="font-size: 18px;">
                                                        <label for="cus_details" style="color: #ff6400;"><b>Customer Details:</b></label><br/>
                                                        <label style="font-weight:400; font-size:16px;" for="customer_name">
                                                        <strong>Name:</strong> USERNAME</label><br/>
                                                        <label style="font-weight:400; font-size:16px;" for="customer_email">
                                                        <strong>Email:</strong> EMAIL</label><br/>
                                                        <label style="font-weight:400; font-size:16px;" for="customer_no">
                                                        <strong>Phone Number:</strong> PHONE NO</label><br/><br/>
                                                    </div>
                                                    <div class="col-xs-6" style="font-size: 18px;">
                                                        <label for="cus_details" style="color: #ff6400;"><b>Order Details:</b></label><br/>
                                                        <label style="font-weight:400; font-size:16px;" for="invoice_no">
                                                        <strong>Invoice #:</strong> INVOICE DETAILS</label><br/>
                                                        <label style="font-weight:400; font-size:16px;" for="date"><strong>Date:</strong> DATE_TODAY</label><br/>
                                                        <label style="font-weight:400; font-size:16px;" for="coupon">
                                                        <strong>Coupon Applied:</strong> COUPON</label><br/><br/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row1">
                                                    <div class="wrapper" style="font-size: 18px;">
                                                        <label for="order_details" style="color: #ff6400;"><b>Break Down:</b></label>
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Item</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                TABLE DATA
                                                            </tbody>
                                                        </table>
                                                    </div><br>
                                            </div>
                                            </td>
                                            </tr>            

                                                        
                                                    <div class="col-xs-6 pull-right" style="padding-right: 10px;">
                                                        <label for="subtotal">Subtotal: TOTAL AMOUNT</label><br/>
                                                        <label for="discount">Discount: DISCOUNT AMOUNT</label><br/>
                                                        <label for="total">Total: TOTAL </label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    
                                                    <div class="col-xs-12">
                                                        <table width="100%;">
                                                            <tr>
                    <td style="padding: 0 10px 40px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;">
                        <!-- <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion> -->
                        <a href="{{$order_confirm->website_link}}" target="_blank" style="">Visit our website</a>
                        <form class="text-center" action="{{route('postOrderConfirmEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" type="text" name="value" class="" value="{{$order_confirm->website_link}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="website_link">
                           
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>    
                        </form>
                        <br><br>
                        U-rang1<br><span class="mobile-link--footer">{{$order_confirm->address}}</span>
                        <form class="text-center" action="{{route('postOrderConfirmEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" name="value" class="form-control" value="{{$order_confirm->address}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="address">
                            <br>
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>    
                        </form>
                        <br>
                        <span class="mobile-link--footer">{{$order_confirm->phone_no}}</span>
                        <form class="text-center" action="{{route('postOrderConfirmEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" type="text" name="value" class="" value="{{$order_confirm->phone_no}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="phone_no">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>    
                        </form>
                        <br><br>
                        <unsubscribe style="color:#888888; text-decoration:underline;">{{$order_confirm->support_email}}</unsubscribe>
                        <form class="text-center" action="{{route('postOrderConfirmEmailChange')}}" method="post">
                        <div class="form-group">
                            <input required="required" type="text" name="value" class="" value="{{$order_confirm->support_email}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="support_email">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>    
                        </form>
                    </td>
                </tr>

                                                        </table>

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
            </table>
            <!-- Email Body : END -->
          
            <!-- Email Footer : BEGIN -->
            
                
            


    <div class="reset-password">
        <h1>Reset Password Email</h1>
        <p>{{$forget_pass->write_up}} <a href="http://u-rang.com/confirm-reset-password/<UNIQUE-ID>">http://u-rang.com/confirm-reset-password/UNIQUE-ID</a>

        .
        <br>
        <form class="text-center" action="{{route('postForgotPasswordEmailChange')}}" method="post">
            <div class="form-group">
            <input required="required" type="text" name="value" value="{{$forget_pass->write_up}}">
            <input type="hidden" name="_token" value="{{Session::token()}}">
            <input type="hidden" name="field_to_update" value="write_up">
            
            <button type="submit" class="btn btn-info btn-sm">Change</button>
            </div>
        </form>

        </p>
    </div>
</div>






<!-- FOOTER -->
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">
            
                <!-- content -->
                <div class="content">
                <table>
                <tr>
                    <td align="center">
                        <p>
                            <!-- <a href="#">Terms</a> |
                            <a href="#">Privacy</a> |
                            <a href="#"><unsubscribe>Unsubscribe</unsubscribe></a> -->
                            
                        </p>
                    </td>
                </tr>
            </table>
                </div><!-- /content -->
                
        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->



@endsection