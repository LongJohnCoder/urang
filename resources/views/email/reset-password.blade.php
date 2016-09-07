<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	$reset = \App\EmailTemplateForgetPassword::first();
?>
{{$reset->write_up}} 
<a href="{{url('/')}}/confirm-reset-password/{{base64_encode($id)}}">{{url('/')}}/confirm-reset-password/{{base64_encode($id)}}</a>
</body>
</html>