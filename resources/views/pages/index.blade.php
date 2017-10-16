@extends('pages.layouts.master')
@section('content')
  <section class="top-header home-header with-bottom-effect transparent-effect dark">
  <div class="bottom-effect"></div>
  <div class="header-container">  
      <div class="wrap-section-slider" id="topSlider">
          <div class="sp-slides">
              <div class="slide-item sp-slide">
                  <div class="slide-image">
                      <img src="{{url('/')}}/public/new/img/mobileapp-mytrip.jpg"  alt="Homepage image" />
                  </div>
                  <div class="slide-content ">
                      <p style="text-align: center;" class="top-title sp-layer"  data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="100" >{{$indexcontent->image_up_first_text}}</p>
                      <div class="title sp-layer" data-show-transition="right" data-hide-transition="up" data-show-delay="500" data-hide-delay="150">{{$indexcontent->image_up_second_text}}</div>
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200">{{$indexcontent->image_up_third_text}}</div>
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200"> {{$indexcontent->image_up_fourth_text}}</div>
                      <div class="controls sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="800" data-hide-delay="250">
                          <a href="{{route('getSignUp')}}" class="btn btn-primary">Get Started NOW</a>
                          <a href="{{route('getPrices')}}" class="btn btn-info">&nbsp;&nbsp;Discover More&nbsp;&nbsp;</a>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="text-align: center;">
                          <a href="https://play.google.com/store/apps/details?id=us.tier5.u_rang&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" target="_blank"><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' style="height: 50px;" /></a>
                          <!-- <input type="image" src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" style="height: 50px;"></input>
                          <input type="image" src="{{url('/')}}/public/new/img/mobile-app/appstore.png" style="height: 50px;"></input> -->
                          <a href="#" target="_blank"><img alt='Get it on Google Play' src="{{url('/')}}/public/new/img/mobile-app/appstore.png" style="height: 50px; border-radius: none;" /></a>
                        </p>
                      </div>
                  </div>
              </div>
              <div class="slide-item sp-slide">
                  <div class="slide-image">
                      <img src="{{url('/')}}/public/new/img/mobileapp-mytrip.jpg" alt="" />
                  </div>
                  <div class="slide-content sp-layer">
                      <p style="text-align: center;" class="top-title sp-layer"  data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="100" >{{$indexcontent->image_up_first_text}}</p>
                      <div class="title sp-layer" data-show-transition="right" data-hide-transition="up" data-show-delay="500" data-hide-delay="150">{{$indexcontent->image_up_second_text}}</div>
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200">{{$indexcontent->image_up_third_text}}</div>
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200"> {{$indexcontent->image_up_fourth_text}}</div>
                      <div class="controls sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="800" data-hide-delay="250">
                          <a href="{{route('getSignUp')}}" class="btn btn-primary">Get Started NOW</a>
                          <a href="{{route('getPrices')}}" class="btn btn-info">&nbsp;&nbsp;Discover More&nbsp;&nbsp;</a>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="text-align: center;">
                          <a href="https://play.google.com/store/apps/details?id=us.tier5.u_rang&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" target="_blank"><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' style="height: 50px;" /></a>
                          <a href="#" target="_blank"><img alt='Get it on Google Play' src="{{url('/')}}/public/new/img/mobile-app/appstore.png" style="height: 50px;" /></a>
                          <!-- <input type="image" src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" style="height: 50px;"></input>
                          <input type="image" src="{{url('/')}}/public/new/img/mobile-app/appstore.png" style="height: 50px;"></input> -->
                        </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div><!--./container-->
</section>  


<!-- ========================== -->
<!-- HOME - FEATURES -->
<!-- ========================== -->

