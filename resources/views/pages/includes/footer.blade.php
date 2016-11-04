<footer>
   <!-- ========================== -->
   <!-- SECTION -->
   <!-- ========================== -->
   <?php
      $indexcontent = App\IndexPageWysiwyg::first();
    ?>
    <style type="text/css">
         .footer-text {
            text-align: center;
         }
    </style>
   <section class="buy-section with-icon">
      <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
      <div class="container">
         <div class="row">
            <div class="col-md-8 col-md-offset-1 col-sm-9 wow fadeInLeft">
               <div class="section-text">
                  <div class=" vcenter like">
                     <span class="icon icon-Like"></span> 
                  </div>
                  <div class="buy-text vcenter">
                     <div class="top-text">{{$indexcontent->section_six_first_text}}</div>
                     <div class="bottom-text">{{$indexcontent->section_six_second_text}}</div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-3  wow fadeInRight">
               <a href="{{route('getSignUp')}}" class="btn btn-info ">Sign-Up Now</a>
            </div>
         </div>
      </div>
   </section>
   <!-- ========================== -->
   <!-- FOOTER - FOOTER -->
   <!-- ========================== -->
   <section class="footer-section">
      <div class="container">
         <div class="row">
            <div class="col-md-3 col-sm-3">
               <h5>{{$indexcontent->footer_section_one_header}}</h5>
               <p>{{$indexcontent->footer_section_one_first}}</p>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>{{$indexcontent->footer_section_two_header}}</h5>
               <div class="row">
                  <div class="col-md-6">
                     <ul class="footer-nav">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('index')}}">About Us</a></li>
                        <li><a href="{{route('getLogin')}}">Login</a></li>
                        <li><a href="{{route('getSignUp')}}">Sign-Up</a></li>
                        <li><a href="{{url('/')}}/sitemap.xml">sitemap</a></li>
                     </ul>
                  </div>
                  <div class="col-md-6">
                     <ul class="footer-nav">
                        <li><a href="{{route('getNeiborhoodPage')}}">Neighborhoods</a></li>
                        <li><a href="{{route('getPrices')}}">Prices</a></li>
                        <li><a href="{{route('getFaqList')}}">FAQ's</a></li>
                        <li><a href="{{ route('getContactUs') }}">Contact us</a></li>
                        <li><a href="{{route('getMobileAppPage')}}">Mobile App</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>{{$indexcontent->footer_section_three_header}}</h5>
               <ul class="contacts-list">
                  <li>
                     <p><i class="icon icon-House"></i>{{$indexcontent->footer_section_three_first}}
                     </p>
                  </li>
                  <li>
                     <p><i class="icon icon-Phone2"></i>{{$indexcontent->footer_section_three_second}}</p>
                  </li>
                  <li>
                     <p><i class="icon icon-Mail"></i><a href="mailto:{{\App\Helper\ConstantsHelper::getClintEmail()}}">{{$indexcontent->footer_section_three_third}}</a> </p>
                  </li>
               </ul>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>{{$indexcontent->footer_section_four_header}}</h5>
               <ul class="contacts-list">
                  <li>
                     <p><i class="icon icon-House"></i>{{$indexcontent->footer_section_four_first}}
                     </p>
                  </li>
                  <li>
                       <a href='https://play.google.com/store/apps/details?id=us.tier5.u_rang&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1' target="_blank"><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' style="height: 70px;" /></a>
                  </li>
                  <li>
                       <a href="#" target="_blank"><img alt='Get it on Google Play' src='{{url('/')}}/public/new/img/mobile-app/appstore.png' style="height: 70px;" /></a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   <section class="copyright-section">
      <p class="footer-text">©2016 <span>Paper'd Media, Inc.</span>. All Rights Reserved</p>
   </section>
</footer>
<script src="{{url('/')}}/public/new/js/custom.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function(){
      var block_status = "";
      block_status = '{{auth()->guard("users")->user() != null ? auth()->guard("users")->user()->block_status : 0}}';
      //console.log(block_status);
      if (block_status == 1) 
      {
         $.ajax({
            url: "{{route('getLogout')}}",
            type: "GET",
            data: {},
            success:function(response) {
               //console.log(response);
               location.reload();
            }
         });
      }
   });
</script>