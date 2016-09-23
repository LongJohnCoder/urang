@extends('admin.layouts.master-index-wysiwyg')
@section('content')
<link href="bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="bootstrap-editable/js/bootstrap-editable.js"></script>


<style>
.relative {position: relative; padding: 7px 0}
.custom-form{position: absolute; right: 0; top: 0}
.custom-form input[type="text"]{color: #fff; background:none; border: 1px solid #fff; padding: 5px 3px; line-height: 18px;}
.custom-form .btn{padding: 5px 3px;}

.section-heading input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 5px 3px; line-height: 18px;}
.section-heading .btn{padding: 5px 3px;}

.feature-item input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 5px 3px; width: 70%; line-height: 18px;}
.feature-item .btn{padding: 5px 3px;}

.laptops input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 8px 3px; line-height: 18px;}
.laptops .btn{padding: 5px 3px;}

.content-logo input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 8px 3px; line-height: 18px;}
.content-logo .btn{padding: 5px 3px;}

.scroll-content-body{height: 349px;}

.scroll-content-item input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 8px 3px; line-height: 18px;} 
.scroll-content-item .btn{padding: 5px 3px;}
.scroll-content-item form{margin: 12px 0}
.scroll-content center{padding: 7px 0;}

.step-item input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 5px 3px; line-height: 18px;} 
.step-item .btn{padding: 5px 3px;}

.video-chenger input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 5px 3px; line-height: 18px;} 
.video-chenger .btn{padding: 5px 3px;}

.media-body input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 5px 3px; width: 67%; line-height: 18px;} 
.media-body .btn{padding: 5px 3px;}

