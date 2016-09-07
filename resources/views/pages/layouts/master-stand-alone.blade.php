<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.includes.stand-alone-header')
</head>
<body data-scrolling-animations="true">
	@if(auth()->guard('users')->user())
		@include('pages.includes.navbaruser')
	@else
		@include('pages.includes.navbar')
	@endif
	@yield('content')
    @include('pages.includes.footer')
</body>
</html>