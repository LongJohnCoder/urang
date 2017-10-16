@extends('pages.layouts.master-neighborhood-single')
@section('content')
<section class="top-header neighborhood-header with-bottom-effect transparent-effect dark">
   <div class="bottom-effect"></div>
   <div class="header-container wow fadeInUp">
      <div class="header-title">
         <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
         <div class="title">neighborhoods</div>
         <em>Concierge Dry Cleaning Service<br>
         Owned and Operated Facility in Manhattan</em>
      </div>
   </div>
   <!--container-->
</section>
<!-- ========================== -->
<!-- HOME - LATEST WORKS -->
<!-- ========================== -->
<!-- <section class="latest-works-section clearfix">
   <div class="container">
      <div class="section-heading">
         <div class="section-title">Neighborhoods We Service</div>
         <div class="section-subtitle"></div>
         <div class="design-arrow"></div>
      </div>
   </div>
   <div class="scroll-pane ">
      <div class="scroll-content">
         @if(count($neighborhood) > 0)
         @foreach($neighborhood as $n)
         <div class="scroll-content-item">
            <img src="{{url('/')}}/public/dump_images/{{$n->image}}" alt="image" style="height: 350px; width: 520px;" />
            <div class="scroll-content-body">
               <div class="name" style="color: #ff6400;">{{$n->name}}</div>
            </div>
         </div>
         @endforeach
         @else
         No Data
         @endif
      </div>
      <div class="scroll-bar-wrap ">
         <div class="scroll-bar"></div>
      </div>
   </div> -->
</section>
<a href="" id="scroll_here_n"></a>
<section class="areas-section with-icon with-top-effect">
<div class="section-icon"><span class="icon icon-Umbrella"></span></div>
	<div class="container">
	  <div class="row">
	     <div class="col-md-7 col-sm-7 text-right">
	        <div class="clearfix " style="padding-right: 3px;">
	           <div class="above-title"></div>
	           <h1 class="main-title">{{$find->name}}</h1>
	        </div>
	        <div class="design-arrow inline-arrow"></div>
	        <p>
	        <ul style="text-align: left; font-size: 12px; font-weight: 100; line-height: 16px; font-family: 'Raleway', sans-serif; margin: 0 0 2.14em;">
	        <p>{!!$find->description!!}</p>
	     </div>
	     <div style="height: 60px;"></div>
	     <div class="col-md-5 col-sm-5 text-center">
	        <img src="{{url('/')}}/public/dump_images/{{$find->image}}" alt="image" class="img-responsive" style="height: 350px width: 520px" />
	     </div>
	  </div>
	</div>
</section>
<script type="text/javascript">
   $(document).ready(function(){
      $('html, body').animate({
         scrollTop: $('#scroll_here_n').offset().top
      }, 'slow');
   });
</script>
@endsection