.buy-section input[type="text"]{color: #000; background:none; border: 1px solid #ccc; padding: 5px 3px; line-height: 18px;} 
.buy-section .btn{padding: 5px 3px;}
.buy-section form{margin: 15px 0;}

.footer-section input[type="text"]{color: #fff; background:none; border: 1px solid #ccc; padding: 5px 3px; width: 70%; line-height: 18px;}
.footer-section .btn{padding: 5px 3px;}



</style>

      <section class="top-header home-header with-bottom-effect transparent-effect dark">
  <div class="bottom-effect"></div>
  <div class="header-container">  
      <div class="wrap-section-slider" id="topSlider">
          <div class="sp-slides">
              <div class="slide-item sp-slide">
                  <div class="slide-image">
                      <img src="{{url('/')}}/public/new/img/sections/home-top-background.jpg"  alt="" />
                  </div>
                  <div class="slide-content ">
                      <div class="relative">  
                      <p class="top-title sp-layer"  data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="100" >{{$indexcontent->image_up_first_text}}</p>

                        <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_first_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_first_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                       </div> 
                       <div class="relative">  
                      <div class="title sp-layer" data-show-transition="right" data-hide-transition="up" data-show-delay="500" data-hide-delay="150">{{$indexcontent->image_up_second_text}}</div>
                      <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_second_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_second_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                      </div> 
                      <div class="relative">
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200">{{$indexcontent->image_up_third_text}}</div>
                      <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_third_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_third_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                      </div> 
                      <div class="relative">
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200"> {{$indexcontent->image_up_fourth_text}}</div>
                      <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_fourth_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_fourth_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                      </div>  
                      <div class="controls sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="800" data-hide-delay="250">
                          <a href="{{route('getSignUp')}}" class="btn btn-primary">Get Started NOW</a>
                          <a href="{{route('getPrices')}}" class="btn btn-info">&nbsp;&nbsp;Discover More&nbsp;&nbsp;</a>
                      </div>
                  </div>
              </div>
              <div class="slide-item sp-slide">
                  <div class="slide-image">
                      <img src="{{url('/')}}/public/new/img/sections/section-11.jpg" alt="" />
                  </div>
                  <div class="slide-content sp-layer">
                      <div class="relative">  
                      <p class="top-title sp-layer"  data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="100" >{{$indexcontent->image_up_first_text}}</p>
                      <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_first_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_first_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                      </div>
                      <div class="relative">  
                      <div class="title sp-layer" data-show-transition="right" data-hide-transition="up" data-show-delay="500" data-hide-delay="150">{{$indexcontent->image_up_second_text}}</div>
                      <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_second_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_second_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                      </div>  
                      <div class="relative">
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200">{{$indexcontent->image_up_third_text}}</div>
                      <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_third_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_third_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                      </div>
                      <div class="relative">
                      <div class="under-title sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="600" data-hide-delay="200"> {{$indexcontent->image_up_fourth_text}}</div>
                      <form class="text-center custom-form" action="{{route('postIndexWysiwygChange')}}" method="post">
                            <input required="required" type="text" name="value" value="{{$indexcontent->image_up_fourth_text}}">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="field_to_update" value="image_up_fourth_text">
                            
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </form>
                      </div>  
                      <div class="controls sp-layer" data-show-transition="up" data-hide-transition="up" data-show-delay="800" data-hide-delay="250">
                          <a href="{{route('getSignUp')}}" class="btn btn-primary">Get Started NOW</a>
                          <a href="{{route('getPrices')}}" class="btn btn-info">&nbsp;&nbsp;Discover More&nbsp;&nbsp;</a>
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
          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_header}}">
              <input type="hidden" name="_token" value="{{Session::token()}}">
              <input type="hidden" name="field_to_update" value="section_one_header">
              
              <button type="submit" class="btn btn-primary btn-sm">Change</button>
          </form>
          <div class="section-subtitle"></div>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                        <input required="required" type="text" name="value" value="{{$indexcontent->section_one_first_up_text}}">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <input type="hidden" name="field_to_update" value="section_one_first_up_text">
                        
                        <button type="submit" class="btn btn-primary btn-sm">Change</button>
                    </form>
                      <div class="text">
                          {{$indexcontent->section_one_first_bootom_text}}
                          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_first_bootom_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_first_bootom_text">
                             
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form> 
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_second_up_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_second_up_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
                      <div class="text">
                          {{$indexcontent->section_one_second_down_text}}
                          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_second_down_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_second_down_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_third_up_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_third_up_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
                      <div class="text">
                          {{$indexcontent->section_one_third_down_text}}
                          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_third_down_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_third_down_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form> 
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_fourth_up_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_fourth_up_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
                      <div class="text">
                          {{$indexcontent->section_one_fourth_down_text}}
                          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_fourth_down_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_fourth_down_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_fifth_up_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_fifth_up_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
                      <div class="text">
                          {{$indexcontent->section_one_fifth_down_text}}
                          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_one_fifth_down_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_one_fifth_down_text">
                              
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
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
         <!--  <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
              <center><input type="file"></center><br>
              <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
              <input type="hidden" name="_token" value="{{Session::token()}}">
              <input type="hidden" name="field_to_update" value="cover_image">
              
              <button type="submit" class="btn btn-primary btn-sm">Change</button>
          </form> -->
      </div>
  </div>
  <div class="container">
      <div class="content-logo text-center wow fadeInUp"  data-wow-duration="1s">
          <img src="{{url('/')}}/public/new/img/content-logo.png" alt="" class="img-responsive" />
          <!-- <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
              <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
              <input type="hidden" name="_token" value="{{Session::token()}}">
              <input type="hidden" name="field_to_update" value="cover_image">
              
              <button type="submit" class="btn btn-primary btn-sm">Change</button>
          </form> -->
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
              <p>{!! $cms !=null ? $cms->tag_line_3 : '' !!}</p>
              <div class="design-arrow inline-arrow"></div>
              <p class="large">{!! $cms !=null ? $cms->tag_line_4 : '' !!}</p>
              <p>{!! $cms !=null ? $cms->head_setion : '' !!}</p>
              <p>
              <ul style="font-size: 12px; font-weight: 100; line-height: 16px; font-family: 'Raleway', sans-serif; margin: 0 0 2.14em;">
                  {!! $cms !=null ? $cms->contents : '' !!}
              <br />
                  <p class="large">{!! $cms !=null ? $cms->head_section_2 : '' !!}</p>
                  {!! $cms !=null ? $cms->contents_2 : '' !!}
              </ul>
          </div>
          <div class="col-md-5 col-sm-5 text-center">
              <img src="{{url('/')}}/public/dump_images/{{ $cms !=null ? $cms->image : ''}}" alt="image" class="img-responsive" />
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
          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
              <input required="required" type="text" name="value" value="{{$indexcontent->section_three_heading}}">
              <input type="hidden" name="_token" value="{{Session::token()}}">
              <input type="hidden" name="field_to_update" value="section_three_heading">
              
              <button type="submit" class="btn btn-primary btn-sm">Change</button>
          </form>
          <div class="section-subtitle"></div>
          <div class="design-arrow"></div>
      </div>
  </div>

  <div class="scroll-pane ">
      <div class="scroll-content">
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img1.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img2.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img3.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
               
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img4.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img5.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img6.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img7.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img8.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
               
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img9.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img10.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img11.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img12.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img13.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img14.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img15.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
              <div class="scroll-content-body">
                  <div class="name"></div> 
              </div>
          </div>
          <div class="scroll-content-item  ">
              <img src="{{url('/')}}/public/new/img/img16.jpg" alt="" />
              <!-- <center>
              <input type="file">
              </center>
              <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{url('/')}}/public/new/img/laptop.jpg">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="cover_image">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form> -->
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
          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{$indexcontent->section_four_heading_upper}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="section_four_heading_upper">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form>
          <div class="section-subtitle">{{$indexcontent->section_four_heading_bottom}}</div>
          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                <input required="required" type="text" name="value" value="{{$indexcontent->section_four_heading_bottom}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input type="hidden" name="field_to_update" value="section_four_heading_bottom">
                
                <button type="submit" class="btn btn-primary btn-sm">Change</button>
            </form>
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
                           <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_four_first_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_four_first_text">
                              <br>
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
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
                          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_four_second_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_four_second_text">
                              <br>
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
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
                          <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                              <input required="required" type="text" name="value" value="{{$indexcontent->section_four_third_text}}">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="hidden" name="field_to_update" value="section_four_third_text">
                              <br>
                              <button type="submit" class="btn btn-primary btn-sm">Change</button>
                          </form>
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
<div class="video-chenger">
<form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
      <input required="required" type="text" name="value" value="{{$indexcontent->video_link}}">
      <input type="hidden" name="_token" value="{{Session::token()}}">
      <input type="hidden" name="field_to_update" value="video_link">
      
      <button type="submit" class="btn btn-primary btn-sm">Change</button>
  </form>
