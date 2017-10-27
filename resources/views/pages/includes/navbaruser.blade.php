<style type="text/css">
  #push_noti{
    position: relative;
  }
  #push_noti i{
    font-size: 20px;
  }
  .notifi-count{
    background: #FF1E1E;
    color: #fff;
    position: absolute;
    top: 0;
    right: 5px;
    width: 20px;
    height: 20px;
    text-align: center;
    border-radius: 50%;
    box-shadow: 1px 1px 1px 1px #999;
  }
</style>
<header>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 header-bar">
            <div class="logo">
              <a href="{{route('index')}}">
                <img src="{{url('/')}}/public/images/logo.png" class="img-responsive">
              </a>
            </div>
            <div class="navigation">
              <nav class="navbar navbar-default nav-tabs">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li role="presentation"><a href="{{route('getCustomerDahsboard')}}">Home</a></li>
                      <li role="presentation"><a href="{{route('getPickUpReq')}}">NYC Pick-UP </a></li>
                      <li role="presentation"><a href="{{route('getMyPickUp')}}">My Pick-UP </a></li>
                      <li role="presentation"><a href="{{route('getPrices')}}">Prices</a></li>
                      <div style="display:none;">{{$test = (new \App\Helper\NavBarHelper)->getNeighborhood()}}</div>
                      <li role="presentation">
                        
                        <a href="{{route('getNeiborhoodPage')}}"> Neighborhoods <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                        @if(count($test) > 0)
                          <ul>
                            @foreach($test as $hood)
                              <li> <a href="{{route('getStandAloneNeighbor', $hood->url_slug)}}">{{$hood->name}}</a></li>
                            @endforeach
                          </ul>
                        @endif
                      </li>
                      <li>
                        <a href="{{route('getSchoolDonations')}}">School Donations</a> 
                      </li>
                      <li>
                        <a href="{{route('getServices')}}">Services <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                        <?php
                          $services_helper = (new \App\Helper\NavBarHelper)->getCmsData();
                        ?>
                        <ul style="width: 160%">
                          <li class="dryclean"><a  href="{{route('getStandAloneService', 'dry-clean')}}">{{$services_helper['dry_clean'] != null && $services_helper['dry_clean']->page_name != null ? $services_helper['dry_clean']->page_name : "dry clean only"}}</a></li>
                          <li class="washnfold"><a  href="{{route('getStandAloneService', 'washNfold')}}">{{$services_helper['wash_n_fold']!= null && $services_helper['wash_n_fold']->page_name != null ? $services_helper['wash_n_fold']->page_name : "wash and fold"}}</a></li>
                          <li><a  href="{{route('getStandAloneService', 'corporate')}}">{{$services_helper['corporate'] != null && $services_helper['corporate']->page_name != null ? $services_helper['corporate']->page_name : "corporate"}}</a></li>
                          <li><a  href="{{route('getStandAloneService', 'tailoring')}}">{{$services_helper['tailoring'] != null && $services_helper['tailoring']->page_name != null ? $services_helper['tailoring']->page_name : "Tailoring"}}</a></li>
                          <li><a  href="{{route('getStandAloneService', 'wet-cleaning')}}">{{$services_helper['wet_clean'] != null && $services_helper['wet_clean']->page_name != null ? $services_helper['wet_clean']->page_name : "Wet cleaning"}}</a></li>
                        </ul>
                      </li>
                      <li role="presentation"><a href="{{route('getFaqList')}}">FAQs</a></li>
                      <li role="presentation"><a href="{{route('getContactUs')}}">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav new-nav">
                      <div style="display: none;">{{$logged_user= (new \App\Helper\NavBarHelper)->getCustomerData()}}</div>
                      <li role="presentation" class="welcome-user"><a href="#">Welcome <span>{{$logged_user->user_details->name}}</span></a>
                        <ul>
                          <li role="presentation"><a href="{{route('get-user-profile')}}"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
                          <li role="presentation"><a href="{{route('getChangePassword')}}"><i class="fa fa-cog" aria-hidden="true"></i> Change Password</a></li>
                        </ul>
                      </li>
                      <li id="push_panel_li">
                        <a href="{{route('getListNotification')}}" id="push_noti">
                          <i class="fa fa-bell-o" aria-hidden="true"></i>
                          <span class="notifi-count"></span>
                        </a>
                      </li>
                      <li><a href="{{route('getLogout')}}"><i class="fa fa-power-off" aria-hidden="true"></i></a></li>
                      <!-- <li><a href="{{route('getComplaints')}}">Complaints</a></li> -->
                      <li><a href="{{route('getMobileAppPage')}}">Download App</a></li>
                    </ul>
                
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
            </div>
          </div>
        </div>
    </div>
  </header>
  <script type="text/javascript">
    $(function(){
      //alert('test')
      $.ajax({
        url: "{{route('checkPushNotification')}}",
        type:"POST",
        data: {user_id: "{{auth()->guard('users')->user()->id}}", _token:"{{Session::token()}}"},
        success:function(data) {
          /*console.log(data);
          console.log(data.length);*/
          if (data != 0) {
            $('#push_noti .notifi-count').show();
            $('.notifi-count').text(data.length);
            $('#push_panel_li').attr('title', "you have "+ data.length + " unread notifications");
          } else {
            $('#push_noti').removeAttr('style');
            $('#push_noti .notifi-count').hide();
          }
        }
      });
      /*$('#push_noti').click(function(){
        $(this).removeAttr('style');
      });*/
    });
  </script>
<?php $sticky_nav_data = \App\Helper\SiteHelper::getStickyText(); ?>
