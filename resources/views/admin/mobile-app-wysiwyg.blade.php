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

   .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #4286f4;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main {
    transition: margin-left .5s;
   /* padding: 16px;*/
}

.side-menu-icon {
  color: #fff;
  font-size: 12px;
  left: 36px;
  position: absolute;
  top: 32px;
  vertical-align: top;
  z-index: 8888;
  cursor: pointer;
}
.side-menu-icon strong{font-size: 30px;}
.sidenav{z-index: 99999;}
.sidenav input[type="text"] {
  border: 1px solid #ccc;
  border-radius: 0;
  font-size: 12px;
  margin-bottom: 8px;
  padding: 8px 10px;
  width: 100%;
}
.sidenav input[type="button"]{background: #ff6400; border:none; cursor: pointer; padding: 6px 15px; color: #fff; font-size: 12px; }
.sidenav .closebtn{right: 0; color: #fff;}

.sidenav-wrap{width: 90%; margin: 0 auto;}
.sidenav-wrap label{color: #fff; font-size: 13px; padding-bottom: 7px;}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

</style>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
  <div id="mySidenav" class="sidenav">
  <div class="sidenav-wrap">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <label>Page Title</label>
    <input id="site_title_content" value="{{$data != null && $data->page_title_content != null ? $data->page_title_content : ''}}" type="text" placeholder="enter page title here" name="page_title_content"></input>
    <input type="button" id="site_title" class="changeMetaContent" onclick="changeMetaContent()" value="change">
    <br>
    <br>
    <label>Meta Keywords</label>
    <input type="text" id="meta_keywords_content" value="{{$data != null && $data->page_meta_keywords != null ? $data->page_meta_keywords : ''}}" placeholder="enter page meta keywords here" name="page_meta_keywords"></input>
    <input type="button" id="meta_keywords" class="changeMetaContent" onclick="changeMetaContent()"  value="change">
    <br>
    <br>
    <label>Meta Description</label>
    <input type="text" id="meta_description_content" value="{{$data != null && $data->page_meta_description != null ? $data->page_meta_description : ''}}" placeholder="enter page meta description here" name="page_meta_description"></input>
    <input type="button" id="meta_description" class="changeMetaContent" onclick="changeMetaContent()" value="change">
</div>
</div>

<div id="main">

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
                  <div id="main">
  
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

<section class="side-menu-icon">

  <span onclick="openButtonClick()" data-toggle="tooltip" title="Open Page Meta Data Editor"><strong> &#9776;</strong> </span>

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
</div>
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
var navIsOpen = false;
function openButtonClick()
{
  if(!navIsOpen)
  {
    openNav();
  }
  else
  {
    closeNav();
  }
}
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    navIsOpen=true;
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    navIsOpen=false;
}

$('.changeMetaContent').click(function(){
  var content_id = this.id;
  //alert($("#"+content_id+"_content").val());
  swal({
    title: "Are you sure?",
    text: "This will change the respective meta data.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, change it!",
    closeOnConfirm: false
  },
  function(){
    $.ajax({
            url: "{{route('postMobileAppWysiwygMetaData')}}",
            type: "POST",
            data: {fieldToUpdate: content_id, value:$("#"+content_id+"_content").val(), _token: '{!!csrf_token()!!}'},
            success: function(data) {
              if(data!=0)
              {
                swal("success!", data, "success");
                closeNav();
              }
              else
              {
                swal("faield!", "Sorry cannot update the value right now!", "error");
              }
            }
          });
    
  });
});
</script>
@endsection