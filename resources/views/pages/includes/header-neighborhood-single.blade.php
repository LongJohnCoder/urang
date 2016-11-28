<?php
	$query_url = $_SERVER['REQUEST_URI'];
	$search_keyword = explode('/', $query_url)[3];
	$seo_data = App\Helper\NavBarHelper::getSeoDetailsNeighborhoodSingle($search_keyword);
?>
<title>{{ $seo_data!= false ? $seo_data->page_title : "U-rang|Neighborhoods"}}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="cache-control" content="private, max-age=0, no-cache">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta name="description" content="{{ $seo_data!= false ? $seo_data->meta_description : 'U-rang neighborhoods'}}">
<meta name="keywords" content="{{ $seo_data!= false ? $seo_data->meta_keywords : 'U-rang neighborhoods'}}">
<!-- fav icon -->
<link rel="icon" type="image/png" href="{{url('/')}}/public/favicon.ico">
<!-- Styles -->
<link href="{{url('/')}}/public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,300' rel='stylesheet' type='text/css'>
<link href="{{url('/')}}/public/new/fonts/Stroke-Gap-Icons-Webfont/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/style_user.min.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/jquery-ui.min.css">
<!-- components -->
<link href="{{url('/')}}/public/new/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/public/new/vendor/owl-carousel/owl-carousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/public/new/vendor/slider-pro/dist/css/slider-pro.min.css" rel="stylesheet" type="text/css" /> 
<link href="{{url('/')}}/public/new/vendor/slick-carousel/slick/slick.min.css" rel="stylesheet" type="text/css" /> 
<link href="{{url('/')}}/public/new/vendor/animate.css/animate.min.css" rel="stylesheet" type="text/css" /> 
<link href="{{url('/')}}/public/new/css/main.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/sweetalert.min.css"/>
<link type="text/css" href="{{url('/')}}/public/new/css/jquery.jscrollpane.min.css" rel="stylesheet" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/js/time-picker/jquery.timepicker.min.css">

<!--js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{url('/')}}/public/new/vendor/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/waypoints/lib/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/slider-pro/dist/js/jquery.sliderPro.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/slick-carousel/slick/slick.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/smooth-scroll/smooth-scroll.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/vendor/wow/dist/wow.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/js/modernizr.min.js" type="text/javascript"></script>

<!-- custom scripts -->
<script src="{{url('/')}}/public/new/js/contact.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/js/custom.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/public/new/js/map.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{url('/')}}/public/js/jquery.creditCardValidator.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/public/js/main.min.js"></script>

<script src="{{url('/')}}/public/js/jquery-ui.min.js"></script>

<script type="text/javascript" src="{{url('/')}}/public/js/sweetalert.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/public/new/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/public/new/js/jquery.jscrollpane.min.js"></script>
<!--time js-->
<script type="text/javascript" src="{{url('/')}}/public/js/time-picker/jquery.timepicker.min.js"></script>
<script>
	$(document).ready(function() {
		var $scrollingDiv = $(".sticky-text");
		$(window).scroll(function(){			
			$scrollingDiv
				.stop()
				.animate({"top": ($(window).scrollTop() + 136) + "px"
			}, 500 );

			$scrollingDiv.css("position","absolute");
		});
	});
</script>