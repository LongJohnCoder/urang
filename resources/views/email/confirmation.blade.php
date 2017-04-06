<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- If you delete this tag, the sky will fall on your head -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Confirmation Email | U-rang 2016</title>
</head>

<body bgcolor="#FFFFFF">

<!-- HEADER -->
<table class="head-wrap">
	<tr>
		<td></td>
		<td class="header container">

				<div class="content">
					<table>
					<tr>
						<td><img src="https://www.u-rang.com/public/new/img/logo.png" alt="logo" /></td>
					</tr>
				</table>
				</div>

		</td>
		<td></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->

		<?php
            $complaints = \App\EmailTemplateSignUp::first();

            ?>
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

			<div class="content">
			<table>
				<tr>
					<td>

						<h3>Welcome, {{$name}}</h3>
						<p class="lead">{{$complaints->first_writeup}}</p>

						<!-- A Real Hero (and a real human being) -->
						<p><img src="{{$complaints->image_link}}" /></p><!-- /hero -->
						<!-- Callout Panel -->
						<p class="callout">
							You have successfully registered with u-rang, new york city's #1 laundry service. <a href="{{URL::to('login')}}">Login Now! &raquo;</a>
						</p><!-- /Callout Panel -->

						<h3>Your Account Details</h3>
						<small><b>Login Credentials: </b></small><br/><br/>
						<p>User email : {{$email}}</p>
						<p>Password: {{$password}}</p>
						<small><b>Other Details: </b></small><br/><br/>
						<p>Name: {{$name}}</p>
						<p>Address: {{$address}}</p>
						<p>Phone Number: {{$ph}}</p>
						<p>Regards, </p>
						<p>The Team at U-Rang.com</p>
						<a class="btn" href="{{URL::to('/')}}">Our Website!</a>

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
												<p class=""><a href="{{$complaints->fb_link}}" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #3B5998!important;">Facebook</a> <a href="{{$complaints->twitter_link}}" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #1daced!important;">Twitter</a> <a href="{{$complaints->google_link}}" style="padding: 3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color: #FFF;font-weight:bold;display:block;text-align:center;background-color: #DB4A39!important;">Google+</a></p>


											</td>
										</tr>
									</table><!-- /column 1 -->

									<!--- column 2 -->
									<table align="left" class="column">
										<tr>
											<td>

												<h5 class="">Contact Info:</h5>
												<p>Phone: <strong>{{$complaints->phone_no}}</strong><br/>
                Email: <strong><a href="{{$complaints->email_link}}">{{$complaints->email_link}}</a></strong></p>

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

						</p>
					</td>
				</tr>
			</table>
				</div><!-- /content -->

		</td>
		<td></td>
	</tr>
</table><!-- /FOOTER -->

</body>
</html>