<section class="features-section">
  <div class="container">
      <div class="section-heading " >
          <div class="section-title">{{$indexcontent->section_one_header}}</div>
          <div class="section-subtitle"><h1 class="h1-main-section-title">Dry Cleaners NYC</h1></div>
          <div class="design-arrow"></div>
      </div>
  </div>
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-sm-6 wow fadeIn">
              <article>
                  <div class="feature-item ">
                      <div class="wrap-feature-icon">
                          <div class="feature-icon">
                              <a href="{{route('getStandAloneService', 'dry-clean')}}" target="_blank"><span class="icon icon-Carioca"></span></a>
                          </div>
                      </div>
                      <div class="title">{{$indexcontent->section_one_first_up_text}}</div>
                      <div class="text">
                          {{$indexcontent->section_one_first_bootom_text}} 
                     </div>
                  </div>
              </article>
          </div> 
          <div class="col-md-4 col-sm-6 wow fadeIn">
              <article>
                  <div class="feature-item active">
                      <div class="wrap-feature-icon">
                          <div class="feature-icon">
                             <a href="{{route('getStandAloneService', 'washNfold')}}" target="_blank"><span class="icon icon-Heart"></span></a>
                          </div>
                      </div>
                      <div class="title">{{$indexcontent->section_one_second_up_text}}</div>
                      <div class="text">
                          {{$indexcontent->section_one_second_down_text}}
                      </div>
                  </div>
              </article>
          </div> 
          <div class="col-md-4 col-sm-6 wow fadeIn">
              <article>
                  <div class="feature-item">
                      <div class="wrap-feature-icon">
                          <div class="feature-icon">
                              <a href="{{route('getStandAloneService', 'corporate')}}" target="_blank"><span class="icon icon-Tools"></span></a>
                          </div>
                      </div>
                      <div class="title">{{$indexcontent->section_one_third_up_text}}</div>
                      <div class="text">
                          {{$indexcontent->section_one_third_down_text}}
                      </div>
                  </div>
              </article>
          </div> 
          <div class="col-md-4 col-sm-6 wow fadeIn">
              <article>
                  <div class="feature-item">
                      <div class="wrap-feature-icon">
                          <div class="feature-icon">
                              <a href="{{route('getStandAloneService', 'tailoring')}}" target="_blank"><span class="icon icon-Blog"></span></a>
                          </div>
                      </div>
                      <div class="title">{{$indexcontent->section_one_fourth_up_text}}</div>
                      <div class="text">
                          {{$indexcontent->section_one_fourth_down_text}}
                      </div>
                  </div>
              </article>
          </div> 
          <div class="col-md-4 col-sm-6 wow fadeIn">
              <article>
                  <div class="feature-item">
                      <div class="wrap-feature-icon">
                          <div class="feature-icon">
                              <a href="{{route('getStandAloneService', 'wet-cleaning')}}" target="_blank"><span class="icon icon-Blog"></span></a>
                          </div>
                      </div>
                      <div class="title">{{$indexcontent->section_one_fifth_up_text}}</div>
                      <div class="text">
                          {{$indexcontent->section_one_fifth_down_text}}
                      </div>
                  </div>
              </article>
          </div>
        <!-- <div class="col-md-4 col-sm-6 wow fadeIn">
              <article>
                  <div class="feature-item">
                      <div class="wrap-feature-icon">
                          <div class="feature-icon">
                              <span class="icon icon-Blog"></span>
                          </div>
                      </div>
                      <div class="title">Housekeeping</div>
                      <div class="text">
                          Quite simply the best home cleaning you can imagine. 
                      </div>
                  </div>
              </article>
          </div> -->
      </div>
  </div>
</section>


<!-- ========================== -->
<!-- HOME - LAPTOPS -->
<!-- ========================== -->
<section class="laptops-section">
  <div class="container">
      <div class="laptops text-center wow fadeInUp" data-wow-duration="1s">
          <img src="{{url('/')}}/public/new/img/laptop.jpg" alt="" class="img-responsive" />
      </div>
  </div>
  <div class="container">
      <div class="content-logo text-center wow fadeInUp"  data-wow-duration="1s">
          <img src="{{url('/')}}/public/new/img/content-logo.png" alt="" class="img-responsive" />
      </div>
  </div>
</section>

<!-- ========================== -->
<!-- HOME - AREAS OF EXPERTISE-->
<!-- ========================== --> 
<section class="areas-section with-icon with-top-effect">
  <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
  <div class="container"> 
      <div class="row">
          <div class="col-md-7 col-sm-7 text-right">
              <div class="clearfix " style="padding-right: 3px;">
                  <div class="above-title">{!! $cms !=null ? $cms->tag_line : '' !!}</div>
                  <h4>{!! $cms !=null ? $cms->header : '' !!}</h4>
              </div>
              <div><em>{!! $cms !=null ? $cms->tag_line_2 : '' !!}</em></div>
              <p style="text-align: right;">{!! $cms !=null ? $cms->tag_line_3 : '' !!}</p>
              <div class="design-arrow inline-arrow"></div>
              <p class="large" style="text-align: right;">{!! $cms !=null ? $cms->tag_line_4 : '' !!}</p>
              <p style="text-align: right;">{!! $cms !=null ? $cms->head_setion : '' !!}</p>
              <br>
              <ul style="font-size: 12px; font-weight: 100; line-height: 16px; font-family: 'Raleway', sans-serif; margin: 0 0 2.14em;">
                 <p>{!! $cms !=null ? $cms->contents : '' !!}</p> 
              <br />
              <br>
              <br>
                  <p style="text-align: right;" class="large">{!! $cms !=null ? $cms->head_section_2 : '' !!}</p>
                  <p>{!! $cms !=null ? $cms->contents_2 : '' !!}</p>
              </ul>
          </div>
          <div class="col-md-5 col-sm-5 text-center">
              <img src="{{ $cms !=null ? $cms->image : ''}}" alt="image" class="img-responsive" />
          </div>
      </div>
  </div>
