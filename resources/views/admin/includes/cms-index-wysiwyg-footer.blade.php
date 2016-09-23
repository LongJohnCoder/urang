<footer>
   <!-- ========================== -->
   <!-- SECTION -->
   <!-- ========================== -->
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
                     <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_six_first_text}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_six_first_text">
                          
                          <button type="submit" class="btn btn-info btn-sm">Change</button>
                      </form>
                     <div class="bottom-text">{{$indexcontent->section_six_second_text}}</div>
                     <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                          <input required="required" type="text" name="value" value="{{$indexcontent->section_six_second_text}}">
                          <input type="hidden" name="_token" value="{{Session::token()}}">
                          <input type="hidden" name="field_to_update" value="section_six_second_text">
                          
                          <button type="submit" class="btn btn-info btn-sm">Change</button>
                      </form>
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
               <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                    <input required="required" required="required" type="text" name="value" value="{{$indexcontent->footer_section_one_header}}">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <input type="hidden" name="field_to_update" value="footer_section_one_header">
                    
                    <button type="submit" class="btn btn-info btn-sm">Change</button>
                </form>
               <p>{{$indexcontent->footer_section_one_first}}</p>
               <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                    <input required="required" required="required" type="text" name="value" value="{{$indexcontent->footer_section_one_first}}">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <input type="hidden" name="field_to_update" value="footer_section_one_first">
                    
                    <button type="submit" class="btn btn-info btn-sm">Change</button>
                </form>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>{{$indexcontent->footer_section_two_header}}</h5>
               <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                    <input required="required" required="required" type="text" name="value" value="{{$indexcontent->footer_section_two_header}}">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <input type="hidden" name="field_to_update" value="footer_section_two_header">
                    
                    <button type="submit" class="btn btn-info btn-sm">Change</button>
                </form>
               <div class="row">
                  <div class="col-md-6">
                     <ul class="footer-nav">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('index')}}">About Us</a></li>
                        <li><a href="{{route('getLogin')}}">Login</a></li>
                        <li><a href="{{route('getSignUp')}}">Sign-Up</a></li>
                     </ul>
                  </div>
                  <div class="col-md-6">
                     <ul class="footer-nav">
                        <li><a href="{{route('getNeiborhoodPage')}}">Neighborhoods</a></li>
                        <li><a href="{{route('getPrices')}}">Prices</a></li>
                        <li><a href="{{route('getFaqList')}}">FAQ's</a></li>
                        <li><a href="{{ route('getContactUs') }}">Contact us</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>{{$indexcontent->footer_section_three_header}}</h5>
               <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                       <input required="required" required="required" type="text" name="value" value="{{$indexcontent->footer_section_three_header}}">
                       <input type="hidden" name="_token" value="{{Session::token()}}">
                       <input type="hidden" name="field_to_update" value="footer_section_three_header">
                       
                       <button type="submit" class="btn btn-info btn-sm">Change</button>
                   </form>
               <ul class="contacts-list">
                  <li>
                     <p><i class="icon icon-House"></i>{{$indexcontent->footer_section_three_first}}
                     </p>
                     <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                       <input required="required" required="required" type="text" name="value" value="{{$indexcontent->footer_section_three_first}}">
                       <input type="hidden" name="_token" value="{{Session::token()}}">
                       <input type="hidden" name="field_to_update" value="footer_section_three_first">
                       
                       <button type="submit" class="btn btn-info btn-sm">Change</button>
                     </form>
                  </li>
                  <li>
                     <p><i class="icon icon-Phone2"></i>{{$indexcontent->footer_section_three_second}}</p>
                     <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                       <input required="required" type="text" name="value" value="{{$indexcontent->footer_section_three_second}}">
                       <input type="hidden" name="_token" value="{{Session::token()}}">
                       <input type="hidden" name="field_to_update" value="footer_section_three_second">
                       
                       <button type="submit" class="btn btn-info btn-sm">Change</button>
                     </form>
                  </li>
                  <li>
                     <p><i class="icon icon-Mail"></i><a href="mailto:lisa@u-rang.com">{{$indexcontent->footer_section_three_third}}</a> </p>
                     <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                       <input required="required" required="required" type="text" name="value" value="{{$indexcontent->footer_section_three_third}}">
                       <input type="hidden" name="_token" value="{{Session::token()}}">
                       <input type="hidden" name="field_to_update" value="footer_section_three_third">
                      
                       <button type="submit" class="btn btn-info btn-sm">Change</button>
                     </form>
                  </li>
               </ul>
            </div>
            <div class="col-md-3 col-sm-3">
               <h5>{{$indexcontent->footer_section_four_header}}</h5>
               <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                       <input required="required" type="text" name="value" value="{{$indexcontent->footer_section_four_header}}">
                       <input type="hidden" name="_token" value="{{Session::token()}}">
                       <input type="hidden" name="field_to_update" value="footer_section_four_header">
                       
                       <button type="submit" class="btn btn-info btn-sm">Change</button>
                     </form>

               
               <ul class="contacts-list">
                  <li>
                     <p><i class="icon icon-House"></i>{{$indexcontent->footer_section_four_first}}
                     </p>
                     <form class="text-center" action="{{route('postIndexWysiwygChange')}}" method="post">
                       <input required="required" required="required" type="text" name="value" value="{{$indexcontent->footer_section_four_first}}">
                       <input type="hidden" name="_token" value="{{Session::token()}}">
                       <input type="hidden" name="field_to_update" value="footer_section_four_first">
                       
                       <button type="submit" class="btn btn-info btn-sm">Change</button>
                     </form>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   <section class="copyright-section">
      <p>©2016 <span>Paper'd Media, Inc.</span>. All Rights Reserved</p>
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