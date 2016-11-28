<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.includes.header-neighborhood-single')
</head>
<body data-scrolling-animations="true">
	<?php
		$login_check = false;
		if(App\Helper\NavBarHelper::getCustomerData())
			$login_check = true;
		else
			$login_check = false;
	?>
	@include($login_check == true ? 'pages.includes.navbaruser' : 'pages.includes.navbar')
	@yield('content')
    @include('pages.includes.footer')
</body>
</html>