</section>

<!-- ========================== -->
<!-- HOME - ACHIEVEMENTS -->
<!-- ========================== -->
<!--    <section class="achievements-section with-bottom-effect dark dark-strong">
  <div class="bottom-effect"></div>
  <div class="container dark-content">
      <div class="row list-achieve">
          <div class="col-md-4 col-sm-4 col-xs-6 wow zoomIn" data-wow-delay="0.5s">
              <article>
                  <div class="achieve-item">
                      <div class="achieve-icon">
                          <span class="icon icon-Tie"></span>
                      </div>
                      <div class="count">25561</div>
                      <div class="name">Dry Cleaning Delivered</div>
                  </div>
              </article>
          </div>
          
          <div class="col-md-4 col-sm-4 col-xs-6 wow zoomIn" data-wow-delay="2.5s">
              <article>
                  <div class="achieve-item">
                      <div class="achieve-icon">
                          <span class="icon icon-Like"></span>
                      </div>
                      <div class="count">10160</div>
                      <div class="name">Happy Clients</div>
                  </div>
              </article>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-6 wow zoomIn" data-wow-delay="3.5s">
              <article>
                  <div class="achieve-item">
                      <div class="achieve-icon">
                          <span class="icon icon-Users"></span>
                      </div>
                      <div class="count">20</div>
                      <div class="name">Neighborhoods Serviced</div>
                  </div>
              </article>
          </div>
      </div>
  </div>
</section>-->

<!-- ========================== -->
<!-- HOME - LATEST WORKS -->
<!-- ========================== -->
<section class="latest-works-section clearfix">
  <div class="container">
      <div class="section-heading">
          <div class="section-title">{{$indexcontent->section_three_heading}}</div>
          <div class="section-subtitle"></div>
          <div class="design-arrow"></div>
      </div>
  </div>

  <div class="scroll-pane ">
      <div class="scroll-content">
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img1.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img2.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img3.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img4.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img5.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img6.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img7.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img8.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img9.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img10.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img11.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img12.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img13.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img14.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img15.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img16.jpg" alt="" />
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>

      </div>
      <div class="scroll-bar-wrap ">
          <div class="scroll-bar"></div>
      </div>
  </div>
</section>


<!-- ========================== -->
<!-- HOME - STEPS  -->
<!-- ========================== -->
<section class="steps-section with-icon ">
  <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
  <div class="container">
      <div class="section-heading">
          <div class="section-title">{{$indexcontent->section_four_heading_upper}}</div>
          <div class="section-subtitle">{{$indexcontent->section_four_heading_bottom}}</div>
          <div class="design-arrow"></div>
      </div>
  </div>
  <div class="container">
      <div class="row steps-list">
          <div class="col-md-4 col-sm-4 col-xs-4 wow fadeIn" >
              <div class="step-item">
                  <div class="item-icon" data-count="1">
                      <span class="icon icon-Pencil"></span>
                  </div>
                  <div class="item-text">
                      <h5>{{$indexcontent->section_four_first_text}}
                      </h5>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4 wow fadeIn" data-wow-delay="0.3s">
              <div class="step-item invert">
                  <div class="item-icon" data-count="2">
                      <span class="icon icon-Heart"></span>
                  </div>
                  <div class="item-text">
                      <h5>{{$indexcontent->section_four_second_text}}
                      </h5>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4 wow fadeIn" data-wow-delay="0.6s">
              <div class="step-item">
                  <div class="item-icon" data-count="3">
                      <span class="icon icon-Plaine"></span>
                  </div>
                  <div class="item-text">
                      <h5>{{$indexcontent->section_four_third_text}}
                      </h5>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!-- ========================== -->
<!-- HOME - VIDEO SECTION -->
<!-- ========================== -->

<section class="video-section with-bottom-effect dark dark-strong">
  <div class="video-play" id="video-play" data-property="{videoURL:'{{$indexcontent->video_link}}',containment:'#video-play',autoPlay:true, mute:true, startAt:0, opacity:1}"></div>
  <div class="bottom-effect"></div>
  <div class="container dark-content">
      <div class="row">
          <div class="col-md-12 text-center">
              <div class="title"></div>
              <em></em>
              <button type="button" class="btn-play"></button>
              <div class="duration"> <span> </span></div>
          </div>
      </div>
  </div>
</section>

