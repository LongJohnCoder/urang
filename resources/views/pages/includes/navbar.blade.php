
<header class="header scrolling-header">
  <nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container relative-nav-container">
      <a class="toggle-button visible-xs-block" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-navicon"></i>
      </a>
      <a class="navbar-brand scroll" href="{{route('index')}}">
          <img class="normal-logo hidden-xs" src="{{url('/')}}/public/new/img/logo-white.png" alt="logo" style="height: 51px; width: 132px; margin-left: -40px;" />
          <img class="scroll-logo hidden-xs" src="{{url('/')}}/public/new/img/logo.png" alt="logo" />
          <img class="scroll-logo visible-xs-block" src="{{url('/')}}/public/new/img/logo-white.png" alt="logo" />
      </a>

      
      <div class="navbar-collapse collapse floated" id="navbar-collapse" style="margin-left: 185px;">
          <ul class="nav navbar-nav navbar-with-inside clearfix navbar-right with-border"> 
              <li class="active">
                  @if(auth()->guard('users')->user() == null)
                    <a href="{{route('index')}}">Home</a>
                  @else
                    <a href="{{route('getCustomerDahsboard')}}">Home</a>
                  @endif
              </li>
              <li><a href="{{route('getPrices')}}">Prices</a></li>
              <li>
                  <a href="{{route('getFaqList')}}">FAQs</a>
              </li>
              <div style="display:none;">{{$navber_data = (new \App\Helper\NavBarHelper)->getNeighborhood()}}</div>
              <li>
                <a href="{{route('getNeiborhoodPage')}}"> Neighborhoods <span class="fa fa-caret-down" title="Toggle dropdown menu"></span></a>
                @if(count($navber_data) > 0)
                  <ul>
                      @foreach($navber_data as $hood)
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
                  <li class="dryclean"><a href="{{route('getStandAloneService', 'dry-clean')}}">{{$services_helper['dry_clean'] != null && $services_helper['dry_clean']->page_name != null? $services_helper['dry_clean']->page_name : "dry clean only"}}</a></li>
                  <li class="washnfold"><a  href="{{route('getStandAloneService', 'washNfold')}}">{{$services_helper['wash_n_fold']!= null && $services_helper['wash_n_fold']->page_name != null? $services_helper['wash_n_fold']->page_name : "wash and fold"}}</a></li>
                  <li><a  href="{{route('getStandAloneService', 'corporate')}}">{{$services_helper['corporate'] != null && $services_helper['corporate']->page_name != null ? $services_helper['corporate']->page_name : "corporate"}}</a></li>
                  <li><a  href="{{route('getStandAloneService', 'tailoring')}}">{{$services_helper['tailoring'] != null && $services_helper['tailoring']->page_name != null ? $services_helper['tailoring']->page_name : "Tailoring"}}</a></li>
                  <li><a  href="{{route('getStandAloneService', 'wet-cleaning')}}">{{$services_helper['wet_clean'] != null && $services_helper['wet_clean']->page_name != null ? $services_helper['wet_clean']->page_name : "Wet cleaning"}}</a></li>
                </ul>
              </li>
              <li>
                 <a href="{{ route('getContactUs') }}">Contact</a>
             </li>
             <li>
                  @if(auth()->guard('users')->user() != null)
                     <a href="{{route('getLogout')}}">Logout</a>
                  @else
                       <a href="{{route('getLogin')}}">Login</a>
                  @endif
              </li>
              <li>
                  @if(auth()->guard('users')->user() == null)
                     <a href="{{route('getSignUp')}}">Sign-Up</a>
                  @else
                  @endif
              </li>
              <!-- <li>
                <a href="{{route('getComplaints')}}">Complaints</a>
              </li> -->
          </ul>
      </div>
    </div>
  </nav>
</header><!--./navigation -->
