@extends('pages.layouts.master-stand-alone')
@section('content')
<section class="top-header services-header with-bottom-effect transparent-effect dark">
   <div class="bottom-effect"></div>
   <div class="header-container wow fadeInUp">
      <div class="header-title">
         <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
         <div class="title">our services</div>
         <a href="" id="scroll_here"></a>
         <em>Concierge Dry Cleaning Service<br>
         Owned and Operated Facility in Manhattan</em>
      </div>
   </div>
   <!--container-->
</section>
<!-- ========================== -->
<!-- SERVICES - STEPS  -->
<!-- ========================== -->
<section class="core-features-section">
   <div class="container">
      <div class="section-heading">
         <div class="section-title">
            <?php
               if ($data != null) {
                  switch ($data->identifier) {
                     case '0':
                        echo "Dry Clean";
                        break;
                     case '1':
                        echo "Wash And Fold";
                        break;
                     case '2':
                        echo "Corporate";
                        break;
                     case '3':
                        echo "Tailoring";
                        break;
                     case '4':
                        echo "Wet Cleaning";
                        break;
                     default:
                        echo "Core Services";
                        break;
                  }
               } 
               else
               {
                  echo "Core Services";
               }
            ?>
         </div>
         <div class="section-subtitle">your personal concierge</div>
         <div class="design-arrow"></div>
      </div>
   </div>
   <hr>
   <div class="container tab-content wow fadeInUp">
      <div role="tabpanel" class="tab-pane active" id="tabDry">
         <div class="row">
            <div style="height: 80px;"></div>
            <div class="col-md-6 col-sm-6 text-center">
            	@if($data != null && $data->background_image!= null)
			        <img src="{{url('/')}}/public/dump_images/{{$data->background_image}}" class="img-responsive" style="height: 350px; width: 520px; ">
			    @else
			        <img src="{{url('/')}}/public/images/no_image.jpg" class="img-responsive" alt="dry clean page image">
			    @endif
            </div>
            <div class="col-md-6">
               <h5 class="italic-title">{{$data != null && $data->page_heading != null ? $data->page_heading : "Default Heading"}}</h5>
               <p>
                  {!! $data != null && $data->content != null ? $data->content : "Page Default Content" !!}
               </p>
               <!-- <ul class="marker-list">
                  <li>Commodo consequt. Duis aute irure dolor reprehenderit </li>
                  <li>Atetur adipisicing elit sed do eiusmod tempor incididunt ut labore dolore</li>
                  <li>Pliqua ut enim ad mid veniam quis nostrud exercitation ullamco</li>
                  <li>Voluptate velit esse cillum dolore fugiat lore ipsum dolor sit amet </li>
                  <li>Amco laboris nisi ut aliquip xea commodo consequt </li>
                  </ul>-->
            </div>
            <div class="col-md-12">
               <div style="height: 40px;"></div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   $('html, body').animate({
        scrollTop: $('#scroll_here').offset().top
    }, 'slow');
</script>
@endsection