<!-- ========================== -->
<!-- REVIEWS SECTION -->
<!-- ========================== -->
<!-- <section class="reviews-section">
  <div class="container">
      <div class="section-heading">
          <div class="section-title">What clients are saying</div>
          <div class="section-subtitle">Just a few Testimonials from Our Clients</div>
          <div class="design-arrow"></div>
      </div>
  </div>
  <div class="container">
      <div class="reviews-slider enable-owl-carousel" data-single-item="true">
          <div class="slide-item">
              <div class="media-left">
                  <div class="image-block">
                      <img src="img/review-img1.jpg" alt="" />
                  </div>
              </div>
              <div class="media-body">
                  <div class="description-block">
                      <div class="name">
                          <span>James H. Ken </span>
                          <em>Trader.</em>
                      </div>
                      <div class="review">
                          <em>U-Rang never fails to deliver. My suits are always impeccable and delivered in a timely manner.</em>
                      </div>
                  </div>
              </div>

          </div>
          <div class="slide-item">
              <div class="media-left">
                  <div class="image-block">
                      <img src="img/review-img2.jpg" alt="" />
                  </div>
              </div>
              <div class="media-body">
                  <div class="description-block">
                      <div class="name">
                          <span>Warren Daniels </span>
                          <em>Lawyer</em>
                      </div>
                      <div class="review">
                          <em>U-Rang, they answer, every single time. They've never not picked up my dry-cleaning or missed a delivery time. I can also count on them for a spotless apartment.</em>
                      </div>
                  </div>
              </div>

          </div>

      </div>
  </div>
</section>-->

<!-- ========================== -->
<!-- HOME - BROWSERS  -->
<!-- ========================== -->
<section class="browsers-section with-bottom-effect ">
  <div class="bottom-effect"></div>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <img src="{{url('/')}}/public/new/img/browsers-image.png" alt=" " class="img-responsive" />
          </div>
      </div>
  </div>
</section>

<!-- ========================== -->
<!-- HOME - SERVICES  -->
<!-- ========================== -->
<section class="services-section ">
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="service-item">
                  <div class="media-left">
                      <div class="wrap-service-icon">
                          <div class="service-icon">
                              <span class="icon icon-WorldGlobe"></span>
                          </div>
                      </div>
                  </div>
                  <div class="media-body">
                      <h5>{{$indexcontent->section_five_first_text_up}}</h5>
                      <p><em>{{$indexcontent->section_five_first_text_mid}}</em></p>
                      <p>{{$indexcontent->section_five_first_text_bottom}}</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="service-item">
                  <div class="media-left">
                      <div class="wrap-service-icon">
                          <div class="service-icon">
                              <span class="icon icon-Tablet"></span>
                          </div>
                      </div>
                  </div>
                  <div class="media-body">
                      <h5>{{$indexcontent->section_five_second_text_up}}</h5>
                      <p><em>{{$indexcontent->section_five_second_text_mid}}</em></p>
                      <p>{{$indexcontent->section_five_second_text_bottom}}</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="service-item">
                  <div class="media-left">
                      <div class="wrap-service-icon">
                          <div class="service-icon">
                              <span class="icon icon-Phone"></span>
                          </div>
                      </div>
                  </div>
                  <div class="media-body">
                      <h5>{{$indexcontent->section_five_third_text_up}}</h5>
                      <p><em>{{$indexcontent->section_five_third_text_mid}}</em></p>
                      <p>{{$indexcontent->section_five_third_text_bottom}}</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="services-divider">
              <div class="col-md-4 col-sm-4 col-xs-4"></div>
              <div class="col-md-4 col-sm-4 col-xs-4"></div>
              <div class="col-md-4 col-sm-4 col-xs-4"></div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="service-item">
                  <div class="media-left">
                      <div class="wrap-service-icon">
                          <div class="service-icon">
                              <span class="icon icon-Heart"></span>
                          </div>
                      </div>
                  </div>
                  <div class="media-body">
                      <h5>{{$indexcontent->section_five_fourth_text_up}}</h5>
                      <p><em>{{$indexcontent->section_five_fourth_text_mid}}</em></p>
                      <p>{{$indexcontent->section_five_fourth_text_bottom}}</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="service-item">
                  <div class="media-left">
                      <div class="wrap-service-icon">
                          <div class="service-icon">
                              <span class="icon icon-Bag"></span>
                          </div>
                      </div>
                  </div>
                  <div class="media-body">
                      <h5>{{$indexcontent->section_five_fifth_text_up}}</h5>
                      <p><em>{{$indexcontent->section_five_fifth_text_mid}}</em></p>
                      <p>{{$indexcontent->section_five_fifth_text_bottom}}
                      </p>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="service-item">
                  <div class="media-left">
                      <div class="wrap-service-icon">
                          <div class="service-icon">
                              <span class="icon icon-DesktopMonitor"></span>
                          </div>
                      </div>
                  </div>
                  <div class="media-body">
                      <h5>{{$indexcontent->section_five_sixth_text_up}}</h5>
                      <p><em>{{$indexcontent->section_five_sixth_text_mid}}</em></p>
                      <p>{{$indexcontent->section_five_sixth_text_bottom}}</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
