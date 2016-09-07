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

            <h1>Complaints Template</h1>
            <!-- Email Header : BEGIN -->
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
					<td bgcolor="#ffffff">
						<img src="{{$complaintsEmail->cover_image}}" width="600" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 600px;">
                        <br>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <input type="text" name="value" value="{{$complaintsEmail->cover_image}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="cover_image">
                            <br>
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
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
	                            		<div class="container">
	                            			<div class="row">
	                            				<div class="col-xs-5"></div>
	                            				<div class="col-xs-2">
	                            					<img src="http://u-rang.tier5-portfolio.com/public/images/cus_icon.png" alt="customer icon" style="height: 60px; width:60px; margin-left: 222px;margin-top: 10px;">	
	                            				</div>
	                            				<div class="col-xs-5"></div>
	                            			</div>
	                            			<div style="margin-left: 142px;">
	                            				<label for="name"><b>Customer Name:</b> first last</label><br><br>
	                               				<label for="email"><b>Customer Email:</b>email </label><br><br>
	                               				<label for="no"><b>Phone Number:</b>phone </label>
	                            			</div>
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
                                <!-- <td align="center" valign="top" width="50%">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;">
                                        <tr>
                                            <td style="text-align: center; padding: 0 10px;">
                                                <img src="http://placehold.it/200" width="200" alt="" style="border: 0;width: 100%;max-width: 200px;" class="center-on-narrow">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding: 10px 10px 0;" class="stack-column-center">
                                                Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora per conubia nostra, per torquent inceptos&nbsp;himenaeos. 
                                            </td> -->
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Two Even Columns : END -->

                <!-- Clear Spacer : BEGIN -->
                <tr>
                    <td height="40" style="font-size: 0; line-height: 0;">
	                    &nbsp;
                    </td>
                </tr>
                <!-- Clear Spacer : END -->

                <!-- 1 Column Text + Button : BEGIN -->
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
                <!-- 1 Column Text + Button : BEGIN -->

            </table>
            <!-- Email Body : END -->
          
            <!-- Email Footer : BEGIN -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" role="presentation">
                <tr>
                    <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;">
                        <!-- <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion> -->
                        <a href="http://u-rang.tier5-portfolio.com/" target="_blank" style="color: #fff;">Visit our website</a>
                        <br>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <input type="text" name="value" value="{{$complaintsEmail->website_link}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="website_link">
                            <br>
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                        <br><br>
                        U-rang
                        <br>
                        <span class="mobile-link--footer">{{$complaintsEmail->address}}</span>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <input type="text" name="value" value="{{$complaintsEmail->address}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="address">
                            <br>
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                        <br>

                        <span class="mobile-link--footer">{{$complaintsEmail->phone_no}}</span>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <input type="text" name="value" value="{{$complaintsEmail->phone_no}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="phone_no">
                            <br>
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                        <br><br>
                        <unsubscribe style="color:#888888; text-decoration:underline;">{{$complaintsEmail->support_email}}</unsubscribe>
                        <form class="text-center" action="{{route('postComplaintsEmailChange')}}" method="post">
                            <input type="text" name="value" value="{{$complaintsEmail->support_email}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="support_email">
                            <br>
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                    </td>
                </tr>
            </table>
            <!-- Email Footer : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>
<h1>Sign up confirmation</h1>
        <!-- HEADER -->
<table class="head-wrap">
    <tr>
        <td></td>
        <td class="header container">
            
                <div class="content">
                    <table>
                    <tr>
                        <td><img src="http://u-rang.com/images/logo.gif" alt="logo" /></td>
                    </tr>
                </table>
                </div>
                
        </td>
        <td></td>
    </tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

            <div class="content">
            <table>
                <tr>
                    <td>
                        
                        <h3>Welcome, Customer Name</h3>
                        <p class="lead">Thank you for signing up with U-Rang.com. We appreciate your business. Please feel free to reach out to us with any additional questions or concerns. We can be reached via email at Lisa@u-rang.com or by phone at (800)959-5785.</p>
                        
                        <!-- A Real Hero (and a real human being) -->
                        <p><img src="https://media-cdn.tripadvisor.com/media/photo-s/03/9b/2d/f2/new-york-city.jpg" /></p><!-- /hero -->
                        <!-- Callout Panel -->
                        <p class="callout">
                            You have successfully registered with u-rang, new york city's #1 laundry service. <a href="http://u-rang.tier5-portfolio.com/login">Login Now! &raquo;</a>
                        </p><!-- /Callout Panel -->
                        
                        <h3>Your Account Details</h3>
                        <small><b>Login Credentials: </b></small><br/><br/>
                        <p>User email : customer@urang.com</p>
                        <p>Password: password</p>
                        <small><b>Other Details: </b></small><br/><br/>
                        <p>Name: Customer Name</p>
                        <p>Address: Customer Address</p>
                        <p>Phone Number: 0000000</p>
                        <p>Regards, </p>
                        <p>The Team at U-Rang.com</p>
                        <a class="btn" href="http://u-rang.tier5-portfolio.com/">Our Website!</a>
                                                
                        <br/>
                        <br/>                           
                                                
                        <!-- social & contact -->
                        <table class="social" width="100%">
                            <tr>
                                <td>
                                    
                                    <!--- column 1 -->
                                    <table align="left" class="column">
                                        <tr>
                                            <td>                
                                                
                                                <h5 class="">Connect with Us:</h5>
                                                <p class=""><a href="#" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #3B5998!important;">Facebook</a> <a href="#" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #1daced!important;">Twitter</a> <a href="#" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #DB4A39!important;">Google+</a></p>
                        
                                                
                                            </td>
                                        </tr>
                                    </table><!-- /column 1 -->  
                                    
                                    <!--- column 2 -->
                                    <table align="left" class="column">
                                        <tr>
                                            <td>                
                                                                            
                                                <h5 class="">Contact Info:</h5>                                             
                                                <p>Phone: <strong>(800)959-5785</strong><br/>
                Email: <strong><a href="emailto:lisa@u-rang.com">lisa@u-rang.com</a></strong></p>
                
                                            </td>
                                        </tr>
                                    </table><!-- /column 2 -->
                                    
                                    <span class="clear"></span> 
                                    
                                </td>
                            </tr>
                        </table><!-- /social & contact -->
                    
                    
                    </td>
                </tr>
            </table>
            </div>
                                    
        </td>
        <td></td>
    </tr>
</table><!-- /BODY -->

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
                            <small>©2016 PAPER'D MEDIA, INC.. ALL RIGHTS RESERVED</small>
                        </p>
                    </td>
                </tr>
            </table>
                </div><!-- /content -->
                
        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->

<h1>Reset Password Email</h1>

Hey, here is ur link 
<a href="http://u-rang.tier5-portfolio.com/confirm-reset-password/UNIQUE-ID">http://u-rang.tier5-portfolio.com/confirm-reset-password/UNIQUE-ID</a>

    </center>
@endsection