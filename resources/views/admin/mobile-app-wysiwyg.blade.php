@extends('pages.layouts.master')
@section('content')
<style type="text/css">
   .textTitle {
      color: black;
      margin-left: 53%;
      height: 36px;
      font-size: 20px;
      text-align: center;
      /*border-radius: 6px;*/
   }
   .customBtn {
    margin-right: 82%;
    width: 33%;
    height: 44px;
    text-align: center;
    padding-top: 13px;
   }
   .textTagLine {
      margin-left: 53%;
      margin-top: 15px;
      color: black;
      width: 50%;
      /*border-radius: 5px;*/
      text-align: center;
   }
   .custom-btn {
      height: 43px;
      padding-top: 11px;
      font-family: sans-serif;
      font-style: normal;
      width: 33%;
      margin-right: 66%;
      margin-top: 10px;
   }
   .customTextArea{
      margin: 0px; width: 625px; height: 218px;
   }
</style>
   <section class="top-header neighborhood-header with-bottom-effect transparent-effect dark">
   <div class="bottom-effect"></div>
   <div class="header-container wow fadeInUp">
      <div class="header-title">
         <div class="header-icon"><span class="icon icon-Wheelbarrow"></span></div>
         <a href="" id="scroll_here_n"></a>
         <div class="title">
            <form role="form" action="{{route('postMobileAppWysiwyg')}}" method="POST">
               <div class="col-md-8">
                  <input type="text" name="title" id="title" class="textTitle" value="{{$data != null && $data->title != null ? $data->title : ''}}"></input>
               </div>
               <div class="col-md-4">
                  <button type="submit" class="btn btn-primary customBtn">save</button>
                  <input type="hidden" name="_token" value="{{Session::token()}}"></input>
               </div>
            </form>
            
         </div>
         <em style="color: whitesmoke;">
            <form role="form" action="{{route('postMobileAppWysiwyg')}}" method="POST">
               <div class="col-md-8">
                  <input type="text" name="tagLine" id="tagLine" class="textTagLine" value="{{$data != null && $data->tagLine != null ? $data->tagLine : ''}}"></input>
               </div>
               <div class="col-md-4">
                  <button type="submit" class="btn btn-primary custom-btn">save</button>
                  <input type="hidden" name="_token" value="{{Session::token()}}"></input>
               </div>
            </form>
         </em>
      </div>
   </div>
   <!--container-->
</section>
<section class="areas-section with-icon with-top-effect">
   <div class="section-icon"><span class="icon icon-Umbrella"></span></div>
   <div class="container">
      <div class="row">
         <div class="col-md-7 col-sm-7 text-right">
            <div class="clearfix " style="padding-right: 3px;">
               <div class="above-title">
                  <form role="form" method="POST" action="{{route('postMobileAppWysiwyg')}}">
                     <input type="text" name="above_title" id="above_title" value="{{$data != null && $data->above_title != null ? $data->above_title : ''}}"></input>
                     <button type="submit" class="btn btn-primary">save</button>
                     <input type="hidden" name="_token" value="{{Session::token()}}"></input>
                  </form>
               </div>
               <h4>Android</h4>
            </div>
            <div class="design-arrow inline-arrow"></div>
            <p>
            <ul style="text-align: left; font-size: 12px; font-weight: 100; line-height: 16px; font-family: 'Raleway', sans-serif; margin: 0 0 2.14em;">
            <form role="form" action="{{route('postMobileAppWysiwyg')}}" method="POST">
               <div class="form-group">
                  <textarea name="descriptionAndroid" id="descriptionAndroid" class="customTextArea">{{$data != null && $data->description_android != null ? $data->description_android : ''}}</textarea>
               </div>
               <button type="submit" class="btn btn-primary">save</button>
               <input type="hidden" name="_token" value="{{Session::token()}}"></input>
            </form>
         </div>
         <div style="height: 60px;"></div>
         <div class="col-md-5 col-sm-5 text-center">
            <img src="{{url('/')}}/public/dump_images/{{$data != null && $data->image_android != null ? $data->image_android : 'u-rang_android.png'}}" alt="image" class="img-responsive" style="height: 500px;" />
            <form role="form" action="{{route('postMobileAppWysiwyg')}}" method="POST" enctype="multipart/form-data">
               <div class="col-md-9">
                  <input type="file" name="imageChooser" id="imageChooser"></input>
               </div>
               <div class="col-md-3">
                  <button type="submit" class="btn btn-primary">save</button>
               </div>
               <input type="hidden" name="_token" value="{{Session::token()}}"></input>
            </form>
         </div>
      </div>
   </div>
</section>
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('descriptionAndroid',
{
    on :
    {
        instanceReady : function( ev )
        {
            this.dataProcessor.writer.setRules( '*',
            {
                indent : false,
                breakBeforeOpen : true,
                breakAfterOpen : false,
                breakBeforeClose : false,
                breakAfterClose : true
            });
        }
    }
});
</script>
@endsection