</div>
  <br>
  <br>
  <br>

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
<section class="browsers-section with-bottom-effect">
  <div class="bottom-effect"></div>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <img src="{{url('/')}}/public/new/img/browsers-image.png" alt=" " class="img-responsive" />

          </div>
      </div>
  </div>
</section>
<div class="video-chenger">
<!-- <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
    <input required="required" type="text" name="value" value="">
    <input type="hidden" name="_token" value="{{Session::token()}}">
    <input type="hidden" name="field_to_update" value="cover_image">
    <button type="submit" class="btn btn-primary btn-sm">Change</button>
</form> -->
</div>
<br>
<br>

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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_first_text_up}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_first_text_up">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p><em>{{$indexcontent->section_five_first_text_mid}}</em></p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_first_text_mid}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_first_text_mid">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p>{{$indexcontent->section_five_first_text_bottom}}</p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_first_text_bottom}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_first_text_bottom">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_second_text_up}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_second_text_up">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p><em>{{$indexcontent->section_five_second_text_mid}}</em></p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_second_text_mid}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_second_text_mid">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p>{{$indexcontent->section_five_second_text_bottom}}</p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_second_text_bottom}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_second_text_bottom">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_third_text_up}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_third_text_up">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p><em>{{$indexcontent->section_five_third_text_mid}}</em></p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_third_text_mid}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_third_text_mid">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p>{{$indexcontent->section_five_third_text_bottom}}</p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_third_text_bottom}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_third_text_bottom">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_fourth_text_up}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_fourth_text_up">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p><em>{{$indexcontent->section_five_fourth_text_mid}}</em></p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_fourth_text_mid}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_fourth_text_mid">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p>{{$indexcontent->section_five_fourth_text_bottom}}</p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_fourth_text_bottom}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_fourth_text_bottom">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_fifth_text_up}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_fifth_text_up">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p><em>{{$indexcontent->section_five_fifth_text_mid}}</em></p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_fifth_text_mid}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_fifth_text_mid">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p>{{$indexcontent->section_five_fifth_text_bottom}}
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_fifth_text_bottom}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_fifth_text_bottom">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
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
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_sixth_text_up}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_sixth_text_up">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p><em>{{$indexcontent->section_five_sixth_text_mid}}</em></p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_sixth_text_mid}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_sixth_text_mid">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                      <p>{{$indexcontent->section_five_sixth_text_bottom}}</p>
                      <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_five_sixth_text_bottom}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_five_sixth_text_bottom">
                          
                          <button type="submit" class="btn btn-primary btn-sm">Change</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection