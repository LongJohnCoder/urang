<?php $i=0;?>
@extends($login_check !=null ? 'pages.layouts.user-master' : 'pages.layouts.master')
@section('content')
  <section class="top-header pricing-header with-bottom-effect transparent-effect dark">
   <div class="bottom-effect"></div>
   <div class="header-container wow fadeInUp">
      <div class="header-title">
         <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
         <div class="title">our prices</div>
         <em>Concierge Dry Cleaning Service<br>
         Owned and Operated Facility in Manhattan</em>
      </div>
   </div>
   <!--container-->
</section>
<!-- ========================== -->
<!-- HOME - FEATURES -->
<!-- ========================== -->
<section class="features-section">
   <div class="container">
      <div class="row">
         <div class="section-heading " >
            <div class="section-title">Our Prices</div>
            <div class="section-subtitle">
               Our Master Craftsmen can do miracles--you will be amazed! <br>we offer full service Dry Cleaning, Green Cleaning (chemical free) and Wash & Fold , We also professionally clean Leather & Suede
            </div>
            <div class="design-arrow"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4">
            <div class="plans">
               <h2>Residential Service <i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-caret-up" aria-hidden="true"></i></h2>
               <div class="product">
                  <div class="product-section">
                        <div class="col-md-3">
                           <img src="http://localhost/html/urang/public/images/demo.png" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <h3>product name</h3>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="row">
                              <h3>$40.00</h3>
                           </div>
                        </div>
                  </div>
                  <div class="product-section">
                        <div class="col-md-3">
                           <img src="http://localhost/html/urang/public/images/demo.png" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <h3>product name</h3>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="row">
                              <h3>$40.00</h3>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="plans">
               <h2>Household Items <i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-caret-up" aria-hidden="true"></i></h2>
               <div class="product">
                  <div class="product-section">
                        <div class="col-md-3">
                           <img src="http://localhost/html/urang/public/images/demo.png" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <h3>product name</h3>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="row">
                              <h3>$40.00</h3>
                           </div>
                        </div>
                  </div>
                  <div class="product-section">
                        <div class="col-md-3">
                           <img src="http://localhost/html/urang/public/images/demo.png" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <h3>product name</h3>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="row">
                              <h3>$40.00</h3>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="plans">
               <h2>Bedding <i class="fa fa-caret-down" aria-hidden="true"></i><i class="fa fa-caret-up" aria-hidden="true"></i></h2>
               <div class="product">
                  <div class="product-section">
                        <div class="col-md-3">
                           <img src="http://localhost/html/urang/public/images/demo.png" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <h3>product name</h3>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="row">
                              <h3>$40.00</h3>
                           </div>
                        </div>
                  </div>
                  <div class="product-section">
                        <div class="col-md-3">
                           <img src="http://localhost/html/urang/public/images/demo.png" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <h3>product name</h3>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="row">
                              <h3>$40.00</h3>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      $(".plans h2").click(function(){
         var product_box = $(this).parent().find($('.product'));
         product_box.toggleClass("close");
         if(product_box.hasClass("close")){
            product_box.slideUp(100);
            $(this).find($('.fa.fa-caret-up')).hide();
            $(this).find($('.fa.fa-caret-down')).show();
            
         }
         else{
            product_box.slideDown(100);
            $(this).find($('.fa.fa-caret-up')).show();
            $(this).find($('.fa.fa-caret-down')).hide();
         }
      });
   });
</script>