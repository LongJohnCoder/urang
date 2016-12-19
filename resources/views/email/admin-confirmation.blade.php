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
						<td><img src="http://u-rang.com/images/logo.gif" alt="logo" /></td>
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

						<h3>Hey,</h3>
						<p class="lead">A new user have just signed up on <a href="{{URL::to('/')}}">U-rang &raquo;</a></p>

						<!-- A Real Hero (and a real human being) -->
						<p><img src="{{$complaints->image_link}}" /></p><!-- /hero -->
						<!-- Callout Panel -->


						<h3>User's Account Details</h3>
						<small><b>Login Credentials: </b></small><br/><br/>
						<p>User email : {{$email}}</p>
						<small><b>Other Details: </b></small><br/><br/>
						<p>Name: {{$name}}</p>
						<p>Address: {{$address}}</p>
						<p>Phone Number: {{$ph}}</p>


						<br/>
						<br/>

						


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
